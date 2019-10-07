<?php $rand = rand(1,1000); ?>
<div class="col-sm-offset-1 col-sm-10" id="row{{ $rand }}">
    <div class="col-sm-3">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding" for="inv_qty" >Quan{{PHP_EOL}}tity </label>
            <div class="col-sm-9">
                <input type="text" id="inv_qty" placeholder="" value="{{ '' }}" class="col-xs-12 form-control" readonly="readonly" />
            </div>
        </div> 
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding" for="consumption" >Consu{{PHP_EOL}}mption </label>
            <div class="col-sm-9">
                <input type="text" name="consumption[]" placeholder="" value="{{ '' }}" class="col-xs-12 form-control"/>
            </div>
        </div> 
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding" for="fabric_qty" >Fabric Qty</label>
            <div class="col-sm-9">
                <input type="text" name="fabric_qty[]" placeholder="" value="{{ '' }}" class="col-xs-12 form-control"/>
            </div>
        </div> 
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding" for="uom" >UOM</label>
            <div class="col-sm-9">
            <?php $uom = ['UOM1','UOM2','UOM3','UOM4']; ?>
            {{ Form::select("uom[]", $uom, null, ['class'=>'col-xs-12 form-control', 'placeholder'=>'Select UOM']) }}
            </div>
        </div>
    </div>
    <div class="col-sm-1 pull-right">
        <button type="button" onclick="deleteRow('row{{ $rand }}')" class="btn btn-danger btn-xs">-</button>
    </div>
</div>

<script type="text/javascript">
    function deleteRow(id) {
        $('#'+id).remove();
    }
</script>