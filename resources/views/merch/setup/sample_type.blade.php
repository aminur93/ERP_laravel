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
                  
                <li class="active">Sample Type</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Sample Type</small></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Sample Type</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/sampletypestore')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="march_color" >Buyer Name<span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               {{ Form::select('buyer', $buyer, null, ['placeholder'=>'Select Buyer','id'=>'bid','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                      </div>
                      <div id="contactPersonData">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="march_color" >Sample Type <span style="color: red">&#42;</span> </label>

                                    <div class="col-sm-7">
                                    <input type="text" id="sample_name" name="sample_name[]" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                                    
                                    </div> 
                                    <button type="button" class="btn btn-sm btn-success AddBtn_bu">+</button>
                                    <button type="button" class="btn btn-sm btn-danger RemoveBtn_bu">-</button>
                                    <div id="msg" class="col-sm-9 pull-right" style="color: red">
                                    </div>
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
                    <h5 class="page-header">Sample Type List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Buyer</th>
                                <th>Sample Type</th>
                             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($sample as $type)
                             <tr>
                                <td>{{ $type->b_name }}</td>
                                <td>{{ $type->sample_name }}</td>
                               
                                <td width="20%">
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/sampletypedit/'.$type->sample_id) }}"class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/sampletypedelete/'.$type->sample_id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Buyer?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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

//Add More wash in form
var data_w = $("#contactPersonData").html();
        $('body').on('click', '.AddBtn_bu', function(){
            $("#contactPersonData").append(data_w);
        });

       $('body').on('click', '.RemoveBtn_bu', function(){
        $(this).parent().remove();
  });
</script>
@endsection