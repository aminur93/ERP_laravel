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
                <li class="active"> Advance Information</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment <small> <i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Advance Information</small></h1>
            </div>

        <div class="row">
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
                            <div id="advanceInfo" class="tab-pane fade in active">
                                <form class="form-horizontal" role="form" method="post" action="{{ url('hr/recruitment/operation/advance_info') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }} 

                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_as_id"> Associate's ID </label>
                                        <div class="col-sm-9">
                                            {{ Form::select('emp_adv_info_as_id', [], null,['placeholder'=>'Select Associate\'s ID', 'data-validation'=> 'required', 'id'=>'emp_adv_info_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'style'=> 'width:40%']) }}  
                                        </div>
                                    </div>

                                   
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_stat"> Status </label>
                                        <div class="col-sm-9">
                                            <div class="radio">
                                                <label>
                                                    <input id="permRadio" name="emp_adv_info_stat" type="radio" class="ace" value="1"/>
                                                    <span class="lbl"> Permanent</span>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input name="emp_adv_info_stat" id="probRadio" type="radio" class="ace" value="0"/>
                                                    <span class="lbl">Probationary</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group hide" id="probationaryPeriod">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_prob_period"> Probationary Period<span style="color: red">&#42;</span>(Month)</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="emp_adv_info_prob_period" name="emp_adv_info_prob_period" data-validation=" required length number" data-validation-length="1-2" placeholder="Probationary Period in Month" class="col-xs-10 col-sm-5" data-validation-error-msg="Probationary Period required in Month less or equal 2 digits" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_nationality"> Nationality </label>
                                        <div class="col-sm-9">
                                            <select name="emp_adv_info_nationality" id="emp_adv_info_nationality" class="col-xs-10 col-sm-5 no-select" data-validation-error-msg="The Nationality field is required"  >
                                                <option value="">Please Select Nationality</option>
                                                <option value="afghan">Afghan</option>
                                                <option value="albanian">Albanian</option>
                                                <option value="algerian">Algerian</option>
                                                <option value="american">American</option>
                                                <option value="andorran">Andorran</option>
                                                <option value="angolan">Angolan</option>
                                                <option value="antiguans">Antiguans</option>
                                                <option value="argentinean">Argentinean</option>
                                                <option value="armenian">Armenian</option>
                                                <option value="australian">Australian</option>
                                                <option value="austrian">Austrian</option>
                                                <option value="azerbaijani">Azerbaijani</option>
                                                <option value="bahamian">Bahamian</option>
                                                <option value="bahraini">Bahraini</option>
                                                <option value="bangladeshi" selected>Bangladeshi</option>
                                                <option value="barbadian">Barbadian</option>
                                                <option value="barbudans">Barbudans</option>
                                                <option value="batswana">Batswana</option>
                                                <option value="belarusian">Belarusian</option>
                                                <option value="belgian">Belgian</option>
                                                <option value="belizean">Belizean</option>
                                                <option value="beninese">Beninese</option>
                                                <option value="bhutanese">Bhutanese</option>
                                                <option value="bolivian">Bolivian</option>
                                                <option value="bosnian">Bosnian</option>
                                                <option value="brazilian">Brazilian</option>
                                                <option value="british">British</option>
                                                <option value="bruneian">Bruneian</option>
                                                <option value="bulgarian">Bulgarian</option>
                                                <option value="burkinabe">Burkinabe</option>
                                                <option value="burmese">Burmese</option>
                                                <option value="burundian">Burundian</option>
                                                <option value="cambodian">Cambodian</option>
                                                <option value="cameroonian">Cameroonian</option>
                                                <option value="canadian">Canadian</option>
                                                <option value="cape verdean">Cape Verdean</option>
                                                <option value="central african">Central African</option>
                                                <option value="chadian">Chadian</option>
                                                <option value="chilean">Chilean</option>
                                                <option value="chinese">Chinese</option>
                                                <option value="colombian">Colombian</option>
                                                <option value="comoran">Comoran</option>
                                                <option value="congolese">Congolese</option>
                                                <option value="costa rican">Costa Rican</option>
                                                <option value="croatian">Croatian</option>
                                                <option value="cuban">Cuban</option>
                                                <option value="cypriot">Cypriot</option>
                                                <option value="czech">Czech</option>
                                                <option value="danish">Danish</option>
                                                <option value="djibouti">Djibouti</option>
                                                <option value="dominican">Dominican</option>
                                                <option value="dutch">Dutch</option>
                                                <option value="east timorese">East Timorese</option>
                                                <option value="ecuadorean">Ecuadorean</option>
                                                <option value="egyptian">Egyptian</option>
                                                <option value="emirian">Emirian</option>
                                                <option value="equatorial guinean">Equatorial Guinean</option>
                                                <option value="eritrean">Eritrean</option>
                                                <option value="estonian">Estonian</option>
                                                <option value="ethiopian">Ethiopian</option>
                                                <option value="fijian">Fijian</option>
                                                <option value="filipino">Filipino</option>
                                                <option value="finnish">Finnish</option>
                                                <option value="french">French</option>
                                                <option value="gabonese">Gabonese</option>
                                                <option value="gambian">Gambian</option>
                                                <option value="georgian">Georgian</option>
                                                <option value="german">German</option>
                                                <option value="ghanaian">Ghanaian</option>
                                                <option value="greek">Greek</option>
                                                <option value="grenadian">Grenadian</option>
                                                <option value="guatemalan">Guatemalan</option>
                                                <option value="guinea-bissauan">Guinea-Bissauan</option>
                                                <option value="guinean">Guinean</option>
                                                <option value="guyanese">Guyanese</option>
                                                <option value="haitian">Haitian</option>
                                                <option value="herzegovinian">Herzegovinian</option>
                                                <option value="honduran">Honduran</option>
                                                <option value="hungarian">Hungarian</option>
                                                <option value="icelander">Icelander</option>
                                                <option value="indian">Indian</option>
                                                <option value="indonesian">Indonesian</option>
                                                <option value="iranian">Iranian</option>
                                                <option value="iraqi">Iraqi</option>
                                                <option value="irish">Irish</option>
                                                <option value="israeli">Israeli</option>
                                                <option value="italian">Italian</option>
                                                <option value="ivorian">Ivorian</option>
                                                <option value="jamaican">Jamaican</option>
                                                <option value="japanese">Japanese</option>
                                                <option value="jordanian">Jordanian</option>
                                                <option value="kazakhstani">Kazakhstani</option>
                                                <option value="kenyan">Kenyan</option>
                                                <option value="kittian and nevisian">Kittian and Nevisian</option>
                                                <option value="kuwaiti">Kuwaiti</option>
                                                <option value="kyrgyz">Kyrgyz</option>
                                                <option value="laotian">Laotian</option>
                                                <option value="latvian">Latvian</option>
                                                <option value="lebanese">Lebanese</option>
                                                <option value="liberian">Liberian</option>
                                                <option value="libyan">Libyan</option>
                                                <option value="liechtensteiner">Liechtensteiner</option>
                                                <option value="lithuanian">Lithuanian</option>
                                                <option value="luxembourger">Luxembourger</option>
                                                <option value="macedonian">Macedonian</option>
                                                <option value="malagasy">Malagasy</option>
                                                <option value="malawian">Malawian</option>
                                                <option value="malaysian">Malaysian</option>
                                                <option value="maldivan">Maldivan</option>
                                                <option value="malian">Malian</option>
                                                <option value="maltese">Maltese</option>
                                                <option value="marshallese">Marshallese</option>
                                                <option value="mauritanian">Mauritanian</option>
                                                <option value="mauritian">Mauritian</option>
                                                <option value="mexican">Mexican</option>
                                                <option value="micronesian">Micronesian</option>
                                                <option value="moldovan">Moldovan</option>
                                                <option value="monacan">Monacan</option>
                                                <option value="mongolian">Mongolian</option>
                                                <option value="moroccan">Moroccan</option>
                                                <option value="mosotho">Mosotho</option>
                                                <option value="motswana">Motswana</option>
                                                <option value="mozambican">Mozambican</option>
                                                <option value="namibian">Namibian</option>
                                                <option value="nauruan">Nauruan</option>
                                                <option value="nepalese">Nepalese</option>
                                                <option value="new zealander">New Zealander</option>
                                                <option value="ni-vanuatu">Ni-Vanuatu</option>
                                                <option value="nicaraguan">Nicaraguan</option>
                                                <option value="nigerien">Nigerien</option>
                                                <option value="north korean">North Korean</option>
                                                <option value="northern irish">Northern Irish</option>
                                                <option value="norwegian">Norwegian</option>
                                                <option value="omani">Omani</option>
                                                <option value="pakistani">Pakistani</option>
                                                <option value="palauan">Palauan</option>
                                                <option value="panamanian">Panamanian</option>
                                                <option value="papua new guinean">Papua New Guinean</option>
                                                <option value="paraguayan">Paraguayan</option>
                                                <option value="peruvian">Peruvian</option>
                                                <option value="polish">Polish</option>
                                                <option value="portuguese">Portuguese</option>
                                                <option value="qatari">Qatari</option>
                                                <option value="romanian">Romanian</option>
                                                <option value="russian">Russian</option>
                                                <option value="rwandan">Rwandan</option>
                                                <option value="saint lucian">Saint Lucian</option>
                                                <option value="salvadoran">Salvadoran</option>
                                                <option value="samoan">Samoan</option>
                                                <option value="san marinese">San Marinese</option>
                                                <option value="sao tomean">Sao Tomean</option>
                                                <option value="saudi">Saudi</option>
                                                <option value="scottish">Scottish</option>
                                                <option value="senegalese">Senegalese</option>
                                                <option value="serbian">Serbian</option>
                                                <option value="seychellois">Seychellois</option>
                                                <option value="sierra leonean">Sierra Leonean</option>
                                                <option value="singaporean">Singaporean</option>
                                                <option value="slovakian">Slovakian</option>
                                                <option value="slovenian">Slovenian</option>
                                                <option value="solomon islander">Solomon Islander</option>
                                                <option value="somali">Somali</option>
                                                <option value="south african">South African</option>
                                                <option value="south korean">South Korean</option>
                                                <option value="spanish">Spanish</option>
                                                <option value="sri lankan">Sri Lankan</option>
                                                <option value="sudanese">Sudanese</option>
                                                <option value="surinamer">Surinamer</option>
                                                <option value="swazi">Swazi</option>
                                                <option value="swedish">Swedish</option>
                                                <option value="swiss">Swiss</option>
                                                <option value="syrian">Syrian</option>
                                                <option value="taiwanese">Taiwanese</option>
                                                <option value="tajik">Tajik</option>
                                                <option value="tanzanian">Tanzanian</option>
                                                <option value="thai">Thai</option>
                                                <option value="togolese">Togolese</option>
                                                <option value="tongan">Tongan</option>
                                                <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                                <option value="tunisian">Tunisian</option>
                                                <option value="turkish">Turkish</option>
                                                <option value="tuvaluan">Tuvaluan</option>
                                                <option value="ugandan">Ugandan</option>
                                                <option value="ukrainian">Ukrainian</option>
                                                <option value="uruguayan">Uruguayan</option>
                                                <option value="uzbekistani">Uzbekistani</option>
                                                <option value="venezuelan">Venezuelan</option>
                                                <option value="vietnamese">Vietnamese</option>
                                                <option value="welsh">Welsh</option>
                                                <option value="yemenite">Yemenite</option>
                                                <option value="zambian">Zambian</option>
                                                <option value="zimbabwean">Zimbabwean</option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_birth_cer">Birth Certificate (pdf|doc|docx|jpg|jpeg|png) </label>
                                        <div class="col-sm-9">
                                            <input type="file" name="emp_adv_info_birth_cer" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                            data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_city_corp_cer">City Corp. Certificate (pdf|doc|docx|jpg|jpeg|png) </label>
                                        <div class="col-sm-9">
                                            <input type="file" name="emp_adv_info_city_corp_cer" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                            data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_police_veri">NID/Passport (pdf|doc|docx|jpg|jpeg|png) </label>
                                        <div class="col-sm-9">
                                            <input type="file" name="emp_adv_info_police_veri" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="1M"
                                            data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_passport"> NID/Passport No </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="emp_adv_info_passport" placeholder="NID or Passport No" class="col-xs-10 col-sm-5" data-validation="length" data-validation-length="0-64" data-validation-error-msg="Designation  between 0-64 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_refer_name"> Reference Name </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="emp_adv_info_refer_name" placeholder="Reference Name" class="col-xs-10 col-sm-5" data-validation="custom length" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="Reference Name  between 0-64 characters" style='text-transform:uppercase'/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_refer_contact"> Reference Contact </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="emp_adv_info_refer_contact" placeholder="Reference Contact" class="col-xs-10 col-sm-5" data-validation="length number" data-validation-length="0-11" data-validation-optional="true" data-validation-error-msg="Reference Contact between 0-11 digits" />
                                        </div>
                                    </div>

                                    <!-- added from  basic info -->
                                     <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_fathers_name"> Father's Name </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_fathers_name" type="text" id="father_name" placeholder="Father's Name" class="col-xs-10 col-sm-5" data-validation=" length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="The Father's Name has to be an alphabet value between 0-64 characters" style='text-transform:uppercase'/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_mothers_name"> Mother's Name </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_mothers_name" type="text" id="mother_name" placeholder="Mother's Name" class="col-xs-10 col-sm-5" data-validation=" length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"   data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="The Mother's Name has to be an alphabet value between 0-64 characters" style='text-transform:uppercase'/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_marital_stat"> Marital Status </label>
                                        <div class="col-sm-9">
                                            <select name="emp_adv_info_marital_stat" id="married_unmarried" class="col-xs-10 col-sm-5 no-select" data-validation-error-msg="The Marital Status field is required"  >
                                                <option value="">Select Marital Status</option>
                                                <option value="Married">Married</option>
                                                <option value="Unmarried">Unmarried</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="marritalInfo" class="hide">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_spouse">Spouse (Husband/Wife) </label>
                                            <div class="col-sm-9">
                                                <input name="emp_adv_info_spouse" type="text" id="Spouse" placeholder="Spouse (Husband/Wife)" class="col-xs-10 col-sm-5"  data-validation="length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"  data-validation-length="0-64" data-validation-optional="true" data-validation-error-msg="The Spouse's Name has to be an alphabet value between 0-64 characters"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_children">Children (if applicable ) </label>
                                            <div class="col-sm-9">
                                                <input name="emp_adv_info_children" type="text" id="Children" placeholder="Children (if applicable )" class="col-xs-10 col-sm-5" data-validation="length custom" data-validation-regexp="^([0-9]+)$"  data-validation-length="0-2" data-validation-optional="true" data-validation-error-msg="The Children has to be an numeric value between 0-2 digits"/>
                                            </div>
                                        </div>
                                     </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_religion"> Religion </label>
                                        <div class="col-sm-9">
                                            <select name="emp_adv_info_religion" class="col-xs-10 col-sm-5 no-select" id="religion" data-validation-error-msg="The Religion field is required">
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
                                            <input name="emp_adv_info_pre_org" type="text" id="previous_org_name" placeholder="Name of Previous Organization" class="col-xs-10 col-sm-5"  
                                             data-validation="length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$"  data-validation-length="3-255" data-validation-optional="true" data-validation-error-msg="The Previous Organization has to be an alphabet value between 3-255 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_work_exp"> Work Experience </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_work_exp" type="text" id="experience" placeholder="Work Experience in Year" class="col-xs-10 col-sm-5" data-validation="number" data-validation-optional="true" data-validation-allowing="range[0;50,float]" data-validation-error-msg="The Work Experience my be 0 to 50 years" />
                                        </div>
                                    </div>

                                    <div class="addRemove">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_nom_name"> Nominee Name</label>
                                            <div class="col-sm-9">
                                                <input name="emp_adv_info_nom_name[]" type="text" id="Nominee" placeholder="Nominee Name" class="col-xs-3 col-sm-3" data-validation="length custom"  data-validation-optional="true" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="3-64" data-validation-allowing=" _-" data-validation-error-msg="The Nominee Name has to be an alphabet value between 3-64 characters" style='text-transform:uppercase'/>

                                                <input name="emp_adv_info_nom_relation[]" type="text" id="Relation" placeholder="Relation with Nominee" class="col-xs-3 col-sm-3" data-validation="length custom"  data-validation-optional="true" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="1-64" data-validation-allowing=" _-" data-validation-error-msg="The Nominee Name has to be an alphabet value between 3-64 characters"/>

                                                <input name="emp_adv_info_nom_per[]" type="text" id="Percent" placeholder="(%)" class="col-xs-2 col-sm-1"  data-validation="alphanumeric" data-validation-optional="true" data-validation-allowing=" _-%" data-validation-length="1-32" data-validation-error-msg="The Percentage has to be an alphanumeric value between 1-32 characters" />

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
                                            <input name="emp_adv_info_per_vill" type="text" id="as_per_vill" placeholder="Village" class="col-xs-10 col-sm-5" data-validation=" length" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true"
                                            data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-error-msg="The Village has to be an alphanumeric value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_po"> PO </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_per_po" type="text" id="as_per_po" placeholder="PO" class="col-xs-10 col-sm-5" data-validation=" length" data-validation-length="0-124" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-allowing=" -" data-validation-optional="true" data-validation-error-msg="The PO has to be a value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_dist"> District </label>
                                        <div class="col-sm-9"> 
                                            {{ Form::select('emp_adv_info_per_dist', $districtList, null, ['placeholder'=>'Select District', 'id'=>'as_per_dis', 'class'=> 'col-xs-10 col-sm-5']) }}  
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_per_upz"> Upazilla </label>
                                        <div class="col-sm-9"> 
                                            {{ Form::select('emp_adv_info_per_upz', [], null, ['placeholder'=>'Select Upazilla', 'id'=>'as_per_upz', 'class'=> 'no-select col-xs-10 col-sm-5']) }} 
                                        </div>
                                    </div>

                                    <legend>Present Address</legend>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_house_no"> House No </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_pres_house_no" type="text" id="house_no" placeholder="House No" class="col-xs-10 col-sm-5" data-validation=" length" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-error-msg="The House No has to be a value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_road"> Road </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_pres_road" type="text" id="Road" placeholder="Road" class="col-xs-10 col-sm-5"  data-validation=" length" data-validation-length="0-124" data-validation-optional="true" data-validation-allowing=" -" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-error-msg="The Road has to be an alphanumeric value between 1-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_po"> PO </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_pres_po" type="text" id="PO" placeholder="PO" class="col-xs-10 col-sm-5"  data-validation="custom length" data-validation-length="0-124" data-validation-allowing=" -"  data-validation-optional="true" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-error-msg="The Road has to be an alphanumeric value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_dist"> District </label>
                                        <div class="col-sm-9"> 
                                            {{ Form::select('emp_adv_info_pres_dist', $districtList, null, ['placeholder'=>'Select District', 'id'=>'as_pre_dis', 'class'=> 'col-xs-10 col-sm-5', 'data-validation-error-msg'=>'The District field is required']) }}  
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_pres_upz"> Upazilla </label>
                                        <div class="col-sm-9"> 
                                            {{ Form::select('emp_adv_info_pres_upz', [], null, [ 'placeholder' =>'Select Upazilla', 'id'=>'as_pre_upz', 'class'=> 'no-select col-xs-10 col-sm-5']) }} 
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_job_app">Job Application (pdf|doc|docx|jpg|jpeg|png) </label>
                                        <div class="col-sm-9">
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
                                            <input name="emp_adv_info_emg_con_name" type="text" id="emergency_contact_name" placeholder="Emergency Contact Name" class="col-xs-10 col-sm-5" data-validation="length custom" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-length="0-124" data-validation-optional="true" data-validation-error-msg="The Emergency Contact Name has to be an alphabet value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_emg_con_num"> Emergency Contact Number </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_emg_con_num" type="text" id="emergency_contact_number" placeholder="Emergency Contact Number" class="col-xs-10 col-sm-5"  data-validation="length alphanumeric" data-validation-length="0-124" data-validation-allowing=" -" data-validation-optional="true" data-validation-error-msg="The Emergency Contact No has to be an alphanumeric value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_bank_name">Mobile Banking/Bank Name </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_bank_name" type="text" id="bank_acc_name" placeholder="Mobile Banking/Bank Name " class="col-xs-10 col-sm-5"  data-validation="length custom" data-validation-length="0-124" data-validation-allowing=" -/" data-validation-regexp="^([.,-;:'& a-zA-Z]+)$" data-validation-optional="true" data-validation-error-msg="The Bank/Bkash/Ucash Account Name has to be an alphanumeric value between 0-124 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_bank_num">Account Number </label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_bank_num" type="text" id="bank_acc_number" placeholder="Account Number" class="col-xs-10 col-sm-5"  data-validation="length alphanumeric" data-validation-length="0-64" data-validation-allowing=" -/" data-validation-optional="true" data-validation-error-msg="The Bank/Bkash/Ucash Account Number has to be an alphanumeric value between 0-64 characters"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_tin">TIN/ETIN</label>
                                        <div class="col-sm-9">
                                            <input name="emp_adv_info_tin" type="text" id="tin_etin" placeholder="TIN/ETIN" class="col-xs-10 col-sm-5" data-validation="length alphanumeric" data-validation-length="0-32" data-validation-allowing=" -/" data-validation-optional="true" data-validation-error-msg="The TIN/ETIN has to be a alphanumeric value between 0-32 characters"/>
                                        </div>
                                    </div> 
                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="emp_adv_info_finger_print">Finger Print (jpg|jpeg|png)</label>
                                        <div class="col-sm-9">
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
                            </div>
                            <div id="educationInfo" class="tab-pane fade">
                                <h5 style="color: red">*All fields are required</h5>
                                <br>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('hr/recruitment/operation/education_info')}}" enctype="multipart/form-data">
                                    <div class="row">
                                        {{ csrf_field() }} 
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="education_as_id"> Associate's ID </label>
                                                <div class="col-sm-9">
                                                    {{ Form::select('education_as_id', [], null,['placeholder'=>'Select Associate\'s ID', 'data-validation'=> 'required', 'id'=>'education_as_id', 'class'=> 'associates no-select', 'style'=> 'width:100%']) }}  
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
                                            <input name="education_degree_id_2" type="text" id="education_degree_id_2" placeholder="Exam/Degree Title" class="col-xs-12"  data-validation="length alphanumeric required" data-validation-length="0-255" data-validation-allowing=" -$&" data-validation-error-msg="Exam/Degree Title is invalid"/>
                                            </div>
                                            </div>

                                            <div class="form-group hide" id="major">
                                            <label class="col-sm-3 control-label no-padding-right" for="education_major_group_concentation">Concentration/ Major/Group </label>
                                            <div class="col-sm-9">
                                            <input name="education_major_group_concentation" type="text" id="education_major_group_concentation" placeholder="Concentration/ Major/Group" class="col-xs-12"  data-validation="required length alphanumeric" data-validation-length="0-124" data-validation-allowing=" -$&" data-validation-error-msg="Concentration/ Major/Group Name invalid"/>
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
                                                <label class="col-sm-3 control-label no-padding-right" for="hr_bn_associate_id"> Associate's ID </label>
                                                <div class="col-sm-9"> 
                                                    {{ 
                                                        Form::select(
                                                            'hr_bn_associate_id', 
                                                            [
                                                                (!empty($bangla->associate_id)?$bangla->associate_id:null) => (!empty($bangla->as_name)?$bangla->as_name:null) .' - '. (!empty($bangla->associate_id)?$bangla->associate_id:null)
                                                            ],  
                                                            (!empty($bangla->associate_id)?$bangla->associate_id:null),
                                                            [
                                                                'placeholder'=>'Select Associate\'s ID', 
                                                                'id'=>'hr_la_as_id', 
                                                                'class'=> 'associates no-select',
                                                                'style'=> 'width:100%', 
                                                                'data-validation'=>'required',
                                                                'data-validation-error-msg' => 'The Associate\'s ID field is required'
                                                            ]
                                                        ) 
                                                    }}  
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
                        <!-- PAGE CONTENT ENDS -->
                    </div>
                <!-- /.col -->
                </div>
            </div><!-- /.page-content -->
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function()
{  

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

    $('#probRadio').on('change', function(){
        if (this.checked)
        {
            $("#probationaryPeriod").removeClass('hide', 500, "linear");
        }
        });
     $('#permRadio').on('change', function(){
        var prob= $('#probRadio');
        if(this.checked)
        {
            $("#probationaryPeriod").addClass('hide', 500, "linear");
        }
    }); 
        // if(this.checked){
        //     $('#probationaryPeriod').toggle();
        // }
        // else{
        //     $('#probationaryPeriod').toggle();
        // }
    


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

    // Education History

    $('body').on('change', '.associates', function(){
        $.ajax({
            url: '{{ url("hr/recruitment/education_history") }}',
            dataType: 'json',
            data: {associate_id: $(this).val()},
            success: function(data)
            {
                // var html = "";
                // $.each(data, function(i, v)
                // {
                //     html += "<tr>"+
                //         "<td>"+v.education_level_title+"</td>"+
                //         "<td>"+(v.education_degree_title)+"</td>"+
                //         "<td>"+v.education_level_id+"</td>"+
                //         "<td>"+v.education_degree_id_2+"</td>"+
                //         "<td>"+v.education_major_group_concentation+"</td>"+
                //         "<td>"+v.education_institute_name+"</td>"+
                //         "<td>"+v.education_result_title+"</td>"+
                //         "<td>"+v.education_result_id+"</td>"+
                //         "<td>"+v.education_result_marks+"</td>"+
                //         "<td>"+v.education_result_cgpa+"</td>"+
                //         "<td>"+v.education_result_scale+"</td>"+
                //         "<td>"+v.education_passing_year+"</td>"+
                //     "</tr>";
                // });
                // $("#educationHistory").html(html);
                $("#educationHistory").html(data);

            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
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
        $.ajax({
            url: '{{ url("hr/associate") }}',
            type: 'get',
            dataType: 'json',
            data: {associate_id: $(this).val()},
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
                        "<dt>Upazilla</dt><dd>"+data.hr_bn_present_upazilla+"</dd>"+
                        "<dt>District</dt><dd>"+data.hr_bn_present_district+"</dd>"+
                    "</dl>"
                );


            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
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
</script> 
@endsection 