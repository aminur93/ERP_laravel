@extends('commercial.index')
@section('content')
<?php
	$cfe = $cfExpensesData; 
	$a_total = $cfe->a1+$cfe->a2+$cfe->a3+$cfe->a4+$cfe->a5;
	$b_total = $cfe->b1+$cfe->b2+$cfe->b3+$cfe->b4+$cfe->b5+$cfe->b6+$cfe->b7+$cfe->b8;
	$c_total = $cfe->c1+$cfe->c2+$cfe->c3+$cfe->c4+$cfe->c5;
	$d_total = $cfe->d1+$cfe->d2+$cfe->d3+$cfe->d4;
	$e_total = $cfe->e1+$cfe->e2+$cfe->e3;
	$f_total = $cfe->f1+$cfe->f2+$cfe->f3+$cfe->f4;
	$total_tk = $a_total+$b_total+$c_total+$d_total+$e_total+$f_total;
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li> 
                <li>
                    <a href="#"> Import </a>
                </li>
                <li class="active"> Edit C&F Expenses </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Edit C&F Expenses </small></h1>
            </div>
            <!-- 1st ROW -->
            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div id="selectOne"></div> 
            </div>
            <form action="{{ url('commercial/import/cfexpenses_update/'.$cfe->imp_air_id) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                	<br>
                    <div class="col-sm-12">
                    	<div class="col-sm-3">
                			<div class="form-group">
                                <label class="col-sm-4 control-label no-padding" for="exp_for" > C&F Expenses for</label>
                                <div class="col-sm-8">
                                    <input type="text" id="exp_for" name="exp_for" placeholder="" value="{{ $cfe->hr_unit }}" class="col-xs-12 form-control" readonly="readonly" />
                                </div>
                            </div> 
                    	</div>
                    	<div class="col-sm-3">
                			<div class="form-group">
                                <label class="col-sm-4 control-label no-padding" for="package" > Package</label>
                                <div class="col-sm-8">
                                    <input type="text" id="package" name="package" placeholder="" value="{{ $cfe->package }}" class="col-xs-12 form-control" readonly="readonly" />
                                </div>
                            </div> 
                    	</div>
                    	<div class="col-sm-3">
                			<div class="form-group">
                                <label class="col-sm-4 control-label no-padding" for="weight" > Weight</label>
                                <div class="col-sm-8">
                                    <input type="text" id="weight" name="weight" placeholder="" value="{{ $cfe->weight }}" class="col-xs-12 form-control" readonly="readonly" />
                                </div>
                            </div> 
                    	</div>
                    	<div class="col-sm-3">
                			<div class="form-group">
                                <label class="col-sm-4 control-label no-padding" for="cbm" > CBM</label>
                                <div class="col-sm-8">
                                    <input type="text" id="cbm" name="cbm" placeholder="" value="{{ $cfe->cubic_measurement }}" class="col-xs-12 form-control" readonly="readonly" />
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
                                    <input type="text" id="supplier" name="supplier" placeholder="" value="{{ $cfe->sup_name }}" class="col-xs-12 form-control" readonly="readonly" />
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
                                	<input type="text" id="t_doc_no" name="t_doc_no" placeholder="Doc No" value="{{ $cfe->transp_doc_no1 }}" class="col-xs-12 form-control" readonly="readonly" />
                            	</div>
                            	<div class="col-sm-4">
                                	<input type="text" id="to_doc_date" name="to_doc_date" placeholder="Doc Date" value="{{ $cfe->transp_doc_date }}" class="col-xs-12 form-control datepicker" readonly="readonly" />
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
                                	<input type="text" id="job_start_date" name="job_start_date" placeholder="" value="{{ $cfe->job_start_date }}" class="col-xs-12 form-control datepicker" data-validation="required" />
                                </div>
                            </div> 
                    	</div>
                		<div class="col-sm-6">
                			<div class="form-group">
                                <label class="col-sm-4 control-label no-padding" for="job_end_date" > Job Ending Date</label>
                                <div class="col-sm-8">
                                	<input type="text" id="job_end_date" name="job_end_date" placeholder="" value="{{ $cfe->job_end_date }}" class="col-xs-12 form-control datepicker" data-validation="required"/>
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
                            <label class="control-label no-padding" for="a_total" > A) Nothing & Documentation Exps</label>
                    	</div>
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
                        	<div class="col-sm-10">
                				<input type="text" id="a_total" name="a_total" placeholder="" value="{{ $cfe->a1+$cfe->a2+$cfe->a3+$cfe->a4+$cfe->a5 }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                    	</div>
                	</div>
                	<div class="col-sm-12" id="a1_section">
                    	{{-- a1 section --}}
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="a1" > 1. Minifest Number + Entry Clerk</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="a1">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="a1" name="a1" placeholder="" value="{{ $cfe->a1 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="a2_section">
                		{{-- a2 section --}}
                		<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="a2" > 2. Paper Entry + Vat Print</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="a2">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="a2" name="a2" placeholder="" value="{{ $cfe->a2 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                	</div>
                	<div class="col-sm-12" id="a3_section">
                		{{-- a3 section --}}
                		<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="a3" > 3. Pass Book Collect</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="a3">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="a3" name="a3" placeholder="" value="{{ $cfe->a3 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                	</div>
                	<div class="col-sm-12" id="a4_section">
                		{{-- a4 section --}}
                		<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="a4" > 4. Bond Clerk</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="a4">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="a4" name="a4" placeholder="" value="{{ $cfe->a4 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                	</div>
                	<div class="col-sm-12" id="a4_section">
                		{{-- a5 section --}}
                		<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="a5" > 5. Letter Disperse</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="a5">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="a5" name="a5" placeholder="" value="{{ $cfe->a5 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                	</div>
                	{{-- start b section --}}
                	<div class="col-sm-12" id="b_total_section">
                		{{-- b total section --}}
                    	<div class="col-sm-4 section_label">
                            <label class="control-label no-padding" for="b_total" > B) Nothing & Documentation Exps</label>
                    	</div>
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b_total" name="b_total" placeholder="" value="{{ $cfe->b1+$cfe->b2+$cfe->b3+$cfe->b4+$cfe->b5+$cfe->b6+$cfe->b7+$cfe->b8 }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                    	</div>
                	</div>
                	<div class="col-sm-12" id="b1_section">
                    	{{-- b1 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b1" > 1. Ship + Inspector</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b1">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b1" name="b1" placeholder="" value="{{ $cfe->b1 }}" min="0" class="form-control g_input"/>
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
                				<input type="number" id="b2" name="b2" placeholder="" value="{{ $cfe->b2 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="b3_section">
                    	{{-- b3 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b3" > 3. RED & Green Purpose Exps</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b3">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b3" name="b3" placeholder="" value="{{ $cfe->b3 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="b4_section">
                    	{{-- b4 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b4" > 4. Urgent Vat Payment & Release Order Rcv Exps</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b4">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b4" name="b4" placeholder="" value="{{ $cfe->b4 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="b5_section">
                    	{{-- b5 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b5" > 5. Photocopy</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b5">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b5" name="b5" placeholder="" value="{{ $cfe->b5 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="b6_section">
                    	{{-- b6 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b6" > 6. Aditional Exps, if any (D.Comm/A.Comm)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b6">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b6" name="b6" placeholder="" value="{{ $cfe->b6 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="b7_section">
                    	{{-- b7 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b7" > 7. D.Comm/A.Comm for PA & Shapf</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b7">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b7" name="b7" placeholder="" value="{{ $cfe->b7 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="b8_section">
                    	{{-- b8 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="b8" > 8. Out Pass</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="b8">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="b8" name="b8" placeholder="" value="{{ $cfe->b8 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    {{-- start c section --}}
                	<div class="col-sm-12" id="c_total_section">
                		{{-- c total section --}}
                    	<div class="col-sm-4 section_label">
                            <label class="control-label no-padding" for="c_total" > C) Examination Exps</label>
                    	</div>
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
                        	<div class="col-sm-10">
                				<input type="number" id="c_total" name="c_total" placeholder="" value="{{ $cfe->c1+$cfe->c2+$cfe->c3+$cfe->c4+$cfe->c5 }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                    	</div>
                	</div>
                	<div class="col-sm-12" id="c1_section">
                    	{{-- c1 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="c1" > 1. Sup + Inspector</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="c1">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="c1" name="c1" placeholder="" value="{{ $cfe->c1 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="c2_section">
                    	{{-- c2 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="c2" > 2. Clerk + Peon</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="c2">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="c2" name="c2" placeholder="" value="{{ $cfe->c2 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="c3_section">
                    	{{-- c3 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="c3" > 3. DC & AC & Supply</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="c3">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="c3" name="c3" placeholder="" value="{{ $cfe->c3 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="c4_section">
                    	{{-- c4 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="c4" > 4. CR + DR Exps</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="c4">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="c4" name="c4" placeholder="" value="{{ $cfe->c4 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="c5_section">
                    	{{-- c5 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="c5" > 5. Produce + AWB Certify</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="c5">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="c5" name="c5" placeholder="" value="{{ $cfe->c5 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    {{-- start d section --}}
                	<div class="col-sm-12" id="d_total_section">
                		{{-- d total section --}}
                    	<div class="col-sm-4 section_label">
                            <label class="control-label no-padding" for="d_total" > D) Delivery Expenses</label>
                    	</div>
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
                        	<div class="col-sm-10">
                				<input type="number" id="d_total" name="d_total" placeholder="" value="{{ $cfe->d1+$cfe->d2+$cfe->d3+$cfe->d4 }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                    	</div>
                	</div>
                	<div class="col-sm-12" id="d1_section">
                    	{{-- d1 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="d1" > 1. Duty Verify (Inspector)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="d1">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="d1" name="d1" placeholder="" value="{{ $cfe->d1 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="d2_section">
                    	{{-- d2 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="d2" > 2. Gate Customs(Cus + Biman Copy) Certificate</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="d2">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="d2" name="d2" placeholder="" value="{{ $cfe->d2 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="d3_section">
                    	{{-- d3 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="d3" > 3. Exit No</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="d3">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="d3" name="d3" placeholder="" value="{{ $cfe->d3 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="d4_section">
                    	{{-- d4 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="d4" > 4. Delivery Point (C/insp+Biman Officer+B/Clerk+Biman Security+C/Shipi+B/Shipi)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="d4">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="d4" name="d4" placeholder="" value="{{ $cfe->d4 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    {{-- start e section --}}
                	<div class="col-sm-12" id="e_total_section">
                		{{-- e total section --}}
                    	<div class="col-sm-4 section_label">
                            <label class="control-label no-padding" for="e_total" > E) Additional Exps, If any</label>
                    	</div>
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
                        	<div class="col-sm-10">
                				<input type="number" id="e_total" name="e_total" placeholder="" value="{{ $cfe->e1+$cfe->e2+$cfe->e3 }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                    	</div>
                	</div>
                	<div class="col-sm-12" id="e1_section">
                    	{{-- e1 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="e1" > 1. Labor (Wear House)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="e1">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="e1" name="e1" placeholder="" value="{{ $cfe->e1 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="e2_section">
                    	{{-- e2 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="e2" > 2. Labor (Out Site)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="e2">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="e2" name="e2" placeholder="" value="{{ $cfe->e2 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="e3_section">
                    	{{-- e3 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="e3" > 3. Truck/Baby Fare</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="e3">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="e3" name="e3" placeholder="" value="{{ $cfe->e3 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    {{-- start f section --}}
                	<div class="col-sm-12" id="f_total_section">
                		{{-- f total section --}}
                    	<div class="col-sm-4 section_label">
                            <label class="control-label no-padding" for="f_total" > F) Reciptable Exxpenses</label>
                    	</div>
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding">Total (TK)</label>
                        	<div class="col-sm-10">
                				<input type="number" id="f_total" name="f_total" placeholder="" value="{{ $cfe->f1+$cfe->f2+$cfe->f3+$cfe->f4 }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                    	</div>
                	</div>
                	<div class="col-sm-12" id="f1_section">
                    	{{-- f1 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="f1" > 1. AWB/HAWB Collect(ORG)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="f1">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="f1" name="f1" placeholder="" value="{{ $cfe->f1 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="f2_section">
                    	{{-- f2 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="f2" > 2. C&F Association Fee (ORG)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="f2">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="f2" name="f2" placeholder="" value="{{ $cfe->f2 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="f3_section">
                    	{{-- f3 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="f3" > 3. Vat & Tax Payment (ORG)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="f3">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="f3" name="f3" placeholder="" value="{{ $cfe->f3 }}" min="0" class="form-control g_input"/>
                			</div>
                    	</div>
                    	<div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-12" id="f4_section">
                    	{{-- f4 section --}}
                    	<br>
                    	<div class="col-sm-4">
                            <label class="control-label no-padding" for="f4" > 4. Biman Handling & Storage Charge (ORG)</label>
                    	</div>
                    	<div class="col-sm-4">
                    		<label class="col-sm-2 control-label no-padding" id="f4">TK.</label>
                        	<div class="col-sm-10">
                				<input type="number" id="f4" name="f4" placeholder="" value="{{ $cfe->f4 }}" min="0" class="form-control g_input"/>
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
                    		<label class="col-sm-3 control-label no-padding" id="less_res_tk">Less Receiptable TK.</label>
                        	<div class="col-sm-9">
                				<input type="number" id="less_res_tk" name="less_res_tk" placeholder="" value="{{ $total_tk-$f_total }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                        </div>
                        <div class="col-sm-12">
                        	<br>
                    		<label class="col-sm-3 control-label no-padding" id="labor">Labor TK.</label>
                        	<div class="col-sm-9">
                				<input type="number" id="labor" name="labor" placeholder="" value="{{ $e_total }}" min="0" class="form-control" readonly="readonly" />
                			</div>
                        </div>
                        <div class="col-sm-12">
                        	<br>
                    		<label class="col-sm-3 control-label no-padding" id="total_misc_exp_tk">Total Misce. Exps TK.</label>
                        	<div class="col-sm-9">
                				<input type="number" id="total_misc_exp_tk" name="total_misc_exp_tk" placeholder="" value="{{ ($total_tk-$f_total)-$e_total }}" min="0" class="form-control" readonly="" />
                			</div>
                        </div>
                        <div class="col-sm-12">
                        	<br>
                    		<label class="col-sm-3"></label>
                        	<div class="col-sm-9">
                				<button type="submit" class="btn btn-info">Update</button>
                			</div>
                        </div>
                	</div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
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
    		var b_input_id = ['b1','b2','b3','b4','b5','b6','b7','b8'];
    		returnTotal(b_input_id, id,'b_total');
    		
    		// c input section			
    		var c_input_id = ['c1','c2','c3','c4','c5'];
    		returnTotal(c_input_id, id,'c_total');

    		// d input section			
    		var d_input_id = ['d1','d2','d3','d4'];
    		returnTotal(d_input_id, id,'d_total');

    		// e input section			
    		var e_input_id = ['e1','e2','e3'];
    		returnTotal(e_input_id, id,'e_total');

    		// f input section			
    		var f_input_id = ['f1','f2','f3','f4'];
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
    		// add labor tk
    		$('input[name=labor]').val(e_section_total);
    		// add total misce exps tk
    		$('input[name=total_misc_exp_tk]').val((a_b_c_d_total-f_section_total)-e_section_total);
    	});
    </script>
@endpush