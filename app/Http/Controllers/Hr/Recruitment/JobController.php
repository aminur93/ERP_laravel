<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\JobPosting;
use Yajra\Datatables\Datatables;
Use Validator, ACL, DB;

class JobController extends Controller
{ 
    public function JobPosting()
    {
        ACL::check(["permission" => "hr_recruitment_job_posting"]);
        #-----------------------------------------------------------# 

    	return view('hr/recruitment/job_posting');
    }

    public function JobPostingStore(Request $request)
    {
        // dd($request->all());
        ACL::check(["permission" => "hr_recruitment_job_posting"]);
        #-----------------------------------------------------------# 
        
    	$validator= Validator::make($request->all(),[
    		'job_po_title'=>'required|max:128',
            'job_po_vacancy'=>'required|max:11',
    		'job_po_application_deadline'=>'required',
    		'job_po_description'=>'required|max:512',
    		'job_po_responsibility'=>'required|max:2048',
    		'job_po_nature'=>'required',
    		'job_po_edu_req'=>'required|max:255',
    		'job_po_experience'=>'required|max:512',
    		'job_po_age_limit'=>'required|max:32',
    		'job_po_requirment'=>'required|max:512',
    		'job_po_location'=>'required|max:64',
    		'job_po_salary'=>'required|max:128',
    		'job_po_benefits'=>'required|max:256'
    	]);
    	if($validator->fails()){
    		return back()
    		->withInput()
    		->withErrors($validator)
    		->with('error', 'Please fillup all required fileds!.');
    	}
    	else
    	{
    		$jobs= new JobPosting();
    		$jobs->job_po_title= $request->job_po_title;
            $jobs->job_po_vacancy= $request->job_po_vacancy;
    		$jobs->job_po_application_deadline= $request->job_po_application_deadline;
    		$jobs->job_po_description= $request->job_po_description;
    		$jobs->job_po_responsibility= $request->job_po_responsibility;
    		$jobs->job_po_nature= $request->job_po_nature;
    		$jobs->job_po_edu_req= $request->job_po_edu_req;
    		$jobs->job_po_experience= $request->job_po_experience;
    		$jobs->job_po_age_limit= $request->job_po_age_limit;
    		$jobs->job_po_requirment= $request->job_po_requirment;
    		$jobs->job_po_location= $request->job_po_location;
    		$jobs->job_po_salary= $request->job_po_salary;
    		$jobs->job_po_benefits= $request->job_po_benefits;

    		if($jobs->save()){
    			return back()
    			->with('success',  'Save Successfull.');
    		}
    		else{
    			return back()
    			->with('error', 'Please try again!.');
    		}
    	}
    }
    public function JobPostingList(){
        ACL::check(["permission" => "hr_recruitment_job_posting"]);
        #-----------------------------------------------------------# 
        $titleList= DB::table('hr_job_posting')
                        ->pluck('job_po_title');
        return view('hr/recruitment/job_posting_list',compact('titleList'));
    }
    public function JobPostingListData(){
        ACL::check(["permission" => "hr_recruitment_job_posting"]);
        #-----------------------------------------------------------# 
        DB::statement(DB::raw('set @serial_no=0'));
        $data= DB::table('hr_job_posting AS j')
                ->select(
                    DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                    'j.*'
                )
                ->orderBy('j.job_po_id', 'DESC')
                ->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) { 

                if (!$data->job_po_status)
                {
                    return "<div class=\"btn-group\">
                        <span class='btn btn-xs btn-danger disabled'>Disabled</span>
                        <a onclick=\"confirm('Are you sure?')\" href=".url('hr/recruitment/job_portal/job_posting_list/'.$data->job_po_id."/enable")." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Enable Now\">
                            <i class=\"ace-icon fa fa-check bigger-120\"></i>
                        </a></div>";
                }
                else
                {
                    return "<div class=\"btn-group\">
                        <span class='btn btn-xs btn-success disabled'>Enable</span>
                        <a onclick=\"confirm('Are you sure?')\" href=".url('hr/recruitment/job_portal/job_posting_list/'.$data->job_po_id."/disable")." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Disable Now\">
                            <i class=\"ace-icon fa fa-times bigger-120\"></i>
                        </a></div>";

                }
            }) 
            ->editColumn('job_po_nature', function($data){
                if($data->job_po_nature==1)
                    return "Full Time";
                else if($data->job_po_nature==2)
                    return "Part Time";
                else
                    return "Contractual";
            })
            ->rawColumns([
                'serial_no',
                'action'
            ])->toJson();
    }
    public function JobPostingListStatus(Request $request){
            DB::table('hr_job_posting')
                    ->where('job_po_id', $request->job_po_id)
                    ->update([
                        "job_po_status" => (($request->status =="enable")?1:0)
                    ]);
            return back()
                ->with("success", "Update Successful!");
    }
}
