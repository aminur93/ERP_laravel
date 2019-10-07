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
                    <a href="#">Reports</a>
                </li>
                <li class="active"> Salary Sheet</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 

            <div class="page-header">
                <h1>Reports<small><i class="ace-icon fa fa-angle-double-right"></i> Salary Sheet(Custom)</small></h1>
            </div>
            {{-- choice 1 --}}
            <div class="panel panel-info">
              <div class="panel-body" >
                <div class="radio">
                  <label><input type="radio" id="choice" class="choice" name="choice" value="choice_1" checked>Individual</label>
                </div>
                <hr>
                <div class="row choice_1_div" id="choice_1_div" name="choice_1_div">
                    <div class="col-sm-5 no-padding">
                        <label class="col-sm-4 control-label no-padding-right align-left" for="emp_id">Employee Select<span class="text-red">&#42;</span>  {{-- <span style="color: red">&#42;</span> --}}</label>
                        <div class="col-sm-8">
                            <select name="as_id" class="form-control" required>
                                <option value=""> - select - </option>
                                @foreach($getEmployees as $employee)
                                <option value="{{$employee->associate_id}}">{{$employee->associate_id}} - {{$employee->as_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-red" id="error_ac_id_f"></span>
                        </div>    
                    </div>
                    <div class="col-sm-2 no-padding">
                        <label class="col-sm-4 control-label no-padding-right align-left" for="month_number">Form<span class="text-red">&#42;</span></label>
                        <div class="col-sm-7">
                            <input type="text" name="form-date" id="form-date" class="col-xs-12 monthYearpicker" value="" data-validation="required" placeholder=" Month-Year" /> 
                            <span class="text-red" id="error_form_date_f"></span> 
                        </div>
                    </div>
                    <div class="col-sm-2 no-padding">
                        <label class="col-sm-4 control-label no-padding-right align-left" for="month_number">To<span class="text-red">&#42;</span></label>
                        <div class="col-sm-7">
                            <input type="text" name="to-date" id="to-date" class="col-xs-12 monthYearpicker" value="" data-validation="required" placeholder=" Month-Year" />
                            <span class="text-red" id="error_to_date_f"></span>  
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button onclick="individual()" class="btn btn-primary choice_1_generate_btn" id="choice_1_generate_btn" name="choice_1_generate_btn" style="height: 28px; 
                        border: none; 
                        color: white; 
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        padding-top: 3px;
                        font-size: 12px;
                        cursor: pointer;" ><span class="glyphicon glyphicon-pencil"></span>&nbsp Generate</button>
                    </div>
                    
                </div>
                
            </div>
        </div>
        {{-- Choice 2 --}}
        <div class="panel panel-info">
          <div class="panel-body" >
            <div class="radio">
              <label><input type="radio" id="choice" class="choice" name="choice" value="choice_2" >Multiple Filter</label>
            </div>
            
            <hr>
            <div class="row choice_2_div" id="choice_2_div" name="choice_2_div">
                {{Form::open( ["url"=>"#", "class"=>"form-horizontal col-xs-12"] )}}
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right align-left" for="unit"> Unit<span class="text-red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit', 'style'=>'width:100%;', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}
                                <span class="text-red" id="error_unit_s"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right align-left" for="floor"> Floor </label>
                            <div class="col-sm-9">
                                {{ Form::select('floor', !empty(Request::get('unit'))?$floorList:[], Request::get('floor'), ['placeholder'=>'Select Floor', 'id'=>'floor', 'style'=>'width:100%']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right align-left" for="area"> Area<span class="text-red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('area', $areaList, Request::get('area'), ['placeholder'=>'Select Area', 'id'=>'area', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}
                                <span class="text-red" id="error_area_s"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right align-left" for="salary_range">Sal. Range  {{-- <span style="color: red">&#42;</span> --}}</label>
                            <div class="col-sm-9">
                                <div class="col-sm-6 no-padding">
                                    <input type="number" name="min_sal" id="min_sal" class="col-xs-12 min_sal" placeholder="Min Salary" value="{{ $salaryMin }}" min="{{ $salaryMin}}" max="{{ $salaryMax}}">
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="number" name="max_sal" id="max_sal" class="col-xs-12 max_sal" placeholder="Max Salary" value="{{ $salaryMax }}" min="{{ $salaryMin}}" max="{{ $salaryMax}}">
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-righta align-left" for="department">Department<span class="text-red">&#42;</span> </label>
                            <div class="col-sm-8">
                                {{ Form::select('department', !empty(Request::get('area'))?$deptList:[], Request::get('department'), ['placeholder'=>'Select Department ', 'id'=>'department', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Department field is required']) }}
                                <span class="text-red" id="error_department_s"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="department">Section </label>
                            <div class="col-sm-8">
                                {{ Form::select('section', !empty(Request::get('department'))?$sectionList:[], Request::get('section'), ['placeholder'=>'Select Section ', 'id'=>'section', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-optional' =>'true', 'data-validation-error-msg'=>'The Department field is required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="department">Sub-Section </label>
                            <div class="col-sm-8">
                                {{ Form::select('sub_section', !empty(Request::get('section'))?$subSectionList:[], Request::get('subSection'), ['placeholder'=>'Select Sub-Section ', 'id'=>'subSection', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-optional' =>'true', 'data-validation-error-msg'=>'The Department field is required']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="ot_range" >OT Range {{-- <span style="color: red">&#42;</span> --}}</label>
                            <div class="col-sm-8">
                                <select id="ot_range" name="ot_range" class="col-xs-12 ot_range">
                                    <option value="">Select OT Range</option>
                                    <option value="2">Maximum 2 Hours</option>
                                    <option value="4">Maximum 4 Hours</option>
                                </select>  
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right align-left" for="month_number">Month<span class="text-red">&#42;</span> {{-- <span style="color: red">&#42;</span> --}}</label>
                            <div class="col-sm-7">
                                <select id="month_number" name="month_number" class="col-xs-12 month_number">
                                    <option value="">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <span class="text-red" id="error_month_s"></span>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right align-left" for="year">Year<span class="text-red">&#42;</span> {{-- <span style="color: red">&#42;</span> --}}</label>
                            <div class="col-sm-7">
                                <input type="number" id="year" class="col-xs-12 year" placeholder="Enter Year" name="year"> 
                                <span class="text-red" id="error_year_s"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right align-left" for="disbursed_date">Disbursed Date{{-- <span style="color: red">&#42;</span> --}}</label>
                            <div class="col-sm-7">
                                <input type="date" id="disbursed_date" class="col-xs-12 disbursed_date" name="disbursed_date" placeholder="Enter Disbursed Date" name="year" > 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right align-left" for="employee_status_id" > Employee Status<span class="text-red">&#42;</span>{{-- <span style="color: red">&#42;</span> --}}</label>
                            <div class="col-sm-7">
                                <select id="employee_status" name="employee_status" class="col-xs-12 employee_status">
                                    <option value="">Select EMP. Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Resign</option>
                                    <option value="3">Terminate</option>
                                    <option value="4">Suspend</option>
                                </select> 
                                <span class="text-red" id="error_status_s"></span> 
                            </div>
                        </div>
                    </div>
                </form>
                {{-- Form End --}}  
                <div class="row">
                    <div class="col-sm-4"></div>                        
                    <div class="col-sm-4"></div>                        
                    <div class="col-sm-4">
                        <div class="col-sm-5"></div>    
                        <div class="col-sm-7">
                            <button onclick="multiple()" class="btn btn-primary choice_2_generate_btn pull-right" id="choice_2_generate_btn" name="choice_2_generate_btn" 
                            style=" height: 28px;
                            margin-right: 8%; 
                            border: none; 
                            color: white; 
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            padding-top: 3px;
                            font-size: 12px;
                            cursor: pointer;" ><span class="glyphicon glyphicon-pencil"></span>&nbsp 
                        Generate</button>
                    </div>
                </div>                        
            </div>
        {{-- </form>   --}}
                    {{-- ...form_end ...
                        if the Generate button need to use with form submission --}}

                    </div> {{-- row-end #choice_2_div  --}}

                </div>
            </div>

            {{-- result of list --}}
            <div class="panel panel-warning" id="salary-sheet-result" style="display: none">
              <div class="panel-heading">Salary sheet result  &nbsp;<button rel='tooltip' data-tooltip-location='left' data-tooltip='Salary sheet result print' type="button" onClick="printMe('result-show')" class="btn btn-primary btn-xs text-right"><i class="fa fa-print"></i> Print</button></div>
              <div class="panel-body" id="result-show">
                
              </div>
            </div>


      </div>  {{-- page-content end --}}
  </div>  {{-- main-content-inner end --}}
</div>  {{-- main-content end --}}

@push('js')
<script type="text/javascript">
   $(window).load(function() {
    var choice = "choice_1";
    sectionOption(choice);


    $('body').on('change','.choice',function(){
        choice = $(this).val(); 
        sectionOption(choice);
    });



});

   function sectionOption(x){
    if(x=="choice_1"){
        $("#choice_1_div *").prop('disabled',false);
        $("#choice_2_div *").prop('disabled',true);
    }
    else{
        $("#choice_1_div *").prop('disabled',true);
        $("#choice_2_div *").prop('disabled',false);
    }
}
</script>

{{-- submit individual --}}
<script>
    var _token = $('input[name="_token"]').val();
    function individual() {
        $("#salary-sheet-result").show();
        var as_id = $('select[name="as_id"]').val();
        var form_date = $('input[name="form-date"]').val();
        var to_date = $('input[name="to-date"]').val();
        var flug = true;
        if(as_id == ''){
            $('#error_ac_id_f').html('<label class="control-label status-label" for="inputError">* Employee not empty</label>');
            flug = false;
        }else{
            $('#error_ac_id_f').html('');
            flug = true;
        }

        if(form_date == ''){
            flug = false;
            $('#error_form_date_f').html('<label class="control-label status-label" for="inputError">* From date not empty</label>');
        }else{
            flug = true;
            $('#error_form_date_f').html('');
        }

        if(to_date == ''){
            flug = false;
            $('#error_to_date_f').html('<label class="control-label status-label" for="inputError">* To date not empty</label>');
        }else{
            flug = true;
            $('#error_to_date_f').html('');
        }
        //console.log(as_id);
        if(flug == true){
            $('html, body').animate({
                scrollTop: $("#result-show").offset().top
            }, 2000);
            $("#result-show").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');

            setTimeout(() => {
                $.ajax({
                    url: url+'/hr/reports/salary-sheet-custom-individual-search',
                    type: "GET",
                    data: { 
                      _token : _token,
                      as_id : as_id,
                      form_date : form_date,
                      to_date : to_date
                    },
                    success: function(response){
                    //console.log(response);
                        //$("#result-show").html(response);
                        if(response !== 'error'){
                            $("#result-show").html(response);
                        }
                    }
                });
            }, 1000); 
        }
        
    }

    // Reuseable ajax function
    function ajaxOnChange(ajaxUrl, ajaxType, valueObject, successStoreId) {           
        $.ajax({
            url : ajaxUrl,
            type: ajaxType,
            data: valueObject,
            success: function(data)
            {
                successStoreId.html(data); 
            },
            error: function()
            {
                alert('failed...');
            }
        });            
    }
    // HR Floor By Unit ID
    var unit = $("#unit");
    var floor = $("#floor")
    unit.on('change', function() {
        ajaxOnChange('{{ url('hr/setup/getFloorListByUnitID') }}', 'get', {unit_id: $(this).val()}, floor);
    });

    //Load Department List By Area ID
    var area = $("#area");
    var department = $("#department");
    area.on('change', function() {
        ajaxOnChange('{{ url('hr/setup/getDepartmentListByAreaID') }}', 'get', {area_id: $(this).val()}, department);            
    });

    //Load Section List by department
    var section = $("#section");
    department.on('change', function() {
        ajaxOnChange('{{ url('hr/setup/getSectionListByDepartmentID') }}', 'get', {area_id: area.val(), department_id: $(this).val()}, section);
    });

    //Load Sub Section List by Section
    var subSection = $("#subSection");

    section.on('change', function() {
        ajaxOnChange('{{ url('hr/setup/getSubSectionListBySectionID') }}', 'get', {area_id: area.val(), department_id: department.val(), section_id: $(this).val()}, subSection);
    });

    //multiple salary sheet
    function multiple() {
        $("#salary-sheet-result").show();
        var unit = $('select[name="unit"]').val();
        var floor = $('select[name="floor"]').val();
        var area = $('select[name="area"]').val();
        var department = $('select[name="department"]').val();
        var sectionF = $('select[name="section"]').val();
        var sub_section = $('select[name="sub_section"]').val();
        var ot_range = $('select[name="ot_range"]').val();
        var month = $('select[name="month_number"]').val();
        var employee_status = $('select[name="employee_status"]').val();
        var min_sal = $('input[name="min_sal"]').val();
        var max_sal = $('input[name="max_sal"]').val();
        var year = $('input[name="year"]').val();
        var disbursed_date = $('input[name="disbursed_date"]').val();
        
        var flug = true;
        if(unit == ''){
            $('#error_unit_s').html('<label class="control-label status-label" for="inputError">* Unit not empty</label>');
            flug = false;
        }else{
            $('#error_unit_s').html('');
            flug = true;
        }

        if(area == ''){
            flug = false;
            $('#error_area_s').html('<label class="control-label status-label" for="inputError">* Area not empty</label>');
        }else{
            flug = true;
            $('#error_area_s').html('');
        }

        if(department == ''){
            flug = false;
            $('#error_department_s').html('<label class="control-label status-label" for="inputError">* Department not empty</label>');
        }else{
            flug = true;
            $('#error_department_s').html('');
        }

        if(month == ''){
            flug = false;
            $('#error_month_s').html('<label class="control-label status-label" for="inputError">* Month not empty</label>');
        }else{
            flug = true;
            $('#error_month_s').html('');
        }
        if(year == ''){
            flug = false;
            $('#error_year_s').html('<label class="control-label status-label" for="inputError">* Year not empty</label>');
        }else{
            flug = true;
            $('#error_year_s').html('');
        }
        if(employee_status == ''){
            flug = false;
            $('#error_status_s').html('<label class="control-label status-label" for="inputError">* Status not empty</label>');
        }else{
            flug = true;
            $('#error_status_s').html('');
        }
        //console.log(as_id);
        if(flug == true){
            $('html, body').animate({
                scrollTop: $("#result-show").offset().top
            }, 2000);
            $("#result-show").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');

            setTimeout(() => {
                $.ajax({
                    url: url+'/hr/reports/salary-sheet-custom-multi-search',
                    type: "GET",
                    data: { 
                      _token : _token,
                      unit : unit,
                      floor : floor,
                      area : area,
                      department : department,
                      section : sectionF,
                      sub_section : sub_section,
                      ot_range : ot_range,
                      month : month,
                      year : year,
                      employee_status : employee_status,
                      min_sal : min_sal,
                      max_sal : max_sal,
                      disbursed_date : disbursed_date
                    },
                    success: function(response){
                    //console.log(response);
                    
                        if(response !== 'error'){
                            $("#result-show").html(response);
                        }
                    }
                });
            }, 1000); 
        }
    }
</script>
@endpush


@endsection