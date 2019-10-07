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
                    <a href="#">Employer</a>
                </li>
                <li class="active">Update Basic Information</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header row">
                <h1 class="col-xs-8">Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Update Basic Information</small></h1>
                <div class="text-right">
                    <div class="btn-group"> 
                        <a href='{{ url("hr/recruitment/employee/edit/$employee->associate_id") }}' class="btn btn-sm btn-success" title="Basic Info"><i class="glyphicon glyphicon-bold"></i></a>
                        <a href='{{ url("hr/recruitment/operation/advance_info_edit/$employee->associate_id") }}' class="btn btn-sm btn-info" title="Advance Info"><i class="glyphicon  glyphicon-font"></i></a>
                        <a href='{{ url("hr/recruitment/operation/benefits?associate_id=$employee->associate_id") }}' class="btn btn-sm btn-primary" title="Benefits"><i class="fa fa-usd"></i></a>
                        <a href='{{ url("hr/ess/medical_incident?associate_id=$employee->associate_id") }}' class="btn btn-sm btn-warning" title="Medical Incident"><i class="fa fa-stethoscope"></i></a>
                        <a href='{{ url("hr/operation/servicebook?associate_id=$employee->associate_id") }}' class="btn btn-sm btn-danger" title="Service Book"><i class="fa fa-book"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                <div class="col-sm-12">
                    <div id="english">
                        <br/>
                        {{ Form::open(['url'=>'hr/recruitment/employee/update_employee', 'files' => true, 'class'=>'form-horizontal']) }}

                            <input type="hidden" name="as_id" value="{{ $employee->as_id }}">

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_emp_type_id"> Employee Type </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_emp_type_id', $employeeTypes, $employee->as_emp_type_id, ['placeholder'=>'Select Employee Type', 'id'=>'as_emp_type_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Employee Type field is required']) }}  
                                </div>
                            </div> 
                            @if(auth()->user()->can('hr_designation_update'))
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_designation_id">Designation </label>
                                <div class="col-sm-4">
                                    <select name="as_designation_id" id="as_designation_id" style="width:100%" data-validation="required" data-validation-error-msg='The Designation field is required'>
                                        @foreach($designationList AS $desg)
                                            <option value="{{ $desg->hr_designation_id }}" {{ $desg->hr_designation_id==$employee->as_designation_id?" Selected ":"" }}>{{ $desg->hr_designation_name }} </option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_designation_id">Designation </label>
                                <div class="col-sm-4">
                                    <input type="hidden" value="{{ $employee->as_designation_id }}" name="as_designation_id">
                                    <input type="text" value="{{ $employee->hr_designation_name }}" readonly class="form-control">
                                </div>
                            </div>
                            @endif
                            @if($cost_mapping_unit_status==false)
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="unit_map_checkbox"></label>
                                <div class="checkbox col-sm-4">
                                    <label class="col-xs-12" style="padding-left: 10px;">
                                        <input name="unit_map_checkbox" id="unit_map_checkbox" type="checkbox" class="ace"/>
                                        <span class="lbl">&nbsp;&nbsp;&nbsp;Assign for Cost Mapping(Unit)</span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_unit_id"> Unit </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_unit_id', $unitList, $employee->as_unit_id, ['placeholder'=>'Select Unit', 'id'=>'as_unit_id',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_location_id"> Location </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_location_id', $unitList, $employee->as_location, ['placeholder'=>'Select Location', 'id'=>'as_location_id',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Location field is required']) }}  
                                </div>
                            </div>

                            <!-- WORKER INFORMATION -->
                            <div id="as_emp_type_info"> 
         
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="as_floor_id"> Floor </label>
                                    <div class="col-sm-4">
                                        {{ Form::select('as_floor_id', $floorList, $employee->as_floor_id, ['placeholder'=>'Select Floor', 'id'=>'as_floor_id','style'=>'width:100%']) }}   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="as_line_id"> Line </label>
                                    <div class="col-sm-4">
                                        {{ Form::select('as_line_id', $lineList, $employee->as_line_id, ['placeholder'=>'Select Line', 'id'=>'as_line_id',  'style'=>'width:100%']) }}  
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="as_shift_id"> Shift </label>
                                    <div class="col-sm-4"> 
                                        {{ Form::select('as_shift_id', $shiftList, $employee->as_shift_id, ['placeholder'=>'Select Shift', 'id'=>'as_shift_id',  'style'=>'width:100%']) }} 
                                    </div>
                                </div> 
                            </div>
                           
                            <!-- ENDS OF WORKER INFORMATION -->
                            @if($cost_mapping_area_status == false)
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="area_map_checkbox"></label>
                                <div class="checkbox col-sm-4">
                                    <label class="col-xs-12" style="padding-left: 10px;">
                                        <input name="area_map_checkbox" id="area_map_checkbox" type="checkbox" class="ace"/>
                                        <span class="lbl">&nbsp;&nbsp;&nbsp;Assign for Cost Mapping(Area)</span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_area_id">Area </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_area_id', $areaList, $employee->as_area_id, ['placeholder'=>'Area Name', 'id'=>'as_area_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}  
                                </div>
                            </div>
     
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_department_id" >Department Name </label>
                                <div class="col-sm-4">
                                    {{ Form::select('as_department_id', $departmentList, $employee->as_department_id, ['placeholder'=>'Department Name', 'id'=>'as_department_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Department field is required']) }} 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_section_id" >Section Name </label>
                                <div class="col-sm-4">
                                    {{ Form::select('as_section_id', $sectionList, $employee->as_section_id, ['placeholder'=>'Section Name', 'id'=>'as_section_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Section field is required']) }}  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_subsection_id" > Sub Section Name</label>
                                <div class="col-sm-4">
                                    {{ Form::select('as_subsection_id', $subsectionList, $employee->as_subsection_id, ['placeholder'=>'Sub Section Name', 'id'=>'as_subsection_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Section field is required']) }}  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_doj"> Date of Joining </label>
                                <div class="col-sm-9">
                                    <input type="date" name="as_doj" id="as_doj" placeholder="Date of Joining" class="col-xs-10 col-sm-5" data-validation="required" data-validation-format="mm-dd-yyyy" autocomplete="off" value="{{ $employee->as_doj }}" />
                                </div>
                            </div>

                            <input type="hidden" name="temp_id" value="{{ $employee->temp_id }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="associate_id"> Associate's ID </label>
                                <div class="col-sm-9">
                                    <input name="associate_id" type="text" id="associate_id" placeholder="Associate's ID" class=" col-xs-10 col-sm-5" data-validation="required length alphanumeric" data-validation-length="10" data-validation-error-msg="Alphanumeric Associate's ID required with exactly 10 characters" readonly value="{{ $employee->associate_id }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_name"> Associate's Name </label>
                                <div class="col-sm-9">
                                    <input name="as_name" type="text" id="as_name" placeholder="Associate's Name" class="col-xs-10 col-sm-5" data-validation="required length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="3-64" data-validation-error-msg="The Associate's Name has to be an alphabet value between 3-64 characters" value="{{ $employee->as_name }}" />
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="gender"> Gender </label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('as_gender', 'Male', (($employee->as_gender=="Male")?true:false), ['class'=>'ace' ,'data-validation'=>'required']) }}
                                            <span class="lbl" value="Male"> Male</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('as_gender', 'Female', (($employee->as_gender=="Female")?true:false), ['class'=>'ace']) }}
                                            <span class="lbl" value="Female"> Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_dob"> Date of Birth </label>
                                <div class="col-sm-9">
                                    <input name="as_dob" type="text" id="as_dob" placeholder="Date of Birth" class="datepicker col-xs-10 col-sm-5" data-validation="required" data-validation-format="yyyy-mm-dd" value="{{ $employee->as_dob }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_contact"> Contact No.  </label>
                                <div class="col-sm-9">
                                    <input name="as_contact" type="text" id="as_contact" placeholder="Contact Number" class="col-xs-10 col-sm-5" data-validation="required length number" data-validation-length="1-11" value="{{ $employee->as_contact }}" />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_ot"> OT Status </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_ot', [0=>'Non OT',1=>'OT'], $employee->as_ot, ['id'=>'as_ot', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}  
                                </div>
                            </div> 

            
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="picture">Picture (jpg|jpeg|png) <br> Maximum Size: 200KB </label>
                                <div class="col-sm-2">
                                    <img id="avatar" style="width: 160px; height: 160px;" class="img-responsive" alt="profile picture" src="{{ url($employee->as_pic?$employee->as_pic:'assets/images/avatars/profile-pic.jpg') }}" />
                                    <input type="hidden" name="old_pic" value="{{ $employee->as_pic }}">
                                </div>
                                <div class="col-sm-2">
                                    <input name="as_pic" type="file" 
                                    class="dropZone"
                                    data-validation="mime size"
                                    data-validation-allowing="jpeg,png,jpg"
                                    data-validation-max-size="200kb"
                                    data-validation-error-msg-size="You can not upload images larger than 200kb"
                                    data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="status"> Status </label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('as_status', '1', (($employee->as_status=="1")?true:false), ['class'=>'ace' ,'data-validation'=>'required']) }}
                                            <span class="lbl"> Active</span>
                                        </label>
                                        <label>
                                            {{ Form::radio('as_status', '2', (($employee->as_status=="2")?true:false), ['class'=>'ace']) }}
                                            <span class="lbl"> Resign</span>
                                        </label>
                                        <label>
                                            {{ Form::radio('as_status', '3', (($employee->as_status=="3")?true:false), ['class'=>'ace']) }}
                                            <span class="lbl"> Terminate</span>
                                        </label>
                                        <label>
                                            {{ Form::radio('as_status', '4', (($employee->as_status=="4")?true:false), ['class'=>'ace']) }}
                                            <span class="lbl"> Suspend</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_remarks"> Remarks </label>
                                <div class="col-sm-8">
                                    <textarea name="as_remarks" id="as_remarks" class="form-control">{{ $employee->as_remarks }}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_oracle_code"> Oracle Code </label>
                                <div class="col-sm-9">
                                    <input name="as_oracle_code" type="text" id="as_oracle_code" placeholder="Oracle Code" class="col-xs-10 col-sm-5" data-validation="required length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="1-20" data-validation-error-msg="The Oracle Code has to be an alphabet value between 1-20 characters" value="{{ $employee->as_oracle_code }}" data-validation-optional="true" />
                                </div>
                            </div> 


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_rfid_code"> RFID Code </label>
                                <div class="col-sm-9">
                                    <input name="as_rfid_code" type="text" id="as_rfid_code" placeholder="RFID Code" class="col-xs-10 col-sm-5" data-validation="required length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="1-20" data-validation-error-msg="The RFID Code has to be an alphabet value between 1-20 characters" value="{{ $employee->as_rfid_code }}" data-validation-optional="true" />
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
                </div> 
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
 
