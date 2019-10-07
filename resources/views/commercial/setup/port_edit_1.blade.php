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
                <li class="active"> Port Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Port Edit</small></h1>
            </div>
            <div class="col-sm-6 ">
            {{Form::open(['url'=>'commercial/setup/port_update', "class"=>"form-horizontal"] )}}
            <div class="form-group">
              
                <label class="col-sm-3 control-label no-padding-right align-left" for="country_id" >Country<span style="color: red">&#42;</span> </label>
                 <div class="col-sm-9">
                    <select class="col-sm-12" name="country_id" id="country_id" >
                      @if($port->cnt_id)
                        <option value="{{$port->cnt_id}}" selected="selected">{{$country_name}}</option>
                      @else
                        <option>Select Country</option>
                        
                        @if($country)
                          @foreach($country as $c)
                            <option value="{{$c->cnt_id}}">{{$c->cnt_name}}</option>
                          @endforeach
                        @else
                        Country List Empty
                        @endif

                     @endif   
                    </select>
                 </div>      
            </div>  
{{-- Showing the previous data --}}
            @if(!empty($port))
                 <div class="form-group">
                  
                        <label class="col-sm-3 control-label no-padding-right align-left" for="port_name" >Port Name<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                         <input type="text" name="port_name" id="port_name"  
                         value="{{$port->port_name}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>  
                        </div>
                  </div>
                  <div class="space-4"></div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right align-left" for="port_address" >Address<span style="color: red">&#42;</span> </label>
                       <div class="col-sm-9">
                         <input type="text" name="port_address" id="port_address"  
                         value="{{$port->address}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/> 
                       </div>
                  </div>
                          
                
            {{-- End of IF section --}}
            @else 
              Nothing to edit
            @endif   

            {{-- submitting --}}
            <div class="clearfix form-actions">
                      <div class="col-md-offset-3 col-md-9"> 
                        
                           <button class="btn btn-info" type="submit">
                            <input type="hidden" name="port_id" value="{{ $port->id }}">
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

@endsection
