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
                <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/ilc/btb_update')  }}" enctype="multipart/form-data">
                     {{ csrf_field() }} 
                    {{-- Part 1 --}}
                    <div class="col-sm-12">
                        <input type="hidden" name="btb_id" value="{{ $btb->id }}">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_file_id" > File No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_file_id', $fileList, $btb->cm_file_id, ['id'=>'cm_file_id', 'placeholder' =>'Select File', 'class' => 'col-xs-12', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="mr_supplier_sup_id" > Supplier<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('mr_supplier_sup_id', $supplierList, $btb->mr_supplier_sup_id, ['id'=>'mr_supplier_sup_id', 'placeholder' =>'Select Supplier', 'class' => 'col-xs-12', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_payment_type_id" > Payment Type</label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_payment_type_id', $paymentTypeList, $btb->cm_payment_type_id, ['id'=>'cm_payment_type_id', 'placeholder' =>'Select Payment Type', 'class' => 'col-xs-12'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_no"> L/C No <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lc_no" id="lc_no" value="{{ $btb->lc_no }}" placeholder="Import L/C No" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                        </div>
                        {{-- Box 1 --}}
                        <div class="col-sm-4">
                            <div class="col-xs-12 panel panel-default"  style="padding-top: 10px;">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="cancel_amount" > Cancel Amount </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="cancel_amount" name="cancel_amount" placeholder="Cancel Amount" value="" class="col-xs-12" readonly />
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="cancel_date" > Cancel Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" id="cancel_date" name="cancel_date" placeholder="Cancel Date" value="" class="col-xs-12" readonly />
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="file_close_date" > File Close Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" id="file_close_date" name="file_close_date" placeholder="File Close Date" value="" class="col-xs-12" readonly />
                                    </div>
                                </div> 
                            </div>
                        </div>
                        {{-- Box 2 --}}
                        <div class="col-sm-4">
                            <div class="col-xs-12 panel panel-default" style="padding-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>PI No</th>
                                            <th>PI Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td> Total</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Part two -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">

                            <div class="form-group ">
                                <label class="form-check-label col-sm-4 control-label no-padding-right" for="lc_status" >LC Status<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        @if($btb->lc_status=="Foreign")
                                            <label>
                                                {{ Form::radio('lc_status', 'Foreign', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                                <span class="lbl" value="Foreign"> Foreign</span>
                                            </label>
                                            <label>
                                                {{Form::radio('lc_status', 'Local', false, ['class'=>'ace']) }}
                                                <span class="lbl" value="Local"> Local</span>
                                            </label>
                                        @else
                                            <label>
                                                {{ Form::radio('lc_status', 'Foreign', false, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                                <span class="lbl" value="Foreign"> Foreign</span>
                                            </label>
                                            <label>
                                                {{Form::radio('lc_status', 'Local', true, ['class'=>'ace']) }}
                                                <span class="lbl" value="Local"> Local</span>
                                            </label>
                                        @endif
                                    </div>
                               </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_date"> L/C Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lc_date" id="lc_date" value="{{ $btb->lc_date }}" placeholder="Import L/C Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_inco_term_id" >Inco Terms<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    
                                  {{ Form::select('cm_inco_term_id', $termList, $btb->cm_inco_term_id,['id'=>'cm_inco_term_id', 'placeholder'=>'Select Inco. Term', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_total_amount">L/C Amount <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_amend_total_amount" id="b2b_amend_total_amount" value="{{ (!empty($last_amend->amend_total_lc_amount)?$last_amend->amend_total_lc_amount:null ) }}" placeholder="L/C Amount" class="col-xs-12 form-control" data-validation="required number" data-validation-allowing="float"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_currency" >Currency<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12" name="lc_currency" id="lc_currency" style="width: 100%" data-validation="required">
                                        <option value="">Select Currency</option>
                                        <option value="USD" <?php if($btb->lc_currency=="USD") echo "selected" ?> >USD</option>
                                        <option value="EUR" <?php if($btb->lc_currency=="EUR") echo "selected" ?> >EUR</option>
                                        <option value="GBD" <?php if($btb->lc_currency=="GBD") echo "selected" ?> >GBD</option>
                                        <option value="TK" <?php if($btb->lc_currency=="TK") echo "selected" ?> >TK</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="amend_remark">Remarks</label>
                                <div class="col-sm-8">
                                    <textarea name="amend_remark" class="col-xs-12" id="amend_remark" data-validation="required" placeholder="Remarks" data-validation="required length" data-validation-length="1-255" data-validation-optional="true">{{ (!empty($last_amend->amend_remark)?$last_amend->amend_remark:null ) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="marine_ins_no" >Insurance No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="marine_ins_no" id="marine_ins_no" value="{{ (!empty($last_amend->marine_ins_no)?$last_amend->marine_ins_no:null) }}" placeholder="Marine Insurance No" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="marine_ins_cover_date">Cover Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="marine_ins_cover_date" id="marine_ins_cover_date" value="{{ (!empty($last_amend->marine_ins_cover_date)?$last_amend->marine_ins_cover_date:null) }}" placeholder="Insurance Cover Date" class="col-xs-12 form-control datepicker" data-validation="required" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lca_no" >LCA No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lca_no" id="lca_no" placeholder="LCA No" value="{{ (!empty($last_amend->lca_no)?$last_amend->lca_no:null) }}" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="last_ship_date" >Shipment Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_ship_date" id="last_ship_date" value="{{ (!empty($last_amend->last_ship_date)?$last_amend->last_ship_date:null) }}" placeholder="Last Shipment Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="expiry_date">Expiry Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="expiry_date" id="expiry_date" value="{{ (!empty($last_amend->expiry_date)?$last_amend->expiry_date:null) }}" placeholder="Expiry Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_currency" >Status<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12" name="btb_status" id="btb_status" style="width: 100%" data-validation="required">
                                        <option value="">Select Status</option>
                                        <option value="1" <?php if( $btb->lc_active_status==1) echo "selected" ?> >Active</option>
                                        <option value="0" <?php if( $btb->lc_active_status==0) echo "selected" ?>>Cancel</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_period_id" >Period<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_period_id', $periodList, $btb->cm_period_id,['id'=>'cm_period_id', 'placeholder'=>'Select Period', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_from_date_id">From date of <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_from_date_id', $dateList, $btb->cm_from_date_id, ['id'=>'cm_from_date_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_lc_type_id" >L/C Type<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_lc_type_id', $lcTypeList, $btb->cm_lc_type_id, ['id'=>'cm_lc_type_id', 'placeholder'=>'Select L/C Type', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="form-check-label col-sm-4 control-label no-padding-right" for="interest" >Interest<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        @if( $btb->interest == "With Interest")
                                            <label>
                                                {{ Form::radio('interest', 'With Interest', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                                <span class="lbl" value="With Interest"> WITH INTEREST</span>
                                            </label>
                                            <label>
                                                {{Form::radio('interest', 'Without Interest', false, ['class'=>'ace']) }}
                                                <span class="lbl" value="Without Interest"> WITH OUT INTEREST</span>
                                            </label>
                                        @else
                                            <label>
                                                {{ Form::radio('interest', 'With Interest', false, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                                <span class="lbl" value="With Interest"> WITH INTEREST</span>
                                            </label>
                                            <label>
                                                {{Form::radio('interest', 'Without Interest', true, ['class'=>'ace']) }}
                                                <span class="lbl" value="Without Interest"> WITH OUT INTEREST</span>
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group hide" id="cancel_date_div">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_currency" >Cancel Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="btb_cancel_date" id="btb_cancel_date" placeholder="Cancel Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <!-- These Divs are for amendments -->
                    <div class="col-sm-12">
                        @if($amendments->count()>0)
                            <legend>Previous Amendments</legend>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Amendment No</td>
                                        <td>Date</td>
                                        <td>Reason</td>
                                        <td>Value</td>
                                        <td>Ship Date</td>
                                        <td>Expiry Date</td>
                                        <td>LCA No</td>
                                        <td>Total Amount</td>
                                        <td>Marine Ins No</td>
                                        <td>Cover Date</td>
                                        <td>Remarks</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($amendments AS $amendment)
                                        <tr>
                                            <td> {{ $amendment->amend_no }} </td>
                                            <td> {{ $amendment->amend_date }} </td>
                                            <td> {{ $amendment->amend_reason }} </td>
                                            <td> {{ $amendment->amend_value }} </td>
                                            <td> {{ $amendment->last_ship_date }} </td>
                                            <td> {{ $amendment->expiry_date }} </td>
                                            <td> {{ $amendment->lca_no }} </td>
                                            <td> {{ $amendment->amend_total_lc_amount }} </td>
                                            <td> {{ $amendment->marine_ins_no }} </td>
                                            <td> {{ $amendment->marine_ins_cover_date }} </td>
                                            <td> {{ $amendment->amend_remark }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>   

                    <!-- New Amendment -->
                    

                    <div class="col-sm-12 hide" id="amend_div">
                        <legend>New Amendment</legend>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_amend_id" >Amendment No</label>
                                <div class="col-sm-8">
                                    <input type="text" name="am_amend_id" id="am_amend_id" value="{{ (!empty($last_amend->amend_no)?($last_amend->amend_no+1):0 ) }}" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_amend_date" >Amendment Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="am_amend_date" id="am_amend_date" value="{{ old('am_amend_date') }}" class="col-xs-12 form-control datepicker" data-validation="required" placeholder="Amendment Date"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_reason" >Amendment Reason<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12 am_reason" name="am_reason" id="am_reason" style="width: 100%" data-validation="required">
                                        <option value="">Select Amendment Reason</option>
                                        <option value="Value Increase">Value Increase</option>
                                        <option value="Value Decrease">Value Decrease</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_amend_value" >Amendment Value<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="am_amend_value" id="am_amend_value" value="{{ old('am_amend_value') }}" class="col-xs-12 form-control am_value" data-validation="required number" data-validation-allowing="float" placeholder="Amendment Value"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_ship_date" >Last Ship Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="am_ship_date" id="am_ship_date" value="{{ old('am_ship_date') }}" class="col-xs-12 form-control datepicker" data-validation="required" placeholder="Last Ship Date"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_expiry_date" >Expiry Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="am_expiry_date" id="am_expiry_date" value="{{ old('am_expiry_date') }}" class="col-xs-12 form-control datepicker" data-validation="required" placeholder="Expiry Date"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_lca_no" >LCA No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="am_lca_no" id="am_lca_no" value="{{ old('am_lca_no') }}" placeholder="LCA No" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="am_remark">Remarks<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <textarea name="am_remark" class="col-xs-12" id="am_remark" data-validation="required" placeholder="Amendment Remarks">{{old('am_remark')}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="am_total_amount" >Total Amount</label>
                                <div class="col-sm-8">
                                    <input type="text" id="am_total_amount" name="am_total_amount"   class="col-xs-12 form-control" placeholder="Total Amount" readonly/>
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
                                <button class="btn btn-primary" type="button" id="amend_button">Amendment</button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
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
    $("#cm_file_id").on('change',function(){
        $("#cm_payment_type_id").val("").change();
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("commercial/import/ilc/cancel_close_info") }}',
                dataType: 'json',
                data: {file_no: $(this).val()},
                success: function(data)
                { 
                    if(data[2]==0){
                        $("#cancel_amount").val("");
                        $("#cancel_date").val("");
                        $("#file_close_date").val(data[3]);
                        alert("This File is closed, Select Another!");
                        $('button[type="submit"]').attr('disabled','disabled');
                    }
                    else{
                        $("#cancel_amount").val(data[0]);
                        $("#cancel_date").val(data[1]);
                        $("#mr_supplier_sup_id").html(data[4]);
                        $("#file_close_date").val("");
                        if($('button[type="submit"]').is(":disabled")){
                            $('button[type="submit"]').removeAttr('disabled');
                        }
                    }
                },
                error: function(xhr)
                {
                    alert('failed');
                }
            }); 
        }
    });  

    //get PI Informations on select payment type
    $("#cm_payment_type_id").on('change',function(){
        if($(this).val() != ""){
            var supplier= $("#mr_supplier_sup_id").val();
            var file= $("#cm_file_id").val();
            if(supplier=="" || file==""){
                alert("Please Select File and Supplier");
                $(this).val("");
            }
            else{
                $.ajax({
                    url: '{{ url("commercial/import/ilc/pi_bom_info") }}',
                    data: {supplier: supplier, file: file, payment_type: $(this).val()},
                    success: function(data)
                    { 
                        $("#pi_bom_total").html(data[0]);
                        $("#b2b_amend_total_amount").val(data[0]);
                        $("#pi_bom_table").html(data[1]);
                    },
                    error: function(xhr)
                    {
                        alert('failed');
                    }
                }); 
            }
        }
    }); 

     //show amendment div
    $("#amend_button").on('click', function(){
        $('#amend_div').removeClass('hide');
        $('#amend_button').attr("disabled","disabled");
    });


    //calculate amendment total
    $("#am_amend_value").on('keyup', function(){
        var lc_amount= parseFloat($("#b2b_amend_total_amount").val());
        var amend_amount= parseFloat($(this).val());
        if($("#am_reason").val()== "Value Decrease"){
            var total_amount= parseFloat((parseFloat(lc_amount)-parseFloat(amend_amount)).toFixed(2));
        }
        else{
            var total_amount= parseFloat((parseFloat(lc_amount)+parseFloat(amend_amount)).toFixed(2));
        }
        
        $("#am_total_amount").val(total_amount);
    });

     //select amendment reason
    $("#am_reason").on("change", function(){
        $("#am_amend_value").val("");
    });

    //show cancel date field
    $("#btb_status").on("change", function(){
        if($(this).val() == "0"){
            $("#cancel_date_div").removeClass("hide");
        }
        else{
            $("#cancel_date_div").addClass("hide");
        }
    });


    //On select status cancel show cancel date field
    // $("#b2b_status").on('change', function(){
    //     if($(this).val() == '0'){
    //         $("#cancelDateDiv").removeClass('hidden');
    //         $("#NoAmendmentDiv1").addClass('hidden');
    //         $("#NoAmendmentDiv2").addClass('hidden');
    //     }
    //     else{
    //         $("#cancelDateDiv").addClass('hidden');
    //         $("#NoAmendmentDiv1").removeClass('hidden');
    //         $("#NoAmendmentDiv2").removeClass('hidden');
    //     }
    // });

});
</script>
@endsection