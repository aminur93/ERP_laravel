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
                    <a href="#">Setup</a>   
                </li> 
                <li class="active"> Season </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Season </small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Add New Season</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"merch/setup/season_store", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="b_id"> Buyer<span style="color: red">&#42;</span>  </label>
                            <div class="col-sm-9"> 
                                {{ Form::select('b_id', $buyerList, null, ['placeholder'=>'Select Buyer', 'id'=>'b_id', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Buyer field is required']) }}  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_name" > Season Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                <input type="text" name="se_name" id="se_name" placeholder="Season Name"  class="col-xs-10 col-sm-12" data-validation="required length custom" data-validation-length="1-128"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                               
                                 <div id="suggesstion-box"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_mm_start" > Start Month-Year<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-4">
                              <input type="number" id="se_mm_start" name="se_mm_start"  class="col-xs-12" value="<?php echo date("n") ?>" data-validation="number" data-validation-allowing="range[1;12]" data-validation-error-msg="The Month field is required" placeholder="Enter Month" /> 
                              monthYearpicker
                            </div>
                            <div class="col-sm-5">
                              <input type="text" name="se_yy_start" value="<?php echo date("Y") ?>" class="col-xs-12" data-validation="date" data-validation-format="yyyy" data-validation-error-msg="The Year field is required" placeholder="Enter Year"/>
                            </div>
                        </div>  
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_mm_end" > End Month-Year<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-4">
                              <input type="number" id="se_mm_end" name="se_mm_end"  class="col-xs-12" value="<?php echo date("n") ?>" data-validation="number" data-validation-allowing="range[1;12]" data-validation-error-msg="The Month field is required" placeholder="Enter Month" /> 
                            </div>
                            <div class="col-sm-5">
                              <input type="text" name="se_yy_end" value="<?php echo date("Y") ?>" class="col-xs-12" data-validation="date" data-validation-format="yyyy" data-validation-error-msg="The Year field is required" placeholder="Enter Year"/>
                            </div>
                        </div>  
 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4">auto complete
                        </div>
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
 
                <div class="col-sm-6"> 
                    <h5 class="page-header">Season List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                        
                    </table>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  
   // $('#dataTables').DataTable();

    $("#se_name").keyup(function(){

        // Action Element list
        $.ajax({
            url : "{{ url('merch/setup/season_input') }}",
            type: 'get',
            data: {keyword : $(this).val()},
             beforeSend: function(){
            //$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
            success: function(data)
            {
               
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
           
                },
            error: function()
            {
                alert('failed...');
            }
        });

    });


});


function selectCountry(val) {
$("#se_name").val(val);
$("#suggesstion-box").hide();
}
</script>
@endsection