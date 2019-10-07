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
				<li class="active">Action Type</li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Action Type</small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Add Action Type</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/action_type') }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="act_name" > Action Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="act_name" name="act_name" placeholder="Action Type" class="col-xs-12" data-validation="required length custom" data-validation-length="2-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="act_code" > Action Type Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="act_code"    name="act_code" placeholder="Action Type Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" readonly/>
                            </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>Submit</button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>Reset</button>
                            </div>
                      </div>
                    </form> 
                </div>     
                <!-- /.col -->
                <div class="col-sm-6">
                    <h5 class="page-header">Action Type List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Action Type</th>   
                                <th>Action Type Code</th>                      
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actionList AS $action)
                            <tr>
                                <td>{{ $action->act_name }}</td>
                                <td>{{ $action->act_code }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/action_type_edit/'.$action->act_id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/action_type_delete/'.$action->act_id) }}" type="button" class='btn btn-xs btn-danger' title="Delete" onclick="return confirm('Are you sure you want to delete this Action Type?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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
$(document).ready(function(){ 

    $('#dataTables').DataTable();

    $("#act_name").on('blur', function(){
        // alert($(this).val());

        $.ajax({
            url: '{{ url("merch/setup/action_type_code") }}',
            type: 'json',
            method: 'get',
            data: { act_name: $(this).val()},
            success: function (data) 
            {
                console.log(data);
                $('#act_code').val(data);
            },
            error: function()
            {
                alert("failed!!");
            }
        });
    });
});
</script>
@endsection