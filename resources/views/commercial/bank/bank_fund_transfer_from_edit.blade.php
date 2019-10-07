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
                <li class="active">Fund Transfer Entry Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>
        {{-- page content --}}
        <div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Fund Transfer Entry Edit</small></h1>
            </div>
            {{-- @include('inc/message') --}}

            <div class="row">
              <div class="col-sm-6"><h3>From</h3></div>
              
            </div>
            {{-- <div class="space-10"> </div> --}}
            @if($from)
            {{Form::open(["url"=>"commercial/bank/fund_transfer_from_update", "class"=>"form-horizontal col-xs-12"])}}
            <div class="row">
                <div class="col-sm-6">
                    <div calss="form-group">
                        <label class="col-sm-4 control-label no-padding-right align-left  " for="from_file_no_id"  >File No. {{-- <span style="color: red">&#42;</span> --}} </label>
                        <div class="col-sm-6" style="margin-bottom: 20px;">
                         <select id="from_file_no_id" name="from_file_no_id" class="col-xs-12">
                            {{-- @foreach($from->from_file as $ff) --}}
                              <option value="{{$from->from_file->id}}">{{$from->from_file->file_no}}</option>
                            {{-- @endforeach --}}
                            <option value="-1">Select File No.</option>
                            @foreach($file_list as $fl)
                              <option value="{{$fl->id}}" >{{$fl->file_no}}</option>
                            @endforeach
                         </select>
                        </div>   
                    </div>

                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="buyer_id">Buyer {{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-6" style="margin-bottom: 20px;">
                                 <input type="text" name="buyer_id" id="buyer_id" class="col-xs-12" readonly="readonly"  />
                                 <input type="hidden" name="buyer_id_hidden" id="buyer_id_hidden" value = "" />
                            </div>    
                    </div>

                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="bank_name" >Bank{{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-6" style="margin-bottom: 20px;">
                                 <input type="text" name="bank_name" id="bank_name" class="col-xs-12" value ="" placeholder="" readonly="readonly"  />
                                 <input type="hidden" name="bank_id_hidden" id="bank_id_hidden" value = "" />
                            </div>
                    </div>

                    <div calss="form-group">
                        <label class="col-sm-4 control-label no-padding-right align-left" for="from_account_type"> Account Type <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-6" style="margin-bottom: 20px;">
                         <select id="from_account_type" name="from_account_type" class="col-xs-12" data-validation="required">
                            {{-- @foreach($from->from_acc as $facc) --}}
                              <option value="{{$from->from_acc->id}}">{{$from->from_acc->acc_type_name}}</option>
                            {{-- @endforeach --}}
                            <option value="-1">Select Account Type</option>
                            @foreach($acc_type as $acc)
                                <option value="{{$acc->id}}">{{$acc->acc_type_name}}</option>
                            @endforeach

                         </select>
                        </div>
                    </div>

                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="date_entry" >Date{{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-6" style="margin-bottom: 20px;">
                                 <input type="date" name="date_entry" id="date_entry" class="col-xs-12" value="{{$from->date}}" data-validation="required"  />
                            </div>
                    </div>

                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="naration" >Naration{{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-6" style="margin-bottom: 20px;">
                                 <input type="text" name="naration" id="naration" value="{{$from->narration}}" class="col-xs-12" data-validation="required"  />
                            </div>
                    </div>

                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="amount" >Amount{{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-3" >
                                 <input type="number" name="amount" id="amount" value="{{$from->amount }}" class="col-xs-12"  />
                            </div>
                            <div class="col-sm-3" style="margin-bottom: 20px;">
                                 <select class="col-xs-12" id="currency" name="currency" >
                                  {{-- @foreach($from->curr as $cur) --}}
                                     <option value="{{$from->currency}}"><font size="10px">{{$from->curr}}</font></option> 
                                  {{-- @endforeach --}}
                                     <option value="USD"><font size="10px"> USD $ </font></option>
                                     <option value="EUR"><font size="10px"> EUR € </font></option>
                                     <option value="GBP"><font size="10px"> GBP £ </font></option>
                                     <option value="TK"><font size="10px"> TK ৳ </font> </option>
                                 </select>           
                            </div>
                    </div>
                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="from_balance" >Balance{{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-6" style="margin-bottom: 20px;">
                                 <input type="text" name="from_balance" id="from_balance" value="" class="col-xs-12" readonly="readonly"  />
                            </div>
                    </div>

                    <div calss="form-group">
                        <label class="col-sm-4 control-label no-padding-right align-left" for="agent"> Agent <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-6" style="margin-bottom: 20px;">
                         <select id="agent" name="agent" class="col-xs-12" data-validation="required">
                            {{-- @foreach($from->agent as $ag) --}}
                              <option value="{{$from->agent->id}}">{{$from->agent->agent_name}}</option>
                            {{-- @endforeach --}}
                            <option value="-1">Select Agent</option>
                            @foreach($agent_list as $ag)
                              <option value="{{$ag->id}}">{{$ag->agent_name}}</option>
                            @endforeach
                         </select>
                        </div>
                    </div>

                    <div calss="form-group">
                            <label class="col-sm-4 control-label no-padding-right align-left" for="exchange_rate" >Exchange Rate{{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-6" style="margin-bottom: 20px;">
                              <input type="text" name="exchange_rate" id="exchange_rate" class="col-xs-12" value="{{$from->exchange_rate}}" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                    </div>


                </div>
                          
             </div> {{-- End Form Row --}}
             <div class="row">
                    <div class="col-sm-11">
                      <input type="hidden" name="from_id" id="from_id" value={{$from->id}}>
                        <button class="btn btn-info btn-sm pull-right" type="submit"> Update </button>
                    </div>
                    
             </div>
           </form> 
           @endif

                
        </div>
<script type="text/javascript">
     $(window).load(function() {
        var amount="";
        var acc_type = "";
        var file_tmp_id = "";
        $('#from_file_no_id').change(function () {
            var file_id = $(this).val();
            if(file_id == -1) {
              document.getElementById('bank_name').placeholder = "";
              document.getElementById('buyer_id').placeholder = "";
              document.getElementById('bank_id_hidden').value = "";
              document.getElementById('buyer_id_hidden').value = "";
            }
            else{

            file_tmp_id = file_id;
            // console.log(file_id);
            $.ajax({
                url: "{{url('commercial/bank/get_buyer_and_bank')}}",
                type: "get",
                dataType: 'json',
                data: { file_id : file_id, _token: '{{csrf_token()}}' } ,

                success: function(data){
                   console.log('SUCCESS: ',data);
                   document.getElementById('bank_name').placeholder = data.bank;
                   document.getElementById('buyer_id').placeholder = data.buyer;
                   document.getElementById('bank_id_hidden').value = data.bank_id;
                   document.getElementById('buyer_id_hidden').value = data.buyer_id;
                   // document.getElementById('from_balance').value = data.pre_amount;
                  
                },
                error: function(){
                    console.log('ERROR: ', data);
                },
              });

            $('#from_account_type').change(function () {
                var acc_type_id = $(this).val();
                if(acc_type_id == -1) {
                  document.getElementById('from_balance').value = "";
                }
                else{

                var data = '<?php echo json_encode($from); ?>';
                var parsed_data = JSON.parse(data);
                // console.log(parsed_data);
                var from_id = parsed_data['id'];

                acc_type = acc_type_id;
                // console.log(acc_type_id);
                                            
                $.ajax({        //pre_amount_get start
                    url:  "{{url('commercial/bank/get_pre_amount_from')}}",
                    type: 'get',
                    dataType: 'json',
                    data: {id : from_id,  file_id : file_id, acc_type_id: acc_type_id, _token: '{{csrf_token()}}' },
                    success : function(data){  
                        console.log("Success: ", data);
                        document.getElementById('from_balance').value = data.pre_amount;
                      

                    },
                    error: function(data){
                        console.log("Error: ", data);    
                    },
                });  //pre_amount_get end
                
              
            //for amount calculation 

          $('#amount').change(function () {
                var amnt = $(this).val();
                
                var data = '<?php echo json_encode($from); ?>';
                var parsed_data = JSON.parse(data);
                // console.log(parsed_data);
                var from_id = parsed_data['id'];

            amount = amnt;
            // console.log(amount);
            $.ajax({
                url: "{{url('commercial/bank/set_balance_edit')}}",
                type: "get",
                dataType: 'json',
                data: { id : from_id, file_id : file_id, amount : amnt, acc_type_id : acc_type_id, _token: '{{csrf_token()}}' },
                success: function(data){
                       // console.log('SUCCESS: ', data);
                      document.getElementById('from_balance').value = data.from_balance;  
                },
                error: function(data){
                       console.log('ERROR: ', data); 
                }, 
            
            });
            
           }); //end-amount 
           //Amount Calculation End 
         } //else inner end
            
        }).change(); //end-account type

       }  //else outer
   
      }).change(); //end-file no 
          
    }).change();//end-window

</script>


        </div>{{-- main-content-inner end --}}
    </div>{{-- main-content end --}}
@endsection

