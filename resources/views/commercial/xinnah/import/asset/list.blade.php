@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li> 
                <li>
                    <a href="#"> Import </a>
                </li>
                <li class="#"> Asset </li>
                <li class="active"> Others PI Entry list </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">  
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Others PI Entry list</small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5> List of Others PI Entry <a href="{{URL::to('comm/import/asset/others-pi-entry/create')}}" class="btn btn-success btn-xs"> <i class="fa fa-plus"></i> Others PI Entry create</a></h5> </div>
                <div class="panel-body">
                @include('inc/message')
                               
                    <div class="row"> 
                        <div class="col-xs-12 table-responsive">
                            <table id="dataTables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File No.</th>
                                        <th>Unit</th>
                                        <th>Item</th>
                                        <th>P.I No</th>
                                        <th>P.I Date</th>
                                        <th>Supplier</th>
                                        <th>Active PI</th>
                                        <th>PI Status</th>
                                        <th>PI Last Ship Date</th>
                                        <th width="80px">Action</th>
                                    </tr>
                                </thead>  
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File No.</th>
                                        <th>Unit</th>
                                        <th>Item</th>
                                        <th>P.I No</th>
                                        <th>P.I Date</th>
                                        <th>Supplier</th>
                                        <th>Active PI</th>
                                        <th>PI Status</th>
                                        <th>PI Last Ship Date</th>
                                        <th width="80px">Action</th>
                                    </tr>
                                </tfoot>  
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
@include('commercial.xinnah.import.asset.delete_modal')
<script type="text/javascript">
$(document).ready(function(){ 

    var searchable = [1,2,4,6];
    var selectable = [3,5,7,8];

    

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        ajax: '{!! url("comm/import/asset/load-data-others-pi-entry") !!}',
        columns: [  
            {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
            {data: 'file_no', name: 'file_no'}, 
            {data: 'hr_unit_name', name: 'hr_unit_name'}, 
            {data: 'cm_item_name', name: 'cm_item_name'}, 
            {data: 'pi_no', name: 'pi_no'}, 
            {data: 'pi_date', name: 'pi_date'}, 
            {data: 'sup_name', name: 'sup_name'},
            {data: 'active_pi', name: 'active_pi'},
            {data: 'pi_status', name: 'pi_status'},
            {data: 'pi_last_ship_date', name: 'pi_last_ship_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],  
        buttons: [  
            {
                extend: 'copy', 
                className: 'btn-sm btn-info',
                exportOptions: {
                    columns: ':visible'
                },
                header: false, 
                footer: true 
            }, 
            {
                extend: 'csv', 
                className: 'btn-sm btn-success',
                exportOptions: {
                    columns: ':visible'
                },
                header: false, 
                footer: true
            }, 
            {
                extend: 'excel', 
                className: 'btn-sm btn-warning',
                exportOptions: {
                    columns: ':visible'
                },
                header: false, 
                footer: true 
            }, 
            {
                extend: 'pdf', 
                className: 'btn-sm btn-primary', 
                exportOptions: {
                    columns: ':visible'
                },
                header: false, 
                footer: true
            }, 
            {
                extend: 'print', 
                className: 'btn-sm btn-default',
                exportOptions: {
                    columns: ':visible'
                },
                header: false, 
                footer: true 
            } 
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
        }  
    }); 
}); 
</script>

@push('js')
 <script>
    
    function deleteData(id) {
        $("#actionType").val('delete');
        $("#rowId").val(id);
        $('#action_modal').modal();
    }
 </script>   
@endpush
@endsection