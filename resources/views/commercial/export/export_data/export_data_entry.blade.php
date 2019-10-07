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
                <li class="active">Export Data Entry</li>
            </ul><!-- /.breadcrumb -->
        </div>

          <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>  Export <i class="ace-icon fa fa-angle-double-right"></i> Export Data Entry  </small></h1>
            </div>
            <form class="form-horizontal" role="form" method="post" action=" {{ url('commercial/export/store_exportdata') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="row">
                            @include('inc/message')
                                 
                              <div class="col-md-4 ">

                                  <div class="form-group ">
                                      <label class="col-sm-5 control-label no-padding-right font-weight-bold" for="unit">Unit:<span style="color: red">&#42;</span> </label>
                                    
                                      <div class="col-sm-7">
                                        {{ Form::select('unit', $unit, null, ['placeholder'=>'Select','id'=>'unit','class'=> 'form-control col-xs-10', 'data-validation' =>'required']) }}
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="form-check-label col-sm-5 control-label no-padding-right" for="agentname" >Agent Name:<span style="color: red">&#42;</span> </label>

                                       <div class="col-sm-7">  
                                         {{ Form::select('agentname', $agent, null, ['placeholder'=>'Select','id'=>'agentname','class'=> 'form-control col-xs-10', 'data-validation' =>'required']) }}
                                     
                                     </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="fileno" >File No.:  <span style="color: red">&#42;</span></label>
                                      <div class="col-sm-7">
                                         <select name="fileno" id="fileno" class="form-control col-xs-12" data-validation ="required">
                                           <option value=""> Select Unit</option>
                                         </select>
                                     
                                      </div> 
                                  </div>
                                  <div class="form-group ">
                                      <label class=" col-sm-5 control-label no-padding-right" for="invoiceno" >Invoice No.: <span style="color: red">&#42;</span></label>
                                    
                                       <div class="col-sm-7">
                                           <input type="text" name="invoiceno" id="invoiceno" value="" placeholder="Enter" class=" form-control" readonly />
                                        </div>                                      
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="invoice_date" >Invoice Date: </label>
                                      <div class="col-sm-7">
                                       <input type="text" name="invoice_date" id="exp_date" value=""placeholder="Enter" class=" form-control datepicker" />
                                      </div> 
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="invoice_date" >ELC No.: </label>
                                      <div class="col-sm-7">
                                   <!--    {{ Form::select('elcno', $lcno, null, ['placeholder'=>'Select','id'=>'elcno','class'=> 'form-control col-xs-10', 'data-validation' =>'required']) }} -->

                                      <select name="elcno" id="elcno" class="form-control col-xs-10"> <option value="">Select File No.</option></select>
                                      </div> 
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="elc_date" >ELC Date: </label>
                                      <div class="col-sm-7">
                                       <input type="text" name="elc_date" id="elc_date" value=""placeholder="Enter" class=" form-control datepicker" readonly="readonly" />
                                      </div> 
                                  </div>
                                  
                                
                              </div>
                              <div class="col-md-4">

                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="lc_open_bank" >LC Open Bank: </label>
                                      <div class="col-sm-7">
                                       <input type="text" name="lc_open_bank" id="lc_open_bank" value=""placeholder="Enter" class=" form-control datepicker" readonly="readonly" />
                                       <input type="hidden" name="lc_open_bank_id" id="lc_open_bank_id" value=""class=" form-control datepicker" readonly="readonly" />
                                      </div> 
                                  </div>

                                  <div class="form-group ">
                                      <label class=" col-sm-5 control-label no-padding-right" for="product" >Buyer: <span style="color: red">&#42;</span></label>
                                      <div class="col-sm-7">

                                           <input type="text" name="buyer1" readonly="readonly" id="buyer" class="form-control col-xs-10" value="">

                                           <input type="hidden" name="buyer" readonly="readonly" id="buyer_id" class="form-control col-xs-10" value="">
                                        </div>
                                   </div>
                                  
 
                               
                                  <div class="form-group ">
                                      <label class="col-sm-5 control-label no-padding-right" for="cancelmark" >Cancel Mark: </label>
                                       <div class="col-sm-2">
                                         <input type="checkbox" name="cancelmark" id="cancelmark" class="" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="col-sm-5 control-label no-padding-right" for="reason" >Reason:</label>
                                       <div class="col-sm-7">
                                         <input type="text" name="reason" value="" id="reason" placeholder="Enter" class=" form-control" />
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="cancel_date value" >Date: </label>
                                      <div class="col-sm-7">
                                          <input type="text" name="cancel_date" id="cancel_date" value=""placeholder="Enter" class="form-control datepicker" />
                                     
                                      </div> 
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="incoterms" >Incoterms: </label>
                                      <div class="col-sm-7">
                                        {{ Form::select('incoterms', $incoterm, null, ['placeholder'=>'Select','id'=>'incoterm','class'=>'form-control col-xs-10']) }}
                                     
                                      </div> 
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="exp_no" >Exp No.: </label>
                                      <div class="col-sm-7">
                                       <input type="text" name="exp_no" id="exp_no" value=""placeholder="Enter" class=" form-control"  />
                                      </div> 
                                  </div>

                                  
                                  

                              </div>
                              <div class="col-md-4 ">
                                <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="exp_date" >Exp Date </label>
                                      <div class="col-sm-7">
                                      
                                          <input type="text" name="exp_date" id="exp_date" value="" placeholder="Enter" class=" form-control datepicker"/>
                                     
                                      </div> 
                                  </div>
                                <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="destination" >Destination</label>
                                      <div class="col-sm-7">
                                        {{ Form::select('destination', $country, null, ['placeholder'=>'Select','id'=>'destination','class'=> 'form-control col-xs-10']) }}
                                      </div> 
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="fab_desc" >Fabric Desc.</label>
                                      <div class="col-sm-7">
                                        <input type="text" name="fab_desc" id="fab_desc" class="form-control col-xs-10" value="" >
                                      </div> 
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="garmb_desc" >Garment Desc.</label>
                                      <div class="col-sm-7">
                                        <input type="text" name="garm_desc" id="garm_desc" class="form-control col-xs-10" value="" >
                                      </div> 
                                  </div>
                                
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="model" >Mode: </label>
                                      <div class="col-sm-7">
                                        {{ Form::select('mode', array('Sea' => 'Sea', 'Air' => 'Air'), null, ['placeholder'=>'Select','id'=>'model','class'=> 'form-control col-xs-10']) }}
                                      </div> 
                                  </div>

                                 <div id="hscode"> 
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="hs_code" >H.S Code: </label>
                                      <div class="col-sm-7">
                                       <input type="text" name="hs_code[]" id="hs_code[]" value=""placeholder="Enter" class="col-sm-7"/>
                                      
                                         <button type="button" class="btn btn-sm btn-success AddBtn_hs">+</button>
                                         <button type="button" class="btn btn-sm btn-danger RemoveBtn_hc">-</button> 
                                      </div>
                                  </div>
                                 </div> 
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label no-padding-right" for="cash_incentive">Cash Incentive</label>
                                      <div class="col-sm-7">
                                        <input type="text" name="cash_incentive" id="cash_incentive" value=""placeholder="Enter" class=" form-control" readonly="readonly" />
                                      </div> 
                                  </div>
                             
                              </div>
                      </div>
                      <hr/> 
                      <div class="row" style="">
                      
                            <div class="col-md-6">

                              <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="port_destination" >Port Of Destination:</label>
                                  <div class="col-sm-7">
                                    {{ Form::select('port_destination', $port, null, ['placeholder'=>'Select','id'=>'port_destination','class'=> 'form-control col-xs-10']) }}
                                 
                                  </div> 
                              </div>
                              <div id="portdestination_ammend" style="background: #eee; padding: 10px;"> 
                                <div class="portdestination">

                                    <div class="form-group" >
                                        <label class="col-sm-4 control-label no-padding-right" for="delv_cnt_code" >Delivery Center Code:</label>
                                        <div class="col-sm-7">
                                        
                                          <input type="text" name="delv_cnt_code[]" id="delv_cnt_code[]" value=""placeholder="Enter" class="col-sm-8 "/>
                                          <button type="button" class="btn btn-sm btn-success AddBtn_port">+</button>
                                          <button type="button" class="btn btn-sm btn-danger RemoveBtn_port">-</button> 
                                        </div> 
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="quantity" >Quantity:</label>
                                        <div class="col-sm-7">
                                          <input type="text" name="quantity[]" id="quantity" value=""placeholder="Enter" class=" form-control"/>
                                        </div> 
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="carton" >Carton:</label>
                                        <div class="col-sm-7">
                                          <input type="text" name="carton[]" id="carton" value=""placeholder="Enter" class=" form-control"/>
                                        </div> 
                                    </div> 
                                </div>        
                              </div>

                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="cat_no" >Category Number:</label>
                                  <div class="col-sm-7">
                                  <!--   {{ Form::select('cat_no', $unit, null, ['placeholder'=>'Select','id'=>'cat_no','class'=> 'form-control col-xs-10', 'data-validation' =>'required']) }} -->

                                    <select name="cat_no" id="cat_no" class="form-control col-xs-12">
                                      @foreach($category as $cat)
                                       <option value="{{$cat->id}}">{{$cat->cat_no_name}} - {{$cat->cat_no_code}}</option>
                                      @endforeach
                                    </select>
                                  </div> 
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="insp_order_no" >Inspection Order Number:</label>
                                  <div class="col-sm-7">
                                    <input type="text" name="insp_order_no" id="insp_order_no" value=""placeholder="Enter" class=" form-control"/>
                                  </div> 
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right" for="brand_name" >Brand Name:</label>
                                  <div class="col-sm-7">
                                    <input type="text" name="brand_name" id="brand_name" value=""placeholder="Enter" class=" form-control" />
                                  </div> 
                              </div>
                              

                            </div>
                        

                          <div class="col-md-12">
                            <div class="" style="margin-top: 20px;">
                              <table id="purchase_table" class="table table-responsive table-bordered" style="table-layout: fixed">
                                 <thead>
                                    <tr>
                                      <th>Po No.</th>
                                      <th>MBM Order No.</th>
                                      <th>Style No.</th>
                                      <th>Dept. No./ISD</th>
                                      <th>PO Qty</th>
                                      <th>Invoice Qty</th>
                                      <th>Unit Price</th>
                                      <th>Unit Price2</th>
                                      <th>Value</th>
                                      <th>Currency</th>
                                      <th>Ctn</th>
                                      <th>Agent Unit Price</th>
                                      <th>Agent Value</th>
                                      <th>FOB Date</th>
                                      <th>Total Exp Qty</th>
                                      <th>CBM</th>
                                      <th>Gross Weight</th>
                                      <th>Net Weight</th>
                                      <th>N.N. Weight</th>
                                      <th></th>
                                    <tr>  
                                 </thead> 

                                 <tbody id="purchase">                          
                                 </tbody>
                                 <tfoot>
                                    <th align="right"><b>Total :</b></th>
                                    <th colspan="4">
                                      <input type="text" name="total_po_qty" readonly="readonly" id="total_po_qty" class="col-sm-2 pull-right">
                                    </th>
                                  
                                    <th>
                                      <input type="text" name="total_inv_qty" readonly="readonly" id="total_inv_qty" class="col-sm-12">
                                    </th>
                                    <th colspan="3" >
                                      <input type="text" name="total_value" readonly="readonly" id="total_value" class="col-sm-3 pull-right">
                                    </th>
                                    <th colspan="2" >
                                      <input type="text" name="total_cnt" readonly="readonly" id="total_cnt" class="col-sm-4 pull-right">
                                    </th>
                                    <th colspan="2" >
                                      <input type="text" name="total_agent_val" readonly="readonly" id="total_agent_val" class="col-sm-5 pull-right">
                                    </th>
                                    <th colspan="2" >
                                      <input type="text" name="total_exp_val" readonly="readonly" id="total_exp_val" class="col-sm-5 pull-right">
                                    </th>
                                    <th colspan="5" >
                                      
                                    </th>
                                 </tfoot>
                           
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
  * File No BASED ON Unit
  * -------------------------
  */

  $("#unit").on("change", function(){ 
    var unitid  = $(this).val();
        $.ajax({
            url : "{{ url('commercial/export/filelist') }}",
            type: 'get',
            data: {unit_id:unitid},
            success: function(data) 
            {
              //alert(data);
               $("#fileno").html(data); 
            },  
            error: function()
            {
                alert('failed...');
               
            }
        });

 /*
  * Generate Invoice No based on Unit No.
  * -------------------------
  */

     year=new Date().getFullYear().toString().substr(-2);
        $.ajax({
            url : "{{ url('commercial/export/invoiceno') }}",
            type: 'get',
            data: {unt_id:unitid},
            success: function(data) 
            {
               var invno=year+data;
               $("#invoiceno").val(invno); 
            },  
            error: function()
            {
                alert('failed...');
               
            }
        });
       

    });

 /* 
  * ELC No BASED ON File No.
  * -------------------------
  */

  $("#fileno").on("change", function(){ 
    var fileid  = $(this).val();

      // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/elclist') }}",
            type: 'get',
            data: {file_id:fileid},
            success: function(data) 
            {
              //alert(data);
               $("#elcno").html(data); 
            },  
            error: function()
            {
                alert('failed...');
               
            }
        });
      

    });

 /*
  * PO table Generate BASED ON File No
  * -----------------------
  */

  $("#fileno").on("change", function(){ 

    var fileno  = $(this).val();
    
      // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/polist') }}",
            type: 'get',
            data: {file_no:fileno},
            success: function(data)
            {
                //alert('sd');
                $("#purchase").html(data); 

              
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

  $("#elcno").on("change", function(){ 
    var elcid  = $(this).val();
    
      // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/elcinfolist') }}",
            type: 'get',
            data: {elc_id:elcid},
            success: function(data)
            {
                $("#buyer").val(data.buyername); 
                $("#buyer_id").val(data.buyerid);
                $("#elc_date").val(data.elcdate); 
                $("#exp_date").val(data.exdate);
                $("#contract_qty").val(data.contractqty);
                $("#lc_open_bank").val(data.lc_bank);
                $("#lc_open_bank_id").val(data.lc_bank_id);
                $("#salesid").val(data.contract_id);
             
            },
            error: function()
            {
                alert('failed...');
               
            }
        });
      

    });
 /*
  * BASED ON PO No
  * -----------------------
  */
  $('body').on('change', '.pono', function() {
  
    var that = $(this);
    var pono  = $(this).val();
    var sum_po_qty_t = 0;
    var sum_value = 0;

      // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/povalues') }}",
            type: 'get',
            data: {po_no:pono},
            success: function(data)
            {
              
               that.closest('tr').find('.po_qty').val(data.poqty);

               // Calculate Total Po quantity
                 $('.po_qty').each(function(i, v){
                     var poqty=$(this).val();
                     sum_po_qty_t+=parseInt(poqty); 
                 });

                 $("#total_po_qty").val(sum_po_qty_t); // set Total Po quantity

            },
            error: function()
            {
                alert('failed...');
               
            }


        });
      });

  
 /*
  * CASH INCENTIVE BASED ON Country
  * -----------------------
  */

  $("#destination").on("change", function(){ 
    var cntid  = $(this).val();
    
      // Action Element list
        $.ajax({
            url : "{{ url('commercial/export/cashincentive') }}",
            type: 'get',
            data: {cnt_id:cntid},
            success: function(data)
            {
                $("#cash_incentive").val(data.cashincentive);
            },
            error: function()
            {
                alert('failed...');
               
            }
        });
      

    });   
 /*
  * Value Calculation
  * -----------------------
  */
  $('body').on('keyup', '.inv_qty', function() {
  
    var that= $(this);
    var inv_val= $(this).val();
    var poqty= that.closest('tr').find('.po_qty').val();
    var unitprice1= that.closest('tr').find('.unit_price1').val();
    var value=inv_val*unitprice1;
    //alert(value);

    that.closest('tr').find('.unit_value').val(value); // Set Value

    // Total Value CAlculation
     var sum_total_val = 0;
     $('.unit_value').each(function(i, v){
         var unit_val=$(this).val();
         sum_total_val+=parseFloat(unit_val); 
     });
     $("#total_value").val(sum_total_val); // set Total Value


    });
 /*
  * Agent Value Calculation
  * -----------------------
  */
  $('body').on('keyup', '.inv_qty,.agent_unit_price', function() {
  
    var that= $(this);
    var agent_price=that.closest('tr').find('.agent_unit_price').val();
    var poqty= that.closest('tr').find('.po_qty').val();
    var invqty= that.closest('tr').find('.inv_qty').val();
    var value=agent_price*invqty;
    //alert(value);

    that.closest('tr').find('.agent_value').val(value);

  //Total Agent Value calculation
     var sum_agent_t = 0;
     $('.agent_value').each(function(i, v){
         var agentval=$(this).val();
         sum_agent_t+=parseFloat(agentval); 
     });
     $("#total_agent_val").val(sum_agent_t); // set Total agent value 


    });
 /*
  * Total CNT calculation
  * -----------------------
  */

