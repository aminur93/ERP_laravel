<?php

namespace App\Http\Controllers\Merch\Setup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\Operation;
use Validator, DB, ACL;
class OperationController extends Controller
{
/// Operation form
    public function operation(){
        ACL::check(["permission" => "mr_setup"]);
        #----------------------------------------------#

      $operations= Operation::get();

      return view('merch/setup/operation', compact('operations'));
    }

    // added by rubel
    public function fetchOperations()
    {
        ACL::check(["permission" => "mr_setup"]);
        $operationData  = '';
        $operationList  = Operation::get();
        if($operationList) {
            $operationData= '<div class="col-xs-12"><div class="checkbox">';
            foreach ($operationList as $operation) {
                $checked="";
                if($operation->opr_type==1){
                    $checked.="checked readonly onclick='return false;'";
                }
                $operationData.= "<label class='col-sm-2' style='padding:0px;'>
                            <input name='operations[]' type='checkbox' data-content-type='".$operation->opr_type."' class='ace' value='".$operation->opr_id."'".$checked.">
                            <span class='lbl'>".$operation->opr_name."</span>
                        </label>";
            }
            $operationData.="</div></div>";
        }
        return json_encode($operationData);
    }
    // end

/// Operation Store
    public function operationStore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-------------------------------------------#

          $validator= Validator::make($request->all(),[
             'op_name'   =>'required|max:50'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{

            $data= new Operation();
            $data->opr_name = $request->op_name;
            $data->save();

            return back()
            ->with('success', "Operation Saved Successfully!!");
         }
    }

/// Operation Delete

    public function operationDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #---------------------------------------------#

        Operation::where('opr_id', $id)->delete();

        return back()
        ->with('success', "Operation  Deleted Successfully!!");
    }

/// Operation Update
    public function operationEdit($id){

        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------#
          $operation=Operation::where('opr_id', $id)->first();

          return view('merch/setup/operation_edit',compact('operation'));

  }

  public function operationUpdate(Request $request){

       ACL::check(["permission" => "mr_setup"]);
        #----------------------------------------------#

       $validator= Validator::make($request->all(),[
            'op_name'        =>'required|max:50'

        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

        $operation = Operation::where('opr_id', $request->op_id)->update([
               'opr_name'     => $request->op_name

           ]);

        return redirect('merch/setup/operation')
                ->with('success', "Operation Successfully updated!!!");


     }

  }

}
