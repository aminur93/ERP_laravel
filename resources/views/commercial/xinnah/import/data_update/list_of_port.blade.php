@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Commercial</a>
                </li>  
                <li>
                    <a href="#"> Import </a>
                </li>
                <li class="#"> Import Data Update </li>
                <li class="active">List of Consignment port </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">  
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> List of Consignment port </small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5>List of Consignment port <a href="{{URL::to('comm/import/import-data-update/consignment/port')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Consignment port</a></h5> </div>
                <div class="panel-body">
                @include('inc/message')
                               
                    <div class="row"> 
                        <div class="col-xs-12 table-responsive">
                            <table id="dataTables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File No.</th>
                                        <th>Value</th>
                                        <th>Package</th>
                                        <th>Transport Doc</th>
                                        <th>Agent name</th>
                                        <th>Bank submission date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>  
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File No.</th>
                                        <th>Value</th>
                                        <th>Package</th>
                                        <th>Transport Doc</th>
                                        <th>Agent name</th>
                                        <th>Bank submission date</th>
                                        <th>Action</th>
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
@include('commercial.xinnah.import.data_update.delete_modal') 
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
        ajax: '{!! url("comm/import/import-data-update/consignment-port-list-data") !!}',
        columns: [  
            {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
            {data: 'file_no', name: 'file_no'}, 
            {data: 'value', name: 'value'}, 
            {data: 'package', name: 'package'}, 
            {data: 'transp_doc_no1', name: 'transp_doc_no1'}, 
            {data: 'agent_name', name: 'agent_name'}, 
            {data: 'port_bank_sub_date', name: 'port_bank_sub_date'},
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