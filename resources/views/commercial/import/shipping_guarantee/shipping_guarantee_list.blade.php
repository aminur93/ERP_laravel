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
                <li class="active">List of Shipping Guarantee Date Update </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> List of Shipping Guarantee Date Update </small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5>List of Shipping Guarantee Date Update </h5> </div>
                <div class="panel-body">
                @include('inc/message')

                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table id="dataTables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>File No.</th>
                                      <th>L/C No.</th>
                                      <th>S.G No.</th>
                                      <th>Mode</th>
                                      <th>Supplier</th>
                                      <th>Value</th>
                                      <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>File No.</th>
                                        <th>L/C No.</th>
                                        <th>S.G No.</th>
                                        <th>Mode</th>
                                        <th>Supplier</th>
                                        <th>Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel">Shipping Guarantee Date Update</h2>
            </div>
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/shipping-guarantee-date-update-edit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div id="edit_section">
                        <div class="form-group">
                            <label for="passbook" class="col-sm-4 control-label"> Shipping Guarantee Receive Date:</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" name="ship_gurant_rcv_date" id="ship-gurant-rcv-date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Original BL Sent to C&F Date:</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="original-bl-to-cnf-date" name="original_bl_to_cnf_date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">SG Submit to Bank Date:</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="sg-sub-bank-date" name="sg_sub_bank_date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Original Doc Received Date:</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="original-doc-rcv-date" name="original_doc_rcv_date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">S.G Received From C&F:</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="sg-rcv-from-cnf" name="sg_rcv_from_cnf" value="">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="ship-guarantee-id" name="ship_guarantee_id" value="">

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <button type="submit" class="btn btn-success btn-sm update">Update</button>
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
<!-- edit modal end -->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/shipping-guarantee-date-update-delete') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
          				<h4 class="text-center">Do you really want to delete these record? This process cannot be undone.</h4>
                  <input type="hidden" class="form-control" id="rowId" name="ship_guarantee_id" value="">
                </div>
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" id="modal_data" data-dismiss="modal">
                            <i class="ace-icon fa fa-check bigger-110" ></i> Close
                        </button>
                        <button type="submit" class="btn btn-success update">Ok</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    var searchable = [];
    var selectable = [];



    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
        ajax: '{!! url("comm/import/importdata/shipping-guarantee-date-update-list-data") !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'file_no', name: 'file_no'},
            {data: 'lc_no', name: 'lc_no'},
            {data: 'sg_no', name: 'sg_no'},
            {data: 'mode', name: 'mode'},
            {data: 'sup_name', name: 'sup_name'},
            {data: 'value', name: 'value'},
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
    $('#dataTables').on('click','#actionBtn',function(){
  		$('#action_modal').modal('show');
      var shipGuaranteeId = $(this).data("content-id");
      console.log(shipGuaranteeId);
      $.ajax({
          // url: '/comm/import/importdata/shipping-guarantee-date-update-by-id/'+shipGuaranteeId,
          url: "{{url('comm/import/importdata/shipping-guarantee-date-update-by-id') }}",
          type: "get",
          data: {shipGuaranteeId: shipGuaranteeId },
          success: function(response){
          // var response = JSON.parse(response);
            // console.log(response);
            if(response.length!=0){
              $("#ship-gurant-rcv-date").val(response.ship_gurant_rcv_date);
              $("#original-bl-to-cnf-date").val(response.original_bl_to_cnf_date);
              $("#sg-sub-bank-date").val(response.sg_sub_bank_date);
              $("#original-doc-rcv-date").val(response.original_doc_rcv_date);
              $("#sg-rcv-from-cnf").val(response.sg_rcv_from_cnf);
              $("#ship-guarantee-id").val(response.id);
            }
          }
      });
	});
  $('#dataTables').on('click','#deleteBtn',function(){
    var shipGuaranteeId = $(this).data("id");
      $("#rowId").val(shipGuaranteeId);
      $('#delete_modal').modal('show');
  });
});
</script>
@endsection
