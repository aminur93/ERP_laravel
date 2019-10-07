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
                    <a href="#">Recruitment</a>
                </li>
                <li>
                    <a href="#">Operation</a>
                </li>
                <li class="active">Medical Incident List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment<small><i class="ace-icon fa fa-angle-double-right"></i> Operation  <i class="ace-icon fa fa-angle-double-right"></i> Medical Incident List </small></h1>
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
                                    <th>Sl. No</th>
                                    <th>Associate ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Incident Details</th>
                                    <th>Doctors Name</th>
                                    <th>Doctors Recommendation</th>
                                    <th>Supporting File </th>
                                    <th>Company's Action</th>
                                    <th>Allowance</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                        </table>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->

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
        ajax: '{!! url("hr/ess/medical_incident_data") !!}',
        ajax: {
            url: '{!! url("hr/ess/medical_incident_data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        }, 
        dom: "<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-4 text-center'B><'col-sm-3'f>>tp", 
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
            { data: 'serial_no', name: 'serial_no' }, 
            { data: 'hr_med_incident_as_id', name: 'hr_med_incident_as_id' }, 
            { data: 'hr_med_incident_as_name',  name: 'hr_med_incident_as_name' }, 
            { data: 'hr_med_incident_date', name: 'hr_med_incident_date' }, 
            { data: 'hr_med_incident_details', name: 'hr_med_incident_details' }, 
            { data: 'hr_med_incident_doctors_name', name: 'hr_med_incident_doctors_name' }, 
            { data: 'hr_med_incident_doctors_recommendation', name: 'hr_med_incident_doctors_recommendation' }, 
            { data: 'file', name: 'file' }, 
            { data: 'hr_med_incident_action', name: 'hr_med_incident_action' }, 
            { data: 'hr_med_incident_allowance', name: 'hr_med_incident_allowance'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],  
    }); 
});
</script>
@endsection