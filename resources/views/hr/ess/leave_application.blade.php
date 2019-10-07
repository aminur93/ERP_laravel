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
					<a href="#"> ESS </a>
				</li>
				<li class="active"> Leave Application</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>ESS<small> <i class="ace-icon fa fa-angle-double-right"></i> Leave Application</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    @include('inc/message')
                    <!-- PAGE CONTENT BEGINS -->
                    {{ Form::open(['url'=>'hr/ess/leave_application', 'class'=>'form-horizontal', 'files' => true]) }}

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
                                    <input type="date" name="leave_from" id="leave_from" class="col-xs-12 " data-validation="required" data-validation-error-msg="The Start Date field is required" />
                                </span> 
                                <span class="input-icon input-icon-right hide" id="multipleDateAccept">
                                    <input type="date" name="leave_to" id="leave_to" class="col-xs-12" data-validation="required" data-validation-error-msg="The End Date field is required" /> 
                                </span> 
                            </div>
                        </div>

                        <input type="hidden" name="leave_applied_date" id="leave_applied_date" value="<?php echo date('Y-m-d'); ?>" class="col-xs-10 col-sm-5 " data-validation="required"/>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_supporting_file">Supporting File (pdf|doc|docx|jpg|jpeg|png) </label>
                            <div class="col-sm-9">
                                <input type="file" name="leave_supporting_file" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                data-validation-error-msg-size="You can not upload file larger than 1MB" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
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


                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <table class="table table-info">
                                    <thead>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Applied Date</th>
                                            <th>Leave From</th>
                                            <th>Leave To</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="leaveHistory"> 
                                    </tbody> 
                                </table>
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

    var associate_id = '{{ auth()->user()->associate_id }}';
    $(window).load( function(){
        $.ajax({
            url: '{{ url("hr/ess/leave_history") }}',
            dataType: 'json',
            data: {associate_id: associate_id},
            success: function(history)
            {
                var html = "";
                $.each(history, function(i, v)
                {
                    html += "<tr>"+
                        "<td>"+v.leave_type+"</td>"+
                        "<td>"+v.leave_applied_date+"</td>"+
                        "<td>"+(v.leave_from) +"</td>"+
                        "<td>"+v.leave_to+"</td>"+
                        "<td>"+v.leave_status+"</td>"+
                    "</tr>";
                });
                $("#leaveHistory").html(html);

            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
    }); 

    var multipleDate = $("#multipleDate");
    var multipleDateAccept = $("#multipleDateAccept");
    multipleDate.on('click', function(){
        multipleDateAccept.children().val('');
        multipleDateAccept.toggleClass('hide');
    })


    $("#leave_type").on("change", function(){
        $.ajax({
            url: '{{ url("hr/reports/leave_check") }}',
            dataType: 'json',
            data: {associate_id: associate_id, leave_type: $(this).val()},
            success: function(data)
            {
                if(data == false){
                    alert("You do not have enough Leave!!");
                    $(this).val(0);
                }

            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
    }); 

});
</script>



@endsection
                    