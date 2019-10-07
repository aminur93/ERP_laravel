<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Floor;
use App\Models\Hr\Section;
use App\Models\Hr\Subsection;
use App\Models\Hr\AttendanceBonus;
use App\Models\Hr\HrMonthlySalary;
use DB, PDF;
use Attendance;

class SalarySheetController extends Controller
{    
    public function showForm(Request $request)
    {   
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id'); 
        #-------------------------------------------------- 
        $dataList = $this->getSalaryData($request, true);
        // dd($dataList);
        //dd($info->employee);
        if ($request->get('pdf') == true) 
        { 
            $pdf = PDF::loadView('hr/reports/salary_sheet_pdf', ['info'=>$info]);
            return $pdf->download('Salary_Sheet_Report_'.date('d_F_Y').'.pdf');
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

        return view("hr/reports/salary_sheet", compact(
            "dataList", 
            "unitList", 
            "areaList",
            "floorList",
            "deptList",
            "sectionList", 
            "subSectionList",
            "unit_id" 
        ));
    }

    // save salary report
    public function saveSalarySheet(Request $request)
    {
        $resultList = $this->getSalaryData($request);
        return $resultList;
    }

    // get salary data
    public function getSalaryData($request, $paginate=false)
    {
        date_default_timezone_set('Asia/Dhaka');
        $en = array('0','1','2','3','4','5','6','7','8','9', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',',');
        $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',',');
        $data       = [];
        $user_id    = auth()->user()->id;
        $work_days  = $this->workDays(
            $request->start_date, 
            $request->end_date, 
            $request->unit
        );
        if($paginate) {
            $employee_list   = $this->employeeInfo($request->unit, $request->floor, $request->department, $request->section, $request->subSection, $request->start_date, 'paginate');
        } else {
            $employee_list   = $this->employeeInfo($request->unit, $request->floor, $request->department, $request->section, $request->subSection, $request->start_date);            
        }
        foreach($employee_list as $key=>$employee) {
            /*
            *--------------------------------------------------------------
            * ATTENDANCE
            *--------------------------------------------------------------
            */            
            $startDate          = date("Y-m-d", strtotime($request->start_date));
            $endDate            = date("Y-m-d", strtotime($request->end_date)); 
            $track              = Attendance::track($employee->associate, $employee->as_id, $employee->unit, $startDate, $endDate);
            $salary_add_deduct  = Attendance::salaryAddDeduct($employee->associate, $startDate);
            #---------------------------------------------------------------
            $totalDays = 30;
            $attends   = $track->attends;
            $leaves    = $track->leaves;
            $absents   = $track->absents;
            $lates     = $track->lates;
            $holidays  = $track->holidays;
            if($employee->as_ot == 1){
                $overtimes      = $track->overtime_minutes; 
                $overtime_time  = $track->overtime_time;
            } else {
                $overtimes      = 0; 
                $overtime_time  = null;
            }
            /*
            *--------------------------------------------------------------
            * Attendance Bonus
            *--------------------------------------------------------------
            */
            $bonusamount = DB::table('hr_attendance_bonus as a')->Select('a.*')
                            ->where('a.unit',$request->unit)
                            ->where('a.status',1)
                            ->first();
            $present_bonous = 0;
            $date1 = strtotime(date("Y-m", strtotime($employee->doj)));
            $date2 = strtotime(date("Y-m", strtotime($startDate)));
            if ($lates <= 3 && $leaves <= 1 && $employee->type == 3 && ($date1 <= $date2)) { 
                if ($date1 == $date2) {
                    if(isset($bonusamount->first_month)) {
                        $present_bonous = $bonusamount->first_month;
                    }
                } else {
                    if(isset($bonusamount->first_month)) {
                        $present_bonous = $bonusamount->first_month;
                    }
                }
            }
            /*
            *--------------------------------------------------------------
            * EXPENSE & PAYMENT
            *--------------------------------------------------------------
            */ 
            $basic              = $employee->basic?$employee->basic:"0.00"; 
            $salary_absent      = $basic?number_format(($basic/$totalDays)*$absents, 2, ".", ""):"0.00"; 
            $salary_half_day    = "0.00";
            $salary_advance     = $salary_add_deduct["advp_deduct"];
            $salary_product     = $salary_add_deduct["cg_deduct"];
            $salary_food        = $salary_add_deduct["food_deduct"];
            $salary_others      = $salary_add_deduct["others_deduct"];
            $salary_stamp       = "10.00";
            /* TOTAL & NET PAY*/ 
            $gross_salary   = number_format(($employee->salary?$employee->salary:0), 2, ".", "");
            $salary_net     = number_format(($gross_salary-($salary_absent+$salary_half_day+$salary_product+$salary_advance+$salary_others+$salary_food)), 2, ".", "");
            if($employee->as_ot == 1){
                $overtime_rate   = number_format((($basic/208)*2), 2, ".", "");
            } else {
                $overtime_rate   = 0;
            }
            $overtime_salary        = number_format($overtime_rate*($overtimes/60), 2, ".", ""); 
            $salary_advance_adjust  = $salary_add_deduct["salary_add"];
            $total_pay              = number_format((($salary_net+$overtime_salary+$present_bonous+$salary_advance_adjust)-($salary_stamp)), 2, ".", "");
            if($paginate) {
                $data['local'][$key]['no']           = str_replace($en, $bn, ($employee_list->perPage() * ($employee_list->currentPage()-1)) + ($key + 1));
                $data['local'][$key]['name']         = $employee->name;
                $data['local'][$key]['doj']          = str_replace($en, $bn, date("d-m-Y", strtotime($employee->doj)));
                $data['local'][$key]['designation']  = $employee->designation;
                $data['local'][$key]['basic']        = str_replace($en, $bn,(string)number_format($employee->basic,2, '.', ','));
                $data['local'][$key]['house']        = str_replace($en, $bn,(string)number_format($employee->house,2, '.', ','));
                $data['local'][$key]['medical']      = str_replace($en, $bn,(string)number_format($employee->medical,2, '.', ','));
                $data['local'][$key]['transport']    = str_replace($en, $bn,(string)number_format($employee->transport,2, '.', ','));
                $data['local'][$key]['food']         = str_replace($en, $bn,(string)number_format($employee->food,2, '.', ','));
                $data['local'][$key]['associate']    = $employee->associate;
                $data['local'][$key]['lates']        = str_replace($en, $bn, $lates);
                $data['local'][$key]['grade']        = str_replace($en, $bn, $employee->grade);
                $data['local'][$key]['gross_salary'] = str_replace($en, $bn,(string)number_format($gross_salary,2, '.', ','));
                $data['local'][$key]['attends']      = str_replace($en, $bn, $attends);
                $data['local'][$key]['holidays']     = str_replace($en, $bn, $holidays);
                $data['local'][$key]['absents']      = str_replace($en, $bn, $absents);
                $data['local'][$key]['leaves']       = str_replace($en, $bn, $leaves);
                $data['local'][$key]['total_day']    = str_replace($en, $bn, ($attends+$holidays+$leaves));
                $data['local'][$key]['salary_absent']    = str_replace($en, $bn,(string)number_format($salary_absent,2, '.', ','));
                $data['local'][$key]['salary_half_day']  = str_replace($en, $bn,(string)number_format($salary_half_day,2, '.', ','));
                $data['local'][$key]['salary_advance']   = str_replace($en, $bn,(string)number_format($salary_advance,2, '.', ','));
                $data['local'][$key]['salary_stamp']     = str_replace($en, $bn,(string)number_format($salary_stamp,2, '.', ','));
                $data['local'][$key]['salary_product']   = str_replace($en, $bn,(string)number_format($salary_product,2, '.', ','));
                $data['local'][$key]['salary_food']      = str_replace($en, $bn,(string)number_format($salary_food,2, '.', ','));
                $data['local'][$key]['salary_others']    = str_replace($en, $bn,(string)number_format($salary_others,2, '.', ','));
                $data['local'][$key]['salary_net']       = str_replace($en, $bn,(string)number_format($salary_net,2, '.', ','));
                $data['local'][$key]['overtime_salary']  = str_replace($en, $bn,(string)number_format($overtime_salary,2, '.', ','));
                $data['local'][$key]['overtime_rate']    = str_replace($en, $bn, $overtime_rate);
                $data['local'][$key]['overtime_time']    = str_replace($en, $bn, $overtime_time);
                $data['local'][$key]['present_bonous']   = str_replace($en, $bn,(string)number_format($present_bonous,2, '.', ','));
                $data['local'][$key]['total_pay']        = str_replace($en, $bn,(string)number_format($total_pay,2, '.', ','));
                
                $data['local'][$key]['salary_advance_adjust'] = str_replace($en, $bn,(string)number_format($salary_advance_adjust,2, '.', ','));
            } else {
                $data['as_id']          = $employee->associate;
                $data['month']          = date("n", strtotime($request->start_date)); // without 0 EX: 03 -> 3
                $data['year']           = date("Y", strtotime($request->end_date));
                $data['gross']          = $this->nullCheck($gross_salary);
                $data['basic']          = $this->nullCheck($employee->basic);
                $data['house']          = $this->nullCheck($employee->house);
                $data['medical']        = $this->nullCheck($employee->medical);
                $data['transport']      = $this->nullCheck($employee->transport);
                $data['food']           = $this->nullCheck($employee->food);
                $data['late_count']     = $this->nullCheck($lates);
                $data['present']        = $this->nullCheck($attends);
                $data['holiday']        = $this->nullCheck($holidays);
                $data['absent']         = $this->nullCheck($absents);
                $data['leave']          = $this->nullCheck($leaves);
                $data['ot_rate']        = $this->nullCheck($overtime_rate);
                $data['ot_hour']        = $this->nullCheck($overtime_time);
                $data['absent_deduct']  = $this->nullCheck($salary_absent);
                $data['half_day_deduct']        = $this->nullCheck($salary_half_day);
                $data['salary_add_deduct_id']   = $salary_add_deduct["add_deduct_id"];
                $data['salary_payable']         = $this->nullCheck($salary_net);
                $data['attendance_bonus']       = $this->nullCheck($present_bonous);


                $exist  = HrMonthlySalary::where(['as_id' => $data['as_id'], 'month' => $data['month'], 'year' => $data['year']])->first();
                if(isset($exist->id)) {
                    // update data if exist
                    $data['updated_by'] = $user_id;
                    $data['updated_at'] = date('Y-m-d');
                    HrMonthlySalary::where('id', $exist->id)->update($data);
                } else {
                    // insert data if not exist
                    $data['created_by'] = $user_id;
                    $data['created_at'] = date('Y-m-d');
                    HrMonthlySalary::insert($data);
                }
            }
        }
        if($paginate){
            $data['global']['links'] = !empty($employee_list->links())?$employee_list->appends(request()->query())->links():null;
            $data['global']['dateDate'] = str_replace($en, $bn, date("d-m-Y"));
            $data['global']['dateTime'] = str_replace($en, $bn, date("H:i"));
            $data['global']['start_date']     = str_replace($en, $bn, date("d-F-Y", strtotime($request->start_date)));
            $data['global']['end_date']       = str_replace($en, $bn, date("d-F-Y", strtotime($request->end_date)));
            $data['global']['work_days']      = str_replace($en, $bn, $work_days);
            $data['global']['disbursed_date'] = str_replace($en, $bn, date("d-F-y", strtotime($request->disbursed_date)));
            $data['global']['unit']           = Unit::where("hr_unit_id", $request->unit)->value("hr_unit_name_bn");
            $data['global']['department']     = Department::where("hr_department_id", $request->department)->value("hr_department_name_bn");
            $data['global']['floor']          = Floor::where("hr_floor_id", $request->floor)->value("hr_floor_name_bn");
            $data['global']['sec_name']       = Section::where("hr_section_id", $request->section)->value("hr_section_name_bn");        
            $data['global']['sub_sec_name']   = Subsection::where("hr_subsec_id", $request->subSection)->value("hr_subsec_name_bn");
        }
        return $data;
    }

    //  null check function
    public function nullCheck($value) {
        if($value == NULL) {
            $value = 0;
        }
        return $value;
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
    public function employeeInfo($unit = null, $floor=null, $department=null, $section=null, $subSection=null, $salaryMonth=null, $paginate=null)
    {  
        $salaryMonth = date("Y-m", strtotime($salaryMonth)); 

        $result = DB::table("hr_as_basic_info AS b")
            ->select(
                "bd.hr_bn_associate_name AS name",
                "b.as_doj AS doj",
                'dg.hr_designation_name_bn AS designation', 
                'dg.hr_designation_grade AS grade', 
                "b.as_id",
                "b.as_ot",
                "b.temp_id",
                "b.associate_id AS associate",
                "b.as_emp_type_id AS type",
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
                if (!empty($floor)) {
                    $c->where("b.as_floor_id", $floor);
                } 
                if (!empty($section)) {
                    $c->where("b.as_section_id", $section);
                } 
                if (!empty($subSection)) {
                    $c->where("b.as_subsection_id", $subSection);
                } 
            })  
            ->where(DB::raw("DATE_FORMAT(b.as_doj, '%Y-%m')"), "<=", $salaryMonth)
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->where('b.as_status',1); // checking status
            if($paginate != null) {
              return $result->paginate(25);  
            } else {
              return $result->get();
            }
    }

}
