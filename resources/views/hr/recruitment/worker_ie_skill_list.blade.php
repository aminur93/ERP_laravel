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
				<li class="active">IE Skill List</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">  
 			<div class="page-header">
                <h1>Worker<small> <i class="ace-icon fa fa-angle-double-right"></i> IE Skill List</small></h1>
			</div>
                               
			<div class="row"> 

                <!-- Display Erro/Success Message -->
				<div class="col-xs-12">
                	@include('inc/message')
            	</div>

				<div class="col-xs-12">
					<table id="dataTables" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th> 
								<th>Associate's Name</th> 
								<th>Date of Joining</th> 
								<th>Pgboard Test</th> 
								<th>Finger Test</th> 
								<th>Color Join</th> 
								<th>Color Band Join</th> 
								<th>Box Pleat Join</th> 
								<th>Color Top Stice</th> 
								<th>Urmol Join</th> 
								<th>Clip Join</th> 
								<th>Salary</th> 
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

    $('#dataTables').DataTable({
    	order: [], //reset auto order
	    processing: true,
	    responsive: true,
	    serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",  
        ajax: {
            url: '{!! url("hr/recruitment/worker/ie_skill_data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        },
	    columns: [  
	        {data: 'serial_no', name: 'serial_no'}, 
	        {data: 'worker_name',  name: 'worker_name'}, 
	        {data: 'worker_doj', name: 'worker_doj'},  
	        {data: 'worker_pigboard_test',  name: 'worker_pigboard_test'}, 
	        {data: 'worker_finger_test', name: 'worker_finger_test'}, 
	        {data: 'worker_color_join', name: 'worker_color_join'}, 
	        {data: 'worker_color_band_join',  name: 'worker_color_band_join'}, 
	        {data: 'worker_box_pleat_join', name: 'worker_box_pleat_join'}, 
	        {data: 'worker_color_top_stice', name: 'worker_color_top_stice'}, 
	        {data: 'worker_urmol_join', name: 'worker_urmol_join'}, 
	        {data: 'worker_clip_join', name: 'worker_clip_join'}, 
	        {data: 'worker_salary', name: 'worker_salary'}, 
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
        ] 

	}); 
});
</script>
@endsection