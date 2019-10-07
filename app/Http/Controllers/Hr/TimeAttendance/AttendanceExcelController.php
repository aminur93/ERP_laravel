<?php
namespace App\Http\Controllers\Hr\TimeAttendance;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessAttCEIL;
use App\Jobs\ProcessAttCEW;
use App\Jobs\ProcessAttendance;
use App\Models\Hr\AttandancedataTemp;
use App\Models\Hr\Attendace;
use App\Models\Hr\AttendanceCeil;
use App\Models\Hr\CheckInOut;
use App\Models\Hr\Employee;
use Carbon\Carbon;
use DB, Validator, Input, FastExcel, File, Session;
use Illuminate\Http\Request;

// Package: Laravel FastExcel

class AttendanceExcelController extends Controller
{
    protected $filename;
    protected $filedir  = "./assets/excel/attendance/";

    public function export()
    {  
        // Export all attendance
        FastExcel::data(CheckInOut::all())->export($this->filedir."/".$this->filename);
    }

    public function importFile(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'unit' => 'required|min:1|max:11',
            'file' => 'required|mimes:csv,txt,xls,xlsx'
        ]);

        if ($validator->fails()) 
        {
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
        Session::forget('process_data');
        $input = $request->all();
        $data['unit'] = $input['unit'];
        
        if($request->unit == 1001){
            
            $filename='';
            $filedir  = "./assets/excel/common_unit/";
            
            $filename = date("d_m_Y")."_".auth()->user()->associate_id."_common_unit_".uniqid().".".pathinfo($request->file("file")->getClientOriginalName(), PATHINFO_EXTENSION);
            
            $request->file('file')->move($filedir, $filename);

            if (file_exists($filedir."/".$filename))
            {  
                $dataResult = FastExcel::import(($filedir."/".$filename), function ($line) {   
                    return  (!empty($line["Date"])?$line["Date"]:null)." ".(!empty($line["Time"])?$line["Time"]:null).":00".(!empty($line["Name"])?$line["Name"]:null);
                });
            }
            else
            {
                return back()->with('error', 'File not Found!');
            }
        }
        else{
            $fileData = file_get_contents($request->file('file'));
            $dataResult = explode(PHP_EOL, $fileData);
        }

        
        #=============TEST START =============#

       //      $unit= $request->unit;

       //  for ($i = 0; $i < sizeof($dataResult); $i++) { 
            


       //      $lineData = $dataResult[$i];
             

       //      if($unit==1 || $unit==4 || $unit==5 || $unit==9){
                
       //          $sl = substr($lineData, 0, 2);
       //          $date   = substr($lineData, 3, 8);
       //          $time   = substr($lineData, 12, 6);
       //          $rfid = substr($lineData, 19, 10);
       //          $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null);
       //      }

       //      else if($unit==2){

       //          $sl = substr($lineData, 0, 2);
       //          $date   = substr($lineData, 2, 8);
       //          $rfid = substr($lineData, 16, 10);
       //          $time   = substr($lineData, 10, 6);
       //          $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null); 
       //      }

       //      else if($unit==8){
       //          if(strlen($lineData)>0){
       //              $lineData = explode(" ", $lineData);
       //              $rfid = $lineData[0];
       //              $date = $lineData[1];
       //              $time = $lineData[2];
       //              $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null);
       //          }
       //          else{
       //              $rfid="";
       //          }
                
       //      }
       //      else if($unit==1001){

       //          $date   = substr($lineData, 0, 19);
       //          $date  =  date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $date)));
       //          $rfid = substr($lineData, 19, 10);
       //          $checktime = (!empty($date)?date("Y-m-d H:i:s", strtotime($date)):null); 
       //      }



       //      //get Employee Information from as_basic_info table according to the RFID
       //      if(strlen($rfid)>0){
       //          $as_info= Employee::where('as_rfid_code', $rfid)
       //                              ->select([
       //                                  'as_unit_id',
       //                                  'as_id',
       //                                  'as_shift_id',
       //                                  'as_shift_id',
       //                                  'hr_shift_code',
       //                                  'hr_shift_start_time',
       //                                  'hr_shift_end_time'
       //                              ])
       //                              ->leftJoin('hr_shift', 'as_shift_id', 'hr_shift_id')
       //                              ->first();

                    
       //          if(!empty($as_info) && strlen($rfid)>0 && $checktime != null){

       //              //Select table Name as associates Unit ID
       //              if($as_info->as_unit_id ==1 || $as_info->as_unit_id ==4 || $as_info->as_unit_id ==5 || $as_info->as_unit_id ==9){
       //                  $tableName="hr_attendance_mbm";
       //              }
       //              else if($as_info->as_unit_id ==2){
       //                  $tableName="hr_attendance_ceil";
       //              }
       //              else if($as_info->as_unit_id ==3){
       //                  $tableName="hr_attendance_aql";
       //              }
       //              else if($as_info->as_unit_id ==8){
       //                  $tableName="hr_attendance_cew";
       //              }
       //              else{
       //                  $tableName="hr_attendance";
       //              }


       //              //get shift Code
       //              $shift_code= null;
       //              $shift_start= null;
       //              $shift_end= null;

       //              $month= date('m', strtotime($checktime));
       //              $year= date('Y', strtotime($checktime));

       //              $day_of_date= date('j', strtotime($checktime));
       //              $day_num= "day_".$day_of_date;

       //              $shift= DB::table("hr_shift_roaster")
       //                                  ->where('shift_roaster_month', $month)
       //                                  ->where('shift_roaster_year', $year)
       //                                  ->where("shift_roaster_user_id", $as_info->as_id)
       //                                  ->orderBy('shift_roaster_id', "DESC")
       //                                  ->select([
       //                                      $day_num,
       //                                      'hr_shift_start_time',
       //                                      'hr_shift_end_time'
       //                                  ])
       //                                  ->leftJoin('hr_shift', $day_num, 'hr_shift_code')
       //                                  ->first();
                    
       //              if($shift->$day_num != null){
       //                  $shift_code= $shift->$day_num;
       //                  $shift_start= $shift->hr_shift_start_time;
       //                  $shift_end= $shift->hr_shift_end_time;
       //              }
       //              else{
       //                  $shift_code= $as_info->hr_shift_code;
       //                  $shift_start= $as_info->hr_shift_start_time;
       //                  $shift_end= $as_info->hr_shift_end_time;
       //              }

       //              if($shift_code != null && $shift_start != null && $shift_end !=null){

       //                  $punch_date= date('Y-m-d', strtotime($checktime));
       //                  $shift_start = $punch_date." ".$shift_start;
       //                  $shift_end = $punch_date." ".$shift_end;

       //                  $shift_in_time= (int)strtotime($shift_start);
       //                  $shift_out_time= (int)strtotime($shift_end);

       //                  // if shift end time is less than shift start time then add one day to shift end time
       //                  if($shift_out_time < $shift_in_time){
       //                      $shift_out_time= $shift_out_time+86400;
       //                  }

       //                  //shift start range
       //                  $shift_start_begin= $shift_in_time-3600;
       //                  $shift_start_end= $shift_in_time+14399;

       //                  //shift end rage
       //                  $shift_end_begin= $shift_start_end+1;
       //                  $shift_end_end= $shift_out_time+21600;

       //                  //check time
       //                  $check_time= (int)strtotime($checktime);

       //                  //get existing punch
       //                  if($as_info->as_id == 3){
       //                      $last_punch= DB::table($tableName)
       //                                      ->where('as_id', $as_info->as_id)
       //                                      ->whereDate('in_time', '=', date("Y-m-d", strtotime($checktime)))
       //                                      ->orderBy('att_id', "DESC")
       //                                      ->first();
       //                  }
       //                  else{
       //                      $last_punch= DB::table($tableName)
       //                                      ->where('as_id', $as_info->as_id)
       //                                      ->whereDate('in_time', '=', date("Y-m-d", strtotime($checktime)))
       //                                      ->orderBy('id', "DESC")
       //                                      ->first();
       //                  }
                            

       //                  if($shift_start_begin<= $check_time && $check_time <= $shift_start_end){
                            
       //                      //if in_time is empty insert new else do nothing
       //                      if(empty($last_punch->in_time)){
       //                          DB::table($tableName)
       //                              ->insert([
       //                                  'as_id' => $as_info->as_id,
       //                                  'in_time' => $checktime,
       //                                  'hr_shift_code' => $shift_code
       //                              ]);
       //                      }
       //                  }

       //                  else if($shift_end_begin<= $check_time && $check_time <= $shift_end_end){

       //                      if(!empty($last_punch)){
       //                          if($as_info->as_id == 3){
       //                              DB::table($tableName)
       //                                  ->where('att_id', $last_punch->att_id)
       //                                  ->where('as_id', $as_info->as_id)
       //                                  ->update([
       //                                      'out_time' => $checktime
       //                                  ]);
       //                          }
       //                          else{
       //                              DB::table($tableName)
       //                                  ->where('id', $last_punch->id)
       //                                  ->where('as_id', $as_info->as_id)
       //                                  ->update([
       //                                      'out_time' => $checktime
       //                                  ]);
       //                          }
       //                      }
       //                      else{
       //                          DB::table($tableName)
       //                              ->insert([
       //                                  'as_id' => $as_info->as_id,
       //                                  'in_time' => date('Y-m-d H:i:s', strtotime($shift_start)),
       //                                  'out_time' => $checktime,
       //                                  'hr_shift_code' => $shift_code,
       //                                  'remarks'       => "DSI"
       //                              ]);
       //                      }
       //                  }
       //                  else{
       //                      $last_punch= DB::table($tableName)
       //                                  ->where('as_id', $as_info->as_id)
       //                                  ->whereDate('in_time', '=', date("Y-m-d", strtotime("-1 days $checktime")))
       //                                  ->orderBy('id', "DESC")
       //                                  ->first();
       //                      if(!empty($last_punch)){

       //                          if($as_info->as_id == 3){
       //                              DB::table($tableName)
       //                                  ->where('att_id', $last_punch->att_id)
       //                                  ->where('as_id', $as_info->as_id)
       //                                  ->update([
       //                                      'out_time' => $checktime
       //                                  ]);
       //                          }
       //                          else{
       //                              DB::table($tableName)
       //                                  ->where('id', $last_punch->id)
       //                                  ->where('as_id', $as_info->as_id)
       //                                  ->update([
       //                                      'out_time' => $checktime
       //                                  ]);
       //                          }
       //                      }
       //                      else{

       //                          $shift_code_new=null;
       //                          if($day_of_date == 1){
       //                              $day_of_date= date("Y-m-d", $check_time-86400);
       //                              $day_of_date= date('j', strtotime($day_of_date));
       //                              $month= $month-1;
       //                              if($month ==1){
       //                                  $month=12;
       //                                  $year= $year-1;
       //                              }
       //                              $day_num= "day_".($day_of_date);
       //                          }
       //                          else{
       //                              $day_num= "day_".($day_of_date-1);
       //                          }
                                

       //                          $shift= DB::table("hr_shift_roaster")
       //                                  ->where('shift_roaster_month', $month)
       //                                  ->where('shift_roaster_year', $year)
       //                                  ->where("shift_roaster_user_id", $as_info->as_id)
       //                                  ->orderBy('shift_roaster_id', "DESC")
       //                                  ->select([
       //                                      $day_num,
       //                                      'hr_shift_start_time',
       //                                      'hr_shift_end_time'
       //                                  ])
       //                                  ->leftJoin('hr_shift', $day_num, 'hr_shift_code')
       //                                  ->first();

       //                          if(!empty($shift)){
       //                              $shift_code_new= $shift->$day_num;
       //                              $shift_start_new= $shift->hr_shift_start_time;
       //                              $shift_end_new= $shift->hr_shift_end_time;
       //                          }

       //                          else{
       //                              $shift_code_new= $as_info->hr_shift_code;
       //                              $shift_start_new= $as_info->hr_shift_start_time;
       //                              $shift_end_new= $as_info->hr_shift_end_time;
       //                          }
       //                          if(!empty($shift_code_new)){


       //                              $shift_start = $punch_date." ".$shift_start_new;
       //                              $shift_end = $punch_date." ".$shift_end_new;

       //                              $shift_in_time_new= (int)strtotime($shift_start);
       //                              $shift_out_time_new= (int)strtotime($shift_end);

       //                              // if shift end time is less than shift start time then add one day to shift end time
       //                              if($shift_out_time_new < $shift_in_time_new){
       //                                  $shift_out_time_new= $shift_out_time_new+86400;
       //                              }

       //                              //shift start range
       //                              $shift_start_begin_new= $shift_in_time_new-3600;
       //                              $shift_start_end_new= $shift_in_time_new+14399;

       //                              //shift end rage
       //                              $shift_end_begin_new= $shift_start_end_new+1;
       //                              $shift_end_end_new= $shift_out_time_new+21600;

       //                              if($shift_end_begin_new<= $check_time && $check_time <= $shift_end_end_new){

       //                                  DB::table($tableName)
       //                                      ->insert([
       //                                          'as_id' => $as_info->as_id,
       //                                          'in_time' => date("Y-m-d H:i:s", strtotime($shift_start)),
       //                                          'out_time'      => $checktime,
       //                                          'hr_shift_code' => $shift_code_new,
       //                                          'remarks'       => "DSI"
       //                                      ]);
       //                              }
                                    
       //                          }
                                
       //                      }
       //                  }
       //              }
       //          }
       //      } 
       //      dd($lineData);   
       // }
       // return 'success';






        #=============TEST END =============#
        
        Session::put('process_data', $dataResult);
        $data['arrayDataCount'] = count($dataResult);
        return view('hr.timeattendance.att_status', $data);
    }
    
    public function attProcessSessionRemove(Request $request){
        //$input = $request->all();
        Session::forget('process_data');
        return 'success';
    }

    public function importFileProcess(Request $request)
    {
        $input = $request->all();
        $input['data'] = Session::get('process_data');
        //return $input;
        $unit= $input['unit'];
        $startPage = ($input['start']) * $input['per_page'];
        $totalGet = intval($startPage) + intval($input['per_page']);
        $dataIds = $input['data'];
        if($totalGet > count($dataIds)){
          $totalGet = count($dataIds);
        }
        $unit= $request->unit;

        for ($i = intval($startPage); $i < intval($totalGet); $i++) { 
            
            $lineData = $dataIds[$i];



            $rfid="";

            if(($unit==1 || $unit==4 || $unit==5 || $unit==9) && !empty($lineData) && (strlen($lineData)>1)){
                
                $sl = substr($lineData, 0, 2);
                $date   = substr($lineData, 3, 8);
                $time   = substr($lineData, 12, 6);
                $rfid = substr($lineData, 19, 10);
                $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null);
            }

            else if($unit==2 && !empty($lineData) && (strlen($lineData)>1)){

                $sl = substr($lineData, 0, 2);
                $date   = substr($lineData, 2, 8);
                $rfid = substr($lineData, 16, 10);
                $time   = substr($lineData, 10, 6);
                $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null); 
            }

            else if($unit==8  &&  !empty($lineData) && (strlen($lineData)>1)){
               // if(strlen($lineData)>0){
                    $lineData = explode(" ", $lineData);
                    $rfid = $lineData[0];
                    $date = $lineData[1];
                    $time = $lineData[2];
                    $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null);
              
                
            }
            else if($unit==1001 && !empty($lineData) && (strlen($lineData)>1)){

                $date   = substr($lineData, 0, 19);
                $date  =  date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $date)));
                $rfid = substr($lineData, 19, 10);
                $checktime = (!empty($date)?date("Y-m-d H:i:s", strtotime($date)):null); 
            }



            //get Employee Information from as_basic_info table according to the RFID
            if(strlen($rfid)>0){
                $as_info= Employee::where('as_rfid_code', $rfid)
                                    ->select([
                                        'as_unit_id',
                                        'as_id',
                                        'as_shift_id',
                                        'as_shift_id',
                                        'hr_shift_code',
                                        'hr_shift_start_time',
                                        'hr_shift_end_time'
                                    ])
                                    ->leftJoin('hr_shift', 'as_shift_id', 'hr_shift_id')
                                    ->first();

                  
                if(!empty($as_info) && strlen($rfid)>0 && $checktime != null){

                    //Select table Name as associates Unit ID
                    if($as_info->as_unit_id ==1 || $as_info->as_unit_id ==4 || $as_info->as_unit_id ==5 || $as_info->as_unit_id ==9){
                        $tableName="hr_attendance_mbm";
                    }
                    else if($as_info->as_unit_id ==2){
                        $tableName="hr_attendance_ceil";
                    }
                    else if($as_info->as_unit_id ==3){
                        $tableName="hr_attendance_aql";
                    }
                    else if($as_info->as_unit_id ==8){
                        $tableName="hr_attendance_cew";
                    }
                    else{
                        $tableName="hr_attendance";
                    }

                    //get shift Code
                    $shift_code= null;
                    $shift_start= null;
                    $shift_end= null;

                    $month= date('m', strtotime($checktime));
                    $year= date('Y', strtotime($checktime));

                    $day_of_date= date('j', strtotime($checktime));
                    $day_num= "day_".$day_of_date;

                    $shift= DB::table("hr_shift_roaster")
                                        ->where('shift_roaster_month', $month)
                                        ->where('shift_roaster_year', $year)
                                        ->where("shift_roaster_user_id", $as_info->as_id)
                                        ->orderBy('shift_roaster_id', "DESC")
                                        ->select([
                                            $day_num,
                                            'hr_shift_start_time',
                                            'hr_shift_end_time'
                                        ])
                                        ->leftJoin('hr_shift', $day_num, 'hr_shift_code')
                                        ->first();
                    if(!empty($shift) && $shift->$day_num != null){
                        $shift_code= $shift->$day_num;
                        $shift_start= $shift->hr_shift_start_time;
                        $shift_end= $shift->hr_shift_end_time;
                    }
                    else{
                        $shift_code= $as_info->hr_shift_code;
                        $shift_start= $as_info->hr_shift_start_time;
                        $shift_end= $as_info->hr_shift_end_time;
                    }

                    if($shift_code != null && $shift_start != null && $shift_end !=null){

                        $punch_date= date('Y-m-d', strtotime($checktime));
                        $shift_start = $punch_date." ".$shift_start;
                        $shift_end = $punch_date." ".$shift_end;

                        $shift_in_time= (int)strtotime($shift_start);
                        $shift_out_time= (int)strtotime($shift_end);

                        // if shift end time is less than shift start time then add one day to shift end time
                        if($shift_out_time < $shift_in_time){
                            $shift_out_time= $shift_out_time+86400;
                        }

                        //shift start range
                        $shift_start_begin= $shift_in_time-7200;
                        $shift_start_end= $shift_in_time+14399;

                        //shift end rage
                        $shift_end_begin= $shift_start_end+1;
                        $shift_end_end= $shift_out_time+21600;

                        //check time
                        $check_time= (int)strtotime($checktime);

                        //get existing punch
                        if($as_info->as_unit_id == 3){
                            $last_punch= DB::table($tableName)
                                            ->where('as_id', $as_info->as_id)
                                            ->whereDate('in_time', '=', date("Y-m-d", strtotime($checktime)))
                                            ->orderBy('att_id', "DESC")
                                            ->first();
                        }
                        else{
                            $last_punch= DB::table($tableName)
                                            ->where('as_id', $as_info->as_id)
                                            ->whereDate('in_time', '=', date("Y-m-d", strtotime($checktime)))
                                            ->orderBy('id', "DESC")
                                            ->first();
                        }
                            

                        if($shift_start_begin<= $check_time && $check_time <= $shift_start_end){
                            
                            //if in_time is empty insert new else do nothing
                            if(empty($last_punch->in_time)){
                                DB::table($tableName)
                                    ->insert([
                                        'as_id' => $as_info->as_id,
                                        'in_time' => $checktime,
                                        'hr_shift_code' => $shift_code
                                    ]);
                            }
                        }

                        else if($shift_end_begin<= $check_time && $check_time <= $shift_end_end){

                            if(!empty($last_punch)){
                                if($as_info->as_unit_id == 3){
                                    DB::table($tableName)
                                        ->where('att_id', $last_punch->att_id)
                                        ->where('as_id', $as_info->as_id)
                                        ->update([
                                            'out_time' => $checktime
                                        ]);
                                }
                                else{
                                    DB::table($tableName)
                                        ->where('id', $last_punch->id)
                                        ->where('as_id', $as_info->as_id)
                                        ->update([
                                            'out_time' => $checktime
                                        ]);
                                }
                            }
                            else{
                                DB::table($tableName)
                                    ->insert([
                                        'as_id' => $as_info->as_id,
                                        'in_time' => date('Y-m-d H:i:s', strtotime($shift_start)),
                                        'out_time' => $checktime,
                                        'hr_shift_code' => $shift_code,
                                        'remarks'       => "DSI"
                                    ]);
                            }
                        }
                        else{
                            $last_punch= DB::table($tableName)
                                        ->where('as_id', $as_info->as_id)
                                        ->whereDate('in_time', '=', date("Y-m-d", strtotime("-1 days $checktime")))
                                        ->orderBy('id', "DESC")
                                        ->first();
                            if(!empty($last_punch)){

                                if($as_info->as_unit_id == 3){
                                    DB::table($tableName)
                                        ->where('att_id', $last_punch->att_id)
                                        ->where('as_id', $as_info->as_id)
                                        ->update([
                                            'out_time' => $checktime
                                        ]);
                                }
                                else{
                                    DB::table($tableName)
                                        ->where('id', $last_punch->id)
                                        ->where('as_id', $as_info->as_id)
                                        ->update([
                                            'out_time' => $checktime
                                        ]);
                                }
                            }
                            else{

                                $shift_code_new=null;
                                if($day_of_date == 1){
                                    $day_of_date= date("Y-m-d", $check_time-86400);
                                    $day_of_date= date('j', strtotime($day_of_date));
                                    $month= $month-1;
                                    if($month ==1){
                                        $month=12;
                                        $year= $year-1;
                                    }
                                    $day_num= "day_".($day_of_date);
                                }
                                else{
                                    $day_num= "day_".($day_of_date-1);
                                }
                                

                                $shift= DB::table("hr_shift_roaster")
                                        ->where('shift_roaster_month', $month)
                                        ->where('shift_roaster_year', $year)
                                        ->where("shift_roaster_user_id", $as_info->as_id)
                                        ->orderBy('shift_roaster_id', "DESC")
                                        ->select([
                                            $day_num,
                                            'hr_shift_start_time',
                                            'hr_shift_end_time'
                                        ])
                                        ->leftJoin('hr_shift', $day_num, 'hr_shift_code')
                                        ->first();

                                if(!empty($shift)){
                                    $shift_code_new= $shift->$day_num;
                                    $shift_start_new= $shift->hr_shift_start_time;
                                    $shift_end_new= $shift->hr_shift_end_time;
                                }

                                else{
                                    $shift_code_new= $as_info->hr_shift_code;
                                    $shift_start_new= $as_info->hr_shift_start_time;
                                    $shift_end_new= $as_info->hr_shift_end_time;
                                }
                                if(!empty($shift_code_new)){


                                    $shift_start = $punch_date." ".$shift_start_new;
                                    $shift_end = $punch_date." ".$shift_end_new;

                                    $shift_in_time_new= (int)strtotime($shift_start);
                                    $shift_out_time_new= (int)strtotime($shift_end);

                                    // if shift end time is less than shift start time then add one day to shift end time
                                    if($shift_out_time_new < $shift_in_time_new){
                                        $shift_out_time_new= $shift_out_time_new+86400;
                                    }

                                    //shift start range
                                    $shift_start_begin_new= $shift_in_time_new-7200;
                                    $shift_start_end_new= $shift_in_time_new+14399;

                                    //shift end rage
                                    $shift_end_begin_new= $shift_start_end_new+1;
                                    $shift_end_end_new= $shift_out_time_new+21600;

                                    if($shift_end_begin_new<= $check_time && $check_time <= $shift_end_end_new){

                                        DB::table($tableName)
                                            ->insert([
                                                'as_id' => $as_info->as_id,
                                                'in_time' => date("Y-m-d H:i:s", strtotime($shift_start)),
                                                'out_time'      => $checktime,
                                                'hr_shift_code' => $shift_code_new,
                                                'remarks'       => "DSI"
                                            ]);
                                    }
                                    
                                }
                                
                            }
                        }
                    }
                }
            }    
       
           
       }
       return 'success';
    }


    /*
    * Tested on Head Office (HO_DATA.csv)
    * HO
    */
    public function device1()
    {
        $data = "date,time,userid\r\n";
        $data .= @file_get_contents($this->filedir."/".$this->filename);
        @file_put_contents($this->filedir."/".$this->filename, $data);

        $device1 = FastExcel::configureCsv(',')->import(($this->filedir."/".$this->filename), function ($line) { 

            $deviceid    = (!empty($line["userid"])?$line["userid"]:"");
            $rfid=$line["userid"];
            if (!empty($line["date"]) && !empty($line["time"]))
            {
                    // date
                $dateArray = explode("/", $line["date"]);
                $days   = (!empty($dateArray[0])?$dateArray[0]:0);
                $months = (!empty($dateArray[1])?$dateArray[1]:0);
                $years  = (!empty($dateArray[2])?$dateArray[2]:0);
                    // time
                $timeArray = explode(".", $line["time"]);
                $hours   = (!empty($timeArray[0])?$timeArray[0]:00);
                $mintues = (!empty($timeArray[1])?$timeArray[1]:00);

                $checktime = date("Y-m-d H:i:s", strtotime("$years-$months-$days $hours:$mintues"));
            }

               //get as_id to store in temp table
            $as_id= Employee::where('as_rfid_code', $rfid)->pluck('as_id')->first();

            if($as_id){
                $month= date('m', strtotime($checktime));
                $year= date('Y', strtotime($checktime));

                $shift_roast= DB::table("hr_shift_roaster AS sr")
                ->where('sr.shift_roaster_month', $month)
                ->where('sr.shift_roaster_year', $year)
                ->orderBy('shift_roaster_id', "DESC")
                ->where("sr.shift_roaster_user_id", $as_id)
                ->first();

                if($shift_roast){

                    $day= date('j', strtotime($checktime));
                    if($day==1) $shift_code= $shift_roast->day_1;
                    if($day==2) $shift_code= $shift_roast->day_2;
                    if($day==3) $shift_code= $shift_roast->day_3;
                    if($day==4) $shift_code= $shift_roast->day_4;
                    if($day==5) $shift_code= $shift_roast->day_5;
                    if($day==6) $shift_code= $shift_roast->day_6;
                    if($day==7) $shift_code= $shift_roast->day_7;
                    if($day==8) $shift_code= $shift_roast->day_8;
                    if($day==9) $shift_code= $shift_roast->day_9;
                    if($day==10) $shift_code= $shift_roast->day_10;
                    if($day==11) $shift_code= $shift_roast->day_11;
                    if($day==12) $shift_code= $shift_roast->day_12;
                    if($day==13) $shift_code= $shift_roast->day_13;
                    if($day==14) $shift_code= $shift_roast->day_14;
                    if($day==15) $shift_code= $shift_roast->day_15;
                    if($day==16) $shift_code= $shift_roast->day_16;
                    if($day==17) $shift_code= $shift_roast->day_17;
                    if($day==18) $shift_code= $shift_roast->day_18;
                    if($day==19) $shift_code= $shift_roast->day_19;
                    if($day==20) $shift_code= $shift_roast->day_20;
                    if($day==21) $shift_code= $shift_roast->day_21;
                    if($day==22) $shift_code= $shift_roast->day_22;
                    if($day==23) $shift_code= $shift_roast->day_23;
                    if($day==24) $shift_code= $shift_roast->day_24;
                    if($day==25) $shift_code= $shift_roast->day_25;
                    if($day==26) $shift_code= $shift_roast->day_26;
                    if($day==27) $shift_code= $shift_roast->day_27;
                    if($day==28) $shift_code= $shift_roast->day_28;
                    if($day==29) $shift_code= $shift_roast->day_29;
                    if($day==30) $shift_code= $shift_roast->day_30;
                    if($day==31) $shift_code= $shift_roast->day_31;

                    if(!empty($shift_code)){
                        AttandancedataTemp::insert([                       
                            'checktime'   => $checktime,
                            'rf_id'       => $rfid,
                            'Userid'         => $as_id,
                            'hr_shift_code' => $shift_code
                        ]); 
                    }
                }
            }

        }); 

        return redirect("hr/timeattendance/attendance_manual")
        ->with('success', 'Bulk upload successful.');

    }

    /*
    * Tested on Wash (dinfo_wash.txt)
    * CEW 
    */
    public function device2()
    {
        $data = "userid date time\r\n";
        $data .= @file_get_contents($this->filedir."/".$this->filename);
        @file_put_contents($this->filedir."/".$this->filename, $data);

        $device2 = FastExcel::configureCsv(' ')->import(($this->filedir."/".$this->filename), function ($line) { 

            $date = (!empty($line["date"])?$line["date"]:0);
            $time = (!empty($line["time"])?$line["time"]:0);
            $rfid=$line["userid"];
            $datetime= $date.' '.$time; 

                //get as_id to store in temp table
            $as_id= Employee::where('as_rfid_code', $rfid)->pluck('as_id')->first();

            if($as_id){
                $month= date('m', strtotime($datetime));
                $year= date('Y', strtotime($datetime));

                $shift_roast= DB::table("hr_shift_roaster AS sr")
                ->where('sr.shift_roaster_month', $month)
                ->where('sr.shift_roaster_year', $year)
                ->orderBy('shift_roaster_id', "DESC")
                ->where("sr.shift_roaster_user_id", $as_id)
                ->first();

                if($shift_roast){

                    $day= date('j', strtotime($datetime));
                    if($day==1) $shift_code= $shift_roast->day_1;
                    if($day==2) $shift_code= $shift_roast->day_2;
                    if($day==3) $shift_code= $shift_roast->day_3;
                    if($day==4) $shift_code= $shift_roast->day_4;
                    if($day==5) $shift_code= $shift_roast->day_5;
                    if($day==6) $shift_code= $shift_roast->day_6;
                    if($day==7) $shift_code= $shift_roast->day_7;
                    if($day==8) $shift_code= $shift_roast->day_8;
                    if($day==9) $shift_code= $shift_roast->day_9;
                    if($day==10) $shift_code= $shift_roast->day_10;
                    if($day==11) $shift_code= $shift_roast->day_11;
                    if($day==12) $shift_code= $shift_roast->day_12;
                    if($day==13) $shift_code= $shift_roast->day_13;
                    if($day==14) $shift_code= $shift_roast->day_14;
                    if($day==15) $shift_code= $shift_roast->day_15;
                    if($day==16) $shift_code= $shift_roast->day_16;
                    if($day==17) $shift_code= $shift_roast->day_17;
                    if($day==18) $shift_code= $shift_roast->day_18;
                    if($day==19) $shift_code= $shift_roast->day_19;
                    if($day==20) $shift_code= $shift_roast->day_20;
                    if($day==21) $shift_code= $shift_roast->day_21;
                    if($day==22) $shift_code= $shift_roast->day_22;
                    if($day==23) $shift_code= $shift_roast->day_23;
                    if($day==24) $shift_code= $shift_roast->day_24;
                    if($day==25) $shift_code= $shift_roast->day_25;
                    if($day==26) $shift_code= $shift_roast->day_26;
                    if($day==27) $shift_code= $shift_roast->day_27;
                    if($day==28) $shift_code= $shift_roast->day_28;
                    if($day==29) $shift_code= $shift_roast->day_29;
                    if($day==30) $shift_code= $shift_roast->day_30;
                    if($day==31) $shift_code= $shift_roast->day_31;

                    if(!empty($shift_code)){
                        AttandancedataTemp::insert([                       
                            'checktime'   => $datetime,
                            'rf_id'       => $rfid,
                            'Userid'         => $as_id,
                            'hr_shift_code' => $shift_code
                        ]); 
                    }
                }
            }
        }); 

        return redirect("hr/timeattendance/attendance_manual")
        ->with('success', 'Bulk upload successful.');

    }


    /*
    * Tested on MBM Garments (MBM.txt)
    * MBM / MFW / SRT 
    */
    public function device3()
    {
        $data = "sldatetimeuserid\r\n";
        $data .= @file_get_contents($this->filedir."/".$this->filename);
        @file_put_contents($this->filedir."/".$this->filename, $data);


        $device3 = FastExcel::configureCsv('')->import(($this->filedir."/".$this->filename), function ($line) { 

            $date = (!empty($line["date"])?$line["date"]:0);
            $time = (!empty($line["time"])?$line["time"]:0);
            $rfid = str_replace(':', '', $line["userid"]);
            $datetime= $date.''.$time;            

                //get as_id to store in temp table
            $as_id= Employee::where('as_rfid_code', $rfid)->pluck('as_id')->first();

            if($as_id){
                $month= date('m', strtotime($datetime));
                $year= date('Y', strtotime($datetime));

                $shift_roast= DB::table("hr_shift_roaster AS sr")
                ->where('sr.shift_roaster_month', $month)
                ->where('sr.shift_roaster_year', $year)
                ->orderBy('shift_roaster_id', "DESC")
                ->where("sr.shift_roaster_user_id", $as_id)
                ->first();

                if($shift_roast){

                    $day= date('j', strtotime($datetime));
                    if($day==1) $shift_code= $shift_roast->day_1;
                    if($day==2) $shift_code= $shift_roast->day_2;
                    if($day==3) $shift_code= $shift_roast->day_3;
                    if($day==4) $shift_code= $shift_roast->day_4;
                    if($day==5) $shift_code= $shift_roast->day_5;
                    if($day==6) $shift_code= $shift_roast->day_6;
                    if($day==7) $shift_code= $shift_roast->day_7;
                    if($day==8) $shift_code= $shift_roast->day_8;
                    if($day==9) $shift_code= $shift_roast->day_9;
                    if($day==10) $shift_code= $shift_roast->day_10;
                    if($day==11) $shift_code= $shift_roast->day_11;
                    if($day==12) $shift_code= $shift_roast->day_12;
                    if($day==13) $shift_code= $shift_roast->day_13;
                    if($day==14) $shift_code= $shift_roast->day_14;
                    if($day==15) $shift_code= $shift_roast->day_15;
                    if($day==16) $shift_code= $shift_roast->day_16;
                    if($day==17) $shift_code= $shift_roast->day_17;
                    if($day==18) $shift_code= $shift_roast->day_18;
                    if($day==19) $shift_code= $shift_roast->day_19;
                    if($day==20) $shift_code= $shift_roast->day_20;
                    if($day==21) $shift_code= $shift_roast->day_21;
                    if($day==22) $shift_code= $shift_roast->day_22;
                    if($day==23) $shift_code= $shift_roast->day_23;
                    if($day==24) $shift_code= $shift_roast->day_24;
                    if($day==25) $shift_code= $shift_roast->day_25;
                    if($day==26) $shift_code= $shift_roast->day_26;
                    if($day==27) $shift_code= $shift_roast->day_27;
                    if($day==28) $shift_code= $shift_roast->day_28;
                    if($day==29) $shift_code= $shift_roast->day_29;
                    if($day==30) $shift_code= $shift_roast->day_30;
                    if($day==31) $shift_code= $shift_roast->day_31;

                    if(!empty($shift_code)){
                        AttandancedataTemp::insert([                       
                            'checktime'   => $datetime,
                            'rf_id'       => $rfid,
                            'Userid'         => $as_id,
                            'hr_shift_code' => $shift_code
                        ]); 
                    }


                }
            }

        });


        return redirect("hr/timeattendance/attendance_manual")
        ->with('success', 'Bulk upload successful.');
    }

    /*
    * Tested on Cutting Edge Industries Ltd (dinfo_ce.txt)
    * CEIL  
    */
    public function device4()
    {
        $lineDatas = array();
        $data = "record\r\n";
        $data .= @file_get_contents($this->filedir."/".$this->filename);
        return $this->filedir."/".$this->filename;
        dd($data);
        @file_put_contents($this->filedir."/".$this->filename, $data);
        return $device4 = FastExcel::configureCsv(' ')->import(($this->filedir."/".$this->filename), function ($line) { 

            
            if (!empty($line))
            {
                $lineData = trim($line['record']);
                $sl = substr($lineData, 0, 2);
                $date   = substr($lineData, 2, 8);
                $rfid = substr($lineData, 16, 10);
                $time   = substr($lineData, 10, 6);
                $checktime = ((!empty($date) && !empty($time))?date("Y-m-d H:i:s", strtotime("$date $time")):null); 

                //get as_id to store in temp table
                $as_id= Employee::where('as_rfid_code', $rfid)->pluck('as_id')->first();
                if($as_id){

                    $month= date('m', strtotime($checktime));
                    $year= date('Y', strtotime($checktime));

                    $shift_roast= DB::table("hr_shift_roaster AS sr")
                    ->where('sr.shift_roaster_month', $month)
                    ->where('sr.shift_roaster_year', $year)
                    ->orderBy('shift_roaster_id', "DESC")
                    ->where("sr.shift_roaster_user_id", $as_id)
                    ->first();

                    if($shift_roast){

                        $day = date('j', strtotime($checktime));
                        if($day==1) $shift_code= $shift_roast->day_1;
                        if($day==2) $shift_code= $shift_roast->day_2;
                        if($day==3) $shift_code= $shift_roast->day_3;
                        if($day==4) $shift_code= $shift_roast->day_4;
                        if($day==5) $shift_code= $shift_roast->day_5;
                        if($day==6) $shift_code= $shift_roast->day_6;
                        if($day==7) $shift_code= $shift_roast->day_7;
                        if($day==8) $shift_code= $shift_roast->day_8;
                        if($day==9) $shift_code= $shift_roast->day_9;
                        if($day==10) $shift_code= $shift_roast->day_10;
                        if($day==11) $shift_code= $shift_roast->day_11;
                        if($day==12) $shift_code= $shift_roast->day_12;
                        if($day==13) $shift_code= $shift_roast->day_13;
                        if($day==14) $shift_code= $shift_roast->day_14;
                        if($day==15) $shift_code= $shift_roast->day_15;
                        if($day==16) $shift_code= $shift_roast->day_16;
                        if($day==17) $shift_code= $shift_roast->day_17;
                        if($day==18) $shift_code= $shift_roast->day_18;
                        if($day==19) $shift_code= $shift_roast->day_19;
                        if($day==20) $shift_code= $shift_roast->day_20;
                        if($day==21) $shift_code= $shift_roast->day_21;
                        if($day==22) $shift_code= $shift_roast->day_22;
                        if($day==23) $shift_code= $shift_roast->day_23;
                        if($day==24) $shift_code= $shift_roast->day_24;
                        if($day==25) $shift_code= $shift_roast->day_25;
                        if($day==26) $shift_code= $shift_roast->day_26;
                        if($day==27) $shift_code= $shift_roast->day_27;
                        if($day==28) $shift_code= $shift_roast->day_28;
                        if($day==29) $shift_code= $shift_roast->day_29;
                        if($day==30) $shift_code= $shift_roast->day_30;
                        if($day==31) $shift_code= $shift_roast->day_31;
                        //if(!empty($shift_code)){
                            $dataSet = [
                                'checktime'   => $checktime,
                                'rf_id'       => $rfid,
                                'Userid'         => $as_id,
                                'hr_shift_code' => $shift_code
                            ];
                            return $results[] = $dataSet;
                            
                        //}
                        //dd($rfid);
                        // if(!empty($shift_code)){
                        //  AttandancedataTemp::insert([                       
                        //      'checktime'   => $checktime,
                        //      'rf_id'       => $rfid,
                        //      'Userid'         => $as_id,
                        //      'hr_shift_code' => $shift_code
                        //  ]); 
                        // }
                    }               
                }
            } 
        }); 
        
        //return $dataSet;
        return redirect("hr/timeattendance/attendance_manual")
        ->with('success', 'Bulk upload successful.');
    }

     //processing the temporary data
    public function processAttendance(){     
        if(request()->segment(4)==3)
        {
            $this->aqlCheckInOutProcess();

            return back()
            ->with('success', 'AQL Attendacne processed!');
        }

        $exists= DB::table('hr_att_data_temp')->count();

        if($exists==0){
            return back()
            ->with('error', 'You have no data to process!');
        }

        $temp_rows= DB::table('hr_att_data_temp AS t')
        ->select([
            "t.*",
            "b.as_id"
        ])
        ->join('hr_as_basic_info AS b', 'b.as_rfid_code', 't.rf_id')
        ->get();

        DB::table('hr_att_data_temp')->truncate();
        foreach ($temp_rows as $temp) {

            //check night flag attendance

            $nightCheck= DB::table('hr_attendance AS att')
            ->select([
                "att.in_time",
                "att.att_id"
            ])
            ->join('hr_shift AS s', 's.hr_shift_code', 'att.hr_shift_code')
            ->where('s.hr_shift_night_flag', 1)
            ->where('att.as_id', $temp->Userid)
            ->orderBy('att.att_id', "DESC")
            ->first();


            if($nightCheck){

                $diff= (date("Y-m-d H:i:s", strtotime($temp->CheckTime)))->diffInHours(date("Y-m-d H:i:s", strtotime($nightCheck->in_time)));

                if($diff<=14){
                    Attendace::where('as_id', $temp->Userid)
                    ->where('att_id', $nightCheck->att_id)
                    ->update([
                        "out_time"=> $temp->CheckTime
                    ]);
                }

            }
            else{

                $exists= DB::table('hr_attendance AS att')
                ->where('att.as_id', $temp->Userid)
                ->whereDate('att.in_time', date("Y-m-d", strtotime($temp->CheckTime)))
                ->orderBy('att.att_id', "DESC")
                ->first();

                if($exists)
                {
                    Attendace::where('att_id', $exists->att_id)
                    ->update([
                        "out_time" => $temp->CheckTime
                    ]);
                }
                else
                {
                    Attendace::insert([
                        "as_id" => $temp->Userid,
                        "in_time" => $temp->CheckTime,
                        "hr_shift_code" => $temp->hr_shift_code
                    ]);
                }
            }
        }

        return back()
        ->with('success', "Attendance Processed!");
    }

    //Check in Out Processing for AQL
    private function aqlCheckInOutProcess(){

        $checkLogId= DB::table('hr_att_logid')
        ->orderBy('id', "DESC")
        ->pluck('Logid')
        ->first();


        if($checkLogId)
        {

            $allPunch= DB::table('checkinout')->where('Logid', '>', $checkLogId)->orderBy('Logid', 'ASC')->get();
            $last_id=$checkLogId;
            foreach($allPunch AS $singlePunch)
            {
                $datetime= $singlePunch->CheckTime;
                $as_id= $singlePunch->Userid;

                $month= date('m', strtotime($datetime));
                $year= date('Y', strtotime($datetime));

                $shift_roast= DB::table("hr_shift_roaster AS sr")
                ->where('sr.shift_roaster_month', $month)
                ->where('sr.shift_roaster_year', $year)
                ->orderBy('shift_roaster_id', "DESC")
                ->where("sr.shift_roaster_user_id", $as_id)
                ->first();

                if($shift_roast){

                    $day= date('j', strtotime($datetime));
                    if($day==1) $shift_code= $shift_roast->day_1;
                    if($day==2) $shift_code= $shift_roast->day_2;
                    if($day==3) $shift_code= $shift_roast->day_3;
                    if($day==4) $shift_code= $shift_roast->day_4;
                    if($day==5) $shift_code= $shift_roast->day_5;
                    if($day==6) $shift_code= $shift_roast->day_6;
                    if($day==7) $shift_code= $shift_roast->day_7;
                    if($day==8) $shift_code= $shift_roast->day_8;
                    if($day==9) $shift_code= $shift_roast->day_9;
                    if($day==10) $shift_code= $shift_roast->day_10;
                    if($day==11) $shift_code= $shift_roast->day_11;
                    if($day==12) $shift_code= $shift_roast->day_12;
                    if($day==13) $shift_code= $shift_roast->day_13;
                    if($day==14) $shift_code= $shift_roast->day_14;
                    if($day==15) $shift_code= $shift_roast->day_15;
                    if($day==16) $shift_code= $shift_roast->day_16;
                    if($day==17) $shift_code= $shift_roast->day_17;
                    if($day==18) $shift_code= $shift_roast->day_18;
                    if($day==19) $shift_code= $shift_roast->day_19;
                    if($day==20) $shift_code= $shift_roast->day_20;
                    if($day==21) $shift_code= $shift_roast->day_21;
                    if($day==22) $shift_code= $shift_roast->day_22;
                    if($day==23) $shift_code= $shift_roast->day_23;
                    if($day==24) $shift_code= $shift_roast->day_24;
                    if($day==25) $shift_code= $shift_roast->day_25;
                    if($day==26) $shift_code= $shift_roast->day_26;
                    if($day==27) $shift_code= $shift_roast->day_27;
                    if($day==28) $shift_code= $shift_roast->day_28;
                    if($day==29) $shift_code= $shift_roast->day_29;
                    if($day==30) $shift_code= $shift_roast->day_30;
                    if($day==31) $shift_code= $shift_roast->day_31;

                    if($shift_code){
                    //check night flag attendance
                        $nightCheck= DB::table('hr_attendance AS att')
                        ->select([
                            "att.in_time",
                            "att.att_id"
                        ])
                        ->join('hr_shift AS s', 's.hr_shift_code', 'att.hr_shift_code')
                        ->where('s.hr_shift_night_flag', 1)
                        ->where('att.as_id', $as_id)
                        ->orderBy('att.att_id', "DESC")
                        ->first();

                        if($nightCheck){
                    //  $diff= ($datetime)->diffInHours($nightCheck->in_time);
                            $diff= (date("Y-m-d H:i:s", strtotime($datetime)))->diffInHours(date("Y-m-d H:i:s", strtotime($nightCheck->in_time)));
                            if($diff<=14){
                                Attendace::where('as_id', $as_id)
                                ->where('att_id', $nightCheck->att_id)
                                ->update([
                                    "out_time"=> $datetime
                                ]);
                            }
                        }
                        else{
                            $exists= DB::table('hr_attendance AS att')
                            ->where('att.as_id', $as_id)
                            ->whereDate('att.in_time', date("Y-m-d", strtotime($datetime)))
                            ->orderBy('att.att_id', "DESC")
                            ->first();

                            if($exists)
                            {
                                Attendace::where('att_id', $exists->att_id)
                                ->update([
                                    "out_time" => $datetime
                                ]);
                            }
                            else
                            {
                                Attendace::insert([
                                    "as_id" => $as_id,
                                    "in_time" => $datetime,
                                    "hr_shift_code" => $shift_code
                                ]);
                            }
                        }
                    }
                }


                $last_id=     $singlePunch->Logid;
            }
            DB::table('hr_att_logid')->insert(['Logid'=> $last_id]);
        }
        else
        {
            $allPunch= DB::table('checkinout')->orderBy('Logid', 'ASC')->get();
            $last_id=0;
            foreach($allPunch AS $singlePunch)
            {
                $datetime= $singlePunch->CheckTime;
                $as_id= $singlePunch->Userid;

                $month= date('m', strtotime($datetime));
                $year= date('Y', strtotime($datetime));

                $shift_roast= DB::table("hr_shift_roaster AS sr")
                ->where('sr.shift_roaster_month', $month)
                ->where('sr.shift_roaster_year', $year)
                ->orderBy('shift_roaster_id', "DESC")
                ->where("sr.shift_roaster_user_id", $as_id)
                ->first();

                if($shift_roast){

                    $day= date('j', strtotime($datetime));
                    if($day==1) $shift_code= $shift_roast->day_1;
                    if($day==2) $shift_code= $shift_roast->day_2;
                    if($day==3) $shift_code= $shift_roast->day_3;
                    if($day==4) $shift_code= $shift_roast->day_4;
                    if($day==5) $shift_code= $shift_roast->day_5;
                    if($day==6) $shift_code= $shift_roast->day_6;
                    if($day==7) $shift_code= $shift_roast->day_7;
                    if($day==8) $shift_code= $shift_roast->day_8;
                    if($day==9) $shift_code= $shift_roast->day_9;
                    if($day==10) $shift_code= $shift_roast->day_10;
                    if($day==11) $shift_code= $shift_roast->day_11;
                    if($day==12) $shift_code= $shift_roast->day_12;
                    if($day==13) $shift_code= $shift_roast->day_13;
                    if($day==14) $shift_code= $shift_roast->day_14;
                    if($day==15) $shift_code= $shift_roast->day_15;
                    if($day==16) $shift_code= $shift_roast->day_16;
                    if($day==17) $shift_code= $shift_roast->day_17;
                    if($day==18) $shift_code= $shift_roast->day_18;
                    if($day==19) $shift_code= $shift_roast->day_19;
                    if($day==20) $shift_code= $shift_roast->day_20;
                    if($day==21) $shift_code= $shift_roast->day_21;
                    if($day==22) $shift_code= $shift_roast->day_22;
                    if($day==23) $shift_code= $shift_roast->day_23;
                    if($day==24) $shift_code= $shift_roast->day_24;
                    if($day==25) $shift_code= $shift_roast->day_25;
                    if($day==26) $shift_code= $shift_roast->day_26;
                    if($day==27) $shift_code= $shift_roast->day_27;
                    if($day==28) $shift_code= $shift_roast->day_28;
                    if($day==29) $shift_code= $shift_roast->day_29;
                    if($day==30) $shift_code= $shift_roast->day_30;
                    if($day==31) $shift_code= $shift_roast->day_31;

                    if($shift_code){
                    //check night flag attendance
                        $nightCheck= DB::table('hr_attendance AS att')
                        ->select([
                            "att.in_time",
                            "att.att_id"
                        ])
                        ->join('hr_shift AS s', 's.hr_shift_code', 'att.hr_shift_code')
                        ->where('s.hr_shift_night_flag', 1)
                        ->where('att.as_id', $as_id)
                        ->orderBy('att.att_id', "DESC")
                        ->first();

                        if($nightCheck){
                            $diff= ($datetime)->diffInHours($nightCheck->in_time);
                            if($diff<=14){
                                Attendace::where('as_id', $as_id)
                                ->where('att_id', $nightCheck->att_id)
                                ->update([
                                    "out_time"=> $datetime
                                ]);
                            }
                        }
                        else{
                            $exists= DB::table('hr_attendance AS att')
                            ->where('att.as_id', $as_id)
                            ->whereDate('att.in_time', date("Y-m-d", strtotime($datetime)))
                            ->orderBy('att.att_id', "DESC")
                            ->first();

                            if($exists)
                            {
                                Attendace::where('att_id', $exists->att_id)
                                ->update([
                                    "out_time" => $datetime
                                ]);
                            }
                            else
                            {
                                Attendace::insert([
                                    "as_id" => $as_id,
                                    "in_time" => $datetime,
                                    "hr_shift_code" => $shift_code
                                ]);
                            }
                        }
                    }
                }


                $last_id=     $singlePunch->Logid;
            }
            DB::table('hr_att_logid')->insert(['Logid'=> $last_id]);

        }

    }
}
