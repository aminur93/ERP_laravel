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
                <h1>Time & Action <small><i class="ace-icon fa fa-angle-double-right"></i> Library</small></h1>
            </div>

            
        
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                <!-- -Form 1----------------------> 
                    <h5 class="page-header">Library</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/time_action/library_store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="lib_action" >Action<span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="action" name="lib_action" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tna_code" >TNA Code <span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="tna_code" name="tna_code" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                               
                            </div> 
                             <div id="msg" class="col-sm-9 pull-right" style="color: red">
                             </div>
                      </div>
              
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> ADD
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>                        
                    </form>
                  </div>     
                <!-- /.col -->
                <div class="col-sm-6">
                    <h5 class="page-header">TNA Library List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Library Action</th>
                                <th>TNA Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($library as $lib)
                             <tr>
                                <td>{{$lib->tna_lib_action}}</td>
                                <td>{{$lib->tna_lib_code}}</td>
                                <td width="20%">
                                    <div class="btn-group">
                                        <a type="button" href="{{url('merch/time_action/library_edit/'.$lib->id)}}"class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{url('merch/time_action/library_delete/'.$lib->id)}}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Library?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
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