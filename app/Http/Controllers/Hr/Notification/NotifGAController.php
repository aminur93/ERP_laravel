<?php

namespace App\Http\Controllers\Hr\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\GrievanceAppeal;
use App\Models\Hr\GrievanceIssue; 
use App\Models\Hr\GrievanceStep; 
use App\Models\Hr\Disciplinary; 

use Auth, DB, DataTables, Validator;

class NotifGAController extends Controller
{
    public function greivanceAppealList(){
    	return view('hr/notification/greivance_appeal_list');
    }

    public function greivanceAppealListData()
    { 
        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_grievance_appeal AS g')
        	->where('hr_griv_appl_status', '=', 0)
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'b.as_name',
                'g.*',
                'i.hr_griv_issue_name AS issue'
            )
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', '=', 'g.hr_griv_appl_offender_as_id')
            ->leftJoin('hr_grievance_issue AS i', 'i.hr_griv_issue_id', '=', 'g.hr_griv_appl_issue_id')
            ->orderBy('g.hr_griv_appl_id','desc')
            ->get();

        return Datatables::of($data) 
            ->addColumn('griever', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->hr_griv_appl_offender_as_id)." target=\"_blank\">$data->hr_griv_appl_offender_as_id</a>";
            }) 
            ->addColumn('offender', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->hr_griv_associate_id)." target=\"_blank\">$data->hr_griv_associate_id</a>";
            }) 
            ->addColumn('action', function ($data) {
                return "<a href=".url('hr/notification/greivance/greivance_approve?gaid='.$data->hr_griv_appl_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Take an Action\">
                    <i class=\"ace-icon fa fa-gavel bigger-120\"></i>
                </a>";
            })  
            ->rawColumns(['serial_no', 'griever', 'offender', 'action'])
            ->toJson();
    }
 

    public function GreivanceView(Request $request) 
    {
        // Appeal Record
        $appeal = [];
        if (!empty($request->gaid))
        {
            $appeal = DB::table('hr_grievance_appeal AS a')
            ->select(
                'a.*',
                DB::raw("CONCAT_WS(' - ', a.hr_griv_associate_id, g.as_name) AS griever"),
                DB::raw("CONCAT_WS(' - ', a.hr_griv_appl_offender_as_id, o.as_name) AS offender") 
            )
            ->leftJoin('hr_as_basic_info AS g', 'g.associate_id', '=', 'a.hr_griv_associate_id')
            ->leftJoin('hr_as_basic_info AS o', 'o.associate_id', '=', 'a.hr_griv_appl_offender_as_id')
            ->where('hr_griv_appl_id', $request->gaid)
            ->first();
        }

    	$issueList = GrievanceIssue::where('hr_griv_issue_status', '1')
    				->pluck('hr_griv_issue_name', 'hr_griv_issue_id');
    	$stepList = GrievanceStep::where('hr_griv_steps_status', '1')
    				->pluck('hr_griv_steps_name', 'hr_griv_steps_id');
    	return view('hr/notification/greivance_approve', compact('issueList', 'stepList', 'appeal'));
    }


    public function GreivanceApprove(Request $request)
    {
      	$validator = Validator::make($request->all(), [
            'dis_re_offender_id' => 'required|max:10|min:10',
    		'dis_re_griever_id'  => 'max:10',
    		'dis_re_issue_id' 	 => 'required|max:11',
    		'dis_re_ac_step_id'  => 'required|max:11',
    		'dis_re_req_remedy'  => 'required|max:255',
    		'dis_re_discussed_date' => 'required|date',
    		'dis_re_doe_from' 	 => 'required|date',
    		'dis_re_doe_to' 	 => 'required|date'		
    	]);

    	if($validator->fails())
        {
    		return back()
    			->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!.');
    	}
    	else
        {
    		$record= new Disciplinary;
    		$record->dis_re_offender_id = $request->dis_re_offender_id ;
    		$record->dis_re_griever_id  = $request->dis_re_griever_id ;
    		$record->dis_re_issue_id    = $request->dis_re_issue_id ;
    		$record->dis_re_ac_step_id  = $request->dis_re_ac_step_id ;
    		$record->dis_re_req_remedy  = $request->dis_re_req_remedy ;
            $record->dis_re_discussed_date = (!empty($request->dis_re_discussed_date)?date('Y-m-d',strtotime($request->dis_re_discussed_date)):null);
    		$record->dis_re_doe_from    = (!empty($request->dis_re_doe_from)?date('Y-m-d',strtotime($request->dis_re_doe_from)):null);
            $record->dis_re_doe_to      = (!empty($request->dis_re_doe_to)?date('Y-m-d',strtotime($request->dis_re_doe_to)):null);
            $record->dis_re_created_by  = (!empty(Auth::id())?(Auth::id()):null);
            $record->dis_re_created_at  = date("Y-m-d H:i:s"); 
 
    		if($record->save())
            {
                if (!empty($request->get('gaid')))
                {
                    # change grievance appeal status
                    GrievanceAppeal::where('hr_griv_appl_id', $request->get('gaid'))
                        ->update(['hr_griv_appl_status' => 1]);
                }
                
    			return redirect('hr/notification/greivance/greivance_appeal_list')
                    ->with('success', 'Save Successful.');
    		}
    		else
            {
    			return back()                    
        			->with('error', 'Please try again.');
    		}
    	}
    }  

}
