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
                <li class="active"> Monthly Increment </li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
              <?php $type='m_increment'; ?>
              @include('hr/reports/attendance_radio')
     

            <div class="page-header">
                <h1>Reports<small> <i class="ace-icon fa fa-angle-double-right"></i> Monthly Increment </small></h1>
            </div>
            <div class="row">
                @include('inc/message')
                <div class="row">
                    <form role="form" method="get" action="{{ url('hr/reports/monthy_increment') }}">
                        <div class="col-sm-10"> 
                            <div class="form-group">
                                <div class="col-sm-3">
                                    {{ Form::select('unit_id', $unitList, null, ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }}  
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::select('department_id', $deptList, null, ['placeholder'=>'Select Department', 'id'=>'department_id', 'class'=> 'col-xs-12']) }}  
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="month" id="month" class="col-xs-12 monthYearpicker" value="{{ Request::get('month') }}" data-validation="required" placeholder="Month-y" />
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search"></i>
                                        Search
                                    </button>
                                    @if(!empty(request()->unit_id) && !empty(request()->month))
                                    <button type="button" onClick="printMe('PrintArea')" class="btn btn-warning btn-sm" title="Print">
                                        <i class="fa fa-print"></i> 
                                    </button>
                                    <a href="{{request()->fullUrl()}}&pdf=true" target="_blank" class="btn btn-danger btn-sm" title="PDF">
                                        <i class="fa fa-file-pdf-o"></i> 
                                    </a>
                                    <button type="button"  id="excel"  class="showprint btn btn-success btn-sm">
                                    <i class="fa fa-file-excel-o" style="font-size:14px"></i>
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

                @if(!empty(request()->unit_id) && !empty(request()->month))

                    <div class="col-xs-12" id="PrintArea">
                        <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
                            <div class="page-header" style="text-align:left;border-bottom:2px double #666">

                                <h2 style="margin:4px 10px; font-weight: bold;  text-align: center;">{{ !empty($unit)?$unit:null}}</h2>
                                <h4 style="margin:4px 10px; text-align: center; ">Increment List Month of <font style="font-weight: bold; font-size: 16px;">{{ !empty($month)?$month:null }}</font></h4>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="60%">
                                                <h5 style="margin:4px 5px; font-size: 12px;"><font style="font-weight: bold; font-size: 12px;">Print Date & Time: </font><?php echo date('d-m-Y H:i:s') ?></h5>
                                            </td>
                                            <td>
                                                <h5 style="margin:4px 5px; font-size: 10px; text-align: right;"><font style="font-weight: bold;">Page:</font></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @if(!empty($departments))
                                @foreach($departments AS $department)
                                    <?php $count=0; ?>
                                    <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                                        <thead>
                                            <tr>
                                                <th colspan="3">Department</th>
                                                <th colspan="15">{{ !empty($department->hr_department_name)?$department->hr_department_name:null }}</th>
                                            </tr>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Pid</th>
                                                <th>Name</th>
                                                <th>D.O.J</th>
                                                <th>Dsgn.</th>
                                                <th>Section</th>
                                                <th>Line</th>
                                                <th>Edu.</th>
                                                <th>Ab. without Pay</th>
                                                <th>Ab. with Pay</th>
                                                <th>Effi</th>
                                                <th>Personal Attribute</th>
                                                <th>Last Inc (Tk.)</th>
                                                <th>Last Inc Date</th>
                                                <th>Status A/M</th>
                                                <th>Tot. Pay</th>
                                                <th>Incr Amt (Tk.)</th>
                                                <th>Propose Salary</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            @foreach($info AS $emp)
                                            @if($emp->as_department_id== $department->as_department_id)
                                            <tr>
                                                <?php $count++;  ?>
                                                <td>{{ $count }}</td>
                                                <td>{{ !empty($emp->associate_id)?$emp->associate_id:null }}</td>
                                                <td>{{ !empty($emp->as_name)?$emp->as_name:null }}</td>
                                                <td>{{ !empty($emp->as_doj)?$emp->as_doj:null }}</td>
                                                <td>{{ !empty($emp->hr_designation_name)?$emp->hr_designation_name:null }}</td>
                                                <td>{{ !empty($emp->hr_section_name)?$emp->hr_section_name:null }}</td>
                                                <td>{{ !empty($emp->hr_line_name)?$emp->hr_line_name:null }}</td>
                                                <td>{{ !empty($emp->edu)?$emp->edu:null }}</td>
                                                <td>{{ !empty($emp->without_pay)?$emp->without_pay:null }}</td>
                                                <td>{{ !empty($emp->with_pay)?$emp->with_pay:null }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ !empty($emp->lat_inc_amount)?$emp->lat_inc_amount:null }}</td>
                                                <td>{{ !empty($emp->last_inc_date)?$emp->last_inc_date:null }}</td>
                                                <td>{{ !empty($emp->status)?$emp->status:null }}</td>
                                                <td>{{ !empty($emp->total_pay)?$emp->total_pay:null }}</td>
                                                <td>{{ !empty($emp->inc_amount)?$emp->inc_amount:null }}</td>
                                                <td></td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td colspan="16"><?php echo $count; $count=0;  ?></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endforeach
                                @endif
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

// $(document).ready(function(){ 

//     $('#unit_id').on("change", function(){ 
//         $.ajax({
//             url : "{{ url('hr/reports/department_by_unit') }}",
//             type: 'get',
//             data: {unit : $(this).val()},
//             success: function(data)
//             {
//                 $("#department_id").html(data);
//             },
//             error: function()
//             {
//                 alert('failed...');
//             }
//         });
//     });
// });


// excel conversion -->

$(function(){
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
