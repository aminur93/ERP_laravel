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
                <li class="active"> Shift Update</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Shift Update</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-sm-offset-2">
                    <!-- PAGE CONTENT BEGINS --> 
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/shift_update')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}  

                        <input type="hidden" name="hr_shift_id"  value="{{ $shift->hr_shift_id }}" >

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_unit_id"> Unit Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">  
                                <input type="hidden" value="{{$shift->hr_shift_unit_id}}" name="hr_shift_unit_id">  
                                <input type="text" value="{{$shift->hr_unit_name}}" class="col-xs-12"  readonly="readonly">   
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_name" > Shift Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_shift_name" id="hr_shift_name" placeholder="Shift Name" class="col-xs-12" value="{{ $shift->hr_shift_name }}"  data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" readonly="readonly" />
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_name_bn" > শিফট (বাংলা)</label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_shift_name_bn" id="hr_shift_name_bn" value="{{ $shift->hr_shift_name_bn }}"  placeholder="শিফট এর নাম" class="col-xs-12" data-validation="length" data-validation-length="0-255"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_start_time">Shift Time<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="time" name="hr_shift_start_time" id="hr_shift_start_time" value="{{ $shift->hr_shift_start_time }}"  placeholder="Start Time" class="col-xs-12 " data-validation-error-msg="The Start Time field is required" />
                                </span> 
                                <span class="input-icon input-icon-right">
                                    <input type="time" name="hr_shift_end_time" id="hr_shift_end_time" value="{{ $shift->hr_shift_end_time }}" class="col-xs-12 "  data-validation-error-msg="The End Time field is required" /> 
                                </span>
                            </div>
                        </div>
                                                              

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_break_time">Break Time<span style="color: red">&#42;</span>(Minutes)</label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_shift_break_time" name="hr_shift_break_time"  value="{{ $shift->hr_shift_break_time }}" data-validation="required length number" data-validation-length="1-3" placeholder="Break time in Minutes" class="col-xs-12"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_code" > Shift Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                            <?php 
                                $code= $shift->hr_shift_code;
                                $letters = preg_replace('/[^a-zA-Z]/', '', $code);?>
                                <input type="text"  id="hr_shift_code" placeholder="Shift Code" class="col-xs-12" value="{{ $letters }}"  data-validation="required length custom" data-validation-length="1-3" data-validation-regexp="^([A-Z ]+)$" readonly="readonly"/>

                                <input type="hidden" name="hr_shift_code" id="hr_shift_code" placeholder="Shift Code" class="col-xs-12" value="{{$shift->hr_shift_code }}"  data-validation="required length custom" data-validation-length="1-3" data-validation-regexp="^([A-Z ]+)$" readonly="readonly"/>
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

    // Show Line List by Unit ID
    var unit  = $("#hr_shift_unit_id");
    var floor = $("#hr_shift_floor_id");
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

    // Show Line List by Floor ID
    var unit = $("#hr_shift_unit_id");
    var floor = $("#hr_shift_floor_id");
    var line = $("#hr_shift_line_id");
    floor.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getLineListByFloorID') }}",
            type: 'json',
            method: 'get',
            data: {unit_id: unit.val(), floor_id: $(this).val() },
            success: function(data)
            {
                line.html(data);
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