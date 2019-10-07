<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\EmpType;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use DB, ACL, DataTables,Validator;

class FileTagController extends Controller
{
    public function showForm(){
    	$employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 
    	return view('hr/reports/file_tag',compact('employeeTypes','unitList'));
    }
        # Associate ID CARD Search
    public function fileTagSearch(Request $request)
    {   
        ACL::check(["permission" => "hr_time_id_card"]);
        #-----------------------------------------------------------#  

        if (!is_array($request->associate_id) || sizeof($request->associate_id) == 0)
            return response()->json(['idcard'=>'<div class="alert alert-danger">Please Select Associate ID</div>', 'printbutton'=>'']);


        $employees = [];
        $employees = DB::table('hr_as_basic_info AS b')
            ->select(
                'b.as_id',
                'b.associate_id',
                'b.as_emp_type_id',
                'b.temp_id',
                'b.as_pic',
                'u.hr_unit_name',
                'u.hr_unit_name_bn', 
                'u.hr_unit_logo', 
                'b.as_name', 
                'bn.hr_bn_associate_name', 
                'b.as_doj', 
                'd.hr_department_name', 
                'd.hr_department_name_bn', 
                'dg.hr_designation_name', 
                'dg.hr_designation_name_bn', 
                'm.med_blood_group'
            ) 
            ->leftJoin('hr_employee_bengali AS bn','bn.hr_bn_associate_id', 'b.associate_id')
            ->leftJoin('hr_unit AS u','u.hr_unit_id', 'b.as_unit_id')
            ->leftJoin('hr_department AS d','d.hr_department_id', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg','dg.hr_designation_id', 'b.as_designation_id') 
            ->leftJoin('hr_med_info AS m','m.med_as_id', 'b.associate_id')
            ->whereIn('b.associate_id', $request->associate_id) 
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->get(); 

        $data['filetag'] = "";
        if (count($employees)>0)
        {
            foreach ($employees as $associate) 
            {
                    $data['filetag'] .= "
                    <div style=\"border-style: solid; width:900px; height: 32%; margin:10px;\">
                    <p style=\"text-align:center; font-size:72px; font-weight:700; margin:0px; padding:0px;\">".strtoupper($associate->as_name)."</p>
                    <p style=\"text-align:center; font-weight:600; font-size:48px; margin:0px; padding:0px;\">".
                                (!empty($associate->associate_id)?
                                (substr_replace($associate->associate_id, "<big style='font-size:72px; font-weight:700'>$associate->temp_id</big>", 3, 6)):
                                null) ."</p>
                    <p style=\"text-align:center; font-size:36px; font-weight:700; margin:0px; padding:0px;\">".strtoupper($associate->hr_designation_name)."</p>
                    <p style=\"text-align:center; font-size:60px; font-weight:700; margin:0px; padding:0px;\">".date('d-M-Y',strtotime($associate->as_doj))."</p>
                    </div>";
            } 
        } 
        else
        {
            $data['filetag'] = '<div class="alert alert-danger">No File Tag Found!</div>';
        }
        
        $data['printbutton'] = "";
        if (strlen($data['filetag'])>1)
        {
            $data['printbutton'] .= "<button onclick=\"printContent('idCardPrint')\" type=\"button\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-print\" title=\"Print\"></i></button>";
        }

        return response()->json($data); 
    }
}
