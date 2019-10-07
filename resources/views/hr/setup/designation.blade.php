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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Designation </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Designation </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="hidden output"></div>
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/designation')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_designation_emp_type"> Associate Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('hr_designation_emp_type', $emp_type, null, ['placeholder'=>'Select Associate Type', 'id'=>'hr_designation_emp_type', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'Employee type is required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_designation_name" > Designation Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_designation_name" placeholder="Designation Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_designation_name_bn" > পদবী (বাংলা)</label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_designation_name_bn" name="hr_designation_name_bn" placeholder="পদের নাম" class="col-xs-12" data-validation="length" data-validation-length="0-255"/>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_designation_grade" > Grade<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_designation_grade" placeholder="Grade" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
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
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    {{ Form::open(['url'=>'hr/hierarchy', 'id'=>'hierarchyFrm']) }}
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5">Drag and drop to change position of designation </th> 
                            </tr>
                            <tr>
                                <th>Associate Type</th>
                                <th>Designation Name</th>
                                <th>পদবী (বাংলা)</th>
                                <th>Grade</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($designations as $designation)
                            <tr class="ui-state-default" style="cursor:move">
                                <td>{{ $designation->hr_emp_type_name }}</td>
                                <td>{{ $designation->hr_designation_name }}</td>
                                <td>{{ $designation->hr_designation_name_bn }}</td>
                                <td>{{ $designation->hr_designation_grade }}</td>
                                <td>
                                    <input type='hidden' class="position" name='designation[{{ $designation->hr_designation_id }}]' value='{{ $designation->hr_designation_position }}'>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/setup/designation_update/'.$designation->hr_designation_id) }}" class='btn btn-xs btn-primary' data-toggle="tooltip" title="Edit"> <i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('hr/setup/designation/'.$designation->hr_designation_id) }}" type="button" onclick="return confirm('Are you sure?')" class='btn btn-xs btn-danger' data-toggle="tooltip" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ Form::close() }}
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 
<script type="text/javascript">
$(document).ready(function(){ 

    $('#sortable').sortable({
        stop: function () {
            var inputs = $('input.position');
            var nbElems = inputs.length;
            $('input.position').each(function(id) 
            { 
                $(this).val(nbElems - id);
            });

            $.ajax({
                url: '{{ url("hr/hierarchy") }}',
                type: 'post',
                data: $('#hierarchyFrm').serialize(),
                success: function(data)
                {
                    $(".output").removeClass('hidden').addClass("alert alert-success").html(data);
                    setTimeout(function(){
                        $(".output").addClass('hidden').removeClass("alert alert-success").html('');
                    }, 3000);
                },
                error: function(xhr)
                {
                    console.log(xhr)
                }
            });
        }
    });  
 

});
</script>
@endsection