<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\LoanType;
use Validator,ACL;

class LoanTypeController extends Controller
{
    public function addloanType(){
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	return view('hr/setup/loan_type');
    }
    public function storeloanType(Request $request){
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	$validator= Validator::make($request->all(),[
    		'hr_loan_type_name' => 'required|max:128'
    	]);
    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput();
    	}
    	else{
    		$type= new LoanType();
    		$type->hr_loan_type_name= $request->hr_loan_type_name;
    		if($type->save())
    		{
    			return back()
    			->with('success', "Saved Successfully");
    		}
    		else{
    			return back()
    			->withInput()
    			->with('error', "Error! Please try again!");
    		}
    	}
    }
}
