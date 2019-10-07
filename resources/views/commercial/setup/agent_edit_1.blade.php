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
                <li class="active"> Agent Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Agent Edit</small></h1>
            </div>
            <div class="col-sm-6 ">
                 {{ Form::open(["url"=>"commercial/setup/agent_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right align-left" for="agent_name" > Agent Name<span style="color: red">&#42;</span> </label>
                         
                          <div class="col-sm-3">
                            <input type="text" name="agent_name" id="agent_name" value="{{$agent->agent_name}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>

                          <label class="col-sm-3 control-label no-padding-right align-left" for="agent_type" > Agent Type<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-3">
                             <select id="agent_type" name="agent_type" class="col-xs-12">
                                @if($agent->agent_type)
                                    <option>{{$agent->agent_type}}</option>
                                    <option>Select a Type</option>
                                    <option value="C&F">C&F</option>
                                    <option value="Export">Export</option>
                                @else
                                    <option>Select a Type</option>
                                    <option value="C&F">C&F</option>
                                    <option value="Export">Export</option>
                                @endif
                             </select>
                          </div>
                   
                        </div>
                        <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right align-left" for="contact_person" >Contact Person<span style="color: red">&#42;</span> </label>
                             <div class="col-sm-9">
                                     <textarea name="contact_person" class="form-control" id="contact_person" 
                                        data-validation="required length custom" 
                                        data-validation-length="1-145">{{$agent->contact_person}} </textarea>
                             </div>
                        </div>

                        <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right align-left" for="agent_address" >Address<span style="color: red">&#42;</span> </label>
                             <div class="col-sm-9">
                                        <textarea name="agent_address" class="form-control" id="agent_address" 
                                         data-validation="required length custom" 
                                        data-validation-length="1-145">{{$agent->address}} </textarea>
                             </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <input type="hidden" name="agent_id" value="{{$agent->id}}">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                      {{-- End Form --}}
                      </form> 
            </div>
        </div>


    </div>   {{-- Main Content inner end --}}
</div>       {{-- Main Content End --}}
@endsection