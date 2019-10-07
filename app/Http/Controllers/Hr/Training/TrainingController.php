<?php

namespace App\Http\Controllers\Hr\Training;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Training;
use App\Models\Hr\TrainingNames;
use DB, Validator, DataTables, ACL;

class TrainingController extends Controller
{
	// Show Add Training Form 
    public function showForm()
    {
        ACL::check(["permission" => "hr_training_add"]);
        #-----------------------------------------------------------# 
    	$trainingNames = TrainingNames::where('hr_tr_status', '1')
    					->pluck('hr_tr_name', 'hr_tr_name_id');

    	return view('hr/training/add_training', compact('trainingNames'));
    }

    # Store Training 
    public function saveTraining(Request $request)
    { 
        ACL::check(["permission" => "hr_training_add"]);
        #-----------------------------------------------------------# 

    	$validator = Validator::make($request->all(), [
            'tr_as_tr_id'     => 'required|max:11',
            'tr_trainer_name' => 'required|max:128',
            'tr_description'  => 'required|max:1024',
            'tr_start_date'   => 'required|date',  
            'tr_end_date'     => 'date|nullable', 
            'tr_start_time'   => 'required|max:5', 
            'tr_end_time'     => 'required|max:5' 
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
        	$store = new Training;
			$store->tr_as_tr_id  = $request->tr_as_tr_id;  	 
			$store->tr_trainer_name = $request->tr_trainer_name;  	 
			$store->tr_description = $request->tr_description;  	 
			$store->tr_start_date = (!empty($request->tr_start_date)?date('Y-m-d',strtotime($request->tr_start_date)):null);  
			$store->tr_end_date = (!empty($request->tr_end_date)?date('Y-m-d',strtotime($request->tr_end_date)):null);  
			$store->tr_start_time = (!empty($request->tr_start_time)?date('H:i',strtotime($request->tr_start_time)):null);  
			$store->tr_end_time = (!empty($request->tr_end_time)?date('H:i',strtotime($request->tr_end_time)):null);            

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
    public function trainingList()
    {  
        ACL::check(["permission" => "hr_training_list"]);
        #-----------------------------------------------------------# 

        return view('hr/training/training_list');
    }

    # training data
    public function getData()
    {  
        ACL::check(["permission" => "hr_training_list"]);
        #-----------------------------------------------------------# 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_training AS tr')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'tr.*',
                'tn.hr_tr_name AS training_name'
            )
            ->leftJoin('hr_training_names AS tn','tn.hr_tr_name_id', '=', 'tr.tr_as_tr_id')
            ->orderBy('tr.tr_start_date','desc')
            ->orderBy('tr.tr_id','desc')
            ->get(); 

        return DataTables::of($data)  
            ->addColumn('schedule_date', function ($data) {

                if($data->tr_start_date != null)
                {
                    $start_date=date('d-M-Y',strtotime($data->tr_start_date));

                    if (!empty($data->tr_end_date))
                    {
                        $end_date=date('d-M-Y',strtotime($data->tr_end_date));
                    }
                    else
                    {
                        $end_date = "Continue";
                    }

                    return "<strong>Start : </strong><span>$start_date</span><br/><strong>End&nbsp;&nbsp;&nbsp;: </strong><span>$end_date</span>";
                }
                else 
                {
                    return "<strong>Start : </strong><span>$data->tr_start_date</span><br/><strong>End&nbsp;&nbsp;&nbsp;: </strong><span>$data->tr_end_date</span>";
                }
            })  
            ->addColumn('schedule_time', function ($data) {
                return "<strong>Start : </strong><span>$data->tr_start_time</span><br/><strong>End&nbsp;&nbsp;&nbsp;: </strong><span>$data->tr_end_time</span>";
            })  
            ->addColumn('action', function ($data) {
                if ($data->tr_status == 1)
                    return "<div class=\"btn-group\">
                            <button type=\"button\" disabled class='btn btn-xs btn-success'>Active</button> 
                            <a href=".url('hr/training/training_status/'.$data->tr_id."/inactive")." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Inactive Now!\">
                            <i class=\"ace-icon fa fa-times bigger-120\"></i>
                        </div>";
                else
                    return "<div class=\"btn-group\">
                            <button type=\"button\" disabled class='btn btn-xs btn-danger'>Inactive</button> 
                            <a href=".url('hr/training/training_status/'.$data->tr_id."/active")." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Active Now!\">
                            <i class=\"ace-icon fa fa-check bigger-120\"></i>
                        </div>";
            })  
            ->rawColumns(['serial_no', 'schedule_date', 'schedule_time', 'action'])
            ->toJson();
    }


    # training Status
    public function trainingStatus(Request $request)
    {

        ACL::check(["permission" => "hr_training_list"]);
        #-----------------------------------------------------------# 
        
        if ($request->status == 'active')
        {
            Training::where('tr_id', $request->id)
            ->update(['tr_status'=>'1']);
            return back()->with('success', 'Training is Activated!');
        }
        else
        {
            Training::where('tr_id', $request->id)
            ->update(['tr_status'=>'0']);
            return back()->with('success', 'Training is Inactivated!');

        }

    }
}
