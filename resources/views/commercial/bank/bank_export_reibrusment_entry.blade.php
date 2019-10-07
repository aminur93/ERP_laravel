@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Commercial</a>
                </li>
                <li> 
                    <a href="#">Bank</a>   
                </li> 
                <li class="active">Export Bill Reimbrusment Entry</li>
            </ul><!-- /.breadcrumb -->
        </div>
        {{-- page content --}}
        <div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Export Bill Reimbrusment Entry 
                </small></h1>
            </div>
            @include('inc/message')

            <div class="panel panel-default">
             <div class="panel-body">

                <div class="row">
                    <div class="col-sm-10">
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label no-padding-right align-left  " for="file_no_id">File {{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-8" style="margin-bottom: 20px;">
                             <select id="file_no_id" name="file_no_id" class="col-xs-12">
                                <option value="">Select File No.</option>
                                @if($file_list)
                                    @foreach($file_list as $fl)
                                        <option value="{{$fl->id}}">{{$fl->file_no}}</option>
                                    @endforeach
                                @else
                                    NO data.
                                @endif
                                
                             </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label no-padding-right align-left  " for="invoice_no_id">Invoice No. {{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-8" style="margin-bottom: 20px;">
                             <select id="invoice_no_id" name="invoice_no_id" class="col-xs-12">
                                <option value="">Select Invoice No.</option>
                                
                             </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label no-padding-right align-left  " for="bank_id"  >Bank {{-- <span style="color: red">&#42;</span> --}} </label>
                            <div class="col-sm-8" style="margin-bottom: 20px;">
                             <select id="bank_id" name="bank_id" class="col-xs-12">
                                <option value="">Select Bank</option>

                             </select>
                            </div>
                        </div>
                               
                    </div>
                    <div class="col-sm-2">
                      {{-- <div class="col-sm-1"> --}}
                        <button id="search_button" type="button" class="btn btn-sm btn-info pull-right"><span class="glyphicon glyphicon-search"></span>&nbsp Search</button>
                      {{-- </div> --}}
                    </div>
                </div>  {{-- end row --}}
                <div class="row">
                    <div class="col-sm-12  table-responsive"  style="width: 71%; margin-left: 120px;">
                      <table class="table table-bordered table-striped">
                        <thead>                       
                            <th>File No.</th>
                            <th>Bill No.</th>
                            <th>Value</th>
                            <th>Invoice No</th>
                            <th>Trans Doc Date</th>
                            <th>Difference</th>
                            <th>Check</th>
                        </thead>

                        <tbody id="search_result_row" name="search_result_row">
                             <td>Results Will Show Here.... </td>  
                        </tbody>
                            
                      </table>    
                    </div>
                </div>
            </div>
           </div>

            <hr>

             <div id="data_entry_form_reimburse" name="data_entry_form_reimburse"> 
                    
                   
             </div>
            

        </div> {{-- Page-content end --}}
{{-- Scripting --}}
<script type="text/javascript">
    $(window).load(function() {
        $('#file_no_id').change(function() {
            $('#invoice_no_id').empty();
            $('#bank_id').empty();
            var file_id = $(this).val();
            // console.log(file_id);
            $.ajax({
                url: "{{url('commercial/bank/ajax_get_invoice')}}",
                type: 'get',
                dataType: 'json',
                data: {file_id : file_id, _token: '{{csrf_token()}}'},
                success: function(data){
                         console.log("SUCCESS: ", data);
                          $('#invoice_no_id').html('<option value="">Select Invoice No</option>');
                          $('#bank_id').html('<option value="">Select Bank</option>');
                          
                            for (j=0; j<data['invoice'].length; j++) {
                                    $("#invoice_no_id").append('<option value="'+data['invoice'][j]+'">'+data['invoice'][j]+'</option>');
                                  }  
                            for(j=0; j<data['bank_id'].length; j++){
                                    $("#bank_id").append('<option value="'+data['bank_id'][j]+'">'+data['bank_nm'][j]+'</option>');
                                }  

                },
                error: function(data){
                         console.log("ERROR: ", data);
                },
            });
            
        }); //File no id change end

        //Search
        $('#search_button').click(function() {
            $('#data_entry_form_reimburse').html('');

            var file_no_id      =   $("#file_no_id").val();
            var invoice_no_id      =   $("#invoice_no_id").val();
            // console.log('file_no_id:', file_no_id, 'invoice_no:', invoice_no_id);
            $.ajax({
                    type: 'get',
                    url: "{{url('commercial/bank/show_search_result')}}",
                    dataType: 'json',
                    data: { file_no_id : file_no_id, invoice_no: invoice_no_id ,  _token: '{{csrf_token()}}' },
                    // data: { test : 'test' },    
                    success: function(data){
                        // alert("success")
                           // console.log('SUCCESS: ', data);
                        if(data!="")
                           $("#search_result_row").html(data);
                        else 
                            $("#search_result_row").html('No data found');
                        // var $table = $('<div></div>');
                        // $table.append(results)
                    },
                    error: function(data){
                    //alert('failed');
                     console.log('ERROR: ', data);
                    },
                });

        }); //End Search
        //Propt Entry Fields
        $('body').on('click','.ck',function(){
          var id = $(this).val();
          var invoice_no   =   $(this).parent().find('.inv_td').val();
          //var invoice_no     =   document.getElementById('inv_td').innerText;
          var file_id      =   $(this).parent().find('.file_id').val();
          var x            =   $(this).parent().find('.d_bill_amt').val();
          
          var form = '<div class="panel panel-default">\
             <div class="panel-body">\
             <h4 style="margin-left: 11px;">Entry Form</h4>\
             {{Form::open( ["url"=>"commercial/bank/save_reimb_entry", "class"=>"form-horizontal col-xs-12"] )}}\
                        <input type="hidden" name="exp_data_entry_1_id" value="'+id+'">\
                        <input type="hidden" name="inv_no" value="'+invoice_no+'">\
                        <input type="hidden" name="file_id" value="'+file_id+'">\
                <div class="row" >\
                    {{-- Left Portion Start --}}\
                    <div class="col-sm-5">\
                        <div class="form-group">\
                                <label class="col-sm-4 control-label no-padding-right align-left" for="date_entry" >Date{{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-6">\
                                     <input type="date" name="date_entry" id="date_entry" class="col-xs-12"   />\
                                </div>\
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-4 control-label no-padding-right align-left" for="reimbrusement_amount" >Reimbrusement Amount{{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-6" >\
                                    <input type="number" name="reimbrusement_amount" id="reimbrusement_amount"  class="col-xs-12" data-validation="required" />\
                                </div>\
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-4 control-label no-padding-right align-left" for="exchange_rate" >Exchange Rate{{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-6" >\
                                  <input type="text" name="exchange_rate" id="exchange_rate" class="col-xs-12" placeholder="Enter" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                                </div>\
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-4 control-label no-padding-right align-left" for="discount_amount">Discount Amount {{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-6" >\
                                     <input type="text" name="discount_amount" id="discount_amount" class="col-xs-12" readonly="readonly"  />\
                                </div>    \
                        </div>\
                          {{-- Left Portion end --}}  \
                    </div>\
                     {{-- Right Portion --}} \
                    <div class="col-sm-7">\
                        <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right align-left" for="fc_amount_dollar" >F.C Amount ($){{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-8"  >\
                                        <input type="number" name="fc_amount_dollar" id="fc_amount_dollar"  class="col-xs-7" data-validation="required" />\
                                        <input type="number" name="fc_amount_per" id="fc_amount_per"  class="col-xs-3" data-validation="required" />\
                                        <font size="12px" color="purple" class="col-xs-1">%</font>\
                                </div> \
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right align-left" for="cd_amount_dollar" >CD. Amount ($){{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-8"   >\
                                        <input type="number" name="cd_amount_dollar" id="cd_amount_dollar"  class="col-xs-7" data-validation="required" />\
                                        <input type="number" name="cd_amount_per" id="cd_amount_per"  class="col-xs-3" data-validation="required" />\
                                        <font size="12px" color="purple" class="col-xs-1">%</font>\
                                </div> \
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right align-left" for="a_tax_amount_bdt" >A. Tax Amount (BDT){{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-8"  >\
                                        <input type="number" name="a_tax_amount_bdt" id="a_tax_amount_bdt"  class="col-xs-7" data-validation="required" />\
                                        <input type="number" name="a_tax_amount_per" id="a_tax_amount_per"  class="col-xs-3" data-validation="required" />\
                                        <font size="12px" color="purple" class="col-xs-1">%</font>\
                                </div> \
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right align-left" for="tax_source_bdt" >TAX at Source BDT{{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-8"  >\
                                        <input type="number" name="tax_source_bdt" id="tax_source_bdt"  class="col-xs-7" data-validation="required" />\
                                        <input type="number" name="tax_source_per" id="tax_source_per"  class="col-xs-3" data-validation="required" />\
                                        <font size="12px" color="purple" class="col-xs-1">%</font>\
                                </div> \
                        </div>\
                        <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right align-left" for="central_fund_bdt" >Central Fund Account BDT{{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-8"  >\
                                        <input type="number" name="central_fund_bdt" id="central_fund_bdt"  class="col-xs-7" data-validation="required" />\
                                        <input type="number" name="central_fund_per" id="central_fund_per"  class="col-xs-3" data-validation="required" />\
                                        <font size="12px" color="purple" class="col-xs-1">%</font>\
                                </div> \
                        </div>\
                                \
                        <div class="form-group">\
                                <label class="col-sm-3 control-label no-padding-right align-left" for="discount_interest_usd" >Discount Interest USD{{-- <span style="color: red">&#42;</span> --}} </label>\
                                <div class="col-sm-8"  >\
                                  <input type="number" name="discount_interest_usd" id="discount_interest_usd"  class="col-xs-7" data-validation="required" placeholder="Enter" />\
                                </div> \
                        </div>\
                        \
                    </div>\
                    {{-- Right Portion End--}}\
                </div>\
                <div class="row">\
                  <div class="col-sm-11">\
                    <button class="btn btn-info btn-sm pull-right" type="submit">\
                        {{-- <i class="ace-icon fa fa-check bigger-110"></i> --}}Save</button>\
                  </div>\
                </div>\
               </form>   {{-- Form Close --}} </div> </div>';

               $('#data_entry_form_reimburse').html(form);

               // var x = document.getElementById('d_bill_amt').value;
               document.getElementById('discount_amount').value = x;

        });


    });  //window-load-end
</script>



    </div>   {{-- main-content-inner end --}}
</div>  {{-- main-content end --}}

@endsection