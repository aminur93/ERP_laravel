<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\AttendaceManual;
use App\Models\Hr\Attendace;
use App\Models\Hr\Shift;
use App\Models\Hr\Unit;
use App\Models\Hr\Employee;
use PDF, Validator, Auth, ACL, DB, DataTables;

class AttendaceBulkManualController extends Controller
{ 
    public function bulkManual(Request $request)
    { 
        return view("hr/timeattendance/attendance_bulk_manual");
    } 
    public function bulkManualStore(Request $request)
    { 
      // dd($request->attendance_id);
        $unit=$request->unit_att;

                    if($unit ==1 || $unit==4 || $unit==5 || $unit==9){
                        $tableName="hr_attendance_mbm";
                        $colName= "id";
                    }

                    else if($unit ==2){
                        $tableName="hr_attendance_ceil";
                        $colName= "id";
                    }

                    else if($unit ==3){
                        $colName= "att_id";
                        $tableName="hr_attendance_aql";
                    }

                    else if($unit ==6){
                        $tableName="hr_attendance_ho";
                        $colName= "id";
                    }

                    else if($unit ==8){
                        $tableName="hr_attendance_cew";
                        $colName= "id";
                    }
                    else{
                        $tableName="hr_attendance";
                        $colName= "att_id";
                    } 

           // dd($request->all());
            for($i=0; $i<sizeof($request->attendance_id); $i++)
            {
                if($request->att_status[$i]=="P"){ //dd($request->att_status[$i]);

                    if(($request->attendance_id[$i]==0)){
                      //get shift code from shift roaster/basic information table according to attandance date
                      $shift_code= null;
                      $shift_ass= $request->ass_id;
                      $shift_year= date('Y', strtotime($request->startday[$i]));
                      $shift_month= date('n', strtotime($request->startday[$i]));
                      $shift_day= "day_".date('j', strtotime($request->startday[$i]));
                      
                      //get shift code from shift roaster
                      $shift_code= DB::table('hr_shift_roaster')
                                        ->where('shift_roaster_year', $shift_year)
                                        ->where('shift_roaster_month', $shift_month)
                                        ->pluck($shift_day)
                                        ->first();
                      //if Shift code is null then get default shift code from basic information table

                      $shift_code= DB::table('hr_as_basic_info As b')
                                        ->where('b.as_id', $shift_ass)
                                        ->leftJoin('hr_shift AS s', 's.hr_shift_id', 'b.as_shift_id')
                                        ->pluck('s.hr_shift_code')
                                        ->first();

                      // Set intime and outtime
                      $intime[$i]=$request->startday[$i]." ".$request->intime[$i];
                      

                      if($request->outtime[$i]==""){$outime[$i]=null;}
                      else{$outime[$i]=$request->startday." ".$request->outtime[$i];}

                      // Insert attendance
                      DB::table($tableName)->insert([
                          'as_id' => $request->ass_id,
                          'hr_shift_code'=> $shift_code,
                          'in_time' =>$intime[$i],
                          'out_time'=>$outime[$i],
                          'remarks'=>'BM',
                          'updated_by' => auth()->user()->associate_id,
                          'updated_at' => NOW()
                          ]);
                    }

                    else {   
                        $intime[$i]=$request->startday[$i]." ".$request->intime[$i];
                         $outime[$i]=$request->startday[$i]." ".$request->outtime[$i];
                        //dd($intime);

                       DB::table($tableName)
                        ->where($colName, $request->attendance_id[$i])
                        ->update([
                          'in_time' =>$intime[$i],
                          'out_time'=>$outime[$i],
                          'remarks'=>'BM',
                          'updated_by' => auth()->user()->associate_id,
                          'updated_at' => NOW()
                         ]);   

                    }
               
                }

            }
            return back()
                    ->with('success', " Updated Successfully!!");   

    }           
}