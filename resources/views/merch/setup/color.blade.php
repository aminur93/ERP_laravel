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
                <li class="active">Color</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Materials <i class="ace-icon fa fa-angle-double-right"></i> Color</small></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <h5 class="page-header">Add Color</h5>
                  
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/colorstore')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="march_color" >Main Reference <span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text" id="march_color" name="march_color" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                      </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="march_color_code" >Second Reference  </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_color_code" name="march_color_code" placeholder="Enter Code" class="col-xs-12" />
                            </div>
                      </div>
                      <!---<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="march_description" > Description <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                              <input type="text" id="march_description" name="march_description" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                             
                        </div>
                      </div>---->   
                    <div id="addmoreAttach"> 
                      <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="march_file" > Attach File</label>
                            <div class="col-sm-9">                                       
                              <input type="file" name="march_file[]" class="form-control-file col-xs-6 imgInp" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"                                    data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                               <div class="form-group col-xs-3 col-sm-3">
                                <!--<img class="colorimage" src="#" alt="Color image" name="colorimagefile[]" />-->
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                               </div> 
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
                  <h5 class="page-header">Color List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Main Reference</th>
                                <th>Second Reference</th>
                                <th>Color Image</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = 0; @endphp
                        @foreach($color as $col)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $col->clr_name }}</td>
                                <td>{{ $col->clr_code }}</td>
                                <td>
                                  @foreach($col->attached_files AS $file)
                                  <img src="{{url($file->col_attach_url )}}" width="30" height="30">
                                
                                  @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/coloredit/'.$col->clr_id) }}" class='btn btn-xs btn-primary'><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/colordelete/'.$col->clr_id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Buyer?');"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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
//Add More1
 
        var data = $("#addmoreAttach").html();
        $('body').on('click', '.AddBtn', function(){
            $("#addmoreAttach").append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });

///Data TAble Color        
    $('#dataTables').DataTable({
        responsive: false, 
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>tp",
    });
});

///Image preview
   
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.colorimage').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(".imgInp").change(function(){
        readURL(this);
    });
    </script>
@endsection