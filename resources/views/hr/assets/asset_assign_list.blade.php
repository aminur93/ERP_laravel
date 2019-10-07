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
                    <a href="#">Asset Management</a>
                </li> 
                <li class="active">Asset Assing List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Asset Management<small><i class="ace-icon fa fa-angle-double-right"></i> Asset Assing List </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS --> 
                        <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Associate ID</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Serial</th>
                                    <th>Assign Date</th>
                                    <th>Return Date</th> 
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
        
        ajax: {
            url: '{!! url("hr/assets/assign_data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        },
        columns: [  
            { data: 'serial_no', name: 'serial_no' }, 
            { data: 'associate_id', name: 'associate_id' }, 
            { data: 'fin_asset_cat_name',  name: 'fin_asset_cat_name' }, 
            { data: 'fin_asset_product_name', name: 'fin_asset_product_name' }, 
            { data: 'fin_asset_serial', name: 'fin_asset_serial' }, 
            { data: 'hr_asset_assign_date', name: 'hr_asset_assign_date' }, 
            { data: 'hr_asset_return_date', name: 'hr_asset_return_date' },  
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],  
    }); 
});
</script>
@endsection