<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
Use Validator,DB, ACL;

class FloorController extends Controller
{
    # show Form
    public function floor()
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 

        $unitList  = Unit::where('hr_unit_status', '1')->whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
        $floors= DB::table('hr_floor as f')
                    ->Select(
                        'f.hr_floor_id',
                        'f.hr_floor_name',
                        'f.hr_floor_name_bn',
                        'u.hr_unit_name'
                    )
                    ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'f.hr_floor_unit_id')
                    ->whereIn('f.hr_floor_unit_id', auth()->user()->unit_permissions())
                    ->get();
    	return view('hr/setup/floor', compact('unitList', 'floors'));
    }

    public function floorStore(Request $request)
    {
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	$validator= Validator::make($request->all(),[
    		'hr_floor_unit_id'=>'required|max:11',
    		'hr_floor_name'=>'required|max:128',
            'hr_floor_name_bn'=>'max:255'
    	]);

    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput()
    			->with('error', 'Please fillup all required fields!');
    	}
    	else
        {
    		$floor = new Floor();
    		$floor->hr_floor_unit_id = $request->hr_floor_unit_id;
            $floor->hr_floor_name    = $request->hr_floor_name;
    		$floor->hr_floor_name_bn	 = $request->hr_floor_name_bn;

    		if ($floor->save())
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


    # Return Floor List by Unit ID with Select Option
    public function getFloorListByUnitID(Request $request)
    {
        $list = "<option value=\"\">Select Floor Name </option>";
        if (!empty($request->unit_id))
        { 
            $floorList  = Floor::where('hr_floor_unit_id', $request->unit_id)
                    ->where('hr_floor_status', '1')
                    ->pluck('hr_floor_name', 'hr_floor_id'); 

            foreach ($floorList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }
    public function floorDelete($id){
        Floor::where('hr_floor_id','=',$id)->delete();
        return redirect('/hr/setup/floor')->with('success', "Successfuly deleted Floor");
    }
    public function floorUpdate(Request $request){
        $unitList  = Unit::where('hr_unit_status', '1')->pluck('hr_unit_name', 'hr_unit_id');
        $floor= DB::table('hr_floor AS f')->where('f.hr_floor_id','=', $request->hr_floor_id)->first();
        return view('hr/setup/floor_update', compact('floor','unitList'));
    }

    
    public function floorUpdateStore(Request $request){
        // dd($request->all());
        $validator= Validator::make($request->all(),[
            'hr_floor_unit_id'=>'required|max:11',
            'hr_floor_name'=>'required|max:128',
            'hr_floor_name_bn'=>'max:255'
        ]);
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!');
        }
        else
        {
            DB::table('hr_floor AS f')->where('f.hr_floor_id','=', $request->hr_floor_id)
                ->update([
                    'hr_floor_unit_id' => $request->hr_floor_unit_id,
                    'hr_floor_name' => $request->hr_floor_name,
                    'hr_floor_name_bn' => $request->hr_floor_name_bn
                ]);
            return redirect('/hr/setup/floor')->with('success', "Successfuly updated Floor");
        }
    }
}
