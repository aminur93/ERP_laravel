<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use App\Models\Hr\Employee;
use App\Models\Hr\Attendace;
use App\Models\Hr\Section;
use App\Helpers\Attendance2;
use DB, PDF;

class DailyOTReportController extends Controller
{
    public function dailyOT(Request $request){
		$information = '';
		$unit_name = '';
		$report_date = '';
		$holidayCheck = '';
		$status = '';

    	$unitList= Unit::where('hr_unit_status',1)
                ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
                ->pluck('hr_unit_name', 'hr_unit_id');
        
    	if(!empty($request->unit_id))
    	{ 
    	    
    		$holiday= DB::table('hr_yearly_holiday_planner')
    							->where('hr_yhp_dates_of_holidays',$request->report_date)
    							->select([
    								'hr_yhp_open_status',
    								'hr_yhp_id'
    							])
    							->first();
    	    

	    	$status="";
	    	$holidayCheck=  null;
	    	if(!empty($holiday)){
	    		if($holiday->hr_yhp_open_status==1) $status= "Weekend(General)";
	    		else if($holiday->hr_yhp_open_status==2) $status= "Weekend(OT)";
	    		else $status="Weekend";
	    		$holidayCheck=  $holiday->hr_yhp_open_status;
	    	}
	    	
            

    		//getting unit name
    		$unit_name= Unit::where('hr_unit_id', $request->unit_id)->pluck('hr_unit_name')->first();
    		$report_date= date('d-M-Y', strtotime($request->report_date));
    		//get attendance list of Report Date
    		
    		$tableName= "hr_attendance";
    		if($request->unit_id == 1 || $request->unit_id == 4 || $request->unit_id ==5 || $request->unit_id ==9){
    		    $tableName= "hr_attendance_mbm";
    		}
    		else if($request->unit_id == 2){
    		    $tableName= "hr_attendance_ceil";
    		}
    		else if($request->unit_id == 3){
    		    $tableName= "hr_attendance_aql";
    		}
    		else if($request->unit_id == 6){
    		    $tableName= "hr_attendance_ho";
    		}
    		else if($request->unit_id == 8){
    		    $tableName= "hr_attendance_cew";
    		}
    		
    		$attend= DB::table($tableName)->whereDate('in_time', $request->report_date)
    							->get();
    	   
    		// Getting floor List of the Requested Unit
    		$floors= Floor::where('hr_floor_unit_id', $request->unit_id)
    						->where('hr_floor_status', 1)
    						->get();
    		




    		//$info is the object for all information to be returned
    		$info= array();
	    	if( empty($holiday) || (!empty($holiday) && ($holidayCheck==1 || $holidayCheck==2))){
    			
	    		//Count Sections of each Floor
	    		foreach($floors AS $floor){

	    			$sections= Employee::where('as_floor_id', $floor->hr_floor_id)
										->groupBy('as_section_id')
										->select([
											"as_section_id",
											's.hr_section_name'
										])
										->leftJoin('hr_section AS s', 'as_section_id', 's.hr_section_id')
										->where('as_ot', 1)
										->get();
	    			// for each section count number of ot hour
					$all_section= array();
					$total_att=0;
					$ot_0_total=0; $ot_1_total=0; $ot_2_total=0; $ot_3_total=0; $ot_4_total=0; $ot_5_total=0; $ot_6_total=0;
	    				$ot_7_total=0; $ot_8_total=0; $ot_9_total=0; $ot_10_total=0; $ot_11_total=0;
	    			foreach($sections AS $section){
	    				//getting employees of each section
	    				$sections_emps= Employee::where('as_section_id',$section->as_section_id)

	    									->where('as_status', 1)
	    									->where('as_floor_id', $floor->hr_floor_id)
	    									->select([
	    										'as_id',
	    										'associate_id'
	    									])
	    									->get();
	    				$sections_present_emps=0;
	    				$ot_0=0; $ot_1=0; $ot_2=0; $ot_3=0; $ot_4=0; $ot_5=0; $ot_6=0;
	    				$ot_7=0; $ot_8=0; $ot_9=0; $ot_10=0; $ot_11=0;

	    				foreach($sections_emps AS $sections_each_emp){
	    					foreach($attend AS $att){
	    						if($att->as_id == $sections_each_emp->as_id){
	    							//count number of person present of this section
	    							$sections_present_emps++;
	    							$startDay= date('Y-m-d', strtotime($att->in_time));
	    							//calculation of ot
	    							$ot_hour= Attendance2::trackOTSum($sections_each_emp->associate_id, $request->unit_id, $startDay,$startDay);

						            $ot_hour = round($ot_hour/60);
						            // OT calculation End
						            
						            if($ot_hour== 1) $ot_1++;
						            if($ot_hour== 2) $ot_2++;
						            if($ot_hour== 3) $ot_3++;
						            if($ot_hour== 4) $ot_4++;
						            if($ot_hour== 5) $ot_5++;
						            if($ot_hour== 6) $ot_6++;
						            if($ot_hour== 7) $ot_7++;
						            if($ot_hour== 8) $ot_8++;
						            if($ot_hour== 9) $ot_9++;
						            if($ot_hour== 11) $ot_10++;
						            if($ot_hour== 11) $ot_11++;
	    							break;
	    						}
	    					}
	    					// dd($sections_present_emps);
	    				}
	    				
	    				$sec_OBJ= (object)[];
	    					$sum= $ot_1+$ot_2+$ot_3+$ot_4+$ot_5+$ot_6+$ot_7+$ot_8+$ot_9+$ot_10+$ot_11;
	    					$ot_0=($sections_present_emps-$sum);
	    					$sec_OBJ->ot_0 = $ot_0;
	    					$sec_OBJ->ot_1 = $ot_1;
	    					$sec_OBJ->ot_2 = $ot_2;
	    					$sec_OBJ->ot_3 = $ot_3;
	    					$sec_OBJ->ot_4 = $ot_4;
	    					$sec_OBJ->ot_5 = $ot_5;
	    					$sec_OBJ->ot_6 = $ot_6;
	    					$sec_OBJ->ot_7 = $ot_7;
	    					$sec_OBJ->ot_8 = $ot_8;
	    					$sec_OBJ->ot_9 = $ot_9;
	    					$sec_OBJ->ot_10 = $ot_10;
	    					$sec_OBJ->ot_11 = $ot_11;
	    					$sec_OBJ->sections_present_emps = $sections_present_emps;
	    					$sec_OBJ->section_name= $section->hr_section_name;

	    					$ot_0_total+= $ot_0;
	    					$ot_1_total+= $ot_1;
							$ot_2_total+= $ot_2;
							$ot_3_total+= $ot_3;
							$ot_4_total+= $ot_4;
							$ot_5_total+= $ot_5;
							$ot_6_total+= $ot_6;
							$ot_7_total+= $ot_7;
							$ot_8_total+= $ot_8;
							$ot_9_total+= $ot_9;
							$ot_10_total+= $ot_10;
							$ot_11_total+= $ot_11;
							$total_att+=$sections_present_emps;
	    					// $info[]=array($sec_OBJ, $floor->hr_floor_name);
	    					$all_section[]=$sec_OBJ;
	    			}

	    			$info[]=array((object)$all_section, $floor->hr_floor_name,$ot_0_total,$ot_1_total,$ot_2_total,$ot_3_total,$ot_4_total,$ot_5_total,$ot_6_total,$ot_7_total,$ot_8_total,$ot_9_total,$ot_10_total,$ot_11_total, $total_att);
	    		}
    		}
    		$information = (object)$info; 



    		// Generate PDF
	        if ($request->get('pdf') == true) {    
	            $pdf = PDF::loadView('hr/reports/daily_ot_report_pdf', [
	            	'information' => $information,
	            	'unit_name'   => $unit_name,
	            	'report_date' => $report_date
				]);
	            return $pdf->download('Daily_Ot_Report_'.date('d_F_Y').'.pdf'); 
	        } 

    	}




    	return view('hr/reports/daily_ot_report', compact('unitList', 'information', 'unit_name', 'report_date', 'holidayCheck','status'));
    }

}
