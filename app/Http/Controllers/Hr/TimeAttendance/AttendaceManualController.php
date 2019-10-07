<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\AttendaceManual;
use App\Models\Hr\Attendace;
use App\Models\Hr\Shift;
use App\Models\Hr\Unit;
use App\Models\Hr\Employee;
use Validator, Auth, ACL, DB, DataTables;

class AttendaceManualController extends Controller
{
    # show form
    public function showForm()
    {
        
        ACL::check(["permission" => "hr_time_manual_att"]);
        #-----------------------------------------------------------# 

        $unitList  = Unit::where('hr_unit_status', '1')->whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
        $unitList->put(1001,  "Common Unit");
        
        
        return view('hr.timeattendance.attendance_manual', compact('unitList'));
    }

    # post data
    public function saveData(Request $request)
    {
                
        ACL::check(["permission" => "hr_time_manual_att"]);
        #-----------------------------------------------------------# 
        
        $validator = Validator::make($request->all(),[
            'hr_att_as_id'      => 'required|max:10|min:10',
            'hr_att_date'       => 'required|date',
            'hr_att_start_time' => 'max:10',
            'hr_att_end_time'   => 'max:10',
            'remarks'           => 'max:45'
        ]);

        if ($validator->fails())
        {
            return back()
                    ->withErrors($validator)
                    ->with('error', 'Please fillup all required fields!.');
        }
        else
        {
            // format date time
            $date = (!empty($request->hr_att_date)?date('Y-m-d', strtotime($request->hr_att_date)):null);
            $startTime = (!empty($request->hr_att_start_time)?date('H:i:s', strtotime($request->hr_att_start_time)):null);
            $endTime = (!empty($request->hr_att_end_time)?date('H:i:s', strtotime($request->hr_att_end_time)):null);
            if($startTime){
            $in = date('Y-m-d H:i:s', strtotime("$date $startTime"));
            }
            else{
                $in = null;
            }
            if($endTime){
            $out = date('Y-m-d H:i:s', strtotime("$date $endTime"));
            }
            else{
                $out= null;
            }

           //dd($request->all());

            // for as_id
            $associate= DB::table('hr_as_basic_info')
                ->where('associate_id', $request->hr_att_as_id)
                ->select([
                    'as_id',
                    'associate_id',
                    'as_unit_id'
                ])
                ->first();

            $unit= $associate->as_unit_id;
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
            // checking existing punch
            $ispunched = DB::table($tableName)
                        ->where('a.as_id', $associate->as_id)
                        ->whereDate('a.in_time', $date)
                        ->select('a.*')
                        ->first();

            // geting shift code
            $day_input= date('d', strtotime($date));
            $day= "day_".ltrim($day_input,'0');
            $shift = DB::table('hr_shift_roaster')
                ->where('shift_roaster_associate_id', $request->hr_att_as_id)
                ->pluck($day)
                ->first();

            if($shift == null){
                DB::table('hr_as_basic_info AS b')
                        ->where('b.associate_id', $request->hr_att_as_id)
                        ->leftJoin('hr_shift AS s', 's.hr_shift_id', 'b.as_shift_id')
                        ->pluck('s.hr_shift_code')
                        ->first();
            }
                
            if($shift == null){
                return back()
                ->with('error', "No shift assigned for this associate!!");
            }
            else{
                $shift_code= $shift;
            }

            $user= Auth::user()->associate_id;
            $up_date= date('Y:m:d H:i:s');

            if($ispunched == null)
            {
                $tableName = substr($tableName, 0, -5);

                DB::table($tableName)
                    ->insert([
                        'as_id' => $associate->as_id,
                        'in_time' => $in,
                        'out_time' => $out,
                        'hr_shift_code' => $shift_code,
                        'remarks' => $request->remarks,
                        'updated_by' => $user,
                        'updated_at' => $up_date
                    ]);
                return back()
                    ->with('success', "Attendance Added Successfully!");            
            }
            else 
            {

                if($in==null)
                    $in= $ispunched->in_time;
                if($out==null)
                    $out= $ispunched->out_time;

            DB::table($tableName)
                ->where('a.as_id', $associate->as_id)
                ->whereDate('a.in_time', $date)
                ->update([
                    'a.in_time'       =>  $in,
                    'a.out_time'      =>  $out,
                    'a.hr_shift_code' =>  $shift_code,
                    'a.remarks' =>  $request->remarks,
                    'a.updated_by' =>  $user,
                    'a.updated_at' =>  $up_date
                ]);
                return back()
                    ->with('success', "Attendance Updated Successfully!");
            }
        }

    }
    public function getExistingPunch(Request $request){
        ACL::check(["permission" => "hr_time_manual_att"]);
        #-----------------------------------------------------------# 
        $associate= DB::table('hr_as_basic_info')
                ->where('associate_id', $request->id)
                ->select([
                    'as_id',
                    'associate_id',
                    'as_unit_id'
                ])
                ->first();

        $unit= $associate->as_unit_id;

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

        $data = array();
        // if any punch of today exists then show it  
        $ifexists= DB::table($tableName)
                    ->where('a.as_id', $associate->as_id)
                    ->whereDate('a.in_time', $request->date)
                    ->select([
                        'a.as_id',
                        'a.in_time',
                        'a.out_time'
                    ]);

        if ($ifexists->exists())
        { 
            $data['status'] = true;

            //if in_time exist then show in_time else in_time=null 
            if($ifexists->first()->in_time){
                $data['in_time'] = date("H:i", strtotime($ifexists->first()->in_time));
            }
            else{
                $data['in_time'] = null;
            }
            //if out_time exist then show out_time else out_time=null 
            if($ifexists->first()->out_time)
                $data['out_time'] = date("H:i", strtotime($ifexists->first()->out_time));
            else
                $data['out_time']= null;
        }
        else
        {
            $data['status'] = false;
        }
        return $data;
    }

    public function manualAttLog(){
        return view('hr/timeattendance/attendance_manual_log');
    }
    public function manualAttLogData(){
        DB::statement(DB::raw("SET @s:=0"));
        $data= DB::select("  
            SELECT @s:=@s+1 AS serial_no, a.*,  b.as_name, b.associate_id 
            FROM hr_attendance AS a
            LEFT JOIN hr_as_basic_info AS b ON b.as_id = a.as_id
            WHERE a.remarks != '' OR a.remarks != NULL
        ");
        // dd($data);

        return Datatables::of($data)
            ->editColumn('in_time', function($data){
                if($data->in_time!=null)
                    return date("H:i", strtotime($data->in_time));
                else
                    return null;
            })
            ->editColumn('out_time', function($data){
                if($data->out_time!=null)
                    return date("H:i", strtotime($data->out_time));
                else
                    return null;
            })
            ->toJson();
    }

}
