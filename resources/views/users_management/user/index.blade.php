@inject('request', 'Illuminate\Http\Request')

@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">User Management</a>
                </li>  
                <li class="active">User List</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>User Management<small> <i class="ace-icon fa fa-angle-double-right"></i> User List </small></h1>
            </div> 
 
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Associate ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Unit Permission</th>
                                <th>Roles</th>
                                <th>Buyer Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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
        ajax: {
            url: '{!! url("users_management/user/data") !!}',
            type: "POST",
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
            {data: 'serial_no', name: 'serial_no'}, 
            {data: 'associate_id', name: 'associate_id'}, 
            {data: 'name', name: 'name'}, 
            {data: 'email',  name: 'email'}, 
            {data: 'units', name: 'units'},  
            {data: 'roles', name: 'roles'}, 
            {data: 'buyer', name: 'buyer'},  
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ], 
    }); 
}); 
</script>
@endsection
