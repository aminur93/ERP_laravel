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
                <li class="active"> Shift </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Shift </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS --> 
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/shift')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}  


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_unit_id"> Unit Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('hr_shift_unit_id', $unitList, null, ['placeholder'=>'Select Unit Name', 'id'=>'hr_shift_unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Unit Name field is required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_name" > Shift Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_shift_name" id="hr_shift_name" placeholder="Shift Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_name_bn" > শিফট (বাংলা)</label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_shift_name_bn" id="hr_shift_name_bn" placeholder="শিফট এর নাম" class="col-xs-12" data-validation="length" data-validation-length="0-255"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_start_time">Shift Time<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="time" name="hr_shift_start_time" id="hr_shift_start_time" class="col-xs-12" data-validation-error-msg="The Start Time field is required" />
                                </span> 
                                <span class="input-icon input-icon-right">
                                    <input type="time" name="hr_shift_end_time" id="hr_shift_end_time" class="col-xs-12"  data-validation-error-msg="The End Time field is required" /> 
                                </span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_break_time">Break Time<span style="color: red">&#42;</span>(Minutes)</label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_shift_break_time" name="hr_shift_break_time" data-validation="required length number" data-validation-length="1-3" placeholder="Break time in Minutes" class="col-xs-12"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_shift_code" > Shift Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_shift_code" id="hr_shift_code" placeholder="Shift Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-3" data-validation-regexp="^([A-Z ]+)$"/>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="gender"> Night Shift</label>
                            <div class="col-sm-3">

                                <div class="control-group"> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="night_flag" type="checkbox" value="1" class="ace" data-validation="checkbox_group" data-validation-qty="min1" data-validation-optional="true">
                                            <span class="lbl"></span>
                                        </label>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="gender"> Default Shift</label>
                            <div class="col-sm-3">

                                <div class="control-group"> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="default_flag" type="checkbox" value="1" class="ace" data-validation="checkbox_group" data-validation-qty="min1" data-validation-optional="true">
                                            <span class="lbl"></span>
                                        </label>
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
                                    <th>Unit Name</th>
                                    <th>Shift Name</th>
                                    <th>Shift Code</th>
                                    <th>Shift Time</th>
                                    <th>Break Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shifts as $shift)
                                <tr>
                                    <td>{{ $shift->hr_unit_name }}</td>
                                    <td>{{ $shift->hr_shift_name }}</td>
                                    <td>
                                    <?php 
                                        $code= $shift->hr_shift_code;
                                        $letters = preg_replace('/[^a-zA-Z]/', '', $code);
                                    ?>
                                        {{ $letters }}
                                    </td>
                                    <td>{{ $shift->hr_shift_start_time }} - {{ $shift->hr_shift_end_time }}</td>
                                     <td>{{ $shift->hr_shift_break_time }}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/setup/shift_update/'.$shift->hr_shift_id) }}" class='btn btn-xs btn-primary' data-toggle="tooltip" title="Edit"> <i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('hr/setup/shift/'.$shift->hr_shift_id) }}" type="button" class='btn btn-xs btn-danger' data-toggle="tooltip" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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
    

    // Show Line List by Unit ID
    var unit  = $("#hr_shift_unit_id");
    var floor = $("#hr_shift_floor_id");
    unit.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getFloorListByUnitID') }}",
            type: 'json',
            method: 'get',
            data: {unit_id: $(this).val() },
            success: function(data)
            {
                floor.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

    // Show Line List by Floor ID
    var unit = $("#hr_shift_unit_id");
    var floor = $("#hr_shift_floor_id");
    var line = $("#hr_shift_line_id");
    floor.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getLineListByFloorID') }}",
            type: 'json',
            method: 'get',
            data: {unit_id: unit.val(), floor_id: $(this).val() },
            success: function(data)
            {
                line.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
});
</script>
@endsection