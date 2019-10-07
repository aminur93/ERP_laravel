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
                <li class="active">Export Bill Discounting Entry Screen</li>
            </ul><!-- /.breadcrumb -->
        </div>
        {{-- page content --}}
        @include('inc.message')
        <div class="page-content">
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Export Bill Discounting Entry Screen 
                </small></h1>
            </div>
            

            <div class="row">
                <div class="col-sm-10">
                    <div class="col-sm-6">
                        <label class="col-sm-4 control-label no-padding-right align-left  " for="file_no_id"  >File No. {{-- <span style="color: red">&#42;</span> --}} </label>
                        <div class="col-sm-8" style="margin-bottom: 20px;">
                         <select id="file_no_id" name="file_no_id" class="col-xs-12">
                            <option value="">Select File No.</option>
                            @foreach($file_id as $fi)
                            <option value="{{$fi->id}}" >{{$fi->file_no}}</option>
                            @endforeach 
                         </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-4 control-label no-padding-right align-left  " for="invoice_no_id"  >Invoice No. {{-- <span style="color: red">&#42;</span> --}} </label>
                        <div class="col-sm-8" style="margin-bottom: 20px;">
                         <select id="invoice_no_id" name="invoice_no_id" class="col-xs-12">
                            <option value="">Select Invoice No.</option>
                            @if($inv_no)
                              @foreach($inv_no as $inv)
                               <option value="{{$inv->inv_no}}">{{$inv->inv_no}}</option>
                              @endforeach
                            @else
                            no data
                            @endif
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
            <div class="space-10"></div>

            <div id='search_result' class="row">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-bordered table-striped" id="billtable" name="billtable">
                    <thead>                       
                        <th>File No.</th>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Byuer</th>
                        <th>Bank</th>
                        <th>Value</th>
                        <th>BL Date</th>
                        {{-- <th>Realize Amount</th>
                        <th>Realize Date</th> --}}
                        <th>Ex-Fty</th>
                        <th>Destination</th>
                        <th>ELC No.</th>
                        <th>Discount Status</th>
                        <th>Check</th>

                    </thead>

                    <tbody id="search_result_row" name="search_result_row">
                          
                    </tbody>
                        
                  </table>    
                </div>
            </div>

            <hr>
            <div id="radioform"></div>







        </div> {{-- Page-content end --}}
    </div>   {{-- main-content-inner end --}}
</div>  {{-- main-content end --}}

  <script type="text/javascript">
              $(document).ready(function() {

                    //Search
                    $('#file_no_id').change(function() {
                    //event.preventDefault();
                        $('#invoice_no_id').empty();
                        var file_no_id = $(this).val();
                        //var show_inv = '<option value>'
                        // alert("ndvbfhb");
                        $.ajax({
                              type: 'get',
                              url: "{{url('commercial/bank/getInvoice')}}",
                              dataType: 'json',
                              data: { file_no_id : file_no_id, _token: '{{csrf_token()}}' },
                              // data: { test : 'test' },    
                              success: function(data){
                                    // alert("success")
                                      //console.log('SUCCESS: ', data);

                                      $('#invoice_no_id').html('<option value="">Select Invoice No</option>');
                                      if(data[0]=="empty")
                                        {$('#invoice_no_id').html('<option value="">No Invoice Found</option>');}
                                      else{
                                      for(i=0; i<data.length;i++){
                                      //      document.getElementById('invoice_no_id').append('<option value="'+data.i+'">'+data.i+'</option>'); 
                                      // }
                                    $("#invoice_no_id").append('<option value="'+data[i]+'">'+data[i]+'</option>');
                                        }
                                      }

                                    // var $table = $('<div></div>');
                                    // $table.append(results)
                                    },
                              error: function(data){
                              alert('failed');
                               //console.log('ERROR: ', data);
                                  },

                            });

                         });
                    });
                    
</script>

<script type="text/javascript">
    $(document).ready(function() {

//Search
$('#search_button').click(function() {
//event.preventDefault();

    var file_no_id = $("#file_no_id").val();
    var invoice_no_id = $("#invoice_no_id").val();
    //var tdoc = $("#tdoc").val();
    // alert("ndvbfhb");


    $.ajax({
          type: 'get',
          url: "{{url('commercial/bank/showTable')}}",
          dataType: 'json',
          data: { file_no_id : file_no_id, invoice_no_id:invoice_no_id, _token: '{{csrf_token()}}' },
          // data: { test : 'test' },    
          success: function(data){
                // alert("success")
                 //console.log('SUCCESS: ', data);
                $("#search_result_row").html(data);
                // var $table = $('<div></div>');
                // $table.append(results)
                },
          error: function(data){
          alert('failed');
           //console.log('ERROR: ', data);
              },

        });
    });

});
</script>


<script type="text/javascript">
    
$(document).ready(function() {
    //var a,b,c,d,e,f='';

    $('body').on('click','.ck',function(){

           
            // var xx= $(this).parent().parent().html();
            // var yy = $(this).parent().parent().find('td_1');
            // console.log(yy);


            /*var x =document.getElementById('uid').value;
            var y =document.getElementById('disp').value;
            var z =document.getElementById('discount_date').value;
            var m =document.getElementById('disc_rcv_amount').value;
            var n =document.getElementById('remarks').value;
            var dis_id=document.getElementById('dis_id').value;*/

            var fileno=$(this).parent().parent().find('.fileno').html();
            var invno=$(this).parent().parent().find('.invno').html();
            var buyerid=$(this).parent().parent().find('.buyid').html();
            var bankid=$(this).parent().parent().find('.bankid').html();
            var value=$(this).parent().parent().find('.invval').html();
            var status=$(this).parent().parent().find('.status').html();
            var uid=$(this).parent().parent().find('.uid').val();
            var disp=$(this).parent().parent().find('.disp').val();
            var disdate=$(this).parent().parent().find('.discount_date').val();
            var disamount=$(this).parent().parent().find('.disc_rcv_amount').val();
            var remarks=$(this).parent().parent().find('.remarks').val();
            var dis_id=$(this).parent().parent().find('.dis_id').val();
            var unit_name=$(this).parent().parent().find('.unitname').val();
            var buyer=$(this).parent().parent().find('.buyer').val();
            var bank=$(this).parent().parent().find('.bank').val();

            //var id=$(this).parent().parent().find('.checkvalue').val();

            //console.log('file:',fileno, 'Invoice:',invno, uid, id, unit_name);

            
            /*$('#billtable').each(function() {
            a = $(this).find("td").eq(0).html();
            b = $(this).find("td").eq(1).html();
            c = $(this).find("td").eq(3).html();
            d = $(this).find("td").eq(4).html();  
            e = $(this).find("td").eq(5).html();
            f = $(this).find("td").eq(10).html();

            });*/

          var id = $(this).val();
          //console.log('file:',fileno, 'Invoice:',invno, uid, id, unit_name,buyer,bank);
          //alert(id);
          //console.log(a,b,c,d,e,f);

          if(status=='Done'){
                
                     var populate_form = '{{Form::open(["url"=>"commercial/bank/entryForm", "class"=>"form-horizontal col-xs-12"])}}\
                <input type="hidden" name="import_id" value="'+id+'">\
                <input type="hidden" name="dis_id" value="'+dis_id+'">\
                <div id="bill_discounting_form">\
                <div class="row">   \
                  <div class="col-sm-8 col-sm-offset-2">\
                    <h4>Bill Discounting</h4>\
                  </div>\
               </div>\
              <div class="row">    {{-- row 1 start --}}\
                <div class="col-sm-8 col-sm-offset-2 border" style="border: 1px solid;">\
                    <div class="col-sm-6" style="margin-bottom: 20px;">   {{-- Left-Section --}}\
                        <div style="margin-bottom: 20px;"></div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discout_ref" >Discount Ref.{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="discout_ref" id="discout_ref" value="Show--" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="file_no_view" >File No.{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="file_no_view" id="file_no_view" value="'+fileno+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="unit" >Unit{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="unit" id="unit" value="'+unit_name+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="invoice_no_view" >Invoice No.{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="invoice_no_view" id="invoice_no_view" value="'+invno+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="buyer_view" >Buyer{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="buyer_view" id="buyer_view" value="'+buyer+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="bank_view" >Bank{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="bank_view" id="bank_view" value="'+bank+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\              \
                    </div>{{-- End Left-Section --}}\
                    <div style="margin-bottom: 20px;"></div>\
                    <div class="col-sm-6" >  {{-- Right-Section --}}\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="value_view" >Value{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="value_view" id="value_view" value="'+value+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discout_percent" >Discount percent{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="number" name="discount_percent" value="'+disp+'" id="discount_percent" class="col-xs-12"   />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discount_amount_view" >Discount Amount{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="discount_amount_view" id="discount_amount_view" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="disc_rev_amount" >Disc. Rcv Amt{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="number" name="disc_rcv_amount" id="disc_rcv_amount" value="'+disamount+'"  class="col-xs-12"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discount_date" >Discount Date{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="date" name="discount_date" id="discount_date" value="'+disdate+'"class="col-xs-12"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="remarks" >Remarks{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="remarks" id="remarks" value="'+remarks+'"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />\
                            </div>\
                        </div>\
                    </div>{{-- End Right-Section --}}\
\
                    \
                </div>\
              </div> {{-- row 1 end --}}\
              <div class="row">\
                <div class="col-sm-11"> \
                  <button class="btn btn-info btn-sm pull-right" type="submit">Save</button>\
                </div>\
              </div>\
\
              </form>\
            </div>\
            </form>';
        
                  $("#radioform").html(populate_form);

            }

            else{

              var populate_form = '{{Form::open(["url"=>"commercial/bank/entryForm", "class"=>"form-horizontal col-xs-12"])}}\
                <input type="hidden" name="import_id" value="'+id+'">\
                {{--<input type="hidden" name="import_id" value="'+id+'">--}}\
                <div id="bill_discounting_form">\
                <div class="row">   \
                  <div class="col-sm-8 col-sm-offset-2">\
                    <h4>Bill Discounting</h4>\
                  </div>\
               </div>\
              <div class="row">    {{-- row 1 start --}}\
                <div class="col-sm-8 col-sm-offset-2 border" style="border: 1px solid;">\
                    <div class="col-sm-6" style="margin-bottom: 20px;">   {{-- Left-Section --}}\
                        <div style="margin-bottom: 20px;"></div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discout_ref" >Discount Ref.{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="discout_ref" id="discout_ref" value="Show--" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="file_no_view" >File No.{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="file_no_view" id="file_no_view" value="'+fileno+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="unit" >Unit{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="unit" id="unit" value="'+unit_name+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="invoice_no_view" >Invoice No.{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="invoice_no_view" id="invoice_no_view" value="'+invno+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="buyer_view" >Buyer{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="buyer_view" id="buyer_view" value="'+buyer+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="bank_view" >Bank{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="bank_view" id="bank_view" value="'+bank+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\              \
                    </div>{{-- End Left-Section --}}\
                    <div style="margin-bottom: 20px;"></div>\
                    <div class="col-sm-6" >  {{-- Right-Section --}}\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="value_view" >Value{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="value_view" id="value_view" value="'+value+'" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discout_percent" >Discount percent{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="number" name="discount_percent" id="discount_percent" class="col-xs-12"   />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discount_amount_view" >Discount Amount{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="discount_amount_view" id="discount_amount_view" class="col-xs-12" readonly="readonly"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="disc_rev_amount" >Disc. Rcv Amt{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="number" name="disc_rcv_amount" id="disc_rcv_amount"   class="col-xs-12"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="discount_date" >Discount Date{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="date" name="discount_date" id="discount_date" class="col-xs-12"  />\
                            </div>\
                        </div>\
                        <div calss="form-group">\
                            <label class="col-sm-4 control-label no-padding-right align-left" for="remarks" >Remarks{{-- <span style="color: red">&#42;</span> --}} </label>\
                            <div class="col-sm-8" style="margin-bottom: 20px;">\
                                 <input type="text" name="remarks" id="remarks"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />\
                            </div>\
                        </div>\
                    </div>{{-- End Right-Section --}}\
\
                    \
                </div>\
              </div> {{-- row 1 end --}}\
              <div class="row">\
                <div class="col-sm-11"> \
                  <button class="btn btn-info btn-sm pull-right" type="submit">Save</button>\
                </div>\
              </div>\
\
              </form>\
            </div>\
            </form>';
        
                $("#radioform").html(populate_form);
            }
            
           $('#discount_percent').change(function() {

            var dis_per=$(this).val();
            var val =document.getElementById('value_view').value;
            var res=val*(dis_per/100.00);
            document.getElementById('discount_amount_view').value= res;

             }).change(); 
        });

        
});

</script>

@endsection
