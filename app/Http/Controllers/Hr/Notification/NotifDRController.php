<?php

namespace App\Http\Controllers\Hr\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Disciplinary;
use DB, DataTables;

class NotifDRController extends Controller
{
    public function DisciplinaryRecordList(){
    	return view('hr/notification/disciplinary_record_list');
    }
    public function DisciplinaryRecordData(){ 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_dis_rec AS dr')
            ->where('dis_re_status','=',0)
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'dr.dis_re_id',
                'dr.dis_re_as_id',
                'b.as_name',
                'dr.dis_re_date',
                'issue.hr_griv_issue_name AS reason',
                'sp.as_name AS supervisor',
                'step.hr_griv_steps_name as step',
                'dr.dis_re_doe_from',
                'dr.dis_re_doe_to'
            )
            ->leftJoin('hr_as_basic_info AS b', 'dr.dis_re_as_id', '=', 'b.associate_id')
            ->leftJoin('hr_as_basic_info AS sp', 'dr.dis_re_sup_id', '=', 'sp.associate_id')
            ->leftJoin('hr_designation AS des', 'des.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin('hr_department AS dep', 'dep.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_grievance_issue AS issue', 'issue.hr_griv_issue_id', '=', 'dr.dis_re_reason')
            ->leftJoin('hr_grievance_steps AS step', 'step.hr_griv_steps_id', '=', 'dr.dis_re_ac_step_id')
            ->orderBy('dr.dis_re_id','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/notification/record/disciplinary_record_approve/'.$data->dis_re_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no','action'])
            ->toJson();
    }
    public function DisciplinaryRecordView($id){
        
        $record= DB::table('hr_dis_rec as dr')
                    ->where('dis_re_id', '=', $id)
                    ->select(
                        'dr.*',
                        'b.as_name',
                        'issue.hr_griv_issue_name AS reason',
                        'sp.as_name AS supervisor',
                        'step.hr_griv_steps_name as step',
                        'des.hr_designation_name',
                        'dep.hr_department_name'
                    )
                    ->leftJoin('hr_as_basic_info AS b', 'dr.dis_re_as_id', '=', 'b.associate_id')
                    ->leftJoin('hr_as_basic_info AS sp', 'dr.dis_re_sup_id', '=', 'sp.associate_id')
                    ->leftJoin('hr_designation AS des', 'des.hr_designation_id', '=', 'b.as_designation_id')
                    ->leftJoin('hr_department AS dep', 'dep.hr_department_id', '=', 'b.as_department_id')
                    ->leftJoin('hr_grievance_issue AS issue', 'issue.hr_griv_issue_id', '=', 'dr.dis_re_reason')
                    ->leftJoin('hr_grievance_steps AS step', 'step.hr_griv_steps_id', '=', 'dr.dis_re_ac_step_id')
                    ->first();

        if($record == null){
            return view('hr/notification/disciplinary_record_list')
            ->with('error', 'No record found!!');
        }
        else{
            return view('hr/notification/disciplinary_record_approve', compact('record'));
        }
    }
    public function DisciplinaryRecordStatus(Request $request){
        if ($request->has('approve'))
        { 
            DB::table('hr_dis_rec')->where('hr_dis_rec.dis_re_id', '=', $request->dis_re_id)
                ->update(['dis_re_status' => 1]);

            return redirect()->intended('hr/notification/record/disciplinary_record_list')
                    ->with('success','Disciplinary Record Approved Successfully');
        }
        else
        {
            DB::table('hr_dis_rec')->where('hr_dis_rec.dis_re_id', '=', $request->dis_re_id)
                ->update(['dis_re_status' => 2]);

            return redirect()->intended('hr/notification/record/disciplinary_record_list')
                    ->with('success','Disciplinary Record Rejected Successfully');
        }


    }
}
