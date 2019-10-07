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
                <li class="active"> Asset Assign </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Asset Management <small><i class="ace-icon fa fa-angle-double-right"></i> Asset Assign </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->

                    {{ Form::open(['url'=>'hr/assets/assign', 'class'=>'form-horizontal']) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="fin_asset_cat_id"> Category Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('fin_asset_cat_id', $categoryList, null, ['placeholder'=>'Select Category Name', 'id'=>'fin_asset_cat_id', 'class'=> 'col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Category Name field is required']) }}  
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="fin_asset_product_id" >Product Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select name="fin_asset_product_id" id="fin_asset_product_id" class="col-xs-10 col-sm-5" data-validation="required" data-validation-error-msg="Product Name is required">
                                    <option value="">Select Product Name </option> 
                                </select>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_fin_asset_id" >Asset Serial<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select name="hr_fin_asset_id" id="hr_fin_asset_id" class="col-xs-10 col-sm-5" data-validation="required" data-validation-error-msg="Asset Serial is required">
                                    <option value="">Select Asset Serial </option> 
                                </select>
                            </div>
                        </div>
  

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_associate_id"> Associate's ID <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9"> 
                                {{ Form::select('hr_associate_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_associate_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_asset_assign_date"> Assign Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" name="hr_asset_assign_date" id="hr_asset_assign_date" class="col-xs-10 col-sm-5" data-validation="required" data-validation-error-msg="The Assign Date field is required" />
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
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
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
<script type="text/javascript">
$(document).ready(function(){ 
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

    // Show Product List by Category ID
    var category  = $("#fin_asset_cat_id");
    var product   = $("#fin_asset_product_id");
    category.on('change', function(){
        $.ajax({
            url : "{{ url('hr/assets/get-product-by-category-id') }}",
            type: 'json',
            method: 'get',
            data: {category_id: $(this).val() },
            success: function(data)
            {
                product.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

    // Show Asset Serial List by Product ID
    var asset  = $("#hr_fin_asset_id");
    var product   = $("#fin_asset_product_id");
    product.on('change', function(){
        $.ajax({
            url : "{{ url('hr/assets/get-product-by-product-id') }}",
            type: 'json',
            method: 'get',
            data: {product_id: $(this).val() },
            success: function(data)
            {
                asset.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

});
</script>
@endsection