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
use App\Models\Hr\Earnleave;
use Yajra\Datatables\Datatables;

use Auth, DB, Validator, Image, ACL; 


class earnLeaveController extends Controller
{
  public function earnLeavePayment()
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

      $unitList = Unit::whereIn('hr_unit_id', auth()->user()->unit_permissions())
        ->pluck('hr_unit_name', 'hr_unit_id'); 
      $floorList = Floor::pluck('hr_floor_name', 'hr_floor_id'); 
      $departmentlist = Department::pluck('hr_department_name', 'hr_department_id'); 
      return view('hr/reports/earned_leave', compact('unitList','floorList','departmentlist'));
    }

    # Return offset type(PCD/FOB) by Action element
    public function floor(Request $request)
    {

      if (!empty($request->un_id))
        {

        $list = "<option value=\"\">Select Floor</option>";
         $desList  = Floor::where('hr_floor_unit_id', $request->un_id)
                    ->pluck('hr_floor_name','hr_floor_id'); 

            foreach ($desList as $key => $value) 
            {
                $list .= "<option value=\"$key\">$value</option>";
            }
       
        return $list;
    }    
}

// Earned leave Table

    public function earnLeavePaymentList(Request $request)

    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 
        date_default_timezone_set('Asia/Dhaka');

     // Number Convert to Bengali Numbers

      $en = array('0','1','2','3','4','5','6','7','8','9');
      $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');

      $unit_id=$request->unit_id;
      $dept_id=$request->dept_id; 
      $flr_id=$request->flr_id;

      $fromyr=$request->fromyr;
      $fromyr_bn =str_replace($en, $bn, $fromyr); // convert to Bangla
      $toyear=$request->toyear;
      $toyear_bn =str_replace($en, $bn, $toyear); // convert to Bangla
    
     if($unit_id||$dept_id){
      $workerlists1= DB::table('hr_as_basic_info AS b')
            ->select(
                'b.*',
                'u.hr_unit_name',
                'u.hr_unit_short_name',
                'u.hr_unit_name_bn',
                'f.hr_floor_name',
                'f.hr_floor_name_bn',
                'l.hr_line_name',
                'l.hr_line_name_bn',
                's.hr_shift_name',
                'dp.hr_department_name',
                'dp.hr_department_name_bn',
                'dg.hr_designation_name',
                'dg.hr_designation_name_bn',
                'a.*',
                'be.*',
                'm.*', 
                'e.hr_emp_type_name', 
                'ar.hr_area_name',  
                'se.hr_section_name', 
                'se.hr_section_name_bn', 
                'sb.hr_subsec_name',
                'sb.hr_subsec_name_bn',
                'bn.*',
                # unit/floor/line/shif
                DB::raw(" 
                    CONCAT_WS('. ', 
                        CONCAT('Unit: ', u.hr_unit_short_name), 
                        CONCAT('Floor: ', f.hr_floor_name),
                        CONCAT('Line: ', l.hr_line_name)
                    ) AS unit_floor_line
                "),  
                # permanent district & upazilla
                "per_dist.dis_name AS permanent_district",
                "per_dist.dis_name_bn AS permanent_district_bn",
                "per_upz.upa_name AS permanent_upazilla",
                "per_upz.upa_name_bn AS permanent_upazilla_bn", 
                # present district & upazilla
                "pres_dist.dis_name AS present_district",
                "pres_dist.dis_name_bn AS present_district_bn",
                "pres_upz.upa_name AS present_upazilla",
                "pres_upz.upa_name_bn AS present_upazilla_bn" 
            )
            ->leftJoin('hr_area AS ar', 'ar.hr_area_id', '=', 'b.as_area_id')
            ->leftJoin('hr_section AS se', 'se.hr_section_id', '=', 'b.as_section_id')
            ->leftJoin('hr_subsection AS sb', 'sb.hr_subsec_id', '=', 'b.as_subsection_id')
            ->leftJoin('hr_emp_type AS e', 'e.emp_type_id', '=', 'b.as_emp_type_id')
            ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
            ->leftJoin('hr_floor AS f', 'f.hr_floor_id', '=', 'b.as_floor_id')
            ->leftJoin('hr_line AS l', 'l.hr_line_id', '=', 'b.as_line_id')
            ->leftJoin('hr_shift AS s', 's.hr_shift_id', '=', 'b.as_shift_id')
            ->leftJoin('hr_department AS dp', 'dp.hr_department_id', '=', 'b.as_department_id')
            ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id')
            ->leftJoin("hr_as_adv_info AS a", "a.emp_adv_info_as_id", "=", "b.associate_id")
            ->leftJoin('hr_benefits AS be',function ($leftJoin) {
                $leftJoin->on('be.ben_as_id', '=' , 'b.associate_id') ;
                $leftJoin->where('be.ben_status', '=', '1') ;
            }) 
            ->leftJoin('hr_med_info AS m', 'm.med_as_id', '=', 'b.associate_id')

            #permanent district & upazilla
            ->leftJoin('hr_dist AS per_dist', 'per_dist.dis_id', '=', 'a.emp_adv_info_per_dist')
            ->leftJoin('hr_upazilla AS per_upz', 'per_upz.upa_id', '=', 'a.emp_adv_info_per_upz')
            #present district & upazilla
            ->leftJoin('hr_dist AS pres_dist', 'pres_dist.dis_id', '=', 'a.emp_adv_info_pres_dist')
            ->leftJoin('hr_upazilla AS pres_upz', 'pres_upz.upa_id', '=', 'a.emp_adv_info_pres_upz') 
            ->leftJoin('hr_employee_bengali AS bn', 'bn.hr_bn_associate_id', '=', 'b.associate_id') 
            ->where("b.as_unit_id", $unit_id)
            ->whereIn('b.as_unit_id', auth()->user()->unit_permissions())
            ->where("b.as_department_id", $dept_id)
            ->where("b.as_floor_id", $flr_id)    
            ->where("b.as_status", 1);
         
            $workerlists=$workerlists1->get();
            $workerlists2=$workerlists1->first();


               
// Increment value            
  $i=1;

// Range between star and end year
        
  $range_yr =sizeof(range($fromyr,$toyear));
            
  $csrf=csrf_field();
  $url=url('hr/reports/earnleavepaymentstore');
  $today=str_replace($en, $bn, date("d-m-Y")); // convert to Bangla;
  $time=str_replace($en, $bn,date('h:i'));
  $loader=asset('assets/images/loader/loader.gif');
 // dd($loader);
 ///List return
  $list= "<div id=\"wait\">
            <p><img src=\"$loader\" /> Please Wait</p>
          </div> 
          <div  id=\"work-register\" class=\"html-2-pdfwrapper\" >
           <form class=\"form-horizontal earnedleave\" role=\"form\" method=\"post\" action=\"$url\" enctype=\"multipart/form-data\">
                 $csrf
                 <table class=\"table responsive \" style=\"width:100%;border:1px solid #ccc;margin:10px 0 0 0;font-size:14px;text-align:left; \"  cellpadding=\"5\">
                        <tr class=\"page-header\" >
                            <th style=\"width:30%\">
                                <p>ফ্লোর  নংঃ
                                $workerlists2->hr_floor_name_bn</p>
                                <span>তারিখঃ $today</span><br/>
                                <span>সময়ঃ $time</span>
                            <th>
                           <th style=\"width:50%; text-align:center;\">
                               <h5> $workerlists2->hr_unit_name_bn</h5>
                               <h6>অর্জিত ছুটির বেতন/মজুরীঃ $fromyr_bn - $toyear_bn</h6> 
                           <th>
                           <th style=\"width:30%; text-align:right;\">
                                <br/><br/>
                                <span>QUALITY</span>
                          <th>
                        </tr> 
                    </table>
                    <table class=\"table responsive\" style=\"width:100%;border:1px solid #ccc;font-size:13px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
                      <thead>
                        <tr>
                          <th>ক্রমিক নং</th>
                          <th>কর্মী/ কর্মচারীদের  নাম  <br/>
                              যোগদানের তারিখ
                          </th>
                          <th>আই. ডি  নং </th>
                          <th>মাসিক বেতন/ মজুরী</th>
                          <th colspan=\"6\" style=\"text-align:center;\">অর্জিত/ ভোগকৃত ছুটির বিবরণ</th>
                          
                          <th>সর্বমোট দেয় টাকার পরিমাণ  </th>
                          <th>দস্তখত </th>
                        </tr> 
                      </thead>
                      <tbody>";



            foreach($workerlists AS $workerlist){
            //increment convert to bengali  
             $bni = str_replace($en, $bn, $i); 

            //earned leave calculation
           //$leave_en= $this->earned($workerlist->as_id,$associate_id,$workerlist->as_doj,2018);
           
            $bn_nid =str_replace($en, $bn, $workerlist->emp_adv_info_nid); //NID convert to Bangla
         
         $leave_en= $this->earnedTotal($workerlist->as_id,$workerlist->associate_id,$fromyr,$toyear);


         $leave =str_replace($en, $bn, $leave_en); //convert to Bangla
      // variables for given years range  
        $total_earned=$leave_en['total_earned'];
        $totaldue=$leave_en['totaldue'];
        $total_enjoyed=$leave_en['total_enjoyed'];
        $total_working=$leave_en['total_working'];
        $total_workday_string=$leave_en['total_workday_string'];
        $total_earned_leave_string=$leave_en['total_earned_leave_string'];
        $total_enjoyed_Leave_sting=$leave_en['total_enjoyed_Leave_sting'];
      ///Variables converted to bangla
        $total_earned_bn=$leave['total_earned'];
        $totaldue_bn=$leave['totaldue'];
        $total_enjoyed_bn=$leave['total_enjoyed'];
        $total_working_bn=$leave['total_working'];
        $total_workday_string_bn=$leave['total_workday_string'];
        $total_earned_leave_string_bn=$leave['total_earned_leave_string'];
        $total_enjoyed_Leave_sting_bn=$leave['total_enjoyed_Leave_sting'];

      
      //Previous Year payment
         $joinYear= date("Y", strtotime($workerlist->as_doj));
         $previous_year= $this->earnedTotal($workerlist->as_id,$workerlist->associate_id,$joinYear,($fromyr-1));
        // dd($previous_year_payment);

      // variables for Previous Year  range  
        $total_earned_prev=$previous_year['total_earned'];
        $totaldue_prev=$previous_year['totaldue'];
        $total_enjoyed_prev=$previous_year['total_enjoyed'];
        $total_working_prev=$previous_year['total_working'];
      
       //check Previous paid for leave   
        $paiddays= DB::table("hr_earn_leave") 
                        ->where("associate_id", $workerlist->associate_id)
                        ->get();
        // Previous paid                 
            $prevPaid=0;          
            foreach ($paiddays as  $paid) {
             $prevPaid+=$paid->paid_days;
            }
        $prevPaid_bn =str_replace($en, $bn, $prevPaid); //convert to Bangla  
       
       // Earned paid 
        $duepaid=$totaldue-$prevPaid;// due leave
        $duepaid_bn=str_replace($en, $bn, $duepaid); //due leave convert to Bangla 

        // given paid 
        $getpaid=$duepaid/$range_yr;  // Total paid Payment
        $getpaid_bn=str_replace($en, $bn, $getpaid); //convert to Bangla

        // Total amount of money given
        $total_money=number_format((($workerlist->ben_current_salary/30)*$getpaid),2);  // Total paid Payment
        $total_money_bn=str_replace($en, $bn, $total_money); //convert to Bangla


      //check if today employee is in Maternity Leave    
        $mLeave= DB::table("hr_leave") 
                        ->where("leave_ass_id", $workerlist->associate_id) 
                        ->where("leave_status", "1")
                        ->where("leave_type", "Maternity")
                        ->whereDate('leave_from', '<=', date("Y-m-d"))
                        ->whereDate('leave_to', '>=', date("Y-m-d"))
                        ->exists();
        

         if($mLeave) 
           $leavetype='M'; 
         else 
           $leavetype='A'; //dd(date("Y-m-d"));
        //Salary

         $salary_bn=str_replace($en, $bn, $workerlist->ben_current_salary);

              $list.= "<tr style=\"text-align:center; font-size:9px!important;\">
                         <td rowspan='2'class=\"earnedleave\">$bni
                            <br/>$leavetype
                            <!--<br/>$workerlist->as_id--->
                         </td>
                         <td rowspan='2'class=\"earnedleave\">
                           $workerlist->hr_bn_associate_name<br/>
                           $workerlist->as_doj<br/>
                           $workerlist->hr_designation_name_bn
                         </td>
                         <td rowspan='2'class=\"earnedleave\">$workerlist->associate_id 
                              <input type='hidden' name='associate_id[]' value='$workerlist->associate_id'></td>
                         <td rowspan='2'class=\"earnedleave\">$salary_bn</td>
                         <td class=\"earnedleave\"><strong>মোট কর্ম দিবস</strong></td>
                         <td class=\"earnedleave\"><strong> অর্জিত  ছুটি</strong></td>
                         <td class=\"earnedleave\"><strong>ভোগকৃত <br/> ছুটির দিন</strong></td>
                         <td class=\"earnedleave\"><strong>পূর্বের প্রদেয়</strong></td>
                         <td class=\"earnedleave\"><strong>পাওনা</strong></td>
                         <td class=\"earnedleave\"><strong>প্রদেয়</strong></td>
                         <td  rowspan='2'class=\"earnedleave\"> $total_money_bn 
                             <input type='hidden' name='paid_amount[]' value='$total_money'></td>
                         <td  rowspan='2'class=\"earnedleave\"></td>
                      </tr>
                     <!--tr for rowspan  column 5--->
                      <tr>
                        <td>$total_working_prev+ $total_workday_string_bn $total_working_bn</td>
                        <td> $total_earned_prev+ $total_earned_leave_string_bn $total_earned_bn</td>
                        <td>$total_enjoyed_prev+ $total_enjoyed_Leave_sting_bn $total_enjoyed_bn</td>
                        <td>$prevPaid_bn</td>
                        <td>$duepaid_bn</td>  
                        <td>$getpaid_bn 
                            <input type='hidden' name='paid_days[]' value='$getpaid'></td>  

                      </tr>";
        
       $i= $i+1;
      }
      $list.= "</tbody></table> 
            <input type='hidden' name='year_range' value='$fromyr-$toyear'>
               <button class='btn btn-info pull-right' type='submit'>
                <i class='ace-icon fa fa-check bigger-110'></i> Store
              </button> </form>
            </div></div>";
      return $list;
     }//end if  
    }
