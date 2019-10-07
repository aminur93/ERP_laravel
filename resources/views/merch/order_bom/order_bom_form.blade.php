@extends('merch.index')
@section('content')
@push('css')
	<style>
		.btn-group-xs>.btn, .btn-xs {border-width: 0px; border-radius: 3px; padding-bottom: 2px;}
		.page-content {padding: 8px 25px 24px;}
		.table .thead-info th { color: #000; background-color: #d6d8db; border-color: #b3b7bb;}
		.modal { overflow: auto !important; }
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
                        <div class="wraper">

			</div>
			<input type="hidden" name="url" value="{{URL::to('/')}}">



			@if(!empty($isBom))
			<div class="page-header row">

				<div class="text-right">
					{{-- show preview page then comment out a tag --}}
					{{-- <a rel='tooltip' data-tooltip="Order BOM Preview" data-tooltip-location="top" href="{{URL::to('merch/order_bom/'.$order->order_id.'/preview')}}" class="btn btn-warning btn-xs" target="_blank">
						<i class="fa fa-eye"></i> Preview
					</a> --}}
					<button rel='tooltip' data-tooltip-location='top' data-tooltip='Order BOM Add Item' type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#newBomModal">
					<i class="glyphicon  glyphicon-plus"></i>	Add Item
					</button>
					@if($check_costing)
					<a href='{{ url("merch/order_costing/".$order->order_id."/edit") }}' class="btn btn-xs btn-success" rel='tooltip' data-tooltip-location='top' data-tooltip="Edit Costing"><i class="glyphicon glyphicon-pencil"></i> Edit Costing</a>
					@else
					<a href='{{ url("merch/order_costing/".$order->order_id."/create") }}' class="btn btn-xs btn-success" rel='tooltip' data-tooltip-location='top' data-tooltip="Costing"><i class="glyphicon glyphicon-plus"></i> Add Costing</a>
					@endif
					<a href='{{ url("merch/order_bom") }}' class="btn btn-xs btn-info" rel='tooltip' data-tooltip-location='top' data-tooltip="BOM List"><i class="glyphicon glyphicon-th-list"></i> BOM List</a>
				</div>
			</div>
			@else
			<div class="widget-header text-right">
				<div class="col-sm-12">
					<button rel='tooltip' data-tooltip-location='top' data-tooltip='Order BOM Add Item' type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#newBomModal">
					<i class="glyphicon  glyphicon-plus"></i>	Add Item
					</button>
				</div>
			</div>
			@endif
			<input type="hidden" value="{{$order->order_id}}" id="order-id">

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
			{{ Form::open(['url'=>('merch/order_bom/'.request()->segment(3).'/store'), 'class'=>'row']) }}
			<input type="hidden" name="mr_style_stl_id" id="mr_style_stl_id" value="{{$order->mr_style_stl_id}}">
			<div class="widget-body table-responsive">
				<table id="bomItemTable" class="table table-striped table-bordered table-responsive table-hover">
					<thead class="thead-info">
						<tr>
							<th>Main Category</th>
							<th width="10%">Item</th>
							<th width="62">Dependency</th>
							<th>Description</th>
							<th width="80">Supplier</th>
							<th width="80">Article</th>
							<th>Composition</th>
							<th>Construction</th>
							<th width="80">UoM</th>
							<th>Consumption</th>
							<th>Extra (%)</th>
							<th>Extra Qty</th>
							<th>Total</th>
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


<!-- NEW BOM  -->
<div class="modal fade" id="newBomModal" tabindex="-1" role="dialog" aria-labelledby="newBomLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">BOM Item</h4>
			</div>
			<div class="modal-body" style="padding:0 15px">
				{!! (!empty($modalItem)?$modalItem:null) !!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				<button type="button" id="newBomModalDone" class="btn btn-primary btn-sm">Done</button>
			</div>
		</div>
	</div>
</div>

<!-- NEW ARTICLE  -->
<div class="modal fade newArticleModal" tabindex="-1" role="dialog" aria-labelledby="newArticleLabel">
  	<div class="modal-dialog modal-xs" role="document">
    	{{ Form::open(["url"=>"", "id"=>"newArticle", "class"=>"modal-content form-horizontal"]) }}
      		<div class="modal-header">
        		<h4 class="modal-title text-center">Add Article</h4>
      		</div>
	    	<div class="modal-body">
		      	<div class="row">
			      	<div class="col-xs-12">
			      		<div class="message"></div>

			            <div class="form-group">
			                <label class="col-sm-3 control-label no-padding-right" for="supplier_name"> Supplier Name<span style="color: red">&#42;</span></label>
			                <div class="col-sm-6">
			                    <input name="supplier_id" type="hidden" id="supplier_id" placeholder="Supplier id"/>
			                    <input type="text" id="supplier_name" placeholder="Supplier Name" class="col-xs-12 form-control" data-validation="required" readonly/>
			                </div>
			            </div>

			            <div class="form-group">
			                <label class="col-sm-3 control-label no-padding-right" for="article_name"> Article Name<span style="color: red">&#42;</span> </label>
			                <div class="col-sm-6">
			                    <input name="article_name" type="text" id="article_name" placeholder="Article Name" class="col-xs-12 form-control" data-validation="required"/>
			                </div>
			            </div>

			            <div class="form-group">
			              <label class="col-sm-3 control-label no-padding-right" for="art_composition" >Composition </label>
			                <div class="col-sm-6">
			                  <input type="text" id="art_composition" name="art_composition" placeholder="Enter Composition" class="col-xs-12 form-control" />
			                </div>
			            </div>

			            <div class="form-group">
			              <label class="col-sm-3 control-label no-padding-right" for="art_construction" >Construction</label>
			              <div class="col-sm-6">
			                <input type="text" id="art_construction" name="art_construction" placeholder="Enter Construction" class="col-xs-12 form-control" />
			              </div>
			            </div>
			      	</div>
		      	</div>
	    	</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary btn-sm">Submit</button>
      		</div>
    	{{ Form::close() }}
  	</div>
</div>

<!-- NEW COMPOSITION  -->
<div class="modal fade newCompositionModal" tabindex="-1" role="dialog" aria-labelledby="newCompositionLabel">
	<div class="modal-dialog" role="document">
		{{ Form::open(["url"=>"", "id"=>"newComposition", "class"=>"modal-content form-horizontal"]) }}
		<div class="modal-header">
			<h4 class="modal-title">Add Composition</h4>
		</div>
		<div class="modal-body row">
			<div class="message"></div>
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="supplier_name"> Supplier Name </label>
				<div class="col-sm-8">
					<input name="supplier_id" type="hidden" id="supplier_id" placeholder="Supplier id"/>
					<input type="text" id="supplier_name" placeholder="Supplier Name" class="col-xs-10 col-sm-5" data-validation="required" readonly/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right composition"> Composition Name </label>
				<div class="col-sm-8">
					<input name="composition_name" type="text" id="composition_name" placeholder="Composition Name" class="col-xs-10 col-sm-5" data-validation="required"/>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary btn-sm">Submit</button>
		</div>
		{{ Form::close() }}
	</div>
</div>

<!-- NEW  CONSTRUCTION -->
<div class="modal fade newConstructionModal" tabindex="-1" role="dialog" aria-labelledby="newConstructionLabel">
	<div class="modal-dialog" role="document">
		{{ Form::open(["url"=>"", "id"=>"newConstruction", "class"=>"modal-content form-horizontal"]) }}
		<div class="modal-header">
			<h4 class="modal-title">Add Construction</h4>
		</div>
		<div class="modal-body row">
			<div class="message"></div>
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="supplier_name"> Supplier Name </label>
				<div class="col-sm-8">
					<input name="supplier_id" type="hidden" id="supplier_id" placeholder="Supplier id"/>
					<input type="text" id="supplier_name" placeholder="Supplier Name" class="col-xs-10 col-sm-5" data-validation="required" readonly/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right construction"> Construction Name </label>
				<div class="col-sm-8">
					<input name="construction_name" type="text" id="construction_name" placeholder="Construction Name" class="col-xs-10 col-sm-5" data-validation="required"/>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary btn-sm">Submit</button>
		</div>
		{{ Form::close() }}
	</div>
</div>

@include('merch.order_bom.order_item_modal')
@include('merch.order_bom.order_supplier_modal')
@include('merch.order_bom.order_supplier_item_modal')

<script type="text/javascript">
	$(document).ready(function(){
	/*
	* NEW BOM ITEM
	* -----------------------
	*/
	$("body").on("click", ".supplier_save", function(e) {

	 var formData = $('#supForm').serialize();
			$.ajax({
				url     : "{{ url('merch/setup/ajax_save_supplier') }}",
				data    : formData,
				type    : 'POST',
				success : function(res) {

					// if(data.length > 0){
					
					var option = new Option(res.sup_name, res.id);
					$('.supplier').append($(option));
					var message = '<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						'Supplier Saved Successfully.'+
					'</div>';
					$('.wraper').append(message);

					$('.newSupplierModal').modal('hide');
				// }
				},
				error   : function(xhr) {
					console.log(xhr)
					var message = '<div class="alert alert-danger alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						'Something Went Wrong! Please Try Again'+
					'</div>';
					$('.wraper').append(message);
				}
	});


	});
	var modal = $("#newBomModal");
	$("body").on("click", "#newBomModalDone", function(e) {

		// ------table actions----------
		var table_item = [];
		$("body #bomItemTable > tbody > tr").each(function(i, v) {
			table_item.push($(this).attr("id"));
		});

		//-------- modal actions ------------------
		modal.find('.modal-body input[type=checkbox]').each(function(i,v) {
			var item     = $(this).val();
			var category = $(this).prev().val();
			//--------------------------------------
			if ($(this).prop("checked") == true)
			{
				if (table_item.length == 0)
				{
					getItem(item, category);
				}
				else if (table_item.includes(item) == false)
				{
					getItem(item, category);
				}
			}
			else
			{
				$("body #bomItemTable > tbody").find('tr[id="'+item+'"]').remove();
			}
		});
		modal.modal('hide');
	});

	// get item
	function getItem(item_id, category_id)
	{
		$.ajax({
			url     : "{{ url('merch/order_bom/get_item_data') }}",
			data    : { item_id, category_id },
			success : function(data) {
				if(data.category_id == 1){
					$("#bomItemTable tbody#fabric").append(data.value);
				}else if(data.category_id == 2){
					$("#bomItemTable tbody#sewing-accessories").append(data.value);
				}else if(data.category_id == 3){
					$("#bomItemTable tbody#finishing-accessories").append(data.value);
				}
			},
			error   : function(xhr) {
				console.log(xhr)
			}
		});
	}

	/*
	* --------CALCULATE TOTAL---------
	*/
	$("body").on("keyup", ".calc", function(){
		var consumption = $(this).parent().parent().find(".consumption").val();
		var extra = $(this).parent().parent().find(".extra").val();
		var qty   = parseFloat(((parseFloat(consumption)/100)*parseFloat(extra))).toFixed(2);
		var total = (parseFloat(qty)+parseFloat(consumption)).toFixed(2);
		$(this).parent().parent().find(".qty").val(qty);
		$(this).parent().parent().find(".total").val(total);
	});


	/*
	* GET ARTICLE, COMPOSITION AND CONSTRUCTION
	* -------------------------------------------
	*/
	$("body").on("change", ".supplier", function() {
		var that = $(this);
		// load article
		$.ajax({
			url: "{{ url('merch/order_bom/get_article_by_supplier') }}",
			data: {
				"supplier_id" : that.val(),
				"name"        : "mr_article_id[]",
				"selected"    : "",
				"option"      : {
					"class"           : "form-control input-sm no-select bom_article",
					"placeholder"     : "Select"
				}
			},
			success: function(data) {
				that.parent().parent().next().html(data);
			},
			error: function(xhr) {
				console.log(xhr)
			}
		});
	});

	$("body").on("change", ".bom_article", function() {
		var that= $(this);
		$.ajax({
			url: "{{ url('merch/style_bom/get_composition_by_article') }}",
			data: {
				"article_id" : $(this).val()
			},
			success: function(data) {
				that.parent().parent().next().text(data.cons);
				that.parent().parent().next().next().text(data.comp);
			},
			error: function(xhr) {
				console.log(xhr)
			}
		});
	});


	/*
	* NEW ARTICLE
	* -------------------------------------------
	*/
	$('.newArticleModal').on('show.bs.modal', function (e) {
		var modal = $(this);
		var button = $(e.relatedTarget);
		var supplier_id = button.parent().parent().parent().parent().find(".supplier option:selected").val();
		var supplier_name = button.parent().parent().parent().parent().find(".supplier option:selected").text();
		modal.find("#supplier_id").val(supplier_id);
		modal.find("#supplier_name").val(supplier_name);

		// new article
		$("#newArticle").on("submit", function(e) {
			e.preventDefault();
			var that = $(this);
			$.ajax({
				url: "{{ url('merch/style_bom/new_article') }}",
				dataType: "json",
				data: {
					"supplier_id"  : that.find("#supplier_id").val(),
					"article_name" : that.find("#article_name").val(),
					"art_composition" : that.find("#art_composition").val(),
					"art_construction" : that.find("#art_construction").val(),
					"name"         : "mr_article_id[]",
					"selected"     : "",
					"option"       : {
						"class" : "form-control input-sm no-select article bom_article",
						"placeholder"     : "Select",
						"data-validation" : "required"
					}
				},
				success: function(data) {
					if (data.status)
					{
						button.parent().parent().parent().html(data.result);
						modal.find("#supplier_id").val("");
						modal.find("#supplier_name").val("");
						modal.find("#article_name").val("");
						modal.find(".message").html("");
						$('.newArticleModal').modal('hide');
						that.unbind('submit');
					}
					else
					{
						modal.find(".message").html("<div class='alert alert-danger'>"+data.message+"</div>");
					}
				},
				error: function(xhr) {
					console.log(xhr)
				}
			});
		});
	});

	/*
	* NEW COMPOSITION
	* -------------------------------------------
	*/
	$('.newCompositionModal').on('show.bs.modal', function (e) {
		var modal = $(this);
		var button = $(e.relatedTarget);
		var supplier_id = button.parent().parent().parent().parent().find(".supplier option:selected").val();
		var supplier_name = button.parent().parent().parent().parent().find(".supplier option:selected").text();
		modal.find("#supplier_id").val(supplier_id);
		modal.find("#supplier_name").val(supplier_name);

		// new article
		$("#newComposition").on("submit", function(e) {
			e.preventDefault();
			var that = $(this);
			$.ajax({
				url: "{{ url('merch/style_bom/new_composition') }}",
				dataType: "json",
				data: {
					"supplier_id"  : that.find("#supplier_id").val(),
					"composition_name" : that.find("#composition_name").val(),
					"name"         : "mr_composition_id[]",
					"selected"     : "",
					"option"       : {
						"class" : "form-control input-sm no-select article",
						"placeholder"     : "Select",
						"data-validation" : "required"
					}
				},
				success: function(data) {
					if (data.status)
					{
						button.parent().parent().parent().html(data.result);
						modal.find("#supplier_id").val("");
						modal.find("#supplier_name").val("");
						modal.find("#composition_name").val("");
						modal.find(".message").html("");
						$('.newCompositionModal').modal('hide');
						that.unbind('submit');
					}
					else
					{
						modal.find(".message").html("<div class='alert alert-danger'>"+data.message+"</div>");
					}
				},
				error: function(xhr) {
					console.log(xhr)
				}
			});
		});
	});


	/*
	* NEW CONSTRUCTION
	* -------------------------------------------
	*/
	$('.newConstructionModal').on('show.bs.modal', function (e) {
		var modal = $(this);
		var button = $(e.relatedTarget);
		var supplier_id = button.parent().parent().parent().parent().find(".supplier option:selected").val();
		var supplier_name = button.parent().parent().parent().parent().find(".supplier option:selected").text();
		modal.find("#supplier_id").val(supplier_id);
		modal.find("#supplier_name").val(supplier_name);

		// new article
		$("#newConstruction").on("submit", function(e) {
			e.preventDefault();
			var that = $(this);
			$.ajax({
				url: "{{ url('merch/style_bom/new_construction') }}",
				dataType: "json",
				data: {
					"supplier_id"  : that.find("#supplier_id").val(),
					"construction_name" : that.find("#construction_name").val(),
					"name"         : "mr_construction_id[]",
					"selected"     : "",
					"option"       : {
						"class" : "form-control input-sm no-select article",
						"placeholder"     : "Select",
						"data-validation" : "required"
					}
				},
				success: function(data) {
					if (data.status)
					{
						button.parent().parent().parent().html(data.result);
						modal.find("#supplier_id").val("");
						modal.find("#supplier_name").val("");
						modal.find("#construction_name").val("");
						modal.find(".message").html("");
						$('.newConstructionModal').modal('hide');
						that.unbind('submit');
					}
					else
					{
						modal.find(".message").html("<div class='alert alert-danger'>"+data.message+"</div>");
					}
				},
				error: function(xhr) {
					console.log(xhr)
				}
			});
		});
	});

	/*
	* COLOR LIST WITH BACKGROUND COLOR
	* -------------------------------------------
	*/
	$("body").on("click", "select.color", function(){
		$("body select.color option").each(function(i, v) {
			$(this).css('background-color', $(this).text());
		});
		$(this).css('background-color', $(this).find('option:selected').text());
	});

	/*
	* Size and Color Dependancy Checkbox value Setup
	* -------------------------------------------
	*/
	$("body").on("click", ".color_depends" , function(){
		if($(this).is(':checked')){
			$(this).next().next().removeAttr('name');
		}
		else{
			$(this).next().next().attr('name',"color_depends[]");
		}
	});

	$("body").on("click", ".size_depends" , function(){
		if($(this).is(':checked')){
			$(this).next().next().removeAttr('name');
		}
		else{
			$(this).next().next().attr('name',"size_depends[]");
		}
	});

});
// $(document).ready(function () {
//   $('.sidebar-collapse').click();
// });
</script>
@push('js')
{{--  --}}

<script>
	var base_url = $('input[name="url"]').val();
	var _token = $('input[name="_token"]').val();

  $(".overlay-modal, .item_details_dialog").css("opacity", 0);
  /*Remove inline styles*/
  $(".overlay-modal, .item_details_dialog").removeAttr("style");
  /*Set min height to 90px after  has been set*/
  var detailsheight = $(".item_details_dialog").css("min-height", "115px");
	function itemDetails(cat_id, cat_item_id) {
		//console.log(cat_id);
		$('#order_item_name').html('...');
		$("#loader-result").show();
		$("#modal-details-content").hide();
		$('body').css('overflow', 'hidden');
		$("#order_cat_id").val(cat_id);
		$("#order_item_id").val(cat_item_id);
		$("#order_id").val($("#order-id").val());
		/*Show the dialog overlay-modal*/
    $(".overlay-modal-details").show();
    /*Animate Dialog*/
    $(".show_item_details_modal").css("width", "225").animate({
      "opacity" : 1,
      height : detailsheight,
      width : "90%"
    }, 600, function() {
      /*When animation is done show inside content*/
      $(".fade-box").show();
      $.ajax({
	    	url: base_url+'/merch/order_bom/single-order-details-info',
	      type: "GET",
	      data: {
	    		_token : _token,
	        order_id : $("#order-id").val(),
	        item_id : cat_item_id
	    	},
	    	success: function(response){
	    		//console.log(response);
	    		$('.details_button_ok').html('Confirm');
	    		$('#order_item_name').html(response.item_name);
	    		$('#order_item_qty').val(response.item_qty);
	    		var getOrderDetails = response.getOrderDetails;
	    		$('.item_details tbody').html('');
	    		$("#loader-result").hide();
					$("#modal-details-content").show();
					var o = 1;
					if(getOrderDetails.length > 0){
						$('.details_button_ok').html('Update');
	    			for (var i = 0; i < getOrderDetails.length; i++) {
							html = '<tr id="'+o+'" class="'+getOrderDetails[i].id+'">';
							html += '<td id="check_'+o+'"><input class="case" type="checkbox"/></td>';
							html += '<td id="placement_'+o+'"><input type="text" class="form-control autocomplete_pla" data-type="placement" autocomplete="off"  name="exsis_placements[]" value="'+getOrderDetails[i].item_placement.placement+'" required><input type="hidden" class="form-control" name="exsis_placement_id[]" value="'+getOrderDetails[i].id+'"></td>';
							html += '<td id="description_'+o+'"><input type="text" class="form-control" name="exsis_description[]" value="'+getOrderDetails[i].description+'"></td>';
							var gmtColorLength = getOrderDetails[i].gmt_color.length;
							var g = 1;
							var addmoreBtn = '';
							var gmtColor = '';
							var itemcolor = '';
							var measurement = '';
							var size = '';
							var type = '';
							var qty = '';
							for (var s = 0; s < gmtColorLength; s++) {
								//add more setion load
								if(addmoreBtn == ''){
									var moreOption = '<a rel="tooltip" data-tooltip-location="right" data-tooltip="Add More Color Size Breakdown" class="addmoreoption more btn btn-xs btn-info" id="more_'+o+'_'+g+'"><i class="fa fa-plus-circle"></i></a>';
								}else{
									var moreOption = '<hr><a rel="tooltip" data-tooltip-location="right" data-tooltip="Remove Color Size" class="btn btn-xs btn-danger more remove_sub" id="remove_'+o+'_'+g+'" data-type="'+getOrderDetails[i].gmt_color[s].id+'"><i class="fa fa-minus-circle"></i></a>';
								}
								addmoreBtn += moreOption;
								//gmt color load
								if(gmtColor == ''){
									var gtm = '<div id="gmtcolor_'+o+'_'+g+'"><input type="text" class="form-control" name="exsis_gmt_color_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].gmt_color+'"><input type="hidden" class="form-control" name="exsis_gmt_color_id_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].id+'"></div>';
								}else{
									var gtm = '<div id="gmtcolor_'+o+'_'+g+'"><hr><input type="text" class="form-control" name="exsis_gmt_color_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].gmt_color+'"><input type="hidden" class="form-control" name="exsis_gmt_color_id_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].id+'"></div>';
								}
								gmtColor += gtm;
								//item color load
								if(itemcolor == ''){
									var itemC = '<div id="itemcolor_'+o+'_'+g+'"><input type="text" class="form-control" name="exsis_item_color_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.color_name+'"><input type="hidden" class="form-control" name="exsis_item_color_measurement_id_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.id+'"></div>';
								}else{
									var itemC = '<div id="itemcolor_'+o+'_'+g+'"><hr><input type="text" class="form-control" name="exsis_item_color_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.color_name+'"><input type="hidden" class="form-control" name="exsis_item_color_measurement_id_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.id+'"></div>';
								}
								itemcolor += itemC;
								//measurement load
								if(getOrderDetails[i].gmt_color[s].item_color_measurement.measurement == null){
									getOrderDetails[i].gmt_color[s].item_color_measurement.measurement = '';
								}
								if(measurement == ''){
									var measurementD = '<div id="measurement_'+o+'_'+g+'"><input type="text" class="form-control" name="exsis_measurement_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.measurement+'"></div>';
								}else{
									var measurementD = '<div id="measurement_'+o+'_'+g+'"><hr><input type="text" class="form-control" name="exsis_measurement_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.measurement+'"></div>';
								}
								measurement += measurementD;
								//size load
								if(getOrderDetails[i].gmt_color[s].item_color_measurement.size == null){
									getOrderDetails[i].gmt_color[s].item_color_measurement.size = '';
								}
								if(size == ''){
									var sizeD = '<div id="size_'+o+'_'+g+'"><input type="text" class="form-control autocomplete_txt" data-type="type" autocomplete="off" name="exsis_size_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.size+'"></div>';
								}else{
									var sizeD = '<div id="size_'+o+'_'+g+'"><hr><input type="text" class="form-control autocomplete_txt" name="exsis_size_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.size+'" autocomplete="off"></div>';
								}
								size += sizeD;
								//type load
								if(getOrderDetails[i].gmt_color[s].item_color_measurement.type == null){
									getOrderDetails[i].gmt_color[s].item_color_measurement.type = '';
								}
								if(type == ''){
									var typeD = '<div id="type_'+o+'_'+g+'"><input type="text" class="form-control autocomplete_txt" data-type="type" autocomplete="off" name="exsis_type_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.type+'"></div>';
								}else{
									var typeD = '<div id="type_'+o+'_'+g+'"><hr><input type="text" class="form-control autocomplete_txt" data-type="type" autocomplete="off" name="exsis_type_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.type+'"></div>';
								}
								type += typeD;
								//qty load
								if(qty == ''){
									var qtyD = '<div id="qty_'+o+'_'+g+'"><input type="text" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" name="exsis_qty_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.qty+'"></div>';
								}else{
									var qtyD = '<div id="qty_'+o+'_'+g+'"><hr><input type="text" class="form-control" name="exsis_qty_'+o+'[]" value="'+getOrderDetails[i].gmt_color[s].item_color_measurement.qty+'"></div>';
								}
								qty += qtyD;

								g++;
							}
							html += '<td id="add_'+o+'" class="add_btn">'+addmoreBtn+'</td>';
							html += '<td id="gmt_color_'+o+'">'+gmtColor+'</td>';
							html += '<td id="item_color_'+o+'">'+itemcolor+'</td>';
							html += '<td id="measurement_'+o+'">'+measurement+'</td>';
							html += '<td id="size_'+o+'">'+size+'</td>';
							html += '<td id="type_'+o+'">'+type+'</td>';
							html += '<td id="qty_'+o+'">'+qty+'</td>';
							html += '</tr>';
							$('.item_details tbody').append(html);
							o++;
	    			}
					}else{
    				html = '<tr id="1">';
						html += '<td id="check_1"><input class="case" type="checkbox"/></td>';
						html += '<td id="placement_1"><input type="text" class="form-control autocomplete_pla" data-type="placement" autocomplete="off" name="placements[]" value="" required><input type="hidden" name="place[]" value="1"></td>';
						html += '<td id="description_1"><input type="text" class="form-control" name="description[]" value=""></td>';
						html += '<td id="add_1" class="add_btn"><a class="addmoreoption more btn btn-xs btn-info" id="more_1_1"><i class="fa fa-plus-circle"></i></a></td>';
						html += '<td id="gmt_color_1"><div id="gmtcolor_1_1"><input type="text" class="form-control" name="gmt_color_1[]" value="" required></div></td>';
						html += '<td id="item_color_1"><div id="itemcolor_1_1"><input type="text" class="form-control" name="item_color_1[]" value=""></div></td>';
						html += '<td id="measurement_1"><div id="measurement_1_1"><input type="text" class="form-control" name="measurement_1[]" value=""></div></td>';
						html += '<td id="size_1"><div id="size_1_1"><input type="text" class="form-control autocomplete_txt" data-type="size" autocomplete="off" name="size_1[]" value=""></div></td>';
						html += '<td id="type_1"><div id="type_1_1"><input type="text" class="form-control autocomplete_txt" data-type="type" autocomplete="off" name="type_1[]" value=""></div></td>';
						html += '<td id="qty_1"><div id="qty_1_1"><input type="text" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" name="qty_1[]" value=""></div></td>';
						html += '</tr>';
						$('.item_details tbody').html(html);
	    		}

	    	}

	    });
    });
	}

	var specialKeys = new Array();
	specialKeys.push(8,46); //Backspace
	function IsNumeric(e) {
	    var keyCode = e.which ? e.which : e.keyCode;
	    //console.log( keyCode );
	    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
	    return ret;
	}

</script>
@endpush
@endsection
