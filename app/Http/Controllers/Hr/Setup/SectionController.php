<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Area;
use App\Models\Hr\Section;
use App\Models\Hr\Department;

use Validator,DB,ACL;


class SectionController extends Controller
{
    #show section
    public function section()
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	$areaList = Area::where('hr_area_status', 1)->pluck('hr_area_name','hr_area_id');
        $sections= DB::table('hr_section AS s')

                        ->Select(
                            's.hr_section_id',
                            's.hr_section_name',
                            's.hr_section_name_bn',
                            'a.hr_area_name',
                            'd.hr_department_name'
                        )
                        ->leftJoin('hr_area AS a', 'a.hr_area_id', '=', 's.hr_section_area_id')
                        ->leftJoin('hr_department AS d', 'd.hr_department_id', '=', 's.hr_section_department_id')
                        ->get();


    	return view('hr.setup.section', compact('areaList', 'sections'));
    }

    public function sectionStore(Request $request)
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	$validator= Validator::make($request->all(),[
            'hr_section_area_id' => 'required|max:11',
    		'hr_section_department_id' => 'required|max:11',
    		'hr_section_name'    => 'required|max:128|unique:hr_section',
    		'hr_section_name_bn' => 'max:255',
    		'hr_section_code'    => 'max:10'
    	]);


    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput()
    			->with('error', 'Please fillup all required fields!');
    	}
    	else
        {
    		$section= new Section;
            $section->hr_section_area_id  = $request->hr_section_area_id;
    		$section->hr_section_department_id  = $request->hr_section_department_id;
    		$section->hr_section_name	  = $request->hr_section_name;
    		$section->hr_section_name_bn  = $request->hr_section_name_bn;
    		$section->hr_section_code	  = $request->hr_section_code;
    		if ($section->save())
            {
                return back()
                    ->withInput()
                    ->with('success', 'Save Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }
    	}
    }


    // # Return Section List by Department ID
    public function getSectionListByDepartmentID(Request $request)
    {
        $list = "<option value=\"\">Select Section Name </option>";
        if (!empty($request->area_id) && !empty($request->department_id))
        { 
            $lineList  = Section::where('hr_section_area_id', $request->area_id)
                    ->where('hr_section_department_id', $request->department_id)
                    ->where('hr_section_status', '1')
                    ->pluck('hr_section_name', 'hr_section_id'); 

            foreach ($lineList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }
    public function sectionDelete($id){
        DB::table('hr_section')->where('hr_section_id', $id)->delete();
        return redirect('/hr/setup/section')->with('success', "Successfuly deleted Section");
    }
    public function sectionUpdate($id){
        $areaList = Area::where('hr_area_status', 1)->pluck('hr_area_name','hr_area_id');
        $section= DB::table('hr_section')->where('hr_section_id',$id)->first();

        $departmentList= Department::where('hr_department_area_id', $section->hr_section_area_id)->pluck('hr_department_name', 'hr_department_id');

        return view('/hr/setup/section_update', compact('areaList','section','departmentList'));
    }
    public function sectionUpdateStore(Request $request){
        // dd($request->all());
        $validator= Validator::make($request->all(),[
            'hr_section_area_id' => 'required|max:11',
            'hr_section_department_id' => 'required|max:11',
            'hr_section_name'    => 'required|max:128',
            'hr_section_name_bn' => 'max:255',
            'hr_section_code'    => 'max:10'
        ]);


        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!');
        }
        else
        {
            DB::table('hr_section')->where('hr_section_id', $request->hr_section_id)
            ->update([
                'hr_section_area_id' => $request->hr_section_area_id,
                'hr_section_department_id' => $request->hr_section_department_id,
                'hr_section_name' => $request->hr_section_name,
                'hr_section_name_bn' => $request->hr_section_name_bn,
                'hr_section_code' => $request->hr_section_code
            ]);
            return redirect('/hr/setup/section')->with('success', "Successfuly updated Section");
        }
    }

}
