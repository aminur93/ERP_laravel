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
                    <a href="#">Payroll</a>
                </li>
                <li class="active">OT</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Payroll<small> <i class="ace-icon fa fa-angle-double-right"></i>OT</small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                   
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/payroll/ot') }}" enctype="multipart/form-data">
                        {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_ot_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_ot_as_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_ot_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_ot_date"> Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" id="hr_ot_date" name="hr_ot_date" class="col-xs-10 col-sm-5" data-validation="required"/>
                            </div>
                        </div>
   

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_ot_hour"> OT Hour<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select id="hr_ot_hour" name="hr_ot_hour" class="col-xs-10 col-sm-5" data-validation="required">
                                    <option value="">0.0</option>
                                    <option value="0.5">0.5</option>
                                    <option value="1.0">1.0</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2.0">2.0</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3.0">3.0</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4.0">4.0</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5.0">5.0</option>
                                    <option value="5.5">5.5</option>
                                    <option value="6.0">6.0</option>
                                    <option value="6.5">6.5</option>
                                    <option value="7.0">7.0</option>
                                    <option value="7.5">7.5</option>
                                    <option value="8.0">8.0</option>
                                    <option value="8.5">8.5</option>
                                    <option value="9.5">9.5</option>
                                    <option value="10.0">10.0</option>
                                    <option value="10.5">10.5</option>
                                    <option value="11.0">11.0</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_ot_remarks"> Remarks </label>
                            <div class="col-sm-9">
                                <textarea name="hr_ot_remarks" id="hr_ot_remarks" class="col-xs-10 col-sm-5" data-validation="length" data-validation-length="1-128" data-validation-optional="true" placeholder="Remarks"></textarea>
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

                    </form>

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
            <br>
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