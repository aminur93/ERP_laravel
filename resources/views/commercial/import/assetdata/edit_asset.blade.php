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
                        <a href="#"> Asset </a>
                    </li>
                    <li class="#"> Asset Data</li>
                    <li class="active">  Asset Data Update   </li>
                </ul><!-- /.breadcrumb -->
            </div>


            <div class="page-content">
                <div class="page-header">
                    <h1> Asset Data Update <small><i class="ace-icon fa fa-angle-double-right"></i>  Asset Data Entry Update  </small></h1>
                </div>
                <!---Form -->
                <h5 class="page-header">Add Information  </h5>
                <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/asset/assetedit',$asset->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <!-- Display Erro/Success Message -->
                        @include('inc/message')
                        <div class="col-sm-4">

                            <!-- PAGE CONTENT BEGINS -->

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="importcode" >Import Code :<span style="color: red">&#42;</span> </label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->imp_code }}" id="importcode" name="importcode" class="col-xs-12" data-validation="required" readonly="readonly" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="bank" >Bank: <span style="color: red">&#42;</span></label>

                                <div class="col-sm-8">
                                    <select name="bank" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($bank as $bak)
                                            <option value="{{ $bak->id }}" @if($asset->cm_bank_id == $bak->id) selected @endif>{{ $bak->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="tr_doc1" >Transport Doc No. 1:</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->transp_doc_no1 }}" name="tr_doc1" placeholder="Auto" class="col-xs-12"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="tr_doc_date" >Transport Doc Date: </label>

                                <div class="col-sm-8">
                                    <input type="date" value="{{ $asset->transp_doc_date }}" name="tr_doc_date" placeholder="Enter" class="col-xs-12"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="tr_doc2" >Transport Doc No-2:</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->transp_doc_no2 }}" name="tr_doc2" class="col-xs-12" />

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="ship" >Ship Mode </label>

                                <div class="col-sm-8">
                                    <?php
                                    $shipMode = array(
                                        "Ship" => "Ship",
                                        "Air" => "Air",
                                        "Road" => "Road"
                                    );
                                    ?>

                                    <select name="ship" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($shipMode as $sm)
                                            <option value="{{ $sm }}" @if($asset->ship_mode == $sm) selected @endif>{{ $sm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="weight" >Weight (kg):</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->weight }}" name="weight" placeholder="Enter"  class="col-xs-12" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="country" >Country Of Origin: </label>

                                <div class="col-sm-8">
                                    <select name="country" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($country as $ct)
                                            <option value="{{ $ct->cnt_id }}" {{ $asset->cnt_id == $ct->cnt_id ? 'selected' : ''}}>{{ $ct->cnt_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="carrier" >Carrier :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->carrier }}" name="carrier" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                           {{--  <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="carrier" >Freight :</label>

                                <div class="col-sm-8">

                                    {{ Form::select('freight', array('Prepaid'=>'Prepaid','Collect'=>'Collect'), null, ['placeholder'=>'Select','class'=> 'form-control col-xs-10']) }}
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="ship_com" >Ship Company :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->ship_company }}" name="ship_com" placeholder="Enter" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">

                            <!-- SECOND COLUMN BEGINS -->

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="container1" >Container-1 :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->container_1 }}" name="container1" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="container2" >Container-2 :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->container_2 }}" name="container2" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="container3" >Container-3 :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->container_3 }}" name="container3" placeholder="Enter" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="package" >Package:</span> </label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->package }}" name="package" placeholder="Enter" class="col-xs-12" />
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
                                            <option value="{{ $dl }}" @if($asset->doc_type == $dl) selected @endif>{{ $dl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="docdate" >Doc Receive <br/>Date :</label>
                                <div class="col-sm-8">
                                    <input type="date" value="{{ $asset->doc_recv_date }}" name="docdate" placeholder="Enter" class="col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="quantity" >Quantity : </label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->qty }}" name="quantity" placeholder="Enter"  class="form-control"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="value" >value :</label>

                                <div class="col-sm-8">
                                    <input type="text" value="{{ $asset->value }}" name="value" placeholder="Enter" class="col-xs-8" />

                                    <select class="col-sm-3" name="currency" data-validation="required length" data-validation-length="1-45">
                                        <option value="USD" selected="selected">USD</option>
                                        <option value="BDT">BDT</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="port_loading" >Port Of Loading </label>

                                <div class="col-sm-8">
                                    <select name="port_loading" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($port as $prt)
                                            <option value="{{ $prt->cnt_id }}" {{ $asset->cm_port_id == $prt->cnt_id ? 'selected' :'' }}>{{ $prt->port_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="container-size" >Container Size :</label>

                                <div class="col-sm-8">
                                    <?php
                                    $container = array(
                                        'FCL' => 'FCL',
                                        'LCL' => 'LCL'
                                    );

                                    ?>

                                    <select name="container_size" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($container as $cont)
                                            <option value="{{ $cont }}" {{ $asset->container_size == $cont ? 'selected' : ''}}>{{ $cont }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="mother_vessel" >Mother Vessel : </label>

                                <div class="col-sm-8">
                                    <select name="mother_vessel" id="id" class="form-control dynamic" data-dependent="voyage_name">
                                        <option value="">Select</option>
                                        @foreach($vessel as $vess)
                                            <option value="{{ $vess->id }}" {{ $asset->cm_vessel_id == $vess->id ? 'selected' :'' }}>{{ $vess->vessel_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="voyage_no" >Voyage No : </label>

                                <div class="col-sm-8">
                                    <select name="voyage_no" id="voyage_name" class="col-xs-12">
                                        <option value="">Select Mother Vessel </option>
                                        @foreach($voyage as $voage)
                                            <option value="{{ $voage->cm_vessel_id }}" {{ $asset->cm_voyage_vessel_id == $voage->cm_vessel_id ? 'selected':'' }}>{{ $voage->voyage_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4"  style="background:#ccc;padding: 20px 20px 20px 0;text-align: center;">

                            <!-- PAGE CONTENT BEGINS -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="examine_date" style="margin-left: 10px;">File No: </label>

                                <div class="col-sm-6">
                                    <select name="file_no" id="" class="form-control file_no ">
                                        <option value="">Select File</option>
                                        @foreach($cm_file as $cf)
                                            <option value="{{ $cf->id }}"  {{$asset->cm_file_id == $cf->id ? 'selected' :''}} >{{ $cf->file_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="unit" style="margin-left: 10px;">Unit : </label>

                                <div class="col-sm-6">
                                    <input type="text" value="{{ $asset->hr_unit }}" name="unit" placeholder="Enter" id="unitname"  value="" class="form-control unitName" readonly="readonly" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="supplier" style="margin-left: 10px;">Supplier</label>

                                <div class="col-sm-6">
                                    <select name="supplier" id="" class="form-control supplier_no">
                                        <option value="">Select</option>
                                        @foreach($cm_supplier as $csup)
                                            <option value="{{ $csup->sup_id }}" {{ $asset->mr_supplier_sup_id == $csup->sup_id ? 'selected' : '' }}>{{ $csup->sup_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="ilcno" style="margin-left: 10px;">ILC No : </label>

                                <div class="col-sm-6">
                                    <input type="text" value="{{ $asset->cm_btb_id }}" name="ilcno" placeholder="Enter" value="" class="form-control ilcNo" readonly="readonly"/>
                                </div>
                            </div>

                        </div>

                        <!-- /.col -->
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
                                    <tr id="pirow" class="no-padding">

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
                                            <input type="date" value="{{ $cpi->pi_date }}" name="pidate[]" id="pidate" class="form-control pidate" readonly="readonly" />
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
                                <input type="hidden" name="impdatatype"placeholder="Enter" class="form-control" value="Foreign" />

                                <input type="hidden" name="import_id" placeholder="Enter" class="form-control" value="" />

                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!---page content---->
        </div><!-- main-content-inner -->
    </div><!--main-content-->

    <script type="text/javascript">
        $(document).ready(function(){

            var count = 1;
            //Add More Invoice Table

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
            //Add More Invoice Table

            $('body').on('click', '.AddBtn', function(){

                var data = '<tr id="pirow'+counts+'" class="no-padding">'+

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

//// Import Auto Code Ajax
{{--var importcode = $(this).val();--}}
{{--$.ajax({--}}
    {{--url : "{{ url('comm/import/importdata/importcode') }}",--}}
    {{--type: 'get',--}}
    {{--data: {importcode:importcode},--}}
    {{--success: function(data)--}}
    {{--{--}}
        {{--$("#importcode").val(data);--}}
    {{--},--}}
    {{--error: function()--}}
    {{--{--}}
        {{--alert('failed...');--}}
    {{--}--}}
{{--});--}}


// Voyage select Based On Mother Vessel
$('.dynamic').change(function(){
    if($(this).val() != '')
    {
        var select = $(this).attr("id");
        var value = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: " {{ url('comm/import/importdata/voyage') }} ",
            method: "POST",
            data: {select:select, value:value, _token:_token, dependent:dependent},
            success: function (result) {
                $('#'+dependent).html(result);
            }
        })
    }
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
        url: "{{ url('comm/import/importdata/fileUnit') }}",
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
        url: "{{ url('comm/import/importdata/supplierIlcNo') }}",
        type: 'get',
        data: {supplier_no: supplier_no},
        success: function (data) {
            $(".ilcNo").val(data);
        },
        error: function () {

        }
    });

});

var pi_master_id = $('#pi_no').val();
console.log('PI No:',pi_master_id);
    //var file_id = $(this).val();
    if(pi_master_id){
        $.ajax({
          url: "{{url('comm/import/chalandata/getpiTable')}}",
          type: 'get',
          data: {pi_master_id: pi_master_id},
                        success: function (response) {
                            $('.wrapper').append(response);

                            $("#quantity, #unit_price").keyup(function(){
                                var rate = parseFloat($('#quantity').val()) || 0;
                                var box = parseFloat($('#unit_price').val()) || 0;

                                $('#pi_amount').val(rate * box);
                            });
                        }
                    })
                }else{
                    $('.wrapper').empty();
                }


//Pi select weise table
$(document).on('change', '#pi_no', function(e){
//    var file_id = $('#pi_no').find(":selected").val();
var pi_master_id = $(this).val();
console.log('PI No:',pi_master_id);
    //var file_id = $(this).val();
    if(pi_master_id){
        $.ajax({
          url: "{{url('comm/import/chalandata/getpiTable')}}",
          type: 'get',
          data: {pi_master_id: pi_master_id},
                        success: function (response) {
                            $('.wrapper').append(response);

                            $("#quantity, #unit_price").keyup(function(){
                                var rate = parseFloat($('#quantity').val()) || 0;
                                var box = parseFloat($('#unit_price').val()) || 0;

                                $('#pi_amount').val(rate * box);
                            });
                        }
                    })
                }else{
                    $('.wrapper').empty();
                }


            });

var countss = 1;
// bom wise plus table form Add More Bom Table
$('body').on('click', '.AddBtns', function(){

    var data = '<tr id="assetbom'+countss+'" class="no-padding">'+

        '<td>'+
        '<select name="machine_type" id="machine_type" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($cm_machine as $cm)'+
        '<option value="{{$cm->id}}">{{$cm->type_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '<input type="hidden" value="" name="cm_pi_asset_description_id[]" class="form-control" />'+
        '<input type="hidden" value="" name="cm_pi_asset_id[]" class="form-control" />'+
        '<input type="hidden" name="assetbom[]" value="assetbom'+countss+'" class="assetbom" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="model_no" id="model_no" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="description" id="description" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<select name="section" id="section" class="form-control">'+
        '<option>Select</option>'+
        '@foreach($cm_section as $cs)'+
        '<option value="{{$cs->id}}">{{$cs->section_name}}'+
        '</option>'+
        '@endforeach'+
        '</select>'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="quantity" id="quantitys" class="form-control" />'+
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
        '<input type="text" value="" name="unit_price" id="unit_prices" class="form-control" />'+
        '</td>'+

        '<td>'+
        '<input type="text" value="" name="pi_amount" id="pi_amounts" class="form-control" />'+
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

$(document).keyup("#quantitys, #unit_prices",function(){
    var rate = parseFloat($('#quantitys').val()) || 0;
    var box = parseFloat($('#unit_prices').val()) || 0;

    $('#pi_amounts').val(rate * box);
});

$('body').on('click', '.RemoveBtns', function(){
    $(this).parent().parent().remove();
    var rowid=$(this).parent().parent().attr("id");
    $("table."+rowid).remove();  // remove table with rowid class name

    //$("table#"+rowid).remove();
    // $("table#table_id_"+ $(this).parent().parent().attr("id")).remove();
});

//    var file_id = $('#pi_no').find(":selected").val();
    var file_id = $('#pi_no').val();
    if(file_id){
        $.ajax({
            url:'/comm/import/asset/editTable/'+file_id,
            type: 'get',
            success: function (response) {
                if(response.length!=0){
                    var response = JSON.parse(response);
//                    $('.wrapper').empty();
                    $.each(response, function( key,value ) {
                        var data =
                            '<table id="bomTable" class="table table-bordered table-striped table-highlight" >'+
                            '<thead>'+
                            '<th>Machine Type</th>'+
                            '<th>Model No</th>'+
                            '<th>Description</th>'+
                            '<th>Section</th>'+
                            '<th>Quantity</th>'+
                            '<th>Uom</th>'+
                            '<th>Unit Price</th>'+
                            '<th>Pi Value</th>'+
                            '<th>Shipped Qty</th>'+
                            '<th>Action</th>'+
                            '</thead>'+

                            '<tbody class="addRemovees min-font">'+
                            '@foreach($cm_pi_asset as $cpm)'+
                            '<tr id="pibom0" class="no-padding">'+

                            '<td>'+
                            '<select name="machine_type" id="machine_type" class="form-control">'+
                            '<option>Select</option>'+
                            '@foreach($cm_machine as $cm)'+
                            '<option value="{{$cm->id}}" @if($cpm->cm_machine_type_id == $cm->id) selected @endif>{{$cm->type_name}}'+
                            '</option>'+
                            '@endforeach'+
                            '</select>'+
                            '<input type="hidden" value="{{ $cpm->id }}" name="cm_pi_asset_description_id[]" class="form-control" />'+
                            '<input type="hidden" value="{{ $cpm->cm_pi_asset_id }}" name="cm_pi_asset_id[]" class="form-control" />'+
                            '<input type="hidden" name="assetbom[]" value="assetbom0" class="assetbom" />'+
                            '</td>'+

                            '<td>'+
                            '<input type="text" value="{{ $cpm->model_no }}" name="model_no" id="model_no" class="form-control" />'+
                            '</td>'+

                            '<td>'+
                            '<input type="text" value="{{ $cpm->description }}" name="description" id="description" class="form-control" />'+
                            '</td>'+

                            '<td>'+
                            '<select name="section" id="section" class="form-control">'+
                            '<option>Select</option>'+
                            '@foreach($cm_section as $cs)'+
                            '<option value="{{$cs->id}}" @if($cpm->cm_section_id == $cs->id) selected @endif>{{$cs->section_name}}'+
                            '</option>'+
                            '@endforeach'+
                            '</select>'+
                            '</td>'+

                            '<td>'+
                            '<input type="text" value="{{ $cpm->qty }}" name="quantity" id="quantity" class="form-control" />'+
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
                            '<option value="{{$um}}" @if($cpm->uom == $um) selected @endif>{{$um}}'+
                            '</option>'+
                            '@endforeach'+
                            '</select>'+
                            '</td>'+

                            '<td>'+
                            '<input type="text" value="{{ $cpm->unit_price }}" name="unit_price" id="unit_price" class="form-control" />'+
                            '</td>'+

                            '<td>'+
                            '<input type="text" value="{{$cpm->qty * $cpm->unit_price}}" name="pi_amount" id="pi_amount" class="form-control" />'+
                            '</td>'+


                            '<td>'+
                            '<input type="text" name="shipped_qty[]" value="{{ $cpm->shipped_qty }}" id="shipped_qty" class="form-control g_input" />'+
                            '</td>'+

                            '<td>'+
                            '<button type="button" class="btn btn-xs btn-success AddBtns">+</button>'+
                            '<button type="button" class="btn btn-xs btn-danger RemoveBtns">-</button>'+
                            '</td>'+
                            '</tr>'+
                            '@endforeach'+

                            '</tbody>'+
                            '</table>';
                        $('.wrapper').append(data);
                        $("#t_qty, #u_price").keyup(function(){
                            var rate = parseFloat($('#t_qty').val()) || 0;
                            var box = parseFloat($('#u_price').val()) || 0;

                            $('#pi_values').val(rate * box);
                        });
                    });
                }
            }
        })
    }else{
        $('.wrapper').empty();
    }



        });

    </script>

    <script>


    </script>
@endsection
