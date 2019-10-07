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
                <li class="active"> Passbook Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Passbook Edit</small></h1>
            </div>
            <div class="col-sm-6 ">
                 {{ Form::open(["url"=>"commercial/setup/passbook_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="volume_no" >Volume No<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                            <input type="text" name="volume_no" id="volume_no" value="{{$passbook->volume_no}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="page_no" >Page Name<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                            <input type="text" name="page_no" id="page_no" value="{{$passbook->page_no}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                          </div>
                        </div>  
 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                  <input type="hidden" name="passbook_id" value="{{$passbook->id}}">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                       
                    </form> 
            </div>
        </div>

    </div>  {{-- main content inner end --}}
</div>      {{-- main content end --}}

@endsection