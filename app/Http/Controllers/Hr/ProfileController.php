<?php

namespace App\Http\Controllers\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use Auth, DB, Session; 
use App\Models\Hr\Increment;
use App\Models\Hr\promotion;

class ProfileController extends Controller
{

    public function showProfile()
    {
        $associate_id = Auth::user()->associate_id;
 
        $info = DB::table('hr_as_basic_info AS b')
            ->select(
                'b.*',
                'u.hr_unit_name',
                'u.hr_unit_name_bn',
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
            ->where("b.associate_id", $associate_id)
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions()) 
            ->first();   
     
        if(empty($info)) abort(404, "User not found!");

        $loans = DB::table("hr_loan_application")
            ->select(
            "*",
            DB::raw("
                CASE 
                    WHEN hr_la_status = '0' THEN 'Applied' 
                    WHEN hr_la_status = '1' THEN 'Approved' 
                    WHEN hr_la_status = '2' THEN 'Declined' 
                END AS hr_la_status
            ")
        )
        ->where("hr_la_as_id", $associate_id)
        ->get(); 

        
        $leaves = DB::table('hr_leave')
            ->select(
                DB::raw(" 
                    YEAR(leave_from) AS year, 
                    SUM(CASE WHEN leave_type = 'Casual' THEN DATEDIFF(leave_to, leave_from)+1 END) AS casual,
                    SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS earned,
                    SUM(CASE WHEN leave_type = 'Sick' THEN DATEDIFF(leave_to, leave_from)+1 END) AS sick,
                    SUM(CASE WHEN leave_type = 'Maternity' THEN DATEDIFF(leave_to, leave_from)+1 END) AS maternity,
                    SUM(DATEDIFF(leave_to, leave_from)+1) AS total
                ")
            )
            ->where('leave_status', '1')
            ->where("leave_ass_id", $associate_id)
            ->groupBy('year')
            ->orderBy('year', 'DESC')
            ->get(); 
  


        $records = DB::table('hr_dis_rec AS r')
            ->select(
                'r.*', 
                DB::raw("CONCAT_WS(' to ', r.dis_re_doe_from, r.dis_re_doe_to) AS date_of_execution"), 
                'i.hr_griv_issue_name', 
                's.hr_griv_steps_name' 
            )
            ->leftJoin('hr_grievance_issue AS i', 'i.hr_griv_issue_id', '=', 'r.dis_re_issue_id')
            ->leftJoin('hr_grievance_steps AS s', 's.hr_griv_steps_id', '=', 'r.dis_re_issue_id')
            ->where('r.dis_re_offender_id', $associate_id)
            ->get();

       

        $promotions = DB::table("hr_promotion AS p")
            ->select(
                "d1.hr_designation_name AS previous_designation",
                "d2.hr_designation_name AS current_designation",
                "p.eligible_date",
                "p.effective_date"
            )
            ->leftJoin("hr_designation AS d1", "d1.hr_designation_id", "=", "p.previous_designation_id")
            ->leftJoin("hr_designation AS d2", "d2.hr_designation_id", "=", "p.current_designation_id")
            ->where('p.associate_id', $associate_id)
            ->orderBy('p.effective_date', "DESC")
            ->get();

        $increments = Increment::where('associate_id', $associate_id)
            ->orderBy('effective_date', 'DESC')->get();

        $educations = DB::table('hr_education AS e')
            ->select(
                'l.education_level_title',
                'dt.education_degree_title',
                'e.education_level_id',
                'e.education_degree_id_2',
                'e.education_major_group_concentation',
                'e.education_institute_name',
                'r.education_result_title',
                'e.education_result_id',
                'e.education_result_marks',
                'e.education_result_cgpa',
                'e.education_result_scale',
                'e.education_passing_year' 
            )
            ->leftJoin('hr_education_level AS l', 'l.id', '=', 'e.education_level_id')
            ->leftJoin('hr_education_degree_title AS dt', 'dt.id', '=', 'e.education_degree_id_1')
            ->leftJoin('hr_education_result AS r', 'r.id', '=', 'e.education_result_id')
            ->where("e.education_as_id", $associate_id)
            ->get();

        return view('hr.profile', compact(
            'info', 
            'loans', 
            'leaves', 
            'records',
            'promotions',
            'increments',
            'educations'
        ));

    }
}
