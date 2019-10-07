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
                    <li class="#"> Import Data</li>

                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>Import Data <small></small></h1>
                </div>
                <!---Form 1---------------------->
                <div class="row">
                    @include('inc/message')

                    <div class="col-xs-12 table-responsive">
                        <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Bank</th>
                                <th>Status</th>
                                <th>Tranpost Doc No</th>
                                <th>Transport Doc Date</th>
                                <th>Value</th>
                                <th>Quantity</th>
                                <th>File No</th>
                                <th>Unit</th>
                                <th>ILC No.</th>
                                <th>Supplier</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Bank</th>
                                <th>Status</th>
                                <th>Tranpost Doc No</th>
                                <th>Transport Doc Date</th>
                                <th>Value</th>
                                <th>Quantity</th>
                                <th>File No</th>
                                <th>Unit</th>
                                <th>ILC No.</th>
                                <th>Supplier</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

//            var searchable = [2,4,5];
//            var selectable = [1,3,6];

            $('#dataTables').DataTable({
                //reset auto order
                processing: true,
                responsive: false,
                serverSide: true,
                pagingType: "full_numbers",
                dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
                ajax: {
                    url: '{!!  url("comm/import/importdata/importdataviews") !!}',
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'bank_name',  name: 'bank_name'},
                    {data: 'imp_lc_type', name: 'imp_lc_type'},
                    {data: 'transp_doc_no1', name: 'transp_doc_no1'},
                    {data: 'transp_doc_date',  name: 'transp_doc_date'},
                    {data: 'value', name: 'value'},
                    {data: 'qty', name: 'qty'},
                    {data: 'file_no', name: 'file_no'},
                    {data: 'hr_unit_name', name: 'hr_unit_name'},
                    {data: 'cm_btb_id', name: 'cm_btb_id'},
                    {data: 'sup_name', name: 'sup_name'},
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
                        autoPrint: true,
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

//                    // Apply the search
//                    api.columns(searchable).every(function () {
//                        var column = this;
//                        var input = document.createElement("input");
//                        input.setAttribute('placeholder', $(column.header()).text());
//
//                        $(input).appendTo($(column.header()).empty())
//                            .on('keyup', function () {
//                                column.search($(this).val(), false, false, true).draw();
//                            });
//
//                        $('input', this.column(column).header()).on('click', function(e) {
//                            e.stopPropagation();
//                        });
//                    });

//                    // each column select list
//                    api.columns(selectable).every( function (i, x) {
//                        var column = this;
//
//                        var select = $('<select><option value="">'+$(column.header()).text()+'</option></select>')
//                            .appendTo($(column.header()).empty())
//                            .on('change', function(e){
//                                var val = $.fn.dataTable.util.escapeRegex(
//                                    $(this).val()
//                                );
//                                column.search(val ? val : '', true, false ).draw();
//                                e.stopPropagation();
//                            });
//
//                        $.each(dropdownList[i], function(j, v) {
//                            select.append('<option value="'+v+'">'+v+'</option>')
//                        });
//                    });
                }
            });
        });
    </script>
@endsection