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
                    <a href="#">Import</a>
                </li>
                <li class="active">BTB(Asset/Other) List</li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import<small> <i class="ace-icon fa fa-angle-double-right"></i>BTB(Asset/Other) List</small></h1>
            </div>

            <div class="row">
                 <!-- Display Erro/Success Message -->
                    @include('inc/message')
                <div class="col-xs-12 table-responsive">
                    <!-- PAGE CONTENT BEGINS -->
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>File No</th>
                                <th>Supplier</th>
                                <th>L/C No</th>
                                <th>L/C Status</th>
                                <th>L/C Date</th>
                                <th>L/C Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl.</th>
                                <th>File No</th>
                                <th>Supplier</th>
                                <th>L/C No</th>
                                <th>L/C Status</th>
                                <th>L/C Date</th>
                                <th>L/C Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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

    var searchable = [1,3,5];
    var selectable = [2,4,6,7];

    var dropdownList = { 
        '2' :[@foreach($supplierList as $e) <?php echo "\"$e\"," ?> @endforeach],
        '4' :['Foreign', 'Local'],
        '6' :[@foreach($typeList as $e) <?php echo "\"$e\"," ?> @endforeach],
        '7' :['Active','Cancel']

    };

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        ajax: '{!! url("commercial/import/ilc/asset_list_data") !!}',
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
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, 
            { data: 'file_no', name: 'file_no' }, 
            { data: 'sup_name',  name: 'sup_name' }, 
            { data: 'lc_no', name: 'lc_no' }, 
            { data: 'lc_status', name: 'lc_status' }, 
            { data: 'lc_date', name: 'lc_date' },
            { data: 'lc_type_name', name: 'lc_type_name' }, 
            { data: 'lc_active_status', name: 'lc_active_status' }, 
            { data: 'action', name: 'action', orderable: false, searchable: false }
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
 
            // each column select list
            api.columns(selectable).every( function (i, x) {
                var column = this; 

                var select = $('<select><option value="">'+$(column.header()).text()+'</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function(e){
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search(val ? val : '', true, false ).draw();
                        e.stopPropagation();
                    });

                $.each(dropdownList[i], function(j, v) {
                    select.append('<option value="'+v+'">'+v+'</option>')
                }); 
            });
        }   
    }); 
});
</script>
@endsection
