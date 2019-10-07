<?php
namespace App\Helpers;
use DB;

class Attendance
{
	static public function track($associate = null, $as_id = null, $unit = null, $startDate = null, $endDate = null)
	{
		$attends   = 0;
		$leaves    = 0;
		$absents   = 0;
		$lates     = 0;
		$holidays  = 0; 
		$overtimes = 0; 
		$startDate = date("Y-m-d", strtotime($startDate));
		$endDate   = date("Y-m-d", strtotime($endDate));
		$totalDays = ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24))+1;


		if($unit==1 || $unit == 4 || $unit ==5 || $unit ==9){
    		$tableName= "hr_attendance_mbm AS a";
    	}
    	else if($unit==2){
    		$tableName= "hr_attendance_ceil AS a";
    	}
    	else if($unit==3){
    		$tableName= "hr_attendance_aql AS a";
    	}
    	else if($unit==8){
    		$tableName= "hr_attendance_cew AS a";
    	}
    	else{
    		$tableName= "hr_attendance AS a";
    	}
		#---------------------------------------------------------------
		//check for each date of each month
		for($i=0; $i<$totalDays; $i++)
		{
		    $today = date("Y-m-d", strtotime("$startDate +$i day")); 

		    // check leave 
		    $leaveCheck = DB::table("hr_leave")->where('leave_ass_id', $associate)
		        ->where(function ($q) use($today) {
		                $q->where('leave_from', '<=', $today);
		                $q->where('leave_to', '>=', $today);
		            }) 
		        ->exists();

		    if($leaveCheck)
		    {
		        $leaves++;
		    }
		    else
		    {
		        // if today is a holiday
		        $holidayCheck = DB::table("hr_yearly_holiday_planner")
		            ->where('hr_yhp_dates_of_holidays', $today)
		            ->where('hr_yhp_unit', $unit)
		            ->whereNotIn('hr_yhp_open_status', [1]);
 
		        if($holidayCheck->exists())
		        {
		        	$holidayData = $holidayCheck->first();
		            // check if open status = 0, then holiday
		            if ($holidayData->hr_yhp_open_status == "0")
		            {
		                $holidays++;
		            }
		            else if($holidayData->hr_yhp_open_status == "2") 
		            {
		            	

				        // check attendance 
				        $attendCheck = DB::table($tableName)
				            ->select(
				                "a.*",
				                "s.hr_shift_start_time",
				                "s.hr_shift_end_time",
				                "s.hr_shift_break_time" 
				            ) 
				            ->leftJoin("hr_shift AS s", function($join) {
				                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
				            }) 
				            ->where('a.as_id', $as_id)
				            ->whereDate('a.in_time', '=', $today); 

		                // check out time and exists then
		                // calculate OT = outtime - (sf_start+breack) 
		                if($attendCheck->exists())
		                {   
		                	$attends++;
		                	$attendanceData = $attendCheck->first();
		                    /*
		                    * attendance intime & outtime
		                    * if not empty outtime
		                    * -- then outtime = outtime
		                    * else if (outitme empty and intime > sf_start + 4 hours)
		                    * -- then outime=intime and calculate ot
		                    */
		                    $cIn = strtotime(date("H:i", strtotime($attendanceData->in_time)));
		                    $cOut = strtotime(date("H:i", strtotime($attendanceData->out_time)));
		                    $cShifStart = strtotime(date("H:i", strtotime($attendanceData->hr_shift_start_time)));
		                    $cBreak = $attendanceData->hr_shift_break_time*60;

		                    if (!empty($attendanceData->out_time))
		                    {
		                        $total_minutes = ($cOut - ($cShifStart+$cBreak))/60; 
		                        $minutes= ($total_minutes%60);
		                        $ot_minute = $total_minutes-$minutes;
		                        //round minutes
		                        if($minutes>=13 && $minutes<43) $minutes= 30;
		                        else if($minutes>=43) $minutes= 60;
		                        else $minutes= 0; 
		                        if($ot_minute>=0)
		                        $overtimes+=($ot_minute+$minutes); 
		                    }
		                    else if (empty($attendanceData->out_time) && ($cIn>($cShifStart+14399)) )
		                    {
		                        $total_minutes= ($cIn - ($cShifStart+$cBreak))/60;
		                        $minutes= ($total_minutes%60);
		                        $ot_minute = $total_minutes-$minutes;
		                        //round minutes
		                        if($minutes>=13 && $minutes<43) $minutes= 30;
		                        else if($minutes>=43) $minutes= 60;
		                        else $minutes= 0;  
		                        if($ot_minute>=0)
		                        $overtimes+=($ot_minute+$minutes); 
		                    } 
		                } 
		                else
		                {
		                	$absents++;
		                }
		            }
		        }
		        else
		        {
			        // check attendance 
			        $attendCheck = DB::table($tableName)
			            ->select(
			                "a.*",
			                "s.hr_shift_start_time",
			                "s.hr_shift_end_time",
			                "s.hr_shift_break_time" 
			            ) 
			            ->leftJoin("hr_shift AS s", function($join) {
			                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
			            }) 
			            ->where('a.as_id', $as_id)
			            ->whereDate('a.in_time', '=', $today); 


		            // calculate general time & att with overtime
		            if($attendCheck->exists())
		            { 
		                $attends++;
	                	$attendanceData = $attendCheck->first();
		                // -------------------------------------------------
		                $shift_start_time = $attendanceData->hr_shift_start_time;
		                $shift_end_time   = $attendanceData->hr_shift_end_time;
		                $shift_break_time = $attendanceData->hr_shift_break_time;
		                $punch_in         = $attendanceData->in_time;
		                $punch_out        = $attendanceData->out_time;
		                // ------------------------------------------------- 
		                $cIn = strtotime(date("H:i", strtotime($attendanceData->in_time)));
		                $cOut = strtotime(date("H:i", strtotime($attendanceData->out_time)));
		                $cShifStart = strtotime(date("H:i", strtotime($attendanceData->hr_shift_start_time)));
		                $cShifEnd = strtotime(date("H:i", strtotime($attendanceData->hr_shift_end_time)));
		                $cBreak = $attendanceData->hr_shift_break_time*60; 
		                //------------------------------------ 
		                // Calculate INTIME & OUTTIME

		                $ot_manual = DB::table("hr_ot")
		                    ->where("hr_ot_as_id",  $associate)
		                    ->whereDate('hr_ot_date', '=', $today) 
		                    ->value("hr_ot_hour"); 

		                if (!empty($ot_manual))
		                {
		                    $overtimes += ($ot_manual*60);  
		                } 
		                else
		                {
		                    if (empty($punch_out))
		                    {
		                        if ($cIn > ($cShifStart+$cBreak))
		                        {
		                            $cOut = $cIn;
		                        }
		                        else
		                        {
		                            $cOut = null;
		                        } 
		                    }
		                    else
		                    {
		                        if ($cOut < ($cShifEnd+$cBreak))
		                        {
		                            $cOut = null;
		                        }
		                    }

		                    // CALCULATE OVER TIME
		                    if(!empty($cOut))
		                    {
		                        $total_minutes = ($cOut - ($cShifEnd+$cBreak))/60;
		                        $minutes = ($total_minutes%60);
		                        $ot_minute = $total_minutes-$minutes;
		                        //round minutes
		                        if($minutes>=13 && $minutes<43) $minutes= 30;
		                        else if($minutes>=43) $minutes= 60;
		                        else $minutes= 0; 

		                        if($ot_minute>=0)
		                        $overtimes+=($ot_minute+$minutes); 
		                    }
		                }


		                // check shift time an in time
		                $late_time = ((strtotime(date('H:i:s',strtotime($punch_in))) - strtotime('TODAY')) - (strtotime(date('H:i:s', strtotime($shift_start_time))) - strtotime('TODAY')));

		                if($late_time > 180) // 3*60=180 seconds  
		                {
		                    $lates++;
		                } 
		                // -----------------------------
		            }
		            else
		            {
		                $management_holidays = DB::table("hr_yearly_holiday_planner")
										            ->where('hr_yhp_dates_of_holidays', $today)
										            ->where('hr_yhp_unit', $unit)
										            ->where('hr_yhp_open_status', 1)
										            ->first();

	                	$emp_type=DB::table('hr_as_basic_info')
	                		->where("associate_id", $associate)
	                		->pluck("as_emp_type_id")
	                		->first();

	                	if($emp_type == 1 && !empty($management_holidays) && $management_holidays->hr_yhp_open_status ==1){
	                		$holidays++;
	                	}
	                	else{
	                		$absents++;
	                	}
		            }
		        }
		    } 
		} 

		$h = floor($overtimes/60) ? ((floor($overtimes/60)<10)?("0".floor($overtimes/60)):floor($overtimes/60)) : '00';
		$m = $overtimes%60 ? (($overtimes%60<10)?("0".$overtimes%60):($overtimes%60)) : '00';

		return (object)array(
			'start_date' 	=> $startDate,
			'end_date'   	=> $endDate,
			'total_days' 	=> $totalDays,
			'associate' 	=> $associate,
			'unit'      	=> $unit,
			'attends'   	=> $attends,
			'leaves'    	=> $leaves,
			'absents'   	=> $absents,
			'lates'     	=> $lates,
			'holidays'  	=> $holidays, 
			'overtime_minutes' => $overtimes,
			'overtime_time'    => "$h:$m"
		);
	}

	static public function salaryAddDeduct($associate =null, $date=null){
		$value= [];
		if($associate !=null and $date!=null){

			$month 	= date("n", strtotime($date));
			$year 	= date("Y", strtotime($date));			
			$data 	= DB::table('hr_salary_add_deduct')
						->where('month', $month)
						->where('month', $month)
						->where('associate_id', $associate)
						->first();			
			if(!empty($data)){
				$value["add_deduct_id"]		= $data->id;
				$value["advp_deduct"]		= $data->advp_deduct;
				$value["cg_deduct"]			= $data->cg_deduct;
				$value["food_deduct"]		= $data->food_deduct;
				$value["others_deduct"]		= $data->others_deduct;
				$value["salary_add"]		= $data->salary_add;
				return $value;
			}
		}
		$value["add_deduct_id"]	= NULL;
		$value["advp_deduct"]	= 0;
		$value["cg_deduct"]		= 0;
		$value["food_deduct"]	= 0;
		$value["others_deduct"]	= 0;
		$value["salary_add"]	= 0;
		return $value;
	}
}