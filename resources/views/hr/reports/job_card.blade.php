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
                <li class="active"> Job Card </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <?php $type='job_card'; ?>
            @include('hr/reports/attendance_radio')

            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Job Card </small></h1>
            </div>
            <div class="row">
                <form role="form" method="get" action="{{ url('hr/reports/job_card') }}" class="attendanceReport" id="attendanceReport">
                    <div class="col-sm-10"> 

                        <div class="col-sm-8">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    {{ Form::select('associate', [Request::get('associate') => Request::get('associate')], Request::get('associate'), ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate', 'class'=> 'associates no-select col-xs-12', 'data-validation'=>'required']) }}  
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="month" id="month" class="monthpicker col-xs-12" value="{{ Request::get('month') }}" data-validation="required" placeholder="Month" autocomplete="off" />
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="year" id="year" class="yearpicker col-xs-12" value="{{ Request::get('year') }}" data-validation="required" placeholder="Year" autocomplete="off" />
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fa fa-search"></i>
                                Search
                            </button>
                            @if (!empty(request()->associate)
                            && !empty(request()->month)
                            && !empty(request()->year)
                            ) 
                            <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                <i class="fa fa-print"></i> 
                            </button> 
                            <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                <i class="fa fa-file-pdf-o"></i> 
                            </a>
                            <button type="button"  id="excel"  class="showprint btn btn-success btn-sm" title="Excel">
                                <i class="fa fa-file-excel-o" style="font-size:14px"></i>
                           </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12" id="PrintArea">
                    <!-- PAGE CONTENT BEGINS -->
                <?php
                if (!empty(request()->associate)
                && !empty(request()->month)
                && !empty(request()->year)
                ) {

                $total_attend   = 0;
                $total_overtime = 0;
                $associate = request()->associate; 
                $tempdate= "01-".request()->month."-".request()->year;
                

                $month = date("m", strtotime($tempdate));
                $year  = request()->year;
                #------------------------------------------------------
                // ASSOCIATE INFORMATION
                $fetchUser = DB::table("hr_as_basic_info AS b")
                    ->select(
                      "b.associate_id AS associate",
                      "b.as_name AS name",
                      "b.as_doj AS doj",
                      "b.as_ot",
                      "u.hr_unit_id AS unit_id",
                      "u.hr_unit_name AS unit",
                      "s.hr_section_name AS section",
                      "d.hr_designation_name AS designation"
                    )
                    ->leftJoin("hr_unit AS u", "u.hr_unit_id", "=", "b.as_unit_id")
                    ->leftJoin("hr_section AS s", "s.hr_section_id", "=", "b.as_section_id")
                    ->leftJoin("hr_designation AS d", "d.hr_designation_id", "=", "b.as_designation_id")
                    ->where("b.associate_id", "=", $associate);

                if ($fetchUser->exists())
                {
                    $info = $fetchUser->first();
                ?>

                <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                    <div class="page-header" style="border-bottom:2px double #666">
                        <h2 style="margin:4px 10px">{{ $info->unit }}</h2>
                        <h5 style="margin:4px 10px">For the month of {{ request()->month }} - {{ request()->year }}</h5>
                    </div>
                    <table class="table" style="width:100%;border:1px solid #ccc;margin-bottom:0;font-size:14px;text-align:left"  cellpadding="5">
                        <tr>
                            <th style="width:50%">
                               <p style="margin:0;padding:4px 10px"><strong>ID </strong> # {{ $info->associate }}</p>
                               <p style="margin:0;padding:4px 10px"><strong>Name </strong>: {{ $info->name }}</p>
                               <p style="margin:0;padding:4px 10px"><strong>DOJ </strong>: {{ date("d-m-Y", strtotime($info->doj)) }}</p> 
                            </th>
                            <th>
                               <p style="margin:0;padding:4px 10px"><strong>Section </strong>: {{ $info->section }} </p> 
                               <p style="margin:0;padding:4px 10px"><strong>Designation </strong>: {{ $info->designation }} </p> 
                            </th>
                        </tr> 
                    </table>

                    <table class="table" style="width:100%;border:1px solid #ccc;font-size:13px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Present Status</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>OT Hour</th>
                            </tr> 
                        </thead>

                    <?php
                        $date= ($year."-".$month."-"."01");
                        $startDay= date('Y-m-d', strtotime($date));
                        $endDay= date('Y-m-t', strtotime($date));
                        $toDay= date('Y-m-d');
                        //If end date is after current date then end day will be today

                        if($endDay>$toDay) $endDay= $toDay;
                        $totalDays= (date('d', strtotime($endDay))-date('d', strtotime($startDay)));
                        //total attends and total overtime 
                        $total_ot_minutes=0;
                        $total_attends= 0;
                        $x=1;
                        for($i=0; $i<=$totalDays; $i++) {

                            $date= ($year."-".$month."-".$x++);
                            $startDay= date('Y-m-d', strtotime($date));

                            $data= Attendance2::track($info->associate, $info->unit_id, $startDay, $startDay);

                            $total_ot_minutes+= $data->overtime_minutes;

                             ?>
                             <tbody> 
                            <tr>
                              <td>{{ $startDay }}</td>
                              <td>
                                <?php 
                                if($data->leaves== true){
                                    echo $data->leave_type." Leave";
                                }
                                else if($data->holidays>=0){
                                    if($data->holidays==1) {

                                        echo "Weekend(General)";
                                        $total_attends++;
                                    }
                                    else if($data->holidays==2){
                                        echo "Weekend(OT)";
                                        $total_attends++;
                                    }
                                    else if($data->holidays==0) echo $data->holiday_comment;
                                }
                                else{
                                    if($data->attends){
                                        echo "P";
                                        $total_attends++;
                                    }
                                    else {
                                        echo "A";
                                    }
                                }
                                ?>  
                              </td>
                              <td>{{!empty($data->in_time)?$data->in_time:null}}</td>
                              <td>{{!empty($data->out_time)?$data->out_time:null}}</td>
                              <td>{{ (($info->as_ot ==1)? $data->overtime_time:  "") }}</td>
                            </tr> 
                          </tbody>
                            
                          <?php
                           $startDay= date("Y-m-d", strtotime("$startDay +1 day"));
                        }
                        // dd($total);
                    ?>

                    <tfoot style="border-top:2px double #999">
                            <tr>
                                <th style="text-align:right">Attend</th>
                                <th>{{ $total_attends }}</th>
                                <th></th>
                                <th style="text-align:right">Total</th>
                                @if($info->as_ot==1)
                                <th>{{ floor($total_ot_minutes/60) }}:{{ (($total_ot_minutes%60)>0)? ($total_ot_minutes%60):"00"}}</th>
                                @else
                                <th></th>
                                @endif
                            </tr>
                    </tfoot>
                    <?php 
                    }

                    }
                    ?>
                    </table>
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
// excel conversion -->
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
