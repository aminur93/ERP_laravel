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
                <li class="active">BTB(Machinery) List</li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import<small> <i class="ace-icon fa fa-angle-double-right"></i>BTB(Machinery) List</small></h1>
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
                                <th>Item</th>
                                <th>L/C Status</th>
                                <th>L/C No</th>
                                <th>L/C Date</th>
                                <th>Inco. Term</th>
                                <th>S. Code</th>
                                <th>L/C Type</th>
                                <th>Period</th>
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
    var searchable = [1,4,5,7];
    var selectable = [2,3,6,8,9];

    var dropdownList = { 
        '2' :['Fabric', 'Accessories', 'Fabric+Accessories'],
        '3' :['Foreign', 'Local'],
        '6' :['USD','EUR','GBP','AUD','BDT','BRR','CAD','CNY','FRF','DEM','INR','IDR','ITL','JPY','MYR','NLG','NZD','NOK','PKR','PHP','RUR','SAR','SGD','SEK','CHF','TWD','TRL','XAU','XAG','XPT','XPD'],
        '8' :[@foreach($typeList as $e) <?php echo "\"$e\"," ?> @endforeach],
        '9' :[@foreach($periodList as $e) <?php echo "\"$e\"," ?> @endforeach]
    };

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        ajax: '{!! url("comm/import/ilc/machinery_list_data") !!}',
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
            { data: 'serial_no', name: 'serial_no' }, 
            { data: 'machinery_pi_fileno', name: 'machinery_pi_fileno' }, 
            { data: 'b2b_machinery_item',  name: 'b2b_machinery_item' }, 
            { data: 'b2b_machinery_lc_status', name: 'b2b_machinery_lc_status' }, 
            { data: 'b2b_machinery_lc_no', name: 'b2b_machinery_lc_no' }, 
            { data: 'b2b_machinery_date', name: 'b2b_machinery_date' }, 
            { data: 'b2b_machinery_inco_term', name: 'b2b_machinery_inco_term' }, 
            { data: 'b2b_machinery_sup_code', name: 'b2b_machinery_sup_code' }, 
            { data: 'b2b_machinery_lc_type', name: 'b2b_machinery_lc_type' }, 
            { data: 'lc_period_id', name: 'lc_period_id' }, 
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
