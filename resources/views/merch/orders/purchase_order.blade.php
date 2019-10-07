@extends('merch.index')
@section('content')

<div class="main-content">
    <style type="text/css">        
        
    </style>
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
                <li class="active"> Purchase Order</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header row">
                <h1 class="col-sm-8">Order <small><i class="ace-icon fa fa-angle-double-right"></i> Purchase Order</small></h1>
                <div class="text-right">
                    <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#add_purchase_order" title="Add Purchase Order"><i class="glyphicon glyphicon-plus"></i></button>

                    @if($isBom)
                    <a href='{{ url("merch/order_bom/".$data->order_id."/create") }}' class="btn btn-sm btn-success" title="Edit BOM"><i class="glyphicon glyphicon-pencil"></i></a>
                    @else
                    <a href='{{ url("merch/order_bom/".$data->order_id."/create") }}' class="btn btn-sm btn-success" title="BOM"><i class="glyphicon glyphicon-bold"></i></a>
                    @endif
                    <a href='{{ url("merch/orders/order_list") }}' class="btn btn-sm btn-info" title="Order List"><i class="glyphicon glyphicon-th-list"></i></a>
                    <a href='{{ url("merch/orders/order_copy/".$data->order_id) }}' class="btn btn-sm btn-primary" title="Order Copy"><i class="glyphicon glyphicon-copy"></i></a>
                </div>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                
                <form class="form-horizontal" role="form" method="post" action="{{ url('merch/orders/order_entry') }}">
                    {{ csrf_field() }} 

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_code"> Order No<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_code" name="order_code" class="col-xs-12" value="{{ $data->order_code }}" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_name">Unit<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_name" name="hr_unit_name" value="{{ $data->hr_unit_name }}" class="col-xs-12" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mr_buyer_name" >Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="mr_buyer_name" name="mr_buyer_name" value="{{ $data->b_name }}" class="col-xs-12" disabled/>
                                <input type="hidden" name="b_id" id="b_id" value="{{ $data->mr_buyer_b_id }}">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="br_name" >Brand<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="br_name" name="br_name" value="{{ $data->br_name }}" class="col-xs-12" disabled/>
                                <input type="hidden" name="br_id" id="br_id" value="{{ $data->mr_brand_br_id }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_month"> Month<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_month" name="order_month" class="col-xs-3" placeholder="Month" value="{{ date('M', strtotime($data->order_month)) }}" disabled/>

                                <label class="col-xs-3" style="text-align: right">Year<span style="color: red">&#42;</span></label>
                                <input type="text" id="order_year" name="order_year"  class="col-xs-5" placeholder="Year" value="{{ $data->order_year }}" data-validation="required" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_name"> Season <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="se_name" name="se_name" value="{{ $data->se_name }}" class="col-xs-12" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mr_style_stl_id"> Style <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="mr_style_stl_id" name="mr_style_stl_id" value="{{ $data->mr_style_stl_id }}" class="col-xs-12" disabled/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_ref_no"> Reference No<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_ref_no" name="order_ref_no" class="col-xs-12" value="{{ $data->order_ref_no }}" placeholder="Reference No" disabled/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_qty"> Quantity<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_qty_actual" name="order_qty_actual" value="{{ $data->order_qty }}" class="col-xs-12" disabled/>
                                <input type="hidden" id="order_qty" name="order_qty" value="{{ $data->order_qty-$total_po }}" class="col-xs-12"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_delivery_date"> Delivery Date <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_delivery_date" name="order_delivery_date" value="{{ $data->order_delivery_date }}" class="col-xs-12" disabled/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="" id="purchase_order_div">
                            <table id="dataTables" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>PO NO</th>
                                        <th>Order No</th>
                                        <th>PO Quantity</th>
                                        <th>Ex-Fty</th>
                                        <th>Delivery Country</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($poList AS $eachPO)
                                    <tr>
                                        <td>{{ $eachPO->po_no }}</td>
                                        <td>{{ $eachPO->order_code }}</td>
                                        <td>{{ $eachPO->po_qty }}</td>
                                        <td>{{ $eachPO->po_ex_fty }}</td>
                                        <td>{{ $eachPO->cnt_name }}</td>
                                        <td width="8%">
                                            <div class="btn-group">
                                                <input type="hidden" name="po_id[]" id="po_id" value="{{ $eachPO->po_id }}" data-orderid="{{ $data->order_id }}">
                                                <a type="button" class='btn btn-xs btn-primary edit' title="Edit" data-toggle="modal" data-target="#purchase_order_edit"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                                <a href="{{ url('merch/orders/purchase_order_delete/'.$data->order_id.'/'.$eachPO->po_id) }}" type="button" class='btn btn-xs btn-danger' title="Delete" onclick="return confirm('Are you sure you want to delete this Purchase Order?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<!-- PO Add Modal -->
