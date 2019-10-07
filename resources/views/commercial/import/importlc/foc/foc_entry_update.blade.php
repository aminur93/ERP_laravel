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
                <li class="#">FOC Entry & Update</li>
                <li class="active"> FOC Update   </li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content"> 
              <div class="page-header">
               <h1>FOC Entry & Update<small><i class="ace-icon fa fa-angle-double-right"></i> FOC Update  </small></h1>
            </div>
          <!---Form -->
                 <h5 class="page-header">Add Information  </h5>
        <form class="form-horizontal" role="form" method="post" action="{{ url('/')}}/comm/import/importlc/focupdate/{{$datas[0]->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                {{-- @if($datas[0])
                @endif --}}
                <div class="col-sm-4">
               
                    <!-- PAGE CONTENT BEGINS -->

                <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="file_no" >File No.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                             {{-- {{ Form::select('file_no', $file_no, null, ['placeholder'=>'Select ','id'=> 'file_no','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }} --}}
                             <select id='suppiler' name='file_no' onchange="fileorder(this.value)" class="col-xs-12">
                                <option selected="selected" value="{{$datas[0]->cm_file_id}}">{{$datas[0]->file_no}}</option>
                              @foreach ($file_no as $fl) 
                                 <option value="{{ $fl->id }}">{{ $fl->file_no }}</option>
                              @endforeach
                          
                          </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="mode" >Mode: </label>

                          <div class="col-sm-9">
                              {{ Form::select('mode', array('Ship'=>'Ship','Air'=>'Air','Road'=>'Road'),$datas[0]->foc_mode, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}

                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="item" >Item</label>

                          <div class="col-sm-9">
                            {{ Form::select('item', $item, $datas[0]->cm_item_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="invoiceno" >Invoice No.: </label>

                          <div class="col-sm-9">
                          <input type="text" name="invoiceno"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->foc_invoice_no}}"/> 
                      
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tr_doc1" >Transport Doc No-1 </label>

                          <div class="col-sm-9">
                            <input type="text" name="tr_doc1" class="col-xs-12" value="{{$datas[0]->trans_doc_no1}}"/> 
                            
                          </div>
                        </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tr_doc2" >Transport Doc No-2 </label>

                          <div class="col-sm-9">
                             <input type="text" name="tr_doc2"placeholder="Enter"  class="col-xs-12" value="{{$datas[0]->trans_doc_no2}}"/>
                          </div>
                     </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tr_doc_date" >Transport Doc Date</label>

                          <div class="col-sm-9">
                          <input type="date" name="tr_doc_date"placeholder="Enter"  class="col-xs-12" value="{{$datas[0]->trans_doc_date}}"/>
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="supplier" >Supplier </label>

                          <div class="col-sm-9">
                               {{ Form::select('supplier',$supplier,$datas[0]->mr_supplier_sup_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                     </div> 

                           <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="value" >value </label>

                          <div class="col-sm-9">
                              <input type="text" name="value"placeholder="Enter" class="col-xs-8" value="{{$datas[0]->foc_value}}"/>
                              
                          <select class="col-sm-3" name="currency" data-validation="required length" data-validation-length="1-45"> 
                                <option value="{{$datas[0]->foc_currency}}" selected="selected">{{$datas[0]->foc_currency}}</option>
                                <option value="USD">USD $</option>
                                <option value="EUR"> EUR € </option>
                                <option value="GBP"> GBP £ </option>
                                <option value="TK"> TK ৳  </option>
                            {{-- <option value="BDT">BDT</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                            <option value="DZD">DZD</option>
                            <option value="ARP">ARP</option>
                            <option value="AUD">AUD</option>
                            <option value="ATS">ATS</option>
                            <option value="BSD">BSD</option>
                            <option value="BBD">BBD</option>
                            <option value="BEF">BEF</option>
                            <option value="BMD">BMD</option>
                            <option value="BRR">BRR</option>
                            <option value="BGL">BGL</option>
                            <option value="CAD">CAD</option>
                            <option value="CLP">CLP</option>
                            <option value="CNY">CNY</option>
                            <option value="CYP">CYP</option>
                            <option value="CSK">CSK</option>
                            <option value="DKK">DKK</option>
                            <option value="NLG">NLG</option>
                            <option value="XCD">XCD</option>
                            <option value="EGP">EGP</option>
                            <option value="FJD">FJD</option>
                            <option value="FIM">FIM</option>
                            <option value="FRF">FRF</option>
                            <option value="DEM">DEM</option>
                            <option value="XAU">XAU</option>
                            <option value="GRD">GRD</option>
                            <option value="HKD">HKD</option>
                            <option value="HUF">HUF</option>
                            <option value="ISK">ISK</option>
                            <option value="INR">INR</option>
                            <option value="IDR">IDR</option>
                            <option value="IEP">IEP</option>
                            <option value="ILS">ILS</option>
                            <option value="ITL">ITL</option>
                            <option value="JMD">JMD</option>
                            <option value="JPY">JPY</option>
                            <option value="JOD">JOD</option>
                            <option value="KRW">KRW</option>
                            <option value="LBP">LBP</option>
                            <option value="LUF">LUF</option>
                            <option value="MYR">MYR</option>
                            <option value="MXP">MXP</option>
                            <option value="NLG">NLG</option>
                            <option value="NZD">NZD</option>
                            <option value="NOK">NOK</option>
                            <option value="PKR">PKR</option>
                            <option value="XPD">XPD</option>
                            <option value="PHP">PHP</option>
                            <option value="XPT">XPT</option>
                            <option value="PLZ">PLZ</option>
                            <option value="PTE">PTE</option>
                            <option value="ROL">ROL</option>
                            <option value="RUR">RUR</option>
                            <option value="SAR">SAR</option>
                            <option value="XAG">XAG</option>
                            <option value="SGD">SGD</option>
                            <option value="SKK">SKK</option>
                            <option value="ZAR">ZAR</option>
                            <option value="KRW">SKRW</option>
                            <option value="ESP">ESP</option>
                            <option value="XDR">XDR</option>
                            <option value="SDD">SDD</option>
                            <option value="SEK">SEK</option>
                            <option value="CHF">CHF</option>
                            <option value="TWD">TWD</option>
                            <option value="THB">THB</option>
                            <option value="TTD">TTD</option>
                            <option value="TRL">TRL</option>
                            <option value="VEB">VEB</option>
                            <option value="ZMK">ZMK</option>
                            <option value="EUR">EUR</option>
                            <option value="XCD">XCD</option>
                            <option value="XDR">XDR</option>
                            <option value="XAG">XAG</option>
                            <option value="XAU">XAU</option>
                            <option value="XPD">XPD</option>
                            <option value="XPT">XPT</option> --}}
                          </select>
                          </div>
                     </div>
                           <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="quantity" >Quantity </label>

                          <div class="col-sm-9">
                              <input type="text" name="quantity"placeholder="Enter" class="col-xs-8" value="{{$datas[0]->foc_qty}}"/>
                              <?php
                              $uomList = array(
                                  "Millimeter" => "Millimeter",
                                  "Centimeter" => "Centimeter",
                                  "Meter" => "Meter",
                                  "Inch" => "Inch",
                                  "Feet" => "Feet",
                                  "Yard" => "Yard",
                                  "Piece" => "Piece");?>

                               {{ Form::select('uom', $uomList,$datas[0]->foc_uom, ['placeholder'=>'Select ','class'=> 'col-xs-3']) }}
                               
                          </div>
                     </div>
                   </div>     
                   <div class="col-sm-4">
            
                    <!-- PAGE CONTENT BEGINS -->
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="weight" >Weight:</label>

                          <div class="col-sm-9">
                             <input type="text" name="weight"placeholder="Enter" class="col-xs-12"  value="{{$datas[0]->foc_weight}}"/>
                          </div>
                        </div> 
                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="package" >Package:</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="package"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->foc_package}}"/>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="doc_type" >Doc Type:</label>

                          <div class="col-sm-9">

                            <?php
                              $docList = array(
                                  "Email" => "Email",
                                  "Original" => "Original",
                                  "Phone" => "Phone",
                                  "Others" => "Others",
                                  "Shipment Advice" => "Shipment Advice",
                                  "Non-negotiable Partial" => "Non-negotiable Partial");?>
                          
                             {{ Form::select('doc_type', $docList,$datas[0]->foc_doc_type, ['placeholder'=>'Select','class'=> 'form-control col-xs-10']) }} 
                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="docdate" >Doc Date</label>

                          <div class="col-sm-9">
                          <input type="date" name="docdate"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->foc_doc_date}}"> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="doc_dispatch_date" >Doc Dispatch Date: </label>

                          <div class="col-sm-9">
                            <input type="date" name="doc_dispatch_date"placeholder="Enter"  class="col-xs-12"  value="{{$datas[0]->foc_doc_dispatch_date}}"/> 
                      
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="port_loading" >Port Of Loading </label>

                          <div class="col-sm-9">
                            {{ Form::select('port_loading', $port, $datas[0]->cm_port_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                            
                       
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="port_loading" >Buyer</label>

                          <div class="col-sm-9">
                              <select id='buyer' name='buyer' onchange="orderlist(this.value)" class="col-xs-12">
                                  <option selected="selected" value="{{$datas[0]->mr_buyer_b_id}}">{{$datas[0]->buyer_name}}</option>
                              {{-- @foreach ($buyer as $buyer_id) 
                                   <option value="{{ $buyer_id }}">{{ $buyer_id }}</option>
                              @endforeach --}}
                            
                            </select>
                            {{-- {{ Form::select('buyer', $buyer, null, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }} --}}
                          </div>
                            
                       
                        </div> 

                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="birth_date" >Birth date</label>

                          <div class="col-sm-9">
                          <input type="date" name="birth_date"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->berth_date}}"/> 
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="noting_date" >Noting Date: </label>

                          <div class="col-sm-9">
                            <input type="date" name="noting_date"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->noting_date}}"/> 
                          </div>
                     </div> 
                     
                   </div>  

                   <div class="col-sm-4">
      
                    <!-- PAGE CONTENT BEGINS -->
                   <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="examine_date" >Examine Date </label>

                          <div class="col-sm-9">
                            <input type="date" name="examine_date"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->examine_date}}"/> 
                          </div>
                     </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="assessment_date" >Assessment Date </label>

                          <div class="col-sm-9">
                            <input type="date" name="assessment_date"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->assesment_date}}"/> 
                          </div>
                     </div>
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="delivery_date" >Delivery Date</label>

                          <div class="col-sm-9">
                           <input type="date" name="delivery_date"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->delivery_date}}"/> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="arriving_date">Factory Arriving Date: </label>

                          <div class="col-sm-9">
                            <input type="date" name="arriving_date"placeholder="Enter" class="col-xs-12" value="{{$datas[0]->fac_arrive_date}}"/>
                          </div>
                        </div>  

             
                    <div id="addELC">
                       <div class="form-group elc-sec" id="elc-sec">
                          {{-- <label class="col-sm-3 control-label no-padding-right" for="elc" >ELC</label> --}}
                          <div class="col-sm-9">
                                 {{-- {{ Form::select('elc[]', $elc, null, ['placeholder'=>'Select ','id'=>'elc','class'=> 'col-xs-6 px-0']) }} --}}
                              {{-- <div class="col-sm-9">
                                  <select id='select_u' name='selector'>
                                      <option value=''>Select</option>
                                  </select> --}}
                                  <div class="col-sm-5 pull-right">
                                      {{-- <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                      <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>  --}}
                                      <button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_buyer" type="button"> Select Order</button>
                                      
                                  </div> 
                             </div>                             
                             {{-- <label class='col-sm-6' style='padding:0px;'><br>
                              <ul class="list-group" id="selectedbox">
                                <li class="list-group-item disabled">Selected Order</li>
                              </ul>
                          </label>  --}}
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="arriving_date"></label>    
                        <div class="col-sm-9">
                          <ul class="list-group" id="selectedbox">
                              <li class="list-group-item disabled">Selected Order</li>
                              @foreach ($mrlscorderid as $mrbrid) 
                                <li class="list-group-item disabled">{{$mrbrid->order_code}}</li>
                              @endforeach
                          </ul>
                        </div>
                      </div> 
                   </div>
                   
                  
                   <div class="modal fade" id="new_buyer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h2 class="modal-title text-center" id="myModalLabel">Order</h2>
                            </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="opr_id" > Order No </label>
                                    <div class="col-sm-5" style='padding-left:20px;'>
                                     
                                        <div class="checkbox">
                                            {{-- <label class='col-sm-6' style='padding:0px;'>
                                                <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="1">
                                                <span class="lbl"> Cutting</span>
                                            </label>
                
                                            <label class='col-sm-6' style='padding:0px;'>
                                                <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="3">
                                                <span class="lbl"> Finish</span>
                                            </label>
                                                                                   <label class='col-sm-6' style='padding:0px;'>
                                                <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="2">
                                                <span class="lbl"> Input</span>
                                            </label>
                                                                                   <label class='col-sm-6' style='padding:0px;'>
                                                <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="4">
                                                <span class="lbl"> Packing</span>
                                            </label>
                                                                                   <label class='col-sm-6' style='padding:0px;'>
                                                <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="5">
                                                <span class="lbl"> Shipped</span>
                                            </label> --}}
                                            @foreach ($mrlscorderid as $order)
                                            <label class='col-sm-6' style='padding:0px;'>
                                                <input name="checker[]" id="opr_id" type="checkbox" class="ace" checked="checked" value="{{$order->order_id}}">
                                            <span class="lbl">{{$order->order_code}}</span>
                                            </label>
                                            @endforeach
                                            
                                        </div> 
                           
                                  </div>
                                </div>
                              </div>
                
                                        
                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="col-md-8">
                                        <button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                        {{-- <button class="btn btn-info btn-sm size-add-modal" id="buyer-add-modal" onclick="checkedbox()">
                                         DONE
                                       </button> --}}
                                       <a type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal" onclick="checkedbox()">Done</a>

                                     </div>
                                
                                </div>
                              </div>
                </div>
                <div class="col-sm-12">
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-6 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>
                                {{-- <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button> --}}
                            </div>
                        </div>                        
                    </form>

               </div>
            </div><!--- /. Row Form 1---->
          </div><!-- /.page-content -->
    </div>
</div>








<script type="text/javascript">

var previousData;

function myFunction(x) {
  var url = "{{url('/')}}";

  var x = document.getElementById("buyer").value;
  console.log('----------'+x);
  var url = url+'/comm/import/importlc/foc/getdata/'+x;
  var data;
  fetch(url)
  .then(data => {return data.json()})
  .then(res => {
    //console.log(res);
    var opt_sel = '';
     for(var i=0;i<res.length;i++){
        opt_sel+='<option value='+res[i]+'>'+res[i]+'</option>';
     }
     $('#select_u').html(opt_sel);
    })

}
//Prompting buyer list into dropdown
function fileorder(value) {
  var url = "{{url('/')}}";
  var url = url+'/comm/import/importlc/foc/getFileorder/'+value;
  var data;
  fetch(url)
  .then(data => {return data.json()})
  .then(res => {
    console.log(res);
    var opt_sel = '<option value=""> - select - </option>';
     for(var i=0;i<res.length;i++){
        opt_sel+='<option value=" '+res[i].b_id+' " > '+res[i].b_name+'</option>';
     }
     $('#buyer').html(opt_sel);
    })

}

//Prompting order list of the file in according to the buyer
function orderlist(id){
    url = "{{url('/')}}";
     url = url+'/comm/import/importlc/foc/getdata/'+id;
     fetch(url)
    .then(data => {return data.json()})
    .then(res => {
    console.log(res);

    opt_sel = '';
     for(var i=0;i<res['order_id'].length;i++){
        // opt_sel+=`<label class='col-sm-6' style='padding:0px;'>
        //     <input name="checker[]" id="opr_id" type="checkbox" class="ace" value="${res[i]}">
        //     <span class="lbl">${res[i]}</span>
        // </label>`;
     
        opt_sel+=`<label class='col-sm-6' style='padding:0px;'>
            <input name="checker[]" id="opr_id" type="checkbox" class="ace" value="${res['order_id'][i]}">
            <span class="lbl">${res['order_code'][i]}</span>
        </label>`;
     }
     $('.checkbox').html(opt_sel);
    })
}

//Showing the selected order into the page as list
function checkedbox() {
  console.log('..................');
  var opt_sel = '';
    var favorite = [];
    $.each($("input[name='checker[]']:checked"), function(){            
        favorite.push($(this).val());
        opt_sel+=`<li class="list-group-item disabled">${$(this).parent().find('.lbl').html()}
        </li>`;
        console.log('ok..'+$(this).val());
    });
    //console.log(favorite);
    $('#new_buyer').modal('hide');
    $('#selectedbox').html(opt_sel);
    // <li class="list-group-item disabled">Cras justo odio</li>
}

// function fileorder(value) {
//   console.log('Cottecyed..');
//   var url = "{{url('/')}}";
//   var url = url+'/comm/import/importlc/foc/getFileorder/'+value;
//   var data;
//   fetch(url)
//   .then(data => {return data.json()})
//   .then(res => {
//     console.log(res);
//     var opt_sel = '';
//      for(var i=0;i<res.length;i++){
//         opt_sel+='<option value='+res[i]+'>'+res[i]+'</option>';
//      }
//      $('#buyer').html(opt_sel);

//      url = "{{url('/')}}";
//      url = url+'/comm/import/importlc/foc/getdata/'+res;
//      fetch(url)
//     .then(data => {return data.json()})
//     .then(res => {
//     //console.log(res);
//     opt_sel = '';
//      for(var i=0;i<res.length;i++){
//         opt_sel+=`<label class='col-sm-6' style='padding:0px;'>
//             <input name="checker[]" id="opr_id" type="checkbox" class="ace" value="${res[i]}">
//             <span class="lbl">${res[i]}</span>
//         </label>`;
//      }
//      $('.checkbox').html(opt_sel);
//     })
//     })

// }

// function checkedbox() {
//   console.log('..................');
//   var opt_sel = '';
//     var favorite = [];
//     $.each($("input[name='checker[]']:checked"), function(){            
//         favorite.push($(this).val());
//         opt_sel+=`<li class="list-group-item disabled">${$(this).val()}
//         </li>`;
//         console.log('ok..'+$(this).val());
//     });
//     //console.log(favorite);
//     $('#new_buyer').modal('hide');
//     $('#selectedbox').html(opt_sel);
//     // <li class="list-group-item disabled">Cras justo odio</li>
// }


$(document).ready(function(){  

 
  //Add More  

   var data1 = $("#addELC").html();
    $('body').on('click', '.AddBtn', function(){
      //console.log(data1);
      
        $("#addELC").append(data1);
        var last = $("#addELC").children().last().attr('id');
        //var lastDiv = last.html(previousData);
        console.log(last);
        $('#select_u').html(previousData);
        //console.log('previous data-'+previousData);
    });

    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().parent().parent().remove();

    });

});

</script>
@endsection
