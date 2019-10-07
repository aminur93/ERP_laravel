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
                    <a href="#">Performance </a>
                </li>
                <li >
                    <a href="#"> Operation </a>
                </li>
                <li class="active"> Disciplinary Record Approve</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Performance <small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Disciplinary Record Approve </small></h1>
            </div>

            <div class="row">
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    </br>

                    {{ Form::open(['url'=>'hr/notification/greivance/greivance_approve', 'class'=>'form-horizontal']) }}
                        <input type="hidden" name="gaid" value="{{ Request::get('gaid') }}"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="dis_re_offender_id"> Offender ID </label>
                            <div class="col-sm-9">
                                {{ Form::select('dis_re_offender_id', [(!empty($appeal->hr_griv_appl_offender_as_id)?$appeal->hr_griv_appl_offender_as_id:null) => (!empty($appeal->offender)?$appeal->offender:null)], (!empty($appeal->hr_griv_appl_offender_as_id)?$appeal->hr_griv_appl_offender_as_id:null), ['placeholder'=>'Select Offender\'s Name or ID', 'id'=>'dis_re_offender_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Offender\'s ID field is required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="dis_re_griever_id"> Griever ID (Optional) </label>
                            <div class="col-sm-9">
                                {{ Form::select('dis_re_griever_id', [(!empty($appeal->hr_griv_associate_id)?$appeal->hr_griv_associate_id:null) => (!empty($appeal->griever)?$appeal->griever:null)], (!empty($appeal->hr_griv_associate_id)?$appeal->hr_griv_associate_id:null), ['placeholder'=>'Select Associate\'s ID', 'id'=>'dis_re_griever_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-optional' => 'true']) }}  

                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="dis_re_discussed_date"> Discussed Date </label>
                            <div class="col-sm-9">
                                <input type="text" name="dis_re_discussed_date" id="dis_re_discussed_date" placeholder="Discussed Date" class="datepicker col-xs-10 col-sm-5" data-validation="required" value="{{ (!empty($appeal->hr_griv_appl_discussed_date)?$appeal->hr_griv_appl_discussed_date:null) }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="dis_re_issue_id">Reason</label>
                            <div class="col-sm-9">
                                {{ Form::select('dis_re_issue_id', $issueList, (!empty($appeal->hr_griv_appl_issue_id)?$appeal->hr_griv_appl_issue_id:null), ['placeholder'=>'Select Reason', 'id'=>'dis_re_issue_id', 'class'=> 'col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Reason field is required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="dis_re_req_remedy"> Requested Remedy </label>
                            <div class="col-sm-9">
                                <textarea name="dis_re_req_remedy" id="dis_re_req_remedy" class="col-xs-10 col-sm-5" placeholder="Requested Remedy"  data-validation="required length" data-validation-length="2-255" data-validation-allowing=" -" data-validation-error-msg="The Requested Remedy has to be an alphanumeric value between 2-255 characters">{{ (!empty($appeal->hr_griv_appl_req_remedy)?$appeal->hr_griv_appl_req_remedy:null) }}</textarea>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="dis_re_ac_step_id">Action Steps</label>
                            <div class="col-sm-9">
                                {{ Form::select('dis_re_ac_step_id', $stepList, null, ['placeholder'=>'Select Action Step', 'id'=>'dis_re_ac_step_id', 'class'=> 'col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Action Step field is required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Date of Execution</label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="text" name="dis_re_doe_from" class="datepicker" placeholder="Execution From" data-validation="required">
                                </span>

                                <span class="input-icon input-icon-right">
                                    <input type="text" name="dis_re_doe_to" class="datepicker" placeholder="Executed To" data-validation="required">
                                </span>
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

                    </form>

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