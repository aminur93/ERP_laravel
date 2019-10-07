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
                    <a href="#">Recruitment</a>
                </li>
                <li>
                    <a href="#">Operation</a>
                </li>
                <li class="active"> Advance Information Details</li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 

            <div class="page-header row">
                <h1 class="col-sm-6">Recruitment <small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Advance Information Details</small></h1>
                <div class="text-right">
                    <div class="btn-group"> 
                        <a href='{{ url("hr/recruitment/employee/edit/$advance->emp_adv_info_as_id") }}' class="btn btn-sm btn-success" title="Basic Info"><i class="glyphicon glyphicon-bold"></i></a>
                        <a href='{{ url("hr/recruitment/operation/advance_info_edit/$advance->emp_adv_info_as_id") }}' class="btn btn-sm btn-info" title="Advance Info"><i class="glyphicon  glyphicon-font"></i></a>
                        <a href='{{ url("hr/recruitment/operation/benefits?associate_id=$advance->emp_adv_info_as_id") }}' class="btn btn-sm btn-primary" title="Benefits"><i class="fa fa-usd"></i></a>
                        <a href='{{ url("hr/ess/medical_incident?associate_id=$advance->emp_adv_info_as_id") }}' class="btn btn-sm btn-warning" title="Medical Incident"><i class="fa fa-stethoscope"></i></a>
                        <a href='{{ url("hr/operation/servicebook?associate_id=$advance->emp_adv_info_as_id") }}' class="btn btn-sm btn-danger" title="Service Book"><i class="fa fa-book"></i></a>
                    </div>
                </div>
            </div>
          

            <div class="row">
                 <!-- Display Erro/Success Message -->
                    @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                     
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#advanceInfo" aria-expanded="true">Advance Information</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#educationInfo" aria-expanded="false">Education Information</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#bengali">বাংলা</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Advance Info -->
                        <div id="advanceInfo" class="tab-pane fade in active">
                            <h5 style="color: red">*All fields are required</h5>
                            <br>
                            <form class="form-horizontal" role="form" method="post" action="{{ url('hr/recruitment/operation/advance_info_update') }}" enctype="multipart/form-data"> 
                                 {{ csrf_field() }} 

                                 {{ Form::hidden('emp_adv_info_id', $advance->emp_adv_info_id) }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_as_id"> Associate's ID </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emp_adv_info_as_id" placeholder="Associate's ID" class="col-xs-10 col-sm-5" value="{{ (!empty($advance->emp_adv_info_as_id)?$advance->emp_adv_info_as_id:(request()->route('emp_adv_info_as_id'))) }}" readonly /> 
                                    </div>
                                </div>
         
                               
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_stat"> Status </label>
                                    <div class="col-sm-9">
                                        @if($advance->emp_adv_info_stat == 1)
                                        <div class="radio">
                                            <label>
                                                <input id="emp_adv_info_stat" name="emp_adv_info_stat" type="radio" class="ace" value="1" checked />
                                                <span class="lbl"> Permanent</span>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input name="emp_adv_info_stat" id="emp_adv_info_stat" type="radio" class="ace" value="0"/>
                                                <span class="lbl">Probationary</span>
                                            </label>
                                        </div>
                                        @else
                                        <div class="radio">
                                            <label>
                                                <input id="emp_adv_info_stat" name="emp_adv_info_stat" type="radio" class="ace" value="1"/>
                                                <span class="lbl"> Permanent</span>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input name="emp_adv_info_stat" id="emp_adv_info_stat" type="radio" class="ace" value="0" checked/>
                                                <span class="lbl">Probationary</span>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_birth_cer">Birth Certificate (pdf|doc|docx|jpg|jpeg|png) </label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_birth_cer))
                                        <a href="{{ url($advance->emp_adv_info_birth_cer) }}" class="btn btn-xs btn-primary" target="_blank" title="View"><i class="fa fa-eye"></i> View</a>
                                        <a href="{{ url($advance->emp_adv_info_birth_cer) }}" class="btn btn-xs btn-success" target="_blank" download title="Download"><i class="fa fa-download"></i> Download</a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input type="file" name="emp_adv_info_birth_cer" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                        data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_city_corp_cer">City Corp. Certificate (pdf|doc|docx|jpg|jpeg|png) </label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_city_corp_cer))
                                        <a href="{{ url($advance->emp_adv_info_city_corp_cer) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_city_corp_cer) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-download"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input type="file" name="emp_adv_info_city_corp_cer" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                        data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_police_veri">Police Verification (pdf|doc|docx|jpg|jpeg|png) </label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_police_veri))
                                        <a href="{{ url($advance->emp_adv_info_police_veri) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_police_veri) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-eye"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input type="file" name="emp_adv_info_police_veri" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                        data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_passport"> NID/Passport No </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emp_adv_info_passport" placeholder="NID/Passport No" class="col-xs-10 col-sm-5" value="{{ $advance->emp_adv_info_passport }}" data-validation="length custom" data-validation-length="0-64" data-validation-regexp="^([./,-;:'&a-z A-Z0-9]+)$"data-validation-error-msg="Designation  between 0-64 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_refer_name"> Reference Name </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emp_adv_info_refer_name" placeholder="Reference Name" class="col-xs-10 col-sm-5" value="{{ $advance->emp_adv_info_refer_name }}" data-validation="custom length" data-validation-regexp="^([./,-;:'&a-z A-Z]+)$" data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="Reference Name  between 0-64 characters" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_refer_contact"> Reference Contact </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emp_adv_info_refer_contact" placeholder="Reference Contact" class="col-xs-10 col-sm-5" value="{{ $advance->emp_adv_info_refer_contact }}" data-validation="length number" data-validation-length="0-11" data-validation-optional="true" data-validation-error-msg="Reference Contact between 0-11 digits" />
                                    </div>
                                </div>
                                <!-- added from  basic info -->
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_fathers_name"> Father's Name </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_fathers_name" type="text" id="father_name" placeholder="Father's Name" class="col-xs-10 col-sm-5" value="{{ $advance->emp_adv_info_fathers_name }}" data-validation=" length custom" data-validation-regexp="^([./,-;:'& a-zA-Z]+)$" data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="The Father's Name has to be an alphabet value between 0-64 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_mothers_name"> Mother's Name </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_mothers_name" type="text" id="mother_name" placeholder="Mother's Name" class="col-xs-10 col-sm-5" value="{{ $advance->emp_adv_info_mothers_name }}" data-validation=" length custom" data-validation-regexp="^([./,-;:'& a-zA-Z]+)$"   data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="The Mother's Name has to be an alphabet value between 0-64 characters" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_marital_stat"> Marital Status </label>
                                    <div class="col-sm-9">
                                        <select name="emp_adv_info_marital_stat" id="married_unmarried" class="col-xs-10 col-sm-5 no-select" data-validation-error-msg="The Marital Status field is required">
                                            <option <?php if($advance->emp_adv_info_marital_stat == "Married") echo "Selected" ?>  value="Married">Married</option>
                                            <option <?php if($advance->emp_adv_info_marital_stat == "Unmarried") echo "Selected" ?>  value="Unmarried">Unmarried</option>
                                            <option <?php if($advance->emp_adv_info_marital_stat == "Divorced") echo "Selected" ?> value="Divorced">Divorced</option>
                                            <option <?php if($advance->emp_adv_info_marital_stat == "Widowed") echo "Selected" ?> value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="marritalInfo" <?php if($advance->emp_adv_info_marital_stat == 'Unmarried')
                                echo "class="."'hide'" ?> >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_spouse">Spouse (Husband/Wife) </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_spouse" type="text" id="Spouse" placeholder="Spouse (Husband/Wife)" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_spouse}}"  data-validation="length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"  data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="The Spouse's Name has to be an alphabet value between 0-64 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_children">No. of Children (if applicable ) </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_children" type="text" id="Children" placeholder="No. of Children (if applicable )" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_children}}" data-validation="number"
                                             data-validation-optional="true"
                                             data-validation-allowing="range[0;15]" data-validation-error-msg="Please check the value"/>
                                        </div>
                                    </div>
                                 </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_religion"> Religion </label>
                                    <div class="col-sm-9">
                                        <select name="emp_adv_info_religion" class="col-xs-10 col-sm-5 no-select" id="religion" data-validation-error-msg="The Religion field is required">
                                            @if(!empty($advance->emp_adv_info_religion))
                                            <option value="{{$advance->emp_adv_info_religion}}">{{$advance->emp_adv_info_religion}}</option>
                                            @endif
                                            <option value="">Select Religion</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Buddhists">Buddhists</option>
                                            <option value="Christians">Christians</option>
                                        </select>
                                    </div>
                                </div>
         
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pre_org"> Name of Previous Organization </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_pre_org" type="text" id="previous_org_name" placeholder="Name of Previous Organization" class="col-xs-10 col-sm-5" value="{{ $advance->emp_adv_info_pre_org }}" data-validation="length custom" data-validation-regexp="^([/.,-;:'& a-zA-Z]+)$"  data-validation-length="3-255" data-validation-optional="true"/>
                                    </div>
                                </div>
         
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_work_exp"> Work Experience </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_work_exp" type="text" id="experience" placeholder="Work Experience in Year" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_work_exp}}" data-validation="number" data-validation-optional="true" data-validation-allowing="range[0;50,float]" data-validation-error-msg="The Work Experience my be 0 to 50 years" />
                                    </div>
                                </div>

                                <div class="addRemove">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_nom_name"> Nominee Name</label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_nom_name[]" type="text" id="Nominee" placeholder="Nominee Name" class="col-xs-3 col-sm-3" value="" data-validation="length custom"  data-validation-optional="true" data-validation-regexp="^([./,-;:'& a-zA-Z]+)$" data-validation-length="3-64" data-validation-allowing=" _-" data-validation-error-msg="The Nominee Name has to be an alphabet value between 3-64 characters"/>

                                            <input name="emp_adv_info_nom_per[]" type="text" id="Percent" placeholder="(%)" class="col-xs-2 col-sm-1" value="" data-validation="alphanumeric" data-validation-optional="true" data-validation-allowing=" _-%" data-validation-length="1-32" data-validation-error-msg="The Percentage has to be an alphanumeric value between 1-32 characters" />

                                            <div class="form-group col-xs-2 col-sm-2">
                                                <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                                <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
            
                                <legend>Permanent Address</legend>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_vill"> Village </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_per_vill" type="text" id="as_per_vill" placeholder="Village" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_per_vill}}" data-validation=" length custom" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true"
                                        data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-error-msg="The Village has to be a value between 0-124 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_po"> PO </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_per_po" type="text" id="as_per_po" placeholder="PO" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_per_po}}" data-validation=" length custom" data-validation-length="0-124" data-validation-allowing=" -" data-validation-regexp="^([.,-;:'& a-zA-Z0-9]+)$" data-validation-optional="true" data-validation-error-msg="The PO has to be a value between 0-124 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_dist"> District  </label>
                                    <div class="col-sm-9"> 
                                        {{ Form::select('emp_adv_info_per_dist', $districtList, $advance->emp_adv_info_per_dist, ['placeholder'=>'Select District', 'id'=>'as_per_dis', 'class'=> 'col-xs-10 col-sm-5']) }}  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_upz"> Upazilla </label>
                                    <div class="col-sm-9"> 
                                        {{ Form::select('emp_adv_info_per_upz', $upazillaList, $advance->emp_adv_info_per_upz, ['placeholder'=>'Select Upazilla', 'id'=>'as_per_upz', 'class'=> 'no-select col-xs-10 col-sm-5']) }} 
                                    </div>
                                </div>

                                <legend>Present Address</legend>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_house_no"> House No </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_pres_house_no" type="text" id="house_no" placeholder="House No" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_pres_house_no}}" data-validation=" length custom" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true" 
                                        data-validation-regexp="^([./,-;:'& a-zA-Z0-9]+)$"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_road"> Road </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_pres_road" type="text" id="Road" placeholder="Road" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_pres_road}}" data-validation="length custom" data-validation-length="0-124" data-validation-optional="true" data-validation-allowing=" -" 
                                        data-validation-regexp="^([./,-;:'& a-zA-Z0-9]+)$"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_po"> PO </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_pres_po" type="text" id="PO" placeholder="PO" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_pres_po}}"  data-validation=" length custom" data-validation-length="0-124" data-validation-allowing=" -"  data-validation-optional="true" data-validation-regexp="^([./,-;:'& a-zA-Z0-9]+)$"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_dist"> District </label>
                                    <div class="col-sm-9"> 
                                        {{ Form::select('emp_adv_info_pres_dist', $districtList, $advance->emp_adv_info_pres_dist, ['placeholder'=>'Select District', 'id'=>'as_pre_dis', 'class'=> 'col-xs-10 col-sm-5', 'data-validation-error-msg'=>'The District field is required']) }}  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_upz"> Upazilla </label>
                                    <div class="col-sm-9"> 
                                        {{ Form::select('emp_adv_info_pres_upz', $upazillaList, $advance->emp_adv_info_pres_upz, [ 'placeholder' =>'Select Upazilla', 'id'=>'as_pre_upz', 'class'=> 'no-select col-xs-10 col-sm-5']) }} 
                                    </div>
                                </div>
                                <hr> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_job_app">Job Application (pdf|doc|docx|jpg|jpeg|png) </label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_job_app))
                                        <a href="{{ url($advance->emp_adv_info_job_app) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_job_app) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-eye"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input name="emp_adv_info_job_app" type="file" id="as_job_appl"
                                        data-validation="mime size"
                                        data-validation-allowing="docx,doc,pdf,jpeg,png,jpg"
                                        data-validation-max-size="1M"
                                        data-validation-error-msg-size="You can not upload images larger than 1MB"
                                        data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_cv">Curriculum Vitae (pdf|doc|docx|jpg|jpeg|png) </label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_cv))
                                        <a href="{{ url($advance->emp_adv_info_cv) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_cv) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-eye"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input name="emp_adv_info_cv" type="file" id="as_cv"
                                        data-validation="mime size"
                                        data-validation-allowing="docx,doc,pdf,jpeg,png,jpg"
                                        data-validation-max-size="1M"
                                        data-validation-error-msg-size="You can not upload images larger than 1MB"
                                        data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_emg_con_name"> Emergency Contact Name </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_emg_con_name" type="text" id="emergency_contact_name" placeholder="Emergency Contact Name"  value="{{$advance->emp_adv_info_emg_con_name}}" class="col-xs-10 col-sm-5" data-validation="length custom" data-validation-regexp="^([./,-;:'& a-zA-Z]+)$" data-validation-length="0-124" data-validation-optional="true" data-validation-error-msg="The Emergency Contact Name has to be an alphabet value between 0-124 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_emg_con_num"> Emergency Contact Number </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_emg_con_num" type="text" id="emergency_contact_number" placeholder="Emergency Contact Number" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_emg_con_num}}" data-validation="length custom" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true" data-validation-regexp="^([.,-;:'& a-zA-Z0-9]+)$"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_bank_name">Mobile Banking/Bank Name </label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_bank_name" type="text" id="bank_acc_name" placeholder="Mobile Banking/Bank Name " class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_bank_name}}"  data-validation="length alphanumeric" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true" data-validation-error-msg="The Bank/Bkash/Ucash Account Name has to be an alphanumeric value between 0-124 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_bank_num">Account Number</label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_bank_num" type="text" id="bank_acc_number" placeholder="Account Number" value="{{$advance->emp_adv_info_bank_num}}" class="col-xs-10 col-sm-5"  data-validation="length alphanumeric" data-validation-length="0-64" data-validation-allowing=" -" data-validation-optional="true" data-validation-error-msg="The Bank/Bkash/Ucash Account Number has to be an alphanumeric value between 0-64 characters"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_tin">TIN/ETIN</label>
                                    <div class="col-sm-9">
                                        <input name="emp_adv_info_tin" type="text" id="tin_etin" placeholder="TIN/ETIN" class="col-xs-10 col-sm-5" value="{{$advance->emp_adv_info_tin}}" data-validation="length alphanumeric" data-validation-length="0-32" data-validation-allowing=" -" data-validation-optional="true" data-validation-error-msg="The TIN/ETIN has to be a alphanumeric value between 0-32 characters"/>
                                    </div>
                                </div> 
                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_finger_print">Finger Print (jpg|jpeg|png)</label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_finger_print))
                                        <a href="{{ url($advance->emp_adv_info_finger_print) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_finger_print) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-eye"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input name="emp_adv_info_finger_print" type="file" id="finger_print"
                                        data-validation="mime size"
                                        data-validation-allowing="jpeg,png,jpg"
                                        data-validation-max-size="512kb"
                                        data-validation-error-msg-size="You can not upload images larger than 512kb"
                                        data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                                    </div>
                                </div>
                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_signature">Signature (jpg|jpeg|png) </label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_signature))
                                        <a href="{{ url($advance->emp_adv_info_signature) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_signature) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-eye"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input name="emp_adv_info_signature" type="file" id="Signature"
                                        data-validation="mime size"
                                        data-validation-allowing="jpeg,png,jpg"
                                        data-validation-max-size="512kb"
                                        data-validation-error-msg-size="You can not upload images larger than 512kb"
                                        data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_auth_sig">Authority Signature (jpg|jpeg|png)</label>
                                    <div class="col-sm-9">
                                        @if(!empty($advance->emp_adv_info_auth_sig))
                                        <a href="{{ url($advance->emp_adv_info_auth_sig) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
                                            <i class="fa fa-eye"></i>
                                             View
                                        </a>
                                        <a href="{{ url($advance->emp_adv_info_auth_sig) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
                                            <i class="fa fa-eye"></i>
                                             Download
                                        </a>
                                        @else
                                            <strong class="text-danger">No file found!</strong>
                                        @endif
                                        <input name="emp_adv_info_auth_sig" type="file" id="authority_signature" 
                                        data-validation="mime size"
                                        data-validation-allowing="jpeg,png,jpg"
                                        data-validation-max-size="512kb"
                                        data-validation-error-msg-size="You can not upload images larger than 512kb"
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
                                        <button name="approve" class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Update
                                        </button>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <a href="{{ url('hr/recruitment/operation/advance_info_list')}}" name="reject" class="btn btn-primary" type="submit">
                                            <i class="ace-icon fa fa-arrow-left bigger-110"></i> Cancel 
                                        </a>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <hr /> 
                            </form>
                        </div> 

                        <!-- Education -->
                        <div id="educationInfo" class="tab-pane fade">
                            <h5 style="color: red">*All fields are required</h5>
                            <br>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('hr/recruitment/operation/education_info')}}" enctype="multipart/form-data">
                                <div class="row">
                                    {{ csrf_field() }} 
                                    <div class="col-sm-6"> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_as_id"> Associate's ID </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="education_as_id" placeholder="Associate's ID" class="col-xs-12" value="{{ (!empty($advance->emp_adv_info_as_id)?$advance->emp_adv_info_as_id:(request()->route('emp_adv_info_as_id'))) }}" readonly /> 
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="education_level_id"> Education Level </label>
                                            <div class="col-sm-9">
                                                {{ Form::select('education_level_id', $levelList, null, ['placeholder'=>'Select Education Level', 'id'=>'education_level_id', 'style'=> 'width:100%', 'data-validation'=> 'required']) }}
                                            </div>
                                        </div>

                                        <div class="form-group hide" id="degrreforPhd">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_degree_id_1"> Exam/Degree Title </label>
                                        <div class="col-sm-9"> 
                                        {{ Form::select('education_degree_id_1', [], null, ['id'=>'education_degree_id_1','style'=> 'width:100%']) }} 
                                        </div>
                                        </div>

                                        <div class="form-group hide" id="PhdTitle">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_degree_id_2">Exam/Degree Title</label>
                                        <div class="col-sm-9">
                                        <input name="education_degree_id_2" type="text" id="education_degree_id_2" placeholder="Exam/Degree Title" class="col-xs-12"  data-validation="length custom required" data-validation-length="0-255" data-validation-allowing=" -$&" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-error-msg="Exam/Degree Title is invalid"/>
                                        </div>
                                        </div>

                                        <div class="form-group hide" id="major">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_major_group_concentation">Concentration/ Major/Group </label>
                                        <div class="col-sm-9">
                                        <input name="education_major_group_concentation" type="text" id="education_major_group_concentation" placeholder="Concentration/ Major/Group" class="col-xs-12"  data-validation="required length custom" data-validation-length="0-124" data-validation-allowing=" -$&" data-validation-regexp="^([.,-;:'& a-zA-Z0-9]+)$" data-validation-error-msg="Concentration/ Major/Group Name invalid"/>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_institute_name">Institute Name</label>
                                        <div class="col-sm-9">
                                        <input name="education_institute_name" type="text" id="education_institute_name" placeholder="Institute Name" class="col-xs-12"  data-validation="length custom required" data-validation-length="0-255" data-validation-allowing=" -$&" data-validation-regexp="^([.,-;:'& a-zA-Z0-9]+)$" data-validation-error-msg="Institute Name is invalid"/>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-sm-3 control-label" for="education_result_id"> Result </label>
                                        <div class="col-sm-9">
                                        {{ Form::select('education_result_id', $resultList, null, ['placeholder'=>'Select Education Level', 'id'=>'education_result_id', 'style'=> 'width:100%', 'data-validation'=> 'required']) }}
                                        </div>
                                        </div>

                                        <div class="hide" id="cgpa_scale">
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_result_cgpa"> CGPA </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="education_result_cgpa" id="education_result_cgpa" placeholder="CGPA" class="col-xs-12" data-validation="required number"  data-validation-allowing="float" data-validation-error-msg="Invalid CGPA"/>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_result_scale"> Scale </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="education_result_scale" id="education_result_scale" placeholder="Scale" class="col-xs-12" data-validation="required number" data-validation-error-msg="Invalid Scale"/>
                                        </div>
                                        </div>
                                        </div>


                                        <div class="form-group hide" id="division_mark">
                                        <label class="col-sm-3 control-label no-padding-right" for="education_result_marks"> Marks(%) </label>
                                        <div class="col-sm-9">
                                        <input type="text" name="education_result_marks" id="education_result_marks" placeholder="Marks" class="col-xs-12" data-validation="required number" data-validation-error-msg="Invalid Marks"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-3 control-label" for="education_level_title"> Passing Year </label>
                                    <div class="col-sm-9">
                                    <select style="width: 100%" name="education_passing_year" id="education_passing_year" data-validation="required">
                                        <option value="">Selecet Passing Year</option>
                                        @for($year=1950; $year<=date('Y') ; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-sm-6">
                                    <table class="table table-info" style="border: 1px solid;">
                                    <tbody id="educationHistory"> 
                                    </tbody> 
                                    </table>
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
                            </form>
                        </div>

                        <!-- Bangla -->
                        <div id="bengali" class="tab-pane fade  {{ (!empty(Session::get('bn_flag'))?'in active':null) }}">
                            <h5 style="color: red">*সব গুলো ঘর পূরণ করা বাধ্যতামূলক</h5>
                            <br/> 
                            <div class="row">

                                <div class="col-sm-6">
                                    {{ Form::open(['url'=>'hr/recruitment/employee/add_employee_bn',  'class'=>'form-horizontal']) }}

                                        <input type="hidden" name="hr_bn_id" id="hr_bn_id"/> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_as_id"> Associate's ID </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="hr_bn_associate_id" placeholder="Associate's ID" class="col-xs-12" value="{{ (!empty($advance->emp_adv_info_as_id)?$advance->emp_adv_info_as_id:(request()->route('emp_adv_info_as_id'))) }}" readonly /> 
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_associate_name"> নাম </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_associate_name" type="text" id="hr_bn_associate_name" placeholder="নাম" class="col-xs-12" data-validation="required length" data-validation-length="1-255"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_unit"> ইউনিট  </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_unit" placeholder="ইউনিটের নাম" value="{{ (!empty($bangla->hr_unit_name_bn)?$bangla->hr_unit_name_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_department"> ডিপার্টমেন্ট </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_department" placeholder="ডিপার্টমেন্টের নাম" value="{{ (!empty($bangla->hr_department_name_bn)?$bangla->hr_department_name_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_designation"> পদবি </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_designation" placeholder="পদবি" value="{{ (!empty($bangla->hr_designation_name_bn)?$bangla->hr_designation_name_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_doj"> যোগদানের তারিখ </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_doj" placeholder="যোগদানের তারিখ" value="{{ (!empty($bangla->as_doj)?$bangla->as_doj:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_father_name">পিতার নাম </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_father_name" type="text" id="hr_bn_father_name" placeholder="পিতার নাম" class="col-xs-12" data-validation="required length" data-validation-length="1-255"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_mother_name">মাতার নাম </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_mother_name" type="text" id="hr_bn_mother_name" placeholder="মাতার নাম" class="col-xs-12" data-validation="required length" data-validation-length="1-255"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_spouse_name">স্বামী/স্ত্রীর নাম </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_spouse_name" type="text" id="hr_bn_spouse_name" placeholder="স্বামী/স্ত্রীর নাম (ঐচ্ছিক)" class="col-xs-12" data-validation="length" data-validation-length="0-255"/>
                                            </div>
                                        </div>

                                        <legend><small>স্থায়ী ঠিকানা</small></legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_permanent_village"> গ্রাম  </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_permanent_village" type="text" id="hr_bn_permanent_village" placeholder="গ্রামের নাম"  class="col-xs-12" data-validation="required length" data-validation="length" data-validation-length="1-255"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_permanent_po"> ডাকঘর  </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_permanent_po" type="text" id="hr_bn_permanent_po" placeholder="ডাকঘরের নাম"  class="col-xs-12" data-validation="required length" data-validation="length" data-validation-length="1-255"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_permanent_upazilla"> উপজেলা </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_permanent_upazilla" placeholder="উপজেলার নাম" value="{{ (!empty($bangla->permanent_upazilla_bn)?$bangla->permanent_upazilla_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_permanent_district"> জেলা </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_permanent_district" placeholder="জেলার নাম" value="{{ (!empty($bangla->permanent_district_bn)?$bangla->permanent_district_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <legend><small>বর্তমান ঠিকানা</small></legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_present_road"> রোড নং </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_present_road" type="text" id="hr_bn_present_road" placeholder="রোড নং "  class="col-xs-12" data-validation="required length" data-validation="length" data-validation-length="1-255"/>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_present_house"> বাড়ি নং</label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_present_house" type="text" id="hr_bn_present_house" placeholder="বাড়ি নং"  class="col-xs-12" data-validation="required length" data-validation="length" data-validation-length="1-255"/>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_present_po"> ডাকঘর  </label>
                                            <div class="col-sm-9">
                                                <input name="hr_bn_present_po" type="text" id="hr_bn_present_po" placeholder="ডাকঘরের নাম"  class="col-xs-12" data-validation="required length" data-validation="length" data-validation-length="1-255"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_present_upazilla"> উপজেলা </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_present_upazilla" placeholder="উপজেলার নাম" value="{{ (!empty($bangla->present_upazilla_bn)?$bangla->present_upazilla_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="hr_bn_present_district"> জেলা </label>
                                            <div class="col-sm-9">
                                                <input type="text" id="hr_bn_present_district" placeholder="জেলার নাম" value="{{ (!empty($bangla->present_district_bn)?$bangla->present_district_bn:null) }}" class="col-xs-12" data-validation="required" readonly />
                                            </div>
                                        </div>

                                        <div class="space-4"></div>
                                        <div class="space-4"></div>
                                        <div class="space-4"></div>
                                        <div class="space-4"></div>
                                        <div class="space-4"></div>
                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-info" type="button">
                                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                                </button>

                                                &nbsp; &nbsp; &nbsp;
                                                <button class="btn" type="reset">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                                </button>
                                            </div>
                                        </div>

                                    {{ Form::close() }}
                                </div>
                                <div class="col-sm-6" id="associateInformation">
                                    <dl class="dl-horizontal">
                                        <dt>Associate's ID</dt><dd>{{ (!empty($bangla->associate_id)?$bangla->associate_id:" ") }}</dd>
                                        <dt>Associate's Name</dt><dd>{{ (!empty($bangla->as_name)?$bangla->as_name:" ") }}</dd>
                                        <dt>Unit</dt><dd>{{ (!empty($bangla->hr_unit_name)?$bangla->hr_unit_name:" ") }}</dd>
                                        <dt>Department</dt><dd>{{ (!empty($bangla->hr_department_name)?$bangla->hr_department_name:" ") }}</dd>
                                        <dt>Designation</dt><dd>{{ (!empty($bangla->hr_designation_name)?$bangla->hr_designation_name:" ") }}</dd>
                                        <dt>Date of Joining</dt><dd>{{ (!empty($bangla->as_doj)?$bangla->as_doj:" ") }}</dd>

                                        <dt>Father's Name</dt><dd>{{ (!empty($bangla->emp_adv_info_fathers_name)?$bangla->emp_adv_info_fathers_name:" ") }}</dd>
                                        <dt>Mother's Name</dt><dd>{{ (!empty($bangla->emp_adv_info_mothers_name)?$bangla->emp_adv_info_mothers_name:" ") }}</dd>
                                        <dt>Spouse's Name</dt><dd>{{ (!empty($bangla->emp_adv_info_spouse)?$bangla->emp_adv_info_spouse:" ") }}</dd>

                                        <legend><small>Permanent Address</small></legend>
                                        <dt>Village</dt><dd>{{ (!empty($bangla->emp_adv_info_per_vill)?$bangla->emp_adv_info_per_vill:" ") }}</dd>
                                        <dt>Post Office</dt><dd>{{ (!empty($bangla->emp_adv_info_per_po)?$bangla->emp_adv_info_per_po:" ") }}</dd>
                                        <dt>Upazilla</dt><dd>{{ (!empty($bangla->permanent_upazilla)?$bangla->permanent_upazilla:" ") }}</dd>
                                        <dt>District</dt><dd>{{ (!empty($bangla->permanent_district)?$bangla->permanent_district:" ") }}</dd>

                                        <legend><small>Present Address</small></legend>
                                        <dt>House No</dt><dd>{{ (!empty($bangla->emp_adv_info_pres_house_no)?$bangla->emp_adv_info_pres_house_no:" ") }}</dd>
                                        <dt>Road No</dt><dd>{{ (!empty($bangla->emp_adv_info_pres_road)?$bangla->emp_adv_info_pres_road:" ") }}</dd>
                                        <dt>Post Office</dt><dd>{{ (!empty($bangla->emp_adv_info_pres_po)?$bangla->emp_adv_info_pres_po:" ") }}</dd>
                                        <dt>Upazilla</dt><dd>{{ (!empty($bangla->present_district)?$bangla->present_district:" ") }}</dd>
                                        <dt>District</dt><dd>{{ (!empty($bangla->present_upazilla)?$bangla->present_upazilla:" ") }}</dd>
                                    </dl>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div> 

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<!-- <script type="text/javascript">
    $(window).load( "ajax/test.html",function(){

        var status = ["Married", "Divorced", "Widowed"];

        if (status.includes($(this).val()))
        {
            $("#marritalInfo").removeClass('hide', 500, "linear");
        }
        else
        {
            $("#marritalInfo").addClass('hide', 500, "linear");
        }
    }
</script>
 -->
<script type="text/javascript">
$(document).ready(function()
{  
    var associate_id = '{{ (request()->route("emp_adv_info_as_id")) }}'

    $('.dropZone').ace_file_input({
        style: 'well',
        btn_choose: 'Drop files here or click to choose',
        btn_change: null,
        no_icon: 'ace-icon fa fa-cloud-upload',
        droppable: true,
        thumbnail: 'fit'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
        }*/
        /**,before_remove : function() {
            return true;
        }*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });

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



    /*
    *----------------------------------------
    *   Marital Information
    *-----------------------------------------
    */


    $("#married_unmarried").on('change', function(){
        var status = ["Married", "Divorced", "Widowed"];

        if (status.includes($(this).val()))
        {
            $("#marritalInfo").removeClass('hide', 500, "linear");
        }
        else
        {
            $("#marritalInfo").addClass('hide', 500, "linear");
        }
    });
 
    /*
    *----------------------------------------
    *   Add or Remove Nominee
    *-----------------------------------------
    */

    var data = $('.AddBtn').parent().parent().parent().parent().html();
    $('body').on('click', '.AddBtn', function(){
        $('.addRemove').append(data);
    });

    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().parent().remove();
    });


    /*
    *----------------------------------------
    *   Permanent Address - District & Upazilla
    *-----------------------------------------
    */

    $("#as_per_dis").on('change', function()
    { 
        var id = $(this).val();
        if (id != '')
        {
            $.ajax({
                url: '{{ url("district_wise_upazilla") }}',
                type: 'json',
                method: 'get',
                data: {district_id: $(this).val() },
                success: function(data)
                {
                    $("#as_per_upz").html(data);
                },
                error: function()
                {
                    alert('failed');
                }

            });
        } 
    });

    /*
    *----------------------------------------
    *   Present Address - District & Upazilla
    *-----------------------------------------
    */

    $("#as_pre_dis").on('change', function()
    { 
        var id = $(this).val();
        if (id != '')
        {
            $.ajax({
                url: '{{ url("district_wise_upazilla") }}',
                type: 'json',
                method: 'get',
                data: {district_id: $(this).val() },
                success: function(data)
                {
                    $("#as_pre_upz").html(data);
                },
                error: function()
                {
                    alert('failed');
                }

            });
        } 
    });

   /*
    *----------------------------------------
    *   Exam/Degree Title- On Education Level
    *-----------------------------------------
    */

    $("#education_level_id").on('change', function()
    { 
        var id = $(this).val();
        if (id != '')
        {
            $.ajax({
                url: '{{ url("level_wise_degree") }}',
                type: 'json',
                method: 'get',
                data: {id: $(this).val() },
                success: function(data)
                {
                    $("#education_degree_id_1").html(data);
                },
                error: function()
                {
                    alert('failed');
                }

            });
        }
        var status= ['1','2'];

        if (!status.includes($(this).val()))
        {
            $("#major").removeClass('hide', 500, "linear");
        }
        else
        {
            $("#major").addClass('hide', 500, "linear");
        }


        var phd= ['8'];

        if (phd.includes($(this).val()))
        {
            $("#PhdTitle").removeClass('hide', 500, "linear");
            $("#degrreforPhd").addClass('hide', 500, "linear");
        }
        else
        {
            $("#PhdTitle").addClass('hide', 500, "linear");
            $("#degrreforPhd").removeClass('hide', 500, "linear");
        }
    });

    /*
    *----------------------------------------
    *   CGPA and Scale On Grade
    *-----------------------------------------
    */
    $("#education_result_id").on('change', function(){
        var status = ['4'];
        var selected= ['1','2','3'];
        if (status.includes($(this).val()))
        {
            $("#cgpa_scale").removeClass('hide', 500, "linear");
        }
        else
        {
            $("#cgpa_scale").addClass('hide', 500, "linear");
        }
        if (selected.includes($(this).val()))
        {
            $("#division_mark").removeClass('hide', 500, "linear");
        }
        else
        {
            $("#division_mark").addClass('hide', 500, "linear");
        }
    });



    /*
    |-------------------------------------------------- 
    | BANGLA 
    |-------------------------------------------------- 
    */

    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            type: 'get',
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

    // Translate english date to bangla
    var string = $("#hr_bn_doj");
    $(window).on('load', function()
    { 
        string.val(convertE2B(string.val()));
    });


    // retrive all information by associate selction 
    $('body').on('change', '.associates', function(){
        showInfo($(this).val());
    });
    $(window).load(function(){
        showInfo(associate_id);
        educationHistory(associate_id);
    });



});


function convertE2B(string)
{
    var bn = string.replace(/0/g, "০");
    bn = bn.replace(/1/g, "১");
    bn = bn.replace(/2/g, "২");
    bn = bn.replace(/3/g, "৩");
    bn = bn.replace(/4/g, "৪");
    bn = bn.replace(/5/g, "৫");
    bn = bn.replace(/6/g, "৬");
    bn = bn.replace(/7/g, "৭");
    bn = bn.replace(/8/g, "৮");
    bn = bn.replace(/9/g, "৯"); 
    return bn;
}

//bangla information
function showInfo(associate_id)
{
    $.ajax({
        url: '{{ url("hr/associate") }}',
        type: 'get',
        dataType: 'json',
        data: {associate_id: associate_id},
        success: function(data)
        { 
            // update previous information 
            $("#hr_bn_id").empty().val(data.hr_bn_id);
            $("#hr_bn_associate_name").empty().val(data.hr_bn_associate_name);
            $("#hr_bn_unit").empty().val(data.hr_unit_name_bn);
            $("#hr_bn_department").empty().val(data.hr_department_name_bn);
            $("#hr_bn_designation").empty().val(data.hr_designation_name_bn);
            $("#hr_bn_doj").empty().val(convertE2B(data.as_doj));
            $("#hr_bn_father_name").empty().val(data.hr_bn_father_name);
            $("#hr_bn_mother_name").empty().val(data.hr_bn_mother_name);
            $("#hr_bn_spouse_name").empty().val(data.hr_bn_spouse_name);

            $("#hr_bn_permanent_village").empty().val(data.hr_bn_permanent_village);
            $("#hr_bn_permanent_po").empty().val(data.hr_bn_permanent_po);
            $("#hr_bn_permanent_upazilla").empty().val(data.permanent_upazilla_bn);
            $("#hr_bn_permanent_district").empty().val(data.permanent_district_bn);

            $("#hr_bn_present_road").empty().val(data.hr_bn_present_road);
            $("#hr_bn_present_house").empty().val(data.hr_bn_present_house);
            $("#hr_bn_present_po").empty().val(data.hr_bn_present_po);
            $("#hr_bn_present_upazilla").empty().val(data.present_upazilla_bn);
            $("#hr_bn_present_district").empty().val(data.present_district_bn);


            //display employee informaiton in english 
            $("#associateInformation").html(
                "<dl class=\"dl-horizontal\">"+
                    "<dt>Associate's ID</dt><dd>"+data.associate_id+"</dd>"+
                    "<dt>Associate's Name</dt><dd>"+data.as_name+"</dd>"+
                    "<dt>Unit</dt><dd>"+data.hr_unit_name+"</dd>"+
                    "<dt>Department</dt><dd>"+data.hr_department_name+"</dd>"+
                    "<dt>Designation</dt><dd>"+data.hr_designation_name+"</dd>"+
                    "<dt>Date of Joining</dt><dd>"+data.as_doj+"</dd>"+
                    "<dt>Father's Name</dt><dd>"+data.emp_adv_info_fathers_name+"</dd>"+
                    "<dt>Mother's Name</dt><dd>"+data.emp_adv_info_mothers_name+"</dd>"+
                    "<dt>Spouse's Name</dt><dd>"+data.emp_adv_info_spouse+"</dd>"+
                    "<legend><small>Permanent Address</small></legend>"+
                    "<dt>Village</dt><dd>"+data.emp_adv_info_per_vill+"</dd>"+
                    "<dt>Post Office</dt><dd>"+data.emp_adv_info_per_po+"</dd>"+
                    "<dt>Upazilla</dt><dd>"+data.permanent_upazilla+"</dd>"+
                    "<dt>District</dt><dd>"+data.permanent_district+"</dd>"+
                    "<legend><small>Present Address</small></legend>"+
                    "<dt>House No</dt><dd>"+data.emp_adv_info_pres_house_no+"</dd>"+
                    "<dt>Road No</dt><dd>"+data.emp_adv_info_pres_road+"</dd>"+
                    "<dt>Post Office</dt><dd>"+data.emp_adv_info_pres_po+"</dd>"+
                    "<dt>Upazilla</dt><dd>"+data.present_upazilla+"</dd>"+
                    "<dt>District</dt><dd>"+data.present_district+"</dd>"+
                "</dl>"
            );


        },
        error: function(xhr)
        {
            alert('failed...');
        }
    });
}

// Education History
function educationHistory(associate_id)
{

    $.ajax({
        url: '{{ url("hr/recruitment/education_history") }}',
        dataType: 'json',
        data: {associate_id: associate_id},
        success: function(data)
        { 
            $("#educationHistory").html(data); 
        },
        error: function(xhr)
        {
            alert('failed...');
        }
    });
}

</script>

@endsection