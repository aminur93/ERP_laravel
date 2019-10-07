<tr id="child_{{ $master_data['id'] }}">
	<td>
		<input type="hidden" name="cm_exp_data_entry_1_id[]" value="{{ $master_data['id'] }}">
		{{-- <input type="hidden" name="cm_file_id[]" value="{{ $master_data['cm_file']['id'] }}"> --}}
		<input type="text" class="incentive_ref col-xs-12 form-control" placeholder="" value="{{ $master_incentive_ref }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="cm_file_id col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_file']['file_no'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="invoice_no col-xs-12 form-control" name="invoice_no[]" placeholder="" value="{{ $master_data['inv_no'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="buyer col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_exp_lc_entry']['cm_sales_contract']['mr_buyer']['b_name'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="rim_value col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_exp_reimburse']['reimburse_amount'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="bank col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_exp_lc_entry']['cm_sales_contract']['cm_bank']['bank_name'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<input type="text" class="destination col-xs-12 form-control" placeholder="" value="{{ $master_data['cm_port']['port_name'] }}" tabindex="-1" readonly="readonly" />
	</td>
	<td>
		<button type="button" class="btn btn-danger btn-sm delete-child-row">Delete</button>
	</td>
</tr>

<script>	
	$('.delete-child-row').on('click', function() {
		var tr_child_id = $(this).closest('tr').attr('id');		
		// remove child row
		$('#'+tr_child_id).remove();

		sumEach('rim_value', 'total_multi_rim');
		var total_multi_rim 	= $('#total_multi_rim').val();
		var incentive_percent 	= $('#incentive_percent').val();
		// caculate incentive value (rim*incentive per)
		$('#incentive_value').val(total_multi_rim*incentive_percent);
		// count incoive total
		var child_tr_count = $('#child_table tbody tr').length;
		// hide child table if tr 0
		if(child_tr_count-1 == 0) {
			$('#cashIncentiveForm').css({'display': 'none'});
		}
		// remove last total tr
		$('#incentive_total').val(child_tr_count-1);
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
</script>