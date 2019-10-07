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
                <li>
                    <a href="#"> UD System </a>
                </li>
                <li class="active"> List </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> UD System List</small></h1>
            </div>
            @include('inc/message')

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>File No.</th>
                                <th>UD No.</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>BGMEA Ref.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>File No.</th>
                                <th>UD No.</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>BGMEA Ref.</th>
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

    var searchable = [1,3,4,5,6];
    var selectable = [2];

    var dropdownList = {
        '2' :[@foreach($fileList as $e) <?php echo "\"$e\"," ?> @endforeach]
    };

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
        ajax: '{!! url("comm/import/ud_master/list_data") !!}',
        columns: [
            {data: 'id'},
            {data: 'file_no'},
            {data: 'ud_no'},
            {data: 'ud_date'},
            {data: 'remarks'},
            {data: 'bgmea_remarks'},
            {data: 'action', orderable: false, searchable: false}
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
