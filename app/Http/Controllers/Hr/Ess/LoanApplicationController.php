<?php

namespace App\Http\Controllers\Hr\Ess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\LoanApplication;
use App\Models\Hr\LoanType;
use App\Models\Hr\Unit;
use Auth, DB, Validator, DataTables, ACL;

class LoanApplicationController extends Controller
{
	# show loan list
	public function loanList()
	{
        ACL::check(["permission" => "hr_payroll_loan_list"]);
        #-----------------------------------------------------------# 
        $unit = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name','hr_unit_id');

    	return view('hr/ess/loan_application_list',compact('unit'));
    }

    # get LoadData
    public function getData()
    {  
        ACL::check(["permission" => "hr_payroll_loan_list"]);
        #-----------------------------------------------------------#

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_loan_application AS l')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'l.hr_la_id',
                'l.hr_la_as_id',
                'l.hr_la_name',
                'l.hr_la_applied_amount',
                'l.hr_la_updated_at',
                'l.hr_la_status',
                'bs.associate_id',
                'bs.as_unit_id',
                'u.hr_unit_id',
                'u.hr_unit_name'
            ) 
            ->leftJoin("hr_as_basic_info AS bs", 'bs.associate_id', 'l.hr_la_as_id')
            ->leftJoin("hr_unit AS u", 'u.hr_unit_id', 'bs.as_unit_id')
            ->whereIn('bs.as_unit_id', auth()->user()->unit_permissions())
            ->orderBy('l.hr_la_status','asc')
            ->orderBy('l.hr_la_id','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('hr_la_as_id', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->hr_la_as_id)." target=\"_blank\">$data->hr_la_as_id</a>";
            })
            ->addColumn('updated_at', function($data){
                $updated_at= date('s:i:h d-M-Y', strtotime($data->hr_la_updated_at));
                return $updated_at;
            })  
            ->addColumn('status', function ($data) {
            	if ($data->hr_la_status == 1)
                	return "<span class='label label-success'>Approved</span>";
            	elseif ($data->hr_la_status == 2)
                	return "<span class='label label-danger'>Declined</span>";
            	else
                	return "<span class='label label-success'>Applied</span>";
            })  
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/ess/loan_status/'.$data->hr_la_id.'/'.$data->hr_la_as_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no', 'hr_la_as_id', 'status', 'action'])
            ->toJson();
    }


    # show form
    public function showForm()
    {
        ACL::check(["permission" => "hr_ess_loan_application"]);
        #-----------------------------------------------------------# 
        $types= DB::table('hr_loan_type AS l')
                    ->select('l.*')
                    ->get();
    	return view("hr.ess.loan_application", compact('types'));
    }

    public function saveData(Request $request)
    {
        ACL::check(["permission" => "hr_ess_loan_application"]);
        #-----------------------------------------------------------# 
        
    	$validator = Validator::make($request->all(), [
    		'hr_la_name'               => 'required|max:64', 
    		'hr_la_designation'        => 'required|max:150', 
    		'hr_la_date_of_join'       => 'required|date', 
    		'hr_la_type_of_loan'       => 'required|max:64', 
    		'hr_la_applied_amount'     => 'required|max:11', 
            'hr_la_no_of_installments' => 'required|max:11', 
    		'hr_la_applied_date'       => 'required|date', 
    		'hr_la_purpose_of_loan'    => 'required|max:512',  
    		'hr_la_note'               => 'max:1024'  
    	]);

    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator)
    			->with("error", "Please fillup all required fields!");
    	}
    	else
    	{
	        // purpose of loan
	        $hr_la_purpose_of_loan = "";
	        if (sizeof($request->hr_la_purpose_of_loan) > 0)
	        {
	           foreach ($request->hr_la_purpose_of_loan as $value) {
	           	$hr_la_purpose_of_loan .= "$value, ";
	           }
	        } 

	        // Store Information
	        $store = new LoanApplication;
	        $store->hr_la_as_id          = Auth()->user()->associate_id;
	        $store->hr_la_name           = $request->hr_la_name;
	        $store->hr_la_designation    = $request->hr_la_designation;
	        $store->hr_la_date_of_join   = $request->hr_la_date_of_join;
	        $store->hr_la_type_of_loan   = $request->hr_la_type_of_loan;
	        $store->hr_la_applied_amount = $request->hr_la_applied_amount;
	        $store->hr_la_approved_amount = null;
	        $store->hr_la_no_of_installments = $request->hr_la_no_of_installments;
            $store->hr_la_no_of_installments_approved = null;
	        $store->hr_la_applied_date = $request->hr_la_applied_date;
	        $store->hr_la_purpose_of_loan = $hr_la_purpose_of_loan;
	        $store->hr_la_note = $request->hr_la_note;
	        $store->hr_la_supervisors_comment = null;
	        $store->hr_la_updated_at = null;
	        $store->hr_la_status = 0;

			if ($store->save())
			{
	     		return back()
	                 ->withInput()
	                 ->with('success', 'Save Successful.');
			}   
			else
			{
	     		return back()                    
	     			->withInput()->with('error', 'Please try again.');
			} 
    	}
    }


	public function showLoanStatus(Request $request)
	{ 
        ACL::check(["permission" => "hr_payroll_loan_list"]);
        #-----------------------------------------------------------#

		$loan = LoanApplication::select(
			'*',
    		DB::raw("
        		CASE 
        			WHEN hr_la_status = '0' THEN 'Applied' 
        			WHEN hr_la_status = '1' THEN 'Approved' 
        			WHEN hr_la_status = '2' THEN 'Declined' 
        		END AS status
    		")
		)
		->where('hr_la_id','=', $request->id)->first();

        $history =LoanApplication::select(
        		"*",
        		DB::raw("
	        		CASE 
	        			WHEN hr_la_status = '0' THEN 'Applied' 
	        			WHEN hr_la_status = '1' THEN 'Approved' 
	        			WHEN hr_la_status = '2' THEN 'Declined' 
	        		END AS hr_la_status
        		")
        	)
            ->where("hr_la_as_id", $request->associate_id)
            ->get();

		return view('hr/ess/loan_application_status', compact('loan', 'history'));
	}

    public function updateLoanStatus(Request $request)
    {
        ACL::check(["permission" => "hr_payroll_loan_list"]);
        #-----------------------------------------------------------#
        
        $validator= Validator::make($request->all(),[
            'hr_la_approved_amount' => 'required|max:11',
            'hr_la_no_of_installments_approved' => 'required|max:11',
            'hr_la_supervisors_comment' => 'required|max:255'
        ]);

        if($validator->fails())
        {
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
            if ($request->has('approve'))
            {
                DB::table('hr_loan_application')->where('hr_loan_application.hr_la_id', '=', $request->hr_la_id)
	                ->update([
	                'hr_loan_application.hr_la_approved_amount'=> $request->hr_la_approved_amount,
	                'hr_loan_application.hr_la_no_of_installments_approved'=> $request->hr_la_no_of_installments_approved,
	                'hr_loan_application.hr_la_supervisors_comment' => $request->hr_la_supervisors_comment,
	                'hr_loan_application.hr_la_updated_at' => date('Y-m-d H:i:s'),
	                'hr_loan_application.hr_la_status' => 1
	            ]);

            	return redirect('hr/ess/loan_list')->with('success','Loan Approved Successfully');

            }
            else
            {
                DB::table('hr_loan_application')->where('hr_loan_application.hr_la_id', '=', $request->hr_la_id)
                ->update([
                    'hr_loan_application.hr_la_approved_amount' => 0,
                    'hr_loan_application.hr_la_no_of_installments_approved' => 0,
                    'hr_loan_application.hr_la_supervisors_comment' => $request->hr_la_supervisors_comment,
                    'hr_loan_application.hr_la_updated_at' => date('Y-m-d H:i:s'),
                    'hr_loan_application.hr_la_status' => 2
                ]);

            	return redirect('hr/ess/loan_list')->with('success','Loan Rejected Successfully');
            }
        }
    }

    # Loan History by Associate ID
    public function loanHistory(Request $request)
    { 
        $data = [];
        if($request->has('associate_id'))
        { 
	        $data['associate'] = DB::table('hr_as_basic_info AS b')
	            ->select(
	                'b.as_name',
	                'b.as_doj',
	                'dp.hr_department_name',
	                'dg.hr_designation_name'  
	            )
	            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
	            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
	            ->where("b.associate_id", $request->associate_id)
	            ->first();   

	        $data['loan'] = DB::table('hr_loan_application')
	        	->select(
	        		"*",
	        		DB::raw("
		        		CASE 
		        			WHEN hr_la_status = '0' THEN 'Applied' 
		        			WHEN hr_la_status = '1' THEN 'Approved' 
		        			WHEN hr_la_status = '2' THEN 'Declined' 
		        		END AS hr_la_status
	        		")
	        	)
	            ->where("hr_la_as_id", $request->associate_id)
	            ->get();
        }
        return response()->json($data);
    }

}
