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
                <li class="active"> PI Master Accessories </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> PI Master Accessories </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                {{ Form::open(["url"=>"comm/import/pi/pi_master_accessories", "class"=>"form-horizontal"]) }}
                <!-- 1st ROW -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_id" > PI No<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            {{ Form::select("pi_entry_id", $PIEntryList, null, ['class'=>'col-xs-12', 'id'=>'pi_entry_id', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="exp_lc_fileno" > File No<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            {{ Form::select("exp_lc_fileno", $fileList, null, ['class'=>'col-xs-12', 'id'=>'exp_lc_fileno', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="sup_name" > Supplier<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-4">
                            <input type="hidden" name="sup_id" id="sup_id">
                            <input type="text" id="sup_name" placeholder="Supplier" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly/>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="master_pi_acss_sup_code" id="master_pi_acss_sup_code" placeholder="Auto Code" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_date" > PI Date<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_date" placeholder="DD-MM-YYYY" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_category" > PI Category<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_category" placeholder="PI Category" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_last_date" > PI Last Date<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_last_date" placeholder="DD-MM-YYYY" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_shipmode" > Ship Mode<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_shipmode" placeholder="Sea/Air/Road" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>    
                </div> 

                <!-- 2nd row -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_type" > PI Type<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8"> 
                            <input type="text" id="pi_entry_type" placeholder="PI Type" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()+%$&a-z A-Z0-9]+)$" readonly/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="master_pi_acss_insurance_no" > Marine Insurance No<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" name="master_pi_acss_insurance_no" id="master_pi_acss_insurance_no" placeholder="Marine Insurance No" value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="master_pi_acss_insurance_date" > Marine Insurance Date<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="date" name="master_pi_acss_insurance_date" id="master_pi_acss_insurance_date" placeholder="DD-MM-YYYY" value="" class="col-xs-12" data-validation="date"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="insurance_comp_id" > Insurance Company Code<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            {{ Form::select("insurance_comp_id", $insuranceList, null, ['class'=>'col-xs-12', 'id'=>'insurance_comp_id', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
                        </div>
                    </div>     
                </div>  

                <!-- 3rd row -->
                <div class="col-sm-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>MBM Order No</th>
                                <th>Style No</th>
                                <th>FOB Date</th>
                            </tr>
                        </thead>
                        <tbody id="order_details"></tbody>
                    </table>
                </div>

                <!-- ORDERS -->
                <div class="col-sm-12">
                    <div id="bom_order_details"> 
                    </div>
                </div>


                <!-- SUBMIT -->
                <div class="col-sm-12">
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
                </div>
                </form> 
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 
<script type="text/javascript">
$(document).ready(function(){
    // add and remove 
    $('body').on('click', '.AddBtn', function() {
        var data = $(this).parent().parent().parent().html();
        $(this).parent().parent().parent().parent().append("<tr'>"+data+"</tr>");
    });
    $('body').on('click', '.RemoveBtn', function() {
        $(this).parent().parent().parent().remove();
    });

    // --- LOAD ALL DATA ---------
    var sup_name           = $("#sup_name");
    var sup_id             = $("#sup_id");
    var master_pi_acss_sup_code = $("#master_pi_acss_sup_code");
    var pi_entry_category  = $("#pi_entry_category");
    var pi_entry_date      = $("#pi_entry_date");
    var pi_entry_last_date = $("#pi_entry_last_date");
    var pi_entry_shipmode  = $("#pi_entry_shipmode");
    var pi_entry_type      = $("#pi_entry_type");
    var order_details      = $("#order_details");

    // get accessories order
    $("body").on("change", "#pi_entry_id", function(){
        var pi_entry_id = $(this).val();
        
        $.ajax({
            url: '{{ url("comm/import/pi/get_pi_accessories_entry_by_id") }}',
            dataType: 'json',
            data: {pi_entry_id},
            success: function(data)
            { 
                if (data.status)
                {
                    //purchase
                    var purchase = data.purchase; 
                    sup_name.val(purchase.sup_name);
                    sup_id.val(purchase.sup_id);
                    master_pi_acss_sup_code.val(data.autocode);
                    pi_entry_category.val(purchase.pi_entry_category);
                    pi_entry_date.val(purchase.pi_entry_date);
                    pi_entry_last_date.val(purchase.pi_entry_last_date);
                    pi_entry_shipmode.val(purchase.pi_entry_shipmode);
                    pi_entry_type.val((purchase.pi_entry_type==1?"Fabric":(purchase.pi_entry_type==2?"Accessories":"Fabric+Accessories")));

                    //orders
                    $("#bom_order_details").html("");
                    var orders = data.orders;
                    var html = "";
                    if (orders.length > 0)
                    {
                        $.each(orders, function(i, v){
                            html += "<tr>"+
                                "<th>"+
                                    "<div class=\"checkbox\">"+
                                    "<label><input value="+v.pi_order_id+" type=\"checkbox\" class=\"pi_order_id ace\"><span class=\"lbl\"></span></label>"+
                                    "</div>"+
                                "</th>"+
                                "<td><input type=\"text\" value="+v.order_code+" class=\"form-control input-sm\" readonly></td>"+
                                "<td><input type=\"text\" value="+v.stl_no+" class=\"form-control input-sm\" readonly><input type=\"hidden\" value="+v.stl_id+"></td>"+
                                "<td><input type=\"text\" value="+v.order_delivery_date+" class=\"form-control input-sm\" readonly></td>"+
                            "</tr>"; 
                        });
                    }
                    order_details.html(html); 
                }
                else
                {
                    sup_name.val("");
                    sup_id.val("");
                    master_pi_acss_sup_code.val("");
                    pi_entry_category.val("");
                    pi_entry_date.val("");
                    pi_entry_last_date.val("");
                    pi_entry_shipmode.val("");
                    pi_entry_type.val("");
                    order_details.html(""); 
                    $("#bom_order_details").html("");
                }
            },
            error: function(xhr)
            {
                alert('failed');
            }
        }); 
    });

    // get order detials
    $("body").on("change", ".pi_order_id", function(){
        var pi_order_id  = $(this).val();
        var order_code = $(this).parent().parent().parent().next().children().val();
        var style_id   = $(this).parent().parent().parent().next().next().children().next().val();
       
        if ($(this).is(':checked')) 
        {
            $.ajax({
                url : "{{ url('comm/import/pi/get_accessories_order') }}",
                dataType: 'json',
                data: {pi_order_id, order_code, style_id},
                success: function(data)
                {  
                    $("#bom_order_details").append(data.result)
                }, 
                error: function(xhr)
                {
                    alert('failed...');
                }
            });               
        } 
        else 
        {
            //remove table
            $("table[data-order-id='" + pi_order_id +"']").remove();
        }

    });

    // item name
    $("body").on("change", ".matitem_id", function(){
        var that = $(this);

        $.ajax({
            url : "{{ url('comm/import/pi/get_item_name') }}",
            dataType: 'json',
            data: {matitem_id: that.val()},
            success: function(data)
            {  
                that.parent().parent().find(".item-name").val(data.name);
            }, 
            error: function(xhr)
            {
                alert('failed...');
            }
        });    
    });

    // calculate amount
    $("body").on("keyup", ".qty, .price", function(){
        var qty = $(this).parent().parent().find(".qty").val();
        var price = $(this).parent().parent().find(".price").val();
        $(this).parent().parent().find(".amount").val(qty*price);
    });

});
</script>
@endsection