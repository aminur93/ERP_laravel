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
                    <a href="#">Performance </a>
                </li>
                <li >
                    <a href="#"> Operation </a>
                </li>
                <li class="active"> Disciplinary Record List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Performance <small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Disciplinary Record List</small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    </br>
                    <!-- Display Erro/Success Message -->
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL. No</th>
                                <th>Offender ID</th>
                                <th>Griever ID</th>
                                <th>Reason</th>
                                <th>Action</th>
                                <th>Requested Remedy</th>
                                <th>Discussed Date</th>
                                <th>Date of Execution</th> 
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
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
        ajax: '{!! url("hr/performance/operation/disciplinary_data") !!}',
        columns: [  
            { data: 'serial_no', name: 'serial_no' }, 
            { data: 'offender',  name: 'offender' }, 
            { data: 'griever',  name: 'griever' }, 
            { data: 'issue',  name: 'issue' }, 
            { data: 'step', name: 'step' }, 
            { data: 'dis_re_req_remedy', name: 'dis_re_req_remedy' }, 
            { data: 'discussed_date', name: 'discussed_date' }, 
            { data: 'date_of_execution', name: 'date_of_execution' }, 
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],  
    }); 
});
</script>
@endsection