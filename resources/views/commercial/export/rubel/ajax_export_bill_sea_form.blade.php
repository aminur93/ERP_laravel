<?php
    $a_row_count = 2;
    $b_row_count = 3;
    $c_row_count = 7;
    $d_row_count = 3;
    $e_row_count = 9;
    // get section total
    $a_total = repeat($exportBillSeaData, 'a', $a_row_count);
    $b_total = repeat($exportBillSeaData, 'b', $b_row_count);
    $c_total = repeat($exportBillSeaData, 'c', $c_row_count);
    $d_total = repeat($exportBillSeaData, 'd', $d_row_count);
    $e_total = repeat($exportBillSeaData, 'e', $e_row_count);
    $total_tk = $a_total+$b_total+$c_total+$d_total;

    function repeat($exportBillSeaData, $niddle, $amount) {
        $summation = 0;
        for($x = 1; $x <= $amount; $x++) {
            $index = $niddle.$x;
            if(isset($exportBillSeaData->$index)) {
                $summation += $exportBillSeaData->$index;
            }
        }
        return $summation;
    }

    function sectionSum($exportBillSeaData, $section, $loop) {
        if($loop > 0) {
            $sectionSum = 0;
            for($i = 1; $i <= $loop; $i++) {
                $name = $section.$i;
                $sectionSum += $exportBillSeaData->$name;
            }
        }
        return $sectionSum;
    }
?>
<input type="hidden" id="exp_bill_sea_id" name="exp_bill_sea_id" value="{{ $exportBillSeaData->exp_bill_sea_id }}">
<input type="hidden" id="cm_exp_data_entry_1_id" name="cm_exp_data_entry_1_id" value="{{ $exportBillSeaData->d_entry1_id }}">
{{-- 3rd row --}}
<div class="row">
	<br>
    <div class="col-sm-12">
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="bill_entry_no" > S/B No & Date</label>
                <div class="col-sm-4">
                	<input type="text" id="bill_entry_no" name="bill_entry_no" placeholder="Bill Entry No" value="{{ $exportBillSeaData->ship_bill_no }}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            	<div class="col-sm-4">
                	<input type="text" id="bill_entry_date" name="bill_entry_date" placeholder="Bill Entry Date" value="{{ $exportBillSeaData->ship_bill_date }}" class="col-xs-12 form-control datepicker" readonly="readonly" />
            	</div>
            </div>
    	</div>
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="t_doc_no" > T.doc No & Date</label>
                <div class="col-sm-4">
                	<input type="text" id="t_doc_no" name="t_doc_no" placeholder="Doc No" value="{{ $exportBillSeaData->transp_doc_no }}" class="col-xs-12 form-control" readonly="readonly" />
            	</div>
            	<div class="col-sm-4">
                	<input type="text" id="to_doc_date" name="to_doc_date" placeholder="Doc Date" value="{{ $exportBillSeaData->transp_doc_date }}" class="col-xs-12 form-control datepicker" readonly="readonly" />
            	</div>
            </div>
    	</div>
    </div>
</div>
<br>
{{-- 4th row --}}
<div class="row">
    <div class="col-sm-12">
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="job_start_date" > Job Starting Date</label>
                <div class="col-sm-8">
                	<input type="text" id="job_start_date" name="job_start_date" placeholder="" value="{{ $exportBillSeaData->job_start_date }}" class="col-xs-12 form-control datepicker" data-validation="required" />
                </div>
            </div>
    	</div>
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="job_end_date" > Job Ending Date</label>
                <div class="col-sm-8">
                	<input type="text" id="job_end_date" name="job_end_date" placeholder="" value="{{ $exportBillSeaData->job_end_date }}" class="col-xs-12 form-control datepicker" data-validation="required"/>
            	</div>
            </div>
    	</div>
    </div>
