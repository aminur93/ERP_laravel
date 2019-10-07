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
                <li class="active"> BTB Entry (Machinery) </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> BTB Entry (Machinery) </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/ilc/btb_machinery')  }}" enctype="multipart/form-data">
                     {{ csrf_field() }} 
                    <!-- Part 1 -->
                    <div class="col-sm-7">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="machinery_pi_fileno" > File No<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        {{ Form::select('machinery_pi_fileno', $fileList, null, ['id'=>'machinery_pi_fileno', 'placeholder' =>'Select File', 'class' => 'col-xs-12 no-select', 'data-validation'=>'required'])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_item" >Item<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <select class="col-xs-12 no-select" name="b2b_machinery_item" id="b2b_machinery_item" style="width: 100%" data-validation="required" data-validation-optional="true">
                                                <option value="4">Machinery</option>
                                          </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_lc_no"> L/C No <span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="b2b_machinery_lc_no" id="b2b_machinery_lc_no" value="{{ old('b2b_machinery_lc_no') }}" placeholder="Import L/C No" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_inco_term" >Inco Terms<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <select class="col-xs-12 no-select" name="b2b_machinery_inco_term" id="b2b_machinery_inco_term" style="width: 100%" data-validation="required" data-validation-optional="true">
                                            <option value="">Select Inco terms</option>
                                            <option value="CFR">CFR</option>
                                            <option value="CIF">CIF</option>
                                            <option value="CIP">CIP</option>
                                            <option value="CPT">CPT</option>
                                            <option value="DAF">DAF</option>
                                            <option value="DDP">DDP</option>
                                            <option value="DDU">DDU</option>
                                            <option value="DEQ">DEQ</option>
                                            <option value="DES">DES</option>
                                            <option value="EXW">EXW</option>
                                            <option value="FAS">FAS</option>
                                            <option value="FCA">FCA</option>
                                            <option value="FOB">FOB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="bank_id" >Bank<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        {{ Form::select('bank_id', $bankList, null, [ 'id' => 'bank_id', 'placeholder' =>'Select Bank', 'class' => 'col-xs-12 form-control no-select', 'data-validation'=>'required'])}}
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="form-check-label col-sm-4 control-label no-padding-right" for="b2b_machinery_lc_status" >LC Status<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <div class="radio">
                                            <label>
                                                {{ Form::radio('b2b_machinery_lc_status', 'Foreign', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                                <span class="lbl" value="Foreign"> Foreign</span>
                                            </label>
                                            <label>
                                                {{Form::radio('b2b_machinery_lc_status', 'Local', false, ['class'=>'ace']) }}
                                                <span class="lbl" value="Local"> Local</span>
                                            </label>
                                        </div>
                                   </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_date"> L/C Date <span style="color: red">&#42;</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="b2b_machinery_date" id="b2b_machinery_date" value="{{ old('b2b_machinery_date') }}" placeholder="Import L/C Date" class="col-xs-12 form-control" data-validation="required"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Box Panel -->
                    <div class="col-sm-5">
                        <div class="col-sm-12  panel panel-default" style="padding: 10px;">

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
                    <!-- Part two -->
                    <!-- Part three -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_sup_code">Supplier Code <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('b2b_machinery_sup_code', $supCodeList, null, ['id'=>'b2b_machinery_sup_code', 'placeholder' => 'Select Supplier Code', 'class'=>'col-xs-12 no-select', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" name="sup_name" id="sup_name" placeholder="Supplier Name" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="text" name="lc_amount" id="lc_amount" placeholder="Amount" class="col-xs-12 form-control" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Part Four -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machine_amend_total_amount">L/C Amount <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_machine_amend_total_amount" id="b2b_machine_amend_total_amount" value="{{ old('b2b_machine_amend_total_amount') }}" placeholder="L/C Amount" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machine_amend_lca_no" >LCA No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_machine_amend_lca_no" id="b2b_machine_amend_lca_no" placeholder="LCA No" value="{{ old('b2b_machine_amend_lca_no') }}" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machine_amend_last_ship_date" >Last Shipment Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_machine_amend_last_ship_date" id="b2b_machine_amend_last_ship_date" value="{{ old('b2b_machine_amend_last_ship_date') }}" placeholder="Last Shipment Date" class="col-xs-12 form-control" data-validation="required"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machine_amend_remark">Remarks</label>
                                <div class="col-sm-8">
                                    <textarea name="b2b_machine_amend_remark" class="col-xs-12" id="b2b_machine_amend_remark" data-validation="required" placeholder="Remarks" data-validation="required length" data-validation-length="1-255" data-validation-optional="true">{{ old('b2b_machine_amend_remark') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_currency" >Currency<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12 no-select" name="b2b_machinery_currency" id="b2b_machinery_currency" style="width: 100%" data-validation="required">
                                        <option value="">Select Currency</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="AUD">AUD</option>
                                        <option value="BDT">BDT</option>
                                        <option value="BRR">BRR</option>
                                        <option value="CAD">CAD</option>
                                        <option value="CNY">CNY</option>
                                        <option value="FRF">FRF</option>
                                        <option value="DEM">DEM</option>
                                        <option value="INR">INR</option>
                                        <option value="IDR">IDR</option>
                                        <option value="ITL">ITL</option>
                                        <option value="JPY">JPY</option>
                                        <option value="MYR">MYR</option>
                                        <option value="NLG">NLG</option>
                                        <option value="NZD">NZD</option>
                                        <option value="NOK">NOK</option>
                                        <option value="PKR">PKR</option>
                                        <option value="PHP">PHP</option>
                                        <option value="RUR">RUR</option>
                                        <option value="SAR">SAR</option>
                                        <option value="SGD">SGD</option>
                                        <option value="SEK">SEK</option>
                                        <option value="CHF">CHF</option>
                                        <option value="TWD">TWD</option>
                                        <option value="TRL">TRL</option>
                                        <option value="XAU">XAU</option>
                                        <option value="XAG">XAG</option>
                                        <option value="XPT">XPT</option>
                                        <option value="XPD">XPD</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machine_amend_expiry_date">Expiry Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_machine_amend_expiry_date" id="b2b_machine_amend_expiry_date" value="{{ old('b2b_machine_amend_expiry_date') }}" placeholder="Expiry Date" class="col-xs-12 form-control" data-validation="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_period_id" >Period<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('lc_period_id', $periodList, null,['id'=>'lc_period_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control no-select', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_lc_type" >L/C Type<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('b2b_machinery_lc_type', $lcTypeList, null,['id'=>'b2b_machinery_lc_type', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control no-select', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_marine_ins_no" >Marine Ins. No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_machinery_marine_ins_no" id="b2b_machinery_marine_ins_no" value="{{ old('b2b_machinery_marine_ins_no') }}" placeholder="Marine Insurance No" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_machinery_ins_cover_date">Ins. Cover Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="date" name="b2b_machinery_ins_cover_date" id="b2b_machinery_ins_cover_date" value="{{ old('b2b_machinery_ins_cover_date') }}" placeholder="Insurance Cover Date" class="col-xs-12 form-control" data-validation="required" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="from_date_of_id">From Date of<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('from_date_of_id', $dateOfList, null,['id'=>'from_date_of_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control no-select', 'data-validation'=>'required'])}}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="form-check-label col-sm-4 control-label no-padding-right" for="b2b_machinery_interest" >Interest<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('b2b_machinery_interest', 'WITH INTEREST', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                            <span class="lbl" value="WITH INTEREST"> WITH INTEREST</span>
                                        </label>
                                        <label>
                                            {{Form::radio('b2b_machinery_interest', 'WITH OUT INTEREST', false, ['class'=>'ace']) }}
                                            <span class="lbl" value="WITH OUT INTEREST"> WITH OUT INTEREST</span>
                                        </label>
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
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
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
    $("#machinery_pi_fileno").on('change',function(){
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("comm/import/ilc/cancel_close_info") }}',
                dataType: 'json',
                data: {file_no: $(this).val()},
                success: function(data)
                { 
                    if(data.status==0){
                        $("#cancel_amount").val(data.canceled_amount);
                        $("#cancel_date").val(data.cancelled_date);
                        $("#file_close_date").val(data.date);
                        alert("This File is closed, Select Another!");
                        $('button[type="submit"]').attr('disabled','disabled');
                    }
                    else{
                        $("#cancel_amount").val(data.canceled_amount);
                        $("#cancel_date").val(data.cancelled_date);
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
    //get supplier code on item select
    $("#b2b_item").on('change',function(){
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("comm/import/ilc/supplier_code") }}',
                data: {b2b_item: $(this).val(), file_no: $("#exp_lc_fileno").val()},
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
    $("#b2b_machinery_sup_code").on('change',function(){
        $('#sup_name').val("");
        $('#lc_amount').val("");
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("comm/import/ilc/supplier_info_machine") }}',
                data: {sup_code: $(this).val()},
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



});
</script>
@endsection