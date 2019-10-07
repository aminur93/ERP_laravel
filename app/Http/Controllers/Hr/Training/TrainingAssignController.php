<?php

namespace App\Http\Controllers\Hr\Training;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Employee;
use App\Models\Hr\Training;
use App\Models\Hr\TrainingAssign;
use App\Models\Hr\TrainingNames;
use DB, Validator, DataTables, ACL;

class TrainingAssignController extends Controller
{
	# Show Form
    public function showForm()
    {
        ACL::check(["permission" => "hr_training_assign"]);
        #-----------------------------------------------------------# 

    	$trainingList = DB::table('hr_training AS t')
			->leftJoin('hr_training_names AS tn', 'tn.hr_tr_name_id', '=', 't.tr_as_tr_id')
			->whereDate('t.tr_start_date', '>=', date('Y-m-d'))
			->where('t.tr_status', '1')
			->pluck('tn.hr_tr_name', 'tn.hr_tr_name_id');

    	return view('hr/training/assign_training', compact('trainingList'));
    }

    # Store Data
    public function saveTraining(Request $request)
    {
        ACL::check(["permission" => "hr_training_assign"]);
        #-----------------------------------------------------------# 

    	 $validator = Validator::make($request->all(), [
            'tr_as_tr_id'     => 'required|max:11',
            'tr_as_ass_id'    => 'required|max:10|min:10'
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
            //-----------Store Data---------------------
        	$store = new TrainingAssign;
			$store->tr_as_tr_id   = $request->tr_as_tr_id;  
            $store->tr_as_ass_id  = $request->tr_as_ass_id;   
			$store->tr_as_status  = 0;   

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


    # training list
    public function assignList()
    { 
        ACL::check(["permission" => "hr_training_assign_list"]);
        #-----------------------------------------------------------# 
        $trainingNames = TrainingNames::where('hr_tr_status', '1')
                        ->pluck('hr_tr_name');
        return view('hr/training/assign_list', compact('trainingNames'));
    }

    # training data
    public function getData()
    {  
        ACL::check(["permission" => "hr_training_assign_list"]);
        #-----------------------------------------------------------# 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_training_assign AS ta')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'ta.tr_as_id',
                'ta.tr_as_ass_id AS associate_id',
                'ta.tr_as_status',
                'b.as_name AS associate_name',
                'tr.*',
                'tn.hr_tr_name AS training_name' 
            )
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id',  '=', 'ta.tr_as_ass_id')
            ->leftJoin('hr_training AS tr', 'tr.tr_id',  '=', 'ta.tr_as_tr_id')
            ->leftJoin('hr_training_names AS tn','tn.hr_tr_name_id', '=', 'tr.tr_as_tr_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->orderBy('ta.tr_as_id','desc')
            ->get(); 

        return DataTables::of($data)  
            ->addColumn('associate_id', function ($data) {
                return "<a href=".url('hr/recruitment/employee/show/'.$data->associate_id)." target=\"_blank\">$data->associate_id</a>";
            }) 
            ->addColumn('schedule_date', function ($data) {
                if($data->tr_start_date != null){
                $start_date=date('d-M-Y',strtotime($data->tr_start_date));
                $end_date=date('d-M-Y',strtotime($data->tr_end_date));
                return "<strong>Start : </strong><span>$start_date</span><br/><strong>End&nbsp;&nbsp;&nbsp;: </strong><span>$end_date</span>";
                }
                else
                    return "<strong>Start : </strong><span>$data->tr_start_date</span><br/><strong>End&nbsp;&nbsp;&nbsp;: </strong><span>$data->tr_end_date</span>";
            })  
            ->addColumn('schedule_time', function ($data) {
                return "<strong>Start : </strong><span>$data->tr_start_time</span><br/><strong>End&nbsp;&nbsp;&nbsp;: </strong><span>$data->tr_end_time</span>";
            })      
            ->addColumn('action', function ($data) {
                if ($data->tr_as_status==1)
                    return "<div class=\"btn-group\"><button disabled type='button' class='btn btn-success btn-xs disabled'>Approved</button></div>";
                if ($data->tr_as_status==2)
                    return "<div class=\"btn-group\"><button disabled type='button' class='btn btn-danger btn-xs disabled'>Rejected</button></div>";
                else
                    return "<div class=\"btn-group\">  
                        <button disabled type='button' class='btn btn-info btn-xs disabled'>Pending</button>
                        <a href=".url('hr/training/assign_status/'.$data->tr_as_id. '/approved')." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Approved Now!\">
                            <i class=\"ace-icon fa fa-check bigger-120\"></i>
                        </a>
                        <a href=".url('hr/training/assign_status/'.$data->tr_as_id. '/rejected')." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Rejected Now!\">
                            <i class=\"ace-icon fa fa-times bigger-120\"></i>
                        </a>
                    </div>";
            }) 
            ->rawColumns(['serial_no', 'associate_id', 'schedule_date', 'schedule_time', 'action'])
            ->toJson();
    }



    # Assign Status
    public function assignStatus(Request $request)
    {

        ACL::check(["permission" => "hr_training_assign_list"]);
        #-----------------------------------------------------------# 

        if ($request->status == 'approved')
        {
            TrainingAssign::where('tr_as_id', $request->id)
            ->update(['tr_as_status' => '1']);
            return back()->with('success', 'Training Assign Approved!');
        }
        else
        {
            TrainingAssign::where('tr_as_id', $request->id)
            ->update(['tr_as_status' => '2']);
            return back()->with('success', 'Training Assign Rejected!');

        }
    }

}
