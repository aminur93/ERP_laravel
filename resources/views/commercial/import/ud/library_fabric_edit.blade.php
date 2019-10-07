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
                    <a href="#"> Import </a>
                </li>
                <li>
                    <a href="#"> UD System </a>
                </li> 
                <li class="active">  Fabric & Pocketing Library Edit </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Edit Fabric & Pocketing Library</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-sm-offset-2">
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"comm/import/ud_master/library_fabric_update", "class"=>"form-horizontal"]) }}
                    <input type="hidden" name="id" value="{{ $fabric->id }}">
                        <!-- Code -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_code" > Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-5">
                                <input type="text" name="ud_library_fab_pock_code" id="ud_library_fab_pock_code" placeholder="Enter" class="col-xs-12" value="{{ $fabric->ud_library_fab_pock_code }}" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                            </div>
                        </div> 

                        <!-- Fabric Comp. -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_fab_comp" > Fabric Comp.<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-5">
                                <input type="text" name="ud_library_fab_pock_fab_comp" id="ud_library_fab_pock_fab_comp" placeholder="Fabric Comp." class="col-xs-12" value="{{ $fabric->ud_library_fab_pock_fab_comp }}" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                            </div>
                        </div> 

                        <!-- Fabric Desc. -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_fab_desc" > Fabric Desc.</label>
                            <div class="col-sm-5">
                                <textarea type="text" name="ud_library_fab_pock_fab_desc" id="ud_library_fab_pock_fab_desc" placeholder="Fabric Desc." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"
                                data-validation-optional="true" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">{{ $fabric->ud_library_fab_pock_fab_desc }}</textarea>
                            </div>
                        </div>

                        <!-- Fabric Cons. -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_fab_cons" > Fabric Cons.<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-5">
                                <input type="text" name="ud_library_fab_pock_fab_cons" id="ud_library_fab_pock_fab_cons" value="{{ $fabric->ud_library_fab_pock_fab_cons }}" placeholder="Fabric Cons." class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                            </div>
                        </div> 

                        <!-- Width. -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="ud_library_fab_pock_width" > Width<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-5">
                                <input type="text" name="ud_library_fab_pock_width" id="ud_library_fab_pock_width" value="{{ $fabric->ud_library_fab_pock_width }}" placeholder="Width" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                            </div>
                        </div> 
                     
                        <!-- SUBMIT -->
                        <div class="form-group">
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="space-4"></div>
                            <div class="clearfix form-actions">
                                <div class="col-sm-offset-2 col-sm-10"> 
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> Update
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                    </button>
                                </div>
                            </div> 
                        </div>
                    {{ Form::close() }}
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

@endsection