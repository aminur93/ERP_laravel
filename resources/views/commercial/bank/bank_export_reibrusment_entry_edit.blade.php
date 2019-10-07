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
                <li class="active">Bank Export Reimbursement Entry Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Bank Export Reimbursement Entry Edit</small></h1>
            </div>
            @include('inc/message')
        
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                <table class="table table-bordered"> 
                    <thead>
                       <th>File No</th>
                       <th>Bill No</th>
                       <th>Value</th>
                       <th>Invoice No</th>
                       <th>Transport Doc Date</th>
                       <th>Difference</th>
                    </thead>
                    <tbody>
                        @if($exp_reimb_data)
                         <tr>
                                    <td>{{$exp_reimb_data->file_no}}</td>
                                    <td>{{$exp_reimb_data->bill_no}}</td>
                                    <td>{{$exp_reimb_data->value}}</td>
                                    <td>{{$exp_reimb_data->invoice_no}}</td>
                                    <td>{{$exp_reimb_data->transp_doc_date}}</td>
                                    <td>{{$exp_reimb_data->diff_days}}</td>
                         </tr>
                        @else
                        No Data.
                        @endif

                        
                    </tbody>
                </table>    
                </div>
            </div>
            <hr>
            <h4>Entry Form Edit</h4>
             @if($exp_reimb_data)
                 {{Form::open( ["url"=>"commercial/bank/exp_reimb_entry_update", "class"=>"form-horizontal col-xs-12"] )}}
                 <div class="row" >
                    {{-- Left Portion Start --}}
                    <div class="col-sm-5">
                        <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right align-left" for="date_entry" >Date{{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-6">
                                     <input type="date" name="date_entry" id="date_entry" class="col-xs-12" value="{{$exp_reimb_data->date }}" />
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right align-left" for="reimbrusement_amount" >Reimbrusement Amount{{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-6" >
                                    <input type="number" name="reimbrusement_amount" id="reimbrusement_amount"  class="col-xs-12" data-validation="required" value="{{$exp_reimb_data->reimburse_amount }}"/>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right align-left" for="exchange_rate" >Exchange Rate{{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-6" >
                                  <input type="text" name="exchange_rate" id="exchange_rate" class="col-xs-12" placeholder="Enter" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" value="{{$exp_reimb_data->exchange_rate }}"/>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right align-left" for="discount_amount">Discount Amount </label>
                                <div class="col-sm-6" >
                                     <input type="text" name="discount_amount" id="discount_amount" class="col-xs-12" readonly="readonly" value="{{$exp_reimb_data->disc_amount }}" />
                                </div>    
                        </div>
                          {{-- Left Portion end --}}  
                    </div>
                     {{-- Right Portion --}} 
                    <div class="col-sm-7">
                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="fc_amount_dollar" >F.C Amount ($){{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-8"  >
                                        <input type="number" name="fc_amount_dollar" id="fc_amount_dollar"  class="col-xs-7" data-validation="required" value="{{$exp_reimb_data->fc_amount_dollar }}" />
                                        <input type="number" name="fc_amount_per" id="fc_amount_per"  class="col-xs-3" data-validation="required" value="{{$exp_reimb_data->fc_amount_percent }}"/>
                                        <font size="12px" color="purple" class="col-xs-1">%</font>
                                </div> 
                        </div>
                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="cd_amount_dollar" >CD. Amount ($){{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-8"   >
                                        <input type="number" name="cd_amount_dollar" id="cd_amount_dollar"  class="col-xs-7" data-validation="required" value="{{$exp_reimb_data->cd_amount_dollar }}"/>
                                        <input type="number" name="cd_amount_per" id="cd_amount_per"  class="col-xs-3" data-validation="required" value="{{$exp_reimb_data->cd_amount_percent }}" />
                                        <font size="12px" color="purple" class="col-xs-1">%</font>
                                </div> 
                        </div>
                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="a_tax_amount_bdt" >A. Tax Amount (BDT){{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-8"  >
                                        <input type="number" name="a_tax_amount_bdt" id="a_tax_amount_bdt"  class="col-xs-7" data-validation="required" value="{{$exp_reimb_data->a_tax_amount_bdt }}"/>
                                        <input type="number" name="a_tax_amount_per" id="a_tax_amount_per"  class="col-xs-3" data-validation="required" value="{{$exp_reimb_data->a_tax_percent }}"/>
                                        <font size="12px" color="purple" class="col-xs-1">%</font>
                                </div> 
                        </div>
                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="tax_source_bdt" >TAX at Source BDT{{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-8"  >
                                        <input type="number" name="tax_source_bdt" id="tax_source_bdt"  class="col-xs-7" data-validation="required" value="{{$exp_reimb_data->tax_source_bdt }}"/>
                                        <input type="number" name="tax_source_per" id="tax_source_per"  class="col-xs-3" data-validation="required" value="{{$exp_reimb_data->tax_source_bdt_percent }}" />
                                        <font size="12px" color="purple" class="col-xs-1">%</font>
                                </div> 
                        </div>
                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="central_fund_bdt" >Central Fund Account BDT{{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-8"  >
                                        <input type="number" name="central_fund_bdt" id="central_fund_bdt"  class="col-xs-7" data-validation="required" value="{{$exp_reimb_data->central_fund }}" />
                                        <input type="number" name="central_fund_per" id="central_fund_per"  class="col-xs-3" data-validation="required" value="{{$exp_reimb_data->central_fund_percent }}" />
                                        <font size="12px" color="purple" class="col-xs-1">%</font>
                                </div> 
                        </div>
                                
                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="discount_interest_usd" >Discount Interest USD{{-- <span style="color: red">&#42;</span> --}} </label>
                                <div class="col-sm-8"  >
                                  <input type="number" name="discount_interest_usd" id="discount_interest_usd"  class="col-xs-7" data-validation="required" placeholder="Enter" value="{{$exp_reimb_data->discount_interest_usd }}"/>
                                </div> 
                        </div>
                        
                    </div>
                    {{-- Right Portion End--}}
                </div>
                <div class="row">
                  <div class="col-sm-11">
                    <input type="hidden" name="reimb_id" value="{{$exp_reimb_data->id}}">
                    <input type="hidden" name="inv_no" value="{{$exp_reimb_data->invoice_no}}">
                    <input type="hidden" name="exp_data_entry_1_id" value="{{$exp_reimb_data->cm_exp_data_entry_1_id}}">
                    <button class="btn btn-info btn-sm pull-right" type="submit">
                        {{-- <i class="ace-icon fa fa-check bigger-110"></i> --}}Update</button>
                  </div>
                </div>
               </form>
             @else
                Nothing to edit
             @endif
           
        </div>
    </div>
</div>
@endsection