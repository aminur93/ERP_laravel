<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\AttendaceManual;
use App\Models\Hr\YearlyHolyDay;
use App\Models\Hr\Attendace;
use App\Models\Hr\Employee;
use App\Models\Hr\Leave;
use App\Models\Hr\Shift;
use App\Models\Hr\Unit;
use DB, ACL, PDF;

class manualAttendanceReportController extends Controller
{
# Report Form page	
    public function manualAttendanceForm(Request $request)
    {
    	$units = Unit::unitList();
    	return view('hr/reports/manual_attendance', compact('units'));

    }
# Manual Attendance Status List	
    public function manualAttendanceList(Request $request)
    {
    	$loader=asset('assets/images/loader/loader.gif');    	
        $month=$request->fromMonth;
        $monthNumber =date('m', strtotime($month));
        $year=$request->toYear;
        $unit=$request->unitId;    	
    	$unitName=Unit::unitName($unit);
        $i=0;
    	if($unit&&$month&&$year){

	        // Set Attendance Table and Column Name

	            if($unit ==1 || $unit==4 || $unit==5 || $unit==9){
	                $tableName="hr_attendance_mbm";
	                $colName= "id";
	            }

	            else if($unit ==2){
	                $tableName="hr_attendance_ceil";
	                $colName= "id";
	            }

	            else if($unit ==3){
	                $colName= "att_id";
	                $tableName="hr_attendance_aql";
	            }

	            else if($unit ==6){
	                $tableName="hr_attendance_ho";
	                $colName= "id";
	            }

	            else if($unit ==8){
	                $tableName="hr_attendance_cew";
	                $colName= "id";
	            }
	            else{
	                $tableName="hr_attendance";
	                $colName= "att_id";
	            } 

	        // Query for counting manual attendance    
	            $manualAttCount= DB::table($tableName. ' AS a')
	            ->select(
	                'a.*',
	                'b.as_name',
	                'b.associate_id',
	                // count each group 
	                DB::raw('count('.$colName.') as total_count')      

	               )
	            ->leftJoin('hr_as_basic_info AS b', 'b.as_id', '=', 'a.as_id')
	            ->where("b.as_unit_id", $unit)
	            ->where("a.remarks", 'BM') 
	            ->whereMonth('in_time', $monthNumber)
	            ->whereYear('in_time', '=',$year)
	            ->groupBy('a.as_id')
	            ->get(); 

           
	    	// Table  for returning result
		        $list= "<div id=\"wait\">
			              <p><img src=\"$loader\" /> Please Wait</p>
			            </div> 
			            <div  id=\"manual-attendance\" class=\"html-2-pdfwrapper form-horizontal\" style=\"padding:0px 10px!important;margin-top:20px;border:1px solid #ccc\" >
			                    <div class=\"page-header\" style=\"text-align:left;border-bottom:2px double #666\">
	                                <h2 style=\"margin:4px 10px\">$unitName->hr_unit_name</h2>
	                                <h5 style=\"margin:4px 10px\">$month-$year</h5>
                                </div>
                      
			                    <table class=\"table responsive\" style=\"width:100%;border:1px solid #ccc;font-size:13px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
			                      <thead>
			                        <tr>
			                          <th style=\"text-align:center!important;\">SL</th>
			                          <th style=\"text-align:center!important;\">ID</th>
			                          <th style=\"text-align:center!important;\">Name</th>
			                          <th style=\"text-align:center!important;\">Count </th>
			                        </tr> 
			                      </thead>
			                      <tbody>";

			    foreach ($manualAttCount as  $count) {
					 	$list.= "<tr style=\"text-align:center; font-size:9px!important;\">
		                         <td>$i</td>
		                         <td>
		                           $count->associate_id
		                         </td>
		                         <td>$count->as_name</td>
		                         <td>$count->total_count</td>                        
		                        </tr>";
		        
					    $i= $i+1;
			      }

			    $list.=   "</tbody>
			                </table>
			              </div>
			              </div>";               
		}//end if

		else{ return "<h5> Please select Unit, Month and Year Correctly.</h5>";}

		return $list;                      
    	

    }    


}