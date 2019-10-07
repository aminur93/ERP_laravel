<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\WithoutPay;
use Validator, ACL, DB, DataTables;

class WithoutPayController extends Controller
{
	#show form
    public function showForm()
    {
        ACL::check(["permission" => "hr_time_op_without_pay"]);
        #-----------------------------------------------------------# 
    	return view('hr/timeattendance/without_pay');
    } 

    public function saveData(Request $request)
    {
        ACL::check(["permission" => "hr_time_op_without_pay"]);
        #-----------------------------------------------------------# 
        
    	$validator = Validator::make($request->all(), [
            'hr_wop_as_id'      => 'required|max:10|min:10', 
            'hr_wop_start_date' => 'required|date', 
            'hr_wop_end_date'   => 'max:10', 
            'hr_wop_reason'     => 'required|max:1024', 
        ]); 

        if ($validator->fails()) 
        { 
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fillup all required fields!');
        } 
        else
        {
        	// Format Date
        	$startDate = (!empty($request->hr_wop_start_date)?date('Y-m-d', strtotime($request->hr_wop_start_date)):null);
        	$endDate = (!empty($request->hr_wop_end_date)?date('Y-m-d', strtotime($request->hr_wop_end_date)):$startDate);

            //-----------Store Data---------------------
        	$store = new WithoutPay;
			$store->hr_wop_as_id      = $request->hr_wop_as_id;  
			$store->hr_wop_start_date = $startDate;  
			$store->hr_wop_end_date   = (!empty($endDate)?$endDate:$startDate);  
            $store->hr_wop_reason     = $request->hr_wop_reason;   
            $store->hr_wop_created_by = auth()->user()->associate_id;   
            $store->hr_wop_created_at = date("Y-m-d H:i:s");   

			if ($store->save())
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

    public function showList()
    {
        ACL::check(["permission" => "hr_time_op_without_pay"]);
        #-----------------------------------------------------------# 
        return view('hr/timeattendance/without_pay_list');
    }

    public function getData(Request $request)
    {
        DB::statement(DB::raw("SET @s:=0 "));
        $data = DB::table("hr_without_pay AS w")
            ->select(
                DB::raw("@s:=@s+1 AS serial"),
                "w.*"
            )
            ->leftJoin('hr_as_basic_info AS b', 'b.associate_id',  '=', 'w.hr_wop_as_id')
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->get();

        return DataTables::of($data)   
            ->addColumn('action', function ($data) {
                return "<div class=\"btn-group\">  
                    <a href=".url('hr/timeattendance/operation/without_pay_edit/'.$data->hr_wop_id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-edit bigger-120\"></i>
                    </a> 
                </div>";
            })  
            ->rawColumns(['action'])
            ->toJson(); 
    }

    public function editForm(Request $request)
    {
        ACL::check(["permission" => "hr_time_op_without_pay"]);
        #-----------------------------------------------------------# 
        $pay = WithoutPay::where("hr_wop_id", $request->id)->first();
        return view('hr/timeattendance/without_pay_edit', compact('pay'));
    }

    public function updateData(Request $request)
    {
        ACL::check(["permission" => "hr_time_op_without_pay"]);
        #-----------------------------------------------------------# 
        
        $validator = Validator::make($request->all(), [
            'hr_wop_id'         => 'required|max:11|min:1', 
            'hr_wop_as_id'      => 'required|max:10|min:10', 
            'hr_wop_start_date' => 'required|date', 
            'hr_wop_end_date'   => 'max:10', 
            'hr_wop_reason'     => 'required|max:1024', 
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
            $ot = DB::table("hr_without_pay")
            ->where("hr_wop_id", $request->hr_wop_id)
            ->update([
                "hr_wop_as_id"      => $request->hr_wop_as_id,
                "hr_wop_start_date" => $request->hr_wop_start_date,
                "hr_wop_end_date"   => (!empty($request->hr_wop_end_date)?$request->hr_wop_end_date:$request->hr_wop_start_date),
                "hr_wop_reason"     => $request->hr_wop_reason,
                "hr_wop_created_by" => auth()->user()->associate_id, 
                "hr_wop_created_at" => date("Y-m-d H:i:s") 
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
