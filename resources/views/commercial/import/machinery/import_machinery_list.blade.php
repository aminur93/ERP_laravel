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
                    <a href="#"> Import </a>
                </li>
                <li class="#"> Import Data</li>
               
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
              <h1>Import Data <small></small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive"> 
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>File No</th>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>ILC No.</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <tfoot class="bg-primary">
                            <tr>
                                <th>Action</th>
                                <th>File No</th>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>ILC No.</th>
                                <th>Supplier</th>
                            </tr>
                        </tfoot>
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
    var searchable = [1,2,4];
    var selectable = [3,5]; //use 4,5,6,7,8,9,10,11,....and * for all
      var dropdownList = {
      
      
      '3' :[@foreach($unit as $e) <?php echo "\"$e\"," ?> @endforeach],
      '5' :[@foreach($supplier as $e) <?php echo "\"$e\"," ?> @endforeach]
      
    };
    ////
    var oTable = $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-4 text-center'B><'col-sm-3'f>>tp", 
        ajax: {
           url: '{!! url("comm/import/machinery/importmachinerylistdata") !!}',
            data: function (d) {
                d.id = $('select[name=bank]').val();
            }
        },
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
        columns: [ 
              { data: 'action'},
              { data: 'machinery_pi_fileno'}, 
              { data: 'machinery_pi_item'},
              { data: 'hr_unit_name'},
              { data: 'machinery_master_info_lc_no'},
              { data: 'sup_name'}
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

    $('body').on("change", "#bank", function(e) {  
        oTable.draw();
        e.preventDefault();
    }); 
});
</script>
@endsection