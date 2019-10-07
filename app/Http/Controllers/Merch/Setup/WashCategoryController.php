<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\WashCategory;
use Validator, DB;
class WashCategoryController extends Controller
{
    public function showForm(){

        $wash_category=DB::table('mr_wash_category')->get();
    	
    	return view('merch/setup/wash_category',compact('wash_category') );
    }
    
    public function saveForm(Request $request){
        $validator= Validator::make($request->all(),[
            'wash_category' => 'required'
            
        ]);
        if($validator->fails())
        {
            return back()
                ->withInput()
                ->with('error', "Incorrect Input!!");
        }
        else{
            WashCategory::insert([
                'category_name' => $request->wash_category
                
            ]);

            // $wash = new WashCategory;

            // $wash->category_name = $request->wash_category;

            // $wash->save();

            return back()->with('success', "Wash Category Saved Successfully!");
            }
        }


    public function editForm($id){
        $wash= WashCategory::where('id', $id)->first();
        return view('merch/setup/wash_category_edit', compact('wash'));
    }

    public function updateForm(Request $request){
        // dd($request->all());
        $validator= Validator::make($request->all(),[
            'wash_category' => 'required'
           
        ]);
        if($validator->fails())
        {
            return back()
                ->withInput()
                ->with('error', "Incorrect Input!!");
        }
        else{
            WashCategory::where('id', $request->id)
                    ->update([
                        'category_name' => $request->wash_category
                        
                    ]);
            return back()
                ->with('success', "Wash Type updated Successfully!");
        }
    }
    public function deleteEntry($id){
        WashCategory::where('id', $id)->delete();
        return redirect('merch/setup/wash_category')
                ->with('Success', "Wash Category deleted Successfully!!");
    }
    
}
