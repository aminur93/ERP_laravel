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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Approval Hierarchy</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Approval Hierarchy </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="hidden output"></div>
                <div class="col-sm-5">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/approval_store')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="type"> Approval Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                {{ Form::select('type',array('Style Costing' => 'Style Costing', 'Order Costing' => 'Order Costing','Supplier Approval' => 'Supplier Approval'), null, ['placeholder'=>'Select Category Name','id'=>'mcat_id','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="type"> Unit<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                {{ Form::select('unit',$unitList, null, ['placeholder'=>'Select Unit','id'=>'unit','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level1" > Level 1<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                              {{ Form::select('level1', [request()->get("associate_id") => request()->get("associate_id")], request()->get("associate_id"), ['placeholder'=>'Select Associate\'s ID', 'id'=>'ben_as_id', 'class'=> 'associates no-select col-xs-12 col-sm-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level2" >  Level 2<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('level2', [request()->get("associate_id") => request()->get("associate_id")], request()->get("associate_id"), ['placeholder'=>'Select Associate\'s ID', 'id'=>'ben_as_id', 'class'=> 'associates no-select col-xs-12 col-sm-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="level3" >  Level 3<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('level3', [request()->get("associate_id") => request()->get("associate_id")], request()->get("associate_id"), ['placeholder'=>'Select Associate\'s ID', 'id'=>'ben_as_id', 'class'=> 'associates no-select col-xs-12 col-sm-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}
                            </div>
                        </div>


                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- /.row -->
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
           <!--   //////table here -->
             <!-- /.col -->
                <div class="col-sm-7">
                    {{ Form::open(['url'=>'hr/hierarchy', 'id'=>'hierarchyFrm']) }}
                    <table id="dataTables1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5">Drag and drop to change position of designation </th>
                            </tr>
                            <tr>
                                <th>Approval Type</th>
                                <th>Unit</th>
                                <th>Level 1</th>
                                <th>Level 2</th>
                                <th>Level 3</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            <?php 
                             function getAsName($approvid){
                                $asname=DB::table('hr_as_basic_info AS b')
                                    ->select('b.as_name')
                                    ->where('b.associate_id',"=",$approvid)
                                    ->first();
                                return $asname->as_name;
                             } 
                            ?>
                          @foreach($approval as $approv)
                            <?php 
                                  
                                 $lvl1=getAsName($approv->level_1); 
                                 $lvl2=getAsName($approv->level_2);
                                 $lvl3=getAsName($approv->level_3);  
                            ?>            
                            <tr class="ui-state-default" style="cursor:move">
                                <td>{{ $approv->mr_approval_type }}</td>
                                <td>{{ $approv->unit_name }}</td>
                                <td>{{$lvl1}}<br/>{{$approv->level_1 }} </td>
                                <td>{{$lvl2}}<br/>{{ $approv->level_2 }}</td>
                                <td>{{$lvl3}}<br/>{{ $approv->level_3 }}</td>
                                <td>
                                    <a type="button" href="{{ url('merch/setup/approval_edit/'.$approv->id) }}" class='btn btn-xs btn-primary' data-toggle="tooltip" title="Edit"> <i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                    <a href="{{ url('merch/setup/approv_delete/'.$approv->id) }}" type="button" onclick="return confirm('Are you sure?')" class='btn btn-xs btn-danger' data-toggle="tooltip" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ Form::close() }}
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
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

$('#dataTables1').DataTable();
});
</script>
@endsection
