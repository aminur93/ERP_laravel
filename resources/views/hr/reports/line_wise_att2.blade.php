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
                <li class="active"> Line Wise Present/Absent </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">
          <?php $type='line'; ?> 
             @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Line Wise Present/Absent </small></h1>
            </div>
            <div class="row">
                @include('inc/message')
                    <div class="col-sm-10">
                        <form role="form" method="get" action="{{ url('hr/reports/line_by_unit2') }}">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    {{ Form::select('unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }}  
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::select('line_id', !empty(Request::get('unit_id'))?$lineList:[], Request::get('line_id'), ['placeholder'=>'Select Line', 'id'=>'line_id', 'class'=> 'col-xs-12']) }}  
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" name="report_date" id="report_date" class="col-xs-12" value="{{ Request::get('report_date') }}" data-validation="required"/>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        Search
                                    </button>
                                    @if(!empty(request()->unit_id) && !empty(request()->line_id) && !empty(request()->report_date))
                                    <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                        <i class="fa fa-print"></i> 
                                    </button> 
                                    <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                        <i class="fa fa-file-pdf-o"></i> 
                                    </a>
                                    <button type="button"  id="excel"  class="showprint btn btn-success btn-sm">
                                     <i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                <br><br>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                @if(!empty(request()->unit_id)  && !empty(request()->report_date))

                    <div class="col-xs-12" id="PrintArea">
                        <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                            <div class="page-header" style="text-align:left;border-bottom:2px double #666">
                                <h2 style="margin:4px 10px; font-weight: bold; text-decoration: underline; text-align: center;">Line Wise Present/Absent</h2>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="70%" style="margin: 0; padding: 0">
                                                <h4 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Unit: </font>&nbsp;&nbsp;{{ !empty($unit_name)?$unit_name:null }}</h4>
                                                <h5 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Line: </font>&nbsp;&nbsp;{{ !empty($line_name)?$line_name:null }}</h5>
                                                <h5 style="margin:4px 5px; font-size: 10px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Report Date: </font>&nbsp;&nbsp;{{ !empty($report_date)?$report_date:null }}</h5>
                                            </td>
                                            <td style="margin: 0; padding: 0">
                                                <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Total Emp in Line:</font>&nbsp;&nbsp;{{ !empty($info)?$info->count():null }}</h4>
                                                <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Present Emp in Line(P):</font>&nbsp;&nbsp;{{ !empty($present)?$present:null }}</h4>
                                                <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Absent Emp in Line(A):</font>&nbsp;&nbsp;{{ !empty($absent)?$absent:null }}</h4>
                                                <h5 style="margin:4px 5px; font-size: 10px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold;">Print:&nbsp;&nbsp;</font><?php echo date('d-M-Y H:i A');  ?></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                
                            </div>
                            @if(!empty($departments))
                                @foreach($departments AS $department)
                                    <?php $count=0; $dept_sl=1; $p=0; $overtime_minutes=0; ?>
                                    <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                                        <thead>
                                            <tr>
                                                <th colspan="2">Department</th>
                                                <th colspan="5">{{ $department->hr_department_name }}</th>
                                            </tr> 
                                            <tr>
                                                <th>Sl</th>
                                                <th>Associate ID</th>
                                                <th>Name</th>
                                                <th>Present Status</th>
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <th>Overtime(Hour)</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            @foreach($info AS $emp)
                                            @if($emp->as_department_id== $department->as_department_id)
                                                <tr>
                                                    <td>{{ $dept_sl }}</td>
                                                    <td>{{ !empty($emp->associate_id)?$emp->associate_id:null }}</td>
                                                    <td>{{ !empty($emp->as_name)? $emp->as_name:null }}</td>
                                                    <td>{{ !empty($emp->att)? $emp->att:null }}</td>
                                                    <td>{{ !empty($emp->in_time)? $emp->in_time:null }}</td>
                                                    <td>{{ !empty($emp->out_time)? $emp->out_time:null }}</td>
                                                    <td>{{ !empty($emp->oth)? $emp->oth:null }}</td>
                                                    <?php if($emp->att == "P") $p++; $count++; $dept_sl++;
                                                    $overtime_minutes+= $emp->otm;
                                                     ?>
                                                </tr>
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td><?php echo "<font style=\"font-weight: bold\">Total:&nbsp;&nbsp;</font>". $count;?></td>
                                                <td colspan="2"></td>
                                                <td><font style="font-weight: bold">P:&nbsp;&nbsp;</font>{{$p}} &nbsp; &nbsp;<font style="font-weight: bold">A:&nbsp;&nbsp;</font><font style="text-align: right;"><?php echo ($count-$p); $count=0; ?></font></td>
                                                <td colspan="2"></td>
                                                <td><font style="font-weight: bold">Total Oth:&nbsp;&nbsp;</font>
                                                    <?php
                                                    $result= floor($overtime_minutes/60).":".((($overtime_minutes%60)>0)? (($overtime_minutes%60))."":"00");

                                                    ?>
                                                    <font><?php echo $result ?></font>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endforeach
                                @endif
                        </div>
                    </div>
                    @endif
                
                <!-- //ends of info  -->
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

    $('#unit_id').on("change", function(){ 
        $.ajax({
            url : "{{ url('hr/reports/line_by_unit') }}",
            type: 'get',
            data: {unit : $(this).val()},
            success: function(data)
            {
                $("#line_id").html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });

     $('#excel').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
        location.href=url
        return false
    })
});
 function attLocation(loc){
    window.location = loc;
   }
</script>
@endsection
