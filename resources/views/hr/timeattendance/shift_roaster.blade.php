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
                <li class="active"> Shift Roaster </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i>Shift Roaster</small></h1>
            </div>

            <div class="row">
                <form role="form" method="get" action="#" id="shiftRoasterForm">
                    <div class="col-xs-12">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="year"> Year</label>
                                <div class="col-sm-9">
                                    <input type="text" name="year" id="year" placeholder="Select Year" class="col-xs-12 yearpicker" value="{{ !empty(Request::get('year'))?Request::get('year'):null }}" data-validation="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="month"> Month</label>
                                <div class="col-sm-9">
                                    <input type="text" name="month" id="month" placeholder="Select Month" class="col-xs-12 monthpicker" value="{{ !empty(Request::get('month'))?Request::get('month'):null }}" data-validation="required"/>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-xs-12" style="margin-top:20px">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="unit"> Unit </label>
                                <div class="col-sm-9"> 
                                    {{ Form::select('unit', $unitList,  (!empty(Request::get('unit'))?Request::get('unit'):null ), ['placeholder'=>'Select Unit', 'id'=>'unit', 'style'=>'width:100%;', 'data-validation'=>'required']) }}  
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="floor"> Floor </label>
                                <div class="col-sm-9"> 
                                    <select name="floor" id="floor" style="width:100%">
                                        <option value="">Floor </option> 

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2">Sl</th>
                                <th rowspan="2">Year</th>
                                <th rowspan="2">Month</th>
                                <th rowspan="2">Line</th>
                                <th rowspan="2" style="word-wrap: break-word;">Associate</th>
                                <th colspan="31">Days</th> 
                                <th rowspan="2">Updated at</th>
                            </tr>
                            <tr> 
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>21</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th>26</th>
                                <th>27</th>
                                <th>28</th>
                                <th>29</th>
                                <th>30</th>
                                <th>31</th> 
                            </tr>
                        <thead>
                            <tbody>
                                @if(!empty($roasters))
                                    @foreach($roasters AS $row)
                                        <tr>
                                            <td>{{ $row->serial_no }}</td>
                                            <td>{{ $row->shift_roaster_year }}</td>
                                            <td>{{ date('F', mktime(0, 0, 0, $row->shift_roaster_month, 10)) }}</td>
                                            <td>{{ $row->hr_line_name }}</td>
                                            <td>{{ $row->associate_id }}</td>
                                            <td>{{ $row->day_1 }}</td>
                                            <td>{{ $row->day_2 }}</td>
                                            <td>{{ $row->day_3 }}</td>
                                            <td>{{ $row->day_4 }}</td>
                                            <td>{{ $row->day_5 }}</td>
                                            <td>{{ $row->day_6 }}</td>
                                            <td>{{ $row->day_7 }}</td>
                                            <td>{{ $row->day_8 }}</td>
                                            <td>{{ $row->day_9 }}</td>
                                            <td>{{ $row->day_10 }}</td>
                                            <td>{{ $row->day_11 }}</td>
                                            <td>{{ $row->day_12 }}</td>
                                            <td>{{ $row->day_13 }}</td>
                                            <td>{{ $row->day_14 }}</td>
                                            <td>{{ $row->day_15 }}</td>
                                            <td>{{ $row->day_16 }}</td>
                                            <td>{{ $row->day_17 }}</td>
                                            <td>{{ $row->day_18 }}</td>
                                            <td>{{ $row->day_19 }}</td>
                                            <td>{{ $row->day_20 }}</td>
                                            <td>{{ $row->day_21 }}</td>
                                            <td>{{ $row->day_22 }}</td>
                                            <td>{{ $row->day_23 }}</td>
                                            <td>{{ $row->day_24 }}</td>
                                            <td>{{ $row->day_25 }}</td>
                                            <td>{{ $row->day_26 }}</td>
                                            <td>{{ $row->day_27 }}</td>
                                            <td>{{ $row->day_28 }}</td>
                                            <td>{{ $row->day_29 }}</td>
                                            <td>{{ $row->day_30 }}</td>
                                            <td>{{ $row->day_31 }}</td>
                                            <td>{{ $row->updated_at }}</td>
                                        </tr>
                                    @endforeach

                                @endif
                            </tbody>
                    </table>
                    @if(!empty($roasters))
                    {{ $roasters->appends(request()->input())->links() }}
                    @endif
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('#unit').on("change", function(){ 
        $.ajax({
            url : "{{ url('hr/timeattendance/get_floor_by_unit') }}",
            type: 'get',
            data: {unit : $(this).val()},
            success: function(data)
            {
                $("#floor").html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $("#dataTables").DataTable({

            paging: false,

            dom: "<'row'<'col-sm-4'i><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
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
    });

    // var oTable = $('#dataTables').DataTable({
    //     order: [], 
    //     processing: true,
    //     responsive: false,
    //     serverSide: true, 
    //     paging: false,
    //     scroller: {
    //         loadingIndicator: true
    //     },
    //     ajax: {
    //         url: '{{ url("hr/timeattendance/shift_roaster_data") }}',
    //         type:'post',
    //         data : function ( d ) {
    //             return $('form').serialize();
    //         }     
    //     }, 
    //     dom: "<'row'<'col-sm-4'i><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
 
    //     columns: [ 
    //         {data: 'serial_no', name: 'serial_no'},
    //         {data: 'year', name: 'year'},
    //         {data: 'month', name: 'month'},
    //         {data: 'line', name: 'line'},
    //         {data: 'associate', name: 'associate'},
    //         {data: 'day_1', name: 'day_1', 'orderable':false}, 
    //         {data: 'day_2', name: 'day_2', 'orderable':false},
    //         {data: 'day_3', name: 'day_3', 'orderable':false},
    //         {data: 'day_4', name: 'day_4', 'orderable':false},
    //         {data: 'day_5', name: 'day_5', 'orderable':false},
    //         {data: 'day_6', name: 'day_6', 'orderable':false},
    //         {data: 'day_7', name: 'day_7', 'orderable':false},
    //         {data: 'day_8', name: 'day_8', 'orderable':false},
    //         {data: 'day_9', name: 'day_9', 'orderable':false},
    //         {data: 'day_10', name: 'day_10', 'orderable':false},
    //         {data: 'day_11', name: 'day_11', 'orderable':false},
    //         {data: 'day_12', name: 'day_12', 'orderable':false},
    //         {data: 'day_13', name: 'day_13', 'orderable':false},
    //         {data: 'day_14', name: 'day_14', 'orderable':false},
    //         {data: 'day_15', name: 'day_15', 'orderable':false},
    //         {data: 'day_16', name: 'day_16', 'orderable':false},
    //         {data: 'day_17', name: 'day_17', 'orderable':false},
    //         {data: 'day_18', name: 'day_18', 'orderable':false},
    //         {data: 'day_19', name: 'day_19', 'orderable':false},
    //         {data: 'day_20', name: 'day_20', 'orderable':false},
    //         {data: 'day_21', name: 'day_21', 'orderable':false},
    //         {data: 'day_22', name: 'day_22', 'orderable':false},
    //         {data: 'day_23', name: 'day_23', 'orderable':false},
    //         {data: 'day_24', name: 'day_24', 'orderable':false},
    //         {data: 'day_25', name: 'day_25', 'orderable':false},
    //         {data: 'day_26', name: 'day_26', 'orderable':false},
    //         {data: 'day_27', name: 'day_27', 'orderable':false},
    //         {data: 'day_28', name: 'day_28', 'orderable':false},
    //         {data: 'day_29', name: 'day_29', 'orderable':false},
    //         {data: 'day_30', name: 'day_30', 'orderable':false},
    //         {data: 'day_31', name: 'day_31', 'orderable':false}, 
    //         {data: 'updated_at', name: 'updated_at'}
    //     ],  
    // }); 
 
    // $('#shiftRoasterForm').on('submit', function(e) 
    // {  
    //     oTable.draw();
    //     e.preventDefault();
    // });




});
</script>
@endsection