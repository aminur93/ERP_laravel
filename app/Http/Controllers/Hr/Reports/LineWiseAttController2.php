<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Line;
use App\Helpers\Attendance2;
use DB, PDF;

class LineWiseAttController2 extends Controller
{
    public function lineWiseAtt(Request $request){
    	// dd($request->all());
        $id=$request->line_id;
    	$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
        DB::statement(DB::raw('SET @sl:=0;'));
    	$info= DB::table('hr_as_basic_info AS b')
    			->where('as_unit_id', $request->unit_id)
    		    //->where('as_line_id', $request->line_id)
                ->where(function($condition) use ($id){
                      if (!empty($id)) 
                      {
                        $condition->where('as_line_id', $id);
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
    		$data= Attendance2::track($employees->associate_id, $request->report_date, $request->report_date);
             $employees->in_time= $data->in_time;
             $employees->out_time= $data->out_time;
             $employees->oth= $data->overtime_time;
             $employees->otm= $data->overtime_minutes;
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
    	
    	$line_name= DB::table('hr_line')
    				->where('hr_line_id', $request->line_id)
    				->pluck('hr_line_name')
    				->first();
    	$report_date= $request->report_date;
        $lineList= DB::table('hr_line')
                    ->where('hr_line_unit_id', $request->unit_id)
                    ->pluck('hr_line_name', 'hr_line_id');

        // generate pdf
        if ($request->get('pdf') == true) {   
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
        }

    	return view('hr/reports/line_wise_att2', compact('unitList', 'info','departments', 'unit_name', 'line_name', 'report_date','absent','present', 'lineList'));

    }
//////
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
}
