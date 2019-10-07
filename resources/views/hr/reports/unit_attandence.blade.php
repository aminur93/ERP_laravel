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
                <li class="active">Attendance </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content"> 
             <?php $type='unit'; ?>
              @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Attendance</small></h1>
            </div>
            <div class="row">
                
                    <div class="col-sm-10"> 

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select ','id'=>'unitselect','class'=> 'form-control', 'data-validation'=>'required']) }}
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="curdate" id="curdate" class="datepicker col-xs-12" data-validation="required" placeholder="Y-m-d"/> 
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" id="search"class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i>
                                Search
                            </button>
                             <button type="button" onClick="printMe('PrintArea')" class="showprint btn btn-warning btn-sm" title="Print">
                                   <i class="fa fa-print"></i>
                             </button>
                        <!--     <button type="button" onclick="generate()" class="showprint btn btn-info btn-sm">
                                <i class="fa fa-file-pdf-o" style="font-size:14px"></i>
                           </button> -->
                            <button type="button"  id="excel"  class="showprint btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o" style="font-size:14px"></i>
                           </button>
                        </div>
                    </div>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-9" id="PrintArea">
                    <!-- PAGE CONTENT BEGINS -->

                    <!--10 here--->
                 <div id="html-2-pdfwrapper">    
                  <div  id="form-element">
              <!--Table here---> 
              
                  </div>
                  <div id="loading" class="col-md-offset-5 text-center col-sm-4" style="margin-top:10%;">
                 
                   <i class="fa fa-spinner fa-pulse fa-5x" ></i>

                  </div>

        
                 </div>  

              <!-- PAGE CONTENT ENDS -->
             </div>
            <!-- /.col -->
            </div> 
        </div><!-- /.page-content -->
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
     $('.showprint').hide(); //Hide print button
     $("#loading").hide(); // hide gif Loader

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

    /// Form Based on Emloyee Id
    var basedon = $("#search");  
    var action_element = $("#form-element");
  
    basedon.on("click", function(){ 
      

        var un_id = $("#unitselect").val();  
        var datevalue = $("#curdate").val();

        if(un_id == "") {

          alert("Please Select Unit");
        }
        if(datevalue == "") {

          alert("Please Select Date");
        }

        else{
          // check if #work-register div already exist then remove 

              if($('#unit-attendance').length)   
              {
                $('#unit-attendance').remove(); 
              }
     
          // Attendance list
            $.ajax({
                url : "{{ url('hr/reports/unitattendance_table') }}",
                type: 'get',
                data: {unit_id :un_id, curdate:datevalue},
                beforeSend: function(){
                   $('#loading').show();
                  },
                complete: function(){
                    $('#loading').hide();
                   },  
                success: function(data)
                {
                    action_element.html(data);
                    //show print button
                      $('.showprint').show(); 
                    //Call Sum Functions
                        calc_total_onroll();
                        calc_total_present();
                        calc_total_absent();
                },
                error: function()
                {
                    alert('Not Found...');
                }
            });
          } //end else

        });

///total O, P, A Calculation
    function calc_total_onroll(){
      var sum = 0;
      $(".onroll").each(function(){
        sum += parseFloat($(this).text());
      });
      $('#sumonroll').text(sum);
    }

    function calc_total_present(){
      var sum = 0;
      $(".present").each(function(){
        sum += parseFloat($(this).text());
      });
      $('#sumpresent').text(sum);
    }

    function calc_total_absent(){
      var sum = 0;
      $(".absent").each(function(){
        sum += parseFloat($(this).text());
      });
      $('#sumabsent').text(sum);
    }

  });

</script>
<!-- Pdf Conversion -->
<script src="{{ asset('assets/js/dist/jspdf.min.js') }}"></script> 
<script>
  margins = {
  top: 70,
  bottom: 40,
  left: 30,
  width: 700
};

generate = function()
{

    var pdf = new jsPDF('p', 'pt', 'a4');
    pdf.setFontSize(18);
    pdf.fromHTML(document.getElementById('html-2-pdfwrapper'), 
        margins.left, // x coord
        margins.top,
        {
            // y coord
            width: margins.width// max width of content on PDF
        },function(dispose) {
            headerFooterFormatting(pdf, pdf.internal.getNumberOfPages());
        }, 
        margins);
        
     var iframe = document.createElement('iframe');
      iframe.src = pdf.output('datauristring');
     var url = iframe.src;
     //var tabOrWindow = window.open(url, '_blank');
     var res = url.replace("data:application/pdf;base64,", "")
     var tabOrWindow=window.open('data:application/pdf;base64,' +res);
      //  var tabOrWindow=window.open("data:application/pdf;base64, " + url);
     tabOrWindow.focus();

     pdf.save('unit_attendance.pdf');
    
};
function headerFooterFormatting(doc, totalPages)
{
    for(var i = totalPages; i >= 1; i--)
    {
        doc.setPage(i);                            
        //header
       // header(doc);
       footer(doc, i, totalPages);
        doc.page++;
    }
};

function footer(doc, pageNumber, totalPages){

    var str = "Page " + pageNumber + " of " + totalPages
    doc.setFontSize(10);
    doc.text(str, margins.left, doc.internal.pageSize.height - 20);
    
};

// excel conversion -->

$(function(){
    $('#excel').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
        location.href=url
        return false
    })
})
 function attLocation(loc){
    window.location = loc;
   }
</script>

@endsection