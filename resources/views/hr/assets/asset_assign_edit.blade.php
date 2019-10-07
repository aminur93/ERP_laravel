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
                    <a href="#"> Asset Management </a>
                </li>
                <li class="active"> Asset Return </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Asset Management <small><i class="ace-icon fa fa-angle-double-right"></i> Asset Return </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->

                    {{ Form::open(['url'=>'hr/assets/assign_edit',  'class'=>'form-horizontal']) }}

                        <input type="hidden" name="hr_asset_assign_id" value="{{ $asset->hr_asset_assign_id }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="fin_asset_cat_id"> Category Name </label>
                            <div class="col-sm-9 disabled"> 
                                <input type="text" name="fin_asset_cat_id" id="fin_asset_cat_id" placeholder="Category Name" class="col-xs-10 col-sm-5 " data-validation="required" value="{{ $asset->fin_asset_cat_name }}" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="fin_asset_product_id"> Product Name </label>
                            <div class="col-sm-9 disabled"> 
                                <input type="text" name="fin_asset_product_id" id="fin_asset_product_id" placeholder="Product Name" class="col-xs-10 col-sm-5 " data-validation="required" value="{{ $asset->fin_asset_product_name }}" readonly />
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_fin_asset_id"> Product Serial </label>
                            <div class="col-sm-9 disabled"> 
                                <input type="text" name="hr_fin_asset_id" id="hr_fin_asset_id" placeholder="Product Serial" class="col-xs-10 col-sm-5 " data-validation="required" value="{{ $asset->hr_fin_asset_id }}" readonly />
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_associate_id"> Associate's ID </label>
                            <div class="col-sm-9 disabled"> 
                                <input type="text" name="hr_associate_id" id="hr_associate_id" placeholder="Associate's ID" class="col-xs-10 col-sm-5 " data-validation="required" value="{{ $asset->hr_associate_id }}" readonly />
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_asset_assign_date"> Assign Date </label>
                            <div class="col-sm-9 disabled"> 
                                <input type="text" name="hr_asset_assign_date" id="hr_asset_assign_date" placeholder="Assign Date" class="col-xs-10 col-sm-5 " data-validation="required" value="{{ $asset->hr_asset_assign_date }}" readonly />
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_asset_assign_date"> Return Date </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_asset_return_date" id="hr_asset_return_date" placeholder="Return Date" class="col-xs-10 col-sm-5 datepicker" data-validation="required" data-validation-format="yyyy-mm-dd" data-validation-error-msg="The Return Date field is required"  value="{{ $asset->hr_asset_return_date }}" />
                            </div>
                        </div>

 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <a class="btn btn-success" href="{{ url('hr/assets/assign_list') }}">
                                    <i class="ace-icon fa fa-arrow-left bigger-110"></i> Back
                                </a>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-danger" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Return
                                </button>
                            </div>
                        </div>

                        <!-- /.row --> 
                    {{ Form::close() }}
                    <!-- PAGE CONTENT ENDS -->
                </div> 
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 
@endsection