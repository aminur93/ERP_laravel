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
				<li class="active"> Unit </li>
			</ul><!-- /.breadcrumb --> 
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Unit </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/unit')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_name" > Unit Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_name" name="hr_unit_name" placeholder="Unit name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_short_name" > Unit Short Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_short_name" name="hr_unit_short_name" placeholder="Unit short name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-20" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_name_bn" > ইউনিট (বাংলা) </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_name_bn" name="hr_unit_name_bn" placeholder="ইউনিটের নাম" class="col-xs-12" data-validation="length" data-validation-length="0-255" data-validation-error-msg="সঠিক নাম দিন"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_address" > Unit Adrress </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_address" name="hr_unit_address" placeholder="Unit name" class="col-xs-12" data-validation-regexp="^([.,-;:'& a-zA-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_address_bn" > ইউনিট ঠিকানা(বাংলা) </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_address_bn" name="hr_unit_address_bn" placeholder="ইউনটের ঠিকানা(বাংলা)" class="col-xs-12"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_code"> Unit Code </label>
                            <div class="col-sm-9">
                                <input type="text" id="hr_unit_code" name="hr_unit_code" placeholder="Unit code" class="col-xs-12" data-validation="length" data-validation-length="0-10" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_logo">Logo (jpg|jpeg|png) <br> Max Size: 200KB<br> Dimension: (148x248)px</label>
                            <div class="col-sm-2">
                                <input name="hr_unit_logo" type="file" 
                                class="dropZone"
                                data-validation="mime size dimension" data-validation-dimension="min248x148"
                                data-validation-allowing="jpeg,png,jpg"
                                data-validation-max-size="200kb"
                                data-validation-error-msg-size="You can not upload images larger than 200kb"
                                data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
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
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Unit Name</th>
                                <th>Short Name</th>
                                <th>ইউনিট (বাংলা)</th>
                                <th>Unit Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $unit)
                            <tr>
                                <td><img src='{{ url("$unit->hr_unit_logo") }}' alt="Logo" width="122" height="45"></td>
                                <td>{{ $unit->hr_unit_name }}</td>
                                <td>{{ $unit->hr_unit_short_name }}</td>
                                <td>{{ $unit->hr_unit_name_bn }}</td>
                                <td>{{ $unit->hr_unit_code }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/setup/unit_update/'.$unit->hr_unit_id) }}" class='btn btn-xs btn-primary' data-toggle="tooltip" title="Edit"> <i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('hr/setup/unit/'.$unit->hr_unit_id) }}" type="button" class='btn btn-xs btn-danger' data-toggle="tooltip" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

    $('#dataTables').DataTable({
        pagingType: "full_numbers" ,
        // searching: false,
        // "lengthChange": false,
        // 'sDom': 't' 
        "sDom": '<"F"tp>'

    }); 
});
</script>
@endsection