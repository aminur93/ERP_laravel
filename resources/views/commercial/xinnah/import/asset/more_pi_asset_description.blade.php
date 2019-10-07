<script>
    var base_url = $('input[name="url"]').val();
    var _token = $('input[name="_token"]').val();
    //adds extra table rows
    var i=$('table tr').length;
    $(".addmore").on('click',function(){
        html = '<tr>';
        html += '<td><input class="case" type="checkbox"/></td>';
        html += '<td><input type="text" class="form-control autocomplete_machine" data-type="machineType" autocomplete="off" id="machineType_'+i+'" name="cm_machine_type_id[]" value="" required></td>';
        html += '<td><input type="text" data-type="modelNo" name="model_no[]" id="modelNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off" required></td>';
        html += '<td><input type="text" data-type="description" name="description[]" id="description_'+i+'" class="form-control autocomplete_txt" autocomplete="off" required></td>';
        html += '<td><input type="text" data-type="manufacture" id="manufacture_'+i+'" class="form-control autocomplete_txt" name="manufacturer[]" autocomplete="off" required></td>';
        html += '<td><select name="cm_section_id[]" id="section_'+i+'" class="col-xs-12 form-control"><option value=""> - select - </option>@foreach($getSection as $section)<option value="{{$section->id}}">{{$section->section_name}}</option>@endforeach</select></td>';
        html += '<td><input type="number" min="1" value="1" name="qty[]" id="quantity_'+i+'" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
        html += '<td><select name="uom[]" id="uom_'+i+'" class="col-xs-12 form-control"><option value=""> - select - </option><option value="millimeter"> Millimeter </option><option value="centimeter"> Centimeter </option><option value="meter"> Meter </option><option value="inch"> Inch </option><option value="feet"> Feet </option><option value="yard"> Yard </option><option value="piece"> Piece </option></select></td>';
        html += '<td><input type="number" min="0" value="0" name="unit_price[]" id="price_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
        html += '<td><select name="currency[]" id="currency_'+i+'" class="col-xs-12 form-control"><option value=""> - select - </option><option value="usd"> USD </option><option value="eur"> EUR </option><option value="gbp"> GBP </option><option value="tk"> TK </option></select></td>';
        html += '<td><input type="number" id="total_'+i+'" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly></td>';
        html += '</tr>';
        $('table').append(html);
        $('#itemNo_'+i).focus();
        i++;
        $('select').select2();
    });

    //to check all checkboxes
    $(document).on('change','#check_all',function(){
        $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
    });

    //deletes the selected table rows
    $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('#check_all').prop("checked", false); 
        calculateTotal();
    });
    //autocomplete machineType_ script
    $(document).on('focus','.autocomplete_machine',function(){
        var type = $(this).data('type');
        var getId = $(this).attr('id');
        eId = getId.split("_");
        if(type == 'machineType')autoTypeNo=0;
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url : base_url+'/comm/import/asset/pi-entry-get-machine-type',
                    method: 'GET',
                    data: {
                      name_startsWith: request.term,
                      type: type
                    },
                    success: function( data ) {
                        if(data.length == 0){
                            $('#manufacture_'+eId[1]).removeAttr('readonly');
                        }

                        response( $.map( data, function( item ) {
                            var code = item.split("|");
                            return {
                                label: code[autoTypeNo],
                                value: code[autoTypeNo],
                                data : item
                            }
                        }));
                    }
                });
            },
            autoFocus: true,            
            minLength: 0,
            select: function( event, ui ) {
                var names = ui.item.data.split("|");
                $(this).val(names[0]);
                id_arr = $(this).attr('id');
                id = id_arr.split("_");
                $('#manufacture_'+id[1]).val(names[1]);
                $('#manufacture_'+id[1]).attr('readonly',true);
            }               
        });
        
    });
    //price change
    $(document).on('change keyup blur','.changesNo',function(){
        id_arr = $(this).attr('id');
        id = id_arr.split("_");
        quantity = $('#quantity_'+id[1]).val();
        price = $('#price_'+id[1]).val();
        if( quantity!='' && price !='' ) $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) ); 
        calculateTotal();
    });


    //total price calculation 
    function calculateTotal(){
        subTotal = 0 ; total = 0; 
        $('.totalLinePrice').each(function(){
            if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
        });
        $('#subTotal').val( subTotal.toFixed(2) );
        
    }




    </script>