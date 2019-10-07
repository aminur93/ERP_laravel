<?php

namespace App\Http\Controllers\Merch\TimeAction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use App\Models\Merch\TnaLibrary;
use App\Models\Merch\TnaTemplate;
use App\Models\Merch\TnaTemplatetoLibrary;
Use DB, ACL, Validator, DataTables,DateTime;

class TimeActionController extends Controller
{
 #show Form
    public function timeActionForm()
    {
    #-----------------------------------------------------------# 
     $library=TnaLibrary::get();
     return view('merch.time_action.library',compact('library'));
 
    }

 # Library Store    
    public function libraryStore(Request $request){

        ACL::check(["permission" => "mr_setup"]);
    
        #-----------------------------------------------------------# 
        $validator= Validator::make($request->all(),[
            'lib_action'   => 'required|max:145|unique:mr_tna_library,tna_lib_action',
            'tna_code'     => 'required|max:65|unique:mr_tna_library,tna_lib_code'
           
    
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $data= new TnaLibrary();
            $data->tna_lib_action = $request->lib_action ;
            $data->tna_lib_code   = $request->tna_code ;
           

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

 #Library Edit Form
    public function libraryEdit($id)
    {
        #-----------------------------------------------------------# 
       $library=TnaLibrary::where('id',$id)->first();

    //dd($library);
     return view('merch.time_action.library_edit',compact('library'));
    }
 # Library Update    
    public function libraryUpdate(Request $request){

        ACL::check(["permission" => "mr_setup"]);
    
        #-----------------------------------------------------------# 
        
        $validator= Validator::make($request->all(),[

            'lib_action'   => 'required|max:145|unique:mr_tna_library,tna_lib_action,'. $request->libid,            
            'tna_code' => 'required|max:65|unique:mr_tna_library,tna_lib_code,' . $request->libid
        ]);


        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{            

           $update=TnaLibrary::where('id', $request->libid)->update([
            'tna_lib_action' => $request->lib_action, 
            'tna_lib_code'   => $request->tna_code 
           ]);

            

            if($update){

            // Log file
                $this->logFileWrite("Library updated", $request->libid);               
                return redirect('merch/time_action/library')
                ->with('success', "Updated Successfully!!");
            }
            else{
                return back()
                ->withInput()
                ->with('error', 'Error Updating data!!');
            }
        }
    }    
# Library Delete  
 public function libraryDelete($id){

        #------------------------------------------------# 
        TnaLibrary::where('id', $id)->delete();
     
        // Log File 
        $this->logFileWrite("Library Deleted", $id);
        return back()
        ->with('success', "Deleted Successfully!!");
    }

 #show Form
    public function templateForm()
    {
        #-----------------------------------------------------------# 
    $buyer=Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name','b_id');
    $library=TnaLibrary::get();  
    $templates = DB::table('mr_tna_template AS t') 
            ->select(
                "t.*",
                "b.b_name"             
             
            )
            ->leftJoin('mr_buyer AS b', 'b.b_id', '=', 't.mr_buyer_b_id')
            ->get();
           // dd($templates);
     return view('merch.time_action.tna_template',compact('buyer','library','templates'));

    }
 # Template Store    
    public function templateStore(Request $request){
       // dd($request->all());

        ACL::check(["permission" => "mr_setup"]);
      // dd($request->all());
        #-----------------------------------------------------------# 
        $validator= Validator::make($request->all(),[
            'template_name'   => 'required|max:45',
            'buyer'           => 'required'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $data= new TnaTemplate();
            $data->tna_temp_name = $request->template_name ;
            $data->mr_buyer_b_id   = $request->buyer ;

               if($data->save()){
                $last_id = $data->id;

                for($j=0; $j<sizeof($request->tnalibrary); $j++)
                {
                   // printf($request->logic[$j]); 
                   if($request->tnalibrary[$j] !=""){
                        TnaTemplatetoLibrary::insert([
                            'mr_tna_template_id' => $last_id,
                            'mr_tna_library_id'  => $request->tnalibrary[$j],
                            'tna_temp_logic'     => $request->logic[$j],
                            'offset_day'         => $request->tna_lib_offset[$j],
                          ]);
                    }    
               } 
              // dd(0);

                  

                // Log File 
                  $this->logFileWrite("Template Stored", $last_id);
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

# Template Update
    public function templateEdit($id){

        #-------------------------------------------------------# 
        $buyer=Buyer::whereIn('b_id', auth()->user()->buyer_permissions())->pluck('b_name','b_id');
        $library=TnaLibrary::get();  
        $template= TnaTemplate::where('id', $id)->first();

        return view('merch.time_action.tna_template_edit',compact('buyer','library','template','template1'));
 }

 # Template Update Action    
    public function templateUpdate(Request $request){

        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
        $validator= Validator::make($request->all(),[
            'template_name'   => 'required|max:45',
            'buyer'           => 'required'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{
            $update=TnaTemplate::where('id', $request->tna_id)->update([
               'tna_temp_name' => $request->template_name,
               'mr_buyer_b_id' => $request->buyer
        ]);

          
            //dd($request->all());

          if(sizeof($request->tnalibrary)>0){ 

              $temlib=TnaTemplatetoLibrary::where('mr_tna_template_id', $request->tna_id)->delete();

                 for($j=0; $j<sizeof($request->tnalibrary); $j++)
                    {                      
                       if($request->tnalibrary[$j] !=""){
                        $updatelib=TnaTemplatetoLibrary::insert([
                            'mr_tna_template_id' => $request->tna_id,
                            'mr_tna_library_id'  => $request->tnalibrary[$j],
                            'tna_temp_logic'     => $request->logic[$j],
                            'offset_day'         => $request->tna_lib_offset[$j],
                        ]);
                      }    
                    } 
                }               

         if ($update || $updatelib)
            {  
              // Log file
                $this->logFileWrite("Template updated", $request->tna_id);
                return redirect('merch/time_action/tna_template')
                    ->with('success', 'Update Successful.');
            }   
         else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }         
         
        }
    }  

# Delete Template 
 public function templateDelete($id){

        #------------------------------------------------# 
        TnaTemplate::where('id', $id)->delete();
        TnaTemplatetoLibrary::where('mr_tna_template_id', $id)->delete();
        // Log File 
        $this->logFileWrite("Template Deleted", $id);
        return back()
        ->with('success', "Deleted Successfully!!");
    }

# Write Every Events in Log File
    public function logFileWrite($message, $event_id){
        $log_message = date("Y-m-d H:i:s")." ".Auth()->user()->associate_id." \"".$message."\" ".$event_id.PHP_EOL;
        $log_message .= file_get_contents("assets/log.txt");
        file_put_contents("assets/log.txt", $log_message);
    }
}