<script type="text/javascript">
$(document).ready(function()
{    

    /*
    |-------------------------------------------------- 
    | ENGLISH
    |-------------------------------------------------- 
    */
    var unit= $("#as_unit_id");
    var floor= $("#as_floor_id");
    var line = $("#as_line_id");
    var shift = $("#as_shift_id");
    unit.on("change",function(){
        $.ajax({
            url : "{{ url('hr/timeattendance/get_floor_by_unit') }}",
            type: 'get',
            data: {unit: unit.val() },
            success: function(data)
            {
                floor.html(data); 
                line.html('');
                shift.html(''); 
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
    floor.on("change",function(){
        $.ajax({
            url : "{{ url('hr/setup/getLineListByFloorID') }}",
            type: 'get',
            data: {unit_id: unit.val(), floor_id: floor.val() },
            success: function(data)
            {
                line.html(data);
                shift.html(''); 
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
    line.on("change",function(){
        $.ajax({
            url : "{{ url('hr/setup/getShiftListByLineID') }}",
            type: 'get',
            data: {unit_id: unit.val(), floor_id: floor.val(), line_id: line.val() },
            success: function(data)
            {
                shift.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

    //Load Department List By Area ID
    var area       = $("#as_area_id");
    var department = $("#as_department_id");
    var date_of_joining = $("#as_doj");
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
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
 

    //Load Section List By Department & Area ID
    var area       = $("#as_area_id");
    var department = $("#as_department_id")
    var section    = $("#as_section_id");
    var date_of_joining = $("#as_doj");
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
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

    //Load Sub Section List By Area ID, Department & Section
    var area       = $("#as_area_id");
    var department = $("#as_department_id")
    var section    = $("#as_section_id");
    var subsection    = $("#as_subsection_id");
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



    $('.dropZone').ace_file_input({  
        style: 'well',
        btn_choose: 'Drop files here or click to choose',
        btn_change: null,
        no_icon: 'ace-icon fa fa-cloud-upload',
        droppable: true,
        thumbnail: 'fit'//large | fit
        //,icon_remove:null //set null, to hide remove/reset button
        ,before_change:function(files, dropped) {  
            var fileType = ["image/png", "image/jpg", "image/jpeg"]; 

            if ((files[0].size <= 524288) && (jQuery.inArray(files[0].type, fileType) != '-1'))
            { 
                return true;
            }
            else
            {
                return false;
            }
        } 
    }).on('change', function(){
        // console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });

  
    /*
    |-------------------------------------------------- 
    | BANGLA 
    |-------------------------------------------------- 
    */

    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            type: 'get',
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
    //Make unit Floor Line Required if the Unit Cost Mapping Checkbox is checked
    $("#unit_map_checkbox").on("click",function(){
        var unit_check_status= $(this).prop('checked');
        var emp_type= $('#as_emp_type_id :selected').val();
        if(unit_check_status && emp_type != 1){
            floor.attr({'data-validation':"required"});
            line.attr({'data-validation':"required"});
        }
        if(!unit_check_status){
            floor.removeAttr("data-validation");
            line.removeAttr("data-validation");
        }
    });  
    //Make Area, Department, Section, Sub-Section Required if the Area Cost Mapping Checkbox is checked
    $("#area_map_checkbox").on("click",function(){
        var area_check_status= $(this).prop('checked');
        var emp_type= $('#as_emp_type_id :selected').val();
        if(area_check_status && emp_type != 1){
            section.attr({'data-validation':"required"});
            subsection.attr({'data-validation':"required"});
        }
        if(!area_check_status){
            section.removeAttr("data-validation");
            subsection.removeAttr("data-validation");
            
        }
    });
});
 
</script>
 
@endsection