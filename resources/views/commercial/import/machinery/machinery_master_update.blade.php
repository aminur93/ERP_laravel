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
                    <a href="#"> Import </a>
                </li>
                <li class="#"> Machinery</li>
                <li class="active"> Machinery Master Information Update</li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content"> 
              <div class="page-header">
               <h1>Machinery <small><i class="ace-icon fa fa-angle-double-right"></i> Machinery Master Information Update  </small></h1>
            </div>
          <!---Form -->
            
       
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Add Information  </h5>
                    <!-- PAGE CONTENT BEGINS -->
                
                    <form class="form-horizontal" role="form" method="post" action="{{ url('comm/import/machinery/machinery_masterupdate')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="file_no" >File No.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                             {{ Form::select('file_no', $file_no, $data->machinery_pi_fileno, ['placeholder'=>'Select ','id'=> 'file_no','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="unit" >Unit: </label>

                          <div class="col-sm-9">
                             <input type="text" name="unit"placeholder="Enter" value="{{$data->hr_unit_name}}" id="unit" class="col-xs-12" readonly="readonly" /> 
                          </div>
                        </div> 

                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="manufacturer" >Manufacturer</label>

                          <div class="col-sm-9">
                            <input type="text" name="manufacturer"placeholder="Enter" value="{{$data->manf_name}}" id="manufacturer" class="col-xs-12" readonly="readonly" /> 
                          </div>
                        </div> 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="lcno" >L/C No.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="lcno"placeholder="Enter" value="{{$data->machinery_master_info_lc_no}}" id="lcno" class="col-xs-12"  data-validation=" required"/> 
                      
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="lcdate" >L/C Date.:<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="date" name="lcdate" value="{{$data->machinery_master_info_lc_date}}" id="lcdate" class="col-xs-12"  data-validation=" required"/> 
                            
                          </div>
                        </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="supplier" >Supplier Name<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                             <input type="text" name="supplier"placeholder="Enter" value="{{$data-> sup_name}}" id="supplier" class="col-xs-12" readonly="readonly" />
                          </div>
                     </div> 
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="supplier" >Section<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                               {{ Form::select('section', $section, $data->section_id, ['placeholder'=>'Select ','class'=> 'form-control col-xs-10', 'data-validation' => 'required']) }}
                          </div>
                     </div> 
                    
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"><input type="hidden" name="master_id"value="{{$data->machinery_master_info_id}}" />
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
                <!-- /.col -->
               
            </div><!--- /. Row Form 1---->
            <div class="panel panel-default"></div>
      
            
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){  

////  Ajax call for value set in input field based on File No. dropdown list


    

      $("body").on("change", "#file_no",  function(){ 
        var file_no = $(this).val();
        var s_id  = $("#supp-name").val();
        var supplier = $("#supplier"); 
        var unitinfo = $("#unit");
        var manfinfo = $("#manufacturer");

      $.ajax({
            url : "{{ url('comm/import/machinery/manufacturerinfo') }}",
            type: 'get',
            data: {fileno:file_no},
            success: function(data)
            {
                manfinfo.val(data);

            },
            error: function()
            {
                alert('failed...');
            }
        });
//////

        $.ajax({
            url : "{{ url('comm/import/machinery/unitinfo') }}",
            type: 'get',
            data: {fileno:file_no},
            success: function(data)
            {
                unitinfo.val(data);

            },
            error: function()
            {
                alert('failed...');
            }
        });
//////
        $.ajax({
            url : "{{ url('comm/import/machinery/supplierinfo') }}",
            type: 'get',
            data: {fileno:file_no},
            success: function(data)
            {
                supplier.val(data);

            },
            error: function()
            {
                alert('failed...');
            }
        });
//////



    });
/// 
 
});

</script>
@endsection