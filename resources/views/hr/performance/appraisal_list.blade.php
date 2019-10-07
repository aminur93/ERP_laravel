@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Human Resource </a>
                </li>
                <li>
                    <a href="#"> Performance </a>
                </li>
                <li class="active"> P.Appraisal List </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Performance<small> <i class="ace-icon fa fa-angle-double-right"></i> P.Appraisal List </small></h1>
            </div>

            <div class="row">
                <form role="form" method="get" action="#" id="appraisalFilterForm">
                    <div class="col-xs-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="hr_pa_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-9">
                                    {{ Form::select('hr_pa_as_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_pa_as_id', 'class'=> 'associates no-select col-xs-12 col-sm-12']) }}  
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="pa_from">From</label>
                                <div class="col-sm-9">
                                    <input type="date" name="pa_from" id="pa_from" class="col-xs-12 " data-validation="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="pa_to"> To</label>
                                <div class="col-sm-9">
                                    <input type="date" name="pa_to" id="pa_to" class="col-xs-12 " data-validation="required"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="row">
                 <!-- Display Erro/Success Message -->
                    @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- </br> -->
                    <!-- Display Erro/Success Message -->
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Associate ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Appraisal Duration</th>
                                <th>Primary Assesment</th>
                                <th>Appraisal Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){ 

    $('select.associates').select2({
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term
                }; 
            },
            processResults: function (data) { 
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.associate_name,
                            id: item.associate_id
                        }
                    }) 
                };
          },
          cache: true
        }
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });


    var oTable = $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: true,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp", 
        ajax: {
            url: '{{ url("hr/performance/appraisal_list_data") }}',
            data: function (d) {
                delete d.columns[0,1,2,3,4,5,6,7],
                d.hr_pa_as_id  = $('#hr_pa_as_id').val(),
                d.pa_from  = $('#pa_from').val(),
                d.pa_to  = $('#pa_to').val()
            },
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
            { data: 'hr_pa_as_id', name: 'hr_pa_as_id' }, 
            { data: 'as_name',  name: 'as_name' }, 
            { data: 'hr_department_name', name: 'hr_department_name' }, 
            { data: 'appraisal_duration', name: 'appraisal_duration' }, 
            { data: 'hr_pa_primary_assesment', name: 'hr_pa_primary_assesment' }, 
            { data: 'hr_pa_status', name: 'hr_pa_status' }, 
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],  
    }); 


    $('#appraisalFilterForm').on('submit', function(e) 
    {
        var start= $('#pa_from').val();
        var end= $('#pa_to').val();

    if(start=='' || end=='')
    {
        alert("Input Appraisal Duration");
        e.preventDefault();
    }
    else
    {
        oTable.draw();
        e.preventDefault();
    }
    // if(isNaN(start) && isNaN(end) && isNaN($('#hr_pa_as_id').val())){
    //     alert("Input Appraisal Start and end date, Associate ID");
    //     e.preventDefault();
    // }  
    });


});
</script>
@endsection