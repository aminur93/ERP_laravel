@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#"> Human Resource </a>
				</li> 
				<li>
					<a href="#"> Setup </a>
				</li>
				<li class="active"> Increment Type Update </li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Increment Type Update </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/increment_type_update')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="increment_type" > Increment Type <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="increment_type" name="increment_type" placeholder="Increment Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" value="{{ $data->increment_type }}" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
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
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- /.row --> 
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
		</div><!-- /.page-content -->
	</div>
</div>

@endsection