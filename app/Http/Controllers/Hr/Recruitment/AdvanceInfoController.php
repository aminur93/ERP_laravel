<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\AdvanceInfo;
use App\Models\District;
use App\Models\Upazilla;
use App\Models\Hr\Nominee;
use App\Models\Hr\Education;
use App\Models\Hr\EducationResult;
use App\Models\Hr\EducationDegree;
use App\Models\Hr\EducationLevel;
use App\Models\Hr\EmployeeBengali; 
use App\Models\Hr\EmpType;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use App\Models\Hr\Line;
use App\Models\Hr\Shift;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Designation;
use App\Models\Hr\Section;
use DB, Validator, Image,DataTables, Session, ACL;

class AdvanceInfoController extends Controller
{
    public function advanceInfo()
    { 
        ACL::check(["permission" => "hr_recruitment_op_adv_info"]);
        #-----------------------------------------------------------# 

        $districtList = District::pluck('dis_name', 'dis_id');
        $resultList = EducationResult::pluck('education_result_title', 'id');
        $levelList = EducationLevel::pluck('education_level_title', 'id');
        $degreeList = EducationDegree::pluck('education_degree_title', 'id');

        $bangla = []; 
        if (Session::has('associate_id'))
        { 
            $bangla = $this->getDataByID(Session::get('associate_id'));
        }

        return view('hr/recruitment/advance_info',compact('districtList','resultList','levelList','degreeList', 'bangla'));
    }

