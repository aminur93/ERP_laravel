<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
@if(!empty($info->otEmpAttendance))
<div class="col-sm-12">
    <h4 style="text-align: center; text-decoration: underline;" >Attendance Report OF {{ $info->unit_name }}</h4>
    <h4 style="text-align: center; text-decoration: underline;" >Date:  {{ date('d-M-Y', strtotime($info->date)) }}</h4>
    <p>Run Time:&nbsp;<?php echo date('l\&\\n\b\s\p\;F \&\\n\b\s\p\;d \&\\n\b\s\p\;Y \&\\n\b\s\p\;h:m a'); ?></p>
    <hr>
</div>
<div class="col-sm-12">
    <table width="100%" >
        <tr>
        <td width="55%">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="55%" style="text-align: left;"> Summary : </th>
                    <td width="15%" style="border: 1px; text-align: center;">E</td>
                    <td width="15%" style="border: 1px; text-align: center;">P</td>
                    <td width="15%" style="border: 1px; text-align: center;">A</td>
                </tr>
            </table>
            <table width="100%" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="55%" style="text-align: left;">NON OT Employee : </th>
                    <td width="15%" style="text-align: center;" id="non_ot_grand_e"></td>
                    <td width="15%" style="text-align: center;" id="non_ot_grand_p"></td>
                    <td width="15%" style="text-align: center;" id="non_ot_grand_a"></td>
                </tr>
                <tr>
                    <th width="55%" style="text-align: left;">OT Employee : </th>
                    <td width="15%" style="text-align: center;" id="ot_grand_e">d</td>
                    <td width="15%" style="text-align: center;" id="ot_grand_p">d</td>
                    <td width="15%" style="text-align: center;" id="ot_grand_a">d</td>
                </tr>
                <tr>
                    <th bgcolor="#C2C2C2" width="55%" style="text-align: left;">Total:</th>
                    <td bgcolor="#C2C2C2" width="15%" style="text-align: center;" id="sum_e" ></td>
                    <td bgcolor="#C2C2C2" width="15%" style="text-align: center;" id="sum_p" ></td>
                    <td bgcolor="#C2C2C2" width="15%" style="text-align: center;" id="sum_a" ></td>
                </tr>
            </table>
        </td>
        <td width="4%"></td>
        <td width="41%">
            <table>
                <tr>
                   <td style="text-align: right;">MMR</td> 
                   <td>&nbsp;&nbsp;=&nbsp;&nbsp;</td>
                   <td>
                       <p style="border-bottom: 1px solid; padding-bottom: 0px; margin-bottom: 0px; text-align: center;">P. NON OT + P. OT Holder</p>
                       <p style="margin-top: 0px; padding-top: 0px; text-align: center;"> Sewing Opr + Fin Opr</p>
                   </td> 
                </tr>
                <tr>
                   <td></td> 
                   <td>&nbsp;&nbsp;=&nbsp;&nbsp;</td> 
                    <td>
                        <p style="border-bottom: 1px solid; padding-bottom: 0px; margin-bottom: 0px; text-align: center;"><font id="p_ot_n">P. NON OT</font> + <font id="p_ot">P. OT Holder</font></p>
                       <p style="margin-top: 0px; padding-top: 0px; text-align: center;"> <font id="sw_opr">Sewing Opr</font> + <font id="fin_opr">Fin Opr</font></p>
                    </td>
                </tr>
                <tr> 
                   <td></td>
                   <td>&nbsp;&nbsp;=&nbsp;&nbsp;</td>
                    <td>
                        <font id="mmr_result">0</font>
                    </td> 
                </tr>
            </table>
        </td>
        </tr>
    </table>
    <legend>OT Holder List.</legend>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <thead>
            <tr>
                <th style="text-align: center;">Sl</th>
                <th style="text-align: center;">Section</th>
                <th style="text-align: center;">Sub Section</th>
                <th width="5%" style="text-align: center;">E</th>
                <th width="5%" style="text-align: center;">P</th>
                <th width="5%" style="text-align: center;">A</th>
                <th width="5%" style="text-align: center;">AB%</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
                $i=1; 
                $rowspan=1;

                $grand_e=0;
                $grand_p=0;
                $grand_a=0;
            ?>
            @foreach($info->otEmpAttendance AS $section => $subSections)
            <?php $rowspan=sizeof($subSections)+1;  ?>
            <tr>
                <td rowspan="{{ $rowspan }}">{{ $i++ }}</td>
                <td rowspan="{{ $rowspan }}">{{ $section }}</td>
                <td><?php echo $subSections[0]->subsection_name; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->enroll; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->present; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->absent; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->absent_percent; ?>%</td>
                <?php
                    $section_total_e=$subSections[0]->enroll;
                    $section_total_p=$subSections[0]->present;
                    $section_total_a=$subSections[0]->absent;
                    $section_total_ab=$subSections[0]->absent_percent;
                    for($j=1; $j<sizeof($subSections); $j++){ 
                        $section_total_e+=$subSections[$j]->enroll;
                        $section_total_p+=$subSections[$j]->present;
                        $section_total_a+=$subSections[$j]->absent;
                        echo "<tr><td>".$subSections[$j]->subsection_name."</td><td style='text-align: right;'>".$subSections[$j]->enroll."</td><td style='text-align: right;'>".$subSections[$j]->present."</td><td style='text-align: right;'>".$subSections[$j]->absent."</td><td style='text-align: right;'>".$subSections[$j]->absent_percent."%</td></tr>";
                    }
                    $grand_e+=$section_total_e;
                    $grand_p+=$section_total_p;
                    $grand_a+=$section_total_a;
                    echo "<tr bgcolor='#C2C2C2'><td colspan=''>Total: </td><td style='text-align: right;'>".$section_total_e."</td><td style='text-align: right;'>".$section_total_p."</td><td style='text-align: right;'>".$section_total_a."</td><td style='text-align: right;'>".round(($section_total_a*100)/$section_total_e) ."%</td></tr>";
                ?>
            </tr>
            @endforeach
            <tr bgcolor="#C2C2C2">
                <td colspan="3">Grand Total: </td>
                <td style='text-align: right;' id="grand_e">{{ $grand_e }}</td>
                <td style='text-align: right;' id="grand_p">{{ $grand_p }}</td>
                <td style='text-align: right;' id="grand_a">{{ $grand_a }}</td>
                <td style='text-align: right;'>{{ round(($grand_a*100)/$grand_e) }}%</td>
            </tr>
        </tbody>
    </table>
    <!-- Non OT Holder -->

    <legend style="margin-top: 50px;">NON OT Holder List.</legend>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <thead>
            <tr>
                <th style="text-align: center;">Sl</th>
                <th style="text-align: center;">Section</th>
                <th style="text-align: center;">Sub Section</th>
                <th width="5%" style="text-align: center;">E</th>
                <th width="5%" style="text-align: center;">P</th>
                <th width="5%" style="text-align: center;">A</th>
                <th width="5%" style="text-align: center;">AB%</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
                $i=1; 
                $rowspan=1;

                $grand_e=0;
                $grand_p=0;
                $grand_a=0;
            ?>
            @foreach($info->nonOtEmpAttendance AS $section => $subSections)
            <?php $rowspan=sizeof($subSections)+1;  ?>
            <tr>
                <td rowspan="{{ $rowspan }}">{{ $i++ }}</td>
                <td rowspan="{{ $rowspan }}">{{ $section }}</td>
                <td><?php echo $subSections[0]->subsection_name; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->enroll; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->present; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->absent; ?></td>
                <td style='text-align: right;'><?php echo $subSections[0]->absent_percent; ?>%</td>
                <?php
                    $section_total_e=$subSections[0]->enroll;
                    $section_total_p=$subSections[0]->present;
                    $section_total_a=$subSections[0]->absent;
                    $section_total_ab=$subSections[0]->absent_percent;
                    for($j=1; $j<sizeof($subSections); $j++){ 
                        $section_total_e+=$subSections[$j]->enroll;
                        $section_total_p+=$subSections[$j]->present;
                        $section_total_a+=$subSections[$j]->absent;
                        echo "<tr><td>".$subSections[$j]->subsection_name."</td><td style='text-align: right;'>".$subSections[$j]->enroll."</td><td style='text-align: right;'>".$subSections[$j]->present."</td><td style='text-align: right;'>".$subSections[$j]->absent."</td><td style='text-align: right;'>".$subSections[$j]->absent_percent."%</td></tr>";
                    }
                    $grand_e+=$section_total_e;
                    $grand_p+=$section_total_p;
                    $grand_a+=$section_total_a;
                    echo "<tr bgcolor='#C2C2C2'><td colspan=''>Total: </td><td style='text-align: right;'>".$section_total_e."</td><td style='text-align: right;'>".$section_total_p."</td><td style='text-align: right;'>".$section_total_a."</td><td style='text-align: right;'>".round(($section_total_a*100)/$section_total_e) ."%</td></tr>";
                ?>
            </tr>
            @endforeach
            <tr bgcolor="#C2C2C2">
                <td colspan="3">Grand Total: </td>
                <td style='text-align: right;' id="grand_e_n">{{ $grand_e }}</td>
                <td style='text-align: right;' id="grand_p_n">{{ $grand_p }}</td>
                <td style='text-align: right;' id="grand_a_n">{{ $grand_a }}</td>
                <td style='text-align: right;'>{{ round(($grand_a*100)/$grand_e) }}%</td>
            </tr>
        </tbody>
    </table>
