<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
@if(!empty($info->worker_attendance))
 <div id="html-2-pdfwrapper">  
    <div style="width:100%;float:left;color:lightseagreen;border-bottom:2px solid #ccc; margin:10px auto">
    <div style="width:25%;float:left;display:inline"><br/><br/><strong style="font-size:10px">Print: {{ date("M-d-y h:i a") }}</strong></div>
    <div style="width:50%;float:left;display:inline"> 
        <p style="margin:0;text-align:center;font-size:14px;font-weight:600">{{ $info->unit_name }}</p>
        <p style="margin:0;text-align:center;font-size:11px;font-weight:600">Daily Attendance Report</p>
        <p style="margin:0;text-align:center;font-size:11px;font-weight:600">Date : {{ date("d-F-Y", strtotime($info->date)) }}</p>
    </div>
    <div style="width:25%;float:left;display:inline">&nbsp;</div>
    </div>

  {!! $info->staff_attendance !!}
  <table style="margin-top:0;font-size:9px;" width="100%" cellpadding="0" cellspacing="0" border="1" align="center"> 
    {!! $info->worker_attendance !!}
  </table> 
  {!!$info->non_ot!!}
</div>
@endif