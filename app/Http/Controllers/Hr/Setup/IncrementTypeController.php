<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\IncrementType;
use Validator,DB;

class IncrementTypeController extends Controller
{
    public function showForm(){

    	$data= DB::table('hr_increment_type')->get();
    	return view('hr/setup/increment_type', compact('data'));
    }
    public function saveData(Request $request){

    	$validator= Validator::make($request->all(),[
    		'increment_type' => 'required|max:128'
    	]);
    	if($validator->fails()){
    		return back()
    		->withInput()
    		->with('error', "Invalid Input");
    	}
    	else{

    		$newdata= new IncrementType();
    		$newdata->increment_type = $request->increment_type;

    		if($newdata->save()){
    			return back()
    			->with('success', "Saved Successfully!!");
    		}
    		else{
    			return back()
    			->with('error', 'Something went wrong!!');
    		}
    	}
    }
    
    public function incrementTypeEdit($id){

    	$data= DB::table('hr_increment_type')->where('id', $id)->first();
    	return view('hr/setup/increment_type_edit', compact('data'));
    }

    public function incrementTypeUpdate(Request $request){
        $validator= Validator::make($request->all(),[
            'increment_type' => 'required|max:128'
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Invalid Input");
        }
        else{
            IncrementType::where('id','=',$request->id)
                ->update([
                    'increment_type' => $request->increment_type
                ]);
            
        }
        return redirect('/hr/setup/increment_type')->with('success', "Successfuly updated Increment Type");
    }

    public function incrementTypeDelete($id){
        IncrementType::where('id','=',$id)->delete();
        return redirect('/hr/setup/increment_type')->with('success', "Successfuly deleted Increment Type");
    }
}
