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
                <li>Performance</li>
				<li class="active">Performance Appraisal</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Performance <small> <i class="ace-icon fa fa-angle-double-right"></i> Performance Appraisal</small></h1>
            </div>

            <div class="row">

                <!-- Display Erro/Success Message -->
                @include('inc/message')


                {{ Form::open(['url'=>'hr/performance/appraisal', 'class'=>'form-horizontal']) }}
                    <div class="col-xs-12">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10" style=" padding: 10px 0px  10px 5px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="hr_pa_as_id"> Associate's ID<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-9">
                                    {{ Form::select('hr_pa_as_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'hr_pa_as_id', 'class'=> 'associates no-select col-xs-10 col-sm-7', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="hr_pa_as_name"> Associate's Name </label>
                                <div class="col-sm-9">
                                    <input type="text" id="hr_pa_as_name"  class="col-xs-10 col-sm-7" placeholder="Associate's Name"  data-validation="required" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="hr_pa_department"> Department</label>
                                <div class="col-sm-9">
                                    <input type="text" id="hr_pa_department" placeholder="Department" class="col-xs-10 col-sm-7" class="col-xs-10 col-sm-5" data-validation="required" readonly/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="unit_floor_line">Unit/Floor/Line</label>
                                <div class="col-sm-9">
                                    <input type="text" id="unit_floor_line" placeholder="Line" class="col-xs-10 col-sm-7" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_pa_report_from"> Reporting Period<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                <span class="input-icon">
                                    <input type="date" name="hr_pa_report_from" id="hr_pa_report_from" class="col-xs-12" data-validation="required" data-validation-error-msg="The Start Date field is required" />
                                </span> 
                                <span class="input-icon input-icon-right">
                                    <input type="date" name="hr_pa_report_to" id="hr_pa_report_to" class="col-xs-12" data-validation="required"data-validation-error-msg="The End Date field is required" /> 
                                </span> 
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Work Ethics -->

                    <div class="col-xs-12"><br><br></div>
                    <div class="col-xs-12">
                        <legend style="text-indent: 100px;"><b>Work Ethics</b></legend>
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10" style="padding-top: 20px;">

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_punctuality" style="text-align: left;"> Punctual To work<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_punctuality" name="hr_pa_punctuality" type="radio" class="ace" value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_punctuality" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_reasoning" style="text-align: left;"> Accepts Work Load without reasoning<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_reasoning" name="hr_pa_reasoning" type="radio" class="ace" value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_reasoning" type="radio" class="ace" value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_job_acceptance" style="text-align: left;"> Completes given job within stipulated/acceptable time frame<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_job_acceptance" name="hr_pa_job_acceptance" type="radio" class="ace"  value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_job_acceptance" type="radio" class="ace" value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_owner_sense" style="text-align: left;"> Sense of Ownership in all given responsibility<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_owner_sense" name="hr_pa_owner_sense" type="radio" class="ace" value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_owner_sense" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_rw_sense" style="text-align: left;">In all Interaction his/her sense of right & wrong reflects his ethical mind set<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_rw_sense" name="hr_pa_rw_sense" type="radio" class="ace" value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_rw_sense" type="radio" class="ace" value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_idea_thought" style="text-align: left;">Does he/she accepts new ideas/chanllenges positively and thinks out of box  to acomplish<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_idea_thought" name="hr_pa_idea_thought" type="radio" class="ace" value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_idea_thought" type="radio" class="ace" value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_coleague_interaction" style="text-align: left;">Interaction with colleagues is mostly positive<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_coleague_interaction" name="hr_pa_coleague_interaction" type="radio" class="ace"  value="1" data-validation="required"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_coleague_interaction" type="radio" class="ace" value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_meet_kpi" style="text-align: left;">Was able to meet or exceed given KPIs<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_meet_kpi" name="hr_pa_meet_kpi" type="radio" class="ace" data-validation="required" value="1" />
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_meet_kpi" type="radio" class="ace" value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- section B -->

                    <div class="col-xs-12">
                        <legend style="text-indent: 100px;"><b>Reflection of Performance<span style="color: red">&#42;</span></b></legend>
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10" style="padding-top: 20px;"> 
                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_communication" style="text-align: left;"> Does he/she  can communicate both verbally and writing lucidly and rationall?<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_communication" name="hr_pa_communication" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_communication" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_cause_analysis" style="text-align: left;"> In every given issues can he/she do the root cause analysis and resolve methodology?<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_cause_analysis" name="hr_pa_cause_analysis" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_cause_analysis" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_professionality" style="text-align: left;"> Instead of working hard; is he/she is smart in discharging given job proessionally?<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_professionality" name="hr_pa_professionality" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_professionality" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_target_set" style="text-align: left;"> Does he/she hit the target as set forth?<span style="color: red">&#42;</span> </label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_target_set" name="hr_pa_target_set" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_target_set" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_job_interest" style="text-align: left;">Does he/she places job interest above self-interest?<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_job_interest" name="hr_pa_job_interest" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_job_interest" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_out_perform" style="text-align: left;">Does he/she outperform  his/her colleagues of he same Dept/Sec?<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_out_perform" name="hr_pa_out_perform" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_out_perform" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label class="col-xs-7 control-label no-padding-right" for="hr_pa_team_work" style="text-align: left;">Is he/she helpfull to the team members and work as a team?<span style="color: red">&#42;</span></label>
                            <div class="col-xs-5">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_team_work" name="hr_pa_team_work" type="radio" class="ace" data-validation="required" value="1"/>
                                        <span class="lbl"> Yes</span>
                                    </label>
                                    <label>
                                        <input name="hr_pa_team_work" type="radio" class="ace"  value="0" />
                                        <span class="lbl"> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- primaty assesment -->

                    <div class="col-xs-12"><br><br></div>
                    <div class="col-xs-12">
                        <legend style="text-indent: 100px;"><b>Primary Assesment<span style="color: red">&#42;</span></b></legend>
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10" style="padding-top: 20px;">

                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <label>
                                        <input id="hr_pa_primary_assesment" name="hr_pa_primary_assesment" type="radio" class="ace" data-validation="required" value="0" />
                                        <span class="lbl"> DOES NOT MEETS EXPECTATION</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input name="hr_pa_primary_assesment" type="radio" class="ace" value="1" />
                                        <span class="lbl"> PARTIALLY MEETS EXPECATATION</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input name="hr_pa_primary_assesment" type="radio" class="ace" value="2" />
                                        <span class="lbl"> MEETS EXPECTATION SATISFACTORILY </span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input name="hr_pa_primary_assesment" type="radio" class="ace" value="3" />
                                        <span class="lbl"> EXCEEDS SATISFACTIONS</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- professional attributes -->

                    <div class="col-xs-12"><br><br></div>
                    <div class="col-xs-12">
                        <legend style="text-indent: 100px;"><b>Professional Attributes that Needs Improvement (3)</b></legend>
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10" style="padding-top: 20px;">

                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="hr_pa_first_attribute"> 1. </label>
                            <div class="col-sm-9">
                                <input name="hr_pa_first_attribute" type="text" id="hr_pa_first_attribute" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="hr_pa_second_attribute"> 2. </label>
                            <div class="col-sm-9">
                                <input name="hr_pa_second_attribute" type="text" id="hr_pa_second_attribute" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="hr_pa_third_attribute"> 3. </label>
                            <div class="col-sm-9">
                                <input name="hr_pa_third_attribute" type="text" id="hr_pa_third_attribute" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
                            </div>                            
                        </div>
                    </div>
                    </div>

                    <!-- primaty assesment -->

                    <div class="col-xs-12"><br><br></div>
                        <div class="col-xs-12">
                            <legend style="text-indent: 100px;"><b>Final Assesment by the Appraisal</b></legend>
                        <div class="col-xs-1"></div> 
                        <div class="col-xs-10" style="padding-top: 20px;">

                            <div class="form-group">
                                <label class="col-xs-7 control-label no-padding-right" for="hr_pa_long_retention" style="text-align: left;"> Worth for long term retention<span style="color: red">&#42;</span> </label>
                                <div class="col-xs-5">
                                    <div class="radio">
                                        <label>
                                            <input id="hr_pa_long_retention" name="hr_pa_long_retention" type="radio" class="ace" value="1" data-validation="required" />
                                            <span class="lbl"> Yes</span>
                                        </label>
                                        <label>
                                            <input name="hr_pa_long_retention" type="radio" class="ace" value="0" />
                                            <span class="lbl"> No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-7 control-label no-padding-right" for="hr_pa_promotion_recommendation" style="text-align: left;"> Increment/Promotion recommended<span style="color: red">&#42;</span> </label>
                                <div class="col-xs-5">
                                    <div class="radio">
                                        <label>
                                            <input id="hr_pa_promotion_recommendation" name="hr_pa_promotion_recommendation" type="radio" class="ace"  data-validation="required" value="1" />
                                            <span class="lbl"> Yes</span>
                                        </label>
                                        <label>
                                            <input name="hr_pa_promotion_recommendation" type="radio" class="ace" value="0" />
                                            <span class="lbl"> No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-7 control-label no-padding-right" for="hr_pa_replacement" style="text-align: left;"> Needs to be replaced<span style="color: red">&#42;</span> </label>
                                <div class="col-xs-5">
                                    <div class="radio">
                                        <label>
                                            <input id="hr_pa_replacement" name="hr_pa_replacement" type="radio" class="ace" value="1" data-validation="required"/>
                                            <span class="lbl"> Yes</span>
                                        </label>
                                        <label>
                                            <input name="hr_pa_replacement" type="radio" class="ace" value="0"  />
                                            <span class="lbl"> No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- remarks -->

                    <div class="col-xs-12"><br><br></div>
                    <div class="col-xs-12">
                        <legend style="text-indent: 100px;"><b>Remarks</b></legend>
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10" style="padding-top: 20px;">

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="hr_pa_remarks_dept_head" style="text-align: left;" > Dept.  Head </label>
                            <div class="col-sm-8">
                                <input name="hr_pa_remarks_dept_head" type="text" id="hr_pa_remarks_dept_head" placeholder="Dept. Head Remarks" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="hr_pa_remarks_hr_head" style="text-align: left;"> HR Head </label>
                            <div class="col-sm-8">
                                <input name="hr_pa_remarks_hr_head" type="text" id="hr_pa_remarks_hr_head" placeholder="HR Head Remarks" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="hr_pa_remarks_incharge" style="text-align: left;"> Factory In Charge </label>
                            <div class="col-sm-8">
                                <input name="hr_pa_remarks_incharge" type="text" id="hr_pa_remarks_incharge" placeholder="Factory In Charge Comments" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="hr_pa_remarks_ceo" style="text-align: left;"> CEO </label>
                            <div class="col-sm-8">
                                <input name="hr_pa_remarks_ceo" type="text" id="hr_pa_remarks_ceo" placeholder="CEO's Remarks" class="col-xs-10 col-sm-10" data-validation="length" data-validation-length="0-255"/>
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
                    </div>
                    </div>
                {{ Form::close() }}
                    <!-- PAGE CONTENT ENDS -->
            </div>
                <!-- /.col -->
        </div>
    </div><!-- /.page-content -->
</div>
<script type="text/javascript">
$(document).ready(function()
{   
    $('select.associates').select2({
        
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



    // retrive all information 
    var name       = $("#hr_pa_as_name");
    var department = $("#hr_pa_department");
    var line       = $("#unit_floor_line");
    $('body').on('change', '.associates', function(){
        $.ajax({
            url: '{{ url("hr/associate") }}',
            dataType: 'json',
            data: {associate_id: $(this).val()},
            success: function(data)
            {
                name.val(data.as_name);
                department.val(data.hr_department_name);
                line.val(data.unit_floor_line);
            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
    });

});
</script>
@endsection