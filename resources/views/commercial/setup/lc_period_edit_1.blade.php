@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li> 
                <li>
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> L/C Period Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> L/C Period Edit</small></h1>
            </div>
            <!-- L/C Type Form -->
            <div class="col-xs-12">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="row">
                    
                    <div class="col-sm-6 ">
                        <h5 class="page-header">Edit L/C Period</h5>
                        <!-- PAGE CONTENT BEGINS -->
                        {{ Form::open(["url"=>"commercial/setup/lc_period_update", "class"=>"form-horizontal"]) }}

                            <div class="form-group">
                                 <label class="col-sm-3 control-label no-padding-right align-left" for="lc_period_update" >L/C Period<span style="color: red">&#42;</span> </label>
                                 <div class="col-sm-9">
                                    <input type="number" name="lc_period_update" id="lc_period_update" value="{{ $lcperiod->lc_period_days }}" placeholder="Enter L/C Period (Days)" class="col-xs-12" data-validation="required length custom" data-validation-length="1-11" />  
                                 </div>
                            </div>  
     
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9"> 
                                    <input type="hidden" name="lc_period_id" value="{{ $lcperiod->id }}">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Update
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
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  
    $('#dataTables').DataTable(); 
});
</script>
@endsection