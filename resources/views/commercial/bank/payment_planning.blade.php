@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Commercial</a>
                </li>
                <li> 
                    <a href="#">Bank</a>   
                </li> 
                <li class="active">Payment Planning</li>
            </ul><!-- /.breadcrumb -->
        </div>
        {{-- page content --}}
        @include('inc.message')
        <div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Payment Planning 
                </small></h1>
            </div>

            <div id="export_bills" style="border: 1px solid;">
            	 {{-- <form name="export_form" href="commercial/bank/postExportBills"> --}}
                {{Form::open(["url"=>"commercial/bank/postExportBills", "class"=>"form-horizontal"])}}
                <div class="row" >   
                  <div class="col-sm-4" style="margin-left: 10px;">
                    <h4>Export Bills</h4>
                  </div>
                </div>
                <br>

            <div class="row">
                
                    <div class="col-sm-6">
                        <label class="col-sm-4 control-label no-padding-right align-left  " for="file_no_id"  >File No.</label>
                        <div class="col-sm-6" style="margin-bottom: 20px;">
                         <select id="file_no_id" name="file_no_id" class="col-xs-12 file_no_id">
                            <option value="">Select File No.</option>
                            @foreach($file_id as $fi)
                            <option value="{{$fi->cm_file_id}}" >{{$fi->file_no}}</option>
                            @endforeach
                         </select>
                        </div>
                        <input type="hidden" name="hidd_file_id" id="hidd_file_id">
                    </div>       
                
               
            </div>  {{-- end row --}}

            				<div class="space-10"></div>

				            <div id='search_result' class="row"  style="margin-left: 185px">
				                <div class="col-sm-10 table-responsive">
				                  <table class="table table-bordered table-striped" id="billtable" name="billtable">
				                    <thead> 
                                <th>Invoice No</th>                      
				                        <th>Invoice Date</th>
				                        <th>Bill No.</th>
				                        <th>Bill Date</th>
				                        <th>Value($)</th>
				                        <th>Pcs</th>
				                        <th></th>
                                <th></th>


				                    </thead>
				                    
				                    	<tbody class="add_exp_bill" id="add_exp_bill">  
                                        <tr class="tr_clone">
                                          <td>
                                            <select id="invoice_no" name="invoice_no" class="no-select invoice_no">
                                            <option value="">Select Invoice</option>
                                            </select>
                                          </td>
                                          <td> 
                                            <input type="date" name="invoice_date" value="" placeholder="" readonly="readonly" class="form-control invoice_date">
                                          </td>
                                          <td> 
                                            <input type="text" name="exp_bill_no" value="" placeholder="" readonly="readonly" class="form-control exp_bill_no">
                                          </td>
                                          <td>
                                             <input type="date" name="bill_date" value="" placeholder="" readonly="readonly" class="form-control bill_date">
                                          </td>
                                          <td>
                                             <input type="number" id="exp_value" name="exp_value[]" placeholder="" readonly="readonly" class="form-control exp_value">
                                          </td>
                                          <td>
                                            <input type="text" name="pcs" value="" placeholder="" readonly="readonly" class="form-control pcs">
                                          </td>
                                          
                                            {{-- <input type="text" name="rand" value="{{rand(100,999)}}"> --}}
                                          
                                           <td>
                                            <button type="button" class="btn btn-sm btn-success add_exp_bill_row" style="padding: 2px;">+</button>
                                           </td> 

                                           <td>
                                            <button type="button" class="btn btn-sm btn-danger remove_exp_bill_row" style="padding: 3.5px;">-</button>
                                            </td>
                                             
                                          
                                        </tr>                        
                                       
                                                                
                                     </tbody>
				                    
				                </table>
				              </div>
				        	</div>


						    <div class="row" style="margin-left: 300px">
		                
		                    <div class="col-sm-6">
		                        <label class="col-sm-7 control-label no-padding-right align-left  " for="file_no_id"  >Total Amount ($)</label>
		                        <div class="col-sm-5" style="margin-bottom: 20px;">
		                         <input id="total_amount" type="number" name="total_amount" value="" placeholder="" class="total_amount" readonly="readonly">
		                        </div>
		                    </div>       
		                
		               
		            		</div>

		            		<div class="row" style="margin-left: 300px">
		                
		                    <div class="col-sm-6">
		                        <label class="col-sm-7 control-label no-padding-right align-left  " for="file_no_id"  >Previous DAD amount of this file</label>
		                        <div class="col-sm-5" style="margin-bottom: 20px;">
		                         <input type="text" name="dad_amount" value="" placeholder="" class="dad_amount" readonly="readonly">
		                        </div>
		                    </div>       
		                
		               
		            		</div>

		            		<div class="row" style="margin-left: 300px">
		                
		                    <div class="col-sm-6">
		                        <label class="col-sm-7 control-label no-padding-right align-left  " for="file_no_id"  >Other files DAD balance</label>
		                        <div class="col-sm-5" style="margin-bottom: 20px;">
		                         <input type="text" name="dad_balance" value="" placeholder="" class="dad_balance" readonly="readonly">
		                        </div>
		                    </div> 
		                    {{--<div class="col-sm-2">
                 
                    		<button id="export_submit" type="submit" class="btn btn-sm btn-info pull-right">Save</button>
                  
                			</div> --}}     
		                
		               
		            		</div>	
                  </form>
           
           </div>

           		<div class="space-10"></div>

           		<div id="import_bills" style="border: 1px solid;">
            	   {{Form::open(["url"=>"commercial/bank/postImportBills", "class"=>"form-horizontal"])}}
                	<div class="row" >   
	                  <div class="col-sm-4" style="margin-left: 10px;">
	                    <h4>Import Bills</h4>
	                  </div>
                    <div>
                      <input type="hidden" name="hidd_file_id2" id="hidd_file_id2" value="">
                    </div>
                	</div>
                <br>

                

				            <div id='search_result' class="row"  style="margin-left: 10px">
				                <div class="col-sm-9 table-responsive">
				                  <table class="table table-bordered table-striped" id="billtable" name="billtable">
				                    <thead>                       
				                        <th>Tdoc Number</th>
				                        <th>Bill No.</th>
				                        <th>Arrival Date</th>
				                        <th>Due Date</th>
				                        <th>Value($)</th>
				                        <th></th>
                                <th></th>

				                    </thead>
				                    
				                    	<tbody id="add_imp_bill">  
                                        <tr class="imp_table">
                                          <td> 
                                            <select id="tdoc_number" name="tdoc_number" class=" no-select tdoc_number">
				                            <option value="">Select Number</option>
                                    {{--@foreach($tdoc as $td)
                                        <option value="{{$td->id}}" >{{$td->transp_doc_no1}}</option>
                                    @endforeach--}}
				                            
				                         	</select>
                                          </td>
                                          <td> 
                                            <select id="imp_bill_no" name="imp_bill_no" class="no-select imp_bill_no">
				                            <option value="">Select Bill No</option>
				                            
				                         	</select>
                                          </td>
                                          <td>
                                             <input type="date" name="arrival_date[]" value="" placeholder="" readonly="readonly" class="form-control arrival_date">
                                          </td>
                                          <td>
                                             <input type="date" name="due_date[]" value="" placeholder="" readonly="readonly" class="form-control due_date">
                                          </td>
                                          <td>
                                            <input type="number" name="imp_value[]" value="" placeholder="" readonly="readonly" class="form-control imp_value">
                                          </td>
                                         
                                          <td>
                                            <button type="button" class="btn btn-sm btn-success add_imp_bill_row" style="padding: 2px;">+</button>
                                          </td>
                                          <td>
                                            <button type="button" class="btn btn-sm btn-danger remove_imp_bill_row" style="padding: 3.5px;">-</button>
                                             

                                          </td>
                                        </tr>                        
                                       
                                                                
                                     </tbody>
				                    
				                </table>


				              </div>
				              <div class="col-sm-3" >
				                	<div class="row" style="margin-left: 20px;">
				                		<button type="button" class="btn btn-sm btn-info">Calculation Print</button>
				                	</div>
				                	<br>
				                	<div class="row" style="margin-left: 20px;">
				                		<button type="button" class="btn btn-sm btn-info">Letter Print</button>
				                	</div>
				                	<br>
				                	<div class="row" style="margin-left: 20px;">
				                		<button type="button" class="btn btn-sm btn-info">Mismatch Payment</button>
				                	</div>
				                </div>


				         <div class="row" style="margin-left: 200px">
		                
		                    <div class="col-sm-6">
		                        <label class="col-sm-6 control-label no-padding-right align-left  " for="file_no_id"  >Total Amount ($)</label>
		                        <div class="col-sm-6" style="margin-bottom: 20px;">
		                         <input id="total_imp_amount" type="number" name="total_imp_amount" value="" readonly="readonly" class="total_imp_amount">
		                        </div>
		                    </div> 
		                     
                		</div>    
                		<div class="col-sm-8">
                 
                    		<button id="search_button" type="submit" class="btn btn-sm btn-info pull-right">Save</button>
                  
                		</div> 



				        	</div>

