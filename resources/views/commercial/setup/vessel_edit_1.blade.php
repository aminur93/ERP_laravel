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
                <li class="active"> Vessel Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Vessel Edit</small></h1>
            </div>
            <div class="col-sm-6 ">
             <h5 class="page-header">Vessel</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"commercial/setup/vessel_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="vessel_name" > Vessel Name<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="vessel_name" id="vessel_name" value="{{$vessel->vessel_name}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div> 
                        
                       @if(!empty($voyage2))
                          @foreach($voyage as $voy)
                              <div >
                                 <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="voyage_no" >Voyage No<span style="color: red">&#42;</span> </label>

                                   <div class="col-sm-9">
                                    <input type="text" name="voyage_no[]" id="voyage_no" value="{{$voy->voyage_name }}" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                                   <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_vsl">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_vsl">-</button> 
                                  </div>     
                                 </div>
                              </div> 
                            </div>  
                          @endforeach
                        
                       <div id="voyage-entry">
                         
                       </div>

                       @else

                       <div id="voyage-entry">
                          <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right align-left" for="voyage_no" >Voyage No<span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                              <input type="text" name="voyage_no[]" id="voyage_no" placeholder="Enter voyage no" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                              <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_vsl">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_vsl">-</button> 
                              </div>     
                           </div>
                         </div> 
                       </div>

                       @endif 
                     
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                  <input type="hidden" name="vsl_id" value="{{ $vessel->id }}">
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
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //For more port entry..
    var data = ' <div class="form-group">\
                      <label class="col-sm-3 control-label no-padding-right align-left" for="voyage_no" >Voyage No<span style="color: red">&#42;</span> </label>\
                            <div class="col-sm-9">\
                              <input type="text" name="voyage_no[]" id="voyage_no" placeholder="Enter voyage no" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                              <div class="form-group col-xs-3 col-sm-3">\
                                     <button type="button" class="btn btn-sm btn-success AddBtn_vsl">+</button>\
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_vsl">-</button>\
                              </div>\
                           </div>\
                         </div>\
                      </div>'

    $('body').on('click', '.AddBtn_vsl', function(){
        $("#voyage-entry").append(data);
    });

    $('body').on('click', '.RemoveBtn_vsl', function(){
        $(this).parent().parent().parent().remove();
    });
        
  });
    

</script>
@endsection
