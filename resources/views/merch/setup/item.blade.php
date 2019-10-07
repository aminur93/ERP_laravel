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
                <li class="active"> Item</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Materials <i class="ace-icon fa fa-angle-double-right"></i> Item</small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Add Category</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/item_store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="mcat_id">Main Category <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                    

                                {{ Form::select('mcat_name', $cat_list, null, ['placeholder'=>'Select Category Name','id'=>'mcat_id','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="addRemove">
                            <div class="newItem">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <label class="col-sm-3 control-label no-padding-right" for="item_name[]"> Item <span style="color: red">&#42;</span> </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="item_name" name="item_name[0]" placeholder="Enter Text" class="col-xs-9 item_name" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>

                                        <div class="form-group col-xs-3">
                                            <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                            <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="depends[0]"> Depends On<span style="color: red">&#42;</span> </label>
                                    <div class="radio col-sm-9">
                                        
                                        <label>
                                            <input name="depends[0]" type="radio" value="1" class="ace">
                                            <span class="lbl">Color</span>
                                        </label>
                                        <label>
                                            <input name="depends[0]" type="radio" value="2" class="ace" data-validation="required">
                                            <span class="lbl">Size</span>
                                        </label>
                                        <label>
                                            <input name="depends[0]" type="radio" value="3" class="ace">
                                            <span class="lbl">Size & Color</span>
                                        </label>
                                        <label>
                                            <input name="depends[0]" type="radio" value="0" class="ace" checked>
                                            <span class="lbl">None</span>
                                        </label>
                                    </div>
                                </div> 
                            </div>   
                        </div>   

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
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
                    <h5 class="page-header">Item List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Main Category</th>
                                <th>Item</th>   
                                <th>Depends </th>                      
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemList AS $category)
                            <tr>
                                <td>{{ $category->mcat_name }}</td>
                                <td>{{$category->item_name}}</td>
                                <td>
                                @if($category->dependent_on == 1)
                                    Color
                                @elseif($category->dependent_on == 2)
                                    Size
                                @elseif($category->dependent_on == 3)
                                    Color & Size
                                @else
                                    None
                                @endif 
                                </td>
                                <td width="13%">
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/item_edit/'.$category->id) }}" class='btn btn-xs btn-primary' title="Update" ><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/item_delete/'.$category->id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Item?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                         
                        </tbody>
                    </table>
                </div>
            </div><!--- /. Row ---->
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    var t=0;
    $(document).ready(function(){
        $('#dataTables').DataTable(); 
        var data = $('.AddBtn').parent().parent().parent().parent().html();
        $('body').on('click', '.AddBtn', function(){
            t++;
            var data= '<div class="newItem">\
                                <div class="form-group" style="margin-bottom:0px;">\
                                    <label class="col-sm-3 control-label no-padding-right" for="item_name[]"> Item <span style="color: red">&#42;</span> </label>\
                                    <div class="col-sm-9">\
                                        <input type="text" id="item_name" name="item_name['+t+']" placeholder="Enter Text" class="col-xs-9 item_name" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>\
                                        <div class="form-group col-xs-3">\
                                            <button type="button" class="btn btn-sm btn-success AddBtn">+</button>\
                                            <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>\
                                        </div>\
                                    </div>\
                                </div> \
                                <div class="form-group">\
                                    <label class="col-sm-3 control-label no-padding-right" for="depends['+t+']"> Depends On<span style="color: red">&#42;</span> </label>\
                                    <div class="radio col-sm-9">\
                                        <label>\
                                            <input name="depends['+t+']" type="radio" value="1" class="ace" data-validation="required">\
                                            <span class="lbl">Color</span>\
                                        </label>\
                                        <label>\
                                            <input name="depends['+t+']" type="radio" value="2" class="ace">\
                                            <span class="lbl">Size</span>\
                                        </label>\
                                        <label>\
                                            <input name="depends['+t+']" type="radio" value="3" class="ace">\
                                            <span class="lbl">Size & Color</span>\
                                        </label>\
                                        <label>\
                                            <input name="depends['+t+']" type="radio" value="0" class="ace" checked>\
                                            <span class="lbl">None</span>\
                                        </label>\
                                    </div>\
                                </div> \
                            </div> ';

            $('.addRemove').append("<div>"+data+"</div>");
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().parent().remove();
        });  
    });
</script>
@endsection
