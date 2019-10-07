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
                        <a href="#"> Chalan </a>
                    </li>
                    <li class="#"> Chalan Data</li>
                    <li class="active">  Chalan Data Update   </li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1> Chalan Data Update <small><i class="ace-icon fa fa-angle-double-right"></i>  Chalan Data Entry Update  </small></h1>
                </div>

                <!--Form-->
                <h5 class="page-header">Add Information</h5>
                <form action="{{ url('comm/import/chalan/chalanedit',$chalans->id) }}" class="form-horizontal" role="form" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <!-- Display Erro/Success Message -->
                        @include('inc/message')

                        <div class="col-sm-6">

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="bank" >Bank: <span style="color: red">&#42;</span></label>

                                <div class="col-sm-8">
                                    <select name="bank" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($bank as $bak)
                                            <option value="{{ $bak->id }}" @if($chalans->cm_bank_id == $bak->id) selected @endif>{{ $bak->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="tr_doc1" >Transport Doc No. 1:</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->transp_doc_no1 }}" name="tr_doc1" placeholder="Auto" class="col-xs-12"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="tr_doc_date" >Transport Doc Date: </label>

                                <div class="col-sm-8">
                                    <input type="date" value="{{ $chalans->transp_doc_date }}" name="tr_doc_date" placeholder="Enter" class="col-xs-12"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="carrier" >Value :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->value }}" name="value" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="carrier" >Carrier :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->carrier }}" name="carrier" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="doc_type" >Doc Type:</label>

                                <div class="col-sm-8">

                                    <?php
                                    $docList = array(
                                        "Email" => "Email",
                                        "Original" => "Original",
                                        "Phone" => "Phone",
                                        "Others" => "Others",
                                        "Shipment Advice" => "Shipment Advice",
                                        "Non-negotiable Partial" => "Non-negotiable Partial");
                                    ?>

                                    <select name="doc_type" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($docList as $dl)
                                            <option value="{{ $dl }}" @if($chalans->doc_type == $dl) selected @endif>{{ $dl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="bank" >Arriving Date : </label>

                                <div class="col-sm-8">
                                    <input type="date" name="arriving_date" placeholder="Enter" class="col-xs-12"/>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="examine_date">File No: </label>

                                <div class="col-sm-8">
                                    <select name="file_no" id="" class="form-control file_no ">
                                        <option value="">Select File</option>
                                        @foreach($cm_file as $cf)
                                            <option value="{{ $cf->id }}"  {{$chalans->cm_file_id == $cf->id ? 'selected' :''}} >{{ $cf->file_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="unit">Unit : </label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->hr_unit }}" name="unit" placeholder="Enter" id="unitname"  value="" class="form-control unitName" readonly="readonly" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="supplier">Supplier</label>

                                <div class="col-sm-8">
                                    <select name="supplier" id="" class="form-control supplier_no">
                                        <option value="">Select</option>
                                        @foreach($cm_supplier as $csup)
                                            <option value="{{ $csup->sup_id }}" {{ $chalans->mr_supplier_sup_id == $csup->sup_id ? 'selected' : '' }}>{{ $csup->sup_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="ilcno">ILC No : </label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->cm_btb_id }}" name="ilcno" placeholder="Enter" value="" class="form-control ilcNo" readonly="readonly"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="value" >Quantity :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->qty }}" name="quantity" placeholder="Enter" class="col-xs-8" />

                                    <select class="col-sm-3" name="currency" data-validation="required length" data-validation-length="1-45">
                                        <option selected="selected">Uom</option>
                                        @foreach($uoms as $um)
                                            <option value="{{ $um->id }}">{{ $um->uom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="tr_doc_date" >Document Date: </label>

                                <div class="col-sm-8">
                                    <input type="date" value="{{ $chalans->doc_recv_date }}" name="doc_date" placeholder="Enter" class="col-xs-12"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="carrier" >Package :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $chalans->package }}" name="package" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table id="bomTable" class="table table-bordered table-striped table-highlight" >
                                    <thead>
                                    <th>Invoice No.</th>
                                    <th>Invoice Date</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody class="addRemoves min-font">
                                    @foreach($cm_invoice as $ci)
                                    <tr id="invoice0" class="no-padding">

                                        <td>
                                            <input type="text" value="{{ $ci->invoice_no }}" name="invoiceno[]" placeholder="Enter"class="form-control" />
                                            <input type="hidden" name="rowno[]" value="invoice0" class="invrow" />
                                        </td>

                                        <td style="max-width:122px;">
                                            <input type="date" value="{{ $ci->invoice_date }}" name="invoicedate[]" class="form-control" />
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-xs btn-success Addbtn">+</button>
                                            <button type="button" class="btn btn-xs btn-danger Removebtn">-</button>
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table id="bomTable" class="table table-bordered table-striped table-highlight" >
                                    <thead>
                                    <th>PI No.</th>
                                    <th>PI Date</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody class="addRemove min-font">
                                    @foreach($cm_pi_invoice as $cpi)
                                    <tr id="pi0" class="no-padding">

                                        <td style="min-width:75px;">
                                            <select name="pi_no[]" id="pi_no" class="pi_no form-control">
                                                <option>Select</option>
                                                @foreach($cm_pi as $pno)
                                                    <option value="{{$pno->id}}" @if($cpi->pi_no == $pno->pi_no) selected @endif>{{$pno->pi_no}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="pirowno[]" value="pirow0" class="pirow" />
                                        </td>

                                        <td style="max-width:122px;">
                                            <input type="date" name="pidate[]" value="{{ $cpi->pi_date }}" id="pidate" class="form-control pidate" readonly="readonly" />
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-xs btn-success AddBtn">+</button>
                                            <button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive wrapper">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="impdatatype"placeholder="Enter" class="form-control" value="Local" />

                                <input type="hidden" name="import_id" placeholder="Enter" class="form-control" value="" />

                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Back
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            var count = 1;
            //Add More invoice table
            $('body').on('click', '.Addbtn', function(){

                var data = '<tr id="invoice'+count+'" class="no-padding">'+

                    '<td>'+
                    '<input type="text" name="invoiceno[]" placeholder="Enter" class="form-control" />'+
                    '<input type="hidden" name="rowno[]" value="invoice'+count+'" class="invrow" />'+
                    '</td>'+

                    '<td>'+
                    '<input type="date" name="invoicedate[]" class="datepicker form-control" />'+
                    ' </td>'+

                    '<td>'+
                    '<button type="button" class="btn btn-xs btn-success Addbtn">+</button>'+
                    '<button type="button" class="btn btn-xs btn-danger Removebtn">-</button>'+
                    '</td>'+
                    '</tr>';

                $('.addRemoves').append(data);
                count++;
            });

            $('body').on('click', '.Removebtn', function(){
                $(this).parent().parent().remove();
                var rowid=$(this).parent().parent().attr("id");
                $("table."+rowid).remove();  // remove table with rowid class name

                //$("table#"+rowid).remove();
                // $("table#table_id_"+ $(this).parent().parent().attr("id")).remove();
            });

            var counts = 1;
            //Add More Pi Table
            $('body').on('click', '.AddBtn', function(){

                var data = '<tr id="pi'+count+'" class="no-padding">'+

                    '<td>'+
                    '<select name="pi_no[]" id="pi_no" class="pi_no form-control">'+
                    '<option>Select</option>'+
                    '@foreach($cm_pi as $pno)'+
                    '<option value="{{$pno->pi_no}}">{{$pno->pi_no}}'+
                    '</option>'+
                    '@endforeach'+
                    '</select>'+
                    '<input type="hidden" name="pirowno[]" value="pirow'+counts+'" class="pirow" />'+
                    ' </td>'+

                    '<td>'+
                    '<input type="date" name="pidate[]" id="pidate" class="form-control pidate" readonly="readonly" />'+
                    '</td>'+

                    '<td>'+
                    '<button type="button" class="btn btn-xs btn-success AddBtn">+</button>'+
                    '<button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>'+
                    '</td>'+
                    '</tr>';

                $('.addRemove').append(data);
                count++;
            });

            $('body').on('click', '.RemoveBtn', function(){
                $(this).parent().parent().remove();
                var rowid=$(this).parent().parent().attr("id");
                $("table."+rowid).remove();  // remove table with rowid class name

                //$("table#"+rowid).remove();
                // $("table#table_id_"+ $(this).parent().parent().attr("id")).remove();
            });
            $(document).on('keyup', '#t_qty', function(e){

              //$("#t_qty, #u_price").keyup(function(){
                //console.log($(this).parent().parent().find('#pi_values').val());
                  var rate = parseFloat($(this).parent().parent().find('#t_qty').val()) || 0;
                  var box = parseFloat($(this).parent().parent().find('#u_price').val()) || 0;

                $(this).parent().parent().find('#pi_values').val(rate * box);
              //});

            });
            $(document).on('keyup', '#u_price', function(e){

              //$("#t_qty, #u_price").keyup(function(){
                //console.log($(this).parent().parent().find('#pi_values').val());
                  var rate = parseFloat($(this).parent().parent().find('#t_qty').val()) || 0;
                  var box = parseFloat($(this).parent().parent().find('#u_price').val()) || 0;

                $(this).parent().parent().find('#pi_values').val(rate * box);
              //});

            });
//Pi select weise table
$(document).on('change', '#pi_no', function(e){
//              var file_id = $('#pi_no').find(":selected").val();
    var pi_master_id = $(this).val();
    console.log('PI No:',pi_master_id);

    if(pi_master_id){
        $.ajax({
            url: "{{url('comm/import/chalandata/getpiTable')}}",
            type: 'get',
            data: {pi_master_id: pi_master_id ,_token: '{{csrf_token()}}' },
            success: function (response) {
                //$('.wrapper').empty();
                $('.wrapper').append(response);

                // $("#t_qty, #u_price").keyup(function(){
                //     var rate = parseFloat($('#t_qty').val()) || 0;
                //     var box = parseFloat($('#u_price').val()) || 0;
                //
                //     $('#pi_values').val(rate * box);
                // });
            }
        })
    }else{
        $('.wrapper').empty();
    }


});

//    var file_id = $('#pi_no').find(":selected").val();
var pi_master_id_again = $('#pi_no').val();
if(pi_master_id_again){
    $.ajax({
        // url:'/comm/import/chalandata/editTable/'+pi_master_id_again,
        // type: 'get',
        url: "{{url('comm/import/chalandata/editTable')}}",
        type: 'get',
        data: {pi_master_id_again: pi_master_id_again ,_token: '{{csrf_token()}}' },
        success: function (response) {
//             if(response.length!=0){
//                 var response = JSON.parse(response);
// //                    $('.wrapper').empty();
//                 $.each(response, function( key,value ) {
//                     var data =
//                         '<table id="bomTable" class="table table-bordered table-striped table-highlight" >'+
//                         '<thead>'+
//                         '<th>Category</th>'+
//                         '<th>Description</th>'+
//                         '<th>Color</th>'+
//                         '<th>Articel</th>'+
//                         '<th>Composition</th>'+
//                         '<th>Construction</th>'+
//                         '<th>Uom</th>'+
//                         '<th>Consumption</th>'+
//                         '<th>Extra</th>'+
//                         '<th>Total Qty</th>'+
//                         '<th>Unit Price</th>'+
//                         '<th>Currency</th>'+
//                         '<th>Pi Qty</th>'+
//                         '<th>Pi Value</th>'+
//                         '<th>Shipped Qty</th>'+
//                         '<th>Action</th>'+
//                         '</thead>'+
//                         '<tbody class="addRemovees min-font">'+
//                         '@foreach($cm_pi_master as $cpm)'+
//                         '<tr id="chalanbom0" class="no-padding">'+

//                         '<td>'+
//                         '<select name="category" id="category" class="form-control">'+
//                         '<option>Select</option>'+
//                         '@foreach($mr_category as $mc)'+
//                         '<option value="{{$mc->mcat_id}}" @if($cpm->mr_material_category_mcat_id == $mc->mcat_id) selected @endif>{{$mc->mcat_name}}'+
//                         '</option>'+
//                         '@endforeach'+
//                         '</select>'+
//                         '<input type="hidden" name="chalanbom[]" value="chalanbom0" class="pirow" />'+
//                         '<input type="hidden" value="{{ $cpm->id }}" name="id[]" class="form-control" />'+
//                         '<input type="hidden" value="{{ $cpm->cm_pi_master_id }}" name="cm_pi_master_id[]" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->description }}" name="description" id="description" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<select name="color" id="color" class="form-control">'+
//                         '<option>Select</option>'+
//                         '@foreach($mr_color as $mco)'+
//                         '<option value="{{$mco->clr_id}}" @if($cpm->mr_material_color_clr_id == $mco->clr_id) selected @endif>{{$mco->clr_name}}'+
//                         '</option>'+
//                         '@endforeach'+
//                         '</select>'+
//                         '</td>'+

//                         '<td>'+
//                         '<select name="article" id="article" class="form-control">'+
//                         '<option>Select</option>'+
//                         '@foreach($mr_art as $ma)'+
//                         '<option value="{{$ma->id}}" @if($cpm->mr_article_id == $ma->id) selected @endif>{{$ma->art_name}}'+
//                         '</option>'+
//                         '@endforeach'+
//                         '</select>'+
//                         '</td>'+

//                         '<td>'+
//                         '<select name="composition" id="composition" class="form-control">'+
//                         '<option>Select</option>'+
//                         '@foreach($mr_comp as $mcp)'+
//                         '<option value="{{$mcp->id}}" @if($cpm->mr_composition_id == $mcp->id) selected @endif>{{$mcp->comp_name}}'+
//                         '</option>'+
//                         '@endforeach'+
//                         '</select>'+
//                         '</td>'+

//                         '<td>'+
//                         '<select name="construction" id="construction" class="form-control">'+
//                         '<option>Select</option>'+
//                         '@foreach($mr_const as $mcon)'+
//                         '<option value="{{$mcon->id}}" @if($cpm->mr_construction_id == $mcon->id) selected @endif>{{$mcon->construction_name}}'+
//                         '</option>'+
//                         '@endforeach'+
//                         '</select>'+
//                         '</td>'+

//                         '<td>'+
//                         <?php
//                             $uomList = array(
//                                 "Millimeter" => "Millimeter",
//                                 "Centimeter" => "Original",
//                                 "Meter" => "Meter",
//                                 "Inch" => "Inch",
//                                 "Feet" => "Feet",
//                                 "Yard" => "Yard",
//                                 "Piece" => "Piece"
//                             );
//                             ?>
//                             '<select name="uom" id="uom" class="form-control">'+
//                         '<option>Select</option>'+
//                         '@foreach($uomList as $um)'+
//                         '<option value="{{$um}}" @if($cpm->uom == $um) selected @endif>{{$um}}'+
//                         '</option>'+
//                         '@endforeach'+
//                         '</select>'+

//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->consumption }}" name="consumption" id="consumption" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->extra }}" name="extra" id="extra" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->total_qty }}" name="t_qty" id="t_qty" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->unit_price }}" name="u_price" id="u_price" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->currency }}" name="currency" id="currency" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" value="{{ $cpm->pi_qty }}" name="pi_qty" id="pi_qty" class="form-control" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" name="pi_value" id="pi_values" value="{{ $cpm->total_qty * $cpm->unit_price }}" class="form-control g_input" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<input type="text" name="shipped_qty[]" value="{{ $cpm->shipped_qty }}" id="shipped_qty" class="form-control g_input" />'+
//                         '</td>'+

//                         '<td>'+
//                         '<button type="button" class="btn btn-xs btn-success AddBtns">+</button>'+
//                         '<button type="button" class="btn btn-xs btn-danger RemoveBtns">-</button>'+
//                         '</td>'+
//                         '</tr>'+
//                         '@endforeach'+

//                         '</tbody>'+
//                         '</table>';
//                     $('.wrapper').append(data);
//                     $("#t_qty, #u_price").keyup(function(){
//                         var rate = parseFloat($('#t_qty').val()) || 0;
//                         var box = parseFloat($('#u_price').val()) || 0;

//                         $('#pi_values').val(rate * box);
//                     });
//                 });
//             }
            $('.wrapper').append(response);
            $("#t_qty, #u_price").keyup(function(){
                        var rate = parseFloat($('#t_qty').val()) || 0;
                        var box = parseFloat($('#u_price').val()) || 0;

                        $('#pi_values').val(rate * box);
                    });
        }
    });
}else{
    $('.wrapper').empty();
}

// bom wise plus table form Add More Bom Table
var countss = 1;
// bom wise plus table form Add More Bom Table
$('body').on('click', '.AddBtns', function(){

    var data = '<tr id="chalanbom'+countss+'" class="no-padding">'+

        '<td>'+
        '<select name="category" id="category" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($mr_category as $mc)'+
        '<option value="{{$mc->mcat_id}}">{{$mc->mcat_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '<input type="hidden" name="chalanbom[]" value="chalanbom'+countss+'" class="pirow" />'+
        '<input type="hidden" value="" name="id[]" class="form-control" />'+
        '<input type="hidden" value="" name="cm_pi_master_id[]" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="description" id="description" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<select name="color" id="color" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($mr_color as $mco)'+
        '<option value="{{$mco->clr_id}}">{{$mco->clr_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '</td>'+

        '<td>'+
        '<select name="article" id="article" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($mr_art as $ma)'+
        '<option value="{{$ma->id}}">{{$ma->art_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '</td>'+

        '<td>'+
        '<select name="composition" id="composition" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($mr_comp as $mcp)'+
        '<option value="{{$mcp->id}}">{{$mcp->comp_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '</td>'+

        '<td>'+
        '<select name="construction" id="construction" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($mr_const as $mcon)'+
        '<option value="{{$mcon->id}}">{{$mcon->construction_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '</td>'+

        '<td>'+
        <?php
            $uomList = array(
                "Millimeter" => "Millimeter",
                "Centimeter" => "Original",
                "Meter" => "Meter",
                "Inch" => "Inch",
                "Feet" => "Feet",
                "Yard" => "Yard",
                "Piece" => "Piece"
            );
            ?>
            '<select name="uom" id="uom" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($uomList as $um)'+
        '<option value="{{$um}}">{{$um}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+

        '</td>'+

        '<td>'+
        '<input type="text" value="" name="consumption" id="consumption" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="extra" id="extra" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="t_qty" id="t_qtys" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="u_price" id="u_prices" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="currency" id="currency" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="pi_qty" id="pi_qty" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" name="pi_value" id="pi_value" value="" class="form-control g_input" />'+
        '</td>'+

        '<td>'+
        '<input type="text" name="shipped_qty[]" value="" id="shipped_qty" class="form-control g_input" />'+
        '</td>'+

        '<td>'+
        '<button type="button" class="btn btn-xs btn-success AddBtns">+</button>'+
        '<button type="button" class="btn btn-xs btn-danger RemoveBtns">-</button>'+
        '</td>'+
        '</tr>';

        $('.addRemovees').append(data);
        countss++;
});

$(document).keyup("#t_qtys, #u_prices",function(){
    var rate = parseFloat($('#t_qtys').val()) || 0;
    var box = parseFloat($('#u_prices').val()) || 0;

    $('#pi_value').val(rate * box);
});

$('body').on('click', '.RemoveBtns', function(){
    $(this).parent().parent().remove();
    var rowid=$(this).parent().parent().attr("id");
    $("table."+rowid).remove();  // remove table with rowid class name

    //$("table#"+rowid).remove();
    // $("table#table_id_"+ $(this).parent().parent().attr("id")).remove();
});

// PI Date Based On PI No.
var basedonpi = $(".pi_no");
$("body").on("change", ".pi_no", function(){

    var that = $(this);
    var action_date = $(".pidate");
    var pi_no = $(this).val();
    // Action Element list
    $.ajax({
        url: "{{ url('comm/import/importdata/pidate') }}",
        type: 'get',
        data: {pi_no: pi_no},
        success: function (data) {
            that.parent().parent().find(".pidate").val(data);
        },
        error: function () {

        }
    });

});


// FIle wise unit show.
var basedonfile = $(".file_no");
$("body").on("change", ".file_no", function(){

    var that = $(this);
    var action_date = $(".unitName");
    var file_no = $(this).val();
    // Action Element list
    $.ajax({
        url: "{{ url('comm/importchalantdata/fileUnit') }}",
        type: 'get',
        data: {file_no: file_no},
        success: function (data) {
            $(".unitName").val(data);
        },
        error: function () {

        }
    });

});

// supplier wise lcno show.
var basedonsupplier = $(".supplier_no");
$("body").on("change", ".supplier_no", function(){

    var that = $(this);
    var action_date = $(".ilcNo");
    var supplier_no = $(this).val();
    // Action Element list
    $.ajax({
        url: "{{ url('comm/import/chalandata/supplierIlcNo') }}",
        type: 'get',
        data: {supplier_no: supplier_no},
        success: function (data) {
            $(".ilcNo").val(data);
        },
        error: function () {

        }
    });

});
        });
    </script>
@endsection
