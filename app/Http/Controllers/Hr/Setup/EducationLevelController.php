<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\EducationLevel;
use App\Models\Hr\EducationDegree;
use DB, Validator, ACL;
class EducationLevelController extends Controller
{
    public function showForm(){
    	ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------#
    	$levelList= DB::table('hr_education_level AS l')->pluck('education_level_title', 'id');
    	// dd($levelList->all());
    	return view('hr/setup/education_title', compact('levelList'));
    }
    public function saveData(Request $request){
    	ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------#
        $validator= Validator::make($request->all(),[
        	'id'					=> 'required',
        	'education_degree_title' => 'required| max:128'
        ]);
        if($validator->fails())
        {
        	return back()
        			->withInput()
        			->with('error', "Invalid Input!");
        }
        else{
        	$title= new EducationDegree();
        	
        	$title->education_level_id = $request->id ;
        	$title->education_degree_title = $request->education_degree_title ;

        	if($title->save()){
        		return back()
        				->with('success', "Saved Successfully!!");
        	}
        	else{
        		return back()
        			->withInput()
        			->with('error', 'Something wrong!!');
        	}
        }
    }
}
