<?php

namespace App\Http\Controllers\Hr\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Line;

use Validator,DB, ACL;

use App\Models\Hr\Floor;


class LineController extends Controller
{
    public function line()
    { 
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
        $unitList  = Unit::where('hr_unit_status', '1')->whereIn('hr_unit_id', auth()->user()->unit_permissions())->pluck('hr_unit_name', 'hr_unit_id');
        $lines= DB::table('hr_line AS l')
                    ->Select(
                        'l.hr_line_id',
                        'l.hr_line_name',
                        'l.hr_line_name_bn',
                        'u.hr_unit_name',
                        'f.hr_floor_name'
                    )
                    ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'l.hr_line_unit_id')
                    ->leftJoin('hr_floor AS f', 'f.hr_floor_id', '=', 'l.hr_line_floor_id')
                    ->whereIn('hr_line_unit_id', auth()->user()->unit_permissions())
                    ->get();

    	return view('hr/setup/line', compact('unitList', 'lines'));
    }

    public function lineStore(Request $request)
    { 
        ACL::check(["permission" => "hr_setup"]);
        #-----------------------------------------------------------# 
    	$validator= Validator::make($request->all(),[
    		'hr_line_unit_id'=>'required|max:11',
    		'hr_line_floor_id'=>'required|max:11',
            'hr_line_name'=>'required|max:128',
    		'hr_line_name_bn'=>'max:255'
    	]);

    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput()
    			->with('error', 'Please fillup all required fields!');
    	}
    	else
        {
    		$line= new Line();
    		$line->hr_line_unit_id	= $request->hr_line_unit_id;
    		$line->hr_line_floor_id	= $request->hr_line_floor_id;
            $line->hr_line_name     = $request->hr_line_name;
    		$line->hr_line_name_bn		= $request->hr_line_name_bn;

    		if ($line->save())
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



    # Return Line List by Floor ID with Select Option
    public function getLineListByFloorID(Request $request)
    {
        $list = "<option value=\"\">Select Line Name </option>";
        if (!empty($request->unit_id) && !empty($request->floor_id))
        { 
            $lineList  = Line::where('hr_line_unit_id', $request->unit_id)
                    ->where('hr_line_floor_id', $request->floor_id)
                    ->where('hr_line_status', '1')
                    ->pluck('hr_line_name', 'hr_line_id'); 

            foreach ($lineList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
        }
        return $list;
    }

    public function lineDelete($id){
        DB::table('hr_line')->where('hr_line_id', '=', $id)->delete();
        return redirect('/hr/setup/line')->with('success', "Successfuly deleted Line");
    }
    
    public function lineUpdate($id){
        $unitList  = Unit::where('hr_unit_status', '1')->pluck('hr_unit_name', 'hr_unit_id');
        $line= DB::table('hr_line')->where('hr_line_id', '=', $id)->first();
        // $unitList= Unit::where('hr_unit_id', $line->hr_line_unit_id)->pluck('hr_line_name', 'hr_line_id');
        $floorList= Floor::where('hr_floor_unit_id', $line->hr_line_unit_id)->pluck('hr_floor_name', 'hr_floor_id');
        // dd($floorList);
        return view('/hr/setup/line_update',compact('line', 'unitList', 'floorList'));
    }

    public function lineUpdateStore(Request $request){
        // dd($request->all());

        $validator= Validator::make($request->all(),[
            'hr_line_unit_id'=>'required|max:11',
            'hr_line_floor_id'=>'required|max:11',
            'hr_line_name'=>'required|max:128',
            'hr_line_name_bn'=>'max:255'
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fields!');
        }
        else
        {
           DB::table('hr_line')->where('hr_line_id','=', $request->hr_line_id)
           ->update([
            'hr_line_unit_id' => $request->hr_line_unit_id,
            'hr_line_floor_id' => $request->hr_line_floor_id,
            'hr_line_name' => $request->hr_line_name,
            'hr_line_name_bn' => $request->hr_line_name_bn
           ]);
           return redirect('/hr/setup/line')->with('success', "Successfuly updated Line");
        }
    }
}
         