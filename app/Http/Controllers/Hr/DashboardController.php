<?php

namespace App\Http\Controllers\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Employee;
use App\Models\Hr\AdvaneInfo;
use App\Models\Hr\Ot;
use App\Models\Hr\Unit;
use App\Models\Hr\Attendace;
use App\Models\Hr\AttendaceManual;
use App\Models\Hr\Leave;
use App\User;
use App\Helpers\Attendance2;
use DB, ACL,stdClass; 

class DashboardController extends Controller
{
    public function dashboard()
    {  
        
      if (auth()->user()->hasAnyRole('hr_associate|hr_medical'))
      {
        $obj = $this->dashboard2();
        $loans   = $obj['loans'];
        $leaves  = $obj['leaves'];
        $attendances = $obj['attendances'];
        $records = $obj['records']; 

        return view('hr.dashboard2', compact(
            'loans', 
            'leaves', 
            'attendances', 
            'records'  
        ));

      }
      else
      {
        // $pieChart    = $this->pieChart();
        $dounoughtChart     = $this->dounoughtChartMaker();
        $lineChartData          = $this->lineChartMaker();
        $reportCount        = $this->reportCount();
        // $ot                 = $this->otHistory();
        $unitWiseEmpSummary = $this->unitWiseEmployeeSummary();

        return view('hr.dashboard', compact('reportCount','dounoughtChart', 'unitWiseEmpSummary', 'lineChartData'));
      }
    }
    private function lineChartMaker(){
        
        $lineChartData= (object)array(); //Objcet with LineChart Data
        $lineChartData->colors= $this->lineCharColorPicker(); // Selecting graph color
        $lineChartData->day_names = $this->getDayNames();   //Get Day Names for Line chart (15 days)
        
        //Numbers of the units user has permissions of
        $unit_permissions= Auth()->user()->unit_permissions(); 

        //making js code for Line Chart
        $dataset_string="";
        $color_indecator=0;

        foreach($unit_permissions AS $unit_p){
            $ot= (object)[];
            //get unit Name
            $unit_name =Unit::where('hr_unit_id', $unit_p)->pluck('hr_unit_name')->first();
            $ot->unit_name = $unit_name;
            $str="";
            $str="{label: \"".$unit_name."\", data: [";
            //Overtime calculation of that unit
            for($dy=15; $dy>=1; $dy--){
                $ot_date= date("Y-m-d",strtotime("-$dy days"));
                $over_time= $this->OverTimeCalculationForLineChart($unit_p, $ot_date);
                $ot->unit_ot[]= $over_time;
                $str.= $over_time;
                if($dy>1) $str.=",";
            }
            $str.=$lineChartData->colors[$color_indecator++];
            $dataset_string.=$str;


            $lineChartData->dataset_string= $dataset_string;
            $lineChartData->ot_history[] = $ot;
        }
        return $lineChartData;
    }
    private function lineCharColorPicker(){
        $colopickerStrings= array();
        $colopickerStrings[0]= "], backgroundColor: ['rgba(105, 0, 132, .2)',],
                                                            borderColor: [
                                                                'rgba(200, 99, 132, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[1]= "], backgroundColor: ['rgba(0, 137, 132, .2)',],
                                                            borderColor: [
                                                                'rgba(0, 10, 130, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[2]= "], backgroundColor: ['rgba(181, 188, 36, .2)',],
                                                            borderColor: [
                                                                'rgba(181, 188, 150, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[3]= "], backgroundColor: ['rgba(229, 56, 56, .2)',],
                                                            borderColor: [
                                                                'rgba(197, 56, 237, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[4]= "], backgroundColor: ['rgba(40, 53, 147, .2)',],
                                                            borderColor: [
                                                                'rgba(40, 119, 244, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[5]= "], backgroundColor: ['rgba(39, 212, 12, .2)',],
                                                            borderColor: [
                                                                'rgba(39, 212, 137, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[6]= "], backgroundColor: ['rgba(39, 0, 137, .2)',],
                                                            borderColor: [
                                                                'rgba(39, 0, 56, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[7]= "], backgroundColor: ['rgba(55, 0, 200, .2)',],
                                                            borderColor: [
                                                                'rgba(132, 99, 200, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[8]= "], backgroundColor: ['rgba(132, 0, 105, .2)',],
                                                            borderColor: [
                                                                'rgba(99, 132, 200, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[9]= "], backgroundColor: ['rgba(155, 0, 111, .2)',],
                                                            borderColor: [
                                                                'rgba(100, 222, 32, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[10]= "], backgroundColor: ['rgba(155, 0, 111, .2)',],
                                                            borderColor: [
                                                                'rgba(100, 222, 32, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[11]= "], backgroundColor: ['rgba(155, 0, 111, .2)',],
                                                            borderColor: [
                                                                'rgba(100, 222, 32, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[12]= "], backgroundColor: ['rgba(155, 0, 111, .2)',],
                                                            borderColor: [
                                                                'rgba(100, 222, 32, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[13]= "], backgroundColor: ['rgba(155, 0, 111, .2)',],
                                                            borderColor: [
                                                                'rgba(100, 222, 32, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        $colopickerStrings[14]= "], backgroundColor: ['rgba(155, 0, 111, .2)',],
                                                            borderColor: [
                                                                'rgba(100, 222, 32, .7)',
                                                            ],
                                                            borderWidth: 2
                                                        },";
        return $colopickerStrings;
    }
    private function getDayNames(){
        $day_names="";
        for($d=15; $d>=1; $d--){
            $dates= date("dM",strtotime("-$d days"));
            $day_names.= "\"".$dates."\"";
            if($d>1) $day_names.= ",";
        }
        return $day_names;
    }


  /*
  |--------------------------------------------------------------------
  | DASHBOARD 2
  |--------------------------------------------------------------------
  */

  public function dashboard2()
  {
     $associate_id =auth()->user()->associate_id; 
        $loans = DB::table("hr_loan_application")
            ->select(
            "*",
            DB::raw("
                CASE 
                    WHEN hr_la_status = '0' THEN 'Applied' 
                    WHEN hr_la_status = '1' THEN 'Approved' 
                    WHEN hr_la_status = '2' THEN 'Declined' 
                END AS hr_la_status
            ")
        )
        ->where("hr_la_as_id", $associate_id)
        ->get(); 

        $leaves = DB::table('hr_leave')
            ->select(
                DB::raw(" 
                    SUM(CASE WHEN leave_type = 'Casual' THEN DATEDIFF(leave_to, leave_from)+1 END) AS casual,
                    SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS earned,
                    SUM(CASE WHEN leave_type = 'Sick' THEN DATEDIFF(leave_to, leave_from)+1 END) AS sick,
                    SUM(CASE WHEN leave_type = 'Maternity' THEN DATEDIFF(leave_to, leave_from)+1 END) AS maternity,
                    SUM(DATEDIFF(leave_to, leave_from)+1) AS total
                ")
            )
            ->where('leave_status', '1')
            ->where("leave_ass_id", $associate_id)
            ->where('leave_updated_at', "<=", "2050-01-01")
            ->where('leave_updated_at', ">=", "2017-12-31")
            ->get(); 
  
        $attendances = DB::table("hr_attendance AS a")
            ->select( 
                "b.as_emp_type_id",
                "f.hr_floor_name",
                DB::raw("DATE_FORMAT(a.in_time, '%Y-%m-%d') AS date"),
                DB::raw("DATE_FORMAT(a.in_time, '%h:%i %p') AS start"),
                DB::raw("DATE_FORMAT(a.out_time, '%h:%i %p') AS end"),
                "a.in_time",
                "a.out_time",
                "a.hr_shift_code"
            )
            ->where('b.associate_id', $associate_id)
            ->whereYear('a.in_time', date("Y"))
            ->whereMonth('a.in_time', date("m"))
            ->leftJoin("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
            ->leftJoin("hr_floor AS f", "f.hr_floor_id", "=", "b.as_floor_id")
            ->orderBy("a.in_time", "ASC")
            ->get();  
 
        $records = DB::table('hr_dis_rec AS r')
            ->select(
                'r.*', 
                DB::raw("CONCAT_WS(' to ', r.dis_re_doe_from, r.dis_re_doe_to) AS date_of_execution"), 
                'i.hr_griv_issue_name', 
                's.hr_griv_steps_name' 
            )
            ->leftJoin('hr_grievance_issue AS i', 'i.hr_griv_issue_id', '=', 'r.dis_re_issue_id')
            ->leftJoin('hr_grievance_steps AS s', 's.hr_griv_steps_id', '=', 'r.dis_re_issue_id')
            ->where('r.dis_re_offender_id', $associate_id)
            ->get();
            // dd($loans, $leaves, $attendances, $records);
        
        return [
            'loans'   => $loans,
            'leaves'  => $leaves,
            'attendances' => $attendances,
            'records' => $records
        ];
  }

  /*
  |--------------------------------------------------------------------
  | OT
  |--------------------------------------------------------------------
  */
    public function otHistory(){
        //Units For Ot Calculation
        $units= DB::table('hr_unit')
                  ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
                  ->select('hr_unit_name', 'hr_unit_id')
                  ->get();
        //final ot array to return for showing in Dashboard        
        $ot = array();

        foreach( $units as $unit ){
          $time= $this->otCount($unit, null);
          $hours=0;
          $minutes=0;
          $hours= floor($time/60);
          $minutes= $time-($hours*60);
          $ot[] = array(
            "hour" => $hours,
            "minute" => $minutes,
            "unit" => $unit->hr_unit_name
          );
        }
        return $ot;
    }

    //Calculation of overtime Summary
    private function OverTimeCalculationForLineChart($unit, $ot_date){
        
        
        
        
        // $exists_ot= DB::table('hr_ot_dashboard')
        //             ->where('unit_id', $unit)
        //             ->whereDate('ot_date', $ot_date)
        //             ->get([
        //                 'ot_hour',
        //                 'ot_date'
        //             ])
        //             ->first();
        
        // if(!empty($exists_ot)){
        //         return $exists_ot->ot_hour;
        //     }
        // else{
            
            $ot_hour=0;  
            $tableName="";
            if($unit ==1 || $unit == 4 || $unit ==5 || $unit ==9){
                $tableName= "hr_attendance_mbm AS a";
            } 
            else if($unit ==2){
                $tableName= "hr_attendance_ceil AS a";
            } 
            else if($unit ==3){
                $tableName= "hr_attendance_aql AS a";
            } 
            else if($unit ==6){
                $tableName= "hr_attendance_ho AS a";
            }
            else if($unit ==8){
                $tableName= "hr_attendance_cew AS a";
            }
            else return 0;
            $attendances = DB::table($tableName)
                        ->select(
                            "a.as_id",
                            "a.hr_shift_code",
                            "a.in_time",
                            "a.out_time",
                            "s.hr_shift_start_time",
                            "s.hr_shift_end_time",
                            "s.hr_shift_break_time",
                            "b.as_unit_id", 
                            "b.associate_id" 
                        )
                        ->join("hr_as_basic_info AS b", function($join) use ($unit) {
                            $join->on("b.as_id", "=", "a.as_id")
                                ->where("b.as_unit_id", "=", $unit);
                        }) 
                        ->leftJoin("hr_shift AS s", function($join) {
                            $join->on("s.hr_shift_code", "=", "a.hr_shift_code");
                        })
                        ->whereDate('in_time', '=', date("Y-m-d", strtotime($ot_date)))
                        ->where('out_time', '>=', strtotime("+s.hr_shift_break_time s.hr_shift_end_time"))
                        ->get(); 
             
                
            foreach($attendances AS $att){
                    $status  = null;
                    $leave   = null;
                    $present = null;
                    $intime  = null;
                    $outtime = null;
                    $overtime = null;
                    $punch_in  = $att->in_time;
                    $punch_out = $att->out_time;
                    $shift_start = $att->hr_shift_start_time;
                    $shift_end   = $att->hr_shift_end_time;
                    $shift_break = $att->hr_shift_break_time;
                    if($shift_start== null){
                        $shift_start= "08:00:00";
                    }
                    if($shift_end== null){
                        $shift_end= "17:00:00";
                    }
                    if($shift_break== null){
                        $shift_break= "60";
                    }
                    //---------------------------------------------
                    //TIME CALCULATION
                    //---------------------------------------------
                    $punch_intime  = date("H:i", strtotime($punch_in));
                    $punch_intime  = strtotime($punch_intime)/60;
                    $punch_outtime = date("H:i", strtotime($punch_out));
                    $punch_outtime = strtotime($punch_outtime)/60;
                    $shift_intime  = date("H:i", strtotime($shift_start));
                    $shift_intime = (strtotime($shift_intime)/60) + 239.983; // 03:59:59 = 239.983 minutes;
                    //---------------------------------------------
                    // INTIME
                    if($punch_intime <= $shift_intime){
                        $intime = date("H:i", strtotime($punch_in));
                    } 
                    //---------------------------------------------
                    // OUTTIME 
                    if($punch_outtime > $shift_intime){
                        $outtime = date("H:i", strtotime($punch_out));
                    }
                    //---------------------------------------------
                    // OVER TIME
                    $workhour = ((strtotime($punch_out) - strtotime($punch_in))/60);
                    $shifthour =  ((strtotime($shift_end) - strtotime($shift_start))/60) 
                        + $shift_break; // shift break time
                    $othour = ($workhour-$shifthour);
                        //MANUAL OT
                    $ot_manual = DB::table("hr_ot")
                                    ->where("hr_ot_as_id",  $att->associate_id)
                                    ->whereDate('hr_ot_date', '=', date("Y-m-d", strtotime($ot_date))) 
                                    ->value("hr_ot_hour");

                    if(!empty($ot_manual)){
                        $overtime = date('H:i', mktime(0, ($ot_manual*60)));
                        $ot_hour +=  ($ot_manual*60); 
                    } 
                    else if(!empty($intime) && !empty($outtime) && $othour > 0){
                        $othour_time = gmdate('H:i:s', $othour * 60);
                        $extra = 0;
                        $minutes = date('i', strtotime($othour_time));

                        if ($minutes < 13 && $minutes >= 0)
                        {
                            $extra = 0-$minutes;
                        } 
                        else if ($minutes >= 13 && $minutes < 30)
                        {
                            $extra = 30-$minutes;
                        } 
                        else if ($minutes < 43 && $minutes > 30)
                        {
                            $extra = 30-$minutes;
                        }
                        else if ($minutes >= 43 && $minutes < 60)
                        {
                            $extra = 60-$minutes;
                        } 

                        $overtime = date('H:i', strtotime("$extra minutes", strtotime($othour_time))); 
                        //OVERTIME SUMMATION
                        if ($overtime)
                        {
                            $otime = explode(':', $overtime);
                            $ot_hour +=  ($otime[0]*60)+($otime[1]); 
                        }   
                    }
                }
                

            DB::table('hr_ot_dashboard')
                ->insert([
                    'unit_id' => $unit,
                    'ot_date' => $ot_date,
                    'ot_hour' =>$ot_hour/60
                ]);
                
            return $ot_hour/60;
       //  }
        
    }


	/*
	|--------------------------------------------------------------------
	| REPORT
	|--------------------------------------------------------------------
	*/
    public function reportCount(){
    	# Count Total, Male & Female Employee
    	$data['employee'] = Employee::select(
                DB::raw("
                  COUNT(CASE WHEN as_gender = 'Male' THEN as_id END) AS males,
                  COUNT(CASE WHEN as_gender = 'Female' THEN as_id END) AS females,
                  COUNT(CASE WHEN as_ot = '0' THEN as_id END) AS non_ot,
                  COUNT(CASE WHEN as_ot = '1' THEN as_id END) AS ot,
                  COUNT(CASE WHEN as_status != '1' THEN as_id END) AS inactive,
                  COUNT(CASE WHEN as_status = '1' THEN as_id END) AS active,
                  COUNT(CASE WHEN as_doj = CURDATE() THEN as_id END) AS todays_join,
                  COUNT(*) AS total
                ")
            )
            ->whereIn('as_unit_id', auth()->user()->unit_permissions())
    		->first();  

    	return (object)$data;
    }


    /*
  |--------------------------------------------------------------------
  | Unit Wise Employee Summary
  |--------------------------------------------------------------------
  */
  public function unitWiseEmployeeSummary(){
      $units=Unit::select('hr_unit_id', 'hr_unit_name')
                ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
                ->get();
      // dd($units);
      // $data = new stdClass();
      $data = (object)[];
      foreach($units AS $unit){
        $total= Employee::where('as_unit_id', $unit->hr_unit_id)
                ->select(
                  DB::raw('COUNT("as_id") AS num')
                )
                ->where('as_status',1) // checking status
                ->first();
        $male= Employee::where('as_unit_id', $unit->hr_unit_id)
        ->where('as_gender', "Male")
                ->select(
                  DB::raw('COUNT("as_id") AS num')
                )
                ->where('as_status',1) // checking status
                ->first();
        $female= Employee::where('as_unit_id', $unit->hr_unit_id)
        ->where('as_gender', "Female")
                ->select(
                  DB::raw('COUNT("as_id") AS num')
                )
                ->where('as_status',1) // checking status
                ->first();
        $thirdGender= Employee::where('as_unit_id', $unit->hr_unit_id)
        ->where('as_gender', "Third Gender")
                ->select(
                  DB::raw('COUNT("as_id") AS num')
                )
                ->where('as_status',1) // checking status
                ->first();
          $unit->male   = $male->num;
          $unit->female = $female->num;
          $unit->total = $total->num;
      }
      return $units;
      
  }
  private function dounoughtChartMaker(){
    $unit_permissions= Auth()->user()->unit_permissions();
    $dounoughtCharts= (object)array();
    foreach($unit_permissions AS $eachUnit){
       $dounoughtCharts->chart[]= $this->chartData($eachUnit);
    }
    return $dounoughtCharts;
  }
    /*
  |--------------------------------------------------------------------
  | PIE CHART - Attendance & Leave
  |--------------------------------------------------------------------
  */
  private function chartData($unit)
  {
    $today = date("Y-m-d");
    $totalPresent = 0;
    $casualLeave  = 0;
    $earnedLeave  = 0;
    $sickLeave    = 0;
    $maternityLeave = 0;
    $totalLeave   = 0;
    $totalUser    = 0;
    $totalAbsent  = 0;
    /*----------------Attendance------------------*/
    if($unit == 1 || $unit == 4 || $unit == 5  || $unit == 9){
        
        // MBM, MBW, MFW, SRT
        $totalPresent  = DB::table('hr_attendance_mbm AS a')
                        ->select(
                                DB::raw("DISTINCT(a.as_id)"),
                                "a.hr_shift_code"
                              )
                        ->whereDate('a.in_time', $today)
                        ->leftJoin('hr_as_basic_info AS b', 'b.as_id', 'a.as_id')
                        ->where('b.as_unit_id', $unit)
                        ->get()
                        ->count(); 
    }
    else if($unit == 2){
        
        // Cutting edge industries Ltd (CEIL)
        $totalPresent  = DB::table('hr_attendance_ceil AS a')
                        ->select(
                                DB::raw("DISTINCT(a.as_id)"),
                                "a.hr_shift_code"
                              )
                        ->whereDate('a.in_time', $today)
                        ->leftJoin('hr_as_basic_info AS b', 'b.as_id', 'a.as_id')
                        ->where('b.as_unit_id', $unit)
                        ->get()
                        ->count(); 
    }
    else if($unit == 3){
        
        //Absolute quality limited
        $totalPresent  = DB::table('hr_attendance_aql AS a')
                        ->select(
                                DB::raw("DISTINCT(a.as_id)"),
                                "a.hr_shift_code"
                              )
                        ->whereDate('a.in_time', $today)
                        ->leftJoin('hr_as_basic_info AS b', 'b.as_id', 'a.as_id')
                        ->where('b.as_unit_id', $unit)
                        ->get()
                        ->count(); 
    }
    else if($unit == 6){
        $totalPresent  = DB::table('hr_attendance_ho AS a')
                        ->select(
                                DB::raw("DISTINCT(a.as_id)"),
                                "a.hr_shift_code"
                              )
                        ->whereDate('a.in_time', $today)
                        ->leftJoin('hr_as_basic_info AS b', 'b.as_id', 'a.as_id')
                        ->where('b.as_unit_id', $unit)
                        ->get()
                        ->count(); 
    }
    else if($unit == 8){
        //cutting edge wash
        $totalPresent  = DB::table('hr_attendance_cew AS a')
                        ->select(
                                DB::raw("DISTINCT(a.as_id)"),
                                "a.hr_shift_code"
                              )
                        ->whereDate('a.in_time', $today)
                        ->leftJoin('hr_as_basic_info AS b', 'b.as_id', 'a.as_id')
                        ->where('b.as_unit_id', $unit)
                        ->get()
                        ->count(); 
    }
    else{
        
        //default attendance table
        $totalPresent  = DB::table('hr_attendance AS a')
                        ->select(
                                DB::raw("DISTINCT(a.as_id)"),
                                "a.hr_shift_code"
                              )
                        ->whereDate('a.in_time', $today)
                        ->leftJoin('hr_as_basic_info AS b', 'b.as_id', 'a.as_id')
                        ->where('b.as_unit_id', $unit)
                        ->get()
                        ->count(); 
    }
    /*----------------Leave------------------*/
    $leave = DB::table('hr_leave AS l')
                ->select(
                    DB::raw("
                      COUNT(CASE WHEN l.leave_type = 'Casual' THEN id END) AS casual,
                      COUNT(CASE WHEN l.leave_type = 'Earned' THEN id END) AS earned,
                      COUNT(CASE WHEN l.leave_type = 'Sick' THEN id END) AS sick,
                      COUNT(CASE WHEN l.leave_type = 'Maternity' THEN id END) AS maternity,
                      COUNT(*) AS total
                    ")
                )
                ->where('l.leave_from', '<=', $today)
                ->where('l.leave_to',   '>=', $today)
                ->where('l.leave_status', '=', 1)
                ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', 'l.leave_ass_id')
                ->where('b.as_unit_id', $unit)
                ->first(); 
    $casualLeave = $leave->casual; 
    $earnedLeave = $leave->earned; 
    $sickLeave   = $leave->sick; 
    $maternityLeave = $leave->maternity; 
    $totalLeave  = $leave->total;  
    /*----------------Absent------------------*/
    $totalUser = Employee::where("as_status", 1)->where('as_unit_id', $unit)->count();

    $totalAbsent = ($totalUser-($totalPresent+$totalLeave));
    $unit_name= Unit::where('hr_unit_id', $unit)->pluck('hr_unit_name')->first();
    return (object)[
      'total'   => $totalUser,
      'present' => $totalPresent,
      'absent'  => $totalAbsent,
      'leave'   => $totalLeave,
      'casual'  => $casualLeave,
      'sick'    => $sickLeave,
      'earned'  => $earnedLeave,
      'maternity'  => $maternityLeave,
      'unit'    => $unit_name 
    ];
  }
}
