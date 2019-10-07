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
        <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i>Article Construction & Compostion Update</small></h1>
      </div>
            <!-- row -->
      <div class="row">
        <!-- Display Erro/Success Message -->
        @include('inc/message')
        <div class="col-sm-2"></div>
        <div class="col-sm-6">
          <h5 class="page-header">Article, Construction & Compostion</h5>
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/article_update') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
        
           
            <input type="hidden" name="art_id" value="{{ $articleList->id }}">
            <input type="hidden" name="typeval" value="{{ $type }}">

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="sz_id" >Supplier<span style="color: red">&#42;</span></label>
                <div class="col-sm-8">
                  <input type="text" name="supplier" id="supplier" class="col-xs-12 filter" data-validation = "required",data-validation-optional="true",data-validation-length="1-50",data-validation-regexp='^([,./;:-_()%$&a-z A-Z0-9]+)$' value="{{$articleList->sup_name}}" readonly="readonly" />
                </div>
            </div>
 
          @if($type==1) 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_name" >Article</label>
              <div class="col-sm-8">
               
                <input type="text" id="art_name" name="art_name" placeholder="Enter Article" class="col-xs-12" value="{{$articleList->art_name}}" />
             
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="composition" >Composition </label>
                <div class="col-sm-8">
                  <input type="text" id="composition" name="composition" placeholder="Enter Composition" class="col-xs-12" value="{{$articleList->comp_name}}" />
                </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_construction" >Construction</label>
              <div class="col-sm-8">
                <input type="text" id="art_construction" name="art_construction" placeholder="Enter Construction" class="col-xs-12" value="{{$articleList->construction_name}}"  />
              </div>
            </div>  
             
          @endif

          @if($type==2)            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="composition" >Composition </label>
                <div class="col-sm-8">
                  <input type="text" id="composition" name="composition" placeholder="Enter Composition" class="col-xs-12" value="{{$articleList->comp_name}}" />
                </div>
            </div>   
          @endif   

          @if($type==3)        
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_construction" >Construction</label>
              <div class="col-sm-8">
                <input type="text" id="art_construction" name="art_construction" placeholder="Enter Construction" class="col-xs-12" value="{{$articleList->construction_name}}"  />
              </div>
            </div>  
          @endif   
            <div class="clearfix form-actions">
              <div class="col-md-offset-3 col-md-9"> 
                <button class="btn btn-info" type="submit">
                  <i class="ace-icon fa fa-check bigger-110"></i> Update
                </button>
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                  <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                </button>
              </div>
            </div>
          </form> 
        </div>     
     
      </div><!--- /. Row Form 1---->
    </div><!-- /.page-content -->
  </div>
</div>
@endsection