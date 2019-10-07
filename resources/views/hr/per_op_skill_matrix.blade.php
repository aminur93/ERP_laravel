@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Human Resource</a>
				</li> 
				<li>
					<a href="#">Performances</a>
				</li>
				<li class="active"> Skill Matrix</li>
			</ul><!-- /.breadcrumb -->

			<div class="nav-search" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div><!-- /.nav-search -->
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Performances <small> <i class="ace-icon fa fa-angle-double-right"></i> Skill Matrix</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    </br>
                    <form class="form-horizontal" role="form"> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="associate_id"> Associate's ID </label>
                            <div class="col-sm-9">
                                <input type="text" id="associate_id" placeholder="Associate's ID" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name"> Name </label>
                            <div class="col-sm-9">
                                <input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="section"> Section </label>
                            <div class="col-sm-9">
                                <input type="text" id="section" placeholder="Section" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="trade"> Trade </label>
                            <div class="col-sm-9">
                                <input type="text" id="trade" placeholder="Trade" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="present_designation"> Present Designation </label>
                            <div class="col-sm-9">
                                <input type="text" id="present_designation" placeholder="Present Designation" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="joining_date"> Joining Date </label>
                            <div class="col-sm-9">
                                <input type="date" id="joining_date" placeholder="Joining Date" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
	                        <div class="col-sm-6 col-sm-offset-2">
	                            <table class="table table-info">
	                            	<thead>
	                            		<tr>
	                            			<th>Machine</th>
	                            			<th>Process</th>
	                            			<th>Efficiency(%)</th>
	                            			<th>From</th>
	                            			<th>To</th>
	                            			<th><i class="fa fa-cogs"></i></th>
	                            		</tr>
	                            	</thead>
	                            	<tbody>
	                            		<tr>
	                            			<td><input class="form-control" type="text" placeholder="Machine"></td>
	                            			<td><input class="form-control" type="text" placeholder="Process"></td>
	                            			<td><input class="form-control" type="text" placeholder="Efficiency(%)"></td>
	                            			<td><input class="form-control" type="text" placeholder="From"></td>
	                            			<td><input class="form-control" type="text" placeholder="To"></td>
	                            			<td width="70">
	                            				<div class="btn-group">
													<button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button>
													<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button>
	                            				</div>
	                            			</td>
	                            		</tr>    
	                            	</tbody> 
	                            </table>
	                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="grade"> Grade </label>
                            <div class="col-sm-9">
                                <input type="text" id="grade" placeholder="Grade" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="previous_training"> Previous Training </label>
                            <div class="col-sm-9">
                                <textarea id="previous_training" placeholder="Previous Training" class="col-xs-10 col-sm-5" ></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="last_increment"> Last Increment </label>
                            <div class="col-sm-9">
                                <input type="text" id="last_increment" placeholder="Last Increment" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="last_increment_date"> Last Increment Date </label>
                            <div class="col-sm-9">
                                <input type="date" id="last_increment_date" placeholder="Last Increment Date" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-2 col-md-10">
                                <button class="btn btn-success" type="button">
                                    <i class="ace-icon fa fa-history bigger-110"></i> Production History
                                </button>
                                &nbsp; &nbsp; &nbsp;

                                <button class="btn btn-info" type="button">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- /.row --> 
                        <hr /> 
                    </form> 
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
		</div><!-- /.page-content -->
	</div>
</div>
@endsection