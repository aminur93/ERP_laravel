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
                <li class="#"> Asset </li>
                <li class="active"> Others PI Entry create </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Others PI Entry create</small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5> Others PI Entry create <a href="{{URL::to('comm/import/asset/others-pi-entry')}}" class="btn btn-info btn-xs"><i class="fa fa-list"></i> &nbsp; List of Others PI Entry</a></h5> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="entry_search_section">
                            <div class="form-horizontal">
                                <!-- 1st ROW -->
                                <form role="form" method="post" action="{{ url('comm/import/asset/others-pi-entry') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <!-- Display Erro/Success Message -->
                                    @include('inc/message')
                                    <div class="pi_entry_top_section">
                                        <div class="col-sm-12">
                                            <div class="col-sm-6">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="file_no" > File No.:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                           <input type="text" id="file_no" name="file_no" placeholder="Enter File No." value="" required class="form-control col-xs-12" /> 
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="unit" > Unit:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <select name="hr_unit" id="unit" class="col-xs-12 form-control" required>
                                                                <option value=""> - select - </option>
                                                                @foreach($getUnit as $unit)
                                                                <option value="{{$unit->hr_unit_id}}">{{$unit->hr_unit_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="item" > Item:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <select name="cm_item_id" id="item" class="col-xs-12 form-control" required>
                                                                <option value=""> - select - </option>
                                                                @foreach($getItem as $item)
                                                                <option value="{{$item->id}}">{{$item->cm_item_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_no" > P.I No.:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="pi_no" name="pi_no" placeholder="Enter P.I No." value="" class="form-control col-xs-12" required />
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_date" > P.I Date:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" id="pi_date" name="pi_date" placeholder="Enter P.I Date" value="" class="form-control col-xs-12 datepicker" />
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="supplierId" > Supplier Name:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <select name="mr_supplier_sup_id" id="supplierId" class="col-xs-12 form-control" required>
                                                                <option value=""> - select - </option>
                                                                @foreach($getSuppliers as $supplier)
                                                                <option value="{{$supplier->sup_id}}">{{$supplier->sup_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="active_pi" > Active P.I:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <label class="radio-inline"><input type="radio" name="  active_pi" checked value="Yes">Yes</label>
                                                            <label class="radio-inline"><input type="radio" name="active_pi" value="no">No</label>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_status" > P.I Status:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <label class="radio-inline"><input type="radio" name="pi_status" checked value="Foreign">Foreign</label>
                                                            <label class="radio-inline"><input type="radio" name="pi_status" value="Local">Local</label>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="remarks" > Remarks:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                           <input type="text" id="remarks" name="remarks" placeholder="Enter Remarks" value="" class="form-control col-xs-12" /> 
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_last_ship_date" > P.I Last Ship Date:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" id="pi_last_ship_date" name="pi_last_ship_date" placeholder="Enter P.I Last Ship Date" value="" class="form-control col-xs-12 datepicker" />
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="order_id" > Order Number:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <select class="order-multiple form-control col-xs-12" name="mr_order_entry_order_id[]" data-placeholder="Select Order " multiple>
                                                              @foreach($getOrder as $order)
                                                              <option value="{{$order->order_id}}">{{$order->order_code}}</option>
                                                              @endforeach 
                                                            </select>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                                    <th width="">Machine Type</th>
                                                    <th width="">Model No</th>
                                                    <th width="">Description</th>
                                                    <th width="">Manufacture</th>
                                                    <th width="100px">Section</th>
                                                    <th width="">Quantity</th>
                                                    <th width="100px">UOM</th>
                                                    <th width="">Unit Price</th>
                                                    <th width="80px">Currency</th>
                                                    <th width="">P.I Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="case" type="checkbox"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control autocomplete_machine" data-type="machineType" autocomplete="off" id="machineType_1" name="cm_machine_type_id[]" value="" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" data-type="modelNo" name="model_no[]" id="modelNo_1" class="form-control autocomplete_txt" autocomplete="off" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" data-type="description" name="description[]" id="description_1" class="form-control autocomplete_txt" autocomplete="off" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" data-type="manufacture" id="manufacture_1" class="form-control autocomplete_txt" autocomplete="off" name="manufacturer[]" required>
                                                    </td>
                                                    <td>
                                                        <select name="cm_section_id[]" id="section_1" class="col-xs-12 form-control">
                                                            <option value=""> - select - </option>
                                                            @foreach($getSection as $section)
                                                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" min="1" value="1" name="qty[]" id="quantity_1" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                    </td>
                                                    <td>
                                                        <select name="uom[]" id="uom_1" class="col-xs-12 form-control">
                                                            <option value=""> - select - </option>
                                                            <option value="millimeter"> Millimeter </option>
                                                            <option value="centimeter"> Centimeter </option>
                                                            <option value="meter"> Meter </option>
                                                            <option value="inch"> Inch </option>
                                                            <option value="feet"> Feet </option>
                                                            <option value="yard"> Yard </option>
                                                            <option value="piece"> Piece </option>
                                                            
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" min="0" value="0" name="unit_price[]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                    </td>
                                                    
                                                    <td>
                                                        <select name="currency[]" id="currency_1" class="col-xs-12 form-control">
                                                            <option value=""> - select - </option>
                                                            <option value="usd"> USD </option>
                                                            <option value="eur"> EUR </option>
                                                            <option value="gbp"> GBP </option>
                                                            <option value="tk"> TK </option>
                                                            
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                                        <button rel='tooltip' data-tooltip-location='top' data-tooltip="Delete Checked Row" class="btn btn-danger btn-sm delete" type="button">- Delete</button>
                                        <button rel='tooltip' data-tooltip-location='top' data-tooltip="Add New Row" class="btn btn-success btn-sm addmore" type="button">+ Add More</button>
                                        
                                    </div>
                                    <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-5 col-md-5 col-lg-5'>
                                        <div class="form-inline">
                                            <div class="form-group col-sm-12 no-padding">
                                                <label class="col-sm-4">Total Amount: &nbsp;</label>
                                                <div class="input-group col-sm-8">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-7">
                                        <div class="submit-invoice">
                                           <div class="input-group center">
                                                <button type="submit" class="btn btn-success">Confirm</button>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 
@push('js')
    @include('commercial.xinnah.import.asset.more_pi_asset_description')
@endpush

@endsection