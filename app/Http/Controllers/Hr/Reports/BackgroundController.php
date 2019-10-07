<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\EmployeeBengali;
use DB, ACL, PDF;

class BackgroundController extends Controller
{
	public function backgroundVerification(Request $request){
       $info = DB::table('hr_as_basic_info AS b')
            ->where("b.associate_id", $request->associate_id)
            ->select(
                'b.*',
                'u.hr_unit_name',
                'u.hr_unit_name_bn',
                'u.hr_unit_address',
                'u.hr_unit_address_bn',
                'f.hr_floor_name',
                'f.hr_floor_name_bn',
                'l.hr_line_name',
                'l.hr_line_name_bn',
                's.hr_shift_name',
                'dp.hr_department_name',
                'dp.hr_department_name_bn',
                'dg.hr_designation_name',
                'dg.hr_designation_name_bn',
                'a.*',
                'be.*',
                'm.*', 
                'e.hr_emp_type_name', 
                'ar.hr_area_name',  
                'se.hr_section_name', 
                'se.hr_section_name_bn', 
                'sb.hr_subsec_name',
                'sb.hr_subsec_name_bn',
                'bn.*',
                # unit/floor/line/shif
                DB::raw(" 
                    CONCAT_WS('. ', 
                        CONCAT('Unit: ', u.hr_unit_name), 
                        CONCAT('Floor: ', f.hr_floor_name),
                        CONCAT('Line: ', l.hr_line_name)
                    ) AS unit_floor_line
                "),  
                # permanent district & upazilla
                "per_dist.dis_name AS permanent_district",
                "per_dist.dis_name_bn AS permanent_district_bn",
                "per_upz.upa_name AS permanent_upazilla",
                "per_upz.upa_name_bn AS permanent_upazilla_bn", 
                # present district & upazilla
                "pres_dist.dis_name AS present_district",
                "pres_dist.dis_name_bn AS present_district_bn",
                "pres_upz.upa_name AS present_upazilla",
                "pres_upz.upa_name_bn AS present_upazilla_bn" 
            )
            ->leftJoin('hr_area AS ar', 'ar.hr_area_id', '=', 'b.as_area_id')
            ->leftJoin('hr_section AS se', 'se.hr_section_id', '=', 'b.as_area_id')
            ->leftJoin('hr_subsection AS sb', 'sb.hr_subsec_id', '=', 'b.as_area_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
            ->leftJoin('hr_floor AS f', 'f.hr_floor_id', '=', 'b.as_floor_id')
            ->leftJoin('hr_line AS l', 'l.hr_line_id', '=', 'b.as_line_id')
            ->leftJoin('hr_shift AS s', 's.hr_shift_id', '=', 'b.as_shift_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin("hr_as_adv_info AS a", "a.emp_adv_info_as_id", "=", "b.associate_id")
            ->leftJoin('hr_benefits AS be',function ($leftJoin) {
                $leftJoin->on('be.ben_as_id', '=' , 'b.associate_id') ;
                $leftJoin->where('be.ben_status', '=', '1') ;
            }) 
            ->leftJoin('hr_med_info AS m', 'm.med_as_id', '=', 'b.associate_id')

            #permanent district & upazilla
            ->leftJoin('hr_dist AS per_dist', 'per_dist.dis_id', '=', 'a.emp_adv_info_per_dist')
            ->leftJoin('hr_upazilla AS per_upz', 'per_upz.upa_id', '=', 'a.emp_adv_info_per_upz')
            #present district & upazilla
            ->leftJoin('hr_dist AS pres_dist', 'pres_dist.dis_id', '=', 'a.emp_adv_info_pres_dist')
            ->leftJoin('hr_upazilla AS pres_upz', 'pres_upz.upa_id', '=', 'a.emp_adv_info_pres_upz') 
            ->leftJoin('hr_employee_bengali AS bn', 'bn.hr_bn_associate_id', '=', 'b.associate_id')  
            ->first();


        if ($request->get('pdf') == true) {     
            $data = ['info' => $info];
            $pdf = PDF::loadView('hr/reports/background_verification_pdf', $data);
            return $pdf->download('Background_Verification_'.date('d_F_Y').'.pdf'); 
        }
 
        return view('hr/reports/background_verification', compact('info'));
    }

    public function backgroundVerificationStore(Request $request){
    	dd($request->all());
    }
}
