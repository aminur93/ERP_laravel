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
                    <a href="#"> Machinery </a>
                </li>
                <li class="active"> Machinery PI Entry </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Machinery <small><i class="ace-icon fa fa-angle-double-right"></i> Machinery PI Entry   </small></h1>
            </div>
           <form class="form-horizontal" role="form" method="post" action=" {{ url('comm/import/machinery/machinerypistore') }}" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="row">
                  @include('inc/message')
                <div class="col-sm-12"><h5 class="page-header">   Add Machinery PI  </h5>
                 </div>
                         
                  <div class="col-sm-6">
                 
                    <!-- PAGE CONTENT BEGINS --> 
               

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_fileno" >File No<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="pi_fileno" id="pi_fileno" placeholder="Enter Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="unit_id" >Unit<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            {{ Form::select('unit_id', $unit, null, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                           
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_item" >Item<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="pi_item" id="pi_item" placeholder="Enter Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div> 
                      <div id="accno">
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_pi_no" >P.I No.<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="pi_pi_no" id="pi_pi_no" placeholder="Enter Code" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>
                     </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_pi_date" >P.I Date<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                               <input type="date" name="pi_pi_date" id="pi_pi_date" value=""placeholder="Enter" class=" form-control"  data-validation="required"/>
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="com_sup_id" >Supplier Name<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                                 {{ Form::select('com_sup_id', $supplier, null, ['placeholder'=>'Select ','id'=> 'supp-name','class'=> 'pull-left col-sm-7', 'data-validation' => 'required']) }}

                                  <input type="text" name="pi_sup_code" id="pi_sup_code"class="pull-right col-xs-4" placeholder="Code" data-validation="required"/>
                          </div>
                        </div> 

                        <div class="form-group ">
                            <label class="form-check-label col-sm-3 control-label no-padding-right" for="pi_active" >Active PI: </label>

                             <div class="col-sm-8">  
                              <input type="radio" class="form-check-input" id="pi_active" name="pi_active" value="Yes" data-validation="required"> Yes
                               <input type="radio" class="form-check-input" name="pi_active" value="No" data-validation="required"> No
                           </div>
                        </div>
                           <div class="form-group ">
                            <label class="form-check-label col-sm-3 control-label no-padding-right" for="pi_active" >L/C Status: </label>

                             <div class="col-sm-8">  
                              <input type="radio" class="form-check-input" id="pi_lc_status" name="pi_lc_status" value="Foreign"> Foreign
                               <input type="radio" class="form-check-input" name="pi_lc_status" value="Local"> Local
                           </div>
                        </div>

                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_description" >Description<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                               <input type="text" name="pi_description" id="pi_description" value=""placeholder="Enter" class=" form-control"   data-validation="required length" data-validation-length="1-45"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_model_no" >Model No.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                               <input type="text" name="pi_model_no" id="pi_model_no" value=""placeholder="Enter" class=" form-control"   data-validation="required length" data-validation-length="1-45"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="machine_type" >Machine Type<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            {{ Form::select('machine_type', $mcn_type, null, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                           
                          </div>
                        </div>
                      
                        <!-- /.row --> 
           </div>

           <div class="col-sm-6">

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="manf_id" >Manufacturer </label>

                          <div class="col-sm-9">
                              {{ Form::select('manf_id', $manuf, null, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="marine_insurance_no" >Marine Insurance No.: </label>

                          <div class="col-sm-9">
                           <input type="text" name="marine_insurance_no" id="marine_insurance_no" placeholder="Enter Code" class="col-xs-12" data-validation="length" data-validation-length="1-45"/>
                           
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="insurance_date" >Marine Insurance Date</label>

                          <div class="col-sm-9">
                            <input type="date" name="insurance_date" id="insurance_date" placeholder="Enter Date" class="col-xs-12"/>
                          </div>
                        </div> 
                      <div id="accno">
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="insurance_comp">Insurance Company Code </label>

                          <div class="col-sm-9">
                            {{ Form::select('insurance_comp', $insurance, null, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                        </div>
                     </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_quantity" >Quantity<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                               <input type="text" name="pi_quantity" id="pi_quantity" value=""placeholder="Enter" class=" form-control"  data-validation="required length" data-validation-length="1-45"/>
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_unit_price" >Unit Price<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                              <input type="text" name="pi_unit_price" id="pi_unit_price" value=""placeholder="Enter" class=" form-control"  data-validation="required length" data-validation-length="1-45"/>
                          </div>
                        </div> 

                        <div class="form-group ">
                            <label class="form-check-label col-sm-3 control-label no-padding-right" for="pi_pi_amount" >P.I Amount:<span style="color: red">&#42;</span>  </label>

                            <div class="col-sm-8">  
                             <input type="text" name="pi_pi_amount" id="pi_pi_amount" value=""placeholder="Enter" class="col-sm-8"  data-validation="required length" data-validation-length="1-45"/>

                          <select class="col-sm-3" name="currency" data-validation="required length" data-validation-length="1-45"> 
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
                           <div class="form-group ">
                            <label class="form-check-label col-sm-3 control-label no-padding-right" for="pi_pi_lastdate" >P.I Last Date:<span style="color: red">&#42;</span>  </label>

                             <div class="col-sm-8">  
                               <input type="date" name="pi_pi_lastdate" id="pi_pi_lastdate"  class=" form-control"   data-validation="required"/>
                           </div>
                        </div>
                    <div id="addOrder">
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="order_id" >Order Number</label>

                          <div class="col-sm-9">
                               <input type="text" name="  order_id[]" id="order_id" value=""placeholder="Enter" class="col-sm-7"   data-validation="length custom" data-validation-length="1-11"  data-validation-regexp="^([,0-9]+)$"/>

                                <div class="col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                              </div>  
                          </div>
                        </div>
                      </div>
                     
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="pi_remarks" >Remarks: </label>

                          <div class="col-sm-9">
                            <textarea name="pi_remarks" id="pi_remarks" class=" form-control"data-validation="length" data-validation-length="1-45"></textarea>
                          </div>
                        </div>

                    </div><!-- /Col-6 -->

        </div><!-- /.row -->


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
                    
           </div>
       
        </div><!-- /.page-content -->
      </form>
    </div>

<script type="text/javascript">
  $(document).ready(function(){  


  //Add More  

   var data1 = $("#addOrder").html();
    $('body').on('click', '.AddBtn', function(){
        $("#addOrder").append(data1);
    });

    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().parent().remove();

    });

//// Supplier Code Ajax

     var supplcode = $("#pi_sup_code");
     var sup_name = $("#supp-name");
   

      $("body").on("change", "#pi_pi_no, #supp-name",  function(){ 
        var pi_no = $("#pi_pi_no").val();
        var s_id  = $("#supp-name").val();
   
        
        $.ajax({
            url : "{{ url('comm/import/machinery/suppliercode') }}",
            type: 'get',
            data: {s_id, pi_no},
            success: function(data)
            {
                supplcode.val(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
/// 
 
});

</script>
@endsection

