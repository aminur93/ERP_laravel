<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
@if(!empty(request()->unit_id) && !empty(request()->line_id) && !empty(request()->report_date))
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

 