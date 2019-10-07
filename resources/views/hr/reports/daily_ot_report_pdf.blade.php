<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
@if(!empty($information))
<div class="col-xs-12" id="PrintArea">
    <div id="html-2-pdfwrapper" class="col-sm-12" style="margin:20px auto;border:1px solid #ccc">
        <div class="page-header" style="text-align:left;border-bottom:2px double #666">
            <h2 style="margin:4px 10px; font-weight: bold; text-align: center; color: #0000FF">{{ !empty($unit_name)? $unit_name: null }}</h2>
            <h3 style="margin:4px 5px; font-size: 16px; text-align: center; color: #C85E23; ">Daily Ot Hrs As Per Out-time</h3>
            <h4 style="margin:4px 5px; font-size: 14px; text-align: center; font-weight: bold;">Report Date : {{ !empty($report_date)? $report_date:null }}</h4>
            <table width="100%">
                <tbody>
                    <tr>
                        <td>
                            <h5 style="margin:4px 5px; font-size: 10px; text-align: right;"><font style="font-weight: bold;">Print:</font> <?php echo date('d-M-Y H:i A');  ?></h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @foreach($information AS $floor)
        <p style="text-align: center; color: #0000FF">Floor No: {{!empty($floor[1])? $floor[1]:null}}</p>
        <table style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
            <thead>

                <tr>
                    <th rowspan="2"  style="text-align: center;">Section</th>
                    <th rowspan="2"  style="text-align: center;">Total Present</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">0 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">1 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">2 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">3 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">4 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">5 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">6 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">7 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">8 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">9 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">10 Hours</th>
                    <th colspan="2" style="background-color: #FFFFDF; text-align: center;">11 Hours</th>
                </tr>
                <tr>
                    <th style="text-align: center;">5.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">6.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">7.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">8.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">9.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">10.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">11.00 PM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">12.00 AM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">1.00 AM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">2.00 AM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">3.00 AM</th>
                    <th style="text-align: center;">%</th>
                    <th style="text-align: center;">4.00 AM</th>
                    <th style="text-align: center;">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($floor[0] AS $section)
                <tr style="text-align: center;">
                    <td>{{ !empty($section->section_name)?$section->section_name:null }}</td>
                    <td style="background-color: #40DFBF">{{ !empty($section->sections_present_emps)?$section->sections_present_emps:"0" }}</td>
                    <td>{{ !empty($section->ot_0)?$section->ot_0:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_0)?round(($section->ot_0*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_1)?$section->ot_1:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_1)?round(($section->ot_1*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_2)?$section->ot_2:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_2)?round(($section->ot_2*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_3)?$section->ot_3:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_3)?round(($section->ot_3*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_4)?$section->ot_4:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_4)?round(($section->ot_4*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_5)?$section->ot_5:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_5)?round(($section->ot_5*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_6)?$section->ot_6:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_6)?round(($section->ot_6*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_7)?$section->ot_7:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_7)?round(($section->ot_7*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_8)?$section->ot_8:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_8)?round(($section->ot_8*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_9)?$section->ot_9:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_9)?round(($section->ot_9*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_10)?$section->ot_10:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_10)?round(($section->ot_10*100)/$section->sections_present_emps):"0" }}</td>
                    <td>{{ !empty($section->ot_11)?$section->ot_11:"0" }}</td>
                    <td style="color: #D60A0A">{{ !empty($section->ot_11)?round(($section->ot_11*100)/$section->sections_present_emps):"0" }}</td>
                </tr>
                @endforeach
                <tr style="background-color: yellow">
                    <td style="text-align: center;">Total</td>
                    <td style="text-align: center;">{{ $floor[14]}}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[2] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[3] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[4] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[5] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[6] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[7] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[8] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[9] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[10] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[11] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[12] }}</td>
                    <td style="text-align: center;" colspan="2">{{ $floor[12] }}</td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
</div>
@endif