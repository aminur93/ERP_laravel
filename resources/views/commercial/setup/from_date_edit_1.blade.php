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
                <li class="active"> From Date </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> From Date Update</small></h1>
            </div>

            <div class="row">           
                <div class="col-sm-6">
                    <h5 class="page-header">Update From Date</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"commercial/setup/from_date_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="from_date" > From Date<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="from_date" id="from_date" value="{{$from_date_data->from_date }}" class="col-xs-12" data-validation="required" />
                          </div>
                        </div>  
 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                               <input type="hidden" name="from_date_id" value="{{$from_date_data->id}}">  
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
        </div><!-- /.page-content -->
    </div>
</div>

@endsection