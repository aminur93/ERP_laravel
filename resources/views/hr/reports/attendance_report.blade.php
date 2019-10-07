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
            <?php $type='attendance'; ?>
         
                 @include('hr/reports/attendance_radio')
             <div class="page-header">
                <h1>Reports<small><i class="ace-icon fa fa-angle-double-right"></i> Attendance Report</small></h1>
            </div>
            <div class="row">
                <form role="form" method="get" action="{{ url('hr/reports/attendance_report') }}">
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
                                @if (!empty($info->worker_attendance)) 
                                <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                    <i class="fa fa-print"></i> 
                                </button>  
                                <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" title="PDF" class="btn btn-danger btn-sm">
                                    <i class="fa fa-file-pdf-o"> </i> 
                                </a>
                                <button type="button"  id="excel"  class="showprint btn btn-success btn-sm"><i class="fa fa-file-excel-o" style="font-size:14px"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                @include('inc/message')
                <div class="col-xs-12" id="PrintArea" style="margin:20px auto">
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

// excel conversion -->
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


   function attLocation(loc){
    window.location = loc;
   }
</script>
@endsection