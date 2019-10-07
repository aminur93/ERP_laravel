@extends('merch.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-file-text home-icon"></i>
					<a href="#">Style BOM</a>
				</li>
				<li class="active">Style BOM Form</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content  table-responsive">
            <!-- Display Erro/Success Message -->
            @include('inc/message')

            {{ Form::open(['url'=>('merch/style_bom/'.request()->segment(3).'/store'), 'class'=>'row']) }}

	            <div class="widget-header text-right">
	            	<div class="col-sm-12">
		                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#newBomModal">
							Add Item
						</button>
		            </div>
	            </div>

				<div class="widget-body">
					<div class="row">
						<div class="col-sm-10">
							<table class="table custom-font-table" width="50%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<th>Production Type</th>
									<td>{{ (!empty($style->stl_type)?$style->stl_type:null) }}</td>
									<th>Style Reference 1</th>
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
									<th>Style Reference 2</th>
									<td>{{ (!empty($style->stl_product_name)?$style->stl_product_name:null) }}</td>
									<th>Sample Type</th>
									<td>{{ (!empty($samples->name)?$samples->name:null) }}</td>
									<th>Description</th>
									<td>{{ (!empty($style->stl_description)?$style->stl_description:null) }}</td>
								</tr>
							</table>
						</div>
						<div class="col-sm-2">
							<a href="{{ asset(!empty($style->stl_img_link)?$style->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}" target="_blank">
								<img class="thumbnail" height="100px" src="{{ asset(!empty($style->stl_img_link)?$style->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}" alt=""/>
							</a>
						</div>
					</div>
				</div>

				<input type="hidden" name="mr_style_stl_id" value="{{ (!empty($style->stl_id)?$style->stl_id:null) }}">
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
                        </tbody>
                    </table>
                </div><!-- /.col -->

	            <div class="widget-footer text-right">
	            	<div class="col-sm-12">
		                <button type="submit" class="btn btn-success btn-sm">Submit</button>

		                <input type="hidden" name="style_bom_id" value="{{$stylebom_id}}">
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
      	{!! (!empty($bomItem)?$bomItem:null) !!}
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
                <label class="col-sm-4 control-label no-padding-right"> Construction Name </label>
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

<script type="text/javascript">
$(document).ready(function(){
	/*
	* NEW BOM ITEM
	* -----------------------
	*/
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
				"class"       : "form-control input-sm no-select bom_article",
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

		// // load composition
		// $.ajax({
		// 	url: "{{ url('merch/style_bom/get_composition_by_supplier') }}",
		// 	data: {
		// 		"supplier_id" : that.val(),
		// 		"name"        : "mr_composition_id[]",
		// 		"selected"    : "",
		// 		"option"      : {
		// 			"class"           : "form-control input-sm no-select",
		// 			"placeholder"     : "Select"
		// 		}
		// 	},
		// 	success: function(data) {
		// 		that.parent().next().next().html(data);
		// 	},
		// 	error: function(xhr) {
		// 		console.log(xhr)
		// 	}
		// });

		// // load construction
		// $.ajax({
		// 	url: "{{ url('merch/style_bom/get_construction_by_supplier') }}",
		// 	data: {
		// 		"supplier_id" : that.val(),
		// 		"name"        : "mr_construction_id[]",
		// 		"selected"    : "",
		// 		"option"      : {
		// 			"class"           : "form-control input-sm no-select",
		// 			"placeholder"     : "Select"
		// 		}
		// 	},
		// 	success: function(data) {
		// 		that.parent().next().next().next().html(data);
		// 	},
		// 	error: function(xhr) {
		// 		console.log(xhr)
		// 	}
		// });
	});
	//Construction and consumption on change article
	$("body").on("change", ".bom_article", function() {
		var that= $(this);

		$.ajax({
			url: "{{ url('merch/style_bom/get_composition_by_article') }}",
			data: {
				"article_id" : $(this).val()
			},
			success: function(data) {
				that.parent().parent().next().text(data.comp); 
				that.parent().parent().next().next().text(data.cons); 
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
</script>
@endsection