<div class="modal fade" id="add_purchase_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="modal-title text-center" id="myModalLabel">Purchase Order</h2>
            </div>
            <form class="form-inline" role="form" method="post" id="po_modal" action="{{ url('merch/orders/purchase_order_store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <input type="hidden" name="order_id_for_po" value="{{$data->order_id}}">
                <div class="modal-body col-sm-offset-1 col-sm-10">
                    <div class="row col-sm-12">
                        <div class="form-group col-sm-4" style="margin-bottom: 15px;">
                            <label  class="col-sm-4 control-label no-padding-right" style="font-size: 10px;" for="po_number"> PO Number<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="po_number" name="po_number" class="col-xs-12 form-control" placeholder="PO Number" data-validation="required custom length" data-validation-length="1-20" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-4" style="margin-bottom: 15px;" >
                            <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_remarks"> PO Remarks</label>
                            <div class="col-sm-8">
                                <textarea style="width: 143px; height: 34px;" name="po_remarks" id="po_remarks" class="col-xs-12 form-control" placeholder="PO Remarks"  data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" data-validation-optional="true" style="height: 34px; width: 160px; padding-left: 10px"></textarea>
                            </div>
                        </div>


                        <div class="form-group col-sm-4" style="margin-bottom: 15px;" >
                            <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_delivery_country">Del. Country<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                {{ Form::select('po_delivery_country', $countryList, null, ['id'=>'po_delivery_country', 'placeholder'=> 'Delivery Country', 'class' => 'no-select form-control', 'style'=>'width:97%', 'data-validation'=>'required']) }}
                            </div>
                        </div>

                        <div class="form-group col-sm-4" style="margin-bottom: 15px;">
                            <label  class="col-sm-4 control-label no-padding-right" style="font-size: 10px;" for="po_qty">Total PO Quantity<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="po_qty" name="po_qty" class="col-xs-12 form-control po_qty" placeholder="Total PO Quantity" data-validation="required number length" data-validation-length="1-11"/>
                                <input type="hidden" name="ordered_po" value="{{ $total_po }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-4" style="margin-bottom: 15px;" >
                            <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="country_fob">Country FOB</label>
                            <div class="col-sm-8">
                                <input type="text" id="country_fob" name="country_fob" class="col-xs-12 form-control" placeholder="Country FOB" data-validation="custom"  data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group col-sm-4" style="margin-bottom: 15px;" >
                            <label style="font-size: 10px; text-align: right;" class="col-sm-4 control-label no-padding-right" for="po_ex_fty">Ex-Fty Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="po_ex_fty" name="po_ex_fty" class="close-datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="col-xs-12 form-control" placeholder="Ex-Fty Date" data-validation="required" autocomplete="off" />
                            </div>
                        </div>

                    </div>

                    <!-- Inseam and size  -->
                    <div class="row col-sm-12" id="inseam_size">
                        <div class="form-group col-sm-6" style="margin-bottom: 15px;">
                            <label class="col-sm-3 control-label no-padding-right" style="font-size: 10px;" for="po_number"> Inseam &amp; Size<span style="color: red">*</span> </label>
                            <div class="col-sm-7" style="padding-left: 0;">
                                <input type="text" id="po_inseam" name="po_inseam[]" class="col-xs-6" placeholder="Inseam" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&amp;a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;">
                                <input type="text" id="po_size" name="po_size[]" class="col-xs-6" placeholder="Size" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&amp;a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;">                                
                            </div>
                            <div class="col-sm-2" style="padding-left: 0; padding-right: 0;">
                                <button style="width: 25px;height: 29px;margin: 0px;padding: 0px;" type="button" class="btn btn-xs btn-success AddBtn">+</button>
                                <button style="width: 25px; height: 29px; margin: 0px; padding: 0px;" type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
                            </div>
                        </div>
                    </div>                    
                    <!-- Inseam and Size End -->
                    <!-- Color Input -->
                    <div class="row col-sm-12" id="color_add">
                        <div class="form-group col-sm-12" style="margin-bottom: 15px;" >
                            <label style="font-size: 10px;" class="col-sm-1 control-label no-padding-right" for="po_color_select">Colors<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                @if(!empty($colorList))
                                    @foreach($colorList as $colorId=>$color)
                                        <input type="checkbox" name="po_color_select[]" class="form-control po_color_select" id="color_{{ $color }}" data-id="{{ $colorId }}" value="{{ $color }}" /> 
                                        <label style="font-size: 10px;" for="color_{{ $color }}">{{ $color }}</label>
                                    @endforeach
                                @else 
                                    <p>No Color Found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                   <!-- Color Input End -->

                    <div class="row" id="sizeColorRow" style="display: none;">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped" id="sizeColorTable">
                                <thead style="background-color: #2C6AA0">
                                    <th>Color</th>
                                    <th>Group Size</th>
                                    <th>Size</th>
                                </thead>
                                <tbody id="sizeColorTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row" id="addColorSizeGroupTable" style="display: none">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #2C6AA0">
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Del Date</th>
                            </thead>
                            <tbody id="purchase_order_append_table"></tbody>
                        </table>
                    </div>
                </div>  <!-- Modal Body end -->

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9"> 
                        <button class="btn btn-info hide add_purchase_order_button" id="btn_purchase_order" type="submit" >
                            <i class="ace-icon fa fa-check bigger-110" ></i> Submit
                        </button>
                    </div>
                </div> <!-- Modal footer End -->
            </form>
        </div>
    </div>
