<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Shift;
use Validator,DB,ACL; 

class ShiftController extends Controller
{
	#show form 
    public function shift()
    {
        ACL::check(["permission" => "hr_setup"]);
        #-------------------------------------------------# 

        $unitList  = Unit::where('hr_unit_status', '1')->whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');

        $unitids = implode(",", auth()->user()->unit_permissions());
        $shifts = DB::select("SELECT 
            s1.hr_shift_id,
            s1.hr_shift_name, 
            s1.hr_shift_code,
            s1.hr_shift_start_time, 
            s1.hr_shift_end_time, 
            s1.hr_shift_break_time,u.hr_unit_name
            FROM hr_shift s1 
            LEFT JOIN hr_shift s2
            ON (s1.hr_shift_unit_id = s2.hr_shift_unit_id AND s1.hr_shift_name = s2.hr_shift_name AND s1.hr_shift_id < s2.hr_shift_id)
            LEFT JOIN hr_unit AS u
            ON u.hr_unit_id = s1.hr_shift_unit_id
            WHERE s2.hr_shift_id IS NULL AND s1.hr_shift_unit_id IN ($unitids)
          ");


    	return view('hr/setup/shift', compact('unitList', 'shifts'));
    }

    public function shiftStore(Request $request)
    { 
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------# 

    	$validator= Validator::make($request->all(),[
    		'hr_shift_unit_id'    => 'required|max:11',
            'hr_shift_name'       => 'required|max:128',
    		'hr_shift_name_bn'    => 'max:255',
    		'hr_shift_start_time' => 'required|max:10',
            'hr_shift_end_time'   => 'required|max:10', 
    		'hr_shift_code'       => 'required|max:3|unique:hr_shift', 
            'hr_shift_break_time' => 'required|max:3',
    		'hr_shift_code'   => 'required|max:3|unique:hr_shift' 
    	]); 

    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput()
    			->with('error', 'Please fillup all required fields!');
    	}
    	else
        {
            $default_shift= 0;
            $night_shift= 0;
            if($request->has('default_flag'))
            {
                 DB::table('hr_shift')
                    ->where('hr_shift_unit_id', $request->hr_shift_unit_id)
                    ->where('hr_shift_default', 1)
                    ->update([
                        'hr_shift_default'=> 0
                        ]);
                    
                $default_shift= 1;
            }
            
    		$shift = new Shift();
    		$shift->hr_shift_unit_id	= $request->hr_shift_unit_id;
            $shift->hr_shift_name       = $request->hr_shift_name;
    		$shift->hr_shift_name_bn	= $request->hr_shift_name_bn;
            $shift->hr_shift_start_time = date("H:i:s", strtotime($request->hr_shift_start_time));
    		$shift->hr_shift_end_time   = date("H:i:s", strtotime($request->hr_shift_end_time));
            $shift->hr_shift_break_time = $request->hr_shift_break_time;
    		$shift->hr_shift_code       = $request->hr_shift_code;
    		$shift->hr_shift_night_flag = $night_shift;
    		$shift->hr_shift_default    = $default_shift;
    		if ($shift->save())
            {
                return back()
                    ->withInput()
                    ->with('success', 'Saved Successful.');
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }
    	}
    }
    

    # Return Shift List by Line ID with Select Option
    public function getShiftListByLineID(Request $request)
    {
        $list = "<option value=\"\">Select Shift Name </option>";
        if (!empty($request->unit_id) && !empty($request->floor_id) && !empty($request->line_id))
        { 
            $shiftList  = Shift::where('hr_shift_unit_id', $request->unit_id)
                    ->where('hr_shift_status', '1')
                    ->pluck('hr_shift_name', 'hr_shift_id'); 

            foreach ($shiftList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }


    public function shiftDelete($id)
    {
        DB::table('hr_shift')->where('hr_shift_id', $id)->delete();
        return redirect('/hr/setup/shift')->with('success', "Successfuly deleted Shift");
    }


    public function shiftUpdate($id)
    {
        $shift= DB::table('hr_shift AS s')
          ->select("s.*", "u.hr_unit_name")
          ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 's.hr_shift_unit_id')
          ->where('hr_shift_id',$id)
          ->first();
    
        return view('/hr/setup/shift_update', compact('unitList', 'shift', 'floorList', 'lineList'));
    }

    public function shiftUpdateStore(Request $request)
    {
        $validator= Validator::make($request->all(),[
           
            'hr_shift_name_bn'       => 'max:255',
            'hr_shift_start_time'    => 'required|max:10',
            'hr_shift_end_time'      => 'required|max:10',
            'hr_shift_break_time'    => 'required|max:3'
           
        ]); 

        if($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!');
        }
        else
        { 
         
        
            
            
            //Increment Shif code value
            $str= $request->hr_shift_code; 
            $shiftcode=strrev( (int)strrev( $str ) );//seperate Numbers 
            $shiftcode_i= $shiftcode+1; 
            $shift_ltr = preg_replace('/[^a-zA-Z]/', '', $str); //seperate letter 
            $newshiftcode= $shift_ltr.$shiftcode_i; 
            
            $default_shift= 0;
            $night_shift= 0;
            if($request->has('default_flag'))
            {
                DB::table('hr_shift')
                    ->where('hr_shift_unit_id', $request->hr_shift_unit_id)
                    ->where('hr_shift_default', 1)
                    ->update([
                        'hr_shift_default'=> 0
                        ]);
                $default_shift=1;
            }
            if($request->has('night_flag'))
            {
                $night_shift=1;
            }
           

            //Insert
            $shift= new Shift();
            $shift->hr_shift_unit_id    = $request->hr_shift_unit_id;
            $shift->hr_shift_name       = $request->hr_shift_name;
            $shift->hr_shift_name_bn    = $request->hr_shift_name_bn;
            $shift->hr_shift_start_time = date("H:i:s", strtotime($request->hr_shift_start_time));
            $shift->hr_shift_end_time   = date("H:i:s", strtotime($request->hr_shift_end_time));
            $shift->hr_shift_break_time = $request->hr_shift_break_time;
            $shift->hr_shift_code       = $newshiftcode;
            $shift->hr_shift_night_flag = $night_shift;
            $shift->hr_shift_default    = $default_shift;
            if ($shift->save())
            {
                 return redirect('/hr/setup/shift')->with('success', "Successfuly updated Shift");
            }   
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }
        }
    }
}
