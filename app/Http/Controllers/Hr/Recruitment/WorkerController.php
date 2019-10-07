<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Hr\IDGenerator as IDGenerator;
use App\Models\Hr\Employee;  
use App\Models\Hr\AdvanceInfo;
use App\Models\Hr\MedicalInfo;
use App\Models\Hr\Worker;  
use App\Models\Hr\EmpType;
use App\Models\Hr\Unit;  
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Designation; 
use App\Models\Hr\Section; 
use App\Models\Hr\Subsection; 
use Yajra\Datatables\Datatables;
use Auth, DB, Validator, Image, ACL;

class WorkerController extends Controller
{

    /* 
    *----------------------------------------------
    * Worker Recruitment
    *----------------------------------------------
    */ 
    public function recruitForm()
    {   
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------#  

        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id');

        $user_unit= Auth()->user()->unit_id();
        DB::statement(DB::raw('set @sl=0'));
        $recruitList= Worker::whereIn('worker_unit_id', auth()->user()->unit_permissions())
                            ->where('worker_doctor_acceptance', '0')
                            ->where('worker_is_migrated', '0')
                            ->orderBy('worker_doj', "DESC")
                            ->select([
                                DB::raw('@sl := @sl + 1 AS sl'),
                                'worker_id',
                                'worker_name',
                                'worker_doj'
                            ])
                            ->get();

        return view('hr/recruitment/worker_recruit', compact('employeeTypes', 'unitList', 'areaList', 'recruitList'));
    }

