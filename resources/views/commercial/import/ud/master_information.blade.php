<!-- MASTER INFORMATION -->
<div class="tab-pane fade in active">
    {{ Form::open(["url"=>"comm/import/ud_master/save", "class"=>"form-horizontal"]) }}
    <!-- File No -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="cm_exp_lc_entry_cm_file_id" > File No<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            {{ Form::select("cm_exp_lc_entry_cm_file_id", $fileList, null, ['class'=>'col-xs-12', 'id'=>'com_exp_lc_entry_exp_lc_fileno', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
        </div>
    </div>

    <!-- UD No. -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_ud_no" > UD No.<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            <input type="text" name="ud_master_ud_no" id="ud_master_ud_no" placeholder="UD No." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
        </div>
    </div>

    <!-- UD Date -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_ud_date" > UD Date<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            <input type="date" name="ud_master_ud_date" id="ud_master_ud_date" placeholder="DD-MM-YYYY" value="" class="col-xs-12" data-validation="required"/>
        </div>
    </div>

    <!-- UD Quantity(pcs) -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_quantity" > UD Quantity(pcs)<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            <input type="text" name="ud_master_quantity" id="ud_master_quantity" placeholder="UD Quantity(pcs)" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
        </div>
    </div>

    <!-- Remarks -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_remarks" > Remarks</label>
        <div class="col-sm-5">
            <textarea type="text" name="ud_master_remarks" id="ud_master_remarks" placeholder="Remarks" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
            data-validation-optional="true"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"></textarea>
        </div>
    </div>

    <!-- BGMEA Ref. -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_bgmea_ref" > BGMEA Ref.</label>
        <div class="col-sm-5">
            <input type="text" name="ud_master_bgmea_ref" id="ud_master_bgmea_ref" placeholder="BGMEA Ref." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
            data-validation-optional="true"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
        </div>
    </div>

    <!-- SUBMIT -->
    <div class="form-group">
        <div class="space-4"></div>
        <div class="space-4"></div>
        <div class="space-4"></div>
        <div class="space-4"></div>
        <div class="space-4"></div>
        <div class="clearfix form-actions">
            <div class="col-sm-offset-3 col-sm-5">
                <button class="btn btn-info" type="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i> Save
                </button>
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                </button>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</div>
