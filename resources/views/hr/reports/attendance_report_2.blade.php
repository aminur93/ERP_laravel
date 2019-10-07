@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Human Resource</a>
				</li>
				<li>
					<a href="#">Reports</a>
				</li>
				<li class="active"> Attendance Report</li>
			</ul><!-- /.breadcrumb -->
		</div>

        

		<div class="page-content"> 
            <?php $type='attendance_2'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
				<h1>Reports<small><i class="ace-icon fa fa-angle-double-right"></i> Attendance Report</small></h1>
            </div>
            
            <div class="row">

                <form role="form" method="get" action="{{ url('hr/reports/attendance_report_2') }}">
                    <div class="col-sm-10"> 
                        <div class="form-group">
                            <div class="col-sm-4">
                                {{ Form::select('unit', $unitList, request()->unit, ['placeholder'=>'Select Unit', 'id'=>'unit',  'style'=>'width:100%', 'data-validation'=>'required', 'data-validation-error-msg'=>'The Unit field is required']) }}  
                            </div> 
                            <div class="col-sm-4">
                                <input type="text" name="date" id="date" class="datepicker col-xs-12" value="{{ request()->date }}" data-validation="required" autocomplete="off" placeholder="Y-m-d" />
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                @if (!empty($info->otEmpAttendance)) 
                                <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                    <i class="fa fa-print"></i> 
                                </button>
                                <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                    <i class="fa fa-file-pdf-o"></i> 
                                </a>
                                <button type="button"  id="excel"  class="showprint btn btn-success btn-sm" title="Excel"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row" id="html-2-pdfwrapper">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12" id="PrintArea" style="margin:20px auto">
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
                                                <p style="border-bottom: 1px solid; padding-bottom: 0px; margin-bottom: 0px; text-align: center;">
                                                    <span id="p_ot_n">P. NON OT</span> + <font id="p_ot">P. OT Holder</font>

                                                  <!--   <input type="text" id="p_ot_n2" name=""> -->
                                                </p>
                                               <p style="margin-top: 0px; padding-top: 0px; text-align: center;">
                                                   <font id="sw_opr">Sewing Opr</font> + <font id="fin_opr">Fin Opr</font>
                                            </p>
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
                                    <td class="sec_name"rowspan="{{ $rowspan }}">{{ $section }}</td>
                                    <td class="sewing_subsec_name"><?php echo $subSections[0]->subsection_name; ?></td>
                                    <td class="enroll" style='text-align: right;'><?php echo $subSections[0]->enroll; ?>
                                        
                                          <input type="hidden" name="subsec_id" value="{{$subSections[0]->subsection_id}}" class="subsec_id">  
                                    </td>
                                    <td class="sewing_present" style='text-align: right;'>
                                        <?php /*echo"Sewing Present: ";*/
                                         echo $subSections[0]->present; ?>
                                    </td>

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
                                            echo "<tr><td>".$subSections[$j]->subsection_name."</td><td style='text-align: right;'><input type='hidden' name='subsec_id' value='".$subSections[$j]->subsection_id."' class='subsec_id'> ".$subSections[$j]->enroll."</td><td style='text-align: right;'>".$subSections[$j]->present."</td><td style='text-align: right;'>".$subSections[$j]->absent."</td><td style='text-align: right;'>".$subSections[$j]->absent_percent."%</td></tr>";
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
                                    <td style='text-align: right;' id="grand_e"> {{ $grand_e }} </td>
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
                                    <td style='text-align: right;'>
                                         
                                          <input type="hidden" name="subsec_id" value="{{$subSections[0]->subsection_id}}" class="subsec_id">
                                    <?php 
                                    echo $subSections[0]->enroll; ?></td>
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
                                            echo "<tr><td>".$subSections[$j]->subsection_name."</td><td style='text-align: right;'><input type='hidden' name='subsec_id' value='".$subSections[$j]->subsection_id."' class='subsec_id'> ".$subSections[$j]->enroll."</td><td style='text-align: right;'>".$subSections[$j]->present."</td><td style='text-align: right;'>".$subSections[$j]->absent."</td><td style='text-align: right;'>".$subSections[$j]->absent_percent."%</td></tr>";
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
                </div>
            </div>

		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">  

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

        $('#excel').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#html-2-pdfwrapper').html()) 
                    location.href=url
                return false
            })


     
    })

    function printMe(divName)
    { 
        var myWindow=window.open('','','width=800,height=800');
        myWindow.document.write(document.getElementById(divName).innerHTML); 
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }


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

      var sum_sweing_op = 0;
      var sum_fin_op = 0;
        $(".subsec_id").each(function(i, v){

            // Sewing Operator 
            if ($(this).val() == 21)
            {
                sum_sweing_op += +$(this).parent().next().text();        
             
               // $("#sw_opr").text($(this).parent().next().text());

            }

            // Finishing Operator 
            if ($(this).val() == 84)
            {
                sum_fin_op += +$(this).parent().next().text(); 
            }
           
            // Calculation result
            var sum_of_op  = parseFloat($('#sw_opr').text())+parseFloat($('#fin_opr').text());
            $("#mmr_result").text(parseFloat((sum_p)/(sum_of_op)).toFixed(2));
        });

          $("#sw_opr").text(sum_sweing_op);  // Set Sewing Operator value
          $("#fin_opr").text(sum_fin_op);   // Set Finishing Operator value

        // Calculation result
           var sum_of_op  = parseFloat($('#sw_opr').text())+parseFloat($('#fin_opr').text());
           $("#mmr_result").text(parseFloat((sum_p)/(sum_of_op)).toFixed(2));

    });
    function attLocation(loc){
    window.location = loc;
   }

</script>
@endsection