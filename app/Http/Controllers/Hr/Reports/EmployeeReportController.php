<?php
namespace App\Http\Controllers\Hr\Reports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use DB, Validator, PDF;

class EmployeeReportController extends Controller
{ 
    public function report(Request $request)
    {
    	$unitList   = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->
			pluck("hr_unit_name", "hr_unit_id");
    	$statusList = [
    		1 => 'Active', 
    		2 => 'Resign', 
    		3 => 'Terminate', 
    		4 => 'Suspend'
    	];

    	$info = array(); 
    	if (!empty($request->unit) && !empty($request->status))
    	{
	    	$info = array(
				"unit"        => $request->unit, 
				"status"      => $request->unit,
				"unit_name"   => $unitList[$request->unit],
				"status_name" => $statusList[$request->status]
			);
    	}
	    $title = null;	

		$reports = DB::table("hr_as_basic_info AS b")
			->select(
			"b.associate_id", 
			"b.as_name", 
			"b.as_doj", 
			"b.as_dob",
			"b.as_ot",
			"b.as_gender",
			"d.hr_designation_name",
			"d.hr_designation_grade",
			"s.hr_section_name",
			"dp.hr_department_name",
			"bn.ben_current_salary",
			"f.hr_floor_name",
			"l.hr_line_name",
			"adv.emp_adv_info_religion",
			"adv.emp_adv_info_per_dist",
			"hd.dis_name",
			DB::raw("
				CASE
					WHEN b.as_emp_type_id != 1 THEN d.hr_designation_grade
					ELSE NULL
				END AS hr_designation_grade
			") 
		)
		->leftJoin("hr_designation AS d", "d.hr_designation_id", "=", "b.as_designation_id")
		->leftJoin("hr_department AS dp", "dp.hr_department_id", "=", "b.as_department_id")
		->leftJoin("hr_section AS s", "s.hr_section_id", "=", "b.as_section_id")
		->leftJoin("hr_benefits AS bn", "bn.ben_as_id", "=", "b.associate_id")
        ->leftJoin("hr_floor AS f", "f.hr_floor_id", "=", "b.as_floor_id")
        ->leftJoin("hr_line AS l", "l.hr_line_id", "=", "b.as_line_id")
        ->leftJoin("hr_as_adv_info AS adv", "adv.emp_adv_info_as_id", "=", "b.associate_id")
        ->leftJoin("hr_dist AS hd", "hd.dis_id", "=", "adv.emp_adv_info_per_dist") 
		->where("b.as_unit_id", $request->unit)
		->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
		->where("b.as_status", $request->status)		
		->orderBy("b.associate_id", "ASC")
		->get();

		foreach($reports AS $rp){ 
	         $title = DB::table("hr_education AS he") 
	         	->where("he.education_as_id",  $rp->associate_id)	
	         	->orderBy('he.education_level_id', "DESC")
				->leftJoin("hr_education_degree_title AS t", "t.id", "=","he.education_degree_id_1")
				->pluck("t.education_degree_title")
				->first();
			$rp->education_title = $title; 
		}

        if ($request->get('pdf') == true) 
        { 
            $pdf = PDF::loadView('hr/reports/employee_report_pdf', [
            	'info' => $info,
            	'reports' => $reports,
            	'title' => $rp->education_title
			]);
            return $pdf->download('Employee_Report_'.date('d_F_Y').'.pdf');
        }

		return view("hr/reports/employee_report", compact(
        	'info',
        	'reports',
        	'unitList',
        	'statusList',
        	'title'
        ));

    }
}
