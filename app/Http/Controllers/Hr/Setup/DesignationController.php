<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Designation;
use App\Models\Hr\EmpType;
use Validator,DB, ACL;

class DesignationController extends Controller
{
    #show department
    public function designation()
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
        $emp_type= EmpType::where('hr_emp_type_status','1')->pluck('hr_emp_type_name','emp_type_id');
        $designations= DB::table('hr_designation AS d')
            ->select(
                'd.hr_designation_id',
                'd.hr_designation_name',
                'd.hr_designation_name_bn',
                'd.hr_designation_position',
                'd.hr_designation_grade',
                'emp.hr_emp_type_name'
            )
            ->leftJoin('hr_emp_type AS emp', 'emp.emp_type_id', '=', 'd.hr_designation_emp_type')
            ->orderBy('d.hr_designation_position', 'DESC')
            ->get();

    	return view('hr.setup.designation',compact('emp_type', 'designations'));
    }

    public function designationStore(Request $request)
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	$validator= Validator::make($request->all(),[
            'hr_designation_emp_type'=>'required|max:128',
            'hr_designation_name'=>'required|max:128|unique:hr_designation',
            'hr_designation_name_bn'=>'max:255', 
            'hr_designation_grade'=>'required|max:128' 
    	]);

    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput()
    			->with('error', 'Please fillup all required fields!');
    	}
    	else
        {  
    		$designation= new Designation;
            $designation->hr_designation_emp_type = $request->hr_designation_emp_type;
            $designation->hr_designation_name     = $request->hr_designation_name;
            $designation->hr_designation_name_bn  = $request->hr_designation_name_bn;
            $designation->hr_designation_grade  = $request->hr_designation_grade;

    		if ($designation->save())
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


    public function hierarchy(Request $request)
    {
        $designation = $request->designation;
        if (!empty($designation) && sizeof($designation) > 0)
        {
            foreach ($designation as $id => $position) 
            {
                Designation::where('hr_designation_id', $id)
                ->update(['hr_designation_position' => $position]); 
            }
        } 

        return response()
            ->json(['Designation position change successful.']);
    }

    # Return Designation List by Employee Type ID
    public function getDesignationListByEmployeeTypeID(Request $request)
    {
        $list = "<option value=\"\">Select Designation Name </option>";
        if (!empty($request->employee_type_id))
        { 
            $desList  = Designation::where('hr_designation_emp_type', $request->employee_type_id)
                    ->where('hr_designation_status', '1')
                    ->pluck('hr_designation_name', 'hr_designation_id'); 

            foreach ($desList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }

    public function designationDelete($id)
    {
        DB::table('hr_designation')->where('hr_designation_id', '=', $id)->delete();
        return redirect('/hr/setup/designation')->with('success', "Successfuly deleted Designation");
    }

    public function designationUpdate($id)
    {
        $emp_type= EmpType::where('hr_emp_type_status','1')->pluck('hr_emp_type_name','emp_type_id');
        $designation= DB::table('hr_designation')->where('hr_designation_id', '=', $id)->first();
        return view('/hr/setup/designation_update', compact('emp_type', 'designation'));
    }

    public function designationupdateStore(Request $request)
    { 
        $validator= Validator::make($request->all(),[
            'hr_designation_emp_type'=>'required|max:128',
            'hr_designation_name'=>'required|max:128',
            'hr_designation_name_bn'=>'max:255',
            'hr_designation_grade'=>'required|max:128' 
        ]);


        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!');
        }
        else
        {
            DB::table('hr_designation')->where('hr_designation_id', '=', $request->hr_designation_id)
            ->update([
                'hr_designation_emp_type' => $request->hr_designation_emp_type,
                'hr_designation_name'      =>$request->hr_designation_name,
                'hr_designation_name_bn'    =>$request->hr_designation_name_bn,
                'hr_designation_grade'    =>$request->hr_designation_grade
            ]);
            return redirect('/hr/setup/designation')->with('success', "Successfuly updated Designation");
        }
    } 

}
