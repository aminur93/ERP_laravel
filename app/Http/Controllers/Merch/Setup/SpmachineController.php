<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Spmachine;

use Validator, DB, ACL;
class SpmachineController extends Controller
{
/// Special Machine form 
    public function spmachine(){
        ACL::check(["permission" => "mr_setup"]);
        #--------------------------------------------------------#

      $spmachine= Spmachine::get();
      
      return view('merch/setup/spmachine', compact('spmachine'));
    
    }

/// Special Machine Store   
    public function spmachineStore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #---------------------------------------------------#
          
          $validator= Validator::make($request->all(),[
             'sm_name'   =>'required|max:50'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
  
            $data= new Spmachine();
            $data->spmachine_name = $request->sm_name;
            $data->save();

            return back()
            ->with('success', "Machine Saved Successfully!!");
         }
    }

/// Special Machine Delete

    public function spmachineDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------------------# 

        Spmachine::where('spmachine_id', $id)->delete();
    
        return back()
        ->with('success', "Operation  Deleted Successfully!!");
    }
    
/// Special Machine Update
    public function spmachineEdit($id){
   
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------------------# 
          $machine=Spmachine::where('spmachine_id', $id)->first();
         
          return view('merch/setup/spmachine_edit',compact('machine'));

  }

  public function spmachineUpdate(Request $request){ 

       ACL::check(["permission" => "mr_setup"]);
      #-------------------------------------------------------# 

       $validator= Validator::make($request->all(),[
            'sm_name'        =>'required|max:50'

        ]);
       
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

        $smachine = Spmachine::where('spmachine_id', $request->spm_id)->update([
               'spmachine_name'     => $request->sm_name

           ]);

        return redirect('merch/setup/spmachine')
                ->with('success', "Operation Successfully updated!!!");
     } 

  } 
 
}