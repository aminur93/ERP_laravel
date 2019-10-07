@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                   <a href="/"><i class="ace-icon fa fa-home home-icon"></i>Human Resource</a> 
                </li>
                <li>
                    <a href="#">Recruitment</a>
                </li>
                <li>
                    <a href="#">Employer</a>
                </li>
                <li class="active">Employee Information</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Employee Information</small></h1>
            </div>

			<div class="row"> 
				<div class="col-xs-12"> 
					<div id="user-profile-1" class="user-profile row">
						<div class="col-sm-3 center">
							<div>
								<span class="profile-picture">
									<img id="avatar" style="width: 180px; height: 200px;" class="img-responsive" alt="profile picture" src="{{ url($info->as_pic?$info->as_pic:'assets/images/avatars/profile-pic.jpg') }}" />
								</span>
								<div class="space-4"></div>
								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">

									<div class="inline position-relative">
										<a href="#" class="user-title-label">
											<span class="white">{{ $info->as_name}}</span>
										</a>
									</div>
								</div>
							</div>

							<div class="space-6"></div>
							<div class="profile-contact-info">
								<div class="profile-contact-links align-left">
									<p style="text-align: center;">{{ $info->hr_designation_name }}, {{ $info->hr_department_name }}</p>
									<p style="text-align: center;">{{ $info->hr_unit_name }}</p>
								</div>
							</div>

						</div>



						<div class="col-sm-9"> 
							<div id="accordion" class="accordion-style1 panel-group accordion-style2">
								<!-- Basic Information -->
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#basicInfo" aria-expanded="true">
												<i class="bigger-110 ace-icon glyphicon glyphicon-minus-sign" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i> 
												Basic Information
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse in" id="basicInfo" aria-expanded="true" style="">
										<div class="panel-body">
											<div class="profile-user-info">
												<div class="profile-info-row">
													<div class="profile-info-name"> Associate Id </div>
													<div class="profile-info-value">
														<span> {{ $info->associate_id }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Employee Type </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_emp_type_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Designation </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_designation_name }} </span>
													</div>
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name"> Area </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_area_name }} </span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Department </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_department_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Section </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_section_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Sub Section </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_subsec_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Unit</div>
													<div class="profile-info-value">
														<span> {{ $info->hr_unit_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Floor </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_floor_name }} </span>
													</div>
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name"> Line </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_line_name }} </span>
													</div>
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name"> Shift </div>
													<div class="profile-info-value">
														<span> {{ $info->hr_shift_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Gender </div>
													<div class="profile-info-value">
														<span> {{ $info->as_gender }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Date of Birth </div>
													<div class="profile-info-value">
														<span>
															{{ (!empty($info->as_dob)?(date("d-M-Y",strtotime($info->as_dob))):null) }}
														</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Contact NUmber </div>
													<div class="profile-info-value">
														<span> {{ $info->as_contact }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> OT Status </div>
													<div class="profile-info-value">
														<span> @if($info->as_ot == 0) Non OT @else OT @endif </span>
													</div>
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name"> Joining Date </div>
													<div class="profile-info-value">
														<span>
															{{ (!empty($info->as_doj)?(date("d-M-Y",strtotime($info->as_doj))):null) }}
														</span>
													</div>
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name"> Status</div>
													<div class="profile-info-value">
														<span>@if($info->as_status == 1) Active @else Inactive @endif </span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> 

								<!-- Advance Information -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#advanceInfo">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Advance Information
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="advanceInfo">
										<div class="panel-body">
											<div class="profile-user-info">

												<div class="profile-info-row">
													<div class="profile-info-name"> Job Status</div>
													<div class="profile-info-value">
														<span> 
														@if($info->emp_adv_info_stat == 1) 
															Permanent 
														@else 
															Probationary

														@endif
														<?php if($info->emp_adv_info_stat == 0) echo "(for ". $info->emp_adv_info_prob_period . " Months)";

														 ?>
														</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Nationality </div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_nationality }} </span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Birth Certificate</div>
													<div class="profile-info-value btn-group">
														@if(!empty($info->emp_adv_info_birth_cer))
														<a href="{{ url($info->emp_adv_info_birth_cer) }}" class="btn btn-xs btn-primary" target="_blank" title="View"><i class="fa fa-eye"></i> View</a>
														<a href="{{ url($info->emp_adv_info_birth_cer) }}" class="btn btn-xs btn-success" target="_blank" download title="Download"><i class="fa fa-download"></i> Download</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> City Corp. Certificate</div>  
													<div class="profile-info-value  btn-group">
														@if(!empty($info->emp_adv_info_city_corp_cer))
														<a href="{{ url($info->emp_adv_info_city_corp_cer) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_city_corp_cer) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-download"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Police Verification</div>

													<div class="profile-info-value btn-group">
														@if(!empty($info->emp_adv_info_police_veri))
														<a href="{{ url($info->emp_adv_info_police_veri) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_police_veri) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Passport Number</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_passport }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Reference Name</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_refer_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Reference Contact</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_refer_contact }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Reference Biodata</div>
													<div class="profile-info-value">
														<span> Bio Data </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Father's Name</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_fathers_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Mother's Name</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_mothers_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Marital Status</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_marital_stat }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Spouse Name</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_spouse }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Children</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_children }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Religion</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_religion }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Previous Organization</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_pre_org }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Work Experience</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_work_exp }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Permanent Address</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_per_vill }} {{ $info->emp_adv_info_per_po }} {{ $info->emp_adv_info_per_upz }} {{ $info->emp_adv_info_per_dist }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Present Address</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_pres_house_no }} {{ $info->emp_adv_info_pres_road }} {{ $info->emp_adv_info_pres_po }} {{ $info->emp_adv_info_pres_upz }} {{ $info->emp_adv_info_pres_dist }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">National Id</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_nid }} </span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name">Job Application</div>
													<div class="profile-info-value  btn-group">
														@if(!empty($info->emp_adv_info_job_app))
														<a href="{{ url($info->emp_adv_info_job_app) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_job_app) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name">CV</div>
													<div class="profile-info-value  btn-group">
														@if(!empty($info->emp_adv_info_cv))
														<a href="{{ url($info->emp_adv_info_cv) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_cv) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Emergency Contact Name</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_emg_con_name }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Emergency Contact Number</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_emg_con_num }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Bank Info</div>
													<div class="profile-info-value">
														<span> Bank Name: {{ $info->emp_adv_info_bank_name }}<br> Account N0:{{ $info->emp_adv_info_bank_num }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">TIN/ETIN</div>
													<div class="profile-info-value">
														<span> {{ $info->emp_adv_info_tin }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Finger Print</div>
													<div class="profile-info-value  btn-group">
														@if(!empty($info->emp_adv_info_finger_print))
														<a href="{{ url($info->emp_adv_info_finger_print) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_finger_print) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Signature</div>
													<div class="profile-info-value btn-group">
														@if(!empty($info->emp_adv_info_signature))
														<a href="{{ url($info->emp_adv_info_signature) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_signature) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Authorized Signature</div>
													<div class="profile-info-value btn-group">
														@if(!empty($info->emp_adv_info_auth_sig))
														<a href="{{ url($info->emp_adv_info_auth_sig) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->emp_adv_info_auth_sig) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Education History  -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#EducationHistory">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Education History 
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="EducationHistory">
										<div class="panel-body">
											@if(!empty($educations))
											<table class="table table-borderd table-compact">  
												<tbody>
												@foreach($educations as $education)
						                            <tr> 
							                            <td>
							                            	<strong>Lavel of Education:</strong> {{ $education->education_level_title }}
							                            	<br>

							                            	<strong>Institute:</strong> {{ $education->education_institute_name }}
							                            </td>
							                        	<td>
							                            	<strong>Exam/Degree Title:</strong> 
						                            		{{ $education->education_degree_title }} 
							                            	<br>
							                            	@if(!in_array($education->education_level_id, [1,2,8]))
								                            	<strong>Concentration/Major/Group:</strong> 
								                            	{{ $education->education_major_group_concentation }} 
								                            @endif

							                            	@if(in_array($education->education_level_id, [8]))
								                            	<strong>Concentration/Major/Group:</strong> 
								                            	{{ $education->education_degree_id_2 }} 
							                            	@endif
							                            </td> 
							                        	<td>
							                            	<strong>Year:</strong> {{ $education->education_passing_year }} 

							                            	<br/>

							                            	<strong>Result:</strong> {{ $education->education_result_title }} <br/>

							                            	@if(in_array($education->education_result_id, [1,2,3]))
								                            	<strong>Marks:</strong> {{ $education->education_result_marks }}  <br/>
							                            	@elseif(in_array($education->education_result_id,[4]))
								                            	<strong>CGPA:</strong> {{ $education->education_result_cgpa }}  <br/>
								                            	<strong>Scale:</strong> {{ $education->education_result_scale }}
								                            @endif 
							                            </td>
							                        </tr> 
												@endforeach  
												</tbody>
											</table>
											@else 
											No record found!
											@endif 
										</div>
									</div>
								</div>

								<!-- Medical Information -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#medicalInfo">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Medical Information
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="medicalInfo">
										<div class="panel-body">
											<div class="profile-user-info">
												<div class="profile-info-row">
													<div class="profile-info-name">Height</div>
													<div class="profile-info-value">
														<span> {{ $info->med_height }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Weight</div>
													<div class="profile-info-value">
														<span> {{ $info->med_weight }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Tooth Structure</div>
													<div class="profile-info-value">
														<span> {{ $info->med_tooth_str }} </span>
													</div>
												</div> 

												<div class="profile-info-row">
													<div class="profile-info-name">Blood Group</div>
													<div class="profile-info-value">
														<span> {{ $info->med_blood_group }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Identification Mark</div>
													<div class="profile-info-value">
														<span> {{ $info->med_ident_mark }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Others</div>
													<div class="profile-info-value">
														<span> {{ $info->med_others }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Doctors Comment</div>
													<div class="profile-info-value">
														<span> {{ $info->med_doct_comment }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Doctors Age Confirmation</div>
													<div class="profile-info-value">
														<span> {{ $info->med_doct_conf_age }} </span>
													</div>
												</div>

<<<<<<< HEAD
												

=======
>>>>>>> 5ce30aa88034f19c5e014b174810f70df72286ba
												<div class="profile-info-row">
													<div class="profile-info-name btn-group">Signature</div>
													<div class="profile-info-value btn-group">
														@if(!empty($info->med_signature))
														<a href="{{ url($info->med_signature) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->med_signature) }}" class="btn btn-xs btn-success" download target="_blank" title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Authorized Signature</div>
													<div class="profile-info-value btn-group">
														@if(!empty($info->med_auth_signature))
														<a href="{{ url($info->med_auth_signature) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->med_auth_signature) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Doctors Signature</div>
													<div class="profile-info-value btn-group">
														@if(!empty($info->med_doct_signature))
														<a href="{{ url($info->med_doct_signature) }}" class="btn btn-xs btn-primary" target="_blank" title="View">
															<i class="fa fa-eye"></i>
															 View
														</a>
														<a href="{{ url($info->med_doct_signature) }}" class="btn btn-xs btn-success" target="_blank" download title="Download">
															<i class="fa fa-eye"></i>
															 Download
														</a>
														@else
															<strong class="text-danger">No file found!</strong>
														@endif
													</div> 
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Benefits -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#Benefits">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Benefits
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="Benefits">
										<div class="panel-body">
											<div class="profile-user-info">

												<div class="profile-info-row">
													<div class="profile-info-name">Current Salary</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_current_salary }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Joining Salary</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_joining_salary }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Basic Salary</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_basic }} </span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name">House Rent</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_house_rent }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Medical</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_medical }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Transportation</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_transport }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Food</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_food }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Others Amount</div>
													<div class="profile-info-value">
														<span> {{ $info->ben_others }} </span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Medical Leave</div>
													<div class="profile-info-value">
														<span>{{ $info->ben_medical_leave }}</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Casual Leave</div>
													<div class="profile-info-value">
														<span>{{ $info->ben_casual_leave }}</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								

								<!-- Employment History  -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#employmentHistory">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Employment History 
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="employmentHistory">
										<div class="panel-body">
											@if(!empty($employments))
											<table class="table table-borderd table-compact">
												<thead>
						                            <tr>
						                                <th>Sl No</th>
						                                <th>Designation</th>
						                                <th>Starting Date</th>
						                                <th>Joining Salary</th>
						                                <th>Current Salary</th>
						                            </tr>
												</thead>
												<body>
												@foreach($employments as $employment)
						                            <tr> 
						                            	<td>{{ $loop->index+1 }}</td>
							                            <td>{{ $employment->hr_designation_name }}</td>
							                            <td>{{ (!empty($employment->ben_updated_at)? (date('d-M-Y',strtotime($employment->ben_updated_at))):(!empty($employment->as_doj)? (date('d-M-Y',strtotime($employment->as_doj))):null)) }}</td>
							                            <td>{{ $employment->ben_joining_salary }}</td>
							                            <td>{{ $employment->ben_current_salary }}</td>
							                        </tr>
												@endforeach 
												</body>
											</table>
											@else 
											No record found!
											@endif 
										</div>
									</div>
								</div>

								<!-- Loan History -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#loanHistory">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Loan History
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="loanHistory">
										<div class="panel-body">
											@if(!empty($loans))
											<table class="table table-borderd table-compact">
												<thead>
												    <tr>
												        <th>Types of Loan</th>
												        <th>Approved Amount</th>
												        <th>Due</th>
												        <th>Date</th>
												        <th>Status</th>
												        <th>Action</th>
												    </tr>
												</thead>
												<body>
												@foreach($loans as $loan)
						                            <tr>
							                            <td>{{ $loan->hr_la_type_of_loan }}</td>
							                            <td>{{ $loan->hr_la_approved_amount }}</td>
							                            <td>0.00</td>
							                            <td>
							                            	@if($loan->hr_la_updated_at !=null) 	{{ date("d-M-Y",strtotime($loan->hr_la_updated_at)) }}
							                            	@endif
							                        	</td>
							                            <td>{{ $loan->hr_la_status }}</td>
							                            <td><a target="_blank" class="btn btn-success btn-xs" title="View"  href='{{ url("hr/notification/loan/loan_approve/$loan->hr_la_id") }}'><i class="fa fa-eye"></i></a></td>
							                        </tr>
												@endforeach 
												</body>
											</table>
											@else 
											No record found!
											@endif 
										</div>
									</div>
								</div>

								<!-- Leave History  -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#leaveHistory">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Leave History 
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="leaveHistory">
										<div class="panel-body"> 
											@if(!empty($leaves))
												@foreach($leaves as $leave)
												<div class="row">
													<div class="col-xs-4">
														<strong>{{ $leave->year }}</strong>
													</div>

													<div class="col-xs-8">
														<table class="table table-borderd" style="border:1px solid #6EAED1">
															<thead>
															<tr>
																<th style="padding:4px">Leave Type</th>
																<th style="padding:4px">Taken</th>
															</tr>	
															</thead>
															<tbody>
															<tr>
																<th style="padding:4px">Casual</th>
																<td style="padding:4px">{{ (!empty($leave->casual)?$leave->casual:0) }}</td>
															</tr>
															<tr>
																<th style="padding:4px">Earned</th>
																<td style="padding:4px">{{ (!empty($leave->earned)?$leave->earned:0) }}</td>
															</tr>
															<tr>
																<th style="padding:4px">Sick</th>
																<td style="padding:4px">{{ (!empty($leave->sick)?$leave->sick:0) }}</td>
															</tr>
															<tr>
																<th style="padding:4px">Maternity</th>
																<td style="padding:4px">{{ (!empty($leave->maternity)?$leave->maternity:0) }}</td>
															</tr>
															</tbody>
															<tfoot>
																<tr>
																	<th style="padding:4px">Total</th>
																	<td style="padding:4px">{{ (!empty($leave->total)?$leave->total:0) }}</td>
																</tr>
															</tfoot>
														</table>
													</div>
												</div>
												<hr>
												@endforeach 
											@else 
											No record found!
											@endif 
										</div>
									</div>
								</div>

								<!-- Disciplinary Record  -->
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#disciplinaryRecord">
												<i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
												Disciplinary Record 
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse" id="disciplinaryRecord">
										<div class="panel-body">
											@if(!empty($records))
											<table class="table table-borderd table-compact">
												<thead>
						                            <tr> 
						                                <th>Griever ID</th>
						                                <th>Reason</th>
						                                <th>Action</th>
						                                <th>Requested Remedy</th>
						                                <th>Discussed Date</th>
						                                <th>Date of Execution</th> 
						                            </tr>
												</thead>
												<body>

												@foreach($records as $record)
						                            <tr> 
							                            <td><a href="{{ url('hr/recruitment/employee/show/'. $record->dis_re_griever_id) }}" target="_blank">{{ $record->dis_re_griever_id }}</a></td>
							                            <td>{{ $record->hr_griv_issue_name }}</td>
							                            <td>{{ $record->hr_griv_steps_name }}</td>
							                            <td>{{ $record->dis_re_req_remedy }}</td>
							                            <td> 
							                            	{{ (!empty($record->dis_re_discussed_date)?(date("d-M-Y",strtotime($record->dis_re_discussed_date))):null) }}
							                            </td>
							                            <td> 
							                            	{{ (!empty($record->date_of_execution)?(date("d-M-Y",strtotime($record->date_of_execution))):null) }}
							                            </td> 
							                        </tr>
												@endforeach 
												</body>
											</table>
											@else 
											No record found!
											@endif 
										</div>
									</div>
								</div>
							</div> 
						</div>
					</div>
					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>          
@endsection