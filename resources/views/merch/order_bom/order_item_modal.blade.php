@push('css')
	<style>
		.form-control {height: 27px;}
		hr{margin-top: 7px; margin-bottom: 7px; display: block;}
		.add_btn hr{margin-top: 5px; margin-bottom: 5px; display: block;}
		.error-input{border-color: #dc3545 !important;}
	</style>
@endpush
<!-- item details modal section -->
<div class="item_details_section">
	<div class="overlay-modal overlay-modal-details" style="margin-left: 0px; display: none;">
	  <div class="item_details_dialog show_item_details_modal" style="min-height: 115px;">
	    <div class="fade-box-details fade-box">
	      <div class="inner_gray clearfix">
	        <div class="inner_gray_text text-center" id="order_item_name">
	        	
	        </div>
	        <div class="inner_gray_close_button">
	          <a class="cancel_details item_modal_close" role="button" rel='tooltip' data-tooltip-location='left' data-tooltip="Close Modal">Close</a>
	        </div>
	      </div>
	      <div class="loader-cycle inner_body" id="loader-result" style="display: none"><img src="{{asset('assets/xinnah/img/loader-cycle.gif')}}"></div>
	      <div class="inner_body" id="modal-details-content" style="display: none">
	      	{!! Form::open(array('route' => 'order-bom-details.store', 'class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!}
	      	{{ csrf_field() }}
	        <div class="inner_body_content">
	        	<input type="hidden" name="cat_id" value="" id="order_cat_id">
	        	<input type="hidden" name="item_id" value="" id="order_item_id">
	        	<input type="hidden" name="order_id" value="" id="order_id">
	        	{{-- <input type="hidden" name="order_item_qty" value="" id="order_item_qty"> --}}
	        	<h4 id="order_item_name" class="text-center"></h4>
	          <div class="col-sm-12 no-padding">
	          	<div class="item_details_table">
		          	<table class="table table-bordered table-responsive item_details">
								  <thead class="thead-dark">
								    <tr>
								    	<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
								      <th>Placements</th>
								      <th>Item Description</th>
								      <th>Action</th>
								      <th>GMT Color</th>
								      <th>Item Color</th>
								      <th>Measurements</th>
								      <th>Size</th>
								      <th>Type</th>
								      <th>Qty</th>
								    </tr>
								  </thead>
								  
								  <tbody>
								    
								  </tbody>
								  
								</table>
		          </div>
	          </div>
	          <div id="remove_placement"></div>
	          <div id="remove_gmt"></div>
	          <div class='col-sm-12 no-padding'>
              <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                <button rel='tooltip' data-tooltip-location='top' data-tooltip="Delete Checked Placement" class="btn btn-danger btn-sm delete" type="button"><i class="fa fa-trash"></i> Delete</button>
                <button rel='tooltip' data-tooltip-location='top' data-tooltip="Add New Placement" class="btn btn-success btn-sm addmore" type="button"><i class="fa fa-plus-circle"></i> Add More</button>
              </div>
              <div class='col-xs-12 col-sm-offset-4 col-sm-4'>
                <div class="form-inline text-right">
                    <div class="form-group">
                        <label>Order Quantity: &nbsp;</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-shopping-cart"></i></div>
                            <input type="number" class="form-control" id="order_item_qty" placeholder="Order Quantity" name="subTotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>
                        </div>
                    </div>
                    
                </div>
            	</div>

            </div>
	        </div>
	        <div class="inner_buttons">
	          <button class="okay_modal_button details_button_ok" type="submit" tabindex="0">
	            Confirm
	          </button>
	          <a class="cancel_modal_button cancel_details" role="button"> Cancel </a>
	        </div>
	        {!! Form::close() !!}
	      </div>
	    </div>
	  </div>
	</div>
</div>

@push('js')
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

<script>
	$(".cancel_details").click(function() {
    $(".overlay-modal-details, .show_item_details_modal").fadeOut("slow", function() {
      /*Remove inline styles*/
      $(".overlay-modal, .item_details_dialog").removeAttr("style");
      $('body').css('overflow', 'unset');
    });
  });
</script>

<script>
	var base_url = $('input[name="url"]').val();
	//row insert
	$(".addmore").on('click',function(){
		var lastTr = $('.item_details tbody tr:last').attr('id');
		if(lastTr == undefined){
			lastTr = 0;
		}
		var j = parseInt(lastTr) + 1;
	  //console.log(j);
		html = '<tr id="'+j+'">';
		html += '<td id="check_'+j+'"><input class="case" type="checkbox"/></td>';
		html += '<td id="placement_'+j+'"><input type="text" class="form-control autocomplete_pla" data-type="placement" autocomplete="off" name="placements[]" value=""><input type="hidden" name="place[]" value="'+j+'" required></td>';
		html += '<td id="description_'+j+'"><input type="text" class="form-control" name="description[]" value=""></td>';
		html += '<td id="add_'+j+'" class="add_btn"><a rel="tooltip" data-tooltip-location="right" data-tooltip="Add More Color Size Breakdown" class="addmoreoption more btn btn-xs btn-info" id="more_'+j+'_1"><i class="fa fa-plus-circle"></i></a></td>';
		html += '<td id="gmt_color_'+j+'"><div id="gmtcolor_'+j+'_1"><input type="text" class="form-control" name="gmt_color_'+j+'[]" value="" required></div></td>';
		html += '<td id="item_color_'+j+'"><div id="itemcolor_'+j+'_1"><input type="text" class="form-control" name="item_color_'+j+'[]" value=""></div></td>';
		html += '<td id="measurement_'+j+'"><div id="measurement_'+j+'_1"><input type="text" class="form-control" name="measurement_'+j+'[]" value=""></div></td>';
		html += '<td id="size_'+j+'"><div id="size_'+j+'_1"><input type="text" class="form-control autocomplete_txt" data-type="size" name="size_'+j+'[]" value="" autocomplete="off"></div></td>';
		html += '<td id="type_'+j+'"><div id="type_'+j+'_1"><input type="text" class="form-control autocomplete_txt" data-type="type" autocomplete="off" name="type_'+j+'[]" value=""></div></td>';
		html += '<td id="qty_'+j+'"><div id="qty_'+j+'_1"><input type="text" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" name="qty_'+j+'[]" value=""></div></td>';
		html += '</tr>';
		$('.item_details tbody').append(html);
		j++;
	});
	//sub item insert
	$(document).on('click', ".addmoreoption", function() {
		var nameId = $(this).attr('id');
		var splitNameId = nameId.split("_");
		var idP = splitNameId[1];
		var checkIndex = $('#add_'+idP+' a:last').attr('id');
		var indexSplit = checkIndex.split("_");
		
		var index = parseInt(indexSplit[2]) + 1;
		$("#add_"+idP).append('<hr><a rel="tooltip" data-tooltip-location="right" data-tooltip="Remove Color Size Row" class="btn btn-xs btn-danger more remove_sub" id="remove_'+idP+'_'+index+'"><i class="fa fa-minus-circle"></i></a>');
		$("#gmt_color_"+idP).append('<div id="gmtcolor_'+idP+'_'+index+'"><hr><input type="text" class="form-control" name="gmt_color_'+idP+'[]" value="" required></div>');
		$("#item_color_"+idP).append('<div id="itemcolor_'+idP+'_'+index+'"><hr><input type="text" class="form-control" name="item_color_'+idP+'[]" value=""></div>');
		$("#measurement_"+idP).append('<div id="measurement_'+idP+'_'+index+'"><hr><input type="text" class="form-control" name="measurement_'+idP+'[]" value=""></div>');
		$("#size_"+idP).append('<div id="size_'+idP+'_'+index+'"><hr><input type="text" class="form-control autocomplete_txt" data-type="size" name="size_'+idP+'[]" value="" autocomplete="off" ></div>');
		$("#type_"+idP).append('<div id="type_'+idP+'_'+index+'"><hr><input type="text" class="form-control autocomplete_txt" data-type="type" autocomplete="off" name="type_'+idP+'[]" value=""></div>');
		$("#qty_"+idP).append('<div id="qty_'+idP+'_'+index+'"><hr><input type="text" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" name="qty_'+idP+'[]" value=""></div>');
		index++
	});

	$(document).on('click', ".remove_sub", function() {
		var nameId = $(this).attr('id');
		var value = $(this).attr('data-type');
		if(value != undefined){
			var hiddenValue = '<input type="hidden" name="delete_gmt_color[]" value="'+value+'">';
			$("#remove_gmt").append(hiddenValue);
		}
		var splitNameId = nameId.split("_");
		var nameF = splitNameId[0];
		var idP = splitNameId[1];
		var idC = splitNameId[2];
		$("#remove_"+idP+"_"+idC).prev().remove();
		$("#remove_"+idP+"_"+idC).remove();
		$("#gmtcolor_"+idP+"_"+idC).remove();
		$("#itemcolor_"+idP+"_"+idC).remove();
		$("#measurement_"+idP+"_"+idC).remove();
		$("#size_"+idP+"_"+idC).remove();
		$("#type_"+idP+"_"+idC).remove();
		$("#qty_"+idP+"_"+idC).remove();

	});
	$(document).on('change','#check_all',function(){
		$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
	});
	//deletes the selected table rows
	$(".delete").on('click', function() {
		var clickTr = $('.case:checkbox:checked').parents("tr").attr('class');
		if(clickTr != undefined){
			var hiddenData = '<input type="hidden" name="delete_placement[]" value="'+clickTr+'">';
			$("#remove_placement").append(hiddenData);
		}
		$('.case:checkbox:checked').parents("tr").remove();
		$('#check_all').prop("checked", false); 
	});
</script>

<script>
//autocomplete placement script
$(document).on('focus','.autocomplete_pla',function(){
	var type = $(this).data('type');
	if(type == 'placement')autoTypeNo=0;

	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : base_url+'/merch/order_bom/item-wise-placement',
				method: 'GET',
				data: {
				  name_startsWith: request.term,
				  type: type
				},
				success: function( data ) {
					response( $.map( data, function( item ) {
						var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");
			$(this).val(names[0]);
		}		      	
	});
	
});

//autocomplete size script
$(document).on('focus','.autocomplete_txt',function(){
	var type = $(this).data('type');
	var cat_id = $("#order_cat_id").val();
	if(cat_id != 1){
		var style_id = $("#mr_style_stl_id").val();
		if(type =='size' )autoTypeNo=0;
		if(type =='type' )autoTypeNo=0;
		$(this).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : base_url+'/merch/order_bom/item-wise-size-group',
					method: 'GET',
					data: {
					  name_startsWith: request.term,
					  type: type,
					  style_id: style_id
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
						 	var code = item.split("|");
							return {
								label: code[autoTypeNo],
								value: code[autoTypeNo],
								data : item
							}
						}));
					}
				});
			},
			autoFocus: true,	      	
			minLength: 0,
			select: function( event, ui ) {
				var names = ui.item.data.split("|");
				$(this).val(names[0]);
			}		      	
		});
	}
});

// qty check
$(document).on('blur','.quantity',function(){
	var quantity = 0;
	$('.quantity').each(function(){
		if($(this).val() != '' )quantity += parseFloat( $(this).val() );
	});
	totalQty = $("#order_item_qty").val();
	if(quantity > totalQty){
		$('.details_button_ok').hide();
		$("#order_item_qty").addClass('error-input');
		$.notify({
			icon: 'fa fa-exclamation-triangle',
			message: "Oder Quantity "+totalQty+" is Over",
		},{
			type: 'danger'
		});
	}else{
		$("#order_item_qty").removeClass('error-input');
		$('.details_button_ok').show();
	}
	
});


</script>
@endpush