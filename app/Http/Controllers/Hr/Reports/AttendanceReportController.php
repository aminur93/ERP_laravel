<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Employee;
use App\Models\Hr\Attendace;
use DB, PDF;

class AttendanceReportController extends Controller
{
	public function showForm(Request $request)
    {    
        $unitList  = Unit::where('hr_unit_status', '1')
	        ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
	        ->pluck('hr_unit_name', 'hr_unit_id');  

        $info = (object)array();
        $info->unit = $request->unit;
        $info->date = $request->date;
        $info->non_ot = $this->nonOtReport($request->unit, $request->date); 

        $info->unit_name = DB::table("hr_unit")->where("hr_unit_id", $request->unit)->value("hr_unit_name");
        $info->worker_attendance = $this->workerAttendance($request->unit, $request->date); 
        $info->staff_attendance = $this->staffAttendance($request->unit, $request->date); 

        if ($request->get('pdf') == true) {    
            $pdf = PDF::loadView('hr/reports/attendance_report_pdf', ['info' => $info]);
            return $pdf->download('Attendance_Report_'.date('d_F_Y').'.pdf');
        }

        return view("hr/reports/attendance_report", compact(
        	"info", 
        	"unitList" 
        ));
    }  

    public function workerAttendance($unit = null, $date = null)
    {  
    	if (empty($unit) && empty($date))
    	{
    		return null;
    	}
    	# FLOORS
    	#-------------------------------------------------
    	$floors =  DB::table("hr_as_basic_info")
    		->select(
    			"as_floor_id AS floor_id", 
    			DB::raw("
    				CASE 
	    				WHEN hr_floor_id THEN hr_floor_name
	    				ELSE 'Unknown Floor'
    				END AS floor_name
    			")
    		)  
    		->where("as_unit_id", $unit)
    		->where("as_ot", 1)
    		->where("as_status", 1) 
    		->leftJoin("hr_floor", "hr_floor_id", "=", "as_floor_id")
    		->groupBy("as_floor_id")
    		->pluck("floor_name", "floor_id");

    	# SECTIONS
    	#-------------------------------------------------
    	$sections = DB::table("hr_as_basic_info")
    		->select(
    			"as_section_id AS section_id", 
    			DB::raw("
    				CASE 
	    				WHEN hr_section_id THEN hr_section_name
	    				ELSE 'Unknown Section'
    				END AS section_name
    			")
    		)
    		->where("as_unit_id", $unit)
    		->where("as_ot", 1)
    		->where("as_status", 1) 
    		->leftJoin("hr_section", "hr_section_id", "=", "as_section_id")
    		->groupBy("as_section_id")
    		->get();

    	$data = [];
    	foreach($sections as $section)
    	{
    		$designations = DB::table("hr_as_basic_info")
    		->select(
    			DB::raw("
    				associate_id, 
    				as_unit_id AS unit_id, 
    				as_section_id AS section_id, 
    				as_designation_id AS designation_id, 
    				CASE 
	    				WHEN hr_section_id THEN hr_section_name
	    				ELSE 'Unknown Section'
    				END AS section_name,
    				CASE 
	    				WHEN hr_designation_id THEN hr_designation_name
	    				ELSE 'Unknown Designation'
    				END AS designation_name
    			")
    		)
    		->distinct("as_designation_id")
    		->where("as_ot", 1)
    		->where("as_status", 1)
    		->where("as_unit_id", $unit)
    		->where("as_section_id", $section->section_id)
    		->leftJoin("hr_section", "hr_section_id", "=", "as_section_id")
    		->leftJoin("hr_designation", "hr_designation_id", "=", "as_designation_id")
    		->groupBy("as_designation_id")
    		->orderBy("as_section_id")
	        ->whereIn('as_unit_id', auth()->user()->unit_permissions())
    		->get();

    		foreach($designations as $dsg)
    		{
    			$data[$dsg->section_name][] = (object)array(
	    			"unit_id"        => $dsg->unit_id,
	    			"section_id"     => $dsg->section_id,
	    			"designation_id" => $dsg->designation_id,
	    			"designation_name" => $dsg->designation_name 
    			); 
    		}
    	}  

    	/*
    	*------------------------------------------------
    	* render html data
    	*------------------------------------------------
    	*/
		$total_require = array();
		$total_onrole  = array();
		$total_present = array();
		$total_absent  = array(); 
		# HEAD
		#----------------------------------------------------
        $html = "<thead><tr><th colspan=\"2\">Employee Type : OT</th>"; 
		// render floor name column
		foreach($floors as $floor)
		{
			$html .= "<th colspan=\"4\">$floor</th>";
		}
		// end of floor name column 
		$html .= "<th colspan=\"6\" style=\"text-align:center;color:lightseagreen\">Total</th>
		</tr>";

		$html .= "<tr><th style=\"background:#D4F594\">Section</th>
		<th style=\"background:#D4F594\">Designation</th>";

		// render floor R.O.P.A
		$i=0;
		foreach($floors as $floor)
		{
			$total_require[$i] = 0;
			$total_onrole[$i]  = 0;
			$total_present[$i] = 0;
			$total_absent[$i]  = 0; 
			$i++;

			$html .= "<th style=\"background:#D4F594\">R</th>";
			$html .= "<th style=\"background:#D4F594\">O</th>";
			$html .= "<th style=\"background:#D4F594\">P</th>";
			$html .= "<th style=\"background:#D4F594\">A</th>";
		}

		$html .= "<th style=\"color:lightseagreen\">Require</th>";
		$html .= "<th style=\"color:lightseagreen\">On Roll</th>";
		$html .= "<th style=\"color:lightseagreen\">Present</th>";
		$html .= "<th style=\"color:lightseagreen\">Absent</th>";
		$html .= "<th style=\"color:lightseagreen\">Leave</th>";
		$html .= "<th style=\"color:lightseagreen\">Abs%</th></tr></thead>";  

		# BODY
		#----------------------------------------------------
		$sum = array();
		$grand_require = 0;
		$grand_onrole  = 0;
		$grand_present = 0;
		$grand_absent  = 0; 
		$total_leave   = 0; 
		$total_abs     = 0; 
		$grand_leave   = 0; 
		#----------------------------------------------------
    	$section_exists = null; 
    	$html .= "<tbody>";
    	$s = 0;
		foreach($data as $section => $designation)
		{
			// count table rowspan 
			$rowspan = count($designation)?count($designation):0;
			// designation loop
			$l = 0;
			$total_leave = 0;
			foreach($designation as $dsg)
			{  
				$html .= "<tr>";
				//check sectin exists
				if ($section_exists != $section)
				{
					$section_exists = $section;
					$html .= "<th rowspan=\"$rowspan\">$section</th>";
				}
				$html .= "<th align=\"left\">$dsg->designation_name</th>";

					// render floor column
					$f = 0;
					$sub_require[$s] = 0;
					$sub_onrole[$s]  = 0;
					$sub_present[$s] = 0;
					$sub_absent[$s]  = 0; 
					#-----------------------------------------------
					foreach($floors as $floor_id => $floor_name)
					{
						$r = 0;
						$o  = $this->employeeData([
							"unit"        => $dsg->unit_id,
							"section"     => $dsg->section_id,
							"designation" => $dsg->designation_id,
							"floor"       => $floor_id 
						]);
						$p  = $this->presentData([
							"date"        => date("Y-m-d", strtotime($date)),
							"unit"        => $dsg->unit_id,
							"section"     => $dsg->section_id,
							"designation" => $dsg->designation_id,
							"floor"       => $floor_id 
						]);
						$a = $o-$p;

						#-----------------------------
						// SUM total total
						$grand_require += $r; 
						$grand_onrole  += $o; 
						$grand_present += $p; 
						$grand_absent  += $a;   
						#-----------------------------
						#SUM  
						$total_require[$f] += $r;
						$total_onrole[$f]  += $o;
						$total_present[$f] += $p;
						$total_absent[$f]  += $a; 

						$sub_require[$s] += $r; 
						$sub_onrole[$s]  += $o; 
						$sub_present[$s] += $p; 
						$sub_absent[$s]  += $a; 
						#-----------------------------
						$html .= "<th style=\"color:red\">$r</th>";
						$html .= "<th style=\"color:blue\">$o</th>";
						$html .= "<th style=\"color:green\">$p</th>";
						$html .= "<th style=\"color:olive\">$a</th>";
						$f++;
					} 
					// end of floor f 

					// LEAVE CALCULATION 
					#----------------------------------------
					$total_leave  = $this->leaveData([
						"date"        => date("Y-m-d", strtotime($date)),
						"unit"        => $dsg->unit_id,
						"section"     => $dsg->section_id,
						"designation" => $dsg->designation_id
					]); 

					$total_abs   = $sub_onrole[$s]>0?(number_format(($sub_absent[$s]*100)/$sub_onrole[$s], 2, ".", "")):0;

					$grand_leave += $total_leave;


					// calculate total 
					$html .= "<th style=\"color:red\">$sub_require[$s]</th>"; // require
					$html .= "<th style=\"color:blue\">$sub_onrole[$s]</th>"; // on roll
					$html .= "<th style=\"color:green\">$sub_present[$s]</th>"; // present
					$html .= "<th style=\"color:olive\">$sub_absent[$s]</th>"; // absent
					$html .= "<th style=\"color:red\">$total_leave</th>";  // leave
					$html .= "<th style=\"color:red\">$total_abs%</th>"; // abs%
				$html .= "</tr>";
				//designation increment   
				$s++;
			} // designation loop
        } //end of data foreach  
    	$html .= "</tbody>";


        
		# FOOTER
		#----------------------------------------------------
    	$html .= "</tfoot><tr style=\"color:lightseagreen\">";
    	$html .= "<th colspan=\"2\" style=\"color:red;text-align:right;\">Total:</th>";

		// render floor R.O.P.A values
		$i=0;
		foreach($floors as $floor)
		{ 
			$html .= "<th>".$total_require[$i]."</th>";
			$html .= "<th>".$total_onrole[$i]."</th>";
			$html .= "<th>".$total_present[$i]."</th>";
			$html .= "<th>".$total_absent[$i]."</th>";
			$i++;
		}

		$html .= "<th style=\"color:red\">$grand_require</th>";
		$html .= "<th style=\"color:red\">$grand_onrole</th>";
		$html .= "<th style=\"color:red\">$grand_present</th>";
		$html .= "<th style=\"color:red\">$grand_absent</th>";
		$html .= "<th style=\"color:red\">$grand_leave</th>";
		$html .= "<th style=\"color:red\">".($grand_onrole>0?(number_format(($grand_absent*100)/$grand_onrole, 2, ".", "")):0)."%</th></tr></tfoot>";
  
    	return $html;
    } 

    public function employeeData($data = array())
    { 
    	$data = (object)$data;
		return Employee::where(function($query) use($data) {
			$query->where("as_status", 1);
			$query->where("as_ot", 1);
			$query->where("as_unit_id", $data->unit);
			$query->where("as_designation_id", $data->designation);
			$query->where("as_section_id", $data->section);
			$query->where("as_floor_id", $data->floor); 
		})
		->count(); 
    }

    public function presentData($data = array())
    { 
    	$data = (object)$data;
		return DB::table("hr_attendance AS a") 
			->join("hr_as_basic_info AS b", function($query) use($data) {
				$query->where("b.as_status", 1);
				$query->where("b.as_ot", 1);
				$query->where("b.as_unit_id", $data->unit);
				$query->where("b.as_designation_id", $data->designation);
				$query->where("b.as_section_id", $data->section);
				$query->where("b.as_floor_id", $data->floor); 
				$query->on("b.as_id", "=", "a.as_id"); 
			})
			->whereDate("a.in_time", $data->date)
			->count();
    }

    public function leaveData($data = array())
    {  
    	$data = (object)$data;
		return DB::table("hr_leave AS l") 
			->whereDate('l.leave_from', ">=", date("Y-m-d",strtotime($data->date)))
			->whereDate('l.leave_to', "<=", date("Y-m-d",strtotime($data->date)))
			->join("hr_as_basic_info AS b", function($query) use($data) {
				$query->where("b.as_status", 1);
				$query->where("b.as_ot", 1);
				$query->where("b.as_unit_id", $data->unit);
				$query->where("b.as_designation_id", $data->designation);
				$query->where("b.as_section_id", $data->section);
				$query->on("b.associate_id", "=", "l.leave_ass_id"); 
			})
			->count();
    }

    public function staffAttendance($unit=null, $date=null)
    {
    	if(empty($unit) && empty($date))
    	{
    		return null;
    	}

    	$total= array();
        $ot= $this->getSummary($unit, $date, 1);
        $non_ot= $this->getSummary($unit, $date, 0);
        $total[0]= ($ot[0]+$non_ot[0]);
        $total[1]= ($ot[1]+$non_ot[1]);
        $total[2]= ($ot[2]+$non_ot[2]);
        $total[3]= ($ot[3]+$non_ot[3]);

        $table='<table style="width:50%;margin:0 0 10px 0;border:1px solid #000;font-size:11px;" cellpadding="2" cellspacing="0" border="1" align="left">
		    <tr>
		        <th colspan="5" style="font-weight: bold; color: #006FC4; text-align: center; background:gold"><h4> SUMMARY</h4></th>
		    </tr>
		    <tr>
		        <th></th>
		        <th style="text-align: center;">ON ROLL</th>
		        <th style="text-align: center;">PRESENT</th>
		        <th style="text-align: center;">ABSENT</th>
		        <th style="text-align: center;">LEAVE</th>
		    </tr>
		    </thead>
		    <tbody>
		        <tr style="text-align: center;">
		            <th>NON OT EMPLOYEE</th>
		            <td>'.$non_ot[0].'</td>
		            <td>'.$non_ot[1].'</td>
		            <td>'.$non_ot[2].'</td>
		            <td>'.$non_ot[3].'</td>
		        </tr>
		        <tr style="text-align: center;">
		            <th>OT EMPLOYEE</th>
		            <td>'.$ot[0].'</td>
		            <td>'.$ot[1].'</td>
		            <td>'.$ot[2].'</td>
		            <td>'.$ot[3].'</td>
		        </tr>
		        <tr>
		            <th style="color: #006FC4; text-align: center;">TOTAL :</th>
		            <td style="color: #006FC4; text-align: center;">'.$total[0].'</td>
		            <td style="color: #006FC4; text-align: center;">'.$total[1].'</td>
		            <td style="color: #006FC4; text-align: center;">'.$total[2].'</td>
		            <td style="color: #006FC4; text-align: center;">'.$total[3].'</td>
		        </tr>
		    </tbody>
		</table>';

		return $table;
    }

    public function getSummary($unit, $report_date, $ot_status){

		$onroll = Employee::where('as_unit_id', $unit)
		    ->where('as_ot', $ot_status)
		    ->where('as_status', 1)
		    ->count();

		$present = DB::table('hr_attendance AS att')
			->whereDate('att.in_time', date("Y-m-d",strtotime($report_date)))
			->join('hr_as_basic_info AS b', function($join) use($unit, $ot_status) {
				$join->on('att.as_id', '=', 'b.as_id');
				$join->where('b.as_unit_id', '=', $unit);
				$join->where('b.as_ot', '=', $ot_status);
				$join->where('b.as_status', '=', 1);
			})
			->count();

		$leave= DB::table('hr_leave AS l')
			->whereDate('l.leave_from', ">=", date("Y-m-d",strtotime($report_date)))
			->whereDate('l.leave_to', "<=", date("Y-m-d",strtotime($report_date)))
			->join('hr_as_basic_info AS b', function($join) use($unit, $ot_status) {
				$join->on('b.associate_id', '=', 'l.leave_ass_id');
				$join->where('b.as_ot', '=', $ot_status); 
				$join->where('b.as_unit_id', '=', $unit); 
				$join->where('b.as_status', '=', 1); 
			})
			->count();

		$absent= $onroll-($present+$leave);
		$data= array($onroll, $present, $absent, $leave);
		return $data;
	}

	// ATTENDANCE REPORT 2
	public function showForm2(Request $request)
    {     
        
        
        $unitList  = Unit::where('hr_unit_status', '1')
	        ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
	        ->pluck('hr_unit_name', 'hr_unit_id');  

        $info = (object)array();
        $info->unit = $request->unit;
        $info->date = $request->date;
        $info->unit_name = DB::table("hr_unit")->where("hr_unit_id", $request->unit)->value("hr_unit_name");
        $info->otEmpAttendance = $this->otEmpAttendance($request->unit, $request->date, 1); 
        $info->nonOtEmpAttendance = $this->otEmpAttendance($request->unit, $request->date, 0); 

        // generate pdf
        if ($request->get('pdf') == true) 
        { 
            $pdf = PDF::loadView('hr/reports/attendance_report_2_pdf', ['info'=>$info]);
            return $pdf->download('Attendance_Report_2_'.date('d_F_Y').'.pdf');
        } 

        return view("hr/reports/attendance_report_2", compact(
        	"info", 
        	"unitList" 
        ));
    }

    public function otEmpAttendance($unit = null, $date = null, $ot)
    {  
        
       
    	if (empty($unit) && empty($date))
    	{
    		return null;
    	}

    	# SECTIONS
    	#-------------------------------------------------
    	$sections = DB::table("hr_as_basic_info")
    		->select(
    			"as_section_id AS section_id", 
    			DB::raw("
    				CASE 
	    				WHEN hr_section_id THEN hr_section_name
	    				ELSE 'Unknown Section'
    				END AS section_name
    			")
    		)
    		->where("as_unit_id", $unit)
    		->leftJoin("hr_section", "hr_section_id", "=", "as_section_id")
    		->where('as_ot', $ot)
    		->groupBy("as_section_id")
    		->get();

    	$data = [];
    	foreach($sections as $section)
    	{
    		$subSections = DB::table("hr_as_basic_info")
    		->select(
    			DB::raw("
    				associate_id, 
    				as_unit_id AS unit_id, 
    				as_section_id AS section_id, 
    				as_subsection_id AS subsection_id, 
    				CASE 
	    				WHEN hr_section_id THEN hr_section_name
	    				ELSE 'Unknown Section'
    				END AS section_name,
    				CASE 
	    				WHEN hr_subsec_id THEN hr_subsec_name
	    				ELSE 'Unknown Subsection'
    				END AS subsection_name
    			")
    		)
    		->distinct("as_subsection_id")
    		->where("as_unit_id", $unit)
    		->where('as_ot', $ot)
    		->where("as_section_id", $section->section_id)
    		->leftJoin("hr_section", "hr_section_id", "=", "as_section_id")
    		->leftJoin("hr_subsection", "hr_subsec_id", "=", "as_subsection_id")
    		->groupBy("as_subsection_id")
    		->orderBy("as_section_id")
	        ->whereIn('as_unit_id', auth()->user()->unit_permissions())
    		->get();
    		
    		foreach($subSections as $subSec)
    		{
    			 
    			//employee enrolled in the subsection
    			$enroll= DB::table('hr_as_basic_info AS b')
    				->where('b.as_unit_id', $subSec->unit_id)
    				->where('b.as_section_id', $subSec->section_id)
    				->where('b.as_subsection_id', $subSec->subsection_id)
    				->where('as_ot', $ot)
    				->where('b.as_status',1) // checking status
    				->count();
    		    if($enroll>0){
    		       $data[$subSec->section_name][] = (object)array(
	    			"unit_id"        => $subSec->unit_id,
	    			"section_id"     => $subSec->section_id,
	    			"subsection_id" => $subSec->subsection_id,
	    			"subsection_name" => $subSec->subsection_name 
    			    );
    		    }
    		}
    	}
    	
    	foreach($data AS $section => $subSections){
    		foreach ($subSections AS $subSection){
    			//employee enrolled in the subsection
    			$enroll= DB::table('hr_as_basic_info AS b')
    				->where('b.as_unit_id', $subSection->unit_id)
    				->where('b.as_section_id', $subSection->section_id)
    				->where('b.as_subsection_id', $subSection->subsection_id)
    				->where('as_ot', $ot)
    				->where('b.as_status',1) // checking status
    				->count();
    				
    			//employee Present in the subsection
        		if($unit ==2){
        		    $present= DB::table('hr_attendance_ceil AS a')
        				->whereDate('a.in_time', date('Y-m-d', strtotime($date)))
        				->leftJoin('hr_as_basic_info AS b', 'a.as_id', 'b.as_id')
        				->where('b.as_unit_id', $subSection->unit_id)
        				->where('b.as_section_id', $subSection->section_id)
        				->where('b.as_subsection_id', $subSection->subsection_id)
        				->where('b.as_status',1) // checking status
        				->where('b.as_ot', $ot)
        				->count();
        		}
        		else if($unit ==3){
        		    $present= DB::table('hr_attendance_aql AS a')
        				->whereDate('a.in_time', date('Y-m-d', strtotime($date)))
        				->leftJoin('hr_as_basic_info AS b', 'a.as_id', 'b.as_id')
        				->where('b.as_unit_id', $subSection->unit_id)
        				->where('b.as_section_id', $subSection->section_id)
        				->where('b.as_subsection_id', $subSection->subsection_id)
        				->where('b.as_status',1) // checking status
        				->where('as_ot', $ot)
        				->count();
        				
        		}
        		else if($unit ==1 || $unit ==4 || $unit ==5 || $unit ==9){
        		    $present= DB::table('hr_attendance_mbm AS a')
        				->whereDate('a.in_time', date('Y-m-d', strtotime($date)))
        				->leftJoin('hr_as_basic_info AS b', 'a.as_id', 'b.as_id')
        				->where('b.as_unit_id', $unit)
        				->where('b.as_unit_id', $subSection->unit_id)
        				->where('b.as_section_id', $subSection->section_id)
        				->where('b.as_subsection_id', $subSection->subsection_id)
        				->where('b.as_status',1) // checking status
        				->where('as_ot', $ot)
        				->count();
        				
        		}
        		else if($unit ==6){
        		    $present= DB::table('hr_attendance_ho AS a')
        				->whereDate('a.in_time', date('Y-m-d', strtotime($date)))
        				->leftJoin('hr_as_basic_info AS b', 'a.as_id', 'b.as_id')
        				->where('b.as_unit_id', $subSection->unit_id)
        				->where('b.as_section_id', $subSection->section_id)
        				->where('b.as_subsection_id', $subSection->subsection_id)
        				->where('b.as_status',1) // checking status
        				->where('as_ot', $ot)
        				->count();
        				
        		}
        		else if($unit ==8){
        		    $present= DB::table('hr_attendance_cew AS a')
        				->whereDate('a.in_time', date('Y-m-d', strtotime($date)))
        				->leftJoin('hr_as_basic_info AS b', 'a.as_id', 'b.as_id')
        				->where('b.as_unit_id', $subSection->unit_id)
        				->where('b.as_section_id', $subSection->section_id)
        				->where('b.as_subsection_id', $subSection->subsection_id)
        				->where('b.as_status',1) // checking status
        				->where('as_ot', $ot)
        				->count();
        				
        		}
        		else{
        		    $present= DB::table('hr_attendance AS a')
        				->whereDate('a.in_time', date('Y-m-d', strtotime($date)))
        				->leftJoin('hr_as_basic_info AS b', 'a.as_id', 'b.as_id')
        				->where('b.as_unit_id', $subSection->unit_id)
        				->where('b.as_section_id', $subSection->section_id)
        				->where('b.as_subsection_id', $subSection->subsection_id)
        				->where('b.as_status',1) // checking status
        				->where('as_ot', $ot)
        				->count();
        				
        		}
    		    
    			//employee Absent in the subsection
    			$absent= $enroll-$present;
    			//Absent Percentage in the subsection
    			$absent_percent= $enroll<=0?0:round(($absent*100)/$enroll);
    			// enroll, present, absent, absent percent 
    			    $subSection->enroll=$enroll;
    			    $subSection->present=$present;
    			    $subSection->absent=$absent;
    			    $subSection->absent_percent=$absent_percent;
    		}

    	}
    	return $data;
    } 

    public function nonOtReport($unit = null, $date = null)
    { 
        
    	if (empty($unit) && empty($date))
    	{
    		return null;
    	}
    	# NON-OT Holder
    	#-------------------------------------------------
    	$sections = DB::table("hr_as_basic_info AS b")
    		->select(
    			"b.as_section_id", 
    			DB::raw("
    				CASE 
    					WHEN s.hr_section_id THEN s.hr_section_name
    					ELSE 'Unknown'
    				END AS hr_section_name,
    				COUNT(associate_id) AS enroll
    			")
    		)
    		->leftJoin("hr_section AS s", "s.hr_section_id", "=", "b.as_section_id")
    		->where("b.as_ot", 0)
    		->where("b.as_unit_id", $unit)
    		->where("b.as_status", 1)
    		->groupBy("b.as_section_id")
    		->get(); 

    	$html = "<table style=\"width:50%;margin:10px 0 10px 0;border:1px solid #000;font-size:11px;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"left\">
    		<thead style=\"background:gold;font-weight:bold; color:#006FC4;\">
    		<tr><th style=\"padding:4px 10px;text-align:center\" colspan=\"5\"><h4>NON-OT ATTENDANCE</h4></th></tr>
    		</thead>
    		<thead style=\"background:gold;font-weight:bold; color:#006FC4;\">
    		<tr><th style=\"padding:4px 10px;width:30px\">SL.NO</th><th style=\"padding:4px 10px\">SECTION</th><th style=\"padding:4px 10px;text-align:center\">E</th><th style=\"padding:4px 10px;text-align:center\">P</th><th style=\"padding:4px 10px;text-align:center\">A</th></tr>
    		</thead>
    		<tbody>";

    	$sl      = 1;
    	$enroll  = 0;
    	$present = 0;
    	$absent  = 0;
    	$totalEnroll  = 0;
    	$totalPresent = 0;
    	$totalAbsent  = 0;
    	#-------------------------------------------
    	foreach ($sections as $section) 
    	{
    		//ENROLL
    		$enroll = $section->enroll;
    		$totalEnroll += $enroll;


            

    		//PRESENT
			
				
			if($unit ==2){
        		  $present  =  DB::table("hr_attendance_ceil AS a") 
                    				->join("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
                    				->where("b.as_unit_id", $unit)
                    				->where("b.as_section_id", $section->as_section_id)
                    				->where("b.as_ot", 0)
                    				->where("b.as_status", 1)
                    				->whereDate("a.in_time", date("Y-m-d", strtotime($date)))
                    				->count();
        		}
        		else if($unit ==3){
        		    $present= DB::table('hr_attendance_aql AS a')
                				    ->join("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
                    				->where("b.as_unit_id", $unit)
                    				->where("b.as_section_id", $section->as_section_id)
                    				->where("b.as_ot", 0)
                    				->where("b.as_status", 1)
                    				->whereDate("a.in_time", date("Y-m-d", strtotime($date)))
                    				->count();
        				
        		}
        		else if($unit ==1 || $unit ==4 || $unit ==5 || $unit ==9){
        		    $present= DB::table('hr_attendance_mbm AS a')
                				->join("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
                    				->where("b.as_unit_id", $unit)
                    				->where("b.as_section_id", $section->as_section_id)
                    				->where("b.as_ot", 0)
                    				->where("b.as_status", 1)
                    				->whereDate("a.in_time", date("Y-m-d", strtotime($date)))
                    				->count();
        				
        		}
        		else if($unit ==6){
        		    $present= DB::table('hr_attendance_ho AS a')
                				    ->join("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
                    				->where("b.as_unit_id", $unit)
                    				->where("b.as_section_id", $section->as_section_id)
                    				->where("b.as_ot", 0)
                    				->where("b.as_status", 1)
                    				->whereDate("a.in_time", date("Y-m-d", strtotime($date)))
                    				->count();
        				
        		}
        		else if($unit ==8){
        		    $present= DB::table('hr_attendance_cew AS a')
        				            ->join("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
                    				->where("b.as_unit_id", $unit)
                    				->where("b.as_section_id", $section->as_section_id)
                    				->where("b.as_ot", 0)
                    				->where("b.as_status", 1)
                    				->whereDate("a.in_time", date("Y-m-d", strtotime($date)))
                    				->count();
        				
        		}
        		else{
        		    $present= DB::table('hr_attendance AS a')
                    				->join("hr_as_basic_info AS b", "b.as_id", "=", "a.as_id")
                    				->where("b.as_unit_id", $unit)
                    				->where("b.as_section_id", $section->as_section_id)
                    				->where("b.as_ot", 0)
                    				->where("b.as_status", 1)
                    				->whereDate("a.in_time", date("Y-m-d", strtotime($date)))
                    				->count();
        		}	
				
				
				
			
				
				
			$totalPresent += $present;
			//ABSENT
			$absent = $enroll-$present;
			$totalAbsent += $absent;

            
    		$html .= "<tr>";
    		$html .= "<th style=\"text-align:center\">".$sl++."</th>";
    		$html .= "<th style=\"padding:4px 10px\">$section->hr_section_name</th>";
    		$html .= "<th style=\"text-align:center\">$enroll</th>";
    		$html .= "<th style=\"text-align:center\">$present</th>";
    		$html .= "<th style=\"text-align:center\">$absent</th>";
    		$html .= "</tr>";
    	}

		$html .= "<tr style=\"color:#006FC4\">";
		$html .= "<th colspan=\"2\" style=\"padding:4px 10px;text-align:right\">Total</th>";
		$html .= "<th style=\"text-align:center\">$totalEnroll</th>";
		$html .= "<th style=\"text-align:center\">$totalPresent</th>";
		$html .= "<th style=\"text-align:center\">$totalAbsent</th>";
		$html .= "</tr>";
    	$html .= "</tbody></table>";
 

    	return $html;
    }

}
