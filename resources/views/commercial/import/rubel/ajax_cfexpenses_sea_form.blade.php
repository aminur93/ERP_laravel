<?php
	$cfe = $cfExpensesSeaData;
    $a_total = repeat($cfExpensesSeaData, 'a', 5);
    $b_total = repeat($cfExpensesSeaData, 'b', 7);
    $c_total = repeat($cfExpensesSeaData, 'c', 10);;
    $d_total = repeat($cfExpensesSeaData, 'd', 9);
    $e_total = repeat($cfExpensesSeaData, 'e', 5);;
    $f_total = repeat($cfExpensesSeaData, 'f', 8);
    $total_tk = $a_total+$b_total+$c_total+$d_total+$e_total+$f_total;

    function repeat($cfExpensesSeaData, $niddle, $amount) {
        $summation = 0;
        for($x = 1; $x <= $amount; $x++) {
            $index = $niddle.$x;
            $summation += $cfExpensesSeaData->$index;
        }
        return $summation;
    }
?>
<input type="hidden" id="imp_sea_id" name="imp_sea_id" value="{{ isset($cfe->imp_sea_id)?$cfe->imp_sea_id:'' }}">
<input type="hidden" id="cm_imp_data_entry_id" name="cm_imp_data_entry_id" value="{{ isset($cfe->d_entry_id)?$cfe->d_entry_id:'' }}">
{{-- 2nd row --}}
<div class="row">
	<br>
    <div class="col-sm-12">
    	<div class="col-sm-3">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="exp_for" > C&F Expenses for</label>
                <div class="col-sm-8">
                    <input type="text" id="exp_for" name="exp_for" placeholder="" value="{{ isset($cfe->hr_unit)?$cfe->hr_unit:'' }}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    	<div class="col-sm-3">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="package" > Package</label>
                <div class="col-sm-8">
                    <input type="text" id="package" name="package" placeholder="" value="{{ isset($cfe->package)?$cfe->package:''}}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    	<div class="col-sm-3">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="weight" > Weight</label>
                <div class="col-sm-8">
                    <input type="text" id="weight" name="weight" placeholder="" value="{{ isset($cfe->weight)?$cfe->weight:'' }}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    	<div class="col-sm-3">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="cbm" > CBM</label>
                <div class="col-sm-8">
                    <input type="text" id="cbm" name="cbm" placeholder="" value="{{ isset($cfe->cubic_measurement)?$cfe->cubic_measurement:'' }}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    </div>
    <div class="col-sm-12">
    	<div class="col-sm-3">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="item" > Item</label>
                <div class="col-sm-8">
                    <input type="text" id="item" name="item" placeholder="" value="" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    	<div class="col-sm-3">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="supplier" > Supplier</label>
                <div class="col-sm-8">
                    <input type="text" id="supplier" name="supplier" placeholder="" value="{{ isset($cfe->sup_name)?$cfe->sup_name:'' }}" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    	<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="doc_value" > Docs Value US($)</label>
                <div class="col-sm-8">
                    <input type="text" id="doc_value" name="doc_value" placeholder="" value="" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            </div>
    	</div>
    </div>
</div>
{{-- 3rd row --}}
<div class="row">
	<br>
    <div class="col-sm-12">
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="bill_entry_no" > Bill of Entry No & Date</label>
                <div class="col-sm-4">
                	<input type="text" id="bill_entry_no" name="bill_entry_no" placeholder="Bill Entry No" value="" class="col-xs-12 form-control" readonly="readonly" />
                </div>
            	<div class="col-sm-4">
                	<input type="text" id="bill_entry_date" name="bill_entry_date" placeholder="Bill Entry Date" value="" class="col-xs-12 form-control datepicker" readonly="readonly" />
            	</div>
            </div>
    	</div>
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="t_doc_no" > T.doc No & Date</label>
                <div class="col-sm-4">
                	<input type="text" id="t_doc_no" name="t_doc_no" placeholder="Doc No" value="{{ isset($cfe->transp_doc_no1)?$cfe->transp_doc_no1:'' }}" class="col-xs-12 form-control" readonly="readonly" />
            	</div>
            	<div class="col-sm-4">
                	<input type="text" id="to_doc_date" name="to_doc_date" placeholder="Doc Date" value="{{ isset($cfe->transp_doc_date)?$cfe->transp_doc_date:''}}" class="col-xs-12 form-control datepicker" readonly="readonly" />
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
                	<input type="text" id="job_start_date" name="job_start_date" placeholder="" value="{{ isset($cfe->job_start_date)?$cfe->job_start_date:''}}" class="col-xs-12 form-control datepicker" data-validation="required" />
                </div>
            </div>
    	</div>
		<div class="col-sm-6">
			<div class="form-group">
                <label class="col-sm-4 control-label no-padding" for="job_end_date" > Job Ending Date</label>
                <div class="col-sm-8">
                	<input type="text" id="job_end_date" name="job_end_date" placeholder="" value="{{ isset($cfe->job_end_date)?$cfe->job_end_date:'' }}" class="col-xs-12 form-control datepicker" data-validation="required"/>
            	</div>
            </div>
    	</div>
    </div>
