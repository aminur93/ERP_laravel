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
                <li class="active"> BTB Entry (Asset/Others) </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> BTB Entry (Asset/Others) </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')

                <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/ilc/btb_asset')  }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     {{-- Part 1 --}}
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_file_id" > File No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_file_id', $fileList, null, ['id'=>'cm_file_id', 'placeholder' =>'Select File', 'class' => 'col-xs-12', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="mr_supplier_sup_id" > Supplier<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('mr_supplier_sup_id', [], null, ['id'=>'mr_supplier_sup_id', 'placeholder' =>'Select Supplier', 'class' => 'col-xs-12', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_payment_type_id" > Payment Type</label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_payment_type_id', $paymentTypeList, null, ['id'=>'cm_payment_type_id', 'placeholder' =>'Select Payment Type', 'class' => 'col-xs-12'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_no"> L/C No <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lc_no" id="lc_no" value="{{ old('lc_no') }}" placeholder="Import L/C No" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
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
                                    <tbody id="pi_bom_table">
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td> Total</td>
                                            <td id="pi_bom_total"></td>
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
                                        <label>
                                            {{ Form::radio('lc_status', 'Foreign', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                            <span class="lbl" value="Foreign"> Foreign</span>
                                        </label>
                                        <label>
                                            {{Form::radio('lc_status', 'Local', false, ['class'=>'ace']) }}
                                            <span class="lbl" value="Local"> Local</span>
                                        </label>
                                    </div>
                               </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_date"> L/C Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lc_date" id="lc_date" value="{{ old('lc_date') }}" placeholder="Import L/C Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_inco_term_id" >Inco Terms<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    
                                  {{ Form::select('cm_inco_term_id', $termList, null,['id'=>'cm_inco_term_id', 'placeholder'=>'Select Inco. Term', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="b2b_amend_total_amount">L/C Amount <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="b2b_amend_total_amount" id="b2b_amend_total_amount" value="{{ old('b2b_amend_total_amount') }}" placeholder="L/C Amount" class="col-xs-12 form-control" data-validation="required number" data-validation-allowing="float" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lc_currency" >Currency<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <select class="col-xs-12" name="lc_currency" id="lc_currency" style="width: 100%" data-validation="required">
                                        <option value="">Select Currency</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBD">GBD</option>
                                        <option value="TK">TK</option>
                                  </select>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="amend_remark">Remarks</label>
                                <div class="col-sm-8">
                                    <textarea name="amend_remark" class="col-xs-12" id="amend_remark" data-validation="required" placeholder="Remarks" data-validation="required length" data-validation-length="1-255" data-validation-optional="true">{{ old('amend_remark') }}</textarea>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-sm-4">


                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="marine_ins_no" >Insurance No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="marine_ins_no" id="marine_ins_no" value="{{ old('marine_ins_no') }}" placeholder="Marine Insurance No" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="marine_ins_cover_date">Cover Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="marine_ins_cover_date" id="marine_ins_cover_date" value="{{ old('marine_ins_cover_date') }}" placeholder="Insurance Cover Date" class="col-xs-12 form-control datepicker" data-validation="required" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="lca_no" >LCA No<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lca_no" id="lca_no" placeholder="LCA No" value="{{ old('lca_no') }}" class="col-xs-12 form-control" data-validation="required"  data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="last_ship_date" >Shipment Date<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_ship_date" id="last_ship_date" value="{{ old('last_ship_date') }}" placeholder="Last Shipment Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="expiry_date">Expiry Date <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" placeholder="Expiry Date" class="col-xs-12 form-control datepicker" data-validation="required"/>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_period_id" >Period<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_period_id', $periodList, null,['id'=>'cm_period_id', 'placeholder'=>'Select Period', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_from_date_id">From date of <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_from_date_id', $dateList, null,['id'=>'cm_from_date_id', 'placeholder'=>'Select Date of', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="cm_lc_type_id" >L/C Type<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    {{ Form::select('cm_lc_type_id', $lcTypeList, null,['id'=>'cm_lc_type_id', 'placeholder'=>'Select L/C Type', 'class'=>'col-xs-12 form-control', 'data-validation'=>'required'])}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="form-check-label col-sm-4 control-label no-padding-right" for="interest" >Interest<span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        <label>
                                            {{ Form::radio('interest', 'With Interest', true, ['class'=>'ace' ,'data-validation'=>'required']) }}
                                            <span class="lbl" value="With Interest"> WITH INTEREST</span>
                                        </label>
                                        <label>
                                            {{Form::radio('interest', 'Without Interest', false, ['class'=>'ace']) }}
                                            <span class="lbl" value="Without Interest"> WITH OUT INTEREST</span>
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
    $("#cm_file_id").on('change',function(){
        $("#cm_payment_type_id").val("").change();
        if($(this).val() != ""){
            $.ajax({
                url: '{{ url("commercial/import/ilc/get_file_info") }}',
                dataType: 'json',
                data: {file_no: $(this).val()},
                success: function(data)
                { 
                    if(data[2]== false){
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
});
</script>
@endsection