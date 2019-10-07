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
                <li class="active"> Garments Type </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Garments Type </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"merch/setup/garments_type_update", "class"=>"form-horizontal"]) }}

                        <input type="hidden" name="gmt_id" value="{{ $garment->gmt_id }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="prd_type_id"> Style Type<span style="color: red">&#42;</span>  </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('prd_type_id', $productList, $garment->prd_id, ['placeholder'=>'Select Style Type', 'id'=>'prd_type_id', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Style Type field is required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="gmt_name" > Garment Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="gmt_name" id="gmt_name" placeholder="Garment Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" value="{{ $garment->gmt_name }}" />
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="gmt_remarks"> Remarks</label>
                            <div class="col-sm-9">
                                <textarea multiple="multiple" name="gmt_remarks" id="gmt_remarks" class="form-control" placeholder="Remarks"  data-validation="length custom" data-validation-length="1-128" data-validation-regexp="^([.,/_()%$-;:'& a-zA-Z]+)$" data-validation-optional="true">{{ $garment->gmt_remarks }}</textarea>
                            </div>
                        </div>
 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
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
                        <!-- /.row --> 
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div> 
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 
@endsection