@extends('commercial.index')
@section('content')
<div class="main-content">
  <div class="main-content-inner">

        {{--this is the start of 1st line of the body, it gives short link of the pages, it's called breadcrumb--}}
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Commercial</a>
                </li>
                <li> 
                    <a href="#">Bank</a>   
                </li> 
                <li class="active">Import Bill Settlement Screen</li>
            </ul><!-- /.breadcrumb -->
        </div>
        {{--end of the breadcrumb--}}


        <div class="page-content">
          {{--this is the start of second line of the body, it shows the module name in the header --}}
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Import Bill Settlement</small></h1>
            </div>
          {{--end of header--}}
          @include('inc.message')

              
              <div class="container">

                {{--start of the insert info row--}}
                <div class="row">
                    <div class="col-sm-3">
                      <label class="col-sm-3 no-padding-right align-left " for="file_no" >File No.</label>
                        <select id="file_no" name="file_no" class="col-sm-5" >
                            <option value="">Select</option>
                            @foreach($fileno as $fn)
                             <option value="{{$fn->id}}">{{ $fn->file_no }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    <div class="col-sm-3">
                      <label class="col-sm-3 no-padding-right align-left " for="value" >Value</label>
                        <select id="value" name="value" class="col-sm-5" >
                            <option value="">Select</option>
                            @foreach($fileno as $fn)
                             <option value="{{$fn->id}}">{{ $fn->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-3">
                      <label class="col-sm-6 no-padding-right align-left " for="tdoc" >Transport Doc. No.</label>
                        <select id="tdoc" name="tdoc" class="col-sm-5" >
                            <option value="">Select</option>
                            @foreach($fileno as $fn)
                             <option value="{{$fn->id}}">{{ $fn->transp_doc_no1 }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2 ">
                      <button id="search_button" type="button" class="btn btn-sm btn-info pull-right">Search</button>
                    </div>
                      
                </div>{{--this is row div--}}
                {{--end of the insert info row--}}


                {{-- Showing Search Result --}}
                <div class="space-10"></div>
                  <div id="search_result" class="row">
                      <div class="col-sm-9 offset-sm-2">
                         <table class="table table-bordered">
                            <thead>
                            <th>File No.</th>                       
                            <th>Transport Doc. No.</th>
                            <th>L/C No.</th>
                            <th>Value</th>
                            <th>Acceptance Date</th>
                            <th>Due Date</th>
                            <th>Difference</th>
                            <th>Check</th>
                            </thead>

                            <tbody id="search_result_row" name="search_result_row">

                            </tbody>
                        
                         </table> 

                         
                            <div id="test"></div> 
                            {{--the above div contains the form after clicking radio button--}}

                      </div> 
                          
                          <div class="col-sm-2">
                            <a href="{{url( 'commercial/bank/import_bill_settlement_view' )}}" class="btn btn-sm btn-info pull-right">View Previous Entries</a>
                          </div>
                  
                  </div>

 <script type="text/javascript">
    $(document).ready(function() {

//Search
$('#search_button').click(function() {
//event.preventDefault();

    var file_no = $("#file_no").val();
    var value = $("#value").val();
    var tdoc = $("#tdoc").val();
    // alert("ndvbfhb");


    $.ajax({
          type: 'get',
          url: "{{url('commercial/bank/showdata')}}",
          dataType: 'json',
          data: { file_no : file_no, value:value , tdoc:tdoc, _token: '{{csrf_token()}}' },
          // data: { test : 'test' },    
          success: function(data){
                // alert("success")
                 // console.log('SUCCESS: ', data);
                $("#search_result_row").html(data);
                // var $table = $('<div></div>');
                // $table.append(results)
                },
          error: function(data){
          alert('failed');
           //console.log('ERROR: ', data);
              },

        });
                                

     $('body').on('click','.ck',function(){

           // alert('sd');

           
            var settle_id=$(this).parent().parent().find('.settle_id').val();
            var payment_date=$(this).parent().parent().find('.payment_date').val();
            var days_interest=$(this).parent().parent().find('.days_interest').val();
            var interest_rate=$(this).parent().parent().find('.interest_rate').val();
            var amount=$(this).parent().parent().find('.amount').val();
            var accounttype=$(this).parent().parent().find('.accounttype').val();
            var status=$(this).parent().parent().find('.status').val(); 

            


          var id = $(this).val();

          if(status=='1') {
                
                     var populate_form = '{{Form::open(["url"=>"commercial/bank/enterdata", "class"=>"form-horizontal col-xs-12"])}}\
                            <input type="hidden" name="import_id" value="'+id+'">\
                            <br>\
                               <div class="row">\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-right " for="paydate" >Payment Date</label>\
                                      <div class="col-sm-7">\
                                        <input type="date" name="paydate" id="paydate"  class="col-xs-12" value="'+payment_date+'" />\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-left">Days of Interest <span style="color: red">&#42;</span></label>\
                                      <div class="col-sm-7">\
                                        <input type="text" name="doi" id="doi"  class="col-xs-12" value="'+days_interest+'" data-validation="required" />\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-left" for="acceptance_date" >Interest Rate <span style="color: red">&#42;</span></label>\
                                      <div class="col-sm-7">\
                                        <input type="text" name="ir" id="ir"  class="col-xs-12" value="'+interest_rate+'" data-validation="required"/>\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-left" for="acceptance_date" >Amount ($) <span style="color: red">&#42;</span></label>\
                                      <div class="col-sm-7">\
                                        <input type="text" name="amount" id="amount"  class="col-xs-12" value="'+amount+'" data-validation="required"/>\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-5 radio">\
                                <span>Account type <span style="color: red">&#42; </span></span>\
                                  <label><input type="radio" class="mob" name="acc_radio" value="mob" >MOB</label>\
                                  <label><input type="radio" class="erq" name="acc_radio"  value="erq">ERQ</label>\
                                </div>\
                                <div class="col-sm-10 ">\
                                <br>\
                                <button id="save_button" type="Submit" class="btn btn-sm btn-info pull-left">Save</button>\
                                </div>\
                              </div>\
                             </form> ';



                              $("#test").html(populate_form);

                              if($(this).parent().parent().find('.accounttype').val() == 1)
                                {
                                $('.mob').prop("checked",true);
                                }
                              else if($(this).parent().parent().find('.accounttype').val() == 0)
                                {
                                $('.erq').prop("checked",false);
                                $('.mob').prop("checked",false);
                                }
                                else
                                {
                                  $('.erq').prop("checked",true);
                                }

                      }

                  else{

                           var populate_form = '{{Form::open(["url"=>"commercial/bank/enterdata", "class"=>"form-horizontal col-xs-12"])}}\
                            <input type="hidden" name="import_id" value="'+id+'">\
                            <br>\
                               <div class="row">\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-right " for="paydate" >Payment Date</label>\
                                      <div class="col-sm-7">\
                                        <input type="date" name="paydate" id="paydate"  class="col-xs-12" style="" />\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-left">Days of Interest <span style="color: red">&#42;</span></label>\
                                      <div class="col-sm-7">\
                                        <input type="text" name="doi" id="doi"  class="col-xs-12" value="" data-validation="required" />\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-left" for="acceptance_date" >Interest Rate <span style="color: red">&#42;</span></label>\
                                      <div class="col-sm-7">\
                                        <input type="text" name="ir" id="ir"  class="col-xs-12" style="" data-validation="required"/>\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                      <label class="col-sm-4 control-label no-padding-left" for="acceptance_date" >Amount ($) <span style="color: red">&#42;</span></label>\
                                      <div class="col-sm-7">\
                                        <input type="text" name="amount" id="amount"  class="col-xs-12" style="" data-validation="required"/>\
                                      </div>\
                                    </div>\
                                </div>\
                                <div class="col-sm-5 radio">\
                                <span>Account type <span style="color: red">&#42; </span></span>\
                                  <label><input type="radio" name="acc_radio" value="mob" >MOB</label>\
                                  <label><input type="radio" name="acc_radio"  value="erq">ERQ</label>\
                                </div>\
                                <div class="col-sm-10 ">\
                                <br>\
                                <button id="save_button" type="Submit" class="btn btn-sm btn-info pull-left">Save</button>\
                                </div>\
                              </div>\
                             </form> ';

                              $("#test").html(populate_form);


                              }

                         });

                   });



  }); 

</script> 
          


              </div>{{--this is container div--}}

        </div>{{--this ois page content div--}}
  </div> {{--this is main comntent inner div--}}
</div> {{--this is main content div--}}

      

@endsection