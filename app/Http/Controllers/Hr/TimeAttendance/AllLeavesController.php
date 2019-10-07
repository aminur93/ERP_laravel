<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Leave;
use DB,DataTables, ACL;

class AllLeavesController extends Controller
{
   public function allLeaves()
   {
        ACL::check(["permission" => "hr_time_leaves"]);
        #--------------------------------------------------------#  
   	    return view('hr/timeattendance/all_leaves');
   }

   public function allLeavesData()
   {
      ACL::check(["permission" => "hr_time_leaves"]);
      #-----------------------------------------------------------# 

        $data = DB::table('hr_leave AS l')
            ->select([
               'l.id',
               'l.leave_ass_id',
               'b.as_name',
               'l.leave_type',
               'l.leave_status',
               'l.leave_from',
               'l.leave_to'
            ])
            ->leftJoin('hr_as_basic_info AS b', 'l.leave_ass_id', '=', 'b.associate_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->orderBy('l.leave_from','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('leave_duration', function ($data) {
             $start= (!empty($data->leave_from)?(date("d-M-Y", strtotime($data->leave_from))):null);
             $end= (!empty($data->leave_to)?(date("d-M-Y", strtotime($data->leave_to))):null);
             $leave_duration= $start. " to " . $end;
             return $leave_duration;
            }) 
            ->addColumn('leave_status', function ($data) {
               if ($data->leave_status == 1)
                  return  "<span class='label label-success label-xs'> Approved
                    </span>";
               else if ($data->leave_status == 2)
                  return  "<span  class='label label-danger label-xs'> Declined
                    </span>";
               else
                  return  "<span class='label label-primary label-xs'>Applied
                    </span>";
            })  
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/timeattendance/leave_approve/'.$data->id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no','leave_status','action'])
            ->toJson();
   
   }


   public function LeaveView($id){

      ACL::check(["permission" => "hr_time_leaves"]);
      #-----------------------------------------------------------#

    $previous_leaves= DB::table('hr_leave AS l')->where('l.leave_ass_id', '=',"XTQGMOKVJI")->get();


        $leave= DB::table('hr_leave AS l')
            ->where('l.id', '=', $id)
            ->first();

        if($leave == null){
            return view('hr/timeattendance/all_leave')
                ->with('error', 'No record found!!');
        }
        else{
            return view('hr/timeattendance/leave_approve', compact('leave', 'previous_leaves'));
        }

    }

    public function LeaveStatus(Request $request)
    {
      ACL::check(["permission" => "hr_time_leaves"]);
      #-----------------------------------------------------------#
      
        if ($request->has('approve'))
        { 
            DB::table('hr_leave AS l')->where('l.id', '=', $request->id)
                ->update([
                  'leave_comment' => $request->leave_comment,
                  'leave_updated_at' => date('Y-m-d H:i:s'),
                  'leave_updated_by' => auth()->user()->associate_id,
                  'leave_status' => 1
               ]);

            return redirect()->intended('hr/timeattendance/all_leaves')
                    ->with('success','Leave Approved Successfully');
        }
        else
        {
            DB::table('hr_leave AS l')->where('l.id', '=', $request->id)
                ->update([
                  'leave_comment' => $request->leave_comment,
                  'leave_updated_at' => date('Y-m-d H:i:s'),
                  'leave_updated_by' => "XTQGMOKVJI",
                  'leave_status' => 2
               ]);

            return redirect()->intended('hr/timeattendance/all_leaves')
                    ->with('success','Leave Rejected Successfully');
        }

    } 
}
