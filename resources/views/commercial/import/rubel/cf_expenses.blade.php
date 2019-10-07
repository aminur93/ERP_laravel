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
	                    <a href="#"> Import </a>
	                </li>
	                <li class="active"> C&F Expenses </li>
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
	             	<div class="panel-heading page-headline-bar"><h5> C&F Expenses <a href="{{ url('commercial/import/cf_expenses_list') }}" class="btn btn-info btn-sm pull-right">List of C&F Expenses</a></h5> </div>
	         	</div>
	                <form action="{{ url('commercial/import/cfexpenses_save') }}" method="post">
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
		                                <label class="col-sm-4 control-label no-padding" for="trans_doc" > Transport Doc</label>
		                                <div class="col-sm-8">
		                                {{ Form::select("trans_doc", $lcDocNoList, null, ['class'=>'col-xs-12 form-control', 'id'=>'trans_doc', 'placeholder'=>'Select Doc No']) }}
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
@endpush
@endsection
