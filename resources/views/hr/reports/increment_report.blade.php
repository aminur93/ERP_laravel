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
                <li class="active"> Increment Report </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
           <?php $type='increment'; ?> 
             @include('hr/reports/attendance_radio')

            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Increment Report </small></h1>
            </div>
            <div class="row">
                @include('inc/message')
                <form role="form" method="get" class="form-horizontal" action="{{ url('hr/reports/increment_report') }}" class="incrementReport" id="incrementReport">
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="unit_id"> Unit<span style="color: red">&#42;</span></label>
                                <div class="col-sm-9">
                                    {{ Form::select('unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="floor_id">Floor<span style="color: red">&#42;</span></label>
                                <div class="col-sm-9">
                                    {{ Form::select('floor_id', !empty(Request::get('floor_id'))? $floorList:[], Request::get('floor_id'), ['placeholder'=>'Select Floor', 'id'=>'floor_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} 
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="line_id">Line</label>
                                <div class="col-sm-9">
                                    {{ Form::select('line_id', !empty(Request::get('line_id'))? $lineList:[], Request::get('line_id'), ['placeholder'=>'Select Line', 'id'=>'line_id', 'class'=> 'col-xs-12']) }} 
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="hr_letter_as_id">ID</label>
                                <div class="col-sm-9">
                                    {{ Form::select('associate_id', [Request::get('associate_id') => Request::get('associate_id')], Request::get('associate_id'),['placeholder'=>'Select Associate\'s ID', 'id'=>'associate_id',  'class'=> 'associates no-select col-xs-12', 'data-validation'=>'required']) }} 
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group" style="visibility: hidden;">
                                <div class="col-sm-9">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <button type="submit"  id="generate" class="btn btn-primary btn-sm" ><i class="fa fa-search"></i>Generate</button>
                                    @if(!empty(Request::get('associate_id')))
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
                        </div>
                    </div>
                </form>
            </div>
            <br><br>

             @if(!empty(Request::get('associate_id')) || !empty(Request::get('unit_id')))
            <div id="html-2-pdfwrapper" class="row">
                <div class="col-sm-10" id="PrintArea" style="float: left;">
                    <table border="1" cellpadding="4" cellspacing="0" width="100%" style="margin-bottom: 10px;">
                        <th style="font-size: 18px; text-align: center;">Salary/Wages Increment Status</th>
                    </table>

                   <table border="1" cellpadding="4" cellspacing="0" width="100%" style="margin-bottom: 10px; float: left;">
                        <tr>
                            <td>
                                <div class="col-xs-12">
                                <label class="col-sm-4 control-label no-padding-right">ID No:</label>
                                <span class="col-sm-8">{{ $info->associate_id}}</span>
                            </div>
                            <div class="col-xs-12">
                                <label class="col-sm-4 control-label no-padding-right">Name:</label>
                                <span class="col-sm-8">{{ $info->as_name}}</span>
                            </div>
                            <div class="col-xs-12">
                                <label class="col-sm-4 control-label no-padding-right">Joining Designation:</label>
                                <span class="col-sm-8">{{ $info->hr_designation_name}}</span>
                            </div>
                            </td>
                            <td>
                                <div class="col-xs-12">
                                <label class="col-sm-4 control-label no-padding-right">Date of Join:</label>
                                <span class="col-sm-8">{{$info->as_doj}}</span>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-sm-4 control-label no-padding-right">Section:</label>
                                <span class="col-sm-8">{{$info->hr_section_name}}</span>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-sm-4 control-label no-padding-right">Present Designation:</label>
                                <span class="col-sm-8">{{$info->hr_designation_name}}</span>
                            </div>
                            </td>
                        </tr>
                    </table>
                    <table border="1" cellpadding="4" cellspacing="0" width="100%" style="margin-bottom: 30px;">
                        <thead>
                            <th colspan="10" style="text-align: center; font-size: 12px;">Salary/wages increment</th>
                            <th colspan="2" style="text-align: center; font-size: 12px;">Designation Changed</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Sl</th>
                                <th>Inc. Amout</th>
                                <th>Reason</th>
                                <th>Eff. Date</th>
                                <th>Gross</th>
                                <th>Basic</th>
                                <th>H.Rent</th>
                                <th>Medical</th>
                                <th>Conv.</th>
                                <th>Food</th>
                                
                                <th>Eff. Date</th>
                                <th>Designation</th>
                            </tr>
                            
                            <?php 
                                for($i=0; $i<$ret; $i++){
                                    echo "<tr>
                                        <td>".$oVal->sl[$i]."</td>
                                        <td>".$oVal->increment_amount[$i]."</td>
                                        <td>".$oVal->reason[$i]."</td>
                                        <td>".$oVal->incEfDate[$i]."</td>
                                        <td>".$oVal->gross[$i]."</td>
                                        <td>".$oVal->basic[$i]."</td>
                                        <td>".$oVal->house[$i]."</td>
                                        <td>".$oVal->medical[$i]."</td>
                                        <td>".$oVal->conv[$i]."</td>
                                        <td>".$oVal->food[$i]."</td>
                                        <td>".$oVal->pomEfDate[$i]."</td>
                                        <td>".$oVal->designation[$i]."</td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                    </table> 
                </div>
            </div>
            @endif 
        </div><!-- /.page-content -->
    </div>
</div>
<script src="{{ asset('assets/js/excel/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/excel/jquery.tabletoCSV.js')}}"></script>
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
    //associate select with or without selecting unit, floor, line
    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/reports/search_associate") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term,
                    unit_id: $("#unit_id").val(),
                    floor_id: $("#floor_id").val(),
                    line_id: $("#line_id").val()
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

    $('#unit_id').on("change", function(){
         $("#floor_id").html("");
         $("#line_id").html("");
         $("#associate_id").html("");
        $.ajax({
            url : "{{ url('hr/reports/floor_by_unit') }}",
            type: 'get',
            data: {unit : $(this).val()},
            success: function(data)
            {
                $("#floor_id").html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
    var unit= $("#unit_id");
    var floor= $("#floor_id");
    floor.on("change", function(){
        $("#line_id").html("");
         $("#associate_id").html(""); 
        $.ajax({
            url : "{{ url('hr/recruitment/employee/idcard/line_list_by_unit_floor') }}",
            type: 'get',
            data: {unit : unit.val(), floor: floor.val()},
            success: function(data)
            {
                $("#line_id").html(data.lineList);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    });
     $("#line_id").on("change",function(){
        $("#associate_id").html("");
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
