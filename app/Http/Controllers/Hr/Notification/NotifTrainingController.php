<?php

namespace App\Http\Controllers\Hr\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Training;
use App\Models\Hr\TrainingAssign;
use App\Models\Hr\TrainingNames;
use DB, DataTables;

class NotifTrainingController extends Controller
{
    public function TrainingList(){
    	return view('hr/notification/training_list');
    }
    public function TrainingData(){ 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_training_assign AS ta')
        ->where('tr_as_status', '=', 0)
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'ta.tr_as_id',
                'ta.tr_as_ass_id',
                'b.as_name',
                'tn.hr_tr_name',
                't.tr_trainer_name',
                DB::raw("CONCAT(t.tr_start_date, ' to ',  t.tr_end_date) as date"),
                DB::raw("CONCAT(t.tr_start_time, ' to ',  t.tr_end_time) as time")
            )
            ->leftJoin('hr_as_basic_info AS b', 'ta.tr_as_ass_id', '=', 'b.associate_id')
            ->leftJoin('hr_training_names AS tn', 'ta.tr_as_tr_id', '=', 'tn.hr_tr_name_id')
            ->leftJoin('hr_training AS t', 'ta.tr_as_tr_id', '=', 't.tr_as_tr_id')
            ->orderBy('ta.tr_as_id','desc')
            ->get();

        return DataTables::of($data) 
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/notification/training/training_approve/'.$data->tr_as_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Approve\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no','action'])
            ->toJson();
    }
    public function TrainingView($id){
        $training= DB::table('hr_training_assign AS ta')
                    ->where('ta.tr_as_id','=',$id)
                    ->select(
                        'ta.*',
                        't.tr_trainer_name',
                        't.tr_description',
                        't.tr_start_date',
                        'b.as_name',
                        'tn.hr_tr_name',
                        DB::raw("CONCAT(t.tr_start_date, ' to ',  t.tr_end_date) as date"),
                        DB::raw("CONCAT(t.tr_start_time, ' to ',  t.tr_end_time) as time")
                        
                    )
                    ->leftJoin('hr_training AS t', 'ta.tr_as_tr_id', '=', 't.tr_as_tr_id')
                    ->leftJoin('hr_as_basic_info AS b', 'ta.tr_as_ass_id', '=', 'b.associate_id')
                    ->leftJoin('hr_training_names AS tn', 'ta.tr_as_tr_id', '=', 'tn.hr_tr_name_id')
                    ->first();

           
            if( $training == null){
                return view('hr/notification/training_list')
                    ->with('error', 'No record found!!');
            }
            else{
                return view('hr/notification/training_approve', compact('training'));
            }

    }
    public function TrainingStatus(Request $request){
        if ($request->has('approve'))
        { 
            DB::table('hr_training_assign')->where('hr_training_assign.tr_as_id', '=', $request->tr_as_id)
                ->update(['tr_as_status' => 1]);

            return redirect()->back()->with('success','Training Approved Successfully');
        }
        else
        {
            DB::table('hr_training_assign')->where('hr_training_assign.tr_as_id', '=', $request->tr_as_id)
                ->update(['tr_as_status' => 2]);

            return redirect()->intended('hr/notification/training/training_list')
                    ->with('success','Training Rejected Successfully');
        }
    }
}
