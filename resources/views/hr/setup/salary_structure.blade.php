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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Salary Structure </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Salary Structure </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS --> 
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/salary_structure')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
 

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="basic"> Basic(% of Gross)<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" name="basic" id="basic" placeholder="Percentage of Gross Paid as Basic Salary" class="form-control col-xs-12" data-validation="required length number" data-validation-allowing="float" data-validation-length="1-10"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="medical"> Medical <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" name="medical" id="medical" placeholder="Amount Paid for Medical" class="form-control col-xs-12" data-validation="required length number" data-validation-allowing="float" data-validation-length="1-10"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="transport"> Transportation <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" name="transport" id="transport" placeholder="Amount Paid for Transportation" class="form-control col-xs-12" data-validation="required length number" data-validation-allowing="float" data-validation-length="1-10"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="food"> Food <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" name="food" id="food" placeholder="Amount Paid for Food" class="form-control col-xs-12" data-validation="required length number" data-validation-allowing="float" data-validation-length="1-10"/>
                            </div>
                        </div>
 

 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- /.row --> 
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Basic</th>
                                    <th>Medical</th>
                                    <th>Transportation</th>
                                    <th>Food</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($current_structure AS $structure)
                                <tr>
                                    <td>{{ ($structure->basic ? $structure->basic: null) }}</td>
                                    <td>{{ ($structure->medical ? $structure->medical: null) }}</td>
                                    <td>{{ ($structure->transport ? $structure->transport: null) }}</td>
                                    <td>{{ ($structure->food ? $structure->food: null) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

    $('#dataTables').DataTable({
        paging: false,
        // pagingType: "full_numbers" ,
        // searching: false,
        // "lengthChange": false,
        // 'sDom': 't' 

        "sDom": '<"F"tp>'

    }); 


    // $('form').submit(function(e){
    //     // var salary   = parseFloat($('#ben_joining_salary').val()).toFixed(2);
    //     var basic    = parseFloat($('#basic').val());
    //     var house    = parseFloat($('#house_rent').val());
    //     var medical  = parseFloat($('#medical').val());
    //     var transport= parseFloat($('#transport').val());
    //     var food     = parseFloat($('#food').val()); 

    //     var total= parseFloat(basic+house+medical+transport+food).toFixed(2);
    //     // alert(total);
    //     if(total != 100.00){
    //         alert("Invalid Calculation! Please Check...");
    //         e.preventDefault();
    //     }
    // });
});
</script>
@endsection