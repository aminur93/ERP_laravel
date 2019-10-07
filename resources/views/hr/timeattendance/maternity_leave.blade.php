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
                <li >
                    <a href="#">Operation</a>
                </li>
                <li class="active">Maternity Leave </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Maternity Leave </small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    </br>
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/timeattendance/operation/maternity_leave', 'class'=>'form-horizontal']) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_mat_as_id"> Associate's ID </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_mat_as_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_mat_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

                            </div>
                        </div> 
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_mat_start_date"> Date</label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="text" name="hr_mat_start_date" id="hr_mat_start_date" placeholder="Start Date" class="col-xs-12 datepicker" data-validation="required" data-validation-format="yyyy-mm-dd" data-validation-error-msg="The Start Date field is required" />
                                </span> 
                                <span class="input-icon input-icon-right">
                                    <input type="text" name="hr_mat_end_date" id="hr_mat_end_date" placeholder="End Date" class="col-xs-12 datepicker" data-validation="required" data-validation-format="yyyy-mm-dd" data-validation-error-msg="The End Date field is required" /> 
                                </span> 
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_mat_note"> Reason </label>
                            <div class="col-sm-9">
                                <textarea name="hr_mat_note" id="hr_mat_note" class="col-xs-10 col-sm-5" placeholder="Description"  data-validation="required length" data-validation-length="3-1024" data-validation-allowing=" -" data-validation-error-msg="The Description has to be an alphanumeric value between 3-1024 characters"></textarea>
                            </div>
                        </div>  
                     

                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
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

                        <hr />

                    {{ Form::close() }}

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
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

});
</script>
@endsection