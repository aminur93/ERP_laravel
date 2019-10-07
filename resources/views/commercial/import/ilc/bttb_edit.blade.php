@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li> 
                <li>
                    <a href="#"> Import </a>
                </li>
                <li class="active">BTB(Fabric, Accessories) Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> BTB(Fabric, Accessories) Edit</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/ilc/btb_update')  }}" enctype="multipart/form-data">
                     {{ csrf_field() }} 
                    <!-- Part 1 -->
                    <input type="hidden" name="b2b_id" id="b2b_id" value="{{ $btb->b2b_id }}">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="exp_lc_fileno" > File No<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="exp_lc_fileno" name="exp_lc_fileno" value="{{ $btb->exp_lc_fileno }}" class="col-xs-12" data-validation="required" readonly/>
                            </div>
                        </div>   

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="b2b_item" >Item<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('b2b_item', $piTypeList, $btb->b2b_item, [ 'id' => 'b2b_item', 'placeholder' => 'Select Item', 'class' => 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div> 

                        <div class="form-group ">
                            <label class="form-check-label col-sm-3 control-label no-padding-right" for="cmpc" >LC Type<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                @if($btb->b2b_lc_status == "Foreign")
                                <div class="radio">
                                    <label>

                                        {{ Form::radio('b2b_lc_status', 'Foreign', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                        <span class="lbl" value="Foreign"> Foreign</span>
                                    </label>
                                    <label>
                                        {{Form::radio('b2b_lc_status', 'Local', false, ['class'=>'ace']) }}
                                        <span class="lbl" value="Local"> Local</span>
                                    </label>
                                </div>
                                @else
                                <div class="radio">
                                    <label>

                                        {{ Form::radio('b2b_lc_status', 'Foreign', false, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                        <span class="lbl" value="Foreign"> Foreign</span>
                                    </label>
                                    <label>
                                        {{Form::radio('b2b_lc_status', 'Local', true, ['class'=>'ace']) }}
                                        <span class="lbl" value="Local"> Local</span>
                                    </label>
                                </div>
                                @endif
                           </div>
                        </div>

                        <div class="form-group ">
                            <label class="col-sm-3 control-label no-padding-right" for="b2b_lc_no"> L/C No <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="b2b_lc_no" id="b2b_lc_no" value="{{ $btb->b2b_lc_no }}" placeholder="Import L/C No" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>
                    </div>
                    <!-- Box Panel -->
                    <div class="col-sm-7">
                        <div class="col-sm-8 col-sm-offset-4 panel panel-default" style="padding: 10px;">

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cancel_amount" > Cancel Amount </label>
                                <div class="col-sm-8">
                                    <input type="text" id="cancel_amount" name="cancel_amount" placeholder="Cancel Amount" value="" class="col-xs-12" readonly />
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cancel_date" > Cancel Date</label>
                                <div class="col-sm-8">
                                    <input type="text" id="cancel_date" name="cancel_date" placeholder="Cancel Date" value="" class="col-xs-12" readonly />
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="file_close_date" > File Close Date</label>
                                <div class="col-sm-8">
                                    <input type="text" id="file_close_date" name="file_close_date" placeholder="File Close Date" value="" class="col-xs-12" readonly />
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- Part two -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_lc_date"> L/C Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_lc_date" id="b2b_lc_date" value="{{ $btb->b2b_lc_date }}" placeholder="Import L/C Date" class="col-xs-12 form-control" data-validation="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_inco_term" >Inco Terms<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12" name="b2b_inco_term" id="b2b_inco_term" style="width: 100%" data-validation="required" data-validation-optional="true">
                                        <option value="">Select Inco terms</option>
                                        <option value="CFR" <?php if($btb->b2b_inco_term == "CFR") echo "Selected"; ?> >CFR</option>
                                        <option value="CIF" <?php if($btb->b2b_inco_term == "CIF") echo "Selected"; ?> >CIF</option>
                                        <option value="CIP" <?php if($btb->b2b_inco_term == "CIP") echo "Selected"; ?> >CIP</option>
                                        <option value="CPT" <?php if($btb->b2b_inco_term == "CPT") echo "Selected"; ?> >CPT</option>
                                        <option value="DAF" <?php if($btb->b2b_inco_term == "DAF") echo "Selected"; ?> >DAF</option>
                                        <option value="DDP" <?php if($btb->b2b_inco_term == "DDP") echo "Selected"; ?> >DDP</option>
                                        <option value="DDU" <?php if($btb->b2b_inco_term == "DDU") echo "Selected"; ?> >DDU</option>
                                        <option value="DEQ" <?php if($btb->b2b_inco_term == "DEQ") echo "Selected"; ?> >DEQ</option>
                                        <option value="DES" <?php if($btb->b2b_inco_term == "DES") echo "Selected"; ?> >DES</option>
                                        <option value="EXW" <?php if($btb->b2b_inco_term == "EXW") echo "Selected"; ?> >EXW</option>
                                        <option value="FAS" <?php if($btb->b2b_inco_term == "FAS") echo "Selected"; ?> >FAS</option>
                                        <option value="FCA" <?php if($btb->b2b_inco_term == "FCA") echo "Selected"; ?> >FCA</option>
                                        <option value="FOB" <?php if($btb->b2b_inco_term == "FOB") echo "Selected"; ?> >FOB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- Part three -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_lc_date">Supplier Code <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('b2b_lc_sup_code', $supplierList, $btb->b2b_lc_sup_code, ['id'=>'b2b_lc_sup_code', 'placeholder' => 'Select Supplier Code', 'class'=>'col-xs-12', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" name="sup_name" id="sup_name" value="{{ $sup_info['sup_name'] }}" placeholder="Supplier Name" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="text" name="lc_amount" id="lc_amount" value="{{ $sup_info['amount'] }}" placeholder="Amount" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Part Four -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_total_amount">L/C Amount</label>
                                <div class="col-sm-8">
                                    <input type="text" name="lc_total_amount" id="lc_total_amount" value="{{ $btb->lc_total_amount }}" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="b2b_inco_term" >Currency<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12" name="b2b_lc_currency" id="b2b_lc_currency" style="width: 100%" data-validation="required">
                                        <option value="">Select Currency</option>
                                        <option value="USD" <?php if($btb->b2b_lc_currency == "USD") echo "Selected"; ?>>USD</option>
                                        <option value="EUR" <?php if($btb->b2b_lc_currency == "EUR") echo "Selected"; ?> >EUR</option>
                                        <option value="GBP" <?php if($btb->b2b_lc_currency == "GBP") echo "Selected"; ?> >GBP</option>
                                        <option value="AUD" <?php if($btb->b2b_lc_currency == "AUD") echo "Selected"; ?> >AUD</option>
                                        <option value="BDT" <?php if($btb->b2b_lc_currency == "BDT") echo "Selected"; ?> >BDT</option>
                                        <option value="BRR" <?php if($btb->b2b_lc_currency == "BRR") echo "Selected"; ?> >BRR</option>
                                        <option value="CAD" <?php if($btb->b2b_lc_currency == "CAD") echo "Selected"; ?> >CAD</option>
                                        <option value="CNY" <?php if($btb->b2b_lc_currency == "CNY") echo "Selected"; ?> >CNY</option>
                                        <option value="FRF" <?php if($btb->b2b_lc_currency == "FRF") echo "Selected"; ?> >FRF</option>
                                        <option value="DEM" <?php if($btb->b2b_lc_currency == "DEM") echo "Selected"; ?> >DEM</option>
                                        <option value="INR" <?php if($btb->b2b_lc_currency == "INR") echo "Selected"; ?> >INR</option>
                                        <option value="IDR" <?php if($btb->b2b_lc_currency == "IDR") echo "Selected"; ?> >IDR</option>
                                        <option value="ITL" <?php if($btb->b2b_lc_currency == "ITL") echo "Selected"; ?> >ITL</option>
                                        <option value="JPY" <?php if($btb->b2b_lc_currency == "JPY") echo "Selected"; ?> >JPY</option>
                                        <option value="MYR" <?php if($btb->b2b_lc_currency == "MYR") echo "Selected"; ?> >MYR</option>
                                        <option value="NLG" <?php if($btb->b2b_lc_currency == "NLG") echo "Selected"; ?> >NLG</option>
                                        <option value="NZD" <?php if($btb->b2b_lc_currency == "NZD") echo "Selected"; ?> >NZD</option>
                                        <option value="NOK" <?php if($btb->b2b_lc_currency == "NOK") echo "Selected"; ?> >NOK</option>
                                        <option value="PKR" <?php if($btb->b2b_lc_currency == "PKR") echo "Selected"; ?> >PKR</option>
                                        <option value="PHP" <?php if($btb->b2b_lc_currency == "PHP") echo "Selected"; ?> >PHP</option>
                                        <option value="RUR" <?php if($btb->b2b_lc_currency == "RUR") echo "Selected"; ?> >RUR</option>
                                        <option value="SAR" <?php if($btb->b2b_lc_currency == "SAR") echo "Selected"; ?> >SAR</option>
                                        <option value="SGD" <?php if($btb->b2b_lc_currency == "SGD") echo "Selected"; ?> >SGD</option>
                                        <option value="SEK" <?php if($btb->b2b_lc_currency == "SEK") echo "Selected"; ?> >SEK</option>
                                        <option value="CHF" <?php if($btb->b2b_lc_currency == "CHF") echo "Selected"; ?> >CHF</option>
                                        <option value="TWD" <?php if($btb->b2b_lc_currency == "TWD") echo "Selected"; ?> >TWD</option>
                                        <option value="TRL" <?php if($btb->b2b_lc_currency == "TRL") echo "Selected"; ?> >TRL</option>
                                        <option value="XAU" <?php if($btb->b2b_lc_currency == "XAU") echo "Selected"; ?> >XAU</option>
                                        <option value="XAG" <?php if($btb->b2b_lc_currency == "XAG") echo "Selected"; ?> >XAG</option>
                                        <option value="XPT" <?php if($btb->b2b_lc_currency == "XPT") echo "Selected"; ?> >XPT</option>
                                        <option value="XPD" <?php if($btb->b2b_lc_currency == "XPD") echo "Selected"; ?> >XPD</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <!-- Part Five -->
                    <div class="col-sm-12">
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_lc_marine_ins_no" >Marine Insurance No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_lc_marine_ins_no" id="b2b_lc_marine_ins_no" value="{{ $btb->b2b_lc_marine_ins_no }}" placeholder="Marine Insurance No" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_lca_no" >LCA No</label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_amend_lca_no" id="b2b_amend_lca_no" placeholder="LCA No" value="{{ $btb->b2b_amend_lca_no }}" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_expiry_date">Expiry Date</label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_amend_expiry_date" id="b2b_amend_expiry_date" value="{{ $btb->b2b_amend_expiry_date }}" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <!-- Part Six -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_lc_ins_cover_date">Insurance Cover Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_lc_ins_cover_date" id="b2b_lc_ins_cover_date" value="{{ $btb->b2b_lc_ins_cover_date }}" placeholder="Insurance Cover Date" class="col-xs-12 form-control" data-validation="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_last_ship_date" >Last Shipment Date</label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_amend_last_ship_date" id="b2b_amend_last_ship_date" value="{{ $btb->b2b_amend_last_ship_date }}" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="lc_period_id" >Period<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('lc_period_id', $periodList, $btb->lc_period_id,['id'=>'lc_period_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                        </div>
                    </div>  

                    <!-- Part Seven -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="from_date_of_id">From the date of <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('from_date_of_id', $dateOfList, $btb->from_date_of_id,['id'=>'from_date_of_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group ">
                            <label class="form-check-label col-sm-2 control-label no-padding-right" for="b2b_lc_interest" >LC Type<span style="color: red">&#42;</span></label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    @if($btb->b2b_lc_interest == "WITH INTEREST")
                                    <label>
                                        {{ Form::radio('b2b_lc_interest', 'WITH INTEREST', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                        <span class="lbl" value="WITH INTEREST"> WITH INTEREST</span>
                                    </label>
                                    <label>
                                        {{Form::radio('b2b_lc_interest', 'WITH OUT INTEREST', false, ['class'=>'ace']) }}
                                        <span class="lbl" value="WITH OUT INTEREST"> WITH OUT INTEREST</span>
                                    </label>
                                    @else
                                    <label>
                                        {{ Form::radio('b2b_lc_interest', 'WITH INTEREST', false, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                        <span class="lbl" value="WITH INTEREST"> WITH INTEREST</span>
                                    </label>
                                    <label>
                                        {{Form::radio('b2b_lc_interest', 'WITH OUT INTEREST', true, ['class'=>'ace']) }}
                                        <span class="lbl" value="WITH OUT INTEREST"> WITH OUT INTEREST</span>
                                    </label>
                                    @endif
                                </div>
                           </div>
                        </div>
                        </div>
                    </div>  
                    <!-- Part Eight -->
                    <div class="col-sm-12">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_id" >L/C Type<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('lc_id', $lcTypeList, $btb->lc_id,['id'=>'lc_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_remark">Remarks</label>
                                <div class="col-sm-9">
                                    <textarea name="b2b_amend_remark" class="col-xs-12" id="b2b_amend_remark" readonly>{{ $btb->b2b_amend_remark }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_status" >Status<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12" name="b2b_status" id="b2b_status" style="width: 100%" data-validation="required">
                                        <option value="">Select Status</option>
                                        <option value="1" <?php if($btb->b2b_status == 1) echo "Selected"; ?> >Active</option>
                                        <option value="0" <?php if($btb->b2b_status == 0) echo "Selected"; ?> >Cancel</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden" id="cancelDateDiv">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="b2b_lc_cancel_date" >Cancel Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-6">
                                    <input type="date" name="b2b_lc_cancel_date" id="b2b_lc_cancel_date" class="col-xs-12 form-control" data-validation="required"/>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <!-- These Divs are for amendments -->
                    <div class="col-sm-12">
                    
                        <div class="col-sm-10 col-sm-offset-1">
                            <legend>Previous Amendments</legend>
                        </div>
                        @foreach($amendments AS $amendment)
                        <div class="col-sm-10 col-sm-offset-1 panel panel-default" style="padding: 5px;">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_id" >Amendment No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="b2b_amend_id" id="b2b_amend_id" value="{{ $amendment->b2b_amend_id-1 }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_date" >Amendment Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="b2b_amend_date" id="b2b_amend_date" value="{{ $amendment->b2b_amend_date }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_reason" >Amendment Reason</label>
                                    <div class="col-sm-8">
                                        <select class="col-xs-12" name="b2b_amend_reason" id="b2b_amend_reason" style="width: 100%" disabled>
                                            <option value="">Select Inco terms</option>
                                            <option value="New" <?php if($amendment->b2b_amend_reason == "New") echo "Selected"; ?> >New</option>
                                            <option value="Increase" <?php if($amendment->b2b_amend_reason == "Increase") echo "Selected"; ?> >Value Increase</option>
                                            <option value="Decrease" <?php if($amendment->b2b_amend_reason == "Decrease") echo "Selected"; ?> >Value Decrease</option>
                                            <option value="Others" <?php if($amendment->b2b_amend_reason == "Others") echo "Selected"; ?> >Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_value" >Amendment Value</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="b2b_amend_value" id="b2b_amend_value" value="{{ $amendment->b2b_amend_value }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_last_ship_date" >Last Ship Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="b2b_amend_last_ship_date" id="b2b_amend_last_ship_date" value="{{ $amendment->b2b_amend_last_ship_date }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_expiry_date" >Expiry Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="b2b_amend_expiry_date" id="b2b_amend_expiry_date" value="{{ $amendment->b2b_amend_expiry_date }}" class="col-xs-12 form-control" readonly />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_lca_no" >LCA No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="b2b_amend_lca_no" id="b2b_amend_lca_no" value="{{ $amendment->b2b_amend_lca_no }}" class="col-xs-12 form-control" readonly />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_remark">Remarks</label>
                                    <div class="col-sm-9">
                                        <textarea name="b2b_amend_remark" class="col-xs-12" id="b2b_amend_remark" disabled>{{ $amendment->b2b_amend_remark }}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="b2b_amend_total_amount" >Total Amount</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="b2b_amend_total_amount" id="b2b_amend_total_amount" value="{{ $amendment->b2b_amend_total_amount }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            <!-- New Amendment -->
                        <div class="col-sm-10 col-sm-offset-1" id="NoAmendmentDiv1">
                            <legend>New Amendment</legend>
                        </div>
                        <div class="col-sm-10 col-sm-offset-1 panel panel-default" id="NoAmendmentDiv2" style="padding: 5px;">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_amend_id" >Amendment No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="am_amend_id" id="am_amend_id" value="{{ $btb->b2b_amend_id }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_amend_date" >Amendment Date<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="am_amend_date" id="am_amend_date" value="{{ old('am_amend_date') }}" class="col-xs-12 form-control" data-validation="required"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_reason" >Amendment Reason<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <select class="col-xs-12 am_reason" name="am_reason" id="am_reason" style="width: 100%" data-validation="required">
                                            <option value="">Select Amendment Reason</option>
                                            <option value="Increase">Value Increase</option>
                                            <option value="Decrease">Value Decrease</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_amend_value" >Amendment Value<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="am_amend_value" id="am_amend_value" value="{{ old('am_amend_value') }}" class="col-xs-12 form-control am_value" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_ship_date" >Last Ship Date<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="am_ship_date" id="am_ship_date" value="{{ old('am_ship_date') }}" class="col-xs-12 form-control" data-validation="required"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_expiry_date" >Expiry Date <span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="am_expiry_date" id="am_expiry_date" value="{{ old('am_expiry_date') }}" class="col-xs-12 form-control" data-validation="required" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_lca_no" >LCA No<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="am_lca_no" id="am_lca_no" value="{{ old('am_lca_no') }}" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_remark">Remarks<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <textarea name="am_remark" class="col-xs-12" id="am_remark" data-validation="required">{{old('am_remark')}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="am_total_amount" >Total Amount</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="am_total_amount" id="am_total_amount" value="{{ old('am_total_amount') }}" class="col-xs-12 form-control" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="col-sm-12">
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-4 col-md-8"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div> 
                    </div>
                </form> 
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 
<script type="text/javascript">
$(document).ready(function(){
    //get cancel amount and file close info
    $("#exp_lc_fileno").on('change',function(){
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("comm/import/ilc/cancel_close_info") }}',
                dataType: 'json',
                data: {file_no: $(this).val()},
                success: function(data)
                { 
                    alert("success")
                },
                error: function(xhr)
                {
                    alert('failed');
                }
            }); 
        }
    });    
    //get supplier code on item select
    $("#b2b_item").on('change',function(){
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("comm/import/ilc/supplier_code") }}',
                data: {item: $(this).val(), file_no: $("#exp_lc_fileno").val()},
                success: function(data)
                { 
                    $('#b2b_lc_sup_code').html(data);
                },
                error: function(xhr)
                {
                    alert('failed');
                }
            }); 
        }
    });    
    //get supplier Information on Supplier Code select
    $("#b2b_lc_sup_code").on('change',function(){
        $('#sup_name').val("");
        $('#lc_amount').val("");
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("comm/import/ilc/supplier_info") }}',
                data: {sup_code: $(this).val(), file_no: $("#exp_lc_fileno").val(), item: $("#b2b_item").val()},
                success: function(data)
                { 
                    $('#sup_name').val(data.sup_name);
                    $('#lc_amount').val(data.amount);
                },
                error: function(xhr)
                {
                    alert('failed');
                }
            }); 
        }
    });

    // calculate amendment amount

    $("body").on("keyup", ".am_value", function(){
        var lc_total_amount= $("#lc_total_amount").val();
        var reason= $("#am_reason").val();
        var am_amend_value= $("#am_amend_value").val();
        var am_total_amount=0;
        if(reason == ""){
            alert("Please Select Amendment Reason");
        }
        else{
            if(reason == "Decrease"){
                if(am_amend_value =="") am_amend_value=0;
                am_total_amount= parseInt(lc_total_amount)- parseInt(am_amend_value);
                $("#am_total_amount").val(am_total_amount);
            }
            else{
                if(am_amend_value =="") am_amend_value=0;
                am_total_amount= parseInt(lc_total_amount)+ parseInt(am_amend_value);
                $("#am_total_amount").val(am_total_amount);
            }
        }
    });   
     // Change Reason 
    $("body").on("change", ".am_reason", function(){
        $("#am_amend_value").val("");
        $("#am_total_amount").val("");
    });

    //On select status cancel show cancel date field
    $("#b2b_status").on('change', function(){
        if($(this).val() == '0'){
            $("#cancelDateDiv").removeClass('hidden');
            $("#NoAmendmentDiv1").addClass('hidden');
            $("#NoAmendmentDiv2").addClass('hidden');
        }
        else{
            $("#cancelDateDiv").addClass('hidden');
            $("#NoAmendmentDiv1").removeClass('hidden');
            $("#NoAmendmentDiv2").removeClass('hidden');
        }
    });



});
</script>
@endsection