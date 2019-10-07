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
                <li class="active"> Bank  </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Cash Incentive Update</small></h1>
            </div>

            <div class="row">
                 <h5 class="page-header">Update Cash Incentive</h5>
                 <div class="col-sm-6">
                        {{Form::open(['url'=>'commercial/setup/incentive_update',"class"=>"form-horizontal"] )}}
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="country" >Country<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-9">
                                    <select class="col-sm-12" name="country" id="country">
                                    @if($cash[0]->cnt_id)
                                      <option value="{{$cash[0]->cnt_id}}">{{$cash[0]->country_name}}</option> 
                                       <option>Select a country</option>
                                        @foreach($country as $ctry)
                                            <option value="{{$ctry->cnt_id}}">{{$ctry->cnt_name}}</option>
                                        @endforeach 
                                    @else
                                     <option>Select a country</option>
                                        @foreach($country as $ctry)
                                            <option value="{{$ctry->cnt_id}}">{{$ctry->cnt_name}}</option>
                                        @endforeach 
                                    @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="incentive" >Incentive<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-9">
                                    <select class="col-sm-12" name="incentive" id="incentive">
                                     @if($cash[0]->incentive)
                                        <option>{{$cash[0]->incentive}}</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                     @else
                                        <option>Select Status</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                     @endif 
                                    </select>
                                </div>
                
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right align-left" for="type" >Type<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-9">
                                <input type="text" name="type" id="type" value="{{$cash[0]->type}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                </div>
                            </div>
                    {{-- Submitting --}}
                       <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <input type="hidden" name="cash_id" value="{{$cash[0]->id}}"> 
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

                 <div class="col-sm-6">
                        
                 </div>
                
            </div>
        </div>

    </div>   {{-- main content inner end --}}
</div>      {{-- Main content End --}}
@endsection