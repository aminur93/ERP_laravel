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
                <li class="active"> Style Copy </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">

                <h1 >Style<small><i class="ace-icon fa fa-angle-double-right"></i>   Style Copy</small></h1>
            </div>
       <!--      <div class="widget-header text-right">
                    <div class="col-sm-12">

                        <a href="#" class="btn btn-info btn-xs" >
                            Create Bulk
                        </a>
                    </div>
            </div> -->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->
                  <div class="col-sm-12" style="margin-top: 20px;">
                     <div class="col-sm-offset-1 form-group col-sm-8">
                        <form action="" class="form-horizontal" method="get">
                            <label class="col-sm-4 control-label no-padding-right" for="style_no" style="text-align: right;"> Style<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-7">
                              <div class="col-sm-9">
                                {{ Form::select('style_no', $stylelist, null, ['placeholder'=>'Select Style', 'class'=> 'col-xs-12', 'id'=>"style_no", 'data-validation' => 'required']) }}
                              </div>
                              <div class="col-sm-3">
                                <button class="btn btn-info btn-sm pull-right" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Search
                                </button>
                              </div>
                            </div>
                        </form>
                     </div>
                  </div>
                  <br>
                  <div id="style_form" class="col-sm-12">
                    <!---form--Here-->
                    @if (!empty(request()->has('style_no')))
                          <!--    {{request('style_no')}} -->
                            <br>
                          <div class="row" style="padding-top: 16px; border: 1px solid lightgray;">
                                <!-- Display Erro/Success Message -->
                              <div class="col-sm-12">
                                  <!-- PAGE CONTENT BEGINS -->
                                  {{ Form::open(["url" => "merch/style/style_copy_store", "class"=>"form-horizontal", "files"=>true]) }}

                                  <!-- Top -->
                                  <div class="col-sm-12">
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                          <label class="col-sm-4 control-label no-padding-right" for="se_id" > Image  </label>
                                          <div class="col-sm-8">
                                            <!-- <input type="file" name="style_img_n" class="form-control form-control-file col-xs-6 imgInp" style="border: 0px;" data-validation="mime size" data-validation-allowing="jpeg,png,jpg" data-validation-max-size="512kb"        data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload  jpeg, jpg or png type file" value="{{ $style->  stl_img_link}}" onchange="loadFile(event)"> -->

                                          <img id="imagepreview" class="thumbnail" src="{{ url($style->stl_img_link) }}" alt="Style image" style="margin-left: 10px;" width="100" />
                                          <input type="hidden" class="setfile" name="style_img" value="{{$style->stl_img_link}}">
                                       </div>

                                      </div>

                                    </div>

                                  </div>
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
                                          <div class="col-sm-8" style='pointer-events: none;'>
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
                                          <div class="col-sm-8" style='pointer-events: none;'>
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
                                                          @if($tnalib)
                                                      <label class='col-sm-6' style='padding:0px;pointer-events: none;'>
                                                          <input name="opr_id[]" id="opr_id" type="checkbox" class="ace" value="{{ $id }}" @if($tnalib) checked @endif>
                                                          <span class="lbl"><?= $name.'  ' ?></span>
                                                      </label>
                                                        @endif
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
                                                       @if($smachine)
                                                      <label style='padding:0px;pointer-events: none;'>
                                                          <input name="sp_machine_id[]" id="sp_machine_id" type="checkbox" class="ace" value="{{ $id }}"  @if($smachine) checked @endif>
                                                          <span class="lbl"> {{ $name }}</span>
                                                      </label>
                                                      @endif
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
                                                      @if($sample)
                                                      <label class='col-sm-6' style='padding:0px;pointer-events: none;'>
                                                          <input name="mr_sample_style[]" id="mr_sample_style" type="checkbox" class="ace" value="{{ $id }}" @if($sample) checked @endif>
                                                          <span class="lbl">{{ $name }}</span>
                                                      </label>
                                                      @endif
                                                      @endforeach
                                                      <!---End Sample Update--->
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- 3rd Row -->
                                  <div class="col-sm-4">
                                      @foreach($stlsize as $k=>$size)
                                           <div class="form-group">
                                              <label class="col-sm-4 control-label no-padding-right" for="prdsz_id" >
                                                <?php if($k == 0){?>
                                                Size Group<span class="color: red">&#42;</span>
                                              <?php } ?>
                                              </label>
                                              <div class="col-sm-8" style='pointer-events: none;'>
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

                                      <!-- <div  id="size-add">
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
                                      </div> -->
                                     <div class="form-group">
                                          <label class="col-sm-4 control-label no-padding-right" for="se_id"> Season <span class="color: red">&#42;</span> </label>
                                          <div class="col-sm-8" style='pointer-events: none;'>
                                            {{ Form::select('se_id', $season, $style->mr_season_se_id, ['placeholder'=>'Select', 'id'=>'se_id', 'class'=> 'col-xs-10 se_id', 'data-validation' => 'required']) }}
                                          </div>
                                         {{--@can("mr_setup") --}}
                                          {{--<div class="col-sm-2 pull-right">--}}
                                            {{--<button class="addart btn btn-xs"  data-toggle="modal" data-target="#new_season" type="button"> NEW</button>--}}
                                          {{--</div>--}}
                                         {{--@endcan --}}
                                     </div>

                               <!--@if(count($stlwash) > 0) -->
                                     @foreach($stlwash as $k=>$swash)
                                         <div class="form-group">
                                              <label class="col-sm-4 control-label no-padding-right" for="wash_id" >
                                                <?php if($k == 0){?>
                                                Wash Type<span class="color: red">&#42;</span>
                                              <?php } ?>
                                              </label>
                                              <div class="col-sm-8" style='pointer-events: none;'>
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
                                          <!-- <div  id="wash-add">
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
                                     </div> -->



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

                    @endif

                    <!--form----->
                  </div>
                    <!-- PAGE CONTENT ENDS -->
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<script>
// Image preview
  var loadFile = function(event) {
    var output = document.getElementById('imagepreview');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
@endsection
