<div class="col-sm-offset-1 col-sm-10">
    <legend>Bill Entry Form</legend>
    <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/save_bill_of_entry') }}">
        {{ csrf_field() }}
        <!-- 2nd ROW -->
        {{-- hidden field --}}
        <input type="hidden" id="id" name="id" value="{{ isset($cm_bill_of_entry->id)?$cm_bill_of_entry->id:'' }}">
        <input type="hidden" id="cm_imp_data_entry_id" name="cm_imp_data_entry_id" value="{{ isset($cm_imp_data_entry_id)?$cm_imp_data_entry_id:'' }}">
        <div class="row">
            <!-- Bill entry form -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="entry_no" > Bill of Entry no</label>
                    <div class="col-sm-8">
                        <input type="text" id="entry_no" name="entry_no" placeholder="" value="{{ isset($cm_bill_of_entry->entry_no)?$cm_bill_of_entry->entry_no:'' }}" class="col-xs-12 form-control" data-validation='required'/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="bond_no" > Bond No</label>
                    <div class="col-sm-8">
                        <input type="text" id="bond_no" name="bond_no" placeholder="" value="{{ isset($cm_bill_of_entry->bond_no)?$cm_bill_of_entry->bond_no:'' }}" class="col-xs-12 form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="entry_recv_date" > Bill of Entry Trip. Rcv Date</label>
                    <div class="col-sm-8">
                        <input type="text" id="entry_recv_date" name="entry_recv_date" placeholder="" value="{{ isset($cm_bill_of_entry->entry_recv_date)?$cm_bill_of_entry->entry_recv_date:'' }}" class="datepicker col-xs-12 form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="contro_bank_sub_date" > Bill of Entry Control Bank Sub Date</label>
                    <div class="col-sm-8">
                        <input type="text" id="contro_bank_sub_date" name="contro_bank_sub_date" placeholder="" value="{{ isset($cm_bill_of_entry->contro_bank_sub_date)?$cm_bill_of_entry->contro_bank_sub_date:'' }}" class="datepicker col-xs-12 form-control" />
                    </div>
                </div>
            </div>
            <!-- secound column -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="entrcontro_bank_sub_date_date"> Bill of Entry Date</label>
                    <div class="col-sm-8">
                        <input type="text" id="entry_date" name="entry_date" placeholder="" value="{{ isset($cm_bill_of_entry->entry_date)?$cm_bill_of_entry->entry_date:'' }}" class="datepicker col-xs-12 form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="bond_date" > Bond Date</label>
                    <div class="col-sm-8">
                        <input type="text" id="bond_date" name="bond_date" placeholder="" value="{{ isset($cm_bill_of_entry->bond_date)?$cm_bill_of_entry->bond_date:'' }}" class="datepicker col-xs-12 form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="copy_rcv_date" > Bill of Entry Trip. Rcv Date</label>
                    <div class="col-sm-8">
                        <input type="text" id="copy_rcv_date" name="copy_rcv_date" placeholder="" value="{{ isset($cm_bill_of_entry->copy_rcv_date)?$cm_bill_of_entry->copy_rcv_date:'' }}" class="datepicker col-xs-12 form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="duty_amount_tk" > Duty Amount Tk</label>
                    <div class="col-sm-8">
                        <input type="text" id="duty_amount_tk" name="duty_amount_tk" placeholder="" value="{{ isset($cm_bill_of_entry->duty_amount_tk)?$cm_bill_of_entry->duty_amount_tk:'' }}" class="col-xs-12 form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="assesment_value" > Assessment Value</label>
                    <div class="col-sm-8">
                        <input type="text" id="assesment_value" name="assesment_value" placeholder="" value="{{ isset($cm_bill_of_entry->assesment_value)?$cm_bill_of_entry->assesment_value:'' }}" class="col-xs-12 form-control"/>
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
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i> {{ isset($cm_bill_of_entry->id)?'Update':'Save' }}
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('.datepicker').datetimepicker({
        showClose: true,
        showTodayButton: true,
        dayViewHeaderFormat: "YYYY MMMM",
        format: "YYYY-MM-DD",
        minDate:false
    });
</script>
