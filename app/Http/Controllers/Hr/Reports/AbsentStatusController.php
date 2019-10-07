<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\YearlyHolyDay;
use App\Models\Hr\Attendace;
use App\Models\Hr\Employee;
use App\Models\Hr\Leave;
use App\Models\Hr\Shift;
use DB, ACL, PDF;

class AbsentStatusController extends Controller
{
    public function showForm(Request $request)
    {
		$report ='';
        
    	if($request->has('associate_id')){
    		$report = (object)[];
    		$unit= Employee::where('associate_id', $request->associate_id)
				->select([
				    'as_unit_id',
					'hr_unit_name',
					'as_name', 
					'as_doj', 
					'hr_designation_name'
				])
				->leftJoin('hr_unit', 'hr_unit_id', 'as_unit_id')
				->leftJoin('hr_designation', 'hr_designation_id', 'as_designation_id')
				->first();

			if($unit){ 
				$report->unit= $unit->hr_unit_name;
				$report->name= $unit->as_name;
				$report->doj= $unit->as_doj;
				$report->designation= $unit->hr_designation_name;
				$report->from= $request->absent_from;
				$report->to= $request->absent_to;
				$report->associate_id= $request->associate_id;
				$report->print_date= date('d-M-Y');
				$unit_id = $unit->as_unit_id;
 			}
            
            
            $tableName= "hr_attendance";
            
            if($unit_id == 1 || $unit_id == 4 || $unit_id == 5 || $unit_id == 9){
                $tableName= "hr_attendance_mbm";
            }
            else if($unit_id == 2){
                $tableName= "hr_attendance_ceil";
            }
            else if($unit_id == 3){
                $tableName= "hr_attendance_aql";
            }
            else if($unit_id == 6){
                $tableName= "hr_attendance_ho";
            }
            else if($unit_id == 9){
                $tableName= "hr_attendance_cew";
            }
            

			$year1 = date('Y', strtotime($request->absent_from));
			$year2 = date('Y', strtotime($request->absent_to));

			$month1 = date('m', strtotime($request->absent_from));
			$month2 = date('m', strtotime($request->absent_to));
			$diff = (($year2 - $year1) * 12) + ($month2 - $month1)+1;
			$associate_id_pk= Employee::where('associate_id', $request->associate_id)
									->pluck('as_id')
									->first();
	    	$month=$month1;
	    	$year= $year1;
	    	$j=0;
	    	//check for each month
	    	for($j=0; $j<$diff; $j++){

	    		if($month>12){
	    			$month=1;
	    			$year++;
	    		}
	    		$start_date = "01-".$month."-".$year;
				$start_time = strtotime($start_date);
				$end_time = strtotime("+1 month", $start_time);
				$leaves=0;
				$absents=0;
				$late=0;


				//check for each date of each month
				for($i=$start_time; $i<$end_time; $i+=86400)
				{
				  	$today= date('Y-m-d', $i);
				   //if today is a holiday
				  	$hoiday=YearlyHolyDay::where('hr_yhp_dates_of_holidays', $today)
				  							->exists();
					if(!$hoiday){
						$exist= Leave::where('leave_ass_id', $request->associate_id)
					   		->where(function ($q) use($today) {
                                    $q->where('leave_from', '<=', $today);
                                    $q->where('leave_to', '>=', $today);
                                }) 
					   		->exists();
					   if($exist){
					   		$leaves+=1;
					   	}
					   	else{
					   		$attend= DB::table($tableName)->where('as_id', $associate_id_pk)
					   							->whereDate('in_time', '=', $today)
					   							->exists();
					   		if($attend){
						   		$attend= DB::table($tableName)->where('as_id', $associate_id_pk)
						   							->whereDate('in_time', '=', $today)
						   							->first();
						   		$shift_start_time= Shift::where('hr_shift_code', $attend->hr_shift_code)
						   					->pluck('hr_shift_start_time')
						   					->first();
						   		$shift_start_time= date('H:i:s', strtotime($shift_start_time));		
						   		$in_time= date('H:i:s',strtotime($attend->in_time));
						   		$shift_start_time = strtotime($shift_start_time) - strtotime('TODAY');
						   		$in_time = strtotime($in_time) - strtotime('TODAY');
						   		$late_time= $in_time-$shift_start_time;
						   		if($late_time>120)
						   			$late+=1;
					   		}
					   		else{
					   			$absents+=1;
					   		}
					   	}
				   }
				}
				$monthName = date("F", mktime(0, 0, 0, $month, 10));

				$report->month[]= $monthName; 
				$report->year[]= $year; 
				$report->absent[]= $absents; 
				$report->leave[]= $leaves; 
				$report->late[]= $late;
				$month++;
	    	}

	        if ($request->get('pdf') == true) {     
	            $pdf = PDF::loadView('hr/reports/absent_status_pdf', [
	            	'report' => $report
	            ]);
	            return $pdf->download('Absent_Status'.date('d_F_Y').'.pdf'); 
	        } 
    	} 
    	return view('hr/reports/absent_status', compact('report'));

    }
}
