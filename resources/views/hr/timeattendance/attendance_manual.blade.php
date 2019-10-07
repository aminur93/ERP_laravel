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
                    <a href="#">Time & Attendance</a>
                </li> 
                <li class="active">Manual Attendance</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Manual Attendance</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12"> 
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')
                </div>
                <div class="col-sm-6"> 
                    {{ Form::open(['url'=>'hr/timeattendance/attendance_manual', 'class'=>'form-horizontal']) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_att_date"> Attendance Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" name="hr_att_date" id="hr_att_date" placeholder="Attendance Date Like 2018-06-06" class="col-xs-12 col-sm-5" value="<?php echo date('Y-m-d') ?>" data-validation="required" data-validation-error-msg="The Attendance Date field is required" />
                            </div>
                        </div> 
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_att_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_att_as_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_att_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_att_start_time"> Punch Time</label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="time" name="hr_att_start_time" id="hr_att_start_time" class="col-xs-12 "/>
                                </span> 
                                <span class="input-icon input-icon-right">
                                    <input type="time" name="hr_att_end_time" id="hr_att_end_time" class="col-xs-12 " /> 
                                </span> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="remarks">Remarks<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input name="remarks" type="text" id="remarks" class="col-xs-10 col-sm-5" data-validation="required length" data-validation-length="1-128"/>
                            </div>
                        </div> 
                     
                        
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info btn-xs" type="submit" id="submitButton">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-xs">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- /.row -->

                       

                    {{ Form::close() }}

                    <!-- PAGE CONTENT ENDS -->
                </div>


                <div class="col-sm-6">
                    <h4 class="page-header"> Bulk Upload</h4>
                    @if (Session::has('status') && Session::has('value'))
                    
                    <div class="process_section">
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" id="progress-bar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    @else
                    <div class="upload_section">
                        {{ Form::open(['url'=>'hr/timeattendance/attendance_manual/excel/import', 'files' => true,  'class'=>'form-horizontal']) }}

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="unit"> Unit Name<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-5"> 
                                    {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit Name', 'id'=>'unit', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Unit Name field is required']) }}  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="file"> File (only <strong>.csv</strong> or <strong>.txt</strong> file supported)</label>
                                <div class="col-sm-5">
                                    <input type="file" name="file" id="file" class="col-xs-12" data-validation="required" autocomplete="off" />
                                </div>
                            </div> 
                            <br/>
                            <br/>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-xs">
                                        <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                    </button>&nbsp; &nbsp; &nbsp;
                                    
                                    <!--<a class="btn btn-success btn-xs" type="button" id="process" href="{{ url('hr/timeattendance/temporary_data_process/0') }}">-->
                                    <!--    <i class="ace-icon fa fa-spinner bigger-110"></i> Process-->
                                    <!--</a>-->
                                    <button type="submit" class="btn btn-info btn-xs" id="upload" type="button">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Upload
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    @endif
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script>


    @if (Session::has('status') && Session::has('value'))
    var value = "{{ Session::get('value') }}";
    processLoading();

    function processLoading() {
        for (var i = 1; i <= 5; ++i) {
            (function(n) {
                setTimeout(function(){
                    $("#progress-bar").animate({width: "50%"})
                }, 5000);
            }(i));
        }
    }
    function checkProcess(value) {
        setTimeout(() => {
            console.log(value);
        }, 10000);
    }
    function deleteAttStatusValue() {
        console.log('hi');
    }
    @endif
</script>
<script type="text/javascript">
$(document).ready(function()
{   
    
    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term
                }; 
            },
            processResults: function (data) { 
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.associate_name,
                            id: item.associate_id
                        }
                    }) 
                };
          },
          cache: true
        }
    });

    $('#hr_att_as_id').on('change',function(){
        var id = $("#hr_att_as_id").val();
        var date= $("#hr_att_date").val();
        $.ajax({
            url: '/hr/timeattendance/existing_punch',
            method: "GET",
            dataType: 'json',
            data: {'id' : id, 'date': date},
            success: function(data)
            {
                if (data.status)
                {
                    if(data.in_time)
                    $("#hr_att_start_time").val(data.in_time);
                    if(data.out_time)
                    $('#hr_att_end_time').val(data.out_time);
                }
                else{
                    $("#hr_att_start_time").val('');
                    $('#hr_att_end_time').val('');
                }
            }
        });
    });
    
    $("#unit").on("change", function(){
        if($(this).val()==3){
            $('#upload').attr('disabled', 'true');
            var x= $(this).val();
            $('#process').attr('href', "{{ url('hr/timeattendance/temporary_data_process/3') }}");
        }
        else{
             $('#upload').prop('disabled', false);
             $('#process').attr('href', "{{ url('hr/timeattendance/temporary_data_process/0') }}");
        }
    });

    $('#submitButton').on('click', function(e){

        // var start= $('#hr_att_start_time').val();
        // var end= $('#hr_att_end_time').val();

        if(($('#hr_att_start_time').val()) == '' && ($('#hr_att_end_time').val() == '')){
            alert("Please input at least one Punch time!");
            e.preventDefault();
        }

        // if(($('#hr_att_start_time').val()) == '' && ($('#hr_att_end_time').val() != '')){
        //     $('#hr_att_start_time').val(end);
        // }
        // if(($('#hr_att_start_time').val()) != '' && ($('#hr_att_end_time').val() == '')){
        //     $('#hr_att_end_time').val(start);
        // }
    });
});
</script>
@endsection