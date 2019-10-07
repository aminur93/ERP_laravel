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
                <li class="active"> Line Update</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Line Update</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/line_update')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <input type="hidden" name="hr_line_id" value="{{ $line->hr_line_id}}"> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_line_unit_id"> Unit Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('hr_line_unit_id', $unitList, $line->hr_line_unit_id, ['placeholder'=>'Select Unit Name', 'id'=>'hr_line_unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Unit Name field is required']) }}  
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_line_floor_id" >Floor Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_line_floor_id', $floorList, $line->hr_line_floor_id, ['placeholder'=>'Select Floor Name', 'id'=>'hr_line_floor_id', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Floor Name field is required']) }} 
                                <!-- <select name="hr_line_floor_id" id="hr_line_floor_id" class="col-xs-12" data-validation="required">
                                    <option value="">Select Floor Name </option> 
                                </select> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_line_name" > Line Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_line_name" placeholder="Line Name" class="col-xs-12" value="{{ $line->hr_line_name }}"  data-validation="required length" data-validation-length="1-128" data-validation-allowing=" _-" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_line_name_bn" > লাইন (বাংলা) </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_line_name_bn" name="hr_line_name_bn" placeholder="লাইনের নাম" class="col-xs-12"  value="{{ $line->hr_line_name_bn }}"  data-validation="length" data-validation-length="0-255"/>
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
    var unit  = $("#hr_line_unit_id");
    var floor = $("#hr_line_floor_id")
    unit.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getFloorListByUnitID') }}",
            type: 'json',
            method: 'get',
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
});
</script>
@endsection