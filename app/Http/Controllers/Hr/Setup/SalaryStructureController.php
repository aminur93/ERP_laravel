<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\SalaryStructure;
use App\Models\Hr\Benefits;
use Validator, Auth,ACL,DB;

class SalaryStructureController extends Controller
{
    public function showForm(){
    	ACL::check(["permission" => "hr_setup"]);

        #-----------------------------------------------------------#
    	$current_structure= DB::table('hr_salary_structure')->where('status',1)->select(['hr_salary_structure.*'])->get();
    	// dd($current_structure->all());
    	return view('hr/setup/salary_structure',compact('current_structure'));
    }
    public function save(Request $request){
    	ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------#
    	$validator= Validator::make($request->all(), [
    		'basic' => 'required|max:10',
    		'medical' => 'required|max:10',
    		'transport' => 'required|max:10',
    		'food' => 'required|max:10'
    	]);
    	$user= Auth::user()->associate_id;

    	if($validator->fails())
    	{
    		return back()
    			->withErrors($validator)
    			->withInput();
    	}
    	else
    	{
    		SalaryStructure::where('status',1)->update([ "status" => 0]);

    		$newStructure= new SalaryStructure();
    		$newStructure->basic = $request->basic ;
    		$newStructure->medical = $request->medical ;
    		$newStructure->transport = $request->transport ;
    		$newStructure->food = $request->food ;
    		$newStructure->updated_by = $user ;
    		$newStructure->status = 1;
          $salaryStructure = $newStructure->save();
          //dd($salaryStructure);exit;
    		if($salaryStructure){
          $hrBenifits = Benefits::get();
          //dd($hrBenifits);exit;

          $this->updateBenifts($hrBenifits,$request);


    			return back()
    			->with('success', "Salary Structure Updated Successfully!!");
    		}
    		else{
    			return back()
    			->withInput()
    			->with('error', "Something wrong!");
    		}
    	}
    }

    private function updateBenifts($hrBenifits,$request){

      foreach ($hrBenifits as $hrBenifit) {
        // Basic = {(Gross – Medical+Transport+Food) / Basic Value}
        // House Rent = {Gross – (Medical+Transport+Food) – Basic}
          $basic = ($hrBenifit->ben_current_salary -($request->medical+$request->transport+$request->food))/$request->basic;
          $houseRent = ($hrBenifit->ben_current_salary -($request->medical+$request->transport+$request->food))- $basic;

          Benefits::where('ben_id', '=', $hrBenifit->ben_id)->update(
            ['ben_basic' => $basic,
            'ben_house_rent'=>$houseRent,
            'ben_medical'=>$request->medical,
            'ben_transport'=>$request->transport,
            'ben_food'=>$request->food]
            );
      }

    }
}
