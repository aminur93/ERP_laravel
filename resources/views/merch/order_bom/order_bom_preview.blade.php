@extends('merch.index')
@section('content')
@push('css')
	<style>
		hr{margin-top: 7px; margin-bottom: 7px; display: block;border-color: #d6d8db;}
		.table .thead-info th { color: #000; background-color: #d6d8db; border-color: #b3b7bb;}
		.capitalize{text-transform: capitalize;}

	</style>
@endpush
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li> 
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Order BOM</a>
				</li>  
				<li class="active">Order BOM Form</li>
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
			<div class="widget-body table-responsive">
				<table id="bomItemTable" class="table table-bordered table-responsive table-hover text-center capitalize">
					<thead class="thead-info">
						<tr>
							<th>SL.</th>
							<th>Main Category</th>
							<th>Item</th>
							<th>Item Code</th>
							<th>Description</th>
							<th>Supplier</th>
							<th>Article</th>
							<th>Composition</th>
							<th>Construction</th>
							<th>UoM</th>
							<th>Consumption</th>
							<th>Extra (%)</th>
							<th>Extra Qty</th>
							<th>Total</th>
							<th>Placements</th>
							<th>Item Description</th>
							<th>GMT color</th>
							<th>Items color</th>
							<th>Measurements</th>
							<th>Size</th>
							<th>Type</th>
							<th>Garment qty</th>
						</tr>
					</thead>  
					<tbody>
						@php $i = 0; @endphp
						@foreach($orderItems as $orderItem)
						@php 
							$extra_qty = number_format((($orderItem->consumption/100)*$orderItem->extra_percent), 2);
							$total     = number_format(($orderItem->consumption+$extra_qty), 2);
						@endphp
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $orderItem->category->mcat_name }}</td>
							<td>{{ $orderItem->item->item_name }}</td>
							<td>{{ $orderItem->item->item_code }}</td>
							<td>{{ $orderItem->item_description }}</td>
							<td>{{ $orderItem->supplier->sup_name }}</td>
							<td>{{ $orderItem->article->art_name }}</td>
							<td>{{ $orderItem->composition->comp_name }}</td>
							<td>{{ $orderItem->construction->construction_name }}</td>
							<td>{{ $orderItem->uom }}</td>
							<td>{{ $orderItem->consumption }}</td>
							<td>{{ $orderItem->extra_percent }}</td>
							<td>{{ $extra_qty }}</td>
							<td>{{ $total }}</td>
						</tr>
						@endforeach
					</tbody>  
				</table>
			</div><!-- /.col -->

			
			<!-- /.form -->
		</div><!-- /.page-content -->
	</div>
</div>



@endsection