</div>
<br>
{{-- 5th row --}}
<div class="row divborder">
	<div class="col-sm-12" id="a_total_section">
		{{-- a total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="a_total" > A) Nothing & Documentation Exps. Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="text" id="a_total" name="a_total" placeholder="" value="{{ $a_total }}" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
	<div class="col-sm-12" id="a1_section">
    	{{-- a1 section --}}
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="a1" > 1. Bill of Entry Typing Charge</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="a1">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="a1" name="a1" placeholder="" value="{{ isset($cfe->a1)?$cfe->a1:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="a2_section">
		{{-- a2 section --}}
		<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="a2" > 2. GM Amendment when required</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="a2">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="a2" name="a2" placeholder="" value="{{ isset($cfe->a2)?$cfe->a2:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
	</div>
	<div class="col-sm-12" id="a3_section">
		{{-- a3 section --}}
		<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="a3" > 3. Nothing + VAT Miscellaneous + Court Fee</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="a3">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="a3" name="a3" placeholder="" value="{{ isset($cfe->a3)?$cfe->a3:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
	</div>
	<div class="col-sm-12" id="a4_section">
		{{-- a4 section --}}
		<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="a4" > 4. Red Folder, Sample Received and peon</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="a4">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="a4" name="a4" placeholder="" value="{{ isset($cfe->a4)?$cfe->a4:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
	</div>
	<div class="col-sm-12" id="a4_section">
		{{-- a5 section --}}
		<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="a5" > 5. Note Sheet Type & Letter Issue</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="a5">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="a5" name="a5" placeholder="" value="{{ isset($cfe->a5)?$cfe->a5:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
	</div>
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
				<input type="number" id="b_total" name="b_total" placeholder="" value="{{ $b_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
	<div class="col-sm-12" id="b1_section">
    	{{-- b1 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b1" > 1. Apprairor & P/A</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b1">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b1" name="b1" placeholder="" value="{{ isset($cfe->b1)?$cfe->b1:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="b2_section">
    	{{-- b2 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b2" > 2. Clerk + Peon</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b2">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b2" name="b2" placeholder="" value="{{ isset($cfe->b2)?$cfe->b2:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="b3_section">
    	{{-- b3 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b3" > 3. Bond (Clerk + peon +sup)</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b3">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b3" name="b3" placeholder="" value="{{ isset($cfe->b3)?$cfe->b3:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="b4_section">
    	{{-- b4 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b4" > 4. Red Catting A/C, D/C, J/C</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b4">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b4" name="b4" placeholder="" value="{{ isset($cfe->b4)?$cfe->b4:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="b5_section">
    	{{-- b5 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b5" > 5. Clerk + Peon</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b5">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b5" name="b5" placeholder="" value="{{ isset($cfe->b5)?$cfe->b5:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="b6_section">
    	{{-- b6 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b6" > 6. Treasury, Bank Bond Submit</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b6">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b6" name="b6" placeholder="" value="{{ isset($cfe->b6)?$cfe->b6:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="b7_section">
    	{{-- b7 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="b7" > 7. Chemical Test</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="b7">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="b7" name="b7" placeholder="" value="{{ isset($cfe->b7)?$cfe->b7:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
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
				<input type="number" id="c_total" name="c_total" placeholder="" value="{{ $c_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
	<div class="col-sm-12" id="c1_section">
    	{{-- c1 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="c1" > 1. FCL/LCL Certify for Shed/Yard</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="c1">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="c1" name="c1" placeholder="" value="{{ isset($cfe->c1)?$cfe->c1:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c2_section">
    	{{-- c2 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="c2" > 2. Wrong Mark/Nill Mark if Required</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="c2">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="c2" name="c2" placeholder="" value="{{ isset($cfe->c2)?$cfe->c2:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c3_section">
    	{{-- c3 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="c3" > 3. Container Indent Apprise come delivery (FCL)</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="c3">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="c3" name="c3" placeholder="" value="{{ isset($cfe->c3)?$cfe->c3:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c4_section">
    	{{-- c4 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="c4" > 4. Appraiser & P/A</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="c4">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="c4" name="c4" placeholder="" value="{{ isset($cfe->c4)?$cfe->c4:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c5_section">
    	{{-- c5 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="c5" > 5. Appraiser Clerk + Person</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="c5">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="c5" name="c5" placeholder="" value="{{ isset($cfe->c5)?$cfe->c5:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c6_section">
        {{-- c6 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="c6" > 6. CCarpenter + SI & Security (FCL)</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="c6">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="c6" name="c6" placeholder="" value="{{ isset($cfe->c6)?$cfe->c6:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c7_section">
        {{-- c7 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="c7" > 7. Our Pass Clerk</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="c7">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="c7" name="c7" placeholder="" value="{{ isset($cfe->c7)?$cfe->c7:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c8_section">
        {{-- c8 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="c8" > 8. Heister Indent for Examine & Shorting</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="c8">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="c8" name="c8" placeholder="" value="{{ isset($cfe->c8)?$cfe->c8:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c9_section">
        {{-- c9 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="c9" > 9. Sample Send to Customs House</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="c9">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="c9" name="c9" placeholder="" value="{{ isset($cfe->c9)?$cfe->c9:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="c10_section">
        {{-- c10 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="c10" > 10. Container keep down for PCL Examine</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="c10">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="c10" name="c10" placeholder="" value="{{ isset($cfe->c10)?$cfe->c10:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    {{-- start d section --}}
	<div class="col-sm-12" id="d_total_section">
		{{-- d total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="d_total" > D) Delivery Expenses Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="d_total" name="d_total" placeholder="" value="{{ $d_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
	<div class="col-sm-12" id="d1_section">
    	{{-- d1 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="d1" > 1. Paper Certify as Gate (Custom)</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="d1">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="d1" name="d1" placeholder="" value="{{ isset($cfe->d1)?$cfe->d1:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d2_section">
    	{{-- d2 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="d2" > 2. Verify (Compering Does with IGM)</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="d2">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="d2" name="d2" placeholder="" value="{{ isset($cfe->d2)?$cfe->d2:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d3_section">
    	{{-- d3 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="d3" > 3. R/D + W/F + Computer Entry Misce.</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="d3">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="d3" name="d3" placeholder="" value="{{ isset($cfe->d3)?$cfe->d3:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d4_section">
    	{{-- d4 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="d4" > 4. Container keep down for FCI</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="d4">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="d4" name="d4" placeholder="" value="{{ isset($cfe->d4)?$cfe->d4:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d5_section">
        {{-- d5 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="d5" > 5. Delivery (Register Entry + Loading + Chember + peon + ATI + key Men + S/T + Gate surgeon + Sup)</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="d5">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="d5" name="d5" placeholder="" value="{{ isset($cfe->d5)?$cfe->d5:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d6_section">
        {{-- d6 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="d6" > 6. Cover Van Permission</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="d6">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="d6" name="d6" placeholder="" value="{{ isset($cfe->d6)?$cfe->d6:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d7_section">
        {{-- d7 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="d7" > 7. Overload Nisc.(Driver & Maltk Samity)</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="d7">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="d7" name="d7" placeholder="" value="{{isset($cfe->d7)?$cfe->d7:''}}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d8_section">
        {{-- d8 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="d8" > 8. Hyester indent & permission for Delivery</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="d8">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="d8" name="d8" placeholder="" value="{{ isset($cfe->d8)?$cfe->d8:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="d9_section">
        {{-- d9 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="d9" > 9. Truck Loading labor Tips</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="d9">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="d9" name="d9" placeholder="" value="{{ isset($cfe->d9)?$cfe->d9:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
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
				<input type="number" id="e_total" name="e_total" placeholder="" value="{{ $e_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
	<div class="col-sm-12" id="e1_section">
    	{{-- e1 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="e1" > 1. Local Truck</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="e1">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="e1" name="e1" placeholder="" value="{{ isset($cfe->e1)?$cfe->e1:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="e2_section">
    	{{-- e2 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="e2" > 2. Local Labor</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="e2">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="e2" name="e2" placeholder="" value="{{ isset($cfe->e2)?$cfe->e2:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="e3_section">
    	{{-- e3 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="e3" > 3. Other Expenses if any</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="e3">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="e3" name="e3" placeholder="" value="{{ isset($cfe->e3)?$cfe->e3:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="e4_section">
        {{-- e4 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="e4" > 4. Part FCI. Permission</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="e4">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="e4" name="e4" placeholder="" value="{{ isset($cfe->e4)?$cfe->e4:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="e5_section">
        {{-- e5 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="e5" > 5. ATO, TO, Peon</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="e5">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="e5" name="e5" placeholder="" value="{{ isset($cfe->e5)?$cfe->e5:'' }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    {{-- start f section --}}
	<div class="col-sm-12" id="f_total_section">
		{{-- f total section --}}
    	<div class="col-sm-4 section_label">
            <label class="control-label no-padding" for="f_total" > F) Receiptable Expenses & Date</label>
    	</div>
    	<div class="col-sm-4"></div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
        	<div class="col-sm-10">
				<input type="number" id="f_total" name="f_total" placeholder="" value="{{ $f_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
    	</div>
	</div>
	<div class="col-sm-12" id="f1_section">
    	{{-- f1 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="f1" > 1. C&F Association Fee</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="f1">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="f1" name="f1" placeholder="" value="{{ isset($cfe->f1)?$cfe->f1:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f2_section">
    	{{-- f2 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="f2" > 2. VAT Payment</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="f2">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="f2" name="f2" placeholder="" value="{{ isset($cfe->f2)?$cfe->f2:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f3_section">
    	{{-- f3 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="f3" > 3. Labor Charge</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="f3">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="f3" name="f3" placeholder="" value="{{ isset($cfe->f3)?$cfe->f3:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f4_section">
    	{{-- f4 section --}}
    	<br>
    	<div class="col-sm-4">
            <label class="control-label no-padding" for="f4" > 4. Port Charge</label>
    	</div>
    	<div class="col-sm-4">
    		<label class="col-sm-2 control-label no-padding" id="f4">TK.</label>
        	<div class="col-sm-10">
				<input type="number" id="f4" name="f4" placeholder="" value="{{ isset($cfe->f4)?$cfe->f4:'' }}" min="0" class="form-control g_input"/>
			</div>
    	</div>
    	<div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f5_section">
        {{-- f5 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="f5" > 5. Terminal Handling Charge (THC)</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="f5">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="f5" name="f5" placeholder="" value="{{ isset($cfe->f5)?$cfe->f5:''  }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f6_section">
        {{-- f6 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="f6" > 6. P/Copy</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="f6">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="f6" name="f6" placeholder="" value="{{ isset($cfe->f6)?$cfe->f6:''  }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f7_section">
        {{-- f7 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="f7" > 7. Terminal Handling Charge for container Agent</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="f7">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="f7" name="f7" placeholder="" value="{{ isset($cfe->f7)?$cfe->f7:''  }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12" id="f8_section">
        {{-- f8 section --}}
        <br>
        <div class="col-sm-4">
            <label class="control-label no-padding" for="f8" > 8. NOC for shippping Agent</label>
        </div>
        <div class="col-sm-4">
            <label class="col-sm-2 control-label no-padding" id="f8">TK.</label>
            <div class="col-sm-10">
                <input type="number" id="f8" name="f8" placeholder="" value="{{ isset($cfe->f8)?$cfe->f8:''  }}" min="0" class="form-control g_input"/>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
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
				<input type="number" id="less_res_tk" name="less_res_tk" placeholder="" value="{{ $total_tk-$f_total }}" min="0" class="form-control" readonly="readonly" />
			</div>
        </div>
        <div class="col-sm-12">
        	<br>
    		<label class="col-sm-3 control-label no-padding" id="total_misc_exp_tk">Total Misce. Exps TK.</label>
        	<div class="col-sm-9">
				<input type="number" id="total_misc_exp_tk" name="total_misc_exp_tk" placeholder="" value="{{ ($total_tk-$f_total)-$e_total }}" min="0"class="form-control" readonly="" />
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

	$('.g_input').on('change', function() {
		var id = $(this).attr('id');
		// a input section
		var a_input_id = ['a1','a2','a3','a4','a5'];
		var a_section_total = returnTotal(a_input_id, id,'a_total');

		// b input section
		var b_input_id = ['b1','b2','b3','b4','b5','b6','b7'];
		returnTotal(b_input_id, id,'b_total');

		// c input section
		var c_input_id = ['c1','c2','c3','c4','c5','c6','c7','c8','c9','c10'];
		returnTotal(c_input_id, id,'c_total');

		// d input section
		var d_input_id = ['d1','d2','d3','d4','d5','d6','d7','d8','d9'];
		returnTotal(d_input_id, id,'d_total');

		// e input section
		var e_input_id = ['e1','e2','e3','e4','e5'];
		returnTotal(e_input_id, id,'e_total');

		// f input section
		var f_input_id = ['f1','f2','f3','f4','f5','f6','f7','f8'];
		returnTotal(f_input_id, id,'f_total');

		// total tk
		var a_section_total = parseInt($('input[name=a_total]').val());
		var b_section_total = parseInt($('input[name=b_total]').val());
		var c_section_total = parseInt($('input[name=c_total]').val());
		var d_section_total = parseInt($('input[name=d_total]').val());
		var e_section_total = parseInt($('input[name=e_total]').val());
		var f_section_total = parseInt($('input[name=f_total]').val());

		var a_b_c_d_total = a_section_total+b_section_total+c_section_total+d_section_total;
		// add total tk
		$('input[name=total_tk]').val(a_b_c_d_total);
		// add less res tk
		$('input[name=less_res_tk]').val(a_b_c_d_total-f_section_total);
		// add total misce exps tk
		$('input[name=total_misc_exp_tk]').val((a_b_c_d_total-f_section_total)-e_section_total);
	});
</script>
