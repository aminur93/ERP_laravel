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
                    <a href="#"> Export </a>
                </li>
                <li class="active">Export Bill (Air) List</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i> Export Bill (Air) List </small></h1>
            </div>
            @include('inc/message')

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data Entry ID</th>
                                <th>Job Starting Date</th>
                                <th>Job Ending Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Data Entry ID</th>
                                <th>Job Starting Date</th>
                                <th>Job Ending Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel">Export Bill (Air)</h2>
            </div>
            <form class="form-horizontal" id="modal_form" role="form" method="post" action="">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="edit_section"></div>
                    <div id="delete_section">
                        <div class="delete_msg">
                            <h4 class="text-center">Do You Sure Want To Delete This Data ?</h4>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                              <button type="submit" class="btn btn-danger btn-sm"><i class="ace-icon fa fa-check bigger-110" ></i> Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" id="modal_data" data-dismiss="modal">
                            <i class="ace-icon fa fa-check bigger-110" ></i> Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->
<script type="text/javascript">
	$(document).ready(function(){
	    var searchable = [1,2,3];

	    $('#dataTables').DataTable({
	        order: [], //reset auto order
	        processing: true,
	        responsive: false,
	        serverSide: true,
	        pagingType: "full_numbers",
	        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
	        ajax: '{!! url("commercial/export/export_bill_air_fetchlist") !!}',
	        columns: [
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'cm_exp_data_entry_1_id', name: 'cm_exp_data_entry_1_id'},
	            {data: 'job_start_date', name: 'job_start_date'},
	            {data: 'job_end_date', name: 'job_end_date'},
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
	        }
	    });
	});
</script>
@push('js')
     <script type="text/javascript">
        function deleteModal(id) {
            $('#modal_form').attr('action', "{{ url('/commercial/export/export_bill_air_delete') }}"+'/'+id);
            $('#edit_section').hide();
            $('#delete_section').show();
            $('#action_modal').modal();
        }
    </script>
@endpush
@endsection