</div>


<!-- Po Edit Modal -->
<div class="modal fade" id="purchase_order_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="modal-title text-center" id="myModalLabel">Purchase Order Edit</h2>
            </div>
            <form class="form-inline" role="form" method="post" id="po_modal" action="{{ url('merch/orders/purchase_order_update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="order_id_for_po" value="{{$data->order_id}}">
                <div class="modal-body col-sm-offset-1 col-sm-10" id="po_edit_modal">
                   
                </div>  <!-- Modal Body end -->
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div class="col-md-offset-3 col-md-9"> 
                        <button class="btn btn-info purchase_order_edit_button" id="btn_purchase_order_edit" type="submit">
                            <i class="ace-icon fa fa-check bigger-110" ></i> Update
                        </button>
                    </div>
                </div> <!-- Modal footer End -->
            </form>
        </div>
    </div>
</div>

{{-- faceing bootstrap datetimepicker position issue --}}
{{-- use bootstrap datepicker --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    // datepicker auto close
    jQuery('#addColorSizeGroupTable, #add_purchase_order').on('change','.close-datepicker',
        function(){ 
            $('.datepicker').hide();
    });
    $(document).ready(function() {
        // select color
        var temp_row_count = 0;
        $('.po_color_select').on('click', function() {
            var color_select_val    = $(this).val();
            var color_select_id     = $(this).data('id');
            if($(this).is(":checked")) {
                temp_row_count += 1;
                var html    = '<tr id="color_'+color_select_id+'">';
                html += '<td>\
                <input type="text" name="clr_id[]" value="'+color_select_val+'" tabindex = "-1" readonly/>\
                <input type="hidden" name="mr_product_color[]" value="'+color_select_id+'" /></td>';
                html += '<td><input type="text" name="po_sub_style_qty[]" class="subStleQtyCalc" data-validation="length number" data-validation-length="0-11" value="0"/></td>';
                html += '<td><input type="text" name="po_sub_style_deliv_date[]" class="close-datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" /></td>';
                html += '</tr>';
                $('#purchase_order_append_table').append(html);
                if ($('#btn_purchase_order').hasClass("hide")){
                    $('#addColorSizeGroupTable').show();
                    $('#btn_purchase_order').removeClass("hide"); 
                }
            } else {
                temp_row_count -= 1;
                $('tr#color_'+color_select_id).remove();
                if(temp_row_count == 0) {
                    $('#addColorSizeGroupTable').hide();
                    $('#btn_purchase_order').addClass("hide");
                }
            }
        });

        $('#dataTables').DataTable(); 
        //Total quantity can not be greater than Projected quantity
        $('body').on('keyup', '.po_qty', function(){
            var sum = 0;
            var already_ordered= "{{ ($total_po != null)? $total_po : 0  }}";
            // var already_ordered= parseInt($("#ordered_po").val());
            var total_qty= parseInt($(this).val())+parseInt(already_ordered);
            var projected_qty= parseInt($("#order_qty").val());
            if(total_qty> projected_qty){
                alert('PO quantity can not greater than order quantity');
                $(this).val(projected_qty);
            }
        });

        //PO Inseam and Size add more       
        var data= '<div class="form-group col-sm-6" style="margin-bottom: 15px;">\
                        <label class="col-sm-3 control-label no-padding-right" style="font-size: 10px;" for="po_number"> Inseam &amp; Size<span style="color: red">*</span> </label>\
                        <div class="col-sm-7" style="padding-left: 0;">\
                            <input type="text" id="po_inseam" name="po_inseam[]" class="col-xs-6" placeholder="Inseam" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&amp;a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;">\
                            <input type="text" id="po_size" name="po_size[]" class="col-xs-6" placeholder="Size" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&amp;a-z A-Z0-9]+)$" style="padding-right:0px; margin-right: 0px;">\
                        </div>\
                        <div class="col-sm-2" style="padding-left: 0; padding-right: 0;">\
                            <button style="width: 25px;height: 29px;margin: 0px;padding: 0px;" type="button" class="btn btn-xs btn-success AddBtn">+</button>\
                            <button style="width: 25px; height: 29px; margin: 0px; padding: 0px;" type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>\
                        </div>\
                    </div>';
        //when add purchase order
        $('body').on('click', '.AddBtn', function(){
            $("#inseam_size").append(data);
        });
        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().remove();
        });

        //when edit purchase order
        $('body').on('click', '.AddBtn', function(){
            $("#inseam_size_for_edit").append(data);
        });
        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().remove();
        });

        //get check box value in array and generate rows for PO add modal
        $("body").on("click", "#size_chart_generate", function(){
            var selected_colors= [];
            var style= $("#mr_style_stl_id").val();
            var b_id= $("#b_id").val();
            var br_id= $("#br_id").val();
            var po_ex_fty= $("#po_ex_fty").val();
            $(".po_color_select:checked").each(function() {
                selected_colors.push($(this).val());
            });

            $.ajax({
                url: "{{ url('merch/orders/sub_style_generate') }}",
                method: "get",
                data: {
                    selected_colors: selected_colors, 
                    b_id: b_id, 
                    br_id: br_id, 
                    po_ex_fty:po_ex_fty, 
                    style_id: style
                },
                success: function(data){  
                    if (data=="false")
                    {
                        $("#purchase_order_append_table").html("");
                        $(".add_purchase_order_button").addClass("hide");
                    }
                    else
                    {
                        $("#purchase_order_append_table").html(data);
                        $(".add_purchase_order_button").removeClass("hide");
                    }
                },
                error: function(xhr){
                    alert("failed"); 
                } 
            });  
        });

        //Reset Purchase order Add Modal on Hide
        $('#add_purchase_order').on('hidden.bs.modal', function (e) {
            temp_row_count              = 0;
            $('#addColorSizeGroupTable').hide();
            $('#purchase_order_append_table').html('');
            $(this).find("input,textarea,select").val('').end()
                .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
        });

       //Edit Purache order Model 
        $("#purchase_order_edit").on("shown.bs.modal", function(e){
           var id = $(e.relatedTarget).prev().val();
           var orderId = $(e.relatedTarget).prev().data('orderid');
            $.ajax({
                url: "{{ url('merch/orders/po_edit_modal_data') }}",
                method: "get",
                data: {po_id: id, order_id: orderId },
                success: function(data){
                    $("#po_edit_modal").html(data);
                    $("#modal_data").removeClass("hide");
                },
                error: function(xhr){
                    alert("failed");
                    $("#po_edit_modal").html("");
                    $("#modal_data").addClass("hide");
                } 
            });  
        });
        //clear edit modal
        $('#purchase_order_edit').on('hidden.bs.modal', function (e) {
            $(this).find("input,textarea,select").val('').end()
                .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
        });

        //get check box value in array and generate rows for PO edit modal
        $("body").on("click", "#size_chart_generate_edit", function(){
            var selected_colors= [];
            var style= $("#mr_style_stl_id").val();
            var b_id= $("#b_id").val();
            var br_id= $("#br_id").val();
            var po_ex_fty= $("#po_ex_fty").val();
            $(".po_color_select_edit:checked").each(function() {
                selected_colors.push($(this).val());
            });

            $.ajax({
                url: "{{ url('merch/orders/sub_style_generate') }}",
                method: "get",
                data: {
                    selected_colors: selected_colors, 
                    b_id: b_id, 
                    br_id: br_id, 
                    po_ex_fty:po_ex_fty, 
                    style_id: style
                },
                success: function(data){
                    if (data=="false")
                    {
                        $("#addRemoveEdit").html("");
                        $(".purchase_order_edit_button").addClass("hide");
                    }
                    else
                    {
                        $("#addRemoveEdit").html(data);
                        $(".purchase_order_edit_button").removeClass("hide");
                    }
                },
                error: function(xhr){
                    alert("failed");
                } 
            });  
        });

        //PO Quantity Check
        $('body').on('keyup', '.po_qty_edit', function(){
            var sum = 0;
            var already_ordered= parseInt($("#order_qty").val());
            var total_qty= parseInt($("#old_po_qty").val())+parseInt(already_ordered);
            var this_po_qty= parseInt($(this).val());
            if(this_po_qty>total_qty){
                alert('PO quantity can not greater than order quantity');
                $(this).val(total_qty);
            }
        });
        //Po Substyle Quantity Validation
        $('body').on('click', '.purchase_order_edit_button', function(e){
            var po_qty = parseInt($("#po_qty_edit").val());
            var sub_total=0;
            $(".subStleQtyCalcEdit").each(function(){
                sub_total+=parseInt($(this).val());
            });
            if(po_qty != sub_total){
                alert("Color-Size quantity must be equal to Purchase Order quantity!");
                e.preventDefault();
            }
        });
        //Po Substyle Quantity Validation
        $('body').on('click', '.add_purchase_order_button', function(e){
            var po_qty = parseInt($("#po_qty").val());
            var sub_total=0;
            $(".subStleQtyCalc").each(function(){
                sub_total+=parseInt($(this).val());
            });
            if(po_qty != sub_total){
                alert("Color-Size quantity must be equal to Purchase Order quantity!");
                e.preventDefault();
            } else if(po_qty==0){
                alert("Purchase Order quantity can be 0!");
                e.preventDefault();
            }
        });
    });

</script>
@endsection