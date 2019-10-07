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
                    <a href="#"> Payroll  </a>
                </li>
                <li class="active"> Salary </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1> Payroll <small> <i class="ace-icon fa fa-angle-double-right"></i>Salary</small></h1>
            </div>

            <div class="row">
                <form role="form" method="get" action="#" id="shiftRoasterForm">
                    <div class="col-xs-12">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="year"> Year</label>
                                <div class="col-sm-9">
                                    <input type="text" name="year" id="year" placeholder="Select Year" class="col-xs-12 yearpicker" data-validation="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="month"> Month</label>
                                <div class="col-sm-9">
                                    <input type="text" name="month" id="month" placeholder="Select Month" class="col-xs-12 monthpicker" data-validation="required"/>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-xs-12" style="margin-top:20px">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="unit"> Unit </label>
                                <div class="col-sm-9"> 
                                    {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit', 'style'=>'width:100%;', 'data-validation'=>'required']) }}  
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
                    </form>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
               
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Monthly Salary</th>
                                <th>Absent Days</th>
                                <th>OT</th>
                                <th>Payable Salary</th>
                            </tr>
                        <thead> 
                        <tbody>
                        <tbody> 
                    </table>
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

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: false,
        responsive: true,
        serverSide: false,
        pagingType: "full_numbers", 
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
        ]  
    }); 
});
</script>
@endsection