///Earned total year range Leave Calculation
    public function earnedTotal($id=null, $associate=null, $start_year=null, $end_year=null)
    {
      $attend     = array(); 
      $leave      = array(); 
      $total_earned  = 0;
      $total_enjoyed = 0;
      $total_due     = 0;
      $total_work    = 0;
   
      #---------------------------------
      //This is for showing the summation of yearly worked days
      $total_workday_string="("; 
      //This is for showing the summation of yearly Earned Leaves
      $total_earned_leave_string="(";
      //This is for showing the summation of yearly enojyed leaves
      $total_enjoyed_Leave_sting="(";

      for ($i=$start_year; $i<=$end_year; $i++)
      {
        # -----------------------------------
        // total due earned due 
        $attend[$i] = DB::table("hr_attendance")
          ->where("as_id", $id)
          ->whereYear('in_time', '=', $i)
          ->count(); /// total present return
        
        $total_work += $attend[$i];
        //make total earned
        $this_year_earned = number_format((!empty($attend[$i])?($attend[$i]/18):0), 2);
        $total_earned +=$this_year_earned;
        
    
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
        /// total enjoyed  leave
        $this_year_enjoyed= number_format((!empty($leave[$i])?$leave[$i]:0), 2); 
        $total_enjoyed+=$this_year_enjoyed;
        # -----------------------------------
        // making of summation string
        $total_workday_string.=$attend[$i];
        $total_earned_leave_string.=$this_year_earned;
        $total_enjoyed_Leave_sting.=$this_year_enjoyed;
        if($i<$end_year){
                $total_workday_string.="+";
                $total_earned_leave_string.="+";
                $total_enjoyed_Leave_sting.="+";
              }
        if($i== $end_year){
                $total_workday_string.=")=";
                $total_earned_leave_string.=")=";
                $total_enjoyed_Leave_sting.=")=";
              }

      }

      $total_due = $total_earned-$total_enjoyed; /// total kotodin suti paona ase
      //return $total_due;

      return array('total_earned'    => $total_earned,
                   'totaldue'        => $total_due,
                   'total_enjoyed'   => $total_enjoyed,
                   'total_working'   => $total_work,
                   'total_workday_string'       => $total_workday_string,
                   'total_earned_leave_string'  => $total_earned_leave_string,
                   'total_enjoyed_Leave_sting'  => $total_enjoyed_Leave_sting
                 );
    }

