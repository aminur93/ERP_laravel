<?php
    $idList = [];
    foreach($poSubStyleList as $k=>$poSubStyle) {
        $idList[] = $poSubStyle->clr_id;
    }    
?>
<div class="row col-sm-12" id="color_edit">
    <div class="form-group col-sm-12" style="margin-bottom: 15px;" >
        <label style="font-size: 10px;" class="col-sm-1 control-label no-padding-right" for="po_color_select_edit">Colors<span style="color: red">&#42;</span> </label>
        <div class="col-sm-8">
            @if(!empty($colorList))
                @foreach($colorList as $cKey=>$color)
                    <input type="checkbox" name="po_color_select[]" class="form-control edit_po_color_select" id="edit_color_{{ $color->clr_id }}" data-id="{{ $color->clr_id }}" value="{{ $color->clr_name }}" {{ in_array($color->clr_id, $idList)!==FALSE?'checked="checked"':'' }}/> 
                    <label style="font-size: 10px;" for="edit_color_{{ $color->clr_id }}">{{ $color->clr_name }}</label>
                @endforeach
            @else 
                <p>No Color Found</p>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
    // datepicker auto close
    jQuery('#edit_po_section, #addColorSizeGroupTableEdit').on('change','.close-datepicker',
        function(){ 
            $('.datepicker').hide();
    });
    var colorSizeStore         = <?php echo json_encode($idList);?>;
    var temp_row_count_edit    = colorSizeStore.length;
    $('.edit_po_color_select').on('click', function() {
        var edit_color_select_val    = $(this).val();
        var edit_color_select_id     = $(this).data('id');
        if($(this).is(":checked")) {
            temp_row_count_edit += 1;
            var html    = '<tr id="color_'+edit_color_select_id+'">';
            html += '<td>\
            <input type="text" name="clr_id[]" value="'+edit_color_select_val+'" tabindex = "-1" readonly/>\
            <input type="hidden" name="mr_product_color[]" value="'+edit_color_select_id+'" /></td>';
            html += '<td><input type="text" name="po_sub_style_qty[]" class="subStleQtyCalcEdit" data-validation="length number" data-validation-length="0-11" value="0"/></td>';
            html += '<td><input type="text" name="po_sub_style_deliv_date[]" class="close-datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" /></td>';
            html += '</tr>';
            $('#addRemoveEdit').append(html);
            if ($('#btn_purchase_order').hasClass("hide")){
                $('#addColorSizeGroupTable').show();
                $('#btn_purchase_order').removeClass("hide"); 
            }
            if(temp_row_count_edit > 0) {
                $('#addColorSizeGroupTableEdit').show();
                $('#btn_purchase_order_edit').show();
            }
        } else {
            console.log(edit_color_select_id);
            temp_row_count_edit -= 1;
            $('tr#color_'+edit_color_select_id).remove();
            if(temp_row_count_edit == 0) {
                $('#addColorSizeGroupTableEdit').hide();
                $('#btn_purchase_order_edit').hide();
            }
        }
    });
</script>