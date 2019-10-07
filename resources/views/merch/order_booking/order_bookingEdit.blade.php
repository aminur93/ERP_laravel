@extends('merch.index')
@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Order Break Down Show</a>
                    </li>
                    <li class="active">Order Color & Size Break Down Show</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table" width="50%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <th>Order No</th>
                                    <td>{{ (!empty($order->order_code)?$order->order_code:null) }}</td>
                                    <th>Unit</th>
                                    <td>{{ (!empty($order->hr_unit_name)?$order->hr_unit_name:null) }}</td>
                                    <th>Buyer</th>
                                    <td>{{ (!empty($order->b_name)?$order->b_name:null) }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{ (!empty($order->br_name)?$order->br_name:null) }}</td>
                                    <th>Season</th>
                                    <td>{{ (!empty($order->se_name)?$order->se_name:null) }}</td>
                                    <th>Style No</th>
                                    <td>{{ (!empty($order->stl_no)?$order->stl_no:null) }}</td>
                                </tr>
                                <tr>
                                    <th>Order Quantity</th>
                                    <td>{{ (!empty($order->order_qty)?$order->order_qty:null) }}</td>
                                    <th>Delivery Date</th>
                                    <td>{{ (!empty($order->order_delivery_date)?$order->order_delivery_date:null) }}</td>
                                    <th>Reference No</th>
                                    <td>{{ (!empty($order->order_ref_no)?$order->order_ref_no:null) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <form action="{{ url('merch/order_booking_update') }}" method="post">{{ csrf_field() }}
                        <table id="bomCostingTable" class="table table-bordered table-condensed table-strip">
                            <thead>
                            <tr>
                                <th>Main Category</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Article</th>
                                <th>Supllier</th>
                                <th>Consumption</th>
                                <th>Extra (%)</th>
                                <th>(Consumption & Extra)</th>
                                <th>Uom</th>
                                <th>Unit Price</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Qty</th>
                                <th>Req Qty</th>
                                <th>Booking Qty</th>
                                <th>Delivery Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $itemIndex = 0; @endphp
                            @foreach($order_break as $bom)


                                <tr>
                                    @if(isset($vals[$bom->item_name]))
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->mcat_name }}</td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->item_name }}
                                            <input type="hidden" name="items[]" value="{{ $bom->item_name }}">
                                        </td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->item_description }}</td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->art_name }}</td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->sup_name }}</td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->consumption }}</td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->extra_percent }}</td>
                                        <td  class="ce-{{$bom->mr_order_bom_costing_booking_id}} vertical-align-center" rowspan="{{ $vals[$bom->item_name] }}">
                                            @php
                                                $ptotal = ($bom->consumption * $bom->extra_percent)/100;
                                                $total = $ptotal + $bom->consumption;
                                                echo "$total";
                                            @endphp
                                        </td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->uom }}</td>
                                        <td rowspan="{{ $vals[$bom->item_name] }}" class="vertical-align-center">{{ $bom->precost_unit_price }}</td>
                                        @php
                                            unset($vals[$bom->item_name]);
                                        @endphp
                                    @endif

                                    <input type="hidden" name="id-{{ $itemIndex }}[]" value="{{  $bom->id }}" class="form-control">

                                    <input type="hidden" name="bom_costing_booking_id-{{ $itemIndex }}[]" value="{{ $bom->mr_order_bom_costing_booking_id }}" class="form-control">

                                    <input type="hidden" name="order_entry_order_id-{{ $itemIndex }}[]" value="{{ $bom->mr_order_entry_order_id }}" class="form-control">

                                    <input type="hidden" name="cat_item_id-{{ $itemIndex }}[]" value="{{  $bom->mr_cat_item_id }}" class="form-control">

                                    <input type="hidden" name="cat_item_mcat_id-{{ $itemIndex }}[]" value="{{  $bom->mr_cat_item_mcat_id  }}" class="form-control">

                                    <td>
                                        @if($bom->dependent_on == 1)
                                            @php $colorF = 0; @endphp
                                            @if($colorF == 0)
                                                @php $colorF = 1; @endphp
                                                <input type="text" size="1" name="clr_name-{{ $itemIndex }}[]" value="{{ $bom->clr_name }}" class="form-control">
                                                <input type="hidden" value="{{ $bom->clr_id }}" name="clr_id-{{ $itemIndex }}[]" >

                                            @else
                                                <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                <input type="text" size="1" name="clr_name-{{ $itemIndex }}[]" value="{{ $bom->clr_name }}" class="form-control">
                                                <input type="hidden" value="{{ $bom->clr_id }}" name="clr_id-{{ $itemIndex }}[]" >

                                            @endif

                                        @elseif($bom->dependent_on == 3)
                                            @php $care_colorF = 0; @endphp
                                            @if($care_colorF == 0)
                                                @php $care_colorF = 1; @endphp
                                                {{ $bom->clr_name }}
                                            @else
                                                <hr style="margin-top: 92px;margin-bottom: 12px;">
                                                {{ $bom->clr_name }}
                                            @endif
                                        @else
                                            <p></p>
                                        @endif
                                    </td>


                                    <td>
                                        @if($bom->dependent_on == 2)
                                            @php $sizeF = 0; @endphp
                                            @if($sizeF == 0)
                                                @php $sizeF = 1; @endphp
                                                <input type="text" size="1" name="sizer-{{ $itemIndex }}[]" value="{{ $bom->size }}" class="form-control">

                                            @else
                                                <hr style="margin-top: 11px;margin-bottom: 10px;">
                                                <input type="text" size="1" name="sizer-{{ $itemIndex }}[]" value="{{ $bom->size }}" class="form-control">

                                            @endif

                                        @elseif($bom->dependent_on == 3)
                                            @php $care_sizeF = 0 @endphp
                                            @if($care_sizeF == 0)
                                                @php $care_sizeF = 1; @endphp
                                                <input type="text" size="1" name="sizes-{{$itemIndex}}[]" value="{{ $bom->size }}" class="form-control" size="1">
                                                <input type="hidden" name="clr_ids-{{$itemIndex}}[]" value="{{ $bom->clr_id }}" class="form-control">
                                            @else
                                                <hr style="margin-top: 13px;margin-bottom: 12px;">
                                                <input type="text" size="1" name="sizes-{{$itemIndex}}[]" value="{{ $bom->size }}" class="form-control" size="1">
                                                <input type="hidden" name="clr_ids-{{$itemIndex}}[]" value="{{ $bom->clr_id }}" class="form-control">

                                            @endif
                                        @else
                                            <p></p>
                                        @endif
                                    </td>



                                    <td>
                                        @if($bom->dependent_on == 1)
                                            @php $qtyF = 0; @endphp
                                            @if($qtyF == 0)
                                                @php $qtyF = 1; @endphp

                                                <input type="text" name="qty-{{$itemIndex}}[]" value="{{ $bom->qty }}" class="form-control" size="1">
                                            @else
                                                <hr style="margin-top: 10px;margin-bottom: 10px;">

                                                <input type="text" name="qty-{{$itemIndex}}[]" value="{{ $bom->qty }}" class="form-control" size="1">
                                            @endif

                                        @elseif($bom->dependent_on == 2)
                                            @php $sizeF = 0; @endphp
                                            @if($sizeF == 0)
                                                @php $sizeF = 1; @endphp
                                                <input type="text" name="size_qtyss-{{$itemIndex}}[]" value="{{ $bom->qty }}" data="{{ $bom->mr_order_bom_costing_booking_id }}" id="size_qty-{{ $bom->size }}_{{$itemIndex}}"  class="form-control global-qty" size="1">
                                            @else
                                                <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                <input type="text" name="size_qtyss-{{$itemIndex}}[]" value="{{ $bom->qty }}"  data="{{$bom->mr_order_bom_costing_booking_id }}"  id="size_qty-{{ $bom->size }}_{{$itemIndex}}" class="form-control global-qty" size="1">
                                            @endif

                                        @elseif($bom->dependent_on == 3)
                                            @php $care_labelF  = 0; @endphp
                                            @if($care_labelF  == 0)
                                                @php $care_labelF  = 1; @endphp
                                                <input type="text" name="s_qtyss-{{$itemIndex}}[]" value="{{ $bom->qty }}" data="{{$bom->mr_order_bom_costing_booking_id}}"  id="size_qty-{{ $bom->size }}_{{ $bom->id }}_{{$itemIndex}}" class="form-control global-qty" size="1">
                                            @else
                                                <hr style="margin-top: 12px;margin-bottom: 12px;">
                                                <input type="text" name="s_qtyss-{{$itemIndex}}[]" value="{{ $bom->qty }}" data="{{$bom->mr_order_bom_costing_booking_id}}"  id="size_qty-{{ $bom->size }}_{{ $bom->id }}_{{$itemIndex}}"  class="form-control global-qty" size="1">
                                            @endif
                                        @else
                                            <p></p>
                                        @endif
                                    </td>


                                    <td>

                                        @php $r_qtyF = 0; @endphp
                                        @php
                                            $ptotal = ($bom->consumption * $bom->extra_percent)/100;
                                            $total = $ptotal + $bom->consumption;
                                        @endphp
                                        @if($bom->dependent_on == 1)
                                            @php $r_qtyF = 0; @endphp
                                            @if($r_qtyF == 0)
                                                @php $r_qtyF = 1; @endphp
                                                <input type="text" value="{{ $bom->req_qty }}" size="1" name="req_qty-{{$itemIndex}}[]" value="" class="form-control" size="1">

                                            @else
                                                <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                <input type="text" value="{{ $bom->req_qty }}" size="1" name="req_qty-{{$itemIndex}}[]" value="" class="form-control" size="1">

                                            @endif
                                        @elseif($bom->dependent_on == 2)
                                            @php $care_labelF  = 0; @endphp
                                            @if($care_labelF  == 0)
                                                @php $care_labelF  = 1; @endphp
                                                <input type="text" value="{{ $bom->req_qty }}" name="req_qtyr-{{ $itemIndex }}[]" id="req_qtyr-{{ $bom->size }}_{{$itemIndex}}"  class="form-control global_total" size="1">
                                            @else
                                                <hr style="margin-top: 12px;margin-bottom: 12px;">
                                                <input type="text" value="{{ $bom->req_qty }}" name="req_qtyr-{{ $itemIndex }}[]" id="req_qtyr-{{ $bom->size }}_{{$itemIndex}}"  class="form-control global_total" size="1">
                                            @endif
                                        @elseif($bom->dependent_on == 3)
                                            @php $care_labelF  = 0; @endphp
                                            @if($care_labelF  == 0)
                                                @php $care_labelF  = 1; @endphp
                                                <input type="text" name="req_qtys-{{$itemIndex}}[]" value="{{ $bom->req_qty }}" id="req_qtyr-{{ $bom->size }}_{{ $bom->id }}_{{$itemIndex}}"   class="form-control global_total" size="1">
                                            @else
                                                <hr style="margin-top: 12px;margin-bottom: 12px;">
                                                <input type="text" name="req_qtys-{{$itemIndex}}[]" value="{{ $bom->req_qty }}" id="req_qtyr-{{ $bom->size }}_{{ $bom->id }}_{{$itemIndex}}"  class="form-control global_total" size="1">
                                            @endif
                                        @else
                                            <p></p>
                                        @endif

                                    </td>

                                    <td>
                                        <input type="text" value="{{ $bom->req_qty }}" name="booking_qty-{{$itemIndex}}[]"  class="form-control" size="1">
                                    </td>

                                        <td>
                                            <input type="date" value="{{ $bom->delivery_date }}" name="delivery_date-{{$itemIndex}}[]"  class="form-control" size="1">
                                        </td>
                                </tr>
                                @php $itemIndex++; @endphp
                            @endforeach

                            </tbody>
                        </table>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div><!-- /.col -->


            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).on('change keyup blur','.global-qty',function(){
            var id = $(this).attr('id');
            var data = $(this).attr('data');
            var idSplit = id.split('-');
            var idF = idSplit[0];
            //console.log(idF);
            var idS = idSplit[1];
            //console.log(idS);
            var qty = $(this).val();
            qty = qty == '' ? '0' : qty;
            var ce = $(".ce-"+data).html();
            console.log(ce);
            var totalReq = parseFloat(parseFloat(ce) * parseFloat(qty)).toFixed(2);
            $("#req_qtyr-"+idS).val(totalReq);

        });

        $(document).on('change keyup blur','.global-qtys',function(){
            var id = $(this).attr('id');
            var idSplit = id.split('-');
            var idF = idSplit[0];
            //console.log(idF);
            var idS = idSplit[1];
            //console.log(idS);
            var qty = $(this).val();
            qty = qty == '' ? '0' : qty;
            var ce = $(this).parent().parent().find("#ce").html();
            //console.log(ce);
            var totalReq = parseFloat(parseFloat(ce) * parseFloat(qty)).toFixed(2);
            $("#req_qtys-"+idS).val(totalReq);

        });
    </script>
    @endpush
@endsection
