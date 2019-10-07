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
                    <a href="#"> Style & Libary </a>
                </li>
                <li class="active"> Product Library</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Style & Libary <small><i class="ace-icon fa fa-angle-double-right"></i>  Product Library </small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/stylelibrary/productlibrarystore')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    
                    <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_buyer_name" > Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                {{ Form::select('march_buyer_name', $buyer, null, ['placeholder'=>'Select', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }} 

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_style_type" > Style Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('march_style_type', $stype, null, ['placeholder'=>'Select', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }}            
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_garments_type" > Garments Type <span class="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                             
                              {{ Form::select('march_garments_type', $garments, null, ['placeholder'=>'Select', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }} 
                                          
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="march_product_name" > Product Name <span class="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                              <input type="text" id="march_product_name" name="march_product_name" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" />
                          </div>
                        </div>
                       <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="prod_short_code" > Short Code <span class="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                              <input type="text" id="prod_short_code" name="prod_short_code" placeholder="Enter Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-20"data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" />
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_product_description" >  Description </label>
                            <div class="col-sm-9">
                                <input type="text" id="march_product_description" name="march_product_description" placeholder="Enter Short Description" class="col-xs-12" " data-validation="length custom" data-validation-length="1-128"data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>                     
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_size_group" > Size Group<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                {{ Form::select('march_size_group', $pr_sizegroup, null, ['placeholder'=>'Select', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }} 

                            </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="march_product_smvpc" > SMV/pc </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_product_smvpc" name="march_product_smvpc" placeholder="Enter value" class="col-xs-12" />                       
                             
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="march_product_cmpc" > CM/pc </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_product_cmpc" name="march_product_cmpc" placeholder="Enter value" class="col-xs-12" />                       
                             
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="march_product_wash_pc" > Wash/pc </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_product_wash_pc" name="march_product_wash_pc" placeholder="Enter value" class="col-xs-12" />                       
                             
                            </div>
                       </div>
                    <div class="addmore"> 
                      <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="march_product_operation" > Operation </label>
                            <div class="col-sm-9">
                                <div class="form-group col-xs-6 col-sm-6">
                                {{ Form::select('march_product_operation[]', $operation, null, ['placeholder'=>'Select', 'class'=> 'col-xs-11']) }} 
                            </div>
                               <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                               </div> 
                        </div>
                      </div> 
                    </div>  
                    <div class="addmore2"> 
                      <div class="form-group">
                         <label class="col-sm-3 control-label no-padding-right" for="march_product_smachine" > Special Machine </label>
                            <div class="col-sm-9">
                                <div class="form-group col-xs-6 col-sm-6">
                                    
                                {{ Form::select('march_product_smachine[]', $spmachine, null, ['placeholder'=>'Select', 'class'=> 'col-xs-11']) }} 
                            </div>
                               <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn2">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn2">-</button> 
                               </div> 
                        </div>
                      </div> 
                    </div>    
                       
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Add
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
//Add More Operation
 
        var data = $(".addmore").html();
       
        $('body').on('click', '.AddBtn', function(){
            $(".addmore").append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });
//Add More Special Machine 

 
        var data2 = $(".addmore2").html();
       
        $('body').on('click', '.AddBtn2', function(){
            $(".addmore2").append(data2);
        });

        $('body').on('click', '.RemoveBtn2', function(){
            $(this).parent().parent().parent().remove();
        });        

});
</script>
@endsection