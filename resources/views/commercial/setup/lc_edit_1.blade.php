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
                <li class="active"> L/C Type  </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> L/C Type Update</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Update L/C Type</h5>
                    {{Form::open(['url'=>'commercial/setup/lc_update',"class"=>"form-horizontal"] )}}
                      <div class="form-group">
                         <label class="col-sm-3 control-label no-padding-right align-left" for="lc_type" >L/C Type<span style="color: red">&#42;</span> </label>
                         <div class="col-sm-9">
                            <input type="text" name="lc_type" id="lc_type" placeholder="Enter L/C Type Name" value="{{$lctype->lc_type_name}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/> 
                         </div>
                         
                      </div>
                    {{-- submitting --}}
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <input type="hidden" name="lctype_id" value="{{ $lctype->id }}"> 
                                <button class="btn btn-info" type="submit">
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
        </div>

    </div>
</div>
@endsection