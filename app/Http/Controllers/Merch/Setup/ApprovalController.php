<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Approval;
use App\Models\Hr\Employee;
use App\Models\Hr\Unit;
Use Validator,DB, ACL;

class ApprovalController extends Controller
{
 #show Form
    public function showForm()
    {
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
        $approval= DB::table('mr_approval_hirarchy AS a')
                    ->select([
                        'a.*',
                        'u.hr_unit_name AS unit_name'
                    ])
                    ->leftJoin('hr_unit AS u', 'u.hr_unit_id', 'a.unit')
                    ->get();

        $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');

    	return view('merch.setup.approval',compact('approval', 'unitList'));
    }

 # Approval Store    
    public function approvalStore(Request $request){

        ACL::check(["permission" => "mr_setup"]);
        //dd($request->all());
        #-----------------------------------------------------------# 
        $validator= Validator::make($request->all(),[
            'type'   => 'required|max:45',
            'level1' => 'required|max:45',
            'level2' => 'required|max:45',
            'level3' => 'required|max:45',
            'unit' => 'required|max:11'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $data= new Approval();
            $data->mr_approval_type = $request->type ;
            $data->level_1 = $request->level1 ;
            $data->level_2 = $request->level2 ;
            $data->level_3 = $request->level3 ;
            $data->unit = $request->unit ;


            if($data->save()){
                return back()
                ->with('success', "Saved Successfully!!");
            }
            else{
                return back()
                ->withInput()
                ->with('error', 'Error saving data!!');
            }
        }
    }
    
 # Approval Update
    public function approvalEdit($id){
   
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------------------# 

        $approval= Approval::where('id', $id)->first();

        $approval1=DB::table('mr_approval_hirarchy AS a')
                 ->select(
                          'a.*',
                          'b.as_name',
                          'b.associate_id'
                        )
                    ->leftJoin('hr_as_basic_info AS b','b.associate_id', '=', 'a.level_1')
                    ->where('id', $id)     
                    ->first();

        $approval2=DB::table('mr_approval_hirarchy AS a')
                 ->select(
                          'a.*',
                          'b.as_name',
                          'b.associate_id'
                        )
                    ->leftJoin('hr_as_basic_info AS b','b.associate_id', '=', 'a.level_2')
                    ->where('id', $id)     
                    ->first();   

        $approval3=DB::table('mr_approval_hirarchy AS a')
                 ->select(
                          'a.*',
                          'b.as_name',
                          'b.associate_id'
                        )
                    ->leftJoin('hr_as_basic_info AS b','b.associate_id', '=', 'a.level_3')
                    ->where('id', $id)     
                    ->first();  
        $employee = Employee::pluck('as_name','associate_id');
                 
        $unitList= Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
         
        return view('merch.setup.approval_edit',compact('approval','approval1','approval2','approval3','employee','unitList'));

  }
 # Approval Update Action    
    public function approvalUpdate(Request $request){

        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
        $validator= Validator::make($request->all(),[
            
            'level1' => 'required|max:45',
            'level2' => 'required|max:45',
            'level3' => 'required|max:45',
            'unit' => 'required|max:11'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            Approval::where('id', $request->approv_id)->update([
               
               'level_1' => $request->level1,
               'level_2' => $request->level2,
               'level_3' => $request->level3,
               'unit' => $request->unit
        ]);

        return back()
            ->with('success', "Updated Successfully!!");
            
         
        }
    }

    public function deleteApprov($id){
        ACL::check(["permission" => "mr_setup"]);
        #------------------------------------------------# 
        Approval::where('id', $id)->delete();
        return back()
        ->with('success', "Successfully Deleted!!");
    }

     
}
