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
                <li class="active"> Machine Type </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Machine Type Update</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Update Machine Type</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"commercial/setup/machine_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="Machine_name" > Machine Type<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="Machine_name" id="Machine_name" value="{{ $machine->type_name}}"placeholder="Enter Machine Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>  
                    <div id="manufecturer">
                     @if(!empty($manunfcr2)) 
                        @foreach($manunfcr as $mfr)    
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="Manufacturer_name" > Manufacturer Name<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="Manufacturer_name[]" value="{{$mfr->manufacturer_name}}" id="Manufacturer_name" placeholder="Enter  Name" class="col-xs-9" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                             <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_mcn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_mcn">-</button> 
                              </div>     
                          </div>
                        </div> 
                      @endforeach

                      @else
                  
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="Manufacturer_name" > Manufacturer Name<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="Manufacturer_name[]" value="" id="Manufacturer_name" placeholder="Enter  Name" class="col-xs-9" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                             <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_mcn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_mcn">-</button> 
                              </div>     
                          </div>
                        </div> 
                      @endif
                     </div>   
 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                               <input type="hidden" name="machine_id" value="{{$machine->id}}">  
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
<script type="text/javascript">
$(document).ready(function(){  
  

//Add More1
 
        var data= '<div class="form-group">\
                    <label class="col-sm-3 control-label no-padding-right align-left" for="march_buyer_contact">Manufacturer Name<span style="color: red">&#42;</span> </label>\
                    <div class="col-sm-9">\
                        <input type="text" name="Manufacturer_name[]" id="Manufacturer_name" placeholder="Enter Manufacturer Name" class="col-xs-9" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                        <div class="form-group col-xs-3">\
                            <button type="button" class="btn btn-sm btn-success AddBtn_mcn">+</button>\
                            <button type="button" class="btn btn-sm btn-danger RemoveBtn_mcn">-</button>\
                        </div>\
                    </div>\
                </div>';
        $('body').on('click', '.AddBtn_mcn', function(){
            $("#manufecturer").append(data);
        });

        $('body').on('click', '.RemoveBtn_mcn', function(){
            $(this).parent().parent().parent().remove();
        });
        
});
</script>
@endsection