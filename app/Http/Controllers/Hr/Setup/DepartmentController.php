<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use Validator, ACL,DB;


class DepartmentController extends Controller
{
    #show department
    public function department()
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 

        $areaList = Area::where('hr_area_status', 1)->pluck('hr_area_name','hr_area_id');
        $departments= Department::all();
    	return view('hr.setup.department', compact('areaList', 'departments'));
    }

    public function departmentStore(Request $request)
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(),[
            'hr_department_area_id' =>'required|max:11',
            'hr_department_name'    =>'required|max:128',
    		'hr_department_name_bn' =>'required|max:255',
            'hr_department_code'    =>'required|max:2|unique:hr_department',
            'hr_department_min_range'    =>'required| max:10',
    		'hr_department_max_range'    =>'required| max:10'
    	]);


    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput();
    	}
    	else
        {
    		$department= new Department;
            $department->hr_department_area_id = $request->hr_department_area_id;
            $department->hr_department_name    = $request->hr_department_name;
    		$department->hr_department_name_bn = $request->hr_department_name_bn;
            $department->hr_department_code    = $request->hr_department_code;
            $department->hr_department_min_range    = $request->hr_department_min_range;
    		$department->hr_department_max_range	   = $request->hr_department_max_range;

    		if ($department->save())
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

    # Return Department List by Area ID
    public function getDepartmentListByAreaID(Request $request)
    {
        $list = "<option value=\"\">Select Department Name </option>";
        if (!empty($request->area_id))
        { 
            $lineList  = Department::where('hr_department_area_id', $request->area_id)
                    ->where('hr_department_status', '1')
                    ->pluck('hr_department_name', 'hr_department_id'); 

            foreach ($lineList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }
    public function departmentDelete($id){
        DB::table('hr_department')->where('hr_department_id', $id)->delete();
        return redirect('/hr/setup/department')->with('success', "Successfuly deleted Department");
    }
    public function departmentUpdate($id){
        // dd($id);
        $areaList = Area::where('hr_area_status', 1)->pluck('hr_area_name','hr_area_id');
        $department= DB::table('hr_department')->where('hr_department_id', $id)->first();
        return view('/hr/setup/department_update', compact('areaList', 'department'));
    }
    
    public function departmentUpdateStore(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'hr_department_area_id' =>'required|max:11',
            'hr_department_name'    =>'required|max:128',
            'hr_department_name_bn' =>'required|max:255',
            'hr_department_code'    =>'required|max:1',
            'hr_department_min_range'    =>'required| max:10',
            'hr_department_max_range'    =>'required| max:10'
        ]);


        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            DB::table('hr_department')->where('hr_department_id', $request->hr_department_id)
            ->update([
                'hr_department_area_id' => $request->hr_department_area_id,
                'hr_department_name' => $request->hr_department_name,
                'hr_department_name_bn' => $request->hr_department_name_bn,
                'hr_department_code' => $request->hr_department_code,
                'hr_department_min_range' => $request->hr_department_min_range,
                'hr_department_min_range' => $request->hr_department_min_range,
                'hr_department_max_range' => $request->hr_department_max_range
            ]);
            return redirect('/hr/setup/department')->with('success', "Successfuly updated Department");
        }
    }

}
