@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Human Resource</a>
                </li>
                <li>
                    <a href="#">Reports</a>
                </li>
                <li class="active"> Pay Slip</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <?php $type='pay_slip'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small><i class="ace-icon fa fa-angle-double-right"></i> Pay Slip</small></h1>
            </div>
            <div class="row">
                <div class="col-sm-10"> 
                <form role="form" method="get" action="{{ url('hr/reports/payslip') }}" class="form-horizontal">
                  <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="unit"> Unit </label>
                      <div class="col-sm-6"> 
                          {{ Form::select('unit', $unitList, Request::get('unit'), ['placeholder'=>'Select Unit', 'id'=>'unit',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="floor"> Floor </label>
                      <div class="col-sm-6"> 
                          {{ Form::select('floor', !empty(Request::get('unit'))?$floorList:[], Request::get('floor'), ['placeholder'=>'Select Floor', 'id'=>'floor',  'style'=>'width:100%']) }}   
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="area"> Area </label>
                      <div class="col-sm-6"> 
                          {{ Form::select('area', $areaList, Request::get('area'), ['placeholder'=>'Select Area', 'id'=>'area', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}  
                      </div>
                  </div>  

                  <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="department">Department </label>
                      <div class="col-sm-6">
                          {{ Form::select('department', !empty(Request::get('area'))?$deptList:[], Request::get('department'), ['placeholder'=>'Select Department ', 'id'=>'department', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Department field is required']) }}  
                      </div>
                  </div> 

                   

                  <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="department">Section </label>
                      <div class="col-sm-6">
                          {{ Form::select('section', !empty(Request::get('department'))?$sectionList:[], Request::get('section'), ['placeholder'=>'Select Section ', 'id'=>'section', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-optional' =>'true', 'data-validation-error-msg'=>'The Department field is required']) }}  
                      </div>
                  </div>  

                  <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="department">Sub-Section </label>
                      <div class="col-sm-6">
                          {{ Form::select('subSection', !empty(Request::get('section'))?$subSectionList:[], Request::get('subSection'), ['placeholder'=>'Select Sub-Section ', 'id'=>'subSection', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-optional' =>'true', 'data-validation-error-msg'=>'The Department field is required']) }}  
                    </div>
                  </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="start_date"> Start Date </label>
                        <div class="col-sm-6">
                            <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="form-control " data-validation="required"  value="{{ Request::get('start_date') }}"/> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="end_date"> End Date </label>
                        <div class="col-sm-6"> 
                            <input type="text" name="end_date" id="end_date" placeholder="End Date" class="form-control " data-validation="required"  value="{{ Request::get('end_date') }}"/> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="disbursed_date"> Disbursed Date </label>
                        <div class="col-sm-6">
                            <input type="text" name="disbursed_date" id="disbursed_date" placeholder="Y-m-d" class="form-control datepicker" value="{{ Request::get('disbursed_date') }}" data-validation="required" data-validation-format="yyyy-mm-dd" autocomplete="off"/>
                        </div>
                    </div>

                  <div class="form-group text-right"> 
                    <div class="col-sm-6 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-search"></i>
                            Generate
                        </button>
                        @if (!empty(request()->has('unit')))  
                        <button type="button" onClick="printMe('html-2-pdfwrapper')" class="btn btn-warning btn-sm" title="Print">
                            <i class="fa fa-print"></i> 
                        </button> 
                        <button type="button"  id="excel"  class="showprint btn btn-success btn-sm"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                </button>
                        <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                            <i class="fa fa-file-pdf-o"></i> 
                        </a>  
                        @endif 
                      </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                @if(isset($info) && !empty($info))
             <div >  
                {{-- <div class="col-xs-12">
                    <div class="col-xs-12">
                        <div class="col-xs-9 text-right">
                            {{ (isset($info->unit) && !empty($info->employee->links()))?$info->employee->appends(request()->query())->links():null }}
                        </div>
                    </div>
                </div> --}}

                <?php
                    date_default_timezone_set('Asia/Dhaka');
                    $en = array('0','1','2','3','4','5','6','7','8','9', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
                ?>
                <div class="col-xs-9" id="html-2-pdfwrapper">
                        <?php $i = 1; ?>
                    @foreach($info->employee as $k=>$employee)
                    
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
if ($lates <= 3 && $leaves <= 1 && $absents==0 && $employee->type == 3 && (strtotime(date("Y-m", strtotime($employee->doj))) <= strtotime(date("Y-m", strtotime($startDate)))))
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
    $overtime_rate   = 0;
}

$overtime_salary = number_format($overtime_rate*($overtimes/60), 2, ".", ""); 
$salary_advance_adjust = $salary_add_deduct["salary_add"];
$total_pay = number_format((($salary_net+$overtime_salary+$present_bonous+$salary_advance_adjust)-($salary_stamp)), 2, ".", "");

?> 
                    <div class="col-sm-12" style="height:33%"> 
                        <table style="width:100%;border:1px solid #ccc;margin-bottom:0;font-size:9px;color:lightseagreen;text-align:left;">
                            <tr>
                                <td colspan="2" style="padding:10px 10px 0 10px;color:hotpink;">
                                    <p style="margin:0;padding:0;">নামঃ {{ $employee->name }}</p>
                                    <p style="margin:0;padding:0;">পদবীঃ {{ $employee->designation }}</p>
                                    <p style="margin:0;padding:0;">গ্রেডঃ {{ $employee->grade }}</p> 
                                    <p style="margin:0;padding:0;">যোগদানের তারিখঃ {{ str_replace($en, $bn, date("d-m-Y", strtotime($employee->doj))) }}</p>
                                </td>
                                <td colspan="3" style="padding:10px;color:hotpink;text-align:center">
                                    <h3 style="margin:4px 10px;text-align:center;font-weight:600;font-size:16px;">{{ $info->unit }}</h3>
                                    <h5 style="margin:4px 10px;text-align:center;font-weight:600;font-size:10px;">প্রে-স্লিপঃ তারিখঃ  {{ str_replace($en, $bn, date("d-F-Y", strtotime($info->start_date))) }} হতে {{ str_replace($en, $bn, date("d-F-Y", strtotime($info->end_date))) }}</h5>
                                   <p style="color:black;font-weight:bolder;text-transform:uppercase">
                                        ({{ date("F/Y", strtotime($info->start_date)) }})
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <font style="margin:0 0 0 20px;padding:4px 0;">ফ্লোর নং  <font style="text-align:right;color:black">&nbsp;&nbsp; {{ $info->floor }}</font>
                                        </font> 
                                   </p>
                                   
                                    <p style="clear:both;text-align: center;margin:0;padding:0;width:100%;display:block;color:lightseagreen"> 
                                        অতিরিক্ত কাজের মঞ্জুরি হারঃ &nbsp;<font style="color:hotpink"> {{ str_replace($en, $bn,(string)number_format($overtime_rate,2, '.', ',')) }}</font> /=টঃ
                                    </p>
                                </td>
                                <td width="30">
                                    <p style="border-radius:50%;width:30px;height:30px;border:1px solid #999;color:#999;line-height:30px;text-align:center">{{ str_replace($en, $bn, ($info->employee->perPage() * ($info->employee->currentPage()-1)) + ($loop->index + 1)) }}</p>
                                </td>
                                <td width="15%" style="padding:10px;color:hotpink;">
                                   <p style="margin:0;padding:4px 0;display:inline;text-align:right;color:maroon;font-weight:bolder">আই ডি # 
                                        <font style="padding:4px 0;display:inline;text-align:right;color:black;font-weight:bolder"><!-- {{ (substr_replace($employee->associate, str_replace($en, $bn, $employee->temp_id), 3, 6)) }} -->
                                        {{ $employee->associate}}
                                        </font>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <!-- first -->
                                <td width="100" style="padding:0 0 0 10px;"> 
                                    <p style="margin:0;padding:0">&nbsp;</p>
                                    <p style="margin:0;padding:0">&nbsp;</p>
                                    <p style="margin:0;padding:0">উপস্থিত দিবস</p>
                                    <p style="margin:0;padding:0">ছুটি দিবস</p>
                                    <p style="margin:0;padding:0k">অনুপস্থিত দিবস</p>
                                    <p style="margin:0;padding:0">ছুটি মঞ্জুর</p>
                                    <p style="margin:0;padding:0;border-top:1px solid #999">মোট দেয়</p>  
                                </td>
                                <td width="100"> 
                                    <p style="margin:0;padding:0">&nbsp;</p>
                                    <p style="margin:0;padding:0">&nbsp;</p>
                                    <p style="margin:0;padding:0">=&nbsp;&nbsp;&nbsp;{{ str_replace($en, $bn, $attends) }}</p>
                                    <p style="margin:0;padding:0">=&nbsp;&nbsp;&nbsp;{{ str_replace($en, $bn, $holidays) }}</p>
                                    <p style="margin:0;padding:0k">=&nbsp;&nbsp;&nbsp;{{ str_replace($en, $bn, $absents) }}</p>
                                    <p style="margin:0;padding:0">=&nbsp;&nbsp;&nbsp;{{ str_replace($en, $bn, $leaves) }} </p>
                                    <p style="margin:0;padding:0;border-top:1px solid #999">=&nbsp;&nbsp;&nbsp;{{ str_replace($en, $bn, ($attends+$holidays+$leaves)) }}</p>  
                                </td>
                                <!-- second -->
                                <td width="100" style="padding:0 0 0 20px;">    
                                    <p style="margin:0;padding:0">&nbsp;</p>
                                    <p style="margin:0;padding:0">মূল বেতন</p>
                                    <p style="margin:0;padding:0">বাড়ী বাড়া (৪০%)</p> 
                                    <p style="margin:0;padding:0">চিকিৎসা ভাতা</p> 
                                    <p style="margin:0;padding:0">যাতায়াত</p>  
                                    <p style="margin:0;padding:0">খাদ্য</p> 
                                    <p style="margin:0;padding:0;border-top:1px solid #999">মোট মজুরি</p> 
                                </td>
                                <td>    
                                    <p style="margin:0;padding:0"></p>
                                    <p style="margin:0;padding:0">=
                                   <?php $em_basic=$employee->basic;?>
                                   {{str_replace($en, $bn,(string)number_format($em_basic,2, '.', ','))}}
                                   </p>
                                    <p style="margin:0;padding:0">=
                                    <?php $em_house=$employee->house;?>
                                    {{str_replace($en, $bn,(string)number_format($em_house,2, '.', ','))}}
                                    </p> 
                                    <p style="margin:0;padding:0">=
                                    <?php $medical=$employee->medical;?>
                                    {{str_replace($en, $bn,(string)number_format($medical,2, '.', ','))}}
                                    </p> 
                                    <p style="margin:0;padding:0">=<?php $transport=$employee->transport;?>
                                    {{str_replace($en, $bn,(string)number_format($transport,2, '.', ','))}} 
                                    </p>  
                                    <p style="margin:0;padding:0">= <?php $food=$employee->food;?>
                                    {{str_replace($en, $bn,(string)number_format($food,2, '.', ','))}}  
                                    </p> 
                                    <p style="margin:0;padding:0;border-top:1px solid #999">=                                         <?php $total_sal=$employee->basic+$employee->house+$employee->medical+$employee->transport+$employee->food;?>
                                    {{str_replace($en, $bn,(string)number_format($total_sal,2, '.', ','))}} 
                                    </p> 
                                </td>
                                <td width="250" align="right" style="padding:0 0 0 20px;">    
                                    <p style="margin:0;padding:0">প্রদেয় মজুরি&nbsp;&nbsp;&nbsp;=</p>
                                    <p style="margin:0;padding:0">খাবার বাবদ/অগ্রিম গ্রহণ/ভোগ্যপণ্য ক্রয়/অন্যান্য কর্তন&nbsp;&nbsp;&nbsp;=</p> 
                                    <p style="margin:0;padding:0">স্টাম্পের জন্য কর্তন&nbsp;&nbsp;&nbsp;=</p> 
                                    <p style="margin:0;padding:0">মজুরি সমন্বয়&nbsp;&nbsp;&nbsp;=</p>  
                                    <p style="margin:0;padding:0">অতিরিক্ত কাজের মজুরি ({{ str_replace($en, $bn, $overtime_time) }} ঘন্টা)&nbsp;&nbsp;&nbsp;=</p> 
                                    <p style="margin:0;padding:0">অতিরিক্ত কাজের মজুরি হার&nbsp;&nbsp;&nbsp;=</p> 
                                    <p style="margin:0;padding:0">হাজিরা বোনাস&nbsp;&nbsp;&nbsp;=</p>
                                    <p style="margin:0;padding:0;border-top:1px solid #999">মোট প্রদেয়&nbsp;&nbsp;&nbsp;=</p> 
                                </td>
                                <!-- third -->
                                <td align="right" style="color:hotpink">    
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{str_replace($en, $bn,(string)number_format($salary_net,2, '.', ',')) }}</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($salary_food+$salary_advance+$salary_product+$salary_others,2, '.', ',')) }}</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($salary_stamp,2, '.', ','))}}</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($salary_advance_adjust,2, '.', ','))}}</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($overtime_salary,2, '.', ','))}}</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($overtime_rate,2, '.', ','))}}</p> 
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($present_bonous,2, '.', ','))}}</p> 
                                    <p style="margin:0;padding:0;border-top:1px solid #999">&nbsp;&nbsp;&nbsp;{{ 
                                    str_replace($en, $bn,(string)number_format($total_pay,2, '.', ','))}}</p> 
                                </td> 
                                <td align="left">    
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p>
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p> 
                                    <p style="margin:0;padding:0">&nbsp;&nbsp;&nbsp;=/টঃ</p> 
                                    <p style="margin:0;padding:0;border-top:1px solid #999">&nbsp;&nbsp;&nbsp;=/টঃ</p> 
                                </td> 
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:0 0 0 10px">
                                    <p style="margin:0;padding:0">মোট অতিরিক্ত কাজের ঘন্টা = {{ str_replace($en, $bn, $overtime_time) }} ঘন্টা</p> 
                                    <p style="margin:0;padding:0">বিলম্ব উপস্থিতিঃ {{ str_replace($en, $bn, $lates) }}</p> 
                                </td>
                                <td colspan="2" style="padding:0 0 0 20px;">
                                    <p style="margin:0;padding:0">অনুপস্থিতির জন্য কর্তন = {{str_replace($en, $bn,(string)number_format($salary_absent,2, '.', ','))}}</p> 
                                    <p style="margin:0;padding:0">বিলম্ব অর্ধ দিবসের জন্য কর্তন = {{str_replace($en, $bn,(string)number_format($salary_half_day,2, '.', ','))}}</p> 
                                </td> 
                                <td style="padding:0 0 0 20px;">
                                    <p style="margin:0;padding:0;color:#999;border-bottom:1px solid;display:inline-block;">কর্মচারীর স্বাক্ষর</p>
                                </td>
                                <td align="right"><h4 style="margin:0;padding:0;color:hotpink">=&nbsp;&nbsp;&nbsp;{{str_replace($en, $bn,(string)number_format($total_pay,2, '.', ','))}}
                                </h4></td> 
                                <td><h4 style="margin:0;padding:0">=/টঃ</h4></td> 
                            </tr>
                        </table>
                    </div> 
                    
                    @if($i==3)
                     
                    <div style="display: block; page-break-before: always;"></div>
                    <?php $i=0; ?>
                    @endif
                    <?php $i++; ?>
                    @endforeach
                </div>
                @endif 

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <div class="col-xs-9 text-right">
                            {{ (isset($info->unit) && !empty($info->employee->links()))?$info->employee->appends(request()->query())->links():null }}
                        </div>
                    </div>
                </div>
            </div>
          </div>   
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function(){

        // HR Floor By Unit ID
        var unit  = $("#unit");
        var floor = $("#floor")
        unit.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getFloorListByUnitID') }}",
                type: 'get',
                data: {unit_id: $(this).val() },
                success: function(data)
                {
                    floor.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });


        //Load Department List By Area ID
        var area       = $("#area");
        var department = $("#department"); 
        area.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getDepartmentListByAreaID') }}",
                type: 'get',
                data: {area_id: $(this).val() },
                success: function(data)
                {
                    department.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });

        //Load Section List by department
        var section= $("#section");

        department.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getSectionListByDepartmentID') }}",
                type: 'get',
                data: {area_id: area.val(), department_id: $(this).val() },
                success: function(data)
                {
                    section.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });

        //Load Sub Section List by Section
        var subSection= $("#subSection");

        section.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getSubSectionListBySectionID') }}",
                type: 'get',
                data: {area_id: area.val(), department_id: department.val(), section_id: $(this).val() },
                success: function(data)
                {
                    subSection.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });

 
        // date 
        $('#start_date').datetimepicker({
            showClose: true,
            showTodayButton: true,
            dayViewHeaderFormat: "YYYY MMMM", 
            format: "YYYY-MM-DD" 
        }).on("dp.update", function(){  
            $('#end_date').each(function(){
                if($(this).data('DateTimePicker')){
                    $(this).data("DateTimePicker").destroy();
                    $(this).val("");
                }
            });  
        });

        // end date according to start date
        $("body").on("focusin", '#end_date', function(){ 

            var startDate = $("#start_date").val();
            if(startDate == "")
            {
                $("#start_date").val(moment().format("YYYY-MM-DD")); 
                var startDate = $("#start_date").val();
            }

            var day = startDate.substring(8, 10);
            var daysInMonth = moment(startDate).daysInMonth();
            var enableDays = daysInMonth-day;
            var lastDay = moment(startDate).add(enableDays, 'days').format("YYYY-MM-DD"); 
            var firstDay = moment(startDate).format("YYYY-MM-DD");

            $(this).datetimepicker({
                dayViewHeaderFormat: 'MMMM',
                format: "YYYY-MM-DD",
                minDate: firstDay, 
                maxDate: lastDay 
            });  
        });

     
        // excel conversion -->
        $('#excel').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
        location.href=url
        return false
        })

    })

    function printMe(divName)
    { 
        var myWindow=window.open('','','width=800,height=800');
        myWindow.document.write('<html><head></head><body>');
        myWindow.document.write(document.getElementById(divName).innerHTML); 
        myWindow.document.write('</body></html>');
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }
    function attLocation(loc){
    window.location = loc;
   }
</script>
@endsection