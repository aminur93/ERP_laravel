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
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Style & Library </a>
                </li> 
                <li class="active"> New Style for Bulk </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Style & Library <small><i class="ace-icon fa fa-angle-double-right"></i> New Style for Bulk </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url" => "merch/stylelibrary/style_bulk_store", "class"=>"form-horizontal"]) }}

                    <input type="hidden" name="stl_id" value="{{ $style->stl_id }}">

                    <!-- Top -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b_id" > Production Type<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8"> 
                                    <label class="radio-inline">
                                    <input type="radio" name="stl_order_type" id="inlineRadio2" value="Bulk" data-validation="required"  data-validation="required" checked> Bulk
                                    </label> 
                                </div> 
                            </div> 
                        </div> 
                    </div>


                    <!-- 1st Row -->
                    <div class="col-sm-4"> 
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="b_id" > Buyer<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                {{ Form::select('b_id', $buyerList, $style->b_id, ['placeholder'=>'Select Buyer', 'class'=> 'col-xs-12', 'id'=>"b_id", 'data-validation' => 'required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="prd_type_id" > Product Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                {{ Form::select('prd_type_id', $productTypeList, $style->prd_type_id, ['placeholder'=>'Select Product Type', 'class'=> 'col-xs-12', 'id'=>'prd_type_id', 'data-validation' => 'required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-4 control-label no-padding-right" for="stl_product_name" > Style Reference 2</label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_product_name" name="stl_product_name" value="{{ $style->stl_product_name }}" placeholder="Enter Text" class="col-xs-12" />
                          </div>
                        </div>


                        <div class="form-group">
                              <label class="col-sm-4 control-label no-padding-right" for="stl_smv" > SMV/pc<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_smv" name="stl_smv" value="{{ $style->stl_smv }}" placeholder="Enter Value" class="col-xs-12" data-validation="number" data-validation-allowing="float"/>               
                            </div>
                        </div>
 
                        <!-- Operation -->
                        <div class="addmore"> 
                            @forelse($operations as $operation) 
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="opr_id"> Operation</label>
                                <div class="col-sm-5">
                                    {{ Form::select('opr_id[]', $operationList,  $operation->opr_id, ['placeholder'=>'Select Operation', 'id'=>'opr_id', 'class'=> 'form-control no-select']) }} 
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                                    </div>
                               </div> 
                            </div>  
                            @empty
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="opr_id"> Operation</label>
                                <div class="col-sm-5">
                                    {{ Form::select('opr_id[]', $operationList, null, ['placeholder'=>'Select Operation', 'id'=>'opr_id', 'class'=> 'form-control no-select']) }} 
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                                    </div>
                               </div> 
                            </div> 
                            @endforelse
                        </div>

                        <!-- Special Machine -->
                        <div class="addmore"> 
                            @forelse($machines as $machine) 
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="sp_machine_id" > Special Machine</label>
                                <div class="col-sm-5">
                                    {{ Form::select('sp_machine_id[]', $machineList, $machine->sp_machine_id, ['placeholder'=>'Select Special Machine', 'id'=>'sp_machine_id', 'class'=> 'form-control no-select']) }} 
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                                    </div>
                               </div> 
                            </div> 
                            @empty
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="sp_machine_id" > Special Machine<span class="color: red">&#42;</span></label>
                                <div class="col-sm-5">
                                    {{ Form::select('sp_machine_id[]', $machineList, null, ['placeholder'=>'Select Special Machine', 'id'=>'sp_machine_id', 'class'=> 'form-control no-select']) }} 
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group">
                                     <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                                    </div>
                               </div> 
                            </div> 
                            @endforelse
                        </div> 
                    </div>
 
                    <!-- 2nd Row -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_no" > Style No<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_no" name="stl_no" value="{{ $style->stl_no }}" placeholder="Enter value" class="col-xs-12"  data-validation="required"/> 
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="gmt_id" > Garments Type<span class="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                              {{ Form::select('gmt_id', $garmentsTypeList, $style->gmt_id, ['placeholder'=>'Select Garments Type', 'id'=>'gmt_id', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_description" > Description<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <textarea name="stl_description" id="stl_description" placeholder="Description"  class="form-control" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'&a-z A-Z]+)$">{{ $style->stl_description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_cm" > CM/pc<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_cm" name="stl_cm" value="{{ $style->stl_cm }}" placeholder="Enter value" class="col-xs-12" data-validation="number" data-validation-allowing="float"/>                       
                            </div>
                        </div>
                    

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_cm" > Sample Type</label>
                            <div class="col-sm-8">
                                <div class="control-group">
                                    <!-- ./show all samples -->
                                    @foreach($sampleTypeList as $id => $name) 
                                        <div class="checkbox">
                                            <label>
                                                <input name="mr_sample_style[]" type="checkbox" class="ace" value="{{ $id }}" {{ (in_array($id, $samples)?'checked':null) }}>
                                                <span class="lbl"> {{ $name }}</span>
                                            </label>
                                        </div>  
                                    @endforeach  
                                </div>                      
                            </div>
                        </div> 
                    </div>

                    <!-- 3rd Row -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_code" > Short Code<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_code" name="stl_code" value="{{ $style->stl_code }}" placeholder="Enter Code" class="col-xs-12 disabled" data-validation="required length custom" data-validation-length="7" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" readonly />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="prdsz_id" > Size Group<span class="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                              {{ Form::select('prdsz_id', $sizegroupList, $style->prdsz_id, ['placeholder'=>'Select Size Group', 'id'=>'prdsz_id', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="se_id" > Season <span class="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                              {{ Form::select('se_id', $seasonList, $style->se_id, ['placeholder'=>'Select', 'id'=>'se_id', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }} 
                            </div>
                        </div>


                        <div class="form-group">
                              <label class="col-sm-4 control-label no-padding-right" for="stl_wash" > Wash/pc<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_wash" name="stl_wash" value="{{ $style->stl_wash }}" placeholder="Enter value" class="col-xs-12" data-validation="number" data-validation-allowing="float"/>   
                            </div>
                       </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-sm-12">
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Save
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <!-- PAGE CONTENT ENDS -->
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
 

<script type="text/javascript">
$(document).ready(function()
{  
    // add and remove 
    $('body').on('click', '.AddBtn', function(){
        var data = $(this).parent().parent().parent().html();
        $(this).closest(".addmore").append("<div class='form-group'>"+data+"</div>");
    });
    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().parent().remove();
    });   

    // get season list by buyer id
    $("#b_id").on("change", function(){ 
        $.ajax({
            url: "{{ url('merch/stylelibrary/shortcode') }}",
            type: 'get',
            dataType: 'json',
            data: {b_id:$(this).val()},
            success: function(data)
            {
                $("#se_id").html(data.seasonList);
            },
            error: function(xhr)
            {
                alert("failed...");
            }
        });
    });

});  
</script>
@endsection