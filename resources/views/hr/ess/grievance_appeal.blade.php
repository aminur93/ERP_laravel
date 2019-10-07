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
                    <a href="#">Ess</a>
                </li>
                <li>
                    <a href="#">Grievance</a>
                </li>
                <li class="active">Appeal</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Grievance<small> <i class="ace-icon fa fa-angle-double-right"></i> Grievance <i class="ace-icon fa fa-angle-double-right"></i> Appeal</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/ess/grievance/appeal', 'class'=>'form-horizontal']) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_griv_associate_id"> Griever ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('hr_griv_associate_id', [], null, ['placeholder'=>'Select Griever ID', 'id'=>'hr_griv_associate_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Griever ID field is required']) }}  
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_griv_appl_issue_id">Grievance Issue<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_griv_appl_issue_id', $issueList, null, ['placeholder'=>'Select Grievance Issue', 'id'=>'hr_griv_appl_issue_id', 'class'=> 'col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Greivance Issue field is required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_griv_appl_step"> Grievance Step </label>
                            <div class="col-sm-9">
                                <textarea name="hr_griv_appl_step" id="hr_griv_appl_step" class="col-xs-10 col-sm-5" placeholder="Grievance Step"  data-validation="length" data-validation-length="0-255" data-validation-optional="true" data-validation-allowing=" -" data-validation-error-msg="The Grievance Step has to be an alphanumeric value between 2-255 characters"></textarea>
                            </div>
                        </div> 


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_griv_appl_discussed_date"> Discussed Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" name="hr_griv_appl_discussed_date" id="hr_griv_appl_discussed_date" class="col-xs-10 col-sm-5 " data-validation="required"data-validation-error-msg="The Discussed Date field is required" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_griv_appl_req_remedy"> Requested Remedy<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <textarea name="hr_griv_appl_req_remedy" id="hr_griv_appl_req_remedy" class="col-xs-10 col-sm-5" placeholder="Requested Remedy"  data-validation="required length" data-validation-length="2-255" data-validation-allowing=" -" data-validation-error-msg="The Requested Remedy has to be an alphanumeric value between 2-255 characters"></textarea>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_griv_appl_offender_as_id"> Offender ID(s) </label>
                            <div class="col-sm-9">
                                <textarea multiple="multiple" name="hr_griv_appl_offender_as_id" id="hr_griv_appl_offender_as_id" class="tagsinput col-xs-10 col-sm-5" placeholder="Offender ID(s)"  data-validation="required length" data-validation-length="8-255" data-validation-allowing=" -" data-validation-error-msg="The Offender ID(s) has to be an alphanumeric value between 8-255 characters"></textarea>
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
                    {{ Form::close() }}

                    <!-- /.row --> 
                    <hr />

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


    // Offender's List  
    var offender = $('.tagsinput');
    var path = "{{ url('hr/associate-tags') }}";
    var query = $(this).val();
    offender.tag({
        placeholder : 'Select Offender\'s Name',
        source:  function (query, process) {
            return $.get(path, { keyword: query }, function (data) {
                console.log(process(data))
                return process(data);
            });
        }
    }); 
 

});
</script>
@endsection