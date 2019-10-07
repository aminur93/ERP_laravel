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
	                <li class="active"> Bill of Entry </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content"> 
	            <div class="page-header">
	                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Bill of Entry </small></h1>
	            </div>
	            <!-- 1st ROW -->
                <div class="row">
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')
                    <div id="selectOne"></div> 
                    <div class="panel panel-info">
		             	<div class="panel-heading page-headline-bar"><h5> Bill of Entry <a href="{{ url('commercial/import/billofentry_list') }}" class="btn btn-info btn-sm pull-right">List of Bill Entry</a></h5> </div>
		         	</div>                   
					<form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/billofentry') }}">
						{{ csrf_field() }}
	                    <div class="col-sm-12">
	                    	<div class="col-sm-2">
	                			<label class="col-sm-4 control-label no-padding" for="cm_file_id" > File No<span style="color: red">&#42;</span> </label>
	                            <div class="col-sm-8">
	                                {{ Form::select("cm_file_id", $btbFileList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_file_id', 'placeholder'=>'Select File No']) }}
	                            </div>
	                    	</div>
	                    	<div class="col-sm-2">
	                			<label class="col-sm-4 control-label no-padding" for="cm_lc_no" > L/C No</label>
	                            <div class="col-sm-8">
	                                {{ Form::select("cm_lc_no", $lcNoList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_lc_no', 'placeholder'=>'Select L/C No']) }}
	                            </div>
	                    	</div>
	                    	<div class="col-sm-2">
	                			<label class="col-sm-4 control-label no-padding" for="cm_supplier_id" > Supplier</label>
	                            <div class="col-sm-8">
	                                {{ Form::select("cm_supplier_id", $supplierList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_supplier_id', 'placeholder'=>'Select Supplier',]) }}
	                            </div>
	                    	</div>                     	
							<div class="col-sm-2">
	                			<div class="form-group">
	                                <label class="col-sm-4 control-label no-padding" for="cm_value" > Value</label>
	                                <div class="col-sm-8">
	                                    <input type="text" id="cm_value" name="cm_value" placeholder="" value="" class="col-xs-12 form-control"/>
	                                </div>
	                            </div> 
	                    	</div>
	                    	<div class="col-sm-2">
	                			<label class="col-sm-4 control-label no-padding" for="cm_transport_doc_no"> Transport Doc No</label>
	                            <div class="col-sm-8">
	                                {{ Form::select("cm_transport_doc_no", $lcDocNoList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_transport_doc_no', 'placeholder'=>'Select Transport Doc Number',]) }}
	                            </div>
	                    	</div> 
	                    	<div class="col-sm-2">
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
                    <div class="col-md-offset-2 col-sm-8">
                        <div id="ajax_bill_entry_table"></div>
                    </div>
                </div>
                <!-- end select table -->
                <br><br>
                <!-- 3rd ROW -->
                <div class="row" id="billEntryForm"></div>
	        </div><!-- /.page-content -->
	    </div>
	</div> 

@push('js')
	<script type="text/javascript">
		function ajax_loader_fn() {
			var loaderPath = "{{asset('assets/rubel/img/loader.gif')}}";
			$("#ajax_bill_entry_table").html('<div class="loader-cycle text-center"><img src="'+loaderPath+'" /></div>');
			$('html, body').animate({
	            scrollTop: $("#ajax_bill_entry_table").offset().top
	        }, 2000);
		}
		
		$('#valueSearch').on('click', function() {			
			var file_no = $('#cm_file_id').val();
			var lc_no = $('#cm_lc_no').val();
			var supplier = $('#cm_supplier_id').val();
			var value = $('#cm_value').val();
			var doc_no = $('#cm_transport_doc_no').val();
			if(file_no != '' || lc_no != '' || supplier != '' || value != '' || doc_no != '') {
				$('#selectOne').html('');
				$('#billEntryForm').html('');
				$('#ajax_bill_entry_table').html('');
				ajax_loader_fn();
				setTimeout(() => {
					$.ajax({
						url: '{{ url('commercial/import/billofentry_fetchbtbdata') }}',
						type: 'POST',
						datatype: 'json',
						data: {'file_no': file_no, 'lc_no': lc_no, 'supplier': supplier, 'value': value, 'doc_no': doc_no},
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						success: function (res) {
							$('#ajax_bill_entry_table').html(res.result);
						}
					});
				}, 1000);
			} else {
				$('#ajax_bill_entry_table').html('');
				$('#billEntryForm').html('');
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
				url: '{{ url('commercial/import/billofentry_fetchlcsup') }}',
				type: 'POST',
				datatype: 'json',
				data: {'file_id': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					$('#cm_lc_no').html(res.lc);
					$('#cm_supplier_id').html(res.supplier);
				}
			})
		});
		// lc fetch data
		$('#cm_lc_no').on('change', function() {
			$.ajax({
				url: '{{ url('commercial/import/billofentry_fetchsup') }}',
				type: 'POST',
				datatype: 'json',
				data: {'lc_id': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					$('#cm_supplier_id').html(res.supplier);
				}
			})
		});		
	</script>
@endpush
@endsection