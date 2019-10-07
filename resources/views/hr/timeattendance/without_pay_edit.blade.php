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
                <li class="active">Edit Without Pay</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Edit Without Pay</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    </br>
                    <!-- Display Erro/Success Message -->
                    @include('inc/message') 
                    {{ Form::open(['url'=>'hr/timeattendance/operation/without_pay_edit', 'class'=>'form-horizontal']) }}
                    <?php
                        $checkbox = "";
                        if(!empty($pay->hr_wop_end_date) && $pay->hr_wop_start_date!=$pay->hr_wop_end_date)
                        {
                            $checkbox = "checked";
                        } 
                    ?>

 
                        <input type="hidden" name="hr_wop_id" value="{{ $pay->hr_wop_id }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_wop_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_wop_as_id', [$pay->hr_wop_as_id=>$pay->hr_wop_as_id], $pay->hr_wop_as_id, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_wop_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="multipleDate"> Multiple Date</label>
                            <div class="col-sm-9"> 
                                <input id="multipleDate" class="ace ace-switch ace-switch-6" type="checkbox" {{ $checkbox }}/>
                                <span class="lbl" style="margin:6px 0 0 0"></span>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_wop_start_date"> Date<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="date" name="hr_wop_start_date" value="{{ $pay->hr_wop_start_date }}" id="hr_wop_start_date" class="col-xs-12" data-validation="required" data-validation-error-msg="The Start Date field is required" />
                                </span> 
                                <span class="input-icon input-icon-right {{ $checkbox?'':'hide' }}" id="multipleDateAccept">
                                    <input type="date" name="hr_wop_end_date" value="{{ $pay->hr_wop_end_date }}" id="hr_wop_end_date" class="col-xs-12" data-validation="required"data-validation-error-msg="The End Date field is required" /> 
                                </span> 
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_wop_reason"> Reason</label>
                            <div class="col-sm-9">
                                <textarea name="hr_wop_reason" id="hr_wop_reason" class="col-xs-10 col-sm-5" placeholder="Description"  data-validation="length" data-validation-length="0-1024" data-validation-allowing=" -" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$">{{ $pay->hr_wop_reason }}</textarea>
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
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
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

});
</script>
@endsection