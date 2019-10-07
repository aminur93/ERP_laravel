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
                <li class="active"> Others PI Entry edit </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Others PI Entry edit</small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5> Others PI Entry edit <a href="{{URL::to('comm/import/asset/others-pi-entry')}}" class="btn btn-info btn-xs"><i class="fa fa-list"></i> &nbsp; List of Others PI Entry</a> <a href="{{URL::to('comm/import/asset/others-pi-entry/create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Others PI Entry create</a></h5> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="entry_search_section">
                            <div class="form-horizontal">
                                <!-- 1st ROW -->
                                
                                {!! Form::open(array('route' => ['others-pi-entry.update',$getPiAsset->id],'class'=>'form-horizontal','method'=>'PUT','files'=>'true')) !!} 
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
                                                           <input type="text" id="file_no" name="file_no" value="{{ $getPiAsset->file->file_no }}" required readonly class="form-control col-xs-12" /> 
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
                                                                @if($unit->hr_unit_id == $getPiAsset->unit->hr_unit_id)
                                                                <option value="{{$unit->hr_unit_id}}" selected>{{$unit->hr_unit_name}}</option>
                                                                @else
                                                                <option value="{{$unit->hr_unit_id}}">{{$unit->hr_unit_name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="item" > Item:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <select name="cm_item_id" id="item" class="col-xs-12 form-control" required readonly>
                                                                <option value=""> - select - </option>
                                                                @foreach($getItem as $item)
                                                                @if($item->id == $getPiAsset->item->id)
                                                                <option value="{{$item->id}}" selected>{{$item->cm_item_name}}</option>
                                                                @else
                                                                <option value="{{$item->id}}">{{$item->cm_item_name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_no" > P.I No.:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="pi_no" name="pi_no" value="{{ $getPiAsset->pi_no }}" class="form-control col-xs-12" required readonly />
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_date" > P.I Date:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" id="pi_date" name="pi_date" placeholder="Enter P.I Date" value="{{ $getPiAsset->pi_date }}" class="form-control col-xs-12 datepicker" readonly />
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
                                                                @if($supplier->sup_id == $getPiAsset->supplier->sup_id)
                                                                <option value="{{$supplier->sup_id}}" selected>{{$supplier->sup_name}}</option>
                                                                @else
                                                                <option value="{{$supplier->sup_id}}">{{$supplier->sup_name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="active_pi" > Active P.I:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <label class="radio-inline"><input type="radio" name="  active_pi" value="Yes" @if($getPiAsset->active_pi == 'Yes') checked @endif>Yes</label>
                                                            <label class="radio-inline"><input type="radio" name="active_pi" value="no" @if($getPiAsset->active_pi == 'no') checked @endif>No</label>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_status" > P.I Status:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <label class="radio-inline"><input type="radio" name="pi_status" value="Foreign" @if($getPiAsset->pi_status == 'Foreign') checked @endif>Foreign</label>
                                                            <label class="radio-inline"><input type="radio" name="pi_status" value="Local" @if($getPiAsset->pi_status == 'Local') checked @endif>Local</label>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="remarks" > Remarks:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                           <input type="text" id="remarks" name="remarks" placeholder="Enter Remarks" value="{{ $getPiAsset->remarks }}" class="form-control col-xs-12" /> 
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="pi_last_ship_date" > P.I Last Ship Date:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" id="pi_last_ship_date" name="pi_last_ship_date" placeholder="Enter P.I Last Ship Date" value="{{ $getPiAsset->pi_last_ship_date }}" class="form-control col-xs-12 datepicker" />
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 no-padding control-label " for="order_id" > Order Number:<span style="color: white">&#42;</span> </label>
                                                        <div class="col-sm-8">
                                                            {{ Form::select('mr_order_entry_order_id[]', $getOrder, $getPiAssetOrder, ['placeholder'=>'Select','id'=>'model','class'=> 'form-control col-xs-12 order-multiple', 'multiple']) }}
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
                                                @php 
                                                $i = 0;
                                                $total = 0;
                                                @endphp
                                                @foreach($getPiAssetDescription as $details)
                                                @php $i++; @endphp
                                                <tr>
                                                    <td>
                                                        <input class="case" type="checkbox"/>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="ex_pi_asset_description_id[]" value="{{ $details->id }}">
                                                        <input type="text" class="form-control autocomplete_machine" data-type="machineType" autocomplete="off" id="machineType_{{ $i }}" name="ex_cm_machine_type_id[]" value="{{ $details->machine_type['type_name'] }}" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" data-type="modelNo" name="ex_model_no[]" value="{{ $details->model_no }}" id="modelNo_{{ $i }}" class="form-control autocomplete_txt" autocomplete="off" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" data-type="description" name="ex_description[]" value="{{ $details->description }}" id="description_{{ $i }}" class="form-control autocomplete_txt" autocomplete="off" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" data-type="manufacture" id="manufacture_{{ $i }}" class="form-control autocomplete_txt" autocomplete="off" name="ex_manufacturer[]" value="{{ $details->machine_type['manufacturer'] }}" readonly required>
                                                    </td>
                                                    <td>
                                                        <select name="ex_cm_section_id[]" id="section_{{ $i }}" class="col-xs-12 form-control">
                                                            <option value=""> - select - </option>
                                                            @foreach($getSection as $section)
                                                            @if($section->id == $details->cm_section_id)
                                                            <option value="{{$section->id}}" selected>{{$section->section_name}}</option>
                                                            @else
                                                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" min="1" value="{{ $details->qty }}" name="ex_qty[]" id="quantity_{{ $i }}" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                    </td>
                                                    <td>
                                                        {{ Form::select('ex_uom[]', ['millimeter'=>'Millimeter', 'centimeter'=>'Centimeter', 'meter'=>'Meter', 'inch'=>'Inch', 'feet'=>'Feet', 'yard'=>'Yard', 'piece'=>'Piece'], $details->uom, ['placeholder'=>'Select','id'=>"uom_$i",'class'=> 'form-control col-xs-12']) }}
                                                    </td>
                                                    <td>
                                                        <input type="number" min="0" value="{{ $details->unit_price }}" name="ex_unit_price[]" id="price_{{ $i }}" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                    </td>
                                                    
                                                    <td>
                                                        {{ Form::select('ex_currency[]', ['usd'=>'USD', 'eur'=>'EUR', 'gbp'=>'GBP', 'tk'=>'TK'], $details->currency, ['placeholder'=>'Select','id'=>"currency_$i",'class'=> 'form-control col-xs-12']) }}
                                                    </td>
                                                    <td>
                                                        <input type="number" id="total_{{ $i }}" value="{{ $details->qty * $details->unit_price }}" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>
                                                        @php $total += $details->qty * $details->unit_price @endphp
                                                    </td>
                                                </tr>
                                                @endforeach
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
                                                    <input type="number" class="form-control" value="{{$total}}" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-7">
                                        <div class="submit-invoice">
                                           <div class="input-group center">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close(); !!}
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