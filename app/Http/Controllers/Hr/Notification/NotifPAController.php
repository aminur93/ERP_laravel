<?php

namespace App\Http\Controllers\Hr\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Appraisal;
use DB, DataTables,Validator;

class NotifPAController extends Controller
{
    public function AppraisalList(){
    	return view('hr/notification/performance_appraisal_list');
    }
    public function AppraisalData(){ 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_performance_appraisal AS pa')
            ->where('pa.hr_pa_status', '=', 0)
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'pa.id',
                'pa.hr_pa_as_id',
                'b.as_name',
                'des.hr_designation_name',
                'dep.hr_department_name'
            )
            ->leftJoin('hr_as_basic_info AS b', 'pa.hr_pa_as_id', '=', 'b.associate_id')
            ->leftJoin('hr_designation AS des', 'des.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin('hr_department AS dep', 'dep.hr_department_id', '=', 'b.as_department_id')
            ->orderBy('pa.id','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/notification/appraisal/appraisal_approve/'.$data->id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Approve\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no','action'])
            ->toJson();
    }
    public function AppraisalView($id){
        $appraisal= DB::table('hr_performance_appraisal AS pa')
                    ->where('pa.id', '=', $id)
                    ->select(
                        'pa.*',
                        'b.as_name',
                        'des.hr_designation_name',
                        'dep.hr_department_name'
                    )
                    ->leftJoin('hr_as_basic_info AS b', 'pa.hr_pa_as_id', '=', 'b.associate_id')
                    ->leftJoin('hr_designation AS des', 'des.hr_designation_id', '=', 'b.as_designation_id')
                    ->leftJoin('hr_department AS dep', 'dep.hr_department_id', '=', 'b.as_department_id')
                    ->first();

                    if( $appraisal == null){
                        return view('hr/notification/performance_appraisal_list')
                            ->with('error', 'No record found!!');
                    }
                    else{
                        return view('hr/notification/appraisal_approve', compact('appraisal'));
                    }
    }
    public function AppraisalStatus(Request $request){

        $validator= Validator::make($request->all(),[
            'hr_pa_remarks_dept_head' => 'max:255',
            'hr_pa_remarks_hr_head' => 'max:255',
            'hr_pa_remarks_incharge' => 'max:255',
            'hr_pa_remarks_ceo' => 'max:255'
        ]);
        if($validator->fails())
        {
            return back()
                ->withInput()
                ->with('error', 'Error! Please input correct information!!');
        }
        else
        {
        if($request->has('approve')){
            DB::table('hr_performance_appraisal')->where('hr_performance_appraisal.id', '=', $request->id)
                ->update([
                    'hr_pa_status' => '1',
                    'hr_pa_remarks_dept_head' => $request->hr_pa_remarks_dept_head,
                    'hr_pa_remarks_hr_head' => $request->hr_pa_remarks_hr_head,
                    'hr_pa_remarks_incharge' => $request->hr_pa_remarks_incharge,
                    'hr_pa_remarks_ceo' => $request->hr_pa_remarks_ceo
                ]);

            return redirect()->intended('hr/notification/appraisal/performance_appraisal_list')
                    ->with('success','Performance Appraisal Approved Successfully');
        }
        else{
             DB::table('hr_performance_appraisal')->where('hr_performance_appraisal.id', '=', $request->id)
                ->update([
                    'hr_pa_status' => 2,
                    'hr_pa_remarks_dept_head' => $request->hr_pa_remarks_dept_head,
                    'hr_pa_remarks_hr_head' => $request->hr_pa_remarks_hr_head,
                    'hr_pa_remarks_incharge' => $request->hr_pa_remarks_incharge,
                    'hr_pa_remarks_ceo' => $request->hr_pa_remarks_ceo
                ]);

            return redirect()->intended('hr/notification/appraisal/performance_appraisal_list')
                    ->with('success','Performance Appraisal Rejected Successfully');
        }
    }
    }
}
