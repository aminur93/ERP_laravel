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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Section </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Section </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-md-offset-2">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/section_update')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <input type="hidden" name="hr_section_id" value="{{ $section->hr_section_id}}"> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_section_area_id" > Area Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_section_area_id', $areaList, $section->hr_section_area_id, ['placeholder' => 'Select Area Name', 'class' => 'col-xs-12 no-select', 'id'=>'hr_section_area_id', 'data-validation'=>'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_section_department_id" >Department Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_section_department_id', $departmentList, $section->hr_section_department_id, ['placeholder' => 'Select Department Name', 'class' => 'col-xs-12 no-select', 'id'=>'hr_section_department_id', 'data-validation'=>'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_section_name" > Section Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_section_name" id="hr_section_name" placeholder="Section Name" class="col-xs-12" value="{{ $section->hr_section_name }}" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_section_name_bn" > সেকশন (বাংলা) </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_section_name_bn" id="hr_section_name_bn" value="{{ $section->hr_section_name_bn }}" placeholder="সেকশনের নাম" class="col-xs-12" data-validation="length" data-validation-length="0-255"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_section_code"> Section Code </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_section_code" name="hr_section_code" placeholder="Section code" class="col-xs-12" value="{{ $section->hr_section_code }}" data-validation="length" data-validation-length="0-10" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-current-error="The input value must be between 0-10 characters">
                            </div>
                        </div>

 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-4 col-md-8"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- /.row --> 
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    var area    = $("#hr_section_area_id");
    var department = $("#hr_section_department_id")
    area.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getDepartmentListByAreaID') }}",
            type: 'json',
            method: 'get',
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
});
</script>
@endsection