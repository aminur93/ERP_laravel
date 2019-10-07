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


class workerRegisterController extends Controller
{
	public function workerRegister()
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

    	$unitList = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
        ->pluck('hr_unit_name', 'hr_unit_id'); 
    	return view('hr/reports/worker_register', compact('unitList'));
    }

    public function workerRegisterList(Request $request)

    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

    	//$unitList = Unit::pluck('hr_unit_name', 'hr_unit_id'); 
      
    	$associate_id=$request->associate_id;
    	$unit_id=$request->unit_id;
	  
     if($associate_id||$unit_id){
    	$workerlists1=DB::table('hr_as_basic_info AS b')
            ->select(
                'b.*',
                'u.hr_unit_id',
                'u.hr_unit_name',
                'u.hr_unit_short_name',
                'u.hr_unit_name_bn',
                'u.hr_unit_address_bn',
                'dp.hr_department_name',
                'dp.hr_department_name_bn',
                'dg.hr_designation_name',
                'dg.hr_designation_name_bn',
                'a.*',
                'e.hr_emp_type_name',
                'bn.*'
              )
            ->leftJoin('hr_area AS ar', 'ar.hr_area_id', '=', 'b.as_area_id')
            ->leftJoin('hr_section AS se', 'se.hr_section_id', '=', 'b.as_section_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin("hr_as_adv_info AS a", "a.emp_adv_info_as_id", "=", "b.associate_id")
            ->leftJoin('hr_employee_bengali AS bn', 'bn.hr_bn_associate_id', '=', 'b.associate_id')  
           
            ->where(function($condition) use ($associate_id,$unit_id){
                      
                      if (!empty($unit_id)) 
                      {
                        $condition->where("b.as_unit_id", $unit_id);

                      }
                      if (!empty($associate_id)) 
                      {
                        $condition->where("b.associate_id", $associate_id);
                      }
                    })
            // Only Worker condition
            ->where("b.as_emp_type_id", 3)
            // Only Active employee
            ->where("b.as_status", 1);         
            $workerlists=$workerlists1->get();
            $workerlists2=$workerlists1->first();

/// Number Convert to Bengali Numbers

    $en = array('0','1','2','3','4','5','6','7','8','9');
    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');
               
///Increment value            
  $i=1;


 ///List return
  $list= "<div  id=\"form-element\" class=\"col-sm-12 html-2-pdfwrapper\" style=\"margin:20px auto;border:1px solid #ccc\">
		    <div class=\"page-header\" style=\"border-bottom:2px double #666\">
		                        <h6 style=\"margin:4px 10px; text-align: center;\">
                            <p>ফরম-৮</p>
                        <p>ধারা ৯(১)(২) এবং বিধি ২৩(১) দ্রষ্টব্য</p>
                        <p>শ্রমিক রেজিস্টার </p></h6>
                        
            </div>

            <table id=\"tblExport\"class=\"table responsive\" style=\"width:100%;border:1px solid #ccc;margin-bottom:0;font-size:14px;text-align:left\"  cellpadding=\"5\">
                        <tr>
                            <th style=\"width:50%\">
                               <p> <h5  style=\"margin:4px 10px\">কারখানা/প্রতিষ্ঠানের  নামঃ 
                                $workerlists2->hr_unit_name_bn</h5></p>
                               <p><h5 style=\"margin:4px 10px\">কারখানা/প্রতিষ্ঠানের  ঠিকানাঃ
                               $workerlists2->hr_unit_address_bn</h5></p>
                               <p><h5 style=\"margin:4px 10px\"> শ্রমিকের  শ্রেনিবিভাগঃ  </h5></p>
                            </th>
                            <th>
                               
                            </th>
                        </tr> 
                    </table>

                    <table class=\"table\" style=\"width:100%;border:1px solid #ccc;font-size:13px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
                      <thead>
                        <tr>
                          <th>ক্রমিক নং</th>
                          <th>শ্রমিকের নাম ও এন আই ডি নং</th>
                          <th>পিতার নাম</th>
                          <th>মাতার নাম</th>
                          <th>লিঙ্গ, জন্ম তারিখ ও বয়স</th>
                          <th>স্থায়ী ঠিকানা</th>
                          <th>নিয়োগের তারিখ</th>
                          <th>পদবি ও গ্রেড</th>
                          <th>কার্ড নং</th>
                          <th>পাওনা ছুটির পরিমান</th>
                          <th>কর্ম সময়</th>
                          <th>বিরতির সময়</th>
                          <th>সাপ্তাহিক ছুটির দিন</th>
                          <th>গ্রুপের নাম</th>
                          <th>পালা ও রিলে</th>
                          <th>গ্রুপ বদলির বিবরণ </th>
                          <th>মন্তব্য</th>
                        </tr> 
                      </thead>
                      <tbody>";
            foreach($workerlists AS $workerlist){
            //increment convert to bengali 	
             $bni = str_replace($en, $bn, $i); 

            //earned leave calculation
            $yr=date("Y"); 
            $leave_en= $this->earned($workerlist->as_id,$associate_id,$workerlist->as_doj,$yr);
            $leave =str_replace($en, $bn, $leave_en); //convert to Bangla
            $bn_nid =str_replace($en, $bn, $workerlist->emp_adv_info_nid); //NID convert to Bangla

            //Age calculation
    		    $birth_date = $workerlist->as_dob;
    		    $age= date("Y") - date("Y", strtotime($birth_date)); 

            // Card no.
            $associate_id=$request->associate_id;
            if(!empty($associate_id)){
              $cardno=$associate_id;
            }

            else{
               $cardno=$workerlist->associate_id;               
            }


   	          $list.= "<tr style=\"text-align:center\">
   	                     <td>$bni</td>
                         <td>
                           $workerlist->hr_bn_associate_name<br/>
                           $bn_nid                           
                         </td>
                         <td>$workerlist->hr_bn_father_name</td>
                         <td>$workerlist->hr_bn_mother_name</td>
                         <td>
                            $workerlist->as_gender,  <br/> 
                            $workerlist->as_dob,    <br/> 
                            $age
                         </td>
                         <td>
                            $workerlist->hr_bn_permanent_village, 
                            $workerlist->hr_bn_permanent_po
                         </td>
                         <td>$workerlist->as_doj</td>
                         <td>$workerlist->hr_designation_name_bn</td>
                         <td>$cardno</td>
                         <td>$leave</td>
                         <td>৮ ঘণ্টা</td>
                         <td>১ ঘণ্টা</td>
                         <td>শুক্রবার বন্ধ</td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                     </tr>";
          
    	 $i= $i+1;
    	}
    	$list.= "</tbody></table></div></div>";
    	return $list;
     }//end if	
    }

    ///Earned Leave Calculation
     public function earned($id=null, $associate=null, $doj=null, $year=null)
    {
  	$date_of_join_year = date("Y", strtotime($doj));
  	$start_year = $date_of_join_year; 
  	$end_year   = $year;
		$attend     = array(); 
		$leave      = array(); 
		$total_earned  = 0;
		$total_enjoyed = 0;
		$total_due     = 0;
    	#---------------------------------
		for ($i = $start_year; $i<$end_year; $i++)
		{
			# -----------------------------------
			// total due earned due 
			$attend[$i] = DB::table("hr_attendance")
				->select(DB::raw("
					DATE(in_time) AS date 
				"))
				->distinct("date")
				->where("as_id", $id)
				->where(DB::raw("YEAR(in_time)"), $i)
				->groupBy("att_id")
				->get();
			//make total earned
			$total_earned += number_format((sizeof($attend[$i])>0?(sizeof($attend[$i])/18):0), 2); 

			# -----------------------------------
	    	$leave[$i] = DB::table("hr_leave") 
                ->select(
                    DB::raw("   
                        SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS enjoyed 
                    ")
                )
	    		->where("leave_ass_id", $associate) 
                ->where("leave_status", "1") 
                ->where(DB::raw("YEAR(leave_from)"), '=', $i)  
                ->value("enjoyed"); 

			$total_enjoyed += number_format((!empty($leave[$i])?$leave[$i]:0), 2);  
			# ----------------------------------- 
		}
    	$total_due = $total_earned-$total_enjoyed; 
    	return $total_due;
    }


 # Search Associate ID returns NAME & ID
    public function associtaeUnitSearch(Request $request)
    { 
        $data = [];

        if($request->has('keyword'))
        {
            $search = $request->keyword;
            $unit   = $request->unit_id;
            $data = Employee::select("associate_id", DB::raw('CONCAT_WS(" - ", associate_id, as_name) AS associate_name'))
                ->where(function($query) use($search, $unit){
                  $query->where("associate_id", "LIKE" , "%{$search}%");
                  $query->orWhere('as_name', "LIKE" , "%{$search}%");
                }) 
                ->where('as_unit_id', "=",  $unit) 
                ->get();
        }
        return response()->json($data);
    }
   
}
