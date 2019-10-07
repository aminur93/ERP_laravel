<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\AttendaceManual;
use App\Models\Hr\Attendace;
use App\Models\Hr\Shift;
use App\Models\Hr\Unit;
use App\Models\Hr\Employee;
use App\Models\Hr\Floor;
use App\Models\Hr\Line;
use App\Helpers\Attendance2;
use PDF, Validator, Auth, ACL, DB, DataTables;

class AttendaceDaywiseManualController extends Controller
{
 # Daywise Manual Attendance Form     
  public function dayManual(Request $request){
  // dd($request->all());
    $lineid=$request->line_id;
    $florid=$request->floor_id;

    $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
    ->pluck('hr_unit_name', 'hr_unit_id');
    DB::statement(DB::raw('SET @sl:=0;'));
    $info= DB::table('hr_as_basic_info AS b')
    ->where('as_unit_id', $request->unit_id)
          //->Where('as_line_id', $request->line_id)
    ->where(function($condition) use ($florid,$lineid){
      if ($florid!=null)
      {
        $condition->where('as_floor_id', $florid);
      }
      if ($lineid!=null)
      {
        $condition->where('as_line_id', $lineid);
      }
    })
    ->where('b.as_status',1) // checking status
    ->select([
      DB::raw('@sl:=@sl+1 AS serial_no'),
      'b.as_id',
      'b.associate_id',
      'b.as_name',
      'b.as_department_id',
      'd.hr_department_name'
    ])
    ->leftJoin('hr_department AS d', 'b.as_department_id', 'd.hr_department_id')

    ->get();

    $present=0; $absent=0;


    foreach($info AS $employees){

      $data= Attendance2::track2($employees->associate_id, $request->unit_id, $request->report_date, $request->report_date);
      
      $employees->in_time= $data->in_time;
      $employees->out_time= $data->out_time;
      $employees->oth= $data->overtime_time;
      $employees->otm= $data->overtime_minutes;
      $employees->atid= $data->attendance_id;

      if($data->holidays == 0)
        $employees->att= "Weekend";
      else if($data->holidays == 1)
        $employees->att= "Weekend(General)";
      else if($data->holidays == 2)
        $employees->att= "Weekend(OT)";
      else{
        if($data->attends)
          $employees->att= "P";
        else
          $employees->att= "A";
      }
    }
    $departments= $info->unique('as_department_id');

    $unit_name= DB::table('hr_unit')
    ->where('hr_unit_id', $request->unit_id)
    ->pluck('hr_unit_name')
    ->first();

    if(!empty($lineid)){
      $line_name= DB::table('hr_line')
      ->where('hr_line_id', $request->line_id)
      ->pluck('hr_line_name')
      ->first();
    }
    else  $line_name="";    

    if(!empty($florid)){
      $floor_name= DB::table('hr_floor')
      ->where('hr_floor_id', $florid)
      ->pluck('hr_floor_name')
      ->first();
    }
    else  $floor_name="";  

    $report_date= $request->report_date;

    $floorList= DB::table('hr_floor')
    ->where('hr_floor_unit_id', $request->unit_id)
    ->pluck('hr_floor_name', 'hr_floor_id');
    $lineList= DB::table('hr_line')
    ->where('hr_line_unit_id', $request->unit_id)
    ->pluck('hr_line_name', 'hr_line_id');

  // generate pdf
  /*if ($request->get('pdf') == true) {   
      $pdf = PDF::loadView('hr/reports/line_wise_att_pdf',  [
          'info' => $info,
          'departments' => $departments,
          'unit_name' => $unit_name,
          'line_name' => $line_name,
          'report_date' => $report_date,
          'absent' => $absent,
          'present' => $present,
          'lineList' => $lineList  
      ]);
      return $pdf->download('Line_Wise_Attendance'.date('d_F_Y').'.pdf'); 
    }*/

    return view('hr/timeattendance/attendance_daywise_manual', compact('unitList', 'info','departments', 'unit_name','floorList','floor_name', 'line_name', 'report_date','absent','present', 'lineList'));
  }
# Get Floor based on Unit
  public function getFloorByUnit(Request $request){
    $floors= Floor::select('hr_floor_name', 'hr_floor_id')
    ->where('hr_floor_unit_id', $request->unit)
    ->get();

    $data= '<option value="">Select Floor</option>';
    foreach ($floors as $floor) {
      $data.='<option value="'.$floor->hr_floor_id.'">'.$floor->hr_floor_name.'</option>';
    }
    return $data;
  }
# Get line based on Unit
  public function getLineByUnit(Request $request){
    $lines= Line::select('hr_line_name', 'hr_line_id')
    ->where('hr_line_unit_id', $request->unit)
    ->get();
// dd($lines);
    $data= '<option value="">Select Line</option>';
    foreach ($lines as $line) {
      $data.='<option value="'.$line->hr_line_id.'">'.$line->hr_line_name.'</option>';
    }


    return $data;
  }

 # Daywise Manual Attendance Store   

  public function dayManualStore(Request $request)
  { 

    $unit=$request->unit_att;
          // Set Attendance Table and Column Name

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

      //dd($request->all());

    for($i=0; $i<sizeof($request->attendance_id); $i++)
    {

        if($request->att_status[$i]=="P"){ //dd($request->att_status[$i]);

          if(($request->attendance_id[$i]==0)){

                //get shift code from shift roaster/basic information table according to attandance date
            $shift_code= null;
            $shift_ass= $request->ass_id[$i];
            $shift_year= date('Y', strtotime($request->startday));
            $shift_month= date('n', strtotime($request->startday));
            $shift_day= "day_".date('j', strtotime($request->startday));

                //get shift code from shift roaster
            $shift_code= DB::table('hr_shift_roaster')
            ->where('shift_roaster_year', $shift_year)
            ->where('shift_roaster_month', $shift_month)
            ->pluck($shift_day)
            ->first();
                //if Shift code is null then get default shift code from basic information table

            $shift_code= DB::table('hr_as_basic_info As b')
            ->where('b.as_id',$request->ass_id[$i])
            ->leftJoin('hr_shift AS s', 's.hr_shift_id', 'b.as_shift_id')
            ->pluck('s.hr_shift_code')
            ->first();


               // Set intime and outtime with date 
            $intime[$i]=$request->startday." ".$request->intime[$i];

            if($request->outtime[$i]==""){$outime[$i]=null;}
            else{$outime[$i]=$request->startday." ".$request->outtime[$i];}
                     //   dd($intime[$i]);

               // Store attendance 

            DB::table($tableName)->insert([
              'as_id'   =>$request->ass_id[$i],
              'hr_shift_code'=> $shift_code,
              'in_time' =>$intime[$i],
              'out_time'=>$outime[$i],
              'remarks'=>'BM',
              'updated_by' => auth()->user()->associate_id,
              'updated_at' => NOW()
            ]);
          }

             /* else {   
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

                 }*/

               }

             }
             return back()
             ->with('success', " Inserted Successfully!!");   

           }  

         }