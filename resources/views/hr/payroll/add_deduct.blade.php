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
                    <a href="#">Payroll</a>
                </li> 
                <li class="active">Add/Deduct(Salary) Bulk Upload</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Payroll<small> <i class="ace-icon fa fa-angle-double-right"></i> Add/Deduct(Salary) Bulk Upload</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12"> 
                    <!-- Display Erro/Success Message -->
                    @include('inc/message')
                </div>

                <div class="col-sm-8 col-sm-offset-2">
                    <h4 class="page-header"> Bulk Upload</h4>
                    @if (Session::has('status') && Session::has('value'))
                    
                    <div class="process_section">
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" id="progress-bar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    @else
                    <div class="upload_section">
                        {{ Form::open(['url'=>'hr/payroll/add_deduct', 'files' => true,  'class'=>'form-horizontal']) }}

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="file">Salary Add/Deduct File <span style="font-size: 9px">(only<strong>.xls/xlsx</strong> file supported)</span> </label>
                                <div class="col-sm-5">
                                    <input type="file" name="file" id="file" class="col-xs-12" data-validation="required" autocomplete="off" />
                                </div>
                            </div> 
                            <br/>
                            <br/>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-xs">
                                        <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                    </button>&nbsp; &nbsp; &nbsp;
                                    
                                    <!--<a class="btn btn-success btn-xs" type="button" id="process" href="{{ url('hr/timeattendance/temporary_data_process/0') }}">-->
                                    <!--    <i class="ace-icon fa fa-spinner bigger-110"></i> Process-->
                                    <!--</a>-->
                                    <button type="submit" class="btn btn-info btn-xs" id="upload" type="button">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Upload
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    @endif
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script>
</script>
@endsection