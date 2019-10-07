<?php

namespace App\Http\Controllers\Hr\TimeAttendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Employee;
use App\Models\Hr\EmpType;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use App\Models\Hr\Line;
use App\Models\Hr\Shift;
use App\Models\Hr\ShiftRoaster;
use Validator, DB, DataTables, ACL;

class ShiftRoasterController extends Controller
{ 
    public function shiftAssign()
    { 
        ACL::check(["permission" => "hr_time_shift_assign"]);
        #-----------------------------------------------------------# 
        $employeeTypes  = EmpType::where('hr_emp_type_status', '1')->pluck('hr_emp_type_name', 'emp_type_id'); 
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name', 'hr_unit_id'); 

        $shiftList = Shift::where('hr_shift_status', 1)->pluck("hr_shift_name", "hr_shift_id"); 
    	return view('hr/timeattendance/shift_assign', compact('shiftList', 'employeeTypes', 'unitList'));
    }


    public function getAssociateByTypeUnitShift(Request $request) 
    {
        $employees = Employee::where(function($query) use ($request){
            if ($request->emp_type != null)
            {
                $query->where('as_emp_type_id', $request->emp_type);
            }
            if ($request->unit != null)
            {
                $query->where('as_unit_id', $request->unit);
            }

            if ($request->shift != null)
            {
                $query->where('as_shift_id', $request->shift);
            }
            $query->where("as_status", 1);
        })
        ->whereIn('as_unit_id', auth()->user()->unit_permissions())
        ->get();
        // show user id  
        $data['filter'] = "<input type=\"text\" id=\"AssociateSearch\" placeholder=\"Search an Associate\" autocomplete=\"off\" class=\"form-control\"/>";

        $data['result'] = "";
        foreach($employees as $employee)
        {
            $data['result'].= "<tr>
                <td colspan=\"2\"><input type='checkbox' value='$employee->associate_id' name='assigned[$employee->as_id]'/><span class=\"lbl\"> $employee->associate_id</span></td>
                <td>$employee->as_name </td></tr>";
        }
        return $data;  

    }

    public function saveAssignedShift(Request $request)
    {
        ACL::check(["permission" => "hr_time_shift_assign"]);
        #-----------------------------------------------------------# 
        // dd($request->all());
        $validator= Validator::make($request->all(),[
            'shift'     => 'required',
            'year'      => 'required',
            'month'     => 'required', 
            'start_day' => 'required',
            'end_day'   => 'required'
        ]);

        if (empty($request->assigned) || !is_array($request->assigned))
        {
            return back()
                ->withInput()
                ->with($validator)
                ->with('error',"Error! Please select at least one associate.");
        }


        if($validator->fails())
        {
            return back()
            ->withInput()
            ->with($validator)
            ->with('error',"Error! Please Select all required fields!");
        }
        else
        {
            $assigned_emp = $request->assigned;
          
        // print_r($assigned_emp);

         foreach ($assigned_emp as $id => $associate_id) 
            {
                // Update basic info table shif id
                $updateBasicShift = Employee::where('as_id',$id)
                                   ->update(['as_shift_id'=> $request->shift]);

              $exist = ShiftRoaster::where('shift_roaster_associate_id', $associate_id)
                    ->where('shift_roaster_user_id', $id)
                    ->where('shift_roaster_year', $request->year)
                    ->where('shift_roaster_month', $request->month)
                    ->first();

                if($exist)
                {
                    ShiftRoaster::where('shift_roaster_associate_id', $associate_id)
                        ->where('shift_roaster_user_id', $id)
                        ->where('shift_roaster_year', $request->year)
                        ->where('shift_roaster_month', $request->month)
                        ->update([ 
                            'shift_roaster_year'  => $request->year,
                            'shift_roaster_month' => $request->month,
                            'status'              => '0'
                        ]); 
                }
                else
                {
                    $newdata = new ShiftRoaster();
                    $newdata->shift_roaster_associate_id = $associate_id;
                    $newdata->shift_roaster_user_id      = $id;
                    $newdata->shift_roaster_year = $request->year ;
                    $newdata->shift_roaster_month = $request->month ;
                    $newdata->save();
                }

                for($j=$request->start_day; $j<=$request->end_day; $j++)
                {
                    $data = Shift::where('hr_shift_id', '=', $request->shift)->value('hr_shift_code');
                    $day= "day_".$j;

                    ShiftRoaster::where('shift_roaster_associate_id', $associate_id)
                        ->where('shift_roaster_year',$request->year)
                        ->where('shift_roaster_month', $request->month)
                        ->update([$day => $data]);
                } 
            }

            return back()->with('success', "Shift Assigned Successfully!");
        }
    }
 
