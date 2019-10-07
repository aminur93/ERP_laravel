@extends('hr.index') @section('content')
<?php 
    $save_salary_list = []; 
    function nullCheck($value) {
        if($value == NULL) {
            $value = 0;
        }
        return $value;
    }
?>
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
                <li class="active"> Salary Sheet</li>
            </ul>
            <!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <?php $type='salary_sheet'; ?>
                @include('hr/reports/attendance_radio')

                <div class="page-header">
                    <h1>Reports<small><i class="ace-icon fa fa-angle-double-right"></i> Salary Sheet</small></h1>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <form role="form" method="get" action="{{ url('hr/reports/salary_sheet') }}" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="unit"> Unit </label>
                                <div class="col-sm-6">
                                    {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit', 'style'=>'width:100%;', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="floor"> Floor </label>
                                <div class="col-sm-6">
                                    {{ Form::select('floor', !empty(Request::get('unit'))?$floorList:[], Request::get('floor'), ['placeholder'=>'Select Floor', 'id'=>'floor', 'style'=>'width:100%']) }}
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
                                    <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="form-control" data-validation="required" value="{{ Request::get('start_date') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="end_date"> End Date </label>
                                <div class="col-sm-6">
                                    <input type="text" name="end_date" id="end_date" placeholder="End Date" class="form-control " data-validation="required" value="{{ Request::get('end_date') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="disbursed_date"> Disbursed Date </label>
                                <div class="col-sm-6">
                                    <input type="text" name="disbursed_date" id="disbursed_date" class="form-control datepicker" data-validation="required" data-validation-format="yyyy-mm-dd" autocomplete="off" placeholder="Y-m-d" value="{{ Request::get('disbursed_date') }}" />
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <div class="col-sm-6 col-sm-offset-4">                                    
                                    @if(!empty($dataList['local']))
                                        <button type="button" id="salary_save" class="btn btn-info btn-sm">
                                            <i class="fa fa-save"></i> Save
                                        </button>
                                    @endif
                                    <button type="submit" id="salary_generate" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i> Generate
                                    </button>
                                    @if (!empty(request()->has('unit')))
                                    <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                        <i class="fa fa-print"></i>
                                    </button>
                                    <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                    <button type="button" id="excel" class="showprint btn btn-success btn-sm">
                                        <i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row" id="salary_content_section">

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-right">
                            {{ $dataList['global']['links'] }}
                        </div>
                    </div>

                    <div class="col-xs-12" id="PrintArea">
                        @if(!empty($dataList['local']))
                            <div id="html-2-pdfwrapper" class="col-sm-12" style="margin:20px auto">
                                <table class="table" style="width:100%;border-bottom:1px solid #ccc;margin-bottom:0;font-size:12px;color:lightseagreen;text-align:left" cellpadding="5">
                                    <tr>
                                        <td style="width:14%">
                                            <p style="margin:0;padding:4px 0"><strong>তারিখঃ </strong>
                                                {{ $dataList['global']['dateDate'] }}
                                            </p>
                                            <p style="margin:0;padding:4px 0"><strong>&nbsp;সময়ঃ </strong>
                                                {{ $dataList['global']['dateTime'] }}
                                            </p>
                                        </td>
                                        <td style="width:15%;font-size:10px">
                                            <p style="margin:0;padding:4px 0"><strong>&nbsp;প্রদান তারিখঃ </strong>
                                                {{ $dataList['global']['disbursed_date'] }}ইং 
                                            </p>
                                        </td>
                                        <td>
                                            <h3 style="margin:4px 10px;text-align:center;font-weight:600;font-size:18px;">
                                                {{ $dataList['global']['unit'] }}
                                            </h3>
                                            <h5 style="margin:4px 10px;text-align:center;font-weight:600;font-size:14px;">বেতন/মজুরি এবং অতিরিক্ত সময়ের মজুরীঃ 
                                    <br/>
                                    তারিখঃ {{ $dataList['global']['start_date'] }} হতে {{ $dataList['global']['end_date'] }}</h5>
                                        </td>
                                        <td style="width:22%">
                                            <p style="margin:0;padding:4px 0;">
                                                <strong>&nbsp;মোট কর্ম দিবসঃ 
                                                    {{ $dataList['global']['work_days'] }} &nbsp;&nbsp;&nbsp;ফ্লোর নংঃ
                                                    {{ $dataList['global']['floor'] }}
                                                </strong>
                                            </p>
                                            @if(!empty($info->sec_name))
                                                <p style="margin:0;padding:4px 0;">
                                                    <strong>&nbsp; সেকশনঃ</strong> 
                                                    {{ $dataList['global']['sec_name'] }}
                                                </p>
                                            @endif
                                        </td>
                                        <td style="width:13%">
                                            <h3 style="margin:4px 10px;text-align:center;font-weight:600;font-size:14px;">
                                                {{ $dataList['global']['department'] }}
                                            </h3> 
                                            @if(!empty($dataList['global']['sub_sec_name']))
                                                <p style="margin:0;padding:4px 0;"><strong>&nbsp;সাব-সেকশনঃ </strong> 
                                                    {{ $dataList['global']['sub_sec_name'] }}
                                                </p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <table class="table" style="width:100%;border:1px solid #ccc;font-size:9px;color:lightseagreen" cellpadding="2" cellspacing="0" border="1" align="center">
                                    <thead>
                                        <tr style="color:hotpink">
                                            <th style="color:lightseagreen">ক্রমিক নং</th>
                                            <th width="180">কর্মী/কর্মচারীদের নাম
                                                <br/> ও যোগদানের তারিখ</th>
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
                                        @forelse($dataList['local'] as $key=>$data)
                                            <tr>
                                                <td>{{ $data['no'] }}</td>
                                                <td>
                                                    <p style="margin:0;padding:0;">{{ $data['name'] }}</p>
                                                    <p style="margin:0;padding:0;">{{ $data['doj'] }}</p>
                                                    <p style="margin:0;padding:0;">{{ $data['designation'] }}</p>
                                                    <p style="margin:0;padding:0;color:hotpink">মূল+বাড়ি ভাড়া+চিকিৎসা+যাতায়াত+খাদ্য </p>
                                                    <p style="margin:0;padding:0;">
                                                        {{ $data['basic'].'+'.$data['house'].'+'.$data['medical'].'+'.$data['transport'].'+'.$data['food'] }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p style="font-size:14px;margin:0;padding:0;color:blueviolet">
                                                        {{ $data['associate'] }}
                                                    </p>
                                                    <p style="margin:0;padding:0;color:hotpink">
                                                        বিলম্ব উপস্থিতিঃ {{ $data['lates'] }}
                                                    </p>
                                                    <p style="margin:0;padding:0">গ্রেডঃ {{ $data['grade'] }}</p>
                                                </td>
                                                <td>
                                                    <p style="margin:0;padding:0">
                                                        {{ $data['gross_salary'] }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p style="margin:0;padding:0">
                                                        উপস্থিত দিবস &nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['attends'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        সরকারি ছুটি &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['holidays'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0k">
                                                        অনুপস্থিত দিবস &nbsp;<font style="color:hotpink">= {{ $data['absents'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        ছুটি মঞ্জুর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['leaves'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        মোট দেয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['total_day'] }}</font>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p style="margin:0;padding:0">
                                                        অনুপস্থিতির জন্য &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">={{ $data['salary_absent'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        অর্ধ দিবসের জন্য কর্তন &nbsp;&nbsp;<font style="color:hotpink">={{ $data['salary_half_day'] }}
                                                        </font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        অগ্রিম গ্রহণ বাবদ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">={{ $data['salary_advance'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        স্ট্যাম্প বাবদ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['salary_stamp'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        ভোগ্যপণ্য ক্রয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['salary_product'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        খাবার বাবদ কর্তন &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['salary_food'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        অন্যান্য &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['salary_others'] }}</font>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p style="margin:0;padding:0">
                                                        বেতন/মঞ্জুরি &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['salary_net'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        অতিরিক্ত সময়ের কাজের মঞ্জুরি <font style="color:hotpink">= {{ $data['overtime_salary'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        অতিরিক্ত কাজের মঞ্জুরি হার &nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['overtime_rate'] }} ({{ $data['overtime_time'] }} ঘন্টা)</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        উপস্থিত বোনাস &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['present_bonous'] }}</font>
                                                    </p>
                                                    <p style="margin:0;padding:0">
                                                        বেতন/মঞ্জুরি অগ্রিম/সমন্বয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $data['salary_advance_adjust'] }}</font>
                                                    </p>
                                                </td>
                                                <td>{{ $data['total_pay'] }}</td>
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
                    </div>

                    <div class="col-xs-12">
                        <div class="col-xs-12 text-right">
                            {{ $dataList['global']['links'] }}
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        // Reuseable ajax function
        function ajaxOnChange(ajaxUrl, ajaxType, valueObject, successStoreId) {           
            $.ajax({
                url : ajaxUrl,
                type: ajaxType,
                data: valueObject,
                success: function(data)
                {
                    successStoreId.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });            
        }

        // ajax loader
        function ajax_loader_fn(selector) {
            var loaderPath = "{{asset('assets/rubel/img/loader.gif')}}";
            $("#"+selector).html('<div class="loader-cycle text-center"><img src="'+loaderPath+'" /></div>');
            $('html, body').animate({
                scrollTop: $("#"+selector).offset().top
            }, 2000);
        }

        // list of mendatory fields id
        var check_value_id_list = ['unit', 'area', 'department', 'start_date', 'end_date', 'disbursed_date'];
        function checkValue(reset=false) {
            var error_count = 0;
            var value_object = {};
            $.each(check_value_id_list, function(i, v) {
                // reset all div
                if(reset) {
                    $('span#'+v+'_error').remove('');
                } else {
                    if($('#'+v).val() == '') {
                        error_count += 1;
                        if($('#'+v+'_error').length == '') {
                            // show error
                            $('#'+v).parent().after('<span class="col-sm-offset-4 col-sm-4 help-block" id="'+v+'_error" style="color: #a94442;">The '+v+' field is required</span>');
                        }
                    } else {
                        // store data to object
                        value_object[v] = $('#'+v).val();
                    }
                }
            });
            return {e_count: error_count, value_object_list: value_object};
        }

        // click save button
        $('#salary_save').on('click', function() {            
            // remove validation error message
            $('.form-error').remove();
            var result = checkValue();
            if(result.e_count == 0) {
                // get not mendatory field value
                result.value_object_list['section']       = $('#section').val();
                result.value_object_list['floor']         = $('#floor').val();
                result.value_object_list['subSection']    = $('#subSection').val();
                // remove create error message
                checkValue(true);
                // remove save button
                $('#salary_save').remove();
                // show loader
                ajax_loader_fn('salary_content_section');
                setTimeout(() => {
                    $.ajax({
                        url: '{{ url('hr/reports/save_salary_sheet') }}',
                        type: 'POST',
                        datatype: 'json',
                        data: result.value_object_list,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (res) {
                            // console.log(res);
                            $("#salary_content_section").html('<div class="panel panel-success"><div class="panel-heading page-headline-bar"><h5>Salary Add Success</h5> </div></div>');                            
                        },
                        error: function() {
                            alert('Error Occurred');
                        }
                    });
                }, 1000);
            }
        });

        // click generate button (reset error field)
        $('#salary_generate').on('click', function() {
            checkValue(true);
        });
        
        // HR Floor By Unit ID
        var unit = $("#unit");
        var floor = $("#floor")
        unit.on('change', function() {
            ajaxOnChange('{{ url('hr/setup/getFloorListByUnitID') }}', 'get', {unit_id: $(this).val()}, floor);
        });

        //Load Department List By Area ID
        var area = $("#area");
        var department = $("#department");
        area.on('change', function() {
            ajaxOnChange('{{ url('hr/setup/getDepartmentListByAreaID') }}', 'get', {area_id: $(this).val()}, department);            
        });

        //Load Section List by department
        var section = $("#section");
        department.on('change', function() {
            ajaxOnChange('{{ url('hr/setup/getSectionListByDepartmentID') }}', 'get', {area_id: area.val(), department_id: $(this).val()}, section);
        });

        //Load Sub Section List by Section
        var subSection = $("#subSection");

        section.on('change', function() {
            ajaxOnChange('{{ url('hr/setup/getSubSectionListBySectionID') }}', 'get', {area_id: area.val(), department_id: department.val(), section_id: $(this).val()}, subSection);
        });

        // day According to month 
        $('#start_date').datetimepicker({
            showClose: true,
            showTodayButton: true,
            dayViewHeaderFormat: "YYYY MMMM",
            format: "YYYY-MM-DD"
        }).on("dp.update", function() {
            $('#end_date').each(function() {
                if ($(this).data('DateTimePicker')) {
                    $(this).data("DateTimePicker").destroy();
                    $(this).val("");
                }
            });
        });

        //end_date
        $("body").on("focusin", '#end_date', function() {
            var startDate = $("#start_date").val();
            if (startDate == "") {
                $("#start_date").val(moment().format("YYYY-MM-DD"));
                var startDate = $("#start_date").val();
            }
            var day = startDate.substring(8, 10);
            var daysInMonth = moment(startDate).daysInMonth();
            var enableDays = daysInMonth - day;
            var lastDay = moment(startDate).add(enableDays, 'days').format("YYYY-MM-DD");
            var firstDay = moment(startDate).format("YYYY-MM-DD");

            $(this).datetimepicker({
                dayViewHeaderFormat: 'MMMM',
                format: "YYYY-MM-DD",
                minDate: firstDay,
                maxDate: lastDay
            });
        });
    })

    function printMe(divName) {
        var myWindow = window.open('', '', 'width=800,height=800');
        myWindow.document.write(document.getElementById(divName).innerHTML);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }
    // excel conversion -->

    $(function() {
        $('#excel').click(function() {
            var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html())
            location.href = url
            return false
        })
    })

    function attLocation(loc) {
        window.location = loc;
    }
</script>
@endsection