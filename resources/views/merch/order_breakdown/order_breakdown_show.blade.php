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
				<form action="{{ url('merch/order_breakdown_store') }}" method="post">{{ csrf_field() }}
					<table id="bomCostingTable" class="table table-bordered table-condensed">
						<thead>
						<tr>
							<th>Main Category</th>
							<th>Item</th>
							<th>Description</th>
							<th>Article</th>
							<th>Supplier</th>
							<th>Consumption</th>
							<th>Extra (%)</th>
							<th>(Consumption & Extra)</th>
							<th>Uom</th>
							<th>Unit Price</th>
							<th>Color</th>
							<th>Size</th>
							<th>Qty</th>
							<th>Req Qty</th>
						</tr>
						</thead>
						<tbody>
							@php $itemIndex = 0; @endphp
						@foreach($boms as $bom)
							
							<tr>
								<td class="vertical-align-center">
									{{ $bom->mcat_name }}
								</td>
								<td class="vertical-align-center">{{ $bom->item_name }}
									<input type="hidden" name="items[]" value="{{ $bom->item_name }}">
								</td>
								<td class="vertical-align-center">{{ $bom->item_description }}</td>
								<td class="vertical-align-center">{{ $bom->art_name }}</td>
								<th class="vertical-align-center">{{ $bom->sup_name }}</th>
								<td class="vertical-align-center">{{ $bom->consumption }}</td>
								<td class="vertical-align-center">{{ $bom->extra_percent }}</td>
								<td id="ce" class="vertical-align-center">
									@php
										$ptotal = ($bom->consumption * $bom->extra_percent)/100;
                                        $total = $ptotal + $bom->consumption;
									    echo $total;
									@endphp
								</td>
								<td class="vertical-align-center">{{ $bom->uom }}</td>
								<td class="vertical-align-center">{{ $bom->precost_unit_price }}</td>

								<input type="hidden" name="bom_costing_booking_id-{{ $itemIndex }}[]" value="{{ $bom->id }}" class="form-control">

								<input type="hidden" name="order_entry_order_id-{{ $itemIndex }}[]" value="{{ $bom->order_id }}" class="form-control">

								<input type="hidden" name="cat_item_id-{{ $itemIndex }}[]" value="{{  $bom->mr_cat_item_id }}" class="form-control">

								<input type="hidden" name="cat_item_mcat_id-{{ $itemIndex }}[]" value="{{  $bom->mr_material_category_mcat_id  }}" class="form-control">

								<!--COlor input field-->
								<td>
									@if($bom->dependent_on == 1)
										@php $colorF = 0; @endphp
										<?php foreach($colors as $color){ ?>
											@if($colorF == 0)
												@php $colorF = 1; @endphp
												{{ $color->clr_name }}
												<input type="hidden" name="clr_name-{{ $itemIndex }}[]" value="{{ $color->clr_name }}" class="form-control">
												<input type="hidden" value="{{ $color->clr_id }}" name="clr_id-{{ $itemIndex }}[]" >

												@else
												<hr style="margin-top: 10px;margin-bottom: 10px;">
												{{ $color->clr_name }}
												<input type="hidden" name="clr_name-{{ $itemIndex }}[]" value="{{ $color->clr_name }}" class="form-control">
												<input type="hidden" value="{{ $color->clr_id }}" name="clr_id-{{ $itemIndex }}[]" >

											@endif
										<?php } ?>

										@elseif($bom->dependent_on == 3)
											@php $care_colorF = 0; @endphp
											<?php
											foreach($filter as  $cl){
											?>
											@if($care_colorF == 0)
												@php $care_colorF = 1; @endphp
												{{ $cl }}
											@else
												<?php $counts = (count($sizes));
												  if($counts == 1){
												?>
												<hr style="margin-top: 44px;margin-bottom: 24px;">
												<?php }elseif($counts == 2){ ?>
													<hr style="margin-top: 88px;margin-bottom: 24px;">
												<?php }elseif($counts == 3){ ?>
													<hr style="margin-top: 132px;margin-bottom: 24px;">
												<?php }elseif($counts == 4){ ?>
													<hr style="margin-top: 176px;margin-bottom: 26px;">
												<?php }elseif($counts == 5){ ?>
													<hr style="margin-top: 230px;margin-bottom: 26px;">
												<?php }elseif($counts == 6){ ?>
													<hr style="margin-top: 274px;margin-bottom: 26px;">
												<?php }elseif($counts == 7){ ?>
													<hr style="margin-top: 351px;margin-bottom: 26px;">
												<?php }elseif($counts == 8){ ?>
													<hr style="margin-top: 395px;margin-bottom: 26px;">
												<?php }elseif($counts == 9){ ?>
													<hr style="margin-top: 439px;margin-bottom: 26px;">
												<?php }elseif($counts == 10){ ?>
													<hr style="margin-top: 483px;margin-bottom: 26px;">
												<?php }?>
												{{ $cl  }}
											@endif
											<?php } ?>
										@else
										<p></p>
									@endif
								</td>

								<!--size input field-->
								<td>
									@if($bom->dependent_on == 2)
										@php $sizeF = 0; @endphp
										<?php foreach($sizes as $size){ ?>
										@if($sizeF == 0)
											@php $sizeF = 1; @endphp
											{{ $size->mr_product_pallete_name }}
												<input type="hidden" name="sizer-{{ $itemIndex }}[]" value="{{ $size->mr_product_pallete_name }}" class="form-control">

										@else
											<hr style="margin-top: 29px;margin-bottom: 10px;">
											{{ $size->mr_product_pallete_name }}
												<input type="hidden" name="sizer-{{ $itemIndex }}[]" value="{{ $size->mr_product_pallete_name }}" class="form-control">

										@endif
										<?php } ?>
										@elseif($bom->dependent_on == 3)
										    @php $care_sizeF = 0 @endphp
											@foreach($care_label as $color)
												@if($care_sizeF == 0)
													@php $care_sizeF = 1; @endphp
													{{ $color->mr_product_pallete_name }}
													<input type="hidden" name="sizes-{{$itemIndex}}[]" value="{{ $color->mr_product_pallete_name }}" class="form-control" size="1">

													<input type="hidden" name="clr_ids-{{$itemIndex}}[]" value="{{ $color->clr_id }}" class="form-control">
												@else
													<hr style="margin-top: 24px;margin-bottom: 24px;">
													{{ $color->mr_product_pallete_name }}
													<input type="hidden" name="sizes-{{$itemIndex}}[]" value="{{ $color->mr_product_pallete_name }}" class="form-control" size="1">

													<input type="hidden" name="clr_ids-{{$itemIndex}}[]" value="{{ $color->clr_id }}" class="form-control">

												@endif
											@endforeach
										@else
										<p></p>
									@endif
								</td>


								<!--qty input field-->
								<td>
									@if($bom->dependent_on == 1)
										@php $qtyF = 0; @endphp
										@foreach($colors as $un)
											@if($qtyF == 0)
												@php $qtyF = 1; @endphp
												{{ $un->sum }}
												<input type="hidden" name="qty-{{$itemIndex}}[]" value="{{ $un->sum }}" class="form-control">
											@else
												<hr style="margin-top: 10px;margin-bottom: 10px;">
												{{ $un->sum }}
												<input type="hidden" name="qty-{{$itemIndex}}[]" value="{{ $un->sum }}" class="form-control">
											@endif
										@endforeach

										@elseif($bom->dependent_on == 2)
											@php $sizeF = 0; @endphp
											<?php foreach($sizes as $size){ ?>
											@if($sizeF == 0)
												@php $sizeF = 1; @endphp
											<input type="text" name="size_qtyss-{{$itemIndex}}[]" id="size_qty-{{ $size->mr_product_pallete_name }}_{{$itemIndex}}"   class="form-control global-qty" size="1">
											@else
												<hr style="margin-top: 10px;margin-bottom: 10px;">
											<input type="text" name="size_qtyss-{{$itemIndex}}[]" id="size_qty-{{ $size->mr_product_pallete_name }}_{{$itemIndex}}"  class="form-control global-qty" size="1">
											@endif
                                             <?php } ?>

										@elseif($bom->dependent_on == 3)
											@php $care_labelF  = 0; @endphp
											@foreach($care_label as $color)
												@if($care_labelF  == 0)
													@php $care_labelF  = 1; @endphp
													<input type="text" name="s_qtyss-{{$itemIndex}}[]" id="size_qtys-{{ $color->clr_name }}_{{ $color->mr_product_pallete_name }}_{{$itemIndex}}"  class="form-control global-qty" size="1">
												@else
													<hr style="margin-top: 12px;margin-bottom: 12px;">
													<input type="text" name="s_qtyss-{{$itemIndex}}[]" id="size_qtys-{{ $color->clr_name }}_{{ $color->mr_product_pallete_name }}_{{$itemIndex}}"  class="form-control global-qty" size="1">
												@endif
											@endforeach
										@elseif($bom->dependent_on == 0)
											{{ $order->order_qty }}
										    <input type="hidden" value="{{ $order->order_qty }}" name="order_qty-{{ $itemIndex }}[]" class="form-control">
										@else
										<p>Nothing Found</p>
									@endif
								</td>

								<!--req qty input field-->
								<td>

									 @php $r_qtyF = 0; @endphp
									 @php
										 $ptotal = ($bom->consumption * $bom->extra_percent)/100;
									     $total = $ptotal + $bom->consumption;
									 @endphp
										@if($bom->dependent_on == 1)
											@php $r_qtyF = 0; @endphp
											@foreach($colors as $un)
												@if($r_qtyF == 0)
													@php $r_qtyF = 1; @endphp
													{{ $un->sum * $total}}
												   <input type="hidden" name="req_qty-{{$itemIndex}}[]" value="{{ $un->sum * $total }}" class="form-control" size="1">

												@else
													<hr style="margin-top: 10px;margin-bottom: 10px;">
													{{ $un->sum * $total}}
												  <input type="hidden" name="req_qty-{{$itemIndex}}[]" value="{{ $un->sum * $total }}" class="form-control" size="1">

												@endif
											@endforeach
										@elseif($bom->dependent_on == 2)
											@php $sizeF = 0; @endphp
											<?php foreach($sizes as $size){ ?>
											@if($sizeF == 0)
												@php $sizeF = 1; @endphp
												<input type="text" name="req_qtyr-{{ $itemIndex }}[]" id="req_qtyr-{{$size->mr_product_pallete_name}}_{{$itemIndex}}" class="form-control global_total" size="1">
											@else
												<hr style="margin-top: 10px;margin-bottom: 10px;">
												<input type="text" name="req_qtyr-{{ $itemIndex }}[]" id="req_qtyr-{{$size->mr_product_pallete_name}}_{{$itemIndex}}" class="form-control global_total" size="1">
											@endif
                                        <?php } ?>

										@elseif($bom->dependent_on == 3)
											@php $care_labelF  = 0; @endphp
											@foreach($care_label as $color)
												@if($care_labelF  == 0)
													@php $care_labelF  = 1; @endphp
													<input type="text" value="" name="req_qtys-{{$itemIndex}}[]" id="req_qtyr-{{ $color->clr_name }}_{{$color->mr_product_pallete_name}}_{{$itemIndex}}"  class="form-control global_totals" size="1">
												@else
													<hr style="margin-top: 12px;margin-bottom: 12px;">
													<input type="text" value="" name="req_qtys-{{$itemIndex}}[]" id="req_qtyr-{{ $color->clr_name }}_{{$color->mr_product_pallete_name}}_{{$itemIndex}}"  class="form-control global_totals" size="1">
												@endif
											@endforeach
										@elseif($bom->dependent_on == 0)
											{{ $order->order_qty * $total }}
											<input type="hidden" value="{{ $order->order_qty * $total }}" name="order_req_qty-{{ $itemIndex }}[]" class="form-control">
											@else
											<p>Nothing Found</p>
										@endif

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

