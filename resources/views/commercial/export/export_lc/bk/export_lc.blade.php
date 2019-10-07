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
                    <a href="#">Export L/C </a>   
                </li> 
                <li class="active"> Export L/C Entry</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i> Export L/C Entry  </small></h1>
            </div>
           <form class="form-horizontal" role="form" method="post" action=" {{ url('comm/exportlc/store') }}" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="row">
                  @include('inc/message')

                       
                    <div class="col-md-4 ">
                       
                        <div class="form-group ">
                            <label class="col-sm-4 control-label no-padding-right font-weight-bold" for="fileno">File No:<span style="color: red">&#42;</span> </label>
                          
                          <div class="col-sm-8">
                            <input type="text" name="fileno" id="fileno" value=""placeholder="Enter" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>
                        
                        <div class="form-group ">
                            <label class=" col-sm-4 control-label no-padding-right" for="product" >Buyer: <span style="color: red">&#42;</span></label>
                          
                           <div class="col-sm-8">
                               {{ Form::select('buyer', $buyer, null, ['placeholder'=>'Select Country','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }} 
                            </div>
                            
                        </div>

                        <div class="form-group ">
                            <label class="col-sm-4 control-label no-padding-right" for="ex_lcno" >Export L/C No.:<span style="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                            <input type="text" name="ex_lcno" id="ex_lcno" value=""placeholder="Enter" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                               
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="elc_date" >ELC Date: </label>
                            <div class="col-sm-8">
                             <input type="date" name="elc_date" id="elc_date" value=""placeholder="Enter" class=" form-control"/>
                            </div> 
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-4 control-label no-padding-right" for="elc_bank" >Open Bank: </label>
                             <div class="col-sm-8">
                               {{ Form::select('elc_bank', $bank, null, ['placeholder'=>'Select Bank','class'=> 'form-control col-xs-10']) }} 
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="form-check-label col-sm-4 control-label no-padding-right" for="cmpc" >LC Type: </label>

                             <div class="col-sm-8">  
                              <input type="radio" class="form-check-input" id="lctype" name="lctype" value="ELC"> ELC<br/>
                               <input type="radio" class="form-check-input" name="lctype" value="Contract"> Contract
                           </div>
                        </div>

                    </div>

                    <div class="col-md-4 ">
                          <div class="form-group ">
                            <label class="col-sm-4 control-label no-padding-right" for="lc_ex_date" >Expiry Date </label>
                             <div class="col-sm-8">
                             <input type="date" name="lc_ex_date" id="lc_ex_date" value=""placeholder="Enter" class=" form-control"/>
                            </div> 

                        </div>
                        <div class="form-group ">
                            <label class="col-sm-4 control-label no-padding-right" for="operation" >Initial Value: </label>
                            <div class="col-sm-8">
                             <input type="text" name="ini_value" id="ini_value" value=""placeholder="Enter" class="col-sm-7"/>
                             <!--{!! Form::select('currency', array('L' => 'Large', 'S' => 'Small'), 'S'); !!}-->
                          <select class="col-sm-3" name="currency"> 
                            <option value="USD" selected="selected">USD</option>
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
                       
            </div>
          </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
             
                <div class="col-md-12 form-horizontal">
                    <!-- PAGE CONTENT BEGINS --> 
             <!----------------------------------------->

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
                            
                        <div class="row form-group">

                          <div class="col-xs-2 col-sm-2"><h5>Amendment No.</h5></div>
                          <div class="col-xs-2 col-sm-2"><h5>Amendment Date</h5></div>
                          <div class="col-xs-2 col-sm-2"><h5>Expiry Date</h5></div>
                          <div class="col-xs-2 col-sm-2"><h5>ELC Amount</h5></div>
                          <div class="col-xs-2 col-sm-2"><h5>Total Amount</h5></div>
                          <div class="col-xs-2 col-sm-2"><h5>&nbsp;</div>
                       </div>   
                       <div id="add_amend">
                        <div class="form-group">
                          <div class="col-sm-12">

                            <div class="col-sm-2">
                            <input type="text" name="amend_no[]" id="amend_no" value=""placeholder="Enter" class="col-xs-12 form-control" /></div>

                            <div class="col-xs-2">
                                       <input type="date" name="amend_date[]" value=""placeholder="Enter" class="col-xs-12 form-control"/>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="date" name="amend_ex_date[]" value=""placeholder="Enter" class="col-xs-12 form-control"/>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" name="elc_ammount[]"  value=""placeholder="Enter" class="col-xs-12 form-control elc_ammount"/>
                                    </div>
                                    <div class="col-xs-2">  
                                      <input type="text" name="elc_total_ammount[]" value=""placeholder="Enter" class="col-xs-12 form-control elc_total_ammount" />
                                    </div>

                              <div class="col-sm-2">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_amend">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_amend">-</button> 
                              </div>  

                             </div>
                           </div>

                        </div>  
                      </div> 
                    
                      <!-- Address book -->
                        <div id="addressbook" class="tab-pane fade">
                       
                        <div class="form-group">
                          <label class="col-sm-2 control-label no-padding-right" for="country" >Country </label>

                          <div class="col-sm-5">
                             {{ Form::select('country', $country, null, ['placeholder'=>'Select','class'=> 'col-xs-12 col-md-12']) }} 
                             </div>
                           </div>

                         <div class="form-group">
                          <label class="col-sm-2 control-label no-padding-right" for="notify_addrss" >Notify Address </label>

                          <div class="col-sm-5">
                            <textarea name="notify_addrss" class="form-control" id="notify_addrss" data-validation=" length" data-validation-length="0-144"> </textarea>
                             </div>
                           </div>

                          <div class="form-group">
                           <label class="col-sm-2 control-label no-padding-right" for="buyer_addrss" >Buyer Address </label>

                          <div class="col-sm-5">
                            <textarea name="buyer_addrss" class="form-control" id="buyer_addrss" data-validation="length" data-validation-length="0-144"> </textarea>
                             </div>
                           </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="notify_addrss2" >Notify Address 2</label>

                           <div class="col-sm-5">
                             <textarea name="notify_addrss2" class="form-control" id="notify_addrss2" data-validation=" length" data-validation-length="0-144"> </textarea>
                             </div>
                          </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="notify_addrss3" >Notify Address 3</label>

                           <div class="col-sm-5">
                             <textarea name="notify_addrss3" class="form-control" id="notify_addrss3" data-validation=" length" data-validation-length="0-144"> </textarea>
                             </div>
                          </div>
                         </div> 
                          
               
                      
                  </div> 
              </div> 
             <!----------------------------------------->

             <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
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
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){  


  //Add More  

   var data1 = $("#add_amend").html();
    $('body').on('click', '.AddBtn_amend', function(){
        $("#add_amend").append(data1);
    });

    $('body').on('click', '.RemoveBtn_amend', function(){
        $(this).parent().parent().parent().remove();

    });

   ///Total Amount 
   
   $('body').on("keyup", ".elc_ammount, #ini_value", function() {  
    var sum = parseFloat($("#ini_value").val());

      $(".elc_ammount").each(function(){
          sum += +$(this).val();
          $(this).parent().parent().find('.elc_total_ammount').val(parseFloat(sum).toFixed(2)) 
      }); 
   }); 


 
///**End Total Amount 

  });

</script>
@endsection

