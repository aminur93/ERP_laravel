<?php

namespace App\Http\Controllers\Hr\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Ot;
use Validator, ACL, DataTables, DB;

class OtController extends Controller
{
    public function OT()
    {
        ACL::check(["permission" => "hr_payroll_ot"]);
        #-----------------------------------------------------------# 
    	return view('hr/payroll/ot');
    }

    public function OtStore(Request $request)
    {
        ACL::check(["permission" => "hr_payroll_ot"]);
        #-----------------------------------------------------------#  

    	$validator= Validator::make($request->all(), [
    		'hr_ot_as_id' => 'required|max:10|min:10',
    		'hr_ot_date'  => 'required|date',
            'hr_ot_hour'  => 'required',
    		'hr_ot_remarks' => 'max:128'
    	]);

    	if($validator->fails())
        {
    		return back()
    		->withErrors($validator)
    		->withInput()
    		->with('error', 'Please fillup all required fileds correctly!.');
    	}
    	else
        { 
            $ot = DB::table("hr_ot")->where("hr_ot_as_id", $request->hr_ot_as_id)
                ->where("hr_ot_date", $request->hr_ot_date)
                ->exists(); 

            if ($ot) 
            {
                $ot = DB::table("hr_ot")
                ->where("hr_ot_as_id", $request->hr_ot_as_id)
                ->where("hr_ot_date", $request->hr_ot_date)
                ->update([
                    "hr_ot_as_id"   => $request->hr_ot_as_id,
                    "hr_ot_date"    => $request->hr_ot_date,
                    "hr_ot_hour"    => $request->hr_ot_hour,
                    "hr_ot_remarks" => $request->hr_ot_remarks,
                    "hr_ot_created_by" => auth()->user()->associate_id, 
                    "hr_ot_created_at" => date("Y-m-d H:i:s") 
                ]);
            } 
            else
            {
                $ot= new Ot();
                $ot->hr_ot_as_id = $request->hr_ot_as_id;
                $ot->hr_ot_date = $request->hr_ot_date;
                $ot->hr_ot_hour = $request->hr_ot_hour;
                $ot->hr_ot_remarks = $request->hr_ot_remarks;
                $ot->hr_ot_created_by = auth()->user()->associate_id;
                $ot->hr_ot_created_at = date("Y-m-d H:i:s");
                $ot->save();
            } 

            return back()
                    ->with('success', 'Save Successful.');
    	}
    }

    public function otList()
    {
        ACL::check(["permission" => "hr_payroll_ot"]);
        #-----------------------------------------------------------# 
        return view('hr/payroll/ot_list');
    }

    public function otListData(Request $request)
    {
        DB::statement(DB::raw("SET @s:=0 "));
        $data = DB::table("hr_ot AS o")
            ->select(
                DB::raw("@s:=@s+1 AS serial"),
                "o.*"
            ) 
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id',  '=', 'o.hr_ot_as_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->get();

        return DataTables::of($data)   
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/payroll/ot/'.$data->hr_ot_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a> 
                </div>";
            })  
            ->rawColumns(['action'])
            ->toJson();

    }

    public function otEdit(Request $request)
    {
        ACL::check(["permission" => "hr_payroll_ot"]);
        #-----------------------------------------------------------# 
        $ot = Ot::where("hr_ot_id", $request->id)->first();
        return view('hr/payroll/ot_edit', compact('ot'));
    }

    public function otUpdate(Request $request)
    {
        ACL::check(["permission" => "hr_payroll_ot"]);
        #-----------------------------------------------------------# 
        $validator= Validator::make($request->all(), [
            'hr_ot_id'    => 'required|max:11|min:1',
            'hr_ot_as_id' => 'required|max:10|min:10',
            'hr_ot_date'  => 'required|date',
            'hr_ot_hour'  => 'required|max:1:min:1',
            'hr_ot_remarks' => 'max:128'
        ]);

        if($validator->fails())
        {
            return back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please fillup all required fileds correctly!.');
        }
        else
        {
            $ot = DB::table("hr_ot")
            ->where("hr_ot_id", $request->hr_ot_id)
            ->update([
                "hr_ot_as_id"   => $request->hr_ot_as_id,
                "hr_ot_date"    => $request->hr_ot_date,
                "hr_ot_hour"    => $request->hr_ot_hour,
                "hr_ot_remarks" => $request->hr_ot_remarks,
                "hr_ot_created_by" => auth()->user()->associate_id, 
                "hr_ot_created_at" => date("Y-m-d H:i:s") 
            ]);

            if($ot)
            {
                return back()
                        ->with('success', 'Update Successful.');
            }
            else
            {
                return back()                    
                    ->withInput()->with('error', 'Please try again.');
            }
        }
    }

}
