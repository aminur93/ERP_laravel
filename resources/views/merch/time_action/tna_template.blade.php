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
                  
                <li class="active"> TNA Template</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Time & Action <small><i class="ace-icon fa fa-angle-double-right"></i>  TNA Template</small></h1>
            </div>
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                  <!-- -Form 1---------------------->
                    <h5 class="page-header">TNA Template</h5>
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/time_action/tna_temp_store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="template_name" >Template Name<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                               <input type="text" id="template_name" name="template_name" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="tna_code" >Buyer <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                               {{ Form::select('buyer', $buyer, null, ['placeholder'=>'Select Buyer','id'=>'bid','class'=> 'col-xs-12', 'data-validation' => 'required']) }}

                            </div> 
                             <div id="msg" class="col-sm-9 pull-right" style="color: red">
                             </div>
                      </div>
                      <div id="lib" style="display: none"  class="form-horizontalform-group">
                        <h5 class="page-header">TNA Library </h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>TNA Code</th>
                                    <th>Library Action</th>
                                    <th>Offset Day</th>
                                    <th>Logic</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>
                            @foreach($library as $lib)
                             <tr>
                                <td>
                                  <input type="text"  name="tna_lib_code[]" placeholder="Enter Text" class="col-xs-12" value="{{$lib->tna_lib_code}}" disabled="disabled"/>
                                </td>
                                <td>
                                  <input type="text"  name="tna_lib_action[]" placeholder="Enter Offset" class="col-xs-12" value="{{$lib->tna_lib_action}}"  disabled="disabled" />
                                </td>
                                <td>
                                <!--   <input type="text"  name="tna_lib_offset[]" placeholder="Enter Text" class="col-xs-12 Offset" value="{{$lib->tna_lib_offset}}"  disabled="disabled"/> -->
                                  <input type="text"  name="tna_lib_offset[]" placeholder="Enter Text" class="col-xs-12 Offset" value=""   data-validation="required length custom" data-validation-length="1-11" data-validation-regexp="^([0-9]+)$" disabled="disabled"/>
                                </td>
                                <td class="logic-box" width="25%">
                                  {{ Form::select('logic[]',array('DCD or FOB' => 'DCD or FOB', 'OK to Begin' => 'OK to Begin'), null, ['placeholder'=>'Select','class'=> 'col-xs-12 logic', 'disabled','data-validation' => 'required']) }}
                                <td>
                                  <input type="checkbox" value="{{$lib->id}}" name="tnalibrary[]" class="tnalibrary">
                                  
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                        </table>
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
                <!--Data Table---------------------->
                <div class="col-sm-6">
                    <h5 class="page-header">TNA Template List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Template Name</th>   
                                <th>Buyer </th>                      
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates AS $template)
                            <tr>
                                <td>{{ $template->tna_temp_name }}</td>
                                <td>{{ $template->b_name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('merch/time_action/tna_template_edit/'.$template->id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/time_action/tna_template_delete/'.$template->id) }}" type="button" class='btn btn-xs btn-danger' title="Delete" onclick="return confirm('Are you sure you want to delete this Action Type?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                </td>
                            </tr>
                          @endforeach                         
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>          
       
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
$('#dataTables').DataTable(); 

//--TNA Library div hide/show
$("#lib").hide();

  $("#bid").change(function(){

    if ($(this).val() == "" ) { 
      $("#lib").hide();    
    }
    else 
        $("#lib").show();     
    }); 
});
</script>

<script type="text/javascript">
  
 // Enable Logic field according to checkbox 
$("document").ready(function(){
    $("body").on("click", ".tnalibrary", function(){
        if ($(this).parent().parent().find("select").is(":disabled"))
        {
            $(this).parent().parent().find("select").prop("disabled", false);
            $(this).parent().parent().find(".Offset").prop("disabled", false);
        }
        else
        {
            $(this).parent().parent().find("select").prop("disabled", true);
            $(this).parent().parent().find(".Offset").prop("disabled", true);
        }
    });
});



$(document).ready(function(){
  
  
  
});


</script>
@endsection

