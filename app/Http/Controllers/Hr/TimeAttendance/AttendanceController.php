<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Shift;
use App\Models\Hr\Employee;
use App\Models\Hr\Unit;
use App\Helpers\Attendance2;
use DataTables, DB, Auth, ACL;

class AttendanceController extends Controller
{
    public function dailyAttendance()
    { 
        ACL::check(["permission" => "hr_time_daily_att_list"]);
        #-----------------------------------------------------------# 
        return view('hr/timeattendance/daily_attendance_list');
    }

    public function getAttendanceData()
    {
        ACL::check(["permission" => "hr_time_daily_att_list"]);
        #-----------------------------------------------------------# 
        
        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table("hr_attendance AS a")
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                "b.associate_id", 
                "b.as_name",
                "b.as_emp_type_id",
                "f.hr_floor_name",
                "a.in_time",
                "a.out_time",
                "a.hr_shift_code"
            )
            ->join("hr_as_basic_info AS b", function($join){
                $join->on( "b.as_id", "=", "a.as_id");
                $join->where( "b.as_status", "=", "1");
            }) 
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->leftJoin("hr_floor AS f", "f.hr_floor_id", "=", "b.as_floor_id")
            ->get();
    
        return DataTables::of($data)
        ->addColumn('ot', function ($data) { 

            $out= date('H:i:s', strtotime($data->out_time));
            $shift_out= DB::table('hr_shift')
                        ->select('hr_shift_id', 'hr_shift_start_time', 'hr_shift_end_time')
                        ->where('hr_shift_code', "=", $data->hr_shift_code)
                        ->first();
            if($shift_out == null){
                $shift_out_time=0;
            } 
            else{
                $shift_out_time=$shift_out->hr_shift_end_time;
            }
            if(($data->as_emp_type_id == 3) && ($out > $shift_out_time) && $shift_out_time !=0){


                $hour= date('h', strtotime($out) - strtotime($shift_out_time));
                if(date('h',strtotime($out)) == date('h',strtotime($shift_out_time)))
                    $hour=0;
                $minute= date('i', strtotime($out) - strtotime($shift_out_time));

                if($hour ==0 && $minute==0)
                    $ot="";
                else
                $ot= $hour." h ". $minute. " m";
            }
            else {
                $ot="" ;
            }
            return $ot;
            })  
            ->rawColumns(['serial_no', 'ot'])
            ->toJson();
    }

    public function attendanceReport()
    {
        ACL::check(["permission" => "hr_time_daily_att_list"]);
        #-----------------------------------------------------------# 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id'); 

        return view('hr/timeattendance/attendance_report', compact('unitList'));
    }

    public function attendanceReportData(Request $request){ 
        
        
        ACL::check(["permission" => "hr_time_daily_att_list"]);
        #-----------------------------------------------------------#  
        $associate_id = $request->associate_id; 
        $report_from  = $request->report_from;
        $report_to    = $request->report_to; 
        $unit         = $request->unit; 
        
        
        $tableName="";
        //CEIL
        if($unit == 2){
           $tableName= "hr_attendance_ceil AS a";
        }
        //AQl
        else if($unit == 3){
            $tableName= "hr_attendance_aql AS a";
        }
            
        else if($unit == 1 || $unit == 4 || $unit == 5 || $unit == 9){
            $tableName= "hr_attendance_mbm AS a";
        }
        //HO
        else if($unit == 6){
            $tableName= "hr_attendance_ho AS a";
        }
        
        else if($unit == 8){
            $tableName= "hr_attendance_cew AS a";
        }
        
        else{
            $tableName= "hr_attendance AS a";
        }
        
        
        $data = DB::table($tableName)
                ->select(
                    "b.associate_id", 
                    "b.as_unit_id", 
                    "b.as_name",
                    "b.as_emp_type_id",
                    "a.in_time",
                    "a.out_time",
                    "a.hr_shift_code",
                    "s.hr_shift_break_time",
                    "s.hr_shift_name",
                    "u.hr_unit_name",
                    "b.as_ot"
                )
                ->where(function($query) use ($associate_id, $report_from, $report_to) {
                   if (!empty($associate_id))
                   {
                        $query->where('b.associate_id', '=', $associate_id);
                    }  
          
                    $query->where('a.in_time', '>=', $report_from." 00:00:00");
                    $query->where('a.in_time', '<=', $report_to." 23:59:59");  
                }) 
                ->join("hr_as_basic_info AS b", function($join){
                    $join->on( "b.as_id", "=", "a.as_id");
                    $join->where( "b.as_status", "=", "1");
                })
                //->where('b.as_ot', 1)
                ->leftJoin("hr_unit AS u", "u.hr_unit_id", "=", "b.as_unit_id")
                ->leftJoin("hr_shift AS s", "a.hr_shift_code", "=", "s.hr_shift_code")
                ->orderBy('a.in_time')
                ->get();
         
            $data= $data->where('as_unit_id', $unit);
            
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('att_date', function ($data) {  
                if ($data->in_time)
                {
                    return date('Y-M-d', strtotime($data->in_time));
                } 
            })
            ->addColumn('in_punch', function ($data) { 
                if ($data->in_time)
                {
                    return date('H:i:s', strtotime($data->in_time));
                } 
            })
            ->addColumn('out_punch', function ($data) { 
                if ($data->out_time)
                {
                    return date('H:i:s', strtotime($data->out_time));
                } 
            })
            ->addColumn('ot', function ($data) use ($unit) { 
                    if($data->as_ot==1){
                        $startDay= date('Y-m-d', strtotime($data->in_time));
                        $result= Attendance2::track($data->associate_id, $unit, $startDay, $startDay);
                        return $result->overtime_time;
                    }
                    else{
                        return null;
                    }
                   
            })
            ->rawColumns(['ot', 'in_punch', 'out_punch', 'att_date'])
            ->toJson(); 
    }


    public function attendanceSummary(Request $request)
    { 
        // Working hour
        $associate_id = $request->associate_id; 
        $report_from  = $request->report_from;
        $report_to    = $request->report_to;
        $unit         = $request->unit;

        $data = DB::table("hr_attendance AS a")
            ->select(
                "b.associate_id", 
                "a.in_time",
                "a.out_time",
                "a.hr_shift_code",
                "s.hr_shift_break_time",
                "s.hr_shift_start_time",
                "s.hr_shift_end_time"
            )
            ->where(function($query) use ($associate_id, $report_from, $report_to) {
                if (!empty($associate_id))
                {
                    $query->where('b.associate_id', '=', $associate_id);
                } 

                if (!empty($report_from) && !empty($report_to))
                {
                    $query->whereBetween('a.in_time', [$report_from." 00:00:00", $report_to." 23:59:59"]);
                } 
            }) 
            ->join("hr_as_basic_info AS b", function($join){
                $join->on( "b.as_id", "=", "a.as_id");
                $join->where( "b.as_status", "=", "1");
            }) 
            ->where('b.as_unit_id', $unit)
            ->leftJoin("hr_floor AS f", "f.hr_floor_id", "=", "b.as_floor_id")
            ->leftJoin("hr_shift AS s", "a.hr_shift_code", "=", "s.hr_shift_code")
            ->get(); 
            $total_ot=0;

        foreach($data AS $associate)
        {
            $startDay= date('Y-m-d', strtotime($associate->in_time));
            $ot= Attendance2::trackOTSum($associate->associate_id, $unit, $startDay, $startDay);
            $total_ot+=$ot;
        }

        $result= floor($total_ot/60)."h:".((($total_ot%60)>0)? (($total_ot%60))."m":"00m");
        return $result;
    }
  

}
