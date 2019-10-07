@extends('commercial.index')
@push('css')
	<style type="text/css">
		.divborder {
			border: 1px solid lightgray;
    		padding: 12px 0px;
		}
		.section_label {
		    background: aliceblue;
		}
	</style>
@endpush
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
	                    <a href="#"> Export </a>
	                </li>
	                <li class="active"> Export Fabric Consumption Entry </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content">
	            <div class="page-header">
	                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Export Fabric Consumption Entry </small></h1>
	            </div>
	            <!-- 1st ROW -->
	            <div class="row">
	                <!-- Display Erro/Success Message -->
	                @include('inc/message')
	                <div id="selectOne"></div>
	            </div>
	            <div class="panel panel-info">
	             	<div class="panel-heading page-headline-bar"><h5> Export Fabric Consumption Entry <a href="{{ url('commercial/export/expFabricConsEntry_list') }}" class="btn btn-info btn-sm pull-right">List of Export Fabric Consumption Entry</a></h5> </div>
	         	</div>
	                <form action="{{ url('commercial/export/expFabricConsEntry_save') }}" method="post">
	                	{{ csrf_field() }}
						<div class="row">
							<br>
							{{-- hidden field --}}
							<input type="hidden" name="cm_exp_data_entry_1_id" id="cm_exp_data_entry_1_id" value="">
		                    <div class="col-sm-12">
								<div class="col-sm-3">
		                			<div class="form-group">
		                                <label class="col-sm-3 control-label no-padding" for="cm_file_id" > FIle No</label>
		                                <div class="col-sm-9">
		                                {{ Form::select("cm_file_id", $fileList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_file_id', 'placeholder'=>'Select File No']) }}
		                            	</div>
		                            </div>
		                    	</div>
								<div class="col-sm-3">
		                			<div class="form-group">
		                                <label class="col-sm-4 control-label no-padding" for="hr_unit" > Unit</label>
		                                <div class="col-sm-8">
		                                {{ Form::select("hr_unit", $unitIdList, null, ['class'=>'col-xs-12 form-control', 'id'=>'hr_unit', 'placeholder'=>'Select Unit']) }}
		                            	</div>
		                            </div>
		                    	</div>
		                    	<div class="col-sm-3">
		                			<div class="form-group">
		                                <label class="col-sm-3 control-label no-padding" for="invoice_no" >Invoice No</label>
		                                <div class="col-sm-9">
		                                {{ Form::select("invoice_no", $invoicNoList, null, ['class'=>'col-xs-12 form-control', 'id'=>'invoice_no', 'placeholder'=>'Select Invoice No']) }}
		                            	</div>
		                            </div>
		                    	</div>
		                    	<div class="col-sm-3">
		                			<div class="form-group">
		                                <label class="col-sm-3 control-label no-padding" for="inv_date" >Invoice Date</label>
		                                <div class="col-sm-9">
		                                	<input type="text" id="inv_date" placeholder="" value="{{ '' }}" class="col-xs-12 form-control" readonly="readonly" />
		                            	</div>
		                            </div>
		                    	</div>
		                    </div>
	                    </div>
	                    <br>
	                	<div class="row divborder">
		                	<div id="export_fabric_cons_entry_form" >
		                		<div class="col-sm-offset-1 col-sm-10" id="row1">
		                			<div class="col-sm-3">
			                			<div class="form-group">
			                                <label class="col-sm-3 control-label no-padding" for="inv_qty" >Quan{{PHP_EOL}}tity </label>
			                                <div class="col-sm-9">
			                                	<input type="text" id="inv_qty" placeholder="" value="{{ '' }}" class="col-xs-12 form-control" readonly="readonly" />
			                            	</div>
			                            </div>
			                    	</div>
			                    	<div class="col-sm-3">
			                			<div class="form-group">
			                                <label class="col-sm-3 control-label no-padding" for="consumption" >Consu{{PHP_EOL}}mption </label>
			                                <div class="col-sm-9">
			                                	<input type="text" name="consumption[]" placeholder="" value="{{ '' }}" class="col-xs-12 form-control"/>
			                            	</div>
			                            </div>
			                    	</div>
			                    	<div class="col-sm-2">
			                			<div class="form-group">
			                                <label class="col-sm-3 control-label no-padding" for="fabric_qty" >Fabric Qty</label>
			                                <div class="col-sm-9">
			                                	<input type="text" name="fabric_qty[]" placeholder="" value="{{ '' }}" class="col-xs-12 form-control"/>
			                            	</div>
			                            </div>
			                    	</div>
			                    	<div class="col-sm-3">
			                			<div class="form-group">
			                                <label class="col-sm-3 control-label no-padding" for="uom" >UOM</label>
			                                <div class="col-sm-9">
		                                	<?php $uom = ['UOM1','UOM2','UOM3','UOM4']; ?>
			                                {{ Form::select("uom[]", $uom, null, ['class'=>'col-xs-12 form-control', 'placeholder'=>'Select UOM']) }}
			                            	</div>
			                            </div>
			                    	</div>
			                    	<div class="col-sm-1 pull-right">
										<button type="button" class="btn btn-success btn-xs plus-btn">+</button>
			                    	</div>
		                		</div>
		                		<div id="multirowDiv"></div>
	                		</div>
		                	<div class="col-sm-offset-8 col-sm-2 pull-right" id="buttonSection" style="display: none;">
	                			<button class="btn btn-info btn-sm">Save</button>
	                		</div>
                		</div>
	                </form>
	            </div>
	        </div><!-- /.page-content -->
	    </div>

@push('js')
	<script type="text/javascript">

		$('.plus-btn').on('click', function() {
			$.ajax({
				url: '{{ url('commercial/export/expFabricConsEntry_fetchrow') }}',
				type: 'get',
				datatype: 'json',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					if(res) {
						$('#multirowDiv').append(res);
					} else {
						console.log('error occured');
					}
				}
			})
		});

		// onchange three section
		$('#cm_file_id, #invoice_no, #hr_unit').on('change', function() {
			var invoice_no = $('#invoice_no').val();
			var hr_unit = $('#hr_unit').val();
			var cm_file_id = $('#cm_file_id').val();
			if(invoice_no != '' && hr_unit != '' && cm_file_id != '') {
				$('#buttonSection').show();
				$.ajax({
					url: '{{ url('commercial/export/expFabricConsEntry_fetchinvdate_qty') }}',
					type: 'POST',
					datatype: 'json',
					data: {'file_id': cm_file_id, 'unit_id': hr_unit, 'invoice_no': invoice_no},
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function (res) {
						console.log(res);
						if(res.status) {
							$('#inv_qty').val(res.entry1_po_sum);
							$('#cm_exp_data_entry_1_id').val(res.entry_1_data.id);
							$('#inv_date').val(res.entry_1_data.inv_date);
						} else {
							console.log('error occured');
						}
					}
				})
			} else {
				$('#buttonSection').hide();
				$('#multirowDiv').html('');
			}
		});
		$('#cm_file_id').on('change', function() {
			$.ajax({
				url: '{{ url('commercial/export/expFabricConsEntry_fetchunitinvoice') }}',
				type: 'POST',
				datatype: 'json',
				data: {'file_id': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					if(res.status) {
						$('#hr_unit').html(res.hr_unit);
						$('#invoice_no').html(res.invoice);
					} else {
						console.log('error occured');
					}
				}
			})
		});

	</script>
@endpush
@endsection
