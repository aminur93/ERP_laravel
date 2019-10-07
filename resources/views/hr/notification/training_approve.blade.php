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
                <li class="active">Training Approval</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Notification<small> <i class="ace-icon fa fa-angle-double-right"></i>Training Approval</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/notification/training/training_approve/aprrove_reject/', 'class'=>'form-horizontal']) }}

                        {{ Form::hidden('tr_as_id', $training->tr_as_id) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_tr_name"> Training Name </label>
                            <div class="col-sm-9">
                                <input name="hr_tr_name" type="text" id="hr_tr_name"  class="col-xs-10 col-sm-5" value="{{ $training->hr_tr_name }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_trainer_name"> Trainer Name </label>
                            <div class="col-sm-9">
                                <input name="tr_trainer_name" type="text" id="tr_trainer_name"  class="col-xs-10 col-sm-5" value="{{ $training->tr_trainer_name }}" readonly/>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_as_ass_id"> Associate's ID </label>
                            <div class="col-sm-9">
                                <input name="tr_as_ass_id" type="text" id="tr_as_ass_id"  class="col-xs-10 col-sm-5" value="{{ $training->tr_as_ass_id }}" readonly/>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="as_name"> Associate's Name </label>
                            <div class="col-sm-9">
                                <input name="as_name" type="text" id="as_name"  class="col-xs-10 col-sm-5" value="{{ $training->as_name }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="date">Training Date </label>
                            <div class="col-sm-9">
                               <input type="text" name="date" id="date" placeholder="Designation" class="col-xs-10 col-sm-5" value="{{ $training->date }}"  readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="time">Training Time </label>
                            <div class="col-sm-9">
                               <input type="text" name="time" id="time" placeholder="Designation" class="col-xs-10 col-sm-5" value="{{ $training->time }}"  readonly/>
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