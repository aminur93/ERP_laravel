@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Human Resource </a>
                </li>
                <li>
                    <a href="#"> Reports </a>
                </li>
                <li class="active">Earned Leave Payment Sheet </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <?php $type='earn_leave'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Earned Leave Payment Sheet </small></h1>
            </div>
            <div class="row">
                
                    <div class="col-sm-12"> 

                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit','id'=>'unitselect','class'=> 'form-control', 'data-validation'=>'required']) }}
                                </div>
                                <div class="col-sm-2">
                             <!--        {{ Form::select('floor', $floorList, null, ['placeholder'=>'Select Floor','id'=>'floor','class'=> 'form-control', 'data-validation'=>'required']) }} -->


                                     <select name="floor" id="floor" class="col-xs-12" data-validation="required" data-validation-error-msg='Action Type field is required' data-validation-has-keyup-event="true">
                                        <option value="">Select Unit First</option> 
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    {{ Form::select('department', $departmentlist, null, ['placeholder'=>'Select Department','id'=>'department','class'=> 'form-control', 'data-validation'=>'required']) }}
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="fromyear" id="fromyear" class="yearpicker col-xs-5" data-validation="required" placeholder="From" />
                                    <input type="text" name="toyear" id="toyear" class="yearpicker col-xs-5" data-validation="required" placeholder="To" /> 
                                 </div>
                                 <div class="col-sm-3">
                                    <button type="submit" id="search"class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        Search
                                    </button>
                                 
                                    <button type="button" onClick="printMe('PrintArea')" class="showprint btn btn-warning btn-sm" title="Print">
                                   <i class="fa fa-print"></i>
                                   </button>
                                    <!--<button type="button" onclick="generate()" class="showprint btn btn-info btn-sm">
                                    <i class="fa fa-file-pdf-o" style="font-size:14px"></i>
                                   </button> -->
                                    <button type="button"  id="excel"  class="showprint btn btn-success btn-sm" title="Excel"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                   </button>
                                 
                                 </div>
                           
                            </div>

                        </div>

                    </div>

             </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12" id="PrintArea">
                    <!-- PAGE CONTENT BEGINS -->
              
                 <div id="html-2-pdfwrapper"> 
                  <div  id="form-element">
                    <!--Table here--->

                  </div> 
                  
                 </div> 
                  <div id="loading" class="col-md-offset-4 text-center col-sm-4" style="margin-top:10%;">
                 
                   <i class="fa fa-spinner fa-pulse fa-5x" ></i>

                  </div>
                  
                <!-- PAGE CONTENT ENDS -->
               
                <!-- /.col -->
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
</div>
<script type="text/javascript">
function printMe(divName)
{ 
    var myWindow=window.open('','','width=800,height=800');
    myWindow.document.write(document.getElementById(divName).innerHTML); 
    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();
}

$(document).ready(function(){ 
    $('.showprint').hide();
    // excel conversion -->
$('#excel').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
        location.href=url
        return false
    })

    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term
                }; 
            },
            processResults: function (data) { 
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.associate_name,
                            id: item.associate_id
                        }
                    }) 
                };
          },
          cache: true
        }
    });

    ///// Floor Based On Unit
   var floor_element = $("#floor");
     var basedonunit = $("#unitselect");
      basedonunit.on("change", function(){ 

        // Action Element list
        $.ajax({
            url : "{{ url('hr/reports/earnleavepayment_floor') }}",
            type: 'get',
            data: {un_id : $(this).val()},
            success: function(data)
            {
                floor_element.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
/// 

    /// Form Based on Search Element
    var basedon = $("#search");  
    var action_element = $("#form-element");

    basedon.on("click", function(){ 

        var un_id = $("#unitselect").val();  
        var deprt_id = $("#department").val();
        var floor_id = $("#floor").val();
        var from = $("#fromyear").val();
        var to = $("#toyear").val();

      // check if #work-register div already exist then remove 

          if($('#work-register').length)   
          {
            $('#work-register').remove(); 
          }
    //      
 
      // Worker Register list
        $.ajax({
            url : "{{ url('hr/reports/earnleavepayment_table') }}",
            type: 'get',
            data: {unit_id :un_id, dept_id:deprt_id, flr_id:floor_id, fromyr:from, toyear:to},
                beforeSend: function(){
                   $('#loading').show();
                  },
                complete: function(){
                    $('#loading').hide();
                   }, 

            success: function(data)
            { 
                $('#wait').show();
                

                action_element.html(data);
                $('#wait').hide();
                $('.showprint').show(); //show print button
            },
            error: function()
            {
                alert('Not Found...');
            }
        });

    });

///
});
  function attLocation(loc){
    window.location = loc;
   }
</script>
@endsection
