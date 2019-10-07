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
                    <a href="#"> Import </a>
                </li>
                <li class="active">C&F Bill Monitoring List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">  
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> C&F Bill Monitoring List </small></h1>
            </div>
            @include('inc/message')
                               
            <div class="row"> 
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>C&F Bill No</th>
                                <th>C&F Bill Date</th>
                                <th>C&F Bill Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>  
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>C&F Bill No</th>
                                <th>C&F Bill Date</th>
                                <th>C&F Bill Amount</th>
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
                <h2 class="modal-title text-center" id="myModalLabel">C&F Bill Monitoring</h2>
            </div>
            <form class="form-horizontal" id="modal_form" role="form" method="post" action="">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="edit_section">
                    	{{-- hidden field --}}                    	
                    	<input type="hidden" name="cm_imp_data_entry_id">
                        <div class="form-group">
                            <label for="passbook" class="col-sm-4 control-label">C&F Bill No</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="imp_cnf_bill_no" id="imp_cnf_bill_no" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">C&F Bill Date</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control datepicker" id="imp_cnf_bill_date" name="imp_cnf_bill_date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">C&F Bill Amount</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="imp_cnf_bill_amount" name="imp_cnf_bill_amount" value="">
                            </div>
                        </div>
                          
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </div>
                        </div>
                    </div>
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
	        ajax: '{!! url("commercial/import/cf_bill_monitoring_list_data") !!}',
	        columns: [  
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},  
	            {data: 'imp_cnf_bill_no', name: 'imp_cnf_bill_no'}, 
	            {data: 'imp_cnf_bill_date', name: 'imp_cnf_bill_date'}, 
	            {data: 'imp_cnf_bill_amount', name: 'imp_cnf_bill_amount'}, 
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
        function editModal(id,cm_data_entry,imp_cnf_bill_no,imp_cnf_bill_date,imp_cnf_bill_amount) {
            console.log(id, cm_data_entry, imp_cnf_bill_no, imp_cnf_bill_date, imp_cnf_bill_amount);
            $('#edit_section').show();
            $('#delete_section').hide();

            $('#modal_form').attr('action', "{{ url('/commercial/import/cf_bill_monitoring_update') }}"+'/'+id);
            $('#bill_monitor_id').val(id);
            $('#cm_imp_data_entry_id').val(cm_data_entry);
            $('#imp_cnf_bill_no').val(imp_cnf_bill_no);
            $('#imp_cnf_bill_date').val(imp_cnf_bill_date);
            $('#imp_cnf_bill_amount').val(imp_cnf_bill_amount);
            $('#action_modal').modal();
        }

        function deleteModal(id) {
            $('#modal_form').attr('action', "{{ url('/commercial/import/cf_bill_monitoring_delete') }}"+'/'+id);
            $('#edit_section').hide();
            $('#delete_section').show();
            $('#action_modal').modal();
        }
    </script>
@endpush
@endsection