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
                <li class="active">List of Pass Book And Volume Number </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">  
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> List of Pass Book And Volume Number </small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5>List of Pass Book And Volume Number <a href="{{URL::to('comm/import/pass-book-and-volume-number')}}" class="btn btn-success btn-xs"> <i class="fa fa-plus"></i> Passbook volume Entry</a></h5> </div>
                <div class="panel-body">
                @include('inc/message')
                               
                    <div class="row"> 
                        <div class="col-xs-12 table-responsive">
                            <table id="dataTables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File No.</th>
                                        <th>L/C No.</th>
                                        <th>Supplier</th>
                                        <th>Value</th>
                                        <th>Pass Book Page No.</th>
                                        <th>Pass Book Volume No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>  
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>File No.</th>
                                        <th>L/C No.</th>
                                        <th>Supplier</th>
                                        <th>Value</th>
                                        <th>Pass Book Page No.</th>
                                        <th>Pass Book Volume No.</th>
                                        <th>Action</th>
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
<!-- Modal -->
<div class="modal fade" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel">Passbook and Volume Number</h2>
            </div>
            <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/pass-book-and-volume-action') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" value="" id="rowId" value="" name="id">
                    <input type="hidden" value="" id="actionType" value="" name="action_type">
                    <div id="edit_section">
                        <div class="form-group">
                            <label for="passbook" class="col-sm-4 control-label">Pass Book Page No</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="page_no" id="passbook-data" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Pass Book Volume No</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="volume-data" name="volume_no" value="">
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

    var searchable = [1,2,4,6];
    var selectable = [3,5,7,8];

    

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        ajax: '{!! url("comm/import/pass-book-and-volume-number-list-data") !!}',
        columns: [  
            {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
            {data: 'file_no', name: 'file_no'}, 
            {data: 'lc_no', name: 'lc_no'}, 
            {data: 'sup_name', name: 'sup_name'},
            {data: 'value', name: 'value'}, 
            {data: 'page_no', name: 'page_no'}, 
            {data: 'volume_no', name: 'volume_no'}, 
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
            // api.columns(selectable).every( function (i, x) {
            //     var column = this; 

            //     var select = $('<select><option value="">'+$(column.header()).text()+'</option></select>')
            //         .appendTo($(column.header()).empty())
            //         .on('change', function(e){
            //             var val = $.fn.dataTable.util.escapeRegex(
            //                 $(this).val()
            //             );
            //             column.search(val ? val : '', true, false ).draw();
            //             e.stopPropagation();
            //         });

            //     $.each(dropdownList[i], function(j, v) {
            //         select.append('<option value="'+v+'">'+v+'</option>')
            //     }); 
            // });
        }  
    }); 
}); 
</script>

@push('js')
 <script>
    function editData(id, pageNo, volumeNo) {
        $("#edit_section").show();
        $("#delete_section").hide();
        $("#actionType").val('edit');
        $("#passbook-data").val(pageNo);
        $("#rowId").val(id);
        $("#volume-data").val(volumeNo);

        $('#action_modal').modal();
    }
    function deleteData(id) {
        $("#edit_section").hide();
        $("#delete_section").show();
        $("#actionType").val('delete');
        $("#rowId").val(id);
        $('#action_modal').modal();
    }
 </script>   
@endpush
@endsection