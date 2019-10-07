@extends('merch.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                   <a href="/"><i class="ace-icon fa fa-home home-icon"></i>Human Resource</a>
                </li>
                <li>
                    <a href="#">Style</a>
                </li>
                <li>
                    <a href="#">Style List</a>
                </li>
                <li class="active">Style Profile</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Style<small> <i class="ace-icon fa fa-angle-double-right"></i> Style Profile</small></h1>
            </div>
						<div class="widget-header text-right">
                    <div class="col-sm-12">
											<button class="btn btn-xs btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                    </div>
            </div>
						<br>

			<div class="row">
				<div class="col-xs-12">
					<div id="user-profile-1" class="user-profile row">
						<div class="col-sm-3 center">
							<div>
								<span class="profile-picture">
									<a href="{{ asset(!empty($style->stl_img_link)?$style->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}" target="_blank">
										<img id="avatar" style="width: 180px; height: 200px;" class="img-responsive" alt="profile picture" src="{{ asset(!empty($style->stl_img_link)?$style->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}"/>
									</a>
								</span>
								<div class="space-4"></div>
								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">

									<div class="inline position-relative">
										<a href="#" class="user-title-label">
											<span class="white">{{ (!empty($style->stl_no)?$style->stl_no:null) }}</span>
										</a>
									</div>
								</div>
							</div>

							<div class="space-6"></div>
							<div class="profile-contact-info">
								<div class="profile-contact-links align-left">
									<p style="text-align: center;"><strong>Production Type:</strong> {{ (!empty($style->stl_type)?$style->stl_type:null) }}</p>
									<p style="text-align: center;"><strong>Operation:</strong> {{ (!empty($operations->name)?$operations->name:null) }}</p>
									<p style="text-align: center;"><strong>Buyer:</strong> {{ (!empty($style->b_name)?$style->b_name:null) }}</p>
									<p style="text-align: center;"><strong>SMV/PC:</strong> {{ (!empty($style->stl_smv)?$style->stl_smv:null) }}</p>
									<p style="text-align: center;"><strong>Speacial Machine:</strong> {{ (!empty($machines->name)?$machines->name:null) }}</p>
									<p style="text-align: center;"><strong>Product Name:</strong> {{ (!empty($style->stl_product_name)?$style->stl_product_name:null) }}</p>
									<p style="text-align: center;"><strong>Sample Type:</strong> {{ (!empty($samples->name)?$samples->name:null) }}</p>
									<p style="text-align: center;"><strong>Description:</strong> {{ (!empty($style->stl_description)?$style->stl_description:null) }}</p>
								</div>
							</div>
						</div>
						<div class="col-sm-9">
							<div id="accordion" class="accordion-style1 panel-group accordion-style2">
								<!-- Basic Information -->
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#basicInfo" aria-expanded="false">
												<i class="bigger-110 ace-icon glyphicon glyphicon-minus-sign" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												BOM Information
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse multi-collapse in" id="basicInfo" aria-expanded="true" style="">
										<div class="panel-body table-responsive">
											<div class="profile-user-info">

                        <div class="widget-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <table class="table custom-font-table" width="50%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                  <th>Production Type</th>
                                  <td>{{ (!empty($style->stl_type)?$style->stl_type:null) }}</td>
                                  <th>Style No</th>
                                  <td>{{ (!empty($style->stl_no)?$style->stl_no:null) }}</td>
                                  <th>Operation</th>
                                  <td>{{ (!empty($operations->name)?$operations->name:null) }}</td>
                                </tr>
                                <tr>
                                  <th>Buyer</th>
                                  <td>{{ (!empty($style->b_name)?$style->b_name:null) }}</td>
                                  <th>SMV/PC</th>
                                  <td>{{ (!empty($style->stl_smv)?$style->stl_smv:null) }}</td>
                                  <th>Speacial Machine</th>
                                  <td>{{ (!empty($machines->name)?$machines->name:null) }}</td>
                                </tr>
                                <tr>
                                  <th>Product Name</th>
                                  <td>{{ (!empty($style->stl_product_name)?$style->stl_product_name:null) }}</td>
                                  <th>Sample Type</th>
                                  <td>{{ (!empty($samples->name)?$samples->name:null) }}</td>
                                  <th>Description</th>
                                  <td>{{ (!empty($style->stl_description)?$style->stl_description:null) }}</td>
                                </tr>
                              </table>
                            </div>

                          </div>
                        </div>
                        <div class="widget-body">
                            <table id="bomItemTable" class="custom-font-table table table-bordered">
                        <thead>
                        <tr>
                        <th>Main Category</th>
                        <th>Item</th>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th width="80">Color</th>
                        <th>Size/Width</th>
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
													<?php if(count($styleCatMcats)==0){ ?>
														 <tr >
															 <td  colspan="15" ><h4 class="text-center">No BOM found for this style</h4></td>
														 </tr>
													<?php }else{ ?>
                          <?php

													foreach ($styleCatMcats as $styleCatMcat) {?>
                          <tr>
                          <td>{{ $styleCatMcat->mcat_name}}</td>
                          <th>{{ $styleCatMcat->item_name}}</th>
                          <th>{{ $styleCatMcat->item_code}}</th>
                          <th>{{ $styleCatMcat->item_description}}</th>
                          <th width="80">{{ $styleCatMcat->clr_name}}</th>
                          <th>{{ $styleCatMcat->size}}</th>
                          <th width="80">{{ $styleCatMcat->sup_name}}</th>
                          <th width="80">{{ $styleCatMcat->art_name}}</th>
                          <th>{{ $styleCatMcat->comp_name}}</th>
                          <th>{{ $styleCatMcat->construction_name}}</th>
                          <th width="80">{{ $styleCatMcat->uom}}</th>
                          <th>{{ $styleCatMcat->consumption}}</th>
                          <th>{{ $styleCatMcat->extra_percent}}</th>
                          <th><?= $styleCatMcat->extra_percent/100 ?></th>
                          <th><?= $styleCatMcat->extra_percent != 0 ?$styleCatMcat->precost_unit_price + $styleCatMcat->extra_percent/100 :0  ?></th>
                          </tr>
                        <?php } ?>

												<?php } ?>

                        </tbody>
                            </table>
                        </div><!-- /.col -->
											</div>
										</div>
									</div>
								</div>

								<!-- Advance Information -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#advanceInfo">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Costing Information
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse multi-collapse" id="advanceInfo">
										<div id="costing" class="panel-body table-responsive">
											<div class="profile-user-info">
												<div class="widget-body">
                    <table id="bomCostingTable" class="custom-font-table table table-bordered">
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
													</tr>
						          </thead>
											<tbody>
												<?php if(!empty($other_cost)){?>
													<?php if($other_cost->agent_fob != 0){?>
														  <?php if(count($styleCatMcatFabs)>0){?>
												<tr>

													<?php foreach ($styleCatMcatFabs as $styleCatMcat) {?>

													<td>{{ $styleCatMcat->mcat_name}}</td>
													<th>{{ $styleCatMcat->item_name}}</th>
													<th>{{ $styleCatMcat->item_code}}</th>
													<th>{{ $styleCatMcat->item_description}}</th>
													<th width="80">{{ $styleCatMcat->clr_name}}</th>
													<th>{{ $styleCatMcat->size}}</th>
													<th width="80">{{ $styleCatMcat->art_name}}</th>
													<th>{{ $styleCatMcat->comp_name}}</th>
													<th>{{ $styleCatMcat->construction_name}}</th>
													<th width="80">{{ $styleCatMcat->sup_name}}</th>
													<th>{{ $styleCatMcat->consumption}}</th>
													<th>{{ $styleCatMcat->extra_percent}}</th>
													<th width="80">{{ $styleCatMcat->uom}}</th>
													<th>{{ $styleCatMcat->bom_term}}</th>
													<th>{{ $styleCatMcat->precost_fob}}</th>
													<th>{{ $styleCatMcat->precost_lc}}</th>
													<th>{{ $styleCatMcat->precost_freight}}</th>
													<th>{{ $styleCatMcat->precost_unit_price}}</th>
													<th>{{ $styleCatMcat->precost_unit_price*$styleCatMcat->consumption}}</th>
												</tr>
												<?php } ?>
												<tr>
												</tr>

												<tr>
													<th colspan="18" class="text-center"> Total Fabric Price</th>
													<th>{{ isset($other_cost->total_fabric) ?$other_cost->total_fabric:'' }}</th>
												</tr>
											<?php } ?>
											<?php if(count($styleCatMcatSwings)>0){?>
								<tr>

									<?php foreach ($styleCatMcatSwings as $styleCatMcat) {?>

									<td>{{ $styleCatMcat->mcat_name}}</td>
									<th>{{ $styleCatMcat->item_name}}</th>
									<th>{{ $styleCatMcat->item_code}}</th>
									<th>{{ $styleCatMcat->item_description}}</th>
									<th width="80">{{ $styleCatMcat->clr_name}}</th>
									<th>{{ $styleCatMcat->size}}</th>
									<th width="80">{{ $styleCatMcat->art_name}}</th>
									<th>{{ $styleCatMcat->comp_name}}</th>
									<th>{{ $styleCatMcat->construction_name}}</th>
									<th width="80">{{ $styleCatMcat->sup_name}}</th>
									<th>{{ $styleCatMcat->consumption}}</th>
									<th>{{ $styleCatMcat->extra_percent}}</th>
									<th width="80">{{ $styleCatMcat->uom}}</th>
									<th>{{ $styleCatMcat->bom_term}}</th>
									<th>{{ $styleCatMcat->precost_fob}}</th>
									<th>{{ $styleCatMcat->precost_lc}}</th>
									<th>{{ $styleCatMcat->precost_freight}}</th>
									<th>{{ $styleCatMcat->precost_unit_price}}</th>
									<th>{{ $styleCatMcat->precost_unit_price*$styleCatMcat->consumption}}</th>
								</tr>
								<?php } ?>
								<tr>
								</tr>

								<tr>
									<th colspan="18" class="text-center"> Total Sweing Accessories Price</th>
									<th>{{ isset($other_cost->total_sewing) ?$other_cost->total_sewing:'' }}</th>
								</tr>
							<?php } ?>
							<?php if(count($styleCatMcatFinishing)>0){?>
				<tr>

					<?php foreach ($styleCatMcatFinishing as $styleCatMcat) {?>

					<td>{{ $styleCatMcat->mcat_name}}</td>
					<th>{{ $styleCatMcat->item_name}}</th>
					<th>{{ $styleCatMcat->item_code}}</th>
					<th>{{ $styleCatMcat->item_description}}</th>
					<th width="80">{{ $styleCatMcat->clr_name}}</th>
					<th>{{ $styleCatMcat->size}}</th>
					<th width="80">{{ $styleCatMcat->art_name}}</th>
					<th>{{ $styleCatMcat->comp_name}}</th>
					<th>{{ $styleCatMcat->construction_name}}</th>
					<th width="80">{{ $styleCatMcat->sup_name}}</th>
					<th>{{ $styleCatMcat->consumption}}</th>
					<th>{{ $styleCatMcat->extra_percent}}</th>
					<th width="80">{{ $styleCatMcat->uom}}</th>
					<th>{{ $styleCatMcat->bom_term}}</th>
					<th>{{ $styleCatMcat->precost_fob}}</th>
					<th>{{ $styleCatMcat->precost_lc}}</th>
					<th>{{ $styleCatMcat->precost_freight}}</th>
					<th>{{ $styleCatMcat->precost_unit_price}}</th>
					<th>{{ $styleCatMcat->precost_unit_price*$styleCatMcat->consumption}}</th>
				</tr>
				<?php } ?>
				<tr>
				</tr>

				<tr>
					<th colspan="18" class="text-center"> Total Finising Price</th>
					<th>{{ isset($other_cost->total_finishing) ?$other_cost->total_finishing:'' }}</th>
				</tr>
			<?php } ?>
												<?php if(count($special_operations)>0) {?>
													<?php foreach ($special_operations as $special_operation) {?>


												<tr>
													<td colspan='10' class='text-center'>{{$special_operation->opr_name}}</td>
													<td>1</td>
													<td>0</td>
													<td>
														{{$special_operation->uom}}
													</td>
													<td colspan='4'></td>
													<td>
														{{$special_operation->unit_price}}
													</td>
													<td>
														{{$special_operation->unit_price}}
													</td>
												</tr>
											<?php } }?>
												<tr>
													<td colspan="10" class="text-center">Testing Cost</td>
													<td class="consumption">1</td>
													<td>0</td>
													<td>Piece</td>
													<td colspan="4"></td>
													<td>
														{{ isset($other_cost->testing_cost)?$other_cost->testing_cost:''}}
													</td>
													<td>
														{{ isset($other_cost->testing_cost)?$other_cost->testing_cost :''}}
													</td>
												</tr>
												<tr>
													<td colspan="10" class="text-center">CM</td>
													<td class="consumption">1</td>
													<td>0</td>
													<td>Piece</td>
													<td colspan="4"></td>
													<td>
														{{ isset($other_cost->cm)?$other_cost->cm:''}}
													</td>
													<td>
														{{ isset($other_cost->cm)?$other_cost->cm:''}}
													</td>
												</tr>
												<tr>
													<td colspan="10" class="text-right">Commertial Cost</td>
													<td>
													</td>
													<td colspan="6" class="text-left"></td>
													<td>
														{{ isset($other_cost->commercial_cost)?$other_cost->commercial_cost:''}}
													</td>
													<td>
														{{ isset($other_cost->commercial_cost)?$other_cost->commercial_cost:''}}
													</td>
												</tr>
												<tr>
													<th colspan="18" class="text-center">Net FOB </th>
													<th>
														{{ isset($other_cost->net_fob)?$other_cost->net_fob:''}}
													</th>
												</tr>
												<tr>
													<td colspan="10" class="text-right">Buyer Commision</td>
													<td>
														{{ isset($other_cost->buyer_comission_percent)?$other_cost->buyer_comission_percent:''}}
													</td>
													<td colspan="6" class="text-left">%</td>
													<td>
														{{ ($other_cost->buyer_fob)-($other_cost->net_fob) }}
													</td>
													<td>
														{{ ($other_cost->buyer_fob)-($other_cost->net_fob) }}
													</td>
												</tr>
												<tr>
													<th colspan="18" class="text-center">Buyer FOB </th>
													<th>
														{{ isset($other_cost->buyer_fob)?$other_cost->buyer_fob:''}}
													</th>
												</tr>
												<tr>
													<td colspan="10" class="text-right">Agent Commision</td>
													<td>
														{{ isset($other_cost->agent_comission_percent)?$other_cost->agent_comission_percent:''}}
													</td>
													<td colspan="6" class="text-left">%</td>
													<td>
                            {{ ($other_cost->agent_fob)-($other_cost->buyer_fob) }}
                          </td>
													<td>
														{{ ($other_cost->agent_fob)-($other_cost->buyer_fob) }}
													</td>
												</tr>
												<tr>
													<th colspan="18" class="text-center">Agent FOB </th>
													<th>
														{{ isset($other_cost->agent_fob)?$other_cost->agent_fob:''}}
													</th>
												</tr>
												<tr>
													<th colspan="18" class="text-center">Total FOB </th>
													<th>
														{{ isset($other_cost->agent_fob)?$other_cost->agent_fob:''}}
													</th>
												</tr>

										<?php }else{?>
											<tr >
												<td  colspan="19" ><h4 class="text-center">No Costing found for this style</h4></td>
											</tr>
									<?php	} }else{ ?>
											<tr >
												<td  colspan="19" ><h4 class="text-center">No Costing found for this style</h4></td>
											</tr>
										<?php } ?>
										</tbody>
                    </table>
                </div>
								</div>
									</div>
								</div>
							</div>
								<!-- Education History  -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#EducationHistory">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Order Information
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse multi-collapse" id="EducationHistory">
										<div class="panel-body">
											<div class="widget-body">
													<table id="bomItemTable" class="custom-font-table table table-bordered">
											<thead>
											<tr>
											<th>Order Code</th>
											<th>Order Referance No</th>
											<th>Order Quantity</th>
											<th>Order Delivery Date</th>
											<th width="80">Order Status</th>
											<th>Buyer Name</th>
											<th width="80">Brand Name</th>
											<th width="80">Season Name</th>
											</tr>
											</thead>
											<tbody>
												<?php if(count($orders)==0){ ?>
													 <tr >
														 <td  colspan="8" ><h4 class="text-center">No Order found for this style</h4></td>
													 </tr>
												<?php }else{ ?>
												<?php foreach ($orders as $order) {

													?>
												<tr>
												<td><a href="{{url('merch/orders/order_profile_show',$order->order_id)}}" >{{ $order->order_code}}</a></td>
												<th>{{ $order->order_ref_no}}</th>
												<th>{{ $order->order_qty}}</th>
												<th>{{ $order->order_delivery_date}}</th>
												<th width="80">{{ $order->order_status}}</th>
												<th>{{ $order->b_name}}</th>
												<th width="80">{{ $order->br_name}}</th>
												<th width="80">{{ $order->se_name}}</th>
											</tr>
											<?php } ?>
                      <?php } ?>
											</tbody>
													</table>
											</div><!-- /.col -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	/*
	* NEW BOM ITEM
	* -----------------------
	*/
  function getItem(item_id, category_id)
	{
		$.ajax({
			url     : "{{ url('merch/style_bom/get_item_data') }}",
			data    : { item_id, category_id },
			success : function(data) {
				$("#bomItemTable tbody").append(data);
			},
			error   : function(xhr) {
				console.log(xhr)
			}
		});
	}
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
			url: "{{ url('merch/style_bom/get_article_by_supplier') }}",
			data: {
				"supplier_id" : that.val(),
				"name"        : "mr_article_id[]",
				"selected"    : "",
				"option"      : {
					"class"           : "form-control input-sm no-select",
					"placeholder"     : "Select"
				}
			},
			success: function(data) {
				that.parent().next().html(data);
			},
			error: function(xhr) {
				console.log(xhr)
			}
		});

		// load composition
		$.ajax({
			url: "{{ url('merch/style_bom/get_composition_by_supplier') }}",
			data: {
				"supplier_id" : that.val(),
				"name"        : "mr_composition_id[]",
				"selected"    : "",
				"option"      : {
					"class"           : "form-control input-sm no-select",
					"placeholder"     : "Select"
				}
			},
			success: function(data) {
				that.parent().next().next().html(data);
			},
			error: function(xhr) {
				console.log(xhr)
			}
		});

		// load construction
		$.ajax({
			url: "{{ url('merch/style_bom/get_construction_by_supplier') }}",
			data: {
				"supplier_id" : that.val(),
				"name"        : "mr_construction_id[]",
				"selected"    : "",
				"option"      : {
					"class"           : "form-control input-sm no-select",
					"placeholder"     : "Select",
					"data-validation" : "required"
				}
			},
			success: function(data) {
				that.parent().next().next().next().html(data);
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
					"name"         : "mr_article_id[]",
					"selected"     : "",
					"option"       : {
						"class" : "form-control input-sm no-select article",
						"placeholder"     : "Select"
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
						"placeholder"     : "Select"
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
						"placeholder"     : "Select"
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

});
function myFunction() {
	$('#accordion .collapse').addClass("in");
	//document.body.style.visibility = 'hidden';
	//var WinPrint = window.open('', '', 'width=900,height=650');
	$('#costing ').removeClass("table-responsive");
		window.print();
    location.reload();

 }
</script>
@endsection
