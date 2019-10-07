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
                <li class="active"> Department </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Department </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS --> 
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/department')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_department_area_id" > Area Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_department_area_id', $areaList, null, ['placeholder' => 'Select Area Name', 'class' => 'col-xs-12 no-select', 'id'=>'hr_department_area_id', 'data-validation'=>'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_department_name" > Department Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_department_name" id="hr_department_name" placeholder="Department Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_department_name_bn" >ডিপার্টমেন্ট (বাংলা)<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_department_name_bn" id="hr_department_name_bn" placeholder="ডিপার্টমেন্টের নাম " class="col-xs-12" data-validation="length required" data-validation-length="0-255"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_department_code"> Department Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_department_code" placeholder="Department Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-2"
                                data-validation-regexp="^([a-zA-Z]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_department_min_range"> Department ID Range<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="hr_department_min_range" name="hr_department_min_range" data-validation=" required length number" data-validation-length="6" placeholder="Example: 000001 " class="col-xs-12"  />
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="text" id="hr_department_max_range" name="hr_department_max_range" data-validation=" required length number" data-validation-length="6" placeholder="Example: 001000" class="col-xs-12"  />
                                    </div>
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

                        <!-- /.row --> 
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Department Name</th>
                                    <th>ডিপার্টমেন্ট (বাংলা)</th>
                                    <th>Department Code</th>
                                    <th>Department ID Range</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->hr_department_name }}</td>
                                    <td>{{ $department->hr_department_name_bn }}</td>
                                    <td>{{ $department->hr_department_code }}</td>
                                    <td>{{ $department->hr_department_min_range }}-{{ $department->hr_department_max_range }}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/setup/department_update/'.$department->hr_department_id) }}" class='btn btn-xs btn-primary' data-toggle="tooltip" title="Edit"> <i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('hr/setup/department/'.$department->hr_department_id) }}" type="button" class='btn btn-xs btn-danger' data-toggle="tooltip" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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
$(document).ready(function(){ 

    $('#dataTables').DataTable({
        pagingType: "full_numbers" ,
        // searching: false,
        // "lengthChange": false,
        // 'sDom': 't' 
        "sDom": '<"F"tp>'

    }); 
});
</script>
@endsection