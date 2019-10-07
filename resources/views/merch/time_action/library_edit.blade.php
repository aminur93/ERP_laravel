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
                    <a href="#"> Time & Action </a>
                </li>
                  
                <li class="active">Library & TNA Template</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Time & Action <small><i class="ace-icon fa fa-angle-double-right"></i> Library Update</small></h1>
            </div>

            
        
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                <!-- -Form 1----------------------> 
                    <h5 class="page-header">Library</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/time_action/library_update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="lib_action" >Action<span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="action" name="lib_action" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{$library->tna_lib_action}}"  />
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tna_code" >TNA Code <span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="tna_code" name="tna_code" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" value="{{$library->tna_lib_code}}"  />
                               
                            </div> 
                             <div id="msg" class="col-sm-9 pull-right" style="color: red">
                             </div>
                      </div>
                    
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                             <input type="hidden" name="libid"  value="{{$library->id}}" />
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
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
<script type="text/javascript">
$(document).ready(function(){ 

///Data TAble Color        
    $('#dataTables').DataTable({
        responsive: true, 
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>tp",
    });

///Is Buyer name sample type exists
  $("#sample_name").keyup(function(){  
  
        var msg = $("#msg");
        var bid = $("#bid").val();

        // Action Element list
        $.ajax({
            url : "{{ url('merch/setup/sampletypecheck') }}",
            type: 'get',
            data: {keyword : $(this).val(),b_id: bid},
            success: function(data)
            {
                if(data==1){ 
                     msg.html("This Sample Type Already exists");
                     $("#sample_name").val("");
                }
               else{ msg.html("");}

            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
/// 
});
</script>
@endsection