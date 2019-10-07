@extends('hr.index')
@section('content')
<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Job Portal</a>
							</li>
							<!--<li class="active">Blank Page</li>-->
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

				 <div class="page-header">
							<h1>
								Job Portal
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									CV
								</small>
							</h1>
						</div>
                               
						<div class="row">
						  	<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                              
                              	<form class="form-horizontal" role="form">

                              		<div class="col-sm-12">
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-home bigger-120"></i>
														Personal Details
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#career">
														Career and Application information</a>
												</li>
                                                
                                                <li>
													<a data-toggle="tab" href="#preferred">
														Preferred Areas</a>
												</li>

												<li>
													<a data-toggle="tab" href="#relevant">
														Other Relevant information
														<span class="badge badge-danger"></span>
													</a>
												</li>
                                                
                                                <li>
													<a data-toggle="tab" href="#employment">
														Employment history
														<span class="badge badge-danger"></span>
													</a>
												</li>
                                                
                                                <li>
													<a data-toggle="tab" href="#other">
														Other Information</a>
												</li>
                                                
                                                <li>
													<a data-toggle="tab" href="#photo">
													Photograph</a>
												</li>
											</ul>

											<div class="tab-content">
												<div id="home" class="tab-pane fade in active">
													<div class="row">
						  								<div class="col-xs-12">
                          
                          								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="First Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Last Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Father's Name </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Father's Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mother's Name </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Mother's Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Present Address </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
							    </div>
                                    

								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Permanent Address </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Current Location </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Current Location" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mobile </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Mobile" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Email" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alternative Email </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Alternative Email" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date of Birth </label>

										<div class="col-sm-9">
                                        <div class="col-xs-8 col-sm-3">
																<div class="input-group">
										<input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy"  />
                                        <span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                        </div></div>
										</div>
									</div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gender</label>

										<div class="col-sm-4">
										 <select class="form-control" id="form-field-select-1">
																<option value=""></option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
																<option value="Common">Common</option>
																
															</select>
										</div>
							  </div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Religion </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Religion" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Marital Status </label>

										<div class="col-sm-4">
										 <select class="form-control" id="form-field-select-1">
																<option value=""></option>
																<option value="Maried">Maried</option>
																<option value="Unmaried">Unmaried</option>
																<option value="Divorced">Divorced</option>
																
															</select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nationality </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Nationality" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NAtional ID </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="National ID" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                          
                          
                          </div></div>
                      </div>

						<div id="career" class="tab-pane fade">
													
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Objectives </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Objectives" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Present Salary </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Present Salary" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Expected Salary </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Expected Salary" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Looking for (Job level) </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Looking for (Job level)" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                                    
                                    
												</div>

												<div id="preferred" class="tab-pane fade">
													<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Preferred job categories functional </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Preferred job categories functional" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Special skills  </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Special skills " class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Preferred job location </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Preferred job location" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Looking for (Job level) </label>

										<div class="col-sm-9">
										  <input type="text" id="form-field-1" placeholder="Looking for (Job level)" class="col-xs-10 col-sm-5" />
										</div>
						      </div>
												</div>


                                                
                                                
                                                <div id="relevant" class="tab-pane fade">
													<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Career summary  </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Special qualification  </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>
                                                    
     						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Academic summary </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>
                              
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Training summary  </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>
                              
                              

                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Professional certification summary  </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>                                               
                                                    
												</div>
                                                
                                                
                                                <div id="employment" class="tab-pane fade">
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Employment history  </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>			
										
                                        
                                        
                                        
                                        		</div>
                                                
                                                
                                                <div id="other" class="tab-pane fade">
													
                                                   
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Specialization  </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>			
										
                                                                                                                    
                                               
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Language proficiency   </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>			
										
                                        
                                                
                                               
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Reference   </label>

										<div class="col-sm-9">
											

										  <textarea id="form-field-11" class="col-xs-10 col-sm-5"></textarea>
										</div>
						      </div>			
										
                                                
                                                
                                                    
                                                    
												</div>


												<div id="photo" class="tab-pane fade">
													
                                     <div>
								
										<div class="fallback">
											<input name="file" type="file" multiple />
										</div>
								
								</div>               
                                                    
                                                    
                                                    
												</div>
											</div>
										</div>
									</div>
                                    
                                    <div class="space-4"></div>
								   <div class="space-4"></div>
								   <div class="space-4"></div>
								   <div class="space-4"></div>
								   <div class="space-4"></div>
								   <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="button">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
								     </div>
							    </div>
                                    
							</form>
                              <!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
</div>
@endsection