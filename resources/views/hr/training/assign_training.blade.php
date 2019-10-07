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
				<li class="active">Assign Training </li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Training<small> <i class="ace-icon fa fa-angle-double-right"></i> Assign Training </small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    </br>
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/training/assign_training', 'class'=>'form-horizontal']) }}
 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_as_tr_id"> Training List <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9"> 
                                {{ Form::select('tr_as_tr_id', $trainingList, null, ['placeholder'=>'Select Training List', 'id'=>'tr_as_tr_id', 'class'=> 'col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Training List field is required']) }}  
                            </div>
                        </div>
 
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tr_as_ass_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('tr_as_ass_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'tr_as_ass_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

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
});
</script>
@endsection