</div>
<br>
{{-- 5th row --}}
<div class="row divborder">
    {{-- a section --}}
	<div class="col-sm-12" id="a_total_section">
		{{-- a total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="a_total" > A) Nothing & Documentation Exps. Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="text" id="a_total" name="a_total" placeholder="" value="{{ sectionSum($exportBillSeaData, 'a' ,$a_row_count) }}" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $a_section_text = [
            '1. S/B Typing Charge',
            '2. Noting + E.F.R + Court Fee'
        ];
        for($i = 0; $i < count($a_section_text); $i++) {
            $a_section = 'a'.($i+1);
    ?>
        <div class="col-sm-12" id="{{ $a_section }}_section" style="margin-bottom: 15px;">
            <div class="col-sm-4">
                <label class="control-label no-padding" for="{{ $a_section }}" >{{ $a_section_text[$i] }}</label>
            </div>
            <div class="col-sm-4">
                <label class="col-sm-2 control-label no-padding" id="{{ $a_section }}">TK.</label>
                <div class="col-sm-10">
                    <input type="number" id="{{ $a_section }}" name="{{ $a_section }}" placeholder="" value="{{ $exportBillSeaData->$a_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>

    {{-- start b section --}}
	<div class="col-sm-12" id="b_total_section">
		{{-- b total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="b_total" > B) Assessment Exps.Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="b_total" name="b_total" placeholder="" value="{{ sectionSum($exportBillSeaData, 'b' ,$b_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $b_section_text = [
            '1. Apprairor & P/A',
            '2. Clerk + Peon',
            '3. Value/Quantity Amendment if Required'
        ];
        for($i = 0; $i < count($b_section_text); $i++) {
            $b_section = 'b'.($i+1);
    ?>
        <div class="col-sm-12" id="{{ $b_section }}_section" style="margin-bottom: 15px;">
            <div class="col-sm-4">
                <label class="control-label no-padding" for="{{ $b_section }}" >{{ $b_section_text[$i] }}</label>
            </div>
            <div class="col-sm-4">
                <label class="col-sm-2 control-label no-padding" id="{{ $b_section }}">TK.</label>
                <div class="col-sm-10">
                    <input type="number" id="{{ $b_section }}" name="{{ $b_section }}" placeholder="" value="{{ $exportBillSeaData->$b_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
    {{-- start c section --}}
	<div class="col-sm-12" id="c_total_section">
		{{-- c total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="c_total" > C) Examination Exps.Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="c_total" name="c_total" placeholder="" value="{{ sectionSum($exportBillSeaData, 'c' ,$c_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $c_section_text = [
            '1. Appraiser & P/A',
            '2. Clerk + Peom (off dock/port)',
            '3. Shipment Allowed by Preventive Team',
            '4. Labor Tip',
            '5. Value/Quality Amendment/Short Shipment if Required',
            '6. Group Expenes for Shout out, Depot Charge, Docs Cancel',
            '7. After Shipment Amendment, Shut out, Depot Charge, Docs Cancel'
        ];
        for($i = 0; $i < count($c_section_text); $i++) {
            $c_section = 'c'.($i+1);
    ?>
        <div class="col-sm-12" id="{{ $c_section }}_section" style="margin-bottom: 15px;">
            <div class="col-sm-4">
                <label class="control-label no-padding" for="{{ $c_section }}" >{{ $c_section_text[$i] }}</label>
            </div>
            <div class="col-sm-4">
                <label class="col-sm-2 control-label no-padding" id="{{ $c_section }}">TK.</label>
                <div class="col-sm-10">
                    <input type="number" id="{{ $c_section }}" name="{{ $c_section }}" placeholder="" value="{{ $exportBillSeaData->$c_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
    {{-- start d section --}}
	<div class="col-sm-12" id="d_total_section">
		{{-- d total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="d_total" > D) Port Expenses Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="d_total" name="d_total" placeholder="" value="{{ sectionSum($exportBillSeaData, 'd' ,$d_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $d_section_text = [
            '1. Shipping Agent Misc. Exps',
            '2. Visa B/L typing',
            '3. Draft for FCR Typing',
        ];
        for($i = 0; $i < count($d_section_text); $i++) {
            $d_section = 'd'.($i+1);
    ?>
        <div class="col-sm-12" id="{{ $d_section }}_section" style="margin-bottom: 15px;">
            <div class="col-sm-4">
                <label class="control-label no-padding" for="{{ $d_section }}" >{{ $d_section_text[$i] }}</label>
            </div>
            <div class="col-sm-4">
                <label class="col-sm-2 control-label no-padding" id="{{ $d_section }}">TK.</label>
                <div class="col-sm-10">
                    <input type="number" id="{{ $d_section }}" name="{{ $d_section }}" placeholder="" value="{{ $exportBillSeaData->$d_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
    {{-- start e section --}}
	<div class="col-sm-12" id="e_total_section">
		{{-- e total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="e_total" > E) Local Truck & labor Expenses Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="e_total" name="e_total" placeholder="" value="{{ sectionSum($exportBillSeaData, 'e' ,$e_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $e_section_text = [
            '1. Local Truck',
            '2. DF Vat & Scanning Charge',
            '3. Labor Charge@1.20/cm',
            '4. Port Charge',
            '5. P/Copy',
            '6. T/R',
            '7. Landing Charges',
            '8. B/L release cost',
            '9. Re-loading/Shorting Bill at Depo'
        ];
        for($i = 0; $i < count($e_section_text); $i++) {
            $e_section = 'e'.($i+1);
    ?>
        <div class="col-sm-12" id="{{ $e_section }}_section" style="margin-bottom: 15px;">
            <div class="col-sm-4">
                <label class="control-label no-padding" for="{{ $e_section }}" >{{ $e_section_text[$i] }}</label>
            </div>
            <div class="col-sm-4">
                <label class="col-sm-2 control-label no-padding" id="{{ $e_section }}">TK.</label>
                <div class="col-sm-10">
                    <input type="number" id="{{ $e_section }}" name="{{ $e_section }}" placeholder="" value="{{ $exportBillSeaData->$e_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
</div>
{{-- 6th row --}}
<br>
<div class="row divborder">
	<div class="col-sm-8"></div>
	<div class="col-sm-4">
		<div class="col-sm-12">
        	<br>
    		<label class="col-sm-3 control-label no-padding" id="total_tk">Total TK.</label>
        	<div class="col-sm-9">
				<input type="number" id="total_tk" name="total_tk" placeholder="" value="{{ $total_tk }}" min="0" class="form-control" readonly="readonly" />
			</div>
        </div>
        <div class="col-sm-12">
        	<br>
    		<label class="col-sm-3 control-label no-padding" id="less_res_tk">Receiptable TK.</label>
        	<div class="col-sm-9">
				<input type="number" id="less_res_tk" name="less_res_tk" placeholder="" value="{{ $e_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
        </div>
        <div class="col-sm-12">
        	<br>
    		<label class="col-sm-3 control-label no-padding" id="total_misc_exp_tk">Total Misce. Exps TK.</label>
        	<div class="col-sm-9">
				<input type="number" id="total_misc_exp_tk" name="total_misc_exp_tk" placeholder="" value="{{ $total_tk-$e_total }}" min="0"class="form-control" readonly="" />
			</div>
        </div>
        <div class="col-sm-12">
        	<br>
    		<label class="col-sm-3"></label>
        	<div class="col-sm-9">
				<button type="submit" class="btn btn-info">Save</button>
			</div>
        </div>
	</div>
</div>
<script type="text/javascript">
    $('.datepicker').datetimepicker({
        showClose: true,
        showTodayButton: true,
        dayViewHeaderFormat: "YYYY MMMM",
        format: "YYYY-MM-DD",
        minDate:false
    });
</script>
<script type="text/javascript">
    // get input group total and set total output in input group section total
	function returnTotal(arrayData, id, outputId) {
		if(jQuery.inArray(id,arrayData) != -1) {
			$('#'+outputId).val(0);
			var total = 0;
			var input = 0;
			jQuery.each(arrayData, function(index, item) {
				input = $('input[name='+item+']').val();
				if(input != '') {
			    	total += parseInt(input);
				}
			});
			$('#'+outputId).val(total);
		}
	}

    // get input section
    function getInputValue(id, count, section, total_id) {
        if(count > 0) {
            var i;
            var section_input_total = [];
            for(i = 1; i <= count; i++) {
                section_input_total.push(section+i);
            }
            returnTotal(section_input_total, id, total_id);
            return parseInt($('input[name='+total_id+']').val());
        }
    }
    // input value change
	$('.g_input').on('change', function() {
		var id = $(this).attr('id');
        // a input section
        var a_section_total = getInputValue(id, {{ $a_row_count }}, 'a', 'a_total');
        // b input section
        var b_section_total = getInputValue(id, {{ $b_row_count }}, 'b', 'b_total');
        // c input section
        var c_section_total = getInputValue(id, {{ $c_row_count }}, 'c', 'c_total');
        // d input section
        var d_section_total = getInputValue(id, {{ $d_row_count }}, 'd', 'd_total');
        // e input section
        var e_section_total = getInputValue(id, {{ $e_row_count }}, 'e', 'e_total');

		var a_b_c_d_total = a_section_total+b_section_total+c_section_total+d_section_total;
		// add total tk
		$('input[name=total_tk]').val(a_b_c_d_total);
		// add less res tk
		$('input[name=less_res_tk]').val(e_section_total);
		// add total misce exps tk
		$('input[name=total_misc_exp_tk]').val(a_b_c_d_total-e_section_total);
	});
</script>
