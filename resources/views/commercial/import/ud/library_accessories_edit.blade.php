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
                <li>
                    <a href="#"> UD System </a>
                </li> 
                <li class="active">  Accessories Library Edit </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Edit Accessories Library</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-sm-offset-2">
                    <!-- PAGE CONTENT BEGINS --> 
				    {{ Form::open(["url"=>"comm/import/ud_master/library_accessories_update", "class"=>"form-horizontal"]) }}
		                <input type="hidden" name="id" value="{{ $accessories->id }}">
					    <!--Item Code -->
					    <div class="form-group">
					        <label class="col-sm-3 control-label no-padding-right" for="ud_library_acss_item_code" > Item Code<span style="color: red">&#42;</span> </label>
					        <div class="col-sm-5">
					            <input type="text" name="ud_library_acss_item_code" value="{{ $accessories->ud_library_acss_item_code }}" id="ud_library_acss_item_code" placeholder="Item Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
					        </div>
					    </div>
				 

					    <!-- Item Description -->
					    <div class="form-group">
					        <label class="col-sm-3 control-label no-padding-right" for="ud_library_acss_item_desc" > Item Description</label>
					        <div class="col-sm-5">
					            <textarea type="text" name="ud_library_acss_item_desc" id="ud_library_acss_item_desc" placeholder="Item Description" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
					            data-validation-optional="true"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">{{ $accessories->ud_library_acss_item_desc }}</textarea>
					        </div>
					    </div>
					 
					    <!-- SUBMIT -->
					    <div class="form-group">
					        <div class="space-4"></div>
					        <div class="space-4"></div>
					        <div class="space-4"></div>
					        <div class="space-4"></div>
					        <div class="space-4"></div>
					        <div class="clearfix form-actions" style="margin:12px">
					            <div class="col-sm-offset-3 col-sm-9"> 
					                <button class="btn" type="reset">
					                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
					                </button>
					                &nbsp; &nbsp; &nbsp;
					                <button class="btn btn-info" type="submit">
					                    <i class="ace-icon fa fa-check bigger-110"></i> Update
					                </button>
					            </div>
					        </div> 
					    </div>
				    {{ Form::close() }} 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

@endsection