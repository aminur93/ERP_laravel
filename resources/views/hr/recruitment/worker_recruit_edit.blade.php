@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                   <a href="/"><i class="ace-icon fa fa-home home-icon"></i>Human Resource</a> 
                </li>
                <li>
                    <a href="#">Recruitment</a>
                </li>
                <li>
                    <a href="#">Worker</a>
                </li>
                <li class="active">Edit Recruit</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Worker<small> <i class="ace-icon fa fa-angle-double-right"></i> Edit Recruit  </small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                <div class="col-sm-6">
                    <h5 style="color: red">*All fields are required</h5>
                    <br/>
                    {{ Form::open(['url'=>'hr/recruitment/worker/recruit', 'class'=>'form-horizontal']) }}

                    <input type="hidden" name="worker_id" value="{{ (!empty($employee->worker_id)?$employee->worker_id:null) }}">

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_name"> Associate's Name </label>
                        <div class="col-sm-9"> 
                            <input name="worker_name" type="text" id="worker_name" placeholder="Associate's Name" class="col-xs-10" data-validation="required length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="3-64" data-validation-error-msg="The Associate's Name has to be an alphabet value between 3-64 characters" style='text-transform:uppercase' value="{{ (!empty($employee->worker_name)?$employee->worker_name:null) }}" /> 
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_doj"> Date of Joining </label>
                        <div class="col-sm-9">
                            <input type="date" name="worker_doj" id="worker_doj" placeholder="Date of Joining" class="col-xs-10" data-validation="required" data-validation-format="mm/dd/yyyy" autocomplete="off" value="{{ (!empty($employee->worker_doj)?$employee->worker_doj:null) }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_emp_type_id"> Employee Type </label>
                        <div class="col-sm-9"> 
                            {{ Form::select('worker_emp_type_id', $employeeTypes, (!empty($employee->worker_emp_type_id)?$employee->worker_emp_type_id:null), ['placeholder'=>'Select Employee Type', 'id'=>'worker_emp_type_id', 'style'=> 'width:84%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Employee Type field is required']) }}  
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_designation_id" >Designation </label>
                        <div class="col-sm-9">
                            <select name="worker_designation_id" id="worker_designation_id" style="width:84%" data-validation="required" data-validation-error-msg='The Designation field is required'>
                                <option value="{{ $employee->worker_designation_id }}">{{ $employee->hr_designation_name }} </option> 
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_unit_id"> Unit </label>
                        <div class="col-sm-9"> 
                            {{ Form::select('worker_unit_id', $unitList, (!empty($employee->worker_unit_id)?$employee->worker_unit_id:null), ['placeholder'=>'Select Unit', 'id'=>'worker_unit_id',  'style'=>'width:84%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_area_id"> Select Area </label>
                        <div class="col-sm-9"> 
                            {{ Form::select('worker_area_id', $areaList, (!empty($employee->worker_area_id)?$employee->worker_area_id:null), ['placeholder'=>'Area Name', 'id'=>'worker_area_id', 'style'=> 'width:84%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_department_id" >Department Name </label>
                        <div class="col-sm-9">
                            <select name="worker_department_id" id="worker_department_id" style="width:84%" data-validation="required" data-validation-error-msg='The Department field is required'>
                                <option value="{{ $employee->worker_department_id }}">{{ $employee->hr_department_name }} </option> 
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_section_id" >Section Name </label>
                        <div class="col-sm-9">
                            <select name="worker_section_id" id="worker_section_id" style="width:84%">
                                <option value="{{ $employee->worker_section_id }}">{{ $employee->hr_section_name }} </option> 
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_subsection_id" > Sub Section Name</label>
                        <div class="col-sm-9">
                            <select name="worker_subsection_id" id="worker_subsection_id" style="width:84%">
                                <option value="{{ $employee->worker_subsection_id }}">{{ $employee->hr_subsec_name }} </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_ot"> OT / Non OT </label>
                        <div class="col-sm-9">
                            {{ Form::select('worker_ot', [0=>'Non OT',1=>'OT'], $employee->worker_ot, [ 'id'=>'worker_ot', 'style'=> 'width:84%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }} 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="gender"> Gender </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    {{ Form::radio('worker_gender', 'Male', (($employee->worker_gender=="Male")?true:false), ['class'=>'ace' ,'data-validation'=>'required']) }}
                                    <span class="lbl" value="Male"> Male</span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('worker_gender', 'Female',  (($employee->worker_gender=="Female")?true:false), ['class'=>'ace']) }}
                                    <span class="lbl" value="Female"> Female</span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{ Form::radio('worker_gender', 'third_gender',  (($employee->worker_gender=="third_gender")?true:false), ['class'=>'ace']) }}
                                    <span class="lbl" value="Third Gender"> Third Gender</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_dob"> Date of Birth </label>
                        <div class="col-sm-9">
                            <input name="worker_dob" type="date" id="worker_dob" placeholder="Date of Birth" class="date_of_birth col-xs-10"  value="{{ (!empty($employee->worker_dob)?$employee->worker_dob:null) }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_contact"> Contact No.  </label>
                        <div class="col-sm-9">
                            <input name="worker_contact" type="text" id="worker_contact" placeholder="01XXXXXXXXX" class="col-xs-10" data-validation="required length number" data-validation-length="11" data-validation-optional="true" value="{{ (!empty($employee->worker_contact)?$employee->worker_contact:null) }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_nid"> NID/Passport No </label>
                        <div class="col-sm-9">
                            <input type="text" name="worker_nid" placeholder="NID or Passport No" class="col-xs-10" data-validation="length" data-validation-length="0-64" data-validation-error-msg="Designation  between 0-64 characters" value="{{ (!empty($employee->worker_nid)?$employee->worker_nid:null) }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="as_oracle_code"> Oracle ID </label>
                        <div class="col-sm-9">
                            <input type="text" name="as_oracle_code" placeholder="Existing Oracle ID" class="col-xs-10" data-validation="length" data-validation-length="0-64" data-validation-error-msg="Must be Unique" value="{{ (!empty($employee->as_oracle_code)?$employee->as_oracle_code:null) }}"/>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="as_rfid"> RFID  </label>
                        <div class="col-sm-9">
                            <input type="text" name="as_rfid" placeholder="Card RFID No" class="col-xs-10" data-validation="length" data-validation-length="0-64" data-validation-error-msg="Must be Unique" value="{{ (!empty($employee->as_rfid)?$employee->as_rfid:null) }}"/>
                        </div>
                    </div>


                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-info" type="button">
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
                </div> 
                <!-- /.col -->
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Join Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recruitList as $recruited)
                            <tr>
                                <td>{{ $recruited->sl }}</td>
                                <td>{{ $recruited->worker_name }}</td>
                                <td>{{ $recruited->worker_doj }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/recruitment/worker/recruit_edit/'.$recruited->worker_id) }}" class='btn btn-xs btn-info' data-toggle="tooltip" title="Edit Information"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
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
    // show hide employee information
    var emp_type_id    = $("#worker_emp_type_id");
    var emp_type_info  = $("#worker_emp_type_info");
    var designation    = $("#worker_designation_id");
    emp_type_id.on("change", function(){ 

        // designation list
        $.ajax({
            url : "{{ url('hr/setup/getDesignationListByEmployeeTypeID') }}",
            type: 'get',
            data: {employee_type_id : $(this).val()},
            success: function(data)
            {
                designation.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
 

    //Load Department List By Area ID
    var area       = $("#worker_area_id");
    var department = $("#worker_department_id");
    var date_of_joining = $("#worker_doj");
    area.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getDepartmentListByAreaID') }}",
            type: 'get',
            data: {area_id: $(this).val() },
            success: function(data)
            {
                department.html(data); 
                section.html('');
                subsection.html('');
                date_of_joining.val('');
                $("#associate_id").val('');
                $("input[name=temp_id]").val('');
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
 

    //Load Section List By Department & Area ID
    var area       = $("#worker_area_id");
    var department = $("#worker_department_id");
    var section    = $("#worker_section_id");
    var date_of_joining = $("#worker_doj");
    var associate_id = $("#associate_id");
    department.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getSectionListByDepartmentID') }}",
            type:  'get',
            data: {area_id: area.val(), department_id: $(this).val() },
            success: function(data)
            {
                section.html(data); 
                subsection.html('');
                date_of_joining.val('');
                associate_id.val('');
                $("input[name=temp_id]").val('');
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

    //Load Sub Section List By Area ID, Department & Section
    var area       = $("#worker_area_id");
    var department = $("#worker_department_id")
    var section    = $("#worker_section_id");
    var subsection    = $("#worker_subsection_id");
    section.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getSubSectionListBySectionID') }}",
            type: 'get',
            data: {area_id: area.val(), department_id: department.val(), section_id: $(this).val() },
            success: function(data)
            {
                subsection.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

 
    // HR Floor By Unit ID
    var unit  = $("#worker_unit_id");
    var floor = $("#worker_floor_id")
    unit.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getFloorListByUnitID') }}",
            type: 'get',
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

 
}); 
</script> 
@endsection