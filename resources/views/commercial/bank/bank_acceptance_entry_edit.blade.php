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
                    <a href="#">Bank</a>   
                </li> 
                <li class="active">Bank Acceptance Entry Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Bank Acceptance Entry Edit</small></h1>
            </div>
            <div class="panel panel-default">
             <div class="panel-body">
                  {{-- <h4>Editing for,</h4> --}}
                  <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                          <table class="table  table-bordered">
                              <thead>
                                      <th colspan="3" style="text-align: center;">Edit for</th>
                                    <tr>
                                      <th>Transport Doc No</th>
                                      <th>Transport Doc Date</th>
                                      <th>Value</th>
                                    </tr>
                              </thead>
                              <tbody>
                                  @foreach($bank_acceptance_imp_data->bnk_acc_entry as $imp )
                                     <tr> 
                                        <td>{{$imp->transp_doc_no1}}</td>
                                        <td>{{$imp->transp_doc_date }}</td>  
                                        <td>{{$imp->value }}</td>
                                     </tr>
                                  @endforeach
                                    
                              </tbody>
                          </table>
                          
                      </div>
                  </div>
                </div>
              </div>
            @if($bank_acceptance_imp_data)
            <div class="row" id="data_entry_form" name="data_entry_form">
              <div class="panel panel-default">
               <div class="panel-body">
                <div calss="row">
                
                  <h4 style="margin-left: 20px;">Entry Form</h4>
                 {{Form::open(["url"=>"commercial/bank/cm_bank_acceptance_imp_update", "class"=>"form-horizontal col-xs-12"])}}
                   <input type="hidden" name="import_id" value="{{$bank_acceptance_imp_data->cm_imp_data_entry_id }}">
                   <input type="hidden" name="bank_accep_id" value="{{$bank_acceptance_imp_data->id }}">
                   
                   <div class="col-sm-4">
                     <div class="panel panel-default">
                      <div class="panel-body">
                      
                          <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right" for="bill_ex_rec_date" >Bill Ex Rec Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                              <input type="date" name="bill_ex_rec_date" id="bill_ex_rec_date"  class="col-xs-12" data-validation="required" value="{{$bank_acceptance_imp_data->bill_ex_rec_date }}"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right" for="acceptance_date" >Acceptance Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                              <input type="date" name="acceptance_date" id="acceptance_date"  class="col-xs-12 acceptance_date" data-validation="required" value="{{$bank_acceptance_imp_data->acceptance_date }}"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right" for="negotiation_date" >Nagotiation Date<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                              <input type="date" name="negotiation_date" id="negotiation_date"  class="col-xs-12" data-validation="required" value="{{$bank_acceptance_imp_data->negotiation_date }}"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right" for="bank_bill_no" >Bank Bill No.<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                              <input type="text" name="bank_bill_no" id="bank_bill_no"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" 
                              value="{{$bank_acceptance_imp_data->bank_bill_no }}"/>
                            </div>
                          </div>
                      </div>
                    </div>

                  </div>
                  
                  <div class="col-sm-4"> 
                    <div class="panel panel-default">
                      <div class="panel-body">
                        
                            <div class="form-group">
                              <label class="col-sm-5 control-label no-padding-right" for="discre_date" >Discre Date<span style="color: red">&#42;</span> </label>
                              <div class="col-sm-7">
                                <input type="date" name="discre_date" id="discre_date"  class="col-xs-12" data-validation="required" 
                                value="{{$bank_acceptance_imp_data->discre_date }}"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-5 control-label no-padding-right" for="discre_acp_date" >Discre Acp Date<span style="color: red">&#42;</span> </label>
                              <div class="col-sm-7">
                                <input type="date" name="discre_acp_date" id="discre_acp_date"  class="col-xs-12" data-validation="required"
                                value="{{$bank_acceptance_imp_data->discre_acp_date }}"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-5 control-label no-padding-right" for="days" >Days<span style="color: red">&#42;</span> </label>
                              <div class="col-sm-7">
                                <input type="number" name="days" id="days"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-11" value="{{$bank_acceptance_imp_data->days }}"/>
                              </div>
                            </div>
                            
                               <div id="duedate_div" name="duedate_div">
                                @if(sizeof($bank_acceptance_imp_data->due_dates_all) == 1 )
                                    @foreach($bank_acceptance_imp_data->due_dates_all as $due_dt)
                                     <div class="form-group">
                                        <label class="col-sm-5 control-label no-padding-right" for="due_dates_cal" >Due Date<span style="color: red">&#42;</span> </label>
                                        <div class="col-sm-7">
                                            <input type="date" name="due_dates_cal" id="due_dates_cal" class="col-xs-12 no-padding-right" data-validation="required" value="{{$due_dt->due_date}}" readonly="readonly" />
                                        </div>
                                      </div>
                                    @endforeach

                                @else
                                    @foreach($bank_acceptance_imp_data->due_dates_all as $due_dts)
                                     <div id="duedate_div" name="duedate_div">
                                      <div class="form-group">
                                       <label class="col-sm-5 control-label no-padding-right" for="due_dates" >Due Date<span style="color: red">&#42;</span> </label>
                                       <div class="col-sm-4">
                                            <input type="date" name="due_dates[]" id="due_dates" class="col-xs-12 no-padding-right" data-validation="required" value="{{$due_dts->due_date}}" />
                                       </div>
                                        <div class="col-sm-3">
                                             <button type="button" class="btn btn-xs btn-success AddBtn_due">+</button>
                                             <button type="button" class="btn btn-xs btn-danger RemoveBtn_due">-</button>
                                       </div>
                                      </div>
                                     </div>
                                     
                                    @endforeach
                                @endif
                               </div>
                            
                            <div class="form-group">
                                 <label class="col-sm-5 control-label no-padding-right" for="due_date_provide" >Due Date Provided by<span style="color: red">&#42;</span> </label>
                                 <div id="due_date_provide_div" class="col-sm-7">
                                    <select class="col-xs-12" id="due_date_provide" name="due_date_provide">
                                       <option value="">Bank/Calulated</option>
                                       <option value="Bank">Bank</option>
                                       <option value="Calulated">Calculated</option>
                                    </select>     
                                 </div>
                                
                            </div>
                         </div>
                     </div>
                   </div>

                   <div class="col-sm-4">
                     <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="form-group">
                                
                                 <label class="col-sm-5 control-label no-padding-right" for="libor" >Libor Rate Present<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-7">
                                    @if($bank_acceptance_imp_data->libor_rate)
                                      <input type="radio" class="lib_y" name="libor" id="libor" value="lib_yes" checked="checked">Yes</input><br>
                                      <input type="radio" class="lib_n" name="libor" id="libor" value="lib_no" >No</input>
                                    @else
                                      <input type="radio" class="lib_y" name="libor" id="libor" value="lib_yes" >Yes</input><br>
                                      <input type="radio" class="lib_n" name="libor" id="libor" value="lib_no" checked="checked">No</input>
                                    @endif
                                  </div>
                                 </div>
                                            
                                 <div class="form-group" id="lib_rate_appear1" name="lib_rate_appear1" > 
                                    @if($bank_acceptance_imp_data->libor_rate)
                                        <div id="lib_rate_appear2" name="lib_rate_appear2" >
                                         <label class="col-sm-5 control-label no-padding-right" for="libor_rate" >Libor Rate<span style="color: red">&#42;</span> </label>
                                         <div class="col-sm-7">
                                            <input type="number" name="libor_rate" id="libor_rate"  class="col-xs-12" data-validation="required" value="{{$bank_acceptance_imp_data->libor_rate }}" />
                                         </div> 
                                       </div>
                                    @endif
                                      {{-- data comes from script --}}  
                                 </div>
                                 
                                {{--  <div class="form-group">
                                     <label class="col-sm-5 control-label no-padding-right" for="lc_type" >L/C Type<span style="color: red">&#42;</span> </label>
                                   <div class="col-sm-7">
                                          <input type="text" name="lc_type" id="lc_type"  value="" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly="readonly" value="{{$bank_acceptance_imp_data-> }}" />
                                   </div>
                                </div> --}}
                                <div class="form-group">
                                     <label class="col-sm-5 control-label no-padding-right" for="exchange_rate" >Exchange Rate<span style="color: red">&#42;</span> </label>
                                   <div class="col-sm-7">
                                      <input type="text" name="exchange_rate" id="exchange_rate"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"
                                      value="{{$bank_acceptance_imp_data->exchange_rate }}"/>
                                   </div>
                                </div>  
                                 <div class="form-group">
                                     <label class="col-sm-5 control-label no-padding-right" for="acceptance_comm" >Acceptance Comm<span style="color: red">&#42;</span> </label>
                                   <div class="col-sm-7">
                                      <input type="text" name="acceptance_comm" id="acceptance_comm"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" value="{{$bank_acceptance_imp_data->acceptance_comm }}"/>
                                   </div>
                                </div> 
                                 
                          </div>
                       </div>
                      </div> 

                  </div>  {{-- Inner row end --}}



                  <div class="row">
                              <button class="btn btn-info btn-sm pull-right" style="margin-right: 5%;" type="submit">
                                     {{-- <i class="ace-icon fa fa-check bigger-110"></i> --}} Update
                             </button>
                  </div>

                 </form>

               </div>

              </div>  {{-- Outer panel end --}}
             </div>
            @else
            Nothing to edit
            @endif
              
           {{--  </div>   --}}  
            
             


        </div> {{-- page-content-end --}}
    </div>   {{-- main-content-inner-end --}}
