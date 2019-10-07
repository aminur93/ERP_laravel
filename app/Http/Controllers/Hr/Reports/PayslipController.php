<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Floor;
use DB, PDF;

class PayslipController extends Controller
{ 
	public function showForm(Request $request)
    {   
        $unitList  = Unit::where('hr_unit_status', '1')->whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id'); 
        $unit_id=$request->unit;

        #-------------------------------------------------- 
        $info = (object)array();
        $info->start_date = $request->start_date;
        $info->end_date   = $request->end_date;
        $info->disbursed_date = $request->disbursed_date;
        $info->unit       = Unit::where("hr_unit_id", $request->unit)->value("hr_unit_name_bn");
        $info->department = Department::where("hr_department_id", $request->department)->value("hr_department_name_bn");
        $info->floor      = Floor::where("hr_floor_id", $request->floor)->value("hr_floor_name_bn");
        $info->work_days  = $this->workDays(
            $request->start_date, 
            $request->end_date, 
            $request->unit
        );

        $info->employee   = $this->employeeInfo($request->unit, $request->floor, $request->department, $request->section, $request->subSection, $request->start_date);
        //dd($info->employee);

        if ($request->get('pdf') == true) {     
            $pdf = PDF::loadView('hr/reports/payslip_pdf', ['info' => $info]);
            return $pdf->download('Payslip_Report_'.date('d_F_Y').'.pdf');
        }
        $floorList= DB::table('hr_floor')
                        ->where('hr_floor_unit_id', $request->unit)
                        ->pluck('hr_floor_name', 'hr_floor_id');

        $deptList= DB::table('hr_department')
                        ->where('hr_department_area_id', $request->area)
                        ->pluck('hr_department_name', 'hr_department_id');
        $sectionList= DB::table('hr_section')
                        ->where('hr_section_department_id', $request->department)
                        ->pluck('hr_section_name', 'hr_section_id');


        $subSectionList= DB::table('hr_subsection')
                        ->where('hr_subsec_section_id', $request->section)
                        ->pluck('hr_subsec_name', 'hr_subsec_id');

        return view("hr/reports/payslip", compact(
        	"info", 
        	"unitList", 
        	"areaList",
            "floorList",
            "deptList",
            "sectionList", 
            "subSectionList",
            "unit_id" 
        ));
    } 

    // get total working days
    public function workDays($startDate = null, $endDate = null, $unit = null)
    {
        $startDate = date("Y-m-d", strtotime($startDate));
        $endDate   = date("Y-m-d", strtotime($endDate));
        $totalDays = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24); 
        $work_days = 0;
        #----------------------------------------------
        # Check Holiday with unit & month_year
        $total_holidays = DB::table("hr_yearly_holiday_planner")
            ->where("hr_yhp_unit", $unit)
            ->whereBetween("hr_yhp_dates_of_holidays", [$startDate, $endDate])
            ->count(); 

        $work_days = (($totalDays+1)-$total_holidays); 
        return $work_days;
    }


    //get employee info
    public function employeeInfo($unit = null, $floor=null, $department=null, $section=null, $subSection=null, $salaryMonth=null)
    {  
        $salaryMonth = date("Y-m", strtotime($salaryMonth)); 

        DB::statement(DB::raw('set @serial=0'));
    	return DB::table("hr_as_basic_info AS b")
    		->select(
                DB::raw('@serial := @serial + 1 AS serial'),
    			"bd.hr_bn_associate_name AS name",
    			"b.as_doj AS doj",
                'dg.hr_designation_name_bn AS designation', 
                'dg.hr_designation_grade AS grade', 
    			"b.as_id",
                "b.as_ot",
                "b.as_emp_type_id AS type",
    			"b.temp_id",
    			"b.associate_id AS associate",
    			"b.as_name",
    			"b.as_unit_id AS unit",
    			"ben.ben_current_salary AS salary", 
    			"ben.ben_basic AS basic", 
    			"ben.ben_house_rent AS house", 
    			"ben.ben_medical AS medical", 
    			"ben.ben_transport AS transport", 
    			"ben.ben_food AS food"  
    		)
    		->leftJoin("hr_employee_bengali AS bd", "bd.hr_bn_associate_id", "=", "b.associate_id")
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id') 
            ->leftJoin('hr_benefits AS ben', function($join){
            	$join->on('ben.ben_as_id', '=', 'b.associate_id');
            	$join->where('ben.ben_status', '=', 1);
            }) 
            ->where(function($c) use($unit, $floor, $department, $section, $subSection){
				$c->where("b.as_unit_id", $unit);
				$c->where("b.as_department_id", $department);
				if (!empty($floor))
				{
					$c->where("b.as_floor_id", $floor);
				} 
                if (!empty($section))
                {
                    $c->where("b.as_section_id", $section);
                } 
                if (!empty($subSection))
                {
                    $c->where("b.as_subsection_id", $subSection);
                }  
            })
            ->where(DB::raw("DATE_FORMAT(b.as_doj, '%Y-%m')"), "<=", $salaryMonth)
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->where('b.as_status',1) // checking status
    		->paginate(24);  
    }

}
