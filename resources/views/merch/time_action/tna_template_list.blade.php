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
					<a href="#">Time & Action </a>
				</li>
				<li class="active">TNA Template List</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
            <div class="page-header">
                <h1>Style & Library <small><i class="ace-icon fa fa-angle-double-right"></i> TNA Template List </small></h1>
            </div>
            <div class="widget-header text-right">
                    <div class="col-sm-12">
                        <a href="{{ url('merch/time_action/tna_template') }}" class="btn btn-primary btn-xs">
                            New TNA Template
                        </a>
                       
                        <a href="#" class="btn btn-info btn-xs" >
                            Create Bulk
                        </a>
                    </div>
            </div>
                               
			<div class="row"> 
				<div class="col-xs-12 table-responsive">
					<table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Type</th>
                                <th>Style No</th>
                                <th>Buyer</th>
                                <th>Product Name</th>
                                <th>Sewing</th>                        
                         <!--   <th>WASH/pc</th> -->
                                <th>Season</th>
                                <th>Action</th>
                        </thead>  
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Product Type</th>
								<th>Style No</th>
								<th>Buyer</th>
								<th>Product Name</th>
								<th>Sewing</th>					
							<!--<th>WASH/pc</th> -->
								<th>Season</th>
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

    var searchable = [2,4,5,6];
    var selectable = [1,3];

    var dropdownList = { 
        '1' :['Development', 'Bulk'],
        '3' :[@foreach($buyerList as $e) <?php echo "\"$e\"," ?> @endforeach],
        '8' :[@foreach($seasonList as $e) <?php echo "\"$e\"," ?> @endforeach]
    };

    $('#dataTables').DataTable({
    	order: [], //reset auto order
	    processing: true,
	    responsive: false,
	    serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
	    ajax: '{!! url("merch/style/tna_template_data") !!}',
	    columns: [   
	        {data: 'serial_no', name: 'serial_no'}, 
	        {data: 'prd_type_name',  name: 'prd_type_name'}, 
	        {data: 'stl_no', name: 'stl_no'}, 
	        {data: 'b_name', name: 'b_name'}, 
	        {data: 'stl_product_name',  name: 'stl_product_name'}, 
	        {data: 'stl_smv', name: 'stl_smv'},
            {data: 'se_name', name: 'se_name'}, 
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