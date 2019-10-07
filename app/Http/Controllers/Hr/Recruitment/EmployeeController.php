<?php
namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Hr\Recruitment\CostMappingController AS CostMappingController;
use App\Http\Controllers\Hr\DashboardController as DashboardController;
use App\Models\Hr\Employee;
use App\Models\Hr\EmployeeBengali;
use App\Models\Hr\Nominee;
use App\Models\Hr\EmpType;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use App\Models\Hr\Line;
use App\Models\Hr\Shift;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Designation;
use App\Models\Hr\Increment;
use App\Models\Hr\promotion;
use App\Models\Hr\Section;
use App\Models\Hr\Subsection;
use App\Models\Hr\EducationLevel;
use App\Models\Hr\LoanApplication;
use App\Models\Hr\DesignationUpdateLog;
use Yajra\Datatables\Datatables;
use App\Models\Hr\MapCostUnit;
use App\Models\Hr\MapCostArea;
use App\Models\Hr\Station;
use Auth, DB, Validator, Image, Session, ACL;

class EmployeeController extends Controller
{
    public function showEmployeeForm()
    {   
        ACL::check(["permission" => "hr_recruitment_employer_add"]);
        #-----------------------------------------------------------#  
        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id');
        return view('hr/recruitment/add_employee', compact('employeeTypes', 'unitList', 'areaList'));
    }

