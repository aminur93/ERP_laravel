<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
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