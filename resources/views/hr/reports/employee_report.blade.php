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
                <li class="active"> Employee Report </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <?php $type='employee_report'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Employee Report </small></h1>
            </div>
            <div class="row">
                {{ Form::open(['url'=>'hr/reports/employee_report', 'method'=>'get']) }}
                    <div class="col-sm-10"> 
                        <div class="form-group">
                            <div class="col-sm-4">
                                {{ Form::select('unit', $unitList, null, ['placeholder'=>'Select Unit', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }}  
                            </div>
                            <div class="col-sm-4">
                                {{ Form::select('status', $statusList, null, ['placeholder'=>'Select Status', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }}  
                            </div> 
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                @if (!empty(request()->unit)
                                && !empty(request()->status)
                                )  
                                <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                    <i class="fa fa-print"></i>  
                                </button> 

                                <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                    <i class="fa fa-file-pdf-o"> </i> 
                                </a>
                                <button type="button" title="EXCEL"  id="excel"  class="showprint btn btn-success btn-sm"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                </button>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-10">
                        <div class="text-right"> 
                           </div>
                    </div>


                    </div> 

                {{ Form::close() }}
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                @if (is_array($info) && sizeof($info) > 0)  

                    <div class="col-xs-12 html-2-pdfwrapper" id="PrintArea">
                    <div id="html-2-pdfwrapper">
                        <div class="col-sm-12" style="margin:0 20px 20px 20px auto;border:1px solid #ccc">
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
                                    <td> 
                                        {{ ($loop->index + 1) }}
                                    </td>
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
                                    <td colspan="18" align="center">No user found!</td> 
                                </tr>
                            @endforelse 
                            <!-- ends of report -->
                            </tbody>
                            </table>
                        </div>
                    </div>
                    </div>  
                @endif 
                <!-- //ends of info  -->
            </div> 
        </div><!-- /.page-content -->
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

// excel conversion -->
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
