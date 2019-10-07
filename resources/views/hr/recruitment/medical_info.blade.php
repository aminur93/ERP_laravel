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
                    <a href="#">Recruitment </a>
                </li>
                <li>
                    <a href="#">Operation </a>
                </li>
                <li class="active"> Medical Information</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment <small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Medical Information</small></h1>
            </div>

            <div class="row">

                <!-- Display Erro/Success Message -->
                @include('inc/message')


                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    </br>
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/recruitment/operation/medical_info') }}" enctype="multipart/form-data"> 
                         {{ csrf_field() }}
                         
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('med_as_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'med_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  

                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_height"> Height<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="med_height" name="med_height" data-validation=" required length number" data-validation-length="1-2" placeholder="Height in Inch" class="col-xs-10 col-sm-5" data-validation-error-msg="Numeric height required in Inch less or equal 2 digits" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_weight"> Weight<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="med_weight" name="med_weight" placeholder="Weight in Kg" class="col-xs-10 col-sm-5" data-validation="required length number" data-validation-length="1-3" data-validation-error-msg="Numeric weight required in Kg less or equal 3 digits" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_tooth_str"> Tooth Structure </label>
                            <div class="col-sm-9">
                                <input type="text" id="med_tooth_str" name="med_tooth_str" placeholder="Tooth Structure" value="N/A" class="col-xs-10 col-sm-5" data-validation="length" data-validation-length="0-124"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_blood_group"> Blood Group<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select id="med_blood_group" name="med_blood_group" class="col-xs-10 col-sm-5" data-validation="required">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_ident_mark"> Identification Mark </label>
                            <div class="col-sm-9">
                                <textarea id="med_ident_mark" name="med_ident_mark" class="col-xs-10 col-sm-5" placeholder="Identification Mark" data-validation="length" data-validation-length="0-256"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_others"> Other </label>
                            <div class="col-sm-9">
                                <textarea id="med_others" name="med_others" class="col-xs-10 col-sm-5" placeholder="Other" data-validation="length" data-validation-length="0-256"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_doct_comment"> Doctor's Comments<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <textarea id="med_doct_comment" name="med_doct_comment" class="col-xs-10 col-sm-5" placeholder="Doctor's Comments" data-validation="required length" data-validation-length="1-256"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_doct_conf_age"> Doctor's Age Confirmation<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select id="med_doct_conf_age" name="med_doct_conf_age" class="col-xs-10 col-sm-5" data-validation="required">
                                    <option value="">Select Doctors Confrimed Age</option>
                                    <option value="18-20">18-20</option>
                                    <option value="21-25">21-25</option>
                                    <option value="26-30">26-30</option>
                                    <option value="31-35">31-35</option>
                                    <option value="36-40">36-40</option>
                                    <option value="41-45">41-45</option>
                                    <option value="46-50">46-50</option>
                                    <option value="51-55">51-55</option>
                                    <option value="56-60">56-60</option>
                                    <option value="61-65">61-65</option>
                                    <option value="66-70">66-70</option>
                                </select>
                                <!-- <input type="text" id="med_doct_conf_age" name="med_doct_conf_age" placeholder="Doctor's Age Confirmation" class="col-xs-10 col-sm-5" data-validation="required length" data-validation-length="1-128"/> -->
                            </div>
                        </div> 

                       <!--  <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_acceptance"> Acceptance<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input id="med_acceptance" name="med_acceptance" type="radio" class="ace" value="1" data-validation="required" />
                                        <span class="lbl"> Yes</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input name="med_acceptance" id="med_acceptance" type="radio" class="ace" value="0"/>
                                        <span class="lbl">No</span>
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_signature">Signature (jpg|jpeg|png) </label>
                            <div class="col-sm-9">
                                <input type="file" id="med_signature" name="med_signature" data-validation="mime size" data-validation-allowing="jpeg,png,jpg" data-validation-max-size="512kb" data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_auth_signature">Authority Signature (jpg|jpeg|png) </label>
                            <div class="col-sm-9">
                                <input type="file" id="med_auth_signature" name="med_auth_signature" data-validation="mime size" data-validation-allowing="jpeg,png,jpg" data-validation-max-size="512kb" data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="med_doct_signature">Doctor's Signature(jpg|jpeg|png) </label>
                            <div class="col-sm-9">
                                <input type="file" id="med_doct_signature" name="med_doct_signature" data-validation="mime size" data-validation-allowing="jpeg,png,jpg" data-validation-max-size="512kb" data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit" >
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
<script type="text/javascript">
$(document).ready(function()
{   
    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term
                }; 
            },
            processResults: function (data) { 
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.associate_name,
                            id: item.associate_id
                        }
                    }) 
                };
          },
          cache: true
        }
    }); 

});
</script>
@endsection