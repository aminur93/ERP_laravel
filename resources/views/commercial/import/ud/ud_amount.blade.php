<!-- MASTER INFORMATION -->
<div class="tab-pane fade in active">
    {{ Form::open(["url"=>"comm/import/ud_amount/save", "class"=>"form-horizontal"]) }}
    <!-- File No -->
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="cm_exp_lc_entry_cm_file_id" > File No<span style="color: red">&#42;</span> </label>
        <div class="col-sm-5">
            {{ Form::select("cm_exp_lc_entry_cm_file_id", $fileList, empty($udMaster->cm_file_id)?null : $udMaster->cm_file_id, ['class'=>'col-xs-12', 'id'=>'cm_exp_lc_entry_cm_file_id', 'placeholder'=>'Select', 'data-validation'=>'required']) }}
        </div>
    </div>
    <br>
    <div class="form-group wraper">

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
<script type="text/javascript">

$(document).ready(function(){

  var file_id = $('#cm_exp_lc_entry_cm_file_id').find(":selected").val();
  if(file_id){


  $.ajax({
          url:'/comm/import/ud_amount/get_info_by_file/'+file_id,
          type: 'get',
          success: function (response) {
              if(response.length!=0){
                  var response = JSON.parse(response);
                  $('.wraper').empty();
                    $.each(response, function( key,value ) {
                      var lcNo =
                      '<input type="hidden" name="cm_sales_contract_id[]" id="cm_sales_contract_id" data-conten-id="'+value.id+'" value="'+value.id+'" class="contract"  data-validation-length="1-60"  />\n'+
                      '<input type="hidden" name="ud_amount_id[]" id="ud_amount_id" value="'+value.ud_amount_id+'" class="col-xs-12"  data-validation-length="1-60"  />\n'+
                      '<div class="form-group col-md-4">\n'+
                          '<label class="col-sm-3 control-label no-padding-right" for="lc_contract_no" >Export L/C No. </label>\n'+
                          '<div class="col-sm-5">\n'+
                              '<input type="text" name="lc_contract_no[]" id="lc_contract_no" value="'+value.lc_contract_no+'" class="col-xs-12"  data-validation-length="1-60"  />\n'+
                          '</div>\n'+
                      '</div>';
                      var elcDate ='<div class="form-group col-md-4">\n'+
                          '<label class="col-sm-3 control-label no-padding-right" for="elc_date" >ELC Date</label>\n'+
                          '<div class="col-sm-5">\n'+
                              '<input type="date" name="elc_date[]" id="elc_date" value="'+value.elc_date+'"  class="col-xs-12"  data-validation-length="1-60"   />\n'+
                          '</div>\n'+
                      '</div>';
                      var utilizeAmount ='<div class="form-group col-md-4">\n'+
                          '<label class="col-sm-3 control-label no-padding-right" for="utilize_amount" >Utilize Amount</label>\n'+
                          '<div class="col-sm-5">\n'+
                              '<input type="text" name="utilize_amount[]" id="utilize_amount"  value="'+value.utilize_amount +'" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />\n'+
                          '</div>\n'+
                      '</div>';
                    $('.wraper').append(lcNo,elcDate,utilizeAmount);
                    });
                }
              }
             })
           }else{
              $('.wraper').empty();
           }

  $("#cm_exp_lc_entry_cm_file_id").on('change',function(e){
    var file_id = $('#cm_exp_lc_entry_cm_file_id').find(":selected").val();
    if(file_id){
    $.ajax({
            url:'/comm/import/ud_amount/get_info_by_file/'+file_id,
            type: 'get',
            success: function (response) {
                if(response.length!=0){
                    var response = JSON.parse(response);
                    $('.wraper').empty();
                      $.each(response, function( key,value ) {
                        var lcNo =
                        '<input type="hidden" name="cm_sales_contract_id" id="cm_sales_contract_id" value="'+value.id+'" class="col-xs-12"  data-validation-length="1-60"  />\n'+
                        '<div class="form-group col-md-4">\n'+
                            '<label class="col-sm-3 control-label no-padding-right" for="lc_contract_no" >Export L/C No. </label>\n'+
                            '<div class="col-sm-5">\n'+
                                '<input type="text" name="lc_contract_no" id="lc_contract_no" value="'+value.lc_contract_no+'" class="col-xs-12"  data-validation-length="1-60"  />\n'+
                            '</div>\n'+
                        '</div>';
                        var elcDate ='<div class="form-group col-md-4">\n'+
                            '<label class="col-sm-3 control-label no-padding-right" for="elc_date" >ELC Date</label>\n'+
                            '<div class="col-sm-5">\n'+
                                '<input type="date" name="elc_date" id="elc_date" value="'+value.elc_date+'"  class="col-xs-12"  data-validation-length="1-60"   />\n'+
                            '</div>\n'+
                        '</div>';
                        var utilizeAmount ='<div class="form-group col-md-4">\n'+
                            '<label class="col-sm-3 control-label no-padding-right" for="utilize_amount" >Utilize Amount</label>\n'+
                            '<div class="col-sm-5">\n'+
                                '<input type="text" name="utilize_amount" id="utilize_amount"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />\n'+
                            '</div>\n'+
                        '</div>';
                      $('.wraper').append(lcNo,elcDate,utilizeAmount);
                      });
                  }
                }
               })
             }else{
                $('.wraper').empty();
             }
          });
  });

</script>
