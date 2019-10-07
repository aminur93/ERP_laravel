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
                    <a href="#">Notification</a>
                </li>
                <li class="active">Leave Approval</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Notification<small> <i class="ace-icon fa fa-angle-double-right"></i>Leave Approval</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/notification/leave/leave_approve/approve_reject/', 'class'=>'form-horizontal']) }}

                        {{ Form::hidden('id', $leave->id) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_ass_id"> Associate's ID </label>
                            <div class="col-sm-9">
                                <input name="leave_ass_id" type="text" id="leave_ass_id"  class="col-xs-10 col-sm-5" value="{{ $leave->leave_ass_id }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_type"> Leave Type </label>
                            @if( $leave->leave_type == 1)
                            <div class="col-sm-9">
                                <input name="hr_leave_type" type="text" id="leave_type" class="col-xs-10 col-sm-5" value="Casual" readonly/>
                            </div>
                            @elseif( $leave->leave_type == 2)
                            <div class="col-sm-9">
                                <input name="leave_type" type="text" id="leave_type" class="col-xs-10 col-sm-5" value="Sick" readonly/>
                            </div>
                            @else
                            <div class="col-sm-9">
                                <input name="leave_type" type="text" id="leave_type" class="col-xs-10 col-sm-5" value="Sick" readonly/>
                            </div>

                            @endif
                        </div> 


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_from"> Leave Duration </label>
                            <div class="col-sm-9">
                               <input type="text" name="leave_from" id="leave_from" placeholder="Designation" class="col-xs-10 col-sm-5" value="{{ $leave->leave_from }} to {{ $leave->leave_to }}"  readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_supporting_file"> Supporting File </label>
                            <div class="col-sm-9 btn-group">
                                @if(!empty($leave->leave_supporting_file))
                                    <a href="{{ url($leave->leave_supporting_file) }}" class="btn btn-xs btn-primary" target="_blank" title="View"><i class="fa fa-eye"></i> View</a>
                                    <a href="{{ url($leave->leave_supporting_file) }}" class="btn btn-xs btn-success" target="_blank" download title="Download"><i class="fa fa-download"></i> Download</a>
                                @else
                                    <strong class="text-danger">No file found!</strong>
                                 @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_comment"> Leave Comment </label>
                            <div class="col-sm-9">
                                <input name="leave_comment" type="text" id="leave_comment" class="col-xs-10 col-sm-5" value="{{ $leave->leave_comment }}" readonly />
                            </div>
                        </div>

 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button name="approve" class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Approve
                                </button>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <button name="reject" class="btn btn-danger" type="submit">
                                    <i class="ace-icon fa fa-ban bigger-110"></i> Reject 
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
 



    // retrive all information 
    var name         = $("input[name=hr_la_name]");
    var designation  = $("input[name=hr_la_designation]");
    var date_of_join = $("input[name=hr_la_date_of_join]");
    $('body').on('change', '.associates', function(){
        $.ajax({
            url: '{{ url("hr/associate") }}',
            dataType: 'json',
            data: {associate_id: $(this).val()},
            success: function(data)
            {
                name.val(data.as_name);
                designation.val(data.hr_designation_name);
                date_of_join.val(data.as_doj);
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