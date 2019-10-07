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
                    <a href="#">Export </a>
                </li>
				<li class="active">Contract Sales List</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i> Contract Sales List </small></h1>
            </div>

            @include('inc/message')
			<div class="row">
				<div class="col-xs-12 table-responsive">
					<table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Export LC / Contract No</th>
                                <th>Buyer</th>
                                <th>Unit</th>
                                <th>Contract Number By</th>
                                <th>Contract Qty</th>
                                <th>ELC Date</th>
                                <th>LC Type</th>
                                <th>Action</th>
                        </thead>
						<tfoot>
							<tr>
								<th>SL</th>
                                <th>Export LC / Contract No</th>
                                <th>Buyer</th>
                                <th>Unit</th>
                                <th>Contract Number By</th>
                                <th>Contract Qty</th>
                                <th>ELC Date</th>
                                <th>LC Type</th>
                                <th>Action</th>
						</tfoot>
					</table>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    var searchable = [1,4,5,6];
    var selectable = [2,3,7];

    var dropdownList = {

        '2' :[@foreach($buyer as $e) <?php echo "\"$e\"," ?> @endforeach],
        '3' :[@foreach($unit as $e) <?php echo "\"$e\"," ?> @endforeach],
        '7' :['ELC', 'Contract'],
    };

    $('#dataTables').DataTable({
    	order: [], //reset auto order
	    processing: true,
	    responsive: false,
	    serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
	    ajax: '{!! url("commercial/export/sales_contract/sales_contract_get_data") !!}',
	    columns: [
	        {data: 'serial_no', name: 'serial_no'},
	        {data: 'lc_contract_no',  name: 'lc_contract_no'},
	        {data: 'b_name', name: 'b_name'},
	        {data: 'hr_unit_name', name: 'hr_unit_name'},
	        {data: 'contract_no_by',  name: 'contract_no_by'},
	        {data: 'contract_qty', name: 'contract_qty'},
            {data: 'elc_date', name: 'elc_date'},
            {data: 'lc_contract_type', name: 'lc_contract_type'},
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
