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
                    <a href="#">Recruitment</a>
                </li>
                <li>
                    <a href="#">Operation</a>
                </li>
                <li class="active">Medical Incident</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">  
            <div class="page-header row">
                <h1 class="col-sm-6">Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Operation  <i class="ace-icon fa fa-angle-double-right"></i> Medical Incident</small></h1>
                <div class="text-right" id="newBtn"> 
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/ess/medical_incident', 'method'=>'POST', 'files' => true, 'class'=>'form-horizontal']) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('hr_med_incident_as_id', [request()->get("associate_id") => request()->get("associate_id")], request()->get("associate_id"), ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_med_incident_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_as_name"> Associate's Name </label>
                            <div class="col-sm-9">
                                <input name="hr_med_incident_as_name" type="text" id="hr_med_incident_as_name" placeholder="Associate's Name" class="col-xs-10 col-sm-5" data-validation="required length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"  data-validation-length="3-64" data-validation-error-msg="The Associate's Name should contain only alphabet between 3-64 characters" readonly/>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_date">Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" name="hr_med_incident_date" id="hr_med_incident_date" class="col-xs-10 col-sm-5" data-validation="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_details"> Incident Details </label>
                            <div class="col-sm-9">
                               <input type="text" name="hr_med_incident_details" id="hr_med_incident_details" placeholder="Incident Details" class="col-xs-10 col-sm-5" data-validation="length" data-validation-length="0-128" data-validation-error-msg="Incident Details should be between 0-128 characters"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_doctors_name"> Doctors Name </label>
                            <div class="col-sm-9">
                               <input name="hr_med_incident_doctors_name" type="text" id="hr_med_incident_doctors_name" placeholder="Doctors Name" class="col-xs-10 col-sm-5" data-validation="length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-optional="true"  data-validation-length="0-128" data-validation-error-msg="Doctors Name be contain only alphabet between 0-64 characters"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_doctors_recommendation"> Doctors Recommendation </label>
                            <div class="col-sm-9">
                               <input type="text" name="hr_med_incident_doctors_recommendation" id="hr_med_incident_doctors_recommendation" placeholder="Doctors Recommendation" class="col-xs-10 col-sm-5" data-validation="length " data-validation-optional="true" data-validation-length="0-128" data-validation-error-msg="Doctors Recommendation contain alphanumeric value between 0-128 characters"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_supporting_file">Supporting File (pdf|doc|docx|jpg|jpeg|png) </label>
                            <div class="col-sm-9">
                                <input type="file" name="hr_med_incident_supporting_file" data-validation="mime size" data-validation-allowing="docx, doc, pdf, jpg, png, jpeg" data-validation-max-size="1M"
                                data-validation-error-msg-size="You can not upload file larger than 1MB" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_action"> Company's Action </label>
                            <div class="col-sm-9">
                               <input type="text" name="hr_med_incident_action" id="hr_med_incident_action" placeholder="Company's Action" class="col-xs-10 col-sm-5" data-validation="custom length" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-optional="true" data-validation-length="0-128" data-validation-error-msg="Company's Action should contain alphanumeric value between 0-128 characters"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_med_incident_allowance"> Allowance </label>
                            <div class="col-sm-9">
                                <input name="hr_med_incident_allowance" type="text" id="hr_med_incident_allowance" placeholder="Allowance" class="col-xs-10 col-sm-5" data-validation="required length number" data-validation-optional="true" data-validation-length="1-11" data-validation-error-msg="Allowance should contain numeric value between 0-11 digits" />
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
function drawNewBtn(associate_id)
{
    var url = "{{ url("") }}";
    var newUrl = "<div class=\"btn-group\">"+ 
        "<a href='"+url+'/hr/recruitment/employee/edit/'+associate_id+"'  class=\"btn btn-sm btn-success\" title=\"Basic Info\"><i class=\"glyphicon glyphicon-bold\"></i></a>"+
        "<a href='"+url+'/hr/recruitment/operation/advance_info_edit/'+associate_id+"'  class=\"btn btn-sm btn-info\" title=\"Advance Info\"><i class=\"glyphicon  glyphicon-font\"></i></a>"+
        "<a href='"+url+'/hr/recruitment/operation/benefits?associate_id='+associate_id+"' class=\"btn btn-sm btn-primary\" title=\"Benefits\"><i class=\"fa fa-usd\"></i></a>"+
        "<a href='"+url+'/hr/ess/medical_incident?associate_id='+associate_id+"'  class=\"btn btn-sm btn-warning\" title=\"Medical Incident\"><i class=\"fa fa-stethoscope\"></i></a>"+
        "<a href='"+url+'/hr/operation/servicebook?associate_id='+associate_id+"' class=\"btn btn-sm btn-danger\" title=\"Service Book\"><i class=\"fa fa-book\"></i></a>"+
    "</div>"; 
    $("#newBtn").html(newUrl);
}
 

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
  

    // retrive all information 
    var name = $("input[name=hr_med_incident_as_name]");
    var associate_id = '{{ request()->get("associate_id") }}';
    $(window).on("load", function(){
        if (associate_id) 
        {
            ajaxLoad(associate_id);
            drawNewBtn(associate_id);
        }
    });

    $('body').on('change', '.associates', function(){
        ajaxLoad($(this).val());
        drawNewBtn($(this).val());
    });

    function ajaxLoad(associate_id)
    {
        $.ajax({
            url: '{{ url("hr/associate") }}',
            dataType: 'json',
            data: {associate_id},
            success: function(data)
            {
                name.val(data.as_name);
            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
    }

});
</script>
@endsection