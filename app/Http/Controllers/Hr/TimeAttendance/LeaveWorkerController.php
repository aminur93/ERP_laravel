<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\LeaveApproval;
use App\Models\Hr\Leave;
use Auth, Validator, ACL;

class LeaveWorkerController extends Controller
{
    # show form
    public function showForm()
    {
        ACL::check(["permission" => "hr_time_worker_leave"]);
        #-----------------------------------------------------------# 

    	return view('hr/timeattendance/leave_worker');
    }

    # store data
    public function saveData(Request $request)
    { 
        ACL::check(["permission" => "hr_time_worker_leave"]);
        #-----------------------------------------------------------# 
        
    	$validator = Validator::make($request->all(), [
    		'leave_ass_id'            => 'required|max:10|min:10',
    		'leave_type'              => 'required',
    		'leave_from'              => 'required|date',
    		'leave_to'                => 'max:50',
    		'leave_applied_date'      => 'required|date',
            'leave_supporting_file'   => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
    		'leave_comment'           => 'max:128' 
        ]);
    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator)
    			->with('error', 'Please fillup all required fields!');
    	}
    	else
    	{ 
            $leave_supporting_file = null;  
            if($request->hasFile('leave_supporting_file')){
                $file = $request->file('leave_supporting_file');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/leaves/';
                $file->move( public_path($dir) , $filename );
                $leave_supporting_file = $dir.$filename;
            }

        	// Format Date
        	$startDate = (!empty($request->leave_from)?date('Y-m-d', strtotime($request->leave_from)):null);
        	$endDate = (!empty($request->leave_to)?date('Y-m-d', strtotime($request->leave_to)):$startDate);

            //-----------Store Data---------------------
    		$store = new Leave;
            $store->leave_ass_id        = $request->leave_ass_id;
    		$store->leave_type        = $request->leave_type;
    		$store->leave_from   = $startDate;
    		$store->leave_to     = $endDate;
    		$store->leave_applied_date = (!empty($request->leave_applied_date)?date('Y-m-d', strtotime($request->leave_applied_date)):null);
    		$store->leave_supporting_file         = $leave_supporting_file;
            $store->leave_comment         = $request->leave_comment;
            $store->leave_updated_at         = date('Y-m-d H:i:s');
            $store->leave_updated_by         = Auth::user()->associate_id;
    		$store->leave_status         = 1;

    		if ($store->save())
    		{
    			return back()
    				->with('success', 'Save successful.');
    		}
    		else
    		{
    			return back()
					->withErrors($validator)
					->withInput()
					->with('error', 'Please try again.');
    		}
    	}

    }
}
