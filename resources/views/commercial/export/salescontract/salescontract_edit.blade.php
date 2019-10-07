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
                <li class="active">Contract Sales Entry Update</li>
            </ul><!-- /.breadcrumb -->
        </div>

          <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i> Contract Sales Entry  </small></h1>
            </div>
            <div class="widget-header text-right">
                <div class="col-sm-12">
                    <a href="{{ url('commercial/export/sales_contract/sales_contract_list') }}" class="btn btn-primary btn-xs" >Contract List </a>
                </div>
            </div><br/>
            
            <form class="form-horizontal" role="form" method="post" action=" {{ url('commercial/export/sales_contract/sales_contract_update') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
                 <div class="row">
                            @include('inc/message')
                                 
                              <div class="col-md-4 ">

                                 <div class="form-group ">
                                      <label class=" col-sm-6 control-label no-padding-right" for="product" >Buyer: <span style="color: red">&#42;</span></label>
                                    
                                       <div class="col-sm-6">
                                           {{ Form::select('buyer', $buyer, $sales->mr_buyer_b_id, ['placeholder'=>'Select Buyer','id'=> 'buyer','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }} 
                                        </div>
                                      
                                  </div>
                                 
                                  <div class="form-group ">
                                      <label class="col-sm-6 control-label no-padding-right font-weight-bold" for="unit">Unit:<span style="color: red">&#42;</span> </label>
                                    
                                    <div class="col-sm-6">
                                        {{ Form::select('unit', $unit, $sales->hr_unit_id, ['placeholder'=>'Select','id'=>'unit','class'=> 'form-control col-xs-10', 'data-validation' =>'required']) }}
                                    </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="col-sm-6 control-label no-padding-right" for="contract_no" >Contract Number by:<span style="color: red">&#42;</span></label>
                                      <div class="col-sm-6">
                                      {{ Form::select('contract_no', array('In House'=>'In House', 'Buyer'=>'Buyer'), $sales->contract_no_by, ['placeholder'=>'Select','id'=>'c_number_by','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                                      
                                    </div>
                                         
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  
                                  <div class="form-group">
                                      <label class="col-sm-6 control-label no-padding-right" for="exlc_contract_no" >Export LC / Contract No.:  <span style="color: red">&#42;</span></label>
                                      <div class="col-sm-6">
                                       <input type="text" name="exlc_contract_no"  value="{{$sales->lc_contract_no}}" placeholder="Enter" id="exlc_contract_no" class=" form-control" readonly="readonly" data-validation ="required" value="{{$sales->lc_contract_no}}" />
                                      </div> 
                                  </div>
                                  <div class="form-group ">
                                      <label class="col-sm-6 control-label no-padding-right" for="contract_qty" >Contract Qty: <span style="color: red">&#42;</span></label>
                                       <div class="col-sm-6">
                                         <input type="text" name="contract_qty"  placeholder="Enter" class=" form-control"  data-validation ="required" value="{{$sales->contract_qty}}"/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="col-sm-6 control-label no-padding-right" for="contract_value" >Contract Value: <span style="color: red">&#42;</span></label>
                                       <div class="col-sm-6">
                                         <input type="text" name="contract_value"   placeholder="Enter" class=" form-control"  data-validation ="required" value="{{$sales->contract_value}}"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 ">
                                  <div class="form-group">
                                      <label class="col-sm-6 control-label no-padding-right" for="elc_date" >ELC Date: </label>
                                      <div class="col-sm-6">
                                       <input type="text" name="elc_date" id="elc_date" placeholder="Enter" class=" form-control datepicker" value="{{$sales->elc_date}}"/>
                                      </div> 
                                  </div>
                                  <div class="form-group ">   
                                    <?php  $lc=$sales->lc_contract_type;?>
                                      <label class="form-check-label col-sm-6 control-label no-padding-right" for="cmpc" >LC Type: </label>

                                       <div class="col-sm-6">  
                                        <input type="radio" class="form-check-input" id="lctype" name="lctype" value="ELC" <?php if($lc=='ELC'){ echo "checked=checked";}?> > ELC<br/>
                                        <input type="radio" class="form-check-input" name="lctype" value="Contract" <?php if($lc=='Contract'){ echo "checked=checked";}?> > Contract

                                       
                                     </div>
                                  </div>
                              </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 form-horizontal">
                            <div class="tabbable">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#merch" aria-expanded="true">Optional for Merch</a>
                                  </li>
                                 
                                  
                              </ul>
                              <div class="tab-content">
                                <!-- merch -->
                                  <div id="merch" class="tab-pane fade in active">
                                        
                                    <div class="row form-group">

                                      <div class="col-xs-4 col-sm-4">
                                          <div class="form-group">
                                              <label class="col-sm-6 control-label no-padding-right" for="exp_date" >Expire Date: </label>
                                              <div class="col-sm-6">
                                               <input type="text" name="exp_date" id="exp_date" value="{{$sales->  expiry_date}}" placeholder="Enter" class=" form-control datepicker"/>
                                              </div> 
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-6 control-label no-padding-right" for="remark" >Remarks: </label>
                                              <div class="col-sm-6">
                                               <input type="text" name="remark" id="remark" placeholder="Enter" class="form-control" value="{{$sales->remarks}}"/>
                                              </div> 
                                          </div>
                                      </div>
                                      <div class="col-xs-4 col-sm-4">
                                          <div class="form-group">
                                              <label class="col-sm-6 control-label no-padding-right" for="initial value" >Initial Value: </label>
                                              <div class="col-sm-6">
                                               
                                                 <input type="text" name="initial_value" id="initial value" value="{{$sales->initial_value}}"placeholder="Enter" class=" col-sm-6"/>
                                                  {{ Form::select('currency', array('USD'=>'$ USD', 'EUR'=>'€ EUR','GBP'=>'£ GBP','Tk'=>'৳ Tk'), $sales->currency_type, ['placeholder'=>'Select','class'=> '', 'data-validation' => 'required']) }}
                                             
                                              </div> 
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-6 control-label no-padding-right" for="lc_bank" >LC Open Bank: </label>
                                              <div class="col-sm-6">
                                                {{ Form::select('lc_bank', $bank, $sales->lc_open_bank_id, ['placeholder'=>'Select','class'=> 'form-control', 'data-validation' => 'required']) }}
                                             
                                              </div> 
                                          </div>
                                      </div>
                                      <div class="col-xs-4 col-sm-4">
                                          <div class="form-group">
                                              <label class="col-sm-6 control-label no-padding-right" for="initial value" >BTB Bank: </label>
                                              <div class="col-sm-6">
                                                {{ Form::select('btb_bank', $bank, $sales->btb_bank_id, ['placeholder'=>'Select','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                                              </div> 
                                          </div>
                                      </div>
                                      <div class="col-xs-4 col-sm-4">
                                          <div class="form-group">
                                              <label class="col-sm-6 control-label no-padding-right" for="initial value" >

                                               </label>
                                              <div class="col-sm-6">
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#select_item">Add Order</button>
                                              </div> 
                                          </div>
                                       </div>
                                      
                                     </div>
                                   </div> 
                                 </div> 
                            </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                          <table  class="table table-responsive table-bordered" >
                             <thead>
                                <tr>
                                  <th width="20%">Order Number</th>
                                  <th width="20%">Qty</th>
                                  <th width="20%">FOB</th>
                                  <th width="20%">Value</th>
                                <tr>  
                             </thead> 

                             <tbody id="order_list_des"> 
                              <?php $qty=0; $order_val=0;?>
                              @foreach($sales_order as $order)
                                <tr>
                                   <td width="20%"><input type="hidden" name="order_id[]" value="{{$order->mr_order_entry_order_id}}" readonly/>
                                   <input type="text" name="order_no[]" id="items[]" placeholder="" value="{{$order->order_code}}" readonly/></td>
                                   <td width="20%"><input type="text" name="qty[]" class="qty" placeholder="" value="{{$order->order_qty}}"  readonly/></td>
                                   <td width="20%"><input type="text" name="fob[]"  placeholder="" value="{{$order->agent_fob}}"  readonly/></td>
                                   <td width="20%">
                                   <input type="text" name="order_value[]" class="order_value" value="{{$order_value=$order->agent_fob*$order->order_qty}}"  readonly/></td>
                                </tr>

                                <?php $qty+=$order->order_qty; 
                                      $order_val+=$order_value; ?>
                              @endforeach
                             </tbody>
                             <tfoot>
                                <th width="20%" align="right"><b>Total :</b></th>
                                <th colspan="2" >
                                  <input type="text" name="total_qty" readonly="readonly" id="total_qty" value="{{$qty}}">
                                </th>
                              
                                <th width="20%">
                                  <input type="text" name="total_value" readonly="readonly" id="total_value" value="{{$order_val}}">
                                </th>
                             </tfoot>
                          </table>
                        </div>
                      </div>
 
                      <div class="clearfix form-actions">
                          <div class="col-md-offset-3 col-md-9"> 
                            <input type="hidden" name="con_id" value="{{$sales->id}}">
                              <button class="btn btn-info" type="submit">
                                  <i class="ace-icon fa fa-check bigger-110"></i> Submit
                              </button>

                              &nbsp; &nbsp; &nbsp;
                              <button class="btn" type="reset">
                                  <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                              </button>
                          </div>
                      </div>
         </form>

          </div>      
                <!-- PAGE CONTENT ENDS -->
    </div>
       
</div><!-- /.page-content -->

<!-- Modal Select Order -->
<div class="modal fade" id="select_item" tabindex="-1" role="dialog" aria-labelledby="sizeLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Order List</h4>
      </div>
      <div class="modal-body" style="padding:0 15px">
        <div class="row" style="padding: 20px;" id="addListToModal">
      
           @if($orderLists->isEmpty())
               <span>No Size group, Please select Buyer and Unit</span>
           @else
   
                @foreach($orderLists as $orderd)

                  <?php
                   $sales_order = DB::table('cm_sales_contract_order')                         
                                  ->where('cm_sales_contract_id', $orderd->order_id)
                                  ->exists();
                                  //echo  $sales_order;
                    ?>

                    <label>
                      <input name="selected_item[]" type="checkbox" value="{{$orderd->order_id}}" class="ace checkbox-input" checked="<?php if($sales_order){echo"checked";}?>">
                      <span class="lbl">{{$orderd->order_code}}</span>
                       <input type="hidden" class="qty" value="{{$orderd->order_qty}}">
                       <input type="hidden" class="fob" value="{{$orderd->agent_fob}}">                         
                    </label>
                @endforeach
            
           @endif   
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        <button type="button" id="modal_data" class="btn btn-primary btn-sm">Done</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->

<script type="text/javascript">
  $(document).ready(function(){ 

  /*
  * Export LC / Contract No. GENERATE
  * -----------------------
  */

  $("#buyer,#c_number_by, #unit").on("change", function(){ 
 
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
                  var buyerChar  = (buyer.substr(0, 3)).toUpperCase();

                 // Get Unit First 3 character
                  var unitText   = $("#unit option:selected").html();
                  var unit       = unitText.trim().replace(/ /g,'');
                  var unitChar   = (unit.substr(0, 3)).toUpperCase();

                 // Get Contract Number First 3 character 
                  var contractText   = $("#c_number_by option:selected").html();
                  var contract       = contractText.trim().replace(/ /g,'');
                  var contractChar   = (contract.substr(0, 3)).toUpperCase();     

                  var year=new Date().getFullYear().toString().substr(-2);
                
               
                  
                  var exlc_contract = buyerChar.toUpperCase()+'/'+unitChar+'/'+data+'/'+year;

                  if(contractText=='In House'){
                    
                    $("#exlc_contract_no").val(exlc_contract); 
                    $("#exlc_contract_no").prop('readonly',true);

                  }

                  else{ 
                    $("#exlc_contract_no").val("");
                    $("#exlc_contract_no").prop('readonly',false);
                  }
           
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
    $("#buyer,#unit").on("change",function(){

        $("#addListToModal").html("<span>No Order Found, Please select Buyer and Unit</span>");
        $("#order_list_des").html("");

        var b_id = $('#buyer').val();
        var unit  = $("#unit").val();
          if(b_id != '' && unit!=''){
            // Action Element list
            $.ajax({
                url : "{{ url('commercial/export/sales_contract/getorderlist') }}",
                type: 'get',
                data: {buyer_id:b_id,unit_id:unit},
                success: function(data)
                {
                  if(data!=""){
                   $("#addListToModal").html(data); 
                   }

                },
                error: function()
                {
                   $("#addListToModal").html("<span>No Order, Please select Buyer and Unit</span>");
                }
            });
        }
        else{ 
            $("#addListToModal").html("<span>No Order, Please select Buyer and Unit </span>");
            $("#order_list_des").html("");
        }  
    });

 /*
  * SHOW DATA AFTER MODAL HIDE
  * -----------------------
  */
    var sgmodal = $("#select_item"); 
    $("body").on("click", "#modal_data", function(e) {

            var data= '0000';
            var sum_qty = 0;
            var sum_value = 0;

            $('.checkbox-input').each(function(i, v){
                // $("#select_item .modal-body").find('input:checkbox').prop('checked', true);


                if ($(this).is(":checked"))
                {
                    var id= $(this).val();
                   // console.log(id);
                    var item_name= $(this).next().text();
                    var qty= $(this).next().next('.qty').val();
                    var fob= $(this).next().next().next('.fob').val();
                    var cvalue=(qty*fob).toFixed(2);
                    data+='<tr>\
                           <td width="20%"><input type="hidden" name="order_id[]" value="'+id+'" readonly/>\
                           <input type="text" name="order_no[]" id="items[]" placeholder="" value="'+item_name+'" readonly/></td>\
                           <td width="20%"><input type="text" name="qty[]" class="qty" placeholder="" value="'+qty+'"  readonly/></td>\
                           <td width="20%"><input type="text" name="fob[]"  placeholder="" value="'+fob+'"  readonly/></td>\
                           <td width="20%">\
                           <input type="text" name="order_value[]" class="order_value" value="'+cvalue+'"  readonly/></td>\
                          </tr>';
                             
                  // Calculate Total Quantity & Value

                    sum_qty += parseInt(qty);
                    sum_value += parseFloat(cvalue);
                }
            });

           // Set Values
            $("#order_list_des").html(data);
            $("#total_qty").val(sum_qty);
            $("#total_value").val(sum_value);

        sgmodal.modal('hide');
    }); 
});

</script>
@endsection

