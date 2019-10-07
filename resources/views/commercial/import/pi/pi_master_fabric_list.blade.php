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
                    <a href="#"> Proforma Invoice </a>
                </li>
                <li class="active">PI Master Fabric List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">  
            <div class="page-header">
                <h1>Proforma Invoice <small><i class="ace-icon fa fa-angle-double-right"></i> PI Master Fabric List </small></h1>
            </div>
            @include('inc/message')
                               
            <div class="row"> 
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PI No</th>
                                <th>File No</th>
                                <th>Supplier</th>
                                <th>PI Date</th>
                                <th>PI Category</th>
                                <th>PI Last Date</th>
                                <th>Ship Mode</th>
                                <th>PI Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>  
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>PI No</th>
                                <th>File No</th>
                                <th>Supplier</th>
                                <th>PI Date</th>
                                <th>PI Category</th>
                                <th>PI Last Date</th>
                                <th>Ship Mode</th>
                                <th>PI Status</th>
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

    var searchable = [1,2,4,6];
    var selectable = [3,5,7,8];

    var dropdownList = { 
        '3' :[@foreach($buyerList as $e) <?php echo "\"$e\"," ?> @endforeach],
        '5' :['Foreign', 'Local'],
        '7' :['Sea', 'Air', 'Road'],
        '8' :['Active', 'Inactive'],
    };

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        ajax: '{!! url("commercial/import/pi/master_fabric_list_data") !!}',
        columns: [  
            {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
            {data: 'pi_no', name: 'pi_no'}, 
            {data: 'file_no', name: 'file_no'}, 
            {data: 'sup_name', name: 'sup_name'},
            {data: 'pi_date', name: 'pi_date'}, 
            {data: 'pi_category', name: 'pi_category'}, 
            {data: 'pi_last_date', name: 'pi_last_date'}, 
            {data: 'ship_mode', name: 'ship_mode'}, 
            {data: 'pi_status', name: 'pi_status'}, 
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