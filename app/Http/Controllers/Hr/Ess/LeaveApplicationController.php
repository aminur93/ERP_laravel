<?php

namespace App\Http\Controllers\Hr\Ess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Leave;
use Auth, DB, Validator, ACL;

class LeaveApplicationController extends Controller
{
	public function showForm()
    {
        ACL::check(["permission" => "hr_ess_leave_application"]);
        #-----------------------------------------------------------# 

		return view('hr/ess/leave_application');
	}

	public function saveData(Request $request)
    {
        ACL::check(["permission" => "hr_ess_leave_application"]);
        #-----------------------------------------------------------# 
		$validator= Validator::make($request->all(),[
    		'leave_type'              => 'required',
    		'leave_from'              => 'required|date',
    		'leave_to'                => 'max:50',
    		'leave_applied_date'      => 'required|date',
            'leave_supporting_file'   => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024'
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
            $store->leave_ass_id = Auth()->user()->associate_id;
    		$store->leave_type   = $request->leave_type;
    		$store->leave_from   = $startDate;
    		$store->leave_to     = $endDate;
    		$store->leave_applied_date = (!empty($request->leave_applied_date)?date('Y-m-d', strtotime($request->leave_applied_date)):null);
    		$store->leave_supporting_file         = $leave_supporting_file;
            $store->leave_updated_at         = date('Y-m-d H:i:s');
            $store->leave_updated_by         = "XTQGMOKVJI";
    		$store->leave_status         = 0;
    		if ($store->save())
    		{
    			return back()
    				->with('success', 'Save successful.');
    		}
			else{
				return back()
				->withInput()
				->with('error','Error!!! Please try again!');
			}
		}
	}
    public function leaveHistory(Request $request){
        $history = DB::table('hr_leave')
            ->select(
                "*",
                DB::raw("
                    CASE 
                        WHEN leave_status = '0' THEN 'Applied' 
                        WHEN leave_status = '1' THEN 'Approved' 
                        WHEN leave_status = '2' THEN 'Declined' 
                    END AS leave_status
                ")
            )
            ->where("leave_ass_id", $request->associate_id)
            ->get();
            
        return response()->json($history);
    }
}
