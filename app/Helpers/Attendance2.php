<?php
namespace App\Helpers;
use DB;

class Attendance2
{
	static public function track($associate = null, $unit = null, $startDate = null, $endDate = null)
	{
		
		$attends   = false;
		$leaves    = false;
		$absents   = false;
		$lates     = false;
		$holidays  = -1; 
		$holiday_comment= "";
		$overtimes = 0; 
		$output_out= null;
		$output_in = null; 
		$leave_type=null;
		$startDate = date("Y-m-d", strtotime($startDate));
		$endDate   = date("Y-m-d", strtotime($endDate));
		$totalDays = ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24))+1;
		#---------------------------------------------------------------
		
		    $today = $startDate; 

		    // check leave 
		    $leaveCheck = DB::table("hr_leave")->where('leave_ass_id', $associate)
		        ->where(function ($q) use($today) {
		                $q->where('leave_from', '<=', $today);
		                $q->where('leave_to', '>=', $today);
		            });



		    if($leaveCheck->exists())
		    {
		    	$leaveCheck= $leaveCheck->first();

		        $leaves=true;

		        $leave_type= $leaveCheck->leave_type;
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
		        	$holidayCheckData = $holidayCheck->first();
		            // check if open status = 0, then holiday
		            if ($holidayCheckData->hr_yhp_open_status == "0")
		            {
		                $holidays= 0;
		                $holiday_comment= $holidayCheckData->hr_yhp_comments;

		            }
		            else if($holidayCheckData->hr_yhp_open_status == "2") 
		            {
		                $holidays=2;

				        // check attendance 
				        $attendCheck = DB::table("hr_attendance AS a")
				            ->select(
				                "a.*",
				                "s.hr_shift_start_time",
				                "s.hr_shift_end_time",
				                "s.hr_shift_break_time" 
				            )
				            ->join("hr_as_basic_info AS b", function($join) {
				                $join->on("b.as_id", "=", "a.as_id");
				            }) 
				            ->leftJoin("hr_shift AS s", function($join) {
				                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
				            }) 
				            ->where('b.associate_id', $associate)
				            ->whereDate('a.in_time', '=', $today); 

				        $attendCheckData = $attendCheck->first();

		                // check out time and exists then
		                // calculate OT = outtime - (sf_start+breack) 
		                if($attendCheck->exists())
		                {   
		                    /*
		                    * attendance intime & outtime
		                    * if not empty outtime
		                    * -- then outtime = outtime
		                    * else if (outitme empty and intime > sf_start + 4 hours)
		                    * -- then outime=intime and calculate ot
		                    */
		                    $output_in= $attendCheckData->in_time;
		                    $output_out= $attendCheckData->out_time;
		                    $cIn = strtotime(date("H:i", strtotime($attendCheckData->in_time)));
		                    
		                    $cOut = strtotime(date("H:i", strtotime($attendCheckData->out_time)));
		                    $cShifStart = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_start_time)));
		                    $cBreak = $attendCheckData->hr_shift_break_time*60;

		                    if (!empty($attendCheckData->out_time))
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
		                    else if (empty($attendCheckData->out_time) && ($cIn>($cShifStart+14399)) )
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
		            }
		        }
		        else
		        {

		        	//Check  holiday(general) only for showing in report 
			        $generalHolidayCheck = DB::table("hr_yearly_holiday_planner")
			            ->where('hr_yhp_dates_of_holidays', $today)
			            ->where('hr_yhp_unit', $unit)
			            ->where('hr_yhp_open_status', 1)
			            ->exists();
			         if($generalHolidayCheck) {
			         	$holidays = 1; 
			         }

			        $tableName="";

					if($unit ==1 || $unit==4 || $unit==5 || $unit==9){
					    $tableName="hr_attendance_mbm AS a";
					}

					else if($unit ==2){
					    $tableName="hr_attendance_ceil AS a";
					}

					else if($unit ==3){
					    $tableName="hr_attendance_aql AS a";
					}

					else if($unit ==6){
					    $tableName="hr_attendance_ho AS a";
					}

					else if($unit ==8){
					    $tableName="hr_attendance_cew AS a";
					}
					else{
					    $tableName="hr_attendance AS a";
					} 
			        // check attendance 
			        $attendCheck = DB::table($tableName)
			            ->select(
			                "a.*",
			                "s.hr_shift_start_time",
			                "s.hr_shift_end_time",
			                "s.hr_shift_break_time",
			                "b.as_ot" 
			            )
			            ->join("hr_as_basic_info AS b", function($join) {
			                $join->on("b.as_id", "=", "a.as_id");
			            }) 
			            ->leftJoin("hr_shift AS s", function($join) {
			                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
			            }) 
			            ->where('b.associate_id', $associate)
			            ->whereDate('a.in_time', '=', $today); 
			            
			        $attendCheckData = $attendCheck->first();



		            // calculate general time & att with overtime
		            if($attendCheck->exists())
		            { 
		                $attends=true;
		                // -------------------------------------------------
		                $shift_start_time = $attendCheckData->hr_shift_start_time;
		                $shift_end_time   = $attendCheckData->hr_shift_end_time;
		                $shift_break_time = $attendCheckData->hr_shift_break_time;
		                $punch_in         = $attendCheckData->in_time;
		                $punch_out        = $attendCheckData->out_time;
		                $output_in= $attendCheckData->in_time;
		                $output_out= $attendCheckData->out_time;
		                // ------------------------------------------------- 
		                $cIn = strtotime(date("H:i", strtotime($attendCheckData->in_time)));
		                $cOut = strtotime(date("H:i", strtotime($attendCheckData->out_time)));
		                $cShifStart = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_start_time)));
		                $cShifEnd = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_end_time)));
		                $cBreak = $attendCheckData->hr_shift_break_time*60; 
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
		                        if ($cOut < $cShifEnd+$cBreak)
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
		                    $lates=true;
		                } 
		                // -----------------------------
		            }
		            else
		            {
		                $absents== true;
		            }
		        }
		
			} 
			$h = floor($overtimes/60) ? ((floor($overtimes/60)<10)?("0".floor($overtimes/60)):floor($overtimes/60)) : '00';
			$m = $overtimes%60 ? (($overtimes%60<10)?("0".$overtimes%60):($overtimes%60)) : '00';


		// 	if(date("j", strtotime($startDate))==7)
		// dd($leaves);

		return (object)array(
			'start_date' => $startDate,
			'end_date'   => $endDate,
			'total_days' => $totalDays,
			'associate' => $associate,
			'unit'      => $unit,
			'attends'   => $attends,
			'leaves'    => $leaves,
			'leave_type'    => $leave_type,
			'absents'   => $absents,
			'lates'     => $lates,
			'holidays'  => $holidays, 
			'holiday_comment'  => $holiday_comment, 
			'in_time'  => (!empty($output_in))?date("H:i:s", strtotime($output_in)):null, 
			'out_time'  => (!empty($output_out))?date("H:i:s", strtotime($output_out)):null, 
			'overtime_minutes' => $overtimes,
			'overtime_time'    => (($overtimes>0)?"$h:$m":"")
		);
	
	}

 // Call From Attendance Bulk Manual for id return	
   static public function track2($associate = null, $unit = null, $startDate = null, $endDate = null)
	{
		
		$attends   = false;
		$leaves    = false;
		$absents   = false;
		$lates     = false;
		$holidays  = -1; 
		$holiday_comment= "";
		$overtimes = 0; 
		$output_out= null;
		$output_in = null; 
		$leave_type=null;
		$startDate = date("Y-m-d", strtotime($startDate));
		$endDate   = date("Y-m-d", strtotime($endDate));
		$totalDays = ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24))+1;
		$atid=null;
		#----------------- define table name-------------------------------------
		
		$tableName="";

					if($unit ==1 || $unit==4 || $unit==5 || $unit==9){
					    $tableName="hr_attendance_mbm AS a";
					    $colName= "a.id as attid";
					}

					else if($unit ==2){
					    $tableName="hr_attendance_ceil AS a";
					    $colName= "a.id as attid";
					}

					else if($unit ==3){
						$colName= "a.att_id as attid";
					    $tableName="hr_attendance_aql AS a";
					}

					else if($unit ==6){
					    $tableName="hr_attendance_ho AS a";
					    $colName= "a.id as attid";
					}

					else if($unit ==8){
					    $tableName="hr_attendance_cew AS a";
					    $colName= "a.id as attid";
					}
					else{
					    $tableName="hr_attendance AS a";
					    $colName= "a.att_id as attid";
					} 
	    #-----------------------------------------------------
		    $today = $startDate; 

		    // check leave 
		    $leaveCheck = DB::table("hr_leave")->where('leave_ass_id', $associate)
		        ->where(function ($q) use($today) {
		                $q->where('leave_from', '<=', $today);
		                $q->where('leave_to', '>=', $today);
		            });



		    if($leaveCheck->exists())
		    {
		    	$leaveCheck= $leaveCheck->first();

		        $leaves=true;

		        $leave_type= $leaveCheck->leave_type;
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
		        	$holidayCheckData = $holidayCheck->first();
		            // check if open status = 0, then holiday
		            if ($holidayCheckData->hr_yhp_open_status == "0")
		            {
		                $holidays= 0;
		                $holiday_comment= $holidayCheckData->hr_yhp_comments;

		            }
		            else if($holidayCheckData->hr_yhp_open_status == "2") 
		            {
		                $holidays=2;

				        // check attendance 
				        $attendCheck = DB::table($tableName)
				            ->select(
				                "a.*",
				                $colName,
				                "s.hr_shift_start_time",
				                "s.hr_shift_end_time",
				                "s.hr_shift_break_time" 
				            )
				            ->join("hr_as_basic_info AS b", function($join) {
				                $join->on("b.as_id", "=", "a.as_id");
				            }) 
				            ->leftJoin("hr_shift AS s", function($join) {
				                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
				            }) 
				            ->where('b.associate_id', $associate)
				            ->whereDate('a.in_time', '=', $today); 

				        $attendCheckData = $attendCheck->first();

		                // check out time and exists then
		                // calculate OT = outtime - (sf_start+breack) 
		                if($attendCheck->exists())
		                {   
		                    /*
		                    * attendance intime & outtime
		                    * if not empty outtime
		                    * -- then outtime = outtime
		                    * else if (outitme empty and intime > sf_start + 4 hours)
		                    * -- then outime=intime and calculate ot
		                    */
		                    $output_in= $attendCheckData->in_time;
		                    $output_out= $attendCheckData->out_time;
		                    $cIn = strtotime(date("H:i", strtotime($attendCheckData->in_time)));
		                    
		                    $cOut = strtotime(date("H:i", strtotime($attendCheckData->out_time)));
		                    $cShifStart = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_start_time)));
		                    $cBreak = $attendCheckData->hr_shift_break_time*60;
		                    $atid =$attendCheckData->attid;

		                    if (!empty($attendCheckData->out_time))
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
		                    else if (empty($attendCheckData->out_time) && ($cIn>($cShifStart+14399)) )
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
		            }
		        }
		        else
		        {

		        	//Check  holiday(general) only for showing in report 
			        $generalHolidayCheck = DB::table("hr_yearly_holiday_planner")
			            ->where('hr_yhp_dates_of_holidays', $today)
			            ->where('hr_yhp_unit', $unit)
			            ->where('hr_yhp_open_status', 1)
			            ->exists();
			         if($generalHolidayCheck) {
			         	$holidays = 1; 
			         }

			        
			        // check attendance 
			        $attendCheck = DB::table($tableName)
			            ->select(
			                "a.*",
			                $colName,
			                "s.hr_shift_start_time",
			                "s.hr_shift_end_time",
			                "s.hr_shift_break_time",
			                "b.as_ot" 
			            )
			            ->join("hr_as_basic_info AS b", function($join) {
			                $join->on("b.as_id", "=", "a.as_id");
			            }) 
			            ->leftJoin("hr_shift AS s", function($join) {
			                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
			            }) 
			            ->where('b.associate_id', $associate)
			            ->whereDate('a.in_time', '=', $today); 
			            
			        $attendCheckData = $attendCheck->first();

		            // calculate general time & att with overtime
		            if($attendCheck->exists())
		            { 
		                $attends=true;
		                // -------------------------------------------------
		                $shift_start_time = $attendCheckData->hr_shift_start_time;
		                $shift_end_time   = $attendCheckData->hr_shift_end_time;
		                $shift_break_time = $attendCheckData->hr_shift_break_time;
		                $punch_in         = $attendCheckData->in_time;
		                $punch_out        = $attendCheckData->out_time;
		                $output_in= $attendCheckData->in_time;
		                $output_out= $attendCheckData->out_time;
		                $atid = $attendCheckData->attid;
		                // ------------------------------------------------- 
		                $cIn = strtotime(date("H:i", strtotime($attendCheckData->in_time)));
		                $cOut = strtotime(date("H:i", strtotime($attendCheckData->out_time)));
		                $cShifStart = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_start_time)));
		                $cShifEnd = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_end_time)));
		                $cBreak = $attendCheckData->hr_shift_break_time*60; 
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
		                        if ($cOut < $cShifEnd+$cBreak)
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
		                    $lates=true;
		                } 
		                // -----------------------------
		            }
		            else
		            {
		                $absents== true;
		            }
		        }
		
			} 
			$h = floor($overtimes/60) ? ((floor($overtimes/60)<10)?("0".floor($overtimes/60)):floor($overtimes/60)) : '00';
			$m = $overtimes%60 ? (($overtimes%60<10)?("0".$overtimes%60):($overtimes%60)) : '00';


		// 	if(date("j", strtotime($startDate))==7)
		// dd($leaves);

