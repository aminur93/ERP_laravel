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
                <li class="#">Machinery </li>
                <li class="active">  Import Data Entry (Machinery)  </li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content"> 
              <div class="page-header">
               <h1> Machinery <small><i class="ace-icon fa fa-angle-double-right"></i>  Import Data Entry (Machinery) Update  </small></h1>
            </div>
          <!---Form -->
                 <h5 class="page-header">Add Information  </h5>
             <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/machinery/importdataupdate')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-4">
               
                    <!-- PAGE CONTENT BEGINS -->
                
                          <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="importcode" >Import Code :<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-8">
                             <input type="text"  name="importcode" class="col-xs-12" data-validation="required" readonly="readonly" value="{{$machine-> imp_data_machinery_import_code}}" /> 
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="bank" >Bank: <span style="color: red">&#42;</span></label>

                          <div class="col-sm-8">
                             {{ Form::select('bank', $bank, $machine->bank_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'data-validation'=>'required']) }}

                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="tr_doc1" >Transport Doc No. 1:</label>

                          <div class="col-sm-8">
                               <input type="text" name="tr_doc1"placeholder="" class="col-xs-12" value="{{$machine->imp_data_machinery_tarnsp_doc1}}" /> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="tr_doc_date" >Transport Doc Date: </label>

                          <div class="col-sm-8">
                            <input type="date" name="tr_doc_date"placeholder="Enter" class="col-xs-12" value="{{$machine->imp_data_entry_transp_doc_date}}" /> 
                      
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="tr_doc2" >Transport Doc No-2:</label>

                          <div class="col-sm-8">
                            <input type="text" name="tr_doc2" class="col-xs-12" value="{{$machine->import_data_machinery_transp_doc2}}"/> 
                            
                          </div>
                        </div> 
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="ship" >Ship Mode: </label>

                          <div class="col-sm-8">
                             
                              {{ Form::select('ship', array('Ship'=>'Ship','Air'=>'Air','Road'=>'Road'), $machine->imp_data_entry_shipmode, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}

                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="weight" >Weight (kg):</label>

                          <div class="col-sm-8">
                             <input type="text" name="weight"placeholder="Enter"  class="col-xs-12" value="{{$machine->imp_data_machinery_weight}}" />
                          </div>
                     </div> 
                    <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="Cubic_measurement" >Cubic Measurement:</label>

                          <div class="col-sm-8">
                             <input type="text" name="Cubic_measurement"placeholder="Enter"  class="col-xs-12" value="{{$machine->import_data_machinery_cub_measure}}"/>
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="country" >Country Of Origin: </label>

                          <div class="col-sm-8">
                               {{ Form::select('country', $country, $machine->cnt_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="carrier" >Carrier :</label>

                          <div class="col-sm-8">
                              <input type="text" name="carrier"placeholder="Enter" class="form-control" value="{{$machine->imp_data_machinery_carrier}}"/>
                          </div>
                     </div>
                    <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="ship_com" >Ship Company :</label>

                          <div class="col-sm-8">
                              <input type="text" name="ship_com"placeholder="Enter" class="form-control" value="{{$machine->import_data_machinery_ship_comp}}"/>
                          </div>
                     </div>
                    

                  </div> 

                  <div class="col-sm-4">
            
                    <!-- SECOND COLUMN BEGINS -->
                     
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="container1" >Container-1 :</label>

                          <div class="col-sm-8">
                              <input type="text" name="container1"placeholder="Enter" class="form-control" value="{{$machine->imp_data_machinery_container1}}"/>
                          </div>
                     </div>
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="container2" >Container-2 :</label>

                          <div class="col-sm-8">
                              <input type="text" name="container2"placeholder="Enter" class="form-control" value="{{$machine->imp_data_machinery_containe2}}"/>
                          </div>
                     </div>
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="container3" >Container-3 :</label>

                          <div class="col-sm-8">
                              <input type="text" name="container3"placeholder="Enter" class="form-control" value="{{$machine->imp_data_machinery_containe3}}"/>
                          </div>
                     </div>
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="package" >Package:</span> </label>

                          <div class="col-sm-8">
                            <input type="text" name="package"placeholder="Enter" class="col-xs-12" value="{{$machine->imp_data_machinery_package}}"/>
                          </div>
                        </div> 


                           <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="value" >value :</label>

                          <div class="col-sm-8">
                              <input type="text" name="value"placeholder="Enter" class="col-xs-8" value="{{$machine->imp_data_machinery_value}}"/>
                              
                              <select class="col-sm-3" name="currency" data-validation="required length" data-validation-length="1-45"> 
                                 <option  value="{{$machine->imp_data_machinery_currency}}" selected="selected">{{$machine->imp_data_machinery_currency}}</option>
                                
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
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="doc_type" >Doc Type:</label>

                          <div class="col-sm-8">

                            <?php
                              $docList = array(
                                  "Email" => "Email",
                                  "Original" => "Original",
                                  "Phone" => "Phone",
                                  "Others" => "Others",
                                  "Shipment Advice" => "Shipment Advice",
                                  "Non-negotiable Partial" => "Non-negotiable Partial");?>
                          
                             {{ Form::select('doc_type', $docList, $machine->import_data_machinery_doc_type, ['placeholder'=>'Select','class'=> 'form-control col-xs-10']) }} 
                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="docdate" >Doc Receive <br/>Date :</label>

                           <div class="col-sm-8">
                            <input type="date" name="docdate"placeholder="Enter" class="col-xs-12" value="{{$machine->imp_data_machinery_doc_recv_date}}"> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="quantity" >Machine Qty : </label>

                          <div class="col-sm-8">
                            <input type="text" name="quantity" placeholder="Enter"  class="form-control" value="{{$machine->import_data_machinery_quantity}}"/> 
                      
                          </div>
                        </div>  

                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="port_loading" >Port Of Loading: </label>

                          <div class="col-sm-8">
                            {{ Form::select('port_loading', $port, $machine->port_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                            
                       
                        </div> 
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="container-size" >Container Size :</label>

                          <div class="col-sm-8">
                            {{ Form::select('container_size', array('FCL'=>'FCL','LCL'=>'LCL'), $machine->imp_data_machinery_container_size, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10']) }}
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="mother_vessel" >Mother Vessel : </label>

                          <div class="col-sm-8">
                            {{ Form::select('mother_vessel', $vessel, $machine->vess_id, ['placeholder'=>'Select ','id'=> 'vessel','class'=> 'form-control col-xs-10']) }}
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="voyage_no" >Voyage No : </label>

                          <div class="col-sm-8">
                           
                           <select name="voyage_no" id="voyage" class="col-xs-12">
                             <option value="{{$machine->vess_id}}">{{$machine->vess_id }}</option> 
                           </select>
                         </div>
                     </div> 
                     
                   </div>  

                   <div class="col-sm-4"  style="background:#ccc;padding: 20px 20px 20px 0;text-align: center;">
      
                    <!-- PAGE CONTENT BEGINS -->
                   <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="examine_date" >File No: </label>

                          <div class="col-sm-8">
                            <input type="text" name="file_no" placeholder="Enter" value="{{$fileno}}" class="form-control" readonly="readonly" /> 
                          </div>
                     </div>
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="item" >Item :</label>

                          <div class="col-sm-8">
                            <input type="text" name="item"placeholder="Enter" value="{{$item}}" class="form-control" readonly="readonly"/> 
                          </div>
                     </div>
                        
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="unit" >Unit:</label>

                          <div class="col-sm-8">
                           <input type="text" name="unit"placeholder="Enter" id="unitname"  value="{{$unit->hr_unit_name}}" class="form-control" readonly="readonly" /> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="ilcno">ILC No : </label>

                          <div class="col-sm-8">
                            <input type="text" name="ilcno"placeholder="Enter" value="{{$ilcno}}" class="form-control" readonly="readonly"/>
                          </div>
                        </div>

                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="supplier" >Supplier</label>

                          <div class="col-sm-8">
                                 <input type="text" placeholder="Enter" id="supplier" value="{{$sppplier->sup_name}}"  class="form-control" readonly="readonly"/>

                                  <input type="hidden" name="supplier" value="{{$supplid}}"  readonly="readonly"/>
                          </div>
                        </div>

                      </div>

               <!-- /.col -->
          <div class="row">       
            <div class="col-md-11">
              <div class="table-responsive">
                        <table id="bomTable" class="table table-bordered table-striped table-highlight" >
                            <thead>
                                <th>Invoice No.</th>
                                <th>Invoice Date</th>
                                <th>PI No.</th>
                                <th>PI Date</th>
                             
                                <th>Item</th>
                              
                                <th>Value</th>
                           
                                <th>Action</th>
                            </thead>
                            <tbody class="addRemove min-font">
                              @foreach($machine_invoice as $inv)
                                <tr id="invoice0" class="no-padding">
                                    <td>
                                       <input type="text" name="invoiceno[]" placeholder="Enter"class="form-control" value="{{$inv->imp_data_machinery_inv_no}}" /> 
                                       <input type="hidden" name="rowno[]" value="invoice0"  class="invrow" /> 
                                    </td>
                                    <td >
                                         <input type="date" name="invoicedate[]" class="form-control" value="{{$inv->imp_data_machinery_inv_date}}"/>  
                                    </td> 
                                    <td>
                                     <select name="pi_no[]" id="pi_no" class="pi_no form-control">
                                       
                                        <option>{{$inv->imp_data_machinery_inv_pi}}</option>
                                         @foreach($pino as $pno)

                                         <option value="{{$pno->machinery_pi_pi_no}}">{{$pno->machinery_pi_pi_no}}
                                         </option> 

                                         @endforeach
                                      
                                        </select> 
                                    </td> 
                                    <td>
                                      <input type="date" name="pidate[]" id="pidate" class="form-control pidate" readonly="readonly" />
                                    </td>
                                    <td>
                                      <input type="text" name="itemlist[]" class="form-control itemlist" readonly="readonly"  value="{{$inv->machinery_pi_item}}" />
                                    </td>  
                                 
                                    <td>
                                      <input type="text" name="inv_value[]" class="form-control" value="{{$inv->imp_data_machinery_inv_value}}"  />
                                    </td>
                               
                                    <td>
                                        <button type="button" class="btn btn-xs btn-success AddBtn">+</button>
                                        <button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div> 
              </div>

            

                <div class="col-sm-12">
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> <input type="hidden" name="pi_id" placeholder="Enter" class="form-control" value="{{$pid}}" />

                               <input type="hidden" name="m_import_id" placeholder="Enter" class="form-control" value="{{$machine->imp_data_machinery_id}}" />

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

        <!--------------------------->
          </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  

   var count = 1;
  //Add More Invoice Table  

    $('body').on('click', '.AddBtn', function(){

        var data = '<tr id="invoice'+count+'" class="no-padding">'+
            '<td>'+
           '<input type="text" name="invoiceno[]" placeholder="Enter"class="form-control" />'+
           '<input type="hidden" name="rowno[]" value="invoice'+count+'"  class="invrow" />'+
        '</td>'+
        '<td>'+
             '<input type="date" name="invoicedate[]" class="datepicker form-control" />'+  
       ' </td>'+
        '<td>'+
           '<select name="pi_no[]" id="pi_no" class="pi_no form-control">'+
              '<option>Select</option>'+
               '@foreach($pino as $pno)'+
               '<option value="{{$pno->machinery_pi_pi_no}}">{{$pno->machinery_pi_pi_no}}'+
               '</option>'+
               '@endforeach'+
              '</select>'+
       ' </td>'+
       '<td>'+
          '<input type="date" name="pidate[]" id="pidate" class="form-control pidate" readonly="readonly" />'+
       '</td>'+
     
        '<td>'+
        ' <input type="text" name="itemlist[]" class="form-control itemlist" readonly="readonly" />'+
        '</td>'+
        '<td>'+
          '<input type="text" name="inv_value[]" class="form-control"/>'+
        '</td>'+
       
        '<td>'+
            '<button type="button" class="btn btn-xs btn-success AddBtn">+</button>'+
            '<button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>'+
        '</td>'+      
      '</tr>';

    $('.addRemove').append(data);
      count++;
    });

    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().remove();
        var rowid=$(this).parent().parent().attr("id");
        $("table."+rowid).remove();  // remove table with rowid class name

     //$("table#"+rowid).remove();
    // $("table#table_id_"+ $(this).parent().parent().attr("id")).remove();
    });


 //// Import Auto Code Ajax

     var importcode = $("#importcode");
   
        var pi_no = $("#unitname").val();
        var s_id  = $("#supplier").val();
   
        
        $.ajax({
            url : "{{ url('comm/import/machinery/importcode') }}",
            type: 'get',
            data: {s_id, pi_no},
            success: function(data)
            {
                importcode.val(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });


// Voyage select Based On Mother Vessel

    var basedon = $("#vessel");
    var action_voyage = $("#voyage");

      basedon.on("change", function(){ 

        // Action Element list
        $.ajax({
            url : "{{ url('comm/import/machinery/voyage') }}",
            type: 'get',
            data: {vess_id : $(this).val()},
            success: function(data)
            {
                action_voyage.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });

// PI Date Based On PI No.

    var basedonpi = $(".pi_no");
  
$("body").on("change", ".pi_no", function(){
     
       var that = $(this);
       var action_date = $(".pidate");
        // Action Element list
        $.ajax({
            url : "{{ url('comm/import/machinery/pidate') }}",
            type: 'get',
            data: {p_no : $(this).val()},
            success: function(data)
            {
             
               that.parent().parent().find(".pidate").val(data.pidate); 
               that.parent().parent().find(".itemlist").val(data.item);
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