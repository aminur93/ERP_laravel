@extends('merch.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li> 
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Time and Action</a>
				</li>  
				<li class="active">Time and Action Due Report</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<label class="col-sm-3 control-label no-padding-right ">Order</label>
						<div class="col-sm-9 col-xs-12">
							<select id="order_selection" name="order_selection" class="order_selection" style="width: 80%;">
								<option value="" selected="selected">Select Order</option>
								@if($orders)
								 @foreach($orders as $odr)
								   <option value="{{$odr->order_id }}">{{$odr->order_code}}</option>
								 @endforeach	
								@else
									No Orders in T&A 
								@endif
							</select>
						</div>

						<label class="col-sm-3 control-label no-padding-right " style="margin-top: 20px;">Action</label>
						<div class="col-sm-9 col-xs-12" style="margin-top: 20px;">
							<select id="action_selection" name="action_selection" class="action_selection" style="width: 80%;">
								<option value="" selected="selected">Select Action</option>
								@if($tna_actions)
								 @foreach($tna_actions as $action)
								   <option value="{{$action->id }}">{{$action->tna_lib_action}}</option>
								 @endforeach
								@else
									No Actions in T&A library 
								@endif
							</select>
						</div>

						<label class="col-sm-3 control-label no-padding-right " style="margin-top: 20px;">Delivery Date</label>
						<div class="col-sm-9 col-xs-12" style="margin-top: 20px;">
							<input type="date" class="from_date" name="from_date" id="from_date" {{-- data-validation="required" --}} >
							<span> To <span style="padding-right:20px;"></span>
								{{-- &nbsp&nbsp&nbsp&nbsp&nbsp --}}
							<input type="date" class="to_date" name="to_date" id="to_date" {{-- data-validation="required" --}}  > </span>
						</div>
					</div>
					<div class="row" style="margin-top: 20px;">
							<button class="btn btn-primary btn-xs searchButton pull-right" style="margin-right: 16%;">Search</button>	
					</div>
					
				</div>
			</div>

			{{-- Table view --}}

			<div class="row" style="margin-top: 20px;">
				  <div class="col-sm-12 table-responsive" >
                        <table id="dataTables_tna_report" class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <th>Buyer</th>
                                <th>Order
                                	<span style="padding-left:80px;"></span>
                                    Ref
                                </th>
                                <th>Qty</th>
                                <th>SL) Action</th>
                                <th>Calender DT</th>
                                <th>Actual DT</th>
                            </thead>
                            <tbody id="result_tbody" name="result_tbody" class="result_body">
                            	
                            	
                            </tbody>
                        </table>
                   </div>
			</div>

		</div>  {{-- Page content end --}}
	</div>  {{-- Main content inner end --}}
</div>   {{-- Main content end --}}

<script type="text/javascript">
    $(document).ready(function() {
        //Showing data table
         $('#dataTables_tna_report').DataTable({
            "scrollY": true,
            "scrollX": true
            });

         // Searching for result..
          $('body').on('click','.searchButton',function(){
                var order_id 		= $( "#order_selection" ).val();
                var tna_action_id 	= $( "#action_selection" ).val();
                var from_date		= $('#from_date').val();
                var to_date 		= $('#to_date').val();
                console.log('order_id:',order_id, 'tna_action_id:',tna_action_id, 'from_date:',from_date, 'to_date:',to_date);
                var tr = '<tr>\
                			<td>LOADING....</td>\
                			<td>LOADING....</td>\
                			<td>LOADING....</td>\
                			<td>LOADING....</td>\
                			<td>LOADING....</td>\
                			<td>LOADING....</td>\
                		 </tr>'
                $('#result_tbody').html(tr);

                // internal ajax call
	                $.ajax({
	                	url: "{{url('merch/report/tna_report_ajax_call') }}",
	                	type: 'GET',
	                	dataType: 'json',
	                	data: {order_id: order_id, tna_action_id: tna_action_id, from_date: from_date, to_date: to_date, _token: '{{csrf_token()}}'},
	                	success: function(result){
	                			console.log(result.length);
	                			console.log(result);
	                			if( result.length == 1 ){
	                				var tr = 'No Result Found';
	                				$('#result_tbody').html(tr);
	                			}
	                			else if(!('action' in result)) {
	                				var tr = 'Action Not Found';
	                				$('#result_tbody').html(tr);	
	                			}
	                			else{
	                				var tr='';
	                				for(var i=0; i<result['order'].length; i++){
	                					 tr += '<tr>\
					                            	   <td>'+result['buyer'][i]+'</td>\
					                            	   <td>'+result['order'][i]+
					                            	   		'<span style="padding-left:68px;"></span>'
					                            	        +result['order_reference'][i]+
					                            	  '</td>\
					                            	   <td>'+result['order_qty'][i]+'</td>';

						                        tr += '<td>';    			
						                        for(var j=0; j<result['action'][result['order'][i]].length; j++){
						                        	tr +=  '<div style="border: 1px ;">'+(j+1)+')&nbsp&nbsp&nbsp'+result['action'][result['order'][i]][j]+'</div><br>';
						                        }
						                        tr += '</td>\
						                        	   <td>';		
						                        for(var j=0; j<result['action'][result['order'][i]].length; j++){
						                        tr += '<div style="border: 1px ;">'+ result['calender_date'][result['order'][i]][j]+'</div><br>';
						                        }
						                        tr += '</td>\
						                        	   <td>';		
						                        for(var j=0; j<result['action'][result['order'][i]].length; j++){
						                        	tr += '<div style="border: 1px;">'+ result['actual_date'][result['order'][i]][j]+'</div><br>';
						                        }
						                        tr += '</td>\
				                        		</tr>';		
	                				}

	                				$('#result_tbody').html(tr);
	                			}

	                					
	                	},
	                	error: function(data){
	                		    console.log(data);
	                	}
	                });

          });
        
    });
</script>

@endsection