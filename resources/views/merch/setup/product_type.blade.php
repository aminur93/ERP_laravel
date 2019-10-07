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
                    <h5 class="page-header">Add Product Type</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"merch/setup/product_type_store", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="prd_type_name" > Product Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="prd_type_name" id="prd_type_name" placeholder="Product Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
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
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <h5 class="page-header">Product Type List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL. NO.</th>
                                <th>Product Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $product->prd_type_name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('merch/setup/product_type_edit/'.$product->prd_type_id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                        <a href="{{ url('merch/setup/product_type_delete/'.$product->prd_type_id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  
    $('#dataTables').DataTable(); 
});
</script>
@endsection