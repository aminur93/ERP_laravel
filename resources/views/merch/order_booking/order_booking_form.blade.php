@extends('merch.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li> 
					<i class="ace-icon fa fa-usd home-icon"></i>
					<a href="#">Order Booking</a>
				</li>  
				<li class="active">Order Booking Create</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content  table-responsive">   
            <!-- Display Erro/Success Message -->
            @include('inc/message')
            {{ Form::open(['url'=>('merch/order_booking/'.request()->segment(3).'/create'), 'class'=>'row']) }}
 
	            <div class="page-header row">
	            	<div class="text-right">
	            		@if($isBooking)
                    	<a href='{{ url("merch/order_booking") }}' class="btn btn-sm btn-info" title="Booking List"><i class="glyphicon glyphicon-th-list"></i></a>
                    	@endif
		            </div>
	            </div>
 
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
                    <table id="bomCostingTable" class="table table-bordered table-condensed">
						<thead>
							<tr>
								<th>Main Category</th>
								<th>Item</th>
								<th>Item Code</th>
								<th>Description</th>
								<th>Color</th>
								<th>Size / Width</th>
								<th>Article</th>
								<th>Composition</th>
								<th>Construction</th>
								<th>Supplier</th>
								<th>Consumption</th>
								<th>Extra (%)</th>
								<th>Unit</th> 
								<th>Terms</th> 
								<th>FOB</th> 
								<th>L/C</th> 
								<th>Freight</th> 
								<th>Unit Price</th> 
								<th>Total Price</th> 
								<th>Req. Qty</th> 
								<th>Total Value</th> 
								<th>Total Qty</th> 
								<th>Booking Qty</th> 
								<th>Del. Date</th> 
							</tr>
                        </thead>  
						<tbody> 
							{!! (!empty($bomItemData)?$bomItemData:null) !!}
                        </tbody>   
                    </table>
                </div><!-- /.col -->

	            <div class="widget-footer text-right">
	            	<div class="col-sm-12">
		                <button type="submit" class="btn btn-success btn-sm">Submit</button> 
		            </div>
	            </div>
			{!! Form::close() !!}
            <!-- /.form -->
		</div><!-- /.page-content -->
	</div>
</div>
 
<script type="text/javascript">
$(document).ready(function(){
	/*
	* BOM TERM 
	* -----------------------------------------------------
	*/ 
	$("body").on("click", ".bom_term", function(){ 
		var term = $(this).attr("value");
		if (term=="FOB")
		{
			$(this).parent().parent().parent().parent().find("input").prop("readonly", false);
		} 
		else
		{
			$(this).parent().parent().parent().parent().find(".fob").prop("readonly", true).val(0);
			$(this).parent().parent().parent().parent().find(".lc").prop("readonly", true).val(0);
			$(this).parent().parent().parent().parent().find(".freight").prop("readonly", true).val(0);
		} 
	});
 
	/*
	* -----------------------------------------------------
	* CALCULATE 
	* -----------------------------------------------------
	*/ 
	// INITIAL TOTAL
	$(window).on("load", function(){
		$('input[type=text]').css('font-size', '9px');
		// calculate total and net fob price
		calculateFOB();
	});

	// CATEGORY PRICE CALCULATION 
	$("body").on("keyup onchange", ".fob, .lc, .freight, .unit_price, .total_category_price", function(){
		var fob = $(this).parent().parent().find(".fob").val();
		var lc = $(this).parent().parent().find(".lc").val();
		var freight = $(this).parent().parent().find(".freight").val();
		var consumption = $(this).parent().parent().find(".consumption").text();

		// calculate unit price
		// if enabled fob then fob, lc and freight values
		if ($(this).parent().parent().find(".fob").is("[readonly]"))
		{
			var unit_price = parseFloat($(this).parent().parent().find(".unit_price").val()).toFixed(2); 
		}
		else
		{
			var unit_price = parseFloat(parseFloat(fob)+parseFloat(lc)+parseFloat(freight)).toFixed(2); 
			// set unit price
			$(this).parent().parent().find(".unit_price").val(unit_price);
		}
			
		var total_category_price = parseFloat(parseFloat(unit_price)*parseFloat(consumption)).toFixed(2); 
		// set total price
		$(this).parent().parent().find(".total_category_price").val(total_category_price);

		// calculate subtotal
		$(this).parent().parent().parent().find('.subtotal').val(0); //reset subtotal
		$(".total_category_price").each(function(i, v) {
			var cat_id = $(this).data("cat-id");
			var total  = $(this).val(); 
			// calculate subtotal  
			var subtotal = $(this).parent().parent().parent().find('input[data-subtotal="'+cat_id+'"]'); 
			if (subtotal.length > 0) 
			{
				$(this).parent().parent().parent().find('[data-subtotal="'+cat_id+'"]').val(parseFloat(total)+parseFloat(subtotal.val()));
			} 
		});

		// calculate total and net fob price
		calculateFOB();
	});

	// TOTAL PRICE
	$("body").on("keyup onchange", ".total_price", function(){
		// calculate total and net fob price
		calculateFOB();
	}); 
 
	// SPECIAL PRICE
	$("body").on("keyup onchange", ".sp_price, .sp_total_price", function(){
		$(this).parent().parent().find(".sp_price").val($(this).val());
		$(this).parent().parent().find(".sp_total_price").val($(this).val());
		// calculate total and net fob price
		calculateFOB();
	}); 

	// calculate total and net fob price
	function calculateFOB()
	{ 
		var net_fob = 0; 
		var total_fob = 0;
		var buyer_total = $(".buyer_total_price").val();
		$(".total_price").each(function(i, v) {
			net_fob = parseFloat(parseFloat(net_fob)+parseFloat($(this).val())).toFixed(2); 
		});
		$(".net_fob").val(net_fob);

		$(".total_fob").val(parseFloat(parseFloat(net_fob)+parseFloat(buyer_total)).toFixed(2)); 
	}



});
</script>
@endsection
