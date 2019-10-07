<?php

namespace App\Http\Controllers\Hr\Performance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,DataTables,Validator, ACL;

class AppraisalListController extends Controller
{
    public function appraisalList()
    {
        ACL::check(["permission" => "hr_performance_list"]);
        #-----------------------------------------------------------# 
    	return view('hr/performance/appraisal_list');
    }

    public function appraisalListData(Request $request)
    {

        ACL::check(["permission" => "hr_performance_list"]);
        #-----------------------------------------------------------# 
        if(empty($request->hr_pa_as_id) && empty($request->pa_from) && empty($request->pa_to)){
        $data = DB::table('hr_performance_appraisal AS pa')
            ->select([
               'pa.id',
               'pa.hr_pa_as_id',
               'pa.hr_pa_status',
               'pa.hr_pa_report_from',
               'pa.hr_pa_report_to',
               'pa.hr_pa_primary_assesment',
               'b.as_name',
               'd.hr_department_name'
            ])
            ->leftJoin('hr_as_basic_info AS b', 'pa.hr_pa_as_id', '=', 'b.associate_id')
            ->leftJoin('hr_department AS d', 'd.hr_department_id', '=', 'b.as_department_id')
              ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->orderBy('pa.hr_pa_report_from','desc')
            ->get();
        }
        //if associate selected with from and to 
        if(!empty($request->hr_pa_as_id) && !empty($request->pa_from) && !empty($request->pa_to)){
            $data = DB::table('hr_performance_appraisal AS pa')
            ->select([
               'pa.id',
               'pa.hr_pa_as_id',
               'pa.hr_pa_status',
               'pa.hr_pa_report_from',
               'pa.hr_pa_report_to',
               'pa.hr_pa_primary_assesment',
               'b.as_name',
               'd.hr_department_name'
            ])
            ->whereBetween('hr_pa_report_from', [$request->pa_from, $request->pa_to])
            ->where('hr_pa_as_id', '=', $request->hr_pa_as_id)
            ->leftJoin('hr_as_basic_info AS b', 'pa.hr_pa_as_id', '=', 'b.associate_id')
            ->leftJoin('hr_department AS d', 'd.hr_department_id', '=', 'b.as_department_id')
            ->orderBy('pa.hr_pa_report_from','desc')
            ->get();
        }

         //if associate not selected only from and to 

        if (empty($request->hr_pa_as_id) && !empty($request->pa_from) && !empty($request->pa_to)){
            $data = DB::table('hr_performance_appraisal AS pa')
            ->select([
               'pa.id',
               'pa.hr_pa_as_id',
               'pa.hr_pa_status',
               'pa.hr_pa_report_from',
               'pa.hr_pa_report_to',
               'pa.hr_pa_primary_assesment',
               'b.as_name',
               'd.hr_department_name'
            ])
            ->whereBetween('hr_pa_report_from', [$request->pa_from, $request->pa_to])
            ->leftJoin('hr_as_basic_info AS b', 'pa.hr_pa_as_id', '=', 'b.associate_id')
            ->leftJoin('hr_department AS d', 'd.hr_department_id', '=', 'b.as_department_id')
            ->orderBy('pa.hr_pa_report_from','desc')
            ->get();
        }

        return DataTables::of($data) 
            ->addColumn('hr_pa_primary_assesment', function($data) {
                if($data->hr_pa_primary_assesment == 0)
                	return "DOES NOT MEETS EXPECTATION";
                if($data->hr_pa_primary_assesment == 1)
                	return "PARTIALLY MEETS EXPECATATION";
                if($data->hr_pa_primary_assesment == 2)
                	return "MEETS EXPECTATION SATISFACTORILY";
                if($data->hr_pa_primary_assesment == 3)
                	return "EXCEEDS SATISFACTIONS";
            })
            ->addColumn('appraisal_duration', function($data){
                $start= (!empty($data->hr_pa_report_from)? (date('d-M-Y',strtotime($data->hr_pa_report_from))):null);
                $to= (!empty($data->hr_pa_report_to)? (date('d-M-Y', strtotime($data->hr_pa_report_to))):null);
                $appraisal_duration= $start. " to ".$to;
                return $appraisal_duration;
            })
            ->addColumn('hr_pa_status', function ($data) {
               if ($data->hr_pa_status == 1)
                  return  "<span class='label label-success label-xs'> Approved
                    </span>";
               else if ($data->hr_pa_status == 2)
                  return  "<span  class='label label-danger label-xs'> Declined
                    </span>";
               else
                  return  "<span class='label label-primary label-xs'>Applied
                    </span>";
            })
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/performance/appraisal_approve/'.$data->id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['hr_pa_primary_assesment', 'hr_pa_status', 'action'])
            ->toJson();
   }


   public function AppraisalView($id)
   {
        ACL::check(["permission" => "hr_performance_list"]);
        #-----------------------------------------------------------# 

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
                        return view('hr/performance/appraisal_list')
                            ->with('error', 'No record found!!');
                    }
                    else{
                        return view('hr/performance/appraisal_approve', compact('appraisal'));
                    }
    }


    public function AppraisalStatus(Request $request)
    {

        ACL::check(["permission" => "hr_performance_list"]);
        #-----------------------------------------------------------# 

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

            return redirect()->intended('hr/performance/appraisal_list')
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

            return redirect()->intended('hr/performance/appraisal_list')
                    ->with('success','Performance Appraisal Rejected Successfully');
        }
    }
    }
}
