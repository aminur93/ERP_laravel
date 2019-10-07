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
				<li class="active">Employee List</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
 			<div class="page-header">
                <h1>Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Employee List</small>
                <span class="pull-right"> <a  href="{{url('hr/recruitment/employee/employee_list')}}" class="btn btn-sm btn-info">Main List</a></span>
                </h1>
          
			</div>
			<form class="widget-container-col" role="form" id="empFilter" method="get" action="#">
                <div class="">
                    <div class="widget-body">
                        <div class="row" style="padding: 10px 20px">
                          
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="unit"> Unit </label>
                                    <div class="col-sm-8"> 
                                        {{ Form::select('unit', $allUnit, null, ['placeholder'=>'Select Unit', 'id'=>'unit',  'class'=>'form-control', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="emp_type"> Employee Type </label>
                                    <div class="col-sm-8"> 
                                        {{ Form::select('emp_type', $empTypes, null, ['placeholder'=>'Select Employee Type', 'id'=>'emp_type',  'class'=>'form-control']) }}  
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <button type="submit" id="" class="btn btn-primary btn-sm empFilter">
                                <i class="fa fa-search"></i>
                                Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>             
			<div class="row" style="padding-top: 30px;">
				<div class="col-xs-12"> 
					<div class="widget-header">
						<div class="row">
							<ul class="list-unstyled col-sm-4">
								<li><strong>Total Employee:</strong>
								{{ ($reportCount->employee->total?$reportCount->employee->total:0) }}</li>
								<li><strong>Today's Join:</strong>
								{{ ($reportCount->employee->todays_join?$reportCount->employee->todays_join:0) }}</li>
							</ul> 
							<ul class="list-unstyled col-sm-4">
								<li><strong>Males:</strong>
								{{ ($reportCount->employee->males?$reportCount->employee->males:0) }}</li>
								<li><strong>Females:</strong>
								{{ ($reportCount->employee->females?$reportCount->employee->females:0) }}</li>
							</ul>  
							<ul class="list-unstyled col-sm-4">
								<li><strong>Non OT:</strong>
								{{ ($reportCount->employee->non_ot?$reportCount->employee->non_ot:0) }}</li>
								<li><strong>OT:</strong>
								{{ ($reportCount->employee->ot?$reportCount->employee->ot:0) }}</li>
							</dl>  
						</div>
					</div>
				</div>
				<div class="col-xs-12">
				<div class="table-responsive"> 
				<table>
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Action</th>
								<th>Status</th>
								<th>Associate ID</th>
								<th>Name</th>
								<th>Employee Type</th>
								<th>Unit</th>
								<th>Floor</th>
								<th>Line</th>
								<th>Shift</th>
								<th>Area</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Section</th>
								<th>Gender</th>
								<th>OT Status</th>
								<th>Religion</th>
								<th>Contact</th> 
								<th>Education</th>
							</tr>

						</thead>  
						<tfoot class="bg-primary">
							<tr>
								<th>ID</th>
								<th>Action</th>
								<th>Status</th>
								<th>Associate ID</th>
								<th>Name</th>
								<th>Employee Type</th>
								<th>Unit</th>
								<th>Floor</th>
								<th>Line</th>
								<th>Shift</th>
								<th>Area</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Section</th>
								<th>Gender</th>
								<th>OT Status</th>
								<th>Religion</th>
								<th>Contact</th> 
								<th>Education</th> 
							</tr>   

						</tfoot>  
					</table>
				</div><!-- /.col -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{ 
	$("#empFilter").on("submit", function(e){
		e.preventDefault(); 
		$("#dataTables").DataTable().destroy();
		var searchable = [3,4,18];
		var selectable = [2,5,6,7,8,9,10,11,12,13,14,15,16,17,19]; //use 4,5,6,7,8,9,10,11,....and * for all
		// dropdownList = {column_number: {'key':value}}; 
		var dropdownList = {
			'2':['Active', 'Resign', 'Terminate', 'Suspend'],
			'5' :[@foreach($employeeTypes as $e) <?php echo "'$e'," ?> @endforeach],
			'6' :[@foreach($unitList as $e) <?php echo "'$e'," ?> @endforeach],
			'7' :[@foreach($floorList as $e) <?php echo "'$e'," ?> @endforeach],
			'8' :[@foreach($lineList as $e) <?php echo "'$e'," ?> @endforeach],
			'9' :[@foreach($shiftList as $e) <?php echo "'$e'," ?> @endforeach],
			'10' :[@foreach($areaList as $e) <?php echo "'$e'," ?> @endforeach],
			'11' :[@foreach($departmentList as $e) <?php echo "'$e'," ?> @endforeach],
			'12' :[@foreach($designationList as $e) <?php echo "'$e'," ?> @endforeach],
			'13' :[@foreach($sectionList as $e) <?php echo "'$e'," ?> @endforeach],
			'14':['Male', 'Female'],
			'15':['1-OT','0-Non OT'],
			'16':['Islam', 'Hinduism', 'Buddhists', 'Christians'],
			'19' :[@foreach($educationList as $e) <?php echo "'$e'," ?> @endforeach],
		};

	    $('#dataTables').DataTable({
	    	order: [],  
		    processing: false,
		    responsive: false,
		    serverSide: false,
	        scroller: {
	            loadingIndicator: true
	        },
	        pagingType: "full_numbers", 
	        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
		    ajax:{
		    	url:  '{!! url("hr/recruitment/employee/employee_data") !!}',
		    	type: "get",
	            data: function (d) {
	                d.unit  = $('#unit').val(), 
	                d.emp_type = $('#emp_type').val()
	            },
	            headers: {
	                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
	            } 
		    },
		    columns: [    
		        {data:'serial_no', name: 'serial_no'}, 
		        {data:'action', name: 'action', orderable: false, searchable: false},
		        {data:'as_status', name: 'as_status'},
		        {data:'associate_id', name: 'associate_id'},  
		        {data:'as_name',  name: 'as_name'}, 
		        {data:'hr_emp_type_name', name: 'hr_emp_type_name'}, 
		        {data:'hr_unit_short_name',  name: 'hr_unit_short_name'}, 
		        {data:'hr_floor_name', name: 'hr_floor_name'}, 
		        {data:'hr_line_name',  name: 'hr_line_name'}, 
		        {data:'hr_shift_name', name: 'hr_shift_name'}, 
		        {data:'hr_area_name', name: 'hr_area_name'}, 
		        {data:'hr_department_name',  name: 'hr_department_name'}, 
		        {data:'hr_designation_name', name: 'hr_designation_name'}, 
		        {data:'hr_section_name', name: 'hr_section_name'}, 
		        {data:'as_gender', name: 'as_gender'}, 
		        {data:'as_ot', name: 'as_ot'}, 
		        {data:'emp_adv_info_religion', name: 'emp_adv_info_religion'},
		        {data:'as_contact', name: 'as_contact'},  
		        {data:'education_level_title', name: 'education_level_title'}
		    ],  
	        buttons: [  
	            {
	            	extend: 'copy', 
	            	className: 'btn-sm btn-info',
	            	header: false,
	            	footer: true,
	                exportOptions: {
	                    columns: ':visible'
	                }
	            }, 
	            {
	            	extend: 'csv', 
	            	className: 'btn-sm btn-success',
	            	header: false,
	            	footer: true,
	                exportOptions: {
	                    columns: ':visible'
	                }
	            }, 
	            {
	            	extend: 'excel', 
	            	className: 'btn-sm btn-warning',
	            	header: false,
	            	footer: true,
	                exportOptions: {
	                    columns: ':visible'
	                }
	            }, 
	            {
	            	extend: 'pdf', 
	            	className: 'btn-sm btn-primary', 
	            	header: false,
	            	footer: true,
	                exportOptions: {
	                    columns: ':visible'
	                }
	            }, 
	            {
	            	extend: 'print', 
	            	className: 'btn-sm btn-default',
	            	header: false,
	            	footer: true,
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
});
</script>
@endsection