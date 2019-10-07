<!-- MASTER INFORMATION -->
<div class="tab-pane fade in active">
    {{ Form::open(["url"=>"comm/import/ud_master/master_information_update", "class"=>"form-horizontal"]) }}
    <input type="hidden" name="id" value="{{ $udMaster->id }}">
    <!-- File No -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="cm_exp_lc_entry_cm_file_id" > File No<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            {{ Form::select("cm_exp_lc_entry_cm_file_id", $fileList, $udMaster->cm_file_id, ['class'=>'col-xs-12', 'id'=>'com_exp_lc_entry_exp_lc_fileno', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
        </div>
    </div>
    <!-- UD No. -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_ud_no" > UD No.<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            <input type="text" name="ud_master_ud_no" value="{{ $udMaster->ud_no }}" id="ud_master_ud_no" placeholder="UD No." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
        </div>
    </div>
    <!-- UD Date -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_ud_date" > UD Date<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            <input type="date" name="ud_master_ud_date" id="ud_master_ud_date" placeholder="DD-MM-YYYY" value="{{ $udMaster->ud_date }}" class="col-xs-12" data-validation="required" />
        </div>
    </div>
    <!-- UD Quantity(pcs) -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_quantity" > UD Quantity(pcs)<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            <input type="text" name="ud_master_quantity" id="ud_master_quantity" placeholder="UD Quantity(pcs)" value="{{ $udMaster->total_qty }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
        </div>
    </div>
    <!-- Remarks -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_remarks" > Remarks</label>
        <div class="col-sm-5">
            <textarea type="text" name="ud_master_remarks" id="ud_master_remarks" placeholder="Remarks" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
            data-validation-optional="true"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">{{ $udMaster->remarks }}</textarea>
        </div>
    </div>
    <!-- BGMEA Ref. -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="ud_master_bgmea_ref" > BGMEA Ref.</label>
        <div class="col-sm-5">
            <input type="text" name="ud_master_bgmea_ref" id="ud_master_bgmea_ref" placeholder="BGMEA Ref." value="{{ $udMaster->bgmea_remarks }}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
            data-validation-optional="true"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
        </div>
    </div>
    <div class="form-group">
      <?php $i=1; ?>
        @foreach($udMasterAmend as $amend)
        <table style="width:80%;border:1px solid #999;" align="center">
            <tr style="background:yellowgreen">
                <th colspan="2" style="padding:4px 10px;font-weight:bolder;text-align:center;"><h4>Amendment Entry Screen</h4></th>
            </tr>
            <tr>
                <th style="padding:4px 10px">
                    Amendment No: <input type="text" name="ud_master_amend_no[]" class="input-sm form-control" value="{{ $amend->amend_no == 0 ? 1:$amend->amend_no }}" placeholder="Amendment No" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&amp;a-z A-Z0-9]+)$">
                </th>
                <th style="padding:4px 10px">
                    Amendment Date: <input type="date" name="ud_master_amend_date[]" value="{{ $amend->amend_date }}" class="input-sm form-control" placeholder="Amendment Date" data-validation="required" >
                </th>
            </tr>
            <tr>
                <th colspan="2" style="padding:4px 10px">
                    BGMEA Ref: <textarea type="text" name="ud_master_amend_bgmea_ref[]" placeholder="BGMEA Ref" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">{{ $amend->bgmea_ref }}</textarea>
                </th>
            </tr>
            <tr>
                <th style="padding:4px 10px">
                    Amandment Qty: <input type="text" name="ud_master_amend_qty[]" class="input-sm form-control" placeholder="Amandment Qty" value="{{ $amend->amend_qty }}" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&amp;a-z A-Z0-9]+)$">
                </th>
                <th style="padding:4px 10px">
                    Total Qty: <input type="text" name="ud_master_amend_total_qty[]" value="{{ $amend->total_qty }}" class="input-sm form-control total_qty" placeholder="Total Qty" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&amp;a-z A-Z0-9]+)$">
                </th>
            </tr>
        </table>
        @endforeach
    </div>
    <!-- // AMENDMENT FORM -->
    <div class="form-group text-right" style="width:92%;margin-bottom:0;">
        <button class="btn btn-xs btn-success toggoleAmendment" type="button">
            <i class="ace-icon fa fa-plus"></i> Add Amendment
        </button>
    </div>
    <div class="form-group amendmentForm hide">
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
                    <i class="ace-icon fa fa-check bigger-110"></i> Update
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

<script type="text/javascript">
$(document).ready(function(){
    // Amendment Form
    let data = "<table style=\"width:80%;border:1px solid #999;\" align=\"center\">"+
        "<tr style=\"background:lightgreen\">"+
            "<th colspan=\"2\" style=\"padding:4px 10px;font-weight:bolder;text-align:center;\"><h4>Amendment Entry Screen</h4>"+
            "</th>"+
        "</tr>"+
        "<tr>"+
            "<th style=\"padding:4px 10px\">Amendment No: <input type=\"text\" name=\"ud_master_amend_no[]\" class=\"input-sm form-control\" value=\"{{ $amend->amend_no == 0 ? 2 : $amend->amend_no + 1 }}\" placeholder=\"Amendment No\" data-validation=\"required length custom\" data-validation-length=\"1-45\" data-validation-regexp=\"^([,-./;:_()%$&amp;a-z A-Z0-9]+)$\">"+
            "</th>"+
            "<th style=\"padding:4px 10px\">Amendment Date: <input type=\"date\" name=\"ud_master_amend_date[]\" class=\"input-sm form-control\" placeholder=\"Amendment Date\" data-validation=\"required\" data-validation-length=\"1-20\">"+
            "</th>"+
        "</tr>"+
        "<tr>"+
            "<th colspan=\"2\" style=\"padding:4px 10px\">BGMEA Ref: <textarea type=\"text\" name=\"ud_master_amend_bgmea_ref[]\" placeholder=\"BGMEA Ref\" class=\"col-xs-12\" data-validation=\"required length custom\" data-validation-length=\"1-60\" data-validation-regexp=\"^([,-./;:_()%$&a-z A-Z0-9]+)$\"></textarea>"+
            "</th>"+
        "</tr>"+
        "<tr>"+
            "<th style=\"padding:4px 10px\">Amandment Qty: <input type=\"text\" name=\"ud_master_amend_qty[]\" class=\"input-sm form-control\" placeholder=\"Amandment Qty\" data-validation=\"required length custom\" data-validation-length=\"1-45\" data-validation-regexp=\"^([,-./;:_()%$&amp;a-z A-Z0-9]+)$\">"+
            "</th>"+
            "<th style=\"padding:4px 10px\">Total Qty: <input type=\"text\" name=\"ud_master_amend_total_qty[]\" value=\"{{ $amend->total_qty }}\" class=\"input-sm form-control total_qty\" placeholder=\"Total Qty\" data-validation=\"required length custom\" data-validation-length=\"1-45\" data-validation-regexp=\"^([,-./;:_()%$&amp;a-z A-Z0-9]+)$\">"+
            "</th>"+
        "</tr>"+
        "</table>";
    $(".toggoleAmendment").on('click', function(){
        $(".amendmentForm").toggleClass("show hide")
        if ($(".amendmentForm").hasClass("show")) {
            $(".amendmentForm").html(data);
        } else {
            $(".amendmentForm").html("");
        }
    });
    // summation of quantity
    $("body").on('keyup', '.total_qty', function(){
        $(".total_qty").each(function(i, v){
            $("#ud_master_quantity").val($(this).val());
        });
    });
});
</script>