</div>   {{-- main-content-end --}}

<script type="text/javascript">
   $(window).load(function() {
       
        //due date provided by
        var data = '<?php echo json_encode($bank_acceptance_imp_data); ?>';
        var parsed_data = JSON.parse(data);
        // console.log(parsed_data['due_provided_by']);
        $("#due_date_provide_div select").val(parsed_data['due_provided_by']).change();

        //Appending the libor rate entry
        // $("input:radio[value=lib_yes]").click(function() {
            $('body').on('click','.lib_y', function(){ 
            var libo_entry =  '<div id="lib_rate_appear2" name="lib_rate_appear2" >\
                                 <label class="col-sm-5 control-label no-padding-right" for="libor_rate" >Libor Rate<span style="color: red">&#42;</span> </label>\
                                <div class="col-sm-7">\
                                    <input type="number" name="libor_rate" id="libor_rate"  class="col-xs-12" data-validation="required" value="'+parsed_data['libor_rate']+'"/>\
                                </div> </div>'; 
                       $('#lib_rate_appear1').html( libo_entry);
                      });  
        //remove
        // $("input:radio[value=lib_no]").click(function(){
            $('body').on('click','.lib_n', function(){
            $('#lib_rate_appear2').remove();
            });

        //For multiple due dates
          var due_entry='<div class="form-group">\
                         <label class="col-sm-5 control-label no-padding-right" for="due_dates" >Due Date<span style="color: red">&#42;</span> </label>\
                            <div class="col-sm-4">\
                              <input type="date" name="due_dates[]" id="due_dates" class="col-xs-12 no-padding-right " data-validation="required"/>\
                            </div>\
                            <div class="col-sm-3 no-padding-right ">\
                               <button type="button" class="btn btn-xs btn-success AddBtn_due">+</button>\
                               <button type="button" class="btn btn-xs btn-danger RemoveBtn_due">-</button>\
                            </div>\
                          </div>';

                  $('body').on('click', '.AddBtn_due', function(){
                  $("#duedate_div").append(due_entry);
                   });

                  $('body').on('click', '.RemoveBtn_due', function(){
                  $(this).parent().parent().parent().remove();
                  });

        //due date calculation
             $('#data_entry_form').on('keyup', function(){

                   var val1 = $(this).find("input[name='acceptance_date']").val();
                   var val2 = $(this).find("input[name='days']").val();
                     //console.log(val1, val2);
                   var val3 =   new Date(val1);
                   val3.setDate( val3.getDate() + parseInt(val2, 10) );
                     //console.log(val3);
                   var myTime = new Date(val3);
                   var t = myTime.toISOString().substr(0, 10);
                     //console.log(t);
                   document.getElementById("due_dates_cal").value = t;
            });

   });
</script>

@endsection