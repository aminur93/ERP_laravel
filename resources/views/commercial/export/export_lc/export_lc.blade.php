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
                    <a href="#">Export </a>   
                </li> 
                <li class="active">Export L/C Entry</li>
            </ul><!-- /.breadcrumb -->
        </div>

          <div class="page-content"> 
            <div class="page-header row">
                <div class="col-sm-10 no-padding">
                    <h1 class="no-margin">Commercial <small><i class="ace-icon fa fa-angle-double-right"></i> Export L/C Entry  </small> </h1>
                </div>
                <div class="col-sm-2 no-padding">
                    <a href="{{ url('/commercial/export/exportlclist') }}" class="btn btn-primary btn-sm pull-right" role="button" aria-disabled="true">Export L/C Entry List</a>
                </div>                
            </div>
            <form class="form-horizontal" role="form" method="post" action=" {{ url('commercial/exportlc/store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                      @include('inc/message')
                            
                        <div class="col-md-4 ">

                            <div class="form-group ">
                                <label class="col-sm-6 control-label no-padding-right font-weight-bold" for="unit">Unit:<span style="color: red">&#42;</span> </label>
                              
                                <div class="col-sm-6">
                                  {{ Form::select('unit', $unit, null, ['placeholder'=>'Select','id'=>'unit','class'=> 'form-control col-xs-10', 'data-validation' =>'required']) }}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="form-check-label col-sm-6 control-label no-padding-right" for="cmpc" >LC Type:<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-6">  
                                  <input type="radio" class="form-check-input lctype" id="lctype" name="lctype" value="ELC" data-validation ="required"> ELC<br/>
                                    <input type="radio" class="form-check-input lctype" name="lctype" value="Contract"data-validation ="required"> Contract
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="exlc_contract_no" >Export LC / Contract No.:  <span style="color: red">&#42;</span></label>
                                <div class="col-sm-6">
                                <select name="exlc_contract_no" id="exlc_contract_no" class="form-control"> <option>Please Select LC Type</option></select>
                              
                                </div> 
                            </div>
                            <div class="form-group ">
                                <label class=" col-sm-6 control-label no-padding-right" for="product" >File No.: <span style="color: red">&#42;</span></label>
                              
                                  <div class="col-sm-6">
                                      <input type="text" name="fileno"  value="" placeholder="Enter" class=" form-control"  data-validation ="required" />
                                  </div>                                      
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="exp_date" >Expire Date: </label>
                                <div class="col-sm-6">
                                  <input type="text" name="exp_date" id="exp_date" value=""placeholder="Enter" class=" form-control datepicker" readonly="readonly"/>
                                </div> 
                            </div>

                            
                        <!--     <div class="form-group ">
                                <label class="col-sm-6 control-label no-padding-right" for="contract_no" >Contract Number by:<span style="color: red">&#42;</span></label>
                                <div class="col-sm-6">
                                {{ Form::select('contract_no', array('In House'=>'In House', 'Buyer'=>'Buyer'), null, ['placeholder'=>'Select','id'=>'c_number_by','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                                
                              </div>
                                    
                            </div> -->
                        </div>
                        <div class="col-md-4">
                            
                              <div class="form-group ">
                                <label class=" col-sm-6 control-label no-padding-right" for="product" >Buyer: <span style="color: red">&#42;</span></label>
                              
                                  <div class="col-sm-6">
                                  
                                      <input type="text" name="buyer1" readonly="readonly" id="buyer" class="form-control col-xs-10" value="">

                                      <input type="hidden" name="buyer" readonly="readonly" id="buyer_id" class="form-control col-xs-10" value="">
                                  </div>
                                
                            </div>
                          
                            <div class="form-group ">
                                <label class="col-sm-6 control-label no-padding-right" for="contract_qty" >Contract Qty: <span style="color: red">&#42;</span></label>
                                  <div class="col-sm-6">
                                    <input type="text" name="contract_qty" id="contract_qty" placeholder="Enter" class=" form-control"  data-validation ="required" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-6 control-label no-padding-right" for="contract_value" >Contract Value: <span style="color: red">&#42;</span></label>
                                  <div class="col-sm-6">
                                    <input type="text" name="contract_value"  value="" id="contract_value" placeholder="Enter" class=" form-control"  data-validation ="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="initial value" >Initial Value: </label>
                                <div class="col-sm-6">
                                    <span class="col-sm-6" style="padding:0px;">
                                      <input type="text" name="initial_value" id="initial_value" value=""placeholder="Enter" class="form-control"  readonly="readonly"/>
                                    </span>  
                                  <!--   {{ Form::select('currency', array('USD'=>'$ USD', 'EUR'=>'€ EUR','GBP'=>'£ GBP','Tk'=>'৳ Tk'), 'USD', ['placeholder'=>'Select','class'=> '', 'data-validation' => 'required']) }} -->
                                    <span class="col-sm-6" style="padding:0px 0px 0px 10px;">
                                      <input type="text" name="currency" readonly="readonly" id="currency" class="form-control" value="" >
                                    </span> 

                                        <!-- <select class="form-control form-field-username form-field-user-edit form-field-users">
    
                                            <option value=""></option>
                                        </select> -->
                                
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="elc_date" >ELC Date: </label>
                                <div class="col-sm-6">
                                  <input type="text" name="elc_date" id="elc_date" value=""placeholder="Enter" class=" form-control datepicker" readonly="readonly" />
                                </div> 
                            </div>
                            

                        </div>
                        <div class="col-md-4 ">
                          <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="lc_bank" >LC Open Bank: </label>
                                <div class="col-sm-6">
                                
                                  <input type="text" name="lc_bank" readonly="readonly" id="lc_bank" class="form-control " value="" data-validation ="required">
                                    <!--{{ Form::select('lc_bank', $bank, null, ['placeholder'=>'Select', 'id'=>'lc_bank', 'class'=> 'form-control', 'data-validation' => 'required']) }} -->
                                
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="initial value" >BTB Bank: </label>
                                <div class="col-sm-6">
                                  
                                  <input type="text" name="btb_bank1" readonly="readonly" id="btb_bank" class="form-control col-xs-10" value="" data-validation ="required">
                                  <input type="hidden" name="btb_bank" readonly="readonly" id="btb_bank_id" class="form-control col-xs-10" value="" data-validation ="required">
                                </div> 
                            </div>
                          
                            

                            <div class="form-group">
                                        <label class="col-sm-6 control-label no-padding-right" for="remark" >Remarks: </label>
                                        <div class="col-sm-6">
                                          <input type="text" name="remark" id="remark" value=""placeholder="Enter" class=" form-control"/>
                                        </div> 
                                    </div>
                        </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                  <div class="col-md-7 form-horizontal">
                      <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#amendment" aria-expanded="true">Amendment</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#addressbook" aria-expanded="false">Address Book</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Amendment -->
                            <div id="amendment" class="tab-pane fade in active">
                                  <!-- Amendment -->
                            <table  class="table table-responsive table-bordered"  style="table-layout: fixed;">
                                <thead>
                                  <tr>
                                    <th>Amendment No.</th>
                                    <th width="23%">Amendment Date</th>
                                    <th width="23%">Expiry Date</th>
                                    <th>ELC Amount</th>
                                    <th>Total Amount</th>
                                    <th>Remarks</th>
                                    <th width="8%"></th>
                                  <tr>  
                                </thead> 

                                <tbody id="add_amend">  
                                  <tr >
                                    <td style="padding: 0px;"> 
                                      <input type="text" name="amend_no[]" id="amend_no" value=""placeholder="Enter" class="form-control" />
                                    </td>
                                    <td  style="padding: 0px;"> 
                                      <input type="date" name="amend_date[]" value=""placeholder="Enter" class="form-control"/>
                                    </td>
                                    <td  style="padding: 0px;">
                                        <input type="date" name="amend_ex_date[]" value=""placeholder="Enter" class=" form-control"/>
                                    </td>
                                    <td  style="padding: 0px;">
                                        <input type="text" name="elc_ammount[]"  value=""placeholder="Enter" class="form-control elc_ammount"/>
                                    </td>
                                    <td  style="padding: 0px;">
                                      <input type="text" name="elc_total_ammount[]" value=""placeholder="Enter" class="form-control elc_total_ammount" />
                                    </td>
                                    <td  style="padding: 0px;"><input type="text" name="remarks[]" value=""placeholder="Enter" class="col-xs-12 form-control remarks" /></td>
                                    <td  style="padding:3px 0px 0px 5px;">
                                      <button type="button" class="btn btn-sm btn-success AddBtn_amend" style="padding: 2px;">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn_amend" style="padding: 2px;">-</button> 
                                    </td>
                                  </tr>                        
                                </tbody>
                            
                            </table>   
                              
                            </div> 
                    
                            <!-- Address book -->
                        <div id="addressbook" class="tab-pane fade">
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="country" >Country </label>

                          <div class="col-sm-9">
                              {{ Form::select('country', $country, null, ['placeholder'=>'Select','class'=> 'form-control col-xs-12']) }} 

                              </div>
                            </div>

                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="notify_addrss" >Notify Address </label>

                          <div class="col-sm-5">
                            <textarea name="notify_addrss" class="form-control" id="notify_addrss" data-validation=" length" data-validation-length="0-144"> </textarea>
                              </div>
                            </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="buyer_addrss" >Buyer Address </label>

                          <div class="col-sm-5">
                            <textarea name="buyer_addrss" class="form-control" id="buyer_addrss" data-validation="length" data-validation-length="0-144"> </textarea>
                              </div>
                            </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="notify_addrss2" >Notify Address 2</label>

                            <div class="col-sm-5">
                              <textarea name="notify_addrss2" class="form-control" id="notify_addrss2" data-validation=" length" data-validation-length="0-144"> </textarea>
                              </div>
                          </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="notify_addrss3" >Notify Address 3</label>

                            <div class="col-sm-5">
                              <textarea name="notify_addrss3" class="form-control" id="notify_addrss3" data-validation=" length" data-validation-length="0-144"> </textarea>
                              </div>
                          </div>
                          </div> 
                        </div> 
                      </div> 
                  </div>

                    <div class="col-md-5">
                      <div class="" style="margin-top: 20px;">
                        <table  class="table table-responsive table-bordered"   style="table-layout: fixed;">
                            <thead>
                              <tr>
                                <th width="20%">Order Number</th>
                                <th width="20%">Qty</th>
                                <th width="20%">Agent FOB</th>
                                <th width="20%">Value</th>
                              <tr>  
                            </thead> 

                            <tbody id="order_list_des"> 


                            </tbody>
                            <tfoot>
                              <th width="20%" align="right"><b>Total :</b></th>
                              <th colspan="2" >
                                <input type="text" name="total_qty" readonly="readonly" id="total_qty" class="col-sm-6">
                              </th>
                            
                              <th width="20%">
                                <input type="text" name="total_value" readonly="readonly" id="total_value" class="form-control">
                              </th>
                            </tfoot>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="" style="margin-top: 20px;">
                        <table  class="table table-responsive table-bordered" style="table-layout: fixed">
                            <thead>
                              <tr>
                                <th>Style</th>
                                <th>PO</th>
                                <th>Buyer</th>
                                <th>Description</th>
                                <th>Season</th>
                                <!--  <th>Supplier</th> -->
                                <th>Qty(PCS)</th>
                                <th>Ex Factory Date</th>
                                <th>Destination</th>
                                <th>Unit Price/FOB</th>
                                <th>Country Wise FOB</th>
                                <th>Total Value</th>
                              <tr>  
                            </thead> 

                            <tbody id="purchase">                          
                            </tbody>
                      
                        </table>
                      </div>
                    </div>

                </div>                   

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9"> 
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i> Submit
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                        </button>
                        <input type="hidden" name="salescontractid" id="salesid" >
                    </div>
                </div>
            </form>

          </div>      
                <!-- PAGE CONTENT ENDS -->
    </div>
       
</div><!-- /.page-content -->



<script type="text/javascript">
  $(document).ready(function(){ 

  /*
  * BASED ON UNIT
  * -----------------------
  */


 $('.lctype').click(function () {

      var lc  = $(this).val();
      //alert(lc);
      
   
        // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/exportlcnolist') }}",
            type: 'get',
            data: {lc_val:lc},
            success: function(data)
            {
                $("#exlc_contract_no").html(data); 

            },
            error: function()
            {
                alert('failed...');
               
            }
        });
      

    });

 /*
  * BASED ON EXLC No
  * -----------------------
  */

  $("#exlc_contract_no").on("change", function(){ 


      var exid  = $(this).val();
      //alert(exid);      
   
        // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/exportlcinputlist') }}",
            type: 'get',
            data: {ex_id:exid},
            success: function(data)
            {
                $("#buyer").val(data.buyername); 
                $("#buyer_id").val(data.buyerid);
                $("#elc_date").val(data.elcdate); 
                $("#exp_date").val(data.exdate);
                $("#contract_qty").val(data.contractqty);
                $("#contract_value").val(data.contractval);
                $("#initial_value").val(data.initial_val); 
                $("#lc_bank").val(data.lcbank);
                $("#btb_bank").val(data.btbbank);
                $("#btb_bank_id").val(data.btbbankid);
                $("#currency").val(data.currency);
                $("#order_list_des").html(data.orderList);
                $("#total_qty").val(data.sum_qty);
                $("#total_value").val(data.sum_value);
                $("#purchase").html(data.polist);  
                $("#salesid").val(data.salescontractid);   
                $("#remark").val(data.remark);
                $('.form-field-user-edit > option[value="selectedUser"]').attr('selected',true);
                        
              
                
            },
            error: function()
            {
                alert('failed...');
               
            }
        });
      

    });

 /*
  * MODAL ITEM BASED ON BUYER & UNIT
  * -----------------------
  */

  $("#order").on("click", function(){ 
  
      var buyer = $("#buyer").val();  
      var unit  = $("#unit").val();
      //alert(buyer);
      
   
        $.ajax({
            url : "{{ url('commercial/export/sales_contract/getorderlist') }}",
            type: 'get',
            data: {buyer_id:buyer,unit_id:unit},
            success: function(data)
            {
                
                //alert('Success...');
                if(data!=""){ $("#order_list").html(data); }
                else{ $("#order_list").html('<h4>No Order is Found, Please Selet Buyer and Unit Again</h4>'); }
           
            },
            error: function()
            {
                alert('failed...');
               
            }
        });
     

    });

 /*
  * Export LC / Contract No. GENERATE
  * -----------------------
  */

/*  $("#buyer,#c_number_by, #unit").on("change", function(){ 
  //alert('dsfds');
      var buyer = $("#buyer").val();  
      var unit  = $("#unit").val();

      // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/sales_contract/getcontractlist')}}",
            type: 'get',
            data: {b_id:buyer,unit_id:unit},
            success: function(data)
            {
                // Set Contract Value
                  
                 
                 // Get Buyer First 3 character
                  var buyerinput = $("#buyer option:selected").html();
                  var buyer      = buyerinput.trim().replace(/ /g,'');
                  var buyerChar  = buyer.substr(0, 3);

                 // Get Unit First 3 character
                  var unitText   = $("#unit option:selected").html();
                  var unit       = unitText.trim().replace(/ /g,'');
                  var unitChar   = unit.substr(0, 3);

                 // Get Contract Number First 3 character 
                  var contractText   = $("#c_number_by option:selected").html();
                  var contract       = contractText.trim().replace(/ /g,'');
                  var contractChar   = contract.substr(0, 3);

                  var exlc_contract = buyerChar+unitChar+contractChar+data;
                  
                $("#exlc_contract_no").val(exlc_contract); 
           
            },
            error: function()
            {
                alert('failed...');
               
            }
        });
   
    });*/




 /*
  * Add More 
  * -----------------------
  */

   var data1 = $("#add_amend").html();
    $('body').on('click', '.AddBtn_amend', function(){
        $("#add_amend").append(data1);
    });

    $('body').on('click', '.RemoveBtn_amend', function(){
        $(this).parent().parent().remove();

    });
});

</script>
@endsection

 