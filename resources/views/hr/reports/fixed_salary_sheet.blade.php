@extends('hr.index')
@push('css')
  <style>
    .zeroPadding{ padding: 0px; }
      
  </style>
  
@endpush
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
                    <a href="#"> Reports </a>
                </li>
                <li class="active">Fixed Salary Sheet</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <?php $type='fixed_salary'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Fixed Salary Sheet</small></h1>
            </div>
            <div class="row">
                <div class="col-sm-12" >
                    <div class="form-group">
                        <div class="col-sm-3 col-xs-3" >
                            <label class="col-sm-4 control-label no-padding-left" for="unit"> Unit : </label>
                            <div class="col-sm-8" style="padding: 0px;"> 
                                {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <label class="col-sm-4 control-label" for="floor"> Floor : </label>
                            <div class="col-sm-8" style="padding: 0px;"> 
                                {{ Form::select('floor', !empty(Request::get('unit'))?$floorList:[], Request::get('floor'), ['placeholder'=>'Select Floor', 'id'=>'floor',  'style'=>'width:100%']) }}   
                            </div>
                          
                         </div>
                         <div class="col-sm-3 col-xs-3" style="padding: 0px;">
                            <label class="col-sm-4 control-label" for="area"> Area : </label>
                            <div class="col-sm-8" style="padding: 0px;"> 
                                {{ Form::select('area', $areaList, Request::get('area'), ['placeholder'=>'Select Area', 'id'=>'area', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Area field is required']) }}  
                            </div>
                         </div>  
                         <div class="col-sm-3 col-xs-3" style="padding: 0px;">
                            <label class="col-sm-5 control-label" for="area"> Department : </label>
                            <div class="col-sm-7" style="padding: 0px;"> 
                                {{ Form::select('department', !empty(Request::get('area'))?$deptList:[], Request::get('department'), ['placeholder'=>'Select Department ', 'id'=>'department', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Department field is required']) }}   
                            </div>
                         </div>                  
                   
                    </div>
                </div><!--First row end-->
                <div class="col-sm-12" style="padding-top:20px; " >
                    <div class="form-group">
                        <div class="col-sm-3 col-xs-3" >
                            <label class="col-sm-4 control-label no-padding-left" for="unit"> Section : </label>
                            <div class="col-sm-8" style="padding: 0px;"> 
                              {{ Form::select('section', !empty(Request::get('department'))?$sectionList:[], Request::get('section'), ['placeholder'=>'Select Section ', 'id'=>'section', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-optional' =>'true', 'data-validation-error-msg'=>'The Section field is required']) }}   
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <label class="col-sm-4 control-label" for="floor"> Sub-Section : </label>
                            <div class="col-sm-8" style="padding: 0px;"> 
                                {{ Form::select('subSection', !empty(Request::get('section'))?$subSectionList:[], Request::get('subSection'), ['placeholder'=>'Select Sub-Section ', 'id'=>'subSection', 'style'=> 'width:100%', 'data-validation'=>'required', 'data-validation-optional' =>'true', 'data-validation-error-msg'=>'The Department field is required']) }}  
                            </div>
                          
                         </div>
                         <div class="col-sm-3 col-xs-3" style="padding: 0px;">
                            <label class="col-sm-4 control-label" for="start_date">Month : </label>
                            <div class="col-sm-8" style="padding: 0px;"> 
                                 
                                 <input type="text" name="start_date" id="start_date" class="monthpicker form-control" value="" data-validation="required" placeholder="Month" autocomplete="off" />
 
                            </div>
                         </div>  
                         <div class="col-sm-3 col-xs-3" style="padding: 0px;">
                            <label class="col-sm-5 control-label" for="end_date">Year : </label>
                            <div class="col-sm-7" style="padding: 0px;"> 
                                
                                 <input type="text" name="end_date" id="end_date" class="yearpicker form-control" value="" data-validation="required" placeholder="Year" autocomplete="off" />

                            </div>
                         </div>

                    </div>

                  </div><!--2nd row end-->

                  <div class="col-sm-12" style="padding-top:20px;padding-right: 0px; " >
                    <div class="form-group pull-right">
                       <div class="col-sm-3 col-xs-3">
                            <button type="submit" id="generate"class="btn btn-primary btn-sm ">
                                <i class="fa fa-gear"></i>
                                Generate
                            </button>                         
                            <!-- <button type="button" onClick="printMe('PrintArea')" class="showprint btn btn-warning btn-sm " title="Print">
                                <i class="fa fa-print"></i>
                           </button>
                            
                            <button type="button"  id="excel"  class="showprint btn btn-success btn-sm" title="Excel"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                           </button>      -->                    
                       </div>
                    </div>
                </div><!--3rd row end-->    
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12" id="PrintArea">
                    <!-- PAGE CONTENT BEGINS -->
              
                 <div id="html-2-pdfwrapper" style="margin:20px auto"> 
                      <div  id="form-element">
                        <!--Table here--->

                      </div> 
                  
                 </div> 
                  <div id="loading" class="col-md-offset-4 text-center col-sm-4" style="margin-top:10%;">
                 
                   <i class="fa fa-spinner fa-pulse fa-5x" ></i>

                  </div>
                  
                <!-- PAGE CONTENT ENDS -->
               
                <!-- /.col -->
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
</div>
<script type="text/javascript">
function printMe(divName)
{ 
    var myWindow=window.open('','','width=800,height=800');
    myWindow.document.write(document.getElementById(divName).innerHTML); 
    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();
}

$(document).ready(function(){ 
  $('.showprint').hide();

  // excel conversion -->
  $('#excel').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
        location.href=url
        return false
    })

  // Result Table Based on Search Element
    var basedon = $("#generate");  
    var action_place = $("#form-element");

    basedon.on("click", function(){ 

        var un_id = $("#unit").val();
        var month = $("#start_date").val();
        var year = $("#end_date").val();

      // check if #extra-OT div already exist then remove 

          if($('#extra-OT').length)   
          {
            $('#extra-OT').remove(); 
          }
         
 
      // Url for Extra OT 
        $.ajax({
            url : "{{ url('hr/reports/fixed_salary_list') }}",
            type: 'get',
            data: {
                unitId :un_id, 
                floor:$("#floor").val(),
                area:$("#area").val(),
                department:$("#department").val(),
                section:$("#section").val(),
                subSection:$("#subSection").val(),
                fromMonth:month, 
                toYear:year
              },
            // Loader 
                beforeSend: function(){
                   $('#loading').show();
                  },
                complete: function(){
                    $('#loading').hide();
                   }, 

            success: function(data)
            { 
                $('#wait').show();               

                action_place.html(data);
                $('#wait').hide();
                $('.showprint').show(); //show print button
            },
            error: function()
            {
                alert('Not Found...');
            }
        });

    });
 // HR Floor By Unit ID
        var unit  = $("#unit");
        var floor = $("#floor")
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


        //Load Department List By Area ID
        var area       = $("#area");
        var department = $("#department"); 
        area.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getDepartmentListByAreaID') }}",
                type: 'get',
                data: {area_id: $(this).val() },
                success: function(data)
                {
                    department.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });

        //Load Section List by department
        var section= $("#section");

        department.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getSectionListByDepartmentID') }}",
                type: 'get',
                data: {area_id: area.val(), department_id: $(this).val() },
                success: function(data)
                {
                    section.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });

        //Load Sub Section List by Section
        var subSection= $("#subSection");

        section.on('change', function(){
            $.ajax({
                url : "{{ url('hr/setup/getSubSectionListBySectionID') }}",
                type: 'get',
                data: {area_id: area.val(), department_id: department.val(), section_id: $(this).val() },
                success: function(data)
                {
                    subSection.html(data); 
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });



  
///
});

// Radio button action
  function attLocation(loc){
    window.location = loc;
   }
</script>
@endsection
