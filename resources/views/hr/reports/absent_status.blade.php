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
                <li class="active"> Absent Status </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <?php $type='absent'; ?>
                  @include('hr/reports/attendance_radio')
            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Absent Status </small></h1>
            </div>
            <div class="row">
                @include('inc/message')
                <div class="row">
                    <form role="form" method="get" action="{{ url('hr/reports/absent_status') }}">
                        <div class="col-sm-10"> 
                            <div class="form-group">
                                <div class="col-sm-4">
                                    {{ Form::select('associate_id', [Request::get('associate_id') => Request::get('associate_id')], Request::get('associate_id'), ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate_id', 'class'=> 'associates no-select col-xs-12', 'data-validation'=>'required']) }}  
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="absent_from" id="absent_from" class="col-xs-12 monthYearpicker" value="{{ Request::get('absent_from') }}" data-validation="required" placeholder="Absent From" />
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="absent_to" id="absent_to" class="col-xs-12 monthYearpicker" value="{{Request::get('absent_to')}}" data-validation="required" placeholder="Absent to" />
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        Search
                                    </button>
                                    @if(!empty(request()->associate_id) && !empty(request()->absent_from) && !empty(request()->absent_to))
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
                <br><br>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                    @if(!empty(request()->associate_id) && !empty(request()->absent_from) && !empty(request()->absent_to))
                    <div class="col-xs-12" id="PrintArea">
                        <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                            <div class="page-header" style="text-align:left;border-bottom:2px double #666">
                                <h2 style="margin:4px 10px">{{ !empty($report->unit)?$report->unit:null }}</h2>
                                <h5 style="margin:4px 10px">From {{ !empty($report->from)?$report->from:null}} To {{ !empty($report->to)?$report->to:null }}</h5>
                                <p style="margin:4px 5px; font-size: 10px;">As on {{ !empty($report->print_date)?$report->print_date:null}}</hp>
                            </div>
                            <table class="table" style="width:100%;border:1px solid #ccc;margin-bottom:0;font-size:14px;text-align:left"  cellpadding="5">
                                <tr>
                                    <th style="width:40%">
                                       <p style="margin:0;padding:4px 10px"><strong>ID </strong> # {{ !empty($report->associate_id)?$report->associate_id:null }}</p>
                                       <p style="margin:0;padding:4px 10px"><strong>Name </strong>: {{ !empty($report->name)?$report->name:null }}</p>
                                    </th>
                                    <th>
                                       <p style="margin:0;padding:4px 10px"><strong>Date of Join </strong>: {{ !empty($report->doj)?date("d-F-Y", strtotime($report->doj)):null }} </p> 
                                       <p style="margin:0;padding:4px 10px"><strong>Designation </strong>: {{ !empty($report->designation)?$report->designation:null }} </p> 
                                    </th>
                                </tr> 
                            </table>

                            <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Absent</th>
                                    <th>Leave</th>
                                    <th>Late</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php
                                    if (!empty($report->month) && is_array($report->month) && sizeof($report->month)>0 ){
                                        for($i=0;$i<sizeof($report->month);$i++)
                                        {
                                            echo "<tr><td>".$report->month[$i]."</td><td>".$report->year[$i]."</td><td>".$report->absent[$i]."</td><td>".$report->leave[$i]."</td><td>".$report->late[$i]."</td></tr>";
                                        }
                                    }
                                ?>
 
                            <!-- ends of report -->
                            </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                <!-- //ends of info  -->
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
