<?php

namespace App\Http\Controllers\Hr\Ess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\MedicalIncident;
use Validator,DB,DataTables,Image, ACL;

class MedicalIncidentController extends Controller
{
    public function medicalIncident()
    {

        ACL::check(["permission" => "hr_recruitment_op_medical_incident"]);
        #-----------------------------------------------------------# 

    	return view('hr/ess/medical_incident');
    }


    public function medicalIncidentStore(Request $request)
    { 
        ACL::check(["permission" => "hr_recruitment_op_medical_incident"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(),[
    		'hr_med_incident_as_id'	=> 'required|max:10|min:10',
    		'hr_med_incident_as_name'	=> 'required|max:64|min:3',
    		'hr_med_incident_date'	=> 'required',
    		'hr_med_incident_details'	=> 'max:128',
    		'hr_med_incident_doctors_name'	=> 'max:128',
    		'hr_med_incident_doctors_recommendation'	=> 'max:128',
    		'hr_med_incident_supporting_file'	=> 'max:1024',
    		'hr_med_incident_action'	=> 'max:128',
    		'hr_med_incident_allowance'	=> 'max:11'
    	]);
    	if ($validator->fails())
    	{

    		return back()
    			->withInput()
    			->withErrors($validator)
    			->with("error", "Please fillup all required fields!");
    	}
    	else{
            
    		$filepath= null;
    		if($request->hasFile('hr_med_incident_supporting_file')){
                $file = $request->file('hr_med_incident_supporting_file');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/medicalIncident/';
                $file->move( public_path($dir) , $filename );
                $filepath = $dir.$filename; 
            } 
 
            $medical= new MedicalIncident();

            $medical->hr_med_incident_as_id = $request->hr_med_incident_as_id;
            $medical->hr_med_incident_as_name = $request->hr_med_incident_as_name;
            $medical->hr_med_incident_date = $request->hr_med_incident_date;
            $medical->hr_med_incident_details = $request->hr_med_incident_details;
            $medical->hr_med_incident_doctors_name = $request->hr_med_incident_doctors_name;
            $medical->hr_med_incident_doctors_recommendation = $request->hr_med_incident_doctors_recommendation;
            $medical->hr_med_incident_supporting_file = $filepath;
            $medical->hr_med_incident_action = $request->hr_med_incident_action;
            $medical->hr_med_incident_allowance = $request->hr_med_incident_allowance;

            if($medical->save()){
            	return back()
            	->with('success', "Medical Incident Added Successfully");
            }
            else
			{
	     		return back()                    
	     			->withInput()->with('error', 'Please try again.');
			} 
    	}
    }

    public function medicalIncidentList()
    {
        return view('hr/ess/medical_incident_list');
    }

    public function medicalIncidentData(){
        DB::statement(DB::raw('set @i=0'));
        $data= DB::table('hr_medical_incident AS m')
                ->select(
                    DB::raw('@i := @i+1 AS serial_no'),
                    'm.*'
                )
                ->leftJoin('hr_as_basic_info as b', 'b.associate_id', '=', 'm.hr_med_incident_as_id')
                ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
                ->orderBy('m.hr_med_incident_date', 'desc')
                ->get();

        return DataTables::of($data)
            ->addColumn('file', function ($data) {
                if(!empty($data->hr_med_incident_supporting_file))
                    return "<a href='".asset($data->hr_med_incident_supporting_file)."' class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> View</a><a href='".asset($data->hr_med_incident_supporting_file)."' class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i></a>";
                else 
                    return "<strong class=\"text-danger\">No file found!</strong>";
            }) 
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/ess/medical_incident_edit/'.$data->id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                </div>";
            })  
            ->rawColumns(['serial_no', 'file', 'action'])
            ->toJson();
    }


    public function medicalIncidentEdit(Request $request)
    {
        $medical = MedicalIncident::findOrFail($request->id);
        return view('hr/ess/medical_incident_edit', compact('medical'));
    }


    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id'                        => 'required|max:11',
            'hr_med_incident_as_id'     => 'required|max:10|min:10',
            'hr_med_incident_as_name'   => 'required',
            'hr_med_incident_date'      => 'required',
            'hr_med_incident_details'   => 'required',
            'hr_med_incident_doctors_name'    => 'required',
            'hr_med_incident_doctors_recommendation' => 'required',
            'hr_med_incident_action'          => 'required',
            'hr_med_incident_allowance'       => 'required',
            'hr_med_incident_supporting_file' => 'mimes:docx,doc,pdf,jpg,png,jpeg|max:1024',
        ]);

        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fileds correctly!.');
        } 
        else
        { 

            if($request->hasFile('hr_med_incident_supporting_file'))
            {
                $file = $request->file('hr_med_incident_supporting_file');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/advinfo/';
                $file->move( public_path($dir) , $filename );
                $hr_med_incident_supporting_file = $dir.$filename;
            }
            else
            {
                $hr_med_incident_supporting_file = $request->old_supporting_file; 
            }

            $store = MedicalIncident::findOrFail($request->id);
            $store->hr_med_incident_date    = $request->hr_med_incident_date;
            $store->hr_med_incident_details = $request->hr_med_incident_details;
            $store->hr_med_incident_doctors_name = $request->hr_med_incident_doctors_name;
            $store->hr_med_incident_doctors_recommendation = $request->hr_med_incident_doctors_recommendation;
            $store->hr_med_incident_action = $request->hr_med_incident_action;
            $store->hr_med_incident_allowance = $request->hr_med_incident_allowance;
            $store->hr_med_incident_supporting_file = $hr_med_incident_supporting_file;

            if ($store->save())
            {
                return back()
                    ->with('success','Updated Successfully');
            }
            else
            {
                return back()
                    ->with('error','Please try agin.');
            }
        }

    }


}