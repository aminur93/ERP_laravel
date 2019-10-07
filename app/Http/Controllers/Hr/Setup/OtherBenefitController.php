<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\OtherBenefits;

use DB, Validator;

class OtherBenefitController extends Controller
{
    public function otherBenefit(){
    	$benefit_list= OtherBenefits::get();
    	return view('hr/setup/other_benefit_item', compact('benefit_list'));
    }
    public function otherBenefitStore(Request $request){
    	// dd($request->all());
    	$validator= Validator::make($request->all(),[
    		"benefit_name" => "max:128"
    	]);
    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with("error", "Invalid input!!");
    	}
    	else{
    		if($request->has('benefit_name')){
    			for($i=0; $i<sizeof($request->benefit_name); $i++){
    				OtherBenefits::insert([
    					"benefit_name" => $request->benefit_name[$i]
    				]);
    			}
    		}
    		return back()
    			->with("success", "Saved Successfully!!");
    	}
    }
    public function otherBenefitDelete($id){
    	OtherBenefits::where('id', $id)->delete();
    	return back()
    		->with('success', "Item Deleted Successfully!!");
    }
}
