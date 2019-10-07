<?php

namespace App\Http\Controllers\Hr\Reports;

use App\Http\Controllers\Controller;
use App\MOdels\Hr\Benefits;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Employee;
use App\Models\Hr\Floor;
use App\Models\Hr\HrMonthlySalary;
use App\Models\Hr\Section;
use App\Models\Hr\Subsection;
use App\Models\Hr\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalarySheetCustomController extends Controller
{
	public function convertMonthNameToNumber($month)
	{
		return Carbon::parse("1 $month")->month;
	}

    public function index()
    {
    	$data['getEmployees'] = Employee::getSelectIdNameEmployee();
        $data['unitList'] = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id'); 
        $data['areaList'] = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id'); 
        $data['floorList'] = Floor::getFloorList();
        $data['deptList'] = Department::getDeptList();
        $data['sectionList'] = Section::getSectionList();
        $data['subSectionList'] = Subsection::getSubSectionList();
        $data['salaryMin'] = Benefits::getSalaryRangeMin();
        $data['salaryMax'] = Benefits::getSalaryRangeMax();
        //return $data;
    	return view('hr.reports.salary_sheet_custom', $data);
    }

    public function individualSearch(Request $request)
    {
    	$input = $request->all();
    	
    	try {
            // form explode 
            $formExplode = explode('-', $input['form_date']);
            $input['formMonth'] = $this->convertMonthNameToNumber($formExplode[0]);
            $input['formYear'] = $formExplode[1];
            // to explode 
            $toExplode = explode('-', $input['to_date']);
            $input['toMonth'] = $this->convertMonthNameToNumber($toExplode[0]);
            $input['toYear'] = $toExplode[1];
            $getSalaryList = HrMonthlySalary::getSalaryListWithEIdFormTo($input);
            $getEmployee = Employee::getEmployeeAssociateIdWise($input['as_id']);
            $title = 'Unit : '.$getEmployee->unit['hr_unit_name_bn'].' - Location : '.$getEmployee->location['hr_unit_name_bn'];
            
            $pageHead['current_date'] = date('d-m-Y');
            $pageHead['current_time'] = date('H:i');
            $pageHead['pay_date'] = '';
            $pageHead['unit_name'] = $getEmployee->unit['hr_unit_name_bn'];
            $pageHead['for_date'] = $input['form_date'].' - '.$input['to_date'];
            //$pageHead['total_work_day'] = $input['disbursed_date'];
            $pageHead['floor_name'] = $getEmployee->floor['hr_floor_name_bn'];

            return view('hr.common.view_salary_sheet_list', compact('getSalaryList', 'title', 'pageHead'));
        } catch (\Exception $e) {
           return 'error'; 
        }
    }

    public function groupWiseSalarySheet($associate_id, $input)
    {
        // get salary list filter employee id, month, year
        $getSalary = HrMonthlySalary::getSalaryListFilterWise($associate_id, $input['month'], $input['year'], $input['min_sal'], $input['max_sal']);
        if($getSalary != null){
            if($input['ot_range'] != ''){
                if($input['ot_range'] == 2){
                    $presentOt = $getSalary->present * 2;
                }else{
                    $presentOt = $getSalary->present * 4;
                }

                if($getSalary->ot_hour > $presentOt){
                    $getSalary->ot_hour = $presentOt;
                }
            }
            //$getSalaryList[] = $getSalary;
        }
        return $getSalary;
        
    }

    public function multiSearch(Request $request)
    {
        $input = $request->all();
        $input['unit'] = intval($input['unit']);
        
        try {
            //getEmployee Unit, Floor, Area, Deparment, Section, SubScetion with
            $getEmployees = Employee::getEmployeeFilterWise($input);
            $getUnit = Unit::getUnitNameBangla($input['unit']);
            
            if($getUnit != null){
                $unitName = $getUnit->hr_unit_name_bn;
            }else{
                $unitName = '';
            }
            $getFloor = Floor::getFloorNameBangla($input['floor']);
            
            if($getFloor != null){
                $floorName = $getFloor->hr_floor_name_bn;
            }else{
                $floorName = '';
            }
            
            $pageHead['current_date'] = date('d-m-Y');
            $pageHead['current_time'] = date('H:i');
            $pageHead['pay_date'] = $input['disbursed_date'];
            $pageHead['unit_name'] = $unitName;
            $pageHead['for_date'] = $input['month'].' - '.$input['year'];
            //$pageHead['total_work_day'] = $input['disbursed_date'];
            $pageHead['floor_name'] = $floorName;
            $result['pageHead'] = $pageHead;
            //
            $getSalaryList = array();
            $result['group1'] = array();
            $result['group2'] = array();
            $result['group3'] = array();
            foreach ($getEmployees as $employee) {
                if((intval($input['unit']) == $employee->as_unit_id) && (intval($input['unit']) == $employee->as_location)){

                    $group1 = $this->groupWiseSalarySheet($employee->associate_id, $input);
                    if($group1 != null){
                        $result['group1'][] = $group1;
                    }

                }elseif((intval($input['unit']) == $employee->as_unit_id) && (intval($input['unit']) != $employee->as_location)){

                    $group2 = $this->groupWiseSalarySheet($employee->associate_id, $input);
                    if($group2 != null){
                        $result['group2'][] = $group2;
                    }

                }elseif((intval($input['unit']) != $employee->as_unit_id) && (intval($input['unit']) == $employee->as_location)){

                    $group3 = $this->groupWiseSalarySheet($employee->associate_id, $input);
                    if($group3 != null){
                        $result['group3'][] = $group3;
                    }

                }else{
                    return "error";                    
                }
                
            }
            //return $result['group3'];
            return view('hr.common.group_wise_salary_sheet_list', $result);

        } catch (\Exception $e) {
            return 'error'; 
        }
    }
}
