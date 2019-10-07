<?php 
	function calculateTotalPo($cm_exp_entry1_po) {
		if(!empty($cm_exp_entry1_po)) {
			$total_po = 0;
			foreach($cm_exp_entry1_po as $po_key=>$eachPo) {
				$total_po += $eachPo->inv_qty*$eachPo->unit_price;
			}
		} else {
			$total_po = 0;
		}
		return $total_po;
	}
?>
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th>File No</th>
    		<th>Invoice No</th>
    		<th>Invoice Date</th>
    		<th>Buyer</th>
    		<th>Bank</th>
    		<th>Value</th>
    		<th>Transport Doc Date</th>
    		<th>Realise Amount</th>
    		<th>Realise Date</th>
    		<th>Ex-Fty</th>
    		<th>Destination</th>
    		<th>ELC No.</th>
    		<th>Freight Status</th>
    		<th>Action</th>
    	</tr>
    </thead>
    <tbody>
    	@if(isset($masterDataList[0]))    		
	    	@foreach($masterDataList as $k=>$masterData)
	    	<tr id="master_{{ $masterData->id }}">
	    		<td>	    			
	    			<input type="text" id="file_no" placeholder="" value="{{ $masterData->cm_file->file_no }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="inv_no" placeholder="" value="{{ $masterData->inv_no }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="inv_date" placeholder="" value="{{ $masterData->inv_date }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="b_id" placeholder="" value="{{ $masterData->cm_exp_lc_entry['cm_sales_contract']['mr_buyer']['b_name'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="bank" placeholder="" value="{{ $masterData->cm_exp_lc_entry['cm_sales_contract']['cm_bank']['bank_name'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="value" placeholder="" value="{{ calculateTotalPo($masterData->cm_exp_entry1_po) }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="trans_doc_date" placeholder="" value="{{ $masterData['cm_exp_update2']['transp_doc_date'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="rea_amount" placeholder="" value="{{ $masterData['cm_exp_reimburse']['reimburse_amount'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="rea_date" placeholder="" value="{{ $masterData['cm_exp_reimburse']['date'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="ex_fty" placeholder="" value="{{ $masterData['cm_exp_update2']['ex_fty_date'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="destination" placeholder="{{ $masterData['cm_port']['port_name'] }}" value="" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<input type="text" id="elc_no" placeholder="" value="{{ $masterData->cm_exp_lc_entry['cm_sales_contract']['lc_contract_no'] }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			@if(isset($masterData->cm_freight_charge_child->id))
						<?php $foundStatus = TRUE; ?>
	    			@else
						<?php $foundStatus = FALSE; ?>
	    			@endif
	    			<input type="text" id="freight_status" placeholder="" value="{{ $foundStatus?'Done':'Not Done' }}" class="col-xs-12 form-control" readonly="readonly" />
	    		</td>
	    		<td>
	    			<button type="button" 
		    			id="masterbtn_{{ $masterData->id }}" 
		    			data-rowkey="{{ $k+1 }}" 
		    			data-master="{{ $masterData }}" 
		    			data-totalpo="{{ calculateTotalPo($masterData->cm_exp_entry1_po) }}" 
		    			class="btn btn-sm {{ $foundStatus?'btn-success':'btn-info' }} 
		    			{{ $foundStatus?'':'f-charge-select' }}">
		    			{{ $foundStatus?'Pass':'Select' }}
	    			</button>
	    		</td>
	    	</tr>
	    	@endforeach
    	@else
    		<tr class="text-center">
    			<td colspan="14">No Data Found</td>
    		</tr>
    	@endif
    </tbody>
</table>
{{-- hidden input filed (for same file no) --}}
<input type="hidden" name="cm_file_id" value="{{ isset($masterDataList[0])?$masterDataList[0]->cm_file->id:'' }}">
<div id="freight_master">
	<h4 class="section-head-h4">Freight Master</h4>
	<div class="col-sm-3">
		<label class="col-sm-4 control-label no-padding" for="freight_master_id" > ID<span style="color: red">&#42;</span> </label>
        <div class="col-sm-8">
            <input type="text" id="freight_master_id" name="freight_master_id" placeholder="" value="{{ rand(1,1000) }}" class="col-xs-12 form-control" readonly="readonly" />
        </div>
	</div>
	<div class="col-sm-3">
		<label class="col-sm-4 control-label no-padding" for="due_date" > Due Date<span style="color: red">&#42;</span> </label>
        <div class="col-sm-8">
            <input type="text" id="due_date" name="due_date" placeholder="" value="" class="col-xs-12 form-control datepicker" data-validation="required" />
        </div>
	</div>
	<div class="col-sm-3">
		<label class="col-sm-4 control-label no-padding" for="type" > Type<span style="color: red">&#42;</span> </label>
        <div class="col-sm-8">
            {{ Form::select("type", ['Freight' => 'Freight', 'Forwarding' => 'Forwarding'], null, ['class'=>'col-xs-12 form-control', 'id'=>'type', 'placeholder'=>'Select Type', 'data-validation'=>'required' ]) }}
        </div>
	</div>
	<div class="col-sm-6"></div>
</div>
<script>
	$('.datepicker').datetimepicker({
        showClose: true,
        showTodayButton: true,
        dayViewHeaderFormat: "YYYY MMMM", 
        format: "YYYY-MM-DD",
        minDate:false
    });
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
	// select freight charge
	$('.f-charge-select').on('click', function() {
		var tr_id = $(this).attr('id');
		var master_data = $(this).data('master');
		var master_row_key = $(this).data('rowkey');
		var master_totalpo = $(this).data('totalpo');
		if(tr_id) {
			$(this).text('Lodding...');
			$.ajax({
				url: '{{ url('commercial/export/ajax_freight_charge_loadtr') }}',
				type: 'POST',
				datatype: 'json',
				data: {'masterData': master_data, 'masterRowKey': master_row_key, 'masterTotalpo': master_totalpo },
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					$('#'+tr_id).removeClass('btn-info');
					$('#'+tr_id).addClass('btn-success');
					$('#'+tr_id).text('Selected');
					$('#'+tr_id).removeAttr('id');
					$('#tableLastRow').before(res);
					// count value total
					sumEach('value', 'value_total');
					// count qty total
					sumEach('qty', 'qty_total');
					// count incoive total
					var child_tr_count = $('#child_table tbody tr').length;
					// show child table if tr 1
					if(child_tr_count-1 == 1) {
						$('#freightChargeForm').css({'display': 'block'});
					}
					// remove last total tr
					$('#invoice_total').val(child_tr_count-1);
				}
			});
		}				
	});
</script>