<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Http\Controllers\Hr\DashboardController as DashboardController;
use App\Models\Hr\Employee;
use App\Models\Hr\EmployeeBengali;
use App\Models\Hr\Nominee;
use App\Models\Hr\EmpType;
use App\Models\Hr\Unit;
use App\Models\Hr\Floor;
use App\Models\Hr\Line;
use App\Models\Hr\Shift;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Designation;
use App\Models\Hr\Increment;
use App\Models\Hr\promotion;
use App\Models\Hr\Section;
use App\Models\Hr\Subsection;
use App\Models\Hr\EducationLevel;
use App\Models\Hr\LoanApplication;
use Yajra\Datatables\Datatables;
use Auth, DB, Validator, Image, ACL; 


class unitAttendanceController extends Controller
{
  public function unitAttendance()
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

      $unitList = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
        ->pluck('hr_unit_name', 'hr_unit_id'); 
      return view('hr/reports/unit_attandence', compact('unitList'));
    }

    public function unitAttendanceList(Request $request)

    {    
        
        
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

      $curdate=$request->curdate;
      $unit_id=$request->unit_id;
    
      if($curdate && $unit_id){
        $unitname = Unit::where("hr_unit_id", $unit_id)->first();
        $department=DB::table('hr_department AS hdp')->get();


///List return
    $list= "<div  id=\"unit-attendance\" >
    <div  id=\"form-element\" class=\"col-sm-12\" style=\"margin:20px auto;border:1px solid #ccc\">
        <div class=\"page-header\" style=\"margin:10px 10px;border-bottom:2px double #666;text-align: center;\">
                          <h4 style=\"margin:10px 10px; text-align: center;\">
                            $unitname->hr_unit_name</h4>
                           <span>  Daily Attendance Report</span><br/>
                           <span> Date: $curdate</span><br/>
        </div>
            <table class=\"table responsive\" style=\"width:100%;border:1px solid #ccc;font-size:13px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
                      <thead>
                        <tr>
                          <th style=\"text-align:center\">SRL</th>
                          <th style=\"text-align:center\">Department</th>
                          <th style=\"text-align:center\">O</th>
                          <th style=\"text-align:center\">P</th>
                          <th style=\"text-align:center\">A</th>
                        </tr> 
                      </thead>
                      <tbody>";
                        $i=0;
                    
            foreach($department AS $dpt){
             

              $basicinfo=DB::table('hr_as_basic_info AS b')
              ->select(
                  'b.*'
                )
              ->where("b.as_department_id", $dpt->hr_department_id)
              ->where("b.as_unit_id", $unit_id)
              ->where("b.as_status", 1)
              ->get();

  ///Increment values  
      $onroll=0;
      $present=0;
      $absent=0;
         
          foreach($basicinfo AS $binfo){

            $onroll=$onroll+1;
            
            $tableName="hr_attendance";
            $unit= $request->unit_id;
           
            if($unit == 2) $tableName="hr_attendance_ceil";
            else if($unit == 3) $tableName="hr_attendance_aql";
            else if($unit == 1 ||$unit == 4 || $unit == 5 || $unit == 9) $tableName="hr_attendance_mbm";
            else if($unit == 6) $tableName="hr_attendance_ho";
            else if($unit == 8) $tableName="hr_attendance_cew";
            
            $attendCheck = DB::table($tableName)->where('as_id', $binfo->as_id)
                ->whereDate('in_time', '=', $curdate)
                ->exists();

                    if($attendCheck) { $present=$present+1;}

                    else { $absent=$absent+1;}
                  }

                  if($onroll!=0){  
                   $i= $i+1; 
                    $list.= "<tr style=\"text-align:center\">
                                <td>$i</td>
                                <td>$dpt->hr_department_name</td>
                                <td class=\"onroll\">  $onroll</td>
                                <td class=\"present\"> $present</td>
                                <td class=\"absent\">$absent</td>
                             </tr>"; }

            }

        $list.= "<tr style=\"text-align:center\">
                       <td colspan=\"2\"  align=\"right\"><strong>Total:</strong></td>
                       <td><strong><span id=\"sumonroll\"></span></strong></td>
                       <td><strong><span id=\"sumpresent\"></span></strong></td>
                       <td><strong><span id=\"sumabsent\"></span></strong></td>
                </tr>";
      $list.= "</tbody></table></div></div>";
       return $list;

     }//end if 

  }

}