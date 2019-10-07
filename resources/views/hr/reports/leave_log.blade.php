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
        <li class="active"> Leave Log</li>
      </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content"> 
            <?php $type='leave_log'; ?>
            @include('hr/reports/attendance_radio')
            <div class="page-header">
        <h1>Reports<small><i class="ace-icon fa fa-angle-double-right"></i> Leave Log</small></h1>
            </div>
            <div class="row">
                <form role="form" method="get" action="{{ url('hr/reports/leave_log') }}">
                    <div class="col-sm-10"> 
                        <div class="form-group">
                            <div class="col-sm-4">
                                {{ Form::select('associate', [Request::get('associate') => Request::get('associate')], Request::get('associate'), ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate', 'class'=> 'associates no-select col-xs-12', 'data-validation'=>'required']) }}  
                            </div> 
                            <div class="col-sm-4">
                                <input type="text" name="year" id="year" value="{{ Request::get('year') }}" class="yearpicker col-xs-12" data-validation="required" placeholder="Year" />
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                @if (!empty($info)) 
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

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                <div class="col-xs-12" id="PrintArea">
                    @if(!empty($info))
                    <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto">
                        <div class="col-sm-12" style="margin-bottom: 15px;">
                            <h2 style="margin:4px 10px;text-align:center;font-weight:600">{{ $info->unit }}</h2>
                            <h4 style="margin:4px 10px;text-align:center;font-weight:600">Leave Log</h4>
                            <h4 style="margin:4px 10px;text-align:center;font-weight:600">For The Year : {{ request()->year }}</h4>
                        </div>
                        <table class="table" style="width:100%;border:1px solid #ccc;margin-bottom:0;font-size:14px;text-align:left"  cellpadding="5">
                            <tr>
                                <th style="width:40%">
                                   <p style="margin:0;padding:4px 10px"><strong>Name </strong>: {{ $info->name }}</p>
                                   <p style="margin:0;padding:4px 10px"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID </strong>: {{ $info->associate }}</p>
                                </th>
                                <th>
                                   <p style="margin:0;padding:4px 10px"><strong>&nbsp;&nbsp;&nbsp;Designation </strong>: {{ $info->designation }} </p> 
                                   <p style="margin:0;padding:4px 10px"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section </strong>: {{ $info->section }} </p> 
                                   <p style="margin:0;padding:4px 10px"><strong>&nbsp;&nbsp;&nbsp;Date of Join </strong>: {{ date("d-m-Y", strtotime($info->doj)) }}</p> 
                                </th>
                            </tr> 
                        </table>


                        <table class="table" style="width:100%;border:1px solid #ccc;font-size:13px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                          <thead>
                            <tr>
                              <th rowspan="2">Month</th>
                              <th colspan="3">Casual Leave</th>
                              <th colspan="3">Medical Leave</th>
                              <th colspan="3">Meternity Leave</th>
                              <th colspan="3">Earn Leave</th>
                            </tr> 
                            <tr>
                              <th>Due</th>
                              <th>Enjoyed</th>
                              <th>Balance</th>
                              <th>Due</th>
                              <th>Enjoyed</th>
                              <th>Balance</th>
                              <th>Due</th>
                              <th>Enjoyed</th>
                              <th>Balance</th>
                              <th>Due</th>
                              <th>Enjoyed</th>
                              <th>Balance</th>
                            </tr> 
                          </thead>
                          <tbody>
                            <?php
                            $casual_due     = 10;
                            $casual_enjoyed = 0;
                            $casual_balance = 0;
                            $medical_due     = 14;
                            $medical_enjoyed = 0;
                            $medical_balance = 0;
                            $maternity_due     = 112;
                            $maternity_enjoyed = 0;
                            $maternity_balance = 0;
                            $earned_due     = $earned_due?$earned_due:0;
                            $earned_enjoyed = 0;
                            $earned_balance = 0;
                            ?>
                            @if(!empty($leaves) && sizeof($leaves) > 0)
                            @foreach($leaves as $leave)
                            <?php
                                $casual_due     = $casual_due-$casual_enjoyed;
                                $casual_enjoyed = $leave->casual?$leave->casual:0;
                                $casual_balance = $casual_due-$casual_enjoyed;
                                $medical_due     = $medical_due-$medical_enjoyed;
                                $medical_enjoyed = $leave->medical?$leave->medical:0;
                                $medical_balance = $medical_due-$medical_enjoyed;
                                $maternity_due     = $maternity_due-$maternity_enjoyed;
                                $maternity_enjoyed = $leave->maternity?$leave->maternity:0;
                                $maternity_balance = $maternity_due-$maternity_enjoyed;
                                $earned_due     = $earned_due-$earned_enjoyed;
                                $earned_enjoyed = $leave->earned?$leave->earned:0;
                                $earned_balance = $earned_due-$earned_enjoyed;
                            ?>
                            <tr> 
                              <th>{{ $leave->month_name }}</th>
                              <th>{{ $casual_due }}</th>
                              <th>{{ $casual_enjoyed }}</th>
                              <th>{{ $casual_balance }}</th>
                              <th>{{ $medical_due }}</th>
                              <th>{{ $medical_enjoyed }}</th>
                              <th>{{ $medical_balance }}</th>
                              <th>{{ $maternity_due }}</th>
                              <th>{{ $maternity_enjoyed }}</th>
                              <th>{{ $maternity_balance }}</th>  
                              <th>{{ $earned_due }}</th>
                              <th>{{ $earned_enjoyed }}</th>
                              <th>{{ $earned_balance }}</th>   
                            </tr> 
                            @endforeach
                            @endif
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

    })

  function attLocation(loc){
    window.location = loc;
   }  
</script>
@endsection