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
                    <a href="#"> Time & Attendance  </a>
                </li>
                <li class="active"> Daywise Manual Attendance </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content">
         
            <div class="page-header">
                <h1>Time & Attendance <small> <i class="ace-icon fa fa-angle-double-right"></i> Daywise Manual Attendance </small></h1>
            </div>
            <div class="row">
                @include('inc/message')
                    <div class="col-sm-12" style="padding: 0px;">
                        <form role="form" method="get" action="{{ url('hr/timeattendance/daywise_manual_attendance') }}">
                            <div class="form-group">
                                <div class="col-sm-2" >
                                    {{ Form::select('unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }}  
                                </div>
                                <div class="col-sm-2">
                                    {{ Form::select('floor_id', !empty(Request::get('unit_id'))?$floorList:[], Request::get('floor_id'), ['placeholder'=>'Select Floor', 'id'=>'floor_id', 'class'=> 'col-xs-12']) }}  
                                </div>
                                <div class="col-sm-2">
                                    {{ Form::select('line_id', !empty(Request::get('unit_id'))?$lineList:[], Request::get('line_id'), ['placeholder'=>'Select Line', 'id'=>'line_id', 'class'=> 'col-xs-12']) }}  
                                </div>
                                <div class="col-sm-2">
                                    <input type="date" name="report_date" id="report_date" class="col-xs-12" value="{{ Request::get('report_date') }}" data-validation="required"/>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        Search
                                    </button>
                                    @if(!empty(request()->unit_id)  && !empty(request()->report_date))
                                    <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                        <i class="fa fa-print"></i> 
                                    </button> 
                                     <!--
                                    <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                        <i class="fa fa-file-pdf-o"></i> 
                                    </a>
                                    <button type="button"  id="excel"  class="showprint btn btn-success btn-sm">
                                     <i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                    </button> -->
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                <br><br>
            </div>

            <div class="row">              

                @if(!empty(request()->unit_id)  && !empty(request()->report_date))

                    <div class="col-xs-12" id="PrintArea">
                        <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                             <div class="" style="text-align:left;">
                                <!-- <h2 style="margin:4px 10px; font-weight: bold; text-decoration: underline; text-align: center;">Line Wise Present/Absent</h2> -->
                             
                                <table class="col-xs-12" style="margin-bottom: 10px;">
                                    <tbody>
                                        <tr>
                                            <td width="70%" style="margin: 0; padding: 0">
                                                <h4 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 14px;">Unit: &nbsp;&nbsp;{{ !empty($unit_name)?$unit_name:null }}</font></h4>
                                                @if(!empty(request()->floor_id))
                                                <h5 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Floor: &nbsp;&nbsp;{{ !empty($floor_name)?$floor_name:null }}</font></h5>
                                                @endif
                                                @if(!empty(request()->line_id))
                                                <h5 style="margin:4px 5px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Line: &nbsp;&nbsp;{{ !empty($line_name)?$line_name:null }}</font></h5>
                                                @endif
                                                <h5 style="margin:4px 5px; font-size: 10px; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Report Date: </font>&nbsp;&nbsp;{{ !empty($report_date)?$report_date:null }}</h5>
                                            </td>
                                            <td style="margin: 0; padding: 10px 0px 0px 0px;">
                                                <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 14px;">Total Emp:&nbsp;&nbsp;{{ !empty($info)?$info->count():null }}</font></h4>
                                                
                                                <!-- <h4 style="margin:4px 5px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold; font-size: 12px;">Absent Emp in Line(A):</font>&nbsp;&nbsp;{{ !empty($absent)?$absent:null }}</h4> -->
                                                <h5 style="margin:4px 5px; font-size: 10px; text-align: right; margin: 0; padding: 0"><font style="font-weight: bold;">Print:&nbsp;&nbsp;</font><?php echo date('d-M-Y H:i A');  ?></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                
                            </div>
                            @if(!empty($departments))
                            <form class="form-horizontal" role="form" method="post" action="{{ url('hr/timeattendance/attendance_daywise_store')  }}" enctype="multipart/form-data">
                             {{ csrf_field() }}   
                                @foreach($departments AS $department)
                                    <?php $count=0; $dept_sl=1; $p=0; $overtime_minutes=0; ?>
                                    <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                                        <thead>
                                            <tr>
                                                <th colspan="2">Department</th>
                                                <th colspan="5">{{ $department->hr_department_name }}</th>
                                            </tr> 
                                            <tr>
                                                <th>Sl 
                                                 <input type="hidden" name="startday" value="{{ !empty($report_date)?$report_date:null }}" readonly="readonly"></th>
                                                <th>Associate ID</th>
                                                <th>Name</th>
                                               <!--  <th>Status</th> -->
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <!-- <th>Overtime(Hour)</th> -->
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            @foreach($info AS $emp)
                                            @if(($emp->as_department_id== $department->as_department_id)&& (!empty($emp->att)&& ($emp->att=="A")))
                                                <tr>
                                                    <td>{{ $dept_sl }}  
                                                        <input type="hidden" name="attendance_id[]" value="{{$emp->atid}}" class="attendance_id">
                                                    </td>
                                                    <td>{{ !empty($emp->associate_id)?$emp->associate_id:null }}</td>
                                                    <td>{{ !empty($emp->as_name)? $emp->as_name:null }}
                                                        <input type="hidden" class="att_status" name="att_status[]" value="{{ !empty($emp->att)? $emp->att:null }}">

                                                    </td>
                                                   <!--  <td>{{ !empty($emp->att)? $emp->att:null }}
                                                        

                                                    </td> -->
                                                    <td><!-- {{!empty($emp->in_time)? $emp->in_time:null }} -->
                                                        <input class="intime manual" type="time" name="intime[]" value="{{!empty($emp->in_time)? $emp->in_time:null}}"  step="2" placeholder="HH:mm:ss">

                                                    </td>
                                                    <td><!-- {{ !empty($emp->out_time)? $emp->out_time:null }} -->
                                                        <input type="time"class="outtime manual" name="outtime[]" value="{{!empty($emp->out_time)? $emp->out_time:null }}" step="2" placeholder="HH:mm:ss"  >

                                                        <input type="hidden" name="ass_id[]" value="{{$emp->as_id}}">
                                                    </td>
                                                    <!-- <td>{{ !empty($emp->oth)? $emp->oth:null }}</td> -->
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
                                                
                                            </tr>
                                          
                                        </tbody>
                                    </table>

                                    @endforeach
                                    <div class="col-xs-12 pull-right" style="margin-bottom: 10px; padding: 0px;">

                                        <input type="hidden" name="unit_att" class="unit_att" value="{{request()->unit_id}}">
                                        <button class="btn btn-info pull-right" type="submit">
                                              <i class="ace-icon fa fa-check bigger-110"></i> Insert
                                        </button>
                                         
                                    </div>
                                 </form> 
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
            url : "{{ url('hr/attendance/floor_by_unit') }}",
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
// Status Hidden field value change

    $(".manual").on("keyup click", function(){ 
        var intime=$(this).parent().parent().find('.intime').val();
        var outtime=$(this).parent().parent().find('.outtime').val();

        if(intime != ''||outtime != ''){     
          $(this).parent().parent().find('.att_status').val('P');
        }
        else{ 
        $(this).parent().parent().find('.att_status').val('A');
        }  

    });
    // Time picker -->
    // $('.intime, .outtime').datetimepicker({
           
    //         format: 'HH:mm:ss'
    //     });     


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