    public function saveEmployee(Request $request)
    {   
        ACL::check(["permission" => "hr_recruitment_employer_add"]);
        #-----------------------------------------------------------# 

        $validator = Validator::make($request->all(), [
            'as_emp_type_id'    => 'required|max:11',
            'as_unit_id'        => 'max:11',
            'as_floor_id'       => 'max:11',
            'as_line_id'        => 'max:11',
            'as_shift_id'       => 'max:11',

            'as_area_id'        => 'required|max:11',
            'as_department_id'  => 'required|max:11',
            'as_section_id'     => 'required|max:11',
            'as_subsection_id'  => 'required|max:11',

            'as_designation_id' => 'required|max:11',

            'as_doj'            => 'required|date',
            'associate_id'      => 'required|unique:hr_as_basic_info|max:10|min:10', 
            'temp_id'           => 'required|max:6|min:6', 
            'as_name'           => 'required|max:128',
            'as_gender'         => 'required|max:10',
            'as_dob'            => 'required|date',
            'as_contact'        => 'required|max:11',
            'as_ot'             => 'required|max:1',
            'as_pic'            => 'image|mimes:jpeg,png,jpg|max:200',
        ]);

        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fields!');
        } 
        else
        { 
            //-----------IMAGE UPLOAD---------------------     
            $as_pic = null;
            if($request->hasFile('as_pic'))
            {
                $file = $request->file('as_pic');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $as_pic = '/assets/images/employee/' . $filename;
                Image::make($file)->resize(180, 200)->save(public_path( $as_pic ) );
            }

            //-----------Store Data---------------------
            $user = new Employee;
            $user->as_emp_type_id = $request->as_emp_type_id;
            $user->as_unit_id     = $request->as_unit_id;

            // if employee is worker then store the unit, floor, line & shift id
            $user->as_floor_id    = $request->as_floor_id;
            $user->as_line_id     = $request->as_line_id;
            $user->as_shift_id    = $request->as_shift_id;

            $user->as_area_id     = $request->as_area_id;
            $user->as_department_id = $request->as_department_id;
            $user->as_section_id  = $request->as_section_id;
            $user->as_subsection_id  = $request->as_subsection_id;
            $user->as_designation_id = $request->as_designation_id;
            $user->as_doj         = (!empty($request->as_doj)?date('Y-m-d',strtotime($request->as_doj)):null);    
            $user->temp_id        = $request->temp_id;
            $user->associate_id   = $request->associate_id;
            $user->as_name        = strtoupper($request->as_name);
            $user->as_gender      = $request->as_gender;
            $user->as_dob         = (!empty($request->as_dob)?date('Y-m-d',strtotime($request->as_dob)):null);
            $user->as_contact     = $request->as_contact;        
            $user->as_ot          = $request->as_ot; 
            $user->as_pic         = $as_pic;
            $user->created_at     = date("Y-m-d H:i:s"); 
            $user->created_by     = Auth::user()->id; 
            $user->as_status      = 1; 
            
            if ($user->save())
            { 
                return back()
                    ->with('associate_id', $request->associate_id)
                    ->with('associate_name', $request->as_name)
                    ->with('success', 'Save Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            } 
        } 
    } 

    public function showList()
    {
        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 

        $reportCount = (new DashboardController)->reportCount();

        $employeeTypes = EmpType::where('hr_emp_type_status', '1')->distinct()->orderBy('hr_emp_type_name', 'ASC')->pluck('hr_emp_type_name'); 
        $empTypes = EmpType::where('hr_emp_type_status', '1')
                            ->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->distinct()
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->orderBy('hr_unit_short_name', 'ASC')
            ->pluck('hr_unit_short_name'); 
        $allUnit= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
                        ->pluck('hr_unit_name', 'hr_unit_id');
        $floorList = Floor::where('hr_floor_status', '1')->distinct()->orderBy('hr_floor_name', 'ASC')->pluck('hr_floor_name'); 
        $lineList  = Line::where('hr_line_status', '1')->distinct()->orderBy('hr_line_name', 'ASC')->pluck('hr_line_name'); 
        $shiftList  = Shift::where('hr_shift_status', '1')->distinct()->orderBy('hr_shift_name', 'ASC')->pluck('hr_shift_name'); 
        $areaList  = Area::where('hr_area_status', '1')->distinct()->orderBy('hr_area_name', 'ASC')->pluck('hr_area_name');
        $departmentList  = Department::where('hr_department_status', '1')->distinct()->orderBy('hr_department_name', 'ASC')->pluck('hr_department_name');
        $designationList  = Designation::where('hr_designation_status', '1')->distinct()->orderBy('hr_designation_name', 'ASC')->pluck('hr_designation_name');
        $sectionList  = Section::where('hr_section_status', '1')->distinct()->orderBy('hr_section_name', 'ASC')->pluck('hr_section_name');
        $educationList  = EducationLevel::pluck('education_level_title');

        return view('hr.recruitment.employee_list', compact(
            'reportCount',
            'employeeTypes',
            'unitList',
            'floorList',
            'lineList',
            'shiftList',
            'areaList',
            'departmentList',
            'designationList',
            'sectionList',
            'educationList',
            "allUnit",
            "empTypes"
        ));
    }
    public function showListDetails()
    {
        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 

        $reportCount = (new DashboardController)->reportCount();
        
        $empTypes = EmpType::where('hr_emp_type_status', '1')
                            ->pluck('hr_emp_type_name', 'emp_type_id'); 
        $allUnit= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
                        ->pluck('hr_unit_name', 'hr_unit_id');
        $employeeTypes = EmpType::where('hr_emp_type_status', '1')->distinct()->orderBy('hr_emp_type_name', 'ASC')->pluck('hr_emp_type_name'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->distinct()
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->orderBy('hr_unit_short_name', 'ASC')
            ->pluck('hr_unit_short_name'); 
        $floorList = Floor::where('hr_floor_status', '1')->distinct()->whereIn('hr_floor_unit_id', auth()->user()->unit_permissions())->orderBy('hr_floor_name', 'ASC')->pluck('hr_floor_name'); 
        $lineList  = Line::where('hr_line_status', '1')->distinct()->whereIn('hr_line_unit_id', auth()->user()->unit_permissions())->orderBy('hr_line_name', 'ASC')->pluck('hr_line_name'); 
        $shiftList  = Shift::where('hr_shift_status', '1')->distinct()->orderBy('hr_shift_name', 'ASC')->pluck('hr_shift_name'); 
        $areaList  = Area::where('hr_area_status', '1')->distinct()->orderBy('hr_area_name', 'ASC')->pluck('hr_area_name');
        $departmentList  = Department::where('hr_department_status', '1')->distinct()->orderBy('hr_department_name', 'ASC')->pluck('hr_department_name');
        $designationList  = Designation::where('hr_designation_status', '1')->distinct()->orderBy('hr_designation_name', 'ASC')->pluck('hr_designation_name');
        $sectionList  = Section::where('hr_section_status', '1')->distinct()->orderBy('hr_section_name', 'ASC')->pluck('hr_section_name');
        $educationList  = EducationLevel::pluck('education_level_title');

        return view('hr.recruitment.employee_details_list', compact(
            'reportCount',
            'employeeTypes',
            'unitList',
            'floorList',
            'lineList',
            'shiftList',
            'areaList',
            'departmentList',
            'designationList',
            'sectionList',
            'educationList',
            "allUnit",
            "empTypes"
        ));
    }

    //get employee data
    public function getData(Request $request)
    {  

        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 

        $data = DB::table('hr_as_basic_info AS b')
            ->select([
                DB::raw('b.as_id AS serial_no'),
                'b.associate_id',
                'b.as_name',
                'e.hr_emp_type_name AS hr_emp_type_name',
                'u.hr_unit_short_name',
                'f.hr_floor_name',
                'l.hr_line_name', 
                'dp.hr_department_name',
                'dg.hr_designation_name',
                'b.as_gender', 
                'b.as_ot',
                'b.as_status',
                'b.as_oracle_code',
                'b.as_rfid_code'
            ])
            ->leftJoin('hr_area AS a', 'a.hr_area_id', '=', 'b.as_area_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
            ->leftJoin('hr_floor AS f', 'f.hr_floor_id', '=', 'b.as_floor_id')
            ->leftJoin('hr_line AS l', 'l.hr_line_id', '=', 'b.as_line_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
            ->where('b.as_unit_id', $request->unit)
            ->where(function ($query) use ($request) {
                if($request->emp_type != ""){
                    $query->where('b.as_emp_type_id', '=', $request->emp_type);
                }
            })
            ->orderBy('b.as_id','desc')
            ->get();
        
            
        return Datatables::of($data)  
            ->editColumn('as_ot', function($user){
         
               $ot_id= "<span style='display:none;>". $user->as_ot ."-</span>";
              if($user->as_ot==1){
                 $ot_id2="OT";
              }
              else{
                $ot_id2="Non OT";
              }
              $ot_id.= $ot_id.$ot_id2 ;

                //return (($user->as_ot==1)?"OT":"Non OT");
                  return ($ot_id);
            })  
            ->editColumn('as_status', function($user){
                if ($user->as_status == 1)
                {
                    return "Active";
                } 
                elseif ($user->as_status == 2)
                {
                    return "Resign";
                }
                elseif ($user->as_status == 3)
                {
                    return "Terminate";
                }
                elseif ($user->as_status == 4)
                {
                    return "Suspend";
                }
            })  
            ->editColumn('action', function ($user) {

                // $return = "<div class=\"btn-group\" style=\"width:104px\">" . ($user->as_status?"<span class='btn btn-xs disabled btn-info'>Active</span>":"<span class='btn btn-xs disabled btn-warning'>Inactive</span>");
                $return = "<a href=".url('hr/recruitment/employee/show/'.$user->associate_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120 fa-fw\"></i>
                    </a>
                    <a href=".url('hr/recruitment/employee/edit/'.$user->associate_id)." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Edit\" style=\"margin-top:1px;\">
                        <i class=\"ace-icon fa fa-pencil bigger-120 fa-fw\"></i>
                    </a>";
                $return .= "</div>";
                return $return;
            })  
            ->rawColumns([
                'serial_no',    
                'as_status',    
                'action',
                'as_ot'
            ])
            ->make(true); 
    }

    //get employee details data
    public function getDetailsData(Request $request)
    {  

        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 

        $data = DB::table('hr_as_basic_info AS b')
            ->select([
                DB::raw('b.as_id AS serial_no'),
                'b.associate_id',
                'b.as_name',
                'e.hr_emp_type_name AS hr_emp_type_name',
                'u.hr_unit_short_name',
                'f.hr_floor_name',
                'l.hr_line_name', 
                'sft.hr_shift_name',
                'a.hr_area_name', 
                'dp.hr_department_name',
                'dg.hr_designation_name',
                's.hr_section_name',
                'b.as_gender', 
                'b.as_ot',
                'adv.emp_adv_info_religion', 
                'b.as_contact',
                'edu.education_as_id',
                'el.education_level_title',
                'b.as_status',
                'b.as_oracle_code',
                'b.as_rfid_code'
            ])
            ->leftJoin('hr_area AS a', 'a.hr_area_id', '=', 'b.as_area_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
            ->leftJoin('hr_floor AS f', 'f.hr_floor_id', '=', 'b.as_floor_id')
            ->leftJoin('hr_line AS l', 'l.hr_line_id', '=', 'b.as_line_id')
            ->leftJoin('hr_shift AS sft', 'sft.hr_shift_id', '=', 'b.as_shift_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin('hr_section AS s', 's.hr_section_id', '=', 'b.as_section_id') 
            ->leftJoin("hr_as_adv_info AS adv", "adv.emp_adv_info_as_id", "=", "b.associate_id")
            ->leftJoin(DB::raw("(SELECT edu1.*
            FROM hr_education edu1 LEFT JOIN hr_education edu2
             ON (edu1.education_as_id = edu2.education_as_id AND edu1.education_passing_year < edu2.education_passing_year)
            WHERE edu2.id IS NULL) AS edu"), function($query){
                $query->on( 'edu.education_as_id', '=', 'b.associate_id');
            }) 
            ->leftJoin('hr_education_level AS el', 'el.id', '=', 'edu.education_level_id')
            // ->where('b.as_unit_id', auth()->user()->unit_permissions())
            ->where('b.as_unit_id', $request->unit)
            ->where(function ($query) use ($request) {
                if($request->emp_type != ""){
                    $query->where('b.as_emp_type_id', '=', $request->emp_type);
                }
            })
            ->orderBy('b.as_id','desc')
            ->get();
 

        return Datatables::of($data)  
            ->editColumn('as_ot', function($user){
         
               $ot_id= "<span style='display:none;>". $user->as_ot ."-</span>";
              if($user->as_ot==1){
                 $ot_id2="OT";
              }
              else{
                $ot_id2="Non OT";
              }
              $ot_id.= $ot_id.$ot_id2 ;

                //return (($user->as_ot==1)?"OT":"Non OT");
                  return ($ot_id);
            })  
            ->editColumn('as_status', function($user){
                if ($user->as_status == 1)
                {
                    return "Active";
                } 
                elseif ($user->as_status == 2)
                {
                    return "Resign";
                }
                elseif ($user->as_status == 3)
                {
                    return "Terminate";
                }
                elseif ($user->as_status == 4)
                {
                    return "Suspend";
                }
            })  
            ->editColumn('action', function ($user) {

                // $return = "<div class=\"btn-group\" style=\"width:104px\">" . ($user->as_status?"<span class='btn btn-xs disabled btn-info'>Active</span>":"<span class='btn btn-xs disabled btn-warning'>Inactive</span>");
                $return = "<a href=".url('hr/recruitment/employee/show/'.$user->associate_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120 fa-fw\"></i>
                    </a>
                    <a href=".url('hr/recruitment/employee/edit/'.$user->associate_id)." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Edit\" style=\"margin-top:1px;\">
                        <i class=\"ace-icon fa fa-pencil bigger-120 fa-fw\"></i>
                    </a>";
                $return .= "</div>";
                return $return;
            })  
            ->rawColumns([
                'serial_no',    
                'as_status',    
                'action',
                'as_ot'
            ])
            ->make(true); 
    }

    protected function getDataByID($associate_id = null)
    {  
        return DB::table('hr_as_basic_info AS b')
            ->select(
                'b.*',
                'u.hr_unit_id',
                'u.hr_unit_name',
                'u.hr_unit_short_name',
                'u.hr_unit_name_bn',
                'f.hr_floor_name',
                'f.hr_floor_name_bn',
                'l.hr_line_name',
                'l.hr_line_name_bn',
                's.hr_shift_id',
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
                        CONCAT('Unit: ', u.hr_unit_short_name), 
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
            ->leftJoin('hr_section AS se', 'se.hr_section_id', '=', 'b.as_section_id')
            ->leftJoin('hr_subsection AS sb', 'sb.hr_subsec_id', '=', 'b.as_subsection_id')
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
    }

    # Show User by Associate ID
    public function show(Request $request)
    {   
        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 

        if (!empty($request->associate_id)) 
        {  
            $info = $this->getDataByID($request->associate_id);
            if(empty($info)) abort(404, "$request->associate_id not found!");

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
            ->where("hr_la_as_id", $request->associate_id)
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
                ->where("leave_ass_id", $request->associate_id)
                ->groupBy('year')
                ->orderBy('year', 'DESC')
                ->get(); 
            
            $information = DB::table("hr_as_basic_info AS b")
            ->select(
              "b.as_id AS id",
              "b.associate_id AS associate",
              "b.as_name AS name",
              "b.as_doj AS doj",
              "u.hr_unit_id AS unit_id",
              "u.hr_unit_name AS unit",
              "s.hr_section_name AS section",
              "d.hr_designation_name AS designation"
            )
            ->leftJoin("hr_unit AS u", "u.hr_unit_id", "=", "b.as_unit_id")
            ->leftJoin("hr_section AS s", "s.hr_section_id", "=", "b.as_section_id")
            ->leftJoin("hr_designation AS d", "d.hr_designation_id", "=", "b.as_designation_id")
            ->where("b.associate_id", "=", $request->associate_id)
            ->first();
            //earned leave
            foreach($leaves AS $yearlyLeave){

                $earned_due = $this->earned($information->id, $information->associate, $information->doj, $yearlyLeave->year);
               
                if($earned_due==null) $earned_due=0;
                $yearlyLeave->earned_due= $earned_due;
            }

            $records = DB::table('hr_dis_rec AS r')
                ->select(
                    'r.*', 
                    DB::raw("CONCAT_WS(' to ', r.dis_re_doe_from, r.dis_re_doe_to) AS date_of_execution"), 
                    'i.hr_griv_issue_name', 
                    's.hr_griv_steps_name' 
                )
                ->leftJoin('hr_grievance_issue AS i', 'i.hr_griv_issue_id', '=', 'r.dis_re_issue_id')
                ->leftJoin('hr_grievance_steps AS s', 's.hr_griv_steps_id', '=', 'r.dis_re_issue_id')
                ->where('r.dis_re_offender_id', $request->associate_id)
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
                ->where('p.associate_id', $request->associate_id)
                ->orderBy('p.effective_date', "DESC")
                ->get();

            $increments = Increment::where('associate_id', $request->associate_id)
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
                ->where("e.education_as_id", $request->associate_id)
                ->get();


            //check current station
            $station= DB::table('hr_station AS s')
                        ->where('s.associate_id', $request->associate_id)
                        ->whereDate('s.start_date', "<=", date('Y-m-d'))
                        ->whereDate('s.end_date', ">=", date("Y-m-d"))
                        ->select([
                            "s.associate_id",
                            "s.changed_floor",
                            "s.changed_line",
                            "s.start_date",
                            "s.updated_by",
                            "s.end_date",
                            "f.hr_floor_name",
                            "l.hr_line_name",
                            "b.as_name"
                        ])
                        ->leftJoin('hr_floor AS f', 'f.hr_floor_id', 's.changed_floor')
                        ->leftJoin('hr_line AS l', 'l.hr_line_id', 's.changed_line')
                        ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', 's.updated_by')
                        ->first();
            return view('hr.recruitment.employee', compact(
                'info', 
                'loans', 
                'leaves', 
                'records',
                'promotions',
                'increments',
                'educations',
                "station"
            ));
        }
        else
        {
            abort(404);
        }
    }
    //Get earned leave
    public function earned($id=null, $associate=null, $doj=null, $end_y=null)
    {
        $date_of_join_year = date("Y", strtotime($doj));
        $start_year = $date_of_join_year;
        $end_year   = $end_y;
        $attend     = array(); 
        $leave      = array(); 
        $total_earned  = 0;
        $total_enjoyed = 0;
        $total_due     = 0;
        #---------------------------------
        for ($i = $start_year; $i<$end_year; $i++)
        {
            # -----------------------------------
            // total due earned due 
            $attend[$i] = DB::table("hr_attendance")
                ->select(DB::raw("
                    DATE(in_time) AS date 
                "))
                ->distinct("date")
                ->where("as_id", $id)
                ->where(DB::raw("YEAR(in_time)"), $i)
                ->groupBy("att_id")
                ->get();
            //make total earned
            $total_earned += number_format((sizeof($attend[$i])>0?(sizeof($attend[$i])/18):0), 2); 

            # -----------------------------------
            $leave[$i] = DB::table("hr_leave") 
                ->select(
                    DB::raw("   
                        SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS enjoyed 
                    ")
                )
                ->where("leave_ass_id", $associate) 
                ->where("leave_status", "1") 
                ->where(DB::raw("YEAR(leave_from)"), '=', $i)  
                ->value("enjoyed"); 

            $total_enjoyed += number_format((!empty($leave[$i])?$leave[$i]:0), 2);  
            # ----------------------------------- 
        }
        $total_due = $total_earned-$total_enjoyed; 
        return $total_due;
    }
 
    # Edit User by Associate ID
    public function edit(Request $request)
    {

        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 
        $employee  = $this->getDataByID($request->associate_id);
        
        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 

        $floorList  = Floor::where('hr_floor_status', '1')
                            ->where('hr_floor_unit_id', $employee->as_unit_id)
                            ->pluck('hr_floor_name', 'hr_floor_id'); 
        
        $lineList  = Line::where('hr_line_status', '1')
                            ->where('hr_line_unit_id', $employee->as_unit_id)
                            ->where('hr_line_floor_id', $employee->as_floor_id)
                            ->pluck('hr_line_name', 'hr_line_id');

        $shiftList  = Shift::where('hr_shift_status', '1')
                            ->where('hr_shift_unit_id', $employee->as_unit_id)
                            ->pluck('hr_shift_name', 'hr_shift_id'); 
                            
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id');

        $departmentList  = Department::where("hr_department_area_id", $employee->as_area_id)
                ->where("hr_department_status", 1)
                ->pluck('hr_department_name', "hr_department_id");
        $sectionList = Section::where("hr_section_department_id", $employee->as_department_id)
            ->where("hr_section_status", 1)
            ->pluck("hr_section_name", "hr_section_id");
        $subsectionList = Subsection::where("hr_subsec_section_id", $employee->as_section_id)
            ->where("hr_subsec_status", 1)
            ->pluck("hr_subsec_name", "hr_subsec_id");

        $designationList  = Designation::where('hr_designation_status', '1')->distinct()->orderBy('hr_designation_name', 'ASC')->select('hr_designation_name','hr_designation_id')->get();

        //Cost mapping status(Unit) 
        $cost_mapping_unit_status= MapCostUnit::where('associate_id', $request->associate_id)->exists();
        //Cost Mapping status(Area)
        $cost_mapping_area_status= MapCostArea::where('associate_id', $request->associate_id)->exists();

        return view("hr.recruitment.employee_basic_info_edit", compact(
            'employee',
            'employeeTypes', 
            'unitList', 
            'floorList', 
            'lineList', 
            'shiftList', 
            'areaList', 
            'bangla',
            'departmentList',
            'sectionList',
            'subsectionList',
            'designationList',
            'cost_mapping_unit_status',
            'cost_mapping_area_status'
        ));
    }
 

    public function updateEmployee(Request $request)
    {    
        $map = new CostMappingController;
        if($request->has('unit_map_checkbox')){
            $map->defaultCostMapUnit($request->associate_id, $request->as_emp_type_id);
        }
        if($request->has('area_map_checkbox')){
            $map->defaultCostMapArea($request->associate_id, $request->as_emp_type_id);
        }

        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 
        $validator = Validator::make($request->all(), [
            'as_emp_type_id'    => 'required|max:11',
            'as_unit_id'        => 'max:11',
            'as_location_id'    => 'max:11',

            'as_floor_id'       => 'max:11',
            'as_line_id'        => 'max:11',
            'as_shift_id'       => 'max:11',

            'as_area_id'        => 'required|max:11',
            'as_department_id'  => 'required|max:11',
            'as_section_id'     => 'required|max:11',
            'as_subsection_id'  => 'required|max:11', 

            'as_doj'            => 'required|date',
            'associate_id'      => 'required|max:10|min:10', 
            'temp_id'           => 'required|max:6|min:6', 
            'as_name'           => 'required|max:128',
            'as_gender'         => 'required|max:10',
            'as_dob'            => 'required|date',
            'as_contact'        => 'required|max:11',
            'as_ot'             => 'required|max:1', 
            'as_pic'            => 'image|mimes:jpeg,png,jpg|max:200',
            'as_status'         => 'required|max:1', 
            'as_oracle_code'         => 'max:20', 
            'as_rfid_code'         => 'max:20', 
        ]);

        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fields!');
        } 
        else
        { 
            //-----------IMAGE UPLOAD---------------------     
            $as_pic = $request->old_pic;
            if($request->hasFile('as_pic'))
            {
                $file = $request->file('as_pic');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $as_pic = '/assets/images/employee/' . $filename;
                Image::make($file)->resize(180, 200)->save(public_path( $as_pic ) ); 
            }
            //getting prevous designation
            $prev_dsg= Employee::where('as_id', $request->as_id)->pluck('as_designation_id')->first();
            //updated by current user
            $user= Auth()->user()->associate_id;
            if($prev_dsg != $request->as_designation_id){

                Employee::where('as_id', $request->as_id)->update([
                'as_designation_id' => $request->as_designation_id
                ]);

                DesignationUpdateLog::insert([
                    'associate_id' =>$request->associate_id,
                    'previous_designation' =>$prev_dsg,
                    'updated_designation' =>$request->as_designation_id,
                    'updated_by' =>$user
                ]);
            }

            //-----------Store Data---------------------
            $update = Employee::where('as_id', $request->as_id)->update([
                'as_emp_type_id' => $request->as_emp_type_id,
                'as_unit_id'     => $request->as_unit_id,
                'as_floor_id'    => $request->as_floor_id,
                'as_line_id'     => $request->as_line_id,
                'as_shift_id'    => $request->as_shift_id,
                'as_area_id'     => $request->as_area_id,
                'as_department_id' => $request->as_department_id,
                'as_section_id'    => $request->as_section_id,
                'as_subsection_id' => $request->as_subsection_id,
                // 'as_designation_id' => $request->as_designation_id,
                'as_doj'         => (!empty($request->as_doj)?date('Y-m-d',strtotime($request->as_doj)):null),    
                // 'temp_id'        => $request->temp_id,
                // 'associate_id'   => $request->associate_id,
                'as_name'        => strtoupper($request->as_name),
                'as_gender'      => $request->as_gender,
                'as_dob'         => (!empty($request->as_dob)?date('Y-m-d',strtotime($request->as_dob)):null),
                'as_contact'     => $request->as_contact,        
                'as_ot'          => $request->as_ot,
                'as_pic'         => $as_pic, 
                'as_status'      => $request->as_status,
                'as_remarks'     => $request->as_remarks,
                'as_oracle_code'     => $request->as_oracle_code,
                'as_rfid_code'     => $request->as_rfid_code,
                'as_location'   => $request->as_location_id
            ]);

            if ($update)
            { 
                return redirect('hr/recruitment/employee/edit/'.$request->associate_id)
                    ->withInput()
                    ->with('success', 'Update Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            } 
        } 
    } 
   
    # Search Associate ID returns NAME & ID
    public function associtaeSearch(Request $request)
    { 
        $data = []; 
        if($request->has('keyword'))
        {
            $search = $request->keyword;
            $data = Employee::select("associate_id", DB::raw('CONCAT_WS(" - ", associate_id, as_name) AS associate_name'))
                ->where(function($q) use($search) {
                    $q->where("associate_id", "LIKE" , "%{$search}%");
                    $q->orWhere("as_name", "LIKE" , "%{$search}%");
                })
                ->whereIn('as_unit_id', auth()->user()->unit_permissions())
                ->get();
        }

        return response()->json($data);
    }

    # Search Associate Info. Returns All Information
    public function associtaeInfo(Request $request)
    { 
        $data = [];
        if($request->has('associate_id'))
        { 
            $data = $this->getDataByID($request->associate_id);
        }
        return response()->json($data);
    }

    # Associate Tags
    public function associateTags(Request $request)
    { 
        if($request->has('keyword'))
        {
            return Employee::select(DB::raw('associate_id AS associate_info'))
                ->where("associate_id", "LIKE" , "%{$request->keyword}%" )
                ->orWhere('as_name', "LIKE" , "%{$request->keyword}%" )
                ->pluck('associate_info'); 
        } 
        else
        {
            return 'No Employee Found!';
        }
    } 

    /*
    *--------------------------------------------------------
    * ID CARD GENERATE
    *--------------------------------------------------------
    */
    # Associate ID CARD
    public function idCard()
    {   
        ACL::check(["permission" => "hr_time_id_card"]);
        #-----------------------------------------------------------# 

        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1') 
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 

        return view('hr/recruitment/idcard', compact(
            'employeeTypes',
            'unitList'
        ));
    }
 
    # Associate Floor List by Unit
    public function idCardFloorListByUnit(Request $request)
    {      
        $data['floorList'] = "<option value=\"\">Select Floor</value>"; 
        $floors = Floor::where('hr_floor_unit_id', $request->unit)->pluck('hr_floor_name', 'hr_floor_id');
        foreach($floors as $key => $floor)
        {
            $data['floorList'] .= "<option value=\"$key\">$floor</value>";
        }  
        return $data;  
    }
 
 
    # Associate Unit, Floor by Line List
    public function idCardLineListByUnitFloor(Request $request)
    {    
        // create line list
        $data['lineList'] = "<option value=\"\">Select Line</value>"; 
        $lines = line::where('hr_line_unit_id', $request->unit)
            ->where('hr_line_floor_id', $request->floor)
            ->pluck('hr_line_name', 'hr_line_id');
        foreach($lines as $key => $line)
        {
            $data['lineList'] .= "<option value=\"$key\">$line</value>";
        } 
        return $data;  
    } 
 
    #  filter Associate
    public function filterAssociate(Request $request)
    {     
        // employee type wise data
        $employees = [];
        $type   = $request->emp_type;
        $unit   = $request->unit;
        $floor  = $request->floor;
        $line   = $request->line;
        $doj_from = $request->doj_from; 
        $doj_to = $request->doj_to;  
        #-----------------------------------------------------------
        $employees = Employee::where(function($q) use($type, $unit, $floor, $line, $doj_from, $doj_to) {
                if (!empty($type))
                {
                    $q->where('as_emp_type_id', $type);
                }
                if (!empty($unit))
                {
                    $q->where('as_unit_id', $unit);
                }
                if (!empty($floor))
                {
                    $q->where('as_floor_id', $floor);
                }
                if (!empty($line))
                {
                    $q->where('as_line_id', $line);
                }
                if (!empty($doj_from) && !empty($doj_to))
                {  
                    $q->whereBetween('as_doj', [date("Y-m-d", strtotime($doj_from)), date("Y-m-d", strtotime($doj_to))]);
                }
            })
            ->whereIn('as_unit_id', auth()->user()->unit_permissions())
            ->get();
  
        // show user id  
        $data['result'] = null;
        $data['filter'] = "<input type=\"text\" id=\"AssociateSearch\" placeholder=\"Search an Associate\" autocomplete=\"off\" class=\"form-control\"/>";
        foreach($employees as $employee)
        {
            $data['result'] .= "<tr>
                <td><input name=\"associate_id[]\" type=\"checkbox\" value=\"$employee->associate_id\"></td>
                <td>$employee->associate_id</td>
                <td>$employee->as_name</td>
            </tr>"; 
        }
        return $data;  
    } 
 
 
    # Associate ID CARD Search
    public function idCardSearch(Request $request)
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
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->whereIn('b.associate_id', $request->associate_id)
            ->get(); 

        $data['idcard'] = "";
        if (count($employees)>0)
        {
            foreach ($employees as $associate) 
            {
                if ($request->type == "en")
                {
                    $data['idcard'] .= "<div style=\"float:left;margin:27px 15px;width:192px;height:288px;background:white;box-shadow:1px 1px 10px #333;border:1px solid #333;\"> 
                        <div style=\"width:100%;height:10px\"></div>
                        <div style=\"width:100%;height:10px;background:#FBAF42\"></div>
                        <div style=\"width:100%;height:30px;padding:5px\">
                            <div style=\"float:left;width:65%;line-height:16px;font-size:12px;font-weight:700\">$associate->hr_unit_name</div>
                            <div style=\"float:left;width:35%\"><img style=\"width:55px;height:28px;display:block\" src=\"".url(!empty($associate->hr_unit_logo)?$associate->hr_unit_logo:'')."\" alt=\"Logo\"></div>
                        </div>
                        <div style=\"width:100%;height:80px;margin:0 0 10px 0\">
                            <img style=\"margin:0px auto;width:75px;height:75px;display:block\" src=\"".url(!empty($associate->as_pic)?$associate->as_pic:'assets/idcard/avatar.png')."\" alt=\"Logo\">
                        </div>
                        <div style=\"height:50px;text-align:center\">
                            <strong style=\"display:block;font-size:12px;font-weight:700\">$associate->as_name</strong>
                            <span style=\"display:block;font-size:9px\">$associate->hr_designation_name</span>
                            <span style=\"display:block;font-size:9px;color:blue\">$associate->hr_department_name</span>
                            <span style=\"display:block;font-size:9px\">DOJ: ".(date("d-M-Y", strtotime($associate->as_doj)))."</span>
                        </div>
                        <div style=\"width:100%;height:45px;padding:10px 5px 0 10px\">
                            <strong style=\"display:block;font-size:12px\">
                            ".
                                (!empty($associate->associate_id)?
                                (substr_replace($associate->associate_id, "<big style='font-size:18px'>$associate->temp_id</big>", 3, 6)):
                                null) 
                            .
                            "</strong>
                            <strong style=\"display:block;font-size:12px\">Blood Group: $associate->med_blood_group</strong>
                        </div>
                        <div style=\"padding:15px 10px 5px 10px;\">
                            <strong style=\"float:left;display:inline-block;font-size:9px\">$associate->as_id</strong>
                            <strong style=\"float:right;display:inline-block;font-size:9px\">Authorized Signature</strong>
                        </div>
                    </div>";
                }
                else 
                {
                    $data['idcard'] .= "<div style=\"float:left;margin:27px 15px;width:192px;height:288px;background:white;box-shadow:1px 1px 10px #333;border:1px solid #333;\"> 
                        <div style=\"width:100%;height:10px\"></div>
                        <div style=\"width:100%;height:10px;background:#FBAF42\"></div>
                        <div style=\"width:100%;height:30px;padding:5px\">
                            <div style=\"float:left;width:65%;line-height:16px;font-size:12px;font-weight:700\">$associate->hr_unit_name_bn</div>
                            <div style=\"float:left;width:35%\"><img style=\"width:55px;height:28px;display:block\" src=\"".url(!empty($associate->hr_unit_logo)?$associate->hr_unit_logo:'')."\" alt=\"Logo\"></div>
                        </div>
                        <div style=\"width:100%;height:80px;margin:0 0 10px 0\">
                            <img style=\"margin:0px auto;width:75px;height:75px;display:block\" src=\"".url(!empty($associate->as_pic)?$associate->as_pic:'assets/idcard/avatar.png')."\" alt=\"Logo\">
                        </div>
                        <div style=\"height:50px;text-align:center\">
                            <strong style=\"display:block;font-size:12px;font-weight:700\">".($associate->hr_bn_associate_name?$associate->hr_bn_associate_name:null)."</strong>
                            <span style=\"display:block;font-size:9px\">".($associate->hr_designation_name_bn?$associate->hr_designation_name_bn:null)."</span>
                            <span style=\"display:block;font-size:9px;color:blue\">".($associate->hr_department_name_bn?$associate->hr_department_name_bn:null)."</span>
                            <span style=\"display:block;font-size:9px\">যোগদান তারিখ: "

                            .str_replace(['0','1','2','3','4','5','6','7','8','9', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], ['০','১','২','৩','৪','৫','৬','৭','৮','৯', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্ট', 'অক্টোবর', 'নভেম্বর ', 'ডিসেম্বর'], (date("d-M-Y", strtotime($associate->as_doj))))
                            ."</span>
                        </div>
                        <div style=\"width:100%;height:45px;padding:10px 5px 0 10px\">
                            <strong style=\"display:block;font-size:12px\">
                            ".
                                (!empty($associate->associate_id)?
                                (substr_replace($associate->associate_id, "<big style='font-size:18px'>$associate->temp_id</big>", 3, 6)):
                                null) 
                            .
                            "</strong>
                            <strong style=\"display:block;font-size:12px\">রক্তের গ্রুপ: ".($associate->med_blood_group?$associate->med_blood_group:null)."</strong>
                        </div>
                        <div style=\"padding:15px 10px 5px 10px;\">
                            <strong style=\"float:left;display:inline-block;font-size:9px\"></strong>
                            <strong style=\"float:right;display:inline-block;font-size:9px\">অনুমোদনকারীর স্বাক্ষর</strong>
                        </div>
                    </div>";
                }
            } 
        } 
        else
        {
            $data['idcard'] = '<div class="alert alert-danger">No ID Card Found!</div>';
        }
        
        $data['printbutton'] = "";
        if (strlen($data['idcard'])>1)
        {
            $data['printbutton'] .= "<button onclick=\"printContent('idCardPrint')\" type=\"button\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-print\"></i> Print</button>";
        }

        return response()->json($data); 
    }

    /*
    *--------------------------------------------------------
    * EMPLOYEE HIERARCHY
    *--------------------------------------------------------
    */
    public function hierarchy()
    {
        ACL::check(["permission" => "hr_recruitment_employer_list"]);
        #-----------------------------------------------------------# 
        $employeeTypes = EmpType::where('hr_emp_type_status', '1')
            ->distinct()
            ->orderBy('hr_emp_type_name', 'ASC')
            ->pluck('hr_emp_type_name'); 

        return view('hr.recruitment.employee_hierarchy', compact(
            'employeeTypes'
        ));
    }

    public function getHierarchy()
    {

        $data = DB::table('hr_as_basic_info AS b')
            ->select(
                'e.hr_emp_type_name',
                'b.as_name',
                'b.associate_id',
                'u.hr_unit_name',
                'd.hr_department_name', 
                'dg.hr_designation_name' 
            ) 
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u','u.hr_unit_id', 'b.as_unit_id')
            ->leftJoin('hr_department AS d','d.hr_department_id', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg','dg.hr_designation_id', 'b.as_designation_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->orderBy("dg.hr_designation_position", "DESC")
            ->orderBy("b.as_id", "DESC")
            ->orderBy("e.emp_type_id", "ASC")
            ->get(); 


        return Datatables::of($data)   
            ->editColumn('name', function($data){
                return "$data->as_name <br/> ($data->associate_id)";
            }) 
            ->rawColumns(["name"])
            ->make(true); 
    }
}
