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
					<a href="#">Worker</a>
				</li>
				<li class="active">Recruit List</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
 			<div class="page-header">
                <h1>Worker<small> <i class="ace-icon fa fa-angle-double-right"></i> Recruit List</small></h1>
			</div>
                               
			<div class="row"> 
				<div class="col-xs-12 table-responsive">
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
                                <th>Name</th>
                                <th>Oracle ID</th>
								<th>RFID</th>
								<th>Date of Joining</th>
								<th>Employee Type</th>
								<th>Unit</th>
								<th>Area</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Section</th>
								<th>Sub Section</th>
								<th>Gender</th>
								<th>Date of Birth</th>
								<th>OT Status</th>
								<th>Contact</th> 
								<th>NID/Passport</th> 
								<th>Action</th>
						</thead>  
					</table>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

    var searchable = [1,2,3,4,13,15];
    var selectable = [5,6,7,8,9,10,11,12,14];

    var dropdownList = {
        '5' :[@foreach($employeeTypes as $e) <?php echo "'$e'," ?> @endforeach],
        '6' :[@foreach($unitList as $e) <?php echo "'$e'," ?> @endforeach],
        '7' :[@foreach($areaList as $e) <?php echo "'$e'," ?> @endforeach],
        '8' :[@foreach($departmentList as $e) <?php echo "'$e'," ?> @endforeach],
        '9' :[@foreach($designationList as $e) <?php echo "'$e'," ?> @endforeach],
        '10' :[@foreach($sectionList as $e) <?php echo "'$e'," ?> @endforeach],
        '11' :[@foreach($subsectionList as $e) <?php echo "'$e'," ?> @endforeach],
        '12' :['Male', 'Female'],
        '14' :['OT', 'Non OT']
    };

    $('#dataTables').DataTable({
    	order: [], //reset auto order
	    processing: true,
	    responsive: false,
	    serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        ajax: {
            url: '{!! url("hr/recruitment/worker/recruit_data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        },
	    columns: [  
	        {data: 'serial_no', name: 'serial_no'}, 
            {data: 'worker_name',  name: 'worker_name'}, 
            {data: 'as_oracle_code',  name: 'as_oracle_code'}, 
	        {data: 'as_rfid',  name: 'as_rfid'}, 
	        {data: 'worker_doj', name: 'worker_doj'}, 
	        {data: 'hr_emp_type_name', name: 'hr_emp_type_name'}, 
	        {data: 'hr_unit_short_name',  name: 'hr_unit_short_name'}, 
	        {data: 'hr_area_name', name: 'hr_area_name'}, 
	        {data: 'hr_section_name', name: 'hr_section_name'}, 
	        {data: 'hr_subsec_name', name: 'hr_subsec_name'}, 
	        {data: 'hr_department_name',  name: 'hr_department_name'}, 
	        {data: 'hr_designation_name', name: 'hr_designation_name'}, 
	        {data: 'worker_gender', name: 'worker_gender'}, 
	        {data: 'worker_dob', name: 'worker_dob'}, 
	        {data: 'worker_ot', name: 'worker_ot'}, 
	        {data: 'worker_contact', name: 'worker_contact'},  
	        {data: 'worker_nid', name: 'worker_nid'},  
	        {data: 'action', name: 'action', orderable: false, searchable: false}
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

                $.each(dropdownList[i], function(j, v) {
                    select.append('<option value="'+v+'">'+v+'</option>')
                }); 
            });
        } 

	}); 
});
</script>
@endsection