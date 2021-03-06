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
                  
                <li class="active">Special Machine</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Special Machine</small></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <h5 class="page-header">Special Machine</h5>
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/spmachinestore')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="sm_name" >Machine Name <span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               <input type="text"  name="sm_name" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                      </div>
                      <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
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
                    <h5 class="page-header">Special Machine List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Machine</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($spmachine as $machine)
                             <tr>
                                <td>{{ $machine->spmachine_name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/spmachineedit/'.$machine->spmachine_id) }}"class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/spmachinedelete/'.$machine->spmachine_id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Machine?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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

///Data TAble         
    $('#dataTables').DataTable();
});
</script>
@endsection