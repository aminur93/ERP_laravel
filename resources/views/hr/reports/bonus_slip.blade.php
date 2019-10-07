@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Human Resource </a>
                </li>
                <li>
                    <a href="#"> Reports </a>
                </li>
                <li class="active"> Bonus Sheet </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <?php $type='bonus_slip'; ?>
            @include('hr/reports/attendance_radio')

            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Bonus Sheet </small></h1>
            </div>
            <div class="row">
                @include('inc/message')
                <div class="row">
                    <form class="form-horizontal" role="form" method="get" action="{{ url('hr/reports/bonus_slip') }}">
                        <div class="col-sm-10"> 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="unit_id"> Unit<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        {{ Form::select('unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} 
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-sm-3 control-label no-padding-right" for="unit_id"> Festival<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <select name="festive_name" id="festive_name" class="col-xs-12" data-validation="required">
                                            <option value="">Select Festival</option>
                                            <option value="1" <?php if(Request::get('festive_name')== "1") echo "selected" ?> >ঈদ-উল-ফিতর</option>
                                            <option value="2" <?php if(Request::get('festive_name')== "2") echo "selected" ?> >ঈদ-উল-আযহা</option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="floor_id"> Floor<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        {{ Form::select('floor_id', !empty(Request::get('floor_id'))?$floorList:[], Request::get('floor_id'), ['placeholder'=>'Select Floor', 'id'=>'floor_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="job_app_id">Year<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="year" id="year" class="col-xs-12 yearpicker" placeholder="Select Year" value="{{ Request::get('year') }}" data-validation="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="department_id"> Department</label>
                                    <div class="col-sm-9">
                                        {{ Form::select('department_id', $deptList, Request::get('department_id'), ['placeholder'=>'Select Department', 'id'=>'department_id', 'class'=> 'col-xs-12']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label no-padding-right" for="job_app_id">Last Join Date<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-7">
                                        <input type="date" name="last_join_date" id="last_join_date" class="col-xs-12" value="{{ Request::get('last_join_date') }}" data-validation="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-sm-offset-8 text-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        Search
                                    </button>
                                    @if(!empty($info) && !empty($other_info->unit_name))
                                    <button type="button" onClick="printMe('html-2-pdfwrapper')" class="btn btn-warning btn-sm" title="Print">
                                        <i class="fa fa-print"></i> 
                                    </button>
                                    <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                        <i class="fa fa-file-pdf-o"></i> 
                                    </a>
                                    <button type="button"  id="excel"  class="showprint btn btn-success btn-sm">
                                       <i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br><br>
            </div>

            <div class="row">
                <?php
                    date_default_timezone_set('Asia/Dhaka');
                    $en = array('0','1','2','3','4','5','6','7','8','9');
                    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');
                    $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
                ?>
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                @if(!empty($info) && !empty($other_info->unit_name))

                    <div id="html-2-pdfwrapper" class="col-xs-12">
                        <div class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                            <div class="page-header" style="text-align:left;border-bottom:2px double #666">

                                <h2 style="margin:4px 10px; font-weight: bold;  text-align: center; color: #FF00FF">{{ !empty($other_info->unit_name)?$other_info->unit_name:null}}</h2>
                                <h3 style="margin:4px 10px; text-align: center; color: #FF00FF">উৎসব বোনাস প্রদানের শীট ({{ !empty($other_info->festive_name)?$other_info->festive_name:null }})</h3>
                                <h4 style="margin:4px 10px; text-align: center; color: #FF00FF">যোগদানের সর্বশেষ তারিখঃ ({{ !empty($other_info->last_join_date)?str_replace($en,$bn,date('d-m-y', strtotime($other_info->last_join_date))):null }})</h4>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="60%">
                                                <h5 style="margin:4px 5px; font-size: 12px; color: #FF00FF"><font style="font-weight: bold; font-size: 12px; ">ফ্লোরঃ </font>{{ !empty($other_info->floor_name)?$other_info->floor_name:null }}</h5>
                                                <h5 style="margin:4px 5px; font-size: 12px; color: #FF00FF"><font style="font-weight: bold; font-size: 12px; ">তারিখঃ </font><?php echo str_replace($en, $bn, date('d-m-Y')) ?></h5>
                                                <h5 style="margin:4px 5px; font-size: 12px; color: #FF00FF"><font style="font-weight: bold; font-size: 12px;">সময়ঃ </font><?php echo str_replace($en, $bn, date('H:i'))?></h5>
                                            </td>
                                            <td>
                                                <h5 style="margin:4px 5px; font-size: 13px; text-align: right; color: #FF00FF"><font style="font-weight: bold;">{{ !empty($other_info->department_name)?$other_info->department_name:null }}</font></h5>
                                                <h5 style="margin:4px 5px; font-size: 10px; text-align: right; color: #FF00FF"><font style="font-weight: bold;">পাতা নং #</font></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                                <table class="table" style="width:100%;border:1px solid #ccc; font-size:12px; color: #2A86FF"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                                    <thead>
                                        <tr style="color: #2A86FF">
                                            <th>ক্রমিক নং</th>
                                            <th>কর্মী/কর্মচারীদের নাম যোগদানের তারিখ</th>
                                            <th>আই.ডি নং</th>
                                            <th>মাসিক বেতন/মজুরী</th>
                                            <th>সর্বমোট দেয় টাকার পরিমাণ</th>
                                            <th>দস্তখত</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        @foreach($info AS $emp)
                                        <tr >
                                            <td width="5%">
                                                {{ !empty($emp->sl)?(str_replace($en, $bn, $emp->sl)):null }}
                                            </td>
                                            <td>
                                                <p style="margin: 0px; padding: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font>{{ !empty($emp->hr_bn_associate_name)?$emp->hr_bn_associate_name:null }}</font></p>

                                                <p style="margin: 0px; padding: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ !empty($emp->as_doj)?(str_replace($en, $bn, date('d-m-Y', strtotime($emp->as_doj)))):null }}
                                                </p>

                                                <p style="margin: 0px; padding: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp(<?php echo str_replace($en, $bn, floor($emp->jobDuration/12))  ?> বৎসর <?php echo str_replace($en, $bn, ($emp->jobDuration%12))  ?> মাস)</p>

                                                <p style="margin: 0px; padding: 0px;">{{ !empty($emp->status)?$emp->status:null }}&nbsp;&nbsp;&nbsp;&nbsp;<font>{{ !empty($emp->hr_designation_name_bn)?$emp->hr_designation_name_bn:null }}</font></p>
                                            </td>

                                            <td>
                                                <?php $temp_bn= str_replace($en, $bn, $emp->temp_id)  ?>
                                                <!-- {!! !empty($emp->associate_id)?(substr_replace($emp->associate_id, "<big style='font-size:16px; font-weight:bold;'>$temp_bn</big>", 3, 6)):null !!} -->
                                                {!! !empty($emp->associate_id)?
                                                    $emp->associate_id                                                  :null !!}

                                            </td>

                                            <td>
                                                <p style="margin: 0px; padding: 0px;">
                                                    <?php 
                                                    $salary=$emp->salary;
                                                     ?>
                                                    {{ !empty($emp->salary)?(str_replace($en, $bn,(string)number_format($salary,2, '.', ','))):null }}</p>
                                                <p style="margin: 0px; padding: 0px;">মূল বেতনঃ  <?php 
                                                    $basic=$emp->basic;
                                                     ?>
                                                     {{ !empty($emp->basic)?(str_replace($en, $bn,(string)number_format($basic,2, '.', ','))):null }}</p>
                                                <p style="margin: 0px; padding: 0px; font-size: 8px;">স্ট্যাম্পের টাকা কাটাঃ ১০</p>
                                            </td>
                                            <td>
                                                <p style="margin: 0px; padding: 0px; font-size: 20px; font-weight: bold;"><?php 
                                                    $bonus=$emp->bonus;
                                                     ?>
                                                     
                                                    {{ !empty($emp->bonus)?(str_replace($en, $bn,(string)number_format($bonus-10,2, '.', ','))):null }}</p>
                                                <p style="margin: 0px; padding: 0px;">{{ !empty($emp->jobDurationRatio)?(str_replace($en,$bn,($emp->jobDurationRatio))):"-" }}</p>
                                                <p style="margin: 0px; padding: 0px; font-size: 12px; font-weight: bold;">

                                                    {{ !empty($emp->bonus)?(str_replace($en, $bn,(string)number_format($bonus,2, '.', ','))):null }}</p>
                                            </td>
                                            <td width="10%"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                @endif
                
                <!-- //ends of info  -->
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
function printMe(divName)
{ 
    var myWindow=window.open('','','width=800,height=800');
    myWindow.document.write(document.getElementById(divName).innerHTML); 
    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();
}

$(document).ready(function(){ 

    $('#unit_id').on("change", function(){ 
        $.ajax({
            url : "{{ url('hr/reports/floor_by_unit') }}",
            type: 'get',
            data: {unit : $(this).val()},
            success: function(data)
            {
                $("#floor_id").html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
});
// excel conversion -->

$(function(){
    $('#excel').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
        location.href=url
        return false
    })
})
function attLocation(loc){
    window.location = loc;
   }

</script>
@endsection
