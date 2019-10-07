@extends('merch.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li> 
                <li>
                    <a href="#"> Setup </a>
                </li>
                  
                <li class="active">Wash Type</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Wash Type</small> <div class="text-right"><a rel='tooltip' data-tooltip="List of Wash Type" data-tooltip-location="top" href="{{URL::to('merch/setup/wash_type')}}" class="btn btn-info btn-xs">
            <i class="fa fa-list"></i> List of Wash Type
          </a></div></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-8 col-sm-offset-2">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/wash_type_update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    <input type="hidden" name="id" value="{{ $wash->id }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Category Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                                <select id="wash_category" name="wash_category" class="col-xs-12">
                                <option value="">Select Wash Category</option>
                                
                                @foreach($category_name as $cn)
                                <option value="{{$cn->id}}" @if($s_id == $cn->id) selected @endif >{{$cn->category_name}}</option>
                                @endforeach
                               
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_name" >Wash Process<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                                <input type="text" name="wash_name" id="wash_name" placeholder="Wash Name"  class="col-xs-12" value="{{ $wash->wash_name }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Process Time </label>
                            <div class="col-sm-7">
                                <input type="text" name="process_time" id="process_time" placeholder="Process Time"  class="col-xs-12" value="{{ $wash->process_time }}"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Chemical </label>
                            <div class="col-sm-7">
                                <input type="text" name="chemical" id="chemical" placeholder="chemical"  class="col-xs-12" value="{{ $wash->chemical }}"/>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Consumption Rate </label>
                            <div class="col-sm-7">
                                <input type="text" name="consumption_rate" id="consumption_rate" placeholder="Wash Rate"  class="col-xs-12" value="{{ $wash->consumption_rate }}"  />
                            </div>
                        </div>



                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>                        
                    </form>
                </div>     
            </div><!--- /. Row Form 1---->
           
      
            
        </div><!-- /.page-content -->
    </div>
</div>
@endsection