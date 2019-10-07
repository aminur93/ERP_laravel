<?php

namespace App\Http\Controllers\Hr\Performance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Appraisal;
use App\Models\Hr\Benefits;
use Validator, ACL;

class AppraisalController extends Controller
{
    public function showForm()
    {
        ACL::check(["permission" => "hr_performance_appraisal"]);
        #-----------------------------------------------------------# 

    	$joining_salaray_list = Benefits::where('ben_status', '1')
    		->pluck('ben_as_id','ben_joining_salary')->first();
    	return view('hr/performance/appraisal', compact('joining_salaray_list'));
    }

    public function saveData(Request $request)
    {
        ACL::check(["permission" => "hr_performance_appraisal"]);
        #-----------------------------------------------------------# 
        
    	$validator = Validator::make($request->all(), [
    		"hr_pa_as_id"       => "required|max:10|min:10",
    		"hr_pa_report_from" => "required|date",
    		"hr_pa_report_to"   => "required|date",
    		"hr_pa_punctuality" => "required|max:1", 
			"hr_pa_punctuality" => "required|max:1",
			"hr_pa_reasoning"   => "required|max:1",
			"hr_pa_job_acceptance"   => "required|max:1",
			"hr_pa_owner_sense"      => "required|max:1",
			"hr_pa_rw_sense"         => "required|max:1",
			"hr_pa_idea_thought"     => "required|max:1",
			"hr_pa_coleague_interaction" => "required|max:1",
			"hr_pa_meet_kpi"         => "required|max:1",
			"hr_pa_communication"    => "required|max:1",
			"hr_pa_cause_analysis"   => "required|max:1",
			"hr_pa_professionality"  => "required|max:1",
			"hr_pa_target_set"       => "required|max:1",
			"hr_pa_job_interest"     => "required|max:1",
			"hr_pa_out_perform"      => "required|max:1",
			"hr_pa_team_work"        => "required|max:1",
			"hr_pa_primary_assesment" => "required|max:1",
			"hr_pa_first_attribute"  => "max:255",
			"hr_pa_second_attribute" => "max:255",
			"hr_pa_third_attribute"  => "max:255",
			"hr_pa_long_retention"   => "required|max:1",
			"hr_pa_promotion_recommendation"   => "required|max:1",
			"hr_pa_replacement"       => "required|max:1",
			"hr_pa_remarks_dept_head" => "max:255",
			"hr_pa_remarks_hr_head"   => "max:255",
			"hr_pa_remarks_incharge"  => "max:255",
			"hr_pa_remarks_ceo"       => "max:255",
    	]);


    	if ($validator->fails())
    	{
    		return back()
    			->withInput()
    			->withErrors($validator)
    			->with("error", "Please fillup all required fields!");
    	}
    	else
    	{ 
    		$store = new Appraisal;

			$store->hr_pa_as_id          = $request->hr_pa_as_id;
			$store->hr_pa_report_from    = $request->hr_pa_report_from;
			$store->hr_pa_report_to      = $request->hr_pa_report_to;
			$store->hr_pa_punctuality    = $request->hr_pa_punctuality;
			$store->hr_pa_reasoning      = $request->hr_pa_reasoning;
			$store->hr_pa_job_acceptance = $request->hr_pa_job_acceptance;
			$store->hr_pa_owner_sense    = $request->hr_pa_owner_sense;
			$store->hr_pa_rw_sense       = $request->hr_pa_rw_sense;
			$store->hr_pa_idea_thought   = $request->hr_pa_idea_thought;
			$store->hr_pa_coleague_interaction = $request->hr_pa_coleague_interaction;
			$store->hr_pa_meet_kpi       = $request->hr_pa_meet_kpi;
			$store->hr_pa_communication  = $request->hr_pa_communication;
			$store->hr_pa_cause_analysis = $request->hr_pa_cause_analysis;
			$store->hr_pa_professionality = $request->hr_pa_professionality;
			$store->hr_pa_target_set     = $request->hr_pa_target_set;
			$store->hr_pa_job_interest   = $request->hr_pa_job_interest;
			$store->hr_pa_out_perform    = $request->hr_pa_out_perform;
			$store->hr_pa_team_work      = $request->hr_pa_team_work;
			$store->hr_pa_primary_assesment = $request->hr_pa_primary_assesment;
			$store->hr_pa_first_attribute   = $request->hr_pa_first_attribute; 
			$store->hr_pa_second_attribute  = $request->hr_pa_second_attribute; 
			$store->hr_pa_third_attribute   = $request->hr_pa_third_attribute; 
			$store->hr_pa_long_retention    = $request->hr_pa_long_retention;
			$store->hr_pa_promotion_recommendation = $request->hr_pa_promotion_recommendation;
			$store->hr_pa_replacement       = $request->hr_pa_replacement;
			$store->hr_pa_remarks_dept_head = $request->hr_pa_remarks_dept_head;
			$store->hr_pa_remarks_hr_head   = $request->hr_pa_remarks_hr_head;
			$store->hr_pa_remarks_incharge  = $request->hr_pa_remarks_incharge;
			$store->hr_pa_remarks_ceo       = $request->hr_pa_remarks_ceo;

    		if ($store->save())
    		{
	    		return back()
	    			->with("success", "Save successful.");

    		}
    		else
    		{
	    		return back()
	    			->withInput()
	    			->withErrors($validator)
	    			->with("error", "Please try again.");
    		}

    	}  
    }



}
