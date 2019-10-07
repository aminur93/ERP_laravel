<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>
	<div id="sidebar" class="sidebar responsive ace-save-state">
		<script type="text/javascript">
			try{ace.settings.loadState('sidebar')}catch(e){}
		</script> 

		<!-- Left sidebar menu start-->
		<ul class="nav nav-list">
			<li class="active">
				<a href="{{ url('hr') }}"><i class="menu-icon fa fa-home"></i>
					<span class="menu-text"> Dashboard </span>
				</a>
				<b class="arrow"></b>
			</li> 

			<!-- Recruitment Sub menu start -->
			@hasanyrole("hr_admin|hr_management|hr_supervisor|hr_executive|hr_executive_recruitment|hr_medical")
			<li>
				<a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i>
					<span class="menu-text">Recruitment</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu"> 
					<!-- Employer Sub-sub menu start -->
                	@if(auth()->user()->can('hr_recruitment_employer_add') || auth()->user()->can('hr_recruitment_employer_list') || auth()->user()->can('hr_recruitment_worker') ||  auth()->user()->can('hr_recruitment_medical'))
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Employer
                        	<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
                        <ul class="submenu">
							@if(auth()->user()->can('hr_recruitment_worker'))
                        	<li>
								<a href="{{ url('hr/recruitment/worker/recruit')}}"><i class="menu-icon fa fa-caret-right"></i>New Recruit</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@if(auth()->user()->can('hr_recruitment_worker') || auth()->user()->can('hr_recruitment_medical'))
                        	<li>
								<a href="{{ url('hr/recruitment/worker/recruit_list')}}"><i class="menu-icon fa fa-caret-right"></i>Recruit List</a>
								<b class="arrow"></b>
							</li> 
                            <li>
								<a href="{{ url('hr/recruitment/worker/medical_list')}}"><i class="menu-icon fa fa-caret-right"></i>Medical List</a>
								<b class="arrow"></b>
							</li>	
							@endcan
							@if(auth()->user()->can('hr_recruitment_worker'))
                            <li>
								<a href="{{ url('hr/recruitment/worker/ie_skill_list')}}"><i class="menu-icon fa fa-caret-right"></i>IE Skill List</a>
								<b class="arrow"></b>
							</li>
							@endcan
                        	@can("hr_recruitment_employer_add")
                        	<li>
								<a href="{{ url('hr/recruitment/employee/add_employee')}}"><i class="menu-icon fa fa-caret-right"></i>Add New</a>
								<b class="arrow"></b>
							</li>
							@endcan
                        	@can("hr_recruitment_employer_list")
                            <li>
								<a href="{{ url('hr/recruitment/employee/employee_list')}}"><i class="menu-icon fa fa-caret-right"></i>Employee List</a>
								<b class="arrow"></b>
							</li>
                            <li>
								<a href="{{ url('hr/recruitment/employee/hierarchy')}}"><i class="menu-icon fa fa-caret-right"></i>Employee Hierarchy</a>
								<b class="arrow"></b>
							</li>	
							@endcan 
                        </ul>
					</li>
					@endif
					<!-- Employer Sub-sub menu end -->

					<!-- Operation Sub-sub menu start -->
                	@if(auth()->user()->can('hr_recruitment_op_adv_info') || auth()->user()->can('hr_recruitment_op_adv_list') || auth()->user()->can('hr_recruitment_op_benefit') || auth()->user()->can('hr_recruitment_op_medical_info') || auth()->user()->can('hr_recruitment_op_medical_list') || auth()->user()->can('hr_recruitment_op_medical_incident'))
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Operation
                        	<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							@can("hr_recruitment_op_adv_info")
							<li>
								<a href="{{ url('hr/recruitment/operation/advance_info') }}"><i class="menu-icon fa fa-caret-right"></i>Advance Info</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_recruitment_op_adv_list")
							<li>
								<a href="{{ url('hr/recruitment/operation/advance_info_list') }}"><i class="menu-icon fa fa-caret-right"></i>Advance Info List</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_recruitment_op_benefit")
							<li>
								<a href="{{ url('hr/recruitment/operation/benefits') }}"><i class="menu-icon fa fa-caret-right"></i>Benefits</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_recruitment_op_medical_info")
							<li>
								<a href="{{ url('hr/recruitment/operation/medical_info') }}"><i class="menu-icon fa fa-caret-right"></i>Medical Info</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_recruitment_op_medical_list")
							<li>
								<a href="{{ url('hr/recruitment/operation/medical_info_list') }}"><i class="menu-icon fa fa-caret-right"></i>Medical Info List</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_recruitment_op_medical_incident")
							<li>
								<a href="{{ url('hr/ess/medical_incident') }}"><i class="menu-icon fa fa-caret-right"></i>Medical Incident</a>
								<b class="arrow"></b>
							</li>
							<li>
								<a href="{{ url('hr/ess/medical_incident_list') }}"><i class="menu-icon fa fa-caret-right"></i>Medical Incident List</a>
								<b class="arrow"></b>
							</li>
							<li>
								<a href="{{ url('hr/operation/servicebook') }}"><i class="menu-icon fa fa-caret-right"></i>Service Book</a>
								<b class="arrow"></b>
							</li>
							@endcan
							<li>
								<a href="{{ url('hr/operation/cost-mapping') }}"><i class="menu-icon fa fa-caret-right"></i>Cost Distribution(Mapping)</a>
								<b class="arrow"></b>
							</li>
							<li>
								<a href="{{ url('hr/operation/cost_mapping_list') }}"><i class="menu-icon fa fa-caret-right"></i>Cost Distribution(Mapping) List</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					@endif
					<!-- Operation Sub-sub menu end --> 

					<!-- Job Portal Sub-sub menu start -->
                	@if(auth()->user()->can('hr_recruitment_job_posting') || auth()->user()->can('hr_recruitment_job_interview') || auth()->user()->can('hr_recruitment_job_letter'))
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Job Portal
                        	<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
                        <ul class="submenu">
                        	@can("hr_recruitment_job_posting")
                        	<li>
								<a href="{{ url('hr/recruitment/job_portal/job_posting')}}"><i class="menu-icon fa fa-caret-right"></i>Job Posting</a>
								<b class="arrow"></b>
							</li> 
                        	<li>
								<a href="{{ url('hr/recruitment/job_portal/job_posting_list')}}"><i class="menu-icon fa fa-caret-right"></i>Job Posting List</a>
								<b class="arrow"></b>
							</li> 
							@endcan
							@can("hr_recruitment_job_interview")
                           <li>
								<a href="{{ url('hr/recruitment/job_portal/interview_notes')}}"><i class="menu-icon fa fa-caret-right"></i>Interview Notes</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_recruitment_job_letter")
							<li>
								<a href="{{ url('hr/recruitment/job_portal/joining_letter') }}"><i class="menu-icon fa fa-caret-right"></i>Joining Letter</a>
								<b class="arrow"></b>
							</li>
							@endcan
                        </ul>
					</li>
					@endif
					<!-- Job Portal Sub-sub menu end -->
					
				</ul>
			</li>
			@endhasanyrole
			<!-- Recruitment Sub menu End -->


			<!-- Time & Attendance -->
			@hasanyrole("hr_admin|hr_management|hr_supervisor|hr_executive|hr_executive_time_att")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-calendar"></i>
					<span class="menu-text"> Time & Attendance  </span>
					<b class="arrow fa fa-angle-down"></b>
				</a> 
				<b class="arrow"></b>
				<ul class="submenu"> 
					@can("hr_time_daily_att_list")
					<li>
						<a href="{{ url('hr/timeattendance/attendance_report') }}">
							<i class="menu-icon fa fa-caret-right"></i>Attendance Report
						</a> 
					</li>
					<!-- 					<li>
						<a href="{{ url('hr/timeattendance/daily_attendance_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>Daily Attendance List
						</a> 
					</li> -->
					@endcan
					@can("hr_time_manual_att")
					<li>
						<a href="{{ url('hr/timeattendance/attendance_manual') }}">
							<i class="menu-icon fa fa-caret-right"></i>Manual Attendance
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/timeattendance/attendance_bulk_manual') }}">
							<i class="menu-icon fa fa-caret-right"></i> Manual Attendance (Individual)
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/timeattendance/daywise_manual_attendance') }}">
							<i class="menu-icon fa fa-caret-right"></i> Manual Attendance (Daywise)
						</a> 
					</li>
					@endcan
					@can("hr_time_manual_att")
					<li>
						<a href="{{ url('hr/timeattendance/manual_att_log') }}">
							<i class="menu-icon fa fa-caret-right"></i>Manual Attendance Log
						</a> 
					</li>
					@endcan
					@can("hr_time_worker_leave")
					<li>
						<a href="{{ url('hr/timeattendance/leave_worker') }}">
							<i class="menu-icon fa fa-caret-right"></i>Leave Entry</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_time_leaves")
					<li>
						<a href="{{ url('hr/timeattendance/all_leaves') }}">
							<i class="menu-icon fa fa-caret-right"></i>Leave List</a>
						<b class="arrow"></b>
					</li> 
					@endcan
					@can("hr_time_shift_assign")
					<li>
						<a href="{{ url('hr/timeattendance/shift_assign') }}">
							<i class="menu-icon fa fa-caret-right"></i>Shift Assign
						</a> 
					</li>
					@endcan
					@can("hr_time_shift_roaster")
					<li>
						<a href="{{ url('hr/timeattendance/shift_roaster') }}">
							<i class="menu-icon fa fa-caret-right"></i>Shift Roaster
						</a> 
					</li>
					@endcan
					<li>
						<a href="{{ url('hr/timeattendance/new_card') }}">
							<i class="menu-icon fa fa-caret-right"></i>Station Card
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/timeattendance/station_card') }}">
							<i class="menu-icon fa fa-caret-right"></i>Station Card List
						</a> 
					</li>
                	@if(auth()->user()->can('hr_time_op_holiday') ||    auth()->user()->can('hr_time_op_without_pay'))
                    <li>
						<a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-caret-right"></i>
							<span class="menu-text">Operation</span>
							<b class="arrow fa fa-angle-down"></b>
						</a> 
						<b class="arrow"></b> 
						<ul class="submenu"> 
							@can("hr_time_op_holiday") 
							<li>
								<a href="{{ url('hr/timeattendance/operation/yearly_holidays/create') }}"><i class="menu-icon fa fa-caret-right"></i>Yearly Holiday</a>
								<b class="arrow"></b>
							</li>  
							<li>
								<a href="{{ url('hr/timeattendance/operation/yearly_holidays') }}"><i class="menu-icon fa fa-caret-right"></i>Yearly Holiday List</a>
								<b class="arrow"></b>
							</li> 
							@endcan
							@can("hr_time_op_without_pay")
							<li> 
								<a href="{{ url('hr/timeattendance/operation/without_pay') }}"><i class="menu-icon fa fa-caret-right"></i>Without Pay</a>
								<b class="arrow"></b>
							</li>
							<li> 
								<a href="{{ url('hr/timeattendance/operation/without_pay_list') }}"><i class="menu-icon fa fa-caret-right"></i>Without Pay List</a>
								<b class="arrow"></b>
							</li>
							@endcan
						</ul>
					</li>
					@endif
					@can("hr_time_id_card")
					<li>
						<a href="{{ url('hr/recruitment/employee/idcard') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							ID Card
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					<li>
						<a href="{{ url('hr/timeattendance/raw_punch') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							Raw Punch
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>
			@endhasanyrole
			<!-- Time & Attendance Sub menu End -->

			<!-- Asset Management Sub menu Start -->
			@hasanyrole("hr_admin|hr_supervisor|hr_executive|hr_executive_asset")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-pencil-square-o"></i>
					<span class="menu-text"> Asset Management </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu"> 
					@can("hr_asset_assign")
					<li>
						<a href="{{ url('hr/assets/assign') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							Assets Assign 
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_asset_assign_list")
					<li>
						<a href="{{ url('hr/assets/assign_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>
							 Assets Assign List
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
				</ul>
			</li>
			@endhasanyrole
			<!--Asset Management Sub menu End -->

			<!-- Training Sub menu Start -->
			@hasanyrole("hr_admin|hr_management|hr_supervisor|hr_executive|hr_executive_training")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-graduation-cap"></i>
					<span class="menu-text"> Training </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>

				<ul class="submenu">
					@can("hr_training_add")
					<li>
						<a href="{{ url('hr/training/add_training') }}">
							<i class="menu-icon fa fa-caret-right"></i>Add Training
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_training_list")
					<li>
						<a href="{{ url('hr/training/training_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>Training List
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_training_assign") 
                    <li>
						<a href="{{ url('hr/training/assign_training') }}">
							<i class="menu-icon fa fa-caret-right"></i>Training Assign
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_training_assign_list") 
                    <li>
						<a href="{{ url('hr/training/assign_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>Assign List
						</a>
						<b class="arrow"></b>
					</li>
					@endcan 
				</ul>
			</li>
			@endhasanyrole
			<!-- Training Sub menu End -->

			<!-- Payrol Sub menu Start -->
			@hasanyrole("hr_admin|hr_management|hr_supervisor|hr_executive_payroll")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-money"></i>
					<span class="menu-text"> Payroll </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					@can("hr_payroll_ot")
					<li>
						<a href="{{ url('hr/payroll/ot') }}">
							<i class="menu-icon fa fa-caret-right"></i>OT
						</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/payroll/ot_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>OT List
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_payroll_salary")
					<li>
						<a href="{{ url('hr/payroll/salary') }}">
							<i class="menu-icon fa fa-caret-right"></i>Salary
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_payroll_benefit_list")
					<li>
						<a href="{{ url('hr/payroll/promotion') }}">
							<i class="menu-icon fa fa-caret-right"></i>Promotion
						</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/payroll/increment') }}">
							<i class="menu-icon fa fa-caret-right"></i>Increment
						</a>
						<b class="arrow"></b>
					</li>
                    <li>
						<a href="{{ url('hr/payroll/benefit_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>Benefit List
						</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_payroll_loan_list")
					<li>
						<a href="{{ url('hr/ess/loan_list') }}"><i class="menu-icon fa fa-caret-right"></i>Loan Applicant List</a>
						<b class="arrow"></b>
					</li>  
					@endcan
					<li>
						<a href="{{ url('hr/payroll/add_deduct') }}"><i class="menu-icon fa fa-caret-right"></i>Add/Deduct(Salary) Bulk Upload</a>
						<b class="arrow"></b>
					</li>  
				</ul>
			</li>
			@endhasanyrole
			<!-- Payrol Sub menu End -->

			<!-- ESS Sub menu Start -->
			@hasanyrole("hr_admin|hr_associate")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-line-chart"></i>
					<span class="menu-text"> ESS Management  </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
                	@if(auth()->user()->can('hr_ess_grievance_appeal') ||    auth()->user()->can('hr_ess_grievance_list'))
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Grievance
                        	<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
                        <ul class="submenu">
                        	@can("hr_ess_grievance_appeal")
                        	<li>
								<a href="{{ url('hr/ess/grievance/appeal')}}"> <i class="menu-icon fa fa-caret-right"> </i>Appeal </a>
							</li>
							@endcan
							@can("hr_ess_grievance_list")
							<li>
								<a href="{{ url('hr/ess/grievance/appeal_list')}}"><i class="menu-icon fa fa-caret-right"></i>Appeal List</a>
								<b class="arrow"></b>
							</li>	
							@endcan		
                        </ul>
					</li>
					@endif
					@can("hr_ess_leave_application")
					<li>
						<a href="{{ url('hr/ess/leave_application') }}"><i class="menu-icon fa fa-caret-right"></i>Leave Application</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_ess_loan_application")
					<li>
						<a href="{{ url('hr/ess/loan_application') }}"><i class="menu-icon fa fa-caret-right"></i>Loan Application</a>
						<b class="arrow"></b>
					</li>
					@endcan
				</ul>
			</li>
			@endhasanyrole
			<!-- ESS Sub menu End -->

			<!-- Performance Sub menu Start -->
			@hasanyrole("hr_admin|hr_management|hr_supervisor|hr_executive_performance")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-area-chart"></i>
					<span class="menu-text"> Performance </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					@can("hr_performance_appraisal")
					<li>
						<a href="{{ url('hr/performance/appraisal') }}"><i class="menu-icon fa fa-caret-right"></i>Performance Appraisal</a>
						<b class="arrow"></b>
					</li>
					@endcan
					@can("hr_performance_list")
					<li>
						<a href="{{ url('hr/performance/appraisal_list') }}"><i class="menu-icon fa fa-caret-right"></i>P.Appraisal List</a>
						<b class="arrow"></b>
					</li>
					@endcan
                	@if(auth()->user()->can('hr_performance_op_disc') ||  auth()->user()->can('hr_performance_op_disc_list'))
					<li> 
						<a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-caret-right"></i>
							<span class="menu-text">Operation</span>
							<b class="arrow fa fa-angle-down"></b>
						</a> 
						<b class="arrow"></b>
						<ul class="submenu"> 
							@can("hr_performance_op_disc")
							<li>
								<a href="{{ url('hr/performance/operation/disciplinary_form') }}"><i class="menu-icon fa fa-caret-right"></i>Disciplinary Record</a>
								<b class="arrow"></b>
							</li>
							@endcan
							@can("hr_performance_op_disc_list")
							<li>
								<a href="{{ url('hr/performance/operation/disciplinary_list') }}"><i class="menu-icon fa fa-caret-right"></i>Disciplinary List</a>
								<b class="arrow"></b>
							</li>
							@endcan
						</ul>
					</li> 
					@endif
				</ul>
			</li>
			@endhasanyrole
			<!-- Performance Sub menu End -->	
 			
 			<!-- Report Menu Start -->
 			@hasanyrole("hr_admin")
			<li>  
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-pie-chart"></i>
					<span class="menu-text"> Reports </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li>
						<a href="{{ url('hr/reports/job_application') }}"><i class="menu-icon fa fa-caret-right"></i>Job Application</a>
						<b class="arrow"></b>
					</li>
					<li>

						<a href="{{ url('hr/reports/file_tag') }}"><i class="menu-icon fa fa-caret-right"></i>Print File Tag</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/reports/job_card') }}">
							<i class="menu-icon fa fa-caret-right"></i>Job Card
						</a> 
					</li> 
					<li>
						<a href="{{ url('hr/reports/employee_report') }}">
							<i class="menu-icon fa fa-caret-right"></i>Employee Report
						</a> 
					</li> 
					<li>
						<a href="{{ url('hr/reports/increment_report') }}">
							<i class="menu-icon fa fa-caret-right"></i>Increment Report </a>
					</li> 
					<li>
						<a href="{{ url('hr/reports/nominee') }}">
							<i class="menu-icon fa fa-caret-right"></i>Nominee
						</a> 
					</li> 
					<li>
						<a href="{{ url('hr/reports/back_verf') }}">
							<i class="menu-icon fa fa-caret-right"></i>Background Verification
						</a>
					</li>
					<li>
						<a href="{{ url('hr/reports/line_wise_att') }}">
							<i class="menu-icon fa fa-caret-right"></i>Line Wise Attendance
						</a> 
					</li> 
					<li>
						<a href="{{ url('hr/reports/monthy_increment') }}">
							<i class="menu-icon fa fa-caret-right"></i>Monthly Increment
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/reports/bonus_slip') }}">
							<i class="menu-icon fa fa-caret-right"></i>Bonus Slip
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/reports/daily_ot_report') }}">
							<i class="menu-icon fa fa-caret-right"></i>Daily OT Status
						</a> 
					</li> 
					<li> 
						<a href="{{ url('hr/reports/absent_status') }}">
							<i class="menu-icon fa fa-caret-right"></i>Absent Status
						</a>
					</li>
					<li>
						<a href="{{ url('hr/reports/leave_log') }}">
							<i class="menu-icon fa fa-caret-right"></i>Leave Log
						</a> 
					</li> 
					<li>
						<a href="{{ url('hr/reports/salary_sheet') }}">
							<i class="menu-icon fa fa-caret-right"></i>Salary Sheet
						</a>
					</li>
					<li>
						<a href="{{ url('hr/reports/salary-sheet-custom') }}">
							<i class="menu-icon fa fa-caret-right"></i>Salary Sheet(Custom)
						</a>
					</li> 
					<li>
						<a href="{{ url('hr/reports/payslip') }}">
							<i class="menu-icon fa fa-caret-right"></i>Pay Slip
						</a>
					</li> 
					 
					<li>
						<a href="{{ url('hr/reports/attendance_report_2') }}">
							<i class="menu-icon fa fa-caret-right"></i>Attendance Report
						</a>
					</li> 
					<li>
						<a href="{{ url('hr/reports/worker_register') }}">
							<i class="menu-icon fa fa-caret-right"></i>Worker Register
						</a> 
					</li> 
					<li>
						<a href="{{ url('hr/reports/unitattendance') }}">
							<i class="menu-icon fa fa-caret-right"></i>Unit Attendance
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/reports/manual_attendance') }}"><i class="menu-icon fa fa-caret-right"></i>Manual Attendance </a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/reports/earnleavepayment') }}">
							<i class="menu-icon fa fa-caret-right"></i>Earn Leave Payment Sheet
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/reports/extraotsheet') }}">
							<i class="menu-icon fa fa-caret-right"></i>Extra OT Sheet
						</a> 
					</li>
					<li>
						<a href="{{ url('hr/reports/fixedsalarysheet') }}">
							<i class="menu-icon fa fa-caret-right"></i>Fixed Salary Sheet
						</a> 
					</li>
				</ul>
			</li> 
			@endhasanyrole
			<!-- End Sub Menu Report -->
			<!-- User management Start -->
			@hasanyrole("users_management")
			<li>
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-users"></i>
					<span class="menu-text"> User Management </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>
				<ul class="submenu"> 
                    <li> 
						<a href="{{ url('users_management/permissions') }}"><i class="menu-icon fa fa-caret-right"></i>Permissions</a>
						<b class="arrow"></b>
                    </li>
                    <li> 
						<a href="{{ url('users_management/roles') }}"><i class="menu-icon fa fa-caret-right"></i>Roles</a>
						<b class="arrow"></b>
                    </li>
					<li>
						<a href="{{ url('users_management/user/create') }}"><i class="menu-icon fa fa-caret-right"></i>Add User</a>
						<b class="arrow"></b>
					</li>  
                    <li> 
						<a href="{{ url('users_management/users') }}"><i class="menu-icon fa fa-caret-right"></i>User List</a>
						<b class="arrow"></b>
                    </li> 
				</ul>
			</li> 
			@endhasanyrole
			<!-- User management End -->

			<!-- Setup Sub-menu Start -->
			<li>  
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-cogs"></i>
					<span class="menu-text"> Setup </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li>
						<a href="{{ url('hr/setup/unit') }}"><i class="menu-icon fa fa-caret-right"></i>Add Unit</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/floor') }}"><i class="menu-icon fa fa-caret-right"></i>Add Floor</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/line') }}"><i class="menu-icon fa fa-caret-right"></i>Add Line</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/shift') }}"><i class="menu-icon fa fa-caret-right"></i>Add Shift</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/department') }}"><i class="menu-icon fa fa-caret-right"></i>Add Department</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/section') }}"><i class="menu-icon fa fa-caret-right"></i>Add Section</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/subsection') }}"><i class="menu-icon fa fa-caret-right"></i>Add Sub Section</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/designation') }}"><i class="menu-icon fa fa-caret-right"></i>Add Designation</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/loan_type') }}"><i class="menu-icon fa fa-caret-right"></i>Add Loan Type</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/salary_structure') }}"><i class="menu-icon fa fa-caret-right"></i>Salary Structure</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/attendance_bonus') }}"><i class="menu-icon fa fa-caret-right"></i>Attendance Bonus</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/education_title') }}"><i class="menu-icon fa fa-caret-right"></i>Education Title</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/increment_type') }}"><i class="menu-icon fa fa-caret-right"></i>Increment Type</a>
						<b class="arrow"></b>
					</li>
					<li>
						<a href="{{ url('hr/setup/other_benefit_item') }}"><i class="menu-icon fa fa-caret-right"></i>Add Other Benefit Item</a>
						<b class="arrow"></b>
					</li>
					
				</ul>
			</li>  
			<!-- Setup Sub menu End -->	
			
			<!-- Log Sub menu Start --> 
			@hasanyrole("hr_admin")
			<li>  
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-history"></i>
					<span class="menu-text"> Log </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu"> 
					<li>
						<a href="{{ url('hr/logs/desg_update_log') }}"><i class="menu-icon fa fa-caret-right"></i>Designation Update Log</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>  
			@endhasanyrole
			<!-- Log Sub Menu End -->
						
		</ul>
                
    <!-- Left sidebar menu end-->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
