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
                <li class="active">  Export L/C Entry Update Screen 2   </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
              <div class="page-header">
               <h1> Export L/C <small><i class="ace-icon fa fa-angle-double-right"></i>  Export L/C Entry Update Screen 2  </small></h1>
            </div>
          <!---Form -->
                 <!-- <h5 class="page-header">Add Information  </h5> -->
             <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/export/export-lc-update-screen-save')}}" enctype="multipart/form-data">
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
                          <label class="col-sm-4 control-label no-padding-right" for="cf_doc_dispatch_date" >C&F Doc Dispatch Date :<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-8">
                             <input type="date"  name="cf_doc_dispatch_date" class="col-xs-12" data-validation="required"  />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="ex_fty_date" >Ex-Fty Date:</label>
                          <div class="col-sm-4">
                               <input type="date" name="ex_fty_date" placeholder="enter" class="col-xs-12"/>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" name="agent_invoice_no" id="agent-invoice-no" placeholder="enter" value="" class="col-xs-12" readonly/>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="shipping_company" >Shipping Company: </label>
                            <div class="col-sm-8">
                              <input type="date" name="shipping_company"placeholder="Enter" class="col-xs-12"/>
                            </div>
                          </div>
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="staffing_date" >Staffing Date: </label>
                          <div class="col-sm-8">
                            <input type="date" name="staffing_date"placeholder="Enter" class="col-xs-12"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="feeder_vessel_name_no" >Feeder Vessel Name & No:</label>
                          <div class="col-sm-8">
                            <input type="text" name="feeder_vessel_name_no" class="col-xs-12" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="vessel_berth" >Vessel Berth:</label>
                          <div class="col-sm-8">
                             <input type="text" name="vessel_berth"placeholder="Enter"  class="col-xs-12" />
                          </div>
                     </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="transport_doc_no_of_ship_co" >Transport Doc No of Ship. Co.:</label>
                          <div class="col-sm-8">
                              <input type="text" name="transport_doc_no_of_ship_co"placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                    <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="transport_doc_date_of_ship_co" >Transport Doc Date of Ship. Co.:</label>
                          <div class="col-sm-8">
                              <input type="date" name="transport_doc_date_of_ship_co"placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                   </div>
                  <div class="col-sm-6">

                    <!-- SECOND COLUMN BEGINS -->
                      <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="shipping_bill_no" >Shipping Bill No.:</label>
                          <div class="col-sm-8">
                              <input type="text" name="shipping_bill_no" placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="shipping_bill_date" >Shipping Bill Date:</label>
                          <div class="col-sm-8">
                              <input type="date" name="shipping_bill_date" placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="examine_date" >Examine Date:</label>
                          <div class="col-sm-8">
                              <input type="date" name="examine_date"placeholder="Enter" class="form-control" />
                          </div>
                     </div>
                     <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right" for="exp_release_date" >Exp. Release Date:</span> </label>
                          <div class="col-sm-8">
                            <input type="date" name="exp_release_date"placeholder="Enter" class="col-xs-12" />
                          </div>
                        </div>
                        <div class="form-group ">
                          <br>
                             <label class="col-sm-2 control-label no-padding-right " for="final_date" >Final Date:</span> </label>
                             <div class="col-sm-1 custom-control custom-checkbox">
                               <br>
                               <input type="checkbox" name="final_date" class="col-xs-12 custom-control-input" />
                             </div>
                           </div>
                   </div>
               <!-- /.col -->
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                        <table id="bomTable" class="table table-bordered table-striped table-highlight" >
                            <thead>
                                <th>Container No.</th>
                                <th>Size</th>
                                <th>Container SI.</th>
                                <th>Quantity</th>
                                <th>UoM</th>
                                <th>PKg</th>
                                <th></th>
                            </thead>
                            <tbody class="addRemove min-font">
                                <tr id="invoice0" class="no-padding">
                                    <td>
                                       <input type="text" name="data[0][containerno]" placeholder="Enter"class="form-control" />
                                       <!-- <input type="hidden" name="rowno[]" value="invoice0"  class="invrow" /> -->
                                    </td>
                                    <td style="max-width:122px;">
                                         <input type="text" name="data[0][size]" class="form-control" />
                                    </td>

                                    <td style="max-width:122px;">
                                       <input type="text" name="data[0][containersi]" id="pidate" class="form-control pidate" />
                                    </td>

                                    <td>
                                       <input type="text" name="data[0][qty]" id="qty" class="form-control"  />
                                    </td>

                                    <td style="max-width:100px;">
                                       <?php
                                           $uomList = array(
                                            "Millimeter" => "Millimeter",
                                            "Centimeter" => "Centimeter",
                                            "Meter" => "Meter",
                                            "Inch" => "Inch",
                                            "Feet" => "Feet",
                                            "Yard" => "Yard",
                                            "Piece" => "Piece");?>

                                         {{ Form::select('data[0][uom]', $uomList, null, ['placeholder'=>'Select ','class'=> 'form-control']) }}
                                    </td>
                                    <td>
                                       <input type="text" name="data[0][pkg]" id="pkg" class="form-control"  />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-success AddBtn">+</button>
                                        <button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
              </div>
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

   var count = 1;
  //Add More Invoice Table

    $('body').on('click', '.AddBtn', function(){

        var data = '<tr id="invoice'+count+'" class="no-padding">'+
            '<td>'+
           '<input type="text" name="data['+count+'][containerno]" placeholder="Enter"class="form-control" />'+

        '</td>'+
        '<td>'+
             '<input type="text" name="data['+count+'][size]" class="datepicker form-control" />'+
       ' </td>'+

       '<td>'+
          '<input type="text" name="data['+count+'][containersi]" id="pidate" class="form-control pidate"  />'+
       '</td>'+
            '<td>'+
               '<input type="text" name="data['+count+'][qty]" id="qty" class="form-control"/>'+
            '</td>'+
            '<td style="max-width:100px;">'+
              '<?php
                   $uomList = array(
                    "Millimeter" => "Millimeter",
                    "Centimeter" => "Centimeter",
                    "Meter" => "Meter",
                    "Inch" => "Inch",
                    "Feet" => "Feet",
                    "Yard" => "Yard",
                    "Piece" => "Piece");?>'+
                 '<select name="data['+count+'][uom]"  class=" form-control">'+
                     '<option value="">Select</option>'+
                     '<?php foreach ($uomList as $key => $value) { ?>'+
                       '<option value="'+'<?= $value ?>'+'">'+'<?= $value ?>'+'</option>'+
                     '<?php } ?>'+
                 '</select>'+
            '</td>'+
            '<td>'+
               '<input type="text" name="data['+count+'][pkg]" id="pkg" class="form-control"  />'+
            '</td>'+
            '<td>'+
                '<button type="button" class="btn btn-xs btn-success AddBtn">+</button>'+
                '<button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>'+
            '</td>'+
      '</tr>';

    $('.addRemove').append(data);
    $('select').select2();
      count++;
    });

    $('body').on('click', '.RemoveBtn', function(){
        //
        var rowid=$(this).parent().parent().attr("id");
         if(rowid != 'invoice0'){
           $(this).parent().parent().remove();
           $("table."+rowid).remove();
          }
      // remove table with rowid class name
    });

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
    $("#invoiceno").on('change',function(e){
      var invoiceno = $('#invoiceno').find(":selected").val();
      if(invoiceno){
           $.ajax({
              url:'/commercial/export/get-agent-code-by-invoice-no/'+invoiceno,
              type: 'get',
              success: function (response) {

                      //var response = JSON.parse(response);
                      // $('#agent-invoice-no').empty();
                      console.log(response);
                      $("#agent-invoice-no").val(response);


                  }
                 })
               }else{
                 $('#agent-invoice-no').empty();
               }
    });

});

</script>
@endsection
