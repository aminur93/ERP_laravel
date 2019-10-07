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
				<li class="active">Medical List</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
 			<div class="page-header">
                <h1>Worker<small> <i class="ace-icon fa fa-angle-double-right"></i> Medical List</small></h1>
			</div>
                               
			<div class="row"> 
                <!-- Display Erro/Success Message -->
				<div class="col-xs-12">
                	@include('inc/message')
            	</div>
                
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="dataTables" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
                                    <th>Oracle ID</th>
                                    <th>RFID</th>
									<th>Date of Joining</th>
									<th>Height & Weight</th>
									<th>Tooth Structure</th>
									<th>Blood Group</th>
									<th>Identification Mark</th>
									<th>Doctor's Age Confirmation</th>
									<th>Doctor Comments</th>
									<th>Doctor Acceptance</th>
									<th>Action</th>
							</thead>  
						</table>
					</div> 
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
    var searchable = [1,2,3,4,5,6,8,10];
    var selectable = [7,9,11];  
    var dropdownList = {
        '5' :['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'],
        '7' :['18-20', '21-25', '26-30', '31-35', '36-40', '41-45', '46-50', '51-55', '56-60', '61-65', '66-70'],
        '9' :['Yes', 'No']
    };

    $('#dataTables').DataTable({
    	order: [], //reset auto order
	    processing: true,
	    responsive: false,
	    serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        ajax: {
            url: '{!! url("hr/recruitment/worker/medical_data") !!}',
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
	        {data: 'height_weight',  name: 'height_weight'}, 
	        {data: 'worker_tooth_structure', name: 'worker_tooth_structure'}, 
	        {data: 'worker_blood_group', name: 'worker_blood_group'}, 
	        {data: 'worker_identification_mark',  name: 'worker_identification_mark'}, 
	        {data: 'worker_doctor_age_confirm', name: 'worker_doctor_age_confirm'}, 
	        {data: 'worker_doctor_comments', name: 'worker_doctor_comments'}, 
	        {data: 'worker_doctor_acceptance', name: 'worker_doctor_acceptance'}, 
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