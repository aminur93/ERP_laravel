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
                  
                <li class="active">Wash Category</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Wash Category</small></h1>
              </div>
              <div class="space-10"></div>
            
            <div class="row">

                @include('inc/message')
                <div class="col-sm-6">
                    
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/wash_category_save')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_category" >Category Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="wash_category" id="wash_category" placeholder="Wash Category"  class="col-xs-12" value="{{ old('category_name') }}" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
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
                    <div class="col-sm-6">
                        <table id="wash_category_table" class="table table-striped table-bordered">
                            <thead>
                                <th>ID No.</th>
                                <th>Wash Type</th>
                                <th></th>
                               
                                
                            </thead>
                           <tbody>
                                @if($wash_category)
                                 @foreach($wash_category as $wc)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                              {{ $wc->category_name }}
                                        </td>
                                        <td>
                                        <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/wash_category_edit/'.$wc->id) }}" class="btn btn-xs btn-primary" title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/wash_category_delete/'.$wc->id) }}" type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this Operation?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                        </div>
                                        </td>
                                    </tr>
                                 @endforeach
                                @endif
                            </tbody> 
                        </table>
                    </div>
            </div>
          
            
          
           
      
            
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //Showing data table
        $('#wash_category_table').DataTable();
    });
</script> 


@endsection