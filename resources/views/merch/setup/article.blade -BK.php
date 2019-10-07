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
        <li><a href="#"> Setup </a></li>
        <li class="active">Article Construction & Compostion</li>
      </ul><!-- /.breadcrumb --> 
    </div>

		<div class="page-content"> 
      <div class="page-header">
        <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i>Article Construction & Compostion</small></h1>
      </div>
            <!-- row -->
      <div class="row">
        <!-- Display Erro/Success Message -->
        @include('inc/message')
        <div class="col-sm-6">
          <h5 class="page-header">Article, Construction & Compostion</h5>
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/article') }}" enctype="multipart/form-data">
          {{ csrf_field() }}

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="sz_id" >Supplier<span style="color: red">&#42;</span></label>
                <div class="col-sm-9">
                  {{Form::select('supplier', $supplier, null, [ 'id' => 'supplier', 'placeholder' => 'Select Supplier', 'class' => 'col-xs-10 filter', 'data-validation' => 'required' ])}}
                </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_name" >Article<span style="color: red">&#42;</span></label>
              <div class="col-sm-9">
                {{Form::select('art_name', [], null, [ 'id' => 'art_name', 'placeholder' => 'Select Supplier', 'class' => 'col-xs-10 filter', 'data-validation' => 'required','data-validation-optional'=>'true','data-validation-length'=>'1-50','data-validation-regexp'=>'^([,./;:-_()%$&a-z A-Z0-9]+)$ '])}}
                <div class="col-sm-2 pull-right">
                  <button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_article" type="button"> NEW</button>
                  
                </div>
              </div>
             </div>
                     
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="composition" >Composition <span style="color: red">&#42;</span></label>
                <div class="col-sm-9">
                 <!--  {{Form::select('art_construction', [], null, [ 'id' => 'art_construction', 'placeholder' => 'Select Article', 'class' => 'col-xs-10 filter', 'data-validation' => 'required','data-validation-optional'=>'true','data-validation-length'=>'1-50','data-validation-regexp'=>'^([,./;:-_()%$&a-z A-Z0-9]+)$ '])}}
                   -->
                {{Form::select('composition', [], null, [ 'id' => 'composition', 'placeholder' => 'Select Article', 'class' => 'col-xs-10 filter', 'data-validation' => 'required','data-validation-optional'=>'true','data-validation-length'=>'1-50','data-validation-regexp'=>'^([,./;:-_()%$&a-z A-Z0-9]+)$ '])}}
                <div class="col-sm-2 pull-right">
                  <button class="addconst btn btn-xs" data-toggle="modal" data-target="#new_composition" type="button"> NEW
                  </button>
                </div>
              </div>
            </div>   
                     
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="art_construction" >Construction<span style="color: red">&#42;</span></label>
              <div class="col-sm-9">
                <input type="text" id="art_construction" name="art_construction" placeholder="Enter Construction" class="col-xs-10" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
              </div>
            </div>   
             
            <div class="clearfix form-actions">
              <div class="col-md-offset-3 col-md-9"> 
                <button class="btn btn-info" type="submit">
                  <i class="ace-icon fa fa-check bigger-110"></i> Submit
                </button>
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                  <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                </button>
              </div>
            </div>
          </form> 
        </div>     
        <!-- /.col -->
        <div class="col-sm-6">
          <h5 class="page-header">Article, Construction & Composition List</h5>
          <table id="dataTables" class="table table-striped table-bordered">
            <thead>
                <tr>
             
                    <th>Supllier</th>
                    <th>Article</th>
                    <th>Compostion</th>
                    <th>Construction</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($articleList AS $article)
              <tr>
                <td>{{ $article->sup_name }}</td>
                <td>{{ $article->art_name }}</td>
                <td>{{ $article->comp_name }}</td>
                <td>{{ $article->construction_name }}</td>
                <td>
                  <div class="btn-group">
                      <a type="button" href="{{ url('merch/setup/article_edit/'.$article->id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>


                      <a href="{{ url('merch/setup/article_delete/'.$article->artid.'/'.$article->c_id.'/'.$article->id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')" title="Delete" ><i class="ace-icon fa fa-trash bigger-120" ></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> <!-- Table End -->
        </div>
      </div><!--- /. Row Form 1---->
		</div><!-- /.page-content -->
	</div>
