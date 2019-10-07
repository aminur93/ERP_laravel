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
					<a href="#">Training</a>   
				</li>
				<li class="active">Add Training</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header"> 
				<h1>Training<small> <i class="ace-icon fa fa-angle-double-right"></i> Add Training</small></h1> 
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    </br> 

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/training/add_training', 'class'=>'form-horizontal']) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="training_list"> Training List<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('tr_as_tr_id', $trainingNames, null, ['placeholder'=>'Select Training List', 'id'=>'tr_as_tr_id', 'class'=> 'col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Training List field is required']) }}  
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="tr_trainer_name"> Trainer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input name="tr_trainer_name" type="text" id="tr_trainer_name" placeholder="Trainer Name" class="col-xs-10 col-sm-5" data-validation="required length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"  data-validation-length="3-128" data-validation-error-msg="The Trainer Name has to be an alphabet value between 3-128 characters" />
                            </div>
                        </div> 
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_description"> Description<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <textarea name="tr_description" id="tr_description" class="col-xs-10 col-sm-5" placeholder="Description"  data-validation="required length" data-validation-length="3-1024" data-validation-allowing=" -" data-validation-error-msg="The Description has to be an alphanumeric value between 3-1024 characters"></textarea>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="multipleDate"> Continue</label>
                            <div class="col-sm-9"> 
                                <input id="multipleDate" class="ace ace-switch ace-switch-6" type="checkbox">
                                <span class="lbl" style="margin:6px 0 0 0"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_start_date">Schedule Date<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="date" name="tr_start_date" id="tr_start_date" placeholder="Start Date" class="col-xs-12" data-validation="required" data-validation-format="yyyy-mm-dd" data-validation-error-msg="The Start Date field is required" />
                                </span> 
                                <span class="input-icon input-icon-right" id="multipleDateAccept">
                                    <input type="date" name="tr_end_date" id="tr_end_date" placeholder="End Date" class="col-xs-12" data-validation-format="yyyy-mm-dd"/> 
                                </span>
                            </div>
                        </div> 
 
  
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_start_time">Schedule Time<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="time" name="tr_start_time" id="tr_start_time" placeholder="Start Time" class="col-xs-12" data-validation="required"  data-validation-error-msg="The Start Time field is required" />
                                </span> 
                                <span class="input-icon input-icon-right">
                                    <input type="time" name="tr_end_time" id="tr_end_time" placeholder="End Time" class="col-xs-12" data-validation="required"  data-validation-error-msg="The End Time field is required" /> 
                                </span>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_status"> Status </label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('tr_status', 'Active', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                        <span class="lbl" value="Active"> Active</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('tr_status', 'Inactive', false, ['class'=>'ace']) }}
                                        <span class="lbl" value="Inactive"> Inactive</span>
                                    </label>
                                </div>
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
$(document).ready(function(){
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

        var multipleDate = $("#multipleDate");
    var multipleDateAccept = $("#multipleDateAccept");
    multipleDate.on('click', function(){
        multipleDateAccept.children().val('');
        multipleDateAccept.toggleClass('hide');
    }); 
});
</script>

@endsection