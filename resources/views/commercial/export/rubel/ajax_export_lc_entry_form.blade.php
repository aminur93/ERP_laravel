{{-- hidden input --}}
<input type="hidden" name="update_id" value="{{ isset($expUpdateData)?$expUpdateData->id:'' }}">
<div class="col-sm-offset-2 col-sm-8">
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="bank_sub_date" > Bank Submission Date</label>
        <div class="col-sm-8">
            <input type="text" id="bank_sub_date" name="bank_sub_date" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->bank_sub_date:'' }}" class="col-xs-12 form-control datepicker"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="courier_name" > Courier Name (Bank)</label>
        <div class="col-sm-8">
            <input type="text" id="courier_name" name="courier_name" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->courier_name:'' }}" class="col-xs-12 form-control"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="courier_no" > Courier No (Bank)</label>
        <div class="col-sm-8">
            <input type="text" id="courier_no" name="courier_no" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->courier_no:'' }}" class="col-xs-12 form-control"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="courier_date" > Courier Date</label>
        <div class="col-sm-8">
            <input type="text" id="courier_date" name="courier_date" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->courier_date:'' }}" class="col-xs-12 form-control datepicker"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="bill_no" > Bill No</label>
        <div class="col-sm-8">
            <input type="text" id="bill_no" name="bill_no" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->bill_no:'' }}" class="col-xs-12 form-control"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="negotiation_date" > Nagotiation Date</label>
        <div class="col-sm-8">
            <input type="text" id="negotiation_date" name="negotiation_date" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->negotiation_date:'' }}" class="col-xs-12 form-control datepicker"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="exp_proceed_rcv_date" > Export Proceed Rcv Date</label>
        <div class="col-sm-8">
            <input type="text" id="exp_proceed_rcv_date" name="exp_proceed_rcv_date" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->exp_proceed_rcv_date:'' }}" class="col-xs-12 form-control datepicker"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding" for="type_discrepancy" > Type of Discrepancy</label>
        <div class="col-sm-8">
            <input type="text" id="type_discrepancy" name="type_discrepancy" placeholder="" value="{{ isset($expUpdateData)?$expUpdateData->type_discrepancy:'' }}" class="col-xs-12 form-control"/>
        </div>
    </div>
</div>
<div class="col-sm-offset-2 col-sm-8">
    <br>
    <label class="col-sm-4"></label>
    <div class="col-sm-8">
        <button type="submit" class="btn btn-info">{{ isset($expUpdateData->id)?'Update':'Save' }}</button>
    </div>
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