$('body').on('keyup', '.cnt', function() {

  var sum_cnt_qty_t = 0;
     $('.cnt').each(function(i, v){
         var cntval=$(this).val();
         sum_cnt_qty_t+=parseInt(cntval); 
     });
     $("#total_cnt").val(sum_cnt_qty_t); // set Total CNT 
});   

 /*
  * PO total Qty Calculation BASED ON PO No
  * -----------------------
  */
  // var sum_po_qty_t = 0;
  // var sum_value = 0;

  /*$('body').on('change', '.pono', function() {
      var that=$(this);
      //  alert(that);
       //var sum_po_qty=that.next().next().next().next('.po_qty').val();

             // Calculate Total Quantity & Value
          $('.pono').each(function(){
          //var sum_po_qty=that.closest('tr').find('.po_qty').val();
          
          // var tt=that.closest('.pono').querySelector('.po_qty').val();
           // var sum_po_qty= that.next().next('.po_qty').val();
            // sum_po_qty_t += parseInt(sum_po_qty);
            //sum_value += parseFloat(cvalue);


        });
        //alert(sum_po_qty); //alert('tt: ',tt);
        // Set Values

       
            //$("#total_po_qty").val(sum_po_qty_t);
            //$("#total_value").val(sum_value);

    });
  */

 /*
  * Invoice qty calculation
  * -----------------------
  */
  $('body').on('keyup', '.inv_qty', function() {
  
    //var that = $(this);

    var sum_invo_qty_t = 0;
     $('.inv_qty').each(function(i, v){
         var inv=$(this).val();
         sum_invo_qty_t+=parseInt(inv); 
     });
     $("#total_inv_qty").val(sum_invo_qty_t); // set Total Inv quantity
  });

  /*
  * Add More hc code
  * -----------------------
  */

   var data = $("#hscode").html();
    $('body').on('click', '.AddBtn_hs', function(){
        $("#hscode").append(data);
    });

    $('body').on('click', '.RemoveBtn_hc', function(){
        $(this).parent().parent().remove();

    });
 /*
  * Add More Port Destination
  * -----------------------
  */

   var data1 = $("#portdestination_ammend").html();
   $('body').on('click', '.AddBtn_port', function(){
        $("#portdestination_ammend").append(data1);
    });

   $('body').on('click', '.RemoveBtn_port', function(){

    $(this).closest('.portdestination').remove();
  });

 /*
  * Add More PO tr
  * -----------------------
  */

   //var data2 = $("tbody #purchase").html();

   //$("#purchase_table > tbody").append("<tr><td>row content</td></tr>");

  // Add more table row and value update
   $('body').on('click', '.AddBtn_tbl', function(){

    var $tr    = $(this).closest('.purchase_row');
    var $clone = $tr.clone();
    $clone.find(':text').val();
    $tr.after($clone);

    // value calculation

    //PO Qty
      var po= $(this).closest('tr').find('.po_qty').val();
      var prevpo= $("#total_po_qty").val();
      var newTotalPoqty=parseInt(prevpo) + parseInt(po);
       $("#total_po_qty").val(newTotalPoqty);
    // Inv qty
      var inp= $(this).closest('tr').find('.inv_qty').val();
      var previnv= $("#total_inv_qty").val();
      var newTotalinv=parseInt(previnv) + parseInt(inp);
       $("#total_inv_qty").val(newTotalPoqty);
    //UNIT
      var unit_val= $(this).closest('tr').find('.unit_value').val();
      var prevunit= $("#total_value").val();
      var newTotalunit=parseFloat(prevunit) + parseFloat(unit_val);
       $("#total_value").val(newTotalunit); 
    //Cnt   
      var cnt_val= $(this).closest('tr').find('.cnt').val();
      var prevcnt= $("#total_cnt").val();
      var newTotalcnt=parseFloat(prevcnt) + parseFloat(cnt_val);
       $("#total_cnt").val(newTotalcnt);  
    // Agent Value  
      var agn_val= $(this).closest('tr').find('.agent_value').val();
      var prevagn= $("#total_agent_val").val();
      var newTotalagn=parseFloat(prevagn) + parseFloat(agn_val);
       $("#total_agent_val").val(newTotalagn);  
    // Exp Qty
      var exp_val= $(this).closest('tr').find('.total_exp_qty').val();
      var prevexp= $("#total_exp_val").val();
      var newTotaexp=parseFloat(prevexp) + parseFloat(exp_val);
       $("#total_exp_val").val(newTotaexp);     



  });

 // Remove row and value update
   $('body').on('click', '.RemoveBtn_tbl', function(){
      $(this).closest('.purchase_row').remove();
    // $(this).parent().parent().remove();\
  // value calculation
    var po= $(this).closest('tr').find('.po_qty').val();
    var prevpo= $("#total_po_qty").val();
    var newTotalPoqty=parseInt(prevpo) - parseInt(po);
     $("#total_po_qty").val(newTotalPoqty);
  //
    var inp= $(this).closest('tr').find('.inv_qty').val();
    var previnv= $("#total_inv_qty").val();
    var newTotalinv=parseInt(previnv) - parseInt(inp);
     $("#total_inv_qty").val(newTotalPoqty);
  //
    var unit_val= $(this).closest('tr').find('.unit_value').val();
    var prevunit= $("#total_value").val();
    var newTotalunit=parseFloat(prevunit) - parseFloat(unit_val);
     $("#total_value").val(newTotalunit);
  //Cnt   
    var cnt_val= $(this).closest('tr').find('.cnt').val();
    var prevcnt= $("#total_cnt").val();
    var newTotalcnt=parseFloat(prevcnt) - parseFloat(cnt_val);
     $("#total_cnt").val(newTotalcnt);   

   // Agent Value  
    var agn_val= $(this).closest('tr').find('.agent_value').val();
    var prevagn= $("#total_agent_val").val();
    var newTotalagn=parseFloat(prevagn) - parseFloat(agn_val);
     $("#total_agent_val").val(newTotalagn);      
  // Exp Qty
    var exp_val= $(this).closest('tr').find('.total_exp_qty').val();
    var prevexp= $("#total_exp_val").val();
    var newTotaexp=parseFloat(prevexp) - parseFloat(exp_val);
     $("#total_exp_val").val(newTotaexp);         

  });


 
});

</script>
@endsection 