if($atid==null) $atid=0;
		return (object)array(
			'attendance_id' => $atid,
			'start_date'=> $startDate,
			'end_date'  => $endDate,
			'total_days'=> $totalDays,
			'associate' => $associate,
			'unit'      => $unit,
			'attends'   => $attends,
			'leaves'    => $leaves,
			'leave_type'=> $leave_type,
			'absents'   => $absents,
			'lates'     => $lates,
			'holidays'  => $holidays, 
			'holiday_comment'  => $holiday_comment, 
			'in_time'  => (!empty($output_in))?date("H:i:s", strtotime($output_in)):null, 
			'out_time'  => (!empty($output_out))?date("H:i:s", strtotime($output_out)):null, 
			'overtime_minutes' => $overtimes,
			'overtime_time'    => (($overtimes>0)?"$h:$m":"")
		);
	
	}



	static public function trackOTSum($associate = null, $unit = null, $startDate = null, $endDate = null)
	{
		$overtimes = 0; 
		$startDate = date("Y-m-d", strtotime($startDate));
		$endDate   = date("Y-m-d", strtotime($endDate));
		#---------------------------------------------------------------
		
	    $today = $startDate; 
        // if today is a holiday
        $holidayCheck = DB::table("hr_yearly_holiday_planner")
            ->where('hr_yhp_dates_of_holidays', $today)
            ->where('hr_yhp_unit', $unit)
            ->whereNotIn('hr_yhp_open_status', [1]);  


        if($holidayCheck->exists())
        {
        	$holidayCheckData = $holidayCheck->first();

            if($holidayCheckData->hr_yhp_open_status == "2") 
            {
		        // check attendance 
		        $attendCheck = DB::table("hr_attendance AS a")
		            ->select(
		                "a.*",
		                "s.hr_shift_start_time",
		                "s.hr_shift_end_time",
		                "s.hr_shift_break_time" 
		            )
		            ->join("hr_as_basic_info AS b", function($join) {
		                $join->on("b.as_id", "=", "a.as_id");
		            }) 
		            ->leftJoin("hr_shift AS s", function($join) {
		                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
		            }) 
		            ->where('b.associate_id', $associate)
		            ->whereDate('a.in_time', '=', $today); 

		        $attendCheckData = $attendCheck->first();
                
                // check out time and exists then
                // calculate OT = outtime - (sf_start+breack) 
                if($attendCheck->exists())
                {   
                    /*
                    * attendance intime & outtime
                    * if not empty outtime
                    * -- then outtime = outtime
                    * else if (outitme empty and intime > sf_start + 4 hours)
                    * -- then outime=intime and calculate ot
                    */
                    $output_in= $attendCheckData->in_time;
                    $output_out= $attendCheckData->out_time;
                    $cIn = strtotime(date("H:i", strtotime($attendCheckData->in_time)));
                    
                    $cOut = strtotime(date("H:i", strtotime($attendCheckData->out_time)));
                    $cShifStart = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_start_time)));
                    $cBreak = $attendCheckData->hr_shift_break_time*60;

                    if (!empty($attendCheckData->out_time))
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
                    else if (empty($attendCheckData->out_time) && ($cIn>($cShifStart+14399)) )
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
            }
        }
        else
        {
	        // check attendance 
	        $attendCheck = DB::table("hr_attendance AS a")
	            ->select(
	                "a.*",
	                "s.hr_shift_start_time",
	                "s.hr_shift_end_time",
	                "s.hr_shift_break_time" 
	            )
	            ->join("hr_as_basic_info AS b", function($join) {
	                $join->on("b.as_id", "=", "a.as_id");
	            }) 
	            ->leftJoin("hr_shift AS s", function($join) {
	                $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
	            }) 
	            ->where('b.associate_id', $associate)
	            ->whereDate('a.in_time', '=', $today); 

		        $attendCheckData = $attendCheck->first();

            // calculate general time & att with overtime
            if($attendCheck->exists())
            {  
                // -------------------------------------------------
                $shift_start_time = $attendCheckData->hr_shift_start_time;
                $shift_end_time   = $attendCheckData->hr_shift_end_time;
                $shift_break_time = $attendCheckData->hr_shift_break_time;
                $punch_in         = $attendCheckData->in_time;
                $punch_out        = $attendCheckData->out_time;
                $output_in= $attendCheckData->in_time;
                $output_out= $attendCheckData->out_time;
                // ------------------------------------------------- 
                $cIn = strtotime(date("H:i", strtotime($attendCheckData->in_time)));
                $cOut = strtotime(date("H:i", strtotime($attendCheckData->out_time)));
                $cShifStart = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_start_time)));
                $cShifEnd = strtotime(date("H:i", strtotime($attendCheckData->hr_shift_end_time)));
                $cBreak = $attendCheckData->hr_shift_break_time*60; 
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
                        if ($cOut < $cShifEnd+$cBreak)
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
                // -----------------------------
            }
        } 
		$h = floor($overtimes/60) ? ((floor($overtimes/60)<10)?("0".floor($overtimes/60)):floor($overtimes/60)) : '00';
		$m = $overtimes%60 ? (($overtimes%60<10)?("0".$overtimes%60):($overtimes%60)) : '00';

		return  $overtimes;
	}
}