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
                <li class="active"> Product Type </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Product Type </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"merch/setup/product_type_update", "class"=>"form-horizontal"]) }}
                        <input type="hidden" name="prd_type_id" value="{{ $product->prd_type_id }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="prd_type_name" > Product Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="prd_type_name" id="prd_type_name" placeholder="Product Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" value="{{ $product->prd_type_name }}" />
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
<script type="text/javascript">
$(document).ready(function(){  
    $('#dataTables').DataTable({
        pagingType: "full_numbers" , 
        "sDom": '<"f"tp>' 
    }); 
});
</script>
@endsection