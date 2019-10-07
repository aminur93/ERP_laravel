<?php
    $a_row_count = 6;
    $b_row_count = 4;
    $c_row_count = 4;
    $d_row_count = 4;
    $e_row_count = 2;
    // get section total
    $a_total = repeat($exportBillAirData, 'a', $a_row_count);
    $b_total = repeat($exportBillAirData, 'b', $b_row_count);
    $c_total = repeat($exportBillAirData, 'c', $c_row_count);
    $d_total = repeat($exportBillAirData, 'd', $d_row_count);
    $e_total = repeat($exportBillAirData, 'e', $e_row_count);
    $total_tk = $a_total+$b_total+$c_total+$d_total;

    function repeat($exportBillAirData, $niddle, $amount) {
        $summation = 0;
        for($x = 1; $x <= $amount; $x++) {
            $index = $niddle.$x;
            if(isset($exportBillAirData->$index)) {
                $summation += $exportBillAirData->$index;
            }
        }
        return $summation;
    }

    function sectionSum($exportBillAirData, $section, $loop) {
        if($loop > 0) {
            $sectionSum = 0;
            for($i = 1; $i <= $loop; $i++) {
                $name = $section.$i;
                $sectionSum += $exportBillAirData->$name;
            }
        }
        return $sectionSum;
    }
?>
<input type="hidden" id="exp_bill_air_id" name="exp_bill_air_id" value="{{ $exportBillAirData->exp_bill_air_id }}">
<input type="hidden" id="cm_exp_data_entry_1_id" name="cm_exp_data_entry_1_id" value="{{ $exportBillAirData->d_entry1_id }}">
{{-- 3rd row --}}
<div class="row">
	<br>
    <div class="col-sm-12">
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="bill_entry_no" > S/B No & Date</label>
                <div class="col-sm-4">
                	<input type="text" id="bill_entry_no" name="bill_entry_no" placeholder="Bill Entry No" value="{{ $exportBillAirData->ship_bill_no }}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            	<div class="col-sm-4">
                	<input type="text" id="bill_entry_date" name="bill_entry_date" placeholder="Bill Entry Date" value="{{ $exportBillAirData->ship_bill_date }}" class="col-xs-12 form-control datepicker" readonly="readonly" />
            	</div>
            </div>
    	</div>
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="t_doc_no" > T.doc No & Date</label>
                <div class="col-sm-4">
                	<input type="text" id="t_doc_no" name="t_doc_no" placeholder="Doc No" value="{{ $exportBillAirData->transp_doc_no }}" class="col-xs-12 form-control" readonly="readonly" />
            	</div>
            	<div class="col-sm-4">
                	<input type="text" id="to_doc_date" name="to_doc_date" placeholder="Doc Date" value="{{ $exportBillAirData->transp_doc_date }}" class="col-xs-12 form-control datepicker" readonly="readonly" />
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
                	<input type="text" id="job_start_date" name="job_start_date" placeholder="" value="{{ $exportBillAirData->job_start_date }}" class="col-xs-12 form-control datepicker" data-validation="required" />
                </div>
            </div>
    	</div>
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="job_end_date" > Job Ending Date</label>
                <div class="col-sm-8">
                	<input type="text" id="job_end_date" name="job_end_date" placeholder="" value="{{ $exportBillAirData->job_end_date }}" class="col-xs-12 form-control datepicker" data-validation="required"/>
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
            <label class="control-label no-padding" for="a_total" > A) Assessment Expenses</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="text" id="a_total" name="a_total" placeholder="" value="{{ sectionSum($exportBillAirData, 'a' ,$a_row_count) }}" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $a_section_text = [
            '1. Paper Entry',
            '2. Sup + Inspector',
            '3. Clerk + Peon',
            '4. Vat Print',
            '5. RED & Green Purpose Exps',
            '6. Letter Disperse',
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
                    <input type="number" id="{{ $a_section }}" name="{{ $a_section }}" placeholder="" value="{{ $exportBillAirData->$a_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>

    {{-- start b section --}}
	<div class="col-sm-12" id="b_total_section">
		{{-- b total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="b_total" > B) Examination Expenses</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="b_total" name="b_total" placeholder="" value="{{ sectionSum($exportBillAirData, 'b' ,$b_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $b_section_text = [
            '1. Sup + Inspector',
            '2. Clerk + Peon',
            '3. DC & AC',
            '4. Clerk + Peon'
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
                    <input type="number" id="{{ $b_section }}" name="{{ $b_section }}" placeholder="" value="{{ $exportBillAirData->$b_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
    {{-- start c section --}}
	<div class="col-sm-12" id="c_total_section">
		{{-- c total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="c_total" > C) Export Final Report Expenses</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="c_total" name="c_total" placeholder="" value="{{ sectionSum($exportBillAirData, 'c' ,$c_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $c_section_text = [
            '1. Sup + Inspector',
            '2. Clerk + Peom',
            '3. DC & AC',
            '4. Labor Tip'
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
                    <input type="number" id="{{ $c_section }}" name="{{ $c_section }}" placeholder="" value="{{ $exportBillAirData->$c_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
    {{-- start d section --}}
	<div class="col-sm-12" id="d_total_section">
		{{-- d total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="d_total" > D) EXP Release Expenses</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="d_total" name="d_total" placeholder="" value="{{ sectionSum($exportBillAirData, 'd' ,$d_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $d_section_text = [
            '1. Sup + Inspector',
            '2. Clerk + Peom',
            '3. DC & AC',
            '4. Labor Tip'
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
                    <input type="number" id="{{ $d_section }}" name="{{ $d_section }}" placeholder="" value="{{ $exportBillAirData->$d_section }}" min="0" class="form-control g_input"/>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    <?php } ?>
    {{-- start e section --}}
	<div class="col-sm-12" id="e_total_section">
		{{-- e total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="e_total" > E) Receiptable Expenses</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="e_total" name="e_total" placeholder="" value="{{ sectionSum($exportBillAirData, 'e' ,$e_row_count) }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
    <?php
        $e_section_text = [
            '1. C&F Association Fee (ORG)',
            '2. Vat & Tax Payment (ORG)'
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
                    <input type="number" id="{{ $e_section }}" name="{{ $e_section }}" placeholder="" value="{{ $exportBillAirData->$e_section }}" min="0" class="form-control g_input"/>
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
