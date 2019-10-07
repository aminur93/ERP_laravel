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
	                <li class="active"> Export Bill (Air) </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content">
	            <div class="page-header">
	                <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i> Export Bill (Air) </small></h1>
	            </div>
	            <!-- 1st ROW -->
	            <div class="row">
	                <!-- Display Erro/Success Message -->
	                @include('inc/message')
	                <div id="selectOne"></div>
	            </div>
	            <div class="panel panel-info">
	             	<div class="panel-heading page-headline-bar"><h5> Export Bill (Air) <a href="{{ url('commercial/export/export_bill_air_list') }}" class="btn btn-info btn-sm pull-right">List of Export Bill (Air)</a></h5> </div>
	         	</div>
	                <form action="{{ url('commercial/export/export_bill_air_save') }}" method="post">
	                	{{ csrf_field() }}
						<div class="row">
							<br>
		                    <div class="col-sm-12">
								<div class="col-sm-4">
		                			<div class="form-group">
		                                <label class="col-sm-3 control-label no-padding" for="file_id" > FIle No</label>
		                                <div class="col-sm-9">
		                                {{ Form::select("file_id", $fileList, null, ['class'=>'col-xs-12 form-control', 'id'=>'file_id', 'placeholder'=>'Select File No']) }}
		                            	</div>
		                            </div>
		                    	</div>
								<div class="col-sm-4">
		                			<div class="form-group">
		                                <label class="col-sm-4 control-label no-padding" for="inv_no" > Invoice No</label>
		                                <div class="col-sm-8">
		                                {{ Form::select("inv_no", $invNoList, null, ['class'=>'col-xs-12 form-control', 'id'=>'inv_no', 'placeholder'=>'Select Invoice No']) }}
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
	                	<div id="cf_expenses_form"></div>
	                </form>
	            </div>
	        </div><!-- /.page-content -->
	    </div>
@push('js')
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
			var inv_no = $('#inv_no').val();
			if(file_no != '' && inv_no != '') {
				$('#selectOne').html('');
				ajax_loader_fn();
				setTimeout(() => {
					$.ajax({
						url: '{{ url('commercial/export/export_bill_air_fetchentrydata') }}',
						type: 'POST',
						datatype: 'json',
						data: {'file_no': file_no, 'inv_no': inv_no},
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
				url: '{{ url('commercial/export/export_bill_air_fetchinvno') }}',
				type: 'POST',
				datatype: 'json',
				data: {'file_id': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					if(res.status) {
						$('#inv_no').html(res.inv_no);
					} else {
						console.log('error occured');
					}
				}
			})
		});
	</script>
@endpush
@endsection
