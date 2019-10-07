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
				    <a href="#"> Export </a>
				</li>
				<li>
					<a href="#"> Export PRC</a>
				</li>
			</ul><!-- /.breadcrumb -->
			</div>

			<div class="page-content"> 
				<div class="page-header">
					<h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i>Export PRC Correction</small></h1>
				</div>
				<!-- 1st ROW -->
				<div class="row">
					@include('inc/message')
					<div class="panel panel-default" style="width: 80%; margin-left: 10%;">
						  <div class="panel-heading"><h5>All Invoice List</h5> </div>
						  <div class="panel-body">
						  	 <table id="dataTables_export_prc_correction" 
						  	               class="table table-striped table-bordered" style="width:100%;">
	                            <thead>
	                                <th>SE. NO.</th>
	                                <th>File No.</th>
	                                <th>Invoice No.</th>
	                                <th>Value</th>
	                                <th>Reimbursement Value</th>
	                                <th>Transport Doc Shipped Date</th>
	                                <th>Action</th>
	                            </thead>
	                            <tbody>
	                            	@if($exp_entry_data)
	                            		@foreach($exp_entry_data as $exp)
	                            			<tr>
	                            				<td>{{ $loop->index+1 }}</td>
	                            				<td class="file_no_id" >{{$exp->file_no}} 
	                            					<input type="hidden" name="f_id" id="f_id" class="f_id" value="{{ $exp->cm_file_id }}">
	                            				</td>
	                            				<td class="invoice_no">{{ $exp->inv_no }} </td> 
	                            				<td class="invoice_value">{{$exp->inv_value }} </td>
	                            				
	                            				<td class="reimb_value" style="margin-left: 0%; margin-right: 0%;">
	                            					@if(is_null($exp->remburse_value) )
	                            						<input type="number" name="reimb_value_input" id="reimb_value_input" class="reimb_value_input" default="0" placeholder="enter" style="width: 100%;"/>
	                            					@else
	                            						<input type="number" name="reimb_value_input" id="reimb_value_input" class="reimb_value_input" value="{{$exp->remburse_value }}" {{-- readonly="readonly" --}} style="width: 100%;" />
	                            					@endif 
	                            				</td>
	                            				<td class="tdoc_shipped_date" style="margin-left: 0%; margin-right: 0%;">
	                            					{{-- <input type="date" name="tdoc_shipped_date" id="tdoc_shipped_date" class="tdoc_shipped_date" value="{{$exp->transp_doc_date }}" readonly="readonly" 
	                            					style="width: 100%;"/> --}}
	                            					{{$exp->transp_doc_date }}
	                            				</td>
	                            				<td >
	                            					@if( is_null($exp->remburse_value) )
	                            						<button class="btn btn-info btn-sm saveButton"  
	                            						         style="font-size: 11px;">Save</button>
	                            					@else
	                            						<button class="btn btn-info btn-sm editButton" style="font-size: 11px;">Update</button>
	                            						<a href="{{ url('commercial/export/export_prc_correction_delete/'.$exp->prc_id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
	                            						
	                            						<input type="hidden" class="prc_id" id="prc_id" name="prc_id" 
	                            								value="{{ $exp->prc_id }}">
	                            					@endif

	                            					
	                            				</td>

	                            			</tr>
	                            		@endforeach
	                            	@else
	                            		No data Found
	                            	@endif
	                            </tbody>
						  		
						  	</table>
						  </div>
					</div>

			    </div>

			</div>  {{-- page content end --}}



		</div> {{-- Main content inner end --}} 
	</div>   {{-- Main content end --}}


<script type="text/javascript">
$(window).load(function() {
		//Data table
		 $('#dataTables_export_prc_correction').DataTable({
            "scrollY": true,
            "scrollX": true
            });
        

		//Save
		$('body').on('click', '.saveButton', function(){
				var parent = $(this).parent().parent();
				// console.log(parent.html());
				var file_no_id 		= parent.find('.f_id').val();
				console.log('File ID: ', file_no_id);
				var invoice_no 		= parent.find('.invoice_no').text();
				var invoice_value 	= parent.find('.invoice_value').text();
				var reimb_value 	= parent.find('.reimb_value_input').val();
				
				console.log('Reim val: ', reimb_value);
				if(reimb_value==null || reimb_value=="" ){ alert("Please insert Reimbursement Value");}
				else{ 
						$.ajax({
									url: "{{url('commercial/export/export_prc_correction_save')}}",
									type: 'GET',
									dataType: 'json',
									data: {file_no_id: file_no_id, invoice_no: invoice_no, invoice_value: invoice_value, reimb_value: reimb_value, 
									              _token: '{{csrf_token()}}' },

								success: function(data){
									// alert('Successfully Added');
									alert(data);
								},
								error: function(data){
									alert('Something is wrong!');
								},
								
					    });
			         }
				
		});

		//Update
		$('body').on('click', '.editButton', function(){
				var parent = $(this).parent().parent();
				// console.log(parent2.html());
				var reimb_value 	= parent.find('.reimb_value_input').val();
				var prc_id			= parent.find('.prc_id').val();
				console.log('Reim val: ', reimb_value);
				if(reimb_value==null || reimb_value=="" ){ alert("Please insert Reimbursement Value");} 
				else{
						$.ajax({
									url: "{{url('commercial/export/export_prc_correction_update')}}",
									type: 'GET',
									dataType: 'json',
									data: {prc_id: prc_id, reimb_value: reimb_value,  _token: '{{csrf_token()}}' },

								success: function(data){
									// alert('Successfully Added');
									alert(data);
								},
								error: function(data){
									alert('Something is wrong!');
								},
								
					    });
					}
		});


});  //window-end
	
</script>
@endsection
