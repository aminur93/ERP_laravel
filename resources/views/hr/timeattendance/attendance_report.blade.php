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
                    <a href="#"> Time & Attendance </a>
                </li>
                <li class="active"> Attendance Report </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Attendance Report </small></h1>
            </div>
            <form class="widget-container-col" role="form" id="attendanceReport" method="get" action="#">
                <div class="widget-box ui-sortable-handle">
                    <div class="widget-body">
                        <div class="row" style="padding: 10px 20px">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="associate_id">Associate</label>
                                    <div class="col-sm-8">
                                        {{ Form::select('associate_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate_id', 'class'=> 'associates no-select col-xs-12']) }}  
                                    </div>
                                </div>
                            </div> 

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="unit"> Unit </label>
                                    <div class="col-sm-9"> 
                                        {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit',  'class'=>'form-control', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="report_from"> From</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="report_from" id="report_from" class="col-xs-12" data-validation="required"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="report_to"> To</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="report_to" id="report_to" class="col-xs-12" data-validation="required"/>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="widget-header">
                        <h4 class="row" style="padding:0px 53px">
                            <div class="col-sm-11 text-right" style="">
                                <span style="font-size: 16px; font-weight: bold; color: red;" id="over_time"></span>
                            </div>

                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary btn-sm attendanceReport">
                                <i class="fa fa-search"></i>
                                Search
                                </button>
                            </div>
                        </h4>
                    </div>
                </div>
            </form>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Associate ID</th>
                                    <th>Name</th>
                                    <th>Shift</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Over Time</th>
                                </tr>
                            </thead>
                        </table>
                    </div> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
            <!-- div for summary -->
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){ 

    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
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

    var searchable = [1,2,3,4,5,6,7];
    var selectable = []; //use 4,5,6,7,8,9,10,11,....and * for all 
    var dropdownList = {};
    
    var dTable =  $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true, 
        scroller: {
            loadingIndicator: true
        },
        pagingType: "full_numbers",
        ajax: {
            url: '{!! url("hr/timeattendance/attendance_report_data") !!}',
            data: function (d) {
                d.associate_id  = $('#associate_id').val(), 
                d.report_from = $('#report_from').val(), 
                d.report_to   = $('#report_to').val(),
                d.unit        = $('#unit').val()
            },
            type: "get",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        },
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
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, 
            { data: 'associate_id',  name: 'associate_id' }, 
            { data: 'as_name', name: 'as_name' }, 
            { data: 'hr_shift_name', name: 'hr_shift_name' }, 
            { data: 'att_date', name: 'att_date' }, 
            { data: 'in_punch', name: 'in_punch' },  
            { data: 'out_punch', name: 'out_punch' },  
            { data: 'ot', name: 'ot' } 
        ],  
        initComplete: function () {   
            var api =  this.api();

            // Apply the search 
            api.columns(searchable).every(function () {
                var column = this; 
                var input = document.createElement("input"); 
                input.setAttribute('placeholder', $(column.header()).text());

                $(input).appendTo($(column.header()).empty())
                .on('keyup', function () {
                    column.search($(this).val(), false, false, true).draw();
                });

                $('input', this.column(column).header()).on('click', function(e) {
                    e.stopPropagation();
                });
            });
 
            // each column select list
            api.columns(selectable).every( function (i, x) {
                var column = this; 

                var select = $('<select><option value="">'+$(column.header()).text()+'</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function(e){
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search(val ? val : '', true, false ).draw();
                        e.stopPropagation();
                    });

                // column.data().unique().sort().each( function ( d, j ) {
                // if(d) select.append('<option value="'+d+'">'+d+'</option>' )
                // });
                $.each(dropdownList[i], function(j, v) {
                    select.append('<option value="'+v+'">'+v+'</option>')
                }); 
            });
        }  
    });
 

    $('#attendanceReport').on('submit', function(e) 
    {  
        e.preventDefault();
        var from= $("#report_from").val();
        var to= $("#report_to").val();
        var unit= $("#unit").val();
        if(to == "" || from == "" || unit == "")
        {
            alert("Please Select Following Field");
        }
        else{
            dTable.draw();
        }
    });
        //Main Categorywise Subcategory
    // $(".attendanceReport").on('click', function()
    // {
    //     var associate_id  = $('#associate_id').val(); 
    //     var report_from = $('#report_from').val(); 
    //     var report_to  = $('#report_to').val();
    //     var unit       = $('#unit').val();
        
    //     $.ajax({
    //         url: '{{ url("hr/timeattendance/attendance_summary") }}',
    //         type: 'json',
    //         method: 'get',
    //         data: { associate_id, report_from, report_to, unit},
    //         success: function (data) {
    //             $("#over_time").text("Total OT:  "+data);
    //         },
    //         error: function()
    //         {
    //             alert("failed!!");
    //         }
    //     }); 
    // });  
});
</script>
@endsection
