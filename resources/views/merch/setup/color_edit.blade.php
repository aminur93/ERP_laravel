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
                  <li>
                    <a href="#"> Materials </a>
                </li>
                <li class="active">Color Update</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Materials <i class="ace-icon fa fa-angle-double-right"></i> Color</small> <div class="text-right"><a rel='tooltip' data-tooltip="List of colors" data-tooltip-location="top" href="{{URL::to('merch/setup/color')}}" class="btn btn-info btn-xs">
            <i class="fa fa-list"></i> List of colors
          </a></div></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-md-offset-2">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/colorupdate')  }}" enctype="multipart/form-data" >
                    {{ csrf_field() }} 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="march_color" >Main Reference <span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="march_color" name="march_color" placeholder="Enter Main Reference" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{ $color->clr_name}}" />
                            </div>
                      </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="march_color_code" >Second Reference </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_color_code" name="march_color_code" placeholder="Enter Second Reference" class="col-xs-12" value="{{ $color->clr_code}}" />
                            </div>
                      </div>
                      <!--<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="march_description" > Description <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_description" name="march_description" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{ $color->clr_description}} "/>
                             
                        </div>
                      </div> --->  
                    <div class="addmoreAttach"> 
                  @if(!empty($filesearch))
                     @foreach($colorfile as $file)

                      <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="march_file" > Attach File</label>
                        <div class="col-sm-9">     
                                                                 
                              <input type="file" name="march_file[]"  class="selectItem form-control-file col-xs-5 inputFile" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"                                 data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file"value="{{ $file->col_attach_url}}">

                              <input type="hidden" class="setcolorfile" name="march_file[]" value="{{ $file->col_attach_url}}">

                            <div class="form-group col-xs-5 col-sm-5">
                                  <!------->
                                    @if(!empty($file->col_attach_url))
                                      <img class="preview" src="{{ url($file->col_attach_url) }}" alt="Color image" style="margin-right: 10px" width="40" />
                                        <!--<a href="{{ url($file->col_attach_url) }}" class="btn btn-xs btn-primary" target="_blank" title="View"><i class="fa fa-eye"></i> </a>
                                        <a href="{{ url($file->col_attach_url) }}" class="btn btn-xs btn-success" target="_blank" download title="Download"><i class="fa fa-download"></i> </a>-->

                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                                                     

                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                               </div> 
                        </div>
                      </div> 
                        @endforeach 
                    @else                     
                      <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="march_file" > Attach File</label>
                            <div class="col-sm-9">                                       
                              <input type="file" name="march_file[]"  class="form-control-file col-xs-6 inputFile" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"                                    data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">


                               <div class="form-group col-xs-2 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                               </div> 
                        </div>                     
                    </div>
                 @endif 
                </div><!--end addmoreAttach------>

                    <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                                {{Form::hidden('color_id', $value=$color->clr_id)}}
                            </div>
                        </div>                        
                    </form>
                </div>     
                <!-- /.col -->
                
            </div><!--- /. Row Form 1---->
            <div class="panel panel-default"></div>
      
            
        </div><!-- /.page-content -->
    </div>
</div>



<script type="text/javascript">
$(document).ready(function(){ 
//Hidden input file value set for file update 
 $('.selectItem').change(function(e){
      var fileName = $(this).val();
    $(this).next('.setcolorfile').val(fileName);
  });
//Add More1
 
        var data ='<div class="form-group">\
                    <label class="col-sm-3 control-label no-padding-right" for="march_buyer_contact"> Contact Person <span style="color: red">&#42;</span> </label>\
                    <div class="col-sm-9">\
                           <input type="file" name="march_file[]"  class="form-control-file col-xs-6 inputFile" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"                                    data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">\
                        <div class="form-group col-xs-3">\
                            <button type="button" class="btn btn-sm btn-success AddBtn">+</button>\
                            <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>\
                        </div>\
                    </div>\
                </div>';
        $('body').on('click', '.AddBtn', function(){
            $(".addmoreAttach").append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });
               

});
</script>
@endsection