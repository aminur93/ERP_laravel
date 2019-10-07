<?php

namespace App\Http\Controllers\Hr\Ess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Hr\GrievanceIssue; 
use App\Models\Hr\GrievanceAppeal;
use Auth, DB, Validator, Image, DataTables, ACL; 


class GrievanceAppealController extends Controller
{
	public function showForm()
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

    	$issueList = GrievanceIssue::where('hr_griv_issue_status', '1')
    				->pluck('hr_griv_issue_name', 'hr_griv_issue_id'); 

    	return view('hr/ess/grievance_appeal', compact('issueList'));
    }

    public function saveData(Request $request)
    {
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

        $validator = Validator::make($request->all(), [
            'hr_griv_associate_id'        => 'required|max:10|min:10',
            'hr_griv_appl_issue_id'       => 'required|max:11',
            'hr_griv_appl_step'           => 'max:255',
            'hr_griv_appl_discussed_date' => 'required|date',
            'hr_griv_appl_req_remedy'     => 'required|max:255',
            'hr_griv_appl_offender_as_id' => 'required|max:255'  
        ]);

        if ($validator->fails()) 
        { 
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!');
        } 
        else
        {             
            $offender = explode(',', $request->hr_griv_appl_offender_as_id);
            if (is_array($offender) && count($offender) > 0)
            {
                $validID   = "";
                $invalidID = "";
                for($i=0; $i < count($offender); $i++)
                {   
                    if (strlen(trim($offender[$i]))==10)
                    {
                        $validID .= "$offender[$i], ";

                        $user = new GrievanceAppeal;
                        $user->hr_griv_associate_id   = $request->hr_griv_associate_id;       
                        $user->hr_griv_appl_issue_id  = $request->hr_griv_appl_issue_id;      
                        $user->hr_griv_appl_step      = $request->hr_griv_appl_step;      
                        $user->hr_griv_appl_discussed_date = (!empty($request->hr_griv_appl_discussed_date)?date('Y-m-d',strtotime($request->hr_griv_appl_discussed_date)):null);  
                        $user->hr_griv_appl_req_remedy = $request->hr_griv_appl_req_remedy;
                        $user->hr_griv_appl_offender_as_id = trim($offender[$i]);
                        $user->hr_griv_appl_created_by = (!empty(Auth::id())?(Auth::id()):null);
                        $user->hr_griv_appl_created_at = date('Y-m-d H:i:s');
                        $user->hr_griv_appl_status     = 0;
                        $user->save(); 
                    }
                    else
                    {
                        $invalidID .= "$offender[$i], ";
                    }  
                }  


                if ((strlen(trim($validID)) > 0) && (strlen(trim($invalidID)) > 0))
                {  
                    return back()
                        ->withInput()
                        ->with('success', "Save Successful. $validID are valid offenders.")
                        ->with('error', "$invalidID are invalid offenders.");
                }
                else if (strlen(trim($validID)) > 0)
                {
                    return back()
                        ->withInput()
                        ->with('success', "Save Successful. $validID are valid offenders.");
                } 
                else  
                {
                    return back()
                        ->withInput()
                        ->with('error', "Invalid Input. $invalidID are invalid offenders.");
                } 
            }
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            } 
        }
    }


    # appeal list
    public function showList()
    {
        ACL::check(["permission" => "hr_ess_grievance_list"]);
        #-----------------------------------------------------------# 

        return view('hr/ess/grievance_appeal_list');
    }

    # get appeal data
    public function getData()
    { 
        ACL::check(["permission" => "hr_ess_grievance_list"]);
        #-----------------------------------------------------------# 
        
        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_grievance_appeal AS g')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'), 
                'g.*',
                'i.hr_griv_issue_name AS issue'
            )
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', '=', 'g.hr_griv_associate_id') 
            ->leftJoin('hr_grievance_issue AS i', 'i.hr_griv_issue_id', '=', 'g.hr_griv_appl_issue_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->orderBy('g.hr_griv_appl_discussed_date','desc')
            ->orderBy('g.hr_griv_appl_id','desc')
            ->get();
 
        return Datatables::of($data) 
            ->addColumn('offender', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->hr_griv_appl_offender_as_id)." target=\"_blank\">$data->hr_griv_appl_offender_as_id</a>";
            }) 
            ->addColumn('griever', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->hr_griv_associate_id)." target=\"_blank\">$data->hr_griv_associate_id</a>";
            }) 
            ->addColumn('action', function ($data) {
                if ($data->hr_griv_appl_status == 0)
                {
                    return "<a href=".url('hr/performance/operation/disciplinary_form?gaid='.$data->hr_griv_appl_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Take an Action\">
                        <i class=\"ace-icon fa fa-gavel bigger-120\"></i>
                    </a>";
                }
                else
                {
                    return "<a href=\"#\" class=\"btn btn-xs btn-warning\" disabled>
                        <i class=\"ace-icon fa fa-gavel bigger-120\"></i>
                    </a>";
                }
            })  
            ->rawColumns(['serial_no', 'griever', 'offender', 'action'])
            ->toJson();
    }
 
}
