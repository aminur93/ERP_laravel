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
                <li class="active"> Edit PI Master Accessories </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> PI Master Accessories Edit</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                {{ Form::open(["url"=>"comm/import/pi/pi_master_accessories_update", "class"=>"form-horizontal"]) }}
                <input type="hidden" name="master_pi_acss_id" value="{{ $accessories->master_pi_acss_id }}">

                <!-- 1st ROW -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_id" > PI No<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            {{ Form::select("pi_entry_id", $PIEntryList, $accessories->pi_entry_id, ['class'=>'col-xs-12', 'id'=>'pi_entry_id', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="exp_lc_fileno" > File No<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            {{ Form::select("exp_lc_fileno", $fileList, $accessories->exp_lc_fileno, ['class'=>'col-xs-12', 'id'=>'exp_lc_fileno', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="sup_name" > Supplier<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-4">
                            <input type="hidden" name="sup_id" id="sup_id" value="{{ $accessories->sup_id }}">
                            <input type="text" id="sup_name" placeholder="Supplier" value="{{ $accessories->sup_name }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly/>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="master_pi_acss_sup_code" id="master_pi_acss_sup_code" placeholder="Auto Code" value="{{ $accessories->master_pi_acss_sup_code }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_date" > PI Date<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_date" placeholder="DD-MM-YYYY" value="{{ $accessories->pi_entry_date }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_category" > PI Category<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_category" placeholder="PI Category" value="{{ $accessories->pi_entry_category }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_last_date" > PI Last Date<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_last_date" placeholder="DD-MM-YYYY" value="{{ $accessories->pi_entry_last_date }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_shipmode" > Ship Mode<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="pi_entry_shipmode" placeholder="Sea/Air/Road" value="{{ $accessories->pi_entry_shipmode }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                        </div>
                    </div>    
                </div> 

                <!-- 2nd row -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="pi_entry_type" > PI Type<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8"> 
                            <input type="text" id="pi_entry_type" placeholder="PI Type" value="{{ $accessories->pi_entry_type }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;+:_()%$&a-z A-Z0-9]+)$" readonly/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="master_pi_acss_insurance_no" > Marine Insurance No<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="text" name="master_pi_acss_insurance_no" id="master_pi_acss_insurance_no" placeholder="Marine Insurance No" value="{{ $accessories->master_pi_acss_insurance_no }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="master_pi_acss_insurance_date" > Marine Insurance Date<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            <input type="date" name="master_pi_acss_insurance_date" id="master_pi_acss_insurance_date" placeholder="DD-MM-YYYY" value="{{ $accessories->master_pi_acss_insurance_date }}" class="col-xs-12" data-validation="date"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="insurance_comp_id" > Insurance Company Code<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-8">
                            {{ Form::select("insurance_comp_id", $insuranceList, $accessories->insurance_comp_id, ['class'=>'col-xs-12', 'id'=>'insurance_comp_id', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
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
                        <tbody id="order_details">
                            @foreach($orders as $order)
                            <tr>
                                <th>
                                    <div class="checkbox">
                                    <label><input value="{{ $order->pi_order_id }}" type="checkbox" {{ $order->isChecked?"checked":"" }} class="pi_order_id ace"><span class="lbl"></span></label>
                                    </div>
                                </th>
                                <td><input type="text" value="{{ $order->order_code }}" class="form-control input-sm" readonly></td>
                                <td><input type="text" value="{{ $order->stl_no  }}" class="form-control input-sm" readonly><input type="hidden" value="{{ $order->stl_id }}" ></td>
                                <td><input type="text" value="{{ $order->order_delivery_date }}" class="form-control input-sm" readonly></td>
                            </tr> 
                            @endforeach
                        </tbody> 
                    </table>
                </div>

                <!-- ORDERS -->
                <div class="col-sm-12">
                    <div id="bom_order_details"> 
                    @foreach($orders as $order)
                    @if ($order->isChecked)
                    <table class="table bg-success" data-order-id="{{$order->pi_order_id}}">
                        <thead>
                            <tr><th colspan="15"><h3> Order No  {{$order->order_code}}</h3></th></tr>
                            <tr>
                                <th width="70">Item Code</th>
                                <th>Item Name</th>
                                <th>Item Type</th>
                                <th>Quantity</th>
                                <th>Quantity Unit</th>
                                <th>Unit Price</th>
                                <th>Currency</th>
                                <th>Price Unit</th>
                                <th>Amount</th>
                                <th>Ship Date</th>
                                <th width="80">#</th>
                            </tr>
                        </thead>
                        <?php
                        $stl_id = $order->stl_id;
                        $items = DB::table("com_master_pi_accessories_item AS i")
                            ->select(
                                "i.master_pi_acss_item_id",
                                "i.master_pi_acss_id",
                                "i.pi_order_id",
                                "i.matitem_id",
                                "c.matitem_code",
                                "c.matitem_name",
                                "i.master_pi_acss_item_type",
                                "i.master_pi_acss_item_quantity",
                                "i.master_pi_acss_item_qty_unit",
                                "i.master_pi_acss_item_unit_price",
                                "i.master_pi_acss_item_currency",
                                "i.master_pi_acss_item_price_unit",
                                "i.master_pi_acss_item_ship_date",
                                "e.order_code",
                                "e.stl_id",
                                DB::raw("i.master_pi_acss_item_quantity * i.master_pi_acss_item_unit_price AS amount") 
                            )  
                            ->leftJoin('mr_material_item AS c', 'c.matitem_id', '=', 'i.matitem_id') 
                            ->leftJoin('mr_pi_order AS o', 'o.pi_order_id', '=', 'i.pi_order_id')
                            ->leftJoin('mr_order_entry AS e', 'e.order_id', '=', 'o.order_id')
                            ->where("i.master_pi_acss_id", $accessories->master_pi_acss_id)
                            ->where("e.order_code", $order->order_code)
                            ->get();

                        $itemCodes = DB::table("mr_bom_n_costing_booking AS bc")
                            ->leftJoin("mr_material_item AS i", "i.matitem_id", "=", "bc.matitem_id")
                            ->leftJoin("mr_material_category AS c", function($join) {
                                $join->on("c.mcat_id", "=", "i.mcat_id");
                            })
                            ->where(function($condition){ 
                                $condition->where("c.mcat_id", 2); 
                                $condition->orWhere("c.mcat_id", 3);  
                            })
                            ->where("bc.stl_id", $order->stl_id)
                            ->pluck("i.matitem_code", "i.matitem_id");

                        ?>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td> 
                                    <input type="hidden" name="master_pi_acss_item_id[]" value="{{ $item->master_pi_acss_item_id  }}">
                                    <input type="hidden" class="stl_id" value="{{ $item->stl_id }}">
                                    <input type="hidden" name="pi_order_id[]" value="{{ $item->pi_order_id }}">
                                    {{ Form::select("matitem_id[]", $itemCodes, $item->matitem_id, array('class'=>'matitem_id form-control no-select', 'placeholder'=>'Select', 'data-validation'=>'required')) }}
                                </td>  
                                <td class="has-warning">
                                    <input type="text" class="item-name input-sm form-control" value="{{ $item->matitem_name }}" placeholder="Enter" data-validation="required" readonly>
                                </td> 
                                <td>
                                    <input type="text" name="master_pi_acss_item_type[]" class="input-sm form-control" value="{{ $item->master_pi_acss_item_type }}" placeholder="Enter" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">
                                </td>

                                <td>
                                    <input type="text" name="master_pi_acss_item_quantity[]" value="{{ $item->master_pi_acss_item_quantity }}" class="qty input-sm form-control" placeholder="Enter" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">
                                </td>
                                <td>
                                    <?php
                                    $units = array(
                                        "Millimeter" => "Millimeter",
                                        "Centimeter" => "Centimeter",
                                        "Meter"      => "Meter",
                                        "Inch"       => "Inch",
                                        "Feet"       => "Feet",
                                        "Yard"       => "Yard",
                                        "Piece"      => "Piece" 
                                    );
                                    ?>
                                    {{ Form::select("master_pi_acss_item_qty_unit[]", $units, $item->master_pi_acss_item_qty_unit, array("class"=>"no-select form-control", 'placeholder'=>'Select', "data-validation"=>"required")) }} 
                                </td>  
                                <td>
                                    <input type="text" name="master_pi_acss_item_unit_price[]" value="{{ $item->master_pi_acss_item_unit_price }}" class="price input-sm form-control" placeholder="Enter" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">
                                </td>
                                <td> 
                                    <?php
                                    $currency = array(
                                        "USD" =>  "USD",
                                        "EUR" => "EUR",
                                        "GBP" => "GBP", 
                                        "AUD" => "AUD",
                                        "BDT" => "BDT",  
                                        "BRR" => "BRR", 
                                        "CAD" => "CAD", 
                                        "CNY" => "CNY", 
                                        "FRF" => "FRF",
                                        "DEM" => "DEM", 
                                        "INR" => "INR",
                                        "IDR" => "IDR", 
                                        "ITL" => "ITL", 
                                        "JPY" => "ITL", 
                                        "MYR" => "MYR", 
                                        "NLG" => "NLG",
                                        "NZD" => "NZD",
                                        "NOK" => "NOK",
                                        "PKR" => "PKR", 
                                        "PHP" => "PHP", 
                                        "RUR" => "RUR",
                                        "SAR" => "SAR",
                                        "SGD" => "SGD", 
                                        "SEK" => "SEK",
                                        "CHF" => "CHF",
                                        "TWD" => "TWD",
                                        "TRL" => "TRL",
                                        "XAU" => "XAU",
                                        "XAG" => "XAG",
                                        "XPT" => "XPT",
                                        "XPD" => "XPD" 
                                    );
                                    ?> 
                                     {{ Form::select("master_pi_acss_item_currency[]", $currency, $item->master_pi_acss_item_currency, array("class"=>"no-select form-control", 'placeholder'=>'Select', "data-validation"=>"required")) }} 
                                </td> 
                                <td>  
                                    {{ Form::select("master_pi_acss_item_price_unit[]", $units, $item->master_pi_acss_item_price_unit, array("class"=>"no-select form-control", 'placeholder'=>'Select', "data-validation"=>"required")) }}  
                                </td>     
                                <td class="has-warning">
                                    <input type="text" value="{{ $item->amount }}" class="amount input-sm form-control" placeholder="Enter" data-validation="required" readonly>
                                </td>
                                <td>
                                    <input type="date" name="master_pi_acss_item_ship_date[]"  value="{{ $item->master_pi_acss_item_ship_date }}" style="width:140px" class="input-sm form-control" placeholder="Enter" data-validation="date">
                                </td> 
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="AddBtn btn btn-sm btn-success">+</button>
                                        <button type="button" class="RemoveBtn btn btn-sm btn-danger">-</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table> 
                    @endif
                    @endforeach
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
       var id = $(this).closest("table").attr("data-order-id");
       var stl_id = $(this).closest("table").find(".stl_id").val();
       var data = "<tr>"+
            "<td>"+ 
                "<input type=\"hidden\" name=\"master_pi_acss_item_id[]\">"+
                "<input type=\"hidden\" name=\"pi_order_id[]\" value="+id+">"+
                "<input type=\"hidden\" class=\"stl_id\" value="+stl_id+">"+
                '{{ Form::select("matitem_id[]", $itemCodes, null, array("class"=>"matitem_id form-control no-select", "placeholder"=>"Select", "data-validation"=>"required")) }}'+ 
            "</td>"+  
            "<td class=\"has-warning\">"+
                "<input type=\"text\" class=\"item-name input-sm form-control\" placeholder=\"Enter\" data-validation=\"required\" readonly>"+
            "</td>"+  
            "<td>"+
                "<input type=\"text\" name=\"master_pi_acss_item_type[]\" class=\"input-sm form-control\" placeholder=\"Enter\" data-validation=\"required length custom\" data-validation-length=\"1-45\"  data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\">"+
            "</td>"+
            "<td>"+
                "<input type=\"text\" name=\"master_pi_acss_item_quantity[]\" class=\"qty input-sm form-control\" placeholder=\"Enter\" data-validation=\"required length custom\" data-validation-length=\"1-45\"  data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\">"+
            "</td>"+
            "<td>"+
                "<select name=\"master_pi_acss_item_qty_unit[]\" class=\"form-control\" data-validation=\"required\">"+
                    "<option value=\"\">UoM</option>"+
                    "<option value=\"Millimeter\">Millimeter</option>"+
                    "<option value=\"Centimeter\">Centimeter</option>"+
                    "<option value=\"Meter\">Meter</option>"+
                    "<option value=\"Inch\">Inch</option>"+
                    "<option value=\"Feet\">Feet</option>"+
                    "<option value=\"Yard\">Yard</option>"+
                    "<option value=\"Piece\">Piece</option>"+
                "</select>"+ 
            "</td>"+  
            "<td>"+
                "<input type=\"text\" name=\"master_pi_acss_item_unit_price[]\" class=\"price input-sm form-control\" placeholder=\"Enter\" data-validation=\"required length custom\" data-validation-length=\"1-45\"  data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\">"+
            "</td>"+
            "<td>"+  
                "<select name=\"master_pi_acss_item_currency[]\" class=\"form-control\" data-validation=\"required\">"+
                    "<option value=\"USD\" selected=\"selected\">USD</option>"+
                    "<option value=\"EUR\">EUR</option>"+
                    "<option value=\"GBP\">GBP</option>"+ 
                    "<option value=\"AUD\">AUD</option>"+
                    "<option value=\"BDT\">BDT</option>"+  
                    "<option value=\"BRR\">BRR</option>"+ 
                    "<option value=\"CAD\">CAD</option>"+ 
                    "<option value=\"CNY\">CNY</option>"+ 
                    "<option value=\"FRF\">FRF</option>"+
                    "<option value=\"DEM\">DEM</option>"+ 
                    "<option value=\"INR\">INR</option>"+
                    "<option value=\"IDR\">IDR</option>"+ 
                    "<option value=\"ITL\">ITL</option>"+ 
                    "<option value=\"JPY\">ITL</option>"+ 
                    "<option value=\"MYR\">MYR</option>"+ 
                    "<option value=\"NLG\">NLG</option>"+
                    "<option value=\"NZD\">NZD</option>"+
                    "<option value=\"NOK\">NOK</option>"+
                    "<option value=\"PKR\">PKR</option>"+ 
                    "<option value=\"PHP\">PHP</option>"+ 
                    "<option value=\"RUR\">RUR</option>"+
                    "<option value=\"SAR\">SAR</option>"+
                    "<option value=\"SGD\">SGD</option>"+ 
                    "<option value=\"SEK\">SEK</option>"+
                    "<option value=\"CHF\">CHF</option>"+
                    "<option value=\"TWD\">TWD</option>"+
                    "<option value=\"TRL\">TRL</option>"+
                    "<option value=\"XAU\">XAU</option>"+
                    "<option value=\"XAG\">XAG</option>"+
                    "<option value=\"XPT\">XPT</option>"+
                    "<option value=\"XPD\">XPD</option>"+
                "</select>"+ 
            "</td>"+ 
            "<td>"+  
                "<select name=\"master_pi_acss_item_price_unit[]\" class=\"form-control\" data-validation=\"required\">"+ 
                    "<option value=\"\">UoM</option>"+
                    "<option value=\"Millimeter\">Millimeter</option>"+
                    "<option value=\"Centimeter\">Centimeter</option>"+
                    "<option value=\"Meter\">Meter</option>"+
                    "<option value=\"Inch\">Inch</option>"+
                    "<option value=\"Feet\">Feet</option>"+
                    "<option value=\"Yard\">Yard</option>"+
                    "<option value=\"Piece\">Piece</option>"+
                "</select>"+ 
            "</td>"+     
            "<td class=\"has-warning\">"+
                "<input type=\"text\" class=\"amount input-sm form-control\" placeholder=\"Enter\" data-validation=\"required\" readonly>"+
            "</td>"+
            "<td>"+
                "<input type=\"date\" name=\"master_pi_acss_item_ship_date[]\" style=\"width:140px\" class=\"input-sm form-control\" placeholder=\"Enter\" data-validation=\"date\">"+
            "</td>"+ 
            "<td>"+
                "<div class=\"btn-group\">"+
                    "<button type=\"button\" class=\"AddBtn btn btn-sm btn-success\">+</button>"+
                    "<button type=\"button\" class=\"RemoveBtn btn btn-sm btn-danger\">-</button>"+
                "</div>"+
            "</td>"+
        "</tr>";

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