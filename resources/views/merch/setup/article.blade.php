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
        <li><a href="#"> Setup </a></li>
        <li class="active">Article Construction & Compostion</li>
      </ul><!-- /.breadcrumb -->
    </div>

		<div class="page-content">
      <div class="page-header">
        <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i>Article Construction & Compostion</small></h1>
      </div>
            <!-- row -->
      <div class="row">
        <!-- Display Erro/Success Message -->
        @include('inc/message')
        <div class="col-sm-5">
          <h5 class="page-header">Article, Construction & Compostion</h5>
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/article_store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="sz_id" >Supplier<span style="color: red">&#42;</span></label>
                <div class="col-sm-9">
                  {{Form::select('supplier', $supplier, $supId, [ 'id' => 'supplier', 'placeholder' => 'Select Supplier', 'class' => 'col-xs-12 filter', 'data-validation' => 'required' ])}}
                </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_name" >Article<span style="color: red">&#42;</span></label>
              <div class="col-sm-9">

                <input type="text" id="art_name" name="art_name" placeholder="Enter Article" class="col-xs-12" data-validation='required'  />

              </div>
             </div>

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="composition" >Composition </label>
                <div class="col-sm-9">
                  <input type="text" id="composition" name="composition" placeholder="Enter Composition" class="col-xs-12" />
                </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_construction" >Construction</label>
              <div class="col-sm-9">
                <input type="text" id="art_construction" name="art_construction" placeholder="Enter Construction" class="col-xs-12" />
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
          </form>
        </div>
        <!-- /.col -->
    <div class="col-sm-7">
        <div class="">
          <h5 class="page-header">Article </h5>
          <table id="dataTables1" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Supllier</th>
                    <th>Article</th>
                    <th>Construction</th>
                    <th>Composition</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($articleList AS $article)
              <tr>
                <td>{{ $article->sup_name }}</td>
                <td>{{ $article->art_name }}</td>
                <td>{{ $article->construction_name }}</td>
                <td>{{ $article->comp_name }}</td>

                <td>
                  <div class="btn-group">
                      <a type="button" href="{{ url('merch/setup/article_edit/1/'.$article->id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                      <a href="{{ url('merch/setup/article_delete/'.$article->id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')" title="Delete" ><i class="ace-icon fa fa-trash bigger-120" ></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> <!-- Table End -->
          
        </div>
        </div>
      </div><!--- /. Row Form 1---->
		</div><!-- /.page-content -->
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('#dataTables1').DataTable();
    $('#dataTables2').DataTable();
    $('#dataTables3').DataTable();
});
</script>
@endsection
