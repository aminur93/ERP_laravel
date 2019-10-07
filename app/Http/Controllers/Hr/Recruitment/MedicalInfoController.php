<?php

namespace App\Http\Controllers\Hr\Recruitment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\MedicalInfo;
use DB, Validator, Image,DataTables, ACL;

class MedicalInfoController extends Controller
{
    public function medicalInfo()
    {
        ACL::check(["permission" => "hr_recruitment_op_medical_info"]);
        #-----------------------------------------------------------# 

    	return view('hr/recruitment/medical_info');
    }

    public function medicalInfoStore(Request $request)
    {
       
        ACL::check(["permission" => "hr_recruitment_op_medical_info"]);
        #-----------------------------------------------------------# 

        $validator= Validator::make($request->all(), [
            'med_as_id' => 'required|unique:hr_med_info|max:10|min:10|alpha_num',
            'med_height' => 'required|max:50',
            'med_weight' => 'required|max:50',
            'med_tooth_str' => 'max:124',
            'med_blood_group' => 'required',
            'med_ident_mark' => 'max:256',
            'med_others' => 'max:256',
            'med_doct_comment' => 'required|max:256',
            'med_doct_conf_age' => 'required|max:128',
            'med_signature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'med_auth_signature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'med_signature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);


        if ($validator->fails()) {
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }
        else{
            //-----------Signature upload--------------//
            $med_signature = null;
            if($request->hasFile('med_signature'))
            {
                $file = $request->file('med_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $med_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $med_signature ) ); 
            }
            $med_auth_signature = null;
            if($request->hasFile('med_auth_signature'))
            {
                $file = $request->file('med_auth_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $med_auth_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $med_auth_signature ) ); 
            }
            $med_doct_signature = null;
            if($request->hasFile('med_doct_signature'))
            {
                $file = $request->file('med_doct_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $med_doct_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $med_doct_signature ) ); 
            }


            $operation= new MedicalInfo();
            $operation->med_as_id= $request->med_as_id;
            $operation->med_height= $request->med_height;
            $operation->med_weight= $request->med_weight;
            $operation->med_tooth_str= $request->med_tooth_str;
            $operation->med_blood_group= $request->med_blood_group;
            $operation->med_ident_mark= $request->med_ident_mark;
            $operation->med_others= $request->med_others;
            $operation->med_doct_comment= $request->med_doct_comment;
            $operation->med_doct_conf_age= $request->med_doct_conf_age;
            $operation->med_signature= $med_signature;
            $operation->med_auth_signature= $med_auth_signature;
            $operation->med_doct_signature= $med_doct_signature;
            
            if ($operation->save())
                {
                    return back()
                        ->with('success', 'Save Successful.');
                }   
                else
                {
                    return back()                    
                        ->withInput()
                        ->with('error', 'Please try again.');
                }
        }
    }


    public function medicalInfoList()
    { 
        ACL::check(["permission" => "hr_recruitment_op_medical_list"]);
        #-----------------------------------------------------------# 

        return view('hr/recruitment/medical_info_list');
    }


    public function medicalInfoListData()
    { 
        ACL::check(["permission" => "hr_recruitment_op_medical_list"]);
        #-----------------------------------------------------------# 

        $data= DB::table('hr_med_info AS m')
                    ->select(
                        'm.med_id',
                        'm.med_as_id',
                        'm.med_height',
                        'm.med_weight',
                        'm.med_blood_group',
                        'm.med_ident_mark',
                        'b.as_name'
                    )
                    ->leftJoin('hr_as_basic_info as b', 'b.associate_id', '=', 'm.med_as_id')
                    ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
                    ->orderBy('m.med_id', 'desc')
                    ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/recruitment/employee/show/'.$data->med_as_id)." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"View\">
                        <i class=\"ace-icon fa fa-eye bigger-120\"></i>
                    </a>  
                    <a href=".url('hr/recruitment/operation/medical_info_edit/'.$data->med_as_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['action'])
            ->toJson();
   
   }


   public function medicalInfoEdit($med_as_id)
   {
        ACL::check(["permission" => "hr_recruitment_op_medical_list"]);
        #-----------------------------------------------------------# 

        $medical= DB::table('hr_med_info')->where('med_as_id', $med_as_id)->first();
        return view('hr/recruitment/medical_info_edit',compact('medical'));
   }

   public function medicalInfoUpdate(Request $request)
   {

        ACL::check(["permission" => "hr_recruitment_op_medical_list"]);
        #-----------------------------------------------------------# 
        
        $validator= Validator::make($request->all(), [
            'med_height' => 'required|max:50',
            'med_weight' => 'required|max:50',
            'med_tooth_str' => 'max:124',
            'med_blood_group' => 'required',
            'med_ident_mark' => 'max:256',
            'med_others' => 'max:256',
            'med_doct_comment' => 'required|max:256',
            'med_doct_conf_age' => 'required|max:128',
            'med_signature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'med_auth_signature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'med_signature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);


        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fileds!.');
        }
        else{
            $check= DB::table('hr_med_info')->where('hr_med_info.med_id', '=', $request->med_id)->first();
            //-----------Signature upload--------------//
            if(!empty($request->med_signature)){
            $med_signature = $request->med_signature;
            if($request->hasFile('med_signature'))
            {
                $file = $request->file('med_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $med_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $med_signature ) ); 
            }
            }
            else{
                 $med_signature =$check->med_signature;
            }

            if(!empty($request->med_auth_signature)){
            $med_auth_signature = $request->med_auth_signature;
            if($request->hasFile('med_auth_signature'))
            {
                $file = $request->file('med_auth_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $med_auth_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $med_auth_signature ) ); 
            }
            }
            else{
                 $med_auth_signature =$check->med_auth_signature;
            }

            if(!empty($request->med_doct_signature)){
            $med_doct_signature =  $request->med_doct_signature;
            if($request->hasFile('med_doct_signature'))
            {
                $file = $request->file('med_doct_signature');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $med_doct_signature = '/assets/images/employee/med_info/' . $filename;
                Image::make($file)->save(public_path( $med_doct_signature ) ); 
            }
            }
            else{
                 $med_doct_signature =$check->med_doct_signature;
            }
            


            DB::table('hr_med_info')->where('hr_med_info.med_id', '=', $request->med_id)
                ->update([
            'med_height' => $request->med_height,
            'med_weight' => $request->med_weight,
            'med_tooth_str' => $request->med_tooth_str,
            'med_blood_group' => $request->med_blood_group,
            'med_ident_mark' => $request->med_ident_mark,
            'med_others' => $request->med_others,
            'med_doct_comment' => $request->med_doct_comment,
            'med_doct_conf_age' => $request->med_doct_conf_age,
            'med_signature' => $med_signature,
            'med_auth_signature' => $med_auth_signature,
            'med_doct_signature' => $med_doct_signature
            ]);
            return redirect()->intended('hr/recruitment/operation/medical_info_list')
                    ->with('success','Medical Information Updated Successfully');
        }
   }
}
