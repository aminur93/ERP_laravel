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
                  
                <li class="active">Sample Type Edit</li>
            </ul><!-- /.breadcrumb --> 
        </div>
        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Sample Type Edit</small></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-md-offset-2">
                    <h5 class="page-header">Sample Type Edit</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/sampletypeupdate')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="march_color" >Buyer Name<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                           {{ Form::select('buyer', $buyer, $sample->b_id, ['placeholder'=>'Select Buyer','id'=>'bid','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="march_color" >Sample Type <span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="sample_name" name="sample_name" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{ $sample->sample_name}}" />
                            </div>
                            <div id="msg" class="col-sm-9 pull-right" style="color: red">
                             </div>
                      </div>
                    
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                                 {{Form::hidden('sample_id', $value=$sample->sample_id)}}
                            </div>
                        </div>                        
                    </form>
                </div>     
                
            </div><!--- /. Row Form 1---->
            <div class="panel panel-default"></div>
      
            
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

///Data TAble Color        
    $('#dataTables').DataTable({
        responsive: true, 
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>tp",
    });

///Is Buyer name sample type exists
  // $("#sample_name").keyup(function(){  
  
  //       var msg = $("#msg");
  //       var bid = $("#bid").val();

  //       // Action Element list
  //       $.ajax({
  //           url : "{{ url('merch/setup/sampletypecheck') }}",
  //           type: 'get',
  //           data: {keyword : $(this).val(),b_id: bid},
  //           success: function(data)
  //           {
  //               if(data==1){ 
  //                    msg.html("This Sample Type Already exists");
  //                    $("#sample_name").val("");
  //               }
  //              else{ msg.html("");}

  //           },
  //           error: function()
  //           {
  //               alert('failed...');
  //           }
  //       });

  //   });
/// 
});
</script>
@endsection