<?php

namespace App\Http\Controllers\Hr\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Unit;
use App\Models\Hr\Area;
use App\Models\Hr\Department;
use App\Models\Hr\Floor;
use App\Models\Hr\Section;
use App\Models\Hr\Subsection;
use App\Models\Hr\AttendanceBonus;
use App\Models\Hr\MonthlySalarySheet;
use DB, PDF;

class extraOtSheetController extends Controller
{    
	public function extraOtSheet(Request $request)
    {   
        $unitList  = Unit::where('hr_unit_status', '1')
            ->whereIn('hr_unit_id', auth()->user()->unit_permissions())
            ->pluck('hr_unit_name', 'hr_unit_id'); 
        $areaList  = Area::where('hr_area_status', '1')->pluck('hr_area_name', 'hr_area_id'); 
        $unit_id=$request->unit;

        #-------------------------------------------------- 
        /*$info = (object)array();
        $info->start_date = $request->start_date;
        $info->end_date   = $request->end_date;
        $info->disbursed_date = $request->disbursed_date;
        $info->unit       = Unit::where("hr_unit_id", $request->unit)->value("hr_unit_name_bn");

        $info->department = Department::where("hr_department_id", $request->department)->value("hr_department_name_bn");
        $info->floor      = Floor::where("hr_floor_id", $request->floor)->value("hr_floor_name_bn");
        $info->work_days  = $this->workDays(
            $request->start_date, 
            $request->end_date, 
            $request->unit
        );
        $info->sec_name= Section::where("hr_section_id", $request->section)->value("hr_section_name_bn");
        
        $info->sub_sec_name= Subsection::where("hr_subsec_id", $request->subSection)->value("hr_subsec_name_bn");
        //$info->employee   = $this->employeeInfo($request->unit, $request->floor, $request->department, $request->section, $request->subSection, $request->start_date);
        //dd($info->employee);
        if ($request->get('pdf') == true) 
        { 
            $pdf = PDF::loadView('hr/reports/salary_sheet_pdf', ['info'=>$info]);
            return $pdf->download('Salary_Sheet_Report_'.date('d_F_Y').'.pdf');
        }*/

        $floorList= DB::table('hr_floor')
                        ->where('hr_floor_unit_id', $request->unit)
                        ->pluck('hr_floor_name', 'hr_floor_id');

        $deptList= DB::table('hr_department')
                        ->where('hr_department_area_id', $request->area)
                        ->pluck('hr_department_name', 'hr_department_id');

        $sectionList= DB::table('hr_section')
                        ->where('hr_section_department_id', $request->department)
                        ->pluck('hr_section_name', 'hr_section_id');


        $subSectionList= DB::table('hr_subsection')
                        ->where('hr_subsec_section_id', $request->section)
                        ->pluck('hr_subsec_name', 'hr_subsec_id');

        return view("hr/reports/extra_ot_sheet", compact(
        	"info", 
        	"unitList", 
        	"areaList",
            "floorList",
            "deptList",
            "sectionList", 
            "subSectionList",
            "unit_id" 
        ));
    } 


 
# Extra OT List 
    public function extraOtListGenerate(Request $request)
    { 
        $loader=asset('assets/images/loader/loader.gif');       
        $month=$request->fromMonth;
        $monthNumber =date('m', strtotime($month));
        $monthVal = ltrim($monthNumber, '0');
        $unit=$request->unitId; 
        $floor= $request->floor;
        $department= $request->department;
        $area= $request->area;
        $section= $request->section; 
        $subSection= $request->subSection;
        $year=$request->toYear;
        
        // Bangla Conversion
         date_default_timezone_set('Asia/Dhaka');
        $en = array('0','1','2','3','4','5','6','7','8','9', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',',');
        $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',',');
       
        $bnTime=str_replace($en, $bn, date('H:i'));

        if($unit&&$month&&$year){

            $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
            $bnDate=str_replace($en, $bn, date('d-m-Y'));
            $bnTime=str_replace($en, $bn, date('H:i'));
            $bnMonth=str_replace($en, $bn, date("F", strtotime($month)));
            $bnYear=str_replace($en, $bn, date("Y", strtotime($year)));

            //str_replace($en, $bn, date('d-F-y', strtotime($info->disbursed_date)))

            // Query
           // $monthly_salary = MonthlySalarySheet::get();
            $unitName= Unit::where('hr_unit_id',$unit)->first(['hr_unit_name','hr_unit_name_bn']);
            if(!empty($area)){
                $areaName= Area::where('hr_area_id',$area)->first(['hr_area_name','hr_area_name_bn']);
                $areaNameBn=$areaName->hr_area_name_bn;
              }
            else{
                 $areaNameBn="";

            }  //dd($sectionName);
            if(!empty($floor)){
              $floorName= Floor::where('hr_floor_id',$floor)->first(['hr_floor_name','hr_floor_id']);
              $floorNameBn= str_replace($en, $bn, $floorName->hr_floor_name);
            }
            else{
                 $floorNameBn="";

            }
           if(!empty($section)){
            $sectionName= Section::where('hr_section_id',$section)->first(['hr_section_name_bn']);
            $sectionNameBn=$sectionName->hr_section_name_bn;
              }
           else{
                 $sectionNameBn="";

            }  //dd($sectionName);
           if(!empty($department)){  
            $departmentName= Department::where('hr_department_id',$department)->first(['hr_department_name_bn']);
            $departmentNameBn=$departmentName->hr_department_name_bn;
            }
           else{
                 $departmentNameBn="";

            }
           if(!empty($subSection)){  
            $subSectionName= Subsection::where('hr_subsec_id',$subSection)->first(['hr_subsec_name_bn']);
            $subSectionNameBn=$subSectionName->hr_subsec_name_bn;
            }
           else{
                 $subSectionNameBn="";

            }  
            $monthly_salary= DB::table('hr_monthly_salary AS m')
                ->select(
                    'm.*',
                    'b.as_name',
                    'b.associate_id',
                    'b.as_doj',
                    'b.temp_id',
                    'b.associate_id AS associate',
                    'bd.hr_bn_associate_name AS name',
                    'u.hr_unit_name',
                    'u.hr_unit_name_bn',
                    'dg.hr_designation_name_bn AS designation', 
                    'dg.hr_designation_grade AS grade' 

                )
                ->leftJoin('hr_as_basic_info AS b', 'b.associate_id', '=', 'm.as_id')
                ->leftJoin("hr_employee_bengali AS bd", "bd.hr_bn_associate_id", "=", "b.associate_id")
                ->leftJoin('hr_unit AS u', 'u.hr_unit_id', '=', 'b.as_unit_id')
                ->leftJoin('hr_designation AS dg', 'dg.hr_designation_id', '=', 'b.as_designation_id') 
                ->where(function($c) use($floor, $department,$area, $section, $subSection){
                   
                    
                    if (!empty($department))
                    {
                        $c->where("b.as_department_id", $department);
                    } 

                    if (!empty($floor))
                    {
                        $c->where("b.as_floor_id", $floor);
                    } 
                    if (!empty($area))
                    {
                        $c->where("b.as_area_id", $area);
                    }
                    if (!empty($section))
                    {
                        $c->where("b.as_section_id", $section);
                    } 
                    if (!empty($subSection))
                    {
                        $c->where("b.as_subsection_id", $subSection);
                    } 
                }) 
                ->where('b.as_unit_id', $unit)
                ->where('m.month', $monthVal)
                ->where('m.year', '=',$year)   
                ->where('b.as_status',1) // checking status         
                ->get(); //dd($monthVal);

           

            $i=1;
            // Table for returning result
                        $list= "<table style=\"width:100%;margin-bottom:0;font-size:12px;color:lightseagreen;text-align:left;padding-top:10px;\"  cellpadding=\"5\">
                              <tr>
                                <td style=\"width:14%\">
                                   <p style=\"margin:0;padding:4px 0\"><strong>তারিখঃ </strong> $bnDate </p>
                                   <p style=\"margin:0;padding:4px 0\"><strong>&nbsp;সময়ঃ </strong> $bnTime</p>
                                </td>
                                <td>
                                    <h3 style=\"margin:4px 10px;text-align:center;font-weight:600;font-size:18px;\"> $unitName->hr_unit_name_bn </h3>
                                    <h5 style=\"margin:4px 10px;text-align:center;font-weight:600;font-size:14px;\"> বকেয়া অতিরিক্ত সময়ের মজুরী
                                    <br/>
                                   $bnMonth, $bnYear</h5>
                                </td>
                                <td style=\"width:22%\">
                                   <p style=\"margin:0;padding:4px 0;\"><strong>&nbsp;ফ্লোর নংঃ </strong> 
                                   $floorNameBn </strong> </p> 
                               
                                   <p style=\"margin:0;padding:4px 0;\"><strong>&nbsp; সেকশনঃ</strong> 
                                    $sectionNameBn </p>                                  
                                </td> 
                                <td style=\"width:13%\">
                                   <h3 style=\"margin:4px 10px;text-align:center;font-weight:600;font-size:14px;\"> $departmentNameBn </h3>
                                   
                                   <p style=\"margin:0;padding:4px 0;\"><strong>&nbsp;সাব-সেকশনঃ </strong>  $subSectionNameBn </p> 
                             
                                </td>

                            </tr> 
                        </table>
                        <div id=\"wait\">
                                  <p><img src=\"$loader\" /> Please Wait</p>
                                </div> 
                                <div  id=\"extra-OT\" class=\"html-2-pdfwrapper form-horizontal\" style=\"padding:0px 0px!important;margin-top:20px\" >
                                                                      
                                        <table class=\"table responsive\" style=\"width:100%;border:1px solid #ccc;font-size:13px;\"  cellpadding=\"2\" cellspacing=\"0\" border=\"1\" align=\"center\"> 
                                          <thead>
                                            <tr style=\"color:hotpink\">
                                              <th style=\"text-align:center!important;color:lightseagreen\">ক্রমিক নং</th>
                                              <th style=\"text-align:center!important;\">কর্মী/কর্মচারীদের নাম ও যোগদানের তারিখ</th>
                                              <th style=\"text-align:center!important;\">আই ডি নং</th>
                                              <th style=\"text-align:center!important;\">মাসিক বেতন/মজুরি </th>
                                              <th width=\"250\">অতিরিক্ত কাজের মজুরি পাওনা</th>
                                              <th style=\"text-align:center!important;\">বকেয়া অতিরিক্ত কাজের মজুরি</th>
                                            </tr> 
                                          </thead>
                                          <tbody>";
         

            foreach($monthly_salary AS $salary){

                $otCount=$salary->present*4;
                $extraOT=$salary->ot_hour-$otCount;

                

                if($extraOT>0){ 
                    // Due OT calculation
                    $dueOTPayment=$extraOT*$salary->ot_rate;
                    $dueOTPaymentBn=str_replace($en, $bn,(string)number_format($dueOTPayment,2, '.', ','));
                    //
                    $otTotal=  $salary->ot_rate*$salary->ot_hour; 
                   

                    // Bangla Conversion
                    $iBn=str_replace($en, $bn,$i);
                    $bnDoj=str_replace($en, $bn, date("d-m-Y", strtotime($salary->as_doj)));

                    $en_basic=$salary->basic;
                    $basic=str_replace($en, $bn,(string)number_format($en_basic,2, '.', ','));

                    $em_house=$salary->house;
                    $house=str_replace($en, $bn,(string)number_format($em_house,2, '.', ','));

                    $em_medical=$salary->medical;
                    $medical=str_replace($en, $bn,(string)number_format($em_medical,2, '.', ','));

                    $em_transport=$salary->transport;
                    $transport=str_replace($en, $bn,(string)number_format($em_transport,2, '.', ','));

                    $em_food=$salary->food;
                    $food=str_replace($en, $bn,(string)number_format($em_food,2, '.', ','));

                    $grade=str_replace($en, $bn, $salary->grade) ;                 
                    
                    $gross_salary_final=str_replace($en, $bn,(string)number_format($salary->gross,2, '.', ','));

                    $otRateBn= str_replace($en, $bn, $salary->ot_rate) ; 
                    $ottimeBn= str_replace($en, $bn, $salary->ot_hour) ;
                    $otTotalBn= str_replace($en, $bn, $otTotal) ; 


                    
                    $list.="<tr style=\"text-align:center; font-size:9px!important;\">
                                <td>$iBn</td>
                                <td> <p style=\"margin:0;padding:0;\">$salary->name </p>
                                    <p style=\"margin:0;padding:0;\">$bnDoj </p>
                                    <p style=\"margin:0;padding:0;\"> $salary->designation </p>
                                    <p style=\"margin:0;padding:0;color:hotpink\">মূল+বাড়ি ভাড়া+চিকিৎসা+যাতায়াত+খাদ্য </p> 
                                    <p style=\"margin:0;padding:0;\">
                                         $basic+
                                         $house +
                                         $medical +
                                         $transport +
                                         $food 
                                </td>
                                <td>
                                    <p style=\"font-size:14px;margin:0;padding:0;color:blueviolet\">
                                      $salary->associate                                     
                                    </p>
                                    
                                    <p style=\"margin:0;padding:0\">গ্রেডঃ $grade</p>
                                </td>
                                <td>    
                                   <p style=\"margin:0;padding:0\">                                        
                                      $gross_salary_final
                                    </p>
                                </td>
                                <td> $otTotalBn
                                   <p style=\"margin:0;padding:0\"> 
                                      [ অতিরিক্ত কাজের মঞ্জুরি হার &nbsp;&nbsp;&nbsp;&nbsp;<font style=\"color:hotpink\">= $otRateBn ($ottimeBn ঘন্টা)</font> ]
                                    </p> </td>
                                <td>$dueOTPaymentBn</td>                  
                           </tr>"; 
                            $i= $i+1;   
                }
            
                           
            } 
            $list.=    "</tbody>
                     </table>
                    </div>
                   </div>";               
        }//end if

        // else{ return "<h5> Please select Unit, Month and Year Correctly.</h5>";}

        return $list;                      
        

    }    

 // get total working days
    public function workDays($startDate = null, $endDate = null, $unit = null)
    {
        $startDate = date("Y-m-d", strtotime($startDate));
        $endDate   = date("Y-m-d", strtotime($endDate));
        $totalDays = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24); 
        $work_days = 0;
        #----------------------------------------------
        # Check Holiday with unit & month_year
        $total_holidays = DB::table("hr_yearly_holiday_planner")
            ->where("hr_yhp_unit", $unit)
            ->whereBetween("hr_yhp_dates_of_holidays", [$startDate, $endDate])
            ->count(); 

        $work_days = (($totalDays+1)-$total_holidays); 
        return $work_days;
    }

}
