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
                <li class="active">Add Employee</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Add Employee</small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                <div class="col-sm-12">
                <h5 style="color: red">*All fields are required</h5>
                    <div id="english" class="tab-pane fade {{ (empty(Session::get('bn_flag'))?'in active':null) }}">
                        <br/>
                        {{ Form::open(['url'=>'hr/recruitment/employee/add_employee', 'files' => true, 'class'=>'form-horizontal']) }}

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_emp_type_id"> Employee Type </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_emp_type_id', $employeeTypes, null, ['placeholder'=>'Select Employee Type', 'id'=>'as_emp_type_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Employee Type field is required']) }}  
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_designation_id" >Designation </label>
                                <div class="col-sm-4">
                                    <select name="as_designation_id" id="as_designation_id" style="width:100%" data-validation="required" data-validation-error-msg='The Designation field is required'>
                                        <option value="">Designation </option> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_unit_id"> Unit </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'as_unit_id',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                                </div>
                            </div>

                            <!-- WORKER INFORMATION -->
                            <div class="hide" id="as_emp_type_info"> 
         
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="as_floor_id"> Floor </label>
                                    <div class="col-sm-4"> 
                                        {{ Form::select('as_floor_id', [], null, ['placeholder'=>'Select Floor', 'id'=>'as_floor_id',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Floor field is required']) }}  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="as_line_id"> Line </label>
                                    <div class="col-sm-4"> 
                                        {{ Form::select('as_line_id', [], null, ['placeholder'=>'Select Line', 'id'=>'as_line_id', 'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Line field is required']) }}  
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="as_shift_id"> Shift </label>
                                    <div class="col-sm-4"> 
                                        {{ Form::select('as_shift_id', [], null, ['placeholder'=>'Select Shift', 'id'=>'as_shift_id', 'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Shift field is required']) }}  
                                    </div>
                                </div> 
                            </div> 
                            <!-- ENDS OF WORKER INFORMATION -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_area_id"> Select Area </label>
                                <div class="col-sm-4"> 
                                    {{ Form::select('as_area_id', $areaList, null, ['placeholder'=>'Area Name', 'id'=>'as_area_id', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}  
                                </div>
                            </div>
     
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_department_id" >Department Name </label>
                                <div class="col-sm-4">
                                    <select name="as_department_id" id="as_department_id" style="width:100%" data-validation="required" data-validation-error-msg='The Department field is required'>
                                        <option value="">Department Name </option> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_section_id" >Section Name </label>
                                <div class="col-sm-4">
                                    <select name="as_section_id" id="as_section_id" style="width:100%" data-validation="required" data-validation-error-msg='The Section field is required'>
                                        <option value="">Section Name </option> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_subsection_id" > Sub Section Name</label>
                                <div class="col-sm-4">
                                    <select name="as_subsection_id" id="as_subsection_id" style="width:100%" data-validation="required" data-validation-error-msg='The Sub Section field is required'>
                                        <option value="">Sub Section Name </option> 
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_doj"> Date of Joining </label>
                                <div class="col-sm-9">
                                    <input type="text" name="as_doj" id="as_doj" placeholder="Date of Joining" class="GenerateID col-xs-10 col-sm-5" data-validation="required" data-validation-format="yyyy-mm-dd" autocomplete="off" readonly/>
                                </div>
                            </div>

                            <input type="hidden" name="temp_id">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="associate_id"> Associate's ID </label>
                                <div class="col-sm-9">
                                    <input name="associate_id" type="text" id="associate_id" placeholder="Associate's ID" class=" col-xs-10 col-sm-5" data-validation="required length alphanumeric" data-validation-length="10" data-validation-error-msg="Alphanumeric Associate's ID required with exactly 10 characters" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_name"> Associate's Name </label>
                                <div class="col-sm-9"> 
                                    <input name="as_name" type="text" id="as_name" placeholder="Associate's Name" class="col-xs-10 col-sm-5" data-validation="required length custom" data-validation-regexp="^([./,-;:'&a-z A-Z]+)$" data-validation-length="3-64" data-validation-error-msg="The Associate's Name has to be an alphabet value between 3-64 characters" style='text-transform:uppercase'/> 
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_ot"> OT / Non OT </label>
                                <div class="col-sm-4">
                                    <select name="as_ot" id="as_ot" style="width:100%" data-validation="required" data-validation-error-msg="Overtime status is required">
                                        <option value="0">Non OT</option>
                                        <option value="1">OT</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="gender"> Gender </label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('as_gender', 'Male', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                            <span class="lbl" value="Male"> Male</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('as_gender', 'Female', false, ['class'=>'ace']) }}
                                            <span class="lbl" value="Female"> Female</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('as_gender', 'third_gender', false, ['class'=>'ace']) }}
                                            <span class="lbl" value="Third Gender"> Third Gender</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_dob"> Date of Birth </label>
                                <div class="col-sm-9">
                                    <input name="as_dob" type="text" id="as_dob" placeholder="Date of Birth" class="date_of_birth col-xs-10 col-sm-5" data-validation="required" data-validation-format="yyyy-mm-dd" readonly />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="as_contact"> Contact No.  </label>
                                <div class="col-sm-9">
                                    <input name="as_contact" type="text" id="as_contact" placeholder="01XXXXXXXXX" class="col-xs-10 col-sm-5" data-validation="required length number" data-validation-length="11"/>
                                </div>
                            </div>

            
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="picture">Picture (jpg|jpeg|png) <br> Maximum Size: 200KB</label>
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


                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-info" type="button">
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
                    </div> 
                </div> 
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>





<!-- Modal -->
<!-- <div class="modal fade" id="imageResizeGuideline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image Resize Guideline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe 
            src='{{ url('assets/files/imageGuide/ImageResizeGuide.pdf') }}' 
            width='100%' 
            height='400px' 
            marginwidth='0'
            marginheight='0'  
            frameborder='0' 
            fullscreen="yes"
            scrolling='yes' > 
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div> -->
 
<script type="text/javascript">
$(document).ready(function()
{   

    // //Current Date on Joining Date
    // $('#as_department_id').on('change',function(){
    //     var d = new Date()
    //     month = '' + (d.getMonth() + 1);
    //     day = '' + d.getDate();
    //     year = d.getFullYear();

    //     if (month.length < 2) month = '0' + month;
    //     if (day.length < 2) day = '0' + day;

    //     var cur_date= [year, month, day].join('-');
    //     alert(cur_date);
    //     $('#as_doj').val(cur_date);
    // });


    /*
    |-------------------------------------------------- 
    | ID GENERATOR
    |-------------------------------------------------- 
    */
    // Chnage Joining date 
    var date_of_joining = $("#as_doj");
    var generated_id    = $("#associate_id");
    var temp_id         = $("input[name=temp_id]");
    var department_id   = $("#as_department_id");
    $(".GenerateID").datepicker({
        autoclose: true, 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        // minDate: '-18Y',  
        maxDate: '+0Y',
        onSelect: function(date, instance) 
        {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('id/generate') }}",
                type: 'post',
                dataType: 'json',
                data: { date: date, department: department_id.val() }, 
                success: function(data)
                {
                    if (data.id)
                    {
                        generated_id.empty().val(data.id);
                        temp_id.empty().val(data.temp);
                        generated_id.next('span').remove();
                    }
                    else
                    {
                        temp_id.empty();
                        generated_id.empty();
                        generated_id.next('span').remove();
                        generated_id.parent().append("<span class='text-danger'>"+data.error+"<span>");
                    }

                },
                error: function(xhr)
                {
                    temp_id.empty();
                    generated_id.empty();
                    generated_id.next('span').remove();
                    generated_id.parent().append("<span class='text-danger'>"+xhr.status+"! "+xhr.statusText+"<span>");
                } 
            });
        }
    });


 


    /*
    |-------------------------------------------------- 
    | ENGLISH
    |-------------------------------------------------- 
    */

    // show hide employee information
    var emp_type_id    = $("#as_emp_type_id");
    var emp_type_info  = $("#as_emp_type_info");
    var designation    = $("#as_designation_id");
    emp_type_id.on("change", function(){ 
        if ($(this).val() == "3")
        {
            emp_type_info.removeClass('hide');
        }
        else
        {
            emp_type_info.addClass('hide');
            $("#as_unit_id").val("");
            $("#as_floor_id").val("");
            $("#as_line_id").val("");
            $("#as_shift_id").val("");
        } 

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
    var area       = $("#as_area_id");
    var department = $("#as_department_id");
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

 
    // HR Floor By Unit ID
    var unit  = $("#as_unit_id");
    var floor = $("#as_floor_id")
    unit.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getFloorListByUnitID') }}",
            type: 'get',
            data: {unit_id: $(this).val() },
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


    // Show Line List by Floor ID
    var unit  = $("#as_unit_id");
    var floor = $("#as_floor_id");
    var line  = $("#as_line_id");
    floor.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getLineListByFloorID') }}",
            type: 'get',
            data: { unit_id: unit.val(), floor_id: $(this).val() },
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


    // Show Shift List by Line ID
    var unit  = $("#as_unit_id");
    var floor = $("#as_floor_id");
    var line = $("#as_line_id");
    var shift  = $("#as_shift_id");
    line.on('change', function(){
        $.ajax({
            url : "{{ url('hr/setup/getShiftListByLineID') }}", 
            type: 'get',
            data: {
                unit_id: unit.val(),
                floor_id: floor.val(),
                line_id: $(this).val(),
            },
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
}); 
</script> 
@endsection