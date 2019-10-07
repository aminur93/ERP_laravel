<?php

namespace App\Http\Controllers\Hr\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\LoanApplication;
use DB, DataTables;

class NotifLeaveController extends Controller
{
    public function LeaveList(){
    	return view('hr/notification/leave_app_list');
    }

    public function LeaveData(){ 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_leave AS l')
            ->where('l.leave_status', '=', '0')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'l.id',
                'l.leave_ass_id',
                'b.as_name',
                'l.leave_type',
                DB::raw("CONCAT(l.leave_from, ' to ', l.leave_to) AS leave_duration"),
                'l.leave_supporting_file',
                'l.leave_comment'
            )
            ->leftJoin('hr_as_basic_info AS b', 'l.leave_ass_id', '=', 'b.associate_id')
            ->orderBy('l.id','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/notification/leave/leave_approve/'.$data->id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no','action'])
            ->toJson();
    }
    public function LeaveView($id){

        $leave= DB::table('hr_leave')
            ->where('hr_leave.id', '=', $id)
            ->first();

        if($leave == null){
            return view('hr/notification/leave_app_list')
                ->with('error', 'No record found!!');
        }
        else{
            return view('hr/notification/leave_approve', compact('leave'));
        }

    }
    public function LeaveStatus(Request $request)
    {
        if ($request->has('approve'))
        { 
            DB::table('hr_leave')->where('hr_leave.id', '=', $request->id)
                ->update(['leave_status' => 1]);

            return redirect()->intended('hr/notification/leave/leave_app_list')
                    ->with('success','Leave Approved Successfully');
        }
        else
        {
            DB::table('hr_leave')->where('hr_leave.id', '=', $request->id)
                ->update(['leave_status' => 2]);

            return redirect()->intended('hr/notification/leave/leave_app_list')
                    ->with('success','Leave Rejected Successfully');
        }

    } 

}