    public function advanceInfoStore(Request $request)
    { 
        ACL::check(["permission" => "hr_recruitment_op_adv_info"]);
        #-----------------------------------------------------------# 

        $validator = Validator::make($request->all(), [
            'emp_adv_info_as_id'        => 'required|unique:hr_as_adv_info|max:10|min:10|alpha_num',
            'emp_adv_info_stat'         => 'max:1',
            'emp_adv_info_birth_cer'    => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_city_corp_cer'=> 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_police_veri'  => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_passport'     => 'max:64',
            'emp_adv_info_refer_name'   => 'max:64',
            'emp_adv_info_refer_contact'=> 'max:64',
            'emp_adv_info_fathers_name' => 'max:64',
            'emp_adv_info_mothers_name' => 'max:64',
            'emp_adv_info_marital_stat' => 'max:32',
            'emp_adv_info_spouse'       => 'max:64',
            'emp_adv_info_children'     => 'max:2',
            'emp_adv_info_religion'     => 'max:64',
            'emp_adv_info_pre_org'      => 'max:255',
            'emp_adv_info_work_exp'     => 'max:2',
            'emp_adv_info_nom_name'     => 'max:64',
            'emp_adv_info_nom_relation'     => 'max:64',
            'emp_adv_info_nom_per'      => 'max:3',
            'emp_adv_info_per_vill'     => 'max:64',
            'emp_adv_info_per_po'       => 'max:64',
            'emp_adv_info_per_dist'     => 'max:64',
            'emp_adv_info_per_upz'      => 'max:64',
            'emp_adv_info_pres_house_no'=> 'max:64',
            'emp_adv_info_pres_road'    => 'max:64',
            'emp_adv_info_pres_po'      => 'max:64',
            'emp_adv_info_pres_dist'    => 'max:64',
            'emp_adv_info_pres_upz'     => 'max:64',
            'emp_adv_info_job_app'      => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_cv'           => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_emg_con_name' => 'max:64',
            'emp_adv_info_emg_con_num'  => 'max:64',
            'emp_adv_info_bank_name'    => 'max:128',
            'emp_adv_info_bank_num'     => 'max:20',
            'emp_adv_info_tin'          => 'max:20',
            'emp_adv_info_finger_print' => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_signature'    => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_auth_sig'     => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024'
        ]);
        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fileds correctly!.');
        } 
        else{ 
            $emp_adv_info_birth_cer = null;  
            if($request->hasFile('emp_adv_info_birth_cer')){
                $file = $request->file('emp_adv_info_birth_cer');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_birth_cer = $dir.$filename;
            }

            $emp_adv_info_city_corp_cer = null;  
            if($request->hasFile('emp_adv_info_city_corp_cer')){
                $file = $request->file('emp_adv_info_city_corp_cer');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_city_corp_cer = $dir.$filename;
            }

            $emp_adv_info_police_veri = null;  
            if($request->hasFile('emp_adv_info_police_veri')){
                $file = $request->file('emp_adv_info_police_veri');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_police_veri = $dir.$filename;
            } 
            $emp_adv_info_job_app = null;  
            if($request->hasFile('emp_adv_info_job_app')){
                $file = $request->file('emp_adv_info_job_app');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_job_app = $dir.$filename;
            }
            $emp_adv_info_cv = null;  
            if($request->hasFile('emp_adv_info_cv')){
                $file = $request->file('emp_adv_info_cv');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_cv = $dir.$filename;
            }
            $emp_adv_info_finger_print = null;  
            if($request->hasFile('emp_adv_info_finger_print')){
                $file = $request->file('emp_adv_info_finger_print');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_finger_print = $dir.$filename;
            }

            $emp_adv_info_signature = null;  
            if($request->hasFile('emp_adv_info_signature')){
                $file = $request->file('emp_adv_info_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_signature = $dir.$filename;
            }
            $emp_adv_info_auth_sig = null;  
            if($request->hasFile('emp_adv_info_auth_sig')){
                $file = $request->file('emp_adv_info_auth_sig');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_auth_sig = $dir.$filename;
            }
            if($request->emp_adv_info_stat == 1) {
                $request->emp_adv_info_prob_period= null;
            }

            $advance= new AdvanceInfo();
            $advance->emp_adv_info_as_id         = $request->emp_adv_info_as_id ;
            $advance->emp_adv_info_stat          = $request->emp_adv_info_stat ;
            $advance->emp_adv_info_prob_period          = $request->emp_adv_info_prob_period ;
            $advance->emp_adv_info_nationality          = $request->emp_adv_info_nationality ;
            $advance->emp_adv_info_birth_cer     = $emp_adv_info_birth_cer ;
            $advance->emp_adv_info_city_corp_cer = $emp_adv_info_city_corp_cer ;
            $advance->emp_adv_info_police_veri   = $emp_adv_info_police_veri ;
            $advance->emp_adv_info_passport      = $request->emp_adv_info_passport ;
            $advance->emp_adv_info_refer_name    = $request->emp_adv_info_refer_name ;
            $advance->emp_adv_info_refer_contact = $request->emp_adv_info_refer_contact ;
            $advance->emp_adv_info_fathers_name  = $request->emp_adv_info_fathers_name;
            $advance->emp_adv_info_mothers_name  = $request->emp_adv_info_mothers_name;
            $advance->emp_adv_info_marital_stat  = $request->emp_adv_info_marital_stat;
            $advance->emp_adv_info_spouse        = $request->emp_adv_info_spouse;
            $advance->emp_adv_info_children      = $request->emp_adv_info_children;
            $advance->emp_adv_info_religion      = $request->emp_adv_info_religion;
            $advance->emp_adv_info_pre_org       = $request->emp_adv_info_pre_org;
            $advance->emp_adv_info_work_exp      = $request->emp_adv_info_work_exp;
            $advance->emp_adv_info_per_vill      = $request->emp_adv_info_per_vill;
            $advance->emp_adv_info_per_po        = $request->emp_adv_info_per_po;
            $advance->emp_adv_info_per_dist      = $request->emp_adv_info_per_dist;
            $advance->emp_adv_info_per_upz       = $request->emp_adv_info_per_upz;
            $advance->emp_adv_info_pres_house_no = $request->emp_adv_info_pres_house_no;
            $advance->emp_adv_info_pres_road     = $request->emp_adv_info_pres_road;
            $advance->emp_adv_info_pres_po       = $request->emp_adv_info_pres_po;
            $advance->emp_adv_info_pres_dist     = $request->emp_adv_info_pres_dist;
            $advance->emp_adv_info_pres_upz      = $request->emp_adv_info_pres_upz;
            $advance->emp_adv_info_job_app       = $emp_adv_info_job_app;
            $advance->emp_adv_info_cv            = $emp_adv_info_cv;
            $advance->emp_adv_info_emg_con_name  = $request->emp_adv_info_emg_con_name;
            $advance->emp_adv_info_emg_con_num   = $request->emp_adv_info_emg_con_num;
            $advance->emp_adv_info_bank_name     = $request->emp_adv_info_bank_name;
            $advance->emp_adv_info_bank_num      = $request->emp_adv_info_bank_num;
            $advance->emp_adv_info_tin           = $request->emp_adv_info_tin;
            $advance->emp_adv_info_finger_print  = $emp_adv_info_finger_print;
            $advance->emp_adv_info_signature     = $emp_adv_info_signature;
            $advance->emp_adv_info_auth_sig      = $emp_adv_info_auth_sig;


                $data=DB::table('hr_as_adv_info AS a')->where('a.emp_adv_info_as_id', '=', $advance->emp_adv_info_as_id);
               
                if ($advance->save()){
                    //Nominee
                    if (sizeof($request->emp_adv_info_nom_name) > 0){
                        for($i=0;$i<sizeof($request->emp_adv_info_nom_name);$i++){
                            Nominee::insert([
                                'nom_as_id' => $request->emp_adv_info_as_id,
                                'nom_name' => $request->emp_adv_info_nom_name[$i], 
                                'nom_name' => $request->emp_adv_info_nom_relation[$i], 
                                'nom_ben' => $request->emp_adv_info_nom_per[$i]
                            ]);
                        } 
                    }
                    return back()
                            ->with('success', 'Saved Successful.');
                    }   
                    else{
                        return back()                    
                            ->withInput()->with('error', 'Please try again.');
                    }
        }

    }
  
