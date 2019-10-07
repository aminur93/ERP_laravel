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
                    <a href="#">Order </a>
                </li> 
                <li class="active"> Order Entry</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Order <small><i class="ace-icon fa fa-angle-double-right"></i> Order Entry</small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <form class="form-horizontal" role="form" method="post" action="{{ url('merch/orders/order_entry') }}">
                    {{ csrf_field() }} 

                    <div class="col-sm-10 col-sm-offset-2">

                        <input type="hidden" name="res_id" value="{{ $reseravtion->res_id }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_name">Unit<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_name" name="hr_unit_name" value="{{ $reseravtion->hr_unit_name }}" class="col-xs-10 col-sm-5" disabled/>
                                <input type="hidden" name="unit_id" value="{{ $reseravtion->hr_unit_id }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mr_buyer_name" >Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="mr_buyer_name" name="mr_buyer_name" value="{{ $reseravtion->b_name }}" class="col-xs-10 col-sm-5" disabled/>
                                <input type="hidden" name="mr_buyer_b_id" value="{{ $reseravtion->b_id }}">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mr_brand_br_id" >Brand<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('mr_brand_br_id', $brandList, null, ['id'=> 'mr_brand_br_id', 'placeholder' => 'Select Brand', 'class'=> 'col-xs-10 col-sm-5', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_month"> Month<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_month" name="order_month" class="col-xs-4 col-sm-1 monthpicker" placeholder="Month" value="{{ $reseravtion->res_month }}" data-validation="required"/>

                                <label class="col-xs-2 col-sm-1" style="text-align: right">Year<span style="color: red">&#42;</span></label>
                                <input type="text" id="order_year" name="order_year"  class="col-xs-4 col-sm-2 yearpicker" placeholder="Year" value="{{ $reseravtion->res_year }}" data-validation="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mr_season_se_id"> Season <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('mr_season_se_id', $seasonList, null, [ 'id'=> 'mr_season_se_id', 'placeholder' => 'Select Season', 'class'=> 'col-xs-10 col-sm-5', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mr_style_stl_id"> Style <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('mr_style_stl_id', $styleList, null, [ 'id'=> 'mr_style_stl_id', 'placeholder' => 'Select Style', 'class'=> 'col-xs-10 col-sm-5', 'data-validation' => 'required']) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_ref_no"> Reference No<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_ref_no" name="order_ref_no" class="col-xs-10 col-sm-5" placeholder="Reference No" data-validation="required length" data-validation-length="1-60"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_qty"> Quantity<span style="color: red">&#42;</span> </label>
                            <!-- This is the actual Reservation Quantity -->
                            <input type="hidden" class="qty_check" name="qty_check" id="qty_check" value="{{ $reseravtion->res_quantity }}">
                            <!-- This Quantity will be used to check if order qty is greater than reservation qty -->
                            <div class="col-sm-9">
                                <input type="text" id="order_qty" name="order_qty" value="{{ $reseravtion->res_quantity }}" data-validation=" required length number" data-validation-length="1-11" placeholder="Quantity" class="col-xs-10 col-sm-5"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_delivery_date"> Delivery Date <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_delivery_date" name="order_delivery_date" class="col-xs-10 col-sm-5 datepicker" placeholder="Delivery Date" data-validation="required"/>
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
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                            <!-- /.row --> 
                         
                        <!-- PAGE CONTENT ENDS -->
                    </div>
                </form>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //Total quantity can not be greater than Projected quantity
        $('#order_qty').on('keyup', function(){
            var sum = 0;
            var total_qty= parseInt($(this).val());
            var projected_qty= parseInt($("#qty_check").val());
            if(total_qty> projected_qty){
                alert('Total quantity can not greater than Projected quantity');
                $(this).val(projected_qty);
            }
        });
    });
</script>
@endsection