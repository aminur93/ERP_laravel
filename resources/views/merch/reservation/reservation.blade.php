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
                    <a href="#"> Capacity Reservation </a>
                </li> 
                <li class="active">Reservation </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Capacity Reservation<small><i class="ace-icon fa fa-angle-double-right"></i> Add Reservation </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                    <!-- <h5 class="page-header">Add Capacity Reservation</h5> -->
                    <!-- PAGE CONTENT BEGINS --> 
                    <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
                    {{ csrf_field() }} 
 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_id">Unit<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_unit_id', $unitList, null, ['id' => 'hr_unit_id', 'placeholder' => 'Select Unit', 'class' => 'col-xs-10 col-sm-5 filter', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="b_id" >Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('b_id', $buyerList, null, ['id'=> 'b_id', 'placeholder' => 'Select Buyer', 'class' => 'col-xs-12 col-sm-5 fileter', 'data-validation'=> 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="res_month"> Month<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="res_month" name="res_month" value="{{ old('res_month') }}" data-validation=" required" placeholder="Month" class="col-xs-4 col-sm-1 monthpicker"/>
                                <label class="col-sm-1">Year<span style="color: red">&#42;</span></label>
                                <input type="text" id="res_year" name="res_year" data-validation=" required" value="{{ old('res_year') }}" placeholder="Year" class="col-xs-4 col-sm-2 yearpicker"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="prd_type_id" >Product Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('prd_type_id', $prdtypList, null, ['id'=> 'prd_type_id', 'placeholder' => 'Select Product Type', 'class' => 'col-xs-12 col-sm-5 fileter', 'data-validation'=> 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="res_quantity"> Quantity<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="res_quantity" name="res_quantity" data-validation="required length number" data-validation-length="1-11" placeholder="Quantity" class="col-xs-10 col-sm-5 smvCalculation"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="res_sewing_smv"> Sewing SMV<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="res_sewing_smv" name="res_sewing_smv" data-validation="required number" data-validation-allowing="float" value="{{ old('res_sewing_smv') }}" placeholder="Sewing SMV" class="col-xs-10 col-sm-5 smvCalculation"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="res_sah"> SAH <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="res_sah" name="res_sah" placeholder="SAH" class="col-xs-10 col-sm-5" value="{{ old('res_sah') }}" data-validation="required number" data-validation-allowing="float" readonly/>
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
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //Total quantity can not be greater than Projected quantity
        $('.smvCalculation').on('keyup', function(){
            var res_sewing_smv = parseInt($("#res_sewing_smv").val());
            var res_quantity= parseInt($("#res_quantity").val());
            if(res_sewing_smv == null) res_sewing_smv=0;
            if(res_quantity == null) res_quantity=0;
            var sah= ((res_sewing_smv*res_quantity)/60).toFixed(2);
            $("#res_sah").val(sah);
        });
    });
</script>
@endsection