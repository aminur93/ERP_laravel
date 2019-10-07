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
                    <a href="#">Time & Attendance</a>
                </li> 
                <li class="active">Manual Attendance</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance<small> <i class="ace-icon fa fa-angle-double-right"></i> Manual Attendance </small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12"> 
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')
                    <div class="att_status_section">
                        <p style="color: red;">Your file is being processed! Please don't close this page</p>
                        <div class="process_section">
                            <div class="progress">
                              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 1%" id="progress-bar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <input type="hidden" name="unit" value="{{$unit}}">
                            <input type="hidden" name="array_data_count" value="{{$arrayDataCount}}">
                            
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>


<script>
var url = "{{ url('/') }}";
var unit=-1;

var perPage=0;
var cur=0;
var nxt =0;
var temp=0;
var per=0;
var _token = $('input[name="_token"]').val();
    $(document).ready(function()
    {   
       // console.log($('input[name="unit"]').val());
        setTimeout(() => {
            unit = $('input[name="unit"]').val();
            var totalDataLength = $('input[name="array_data_count"]').val();
             perPage = 100;
            if(totalDataLength > perPage){
               perPage = 100;
            }
            else{
               perPage = totalDataLength;
            }
            
            var lDataLength = (Math.round(totalDataLength / perPage) + 1);
            
            if(lDataLength>=100){
                per=(100/lDataLength);
                //nxt= Math.ceil(lDataLength/100)+1;
                nxt= (lDataLength/100);
            }
            else{
                //per= (Math.ceil(100 / lDataLength));
                per= (100 / lDataLength);
                
                nxt= (lDataLength / 100);
            }
             rec(lDataLength, 0);      
        }, 1000);

    });
    function rec(lDataLength, i){
        if(i== lDataLength ){
            $("#progress-bar").animate({width: 100+"%"});
            $("#progress-bar").text(100+"%");
            setTimeout('', 1500)
            window.location.href = url+'/hr/timeattendance/attendance_manual';
        }
        
        $.ajax({
            url: url+'/hr/timeattendance/attendance_process_wise',
            type: "get",
            data: { 
              _token : _token,
              unit : unit,
              start:i,
              per_page : perPage
            },
            success: function(response){
                
                if(response == 'success'){
                    cur = cur + per;
                    console.log("req ="+i+" percent="+cur);
                    if(cur<100){
                        $("#progress-bar").animate({width: cur+"%"});
                        $("#progress-bar").text( parseInt(cur)+"%");
                    }
                    rec(lDataLength, i+1);
                }else{
                    console.log(response);
                }
            }
        });
    }
</script>

@endsection