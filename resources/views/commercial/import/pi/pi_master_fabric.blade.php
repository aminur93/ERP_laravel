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
                <li class="active"> PI Master Fabric/Accessories </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> PI Master Fabric/Accessories </small></h1>
            </div>
            <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/pi/master_fabric') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- 1st ROW -->
                <div class="row">
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="pi_no" > PI No<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" id="pi_no" name="pi_no" placeholder="PI No" value="" class="form-control col-xs-12" data-validation="required length custom" data-validation-length="1-20"  data-validation-regexp="^([-a-z A-Z0-9]+)$"/>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_file_id" > File No<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    {{ Form::select("cm_file_id", $fileList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_file_id', 'placeholder'=>'Select File No', 'data-validation'=>'required']) }}
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="mr_supplier_sup_id" > Supplier<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    {{ Form::select("mr_supplier_sup_id", $supplierList, null, ['class'=>'col-xs-12 form-control', 'id'=>'mr_supplier_sup_id', 'placeholder'=>'Select Supplier', 'data-validation'=>'required']) }}
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="pi_date" > PI Date<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" id="pi_date" name="pi_date" placeholder="YYYY-MM-DD" value="" class="col-xs-12 datepicker form-control" data-validation="required"/>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="pi_category" > PI Category<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <select name="pi_category" class="form-control col-xs-12" data-validation="required">
                                        <option value="Foreign" selected="selected">Foreign</option>
                                        <option value="Local">Local</option>
                                    </select>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="pi_last_date" > PI Last Date<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <input type="text" id="pi_last_date" name="pi_last_date" placeholder="YYYY-MM-DD" value="" class="col-xs-12 datepicker form-control" data-validation="required"/>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="ship_mode" > Ship Mode <span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <select name="ship_mode" class="form-control col-xs-12" data-validation="required">
                                        <option value="Sea" selected="selected">Sea</option>
                                        <option value="Air">Air</option>
                                        <option value="Road">Road</option>
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="pi_status" > PI Status <span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <select name="pi_status" class="form-control col-xs-12" data-validation="required">
                                        <option value="Active" selected="selected">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>    
                        </div> 
                       
                       
                       
                        <div class="col-sm-7 col-sm-offset-1">
                            {{-- Orders --}}
                            <table class="table table-bordered table-striped" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Style No</th>
                                        <th>FOB Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="order_list"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <legend>BOMs</legend>
                <!-- 2nd ROW -->
                <div class="row">
                    <!-- ORDERS -->
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Main Category</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Color</th>
                                    <th>Article</th>
                                    <th>Composition</th>
                                    <th>UOM</th>
                                    <th>Consumption</th>
                                    <th>Extra</th>
                                    <th>Total Qty</th>
                                    <th>Unit Price</th>
                                    <th>Currency</th>
                                    <th>PI Qty</th>
                                    <th>PI Value</th>
                                    <th>Ship Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- fabric category --}}
                            <tbody id="fabric_cat">
                                
                            </tbody>
                            <tr>
                               <td colspan="9" style="text-align: center; font-size: 14px; font-weight: bold;">Total Fabric</td> 
                               <td id="fabric_total_qty">0</td> 
                               <td></td> 
                               <td></td> 
                               <td id="fabric_total_pi_qty">0</td> 
                               <td id="fabric_total_pi_value">0</td> 
                               <td></td> 
                               <td></td> 
                            </tr>
                            {{-- Sewing Category --}}
                            <tbody id="sewing_cat">
                                
                            </tbody>
                            <tr>
                               <td colspan="9" style="text-align: center; font-size: 14px; font-weight: bold;">Total Sewing</td> 
                               <td id="sewing_total_qty">0</td> 
                               <td></td> 
                               <td></td> 
                               <td id="sewing_total_pi_qty">0</td> 
                               <td id="sewing_total_pi_value">0</td> 
                               <td></td> 
                               <td></td> 
                            </tr>
                            {{-- Finishing Category --}}
                            <tbody id="finish_cat">
                                
                            </tbody>
                            <tr>
                               <td colspan="9" style="text-align: center; font-size: 14px; font-weight: bold;">Total Finishing</td> 
                               <td id="finishing_total_qty">0</td> 
                               <td></td> 
                               <td></td> 
                               <td id="finishing_total_pi_qty">0</td> 
                               <td id="finishing_total_pi_value">0</td> 
                               <td></td> 
                               <td></td>  
                            </tr>
                            
                            <tr>
                               <td colspan="9" style="text-align: center; font-size: 14px; font-weight: bold;">Grand Total</td> 
                               <td id="grand_total_qty">0</td> 
                               <td></td> 
                               <td></td> 
                               <td id="grand_total_pi_qty">0</td> 
                               <td id="grand_total_pi_value">0</td> 
                               <td></td> 
                               <td></td>  
                            </tr>
                            
                        </table>
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
                </div>
            </form> 
        </div><!-- /.page-content -->
    </div>
</div> 
<script type="text/javascript">
$(document).ready(function(){
    $("#dataTables").DataTable({
            "searching": false,
            "info": false
        });

    //get Order List on Supplier select
    $("#mr_supplier_sup_id").on("change", function(e){
        
        $("#fabric_cat").html("");
        $("#sewing_cat").html("");
        $("#finish_cat").html("");
        $("#fabric_total_qty").val(0);
        $("#fabric_total_pi_qty").val(0);
        $("#fabric_total_pi_value").val(0);
        $("#sewing_total_qty").val(0);
        $("#sewing_total_pi_qty").val(0);
        $("#sewing_total_pi_value").val(0);
        $("#finishing_total_qty").val(0);
        $("#finishing_total_pi_qty").val(0);
        $("#finishing_total_pi_value").val(0);
        $("#grand_total_qty").val(0);
        $("#grand_total_pi_qty").val(0);
        $("#grand_total_pi_value").val(0);

        var file= $("#cm_file_id").val();
        var supplier= $(this).val();
        if(file == ""){
            alert("Please select File No");
            $(this).val("");
            e.preventDefault();
        }
        else{
            $.ajax({
                method: "get",
                url : "{{ url('commercial/import/pi/get_order_list') }}",
                dataType: 'json',
                data: {file_id: file, sup_id: supplier},
                success: function(data)
                {  
                    $("#order_list").html(data)
                }, 
                error: function(xhr)
                {
                    alert('failed...');
                }
            });   
        }
    });

    //reset everything
    $("#cm_file_id").on("change", function(){
        $('#mr_supplier_sup_id').val('').change();
        $("#fabric_cat").html("");
        $("#sewing_cat").html("");
        $("#finish_cat").html("");
        $("#fabric_total_qty").val(0);
        $("#fabric_total_pi_qty").val(0);
        $("#fabric_total_pi_value").val(0);
        $("#sewing_total_qty").val(0);
        $("#sewing_total_pi_qty").val(0);
        $("#sewing_total_pi_value").val(0);
        $("#finishing_total_qty").val(0);
        $("#finishing_total_pi_qty").val(0);
        $("#finishing_total_pi_value").val(0);
        $("#grand_total_qty").val(0);
        $("#grand_total_pi_qty").val(0);
        $("#grand_total_pi_value").val(0);

    });

    //get Bom Information On Select(Checckbox) Order from Order List

    $("body").on("click", ".order_select",function() {
        if(this.checked) {
            $.ajax({
                method: "get",
                url : "{{ url('commercial/import/pi/get_bom_info') }}",
                dataType: 'json',
                data: {order_id: $(this).val(), sup_id: $("#mr_supplier_sup_id").val()},
                success: function(data)
                {  
                    $("#fabric_cat").append(data.fabric);
                    $("#sewing_cat").append(data.sewing);
                    $("#finish_cat").append(data.finishing);
                    calculateSubTotal();
                }, 
                error: function(xhr)
                {
                    alert('failed...');
                }
            }); 
        }
        else{
            var x= $(this).val();
             $("#fabric_cat").find('tr[id="'+x+'"]').remove();
             $("#sewing_cat").find('tr[id="'+x+'"]').remove();
             $("#finish_cat").find('tr[id="'+x+'"]').remove();
        }
    });

    //Remove a BOM row
    $("body").on("click", "#remove_row", function(){
        
        var x= $(this).parent().parent().remove();
        calculateSubTotal();
    });

    //Onchage value change subtotal

    $("body").on("keyup", ".fab_pi_qty", function(){
        var x=parseInt($(this).parent().prev().prev().text());
        var y= parseFloat($(this).val());
        var z= parseFloat(parseFloat(x)*parseFloat(y)).toFixed(2);
        $(this).parent().next().children().val(z);
        calculateSubTotal();
    });

    $("body").on("keyup", ".sw_pi_qty", function(){
        var x=parseInt($(this).parent().prev().prev().text());
        var y= parseFloat($(this).val());
        var z= parseFloat(parseFloat(x)*parseFloat(y)).toFixed(2);
        $(this).parent().next().children().val(z);
        calculateSubTotal();
    });

    $("body").on("keyup", ".fin_pi_qty", function(){
        var x=parseInt($(this).parent().prev().prev().text());
        var y= parseFloat($(this).val());
        var z= parseFloat(parseFloat(x)*parseFloat(y)).toFixed(2);
        $(this).parent().next().children().val(z);
        calculateSubTotal();
    });

    //calculate Sub Total
    function calculateSubTotal(){
        var fabric_total_qty= 0;
        var sewing_total_qty= 0;
        var finishing_total_qty= 0;
        var fabric_pi_qty= 0;
        var sewing_pi_qty= 0;
        var finishing_pi_qty= 0;
        var fabric_pi_value= 0;
        var sewing_pi_value= 0;
        var finishing_pi_value= 0;

        // grand total
        var grand_total_qty = 0;
        var grand_total_pi_qty = 0;
        var grand_total_pi_value = 0;
        //fabric precost total quantity
        $(".fab_precost_qty").each(function(i, v) {
            fabric_total_qty = parseFloat(parseFloat(fabric_total_qty)+parseFloat($(this).text())).toFixed(2); 
        });

        //sewing precost total quantity
        $(".sw_precost_qty").each(function(i, v) {
            sewing_total_qty = parseFloat(parseFloat(sewing_total_qty)+parseFloat($(this).text())).toFixed(2); 
        });

        //finishing precost total quantity
        $(".fin_precost_qty").each(function(i, v) {
            finishing_total_qty = parseFloat(parseFloat(finishing_total_qty)+parseFloat($(this).text())).toFixed(2); 
        });

        //fabric PI total quantity
        $(".fab_pi_qty").each(function(i, v) {
            fabric_pi_qty = parseFloat(parseFloat(fabric_pi_qty)+parseFloat($(this).val())).toFixed(2); 
        });

        //sewing PI total quantity
        $(".sw_pi_qty").each(function(i, v) {
            sewing_pi_qty = parseFloat(parseFloat(sewing_pi_qty)+parseFloat($(this).val())).toFixed(2); 
        });

        //finishing PI total quantity
        $(".fin_pi_qty").each(function(i, v) {
            finishing_pi_qty = parseFloat(parseFloat(finishing_pi_qty)+parseFloat($(this).val())).toFixed(2); 
        });

        //fabric PI total value
        $(".fab_pi_value").each(function(i, v) {
            fabric_pi_value = parseFloat(parseFloat(fabric_pi_value)+parseFloat($(this).val())).toFixed(2); 
        });

        //sewing PI total value
        $(".sw_pi_value").each(function(i, v) {
            sewing_pi_value = parseFloat(parseFloat(sewing_pi_value)+parseFloat($(this).val())).toFixed(2); 
        });

        //finishing PI total value
        $(".fin_pi_value").each(function(i, v) {
            finishing_pi_value = parseFloat(parseFloat(finishing_pi_value)+parseFloat($(this).val())).toFixed(2); 
        });

        //grand
        grand_total_qty= parseFloat(parseFloat(fabric_total_qty)+parseFloat(sewing_total_qty)+parseFloat(finishing_total_qty)).toFixed(2);
        grand_total_pi_qty= parseFloat(parseFloat(fabric_pi_qty)+parseFloat(sewing_pi_qty)+parseFloat(finishing_pi_qty)).toFixed(2);
        grand_total_pi_value= parseFloat(parseFloat(fabric_pi_value)+parseFloat(sewing_pi_value)+parseFloat(finishing_pi_value)).toFixed(2);

        $("#grand_total_qty").text(grand_total_qty);
        $("#grand_total_pi_qty").text(grand_total_pi_qty);
        $("#grand_total_pi_value").text(grand_total_pi_value);
        
        //sub
        $("#fabric_total_qty").text(fabric_total_qty);
        $("#sewing_total_qty").text(sewing_total_qty);
        $("#finishing_total_qty").text(finishing_total_qty);

        $("#fabric_total_pi_qty").text(fabric_pi_qty);
        $("#sewing_total_pi_qty").text(sewing_pi_qty);
        $("#finishing_total_pi_qty").text(finishing_pi_qty);

        $("#fabric_total_pi_value").text(fabric_pi_value);
        $("#sewing_total_pi_value").text(sewing_pi_value);
        $("#finishing_total_pi_value").text(finishing_pi_value);
    }
});
</script>
@endsection