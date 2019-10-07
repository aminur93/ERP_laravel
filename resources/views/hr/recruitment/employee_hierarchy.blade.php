@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li> 
				<li>
					<a href="#">Recruitment</a>
				</li>
				<li>
					<a href="#">Employer</a>
				</li>
				<li class="active">Employee Hierarchy</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
 			<div class="page-header">
                <h1>Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Employee Hierarchy</small></h1>
			</div>           
			<div class="row"> 
				<div class="col-xs-12">
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Department</th>
								<th>Designation</th> 
								<th>Unit</th> 
								<th>Employee Type</th>
							</tr>
						</thead>  
					</table>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{  
	var searchable = [];
	var selectable = [4]; 
	var dropdownList = {
		'4' :[@foreach($employeeTypes as $e) <?php echo "'$e'," ?> @endforeach],
	};

    $('#dataTables').DataTable({
    	order: [],  
	    processing: true,
	    responsive: true,
	    serverSide: true,
        pagingType: "full_numbers", 
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
	    ajax: '{!! url("hr/recruitment/employee/hierarchy_data") !!}',
	    columns: [    
	        {data:'name',  name: 'name', orderable: false}, 
	        {data:'hr_department_name', name: 'hr_department_name', orderable: false}, 
	        {data:'hr_designation_name', name: 'hr_designation_name', orderable: false}, 
	        {data:'hr_unit_name', name: 'hr_unit_name', orderable: false}, 
	        {data:'hr_emp_type_name', name: 'hr_emp_type_name', orderable: false}, 
	    ],  
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

				// column.data().unique().sort().each( function ( d, j ) {
				// if(d) select.append('<option value="'+d+'">'+d+'</option>' )
			 	// });
				$.each(dropdownList[i], function(j, v) {
					select.append('<option value="'+v+'">'+v+'</option>')
				}); 
			});
        }  
	}); 
});
</script>
@endsection