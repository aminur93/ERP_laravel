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
                  
                <li class="active">Wash Type</li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Wash Type</small></h1>
            </div>
          <!---Form -->
            
          <!-- -Form 1-->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/wash_type')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Category Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8 no-padding-right">
                                <select id="wash_category" name="wash_category" class="col-xs-12 no-padding-right">
                                <option value="">Select Wash Category</option>
                                @foreach($washCategory as $id=>$wc)
                                <option value="{{ $id }}" >{{ $wc }}</option>
                                @endforeach 
                                </select>
                            </div>
                            <div class="col-sm-1 no-padding-right">
                                <button type="button" class="btn btn-sm btn-success" style="padding: 3px;" data-toggle="modal" data-target="#categoryModal">+</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_name" >Wash Process<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="wash_name" id="wash_name" placeholder="Wash Process"  class="col-xs-12" value="{{ old('wash_name') }}" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" style="height: 30px;"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Process Time</label>
                            <div class="col-sm-9">
                                <input type="double" name="process_time" id="process_time" placeholder="Process Time in Minutes"  class="col-xs-12" {{-- data-validation="required length number" data-validation-length="1-45" --}} style="height: 30px;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Chemical </label>
                            <div class="col-sm-9">
                                <input type="text" name="chemical" id="chemical" placeholder="Chemical"  class="col-xs-12" {{-- data-validation="required length custom" data-validation-length="1-45" --}} data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" style="height: 30px;"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Consumption Rate </label>
                            <div class="col-sm-9">
                                <input type="double" name="consumption_rate" id="consumption_rate" placeholder="Consumption Rate"  class="col-xs-12" style="height: 30px;" {{-- data-validation="required length number" data-validation-length="1-45" --}} />
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
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Wash Category</th>
                                <th>Wash Name</th>
                                <th>Process Time</th>
                                <th>Chemical</th>
                                <th>Consumption Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1; ?>
                            @foreach($washList as $wash)
                                <tr>
                                    <td>{{ $sl++ }}</td>

                                    <td>{{ $wash->category->category_name }}</td>

                                    <td>{{ $wash->wash_name }}</td>
                                    <td>{{ $wash->process_time }}</td>
                                    <td>{{ $wash->chemical }}</td>
                                    <td>{{ $wash->consumption_rate }}</td>
                                    
                                    <td>
                                        <div class="btn-group">

                                            <a type="button" href="{{ url('merch/setup/wash_type_edit/'.$wash->id) }}"class='btn btn-xs btn-success'><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                            <a href="{{ url('merch/setup/wash_type_delete/'.$wash->id) }}" type="button" class='btn btn-xs btn-danger bigger-120' onclick="return confirm('Are you sure you want to delete this Buyer?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div><!--- /. Row Form 1---->
           
      
            
        </div><!-- /.page-content -->

                <!-- Modal -->
            <div id="categoryModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                        <!-- Modal content-->

                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/wash_category_add')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Wash Category</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="wash_category" >Category Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-6">
                                <input type="text" name="wash_category" id="wash_category" placeholder="Wash Category"  class="col-xs-12" value="" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                            </div>
                            
                            <div class="space-10"></div>

                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i> Submit</button>

                          </div>
                        </div><!--Modal content end-->
                    </form>

                </div>
            </div><!--Modal end-->

    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){       
    $('#dataTables').DataTable({
        responsive: true, 
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>tp",
    });
</script>

@endsection