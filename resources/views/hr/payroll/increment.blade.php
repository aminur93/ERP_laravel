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
					<a href="#"> Payroll </a>
				</li>
				<li class="active"> Increment </li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Payroll <small><i class="ace-icon fa fa-angle-double-right"></i> Increment </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                   <form class="form-horizontal" role="form" method="post" action="{{ url('hr/payroll/increment')  }}" enctype="multipart/form-data">
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                   
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="hr_unit_name" >Unit </label>
                            <div class="col-sm-8">
                                {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'class'=> 'col-xs-12 filter']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="hr_unit_name" >Associate Type </label>
                            <div class="col-sm-8">
                                {{ Form::select('emp_type', $employeeTypes, null, ['placeholder'=>'Select Associate Type', 'class'=> 'col-xs-12 filter']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="hr_unit_name" >Increment Type </label>
                            <div class="col-sm-8">
                                {{ Form::select('increment_type', $typeList, null, ['placeholder'=>'Select Increment Type', 'class'=> 'col-xs-12']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="effective_date"> Effective Date </label>
                            <div class="col-sm-8">
                                <input type="date" name="effective_date" id="effective_date" class="col-xs-12 filter" value="<?php echo date('Y-m-d') ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="increment_amount"> Increment Amount/Percentage  </label>
                            <div class="col-sm-5">
                                <input type="text" name="increment_amount" id="increment_amount" placeholder="Increment Amount/Percentage" class="col-xs-12" data-validation="required number length" data-validation-length="1-11" data-validation-allowing="float"/>
                            </div>
                            <div class="col-sm-3">
                                <select class="no-select col-xs-12" data-validation="required" id="amount_type" name="amount_type">
                                    <option value="">Select Amount Type</option>
                                    <option value="1">Increased Amount</option>
                                    <option value="2">Percent</option>
                                </select>
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
                     
                    <!-- PAGE CONTENT ENDS -->
                </div>

                <!-- Table -->

                <div class="col-sm-6">
                        <div class="col-xs-12">
                            <table id="AssociateTable" class="table header-fixed table-compact table-bordered">
                                <tehad>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"/></th>
                                        <th>Associate ID</th>
                                        <th>Associate Name</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" id="user_filter"></th>
                                    </tr>
                                </tehad> 
                                <tbody id="user_info">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <table id="dataTables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Associate ID</th>
                                        <th>Name</th>
                                        <th>Inc. Type</th>
                                        <th>Inc. Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incrementList AS $increment)
                                    <tr>
                                        <td>{{ $increment->associate_id }}</td>
                                        <td>{{ $increment->as_name }}</td>
                                        <td>{{ $increment->increment_type }}</td>
                                        <td>{{ $increment->increment_amount }}<?php if($increment->amount_type == 2) echo "%"; ?></td>
                                        <td>
                                        <div class="btn-group">
                                            <a type="button" href="{{ url('hr/payroll/increment_edit/'.$increment->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </form>
                <!-- /.col -->
            </div>
		</div><!-- /.page-content -->
	</div>
</div>

<script type="text/javascript"> 
$(document).ready(function(){
    $('#dataTables').DataTable({
            pagingType: "full_numbers" ,
    });  
    //Filter User
    $("body").on("keyup", "#AssociateSearch", function() {
        var value = $(this).val().toLowerCase(); 
        $("#AssociateTable #user_info tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });


    var userInfo = $("#user_info");
    var userFilter = $("#user_filter");
    var emp_type = $("select[name=emp_type]");
    var unit     = $("select[name=unit]");
    var date     = $('input[name=effective_date]'); 
    $(".filter").on('change keyup', function(){ 
        $.ajax({
            url: '{{ url("hr/payroll/get_associate") }}',
            data: {
                emp_type: emp_type.val(),
                unit: unit.val(),
                date: date.val(),
            },
            success: function(data)
            { 
                console.log(data)
                userInfo.html(data.result);
                userFilter.html(data.filter);
            },
            error:function(xhr)
            {
                console.log('Employee Type Failed');
            }
        });
    }); 

    $('#checkAll').click(function(){
        var checked = $(this).prop('checked');
        $('input:checkbox').prop('checked', checked);
    }); 

    $('body').on('click', 'input:checkbox', function() {
        if(!this.checked) {
            $('#checkAll').prop('checked', false);
        }
        else {
            var numChecked = $('input:checkbox:checked:not(#checkAll)').length;
            var numTotal = $('input:checkbox:not(#checkAll)').length;
            if(numTotal == numChecked) {
                $('#checkAll').prop('checked', true);
            }
        }
    });

    $('#formSubmit').on("click", function(e){
        var checkedBoxes= [];
        $('input[type="checkbox"]:checked').each(function() {
            if(this.value != "on")
            checkedBoxes.push($(this).val());
        });
    });

});
</script>
@endsection