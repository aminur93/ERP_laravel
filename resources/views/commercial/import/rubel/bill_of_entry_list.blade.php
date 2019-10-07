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
                <li class="active">Bill of Entry List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">  
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Bill of Entry List </small></h1>
            </div>
            @include('inc/message')
                               
            <div class="row"> 
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IMP Data Id</th>
                                <th>Entry No</th>
                                <th>Bond No</th>
                                <th>Entry rec date</th>
                                <th>Bank sub date</th>

                                <th>Entry Date</th>
                                <th>Copy Recive Date</th>
                                <th>Duty Amount Taka</th>
                                <th>Assement Value</th>
                            </tr>
                        </thead>  
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>IMP Data Id</th>
                                <th>Entry No</th>
                                <th>Bond No</th>
                                <th>Entry rec date</th>
                                <th>Bank sub date</th>

                                <th>Entry Date</th>
                                <th>Copy Recive Date</th>
                                <th>Duty Amount Taka</th>
                                <th>Assement Value</th>
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

	    var searchable = [1,2,3,4,5,6,7,8,9];
	    $('#dataTables').DataTable({
	        order: [], //reset auto order
	        processing: true,
	        responsive: false,
	        serverSide: true,
	        pagingType: "full_numbers",
	        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
	        ajax: '{!! url("commercial/import/billofentry_listData") !!}',
	        columns: [  
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
	            {data: 'b_id', name: 'b_id'}, 
	            {data: 'entry_no', name: 'entry_no'}, 
	            {data: 'bond_no', name: 'bond_no'}, 
	            {data: 'entry_recv_date', name: 'entry_recv_date'},
	            {data: 'contro_bank_sub_date', name: 'contro_bank_sub_date'},
	            {data: 'entry_date', name: 'entry_date'},
	            {data: 'copy_rcv_date', name: 'copy_rcv_date'},
	            {data: 'duty_amount_tk', name: 'duty_amount_tk'},
	            {data: 'assesment_value', name: 'assesment_value'},
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
@endsection