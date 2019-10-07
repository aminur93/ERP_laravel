<?php

namespace App\Http\Controllers\Hr\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\LoanApplication;
use DB, DataTables, Validator;

class NotifLoanController extends Controller
{
    public function ShowLoan(){
    	return view('hr/notification/loan_app_list');
    }
    public function LoanData(){ 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_loan_application AS l')
            ->where('l.hr_la_status', '=', 0)
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'l.hr_la_id',
                'l.hr_la_as_id',
                'l.hr_la_name',
                'l.hr_la_applied_amount'
            )
            ->orderBy('l.hr_la_id','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/notification/loan/loan_approve/'.$data->hr_la_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no','action'])
            ->toJson();
    }

	    public function LoanView($id){

	    	$application = DB::table('hr_loan_application')
	    						->where('hr_loan_application.hr_la_id','=', $id)
	    						->first();

	    	if($application == null){
	    		return view('hr/notification/loan_app_list')
	    			->with('error', 'No record found!!');
	    	}
	    	else{
	    		return view('hr/notification/loan_approve' ,compact('application'));
	    	}

	    }
        public function LoanStatus(Request $request){
            $validator= Validator::make($request->all(),[
                'hr_la_approved_amount' => 'required|max:11',
                'hr_la_no_of_installments_approved' => 'required|max:11',
                'hr_la_supervisors_comment' => 'required|max:255'
            ]);
            if($validator->fails()){
                return back()
                ->withInput()
                ->with('error', 'Incorrect input, try again!');
            }
            else{
                if ($request->has('approve')){
                    DB::table('hr_loan_application')->where('hr_loan_application.hr_la_id', '=', $request->hr_la_id)
                    ->update([
                    'hr_loan_application.hr_la_approved_amount'=> $request->hr_la_approved_amount,
                    'hr_loan_application.hr_la_no_of_installments_approved'=> $request->hr_la_no_of_installments_approved,
                    'hr_loan_application.hr_la_supervisors_comment' => $request->hr_la_supervisors_comment,
                    'hr_loan_application.hr_la_updated_at' => date('Y-m-d H:i:s'),
                    'hr_loan_application.hr_la_status' => 1
                    
                ]);

                return redirect()->intended('hr/notification/loan/loan_app_list')
                ->with('success','Loan Approved Successfully');
                }
                else{
                    DB::table('hr_loan_application')->where('hr_loan_application.hr_la_id', '=', $request->hr_la_id)
                    ->update([
                        'hr_loan_application.hr_la_approved_amount' => 0,
                        'hr_loan_application.hr_la_no_of_installments_approved' => 0,
                        'hr_loan_application.hr_la_supervisors_comment' => $request->hr_la_supervisors_comment,
                        'hr_loan_application.hr_la_updated_at' => date('Y-m-d H:i:s'),
                        'hr_loan_application.hr_la_status' => 2
                    ]);
                return redirect()->intended('hr/notification/loan/loan_app_list')->with('success','Loan Rejected Successfully');
                }
            }
        }
}