<br>
              </form>
            	</div>


    	</div>
	</div>
</div>



<script type="text/javascript">
              $(document).ready(function() {

                    $('body').on('change','.file_no_id', function(){
                    //$('#file_no_id').change(function() {
                     // alert("jgkj");
                     var rand_val=Math.floor(Math.random(100) * 999);
                        var tr='<tr class="tr_clone">\
                                          <td>\
                                            <select id="invoice_no" name="invoice_no" class="no-select invoice_no">\
                                            <option value="">Select Invoice</option>\
                                            </select>\
                                          </td>\
                                          <td> \
                                            <input type="date" name="invoice_date" value="" placeholder="" readonly="readonly" class="form-control invoice_date">\
                                          </td>\
                                          <td> \
                                            <input type="text" name="exp_bill_no" value="" placeholder="" readonly="readonly"  class="form-control exp_bill_no">\
                                          </td>\
                                          <td>\
                                             <input type="date" name="bill_date" value="" placeholder="" readonly="readonly"  class="form-control bill_date">\
                                          </td>\
                                          <td>\
                                             <input type="number" id="exp_value" readonly="readonly" name="exp_value[]" class="form-control exp_value">\
                                          </td>\
                                          <td>\
                                            <input type="text" name="pcs" value="" placeholder="" readonly="readonly" class="form-control pcs">\
                                          </td>\
                                          <td>\
                                            <input type="hidden" name="rand"  id="rand" value="'+rand_val+'">\
                                            <button type="button" class="btn btn-sm btn-success add_exp_bill_row" style="padding: 2px;">+</button></td>\
                                            <td>\
                                            <button type="button" class="btn btn-sm btn-danger remove_exp_bill_row" style="padding: 3.5px;">-</button>\
                                          </td>\
                                        </tr>';
                        var tr2='<tr class="imp_table">\
                                          <td> \
                                            <select id="tdoc_number" name="tdoc_number" class=" no-select tdoc_number">\
                                    <option value="">Select Number</option>\
                                    {{--@foreach($tdoc as $td)\
                                        <option value="{{$td->id}}" >{{$td->transp_doc_no1}}</option>\
                                    @endforeach\--}}\
                                    \
                                  </select>\
                                          </td>\
                                          <td> \
                                            <select id="imp_bill_no" name="imp_bill_no" class="no-select imp_bill_no">\
                                    <option value="">Select Bill No</option>\
                                    \
                                  </select>\
                                          </td>\
                                          <td>\
                                             <input type="date" name="arrival_date[]" value="" placeholder="" readonly="readonly"  class="form-control arrival_date">\
                                          </td>\
                                          <td>\
                                             <input type="date" name="due_date[]" value="" placeholder="" readonly="readonly"  class="form-control due_date">\
                                          </td>\
                                          <td>\
                                            <input type="number" name="imp_value[]" value="" placeholder="" readonly="readonly"  class="form-control imp_value">\
                                          </td>\
                                         \
                                          <td>\
                                          <input type="hidden" name="rand2"  id="rand2" value="'+rand_val+'">\
                                            <button type="button" class="btn btn-sm btn-success add_imp_bill_row" style="padding: 2px;">+</button></td>\
                                            <td>\
                                            <button type="button" class="btn btn-sm btn-danger remove_imp_bill_row" style="padding: 3.5px;">-</button>\
                                          </td>\
                                        </tr>';
                        $('#add_imp_bill').html(tr2);
                        $('#add_exp_bill').html(tr);
                        // $('.invoice_no').empty();
                        var file_no_id = $(this).val();
                        
                        $.ajax({
                              type: 'get',
                              url: "{{url('commercial/bank/invoiceID')}}",
                              dataType: 'json',
                              data: { file_no_id : file_no_id, _token: '{{csrf_token()}}' },
                                  
                              success: function(data){
                                    // alert("success")
                                      //console.log('SUCCESS: ', data);
                                  document.getElementById("hidd_file_id").value = file_no_id;
                                  document.getElementById("hidd_file_id2").value = file_no_id;   
                                    $('.invoice_no').html('<option value="">Select Invoice No</option>');
                                        for(i=0; i<data['invoice'].length;i++)
                                          {
                                          $(".invoice_no").append('<option value="'+data['invoice'][i]+'">'+data['invoice'][i]+'</option>');
                                          }
                                    $('.tdoc_number').html('<option value="">Select Tdoc No</option>');
                                        for(i=0; i<data['trans_doc_id'].length;i++)
                                          {
                                          $(".tdoc_number").append('<option value="'+data['trans_doc_id'][i]+'">'+data['trans_doc_no'][i]+'</option>');
                                        }

                                    },
                              error: function(data){
                              alert('failed');
                               //console.log('ERROR: ', data);
                                  },

                            });

                         });
             

                    
                    $('body').on('change','.invoice_no', function(){
                    //$('.invoice_no').change(function() {
                    
                        //$('#invoice_no').empty();

                        var invoice_no = $(this).val();
                        var parent= $(this).parent().parent();
                        var file_id = document.getElementById("hidd_file_id").value;
                         //console.log(parent.html());
                        $.ajax({
                              type: 'get',
                              url: "{{url('commercial/bank/getExpData')}}",
                              dataType: 'json',
                              data: {file_no_id: file_id ,invoice_no : invoice_no, _token: '{{csrf_token()}}' },
                                  
                              success: function(data){
                                    // alert("success")
                                     // console.log('SUCCESS: ', data.inv_date);
                                     //console.log(data);
                                     parent.find('.invoice_date').val(data.inv_date);
                                     parent.find('.exp_bill_no').val(data.bill_no);
                                     parent.find('.bill_date').val(data.bill_date);
                                     parent.find('.exp_value').val(data.value);
                                     parent.find('.pcs').val(data.pcs);
                                     $('.dad_amount').val(data.dad_amount);
                                     $('.dad_balance').val(data.other_dad_amount);
                                     totalValues();

                                     //console.log(data);

                                    },
                              error: function(data){
                              alert('failed');
                               //console.log('ERROR: ', data);
                                  },

                            });

                         });


                    $('body').on('change','.tdoc_number', function(){
                    //$('#file_no_id').change(function() {
                     // alert("jgkj");
                     //var rand_val=Math.floor(Math.random(100) * 999);
          
                        var tdoc_number = $(this).val();
                        var parent= $(this).parent().parent();
                        
                        $.ajax({
                              type: 'get',
                              url: "{{url('commercial/bank/getBill')}}",
                              dataType: 'json',
                              data: { tdoc_number : tdoc_number, _token: '{{csrf_token()}}' },
                                  
                              success: function(data){
                                    // alert("success")
                                      //console.log('SUCCESS: ', data);
                                  //document.getElementById("hidd_file_id").value = file_no_id;  
                                    parent.find('.imp_bill_no').html('<option value="">Select Bill No</option>');
                                        for(i=0; i<data.length;i++)
                                          {
                                          parent.find(".imp_bill_no").append('<option value="'+data[i]+'">'+data[i]+'</option>');
                                          }
                                        

                                    },
                              error: function(data){
                              alert('failed');
                               //console.log('ERROR: ', data);
                                  },

                            });

                         });

                    $('body').on('change','.imp_bill_no', function(){
                    //$('.invoice_no').change(function() {
                    
                        //$('#invoice_no').empty();

                        var imp_bill_no = $(this).val();
                        var tdoc_number=$(this).parent().parent().find(".tdoc_number").val();
                        var parent= $(this).parent().parent();
                        //var file_id = document.getElementById("hidd_file_id").value;
                         //console.log(parent.html());
                        $.ajax({
                              type: 'get',
                              url: "{{url('commercial/bank/getImpData')}}",
                              dataType: 'json',
                              data: {tdoc_number:tdoc_number,imp_bill_no: imp_bill_no, _token: '{{csrf_token()}}' },
                                  
                              success: function(data){
                                    // alert("success")
                                     // console.log('SUCCESS: ', data.inv_date);
                                     //console.log(data);
                                     parent.find('.due_date').val(data.due_date);
                                     parent.find('.imp_value').val(data.imp_value);
                                     
                                     totalImpValues();

                                     //console.log(data);

                                    },
                              error: function(data){
                              alert('failed');
                               //console.log('ERROR: ', data);
                                  },

                            });

                         });




                    function totalValues(){

                      var total=0;
                      var list = [];
                      var num = document.getElementsByClassName("exp_value");
                      for (var i = 0; i < num.length; i++) {
                        // list.push($('.exp_value').val());  
                        list.push(parseFloat(num[i].value));  
                      }
                      
                      //console.log(list);
                      find_total = list.reduce(function(a,b){return (a + b);});

                      //console.log(find_total);

                      document.getElementById("total_amount").value =  find_total;
                      
                  }

                  function totalImpValues(){

                      var total=0;
                      var list = [];
                      var num = document.getElementsByClassName("imp_value");
                      for (var i = 0; i < num.length; i++) {
                        // list.push($('.exp_value').val());  
                        list.push(parseFloat(num[i].value));  
                      }
                      
                      //console.log(list);
                      find_total = list.reduce(function(a,b){return (a + b);});

                      //console.log(find_total);

                      document.getElementById("total_imp_amount").value =  find_total;
                      
                  }

       

    var data1 = $(".add_exp_bill").html();
    $('body').on('click', '.add_exp_bill_row', function(){
        var $tr    = $(this).closest('.tr_clone');
        var $clone = $tr.clone();
        $clone.find('.invoice_date').val('');
        $clone.find('.exp_bill_no').val('');
        $clone.find('.bill_date').val('');
        $clone.find('.exp_value').val('');
        $clone.find('.pcs').val('');

        $tr.after($clone);
    });

    $('body').on('click', '.remove_exp_bill_row', function(){
        $(this).parent().parent().remove();
        totalValues();
    });

    var data2 = $("#add_imp_bill").html();
    $('body').on('click', '.add_imp_bill_row', function(){
        var $tr    = $(this).closest('.imp_table');
        var $clone = $tr.clone();
        $clone.find('.tdoc_number').val('');
        $clone.find('.imp_bill_no').val('');
        $clone.find('.arrival_date').val('');
        $clone.find('.due_date').val('');
        $clone.find('.imp_value').val('');

        $tr.after($clone);
    });

    $('body').on('click', '.remove_imp_bill_row', function(){
        $(this).parent().parent().remove();
        totalImpValues();
    });

});

    
</script>
@endsection