///Earned Leave Calculation for individual
    public function earned($id=null, $associate=null, $start_year=null, $end_year=null)
    {
      $attend     = array(); 
      $leave      = array(); 
      $total_earned  = 0;
      $total_enjoyed = 0;
      $total_due     = 0;
      $total_work    = 0;
 
      # -----------------------------------
      // total due earned due 
      $attend = DB::table("hr_attendance")
        ->where("as_id", $id)
        ->whereYear('in_time', '=', $end_year)
        ->count(); /// total present return

      $total_work += $attend;
      //make total earned
      $total_earned += number_format((!empty($attend)?($attend/18):0), 2);
      // total kotodin suti pete pare

      # -----------------------------------
        $leave = DB::table("hr_leave") 
                ->select(
                    DB::raw("   
                        SUM(CASE WHEN leave_type = 'Earned' THEN DATEDIFF(leave_to, leave_from)+1 END) AS enjoyed 
                    ")
                )
          ->where("leave_ass_id", $associate) 
                ->where("leave_status", "1") 
                ->where(DB::raw("YEAR(leave_from)"), '=', $end_year)  
                ->value("enjoyed"); 

      $total_enjoyed += number_format((!empty($leave)?$leave:0), 2); /// total kotodin suti kataise
      # ----------------------------------- 
   
      $total_due = $total_earned-$total_enjoyed; /// total kotodin suti paona ase
      //return $total_due;

      return array('total_earned'    => $total_earned,
                   'totaldue'        => $total_due,
                   'total_enjoyed'   => $total_enjoyed,
                   'total_working'   => $total_work
                 );
    }

/// Store Earned Payment
   public function earnLeavePaymentStore(Request $request){
         ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #------------------------------------------#
     
      for($i=0; $i<sizeof($request->associate_id); $i++)
            {
                    Earnleave::insert([
                        'associate_id' => $request->associate_id[$i],
                        'paid_days' => $request->paid_days[$i],
                        'paid_amount' => $request->paid_amount[$i],
                        'duration' => $request->year_range[$i]
                    ]);
            }
     
      
        return back()
               ->with('success', " Saved Successfully!!");
              // return view('my_view')->withErrors(['Duplicate Record.']);
    
    }
    
  }