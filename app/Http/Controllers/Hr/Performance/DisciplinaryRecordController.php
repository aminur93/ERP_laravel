<?php

namespace App\Http\Controllers\Hr\Performance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Employee;
use App\Models\Hr\Disciplinary;
use App\Models\Hr\GrievanceAppeal;
use App\Models\Hr\GrievanceIssue;
use App\Models\Hr\GrievanceStep;
use Auth, DB, Validator, DataTables, ACL; 

class DisciplinaryRecordController extends Controller
{
    public function showForm(Request $request)
    {
        ACL::check(["permission" => "hr_performance_op_disc"]);
        #-----------------------------------------------------------# 
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
    	return view('hr/performance/disciplinary_form', compact('issueList', 'stepList', 'appeal'));
    }

    public function saveData(Request $request)
    {
        ACL::check(["permission" => "hr_performance_op_disc"]);
        #-----------------------------------------------------------# 

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
                
    			return back()
                    ->with('success', 'Save Successful.');
    		}
    		else
            {
    			return back()                    
        			->with('error', 'Please try again.');
    		}
    	}
    }      

    public function showList()
    { 
        ACL::check(["permission" => "hr_performance_op_disc_list"]);
        #-----------------------------------------------------------# 
        return view('hr/performance/disciplinary_list');
    }

    # get LoadData
    public function getData()
    {  
        ACL::check(["permission" => "hr_performance_op_disc_list"]);
        #-----------------------------------------------------------# 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_dis_rec AS r')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'), 
                'r.dis_re_id', 
                'r.dis_re_offender_id', 
                'r.dis_re_griever_id', 
                'r.dis_re_req_remedy', 
                'r.dis_re_discussed_date', 
                'r.dis_re_doe_from', 
                'r.dis_re_doe_to',
                'i.hr_griv_issue_name AS issue', 
                's.hr_griv_steps_name AS step' 
            )
            ->leftJoin('hr_grievance_issue AS i', 'i.hr_griv_issue_id', '=', 'r.dis_re_issue_id')
            ->leftJoin('hr_grievance_steps AS s', 's.hr_griv_steps_id', '=', 'r.dis_re_issue_id')
            ->orderBy('r.dis_re_discussed_date','desc')
            ->get();

        return Datatables::of($data) 
            ->addColumn('griever', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->dis_re_griever_id)." target=\"_blank\">$data->dis_re_griever_id</a>";
            })
            ->addColumn('discussed_date', function($data){
                $discussed_date = (!empty($data->dis_re_discussed_date)? (date('d-M-Y', strtotime($data->dis_re_discussed_date))):null);
                return $discussed_date;
            })
            ->addColumn('date_of_execution', function($data){
                $start= (!empty($data->dis_re_doe_from)? (date('d-M-Y',strtotime($data->dis_re_doe_from))):null);
                $to= (!empty($data->dis_re_doe_to)? (date('d-M-Y', strtotime($data->dis_re_doe_to))):null);
                $date_of_execution= $start. " to ".$to;
                return $date_of_execution;
            }) 
            ->addColumn('offender', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->dis_re_offender_id)." target=\"_blank\">$data->dis_re_offender_id</a>";
            }) 
            ->addColumn('action', function ($data) { 
                return "<a href=".url('hr/performance/operation/disciplinary_edit/'.$data->dis_re_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                    <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                </a>"; 
            })  
            ->rawColumns(['serial_no', 'griever', 'offender', 'action'])
            ->toJson();
    }


    public function editForm(Request $request)
    { 
        ACL::check(["permission" => "hr_performance_op_disc_list"]);
        #-----------------------------------------------------------# 

        $record = DB::table('hr_dis_rec AS r')
            ->select(
                'r.dis_re_id', 
                'r.dis_re_offender_id', 
                'r.dis_re_griever_id', 
                'r.dis_re_issue_id', 
                'r.dis_re_ac_step_id', 
                'r.dis_re_req_remedy', 
                'r.dis_re_discussed_date', 
                'r.dis_re_doe_from', 
                'r.dis_re_doe_to', 
                DB::raw('CONCAT_WS(" - ", b1.associate_id, b1.as_name) AS offender'),
                DB::raw('CONCAT_WS(" - ", b2.associate_id, b2.as_name) AS griever') 
            )
            ->leftJoin('hr_as_basic_info AS b1', 'b1.associate_id', '=', 'r.dis_re_offender_id')
            ->leftJoin('hr_as_basic_info AS b2', 'b2.associate_id', '=', 'r.dis_re_griever_id')
            ->where('r.dis_re_id', $request->record_id)
            ->orderBy('r.dis_re_id','desc')
            ->orderBy('r.dis_re_created_at','asc')
            ->first();

        $issueList = GrievanceIssue::where('hr_griv_issue_status', '1')
                    ->pluck('hr_griv_issue_name', 'hr_griv_issue_id');
        $stepList = GrievanceStep::where('hr_griv_steps_status', '1')
                    ->pluck('hr_griv_steps_name', 'hr_griv_steps_id');
        return view('hr/performance/disciplinary_edit', compact('issueList', 'stepList', 'record'));
    }

    public function updateData(Request $request)
    {

        ACL::check(["permission" => "hr_performance_op_disc_list"]);
        #-----------------------------------------------------------# 
        
        $validator = Validator::make($request->all(), [
            'dis_re_id'          => 'required|max:11',
            'dis_re_offender_id' => 'required|max:10|min:10',
            'dis_re_griever_id'  => 'max:10',
            'dis_re_issue_id'    => 'required|max:11',
            'dis_re_ac_step_id'  => 'required|max:11',
            'dis_re_req_remedy'  => 'required|max:255',
            'dis_re_discussed_date' => 'required|date',
            'dis_re_doe_from'    => 'required|date',
            'dis_re_doe_to'      => 'required|date'     
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
            $update = Disciplinary::where('dis_re_id', $request->dis_re_id)
            ->update([
                'dis_re_offender_id' => $request->dis_re_offender_id,
                'dis_re_griever_id'  => $request->dis_re_griever_id,
                'dis_re_issue_id'    => $request->dis_re_issue_id,
                'dis_re_ac_step_id'  => $request->dis_re_ac_step_id,
                'dis_re_req_remedy'  => $request->dis_re_req_remedy,
                'dis_re_discussed_date' => (!empty($request->dis_re_discussed_date)?date('Y-m-d',strtotime($request->dis_re_discussed_date)):null),
                'dis_re_doe_from'    => (!empty($request->dis_re_doe_from)?date('Y-m-d',strtotime($request->dis_re_doe_from)):null),
                'dis_re_doe_to'      => (!empty($request->dis_re_doe_to)?date('Y-m-d',strtotime($request->dis_re_doe_to)):null),
            ]);

            if($update)
            {
                if (!empty($request->get('gaid')))
                {
                    # change grievance appeal status
                    GrievanceAppeal::where('hr_griv_appl_id', $request->get('gaid'))
                        ->update(['hr_griv_appl_status'=>1]);
                }
                
                return back()
                    ->with('success', 'Update Successful.');
            }
            else
            {
                return back()                    
                    ->with('error', 'Please try again.');
            }
        }
    }      

}