<script type="text/javascript">
	$(document).ready(function () {
//        var ce = $('#ce td').val();
//        console.log(ce);
        $('#bomCostingTable tr').each(function() {
            var ce = $(this).find("#ce").html();
            //console.log(ce);
            $(this).find("#ce").each(function(){

                //console.log(ce);

			})

        });
    });
</script>
@push('js')
	<script>
		$(document).on('change keyup blur','.global-qty',function(){
			var id = $(this).attr('id');
			var idSplit = id.split('-');
			var idF = idSplit[0];
			//console.log(idF);
			var idS = idSplit[1];
			//console.log(idS);
			var qty = $(this).val();
			qty = qty == '' ? '0' : qty;
			var ce = $(this).parent().parent().find("#ce").html();
			var totalReq = parseFloat(parseFloat(ce) * parseFloat(qty)).toFixed(2);
			$("#req_qtyr-"+idS).val(totalReq);
			
		});

//        $(document).on('change keyup blur','.global-qtys',function(){
//            var id = $(this).attr('id');
//            var idSplit = id.split('-');
//            var idF = idSplit[0];
//            //console.log(idF);
//            var idS = idSplit[1];
//            //console.log(idS);
//            var qty = $(this).val();
//            qty = qty == '' ? '0' : qty;
//            var ce = $(this).parent().parent().find("#ce").html();
//
//            var totalReq = parseFloat(parseFloat(ce) * parseFloat(qty)).toFixed(2);
//            $("#req_qtys-"+idS).val(totalReq);
//
//        });
	</script>
@endpush
@endsection