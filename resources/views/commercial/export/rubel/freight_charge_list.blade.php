@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li>
                <li>
                    <a href="#">Export L/C </a>
                </li>
                <li class="active"> Freight Charge List </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
              <h1>Export L/C <small><i class="ace-icon fa fa-angle-double-right"></i>Freight Charge List </small></h1>
            </div>
          <!---Form 1---------------------->
          @include('inc/message')
            <div class="row">

                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>File No</th>
                                <th>Freight Master ID</th>
                                <th>Type</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($freightCharges as $freightCharge) { ?>
                            <tr>
                              <th>{{ $freightCharge->file_no }}</th>
                              <th>{{ $freightCharge->freight_master_id }}</th>
                              <th>{{ $freightCharge->type }}</th>
                              <!-- <th>

                                <div class="btn-group">
                                  <a href="{{ url('commercial/import/pi/master_fabric/'.$freightCharge->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit" style="height:25px; width:26px;">
                                      <i class="ace-icon fa fa-pencil bigger-120"></i>
                                  </a>
                                  <a href="{{ url('commercial/import/pi/master_fabric/'.$freightCharge->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete" style="height:25px; width:26px;">
                                      <i class="ace-icon fa fa-trash bigger-120"></i>
                                  </a>
                                </div>

                              </th> -->
                            </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                  </div><!--- /. Row ---->
                </div>
            </div><!--- /. Row ---->

        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    ///Filter
    $('#dataTables').DataTable({

    });

//     var searchable = [0,3,4,6];
//     var selectable = [1,2,5,7]; //use 4,5,6,7,8,9,10,11,....and * for all
//
//
//     $('#dataTables').DataTable({
//         order: [], //reset auto order
//         processing: true,
//         responsive: false,
//         serverSide: true,
//         pagingType: "full_numbers",
//         dom: "<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-4 text-center'B><'col-sm-3'f>>tp",
//         buttons: [
//             {
//                 extend: 'copy',
//                 className: 'btn-sm btn-info',
//                 exportOptions: {
//                     columns: ':visible'
//                 }
//             },
//             {
//                 extend: 'csv',
//                 className: 'btn-sm btn-success',
//                 exportOptions: {
//                     columns: ':visible'
//                 }
//             },
//             {
//                 extend: 'excel',
//                 className: 'btn-sm btn-warning',
//                 exportOptions: {
//                     columns: ':visible'
//                 }
//             },
//             {
//                 extend: 'pdf',
//                 className: 'btn-sm btn-primary',
//                 exportOptions: {
//                     columns: ':visible'
//                 }
//             },
//             {
//                 extend: 'print',
//                 className: 'btn-sm btn-default',
//                 exportOptions: {
//                     columns: ':visible'
//                 }
//             }
//         ],
//         ajax: '{!! url("commercial/export/freight_charge_list_ajax") !!}',
//         columns: [
//
//           { data: 'file_no', name: 'file_no' },
//           { data: 'freight_master_id', name: 'freight_master_id' },
//           { data: 'action', name: 'action' }
//
//
//         ],
//         initComplete: function () {
//             var api =  this.api();
//
//             // Apply the search
//             api.columns(searchable).every(function () {
//                 var column = this;
//                 var input = document.createElement("input");
//                 input.setAttribute('placeholder', $(column.header()).text());
//
//                 $(input).appendTo($(column.header()).empty())
//                 .on('keyup', function () {
//                     column.search($(this).val(), false, false, true).draw();
//                 });
//
//                 $('input', this.column(column).header()).on('click', function(e) {
//                     e.stopPropagation();
//                 });
//             });
//
//             // each column select list
//             api.columns(selectable).every( function (i, x) {
//                 var column = this;
//
//                 var select = $('<select><option value="">'+$(column.header()).text()+'</option></select>')
//                     .appendTo($(column.header()).empty())
//                     .on('change', function(e){
//                         var val = $.fn.dataTable.util.escapeRegex(
//                             $(this).val()
//                         );
//                         column.search(val ? val : '', true, false ).draw();
//                         e.stopPropagation();
//                     });
//
//
//                 $.each(dropdownList[i], function(j, v) {
//                     select.append('<option value="'+v+'">'+v+'</option>')
//                 });
//             });
//         }
//     });
// });
</script>
@endsection
