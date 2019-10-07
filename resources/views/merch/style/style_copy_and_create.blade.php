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
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Style & Library </a>
                </li> 
                <li class="active"> Style Copy & Create </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <style type="text/css">#styleInfo label{font-weight:bold}</style>

        <div class="widget-box transparent">

            <div class="widget-header widget-header-large">
                <h3 class="widget-title blue lighter"> 
                   Style & Library <small><i class="ace-icon fa fa-angle-double-right"></i> Style Copy & Create  </small>
                </h3> 
                <div class="widget-toolbar hidden-480">
                    <a href="#">
                        <i class="ace-icon fa fa-print fa-2x" onclick="printMe('styleInfo')"></i>
                    </a>
                </div>
            </div> 

            {{ Form::open(["url" => "merch/stylelibrary/store_style_bom_and_costing", "class"=>"form-horizontal"]) }}
            <input type="hidden" name="stl_id" id="stl_id">
            <input type="hidden" name="stl_code" >

            <div class="widget-body">
                <div class="widget-main">
                      <!-- Display Erro/Success Message -->
                    @include('inc/message')
                    <div class="col-sm-6 ">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="filter_stl_code" > Short Code</label>
                                <div class="col-sm-8">
                                    {{ Form::select('', $styleCodeList, null, ['placeholder'=>'Select Style Code', 'class'=> 'col-xs-12 filter', 'id'=>'filter_stl_code']) }}  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="filter_stl_no" > Style No</label>
                                <div class="col-sm-8">
                                    {{ Form::select('', $styleNoList, null, ['placeholder'=>'Select Style No.', 'class'=> 'col-xs-12 filter', 'id'=>'filter_stl_no']) }}  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="filter_stl_order_type" > Production Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control filter" id="filter_stl_order_type">
                                        <option value="">Select</option>
                                        <option value="Development">Development</option>
                                        <option value="Bulk">Bulk</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div id="styleInfo" class="hide">
                        <div class="col-sm-12">
                            <table class="table table-bordered" cellspacing="0" width='100%' border="1"> 
                            <thead> 
                                <tr>
                                    <th>Copy</th> 
                                    <th colspan="5">Style</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th width="10%">Production Type<span class="color: red">&#42;</span></th>
                                    <td width="23.33%"> 
                                      <label class="radio-inline">
                                        <input type="radio" name="stl_order_type" id="stl_order_type1" value="Development" checked data-validation="required"> Development
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="stl_order_type" id="stl_order_type2" value="Bulk" data-validation="required">
                                        Bulk
                                      </label>
                                    </td>
                                    <th width="10%">Style No<span class="color: red">&#42;</span></th> 
                                    <td width="23.33%"> <input type="text" id="stl_no" name="stl_no"  placeholder="Enter value" class="col-xs-12" data-validation="required length" data-validation-length="1-30"/><span></span></td>
                                    <th width="10%">Short Code<span class="color: red">&#42;</span></th> 
                                    <td width="23.33%" id="stl_code"></td>
                                </tr>
                                <tr>
                                    <th>Buyer<span class="color: red">&#42;</span></th>
                                    <td>{{ Form::select('b_id', $buyerList, null, ['placeholder'=>'Select Buyer', 'class'=> 'col-xs-12  no-select', 'id'=>"b_id", 'data-validation' => 'required']) }}</td>
                                    <th>Garments Type</th>
                                    <td id="gmt_id"></td>
                                    <th>Size Group</th>
                                    <td id="prdsz_id"></td>
                                </tr>
                                <tr>
                                    <th>Product Type</th>
                                    <td id="prd_type_id"></td>
                                    <th>Description</th>
                                    <td id="stl_description"></td>
                                    <th>Season<span class="color: red">&#42;</span></th>
                                    <td>{{ Form::select('se_id', [], null, ['placeholder'=>'Select', 'id'=>'se_id', 'class'=> 'col-xs-12 no-select', 'data-validation' => 'required']) }}</td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td id="stl_product_name"></td>
                                    <th>CM/pc</th>
                                    <td id="stl_cm"></td>
                                    <th>Wash/pc</th>
                                    <td id="stl_wash"></td>
                                </tr>
                                <tr>
                                    <th>SMV/pc</th>
                                    <td id="stl_smv"></td>
                                    <th>Sample Type</th>
                                    <td id="mr_sample_style" colspan="3"></td>
                                </tr>
                                <tr>
                                    <th>Operation</th>
                                    <td id="opr_id"></td>
                                    <th>Special Machine</th>
                                    <td id="sp_machine_id" colspan="3"></td> 
                                </tr> 
                            </tbody>
                            </table>
                        </div>

                        <!-- bom info -->
                        <div class="col-sm-12" id="boms"></div>

                        <!-- costing info -->
                        <div class="col-sm-12" id="costing"></div>


                        <!-- Submit Button -->
                        <div class="col-sm-12">
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9"> 
                                    <button class="btn btn-info no-print" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn no-print" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- PAGE CONTENT ENDS -->
                </div>
            </div>
            {{ Form::close() }}
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function()
{ 
    var styleInfo   = $("#styleInfo");
    var stl_id      = $("#stl_id");
    var stl_order_type = $("#stl_order_type");
    var prd_type_id = $("#prd_type_id");
    var b_id        = $("#b_id");
    var stl_product_name = $("#stl_product_name");
    var stl_smv     = $("#stl_smv");
    var gmt_id      = $("#gmt_id");
    var stl_description = $("#stl_description");
    var stl_cm      = $("#stl_cm");
    var prdsz_id    = $("#prdsz_id");
    var stl_wash    = $("#stl_wash");
    var stl_code    = $("#stl_code");
    var stl_code1    = $("input[name=stl_code]");
    var opr_id      = $("#opr_id");
    var sp_machine_id = $("#sp_machine_id");
    var mr_sample_style = $("#mr_sample_style");
    var boms        = $("#boms");
    var costing     = $("#costing");

    $("body").on("change", '.filter', function(){
        var filter_stl_no   = $("#filter_stl_no").val();
        var filter_stl_code = $("#filter_stl_code").val();
        var filter_stl_order_type = $("#filter_stl_order_type").val();

        $.ajax({
            url: "{{ url('merch/stylelibrary/get_style_and_bom') }}",
            type: 'get',
            dataType: 'json',
            data: {filter_stl_no, filter_stl_code, filter_stl_order_type},
            success: function(data)
            {
                if (data.status)
                {
                    styleInfo.removeClass('hide');
                    var result = data.response;
                    stl_id.val(result.stl_id); 
                    $('input[name=stl_order_type][value='+result.stl_order_type+']').prop("checked", true);
                    prd_type_id.html(result.prd_type_name); 
                    stl_product_name.html(result.stl_product_name);
                    stl_smv.html(result.stl_smv);
                    gmt_id.html(result.gmt_name);
                    stl_description.html(result.stl_description);
                    stl_cm.html(result.stl_cm);
                    prdsz_id.html(result.prdsz_group);
                    stl_wash.html(result.stl_wash);
                    stl_code.html(result.stl_code);
                    stl_code1.val(result.stl_code);

                    if (data.operations && (data.operations).length > 0)
                    {
                        var opt = "";
                        var x = (data.operations).length;
                        $(data.operations).each(function(i,v){
                            opt += v;
                            if (i<x)
                            opt += "/";
                            x--;
                        });
                        opr_id.html(opt);
                    }
                    else
                    {
                        opr_id.html(''); 
                    }

                    if (data.machines && (data.machines).length > 0)
                    {
                        var mch = "";
                        var x = (data.machines).length;
                        $(data.machines).each(function(i,v){
                            mch += v;
                            if (i<x)
                            mch += "/";
                            x--;
                        });
                        sp_machine_id.html(mch); 
                    }
                    else
                    {
                        sp_machine_id.html(''); 
                    }

                    if (data.samples && (data.samples).length > 0)
                    {
                        var smp = "";
                        var x = (data.samples).length;
                        $(data.samples).each(function(i,v){
                            smp += v;
                            if (i<x)
                            smp += "/";
                            x--;
                        });
                        mr_sample_style.html(smp);
                    }
                    else
                    {
                        mr_sample_style.html('');
                    }

                    if (data.boms && (data.boms).length>0)
                    {
                        var bomDetails = "<table class='table table-bordered' border='1' cellspacing=\"0\" width='100%'>"+
                            "<thead>"+
                            "<tr><th><label><input name=\"copy_bom\" value=\"1\" class=\"ace ace-checkbox-2\" type=\"checkbox\"><span class=\"lbl\"> Copy</span></label></th><th colspan=\"15\">BOM</th></tr>"+
                            "<tr><th>Main Category</th>"+
                            "<th>Sub Category</th>"+
                            "<th>Item</th>"+
                            "<th>Color</th>"+
                            "<th>Size</th>"+
                            "<th>Article</th>"+
                            "<th>Construction</th>"+
                            "<th>Composition</th>"+
                            "<th>Mill</th>"+
                            "<th>UoM</th>"+
                            "<th>Consumption</th>"+
                            "<th>Extra</th>"+
                            "<th>Req. Qty</th>"+
                            "<th>Unit Price</th>"+
                            "<th>Value</th>"+
                            "<th>Supplier</th>"+
                            "</tr></thead><tbody>";
 
                        $(data.boms).each(function(i,v){ 
                            bomDetails += "<tr><td>"+v.mcat_name+"</td>"+
                            "<td>"+v.msubcat_name+"</td>"+
                            "<td>"+v.matitem_name+"</td>"+
                            "<td>"+v.clr_name+"</td>"+
                            "<td>"+v.sz_name+"</td>"+
                            "<td>"+(v.art_name?v.art_name:'')+"</td>"+
                            "<td>"+(v.art_construction?v.art_construction:'')+"</td>"+
                            "<td>"+(v.art_dimension?v.art_dimension:'')+"</td>"+
                            "<td>"+v.bom_mill+"</td>"+
                            "<td>"+v.bom_uom+"</td>"+
                            "<td>"+v.bom_consumption+"</td>"+
                            "<td>"+v.bom_extra+"</td>"+
                            "<td>"+(v.bom_cost_req_qty?v.bom_cost_req_qty:'')+"</td>"+
                            "<td>"+(v.bom_cost_unit_price?v.bom_cost_unit_price:'')+"</td>"+
                            "<td>"+(v.bom_cost_value?v.bom_cost_value:'')+"</td>"+
                            "<td>"+(v.sup_name?v.sup_name:'')+"</td></tr>";
                        });

                        bomDetails += "</tbody></table>";
                        boms.html(bomDetails);
                    }
                    else
                    {
                        boms.html('');
                    }

                    if (data.costing)
                    {
                        var x = data.costing; 

                        htmlDetails = "<table class=\"table table-bordered\" border='1' cellspacing=\"0\" width='100%'>"+
                            "<thead><tr><th><label><input name=\"copy_costing\" value=\"1\" class=\"ace ace-checkbox-2\" type=\"checkbox\"><span class=\"lbl\"> Copy</span></label></th><th colspan=\"5\">Costing</th></tr></thead>"+ 
                            "<tbody>"+
                                "<tr>"+
                                    "<th width='10%'>Wash Cost/gmt</th>"+
                                    "<td>"+x.bom_stl_cost_wash+"</td>"+
                                    "<th>Wash Description</th>"+
                                    "<td>"+x.bom_stl_cost_wash_desc+"</td>"+
                                    "<th>Print/gmt</th>"+
                                    "<td>"+x.bom_stl_cost_print+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<th>CM</th>"+
                                    "<td>"+x.bom_stl_cost_cm+"</td>"+
                                    "<th>Special Process Cost</th>"+
                                    "<td>"+x.bom_stl_cost_spc_process_cost+"</td>"+
                                    "<th>Embroidery/gmt</th>"+
                                    "<td>"+x.bom_stl_cost_embroidery+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<th>Commercial Cost</th>"+
                                    "<td>"+x.bom_stl_cost_commercial_cost+"</td>"+
                                    "<th></th>"+
                                    "<td></td>"+
                                    "<th>Profit Margin(%)</th>"+
                                    "<td>"+x.bom_stl_cost_profit_percent+"</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<th>Special Machine Cost</th>"+
                                    "<td>"+x.bom_stl_cost_sp_machine_cost+"</td>"+
                                    "<th>Remarks</th>"+
                                    "<td colspan=\"3\">"+x.bom_stl_cost_remarks+"</td>"+
                                "</tr>"+
                            "</tbody>"+
                        "</table>";

                        costing.html(htmlDetails);  
                    }
                    else
                    {
                        costing.html('')  
                    }
                }
                else
                {
                    styleInfo.removeClass('show').addClass("hide");
                    stl_id.val('');
                    $('input[name=stl_order_type]').prop("checked", false);
                    prd_type_id.html(''); 
                    stl_product_name.html('');
                    stl_smv.html('');
                    gmt_id.html('');
                    stl_description.html('');
                    stl_cm.html('');
                    prdsz_id.html('');
                    stl_wash.html('');
                    stl_code.html('');
                    stl_code1.val('');
                    opr_id.html('');
                    sp_machine_id.html('');
                    mr_sample_style.html('');
                    boms.html('');
                    costing.html('');  
                }
            },
            error: function(xhr)
            {
                alert("failed...");
            }
        });
    });

    //check exists
    $("input[name=stl_order_type], #stl_no").on("change keyup", function(){
        var stl_no = $("#stl_no").val();
        var stl_order_type = $("input[name=stl_order_type]:checked").val();
        var stl_code = $("input[name=stl_code]").val();


        if (stl_no=='' || stl_order_type=='' || stl_code=='')
        {
            return false;
        }

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ url("merch/stylelibrary/check_exists") }}',
            type: 'post',
            data: { stl_no, stl_order_type, stl_code},
            success: function(data)
            {
                if (data.status)
                {
                    $("#stl_no").next().html('');
                }
                else
                {
                    $("#stl_no").next().removeClass('text-success').addClass('text-danger').html(data.error);
                }
            },
            error: function()
            {
                alert('wait...');
            }
        })
    });
 

    // create shortcode
    var event = $("#b_id, #stl_product_name");
    event.on("change", function(){
        if ($("#b_id").find(":selected").val() != "")
        var b_id    = $("#b_id").find(":selected").val();
        var buyer   = $("#b_id").find(":selected").text();
        var product = $("#stl_product_name").text();

        $.ajax({
            url: "{{ url('merch/stylelibrary/shortcode') }}",
            type: 'get',
            dataType: 'json',
            data: {b_id, buyer, product},
            success: function(data)
            {
                $("#se_id").html(data.seasonList);
            },
            error: function(xhr)
            {
                alert("failed...");
            }
        });
    });   
});  

function printMe(divName)
{ 
    var myWindow=window.open('','','width=800,height=800');
    myWindow.document.write(document.getElementById(divName).innerHTML); 
    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();
}
</script>
@endsection