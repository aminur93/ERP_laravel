<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\WashType;
use App\Models\Merch\WashCategory;
use Validator, DB;
class WashTypeController extends Controller
{
    public function showForm(){

    	$washList= WashType::orderBy('id', "DESC")->get();
        
        $washCategory = WashCategory::pluck('category_name','id')->toArray();
        //dd($washCategory);
    	return view('merch/setup/wash_type', compact('washList','washCategory'));
    }
    
    public function saveForm(Request $request){
        //dd($request->all());
    	$validator= Validator::make($request->all(),[
            'wash_category'=>'required',
            'wash_name'=>'required'
            
    	]);
    	if($validator->fails())
    	{
    		return back()
    			->withInput()
    			->with('error', "Incorrect Input!!");
    	}
    	else{
    		WashType::insert([
                'mr_wash_category_id'=>$request->wash_category,
    			'wash_name' => $request->wash_name,
                'process_time'=>$request->process_time,
                'chemical'=>$request->chemical,
    			'consumption_rate' => $request->consumption_rate
    		]);
    		return back()
    			->with('success', "Wash Type Saved Successfully!");
    	}
    }
    public function editForm($id){
    	$wash= WashType::where('id', $id)->first();
        // dd($wash);exit;
        $category_name=DB::table('mr_wash_category')->select('id','category_name')->get();
        //dd($category_name);exit;
        $s_id = $wash->mr_wash_category_id;


    	return view('merch/setup/wash_type_edit', compact('wash','category_name','s_id'));
    }

    public function updateForm(Request $request){
    	// dd($request->all());
    	$validator= Validator::make($request->all(),[
    		'wash_name' => 'required|max:45|unique:mr_wash_type,wash_name,'.$request->id
    	]);
    	if($validator->fails())
    	{
    		return back()
    			->withInput()
    			->with('error', "Incorrect Input!!");
    	}
    	else{
    		WashType::where('id', $request->id)
		    		->update([
                        'mr_wash_category_id'=>$request->wash_category,
		    			'wash_name' => $request->wash_name,
		    			'process_time'=>$request->process_time,
                        'chemical'=>$request->chemical,
                        'consumption_rate' => $request->consumption_rate
		    		]);
    		return back()
    			->with('success', "Wash Type updated Successfully!");
    	}
    }
    public function deleteWash($id){
    	WashType::where('id', $id)->delete();
    	return redirect('merch/setup/wash_type')
    			->with('Success', "Wash Type deleted Successfully!!");
    }



    public function saveWashCategory(Request $request){
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

            return back()->with('success', "Wash Category Added!");
            }
        }
}
