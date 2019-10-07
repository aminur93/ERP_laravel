{{-- 2nd row --}}
@extends('commercial/index')
@section('content')
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
				<li class="active">  </li>
			</ul><!-- /.breadcrumb -->
			</div>

			<div class="page-content"> 
			<div class="page-header">
				<h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> C&F Expenses </small></h1>
			</div>
			<!-- 1st ROW -->
			<div class="row">
				<!-- Display Erro/Success Message -->
				@include('inc/message')
				<div id="selectOne"></div> 
			</div>
			<div class="panel panel-info">
				{{-- <div class="panel-heading page-headline-bar"><h5> C&F Expenses <a href="{{ url('commercial/import/cf_expenses_list') }}" class="btn btn-info btn-sm pull-right">List of C&F Expenses</a></h5> </div> --}}
				</div>
				<form action="{{ url('commercial/export/exportbill') }}" method="post">
					{{ csrf_field() }}

					<input type="hidden" id="imp_air_id" name="imp_air_id" value="">
					<input type="hidden" id="cm_imp_data_entry_id" name="cm_imp_data_entry_id" value="">
					<div class="row">
						<br>
						<div class="col-sm-12">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding" for="exp_for" > 1. File No</label>
									<div class="col-sm-8">
											<select class="custom-select" onchange="fileno(this.value)">
											<option value="">Select File</option>
												@foreach ($files as $file)
											<option value="{{$file}}">{{$file}}</option>
												@endforeach
											</select>
									</div>
								</div> 
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding" for="cbm" > 2. Inv Value US$</label>
									<div class="col-sm-8">
										<input type="text" id="cbm" name="cbm" placeholder="" value="" class="col-xs-12 form-control" readonly="readonly" />
									</div>
								</div> 
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding" for="item" > Inv No</label>
									<div class="col-sm-8">
											<select class="custom-select" name="invoice_no" onchange="invoiceData(this.value)">
												<option selected>Select Invoice No</option>
												<option value="1" id="select_u"></option>
											</select>
									</div>
								</div> 
							</div>
							{{-- <div class="col-sm-3">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding" for="supplier" > Supplier</label>
									<div class="col-sm-8">
										<input type="text" id="supplier" name="supplier" placeholder="" value="" class="col-xs-12 form-control" readonly="readonly" />
									</div>
								</div> 
							</div> --}}
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding" for="doc_value" > T.Doc No</label>
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
									<label class="col-sm-4 control-label no-padding" for="bill_entry_no" > S/B No & Date</label>
									<div class="col-sm-4">
										<input type="text" id="bill_entry_no" name="bill_entry_no" placeholder="Bill Entry No" value="" class="col-xs-12 form-control" readonly="readonly" />
									</div>
									<div class="col-sm-4">
										<input type="text" id="bill_entry_date" name="bill_entry_date" placeholder="Bill Entry Date" value="" class="col-xs-12 form-control datepicker" readonly="readonly" />
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
										<input type="text" id="job_start_date" name="job_start_date" placeholder="" value="" class="col-xs-12 form-control datepicker" data-validation="required" />
									</div>
								</div> 
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-4 control-label no-padding" for="job_end_date" > Job Ending Date</label>
									<div class="col-sm-8">
										<input type="text" id="job_end_date" name="job_end_date" placeholder="" value="" class="col-xs-12 form-control datepicker" data-validation="required"/>
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
								<label class="control-label no-padding" for="a_total" > A) Assesment Expenses</label>
							</div>
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding">Total (TK)</label>
								<div class="col-sm-10">
									<input type="text" id="a_total" name="a_total" placeholder="" value="" class="form-control" readonly="readonly" />
								</div>
							</div>
						</div>
						<div class="col-sm-12" id="a1_section">
							{{-- a1 section --}}
							<div class="col-sm-4">
								<label class="control-label no-padding" for="a1" > 1. Paper Entry</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="a1">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="a1" name="a1" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="a2_section">
							{{-- a2 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="a2" > 2. Sup + Inspector</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="a2">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="a2" name="a2" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="a3_section">
							{{-- a3 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="a3" > 3. Clerk + Peon</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="a3">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="a3" name="a3" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="a4_section">
							{{-- a4 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="a4" > 4. Vat print</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="a4">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="a4" name="a4" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="a4_section">
							{{-- a5 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="a5" > 5. RED & Green Purpose Exps</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="a5">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="a5" name="a5" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>

						<div class="col-sm-12" id="a4_section">
								{{-- a5 section --}}
								<br>
								<div class="col-sm-4">
									<label class="control-label no-padding" for="a5" > 6. Letter Disperse</label>
								</div>
								<div class="col-sm-4">
									<label class="col-sm-2 control-label no-padding" id="a5">TK.</label>
									<div class="col-sm-10">
										<input type="number" id="a5" name="a6" placeholder="" value="" class="form-control g_input"/>
									</div>
								</div>
								<div class="col-sm-4"></div>
							</div>
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
									<input type="number" id="b_total" name="b_total" placeholder="" value="" class="form-control" readonly="readonly" />
								</div>
							</div>
						</div>
						<div class="col-sm-12" id="b1_section">
							{{-- b1 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="b1" > 1. Sup + Inspector</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="b1">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="b1" name="b1" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="b2_section">
							{{-- b2 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="b2" > 2. Clerk + Peon/label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="b2">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="b2" name="b2" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="b3_section">
							{{-- b3 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="b3" > 3. DC & AC</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="b3">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="b3" name="b3" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="b4_section">
							{{-- b4 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="b4" > 4. Clerk + Peon</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="b4">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="b4" name="b4" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						
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
									<input type="number" id="c_total" name="c_total" placeholder="" value="" class="form-control" readonly="readonly" />
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
									<input type="number" id="c1" name="c1" placeholder="" value="" class="form-control g_input"/>
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
									<input type="number" id="c2" name="c2" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="c3_section">
							{{-- c3 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="c3" > 3. DC & AC</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="c3">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="c3" name="c3" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="c4_section">
							{{-- c4 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="c4" > 4. Clerk + Peon</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="c4">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="c4" name="c4" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
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
									<input type="number" id="d_total" name="d_total" placeholder="" value="" class="form-control" readonly="readonly" />
								</div>
							</div>
						</div>
						<div class="col-sm-12" id="d1_section">
							{{-- d1 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="d1" > 1. Sup + Inspector</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="d1">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="d1" name="d1" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="d2_section">
							{{-- d2 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="d2" > 2. Clerk + Peon</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="d2">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="d2" name="d2" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="d3_section">
							{{-- d3 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="d3" > 3. DC & AC</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="d3">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="d3" name="d3" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="d4_section">
							{{-- d4 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="d4" > 4. Clerk + Peon</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="d4">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="d4" name="d4" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
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
									<input type="number" id="e_total" name="e_total" placeholder="" value="" class="form-control" readonly="readonly" />
								</div>
							</div>
						</div>
						<div class="col-sm-12" id="e1_section">
							{{-- e1 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="e1" > 1. C&F Association Fee (ORG)</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="e1">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="e1" name="e1" placeholder="" value="" class="form-control g_input"/>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>
						<div class="col-sm-12" id="e2_section">
							{{-- e2 section --}}
							<br>
							<div class="col-sm-4">
								<label class="control-label no-padding" for="e2" > 2. Vat & Tax Payment(ORG)</label>
							</div>
							<div class="col-sm-4">
								<label class="col-sm-2 control-label no-padding" id="e2">TK.</label>
								<div class="col-sm-10">
									<input type="number" id="e2" name="e2" placeholder="" value="" class="form-control g_input"/>
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
									<input type="number" id="total_tk" name="total_tk" placeholder="" value="" class="form-control" readonly="readonly" />
								</div>
							</div>
							<div class="col-sm-12">
								<br>
								<label class="col-sm-3 control-label no-padding" id="less_res_tk">Less Receiptable TK.</label>
								<div class="col-sm-9">
									<input type="number" id="less_res_tk" name="less_res_tk" placeholder="" value="" class="form-control" readonly="readonly" />
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

				</form>
			</div>
		</div><!-- /.page-content -->
	</div>
	
<script type="text/javascript">
	function ajax_loader_fn() {
		var loaderPath = "{{asset('assets/rubel/img/loader.gif')}}";
		$("#cf_expenses_form").html('<div class="loader-cycle text-center"><img src="'+loaderPath+'" /></div>');
		$('html, body').animate({
		scrollTop: $("#cf_expenses_form").offset().top
		}, 2000);
	}

	$('#valueSearch').on('click', function() {			
		var file_no = $('#file_id').val();
		var doc_no = $('#trans_doc').val();
		if(file_no != '' && doc_no != '') {
			$('#selectOne').html('');
			ajax_loader_fn();
			setTimeout(() => {
				$.ajax({
					url: '{{ url('commercial/import/cfexpenses_fetchentrydata') }}',
					type: 'POST',
					datatype: 'json',
					data: {'file_no': file_no, 'doc_no': doc_no},
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function (res) {
						if(res.status) {
							$('#cf_expenses_form').html(res.render);
						} else {
							console.log('error occured');
						}
					}
				});
			}, 1000);
		} else {
			$('#cf_expenses_form').html('');
			var html = '<div class="alert alert-danger alert-dismissible" role="alert">';
			html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			html += '<span aria-hidden="true">&times;</span></button>Please select all option';
			html += '</div>';
			$('#selectOne').html(html);
		}
	});
	{{-- file_id onchange --}}
	$('#file_id').on('change', function() {
		$.ajax({
			url: '{{ url('commercial/import/cfexpenses_fetchtransdoc') }}',
			type: 'POST',
			datatype: 'json',
			data: {'file_id': $(this).val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function (res) {
				if(res.status) {
					$('#trans_doc').html(res.trans_doc);
				} else {
					console.log('error occured');
				}
			}
		})
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
		var a_input_id = ['a1','a2','a3','a4','a5','a6'];
		returnTotal(a_input_id, id,'a_total');

		// b input section			
		var b_input_id = ['b1','b2','b3','b4'];
		returnTotal(b_input_id, id,'b_total');
		
		// c input section			
		var c_input_id = ['c1','c2','c3','c4'];
		returnTotal(c_input_id, id,'c_total');

		// d input section			
		var d_input_id = ['d1','d2','d3','d4'];
		returnTotal(d_input_id, id,'d_total');

		// e input section			
		var e_input_id = ['e1','e2'];
		returnTotal(e_input_id, id,'e_total');

		// total tk
		var a_section_total = parseInt($('input[name=a_total]').val());
		var b_section_total = parseInt($('input[name=b_total]').val());
		var c_section_total = parseInt($('input[name=c_total]').val());
		var d_section_total = parseInt($('input[name=d_total]').val());
		var e_section_total = parseInt($('input[name=e_total]').val());
		var f_section_total = parseInt($('input[name=f_total]').val());

		var a_b_c_d_total = a_section_total+b_section_total+c_section_total+d_section_total;
		// add total tk
		console.log(a_b_c_d_total, e_section_total);
		$('input[name=total_tk]').val(a_b_c_d_total);
		// add less res tk
		$('input[name=less_res_tk]').val(a_b_c_d_total-e_section_total);
		// add labor tk
		// $('input[name=labor]').val(e_section_total);
		// add total misce exps tk
		// $('input[name=total_misc_exp_tk]').val((a_b_c_d_total-f_section_total)-e_section_total);
		// $('#less_res_tk').val(e_section_total);
	});
</script>

<script>
	function fileno(fno){
		var url = "{{url('/')}}";
		var url = url+'/commercial/export/invoiceno/'+fno;
		var data;
		fetch(url)
		.then(data => {return data.json()})
		.then(res => {
		console.log(res);
		var opt_sel = '';
			for(var i=0;i<res.length;i++){
			opt_sel+='<option value='+res[i]+'>'+res[i]+'</option>';
			}
		$('#select_u').html(opt_sel);
		})
	}

	function invoiceData(invno){
		var url = "{{url('/')}}";
		var url = url+'/commercial/export/invoicedata/'+invno;
		var data;
		fetch(url)
		.then(data => {return data.json()})
		.then(res => {
		console.log(res);
		
		$('#cbm').val(res[0]);
		})


		url = "{{url('/')}}";
		var url = url+'/commercial/export/invoicedatamore/'+invno;
		var data;
		fetch(url)
		.then(data => {return data.json()})
		.then(res => {
		console.log(res[0].transp_doc_no);
		
		$('#doc_value').val(res[0].transp_doc_no);
		$('#bill_entry_no').val(res[0].ship_bill_no);
		$('#bill_entry_date').val(res[0].ship_bill_date);
		})
	}
</script>

@endsection