    public function getRoaster(Request $request)
    { 
        ACL::check(["permission" => "hr_time_shift_roaster"]);
        #-----------------------------------------------------------# 

    	$unitList = Unit::where('hr_unit_status',1)
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_short_name','hr_unit_id');
        $roasters="";
        if($request->has('unit')){

            $unit  = $request->post("unit");
        $floor = $request->post("floor");
        $month = date("n", strtotime($request->post("month")));
        $year  = date("Y", strtotime($request->post("year")));

        // dd($unit);
        DB::statement(DB::raw('set @serial_no=0'));
        $roasters = DB::table("hr_as_basic_info AS b") 
            ->select([
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                's.*', 
                'b.associate_id',
                'b.as_name',
                'l.hr_line_name'
            ])
             ->where('b.as_unit_id', $unit)
             ->where('b.as_status', 1)
            ->where(function($query) use($floor) {
                if (!empty($floor)) 
                {
                    $query->where('b.as_floor_id', $floor);
                }
            })
            ->join("hr_shift_roaster AS s", function($join) use ($year, $month) {
                $join->on( "s.shift_roaster_associate_id", "=", "b.associate_id") 
                    ->where("shift_roaster_year", $year)
                    ->where("shift_roaster_month", $month);
            })
            ->leftJoin('hr_line AS l', 'b.as_line_id', 'l.hr_line_id')
            ->paginate(100);

            
        }

    	$floorList= Floor::where('hr_floor_status',1)->pluck('hr_floor_name','hr_floor_id');
    	return view('hr/timeattendance/shift_roaster', 
            [
                "unitList" => $unitList,
                "floorList"=> $floorList,
                "roasters"  => $roasters
            ]);
        
       
    } 


    public function getRoasterData(Request $request)
    { 
        $unit  = $request->post("unit");
        $floor = $request->post("floor");
        $month = date("n", strtotime($request->post("month")));
        $year  = date("Y", strtotime($request->post("year")));

        DB::statement(DB::raw('set @serial_no=0'));
        $data = DB::table("hr_as_basic_info AS b") 
            ->select([
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'),
                's.*', 
                'b.associate_id',
                'b.as_name',
                'l.hr_line_name'
            ])
            ->where('b.as_unit_id', $unit)
            ->where('b.as_status', 1)
            ->where(function($query) use($floor) {
                if (!empty($floor)) 
                {
                    $query->where('b.as_floor_id', $floor);
                }
            })
            ->join("hr_shift_roaster AS s", function($join) use ($year, $month) {
                $join->on( "s.shift_roaster_associate_id", "=", "b.associate_id") 
                    ->where("shift_roaster_year", $year)
                    ->where("shift_roaster_month", $month);
            })
            ->leftJoin('hr_line AS l', 'b.as_line_id', 'l.hr_line_id')
            ->get();


 
        return DataTables::of($data)
            ->addColumn("associate", function($data){ 
                return "<div class='text-center'>$data->shift_roaster_associate_id  ($data->as_name)</div>";
            })
            ->addColumn("line", function($data){ 
                return "<div class='text-center'>$data->hr_line_name</div>";
            })  
            ->addColumn("year", function($data){
                return date("Y", strtotime($data->shift_roaster_year));
            })
            ->addColumn("month", function($data){   
                return date('F', mktime(0, 0, 0, $data->shift_roaster_month));
                return strftime('%B', mktime(0, 0, 0, $data->shift_roaster_month));
            })
            ->rawColumns(['associate', 'line', 'month', 'year'])
            ->toJson();  
    }

