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
                <li class="active">Manual Attendance</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <?php $type='manual_attendance'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Manual Attendance</small></h1>
            </div>
            <div class="row">
                <div class="col-sm-12" style="padding: 0px;">
                    <div class="form-group">
                        <div class="col-sm-3 col-xs-3">
                            {{ Form::select('unit', $units, null, ['placeholder'=>'Select Unit','id'=>'unitselect','class'=> 'form-control', 'data-validation'=>'required']) }}
                        </div>
                        <div class="col-sm-2 col-xs-2">
                            <input type="text" name="month" id="month" class="monthpicker col-xs-12 col-sm-12" data-validation="required" placeholder="Month" />
                          
                         </div>
                         <div class="col-sm-2 col-xs-2">
                            <input type="text" name="year" id="year" class="yearpicker col-sm-12 col-xs-12" data-validation="required" placeholder="Year" /> 
                         </div>   
                         <div class="col-sm-3 col-xs-3">
                            <button type="submit" id="search"class="btn btn-primary btn-sm ">
                                <i class="fa fa-search"></i>
                                Search
                            </button>
                         
                            <button type="button" onClick="printMe('PrintArea')" class="showprint btn btn-warning btn-sm " title="Print">
                                <i class="fa fa-print"></i>
                           </button>
                            
                            <button type="button"  id="excel"  class="showprint btn btn-success btn-sm" title="Excel"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                           </button>
                         
                         </div>
                   
                    </div>

                </div>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-9" id="PrintArea">
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



/// Result Table Based on Search Element
    var basedon = $("#search");  
    var action_place = $("#form-element");

    basedon.on("click", function(){ 

        var un_id = $("#unitselect").val();
        var month = $("#month").val();
        var year = $("#year").val();

      // check if #manual-attendance div already exist then remove 

          if($('#manual-attendance').length)   
          {
            $('#manual-attendance').remove(); 
          }
         
 
      // Url for Manual Attendance list
        $.ajax({
            url : "{{ url('hr/reports/manual_attendance_list') }}",
            type: 'get',
            data: {unitId :un_id, fromMonth:month, toYear:year},
            // Loader 
                beforeSend: function(){
                   $('#loading').show();
                  },
                complete: function(){
                    $('#loading').hide();
                   }, 

            success: function(data)
            { 
                $('#wait').show();               

                action_place.html(data);
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

// Radio button action
  function attLocation(loc){
    window.location = loc;
   }
</script>
@endsection
