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
                <li class="#"> FOC Entry & Update</li>
                <li class="active">FOC List   </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
              <h1>FOC Entry & Update <small><i class="ace-icon fa fa-angle-double-right"></i>FOC List </small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                <div class="col-md-12 table-responsive" style="width:100% !important;">
                    <table id="dataTables_foc_list" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>SE. NO.</th>
                                <th>File No</th>
                                <th>Mode</th>
                                <th>Item</th>
                                <th>Invoice No.</th>
                                <th>Transport Doc No-1</th>
                                <th>Transport Doc No-2</th>
                                <th>Transport Doc Date</th>
                                <th>Supplier</th>
                                <th>value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$data->file_no}}</td>
                                <td>{{$data->foc_mode}}</td>
                                <td>{{$data->item_name}}</td>
                                <td>{{$data->foc_invoice_no}}</td>
                                <td>{{$data->trans_doc_no1}}</td>
                                <td>{{$data->trans_doc_no2}}</td>
                                <td>{{$data->trans_doc_date}}</td>
                                <td>{{$data->supplier_name}}</td>
                                <td>{{$data->foc_value}}</td>
                                <td>
                                    <a href="{{url('/')}}/comm/import/importlc/focedit/{{$data->id}}" class="btn btn-primary btn-xs" role="button" title="edit">
                                        <i class="fa fa-edit fa-sm"></i>
                                    </a>
                                    <a href="{{url('/')}}/comm/import/importlc/focdelete/{{$data->id}}" class="btn btn-danger btn-xs" role="button" data-toggle="tooltip" title="delete" onclick="return confirm('Are you sure you want to delete?');">
                                        <i class="fa fa-trash fa-sm"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                  </div><!--- /. Row ---->
                </div><!--- /. Row ---->
              
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //Showing data table
         $('#dataTables_foc_list').DataTable({
            "scrollY": true,
            "scrollX": true
            });
        
    });
</script>
@endsection