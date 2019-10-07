@extends('merch.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li> 
                <li>
                    <a href="#"> Style & Libary </a>
                </li>
                <li class="active"> Product Library List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Style & Libary <small><i class="ace-icon fa fa-angle-double-right"></i>  Product Library List</small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                 
                <div class="col-sm-12">
                  <div class="table-responsive"> 
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Buyer Name</th>
                                <th>Style Type</th>
                                <th>Garments Type</th>
                                <th>Product Name</th>
                                <th>Short Code</th>
                                <th>Description</th>
                                <th>Size Group</th>
                                <th>SMV/pc</th>
                                <th>CM/pc</th>
                                <th>Wash/pc</th>
                                <th>Operation</th>
                                <th>Special Machine</th>
                                
                            </tr>
                        </thead>
                        <tfoot class="bg-primary">
                            <tr>
                                <th>Action</th>
                                <th>Buyer Name</th>
                                <th>Style Type</th>
                                <th>Garments Type</th>
                                <th>Product Name</th>
                                <th>Short Code</th>
                                <th>Description</th>
                                <th>Size Group</th>
                                <th>SMV/pc</th>
                                <th>CM/pc</th>
                                <th>Wash/pc</th>
                                <th>Operation</th>
                                <th>Special Machine</th>
                                
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

    var searchable = [1,4,5,6,8,9,10];
    var selectable = [2,3,7,11,12]; //use 4,5,6,7,8,9,10,11,....and * for all
    // dropdownList = {column_number: {'key':value}};
    var dropdownList = {
        '2' :[@foreach($stype as $e) <?php echo "'$e'," ?> @endforeach],
        '3' :[@foreach($garments as $e) <?php echo "'$e'," ?> @endforeach],
        '7' :[@foreach($pr_sizegroup as $e) <?php echo "'$e'," ?> @endforeach],
        '11' :[@foreach($operation as $e) <?php echo "'$e'," ?> @endforeach],
        '12' :[@foreach($spmachine as $e) <?php echo "'$e'," ?> @endforeach],
    };

    ////

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-4 text-center'B><'col-sm-3'f>>tp", 
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
        ajax: '{!! url("merch/stylelibrary/productlistdata") !!}',
        columns: [ 
          { data: 'action', name: 'action' },
          { data: 'b_name', name: 'b_name' }, 
          { data: 'stp_name', name: 'stp_name' }, 
          { data: 'gmt_name', name: 'gmt_name' },
          { data: 'prodlib_name', name: 'prodlib_name' },
          { data: 'prodlib_shortcode', name: 'prodlib_shortcode' },  
          { data: 'prodlib_description', name: 'prodlib_description' }, 
          { data: 'prdsz_id', name: 'prdsz_id' }, 
          { data: 'prodlib_smv', name: 'prodlib_smv' }, 
          { data: 'prodlib_cm', name: 'prodlib_cm' }, 
          { data: 'prodlib_wash', name: 'prodlib_wash' }, 
          { data: 'opr_name', name: 'opr_name' }, 
          { data: 'spmachine_name', name: 'spmachine_name' }

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
</script>
@endsection