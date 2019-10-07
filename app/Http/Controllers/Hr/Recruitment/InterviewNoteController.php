<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\InterviewNote;
use Validator, ACL;

class InterviewNoteController extends Controller
{
    public function Interview()
    { 
        ACL::check(["permission" => "hr_recruitment_job_interview"]);
        #-----------------------------------------------------------# 

    	return view('hr/recruitment/interview_notes');
    }

    public function InterviewNoteStore(Request $request)
    { 
        ACL::check(["permission" => "hr_recruitment_job_interview"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(),[
    		'hr_interview_date'=>'required',
    		'hr_interview_name'=>'required|max:64|min:3',
    		'hr_interview_contact'=>'required|max:11',
    		'hr_interview_exp_salary'=>'required|max:11',
    		'hr_interview_board_member'=>'required|max:255',
    		'hr_interview_note'=>'max:255'
    	]);
        
    	if($validator->fails())
    	{
    		return back()
    		->withErrors($validator)
    		->withInput()
    		->with('error', 'Please fillup all required fileds!.');
    	}
    	else
        {
    		$interview= new InterviewNote();
    		$interview->hr_interview_date=$request->hr_interview_date;
    		$interview->hr_interview_name=$request->hr_interview_name;
    		$interview->hr_interview_contact=$request->hr_interview_contact;
    		$interview->hr_interview_exp_salary=$request->hr_interview_exp_salary;
    		$interview->hr_interview_board_member=$request->hr_interview_board_member;
    		$interview->hr_interview_note=$request->hr_interview_note;

    		if($interview->save()){
    			return back()
    			->with('success', 'Save Successfull.');
    		}
    		else{
    			return back()
    			->withInput()
    			->with('error', 'Please try again.');
    		}
    	}
    }
}
