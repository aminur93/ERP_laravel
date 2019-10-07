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
				<li class="active"> Education Title </li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Education Title </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-md-offset-2">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/education_title')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="id"> Education Level  </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('id', $levelList, null, ['placeholder'=>'Select Education Level', 'id'=>'id', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }}  
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="education_degree_title" >Exam/Degree Title<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="education_degree_title" name="education_degree_title" placeholder="Exam/Degree Title Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
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
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
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