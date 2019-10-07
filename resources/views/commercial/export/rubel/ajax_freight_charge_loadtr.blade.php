<tr id="child_{{ $master_data['id'] }}">
	<td>
		<input type="hidden" name="cm_exp_data_entry_1_id[]" value="{{ $master_data['id'] }}">
		{{-- <input type="hidden" name="cm_file_id[]" value="{{ $master_data['cm_file']['id'] }}"> --}}
		<input type="text" class="f_id col-xs-12 form-control" name="f_id[]" placeholder="" value="{{ $master_row_key }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="cm_file_id col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_file']['file_no'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="invoice_no col-xs-12 form-control" name="invoice_no[]" placeholder="" value="{{ $master_data['inv_no'] }}" tabindex="-1" readonly="readonly" />
	</td>	
	<td>
		<input type="text" class="value col-xs-12 form-control" name="value[]" placeholder="" value="{{ $total_po }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="trans_doc_no col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_exp_update2']['transp_doc_date'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="qty col-xs-12 form-control" placeholder="" value="{{ $total_qty }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="carrier col-xs-12 form-control" placeholder="" value="{{ isset($update3_table['carrier_name'])?$update3_table['carrier_name']:'' }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="destination col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_port']['port_name'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="freight_tk col-xs-12 form-control" name="freight_tk[]" placeholder="" value="" data-validation="required"  />
	</td>
	<td>
		<input type="text" class="rate col-xs-12 form-control" name="rate[]" placeholder="" value="" data-validation="required"  />
	</td>
	<td>
		<input type="text" class="freight_usd col-xs-12 form-control" placeholder="" value="" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="freight_rcv_pcs col-xs-12 form-control" name="freight_rcv_pcs[]" placeholder="" value="" data-validation="required" />
	</td>
	<td>
		<input type="text" class="freight_rcv_usd col-xs-12 form-control" name="freight_rcv_usd[]" placeholder="" value="" data-validation="required"  />
	</td>
	<td>
		<button type="button" class="btn btn-danger btn-sm delete-child-row">Delete</button>
	</td>
</tr>

<script>	
	function sumEach(inputClasss, totalInputID, setZero=false) {
		var fn_val = 0;
		$('input.'+inputClasss).each(function(){
			if(parseInt($(this).val())) {
			    fn_val += parseInt($(this).val());
			} else {
				if(setZero) {
					fn_val = 0;
				}
			}
		});
		$('#'+totalInputID).val(fn_val);
	}
	// count freight_rcv_pcs total
	$('.freight_rcv_pcs').on('change', function() {
		sumEach('freight_rcv_pcs', 'freight_rcv_pcs_total');
	});
	// count freight_rcv_usd total
	$('.freight_rcv_usd').on('change', function() {
		sumEach('freight_rcv_usd', 'freight_rcv_usd_total');
	});

	$('.delete-child-row').on('click', function() {
		var tr_child_id = $(this).closest('tr').attr('id');		
		// remove child row
		$('#'+tr_child_id).remove();
		// set total freight tk
		sumEach('freight_tk', 'freight_tk_total', true);
		// set total freight usd
		sumEach('freight_usd', 'freight_usd_total', true);
		// subtraction freight_rcv_pcs from total
		sumEach('freight_rcv_pcs', 'freight_rcv_pcs_total', true);
		// subtraction freight_rcv_usd from total
		sumEach('freight_rcv_usd', 'freight_rcv_usd_total', true);
		// count incoive total
		var child_tr_count = $('#child_table tbody tr').length;
		// hide child table if tr 0
		if(child_tr_count-1 == 0) {
			$('#freightChargeForm').css({'display': 'none'});
		}
		// remove last total tr
		$('#invoice_total').val(child_tr_count-1);
		// count value total
		sumEach('value', 'value_total');
		// count qty total
		sumEach('qty', 'qty_total');
		// select master row
		var child_split_id = tr_child_id.split('_');
		var c_tr_id = 'master_'+child_split_id[1];
		var master_btn = $('#'+c_tr_id+' button');
		// master row button change
		$('#'+c_tr_id+' button').attr('id', 'masterbtn_'+child_split_id[1]);
		$('#'+c_tr_id+' button').addClass('btn-info');
		$('#'+c_tr_id+' button').removeClass('btn-success');
		$('#'+c_tr_id+' button').text('Select');
	});

	// change freight tk
	$('.freight_tk, .rate').on('change', function() {
		var tr_id = $(this).closest('tr').attr('id');
		var freight_tk = $('tr#'+tr_id+' input.freight_tk').val();
		var rate = $('tr#'+tr_id+' input.rate').val();
		if(tr_id && freight_tk) {
			var freight_usd = freight_tk*rate;
			$('tr#'+tr_id+' input.freight_usd').val(freight_usd);
			// set total freight tk
			sumEach('freight_tk', 'freight_tk_total');
			// set total freight usd
			sumEach('freight_usd', 'freight_usd_total');
		}
	});
</script>