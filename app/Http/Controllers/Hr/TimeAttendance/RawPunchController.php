<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Line;
use App\Models\Hr\Floor;
use DB, DataTables;
class RawPunchController extends Controller
{
    public function rawPunch(Request $request)
    {
    	if(!empty($request->unit_id))
        {
    		$unit_id= $request->unit_id;
    		$floor_id= $request->floor_id;
    		$line_id= $request->line_id;
    		$associate_id= $request->associate_id;
    		$punch_date= $request->punch_date;
    		
    		$punches = DB::table('checkinout AS chk')
				->select([
					"chk.CheckTime",
					"chk.Userid"
				])
				->leftJoin('hr_as_basic_info AS b', 'chk.Userid', 'b.as_id')
                ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
				->where(function($q) use($unit_id, $floor_id, $line_id, $associate_id, $punch_date){
                	$q->where('b.as_unit_id', $unit_id);
                	$q->where('b.as_floor_id', $floor_id);
                	if (!empty($line_id))
	                {
	                    $q->where('b.as_line_id', $line_id);
	                }
                	if (!empty($associate_id))
	                {
	                    $q->where('b.associate_id', $associate_id);
	                }
                	if (!empty($punch_date))
	                {
	                    $q->whereDate('chk.CheckTime', $punch_date);
	                }
				})
				->orderBy('chk.CheckTime')
				->get(); 

    		DB::statement(DB::raw("SET @sl:=0;")); 
    		$employees= DB::table('checkinout AS chk')
				->select([
					DB::raw("@sl:=@sl+1 AS serial_no"),
					"b.as_id",
					"b.associate_id",
					"b.as_name"
				])
				->leftJoin('hr_as_basic_info AS b', 'chk.Userid', 'b.as_id')
                ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
				->where(function($q) use($unit_id, $floor_id, $line_id, $associate_id, $punch_date){
                	$q->where('b.as_unit_id', $unit_id);
                	$q->where('b.as_floor_id', $floor_id);
                	if (!empty($line_id))
	                {
	                    $q->where('b.as_line_id', $line_id);
	                }
                	if (!empty($associate_id))
	                {
	                    $q->where('b.associate_id', $associate_id);
	                }
                	if (!empty($punch_date))
	                {
	                    $q->whereDate('chk.CheckTime', $punch_date);
	                }
				})
				->groupBy("chk.Userid")
				->get();

    		$data[] = (object)array();  

    		foreach($employees AS $emp)
            {
    			$singleObj = (object)[];
    			$singleObj->serial_no = $emp->serial_no;
    			$singleObj->associate_id = $emp->associate_id;
    			$singleObj->as_name = $emp->as_name;
    			foreach($punches AS $punch){
    				if($emp->as_id == $punch->Userid){
    					$singleObj->CheckTime[] = $punch->CheckTime;
    				}
    			}
    			$singleObj->row_num = count($singleObj->CheckTime);
    			$data[]= $singleObj;
    		}
    		$other_info= (object)[];
    		$other_info->unit_name= Unit::where('hr_unit_id', $request->unit_id)->pluck('hr_unit_name')->first();
    		$other_info->floor_name= Floor::where('hr_floor_id', $request->floor_id)->pluck('hr_floor_name')->first();
    		$other_info->total_punch= count($punches);
    		$other_info->emp_num= count($employees);

    		if(!empty($request->line_id)){
    			$other_info->line_name= Line::where('hr_line_id', $request->line_id)->pluck('hr_line_name')->first();
    		}
    		if(!empty($request->punch_date)){
    			$other_info->punch_date= $request->punch_date;
    		}

    	}
    	$unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id');
    	$info=null; 

    	return view('hr/timeattendance/raw_punch', compact('info', 'unitList', 'data','other_info'));
    }
}
