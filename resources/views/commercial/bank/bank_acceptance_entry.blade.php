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
                <li class="active">Bank Acceptance Entry Screen</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Bank Acceptance Entry Screen</small></h1>
            </div>
            @include('inc/message')
           <div class="panel panel-default">
            <div class="panel-body">
             <div class="row">
                <div class="panel panel-info"><div class="panel-body">
                  
                <div class="col-sm-10">
                  @if($import_data_entry)
                      <div class="col-sm-3">
                        <label class="col-sm-4 no-padding-right" for="bank_id" ><font size="11px"><b>Bank</b></font> {{-- <span style="color: red">&#42;</span> --}} </label>
                        <select id="bank_id" name="bank_id" class="col-sm-8 col-xs-10" style="width: 60%;" >
                            <option value=" ">Select</option>
                            @if($bank)
                              @foreach($bank as $b)
                                <option value="{{$b->id}}">{{$b->bank_name}}</option>
                              @endforeach
                            @else
                              no data..
                            @endif
                        </select>
                      </div>
                      <div class="col-sm-3">
                        <label class="col-sm-5  no-padding-right" for="ilc_number" ><font size="11px"><b>ILC Number</b></font> {{-- <span style="color: red">&#42;</span> --}} </label>
                        <select id="ilc_number" name="ilc_number" class="col-sm-7 col-xs-10 ilc_number" style="width: 50%;" >
                            <option value=" ">Select</option>
                            @if($ilc_list)
                              @foreach($ilc_list as $ilc)
                                <option value="{{$ilc->lc_no}}">{{$ilc->lc_no}}</option>
                              @endforeach
                            @else
                              no data..
                            @endif
                        </select>  
                      </div>
                      <div class="col-sm-3">
                        <label class="col-sm-4  no-padding-right" for="file_no_id" ><font size="11px"><b>File No.</b></font> {{-- <span style="color: red">&#42;</span> --}} </label>
                        <select id="file_no_id" name="file_no_id" class="col-sm-8 col-xs-10" style="width: 60%;" >
                            <option value=" ">Select</option>
                            @if($file)
                              @foreach($file as $f)
                                <option value="{{$f->id}}">{{$f->file_no}}</option>
                              @endforeach
                            @else
                              no data..
                            @endif
                        </select>                            
                      </div>
                      <div class="col-sm-3">
                        <label class="col-sm-4 no-padding-right" for="supplier_id" ><font size="11px"><b>Supplier</b></font> {{-- <span style="color: red">&#42;</span> --}} </label>
                        <select id="supplier_id" name="supplier_id" class="col-sm-8 col-xs-10" style="width: 60%;" >
                            <option value=" ">Select</option>
                            @if($supplier)
                              @foreach($supplier as $sp)
                                <option value="{{$sp->sup_id}}">{{$sp->sup_name}}</option>
                              @endforeach
                            @else
                              no data..
                            @endif
                        </select>    
                      </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-sm btn-info pull-right" id="search_button" style="margin-right: 10px;" name="search_button"><span class="glyphicon glyphicon-search"></span>&nbsp Search</button>

                </div>
           
                    @else
                        There is no data
                    @endif

                  </div></div>  {{-- Inner Panel end --}}
             </div>
             {{-- Showing Search Result --}}
           

            <div class="row">
              <div id="search_result" class="col-sm-11 " style="margin-top: 20px; margin-left: 82px;">
                <div class="col-sm-8" style="width: 59%;">
                  <table class="table  table-bordered" >
                    <thead>
                      <th>Transport Doc No</th>
                      <th>Transport Doc Date</th>
                      <th>Value</th>
                      <th>Check</th>
                    </thead>
                    <tbody id="search_result_row" name="search_result_row">

                    </tbody>
                 </table>
                </div>
                <div class="col-sm-3" style="margin-left: 75px;">
                   <a href="{{url('commercial/bank/cm_bank_acceptance_imp_entry_preview')}}" class=" btn btn-sm btn-info pull-left">View Entries</a>
                </div>
             </div>
            </div>
           </div>
          </div>

            <div class="row" id="data_entry_form" name="data_entry_form">

              
            </div>

        </div> {{-- page content end --}}

{{-- Ajax --}}
<script type="text/javascript">
   $(window).load(function() {
        // var lc_name="";
        // $('body').on('change', '.ilc_number', function(){
        //     lc_name = $(this).val();
        // });

        //Search
        $('#search_button').click(function() {
            //event.preventDefault();
            $('#data_entry_form').html('');

            var bank_id         =   $("#bank_id").val();
            var ilc_number      =   $("#ilc_number").val();
            var file_no_id      =   $("#file_no_id").val();
            var supplier_id     =   $("#supplier_id").val();

            $.ajax({
                    type: 'get',
                    url: "{{url('commercial/bank/imp_data_entry_asset')}}",
                    dataType: 'json',
                    data: { bank_id : bank_id, ilc_number: ilc_number , file_no_id: file_no_id, supplier_id: supplier_id, _token: '{{csrf_token()}}' },
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
        }); 
    //Appending the libor rate entry
        // $("input:radio[value=lib_yes]").click(function() {
            $('body').on('click','.lib_y', function(){ 
            var libo_entry =  '<div id="lib_rate_appear2" name="lib_rate_appear2" >\
                                 <label class="col-sm-5 control-label no-padding-right" for="libor_rate" >Libor Rate<span style="color: red">&#42;</span> </label>\
                                <div class="col-sm-7">\
                                    <input type="number" name="libor_rate" id="libor_rate"  class="col-xs-12" data-validation="required"/>\
                                </div> </div>'; 
                       $('#lib_rate_appear1').html( libo_entry);
                      });  
        //remove
        // $("input:radio[value=lib_no]").click(function(){
            $('body').on('click','.lib_n', function(){
            $('#lib_rate_appear2').remove();
            });

    //Appending the entry form     
        // $("input:radio[value=t1]").click(function(){
        
    $('body').on('click','.ck',function(){

          $('#data_entry_form').html('');
          var id = $(this).val();
          var lc_name = $(this).parent().find('.ilc_no').val();
          console.log($(this).parent().html());
          
          //Finding the lc type of the selected row
          // var lc_name;
          // var data = '<//?php echo json_encode($ilc_list); ?>';
          // var parsed_data = JSON.parse(data);
          // console.log(parsed_data);
          // var arr_length = Object.keys(parsed_data).length;
          // for(i=0;i<arr_length;i++){
          //   if(parsed_data[i]['id']==id){
          //     lc_name = parsed_data[i]['lc_type_name']; break;
          //   }
          //   else{
          //     continue;
          //   }
          // }
          //console.log(lc_name);
                
         var form = ' <div class="panel panel-default">\
              <div class="panel-body"> <div class="row"> \
             <h4 style="margin-left: 20px;">Entry Form</h4>\
             {{Form::open(["url"=>"commercial/bank/cm_bank_acceptance_imp_save", "class"=>"form-horizontal col-xs-12"])}}\
                   <input type="hidden" name="import_id" value="'+id+'">\
                   <div calss="col-sm-12">\
                    <div class="col-sm-4"> <div class="panel panel-default">\
                    <div class="panel-body">\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="bill_ex_rec_date" >Bill Ex Rec Date<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="date" name="bill_ex_rec_date" id="bill_ex_rec_date"  class="col-xs-12" data-validation="required"/>\
                          </div>\
                        </div>\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="acceptance_date" >Acceptance Date<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="date" name="acceptance_date" id="acceptance_date"  class="col-xs-12 acceptance_date" data-validation="required" />\
                          </div>\
                        </div>\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="negotiation_date" >Nagotiation Date<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="date" name="negotiation_date" id="negotiation_date"  class="col-xs-12" data-validation="required" />\
                          </div>\
                        </div>\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="bank_bill_no" >Bank Bill No.<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="text" name="bank_bill_no" id="bank_bill_no"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                          </div>\
                        </div>\
                             \
                    </div></div></div>\
                                \
                    <div class="col-sm-4"> <div class="panel panel-default">\
                    <div class="panel-body">\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="discre_date" >Discre Date<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="date" name="discre_date" id="discre_date"  class="col-xs-12" data-validation="required" />\
                          </div>\
                        </div>\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="discre_acp_date" >Discre Acp Date<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="date" name="discre_acp_date" id="discre_acp_date"  class="col-xs-12" data-validation="required"/>\
                          </div>\
                        </div>\
                        <div class="form-group">\
                          <label class="col-sm-5 control-label no-padding-right" for="days" >Days<span style="color: red">&#42;</span> </label>\
                          <div class="col-sm-7">\
                            <input type="number" name="days" id="days"  class="col-xs-12 days" data-validation="required length custom" data-validation-length="1-11"/>\
                          </div>\
                        </div>\
                        \
                           <div id="duedate_div" name="duedate_div">\
                           </div>\
                        \
                        <div class="form-group">\
                             <label class="col-sm-5 control-label no-padding-right" for="due_date_provide" >Due Date Provided by<span style="color: red">&#42;</span> </label>\
                             <div class="col-sm-7">\
                                <select class="col-xs-12" id="due_date_provide" name="due_date_provide">\
                                   <option value="">Bank/Calulated</option>\
                                   <option value="Bank">Bank</option>\
                                   <option value="Calulated">Calculated</option>\
                                </select>     \
                             </div>\
                            \
                        </div>\
                    </div></div></div>\
                                \
                     <div class="col-sm-4"> <div class="panel panel-default">\
                      <div class="panel-body">\
                            <div class="form-group">\
                             <label class="col-sm-5 control-label no-padding-right" for="libor" >Libor Rate<br>Present<span style="color: red">&#42;</span> </label>\
                              <div class="col-sm-7">\
                                <input type="radio" class="lib_y" name="libor" id="libor" value="lib_yes" >Yes</input><br>\
                                <input type="radio" class="lib_n" name="libor" id="libor" value="lib_no" >No</input>\
                              </div>\
                             </div>\
                                        \
                             <div class="form-group" id="lib_rate_appear1" name="lib_rate_appear1" > \
                                  {{-- data comes from script --}}  \
                             </div>\
                             \
                             <div class="form-group">\
                                 <label class="col-sm-5 control-label no-padding-right" for="lc_type" >L/C Type<span style="color: red">&#42;</span> </label>\
                               <div class="col-sm-7">\
                                      <input type="text" name="lc_type" id="lc_type"  value="'+lc_name+'" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly="readonly" />\
                               </div>\
                            </div>\
                            <div class="form-group">\
                                 <label class="col-sm-5 control-label no-padding-right" for="exchange_rate" >Exchange Rate<span style="color: red">&#42;</span> </label>\
                               <div class="col-sm-7">\
                                  <input type="text" name="exchange_rate" id="exchange_rate"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                               </div>\
                            </div>  \
                             <div class="form-group">\
                                 <label class="col-sm-5 control-label no-padding-right" for="acceptance_comm" >Acceptance Comm<span style="color: red">&#42;</span> </label>\
                               <div class="col-sm-7">\
                                  <input type="text" name="acceptance_comm" id="acceptance_comm"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                               </div>\
                            </div> \
                     </div> </div> </div> \
                     \
                    </div></div>\
                    <div class="row">\
                            <button  class="btn btn-info btn-sm pull-right" style="margin-right: 5%;" type="submit">\
                                     {{-- <i class="ace-icon fa fa-check bigger-110"></i> --}} Save\
                             </button>\
                    </div>\
                 </form> </div></div>'; 

                 $('#data_entry_form').html(form);
             });

          //due date choice
           $('body').on('click','.ck',function(){
                // var id = $(this).val();
                 // var lc_name = $(this).parent().find('.ilc_no').val();
                 var lc_name = document.getElementById('lc_type').value;
                 console.log('LC:', lc_name);
             // $('#data_entry_form').on('keyup', function(){
                      // var days = $(this).find("input[name='days']").val();
                      // var days = document.getElementById('days').value;
                      // var parent = $(this);
                      $('#days').on('keyup', function(){
                         var days = document.getElementById('days').value;
                         var acc_date_ck = document.getElementById('acceptance_date').value;
                         if(!acc_date_ck) { alert("Please Enter Acceptance Date"); document.getElementById('days').value=null; }
                         else{

                               var view1= '<div class="form-group"><label class="col-sm-5 control-label no-padding-right" for="due_dates_cal" >Due Date<span style="color: red">&#42;</span> </label>\
                                 <div class="col-sm-7">\
                                  <input type="date" name="due_dates_cal" id="due_dates_cal" class="col-xs-12 no-padding-right" data-validation="required" readonly="readonly"/>\
                                 </div></div>';
                               var view2 = '<div class="form-group"><label class="col-sm-5 control-label no-padding-right" for="due_dates" >Due Date<span style="color: red">&#42;</span> </label>\
                                 <div class="col-sm-4">\
                                  <input type="date" name="due_dates[]" id="due_dates" class="col-xs-12 no-padding-right" data-validation="required"/>\
                                 </div>\
                                 <div class="col-sm-3">\
                                       <button type="button" class="btn btn-xs btn-success AddBtn_due">+</button>\
                                       <button type="button" class="btn btn-xs btn-danger RemoveBtn_due">-</button>\
                                 </div></div>';   

                                
                                  //Finding the lc type of the selected row
                                 // var lc_name;
                                 // var data = '<//?php echo json_encode($ilc_list); ?>';
                                 // var parsed_data = JSON.parse(data);
                                 //        //console.log(parsed_data[1]['lc_type_name']);
                                 // var arr_length = Object.keys(parsed_data).length;
                                 //    for(i=0;i<arr_length;i++){
                                 //          if(parsed_data[i]['id']==id){
                                 //                  lc_name = parsed_data[i]['lc_type_name']; break;
                                 //              }
                                 //          else{
                                 //                continue;
                                 //              }
                                 //          }
                                        //console.log(lc_name);

                                var lcn=String(lc_name).toLowerCase();
                                var s1="upass"; 
                                var s2="edf";

                                var r1 = lcn.localeCompare(s1);  
                                var r2 = lcn.localeCompare(s2);
                               console.log(lcn, r1, r2);

                               if( ( r1==0 || r2==0) && (days == 90 || days==120) ){

                                  document.getElementById("duedate_div").innerHTML =  view2; 
                               } 
                               else{
                                    document.getElementById("duedate_div").innerHTML =  view1; 
                                     //due date calculation
                                    // $('#data_entry_form').on('keyup', function(){
                                              // var val1 = parent.find("input[name='acceptance_date']").val();
                                              var val1 = document.getElementById('acceptance_date').value;
                                              // if(!val1) { alert("Please Enter Acceptance Date"); } 
                                              // var val1 = $(this).find("input[name='acceptance_date']").val();
                                              // var val2 = parent.find("input[name='days']").val();
                                              var val2 = days;
                                                    console.log('accp date and days:',val1, val2);
                                              var val3 =   new Date(val1);
                                                  val3.setDate( val3.getDate() + parseInt(val2, 10) );
                                                  console.log('generated date:',val3);
                                              var myTime = new Date(val3);
                                                  console.log('calculated time:',myTime);
                                              var t = myTime.toISOString().substr(0, 10);
                                                  console.log('put date:',t);
                                              document.getElementById("due_dates_cal").value = t;
                                         // });  
                                    }
                          }
                      });
                         
                // });
            });
        //For multiple due dates
          var due_entry='<div id="duedate_div" name="duedate_div"><div class="form-group">\
                         <label class="col-sm-5 control-label no-padding-right" for="due_dates" >Due Date<span style="color: red">&#42;</span> </label>\
                            <div class="col-sm-4">\
                              <input type="date" name="due_dates[]" id="due_dates" class="col-xs-12 no-padding-right " data-validation="required"/>\
                            </div>\
                            <div class="col-sm-3 no-padding-right ">\
                               <button type="button" class="btn btn-xs btn-success AddBtn_due">+</button>\
                               <button type="button" class="btn btn-xs btn-danger RemoveBtn_due">-</button>\
                            </div>\
                          </div>\
                        </div>';

                  $('body').on('click', '.AddBtn_due', function(){
                  $("#duedate_div").append(due_entry);
                   });

                  $('body').on('click', '.RemoveBtn_due', function(){
                  $(this).parent().parent().parent().remove();
                  });
          

  });
</script>



        </div>

  
</div>
@endsection