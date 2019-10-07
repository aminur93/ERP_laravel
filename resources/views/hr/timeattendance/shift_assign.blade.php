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
                    <a href="#"> Time & Attendance </a>
                </li>
                <li class="active"> Shift Assign </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Shift Assign</small></h1>
            </div>
                @include('inc/message')
            <form role="form" method="POST" action="{{ url('hr/timeattendance/shift_assign') }}" enctype="multipart/form-data"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-7">

                        <!-- <div class="row" style="margin:10px 0px"> -->
                           <!--  <div class="col-sm-4">
                                {{ Form::select('emp_type', $employeeTypes, null, ['placeholder'=>'Select Employee Type', 'class'=> 'form-control filter']) }}  
                            </div>
                             -->
                             <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="emp_type">Employee Type</label>
                                    <div class="col-sm-8" style="padding-left: 15px;">
                                        {{ Form::select('emp_type', $employeeTypes, null, ['placeholder'=>'Select Employee Type', 'class'=> 'form-control filter']) }} 
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'class'=> 'form-control filter']) }}  
                            </div> -->

                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="unit">Unit</label>
                                    <div class="col-sm-8" style="padding-left: 15px;">
                                        {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit','id'=>'unit_shift', 'class'=> 'form-control filter']) }} 
                                    </div>
                                </div>
                            </div>

                          <!--   <div class="col-sm-4">
                                {{ Form::select('shift_id', $shiftList, null, ['placeholder'=>'Select Shift', 'class'=> 'form-control filter']) }}  
                            </div> -->
                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="shift_id">Current Shift</label>
                                    <div class="col-sm-8" style="padding-left: 15px;">
                                       <!--  {{ Form::select('shift_id', $shiftList, null, ['placeholder'=>'Select Shift','id'=>'current_shift', 'class'=> 'form-control filter']) }} -->
                                       <select name="shift_id" id="current_shift" class= "form-control filter" ><option value="">Select Unit First</option></select>
                                    </div>
                                </div>
                            </div>
                        <!-- </div>  -->


                        <!-- <div class="row">  -->
                           <!--  <div class="col-sm-6" style="margin:10px 0px">
                                <label class="col-sm-2 control-label no-padding-right" for="shift"> Target Shift</label>
                                <div class="col-sm-10">
                                    {{ Form::select('shift', $shiftList, null, ['placeholder'=>'Select Target Shift', 'id'=>'shift', 'style'=>'width:100%;', 'data-validation'=> 'required']) }} 
                                </div>
                            </div> -->
                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="month"> Target Shift</label>
                                    <div class="col-sm-8" style="padding-left: 15px;">
                                     <!--    {{ Form::select('shift', $shiftList, null, ['placeholder'=>'Select Target Shift', 'id'=>'shift', 'style'=>'width:100%;', 'data-validation'=> 'required']) }}  -->
                                         <select name="shift" id="shift" class= "form-control filter" data-validation='required' ><option value="">Select Unit First</option></select>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="month"> Month</label>
                                    <div class="col-sm-8" style="padding-left: 15px;">
                                        {{ Form::selectMonth('month', date("n"), ['placeholder'=>'Select Month', 'id'=>'month', 'class'=>'col-xs-12', 'data-validation'=> 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="year"> Year</label>
                                    <div class="col-sm-8">
                                        {{ Form::selectRange('year', 2018, 2030, date("Y"), ['placeholder'=>'Select Year', 'id'=>'year', 'style'=>'width:100%;', 'data-validation'=> 'required']) }}  
                                    </div>
                                </div>
                            </div>  
                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="start_day"> Start Day </label>
                                    <div class="col-sm-8" style="padding-left: 15px;"> 
                                        {{ Form::selectRange('start_day', 1, 31, date("j"), ['placeholder'=>'Select Start Day', 'id'=>'start_day', 'style'=>'width:100%;', 'data-validation'=> 'required']) }}  
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6" style="margin:10px 0px">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="end_day"> End Day </label>
                                    <div class="col-sm-8"> 
                                        {{ Form::selectRange('end_day', 1, 31, date("j"), ['placeholder'=>'Select End Day', 'id'=>'end_day', 'style'=>'width:100%;', 'data-validation'=> 'required']) }}  
                                    </div>
                                </div>
                            </div>  

                            <div class="col-sm-offset-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"></label>
                                    <div class="col-sm-8">
                                    <button type="submit" id="formSubmit" class="btn btn-primary btn-sm" style="width:95%">
                                        Assign Shift
                                    </button> 
                                    </div>
                                </div>
                            </div> 

                           <div class="col-sm-12">   <br/>
                            <h4>Shift List</h4>
                            <table id="dataTables2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                 
                                    <th>Shift Name</th>
                                    <th>Shift Code</th>
                                    <th>Shift Time</th>
                                    <th>Break Time</th>
                                 
                                  
                                </tr>
                            </thead>
                             <tbody id="shifttablerow">
                                
                            </tbody>
                         
                        </table> 
                      </div>
                    </div> 
                   

                    <!-- tables -->
                    <div class="col-sm-5">
                        <div>
                            <table id="AssociateTable" class="table header-fixed table-compact table-bordered">
                                <tehad>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"/></th>
                                        <th>Associate ID</th>
                                        <th>Name</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" id="user_filter"></th>
                                    </tr>
                                </tehad>
                                <tbody id="user_info">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
 $('#dataTables2').DataTable({
        pagingType: "full_numbers" ,
        // searching: false,
        // "lengthChange": false,
        // 'sDom': 't' 
        "sDom": '<"F"tp>'
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
    var shift    = $("select[name=shift_id]"); 
    $(".filter").on('change', function(){
        $.ajax({
            url: '{{ url("hr/timeattendance/get_associate_by_type_unit_shift") }}',
            data: {
                emp_type: emp_type.val(),
                unit    : unit.val(),
                shift   : shift.val() 
            },
            success: function(data)
            { 
                userFilter.html(data.filter);
                userInfo.html(data.result);
            },
            error:function(xhr)
            {
                console.log('Employee Type Failed');
            }
        });
    }); 
 
 
    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: true,
        serverSide: true,
        pagingType: "full_numbers",
        ajax: '{!! url("hr/timeattendance/all_leaves_data") !!}',
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        buttons: [  
            {
                extend: 'copy', 
                className: 'btn-sm btn-info',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'csv', 
                className: 'btn-sm btn-success',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'excel', 
                className: 'btn-sm btn-warning',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'pdf', 
                className: 'btn-sm btn-primary', 
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'print', 
                className: 'btn-sm btn-default',
                exportOptions: {
                    columns: ':visible'
                } 
            } 
        ], 
        columns: [ 
        ],  
    }); 
 

    var today = new Date();
    var start = today.getDate();
    var end = today.getDate();
    $('#end_day').change(function(e){
        var start= $('#start_day').val();
        var end= $('#end_day').val();
        start= parseInt(start);
        end= parseInt(end);
        if(end<start){
            alert("Shift can not end before start");
            $('#end_day').prop('selectedIndex', start);
            e.preventDefault();
        }
    });

    $('#checkAll').click(function(){
        var checked =$(this).prop('checked');
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
        var checkedBoxes = [];
        var checkedIds   = [];
        $('input[type="checkbox"]:checked').each(function() {
            if(this.value != "on")
            {
                checkedBoxes.push($(this).val());
                checkedIds.push($(this).data('id'));
            }
        });
    });

/// Target & Current Shift

    var unit= $("#unit_shift");  
    var current_shift = $("#current_shift");
    var target_shift = $("#shift");

    unit.on("change", function(){ 

        // Shift list
        $.ajax({
            url : "{{ url('hr/timeattendance/unitshift') }}",
            type: 'get',
            data: {unit_id : $(this).val()},
            success: function(data)
            {
                current_shift.html(data);
                target_shift.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });

/// Shift List On Unit Selection


    var row=$("#shifttablerow");

    unit.on("change", function(){ 

        // Shift Table
        $.ajax({
            url : "{{ url('hr/timeattendance/shifttable') }}",
            type: 'get',
            data: {unit_id : $(this).val()},
            success: function(data)
            {
                row.html(data);
              
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
///
 
    
});
</script>
@endsection