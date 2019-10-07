@extends('merch.index')
@section('content')
@push('css')
<style>
	/*.has-validation-callback{overflow-x: hidden;}*/
</style>
@endpush
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li> 
					<i class="ace-icon fa fa-usd home-icon"></i>
					<a href="#">Order Costing</a>
				</li>  
				<li class="active">Order Costing Create</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content  table-responsive">   
            <!-- Display Erro/Success Message -->
            @include('inc/message')
            {{ Form::open(['url'=>('merch/order_costing/'.request()->segment(3).'/create'), 'class'=>'row']) }}
 
	            <div class="widget-header text-right">
	            	<div class="col-sm-12"> 
		            </div>
	            </div>
 
				<div class="widget-body">
					<div class="row">
						<div class="col-sm-10">
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
						<div class="col-sm-2">
							<a href="{{ asset(!empty($order->stl_img_link)?$order->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}" target="_blank">
								<img class="thumbnail" height="100px" src="{{ asset(!empty($order->stl_img_link)?$order->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}" alt=""/>
							</a>
						</div>
					</div>
				</div>

                <div class="widget-body">
                    <table id="bomCostingTable" class="table table-bordered table-condensed table-responsive order-costing-table">
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
								<th>Unit_Price</th> 
								<th>Total_Price</th> 
								<th>Style_Cost</th> 
								<th>Req._Qty</th> 
								<th>Total_Value</th> 
							</tr>
                        </thead>  
						<tbody> 
							{!! (!empty($bomItemData)?$bomItemData:null) !!}
                        </tbody>   
                    </table>
                </div><!-- /.col -->

	            <div class="widget-footer text-right">
	            	{!! (!empty($buttons)?$buttons:null) !!} 
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
			$(this).parent().parent().parent().parent().find("input").not(".total_price").not(".required_qty").not(".total_val").prop("readonly", false);
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
	$(document).on("keyup change blur", ".fob, .lc, .freight, .unit_price, .total_category_price, .required_qty", function(){
		var fob = $(this).parent().parent().find(".fob").val();
		var lc = $(this).parent().parent().find(".lc").val();
		var freight = $(this).parent().parent().find(".freight").val();
		var consumption = $(this).parent().parent().find(".consumption").text();
		var extraCon = $(this).parent().parent().find(".extra").text();

		// calculate unit price
		// if enabled fob then fob, lc and freight values
		if ($(this).parent().parent().find(".fob").is("[readonly]"))
		{
			var sp_price = $(this).val();
			if($(this).val().indexOf('.')!=-1){
				this.value = parseFloat(this.value);
	            if($(this).val().split(".")[1].length > 4){
	                if( isNaN( parseFloat( this.value ) ) ) return;
	                this.value = parseFloat(this.value).toFixed(4);
	                sp_price = this.value;
	                $(this).val(sp_price);
	            }
	        } else {
	        	// if dot(.) not found
	    		// only 4 digit get
			    if(isNumber(sp_price) && sp_price.length>4) {
				   	sp_price = sp_price.substring(0,4);
				   	$(this).val(sp_price);
				} else {
			 		sp_price = this.value;
				}
	        }
	        var unit_price = sp_price; 
			// var unit_price = parseFloat($(this).parent().parent().find(".unit_price").val()).toFixed(2); 
		}
		else
		{
			var unit_price = parseFloat(parseFloat(fob)+parseFloat(lc)+parseFloat(freight)).toFixed(2); 
			// set unit price
			$(this).parent().parent().find(".unit_price").val(unit_price);
		}

		
		unit_price = isNaN(unit_price) ? '0.00' : unit_price;

		var comsumptionPer = parseFloat((parseFloat(consumption) * parseFloat(extraCon)) / 100).toFixed(2);
		var comsumptionEx = parseFloat(consumption) + parseFloat(comsumptionPer);	
		var total_category_price = parseFloat(parseFloat(unit_price)*parseFloat(comsumptionEx)).toFixed(2); 

		//required qty and total value
		var required_qty = $(this).parent().parent().find(".required_qty").val();
		var total_val = parseFloat(parseFloat(unit_price)*parseFloat(required_qty)).toFixed(2);
		//set total value
		$(this).parent().parent().find(".total_val").val(total_val);
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
	$(document).on("keyup change blur", ".total_price", function(){
		// calculate total and net fob price
		calculateFOB();
	}); 
 
	// SPECIAL PRICE
	$(document).on("keyup change blur", ".sp_price, .sp_total_price", function(){
		var sp_price = $(this).val();
		// remove mutiple dot(.) and set 0 first
		if($(this).val().indexOf('.')!=-1){
			this.value = parseFloat(this.value);
            if($(this).val().split(".")[1].length > 4){
                if( isNaN( parseFloat( this.value ) ) ) return;
                this.value = parseFloat(this.value).toFixed(4);
                sp_price = this.value;
            }
        } else {
        	// if dot(.) not found
    		// only 4 digit get
		    if(isNumber(sp_price) && sp_price.length>4) {
			   	sp_price = sp_price.substring(0,4);
		    	$(this).val(sp_price);
			} else {
		 		sp_price = this.value;
			}
        }
		$(this).parent().parent().find(".sp_total_price").val(sp_price);
		// calculate total and net fob price
		calculateFOB();
	}); 

	function isNumber (o) {
	  return ! isNaN (o-0);
	}
	//Buyer commision
	$(document).on('change keyup blur','.buyer_comission_percent',function(){
		calculateFOB()
	});

	//Agent commision
	$(document).on('change keyup blur','.agent_comission_percent',function(){
		calculateFOB()
	});

	// calculate total and net fob price
	function calculateFOB()
	{ 
		var net_fob = 0; 
		var net_style_total = 0; 
		var total_fob = 0;
		var buyer_total = $(".buyer_total_price").val();
		var agent_total = $(".agent_total_price").val();
		$(".total_price").each(function(i, v) {
			net_fob = parseFloat(parseFloat(net_fob)+parseFloat($(this).val())).toFixed(2); 
		});
		$(".net_fob").val(net_fob);

		// buyer_comission_percent
		var buyerComissionValue = $(".buyer_comission_percent").val();	
		var net_fob = $(".net_fob").val();
		var buyerPercent = parseFloat((net_fob * buyerComissionValue)/100).toFixed(2);
		$(".buyer_price").val(buyerPercent);
		$(".buyer_total_price").val(buyerPercent);

		//buyer fob 
		var buyerPercent = $(".buyer_total_price").val();
		var buyerFob = parseFloat(parseFloat(net_fob) + parseFloat(buyerPercent)).toFixed(2);
		$(".buyer_fob").val(buyerFob);

		// agent_comission_percent
		var agentComissionValue = $(".agent_comission_percent").val();	
		var buyer_fob = $(".buyer_fob").val();
		var agentPercent = parseFloat((buyer_fob * agentComissionValue)/100).toFixed(2);
		$(".agent_price").val(agentPercent);
		$(".agent_total_price").val(agentPercent);

		//agent fob
		var agentPercent = $(".agent_total_price").val();
		var agentFob = parseFloat(parseFloat(buyerFob) + parseFloat(agentPercent)).toFixed(2);
		$(".agent_fob").val(agentFob);

		$(".total_fob").val(parseFloat(parseFloat(net_fob)+parseFloat(buyer_total)+parseFloat(agent_total)).toFixed(2)); 
	}



});
</script>
@endsection