    public function recruitStore(Request $request)
    {   
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------#  
        $validator = Validator::make($request->all(), [
            'worker_name'           => 'required|max:128',
            'worker_doj'            => 'required|date',
            'worker_emp_type_id'    => 'required|max:11',
            'worker_designation_id' => 'required|max:11',
            'worker_unit_id'        => 'required|max:11',
            'worker_area_id'        => 'required|max:11',
            'worker_department_id'  => 'required|max:11',
            'worker_section_id'     => 'max:11',
            'worker_subsection_id'  => 'max:11',
            'worker_gender'         => 'required|max:15',
            'worker_dob'            => 'date',
            'worker_contact'        => 'max:11',
            'worker_ot'             => 'required|max:1',
            'worker_nid'            => 'max:30',
            'as_oracle_code'             => 'max:20',
            'as_rfid'                  => 'max:20'
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

            #-------------------Post Data------------------
            $postData = array(
                "worker_name"           => strtoupper($request->worker_name), 
                "worker_doj"            => (!empty($request->worker_doj)?date('Y-m-d',strtotime($request->worker_doj)):null), 
                "worker_emp_type_id" => $request->worker_emp_type_id, 
                "worker_designation_id" => $request->worker_designation_id, 
                "worker_unit_id" => $request->worker_unit_id, 
                "worker_area_id" => $request->worker_area_id, 
                "worker_department_id" => $request->worker_department_id, 
                "worker_section_id" => $request->worker_section_id, 
                "worker_subsection_id" => $request->worker_subsection_id, 
                "worker_ot" => $request->worker_ot, 
                "worker_gender" => $request->worker_gender, 
                "worker_dob" => (!empty($request->worker_dob)?date('Y-m-d',strtotime($request->worker_dob)):null),
                "worker_contact" => $request->worker_contact, 
                "worker_nid" => $request->worker_nid,
                "as_oracle_code"   => $request->as_oracle_code,
                "as_rfid"   => $request->as_rfid
            );

            #-------------------Update------------------
            if (!empty($request->worker_id))
            {
                if (Worker::where('worker_id', $request->worker_id)->update($postData))
                { 
                    return back()
                        ->with('success', 'Update Successful.');
                }   
                else
                {
                    return back()                    
                        ->withInput()->with('error', 'Update Error: Please try again.');
                } 
            }
            else
            {
                #-------------------Save--------------------
                if (Worker::insert($postData))
                { 
                    return back()
                        ->with('success', 'Save Successful.');
                }   
                else
                {
                    return back()                    
                        ->withInput()->with('error', 'Insert Error: Please try again.');
                }

            } 
        } 
    }


    public function recruitList()
    {  
        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name'); 
        $unitList  = Unit::where('hr_unit_status', '1') 
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name');
        $departmentList= Department::where('hr_department_status',1)->pluck('hr_department_name');
        $designationList  = Designation::where('hr_designation_status', '1')->pluck('hr_designation_name');
        $sectionList  = Section::where('hr_section_status', '1')->pluck('hr_section_name');
        $subsectionList  = Subsection::where('hr_subsec_status', '1')->pluck('hr_subsec_name');

        return view('hr.recruitment.worker_recruit_list', compact('employeeTypes','unitList','areaList','departmentList','designationList','sectionList','subsectionList'));
    }


    public function recruitData()
    {   
        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_worker_recruitment AS w')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'w.worker_id',
                'w.worker_name',
                'w.worker_doj',
                'e.hr_emp_type_name',
                'u.hr_unit_short_name',
                'a.hr_area_name', 
                'dp.hr_department_name',
                'dg.hr_designation_name',
                's.hr_section_name',
                'ss.hr_subsec_name',
                'w.worker_gender', 
                'w.worker_dob', 
                'w.worker_ot',
                'w.worker_contact',
                'w.worker_nid',
                'w.as_oracle_code',
                'w.as_rfid'
            )
            ->leftJoin('hr_area AS a', 'a.hr_area_id', '=', 'w.worker_area_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'w.worker_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'w.worker_unit_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'w.worker_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'w.worker_designation_id')
            ->leftJoin('hr_section AS s', 's.hr_section_id', '=', 'w.worker_section_id') 
            ->leftJoin('hr_subsection AS ss', 'ss.hr_subsec_id', '=', 'w.worker_subsection_id') 
            ->whereIn('w.worker_unit_id', auth()->user()->unit_permissions())
            ->where('w.worker_doctor_acceptance', '0')
            ->where('w.worker_is_migrated', '0')
            ->orderBy('w.worker_id','desc')
            ->get();
 

        return Datatables::of($data)   
            ->editColumn('worker_ot', function($data){
                return (($data->worker_ot==1)?"OT":"Non OT");
            })  
            ->editColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/recruitment/worker/recruit_edit/'.$data->worker_id)." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Edit Information\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a> 
                    <a href=".url('hr/recruitment/worker/medical_edit/'.$data->worker_id)." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Medical Entry\">
                        <i class=\"ace-icon fa fa-user-md bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns([
                'serial_no',    
                'action'
            ])
            ->make(true); 
    }
 
  
    public function recruitEditForm(Request $request)
    {  
        $employee = DB::table('hr_worker_recruitment AS w')
            ->select([
                'w.*',
                'e.hr_emp_type_name',
                'u.hr_unit_short_name',
                'a.hr_area_name', 
                'dp.hr_department_name',
                'dg.hr_designation_name',
                's.hr_section_name',
                'ss.hr_subsec_name'
            ])
            ->leftJoin('hr_area AS a', 'a.hr_area_id', '=', 'w.worker_area_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'w.worker_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'w.worker_unit_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'w.worker_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'w.worker_designation_id')
            ->leftJoin('hr_section AS s', 's.hr_section_id', '=', 'w.worker_section_id') 
            ->leftJoin('hr_subsection AS ss', 'ss.hr_subsec_id', '=', 'w.worker_subsection_id')  
            ->where('w.worker_id', $request->worker_id)
            ->where('w.worker_is_migrated', '0')
            ->first();


        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id');

        $user_unit= Auth()->user()->unit_id();
        DB::statement(DB::raw('set @sl=0'));
        $recruitList= Worker::whereIn('worker_unit_id', auth()->user()->unit_permissions())
                            ->where('worker_doctor_acceptance', '0')
                            ->where('worker_is_migrated', '0')
                            ->orderBy('worker_doj', "DESC")
                            ->select([
                                DB::raw('@sl := @sl + 1 AS sl'),
                                'worker_id',
                                'worker_name',
                                'worker_doj'
                            ])
                            ->get();

        return view('hr/recruitment/worker_recruit_edit', compact('employee', 'employeeTypes', 'unitList', 'areaList', 'recruitList'));

    }
 
   
    /* 
    *----------------------------------------------
    * Worker Medical
    *----------------------------------------------
    */

    public function editMedical(Request $request)
    {  
        $employee = DB::table('hr_worker_recruitment AS w')
            ->select('*')
            ->where('w.worker_id', $request->worker_id)
            ->first();

        $user_unit = auth()->user()->unit_id();
        DB::statement(DB::raw('set @sl=0'));
        $medicalList= Worker::whereIn('worker_unit_id', auth()->user()->unit_permissions())
                ->where('worker_is_migrated', '0')  
                ->orderBy('worker_doj', "DESC")
                ->select([
                    DB::raw('@sl := @sl + 1 AS sl'),
                    'worker_id',
                    'worker_name',
                    'worker_doj'
                ])
                ->get();

        return view('hr/recruitment/worker_medical_edit', compact('employee', 'medicalList'));
    }

    public function medicalStore(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'worker_id'             => 'required|max:11',
            'worker_name'           => 'required|max:128',
            'worker_doj'            => 'required|date',
            'worker_height'         => 'required|max:10',
            'worker_weight'         => 'required|max:10',
            'worker_tooth_structure' => 'max:64',
            'worker_blood_group'     => 'required|max:10',
            'worker_identification_mark' => 'max:255',
            'worker_doctor_age_confirm' => 'required|max:20',
            'worker_doctor_comments'    => 'required|max:255',
            'worker_doctor_signature'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'worker_doctor_acceptance'  => 'required|max:1',
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

            $worker_doctor_signature = null;
            if($request->hasFile('worker_doctor_signature'))
            {
                $file = $request->file('worker_doctor_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $worker_doctor_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $worker_doctor_signature ) ); 
            }
            else
            {
                $worker_doctor_signature = $request->old_signature;
            }

            #-------------------Post Data------------------
            $postData = array(
                "worker_height"            => $request->worker_height, 
                "worker_weight"            => $request->worker_weight, 
                "worker_tooth_structure"   => $request->worker_tooth_structure, 
                "worker_blood_group"       => $request->worker_blood_group, 
                "worker_identification_mark" => $request->worker_identification_mark, 
                "worker_doctor_age_confirm"  => $request->worker_doctor_age_confirm, 
                "worker_doctor_comments"   => $request->worker_doctor_comments, 
                "worker_doctor_signature"  => $worker_doctor_signature, 
                "worker_doctor_acceptance" => $request->worker_doctor_acceptance
            ); 

            #-------------------Update------------------
            if (!empty($request->worker_id))
            {
                if (Worker::where('worker_id', $request->worker_id)->update($postData))
                { 
                    return back()
                        ->with('success', 'Update Successful.');
                }   
                else
                {
                    return back()                    
                        ->withInput()->with('error', 'Please try again.');
                } 
            }
            else
            { 
                return back()                    
                    ->withInput()->with('error', 'Please try again.');  
            } 
        } 
    }

    public function showMedicalList()
    {  
        return view('hr/recruitment/worker_medical_list');
    } 

    public function medicalData()
    {    
        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_worker_recruitment AS w')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'w.worker_id',
                'w.worker_name',
                'w.worker_doj',
                'w.worker_height',
                'w.worker_weight',
                'w.worker_tooth_structure',
                'w.worker_blood_group',
                'w.worker_identification_mark',
                'w.worker_doctor_age_confirm',
                'w.worker_doctor_comments',
                'w.worker_doctor_signature',
                'w.worker_doctor_acceptance',
                'w.as_rfid',
                'w.as_oracle_code'
            )
            ->whereIn('w.worker_doctor_acceptance', [1,2]) 
            ->where('w.worker_is_migrated', '0')
            ->whereIn('w.worker_unit_id', auth()->user()->unit_permissions())
            ->orderBy('w.worker_id','desc')
            ->get();
 

        return Datatables::of($data)    
            ->editColumn('worker_doctor_acceptance', function ($data) {
                if ($data->worker_doctor_acceptance==1)
                {
                    return "<span class='label label-success'>Yes</span>";
                }
                else
                {
                    return "<span class='label label-danger'>No</span>";
                }
            })      
            ->editColumn('height_weight', function ($data) {
                return "<strong>Height: </strong> $data->worker_height<br/><strong>Weight: </strong> $data->worker_weight";
            })   
            ->editColumn('action', function ($data) {

                $button = "<div class=\"btn-group\">  
                        <a href=".url('hr/recruitment/worker/medical_edit/'.$data->worker_id)." class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Edit Information\">
                            <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                        </a>";

                if ($data->worker_doctor_acceptance==1 && !auth()->user()->hasRole("hr_medical"))
                {
                    $button .= "<a href=".url('hr/recruitment/worker/ie_skill_edit/'.$data->worker_id)." class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"IE Skill Test\">
                            <i class=\"ace-icon fa fa-cogs bigger-120\"></i>
                        </a>
                        <a href=".url("hr/recruitment/worker/migrate/". $data->worker_id)." onclick=\"return confirm('Are you sure?')\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Migrate Now!\">
                            <i class=\"ace-icon fa fa-plus bigger-120\"></i>
                        </a>"; 
                }

                $button .= "</div>";

                return $button; 
            })  
            ->rawColumns([
                'serial_no',    
                'height_weight',    
                'worker_doctor_acceptance',    
                'action'
            ])
            ->make(true); 
    }

    /* 
    *----------------------------------------------
    * Worker IE Skill Test
    *----------------------------------------------
    */

    public function editIeSkill(Request $request)
    {
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------# 
        $employee = Worker::where('worker_id', $request->worker_id)
            ->where('worker_doctor_acceptance', 1)
            ->first();

        $user_unit= Auth()->user()->unit_id();
        DB::statement(DB::raw('set @sl=0'));
        $ieList= Worker::whereIn('worker_unit_id', auth()->user()->unit_permissions())
                            ->where('worker_is_migrated', '0')
                            ->where('worker_doctor_acceptance', 1)
                            ->orderBy('worker_doj', "DESC")
                            ->select([
                                DB::raw('@sl := @sl + 1 AS sl'),
                                'worker_id',
                                'worker_name',
                                'worker_doj'
                            ])
                            ->get();

        return view('hr/recruitment/worker_ie_skill_edit', compact('employee','ieList'));
    }

    public function ieSkillStore(Request $request)
    {
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------# 

        $validator = Validator::make($request->all(), [
            'worker_id'   => 'required|max:11',
            'worker_name' => 'required|max:255',
            'worker_doj'  => 'required|date',
            'worker_pigboard_test' => 'required|min:1',
            'worker_finger_test'   => 'required|min:1',
            'worker_color_join'    => 'required|min:1',
            'worker_color_band_join' => 'required|min:1',
            'worker_color_top_stice' => 'required|min:1',
            'worker_urmol_join'    => 'required|min:1',
            'worker_clip_join'     => 'required|min:1',
            'worker_salary'        => 'required'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withInput()
                ->withErrors();
        }
        else
        {
            $postData = array(
                'worker_pigboard_test' => $request->worker_pigboard_test,
                'worker_finger_test'   => $request->worker_finger_test,
                'worker_color_join'    => $request->worker_color_join,
                'worker_color_band_join' => $request->worker_color_band_join,
                'worker_box_pleat_join'  => $request->worker_box_pleat_join,
                'worker_color_top_stice' => $request->worker_color_top_stice,
                'worker_urmol_join'    => $request->worker_urmol_join,
                'worker_clip_join'     => $request->worker_clip_join,
                'worker_salary'        => $request->worker_salary
            );

            if (Worker::where('worker_id', $request->worker_id)->update($postData))
            {
                return back()
                    ->with("success", "Update Successful.");
            }
            else
            {
                return back()
                    ->with("error", "Please try again.");
            }
        }

    }

    public function showIeSkillList()
    {
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------# 
        return view('hr/recruitment/worker_ie_skill_list');
    } 

    public function getIeSkillData()
    {  
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------# 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_worker_recruitment AS w')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'w.worker_id',
                'w.worker_name',
                'w.worker_doj',
                DB::raw('CASE WHEN w.worker_pigboard_test=1 THEN "Yes" ELSE "No" END AS worker_pigboard_test'),
                DB::raw('CASE WHEN w.worker_finger_test=1 THEN "Yes" ELSE "No" END AS worker_finger_test'),
                DB::raw('CASE WHEN w.worker_color_join=1 THEN "Yes" ELSE "No" END AS worker_color_join'),
                DB::raw('CASE WHEN w.worker_color_band_join=1 THEN "Yes" ELSE "No" END AS worker_color_band_join'),
                DB::raw('CASE WHEN w.worker_box_pleat_join=1 THEN "Yes" ELSE "No" END AS worker_box_pleat_join'),
                DB::raw('CASE WHEN w.worker_color_top_stice=1 THEN "Yes" ELSE "No" END AS worker_color_top_stice'),
                DB::raw('CASE WHEN w.worker_urmol_join=1 THEN "Yes" ELSE "No" END AS worker_urmol_join'),
                DB::raw('CASE WHEN w.worker_clip_join=1 THEN "Yes" ELSE "No" END AS worker_clip_join'),
                'w.worker_salary' 
            )
            ->where('w.worker_doctor_acceptance', '1')
            ->where('w.worker_is_migrated', '0')
            ->whereIn('w.worker_unit_id', auth()->user()->unit_permissions())
            ->orderBy('w.worker_id','desc')
            ->get();

        return Datatables::of($data)    
            ->editColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/recruitment/worker/ie_skill_edit/'.$data->worker_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit IE Skill\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                    <a href=".url('hr/recruitment/worker/migrate/'. $data->worker_id)." onclick=\"return confirm('Are you sure?')\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Migrate Now!\">
                        <i class=\"ace-icon fa fa-plus bigger-120\"></i>
                    </a> 
                </div>";
            })  
            ->rawColumns([
                'serial_no',    
                'action'
            ])
            ->make(true); 
    }


    /* 
    *----------------------------------------------
    * Migrate 
    *----------------------------------------------
    */ 
    public function migrate(Request $request)
    {  
        ACL::check(["permission" => "hr_recruitment_worker"]);
        #-----------------------------------------------------------# 

        if (!empty($request->worker_id))
        {   
            $data = Worker::where("worker_id", $request->worker_id)
            ->where("worker_doctor_acceptance", "1")
            ->where("worker_is_migrated", "0");

            if ($data->exists())
            {
                $worker = $data->first();
                /*
                * @function - IDGenerator
                * @parameter - department and join_date
                * @return   - ID and Temporary_ID
                */ 
              //dd($worker);
                $IDGenerator = (new IDGenerator)->generator2(array(
                    'department' => $worker->worker_department_id,
                    'date' => $worker->worker_doj
                )); 

                if (!empty($IDGenerator['error']))
                {
                    return back()
                        ->with("error", $IDGenerator['error']);
                }
                else if(strlen($IDGenerator['id']) != 10)
                {    
                    return back()
                        ->with("error", "Unable to start the migration: Alphanumeric Associate's ID required with exactly 10 characters ");  
                }
                else
                {
                    //Default Shift Code
                    $default_shift= DB::table('hr_shift')
                                        ->where('hr_shift_unit_id', $worker->worker_unit_id)
                                        ->where('hr_shift_default', 1)
                                        ->pluck('hr_shift_id')
                                        ->first();
                                        
                    /*---INSERT INTO BASIC INFO TABLE---*/
                    $check = Employee::insert(array(
                        'as_emp_type_id'  => $worker->worker_emp_type_id,
                        'as_unit_id'      => $worker->worker_unit_id, 
                        'as_shift_id'     => $default_shift, 
                        'as_area_id'      => $worker->worker_area_id,
                        'as_department_id' => $worker->worker_department_id,
                        'as_section_id'  => $worker->worker_section_id,
                        'as_subsection_id'  => $worker->worker_subsection_id,
                        'as_designation_id' => $worker->worker_designation_id,
                        'as_doj'         => (!empty($worker->worker_doj)?date('Y-m-d',strtotime($worker->worker_doj)):null),    
                        'temp_id'        => $IDGenerator['temp'],
                        'associate_id'   => $IDGenerator['id'],
                        'as_name'        => $worker->worker_name,
                        'as_gender'      => $worker->worker_gender,
                        'as_dob'         => (!empty($worker->worker_dob)?date('Y-m-d',strtotime($worker->worker_dob)):null),
                        'as_contact'     => $worker->worker_contact,        
                        'as_ot'          => $worker->worker_ot, 
                        'as_oracle_code' => $worker->as_oracle_code, 
                        'as_rfid_code'   => $worker->as_rfid, 
                        'as_pic'         => null, 
                        'created_at'     => date("Y-m-d H:i:s"), 
                        'created_by'     => Auth::user()->id, 
                        'as_status'      => 1 ,
                        'as_location'    => $worker->worker_unit_id
                    )); 
                 
                     
                    if ($check)
                    {
                        /*---INSERT INTO MEDICAL INFO TABLE---*/
                        MedicalInfo::insert(array(
                            'med_as_id'       => $IDGenerator['id'],
                            'med_height'      => $worker->worker_height,
                            'med_weight'      => $worker->worker_weight,
                            'med_tooth_str'   => $worker->worker_tooth_structure,
                            'med_blood_group' => $worker->worker_blood_group,
                            'med_ident_mark'  => (!empty($worker->worker_identification_mark)?$worker->worker_identification_mark:"N/A"),
                            'med_doct_comment'   => $worker->worker_doctor_comments,
                            'med_doct_conf_age'  => $worker->worker_doctor_age_confirm,
                            'med_doct_signature' => $worker->worker_doctor_signature 
                        ));

                        /*---INSERT INTO ADVANCE INFO TABLE---*/
                        AdvanceInfo::insert(array(
                            'emp_adv_info_as_id' => $IDGenerator['id'],
                            'emp_adv_info_nid'   => $worker->worker_nid 
                        ));
 

                        /*---INSERT INTO WORKER TABLE---*/
                        Worker::where('worker_id', $request->worker_id)
                            ->update(array('worker_is_migrated' => '1'));

                   


                        return back()
                            ->with("success", "Migration successful!");


                    }
                    else
                    {
                        return back()
                            ->with("error", "Database error: unable to migrate!");
                    }
                }
            }
            else
            {
                return back()
                    ->with("error", "Unable to start the migration: Please check the user's medical status or user already migrated!");
            }
        }
        else
        {
            return back()
                ->with("error", "Unable to start the migration: Invalid user!");
        } 
    }
    
    
}
