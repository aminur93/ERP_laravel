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
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <h5 class="page-header">Edit Action Type</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/action_type_update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                        <input type="hidden" name="act_id" value="{{$actionType->act_id}}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="act_name" > Action Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="act_name" name="act_name" placeholder="Action Type" class="col-xs-12" value="{{ $actionType->act_name }}" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="act_code" > Action Type Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="act_code" name="act_code" placeholder="Action Type Code" class="col-xs-12" value="{{ $actionType->act_code }}" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" readonly />
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
            </div><!--- /. Row ---->
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

    $("#act_name").on('blur', function(){
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