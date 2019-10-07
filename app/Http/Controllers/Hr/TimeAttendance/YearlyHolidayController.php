<?php

namespace App\Http\Controllers\Hr\Timeattendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\YearlyHolyDay;
use App\Models\Hr\Unit;
use Validator, DB, ACL, DataTables;

class YearlyHolidayController extends Controller
{
    public function index()
    {
        ACL::check(["permission" => "hr_time_op_holiday"]);
        #-----------------------------------------------------------# 
        return view("hr/timeattendance/yearly_holiday_list");
    }

    public function getAll()
    {
        ACL::check(["permission" => "hr_time_op_holiday"]);
        #-----------------------------------------------------------# 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table('hr_yearly_holiday_planner AS h')
            ->select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                'h.*',
                'u.hr_unit_short_name'
            )
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'h.hr_yhp_unit')
            ->whereIn('u.hr_unit_id', auth()->user()->unit_permissions())
            ->get();

        return Datatables::of($data)   
            ->addColumn('action', function ($data) { 

                if (!$data->hr_yhp_status)
                {
                    return "<div class=\"btn-group\">
                        <span class='btn btn-xs btn-danger disabled'>Disabled</span>
                        <a onclick=\"return confirm('Are you sure?')\" href=".url('hr/timeattendance/operation/yearly_holidays/'.$data->hr_yhp_id."/enable")." class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" title=\"Enable Now\">
                            <i class=\"ace-icon fa fa-check bigger-120\"></i>
                        </a></div>";
                }
                else
                {
                    return "<div class=\"btn-group\">
                        <span class='btn btn-xs btn-success disabled'>Enable</span>
                        <a onclick=\"return confirm('Are you sure?')\" href=".url('hr/timeattendance/operation/yearly_holidays/'.$data->hr_yhp_id."/disable")." class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Disable Now\">
                            <i class=\"ace-icon fa fa-times bigger-120\"></i>
                        </a></div>";

                }
            })  
            ->addColumn("open_status", function($data) {
                return "<label class=\"radio-inline\">
                      <input type=\"radio\" data-id=\"$data->hr_yhp_id\" name=\"hr_yhp_open_status[$data->hr_yhp_id]\" class=\"open_status\" value=\"0\" style=\"margin-left:-15px\" ".($data->hr_yhp_open_status=="0"?'checked':null)."> Holiday
                    </label>
                    <label class=\"radio-inline\">
                      <input type=\"radio\" data-id=\"$data->hr_yhp_id\" name=\"hr_yhp_open_status[$data->hr_yhp_id]\" class=\"open_status\" value=\"1\" style=\"margin-left:-15px\" ".($data->hr_yhp_open_status=="1"?'checked':null)."> General
                    </label>
                    <label class=\"radio-inline\">
                      <input type=\"radio\" data-id=\"$data->hr_yhp_id\" name=\"hr_yhp_open_status[$data->hr_yhp_id]\" class=\"open_status\" value=\"2\" style=\"margin-left:-15px\" ".($data->hr_yhp_open_status=="2"?'checked':null)."> OT
                    </label>";
            })
            ->rawColumns(['serial_no', 'open_status', 'action'])
            ->toJson();
    }

    public function create()
    {
        ACL::check(["permission" => "hr_time_op_holiday"]);
        #-----------------------------------------------------------# 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id');
        return view('hr/timeattendance/yearly_holiday', compact('unitList'));
    }


    public function store(Request $request)
    { 
        ACL::check(["permission" => "hr_time_op_holiday"]);
        #-----------------------------------------------------------# 

    	$validator= Validator::make($request->all(), [
            'hr_yhp_dates_of_holidays' 	=> 'required|max:10',
            'hr_yhp_comments' 			=> 'required|max:64'
        ]);

        if($validator->fails())
        {
        	return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fillup all required fileds!.');
        }
        else
        { 

        	for($i=0; $i<sizeof($request->hr_yhp_dates_of_holidays); $i++)
            {
                $date = (date("Y-m-d", strtotime($request->hr_yhp_dates_of_holidays[$i])));

                if (YearlyHolyDay::where('hr_yhp_unit', $request->as_unit_id)->where('hr_yhp_dates_of_holidays', $date)->exists())
                { 
                    YearlyHolyDay::where('hr_yhp_unit', $request->as_unit_id)->where('hr_yhp_dates_of_holidays', $date)
                    ->update([ 
                        'hr_yhp_unit'               => $request->as_unit_id,
                        'hr_yhp_dates_of_holidays'  => $date,
                        'hr_yhp_comments' => $request->hr_yhp_comments[$i],
                        'hr_yhp_status' => 1
                    ]);
                }
                else
                {
                    YearlyHolyDay::insert([
                        'hr_yhp_unit'               => $request->as_unit_id,
                        'hr_yhp_dates_of_holidays'  => $date,
                        'hr_yhp_comments'            => $request->hr_yhp_comments[$i],
                        'hr_yhp_status' => 1
                    ]);
                } 
         	}

            return back()
                ->with('success', 'Saved Successful.');
        } 
    }


    public function status(Request $request)
    { 
        ACL::check(["permission" => "hr_time_op_holiday"]);
        #-----------------------------------------------------------# 

         DB::table("hr_yearly_holiday_planner")
            ->where("hr_yhp_id", $request->id)
            ->update([
                "hr_yhp_status" => (($request->status =="enable")?1:0)
            ]); 
        return back()
            ->with("success", "Update Successful!");
    }

    public function getHolidays(Request $request){

        $date = date_parse($request->month);
        $month_id= $date['month'];

        $workdays = array();
        $type = CAL_GREGORIAN;
        $month_id = date_parse($request->month);
        $month= $date['month'];
        $year = $request->year;
        $day_count = cal_days_in_month($type, $month, $year);

        $weekend_count= count($request->weekdays);
        $weekends= $request->weekdays;

        $data='<legend>Weekend Dates</legend>';
        for ($i = 1; $i <= $day_count; $i++) {

            $date = $year.'/'.$month.'/'.$i;
            $date= date('Y-m-d', strtotime($date));
            $get_name = date('l', strtotime($date));
           if(in_array($get_name, $weekends))
           {
            // echo $date. " ";
            //dates create start
            $data.='<div class="form-group">
                        <div class="col-sm-12">
                            <input type="date" name="hr_yhp_dates_of_holidays[]" value="'. $date . '" class="col-xs-5 col-sm-3" data-validation="required" readonly/>

                            <input type="text" name="hr_yhp_comments[]" class="col-xs-5 col-sm-3" value="Weekend" placeholder="Holiday Name" data-validation="required" readonly/>
                        </div>
                    </div>'; 

            //dates create end
           }
        }
        return $data; 
    }

    public function openStatus(Request $request)
    {
        $update = YearlyHolyDay::where("hr_yhp_id", $request->get("id"))
            ->update(['hr_yhp_open_status' => $request->get("status")]);

        if ($update)
        {
            echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                Open Status update Successful.
            </div>";
        }
        else
        {
            echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                Please try again...
            </div>";
        }
    }

}
	
