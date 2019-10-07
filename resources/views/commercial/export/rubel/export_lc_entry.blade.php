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
	                <li class="active"> Export L/C Entry </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content"> 
	            <div class="page-header">
	                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Export L/C Entry </small></h1>
	            </div>
	            <!-- 1st ROW -->
	            <div class="row">
	                <!-- Display Erro/Success Message -->
	                @include('inc/message')
	                <div id="selectOne"></div> 
	            </div>
	            <div class="panel panel-info">
	             	<div class="panel-heading page-headline-bar"><h5> Export L/C Entry <a href="{{ url('commercial/export/exportLcEntry_list') }}" class="btn btn-info btn-sm pull-right">List of Export L/C Entry</a></h5> </div>
	         	</div>
	                <form action="{{ url('commercial/export/exportLcEntry_save') }}" method="post">
	                	{{ csrf_field() }}
						<div class="row">
							<br>
		                    <div class="col-sm-12">
								<div class="col-sm-4">
		                			<div class="form-group">
		                                <label class="col-sm-3 control-label no-padding" for="invoice_no" > Enter Invoice No</label>
		                                <div class="col-sm-9">
		                                {{ Form::select("invoice_no", $invoicNoList, null, ['class'=>'col-xs-12 form-control', 'id'=>'invoice_no', 'placeholder'=>'Select Invoice No']) }}
		                            	</div>
		                            </div> 
		                    	</div>
								<div class="col-sm-4">
		                			<div class="form-group">
		                                <label class="col-sm-4 control-label no-padding" for="hr_unit" > Unit</label>
		                                <div class="col-sm-8">
		                                {{ Form::select("hr_unit", $unitIdList, null, ['class'=>'col-xs-12 form-control', 'id'=>'hr_unit', 'placeholder'=>'Select Unit']) }}
		                            	</div>
		                            </div>
		                    	</div>
		                    	<div class="col-sm-4">
		                			<button class="btn btn-info btn-sm" type="button" id="valueSearch">
		                                <i class="ace-icon fa fa-search"></i> Search
		                            </button>
		                    	</div>
		                    </div>	
	                    </div>
	                    <br>
	                	<div id="export_lc_entry_form" class="row"></div>
	                </form>
	            </div>
	        </div><!-- /.page-content -->
	    </div>
	
@push('js')	
	<script type="text/javascript">
		function ajax_loader_fn() {
			var loaderPath = "{{asset('assets/rubel/img/loader.gif')}}";
			$("#export_lc_entry_form").html('<div class="loader-cycle text-center"><img src="'+loaderPath+'" /></div>');
			$('html, body').animate({
	            scrollTop: $("#export_lc_entry_form").offset().top
	        }, 2000);
		}

		$('#valueSearch').on('click', function() {
			var invoice_no = $('#invoice_no').val();
			var hr_unit = $('#hr_unit').val();
			if(invoice_no != '' && hr_unit != '') {
				$('#selectOne').html('');
				ajax_loader_fn();
				setTimeout(() => {
					$.ajax({
						url: '{{ url('commercial/export/exportLcEntry_fetchentryform') }}',
						type: 'POST',
						datatype: 'json',
						data: {'invoice_no': invoice_no, 'hr_unit': hr_unit},
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						success: function (res) {
							if(res.status) {
								$('#export_lc_entry_form').html(res.render);
								$('#export_lc_entry_form').addClass('divborder');
							} else {
								console.log('error occured');
							}
						}
					});
				}, 1000);
			} else {
				$('#export_lc_entry_form').html('');
				var html = '<div class="alert alert-danger alert-dismissible" role="alert">';
				html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				html += '<span aria-hidden="true">&times;</span></button>Please select all option';
				html += '</div>';
				$('#selectOne').html(html);
			}
		});
		{{-- file_id onchange --}}
		$('#invoice_no').on('change', function() {
			$.ajax({
				url: '{{ url('commercial/export/exportLcEntry_fetchunit') }}',
				type: 'POST',
				datatype: 'json',
				data: {'invoice_no': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					if(res.status) {
						$('#hr_unit').html(res.hr_unit);
					} else {
						console.log('error occured');
					}
				}
			})
		});
	</script>
@endpush
@endsection