</div>
@endif
 

<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
<script type="text/javascript">
    $(window).load(function() {
      //ot summary
      var ot_e=0;
      var ot_p=0;
      var ot_a=0;
      var ot_e=parseInt($("#grand_e").text());
      var ot_p=parseInt($("#grand_p").text());
      var ot_a=parseInt($("#grand_a").text());
      $("#ot_grand_e").text(ot_e);
      $("#ot_grand_p").text(ot_p);
      $("#ot_grand_a").text(ot_a);

      //non ot summary
      var ot_e_n=0;
      var ot_p_n=0;
      var ot_a_n=0;
      var ot_e_n=parseInt($("#grand_e_n").text());
      var ot_p_n=parseInt($("#grand_p_n").text());
      var ot_a_n=parseInt($("#grand_a_n").text());
      $("#non_ot_grand_e").text(ot_e_n);
      $("#non_ot_grand_p").text(ot_p_n);
      $("#non_ot_grand_a").text(ot_a_n);
      //total summary
      var sum_e= 0;
      var sum_p= 0;
      var sum_a= 0;
      var sum_e= ot_e+ot_e_n;
      var sum_p= ot_p+ot_p_n;
      var sum_a= ot_a+ot_a_n;

      $("#sum_e").text(sum_e);
      $("#sum_p").text(sum_p);
      $("#sum_a").text(sum_a);

      //MMR
      $("#p_ot").text(ot_p);
      $("#p_ot_n").text(ot_p_n);

    });
</script>