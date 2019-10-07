<style type="text/css">body { font-family: 'bangla', sans-serif;}</style> 

@if (is_array($info) && sizeof($info) > 0)
    <div class="col-xs-12 html-2-pdfwrapper" id="PrintArea">
    <div id="html-2-pdfwrapper">
        <div class="col-sm-12" style="margin:20px auto;border:1px solid #ccc">
            <div class="page-header" style="text-align:right;border-bottom:2px double #666">
                <h3 style="margin:4px 10px">{{ $info['unit_name'] }}</h3>
                <h5 style="margin:4px 10px">{{ $info['status_name'] }}</h5>
            </div>
            <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>AID</th>
                    <th>NAME</th>
                    <th>DATE OF JOIN</th>
                    <th>DESIGNATION</th>
                    <th>GRADE</th>
                    <th>SECTION</th>
                    <th>TRADE</th>
                    <th>DATE OF BIRTH</th>
                    <th>SALARY</th>
                    <th>FLR</th>
                    <th>LINE</th>
                    <th>OT</th>
                    <th>AGE</th>
                    <th>SEX</th>
                    <th>RELIGION</th>
                    <th>DISTRICT</th>
                    <th>EDUCATION</th>
                </tr> 
            </thead>
            <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $report->associate_id }}</td>
                    <td>{{ $report->as_name }}</td>
                    <td>{{ date("d-M-Y", strtotime($report->as_doj)) }}</td>
                    <td>{{ $report->hr_designation_name }}</td>
                    <td>{{ $report->hr_designation_grade }}</td>
                    <td>{{ $report->hr_section_name }}</td>
                    <td>{{ $report->hr_department_name }}</td>
                    <td>{{ $birth_date =$report->as_dob }}</td>
                    <td>{{ $report->ben_current_salary }}</td>
                    <td>{{ $report->hr_floor_name }}</td>
                    <td>{{ $report->hr_line_name }}</td>
                    <td>
                        <?php   if($report->as_ot==0){echo "N ";}
                        else { echo "Y "; }?>
                    </td>
                    <td> 
                         <?php  
                            $age= date("Y") - date("Y", strtotime($birth_date)); 
                            echo $age;
                            ?>


                    </td>
                    <td>{{ $report->as_gender }}</td>
                    <td>{{ $report->emp_adv_info_religion }}</td>
                    <td>{{ $report->dis_name }}</td>
                    <td>{{ $report->education_title}}</td>
                </tr> 
            @empty
                <tr>
                    <td colspan="6" align="center">No user found!</td> 
                </tr>
            @endforelse 
            <!-- ends of report -->
            </tbody>
            </table>
        </div>
      </div>
    </div>
@endif 