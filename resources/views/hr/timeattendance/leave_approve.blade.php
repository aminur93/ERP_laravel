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
                    <a href="#"> Time & Attendance </a>
                </li>
                <li class="active"> Leave Approval </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i>Leave Approval</small></h1>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/timeattendance/leave_approve/approve_reject', 'class'=>'form-horizontal']) }}

                        {{ Form::hidden('id', $leave->id) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_ass_id"> Associate's ID </label>
                            <div class="col-sm-9">
                                <input name="leave_ass_id" type="text" id="leave_ass_id"  class="col-xs-12" value="{{ $leave->leave_ass_id }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_leave_type"> Leave Type </label>
                            <div class="col-sm-9">
                                <input name="hr_leave_type" type="text" id="hr_leave_type" class="col-xs-12" value="{{ $leave->leave_type }}" readonly/>
                            </div>
                        </div> 


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_from"> Leave Duration </label>
                            <div class="col-sm-9">
                               <input type="text" name="leave_from" id="leave_from" placeholder="Designation" class="col-xs-12" value="{{ $leave->leave_from }} to {{ $leave->leave_to }}"  readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_applied_date"> Applied Date </label>
                            <div class="col-sm-9">
                               <input type="text" name="leave_applied_date" id="leave_applied_date" placeholder="Designation" class="col-xs-12" value="{{ $leave->leave_applied_date }}"  readonly/>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_applied_date"> Supporting File </label>
                            <div class="col-sm-9">
                                @if(!empty($leave->leave_supporting_file))
                                <a href="{{ url($leave->leave_supporting_file) }}" class="btn btn-xs btn-primary" target="_blank" title="View"><i class="fa fa-eye"></i> View</a>
                                <a href="{{ url($leave->leave_supporting_file) }}" class="btn btn-xs btn-success" target="_blank" download title="Download"><i class="fa fa-download"></i> Download</a>
                                @else
                                    <strong class="text-danger">No file found!</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="leave_comment">Comment </label>
                            <div class="col-sm-9">
                                <input name="leave_comment" type="text" id="leave_comment" class="col-xs-12" data-validation="length" data-validation-length="0-128" value="{{ $leave->leave_comment }}" />
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
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Applied Date</th>
                                    <th>Leave Duration</th>
                                    <th>Leave Type</th>
                                    <th>Leave Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($previous_leaves as $previous_leave)
                                <tr>
                                    <td>{{ $previous_leave->leave_applied_date }}</td>
                                    <td>{{ $previous_leave->leave_from }} to {{ $previous_leave->leave_to }}</td>
                                    <td>{{ $previous_leave->leave_type }}</td>
                                    <td>
                                        @if($previous_leave->leave_status == 1)
                                        <span class='label label-success label-xs'> Approved</span>
                                        @elseif($previous_leave->leave_status == 2)
                                        <span  class='label label-danger label-xs'> Declined</span>
                                        @else
                                        <span class='label label-primary label-xs'>Applied</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
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