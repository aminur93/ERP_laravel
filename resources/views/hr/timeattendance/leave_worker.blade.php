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
                    <a href="#"> Time & Attendance </a>
                </li>
                <li class="active"> Workers Leave </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Workers Leave </small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    </br>
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/timeattendance/leave_worker', 'class'=>'form-horizontal', 'files' => true]) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_ass_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('leave_ass_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'leave_ass_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_type">Leave Type<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <select name="leave_type" id="leave_type" class="col-xs-10 col-sm-5 no-select"  data-validation="required" data-validation-error-msg="Leave type is required" >
                                    <option value="">Select Leave Type</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Earned">Earned</option>
                                    <option value="Sick">Sick</option> 
                                    <option value="Maternity">Maternity</option> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="multipleDate"> Multiple Date</label>
                            <div class="col-sm-9"> 
                                <input id="multipleDate" class="ace ace-switch ace-switch-6" type="checkbox">
                                <span class="lbl" style="margin:6px 0 0 0"></span>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_from">Leave Date<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="date" name="leave_from" id="leave_from" class="col-xs-12" data-validation="required"  data-validation-error-msg="The Start Date field is required" />
                                </span> 
                                <span class="input-icon input-icon-right hide" id="multipleDateAccept">
                                    <input type="date" name="leave_to" id="leave_to" class="col-xs-12" data-validation="required" data-validation-error-msg="The End Date field is required" /> 
                                </span> 
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_applied_date"> Applied Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" name="leave_applied_date" id="leave_applied_date" class="col-xs-10 col-sm-5" data-validation="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_supporting_file">Supporting File (pdf|doc|docx|jpg|jpeg|png) </label>
                            <div class="col-sm-9">
                                <input type="file" name="leave_supporting_file" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                data-validation-error-msg-size="You can not upload file larger than 1MB" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_comment"> Note </label>
                            <div class="col-sm-9">
                                <textarea name="leave_comment" id="leave_comment" class="col-xs-10 col-sm-5" placeholder="Description"  data-validation="length" data-validation-length="0-1024" data-validation-allowing=" -" data-validation-error-msg="The Description has to be an alphanumeric value between 2-1024 characters"></textarea>
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


    // Select Multiple Dates
    var multipleDate = $("#multipleDate");
    var multipleDateAccept = $("#multipleDateAccept");
    multipleDate.on('click', function(){
        multipleDateAccept.children().val('');
        multipleDateAccept.toggleClass('hide');
    })

    $("#leave_type").on("change", function(e){

        if(!($("#leave_ass_id").val())){
            alert("Please Select Associate!!");
            $(this).val(0);
        }
        else{
            $.ajax({
                url: '{{ url("hr/reports/leave_check") }}',
                dataType: 'json',
                data: {associate_id: $("#leave_ass_id").val(), leave_type: $(this).val()},
                success: function(data)
                {
                    if(data == false){
                        alert("You do not have enough Leave!!");
                        $("#leave_type").val(0);
                    }

                },
                error: function(xhr)
                {
                    alert('failed...');
                }
            });
        }
    }); 



});
</script>
@endsection