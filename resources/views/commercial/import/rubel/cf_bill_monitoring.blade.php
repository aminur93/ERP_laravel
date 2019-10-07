@extends('commercial.index')
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
	                <li class="active"> C&F Bill Monitoring </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content">
	            <div class="page-header">
	                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> C&F Bill Monitoring </small></h1>
	            </div>
	            <!-- 1st ROW -->
                <div class="row">
					<div class="col-sm-12">
	                    <!-- Display Erro/Success Message -->
	                    @include('inc/message')
	                    <div id="selectOne"></div>
	                    <div class="panel panel-info">
			             	<div class="panel-heading page-headline-bar"><h5> C&F Bill Monitoring <a href="{{ url('commercial/import/cf_bill_monitoring_list') }}" class="btn btn-info btn-sm pull-right">List of C&F Bill Monitoring</a></h5> </div>
			         	</div>
					</div>
					<form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/cf_bill_monitoring_search') }}">
						{{ csrf_field() }}
	                    <div class="col-sm-12">
	                    	<div class="col-sm-3">
	                			<label class="col-sm-4 control-label no-padding" for="cm_file_id" > File No<span style="color: red">&#42;</span> </label>
	                            <div class="col-sm-8">
	                                {{ Form::select("cm_file_id", $cmFileList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_file_id', 'placeholder'=>'Select File No']) }}
	                            </div>
	                    	</div>
	                    	<div class="col-sm-3">
	                			<div class="form-group">
	                                <label class="col-sm-4 control-label no-padding" for="cm_value" > Value</label>
	                                <div class="col-sm-8">
	                                    <input type="text" id="cm_value" name="cm_value" placeholder="" value="" class="col-xs-12 form-control"/>
	                                </div>
	                            </div>
	                    	</div>
	                    	<div class="col-sm-3">
	                			<label class="col-sm-4 control-label no-padding" for="cm_supplier_id" > Shipment Mode</label>
	                            <div class="col-sm-8">
	                                {{ Form::select("cm_shipment_mode", $cmShipModeList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_shipment_mode', 'placeholder'=>'Select Shipment Mode',]) }}
	                            </div>
	                    	</div>
	                    	<div class="col-sm-3">
	                    		<button class="btn btn-info btn-sm" type="button" id="valueSearch">
	                                <i class="ace-icon fa fa-search"></i> Search
	                            </button>
	                    	</div>
	                    </div>
                	</form>
                </div>
                <!-- select table -->
                <!-- 2nd ROW -->
                <br><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="ajax_cf_bill_monitoring_form" class="text-center"></div>
                    </div>
                </div>
                <!-- end select table -->
	        </div><!-- /.page-content -->
	    </div>
	</div>

@push('js')
	<script type="text/javascript">
		function ajax_loader_fn() {
			var loaderPath = "{{asset('assets/rubel/img/loader.gif')}}";
			$("#ajax_cf_bill_monitoring_form").html('<div class="loader-cycle text-center"><img src="'+loaderPath+'" /></div>');
			$('html, body').animate({
	            scrollTop: $("#ajax_cf_bill_monitoring_form").offset().top
	        }, 2000);
		}

		$('#valueSearch').on('click', function() {
			var data = {};
			data.file_id = $('#cm_file_id').val();
			data.value = $('#cm_value').val();
			data.ship_mode = $('#cm_shipment_mode').val();
			if(data.file_id != '' || data.value != '' || data.ship_mode != '') {
				$('#selectOne').html('');
				ajax_loader_fn();
	            setTimeout(() => {
					$.ajax({
						url: '{{ url('commercial/import/cf_bill_monitoring_search') }}',
						type: 'POST',
						datatype: 'json',
						data: {'data': data},
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						success: function (res) {
							$('#ajax_cf_bill_monitoring_form').html(res);
						}
					});
				}, 1000);
			} else {
				$('#ajax_cf_bill_monitoring_form').html('');
				var html = '<div class="alert alert-danger alert-dismissible" role="alert">';
				html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				html += '<span aria-hidden="true">&times;</span></button>Please select one';
				html += '</div>';
				$('#selectOne').html(html);
			}
		});
		{{-- file_id onchange --}}
		$('#cm_file_id').on('change', function() {
			$.ajax({
				url: '{{ url('commercial/import/cf_bill_monitoring_shipmode_search') }}',
				type: 'POST',
				datatype: 'json',
				data: {'file_id': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					$('#cm_shipment_mode').html(res);
				}
			})
		});
	</script>
@endpush
@endsection
