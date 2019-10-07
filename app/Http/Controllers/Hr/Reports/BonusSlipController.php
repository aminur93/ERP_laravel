<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Department;
use App\Models\Hr\Employee;
use App\Models\Hr\Floor;
use App\Models\Hr\Unit;
use DB, PDF;

class BonusSlipController extends Controller
{
    public function showForm(Request $request){

    	$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
    	$deptList= Department::pluck('hr_department_name', 'hr_department_id');

    	if(!empty($request)){

    		//request with all field 
    		if(!empty($request->unit_id) && !empty($request->floor_id) && !empty($request->festive_name) && !empty($request->year) && !empty($request->department_id) && !empty($request->last_join_date)){

    			$info= DB::table('hr_as_basic_info AS b')
    					->where('b.as_unit_id', $request->unit_id)
    					->where('b.as_floor_id', $request->floor_id)
    					->where('b.as_department_id', $request->department_id)
    					->where('b.as_doj', "<=", $request->last_join_date)
    					->where('b.as_status', 1)
    					->select([
    						'b.associate_id',
    						'b.as_doj',
    						'b.as_name',
    						'b.temp_id',
    						'empb.hr_bn_associate_name',
    						'd.hr_designation_name_bn'
    					])
    					->leftJoin('hr_employee_bengali AS empb', 'empb.hr_bn_associate_id', 'b.associate_id')
    					->leftJoin('hr_designation AS d', 'd.hr_designation_id', 'b.as_designation_id')
                        ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
    					->get();
    			
    		}
    		else{

    			$info= DB::table('hr_as_basic_info AS b')
    					->where('b.as_unit_id', $request->unit_id)
    					->where('b.as_floor_id', $request->floor_id)
    					->where('b.as_doj', "<=", date('Y-m-d',strtotime($request->last_join_date)))
    					->where('b.as_status', 1)
    					->select([
    						'b.associate_id',
    						'b.as_doj',
                            'b.as_name',
    						'b.temp_id',
    						'empb.hr_bn_associate_name',
                            'd.hr_designation_name_bn'
    					])
    					->leftJoin('hr_employee_bengali AS empb', 'empb.hr_bn_associate_id', 'b.associate_id')
                        ->leftJoin('hr_designation AS d', 'd.hr_designation_id', 'b.as_designation_id')
                        ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
    					->get();
    			// dd($info);
    		}
            
    		if(!empty($info)){
    			$todayDate= date('d-m-Y');
    			$sl=1;
    			foreach($info AS $emp){
    				$emp->sl = $sl;
    				$sl++;
    				$jobDuration=0;
    				$basic=0;
    				$salary=0;
    				$bonus=0;
    				$jobDurationRatio=0;
    				


    				$from= date('d-m-Y', strtotime($emp->as_doj));
    				$to= date('d-m-Y', strtotime($todayDate));

    				$fromDay= date('d', strtotime($from));
    				$toDay= date('d', strtotime($to));

    				$fromMonth= date('m',strtotime($from));
    				$toMonth= date('m',strtotime($to));

    				$fromYear= date('Y', strtotime($from));
    				$toYear= date('Y', strtotime($to));
    				//only month difference between ctoday's date and joining date
    				$jobDuration= (($toYear-$fromYear)*12)+($toMonth-$fromMonth);
    				//exact month duration calculating according to days 
    				if($toDay>$fromDay) $jobDuration++;

    				

    				//-- Calculating bonus according salary
    				
    				$ben_salary= DB::table('hr_benefits')
    									->where('ben_as_id', $emp->associate_id)
    									->where('ben_status', 1)
    									->orderBy('ben_id', 'DESC')
    									->select([
    										'ben_basic',
    										'ben_current_salary'
    									])
    									->first();
    				if(!empty($ben_salary)){
    					$salary= $ben_salary->ben_current_salary;
    					$basic= round($ben_salary->ben_basic,2);
    				}
    				else{
    					$salary=0;
    					$basic=0;
    				}
    				//calculation bonus according job duration
    				if($jobDuration>=12){
    					$bonus= $basic;
    				}
    				else{
    					$bonus= round((($basic/12)*$jobDuration),2);
    				}
    				//jobduation /12 ration
    				if($jobDuration>=12){
    					$jobDurationRatio=null;
    				}
    				else{
    					$jobDurationRatio=  $jobDuration."/12";
    				}

    				$status_check= DB::table('hr_leave')
    								->where('leave_ass_id', $emp->associate_id)
    								->where('leave_type', "Maternity")
    								->where('leave_status', 1)
    								->where('leave_from', '<=', $todayDate)
    								->where('leave_to', ">=", $todayDate)
    								->exists();
    				if($status_check){
    					$status= "M";
    				}
    				else{
    					$status= "A";
    				}


    				
    				$emp->jobDuration = $jobDuration;
    				$emp->basic = $basic;
    				$emp->salary = $salary;
    				$emp->bonus = $bonus;
    				$emp->jobDurationRatio = $jobDurationRatio;
    				$emp->status = $status;

    				
    			}
    		}
    		//unit, floor, department, lastjoin date, festival name
    		$unit_name= Unit::where('hr_unit_id', $request->unit_id)
    						->pluck('hr_unit_name_bn')
    						->first();
    		$floor_name= Floor::where('hr_floor_id', $request->floor_id)
    						->pluck('hr_floor_name_bn')
    						->first();
    		if(!empty($request->department_id)){

    			$department_name= Department::where('hr_department_id', $request->department_id)
    							->pluck('hr_department_name_bn')
    							->first();
    		}
    		else{
    			$department_name=null;
    		}
    		$last_join_date= $request->last_join_date;

    		if($request->festive_name == 1){
    			$festive_name= "ঈদ-উল-ফিতর-".$request->year;
    		}
    		else{
    			$festive_name= "ঈদ-উল-আযহা-".$request->year;
    		}
    		$other_info= (object)[];
    		$other_info->unit_name = $unit_name;
    		$other_info->floor_name = $floor_name;
    		$other_info->department_name = $department_name;
    		$other_info->last_join_date = $last_join_date;
    		$other_info->festive_name = $festive_name;

            $floorList= DB::table('hr_floor')
                            ->where('hr_floor_unit_id', $request->unit_id)
                            ->pluck('hr_floor_name', 'hr_floor_id');
    	}


        if ($request->get('pdf') == true) { ;
            $pdf = PDF::loadView('hr/reports/bonus_slip_pdf', [
                'other_info' => $other_info,
                'info' => $info,
            ]);
            return $pdf->download('Bonus_Slip_Report_'.date('d_F_Y').'.pdf');
        }


    	return view('hr/reports/bonus_slip', compact('unitList', 'deptList', 'info','other_info', 'floorList'));
    }



    //get floor list by unit
    public function floorByUnit(Request $request){
    	$floorlist= Floor::where('hr_floor_unit_id', $request->unit)
    					->select([
    						'hr_floor_name', 
    						'hr_floor_id'
    					])
    					->get();

    	$data= '<option value="">Select Floor</option>';
    	if($floorlist){
	    	foreach ($floorlist as $floor) {
	    		$data.='<option value="'.$floor->hr_floor_id.'">'.$floor->hr_floor_name.'</option>';
	    	}
    	}
    	else{
    		$data= '<option value="">No Floor found</option>';
    	}
    	return $data;
    }
}
