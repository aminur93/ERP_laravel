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
                <li class="active">Forward Sales Master Edit Screen</li>
            </ul><!-- /.breadcrumb -->
        </div>
        {{-- page content --}}
        <div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Forward Sales Master Edit Screen</small></h1>
            </div>
            @include('inc/message')
            
            {{Form::open(["url"=>"commercial/bank/bank_forward_sales_entry_update", "class" => "form-horizontal col-xs-12"])}}
            <input type="hidden" name="forward_sales_id" value="{{$forward_sales_master[0]->id}}">
            <div class="row">
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;"><br>FNO</label> </div>
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;">Account<br>Type</label></div>
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;">Available<br>Amount</label></div>
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;"><br>Liability</label></div>
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;">Export<br>Received</label></div>
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;"><br>Bank</label></div>
                <div class="col-sm-2" style=" width: 135px; padding-right: 5px;"><label size="20px;">Withdraw<br>Amount</label></div>
                <div class="col-sm-2" style=" width: 135px;"></div>
            </div>

               
                 @if($forward_sales_master) 
                    <div id=get_row name=get_row >
                       @foreach($forward_sales_master[0]->child1 as $fsm)
                       <div class="row" style="margin-top: 5px;">
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <select class="col-xs-12 no-select fno"  name="fno[]" id="fno">
                                    <option selected class="f_val" value="{{$fsm->cm_file_id}}">{{$fsm->file}}</option>
                                    <option  value="">Select </option>
                                    @if($file_list)
                                        @foreach($file_list as $fl)
                                            <option value="{{$fl->id}}">{{$fl->file_no}}</option>
                                        @endforeach
                                    @else
                                    No File
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2 " style=" width: 135px; padding-right: 5px;">
                                <select class="col-xs-12 no-select acc_type" name="acc_type[]" id="acc_type">
                                     <option selected class="acc_val" value="{{$fsm->acc_typ_id}}" >{{$fsm->account_type}}</option>
                                    <option  value="">Select </option>
                                    @if($acc_type)
                                        @foreach($acc_type as $ac)
                                            <option value="{{$ac->id}}">{{$ac->acc_type_name}}</option>
                                        @endforeach
                                    @else
                                    No File
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px; ">
                                <input class="col-xs-12 available_amount" type="number" name="available_amount[]" id="available_amount" readonly="readonly" value="{{$fsm->available_amount}}" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 liability" type="number" name="liability[]" id="liability" readonly="readonly"value="{{$fsm->liability_amount}}" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 export_recieved" type="number" name="export_recieved[]" id="export_recieved" readonly="readonly" value="{{$fsm->exp_recv_amount}}" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 bank" type="text" name="bank[]" id="bank" readonly="readonly" 
                                    value="{{$fsm->bank_nm}}" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 widthdraw_amount" type="number" name="widthdraw_amount[]" id="widthdraw_amount" data-validation="required" value="{{$fsm->withdrawal_amnt}}" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; ">
                                <button type="button" class="btn btn-xs btn-success AddBtn_row">+</button>
                                <button type="button" class="btn btn-xs btn-danger RemoveBtn_row">-</button>
                            </div>
                       </div>
                       @endforeach
                    </div>
                    
                <div class="space-6"></div>
                <div id=column_total name=column_total >
                        <div class="row" >
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <label size="20px;">Total:</label>
                            </div>
                            <div class="col-sm-2 avail_amount_total" style=" width: 135px; padding-right: 5px; ">
                                <input class="col-xs-12 available_amount_total" type="number" name="available_amount_total" id="available_amount_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 liability_total" type="number" name="liability_total" id="liability_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 export_recieved_total" type="number" name="export_recieved_total" id="export_recieved_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 bank_total" type="text" name="bank_total" id="bank_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 widthdraw_amount_total" type="number" name="widthdraw_amount_total" id="widthdraw_amount_total"  readonly="readonly" value="" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; ">

                            </div>
                        </div>
                </div>
                <div class="space-6"></div>
                <div class="row">
                  {{-- <div class="col-sm-11">
                    <button class="btn btn-info btn-sm pull-left" name="search_button" id="search_button">Search</button>
                  </div> --}}
                </div>
                <div class="space-6"></div>
               {{--   --}}
                    <div class="col-sm-8 col-sm-offset-2" style="/*border: 1px solid; margin-bottom: 20px; */ margin-top: 10px;">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          
                        <div class="row"><label class="col-sm-4 control-label no-padding-right align-left">Child</label></div>
                        <div class="space-6"></div>
                        <div class="row">
                           
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label no-padding-right align-left" for="booking_date" >Booking Date{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                        <input type="date" name="booking_date" id="booking_date" placeholder="Enter" class="col-xs-12" data-validation="required" value="{{$forward_sales_master[0]->booking_date}}" />
                                       </div>
                                    </div>

                                    <div class="form-group"> 
                                      <label class="col-sm-4 control-label no-padding-right align-left" for="buying_bank" >Buying Bank{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="col-sm-8"{{--  style="margin-bottom: 20px;" --}}>
                                          <select id="buying_bank" name="buying_bank" class="col-xs-12"  data-validation="required">
                                              <option value="{{$forward_sales_master[0]->cm_bank_id}}">{{$forward_sales_master[0]->bank}}</option>
                                              <option value="-1">Select</option>
                                              @if($bank)
                                                 @foreach($bank as $b)
                                                    <option value="{{$b->id}}">{{$b->bank_name}}</option>
                                                 @endforeach
                                              @else
                                                Bank List Empty
                                              @endif
                                          </select>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label no-padding-right align-left" for="forward_amt" >Forward Amt{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                        <input type="number" name="forward_amt" id="forward_amt" placeholder="Enter" class="col-xs-12"  data-validation="required" value="{{$forward_sales_master[0]->forward_amnt}}"/>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label no-padding-right align-left" for="sales_done" >Sales Done{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                        @if( strcmp($forward_sales_master[0]->sales_done , "yes") == 0 ) 
                                          <input type="radio" name="sales_done" id="sales_done" value="yes" checked="checked" />Yes
                                          &nbsp&nbsp&nbsp&nbsp
                                          <input type="radio" name="sales_done" id="sales_done" value="no"/>No
                                        @else
                                          <input type="radio" name="sales_done" id="sales_done" value="yes" />Yes
                                          &nbsp&nbsp&nbsp&nbsp
                                          <input type="radio" name="sales_done" id="sales_done" value="no" checked="checked" />No
                                        @endif
                                       </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label no-padding-right align-left" for="remarks" >Remarks{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                        <textarea name="remarks" class="form-control" id="remarks"  data-validation="required length" data-validation-length="0-255" >{{$forward_sales_master[0]->remarks}}</textarea>
                                       </div>
                                    </div>

                                </div>
                                    

                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label no-padding-right align-left" for="exchange_rate" >Exchange Rate{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                        <input type="number" name="exchange_rate" id="exchange_rate" placeholder="Enter" class="col-xs-12"  data-validation="required"  value="{{$forward_sales_master[0]->exchange_rate}}"/>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-12 control-label no-padding-right align-left" style="color: red;" >Maturity Window{{-- <span style="color: red">&#42;</span> --}} </label>
                                       <div class="row">
                                           <div class="col-sm-5 col-sm-offset-1" {{-- style="margin-bottom: 20px;" --}}>
                                            <small style="color: red">Start Date</small> 
                                           </div>
                                           <div class="col-sm-5" {{-- style="margin-bottom: 20px;" --}}>
                                            <small style="color: red">End Date</small>
                                           </div>

                                           <div class="col-sm-5 col-sm-offset-1" style="margin-bottom: 50px;">
                                            <input type="date" name="m_start_date" id="m_start_date" placeholder="Start Date" class="col-xs-12"  data-validation="required"  value="{{$forward_sales_master[0]->maturity_window_start}}"/>
                                           </div>
                                           <div class="col-sm-5" style="margin-bottom: 50px;">
                                            <input type="date" name="m_end_date" id="m_end_date" placeholder="End Date" class="col-xs-12"  data-validation="required"  value="{{$forward_sales_master[0]->maturity_window_end}}"/>
                                           </div>    
                                       </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-6 col-sm-offset-1">
                                            <button class="btn btn-info btn-sm pull-left" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Update</button>    
                                          </div>   
                                        </div>
                                    </div>
                                    
                                </div>
                           
                        </div>
                        </div>
                      </div>
                    </div>

                {{--Show #TT showing the before edit value of child2 --}}
                {{-- <div class="row"> --}}
                    <div class="col-sm-8 col-sm-offset-2" style="margin-bottom: 0px;">
                      <div class="panel panel-borderless"  style="margin-bottom: 0px;">
                        <div class="panel-body" style="margin-bottom: 0px;">
                            <table class="table  table-bordered" style="width: 50%; margin-bottom: 0px;" >
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: left;">Previous Data</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Encashment Date</th>
                                        <th>Amount</th>    
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    @if($forward_sales_master[0]->child2)
                                         @foreach($forward_sales_master[0]->child2 as $c2)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$c2->encashment_date}}</td>
                                                <td>{{$c2->amount}}</td>
                                            </tr>
                                         @endforeach
                                    @else
                                        No Data.
                                    @endif
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                {{-- </div> --}}
                    {{-- end of showing Show #TT  --}}

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <label class="col-sm-1 control-label no-padding-right align-left" {{-- style="margin-top: 2px;" --}}>Child</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" style="color: red;">Encashment Date</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" style="color: red;">Amount</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" style="color: red;">Balance</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" ></label>       
                    </div>
                </div>
               
                    <div id="child_row" name="child_row" >
                        <div class="row" style="margin-top: 5px;">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <input type="date" class="encashment_date" name="encashment_date[]" id="encashment_date" placeholder="Enter" class="col-xs-12" data-validation="required" {{-- value="{{$fsm->encashment_date}}" --}}/>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="col-xs-12 amount_child"  type="number" name="amount_child[]" id="amount_child"  {{-- value="{{$fsm->amount}}" --}}/>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="col-xs-12 balance"   type="number" name="balance[]" id="balance" readonly="readonly"  {{-- value="{{$fsm->balance}}" --}} />
                                    </div>
                                    <div class="col-sm-2">
                                         <button type="button" class="btn btn-xs btn-success AddBtn_child_row">+</button>
                                         <button type="button" class="btn btn-xs btn-danger RemoveBtn_child_row">-</button>
                                    </div>      
                                </div>
                        </div>
                    </div>
               

                 @else    

                <div id=get_row name=get_row >
                     <div class="row" >
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <select class="col-xs-12 no-select fno"  name="fno[]">
                                    <option  value="">Select </option>
                                    @if($file_list)
                                        @foreach($file_list as $fl)
                                            <option value="{{$fl->id}}">{{$fl->file_no}}</option>
                                        @endforeach
                                    @else
                                    No File
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2 " style=" width: 135px; padding-right: 5px;">
                                <select class="col-xs-12 no-select acc_type" name="acc_type[]" id="acc_type">
                                    <option  value="">Select </option>
                                    @if($acc_type)
                                        @foreach($acc_type as $ac)
                                            <option value="{{$ac->id}}" >{{$ac->acc_type_name}}</option>
                                        @endforeach
                                    @else
                                    No File
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px; ">
                                <input class="col-xs-12 available_amount" type="number" name="available_amount[]" id="available_amount" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 liability" type="number" name="liability[]" id="liability" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 export_recieved" type="number" name="export_recieved[]" id="export_recieved" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 bank" type="text" name="bank[]" id="bank" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 widthdraw_amount" type="number" name="widthdraw_amount[]" id="widthdraw_amount" data-validation="required"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; ">
                                <button type="button" class="btn btn-xs btn-success AddBtn_row">+</button>
                                <button type="button" class="btn btn-xs btn-danger RemoveBtn_row">-</button>
                            </div>
                     </div>
                </div>
                <div class="space-6"></div>
                <div id=column_total name=column_total >
                        <div class="row" >
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <label size="20px;">Total:</label>
                            </div>
                            <div class="col-sm-2 avail_amount_total" style=" width: 135px; padding-right: 5px; ">
                                <input class="col-xs-12 available_amount_total" type="number" name="available_amount_total" id="available_amount_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 liability_total" type="number" name="liability_total" id="liability_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 export_recieved_total" type="number" name="export_recieved_total" id="export_recieved_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 bank_total" type="text" name="bank_total" id="bank_total" readonly="readonly"/>
                            </div>
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">
                                <input class="col-xs-12 widthdraw_amount_total" type="number" name="widthdraw_amount_total" id="widthdraw_amount_total" readonly="readonly" />
                            </div>
                            <div class="col-sm-2" style=" width: 135px; ">

                            </div>
                        </div>
                </div>
                <div class="space-6"></div>
                <div class="row">
                  {{-- <div class="col-sm-11">
                    <button class="btn btn-info btn-sm pull-left" name="search_button" id="search_button">Search</button>
                  </div> --}}
                </div>
                <div class="space-6"></div>

                <div class="col-sm-8 col-sm-offset-2" style="border: 1px solid;">
                    <div class="row"><label class="col-sm-4 control-label no-padding-right align-left">Child</label></div>
                    <div class="space-6"></div>
                    <div class="row">
                       
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="booking_date" >Booking Date{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                    <input type="date" name="booking_date" id="booking_date" placeholder="Enter" class="col-xs-12" data-validation="required"/>
                                   </div>
                                </div>

                                <div class="form-group"> 
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="buying_bank" >Buying Bank{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="col-sm-8"{{--  style="margin-bottom: 20px;" --}}>
                                      <select id="buying_bank" name="buying_bank" class="col-xs-12"  data-validation="required">
                                          <option value="-1">Select</option>
                                          @if($bank)
                                             @foreach($bank as $b)
                                                <option value="{{$b->id}}">{{$b->bank_name}}</option>
                                             @endforeach
                                          @else
                                            Bank List Empty
                                          @endif
                                      </select>
                                   </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="forward_amt" >Forward Amt{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                    <input type="number" name="forward_amt" id="forward_amt" placeholder="Enter" class="col-xs-12"  data-validation="required"/>
                                   </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="sales_done" >Sales Done{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                    <input type="radio" name="sales_done" id="sales_done" value="yes"/>Yes
                                    &nbsp&nbsp&nbsp&nbsp
                                    <input type="radio" name="sales_done" id="sales_done" value="no"/>No
                                   </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="remarks" >Remarks{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                    <textarea name="remarks" class="form-control" id="remarks" placeholder="Enter" data-validation="required length" data-validation-length="0-255"></textarea>
                                   </div>
                                </div>

                            </div>
                                

                            <div class="col-sm-6">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="exchange_rate" >Exchange Rate{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="col-sm-8" {{-- style="margin-bottom: 20px;" --}}>
                                    <input type="number" name="exchange_rate" id="exchange_rate" placeholder="Enter" class="col-xs-12"  data-validation="required"/>
                                   </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-12 control-label no-padding-right align-left" style="color: red;" >Maturity Window{{-- <span style="color: red">&#42;</span> --}} </label>
                                   <div class="row">
                                       <div class="col-sm-5 col-sm-offset-1" {{-- style="margin-bottom: 20px;" --}}>
                                        <small style="color: red">Start Date</small> 
                                       </div>
                                       <div class="col-sm-5" {{-- style="margin-bottom: 20px;" --}}>
                                        <small style="color: red">End Date</small>
                                       </div>

                                       <div class="col-sm-5 col-sm-offset-1" style="margin-bottom: 50px;">
                                        <input type="date" name="m_start_date" id="m_start_date" placeholder="Start Date" class="col-xs-12"  data-validation="required"/>
                                       </div>
                                       <div class="col-sm-5" style="margin-bottom: 50px;">
                                        <input type="date" name="m_end_date" id="m_end_date" placeholder="End Date" class="col-xs-12"  data-validation="required"/>
                                       </div>    
                                   </div>
                                   
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-6 col-sm-offset-1">
                                        <button class="btn btn-info btn-sm pull-left" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Update</button>    
                                      </div>   
                                    </div>
                                </div>
                                
                            </div>
                       
                    </div>
                </div>
                
                

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <label class="col-sm-1 control-label no-padding-right align-left" style="margin-top: 40px;">Child</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" style="color: red;margin-top: 40px;">Encashment Date</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" style="color: red;margin-top: 40px;">Amount</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" style="color: red;margin-top: 40px;">Balance</label>
                        <label class="col-sm-3 control-label no-padding-right align-left" ></label>       
                    </div>
                </div>
                <div id="child_row" name="child_row" >
                    <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3">
                                    <input type="date" class="encashment_date" name="encashment_date[]" id="encashment_date" placeholder="Enter" class="col-xs-12" data-validation="required"/>
                                </div>
                                <div class="col-sm-3">
                                    <input class="col-xs-12 amount_child"  type="number" name="amount_child[]" id="amount_child" />
                                </div>
                                <div class="col-sm-3">
                                    <input class="col-xs-12 balance"   type="number" name="balance[]" id="balance" readonly="readonly"/>
                                </div>
                                <div class="col-sm-2">
                                     <button type="button" class="btn btn-xs btn-success AddBtn_child_row">+</button>
                                     <button type="button" class="btn btn-xs btn-danger RemoveBtn_child_row">-</button>
                                </div>      
                            </div>
                    </div>
                    
                </div>

                 @endif  
                       

                {{-- Script --}}
        <script type="text/javascript">

            var balance = 0; //global variable

             $(window).load(function() {
                    updateWithdrawTotal();
                    updateTotal();
                    // alert('Please reselect the Accout Types..');
                    
                    var row=' <div class="row" style="margin-top:5px;" >\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">\
                                <select class="col-xs-12 no-select fno" name="fno[]">\
                                    <option  value="">Select</option>\
                                    @if($file_list)\
                                        @foreach($file_list as $fl)\
                                            <option value="{{$fl->id}}">{{$fl->file_no}}</option>\
                                        @endforeach\
                                    @else\
                                    No File\
                                    @endif\
                                </select>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">\
                                <select class="col-xs-12 no-select acc_type"  name="acc_type[]" id="acc_type">\
                                    <option  value="">Select</option>\
                                    @if($acc_type)\
                                        @foreach($acc_type as $ac)\
                                            <option value="{{$ac->id}}">{{$ac->acc_type_name}}</option>\
                                        @endforeach\
                                    @else\
                                    No File\
                                    @endif\
                                </select>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px; ">\
                                <input class="col-xs-12 available_amount" type="number" name="available_amount[]" id="available_amount" readonly="readonly"/>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">\
                                <input class="col-xs-12 liability" type="number" name="liability[]" id="liability" readonly="readonly"/>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">\
                                <input class="col-xs-12 export_recieved" type="number" name="export_recieved[]" id="export_recieved" readonly="readonly"/>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">\
                                <input class="col-xs-12 bank" type="text" name="bank[]" id="bank" readonly="readonly"/>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; padding-right: 5px;">\
                                <input class="col-xs-12 widthdraw_amount" type="number" name="widthdraw_amount[]" id="widthdraw_amount" data-validation="required"/>\
                            </div>\
                            <div class="col-sm-2" style=" width: 135px; ">\
                                <button type="button" class="btn btn-xs btn-success AddBtn_row">+</button>\
                                <button type="button" class="btn btn-xs btn-danger RemoveBtn_row">-</button>\
                            </div>\
                        </div>';

                        $('body').on('click', '.AddBtn_row', function(){
                           $("#get_row").append(row); //Appending multiple row entry

                            // replace from first to the child encashments.................
                            var xx = '<div class="row"  style="margin-top:5px;" >\
                                    <div class="col-sm-8 col-sm-offset-2">\
                                        <div class="col-sm-1"></div>\
                                        <div class="col-sm-3">\
                                            <input type="date" class="encashment_date" name="encashment_date[]" id="encashment_date" placeholder="Enter" class="col-xs-12" data-validation="required"/>\
                                        </div>\
                                        <div class="col-sm-3">\
                                            <input class="col-xs-12 amount_child" type="number" name="amount_child[]" id="amount_child" />\
                                        </div>\
                                        <div class="col-sm-3">\
                                            <input class="col-xs-12 balance" type="number" name="balance[]" id="balance" readonly = "readonly"/>\
                                        </div>\
                                        <div class="col-sm-2">\
                                             <button type="button" class="btn btn-xs btn-success AddBtn_child_row">+</button>\
                                        <button type="button" class="btn btn-xs btn-danger RemoveBtn_child_row">-</button>\
                                        </div>      \
                                      </div>\
                                     </div>';

                              $("#child_row").html(xx);
                              // replace from first to the child encashments................

                        });
                        $('body').on('click', '.RemoveBtn_row', function(){

                            // replace from first to the child encashments...........................
                            var xx = '<div class="row"  style="margin-top:5px;" >\
                                    <div class="col-sm-8 col-sm-offset-2">\
                                        <div class="col-sm-1"></div>\
                                        <div class="col-sm-3">\
                                            <input type="date" class="encashment_date" name="encashment_date[]" id="encashment_date" placeholder="Enter" class="col-xs-12" data-validation="required"/>\
                                        </div>\
                                        <div class="col-sm-3">\
                                            <input class="col-xs-12 amount_child" type="number" name="amount_child[]" id="amount_child" />\
                                        </div>\
                                        <div class="col-sm-3">\
                                            <input class="col-xs-12 balance" type="number" name="balance[]" id="balance" readonly = "readonly"/>\
                                        </div>\
                                        <div class="col-sm-2">\
                                             <button type="button" class="btn btn-xs btn-success AddBtn_child_row">+</button>\
                                        <button type="button" class="btn btn-xs btn-danger RemoveBtn_child_row">-</button>\
                                        </div>      \
                                      </div>\
                                     </div>';

                              $("#child_row").html(xx);
                              // replace from first to the child encashments.............................
                           
                           $(this).parent().parent().remove();
                           updateTotal();
                           updateWithdrawTotal();
                        }).change();


                var child_row='<div class="row"  style="margin-top:5px;" >\
                            <div class="col-sm-8 col-sm-offset-2">\
                                <div class="col-sm-1"></div>\
                                <div class="col-sm-3">\
                                    <input type="date" class="encashment_date" name="encashment_date[]" id="encashment_date" placeholder="Enter" class="col-xs-12" data-validation="required"/>\
                                </div>\
                                <div class="col-sm-3">\
                                    <input class="col-xs-12 amount_child" type="number" name="amount_child[]" id="amount_child" />\
                                </div>\
                                <div class="col-sm-3">\
                                    <input class="col-xs-12 balance" type="number" name="balance[]" id="balance" readonly = "readonly"/>\
                                </div>\
                                <div class="col-sm-2">\
                                     <button type="button" class="btn btn-xs btn-success AddBtn_child_row">+</button>\
                                <button type="button" class="btn btn-xs btn-danger RemoveBtn_child_row">-</button>\
                                </div>      \
                              </div>\
                             </div>';
                        $('body').on('click', '.AddBtn_child_row', function(){
                           $("#child_row").append(child_row);
                        });
                        $('body').on('click', '.RemoveBtn_child_row', function(){
                           $(this).parent().parent().parent().remove();
                        });

             // });
            
        //importing the amounts to the fields
        

                // $('body').on('change','.fno', function(){
                  

                //           var file_id = $(this).val();
                //           console.log('File Id:',file_id);
                         
                          
                //           var available_total_path = $(this).parent().parent().parent().next().next().children(".row").children(".avail_amount_total");
                //           var liability_total_path = $(this).parent().parent().parent().next().next().children(".row").children(".avail_amount_total").next();
                //           var export_recv_total_path = $(this).parent().parent().parent().next().next().children(".row").children(".avail_amount_total").next().next();
                          // console.log(export_recv_total_path);

                    $('body').on('change','.acc_type', function(event){
                        // console.log('On change Acc Type');
                        // currentXhr && currentXhr.readyState != 4 && currentXhr.abort(); // clear previous request
                                var acc_type_id = $(this).val();
                                var file_id = $(this).parent().parent().find('.fno').val();
                                console.log('Account Type Id:',acc_type_id, 'File Id:',file_id );
                                var acc_parent=$(this).parent();
                                // console.log(acc_parent.next().html());
                     if(acc_type_id==' ' || file_id==' ' ){ alert('Please Select Account type or File No correctly');}
                        else {           

                                var currentXhr = $.ajax({  //currentXhr is used for aborting the previous calls
                                     url: "{{url('commercial/bank/bank_forward_sales_amounts_return')}}",
                                     type: 'get',
                                     // dataType: 'json',
                                     data: {file_id: file_id, acc_type_id: acc_type_id, _token: '{{csrf_token()}}' },
                                     success: function(data){
                                        // event.stopImmediatePropagation();
                                            //console.log("success: ", data);
                                         //  var x= that.parent().next().find(".available_amount").val("0");
                                            // var x= that.val();
                                           // console.log(x);
                                           acc_parent.next().find(".available_amount").val(data['available_amount']);
                                           acc_parent.next().next().find(".liability").val(data['liability']);
                                           acc_parent.next().next().next().find(".export_recieved").val(data['export_recieved']);
                                           acc_parent.next().next().next().next().find(".bank").val(data['bank']);

                                           updateTotal();


                                     },
                                     error: function(data){
                                           
                                            console.log("error: ", data);
                                            acc_parent.next().find(".available_amount").val(data['available_amount']);
                                            acc_parent.next().next().find(".liability").val(data['liability']);
                                            acc_parent.next().next().next().find(".export_recieved").val(data['export_recieved']);
                                            acc_parent.next().next().next().next().find(".bank").val(data['bank']);

                                            document.getElementById("available_amount_total").value     =   0;
                                            document.getElementById("liability_total").value            =   0;
                                            document.getElementById("export_recieved_total").value      =   0;

                                            alert('Select File and Account Type Properly!!');
                                             // currentXhr.abort();     
                                     },

                                  });   //Ajax --end
                              } //else end
                   }).change();  // Acc_type --end
                // }).change(); // Fno --end

                //Previous data load
                // $(document).ready(function () {

                //       var file_option_portion = document.getElementsByClassName('f_val');
                //       var acc_type_id_option_portion = document.getElementsByClassName('acc_val');
                //       // console.log('Check:', 'file select:', file_option_portion, 'accTypID select:', acc_type_id_option_portion );
                      
                //       for(var i=0; i<file_option_portion.length; i++) {
                //         console.log('value',i,':',file_option_portion[i].value);
                //       }

                //       console.log( $(this).parent().find(file_option_portion[0].value).html() );
                //   });
                //Previius data load end
               

                $('body').on('keyup','.widthdraw_amount', function(){
                        updateWithdrawTotal();
                }).change();
         

                 function updateTotal() {
                        //#--updating the total amounts
                        //taking the array of each input fields.... 
                        var avail_total=0;
                        var liability_total=0;
                        var exp_rcv_total=0;
                        var list1 = document.getElementsByClassName("available_amount");
                        var list2 = document.getElementsByClassName("liability");
                        var list3 = document.getElementsByClassName("export_recieved");
                        
                        var values1 = [];
                        var values2 = [];
                        var values3 = [];
                       

                         for(var i = 0; i < list1.length; ++i) {

                                if(isNaN(parseFloat(list1[i].value) ) ){
                                    values1.push(parseFloat(0.0));
                                    values2.push(parseFloat(0.0));
                                    values3.push(parseFloat(0.0));    
                                }
                                else{

                                    values1.push(parseFloat(list1[i].value));
                                    values2.push(parseFloat(list2[i].value));
                                    values3.push(parseFloat(list3[i].value));
                                }  
                           }
                       
                        avail_total = values1.reduce(function(previousValue, currentValue, index, array){
                            return previousValue + currentValue;
                        });
                        liability_total = values2.reduce(function(previousValue, currentValue, index, array){
                            return previousValue + currentValue;
                        });
                        exp_rcv_total = values3.reduce(function(previousValue, currentValue, index, array){
                            return previousValue + currentValue;
                        });
                       

                        document.getElementById("available_amount_total").value     =   avail_total;
                        document.getElementById("liability_total").value            =   liability_total;
                        document.getElementById("export_recieved_total").value      =   exp_rcv_total;
                           
                      }

                function updateWithdrawTotal(){
                    var widrw_total=0;
                                            //taking the array of input field....
                        var list4 = document.getElementsByClassName("widthdraw_amount");
                        var values4 = [];
                        for(var i = 0; i < list4.length; ++i) {
                            // console.log("before withdraw amt:", parseFloat(list4[i].value) );
                            if(isNaN(parseFloat(list4[i].value) ) ){
                                values4.push(parseFloat(0.0));    
                            }
                            else{
                                values4.push(parseFloat(list4[i].value));
                            }
                            // console.log("after withdraw amt:", parseFloat(list4[i].value) );

                         }
                         widrw_total = values4.reduce(function(previousValue, currentValue, index, array){
                                                    return previousValue + currentValue;
                                       });
                         document.getElementById("widthdraw_amount_total").value     =   widrw_total;
                         balance = document.getElementById("widthdraw_amount_total").value;  

                      };

                  
                 $('body').on('change','.encashment_date', function(event){
                                 event.stopImmediatePropagation();
                            var encas_date = $(this).val();

                    $('body').on('change', '.amount_child', function(event){
                                 event.stopImmediatePropagation();
                            var amount = $(this).val(); 
                            if(balance==0 || isNaN(parseFloat(balance) ) ) {
                                $(this).parent().next().find('.balance').val(0.0);     
                                alert('Balance Not Available ');
                            }
                            else{
                                balance = balance-amount;
                                $(this).parent().next().find('.balance').val(balance);
                                console.log(encas_date, amount, balance);    
                            }

                    });
                 });
        


          }).change();//Window load --end


        </script> 


       </form>
{{-- Form End --}}

        </div>
    </div>
</div>

@endsection