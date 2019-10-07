@extends('merch.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Merchandising</a>
				</li>  
				<li>
					<a href="#"> Style & Library </a>
				</li>
				<li class="active">Style History</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
            <div class="page-header">
                <h1>Style & Library <small><i class="ace-icon fa fa-angle-double-right"></i> Style History </small></h1>
            </div>
                               
			<div class="row"> 
				<div class="col-xs-12 table-responsive">
					<table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Production Type</th>
                                <th>Style Code</th>
                                <th>Style No</th>
                                <th>Description</th>
                                <th>IP Address</th>
                                <th>MAC Address</th>
                                <th>Asscociate ID</th>
                                <th>Date</th>
                            </tr>
                        </thead>  
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Production Type</th>
                                <th>Style Code</th>
								<th>Style No</th>
								<th>Description</th>
                                <th>IP Address</th>
								<th>MAC Address</th>
								<th>Asscociate ID</th>
								<th>Date</th>
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

    var searchable = [2,3,5,6,7,8];
    var selectable = [1,4];

    var dropdownList = { 
        '1' :['Development', 'Bulk'],
        '4' :['Create', 'Update', 'Delete'],
    };

    $('#dataTables').DataTable({
    	order: [], //reset auto order
	    processing: true,
	    responsive: false,
	    serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
	    ajax: '{!! url("merch/stylelibrary/style_history_data") !!}',
	    columns: [   
	        {data: 'serial_no', name: 'serial_no'}, 
	        {data: 'stl_order_type',  name: 'stl_order_type'}, 
            {data: 'stl_code', name: 'stl_code'}, 
	        {data: 'stl_no', name: 'stl_no'}, 
	        {data: 'stl_history_desc', name: 'stl_history_desc'}, 
	        {data: 'stl_history_ip',  name: 'stl_history_ip'}, 
	        {data: 'stl_history_mac', name: 'stl_history_mac'}, 
	        {data: 'stl_history_userid', name: 'stl_history_userid'}, 
	        {data: 'stl_history_datetime',  name: 'stl_history_datetime'}, 
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