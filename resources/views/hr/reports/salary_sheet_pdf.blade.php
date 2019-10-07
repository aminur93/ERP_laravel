<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style>
@if(!empty($info) && isset($info->unit))
                    <?php
                        date_default_timezone_set('Asia/Dhaka');
                        $en = array('0','1','2','3','4','5','6','7','8','9', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',',');
                        $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',',');
                        $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
                    ?>
                    <div id="html-2-pdfwrapper" class="col-sm-12" style="margin:20px auto"> 

                        <table class="table" style="width:100%;border-bottom:1px solid #ccc;margin-bottom:0;font-size:12px;color:lightseagreen;text-align:left"  cellpadding="5">
                            <tr>
                                <td style="width:14%">
                                   <p style="margin:0;padding:4px 0"><strong>তারিখঃ </strong>{{ str_replace($en, $bn, date("d-m-Y")) }}</p>
                                   <p style="margin:0;padding:4px 0"><strong>&nbsp;সময়ঃ </strong>{{ str_replace($en, $bn, date("H:i")) }}</p>
                                </td>
                                <td style="width:15%;font-size:10px">
                                   <p style="margin:0;padding:4px 0"><strong>&nbsp;প্রদান তারিখঃ </strong>{{ str_replace($en, $bn, date("d-F-y", strtotime($info->disbursed_date))) }}ইং </p>
                                </td>
                                <td>
                                    <h3 style="margin:4px 10px;text-align:center;font-weight:600;font-size:18px;">{{ $info->unit }}</h3>
                                    <h5 style="margin:4px 10px;text-align:center;font-weight:600;font-size:14px;">বেতন/মজুরি এবং অতিরিক্ত সময়ের মজুরীঃ 
                                    <br/>
                                    তারিখঃ {{ str_replace($en, $bn, date("d-F-Y", strtotime($info->start_date))) }} হতে {{ str_replace($en, $bn, date("d-F-Y", strtotime($info->end_date))) }}</h5>
                                </td>
                                <td style="width:22%">
                                   <p style="margin:0;padding:4px 0;"><strong>&nbsp;মোট কর্ম দিবসঃ {{ str_replace($en, $bn, $info->work_days) }} &nbsp;&nbsp;&nbsp;ফ্লোর নংঃ </strong>{{ str_replace($en, $bn, $info->floor) }}</strong> </p> 
                                   @if(!empty($info->sec_name))
                                   <p style="margin:0;padding:4px 0;"><strong>&nbsp; সেকশনঃ</strong> {{ $info->sec_name }}</p> 
                                   @endif
                                </td> 
                                <td style="width:13%">
                                   <h3 style="margin:4px 10px;text-align:center;font-weight:600;font-size:14px;">{{ $info->department }}</h3>
                                   @if(!empty($info->sub_sec_name))
                                   <p style="margin:0;padding:4px 0;"><strong>&nbsp;সাব-সেকশনঃ </strong> {{ $info->sub_sec_name }}</p> 
                                   @endif
                                </td> 
                            </tr> 
                        </table>


                        <table class="table" style="width:100%;border:1px solid #ccc;font-size:9px;color:lightseagreen"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                            <thead>   
                                <tr style="color:hotpink">
                                    <th style="color:lightseagreen">ক্রমিক নং</th>
                                    <th width="180">কর্মী/কর্মচারীদের নাম<br/> ও যোগদানের তারিখ</th>
                                    <th>আই ডি নং</th>
                                    <th>মাসিক বেতন/মজুরি</th>
                                    <th width="140">হাজিরা দিবস</th>
                                    <th width="220">বেতন হইতে কর্তন </th>
                                    <th width="250">মোট দেয় টাকার পরিমান</th>
                                    <th>সর্বমোট টাকার পরিমান</th>
                                    <th width="80">দস্তখত</th> 
                                </tr> 
                            </thead> 
                            <tbody align="left"> 
                                <?php $sl = 1; ?>
                                @forelse($info->employee as $employee)  
<?php
/*
*--------------------------------------------------------------
* ATTENDANCE
*--------------------------------------------------------------
*/  
$startDate = date("Y-m-d", strtotime($info->start_date));
$endDate   = date("Y-m-d", strtotime($info->end_date)); 
$track = Attendance::track($employee->associate, $employee->as_id, $employee->unit, $startDate, $endDate);
$salary_add_deduct = Attendance::salaryAddDeduct($employee->associate, $startDate);

#---------------------------------------------------------------
//$totalDays = $track->total_days;
$totalDays = 30;
$attends   = $track->attends;
$attends   = $track->attends;
$leaves    = $track->leaves;
$absents   = $track->absents;
$lates     = $track->lates;
$holidays  = $track->holidays;
if($employee->as_ot == 1){

    $overtimes = $track->overtime_minutes; 
    $overtime_time = $track->overtime_time;
}
else{
    $overtimes = 0; 
    $overtime_time = null;
}

/*
*--------------------------------------------------------------
* Attendance Bonus
*--------------------------------------------------------------
*/
if ($lates <= 3 && $leaves <= 1 && $employee->type == 3 && (strtotime(date("Y-m", strtotime($employee->doj))) <= strtotime(date("Y-m", strtotime($startDate)))))
{ 
    if (strtotime(date("Y-m", strtotime($employee->doj))) == strtotime(date("Y-m", strtotime($startDate))))
    {
        $present_bonous = 450;
    } 
    else 
    {
        $present_bonous = 500;  
    }
}
else
{
    $present_bonous = 0;
}
/*
*--------------------------------------------------------------
* EXPENSE & PAYMENT
*--------------------------------------------------------------
*/ 

$basic = $employee->basic?$employee->basic:"0.00"; 
$salary_absent = $basic?number_format(($basic/$totalDays)*$absents, 2, ".", ""):"0.00"; 
$salary_half_day = "0.00";
$salary_advance  = $salary_add_deduct["advp_deduct"];
$salary_product  = $salary_add_deduct["cg_deduct"];
$salary_food     = $salary_add_deduct["food_deduct"];
$salary_others   =$salary_add_deduct["others_deduct"];
$salary_stamp    = "10.00";
/* TOTAL & NET PAY*/ 
$gross_salary = number_format(($employee->salary?$employee->salary:0), 2, ".", "");
$salary_net = number_format(($gross_salary-($salary_absent+$salary_half_day+$salary_product+$salary_advance+$salary_others+$salary_food)), 2, ".", "");
if($employee->as_ot == 1){
    $overtime_rate   = number_format((($basic/208)*2), 2, ".", "");
}
else{
    $overtime_rate=0;
}

$overtime_salary = number_format($overtime_rate*($overtimes/60), 2, ".", ""); 
$salary_advance_adjust = $salary_add_deduct["salary_add"];
$total_pay = number_format((($salary_net+$overtime_salary+$present_bonous+$salary_advance_adjust)-($salary_stamp)), 2, ".", "");
?> 
                                <tr>
                                <td> 
                                    {{ str_replace($en, $bn, ($info->employee->perPage() * ($info->employee->currentPage()-1)) + ($loop->index + 1)) }}
                                </td>
                                <td>
                                    <p style="margin:0;padding:0;">{{ $employee->name }}</p>
                                    <p style="margin:0;padding:0;">{{ str_replace($en, $bn, date("d-m-Y", strtotime($employee->doj))) }}</p>
                                    <p style="margin:0;padding:0;">{{ $employee->designation }}</p>
                                    <p style="margin:0;padding:0;color:hotpink">মূল+বাড়ি ভাড়া+চিকিৎসা+যাতায়াত+খাদ্য </p> 
                                    <p style="margin:0;padding:0;">

                                        <?php       
                                        $en_basic=$employee->basic;
                                        $basic=str_replace($en, $bn,(string)number_format($en_basic,2, '.', ','));

                                        $em_house=$employee->house;
                                        $house=str_replace($en, $bn,(string)number_format($em_house,2, '.', ','));

                                        $em_medical=$employee->medical;
                                        $medical=str_replace($en, $bn,(string)number_format($em_medical,2, '.', ','));

                                        $em_transport=$employee->transport;
                                        $transport=str_replace($en, $bn,(string)number_format($em_transport,2, '.', ','));

                                        $em_food=$employee->food;
                                        $food=str_replace($en, $bn,(string)number_format($em_food,2, '.', ','));

                                        ?>
                                        {{ $basic}}+
                                        {{ $house }}+
                                        {{ $medical }}+
                                        {{ $transport }}+
                                        {{ $food }} 
                                </td> 
                                <td>
                                    <p style="font-size:14px;margin:0;padding:0;color:blueviolet"><!-- {{ (substr_replace($employee->associate, str_replace($en, $bn, $employee->temp_id), 3, 6)) }} -->
                                       {{ $employee->associate}}
                                     
                                    </p>
                                    <p style="margin:0;padding:0;color:hotpink"> 
                                        বিলম্ব উপস্থিতিঃ {{ str_replace($en, $bn, $lates) }}
                                    </p>
                                    <p style="margin:0;padding:0">গ্রেডঃ {{ str_replace($en, $bn, $employee->grade) }}</p>
                                </td> 
                                <td>
                                    <p style="margin:0;padding:0">
                                       <?php  $gross_salary_final=str_replace($en, $bn,(string)number_format($gross_salary,2, '.', ',')); ?>
                                        {{ $gross_salary_final }}
                                    </p>
                                </td>
                                <td> 
                                    <p style="margin:0;padding:0"> 
                                        উপস্থিত দিবস &nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn, $attends) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        সরকারি ছুটি &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn, $holidays) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0k"> 
                                        অনুপস্থিত দিবস &nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn, $absents) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        ছুটি মঞ্জুর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn, $leaves) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        মোট দেয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn, ($attends+$holidays+$leaves)) }}</font>
                                    </p> 
                                </td>
                                <td>
                                    <p style="margin:0;padding:0"> 
                                        অনুপস্থিতির জন্য &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">={{ str_replace($en, $bn,(string)number_format($salary_absent,2, '.', ',')) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        অর্ধ দিবসের জন্য কর্তন &nbsp;&nbsp;<font style="color:hotpink">={{ str_replace($en, $bn,(string)number_format($salary_half_day,2, '.', ',')) }}
                                        </font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        অগ্রিম গ্রহণ বাবদ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">={{ str_replace($en, $bn,(string)number_format($salary_advance,2, '.', ',')) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        স্ট্যাম্প বাবদ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($salary_stamp,2, '.', ',')) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        ভোগ্যপণ্য ক্রয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($salary_product,2, '.', ',')) }}</font>
                                    </p>
                                    <p style="margin:0;padding:0"> 
                                        খাবার বাবদ কর্তন &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($salary_food,2, '.', ',')) }}</font>
                                    </p> 
                                    <p style="margin:0;padding:0"> 
                                        অন্যান্য &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($salary_others,2, '.', ',')) }}</font>
                                    </p> 
                                </td>
                                <td>
                                    <p style="margin:0;padding:0"> 
                                        বেতন/মঞ্জুরি &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($salary_net,2, '.', ',')) }}</font>
                                    </p>   
                                    <p style="margin:0;padding:0"> 
                                        অতিরিক্ত সময়ের কাজের মঞ্জুরি <font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($overtime_salary,2, '.', ',')) }}</font>
                                    </p>   
                                    <p style="margin:0;padding:0"> 
                                        অতিরিক্ত কাজের মঞ্জুরি হার &nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn, $overtime_rate) }} ({{ str_replace($en, $bn, $overtime_time) }} ঘন্টা)</font>
                                    </p>   
                                    <p style="margin:0;padding:0"> 
                                        উপস্থিত বোনাস &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($present_bonous,2, '.', ',')) }}</font>
                                    </p>    
                                    <p style="margin:0;padding:0"> 
                                        বেতন/মঞ্জুরি অগ্রিম/সমন্বয়  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ str_replace($en, $bn,(string)number_format($salary_advance_adjust,2, '.', ',')) }}</font>
                                    </p>         
                                </td>
                                <td>{{ str_replace($en, $bn,(string)number_format($total_pay,2, '.', ',')) }}</td>
                                <td></td> 
                                </tr> 
                                @empty
                                <tr>
                                <td colspan="9">No record found!</td> 
                                </tr> 
                                @endforelse
                            </tbody> 
                        </table> 
                    </div>
                @endif
