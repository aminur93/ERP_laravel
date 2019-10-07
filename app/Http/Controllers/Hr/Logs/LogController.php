<?php

namespace App\Http\Controllers\Hr\Logs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\DesignationUpdateLog;
use App\Models\Hr\Designation;
use App\Models\Hr\Employee;
use DB, DataTables;

class LogController extends Controller
{
    public function designationLog(){
    	return view('hr/logs/designation_update_log');
    }
    public function designationLogData(){
    	DB::statement(DB::raw("SET @sl:=0;"));
    	$data= DB::table("hr_designation_update_log AS dl")
    			->select([
    				DB::raw("@sl:=@sl+1 AS serial_no"),
    				"dl.*"
    			])
    			->orderBy('id', "DESC")
    			->get();
    	// dd($data);
    	return DataTables::of($data)
    			->editColumn('associate_id', function($data){
    				$ass= Employee::where('associate_id', $data->associate_id)->pluck('as_name')->first();
    				$associate= $data->associate_id." - ".$ass;
    				return $associate;
    			})
    			->editColumn('updated_by', function($data){
    				$ass= Employee::where('associate_id', $data->updated_by)->pluck('as_name')->first();
    				$associate= $data->updated_by." - ".$ass;
    				return $associate;
    			})
    			->editColumn('previous_designation', function($data){
    				$prev_desg= Designation::where('hr_designation_id', $data->previous_designation)->pluck('hr_designation_name')->first();
    				return $prev_desg;
    			})
    			->editColumn('updated_designation', function($data){
    				$upd_desg= Designation::where('hr_designation_id', $data->updated_designation)->pluck('hr_designation_name')->first();
    				return $upd_desg;
    			})
    			->toJson();
    }
}
