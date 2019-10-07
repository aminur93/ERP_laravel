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
                <li class="active">Action Element</li>
            </ul><!-- /.breadcrumb --> 
        </div>

		<div class="page-content"> 
          <!---Form 1---------------------->
            <div class="row">
                <div class="page-header">
                  
                  <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Element</small></h1>
                </div>
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <h5 class="page-header">Action Element Edit</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/action_element_update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                        <input type="hidden" name="el_id" value="{{ $element->el_id }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="act_id" > Action Type</label>
                            <div class="col-sm-9">
                               {{ Form::select('act_id', $actionTypes, $element->act_id, ['placeholder'=>'Select Action Type', 'class'=> 'col-xs-12 filter', 'data-validation' => 'required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="el_name" >Action Element<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                              <input type="text" id="el_name" name="el_name" placeholder="Enter Action Element" value="{{ $element->el_name }}" class="col-xs-12"  data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="el_code" >Element Code<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                              <input type="text" id="el_code" name="el_code" placeholder="Enter Element Code" value="{{ $element->el_code }}" class="col-xs-12"  data-validation="required length custom" data-validation-length="1-20" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="el_offset_day" >Off-set Day</label>
                            <div class="col-sm-9">
                              <input type="text" id="el_offset_day" name="el_offset_day" placeholder="Enter Off-set Day" value="{{ $element->el_offset_day }}" class="col-xs-12"  data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" data-validation-optional="true"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="el_offset_based_on" >Based On</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="el_offset_based_on" name="el_offset_based_on">
                                  <option value="">Select One</option>
                                  <option value="PCD" {{ ($element->el_offset_based_on=="PCD")?"selected":null }}>PCD</option>
                                  <option value="FOB" {{ ($element->el_offset_based_on=="FOB")?"selected":null }}>FOB</option>
                           </select>
                           
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
            </div><!--- /. Row Form 2---->

            
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $("#el_name").on('blur', function(){
        $.ajax({
            url: '{{ url("merch/setup/action_element_code") }}',
            type: 'json',
            method: 'get',
            data: { el_name: $(this).val()},
            success: function (data) 
            {
                console.log(data);
                $('#el_code').val(data);
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