</div>

<!--Article Modal -->
<div class="modal fade" id="new_article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel">Add New Article</h2>
            </div>
         
                <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="art_dimension" >Article<span style="color: red">&#42;</span></label>
                    <div class="col-sm-9">
                      <input type="text" id="art_new" name="art_new" placeholder="Enter Article" class="col-xs-10" data-validation="required length custom" data-validation-length="1-65" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                    </div>
                </div>  
                </div>
                <div class="modal-footer" style="margin-top: 20px;">
                    <div class="col-md-9">
                        <button class="btn btn-info" type="button" id="art_modal" data-dismiss="modal">
                            <i class="ace-icon fa fa-check bigger-110" ></i> Add Article
                        </button>
                    </div>
                </div>
        </div>
    </div>
</div>
<!--Article Modal End -->

<!--Composition Modal -->
<div class="modal fade" id="new_composition" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel2">Add New Composition</h2>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="art_dimension" >Composition<span style="color: red">&#42;</span></label>
                    <div class="col-sm-9">
                      <input type="text" id="com_new" name="com_new" placeholder="Enter Composition" class="col-xs-10" data-validation="required length custom" data-validation-length="1-145" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                    </div>
                </div>  
                </div>
                <div class="modal-footer" style="margin-top: 20px;">
                    <div class="col-md-9"> 
                        <button class="btn btn-info" type="button" id="com_modal" data-dismiss="modal">
                          <i class="ace-icon fa fa-check bigger-110" ></i> Add Composition
                        </button>
                    </div>
                </div>
              </div>
           </div>
        </div>
<!--Construction  Modal End -->
<script type="text/javascript">
$(document).ready(function(){ 

    $('#dataTables').DataTable(); 
      //Item wise size
    $("#matitem_id").on('change', function()
    {
        var matitem_id= $(this).val();
        if(matitem_id != ''){
            $.ajax({
                url: '{{ url("merch/setup/size_by_item") }}',
                type: 'json',
                method: 'get',
                data: { matitem_id: $(this).val()},
                success: function (data) {
                    $("#sz_id").html(data);
                },
                error: function()
                {
                    alert("failed!!");
                }
            }); 
        }
        else{
            $("#sz_id").html("<option value=\"\">No Size Available!</option>");
        }
    });

    /// Based On Supplier

     var basedon = $("#supplier");
      basedon.on("change", function(){ 

        // Action Element list
        $.ajax({
            url : "{{ url('merch/setup/article_by_supllier') }}",
            type: 'json',
            method: 'get',
            data: {sup_id : $(this).val()},
            success: function(data)
            {
                $('#art_name').html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });

/// Composition Based On Article

     var basedon_art = $("#art_name");
     basedon_art.on("change", function(){ 

        // Action Element list
        $.ajax({
            url : "{{ url('merch/setup/composition_by_article') }}",
            type: 'json',
            method: 'get',
            data: {art_id : $(this).val()},
            success: function(data)
            {
                $('#composition').html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
  

  /// Add New Article

     var basedon_art_modal = $("#art_modal");
     basedon_art_modal.on("click", function(){ 
     var supllier = $("#supplier").val();
     var new_article=$("#art_new").val(); 
      if(supllier != '' && new_article != ''){
        // Action Element list
        $.ajax({
            url : "{{ url('merch/setup/add_new_article') }}",
            type: 'json',
            method: 'get',
            data: {art_name:new_article, sup_id:supllier},
            success: function(data)
            {
               
                 $('#art_name').html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
      }

    });

 /// Add New Composition
     var basedon_art_modal = $("#com_modal");
     basedon_art_modal.on("click", function(){ 
     var articleval = $("#art_name").val();
     var new_com=$("#com_new").val(); 
      if(articleval != '' && new_com != ''){
        // Action Element list
        $.ajax({
            url : "{{ url('merch/setup/add_new_composition') }}",
            type: 'json',
            method: 'get',
            data: {comst_name:new_com, art_id:articleval},
            success: function(data)
            {
               
                 $('#composition').html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
      }

    });

  ///
});
</script>
@endsection