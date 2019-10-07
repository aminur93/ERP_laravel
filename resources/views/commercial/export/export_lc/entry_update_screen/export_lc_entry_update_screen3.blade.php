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
                    <a href="#"> Export </a>
                </li>
                <li class="#"> Export L/C</li>
                <li class="active">  Export L/C Entry Update Screen 3   </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
              <div class="page-header">
               <h1> Export L/C <small><i class="ace-icon fa fa-angle-double-right"></i>  Export L/C Entry Update Screen 3  </small></h1>
            </div>
          <!---Form -->
                 <!-- <h5 class="page-header">Add Information  </h5> -->
             <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/export/export-lc-update-screen3-save')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="unit" >Unit: <span style="color: red">&#42;</span></label>
                      <div class="col-sm-8">
                          {{ Form::select('unit', $hr_unit, null, ['placeholder'=>'Select ','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label no-padding-right" for="invoiceno" > Invoice No.: <span style="color: red">&#42;</span></label>
                      <div class="col-sm-8">
                        <select name="invoiceno" id="invoiceno" class="col-xs-12 form-control">
                            <option value="">Select</option>

                        </select>
                      </div>
                    </div>
                          <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="vessel_sail" > Vessel Sail:<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-8">
                             <input type="text" placeholder="enter"  name="vessel_sail" class="col-xs-12" data-validation="required"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="forwarder_name" >Forwarder Name:</label>
                          <div class="col-sm-8">
                               <input type="text" name="forwarder_name" placeholder="enter" class="col-xs-12"/>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="fcr_no" >FCR No: </label>
                            <div class="col-sm-8">
                              <input type="text" name="fcr_no" placeholder="Enter" class="col-xs-12"/>
                            </div>
                          </div>
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="fcr_date" >FCR Date: </label>
                          <div class="col-sm-8">
                            <input type="date" name="fcr_date" placeholder="Enter" class="col-xs-12"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="hub" >Hub: <span style="color: red">&#42;</span></label>
                          <div class="col-sm-8">
                              {{ Form::select('hub', $hub, null, ['placeholder'=>'Select ','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="mother_vessel" >Mother Vessel:</label>
                          <div class="col-sm-8">
                            <input type="text" name="mother_vessel" placeholder="enter" class="col-xs-12" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="voyage" >Voyage:</label>
                          <div class="col-sm-8">
                             <input type="text" name="voyage"placeholder="Enter"  class="col-xs-12" />
                          </div>
                     </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="etd_hub" >ETD Hub:</label>
                          <div class="col-sm-8">
                              <input type="text" name="etd_hub" placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                    <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="eta_destination" >ETA Destination:</label>
                          <div class="col-sm-8">
                              <input type="text" name="eta_destination" placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                     <div class="form-group">
                         <label class="col-sm-4 control-label no-padding-right" for="doc_sub_to_buyer" >Doc Sub. To Buyer:</label>
                         <div class="col-sm-8">
                             <input type="text" name="doc_sub_to_buyer" placeholder="Enter" class="form-control" />
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-sm-4 control-label no-padding-right" for="payment_invoice_sd" >Payment Invoice SD:</label>
                         <div class="col-sm-8">
                             <input type="date" name="payment_invoice_sd" placeholder="Enter" class="form-control" />
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-sm-4 control-label no-padding-right" for="bi_surrender_date" >BI. Surrender Date:</label>
                         <div class="col-sm-8">
                             <input type="date" name="bi_surrender_date" placeholder="Enter" class="form-control" />
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-sm-4 control-label no-padding-right" for="ic_rec_date" >I.C Rec Date:</span> </label>
                         <div class="col-sm-8">
                           <input type="date" name="ic_rec_date"placeholder="Enter" class="col-xs-12" />
                         </div>
                       </div>
                       <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="f_amount" >F. Amount:</span> </label>
                            <div class="col-sm-4">
                              <input type="text" name="f_amount" placeholder="enter" class="col-xs-12" />
                            </div>
                            <div class="col-sm-4">
                              <?php
                                  $currancy = array(
                                         'USD' => 'USD',
                                         'EUR' => 'EUR',
                                         'GBP' => 'GBP',
                                         'BDT' => 'BDT'
                                        );
                              ?>
                              {{ Form::select('f_amount_currancy', $currancy, null, ['placeholder'=>'Currancy','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                            </div>
                          </div>
                   </div>
                  <div class="col-sm-6">
                    <!-- SECOND COLUMN BEGINS -->

                       <div class="form-group">
                         <label class="col-sm-4 control-label no-padding-right" for="marine_insurance_value" >Marine Insurance Value:</span> </label>
                          <div class="col-sm-4">
                            <input type="text" name="marine_insurance_value" placeholder="enter" class="col-xs-12" />
                          </div>
                          <div class="col-sm-4">
                            {{ Form::select('marine_insurance_value_currancy', $currancy, null, ['placeholder'=>'Currancy','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                          </div>
                      </div>
                      <div class="form-group">
                           <label class="col-sm-4 control-label no-padding-right" for="insurance_charge" >Insurance Charge:</span> </label>
                           <div class="col-sm-4">
                             <input type="text" name="insurance_charge" placeholder="enter" class="col-xs-12" />
                           </div>
                           <div class="col-sm-4">
                             {{ Form::select('insurance_charge_currancy', $currancy, null, ['placeholder'=>'Currancy','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                           </div>
                      </div>
                      <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="shipping_doc_courier_name" >Shipping DOc Courier Name:</span> </label>
                            <div class="col-sm-8">
                              <input type="text" name="shipping_doc_courier_name" placeholder="enter" class="col-xs-12" />
                            </div>
                      </div>
                      <div class="form-group">
                           <label class="col-sm-4 control-label no-padding-right" for="shipping_doc_courier_number" >Shipping DOc Courier Number:</span> </label>
                           <div class="col-sm-8">
                             <input type="text" name="shipping_doc_courier_number" placeholder="enter" class="col-xs-12" />
                           </div>
                      </div>
                      <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="shipping_doc_courier_date" >Shipping DOc Courier Date:</span> </label>
                            <div class="col-sm-8">
                              <input type="date" name="shipping_doc_courier_date" class="col-xs-12" />
                            </div>
                      </div>
                      <div class="form-group">
                           <label class="col-sm-4 control-label no-padding-right" for="carrier_name" >Carrier Name:</span> </label>
                           <div class="col-sm-8">
                             <input type="text" name="carrier_name" placeholder="enter" class="col-xs-12" />
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="actual_freight_amt" >Actual Freight Amt:</span> </label>
                          <div class="col-sm-4">
                            <input type="text" name="actual_freight_amt" placeholder="enter" class="col-xs-12" />
                          </div>
                          <div class="col-sm-4">
                            {{ Form::select('actual_freight_amt_currancy', $currancy, null, ['placeholder'=>'Currancy','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                          </div>
                      </div>
                      <div class="form-group">
                           <label class="col-sm-4 control-label no-padding-right" for="actual_freight_date" >Actual Freight Date:</span> </label>
                           <div class="col-sm-8">
                             <input type="date" name="actual_freight_date" placeholder="enter" class="col-xs-12" />
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="import_fabric_from_epz" >Import Fabric from EPZ:</span> </label>
                          <!-- Default inline 1-->
                          <div class="col-sm-2">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultInline1" name="import_fabric_from_epz" value="1">
                            <label class="custom-control-label" for="import_fabric_from_epz">YES</label>
                          </div>
                        </div>
                          <!-- Default inline 2-->
                          <div class="col-sm-2">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultInline2" name="import_fabric_from_epz" value="0">
                            <label class="custom-control-label" for="import_fabric_from_epz">No</label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                           <label class="col-sm-4 control-label no-padding-right" for="pass_book_vol_no" >Pass Book Vol No.:</span> </label>
                           <div class="col-sm-8">
                             {{ Form::select('pass_book_vol_no', $passBookVol, null, ['placeholder'=>'Select ','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="pass_book_page_no" >Pass Book Page No.:</span> </label>
                          <div class="col-sm-8">
                            {{ Form::select('pass_book_page_no', $passBookPage, null, ['placeholder'=>'Select ','id' =>'unit','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}
                          </div>
                      </div>
                   </div>
               <!-- /.col -->
                <div class="col-sm-12">
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> <input type="hidden" name="impdatatype"placeholder="Enter" class="form-control" value="Foreign" />
                               <input type="hidden" name="import_id" placeholder="Enter" class="form-control" value="" />
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Add
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
               </div>
            </div><!--- /. Row Form 1---->
          </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $("#unit").on('change',function(e){
      var unit_id = $('#unit').find(":selected").val();
      if(unit_id){
           $.ajax({
              url:'/commercial/export/get-invoice-no-by-hr-unit-id/'+unit_id,
              type: 'get',
              success: function (response) {
                  if(response.length!=0){
                      var response = JSON.parse(response);
                      $('#invoiceno').empty();
                      $("#invoiceno").html('<option value="">Select</option>\n');
                      $.each(response, function( key,value ) {
                      var data = '<option value="">Select</option>\n'+
                      '<option value="'+key+'">'+ value+'</option>\n';
                      $("#invoiceno").html(data);
                    });
                    }
                  }
                 })
               }else{
                  $('#invoiceno').empty();
                  $("#invoiceno").html('<option value="">Select</option>\n');
               }
    });

});

</script>
@endsection
