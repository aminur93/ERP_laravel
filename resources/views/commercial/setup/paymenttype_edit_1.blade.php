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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Payment Type </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Payment Type Update</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
             
                <div class="col-sm-6">
                    <h5 class="page-header">Update Payment Type</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"commercial/setup/paymenttype_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="payment_type" > Payment Type<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="payment_type" id="payment_type" value="{{$pay_type->type_name }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>  
 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                               <input type="hidden" name="pay_type_id" value="{{$pay_type->id}}">  
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
                <!-- /.col -->
        
          
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

@endsection