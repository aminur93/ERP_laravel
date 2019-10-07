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
                <li class="#"> Machinery</li>
                <li class="active"> FOC Entry Update  </li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content"> 
              <div class="page-header">
               <h1>Machinery <small><i class="ace-icon fa fa-angle-double-right"></i> FOC Entry  Update</small></h1>
            </div>
          <!---Form -->
                 <h5 class="page-header">Update Information  </h5>
             <form class="form-horizontal" role="form" method="post" action="{{ url('/')}}/comm/import/importlc/focupdate/{{$data->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-4">
               
                    <!-- PAGE CONTENT BEGINS -->
                
                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="file_no" >File No.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                             {{ Form::select('file_no', $file_no, $data->exp_lc_fileno, ['placeholder'=>'Select ','id'=> 'file_no','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="mode" >Mode: </label>

                          <div class="col-sm-9">
                              {{ Form::select('mode', array('Ship'=>'Ship','Air'=>'Air','Road'=>'Road'), $data->foc_lc_mode, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}

                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="item" >Item</label>

                          <div class="col-sm-9">
                            {{ Form::select('item', $item,  $data->item_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="invoiceno" >Invoice No.: </label>

                          <div class="col-sm-9">
                            <input type="text" name="invoiceno"placeholder="Enter" value="{{$data->foc_lc_inv_no}}" class="col-xs-12"/> 
                      
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tr_doc1" >Transport Doc No-1 </label>

                          <div class="col-sm-9">
                            <input type="text" name="tr_doc1" class="col-xs-12" value="{{$data->foc_lc_transp_doc1}}" /> 
                            
                          </div>
                        </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tr_doc2" >Transport Doc No-2 </label>

                          <div class="col-sm-9">
                             <input type="text" name="tr_doc2"placeholder="Enter" value="{{$data->foc_lc_transp_doc2}}"  class="col-xs-12" />
                          </div>
                     </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tr_doc_date" >Transport Doc Date</label>

                          <div class="col-sm-9">
                             <input type="date" name="tr_doc_date"placeholder="Enter"value="{{$data->foc_lc_transp_date}}"  class="col-xs-12" />
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="supplier" >Supplier </label>

                          <div class="col-sm-9">
                               {{ Form::select('supplier', $supplier, $data->sup_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                     </div> 

                           <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="value" >value </label>

                          <div class="col-sm-9">
                              <input type="text" name="value"placeholder="Enter" value=" {{$data->foc_lc_value}}" class="col-xs-8" />
                              
                          <select class="col-sm-3" name="currency" data-validation="required length" data-validation-length="1-45"> 
                            <option value="{{$data->foc_lc_currency}}" selected="selected">{{$data->foc_lc_currency}}</option>
                            <option value="USD">USD</option>
                            <option value="BDT">BDT</option>
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
                            <option value="XPT">XPT</option>
                          </select>
                          </div>
                     </div>
                           <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="quantity" >Quantity </label>

                          <div class="col-sm-9">
                              <input type="text" name="quantity"placeholder="Enter" value="{{$data->foc_lc_qty}}" class="col-xs-8" />
                              <?php
                              $uomList = array(
                                  "Millimeter" => "Millimeter",
                                  "Centimeter" => "Centimeter",
                                  "Meter" => "Meter",
                                  "Inch" => "Inch",
                                  "Feet" => "Feet",
                                  "Yard" => "Yard",
                                  "Piece" => "Piece");?>

                               {{ Form::select('uom', $uomList, $data->foc_lc_uom, ['placeholder'=>'Select ','class'=> 'col-xs-3']) }}
                               
                          </div>
                     </div>
                   </div>     
                   <div class="col-sm-4">
            
                    <!-- PAGE CONTENT BEGINS -->
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="weight" >Weight:</label>

                          <div class="col-sm-9">
                             <input type="text" name="weight"placeholder="Enter" class="col-xs-12" value="{{$data->foc_lc_weight}}"/>
                          </div>
                        </div> 
                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="package" >Package:</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="package"placeholder="Enter" value="{{$data->foc_lc_package}}" class="col-xs-12" />
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
                          
                             {{ Form::select('doc_type', $docList, $data->foc_lc_doctype, ['placeholder'=>'Select','class'=> 'form-control col-xs-10']) }} 
                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="docdate" >Doc Date</label>

                          <div class="col-sm-9">
                            <input type="date" name="docdate"placeholder="Enter" value="{{$data->foc_lc_doc_date}}" class="col-xs-12" > 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="doc_dispatch_date" >Doc Dispatch Date: </label>

                          <div class="col-sm-9">
                            <input type="date" name="doc_dispatch_date"placeholder="Enter" value="{{$data->foc_lc_dispatch_date}}"  class="col-xs-12"/> 
                      
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="port_loading" >Port Of Loading </label>

                          <div class="col-sm-9">
                            {{ Form::select('port_loading', $port, $data->port_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                            
                       
                        </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="birth_date" >Berth date</label>

                          <div class="col-sm-9">
                            <input type="date" name="birth_date"placeholder="Enter" value="{{$data->foc_lc_berth_date}}" class="col-xs-12"/> 
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="noting_date" >Noting Date: </label>

                          <div class="col-sm-9">
                            <input type="date" name="noting_date"placeholder="Enter"  value="{{$data->foc_lc_noting_date}}" class="col-xs-12"/> 
                          </div>
                     </div> 
                     
                   </div>  

                   <div class="col-sm-4">
      
                    <!-- PAGE CONTENT BEGINS -->
                   <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="examine_date" >Examine Date </label>

                          <div class="col-sm-9">
                            <input type="date" name="examine_date"placeholder="Enter" value="{{$data->foc_lc_examine_date}}" class="col-xs-12"/> 
                          </div>
                     </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="assessment_date" >Assessment Date </label>

                          <div class="col-sm-9">
                            <input type="date" name="assessment_date" value="{{$data->foc_lc_assesment_date}}" placeholder="Enter" class="col-xs-12"/> 
                          </div>
                     </div>
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="delivery_date" >Delivery Date</label>

                          <div class="col-sm-9">
                           <input type="date" name="delivery_date"placeholder="Enter" value="{{$data->foc_lc_delivery_date}}" class="col-xs-12"/> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="arriving_date">Factory Arriving Date: </label>

                          <div class="col-sm-9">
                            <input type="date" name="arriving_date"placeholder="Enter" value="{{$data->foc_lc_arriving_date}}"class="col-xs-12"/>
                          </div>
                        </div>
                      <div id="addELC">
                    @if(!empty($dataElc2))   
                       @foreach($dataElc as $el) 
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="elc" >ELC</label>

                          <div class="col-sm-9">
                                 {{ Form::select('elc[]', $elc, $el->exp_lc_fileno, ['placeholder'=>'Select ','class'=> 'col-xs-6 px-0']) }}

                                <div class="col-sm-5 pull-right">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                              </div>  
                          </div>
                        </div>
                       @endforeach
                      @else
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="elc" >ELC</label>

                          <div class="col-sm-9">
                                 {{ Form::select('elc[]', $elc, null, ['placeholder'=>'Select ','class'=> 'col-xs-6 px-0']) }}

                                <div class="col-sm-5 pull-right">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                                </div>  
                           </div>
                        </div>
                      @endif 
                    </div>
                  </div>  
                <!-- /.col -->
                <div class="col-sm-12">
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> <input type="hidden" name="foc_id" value="{{$data->foc_lc_id}}">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
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

 
  //Add More  

   var data1 ='<div class="form-group">\
                          <label class="col-sm-3 control-label no-padding-right" for="elc" >ELC</label>\
                          <div class="col-sm-9">\
                                 {{ Form::select('elc[]', $elc, null, ['placeholder'=>'Select ','class'=> 'col-xs-6 px-0']) }}\
                                <div class="col-sm-5 pull-right">\
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>\
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>\
                                     </div>\
                                    </div>\
                                  </div>';
    $('body').on('click', '.AddBtn', function(){
        $("#addELC").append(data1);
    });

    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().parent().remove();

    });

});

</script>
@endsection