    public function AdvanceInfoList()
    {
        ACL::check(["permission" => "hr_recruitment_op_adv_list"]);
        #-----------------------------------------------------------# 
        return view('hr/recruitment/advance_info_list');
    }
 
    public function advanceInfoListData()
    {
        ACL::check(["permission" => "hr_recruitment_op_adv_list"]);
        #-----------------------------------------------------------# 
        $data= DB::table('hr_as_adv_info AS adv')
                    ->select(
                        'adv.emp_adv_info_id',
                        'adv.emp_adv_info_as_id',
                        'adv.emp_adv_info_fathers_name',
                        'adv.emp_adv_info_mothers_name',
                        'adv.emp_adv_info_stat',
                        'b.as_name'
                    )
                    ->leftJoin('hr_as_basic_info as b', function($q) {
                        $q->on('b.associate_id', 'adv.emp_adv_info_as_id');
                    })
                    ->whereIn('b.as_unit_id', auth()->user()->unit_permissions()) 
                    ->orderBy('adv.emp_adv_info_id', 'desc')
                    ->get();

        return DataTables::of($data) 
            ->addColumn('emp_adv_info_stat', function ($data) {
               if ($data->emp_adv_info_stat == 1)
                  return  "<span class='label label-success label-xs'> Permanent
                    </span>";
               else
                  return  "<span class='label label-primary label-xs'>Probationary
                    </span>";
            })  
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/recruitment/employee/show/'.$data->emp_adv_info_as_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>  
                    <a href=".url('hr/recruitment/operation/advance_info_edit/'.$data->emp_adv_info_as_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['emp_adv_info_stat','action'])
            ->toJson();
   }


