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
                    <a href="#">Notifcation</a>
                </li>
                <li>
                    <a href="#">Leave Application List</a>
                </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Notification <small><i class="ace-icon fa fa-angle-double-right"></i> Leave Application List </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS --> 
                        <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Sl. No</th> -->
                                    <th>Associate ID</th>
                                    <th>Name</th>
                                    <th>Leave Type</th>
                                    <th>Leave Duration</th>
                                    <!-- <th>Supporting File</th> -->
                                    <th>Associate's Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){ 

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: true,
        serverSide: true,
        pagingType: "full_numbers",
        ajax: '{!! url("hr/notification/leave/leave_app_data") !!}',
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
            // { data: 'serial_no', name: 'serial_no' }, 
            { data: 'leave_ass_id', name: 'leave_ass_id' }, 
            { data: 'as_name',  name: 'as_name' }, 
            { data: 'leave_type', name: 'leave_type' }, 
            { data: 'leave_duration', name: 'leave_duration' }, 
            // { data: 'hr_leave_file', name: 'hr_leave_file' }, 
            { data: 'leave_comment', name: 'leave_comment' }, 
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],  
    }); 
});
</script>
@endsection