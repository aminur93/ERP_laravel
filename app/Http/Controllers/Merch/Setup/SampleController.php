<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\SampleType;
use App\Models\Merch\Buyer;
use Validator, DB, ACL;
class SampleController extends Controller
{
    // Sample type form 
    public function sampleType(){
        ACL::check(["permission" => "mr_setup"]);
      #-----------------------------------------------------------#

      //$sample= SampleType::get();
      $buyer= Buyer::pluck('b_name','b_id'); 
      $sample= DB::table('mr_sample_type as s')
                    ->Select(
                        's.*',              
                        'b.b_id',
                        'b.b_name'
                    )                 
                  ->leftJoin('mr_buyer AS b', 'b.b_id', '=', 's.b_id')
                  ->get();
                
      
      return view('merch/setup/sample_type', compact('sample','buyer'));

    }

    // Sample type  Store   
    public function sampletypestore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
          
          $validator= Validator::make($request->all(),[
            'sample_name'       =>'required|max:50',
            'buyer'             =>'required'

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
         }
        else{
            // $data= new SampleType();
            // $data->b_id        = $request->buyer;
            // $data->save();

            $samplenames = $request->sample_name;
            // $LastId = SampleType::latest('b_id')->pluck('b_id')->first();
            // $request = $request->all();
            // $orderData = $request['checker'];
            foreach($samplenames as $sampslename){
              $data= new SampleType();
              $data->b_id        = $request->buyer;
              $data->sample_name =$sampslename;
              $data->save();
            }
            // exit;
            return back()
            ->with('success', "Sample Type Saved Successfully!!");
         }
    }

/// Sample Type Delete

    public function sampletypeDelete($id){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 

        SampleType::where('sample_id', $id)->delete();
    
        return back()
        ->with('success', "Sample Type  Deleted Successfully!!");
    }
    
/// Sample Type Update
    public function sampletypeEdit($id){
   
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 
         // $sample=SampleType::where('sample_id', $id)->first();
          $buyer= Buyer::pluck('b_name','b_id'); 
          $sample= DB::table('mr_sample_type as s')
                    ->Select(
                        's.*',              
                        'b.b_id',
                        'b.b_name'
                    )                 
                  ->leftJoin('mr_buyer AS b', 'b.b_id', '=', 's.b_id')
                  ->where('sample_id', $id)
                  ->first();
                
          return view('merch/setup/sample_type_edit',compact('sample','buyer'));

  }

    public function sampletypeUpdate(Request $request){ 
       ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------# 

       $validator= Validator::make($request->all(),[
            'sample_name'       =>'required|max:50',
            'buyer'             =>'required'
        ]);

        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

         SampleType::where('sample_id', $request->sample_id)->update([
               'sample_name'     => $request->sample_name,
               'b_id'            => $request->buyer
            
           ]);

        return redirect('merch/setup/sampletype')
                ->with('success', "Sample Type Successfully updated!!!");
    } 

  } 
  public function sampletypeCheck(Request $request)
    {
     if (!empty($request->keyword)){


       $result= SampleType::where('sample_name', $request->keyword)
                ->where('b_id',$request->b_id)
                ->first();
              if(!empty($result)) return 1;
              else return 0;    
          }

    }
}