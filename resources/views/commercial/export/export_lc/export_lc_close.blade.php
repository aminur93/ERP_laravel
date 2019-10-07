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
                    <a href="#"> Export </a>
                </li>
                <li class="active">ELC File Close </li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content"> 
              <div class="page-header">
               <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i>ELC File Close   </small></h1>
            </div>
          <!---Form -->
            
       
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">ELC File Close Entry</h5>
                    <!-- PAGE CONTENT BEGINS -->
                
                    <form class="form-horizontal" role="form" method="post" action="{{ url('comm/export/exportlc_close_action')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="fileno_confirmation" >File No.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                             {{ Form::select('fileno_confirmation', $fileno, null, ['placeholder'=>'Select ','id'=>'fileno_confirmation','class'=> 'form-control col-xs-10 fileno_confirmation', 'data-validation' => 'required']) }}
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="fileno" >Re Enter<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                       <!--      <input type="text" name="fileno"placeholder="Enter" class="col-xs-12"  data-validation="confirmation required"/> -->
                       <input type="text" name="fileno"placeholder="Enter" id="fileno" class="col-xs-12"  data-validation=" required"/> 
                       <span id="alert"></span>
                          </div>
                        </div>  

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="close_date" >Close Date<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="date" name="close_date" placeholder="Enter Code" class="col-xs-12" data-validation="required"/>
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="remarks" >Remarks<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                              <textarea name="remarks" class="form-control"  data-validation="required length" data-validation-length="0-145"> </textarea>
                          </div>
                        </div> 

                    
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Close
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
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

$("#fileno, .fileno_confirmation").on('keyup', function(e) {
  var fileno1  = $(".fileno_confirmation").val();
  var fileno2  = $("#fileno").val();
//alert(fileno2);
  if(fileno1 != fileno2){
   $("#alert").html('<font-color="red">File no does not match</font>');
   }

  else{ $("#alert").html('');}  


});

});
</script>
@endsection