    public function getFloorByUnit(Request $request)
    {
        $list = "<option value=\"\">Select Floor Name </option>";
        if (!empty($request->unit))
        { 
            $floorList  = Floor::where('hr_floor_unit_id', $request->unit)
                    ->where('hr_floor_status', '1')
                    ->pluck('hr_floor_name', 'hr_floor_id'); 

            foreach ($floorList as $key => $floor) 
            {
                $list .= "<option value=\"$key\">$floor</option>";
            }
        }
        return $list;
    }

    /*
    *-------------------------------------------------------
    * CRON JOBS 
    *-------------------------------------------------------
    */

    public function shiftJobs()
    {
        $day   = "day_".(int)date("j");
        $month = (int)date("n");
        $year  = (int)date("Y");

        $assigns = ShiftRoaster::select("shift_roaster_id", "hr_shift.hr_shift_id", "shift_roaster_associate_id", "$day")
            ->leftJoin("hr_shift", "hr_shift.hr_shift_code", "=", "$day")
            ->where("shift_roaster_month", $month)
            ->where("shift_roaster_year", $year)
            ->where("status", "0")
            ->get();

        foreach ($assigns as $assign) 
        { 
            // Update Employee Shift ID
            Employee::where("associate_id", $assign->shift_roaster_associate_id)
                ->update(["as_shift_id" => $assign->hr_shift_id]);

            // Update ShiftRoaster 
            ShiftRoaster::where("shift_roaster_id", $assign->shift_roaster_id)
                ->update(["status" => "1"]);
        }

    }


  # Return  Shift List by Unit
    public function unitShift(Request $request)
    {
        $list = "<option value=\"\">Select Shift </option>";
        if (!empty($request->unit_id))
        {  
                $shifts = DB::select("SELECT 
                    s1.hr_shift_id,
                    s1.hr_shift_name, 
                    s1.hr_shift_code,
                    s1.hr_shift_start_time, 
                    s1.hr_shift_end_time, 
                    s1.hr_shift_break_time
                    FROM hr_shift s1 
                    LEFT JOIN hr_shift s2
                    ON (s1.hr_shift_unit_id = s2.hr_shift_unit_id AND s1.hr_shift_name = s2.hr_shift_name AND s1.hr_shift_id < s2.hr_shift_id)
                    LEFT JOIN hr_unit AS u
                    ON u.hr_unit_id = s1.hr_shift_unit_id
                    WHERE s2.hr_shift_id IS NULL AND s1.hr_shift_unit_id= $request->unit_id
                  ");

            foreach ($shifts as  $value) 
            {  
                $list .= "<option value=\"$value->hr_shift_id\">$value->hr_shift_name</option>";
            }
        }
        return $list;
    }    

    # Return  Shift List by Unit for table
    public function shiftTable(Request $request)
    {
        $list = "";
        if (!empty($request->unit_id))
        { 

            $desList  = Shift::where('hr_shift_unit_id', $request->unit_id)
                        ->get();  
                   
            $shifts = DB::select("SELECT 
                s1.hr_shift_id,
                s1.hr_shift_name, 
                s1.hr_shift_code,
                s1.hr_shift_start_time, 
                s1.hr_shift_end_time, 
                s1.hr_shift_break_time
                FROM hr_shift s1 
                LEFT JOIN hr_shift s2
                ON (s1.hr_shift_unit_id = s2.hr_shift_unit_id AND s1.hr_shift_name = s2.hr_shift_name AND s1.hr_shift_id < s2.hr_shift_id)
                LEFT JOIN hr_unit AS u
                ON u.hr_unit_id = s1.hr_shift_unit_id
                WHERE s2.hr_shift_id IS NULL AND s1.hr_shift_unit_id= $request->unit_id
              ");

            foreach ($shifts as  $value) 
            {
               $code= $value->hr_shift_code;
               $letters = preg_replace('/[^a-zA-Z]/', '', $code);

                $list.= "<tr><td> $value->hr_shift_name </td>
                          <td> $letters</td>
                          <td> $value->hr_shift_start_time  -  $value->hr_shift_end_time </td>
                          <td> $value->hr_shift_break_time </td>
                       
                         </tr>
                          ";
            }
     
        } 
        return $list;
    }     

}