   public function advanceInfoEdit($emp_adv_info_as_id)
   { 
        ACL::check(["permission" => "hr_recruitment_op_adv_list"]);
        #-----------------------------------------------------------#  
        $districtList = District::pluck('dis_name', 'dis_id');
        $upazillaList = Upazilla::pluck('upa_name', 'upa_id');
        $resultList = EducationResult::pluck('education_result_title', 'id');
        $levelList = EducationLevel::pluck('education_level_title', 'id');
        $degreeList = EducationDegree::pluck('education_degree_title', 'id');
        $advance = DB::table('hr_as_adv_info')->where('emp_adv_info_as_id', $emp_adv_info_as_id)->first();
        $bangla = []; 
        if (Session::has('associate_id'))
        { 
            $bangla = $this->getDataByID(Session::get('associate_id'));
        }

        return view('hr/recruitment/advance_info_edit',compact('advance', 'districtList','resultList','levelList','degreeList', 'bangla', 'upazillaList'));
   }


    public function advanceInfoUpdate(Request $request)
    { 
        ACL::check(["permission" => "hr_recruitment_op_adv_list"]);
        #-----------------------------------------------------------# 

        $validator = Validator::make($request->all(), [
            'emp_adv_info_stat'         => 'max:1',
            'emp_adv_info_birth_cer'    => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_city_corp_cer'=> 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_police_veri'  => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_passport'     => 'max:64',
            'emp_adv_info_refer_name'   => 'max:64',
            'emp_adv_info_refer_contact'=> 'max:64',
            'emp_adv_info_fathers_name' => 'max:64',
            'emp_adv_info_mothers_name' => 'max:64',
            'emp_adv_info_marital_stat' => 'max:32',
            'emp_adv_info_spouse'       => 'max:64',
            'emp_adv_info_children'     => 'max:2',
            'emp_adv_info_religion'     => 'max:64',
            'emp_adv_info_pre_org'      => 'max:255',
            'emp_adv_info_work_exp'     => 'max:2',
            'emp_adv_info_nom_name'     => 'max:64',
            'emp_adv_info_nom_per'      => 'max:3',
            'emp_adv_info_per_vill'     => 'max:64',
            'emp_adv_info_per_po'       => 'max:64',
            'emp_adv_info_per_dist'     => 'max:64',
            'emp_adv_info_per_upz'      => 'max:64',
            'emp_adv_info_pres_house_no'=> 'max:64',
            'emp_adv_info_pres_road'    => 'max:64',
            'emp_adv_info_pres_po'      => 'max:64',
            'emp_adv_info_pres_dist'    => 'max:64',
            'emp_adv_info_pres_upz'     => 'max:64',
            'emp_adv_info_job_app'      => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_cv'           => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_emg_con_name' => 'max:64',
            'emp_adv_info_emg_con_num'  => 'max:64',
            'emp_adv_info_bank_name'    => 'max:128',
            'emp_adv_info_bank_num'     => 'max:20',
            'emp_adv_info_tin'          => 'max:20',
            'emp_adv_info_finger_print' => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_signature'    => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
            'emp_adv_info_auth_sig'     => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024'

        ]);
        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fileds correctly!.');
        } 
        else{

            $check= DB::table('hr_as_adv_info')->where('hr_as_adv_info.emp_adv_info_id','=', $request->emp_adv_info_id)->first();

            if(!empty($request->emp_adv_info_birth_cer)){
            $emp_adv_info_birth_cer = $request->emp_adv_info_birth_cer;  
            if($request->hasFile('emp_adv_info_birth_cer')){
                $file = $request->file('emp_adv_info_birth_cer');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_birth_cer = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_birth_cer = $check->emp_adv_info_birth_cer; 
            }

            if(!empty($request->emp_adv_info_city_corp_cer)){
            $emp_adv_info_city_corp_cer = $request->emp_adv_info_city_corp_cer;  
            if($request->hasFile('emp_adv_info_city_corp_cer')){
                $file = $request->file('emp_adv_info_city_corp_cer');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_city_corp_cer = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_city_corp_cer = $check->emp_adv_info_city_corp_cer; 
            }

            if(!empty($request->emp_adv_info_police_veri)){
            $emp_adv_info_police_veri = $request->emp_adv_info_police_veri;  
            if($request->hasFile('emp_adv_info_police_veri')){
                $file = $request->file('emp_adv_info_police_veri');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_police_veri = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_police_veri = $check->emp_adv_info_police_veri; 
            } 


            if(!empty($request->emp_adv_info_job_app)){
            $emp_adv_info_job_app = $request->emp_adv_info_job_app;  
            if($request->hasFile('emp_adv_info_job_app')){
                $file = $request->file('emp_adv_info_job_app');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_job_app = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_job_app = $check->emp_adv_info_job_app; 
            } 


            if(!empty($request->emp_adv_info_cv)){
            $emp_adv_info_cv =$request->emp_adv_info_cv;  
            if($request->hasFile('emp_adv_info_cv')){
                $file = $request->file('emp_adv_info_cv');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_cv = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_cv = $check->emp_adv_info_cv; 
            }

            if(!empty($request->emp_adv_info_finger_print)){
            $emp_adv_info_finger_print = $request->emp_adv_info_finger_print;  
            if($request->hasFile('emp_adv_info_finger_print')){
                $file = $request->file('emp_adv_info_finger_print');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_finger_print = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_finger_print = $check->emp_adv_info_finger_print; 
            }

            if(!empty($request->emp_adv_info_signature)){
            $emp_adv_info_signature = $request->emp_adv_info_signature;  
            if($request->hasFile('emp_adv_info_signature')){
                $file = $request->file('emp_adv_info_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_signature = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_signature = $check->emp_adv_info_signature; 
            }

            if(!empty($request->emp_adv_info_auth_sig)){
            $emp_adv_info_auth_sig = $request->emp_adv_info_auth_sig;  
            if($request->hasFile('emp_adv_info_auth_sig')){
                $file = $request->file('emp_adv_info_auth_sig');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $emp_adv_info_auth_sig = $dir.$filename;
            }
            }
            else{
                $emp_adv_info_auth_sig = $check->emp_adv_info_auth_sig; 
            }
            
            DB::table('hr_as_adv_info')->where('hr_as_adv_info.emp_adv_info_as_id', '=', $request->emp_adv_info_as_id)
            ->update([
                'emp_adv_info_stat'         =>  $request->emp_adv_info_stat,
                'emp_adv_info_birth_cer'     => $emp_adv_info_birth_cer ,
                'emp_adv_info_city_corp_cer' => $emp_adv_info_city_corp_cer ,
                'emp_adv_info_police_veri'   => $emp_adv_info_police_veri ,
                'emp_adv_info_passport'      => $request->emp_adv_info_passport ,
                'emp_adv_info_refer_name'    => $request->emp_adv_info_refer_name ,
                'emp_adv_info_refer_contact' => $request->emp_adv_info_refer_contact ,
                'emp_adv_info_fathers_name'  => $request->emp_adv_info_fathers_name,
                'emp_adv_info_mothers_name'  => $request->emp_adv_info_mothers_name,
                'emp_adv_info_marital_stat'  => $request->emp_adv_info_marital_stat,
                'emp_adv_info_spouse'        => $request->emp_adv_info_spouse,
                'emp_adv_info_children'      => $request->emp_adv_info_children,
                'emp_adv_info_religion'      => $request->emp_adv_info_religion,
                'emp_adv_info_pre_org'       => $request->emp_adv_info_pre_org,
                'emp_adv_info_work_exp'      => $request->emp_adv_info_work_exp,
                'emp_adv_info_per_vill'      => $request->emp_adv_info_per_vill,
                'emp_adv_info_per_po'        => $request->emp_adv_info_per_po,
                'emp_adv_info_per_dist'      => $request->emp_adv_info_per_dist,
                'emp_adv_info_per_upz'       => $request->emp_adv_info_per_upz,
                'emp_adv_info_pres_house_no' => $request->emp_adv_info_pres_house_no,
                'emp_adv_info_pres_road'     => $request->emp_adv_info_pres_road,
                'emp_adv_info_pres_po'       => $request->emp_adv_info_pres_po,
                'emp_adv_info_pres_dist'     => $request->emp_adv_info_pres_dist,
                'emp_adv_info_pres_upz'      => $request->emp_adv_info_pres_upz,
                'emp_adv_info_job_app'       => $emp_adv_info_job_app,
                'emp_adv_info_cv'            => $emp_adv_info_cv,
                'emp_adv_info_emg_con_name'  => $request->emp_adv_info_emg_con_name,
                'emp_adv_info_emg_con_num'   => $request->emp_adv_info_emg_con_num,
                'emp_adv_info_bank_name'     => $request->emp_adv_info_bank_name,
                'emp_adv_info_bank_num'      => $request->emp_adv_info_bank_num,
                'emp_adv_info_tin'           => $request->emp_adv_info_tin,
                'emp_adv_info_finger_print'  => $emp_adv_info_finger_print,
                'emp_adv_info_signature'     => $emp_adv_info_signature,
                'emp_adv_info_auth_sig'      => $emp_adv_info_auth_sig
            ]);
            return redirect()->intended('hr/recruitment/operation/advance_info_list')
                    ->with('success','Advance Information Updated Successfully');
        }

    }

    public function educationInfoStore(Request $request){

        ACL::check(["permission" => "hr_recruitment_op_adv_list"]);
        #-----------------------------------------------------------# 

        $validator= Validator::make($request->all(),[
            'education_as_id'   => 'required|max:10|min:10',
            'education_level_id'=> 'required|max:11',
            'education_degree_id_1'=> 'max:11',
            'education_degree_id_2'=> 'max:128',
            'education_major_group_concentation'=> 'max:128',
            'education_institute_name'=> 'required|max:255',
            'education_result_id'=> 'required|max:11',
            'education_result_marks'=> 'max:11',
            'education_result_cgpa'=> 'max:11',
            'education_result_scale'=> 'max:11',
            'education_passing_year'=> 'max:11'
        ]);
 

        if($validator->fails()){ 
            return back()
                    ->withInput()
                    ->with('error', "Incorrrect input!!");
        }
        else{
            $education= new Education();
            $education->education_as_id = $request->education_as_id;
            $education->education_level_id = $request->education_level_id;
            $education->education_degree_id_1 = $request->education_degree_id_1;
            $education->education_degree_id_2 = $request->education_degree_id_2;
            $education->education_major_group_concentation = $request->education_major_group_concentation;
            $education->education_institute_name = $request->education_institute_name;
            $education->education_result_id = $request->education_result_id;
            $education->education_result_cgpa = $request->education_result_cgpa;
            $education->education_result_scale = $request->education_result_scale;
            $education->education_result_marks = $request->education_result_marks;
            $education->education_passing_year = $request->education_passing_year;

        
        if($education->save()){
            return back()
            ->with('success',"Education information Successfully Saved!!");
        }
        else{
            return back()
            ->with('error', 'Error!! try again!');
        }
        } 
    }


    public function educationHistory(Request $request){

        $html = "";
        if($request->has('associate_id'))
        { 
            $data = DB::table('hr_education AS e')
                ->where("e.education_as_id", $request->associate_id)
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
                ->get();

        foreach($data as $education):
            $html .= "<tr> 
                <td>
                    <strong>Lavel of Education:</strong> $education->education_level_title
                    <br>

                    <strong>Institute:</strong> $education->education_institute_name
                </td>
                <td>
                    <strong>Exam/Degree Title:</strong> 
                    $education->education_degree_title 
                    <br>";
                    if(!in_array($education->education_level_id, [1,2,8])):
                        $html .= "<strong>Concentration/Major/Group:</strong> $education->education_major_group_concentation";
                    endif;

                    if(in_array($education->education_level_id, [8])):
                        $html .= "<strong>Concentration/Major/Group:</strong>$education->education_degree_id_2";
                    endif;

                $html .= "</td> 
                <td>
                    <strong>Year:</strong> $education->education_passing_year 
                    <br/>
                    <strong>Result:</strong> $education->education_result_title <br/>";
                    if(in_array($education->education_result_id, [1,2,3])):
                         $html .= "<strong>Marks:</strong> $education->education_result_marks  <br/>";
                    elseif(in_array($education->education_result_id,[4])):
                         $html .= "<strong>CGPA:</strong> $education->education_result_cgpa  <br/>
                                <strong>Scale:</strong> $education->education_result_scale";
                    endif;
                $html .= "</td>
            </tr>";
        endforeach;  
  
        }

        return response()->json($html);
    }


    public function saveBengali(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            "hr_bn_associate_id"   => "required|max:10|min:10", 
            "hr_bn_associate_name" => "required|max:255", 
            "hr_bn_father_name"    => "required|max:255", 
            "hr_bn_mother_name"    => "required|max:255", 
            "hr_bn_spouse_name"    => "max:255", 
            "hr_bn_permanent_village" => "required|max:255", 
            "hr_bn_permanent_po"   => "required|max:255", 
            "hr_bn_present_road"   => "required|max:255", 
            "hr_bn_present_house"  => "required|max:255", 
            "hr_bn_present_po"     => "required|max:255"
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
            //-----------Store Data---------------------
            if (!empty($request->hr_bn_id)) 
            {
                $user = EmployeeBengali::where('hr_bn_id', $request->hr_bn_id)->update([
                    'hr_bn_associate_id'   => $request->hr_bn_associate_id,
                    'hr_bn_associate_name' => $request->hr_bn_associate_name,
                    'hr_bn_father_name'    => $request->hr_bn_father_name,
                    'hr_bn_mother_name'    => $request->hr_bn_mother_name,
                    'hr_bn_spouse_name'    => $request->hr_bn_spouse_name,
                    'hr_bn_permanent_village' => $request->hr_bn_permanent_village,
                    'hr_bn_permanent_po'   => $request->hr_bn_permanent_po,
                    'hr_bn_present_road'   => $request->hr_bn_present_road,
                    'hr_bn_present_house'  => $request->hr_bn_present_house,
                    'hr_bn_present_po'     => $request->hr_bn_present_po,
                ]);
                    
                if ($user)
                { 
                    return back()
                        ->withInput()
                        ->with('bn_flag', true) 
                        ->with('success', 'Update Successful.');
                }   
                else
                {
                    return back()       
                        ->with('bn_flag', true)              
                        ->withInput()->with('error', 'Please try again.');
                } 


            }
            else
            {
                $user = new EmployeeBengali;

                $user->hr_bn_associate_id   = $request->hr_bn_associate_id; 
                $user->hr_bn_associate_name = $request->hr_bn_associate_name; 
                $user->hr_bn_father_name    = $request->hr_bn_father_name; 
                $user->hr_bn_mother_name    = $request->hr_bn_mother_name; 
                $user->hr_bn_spouse_name    = $request->hr_bn_spouse_name; 
                $user->hr_bn_permanent_village = $request->hr_bn_permanent_village;
                $user->hr_bn_permanent_po   = $request->hr_bn_permanent_po; 
                $user->hr_bn_present_road   = $request->hr_bn_present_road;
                $user->hr_bn_present_house  = $request->hr_bn_present_house;
                $user->hr_bn_present_po     = $request->hr_bn_present_po; 


                if ($user->save())
                { 
                    return back()
                        ->withInput()
                        ->with('bn_flag', true) 
                        ->with('success', 'Save Successful.');
                }   
                else
                {
                    return back()       
                        ->with('bn_flag', true)              
                        ->withInput()->with('error', 'Please try again.');
                } 
            } 

        } 
    }

    protected function getDataByID($associate_id = null)
    { 
        return DB::table('hr_as_basic_info AS b')
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
            ->first();   
    }


}
