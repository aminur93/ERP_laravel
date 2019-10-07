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
                    <a href="#"> Time & Attendance </a>
                </li>
                <li class="active"> Raw Punch </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Raw Punch </small></h1>
            </div>
            <div class="row">
                <div class="col-sm-10"> 
                    @include('inc/message')
                        <form role="form" class="form-horizontal" method="get" action="{{ url('hr/timeattendance/raw_punch') }}">
                                <!-- <div class="form-group"> -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="unit_id"> Unit<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        {{ Form::select('unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="floor_id">Floor<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        {{ Form::select('floor_id', [], null, ['placeholder'=>'Select Floor', 'id'=>'floor_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} 
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="line_id">Line</label>
                                    <div class="col-sm-9">
                                        {{ Form::select('line_id', [], null, ['placeholder'=>'Select Line', 'id'=>'line_id', 'class'=> 'col-xs-12']) }} 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="punch_date">Date<span style="color: red">&#42;</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" name="punch_date" id="punch_date" class="col-xs-12" value="{{old('punch_date')}}" data-validation="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="associate_id">Associate</label>
                                    <div class="col-sm-9">
                                        {{ Form::select('associate_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate_id', 'class'=> 'associates no-select col-xs-12']) }} 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        </button>
                                        @if(!empty(request()->unit_id) && !empty(request()->floor_id))
                                        <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm">
                                            <i class="fa fa-print"></i> 
                                        </button> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
                <br><br>
            </div>
            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                @if(!empty(request()->unit_id) && !empty(request()->floor_id))

                    <div class="col-xs-12" id="PrintArea">
                        <div class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                            <div class="page-header" style="text-align:left;border-bottom:2px double #666">
                                <h2 style="margin:4px 10px; font-weight: bold; text-decoration: underline; text-align: center;">Raw Punch Data</h2>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="40%" style="margin: 0; padding: 0">
                                                <h4 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Unit: </font>&nbsp;&nbsp;{{ !empty($other_info->unit_name)?$other_info->unit_name:null }}</h4>
                                                
                                                <h5 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Floor: </font>&nbsp;&nbsp;{{ !empty($other_info->floor_name)?$other_info->floor_name:null }}</h5>
                                                
                                                @if(!empty($other_info->line_name))
                                                <h5 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Line: </font>&nbsp;&nbsp;{{ !empty($other_info->line_name)?$other_info->line_name:null }}</h5>
                                                @endif
                                            </td>
                                            <td style="margin: 0; padding: 0">
                                                @if(!empty($other_info->punch_date))
                                                <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Punch Date:</font>&nbsp;&nbsp;{{ !empty($other_info->punch_date)?$other_info->punch_date:null }}</h4>
                                                @endif

                                                <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Total Punch:</font>&nbsp;&nbsp;{{ !empty($other_info->total_punch)?$other_info->total_punch:null }}</h4>
                                                <h5 style="margin:4px 5px; font-size: 10px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold;">Print:&nbsp;&nbsp;</font><?php echo date('d-M-Y H:i A');  ?></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if(!empty($data))
                                <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                                    <thead> 
                                        <tr>
                                            <th>Sl</th>
                                            <th>Associate ID</th>
                                            <th>Associate Name</th>
                                            <th>Punch Time</th>
                                            <th>Total Punch</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        @for($i=1; $i<=$other_info->emp_num; $i++)
                                            <tr>
                                                <td>{{ $data[$i]->serial_no }}</td>
                                                <td>{{ $data[$i]->associate_id }}</td>
                                                <td>{{ $data[$i]->as_name }}</td>
                                                <td>
                                                    <table>
                                                        @for($j=0; $j<$data[$i]->row_num; $j++)
                                                        <tr><td>{{ $data[$i]->CheckTime[$j] }}</td></tr>
                                                        @endfor
                                                    </table>
                                                </td>
                                                <td><?php echo $data[$i]->row_num;  ?></td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @endif
                
                <!-- //ends of info  -->
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<script src="{{ asset('assets/js/dist/jspdf.min.js') }}"></script>
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

    $('#unit_id').on("change", function(){ 
        $.ajax({
            url : "{{ url('hr/reports/floor_by_unit') }}",
            type: 'get',
            data: {unit : $(this).val()},
            success: function(data)
            {
                $("#floor_id").html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
    var unit= $("#unit_id");
    var floor= $("#floor_id");
    floor.on("change", function(){ 
        $.ajax({
            url : "{{ url('hr/recruitment/employee/idcard/line_list_by_unit_floor') }}",
            type: 'get',
            data: {unit : unit.val(), floor: floor.val()},
            success: function(data)
            {
                $("#line_id").html(data.lineList);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
});
        
</script>
<script>
    // PDF and Excell Exporter //
    margins = {top: 70,bottom: 40,left: 30,width: 700};
    generate = function(){
        var pdf = new jsPDF('p', 'pt', 'a4');
        pdf.setFontSize(18);
        pdf.fromHTML(document.getElementById('PrintArea'), 
            margins.left, // x coord
            margins.top,
            {
                // y coord
                width: margins.width// max width of content on PDF
            },function(dispose) {
                headerFooterFormatting(pdf, pdf.internal.getNumberOfPages());
            }, 
            margins
        );
            
        var iframe = document.createElement('iframe');
        iframe.src = pdf.output('datauristring');
        var url = iframe.src;
        //var tabOrWindow = window.open(url, '_blank');
        var res = url.replace("data:application/pdf;base64,", "")
        var tabOrWindow=window.open('data:application/pdf;base64,' +res);
        //  var tabOrWindow=window.open("data:application/pdf;base64, " + url);
        tabOrWindow.focus();
         pdf.save('raw_puch.pdf');
    };
    function headerFooterFormatting(doc, totalPages){
        for(var i = totalPages; i >= 1; i--)
        {
            doc.setPage(i);                            
           // header(doc); //header
           footer(doc, i, totalPages);
            doc.page++;
        }
    };

    function footer(doc, pageNumber, totalPages){
        var str = "Page " + pageNumber + " of " + totalPages
        doc.setFontSize(10);
        doc.text(str, margins.left, doc.internal.pageSize.height - 20);
    };

    //excel conversion -->
    $(function(){
        $('#excel').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#PrintArea').html()) 
            location.href=url
            return false
        })
    });
</script>
@endsection
