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
                  <li>
                    <a href="#"> Materials </a>
                </li>
                <li class="active"> Item Edit</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Materials <i class="ace-icon fa fa-angle-double-right"></i>  Item Edit</small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <h5 class="page-header">Update Item</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/item_update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }} 
                        <input type="hidden" name="mcat_id" value="{{ $mitem->id }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mcat_id" >  Main Category<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('mcat_name', $cat_list, $mitem->mcat_id, ['placeholder'=>'Select Category Name','id'=>'mcat_id','class'=> 'col-xs-9', 'data-validation' => 'required']) }}
                            </div>
                        </div>
                        <div class="addRemove">
                            <div class="newItem">
                                <div class="form-group" style="">
                                    <label class="col-sm-3 control-label no-padding-right" for="item_name[]"> Item <span style="color: red">&#42;</span> </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="item_name" name="item_name" placeholder="Enter Text" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{$mitem->item_name}}" />

                                        <div class="form-group col-xs-3">
                                            
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="item_code"> Item Code<span style="color: red">&#42;</span> </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="item_code" name="item_code" placeholder="Enter Text" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{$mitem->item_code}}" />

                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="depends"> Depends On<span style="color: red">&#42;</span> </label>
                                    <div class="radio col-sm-9">

                                        <label>
                                            <input name="depends" type="radio" value="1" class="ace"<?php ($mitem->dependent_on==1)? printf("checked"):printf(""); ?>>
                                            <span class="lbl">Color</span>
                                        </label>
                                        <label>
                                            <input name="depends" type="radio" value="2" class="ace" data-validation="required" <?php ($mitem->dependent_on==2)? printf("checked"):printf(""); ?> >
                                            <span class="lbl">Size</span>
                                        </label>
                                        <label>
                                            <input name="depends" type="radio" value="3" class="ace" <?php ($mitem->dependent_on==3)? printf("checked"):printf(""); ?>>
                                            <span class="lbl">Size & Color</span>
                                        </label>
                                        <label>
                                            <input name="depends" type="radio" value="0" class="ace" <?php ($mitem->dependent_on==0)? printf("checked"):printf(""); ?>>
                                            <span class="lbl">None</span>
                                        </label>
                                    </div>
                                </div> 

                            </div>   
                        </div>   

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>     
                <!-- /.col -->
            </div><!--- /. Row ---->
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#dataTables').DataTable(); 
        var data = $('.AddBtn').parent().parent().parent().parent().html();
        $('body').on('click', '.AddBtn', function(){
            $('.addRemove').append("<div>"+data+"</div>");
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().parent().remove();
        });  
    });
</script>
@endsection
