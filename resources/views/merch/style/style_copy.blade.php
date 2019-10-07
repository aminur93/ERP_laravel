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
                    <a href="#"> Style </a>
                </li>
                <li class="active"> Copy Style </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Style<small><i class="ace-icon fa fa-angle-double-right"></i> Copy  Style </small></h1>
            </div>
            <div class="widget-header text-right">
                    <div class="col-sm-12">
                        <a href="{{ url('merch/style/style_new') }}" class="btn btn-primary btn-xs">
                            New Style
                        </a>

                        <a href="{{ URL::to('merch/style/style_copy/'.$style->stl_id) }}"  class="btn btn-warning btn-xs" > Style Copy</a>

                        <a href="{{ url('merch/style/create_bulk') }}" class="btn btn-info btn-xs" >
                            Create Bulk
                        </a>
                    </div>
            </div>
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->
                    {{ Form::open(["url" => "merch/style/style_copy_store", "class"=>"form-horizontal", "files"=>true]) }}

                    <!-- Top -->
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="b_id" > Production Type<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        @if($style->stl_type == 'Bulk')
                                    <input type="radio" name="stl_order_type" id="inlineRadio1" value="Bulk" data-validation="required" checked> Bulk
                                            @else
                                    <input type="radio" name="stl_order_type" id="inlineRadio1" value="Development" data-validation="required" checked> Development
                                            @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 1st Row -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="b_id" > Buyer<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-6">
                                {{ Form::select('b_id', $buyerList, $style->mr_buyer_b_id, ['placeholder'=>'Select Buyer', 'class'=> 'col-xs-12', 'id'=>"b_id", 'data-validation' => 'required']) }}
                            </div>
                          {{--@can("mr_setup")--}}
                            {{--<div class="col-sm-2 pull-right">--}}
                              {{--<button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_buyer" type="button"> NEW</button>--}}
                            {{--</div>--}}
                          {{--@endcan  --}}
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="prd_type_id" > Product Type<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-6" style='pointer-events: none;'>
                                {{ Form::select('prd_type_id', $productTypeList, $style->prd_type_id, ['placeholder'=>'Select Product Type', 'class'=> 'col-xs-12', 'id'=>'prd_type_id', 'data-validation' => 'required', 'disable'=>'disable']) }}
                            </div>
                           {{--@can("mr_setup")--}}
                            {{--<div class="col-sm-2 pull-right">--}}
                              {{--<button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_product" type="button"> NEW</button>--}}
                            {{--</div>--}}
                           {{--@endcan--}}
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_product_name" > Product Name<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_product_name" name="stl_product_name" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" value="{{$style->stl_product_name}}" readonly="readonly" />
                          </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-4 control-label no-padding-right" for="stl_smv" > Sewing SMV<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                              <input type="text" id="stl_smv" name="stl_smv" placeholder="Enter Value" class="col-xs-12" data-validation="number" data-validation-allowing="float" value="{{$style->stl_smv}}" readonly="readonly" />
                            </div>
                        </div>
                        <!-- Operation -->
                        <div class="addmore">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="opr_id" > Operation </label>
                                <div class="col-sm-5" style='padding-left:20px;'>

                                    <div class="checkbox">
                                         @foreach($operationList as $id => $name)

                                           <?php
                                            $tnalib=DB::table('mr_style_operation_n_cost AS so')
                                                     ->select(
                                                              'so.*'
                                                          )
                                                    ->leftjoin('mr_operation AS op', 'op.opr_id', '=', 'so.mr_operation_opr_id')
                                                    ->where('so.mr_style_stl_id', $style->stl_id)
                                                    ->where('so.mr_operation_opr_id', $id)
                                                    ->first();

                                            ?>
                                        <label class='col-sm-6' style='padding:0px;pointer-events: none;'>
                                            <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="{{ $id }}" @if($tnalib) checked @endif>
                                            <span class="lbl"> {{ $name }}</span>
                                        </label>
                                       @endforeach
                                    </div>

                              </div>

                         </div>
                        </div>

                        <!-- Special Machine -->
                        <div class="addmore">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="sp_machine_id" > Special Machine</label>
                                <div class="col-sm-5" style='padding-left:20px;'>

                                    <div class="checkbox">
                                       @foreach($machineList as $id => $name)

                                        <?php
                                            $smachine=DB::table('mr_style_sp_machine AS sm')
                                                    ->select('sm.*')
                                                    ->leftjoin('mr_special_machine AS sp', 'sp.spmachine_id', '=', 'sm.spmachine_id')
                                                    ->where('sm.stl_id', $style->stl_id)
                                                    ->where('sm.spmachine_id', $id)
                                                    ->first();

                                        ?>
                                        <label style='padding:0px;pointer-events: none;'>
                                            <input name="sp_machine_id[]" id="sp_machine_id" type="checkbox" class="ace" value="{{ $id }}"  @if($smachine) checked @endif>
                                            <span class="lbl"> {{ $name }}</span>
                                        </label>
                                       @endforeach
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- 2nd Row -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_no" > Style No. (Old)</label>
                            <div class="col-sm-8">
                                <input type="text" id="stl_no" name="stl_no_old" placeholder="Enter Style No" class="col-xs-12" data-validation="required length custom" data-validation-length="1-30"  value="{{$style->stl_no}}" readonly="readonly" disabled="disabled" />
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_no" > Copy Style No<span class="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="stl_no" name="stl_no" placeholder="Enter Style No" class="col-xs-12" data-validation="required length custom" data-validation-length="1-30" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="gmt_id" > Garments Type<span class="color: red">&#42;</span> </label>
                            <div class="col-sm-8" style="pointer-events: none;">
                              {{ Form::select('gmt_id', $garmentsTypeList, $style->gmt_id, ['placeholder'=>'Select Garments Type', 'id'=>'gmt_id', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="stl_description" > Description<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <textarea name="stl_description" id="stl_description" placeholder="Description"  class="form-control" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([.,-;:'&a-z A-Z]+)$" readonly="readonly">{{$style->stl_description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-sm-4 control-label no-padding-right" for="mr_sample_style"> Sample Type </label>
                            <div class="col-sm-8" style='padding-left:20px;'>
                                <div class="control-group" >
                                    <div class="checkbox" id="sample-checkbox">
                                      <!---Sample Update--->
                                       @foreach($sampleTypeList as $id => $name)

                                         <?php
                                            $sample=DB::table('mr_stl_sample AS sm')
                                              ->select('sm.*')
                                              ->leftjoin('mr_sample_type AS sp', 'sp.sample_id', '=', 'sm.sample_id')
                                              ->where('sm.stl_id', $style->stl_id)
                                              ->where('sm.sample_id', $id)
                                              ->first();
                                          ?>

                                        <label class='col-sm-6' style='padding:0px;pointer-events: none;'>
                                            <input name="mr_sample_style[]" id="mr_sample_style" type="checkbox" class="ace" value="{{ $id }}" @if($sample) checked @endif>
                                            <span class="lbl">{{ $name }}</span>
                                        </label>
                                        @endforeach
                                        <!---End Sample Update--->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 3rd Row -->
                    <div class="col-sm-4">
                        @foreach($stlsize as $size)
                             <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="prdsz_id" > Size Group<span class="color: red">&#42;</span> </label>
                                <div class="col-sm-6">
                                  {{ Form::select('prdsz_id[]', $sizegroupList, $size->mr_product_size_group_id, ['placeholder'=>'Select Size Group', 'id'=>'prdsz_id', 'class'=> 'col-xs-10 prdsz_id', 'data-validation' => 'required']) }}

                                       {{--<div class="form-group col-xs-2 col-sm-2 pull-right" style="padding:0px;">--}}
                                           {{--<button type="button" class="btn btn-sm btn-danger RemoveBtn_size_s" style="padding:3px;">-</button> --}}
                                       {{--</div> --}}
                                </div>
                               {{--@can("mr_setup") --}}
                                {{--<div class="col-sm-2 pull-right">--}}
                                  {{--<button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_size_group" type="button"> NEW</button>--}}
                                {{--</div>--}}
                               {{--@endcan--}}
                         </div>
                        @endforeach

                        <div  id="size-add">
                            <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="prdsz_id" > Size Group<span class="color: red">&#42;</span> </label>
                                    <div class="col-sm-6">
                                        {{ Form::select('prdsz_id[]', $sizegroupList, null, ['placeholder'=>'Select Size Group', 'id'=>'prdsz_id', 'class'=> 'col-xs-8 prdsz_id']) }}
                                        {{--<div class="form-group col-xs-4 col-sm-4 pull-right" style="padding:0px;">--}}
                                            {{--<button type="button" class="btn btn-sm btn-success AddBtn_size_s pull-let" style="padding: 3px;">+</button>--}}
                                            {{--<button type="button" class="btn btn-sm btn-danger RemoveBtn_size_s" style="padding:3px;">-</button> --}}
                                        {{--</div>  --}}
                                    </div>
                                   {{--@can("mr_setup") --}}
                                    {{--<div class="col-sm-2 pull-right">--}}
                                      {{--<button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_size_group" type="button"> NEW</button>--}}
                                    {{--</div>--}}
                                   {{--@endcan--}}
                             </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="se_id"> Season <span class="color: red">&#42;</span> </label>
                            <div class="col-sm-6">
                              {{ Form::select('se_id', $season, $style->mr_season_se_id, ['placeholder'=>'Select', 'id'=>'se_id', 'class'=> 'col-xs-12 se_id', 'data-validation' => 'required']) }}
                            </div>
                           {{--@can("mr_setup") --}}
                            {{--<div class="col-sm-2 pull-right">--}}
                              {{--<button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_season" type="button"> NEW</button>--}}
                            {{--</div>--}}
                           {{--@endcan --}}
                       </div>

                 <!--@if(count($stlwash) > 0) -->
                       @foreach($stlwash as $swash)
                           <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="wash_id" > Wash Type<span class="color: red">&#42;</span> </label>
                                <div class="col-sm-6">
                                  {{ Form::select('wash[]', $wash, $swash->mr_wash_type_id, ['placeholder'=>'Select Wash', 'class'=> 'col-xs-10 wash_id', 'data-validation' => 'required']) }}
                                    {{--<div class="form-group col-xs-2 col-sm-2 pull-right" style="padding:0px;">--}}
                                        {{--<button type="button" class="btn btn-sm btn-danger RemoveBtn_wash" style="padding:3px;">-</button> --}}
                                    {{--</div> --}}

                                </div>
                               {{--@can("mr_setup")  --}}
                                {{--<div class="col-sm-2 pull-right">--}}
                                  {{--<button class="btn btn-xs"  data-toggle="modal" data-target="#newWashModal" type="button"> NEW</button>--}}
                                {{--</div>--}}
                               {{--@endcan--}}
                           </div>
                        @endforeach
                    <!--     @endif    -->

                     <!---empty field---->
                            <div  id="wash-add">
                               <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="wash_id" > Wash Type<span class="color: red">&#42;</span> </label>
                                    <div class="col-sm-6">
                                      {{ Form::select('wash[]', $wash, null, ['placeholder'=>'Select Wash', 'class'=> 'col-xs-8 wash_id']) }}
                                        {{--<div class="form-group col-xs-4 col-sm-4 pull-right" style="padding:0px;">--}}
                                            {{--<button type="button" class="btn btn-sm btn-success AddBtn_wash pull-let" style="padding: 3px;">+</button>--}}
                                            {{--<button type="button" class="btn btn-sm btn-danger RemoveBtn_wash" style="padding:3px;">-</button> --}}
                                        {{--</div> --}}
                                    </div>
                                   {{--@can("mr_setup")  --}}
                                    {{--<div class="col-sm-2 pull-right">--}}
                                      {{--<button class="btn btn-xs"  data-toggle="modal" data-target="#newWashModal" type="button"> NEW</button>--}}
                                    {{--</div>--}}
                                   {{--@endcan--}}
                               </div>
                       </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="se_id" > Image  </label>
                            <div class="col-sm-8">
                              <input type="file" name="style_img_n" class="form-control form-control-file col-xs-6 imgInp" style="border: 0px;" data-validation="mime size" data-validation-allowing="jpeg,png,jpg" data-validation-max-size="512kb"        data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload  jpeg, jpg or png type file" value="{{ $style->  stl_img_link}}" onchange="loadFile(event)">

                            <img id="imagepreview" class="thumbnail" src="{{ url($style->stl_img_link) }}" alt="Style image" style="margin-left: 10px;" width="100" />
                            <input type="hidden" class="setfile" name="style_img" value="{{$style->stl_img_link}}">
                         </div>

                        </div>

                    </div>
                    <!-- Submit Button -->
                    <div class="col-sm-12">
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>


                                 <input type="hidden" name="style_id" value="{{$style->stl_id}}">
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

{{--<!--Buyer Modal -->--}}
{{--<div class="modal fade" id="new_buyer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--{{ Form::open(["url"=>"", "class"=>"form-horizontal", 'id'=>'newBuyerFrm']) }}--}}
            {{--<div class="modal-header bg-primary">--}}
                {{--<h2 class="modal-title text-center" id="myModalLabel">Add New Buyer</h2>--}}
            {{--</div>--}}
         {{----}}
                {{--<div class="modal-body">--}}
            {{----}}
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="march_buyer_name" > Buyer Name<span style="color: red">&#42;</span> </label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="text" id="march_buyer_name" name="march_buyer_name" placeholder="Buyer name" class="col-xs-10 march_buyer_name" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="march_buyer_short_name" > Buyer Short Name<span style="color: red">&#42;</span> </label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input type="text" id="march_buyer_short_name" name="march_buyer_short_name" placeholder="Buyer short name" class="col-xs-10 march_buyer_short_name" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                          {{--<label class="col-sm-3 control-label no-padding-right" for="action_type" > Country<span style="color: red">&#42;</span> </label>--}}
                            {{--<div class="col-sm-9">--}}
                              {{--{{ Form::select('country', $country, null, ['placeholder'=>'Select Country','id'=>'country','class'=> 'col-xs-10 country', 'data-validation' => 'required']) }} --}}
                            {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="march_buyer_address" >  Address <span style="color: red">&#42;</span></label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{----}}
                              {{--<textarea name="march_buyer_address" class="col-xs-10 march_buyer_address" id="march_buyer_address"  data-validation="required length" data-validation-length="0-128"></textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                     {{--<div id="contactPersonData">--}}
                      {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="march_buyer_contact" > Contact Person <span style="color: red">&#42;</span>(<span style="font-size: 9px">Name, Cell No, Email</span>)</label>--}}
                            {{--<div class="col-sm-9">                                --}}
                              {{--<textarea name="march_buyer_contact[]" class="col-sm-8 march_buyer_contact"  data-validation="required length" data-validation-length="0-128" cl></textarea>--}}
                            {{--<!--  <a href=""><h5>+ Add More</h5></a>-->--}}
                                 {{--<div class="form-group col-xs-3 col-sm-3">--}}
                                     {{--<button type="button" class="btn btn-sm btn-success AddBtn_bu">+</button>--}}
                                     {{--<button type="button" class="btn btn-sm btn-danger RemoveBtn_bu">-</button> --}}
                                 {{--</div>                                  --}}
                             {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer clearfix">--}}
                    {{--<div class="col-md-8">--}}
                        {{--<button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>--}}
                        {{--<button class="btn btn-info btn-sm size-add-modal" type="submit" id="buyer-add-modal" >--}}
                         {{--DONE--}}
                       {{--</button>--}}
                     {{--</div>--}}
                {{----}}
                {{--</div>--}}
              {{----}}
                {{--{{ Form::close() }}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<!-- Product Type -->--}}
{{--<div class="modal fade" id="new_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}

             {{--{{ Form::open(["url"=>"", "class"=>"form-horizontal", 'id'=>'newProdTypeFrm']) }}--}}
            {{--<div class="modal-header bg-primary">--}}
                {{--<h2 class="modal-title text-center" id="myModalLabel">Add New Product</h2>--}}
            {{--</div>--}}
         {{----}}
                {{--<div class="modal-body">--}}
                 {{--<div class="message"></div>--}}
                 {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="prd_type_name" > Product Type<span style="color: red">&#42;</span> </label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" name="prd_type_name" id="prd_type_name" placeholder="Product Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>--}}
                    {{--</div>--}}
                {{--</div>--}}
                        {{--<!-- /.row -->--}}
                {{--</div>--}}
                {{--<div class="modal-footer clearfix " >--}}
                    {{--<div class="col-md-8">--}}
                     {{----}}
                        {{--<button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>--}}
                       {{--<button class="btn btn-info btn-sm product_add" type="submit" id="product_add" >--}}
                         {{--DONE--}}
                       {{--</button>--}}

                    {{--</div>--}}
                    {{--{{Form::close()}}--}}
                {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<!-- Size Group Modal-->--}}
{{--<div class="modal fade" id="new_size_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header bg-primary">--}}
                {{--<h2 class="modal-title text-center" id="myModalLabel">Add New Size Group--}}
                {{--</h2>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--{{ Form::open(["url"=>"", "class"=>"form-horizontal", 'id'=>'newSizeFrm']) }}--}}
                    {{--{{ csrf_field() }} --}}
                     {{----}}
                        {{--<div class="form-group">--}}
                          {{--<label class="col-sm-3 control-label no-padding-right" for="product_size_group" >Brand<span style="color: red">&#42;</span> </label>--}}
                          {{--<div class="col-sm-9">--}}
                              {{--<div class="form-group col-xs-12 col-sm-10" >--}}
                                 {{--{{ Form::select('brand', $brand, null, ['placeholder'=>'Select Brand', 'id'=> 'brand','class'=> 'col-xs-12','data-validation' => 'required']) }}--}}
                               {{--</div> --}}
                          {{--</div>--}}
                        {{--</div> --}}
                        {{--<div class="form-group">--}}
                          {{--<label class="col-sm-3 control-label no-padding-right" for="product_type" >Product Type <span style="color: red">&#42;</span> </label>--}}
                          {{--<div class="col-sm-7">--}}
                            {{--<select name="product_type" id="product_type" class="col-xs-12" data-validation = "required">--}}
                                {{--<option>Select</option>--}}
                                 {{--<option value="Bottom">Bottom</option>--}}
                                 {{--<option value="Top">Top</option>--}}
                                 {{--<option value="Top/Bottom">Top/Bottom</option>--}}
                                 {{--<option value="Tesco">Tesco</option>--}}
                              {{--</select>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                          {{--<label class="col-sm-3 control-label no-padding-right" for="gender" >Gender <span style="color: red">&#42;</span> </label>--}}
                          {{--<div class="col-sm-7">--}}
                            {{--<select name="gender" id="gender" class="col-xs-12" data-validation = "required">--}}
                              {{--<option>Select</option>--}}
                               {{--<option value="Men's">Men's</option>--}}
                               {{--<option value="Ladies">Ladies</option>--}}
                               {{--<option value="Boys/Girls">Boys/Girls</option>--}}
                               {{--<option value="Girls">Girls</option>--}}
                               {{--<option value="Women's">Women's</option>--}}
                               {{--<option value="Men's & Ladies">Men's & Ladies</option>--}}
                               {{--<option value="Baby Boys/Girls">Baby Boys/Girls</option>--}}
                              {{--</select>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                          {{--<label class="col-sm-3 control-label no-padding-right" for="sg_name">Size Group Name <span style="color: red">&#42;</span> </label>--}}
                          {{--<div class="col-sm-7">--}}
                              {{--<input type="text" id="sg_name" name="sg_name" placeholder="Enter Size Group Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="addRemove">--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-3 control-label no-padding-right" for="psize" >Size <span style="color: red">&#42;</span></label>--}}
                                {{--<div class="col-sm-9">                              --}}
                                    {{--<input type="text" id="psize" name="psize[]" placeholder="Size" class="col-xs-9 psize" data-validation="required length custom" data-validation-length="1-11" data-validation-regexp="^([0-9]+)$"/>--}}
                                {{--<!--  <a href=""><h5>+ Add More</h5></a>-->--}}
                                    {{--<div class="form-group col-xs-3 col-sm-3">--}}
                                         {{--<button type="button" class="btn btn-sm btn-success AddBtn_size">+</button>--}}
                                         {{--<button type="button" class="btn btn-sm btn-danger RemoveBtn_size">-</button> --}}
                                    {{--</div>                                  --}}
                                 {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-3 control-label no-padding-right" for="sino" >SI No <span style="color: red">&#42;</span></label>--}}
                                {{--<div class="col-sm-9">                                --}}
                                    {{--<input type="text" id="sino" name="sino[]" placeholder="Size No" class="col-xs-9 sino" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.row --> --}}
                    {{--</div>--}}
                {{--<div class="modal-footer" style="margin-top: 20px;">--}}
                    {{--<div class="col-md-8">--}}
                        {{--<button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>--}}
                        {{--<button class="btn btn-info btn-sm size-add-modal" type="submit" id="size-add-modal" >--}}
                         {{--DONE--}}
                       {{--</button>--}}
                    {{--</div>--}}
                   {{--{{ Form::close() }}--}}
                {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<!-- Season Modal-->--}}
{{--<div class="modal fade" id="new_season" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header bg-primary">--}}
                {{--<h2 class="modal-title text-center" id="myModalLabel">Add New Season--}}
                {{--</h2>--}}
            {{--</div>--}}
         {{----}}
                {{--<div class="modal-body">--}}
                     {{--<div class="message"></div>--}}
                 {{--{{ Form::open(["url"=>"", "class"=>"form-horizontal", 'id'=>'newSeasonFrm']) }}--}}
                    {{--<div class="form-horizontal">--}}
                  {{----}}
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="se_name" > Season Name<span style="color: red">&#42;</span> </label>--}}
                            {{--<div class="col-sm-9">--}}

                                {{--<input type="text" name="se_name" id="se_name" placeholder="Season Name"  class="col-xs-8" data-validation="required length custom" data-validation-length="1-128"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" autocomplete="off"/>--}}
                                {{--<div id="suggesstion-box"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="se_mm_start" > Start Month-Year<span style="color: red">&#42;</span> </label>--}}
                            {{--<div class="col-sm-4">--}}
                             {{----}}
                                {{--<input type="text" name="se_mm_start" id="se_mm_start" placeholder="Month-y" class="form-control monthYearpicker" data-validation="required"/>--}}
                            {{--</div>--}}
                        {{--</div>  --}}
 {{----}}
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="se_mm_end" > End Month-Year<span style="color: red">&#42;</span> </label>--}}
                            {{--<div class="col-sm-4">--}}
                              {{--<input type="text" name="se_mm_end" id="se_mm_end" placeholder="Month-y" class="form-control monthYearpicker" data-validation="required"/>--}}
                            {{--</div>--}}
                           {{----}}
                        {{--</div> --}}
                   {{----}}
                        {{--<!-- /.row --> --}}
                    {{--</div>--}}
                {{--<div class="modal-footer" style="margin-top: 20px;">--}}
                    {{--<div class="col-md-8">--}}
                       {{----}}
                        {{--<button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>--}}
                        {{--<button class="btn btn-info btn-sm season-add" type="submit" id="season-add" >--}}
                         {{--DONE--}}
                       {{--</button>--}}
                    {{--</div>--}}
                  {{--{{Form::close()}}--}}
                  {{--</div>--}}
                {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<!-- Wash Type Modal-->--}}
{{--<div class="modal fade" id="newWashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--{{ Form::open(["url"=>"", "class"=>"form-horizontal", 'id'=>'newWashFrm']) }}--}}
            {{--<div class="modal-header bg-primary">--}}
                {{--<h2 class="modal-title text-center" id="myModalLabel">Add New Wash--}}
                {{--</h2>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<div class="message"></div>--}}
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="wash_name" >Wash Name<span style="color: red">&#42;</span> </label>--}}

                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" name="wash_name" id="wash_name" placeholder="Wash Name"  class="col-xs-12" value="{{ old('wash_name') }}" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="wash_rate" >Rate<span style="color: red">&#42;</span> </label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" name="wash_rate" id="wash_rate" placeholder="Wash Rate"  class="col-xs-12" value="{{ old('wash_rate') }}" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>--}}
                    {{--</div>--}}
                {{--</div>--}}
           {{----}}
                {{--<!-- /.row --> --}}
            {{--</div>--}}
            {{--<div class="modal-footer" style="margin-top: 20px;">--}}
                {{--<div class="col-md-8">--}}
                   {{--<!--<button class="btn btn-info btn-sm" type="submit">--}}
                        {{--<i class="ace-icon fa fa-check bigger-110"></i> ADD--}}
                    {{--</button>--}}
                    {{--<button class="btn btn-sm" type="reset">--}}
                        {{--<i class="ace-icon fa fa-undo bigger-110"></i> Reset--}}
                    {{--</button> -->--}}
                    {{--<button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>--}}
                    {{--<button class="btn btn-info btn-sm wash-add-modal" type="submit" id="wash-add-modal" >--}}
                      {{--DONE--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--{{ Form::close() }}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<script type="text/javascript">
  // Updated 08/2018 to prevent changing value with tab

$(window).on('load', function() {


    var readonly_select = $('select');
    $(readonly_select).attr('readonly', true);

});



$(document).ready(function()
{

    //Add More  buyer modal
        var data_b = $("#contactPersonData").html();
        $('body').on('click', '.AddBtn_bu', function(){
            $("#contactPersonData").append(data_b);
        });

        $('body').on('click', '.RemoveBtn_bu', function(){
            $(this).parent().parent().parent().remove();
      });

    // script for season modal
      $("#se_name").keyup(function(){
        var bid = $("#b_id2").val();
        if(bid != ''){
            // Action Element list
            $.ajax({
                url : "{{ url('merch/setup/season_input') }}",
                type: 'get',
                data: {keyword : $(this).val(),b_id: bid},
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
                   // alert('failed...');
                }
            });
          }
          else{ alert("Please Select Buyer")}

        });


         var basedon = $("#b_id");
         var action_element=$("#sample-checkbox");
         var action_season=$("#se_id");
         var action_size=$(".prdsz_id");

    // Sample type Based On Buyer

          basedon.on("change", function(){

            // Sample  list
            $.ajax({
                url : "{{ url('merch/style/sample_season') }}",
                type: 'get',
                dateType: 'JSON',
                data: {b_id : $(this).val()},
                success: function(data)
                {
                    action_element.html(data.samplelist);
                    action_season.html(data.selist);
                    action_size.html(data.sizelist);
                },
                error: function()
                {
                    alert('failed...');
                }
            });

        });

    //Add More size group in form
            var data_s = $("#size-add").html();
            $('body').on('click', '.AddBtn_size_s', function(){
                $("#size-add").append(data_s);
            });

           $('body').on('click', '.RemoveBtn_size_s', function(){
            $(this).parent().parent().parent().remove();
      });

    //Add More size group in modal
            // var data = $('.AddBtn_size').parent().parent().parent().parent().html();
               var data = $('.AddBtn_size').parent().parent().parent().parent().html();
            $('body').on('click', '.AddBtn_size', function(){
                $('.addRemove').append("<div>"+data+"</div>");
            });

            $('body').on('click', '.RemoveBtn_size', function(){
                $(this).parent().parent().parent().parent().remove();
            });
    //Add More wash in form
            var data_w = $("#wash-add").html();
            $('body').on('click', '.AddBtn_wash', function(){
                $("#wash-add").append(data_w);
            });

           $('body').on('click', '.RemoveBtn_wash', function(){
            $(this).parent().parent().parent().remove();
      });

    // Product Type  Add through ajax

    $('#new_product').on('show.bs.modal', function (e) {
        var modal = $(this);
        var button = $(e.relatedTarget);

        $("#newProdTypeFrm").on("submit", function(e) {
            e.preventDefault();
              var prod_name = $("#prd_type_name").val();
             var that = $(this);

            // Product insert url
            $.ajax({
                url : "{{ url('merch/setup/product_type_store') }}",
                type: 'post',
                data: {
                   prd_type_name: prod_name,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data)
                {
                    modal.find(".message").html("<div class='alert alert-success'>Product Successfully saved</div>");

                    // Ajax call for product list if Successfulily saved
                    $.ajax({
                        url : "{{ url('merch/style/product') }}",
                        type: 'get',
                        data: {},
                        success: function(data)
                        {
                           button.parent().prev().find("#prd_type_id").html(data);
                           modal.modal('hide');
                           that.unbind('submit');
                        },
                        error: function()
                        {
                            alert('failed...');
                        }
                    });
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });


    });

    // Season Add through ajax
    $('#new_season').on('show.bs.modal', function (e) {
        var modal = $(this);
        var button = $(e.relatedTarget);

        $("#newSeasonFrm").on("submit", function(e) {
            e.preventDefault();
            var action_place = $("#se_id");
            var buyr = $("#b_id").val();
            var se_name = $("#se_name").val();
            var se_mm_start  = $("#se_mm_start").val();
            var se_mm_end    = $("#se_mm_end").val();

             var that = $(this);

            // Product insert url
            $.ajax({
                url : "{{ url('merch/setup/season_store') }}",
                type: 'post',
                data: {
                    se_name    : se_name,
                    b_id       : buyr,
                    se_mm_start: se_mm_start,
                    se_mm_end  : se_mm_end
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data)
                {
                    modal.find(".message").html("<div class='alert alert-success'>Wash Successfully saved</div>");

                    // Ajax call for product list if Successfulily saved
                    $.ajax({
                        url : "{{ url('merch/style/season') }}",
                        type: 'get',
                        data: {b_id : buyr},
                        success: function(data)
                        {
                           button.parent().prev().find("#se_id").html(data);
                           modal.modal('hide');
                           that.unbind('submit');
                        },
                        error: function()
                        {
                            alert('failed...');
                        }
                    });
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });


    });

    // Wash Type  Add through ajax

    $('#newWashModal').on('show.bs.modal', function (e) {
        var modal = $(this);
        var button = $(e.relatedTarget);

        $("#newWashFrm").on("submit", function(e) {
            e.preventDefault();
             var wash_name = $("#wash_name").val();
             var wash_rate = $("#wash_rate").val();
             var that = $(this);

            // Wash insert url
            $.ajax({
                url : "{{ url('merch/setup/wash_type') }}",
                type: 'post',
                data: {
                    wash_name: wash_name,
                    wash_rate: wash_rate
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data)
                {
                    modal.find(".message").html("<div class='alert alert-success'>Wash Successfully saved</div>");

                    // Ajax call for wash list if Successfulily saved
                    $.ajax({
                        url : "{{ url('merch/style/wash') }}",
                        type: 'get',
                        data: {},
                        success: function(data)
                        {
                           button.parent().prev().find(".wash_id").html(data);
                           modal.modal('hide');
                           that.unbind('submit');
                        },
                        error: function()
                        {
                            alert('failed...');
                        }
                    });
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });


    });

    // Size Group Add through ajax

    $('#new_size_group').on('show.bs.modal', function (e) {
        var modal = $(this);
        var button = $(e.relatedTarget);
        var buyer = $("#b_id").val();
        if(buyer==""){ alert('Please Select The buyer first!!');}


        $("#newSizeFrm").on("submit", function(e) {

            e.preventDefault();
             var buyer = $("#b_id").val();
             var brand = $("#brand").val();
             var product_type = $("#product_type").val();
             var gender = $("#gender").val();
             var sg_name = $("#sg_name").val();

             var that = $(this);

             var psize_array = new Array();
                $('input[name="psize[]"]').each(function(){
                   psize_array.push($(this).val());
                });
             var sino_array = new Array();
                $('input[name="sino[]"]').each(function(){
                   sino_array.push($(this).val());
                });

            // Size Group insert url
            $.ajax({
                url : "{{ url('merch/setup/productsizestore') }}",
                type: 'post',
                data: {
                    buyer  : buyer,
                    brand  : brand,
                    product_type: product_type,
                    gender : gender,
                    sg_name: sg_name,
                    psize  : psize_array,
                    sino   : sino_array

                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data)
                {
                    modal.find(".message").html("<div class='alert alert-success'>Size Group Successfully saved</div>");

                    // Ajax call for Sizegroup list if Successfulily saved
                    $.ajax({
                        url : "{{ url('merch/style/sizegroup') }}",
                        type: 'get',
                        data: { buyer: buyer },
                        success: function(data)
                        {
                           button.parent().prev().find(".prdsz_id").html(data);
                           modal.modal('hide');
                           that.unbind('submit');
                        },
                        error: function()
                        {
                            alert('failed...');
                        }
                    });
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });


    });

    // Buyer Add through ajax

    $('#new_buyer').on('show.bs.modal', function (e) {
        var modal = $(this);
        var button = $(e.relatedTarget);

        $("#newBuyerFrm").on("submit", function(e) {

            e.preventDefault();
             var march_buyer_name = $("#march_buyer_name").val();
             var march_buyer_short_name = $("#march_buyer_short_name").val();
             var country = $("#country").val();
             var march_buyer_address = $("#march_buyer_address").val();

             var that = $(this);

             var march_buyer_contact = new Array();
                $('textarea[name="march_buyer_contact[]"]').each(function(){
                   march_buyer_contact.push($(this).val());
                });

            // Buyer insert url
            $.ajax({
                url : "{{ url('merch/setup/buyerinfostore') }}",
                type: 'post',
                data: {
                    march_buyer_name    : march_buyer_name,
                    march_buyer_short_name  : march_buyer_short_name,
                    country: country,
                    march_buyer_address : march_buyer_address,
                    march_buyer_contact : march_buyer_contact

                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data)
                {
                    modal.find(".message").html("<div class='alert alert-success'>Buyer Successfully saved</div>");

                    // Ajax call for Buyer list if Successfulily saved
                    $.ajax({
                        url : "{{ url('merch/style/buyerlist') }}",
                        type: 'get',
                        data: {},
                        success: function(data)
                        {
                           button.parent().prev().find("#b_id").html(data);
                           modal.modal('hide');
                           that.unbind('submit');
                        },
                        error: function()
                        {
                            alert('failed...');
                        }
                    });
                },
                error: function()
                {
                    alert('failed...');
                }
            });
        });


    });

});
</script>

<script>
// Image preview
  var loadFile = function(event) {
    var output = document.getElementById('imagepreview');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
@endsection
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
