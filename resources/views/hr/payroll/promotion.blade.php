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
					<a href="#">Payroll</a>
				</li>
				<li class="active"> Promotion</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Payroll<small> <i class="ace-icon fa fa-angle-double-right"></i> Promotion</small></h1>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    </br>
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')
                    <div class="output alert hide"></div> 

                    {{ Form::open(['url'=>'hr/payroll/promotion', 'class'=>'form-horizontal']) }}
 
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="associate_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                {{ Form::select('associate_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate_id', 'class'=> 'associates no-select col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="previous_designation"> Previous Designation </label>
                            <div class="col-sm-8">
                                <input type="hidden" name="previous_designation_id">
                                <input type="text" name="previous_designation" id="previous_designation" placeholder="No Previous Designation Found" class="col-xs-12" data-validation="required" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="current_designation_id"> Promoted Designation </label>
                            <div class="col-sm-8"> 
                                {{ Form::select('current_designation_id', $designationList, null, ['placeholder'=>'Select Promoted Designation', 'id'=>'current_designation_id', 'class'=> 'col-xs-12',  'data-validation'=>'required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="eligible_date"> Eligible Date </label>
                            <div class="col-sm-8">
                                <input type="date" name="eligible_date" id="eligible_date" class="col-xs-12" data-validation="required" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="effective_date"> Effective Date </label>
                            <div class="col-sm-8">
                                <input type="date" name="effective_date" id="effective_date" class="col-xs-12 filter" value="<?php echo date('Y-m-d') ?>" />
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
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Associate ID</th>
                                    <th>Name</th>
                                    <th>Prev. Desg.</th>
                                    <th>Curr. Desg</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($promotionList AS $promotion)
                                <tr>
                                    <td>{{ $promotion->associate_id }}</td>
                                    <td>{{ $promotion->as_name }}</td>
                                    <td>{{ $promotion->previous_desg }}</td>
                                    <td>{{ $promotion->current_desg }}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/payroll/promotion_edit/'.$promotion->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                    </div>
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
    $('#dataTables').DataTable({
            pagingType: "full_numbers" ,
    });  
    // Associate Search
    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/payroll/promotion-associate-search") }}',
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

    //Associate Information 
    $("body").on('change', ".associates", function(){
        $.ajax({
            url: '{{ url("hr/payroll/promotion-associate-info") }}',
            type: 'get',
            dataType: 'json',
            data: {associate_id: $(this).val()},
            success: function(data)
            { 
                if (data.status)
                { 
                    $("select[name=current_designation_id").html("").append(data.designation);
                    $('select[name=current_designation_id').trigger('change'); 

                    $("input[name=eligible_date]").val(data.eligible_date);
                    $("input[name=previous_designation]").val(data.previous_designation);
                    $("input[name=previous_designation_id]").val(data.previous_designation_id);
                    $(".output").addClass("hide");
                }
                else
                {
                    $("input[name=eligible_date]").val(""); 
                    $("input[name=previous_designation]").val("");
                    $("input[name=previous_designation_id]").val("");
                    $(".output").removeClass("hide").addClass("alert-danger").html(data.error);
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