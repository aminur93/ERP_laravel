<?php

/*
|--------------------------------------------------------------------------
| HUMAN RESOURCE
|--------------------------------------------------------------------------
*/  
//---------DASHBOARD-----------//
Route::get('hr', 'Hr\DashboardController@dashboard')->name('hr');

//---------Time and Attendence-----------//

// attendance
Route::get('hr/timeattendance/daily_attendance_list', 'Hr\TimeAttendance\AttendanceController@dailyAttendance');
Route::get('hr/timeattendance/daily_attendance_data', 'Hr\TimeAttendance\AttendanceController@getAttendanceData');
Route::get('hr/timeattendance/attendance_manual', 'Hr\TimeAttendance\AttendaceManualController@showForm');
Route::post('hr/timeattendance/attendance_manual', 'Hr\TimeAttendance\AttendaceManualController@saveData');
Route::post('hr/timeattendance/attendance_manual/excel/import', 'Hr\TimeAttendance\AttendanceExcelController@importFile');

Route::get('/hr/timeattendance/attendance_process_wise', 'Hr\TimeAttendance\AttendanceExcelController@importFileProcess');
Route::get('hr/timeattendance/attendance_bulk_manual', 'Hr\TimeAttendance\AttendaceBulkManualController@bulkManual');
Route::post('hr/timeattendance/attendance_bulk_store', 'Hr\TimeAttendance\AttendaceBulkManualController@bulkManualStore');

Route::get('hr/timeattendance/daywise_manual_attendance', 'Hr\TimeAttendance\AttendaceDaywiseManualController@dayManual');
Route::get('hr/attendance/floor_by_unit', 'Hr\TimeAttendance\AttendaceDaywiseManualController@getFloorByUnit');

Route::post('hr/timeattendance/attendance_daywise_store', 'Hr\TimeAttendance\AttendaceDaywiseManualController@dayManualStore');

	//new routes//

//Process Button route for manual attendance update from temporary table(File upload)
Route::get('hr/timeattendance/temporary_data_process/{id}', 'Hr\TimeAttendance\AttendanceExcelController@processAttendance');

Route::get('hr/timeattendance/existing_punch', 'Hr\TimeAttendance\AttendaceManualController@getExistingPunch');

Route::get('hr/timeattendance/manual_att_log', 'Hr\TimeAttendance\AttendaceManualController@manualAttLog');
Route::get('hr/timeattendance/manual_att_log_data', 'Hr\TimeAttendance\AttendaceManualController@manualAttLogData');

//Attendance Report
Route::get('hr/timeattendance/attendance_report', 'Hr\TimeAttendance\AttendanceController@attendanceReport');
Route::get('hr/timeattendance/attendance_report_data', 'Hr\TimeAttendance\AttendanceController@attendanceReportData');
Route::get('hr/timeattendance/attendance_summary', 'Hr\TimeAttendance\AttendanceController@attendanceSummary');

//shift roaster
Route::get('hr/timeattendance/shift_roaster', 'Hr\TimeAttendance\ShiftRoasterController@getRoaster');
Route::post('hr/timeattendance/shift_roaster_data', 'Hr\TimeAttendance\ShiftRoasterController@getRoasterData');	
Route::get('hr/timeattendance/get_floor_by_unit', 'Hr\TimeAttendance\ShiftRoasterController@getFloorByUnit');

// Station Card

Route::get("hr/timeattendance/station_card", "Hr\TimeAttendance\StationController@showList");
Route::get("hr/timeattendance/station_card_data", "Hr\TimeAttendance\StationController@listData");
Route::get("hr/timeattendance/new_card", "Hr\TimeAttendance\StationController@showForm");
Route::post("hr/timeattendance/new_card", "Hr\TimeAttendance\StationController@saveForm");

Route::get("hr/timeattendance/station_card/{id}/delete", "Hr\TimeAttendance\StationController@stationDelete");
Route::get("hr/timeattendance/station_card/{id}/edit", "Hr\TimeAttendance\StationController@stationEdit");

Route::post("hr/timeattendance/station_card_update", "Hr\TimeAttendance\StationController@stationUpdate");


Route::get("hr/timeattendance/station_as_info", "Hr\TimeAttendance\StationController@stationAssInfo");
Route::get("hr/timeattendance/station_line_info", "Hr\TimeAttendance\StationController@stationLineInfo");

//shift assign
Route::get('hr/timeattendance/shift_assign', 'Hr\TimeAttendance\ShiftRoasterController@shiftAssign');
Route::post('hr/timeattendance/shift_assign', 'Hr\TimeAttendance\ShiftRoasterController@saveAssignedShift');
Route::get('hr/timeattendance/unitshift', 'Hr\TimeAttendance\ShiftRoasterController@unitShift');

Route::get('hr/timeattendance/shifttable', 'Hr\TimeAttendance\ShiftRoasterController@shiftTable');
Route::get('hr/timeattendance/get_associate_by_type_unit_shift', 'Hr\TimeAttendance\ShiftRoasterController@getAssociateByTypeUnitShift');

//shift assign
Route::get('hr/timeattendance/all_leaves', 'Hr\TimeAttendance\AllLeavesController@allLeaves');
Route::post('hr/timeattendance/all_leaves_data', 'Hr\TimeAttendance\AllLeavesController@allLeavesData');
Route::get('hr/timeattendance/leave_approve/{id}', 'Hr\TimeAttendance\AllLeavesController@leaveView');
Route::post('hr/timeattendance/leave_approve/approve_reject', 'Hr\TimeAttendance\AllLeavesController@leaveStatus');

//Leave approval for worker
Route::get('hr/timeattendance/leave_worker',  'Hr\TimeAttendance\LeaveWorkerController@showForm');
Route::post('hr/timeattendance/leave_worker',  'Hr\TimeAttendance\LeaveWorkerController@saveData');

//Operation - Maternity Leave 
Route::get('hr/timeattendance/operation/maternity_leave', 'Hr\TimeAttendance\MaternityLeaveController@showForm');
Route::post('hr/timeattendance/operation/maternity_leave', 'Hr\TimeAttendance\MaternityLeaveController@saveData');

//Operation - Leave Approval
Route::get('hr/timeattendance/operation/leave_approval',  'Hr\TimeAttendance\LeaveApprovalController@showForm');
Route::post('hr/timeattendance/operation/leave_approval',  'Hr\TimeAttendance\LeaveApprovalController@saveData');

//Operation - Without Pay
Route::get('hr/timeattendance/operation/without_pay_list', 'Hr\TimeAttendance\WithoutPayController@showList');
Route::post('hr/timeattendance/operation/without_pay_list_data', 'Hr\TimeAttendance\WithoutPayController@getData');
Route::get('hr/timeattendance/operation/without_pay', 'Hr\TimeAttendance\WithoutPayController@showForm');
Route::post('hr/timeattendance/operation/without_pay', 'Hr\TimeAttendance\WithoutPayController@saveData');
Route::get('hr/timeattendance/operation/without_pay_edit/{id}', 'Hr\TimeAttendance\WithoutPayController@editForm');
Route::post('hr/timeattendance/operation/without_pay_edit', 'Hr\TimeAttendance\WithoutPayController@updateData');

//Yearly Holiday Planner
Route::get('hr/timeattendance/operation/yearly_holidays', 'Hr\TimeAttendance\YearlyHolidayController@index');
Route::post('hr/timeattendance/operation/yearly_holidays/data', 'Hr\TimeAttendance\YearlyHolidayController@getAll');
Route::get('hr/timeattendance/operation/yearly_holidays/create', 'Hr\TimeAttendance\YearlyHolidayController@create');
Route::post('hr/timeattendance/operation/yearly_holidays', 'Hr\TimeAttendance\YearlyHolidayController@store');
Route::get('hr/timeattendance/operation/yearly_holidays/{id}/{status}', 'Hr\TimeAttendance\YearlyHolidayController@status');
Route::get('hr/timeattendance/operation/yearly_holidays/open_status', 'Hr\TimeAttendance\YearlyHolidayController@openStatus');
Route::get('hr/timeattendance/get_holidays', 'Hr\TimeAttendance\YearlyHolidayController@getHolidays');

//Raw Punch Data
Route::get('hr/timeattendance/raw_punch', 'Hr\TimeAttendance\RawPunchController@rawPunch');


//---------Hr/ Payroll-----------//

Route::get('hr/payroll/ot', 'Hr\Payroll\OtController@OT');
Route::post('hr/payroll/ot', 'Hr\Payroll\OtController@OtStore');
Route::get('hr/payroll/ot_list', 'Hr\Payroll\OtController@otList');
Route::get('hr/payroll/ot/{id}', 'Hr\Payroll\OtController@otEdit');
Route::post('hr/payroll/ot_update', 'Hr\Payroll\OtController@otUpdate');
Route::post('hr/payroll/ot_list_data', 'Hr\Payroll\OtController@otListData');
Route::get('hr/payroll/benefit_list', 'Hr\Recruitment\BenefitController@benefitList');
Route::post('hr/payroll/benefit_list_data', 'Hr\Recruitment\BenefitController@benefitListData');
Route::get('hr/payroll/benefit_edit/{ben_as_id}', 'Hr\Recruitment\BenefitController@benefitEdit');
Route::post('hr/payroll/benefit_edit', 'Hr\Recruitment\BenefitController@benefitUpdate');

//Salary
Route::get('hr/payroll/salary', 'Hr\Payroll\SalaryController@view');

//Salary add deduct bulk upload
Route::get('hr/payroll/add_deduct', 'Hr\Payroll\SalaryController@uploadFile');
Route::post('hr/payroll/add_deduct', 'Hr\Payroll\SalaryController@storeFile');

//Increment
Route::get('hr/payroll/increment', 'Hr\Recruitment\BenefitController@showIncrementForm');
Route::get('hr/payroll/get_associate', 'Hr\Recruitment\BenefitController@getAssociates');
Route::post('hr/payroll/increment', 'Hr\Recruitment\BenefitController@storeIncrement');
Route::get('hr/payroll/increment_edit/{id}', 'Hr\Recruitment\BenefitController@editIncrement');
Route::post('hr/payroll/increment_update', 'Hr\Recruitment\BenefitController@updateIncrement');

//Promotion
Route::get('hr/payroll/promotion', 'Hr\Recruitment\BenefitController@promotion');
Route::post('hr/payroll/promotion', 'Hr\Recruitment\BenefitController@storePromotion');
Route::get('hr/payroll/promotion_edit/{id}', 'Hr\Recruitment\BenefitController@promotionEdit');
Route::post('hr/payroll/promotion_update', 'Hr\Recruitment\BenefitController@updatePromotion');
Route::get('hr/payroll/promotion-associate-search', 'Hr\Recruitment\BenefitController@searchPromotedAssociate');
Route::get('hr/payroll/promotion-associate-info', 'Hr\Recruitment\BenefitController@promotedAssociateInfo');
Route::get('hr/payroll/benefit/{associate_id}', 'Hr\Recruitment\BenefitController@showAssociateBenefit');

//---------------------------Common Routes-------------------------//

// Upazilla and District
Route::get('district_wise_upazilla', 'DistrictUpazillaController@districtWiseUpazilla');
Route::get('level_wise_degree', 'EducationController@levelWiseDegree');

// ID Generator with department_id & joining_date
Route::post('id/generate', 'Hr\IDGenerator@generator');


//---------HR / Recruitment-----------//

// Employee Search
Route::get('hr/associate-search', 'Hr\Recruitment\EmployeeController@associtaeSearch');

Route::get('hr/associate-tags', 'Hr\Recruitment\EmployeeController@associateTags');
Route::get('hr/associate/{associate_id?}', 'Hr\Recruitment\EmployeeController@associtaeInfo'); 

// ID CARD GENERATE
Route::get('hr/recruitment/employee/idcard/', 'Hr\Recruitment\EmployeeController@idCard');
Route::get('hr/recruitment/employee/idcard/filter', 'Hr\Recruitment\EmployeeController@filterAssociate');
Route::get('hr/recruitment/employee/idcard/floor_list_by_unit', 'Hr\Recruitment\EmployeeController@idCardFloorListByUnit');
Route::get('hr/recruitment/employee/idcard/line_list_by_unit_floor', 'Hr\Recruitment\EmployeeController@idCardLineListByUnitFloor');
Route::post('hr/recruitment/employee/idcard/search', 'Hr\Recruitment\EmployeeController@idCardSearch');
Route::post('hr/recruitment/employee/idcard/generate', 'Hr\Recruitment\EmployeeController@idCardGenerate');
//Employee Hierarchy
Route::get('hr/recruitment/employee/hierarchy/', 'Hr\Recruitment\EmployeeController@hierarchy');
Route::get('hr/recruitment/employee/hierarchy_data', 'Hr\Recruitment\EmployeeController@getHierarchy');


// Worker 
Route::get('hr/recruitment/worker/recruit_list', 'Hr\Recruitment\WorkerController@recruitList');
Route::post('hr/recruitment/worker/recruit_data', 'Hr\Recruitment\WorkerController@recruitData');
Route::get('hr/recruitment/worker/recruit', 'Hr\Recruitment\WorkerController@recruitForm');
Route::get('hr/recruitment/worker/recruit_edit/{worker_id}', 'Hr\Recruitment\WorkerController@recruitEditForm');
Route::post('hr/recruitment/worker/recruit', 'Hr\Recruitment\WorkerController@recruitStore');
Route::post('hr/recruitment/worker/recruit/excel/import', 'Hr\Recruitment\WorkerExcelController@import'); 

Route::get('hr/recruitment/worker/medical_list', 'Hr\Recruitment\WorkerController@showMedicalList');
Route::post('hr/recruitment/worker/medical_data', 'Hr\Recruitment\WorkerController@medicalData');
Route::get('hr/recruitment/worker/medical_edit/{worker_id}', 'Hr\Recruitment\WorkerController@editMedical');
Route::post('hr/recruitment/worker/medical', 'Hr\Recruitment\WorkerController@medicalStore');
 
Route::get('hr/recruitment/worker/ie_skill_list', 'Hr\Recruitment\WorkerController@showIeSkillList');
Route::post('hr/recruitment/worker/ie_skill_data', 'Hr\Recruitment\WorkerController@getIeSkillData');
Route::get('hr/recruitment/worker/ie_skill_edit/{worker_id}', 'Hr\Recruitment\WorkerController@editIeSkill');
Route::post('hr/recruitment/worker/ie_skill_test', 'Hr\Recruitment\WorkerController@ieSkillStore');

Route::get('hr/recruitment/worker/migrate/{worker_id}', 'Hr\Recruitment\WorkerController@migrate');

// Employee
Route::get('hr/recruitment/employee/employee_list', 'Hr\Recruitment\EmployeeController@showList');

Route::get('hr/recruitment/employee/employee_list_details', 'Hr\Recruitment\EmployeeController@showListDetails');
Route::get('hr/recruitment/employee/employee_data', 'Hr\Recruitment\EmployeeController@getData'); 

//Route::post('hr/recruitment/employee/employee_data', 'Hr\Recruitment\EmployeeController@getData');

Route::get('hr/recruitment/employee/show/{associate_id?}', 'Hr\Recruitment\EmployeeController@show');
Route::get('hr/recruitment/employee/edit/{associate_id?}', 'Hr\Recruitment\EmployeeController@edit');
Route::get('hr/recruitment/employee/delete/{associate_id?}', 'Hr\Recruitment\EmployeeController@delete');
Route::get('hr/recruitment/employee/add_employee', 'Hr\Recruitment\EmployeeController@showEmployeeForm');
Route::post('hr/recruitment/employee/add_employee', 'Hr\Recruitment\EmployeeController@saveEmployee');
Route::post('hr/recruitment/employee/update_employee', 'Hr\Recruitment\EmployeeController@updateEmployee');
 
// Medical Info
Route::get('hr/recruitment/operation/medical_info','Hr\Recruitment\MedicalInfoController@medicalInfo');
Route::post('hr/recruitment/operation/medical_info','Hr\Recruitment\MedicalInfoController@medicalInfoStore');
Route::get('hr/recruitment/operation/medical_info_list','Hr\Recruitment\MedicalInfoController@medicalInfoList');
Route::post('hr/recruitment/operation/medical_info_list_data','Hr\Recruitment\MedicalInfoController@medicalInfoListData');
Route::get('hr/recruitment/operation/medical_info_edit/{med_as_id}','Hr\Recruitment\MedicalInfoController@medicalInfoEdit');
Route::post('hr/recruitment/operation/medical_info_update','Hr\Recruitment\MedicalInfoController@medicalInfoUpdate');

//Advance Information
Route::get('hr/recruitment/operation/advance_info','Hr\Recruitment\AdvanceInfoController@advanceInfo');
Route::post('hr/recruitment/operation/advance_info','Hr\Recruitment\AdvanceInfoController@advanceInfoStore');
Route::post('hr/recruitment/operation/education_info','Hr\Recruitment\AdvanceInfoController@educationInfoStore');
Route::post('hr/recruitment/employee/add_employee_bn', 'Hr\Recruitment\AdvanceInfoController@saveBengali');
Route::get('hr/recruitment/operation/advance_info_list','Hr\Recruitment\AdvanceInfoController@advanceInfoList');
Route::post('hr/recruitment/operation/advance_info_list_data','Hr\Recruitment\AdvanceInfoController@advanceInfoListData');
Route::get('hr/recruitment/operation/advance_info_edit/{emp_adv_info_as_id}','Hr\Recruitment\AdvanceInfoController@advanceInfoEdit');
Route::post('hr/recruitment/operation/advance_info_update','Hr\Recruitment\AdvanceInfoController@advanceInfoUpdate');
Route::get('hr/recruitment/education_history','Hr\Recruitment\AdvanceInfoController@educationHistory');

//Benefitfs
Route::get('hr/recruitment/operation/benefits','Hr\Recruitment\BenefitController@benefits');
Route::post('hr/recruitment/operation/benefits','Hr\Recruitment\BenefitController@benefitStore');
Route::get('hr/recruitment/get_benefit_by_id','Hr\Recruitment\BenefitController@getBenefitByID');

//Job Portal
Route::get('hr/recruitment/job_portal/cv', 'Hr\Recruitment\CvController@CV');
Route::get('hr/recruitment/job_portal/job_posting', 'Hr\Recruitment\JobController@JobPosting');

Route::get('hr/recruitment/job_portal/job_posting_list', 'Hr\Recruitment\JobController@JobPostingList');

Route::get('hr/recruitment/job_portal/job_posting_list/{job_po_id}/{status}', 'Hr\Recruitment\JobController@JobPostingListStatus');

Route::post('hr/recruitment/job_portal/job_posting_data', 'Hr\Recruitment\JobController@JobPostingListData');

Route::post('hr/recruitment/job_portal/job_posting', 'Hr\Recruitment\JobController@JobPostingStore');
Route::get('hr/recruitment/job_portal/interview_notes', 'Hr\Recruitment\InterviewNoteController@Interview');
Route::post('hr/recruitment/job_portal/interview_notes', 'Hr\Recruitment\InterviewNoteController@InterviewNoteStore');

// Joining Letter
Route::get('hr/recruitment/job_portal/joining_letter','Hr\Recruitment\JoiningLetterController@Letter');
Route::post('hr/recruitment/job_portal/joining_letter','Hr\Recruitment\JoiningLetterController@LetterSave');
Route::get('hr/recruitment/job_portal/pdfview/{ arg}','Hr\Recruitment\JoiningLetterController@pdfDownload');

//---------HR / ESS-----------//

// Grievance Appeal
Route::get('hr/ess/grievance/appeal_list', 'Hr\Ess\GrievanceAppealController@showList');
Route::post('hr/ess/grievance/appeal_data', 'Hr\Ess\GrievanceAppealController@getData');
Route::get('hr/ess/grievance/appeal', 'Hr\Ess\GrievanceAppealController@showForm');
Route::post('hr/ess/grievance/appeal', 'Hr\Ess\GrievanceAppealController@saveData');

// Loan Application
Route::get('hr/ess/loan_list', 'Hr\Ess\LoanApplicationController@loanList');
Route::post('hr/ess/loan_data', 'Hr\Ess\LoanApplicationController@getData');
Route::get('hr/ess/loan_application', 'Hr\Ess\LoanApplicationController@showForm');
Route::post('hr/ess/loan_application', 'Hr\Ess\LoanApplicationController@saveData');
Route::get('hr/ess/loan_history', 'Hr\Ess\LoanApplicationController@loanHistory');
Route::get('hr/ess/loan_status/{id}/{associate_id}', 'Hr\Ess\LoanApplicationController@showLoanStatus');
Route::post('hr/ess/loan_status', 'Hr\Ess\LoanApplicationController@updateLoanStatus');

// Leave Application
Route::get('hr/ess/leave_application', 'Hr\Ess\LeaveApplicationController@showForm');
Route::post('hr/ess/leave_application', 'Hr\Ess\LeaveApplicationController@saveData');
Route::get('hr/ess/leave_history', 'Hr\Ess\LeaveApplicationController@leaveHistory');

// Medical Incident
Route::get('hr/ess/medical_incident', 'Hr\Ess\MedicalIncidentController@medicalIncident');
Route::post('hr/ess/medical_incident', 'Hr\Ess\MedicalIncidentController@medicalIncidentStore');
Route::get('hr/ess/medical_incident_edit/{id}', 'Hr\Ess\MedicalIncidentController@medicalIncidentEdit');
Route::post('hr/ess/medical_incident_update', 'Hr\Ess\MedicalIncidentController@update');
Route::get('hr/ess/medical_incident_list', 'Hr\Ess\MedicalIncidentController@medicalIncidentList');
Route::post('hr/ess/medical_incident_data', 'Hr\Ess\MedicalIncidentController@medicalIncidentData');


//---------HR / Training-----------//

// Add Training
Route::get('hr/training/training_list', 'Hr\Training\TrainingController@trainingList');
Route::get('hr/training/training_data', 'Hr\Training\TrainingController@getData');
Route::get('/hr/training/training_status/{id}/{status}', 'Hr\Training\TrainingController@trainingStatus');
Route::get('hr/training/add_training', 'Hr\Training\TrainingController@showForm');
Route::post('hr/training/add_training', 'Hr\Training\TrainingController@saveTraining');

// Assign Training
Route::get('hr/training/assign_list', 'Hr\Training\TrainingAssignController@assignList');
Route::post('hr/training/assign_data', 'Hr\Training\TrainingAssignController@getData');
Route::get('hr/training/assign_status/{id}/{status}', 'Hr\Training\TrainingAssignController@assignStatus');
Route::get('hr/training/assign_training', 'Hr\Training\TrainingAssignController@showForm');
Route::post('hr/training/assign_training', 'Hr\Training\TrainingAssignController@saveTraining');
  

//---------HR / Assets Management-----------//

Route::get('hr/assets/assign', 'Hr\Assets\AssetController@showForm');
Route::post('hr/assets/assign', 'Hr\Assets\AssetController@saveData');
Route::get('hr/assets/get-product-by-category-id', 'Hr\Assets\AssetController@getProductByCategoryID');
Route::get('hr/assets/get-product-by-product-id', 'Hr\Assets\AssetController@getAssetByProductID');
Route::get('hr/assets/assign_list', 'Hr\Assets\AssetController@showList');
Route::post('hr/assets/assign_data', 'Hr\Assets\AssetController@getData');
Route::get('hr/assets/assign_edit/{id}', 'Hr\Assets\AssetController@editForm');
Route::post('hr/assets/assign_edit', 'Hr\Assets\AssetController@updateData');


//---------HR / Performance-----------//

Route::get('hr/performance/operation/disciplinary_list', 'Hr\Performance\DisciplinaryRecordController@showList');
Route::get('hr/performance/operation/disciplinary_data', 'Hr\Performance\DisciplinaryRecordController@getData');
Route::get('hr/performance/operation/disciplinary_form', 'Hr\Performance\DisciplinaryRecordController@showForm');
Route::post('hr/performance/operation/disciplinary_form', 'Hr\Performance\DisciplinaryRecordController@saveData');
Route::get('hr/performance/operation/disciplinary_edit/{record_id}', 'Hr\Performance\DisciplinaryRecordController@editForm');
Route::post('hr/performance/operation/disciplinary_edit', 'Hr\Performance\DisciplinaryRecordController@updateData');
Route::get('hr/performance/appraisal', 'Hr\Performance\AppraisalController@showForm');
Route::post('hr/performance/appraisal', 'Hr\Performance\AppraisalController@saveData');
Route::get('hr/performance/appraisal_list', 'Hr\Performance\AppraisalListController@appraisalList');
Route::post('hr/performance/appraisal_list_data', 'Hr\Performance\AppraisalListController@appraisalListData');
Route::get('hr/performance/appraisal_approve/{hr_pa_as_id}', 'Hr\Performance\AppraisalListController@AppraisalView');
Route::post('hr/performance/appraisal_approve/approve_reject', 'Hr\Performance\AppraisalListController@appraisalStatus');


//---------HR / Setup-----------//

//unit
Route::get('hr/setup/unit','Hr\Setup\UnitController@unit'); 
Route::post('hr/setup/unit','Hr\Setup\UnitController@unitStore');
Route::get('hr/setup/unit/{hr_unit_id}','Hr\Setup\UnitController@unitDelete');
Route::get('hr/setup/unit_update/{hr_unit_id}','Hr\Setup\UnitController@unitUpdate');
Route::post('hr/setup/unit_update','Hr\Setup\UnitController@unitUpdateStore');

//floor
Route::get('hr/setup/floor','Hr\Setup\FloorController@floor');
Route::get('hr/setup/getFloorListByUnitID','Hr\Setup\FloorController@getFloorListByUnitID');
Route::post('hr/setup/floor','Hr\Setup\FloorController@floorStore');
Route::get('hr/setup/floor/{hr_floor_id}','Hr\Setup\FloorController@floorDelete');
Route::get('hr/setup/floor_update/{hr_floor_id}','Hr\Setup\FloorController@floorUpdate');
Route::post('hr/setup/floor_update','Hr\Setup\FloorController@floorUpdateStore');

//line
Route::get('hr/setup/line','Hr\Setup\LineController@line');
Route::get('hr/setup/getLineListByFloorID','Hr\Setup\LineController@getLineListByFloorID');
Route::post('hr/setup/line','Hr\Setup\LineController@lineStore');
Route::get('hr/setup/line/{hr_line_id}','Hr\Setup\LineController@lineDelete');
Route::get('hr/setup/line_update/{hr_line_id}','Hr\Setup\LineController@lineUpdate');
Route::post('hr/setup/line_update','Hr\Setup\LineController@lineUpdateStore');

//shift
Route::get('hr/setup/shift','Hr\Setup\ShiftController@shift');
Route::get('hr/setup/getShiftListByLineID','Hr\Setup\ShiftController@getShiftListByLineID');
Route::post('hr/setup/shift','Hr\Setup\ShiftController@shiftStore');
Route::get('hr/setup/shift/{hr_shift_id}','Hr\Setup\ShiftController@shiftDelete');
Route::get('hr/setup/shift_update/{hr_shift_id}','Hr\Setup\ShiftController@shiftUpdate');
Route::post('hr/setup/shift_update','Hr\Setup\ShiftController@shiftUpdateStore');

//department
Route::get('hr/setup/department','Hr\Setup\DepartmentController@department');
Route::get('hr/setup/getDepartmentListByAreaID','Hr\Setup\DepartmentController@getDepartmentListByAreaID');
Route::post('hr/setup/department','Hr\Setup\DepartmentController@departmentStore');
Route::get('hr/setup/department/{hr_department_id}','Hr\Setup\DepartmentController@departmentDelete');
Route::get('hr/setup/department_update/{hr_department_id}','Hr\Setup\DepartmentController@departmentUpdate');
Route::post('hr/setup/department_update','Hr\Setup\DepartmentController@departmentUpdateStore');

//section
Route::get('hr/setup/section','Hr\Setup\SectionController@section');
Route::get('hr/setup/getSectionListByDepartmentID','Hr\Setup\SectionController@getSectionListByDepartmentID');
Route::post('hr/setup/section','Hr\Setup\SectionController@sectionStore');
Route::get('hr/setup/section/{hr_section_id}','Hr\Setup\SectionController@sectionDelete');
Route::get('hr/setup/section_update/{hr_section_id}','Hr\Setup\SectionController@sectionUpdate');
Route::post('hr/setup/section_update','Hr\Setup\SectionController@sectionUpdateStore');

//subsection
Route::get('hr/setup/subsection','Hr\Setup\SubsectionController@subsection');
Route::get('hr/setup/getSubSectionListBySectionID','Hr\Setup\SubsectionController@getSubSectionListBySectionID');
Route::post('hr/setup/subsection','Hr\Setup\SubsectionController@subsectionStore');
Route::get('hr/setup/subsection/{hr_subsec_id}','Hr\Setup\SubsectionController@subsectionDelete');
Route::get('hr/setup/subsection_update/{hr_subsec_id}','Hr\Setup\SubsectionController@subsectionUpdate');
Route::post('hr/setup/subsection_update','Hr\Setup\SubsectionController@subsectionUpdateStore');

//designation
Route::get('hr/setup/designation','Hr\Setup\DesignationController@designation');
Route::get('hr/setup/getDesignationListByEmployeeTypeID','Hr\Setup\DesignationController@getDesignationListByEmployeeTypeID');
Route::post('hr/setup/designation','Hr\Setup\DesignationController@designationStore');
Route::get('hr/setup/designation/{hr_designation_id}','Hr\Setup\DesignationController@designationDelete');
Route::get('hr/setup/designation_update/{hr_designation_id}','Hr\Setup\DesignationController@designationUpdate');
Route::post('hr/setup/designation_update','Hr\Setup\DesignationController@designationupdateStore');
Route::post('hr/hierarchy', 'Hr\Setup\DesignationController@hierarchy');

//Loan Type
Route::get('hr/setup/loan_type','Hr\Setup\LoanTypeController@addloanType');
Route::post('hr/setup/loan_type','Hr\Setup\LoanTypeController@storeloanType');

//Salary Structure
Route::get('hr/setup/salary_structure', 'Hr\Setup\SalaryStructureController@showForm');
Route::post('hr/setup/salary_structure', 'Hr\Setup\SalaryStructureController@save');

//Education Level
Route::get('hr/setup/education_title', 'Hr\Setup\EducationLevelController@showForm');
Route::post('hr/setup/education_title', 'Hr\Setup\EducationLevelController@saveData');

//Increment Type
Route::get('hr/setup/increment_type', 'Hr\Setup\IncrementTypeController@showForm');
Route::post('hr/setup/increment_type', 'Hr\Setup\IncrementTypeController@saveData');
Route::get('hr/setup/increment_type_edit/{id}', 'Hr\Setup\IncrementTypeController@incrementTypeEdit');
Route::post('hr/setup/increment_type_update', 'Hr\Setup\IncrementTypeController@incrementTypeUpdate');
Route::get('hr/setup/increment_type_delete/{id}', 'Hr\Setup\IncrementTypeController@incrementTypeDelete');

//Add Other Benifit Item 
Route::get('hr/setup/other_benefit_item', 'Hr\Setup\OtherBenefitController@otherBenefit');
Route::post('hr/setup/other_benefit_item', 'Hr\Setup\OtherBenefitController@otherBenefitStore');
Route::get('hr/setup/other_benefit_delete/{id}', 'Hr\Setup\OtherBenefitController@otherBenefitDelete');

//other Benefit
Route::post('hr/payroll/other_benefit', 'Hr\Recruitment\BenefitController@otherBenefitStore');
//Attendance bonus
Route::get('hr/setup/attendance_bonus', 'Hr\Setup\AttendanceBonusController@showForm');
Route::post('hr/setup/attendance_bonus_store', 'Hr\Setup\AttendanceBonusController@attBonusStore');



//---------HR / Profile-----------//

Route::get('hr/user/profile', 'Hr\ProfileController@showProfile');


//---------HR / Notification-----------//

Route::get('hr/notification/loan/loan_app_list', 'Hr\Notification\NotifLoanController@ShowLoan');
Route::get('hr/notification/loan/loan_data', 'Hr\Notification\NotifLoanController@LoanData');
Route::get('hr/notification/loan/loan_approve/{hr_la_id?}', 'Hr\Notification\NotifLoanController@LoanView');
Route::post('hr/notification/loan/loan_approve/approve_reject', 'Hr\Notification\NotifLoanController@LoanStatus');
Route::get('hr/notification/appraisal/performance_appraisal_list', 'Hr\Notification\NotifPAController@AppraisalList');
Route::get('hr/notification/appraisal/performance_appraisal_data', 'Hr\Notification\NotifPAController@AppraisalData');
Route::get('hr/notification/appraisal/appraisal_approve/{id?}', 'Hr\Notification\NotifPAController@AppraisalView');
Route::post('hr/notification/appraisal/appraisal_approve/approve_reject', 'Hr\Notification\NotifPAController@AppraisalStatus');
Route::get('hr/notification/greivance/greivance_appeal_list', 'Hr\Notification\NotifGAController@greivanceAppealList');
Route::get('hr/notification/greivance/greivance_appeal_data', 'Hr\Notification\NotifGAController@greivanceAppealListData');
Route::get('hr/notification/greivance/greivance_approve', 'Hr\Notification\NotifGAController@GreivanceView');
Route::post('hr/notification/greivance/greivance_approve', 'Hr\Notification\NotifGAController@GreivanceApprove');
Route::post('hr/notification/greivance/greivance_approve/approve_reject', 'Hr\Notification\NotifGAController@DisciplinaryRecordStatus');
Route::get('hr/notification/training/training_list', 'Hr\Notification\NotifTrainingController@TrainingList');
Route::get('hr/notification/training/training_data', 'Hr\Notification\NotifTrainingController@TrainingData');
Route::get('hr/notification/training/training_approve/{tr_as_id}', 'Hr\Notification\NotifTrainingController@TrainingView');
Route::post('hr/notification/training/training_approve/aprrove_reject', 'Hr\Notification\NotifTrainingController@TrainingStatus');
Route::get('hr/notification/leave/leave_app_list', 'Hr\Notification\NotifLeaveController@LeaveList');
Route::get('hr/notification/leave/leave_app_data', 'Hr\Notification\NotifLeaveController@LeaveData');
Route::get('hr/notification/leave/leave_approve/{hr_leave_id?}', 'Hr\Notification\NotifLeaveController@LeaveView');
Route::post('hr/notification/leave/leave_approve/approve_reject', 'Hr\Notification\NotifLeaveController@LeaveStatus');



//---------HR / Reports-----------//
//application letter
Route::get('hr/reports/job_application', 'Hr\Reports\JobApplicationController@applicationForm');
Route::post('hr/reports/job_application', 'Hr\Reports\JobApplicationController@saveApplicationForm');


//File Tag Print
Route::get('hr/reports/file_tag', 'Hr\Reports\FileTagController@showForm');
Route::post('hr/reports/filetag/search', 'Hr\Reports\FileTagController@fileTagSearch');

// JOB CARD
Route::get('hr/reports/job_card', 'Hr\Reports\JobCardController@jobCard');
//EMPLOYEE
Route::get('hr/reports/employee_report', 'Hr\Reports\EmployeeReportController@report');


#----------  Reports By Mati-----------#
//Salary/Wages Increment Status
Route::get('hr/reports/increment_report', 'Hr\Reports\IncrementReportController@incrementReport');
Route::get('hr/reports/nominee', 'Hr\Reports\NomineeController@showForm');
Route::get('hr/reports/leave_log', 'Hr\Reports\LeaveLogController@showForm');
Route::get('hr/reports/leave_check', 'Hr\Reports\LeaveLogController@checkDueLeave');

Route::get('hr/reports/salary_sheet', 'Hr\Reports\SalarySheetController@showForm');
// save salary report (Rubel)
Route::post('hr/reports/save_salary_sheet', 'Hr\Reports\SalarySheetController@saveSalarySheet');
Route::get('hr/reports/payslip', 'Hr\Reports\PayslipController@showForm');
Route::get('hr/reports/attendance_report', 'Hr\Reports\AttendanceReportController@showForm');
Route::get('hr/reports/floor_ass_by_unit', 'Hr\Reports\IncrementReportController@floorAssByUnit');

Route::get('hr/reports/attendance_report_2', 'Hr\Reports\AttendanceReportController@showForm2');

#------------- Search associate with paramenters(unit, floor, line)---------#
Route::get('hr/reports/search_associate', 'Hr\Reports\IncrementReportController@searchAssociate');
Route::get('hr/reports/back_verf', 'Hr\Reports\BackgroundController@backgroundVerification');
Route::post('hr/reports/back_verf', 'Hr\Reports\BackgroundController@backgroundVerificationStore');
Route::get('hr/reports/absent_status', 'Hr\Reports\AbsentStatusController@showForm');

Route::get('hr/reports/line_wise_att', 'Hr\Reports\LineWiseAttController@lineWiseAtt');
Route::get('hr/reports/line_by_unit','Hr\Reports\LineWiseAttController@getLineByUnit');

// Test
Route::get('hr/reports/line_wise_att2', 'Hr\Reports\LineWiseAttController2@lineWiseAtt');
Route::get('hr/reports/line_by_unit2','Hr\Reports\LineWiseAttController2@getLineByUnit');

//

Route::get('hr/reports/monthy_increment', 'Hr\Reports\MonthlyIncrementController@increment');
Route::get('hr/reports/absent_status', 'Hr\Reports\AbsentStatusController@showForm');

Route::get('hr/reports/bonus_slip', 'Hr\Reports\BonusSlipController@showForm');
Route::get('hr/reports/floor_by_unit', 'Hr\Reports\BonusSlipController@floorByUnit');
//daily OT Report
Route::get('hr/reports/daily_ot_report', 'Hr\Reports\DailyOTReportController@dailyOT');

//worker register
Route::get('hr/reports/worker_register', 'Hr\Reports\workerRegisterController@workerRegister');
Route::get('hr/reports/worker_register_table', 'Hr\Reports\workerRegisterController@workerRegisterList');

Route::get('hr/reports/worker_register_employee', 'Hr\Reports\workerRegisterController@associtaeUnitSearch');

//Unit Attendance report
Route::get('hr/reports/unitattendance', 'Hr\Reports\unitAttendanceController@unitAttendance');
Route::get('hr/reports/unitattendance_table', 'Hr\Reports\unitAttendanceController@unitAttendanceList');

//Earn Leave Payment Sheet
Route::get('hr/reports/earnleavepayment', 'Hr\Reports\earnLeaveController@earnLeavePayment');
Route::get('hr/reports/earnleavepayment_floor', 'Hr\Reports\earnLeaveController@floor');

Route::get('hr/reports/earnleavepayment_table', 'Hr\Reports\earnLeaveController@earnLeavePaymentList');

Route::post('hr/reports/earnleavepaymentstore', 'Hr\Reports\earnLeaveController@earnLeavePaymentStore');


//Extra OT Sheet

Route::get('hr/reports/extraotsheet', 'Hr\Reports\extraOtSheetController@extraOtSheet');
Route::get('hr/reports/extra_ot_list', 'Hr\Reports\extraOtSheetController@extraOtListGenerate');

//Fixed Salary Sheet

Route::get('hr/reports/fixedsalarysheet', 'Hr\Reports\FixedSalarySheetController@fixedSalarySheet');
Route::get('hr/reports/fixed_salary_list', 'Hr\Reports\FixedSalarySheetController@fixedSalaryListGenerate');

//Multiple Salary Sheet 
Route::get('hr/reports/salary-sheet-custom', 'Hr\Reports\SalarySheetCustomController@index');
Route::get('hr/reports/salary-sheet-custom-individual-search', 'Hr\Reports\SalarySheetCustomController@individualSearch');
Route::get('hr/reports/salary-sheet-custom-multi-search', 'Hr\Reports\SalarySheetCustomController@multiSearch');

//Service Book

Route::get('hr/operation/servicebook', 'Hr\ServiceBook\ServiceBookController@showForm');
Route::post('hr/operation/servicebookstore', 'Hr\ServiceBook\ServiceBookController@servicebookStore');
Route::get('hr/operation/servicebookedit/{sb_id?}', 'Hr\ServiceBook\ServiceBookController@servicebookEdit');
Route::post('hr/operation/servicebookupdate', 'Hr\ServiceBook\ServiceBookController@servicebookUpdate');
Route::get('hr/operation/servicebookpage', 'Hr\ServiceBook\ServiceBookController@servicebookPage');

//Cost Mapping
Route::get('hr/operation/cost-mapping', 'Hr\Recruitment\CostMappingController@showForm');
Route::get('hr/operation/gross_salary', 'Hr\Recruitment\CostMappingController@getAssGross');
Route::post('hr/operation/unit_map', 'Hr\Recruitment\CostMappingController@unitMapStore');
Route::post('hr/operation/area_map', 'Hr\Recruitment\CostMappingController@areaMapStore');
Route::get('hr/operation/cost_mapping_list', 'Hr\Recruitment\CostMappingController@mapList');
Route::post('hr/operation/cost_mapping_data', 'Hr\Recruitment\CostMappingController@mapData');
Route::get('hr/operation/cost_mapping/{id}', 'Hr\Recruitment\CostMappingController@viewMap');
Route::get('hr/operation/cost_mapping_edit/{id}', 'Hr\Recruitment\CostMappingController@editMap');

Route::post('hr/operation/unit_map_update', 'Hr\Recruitment\CostMappingController@unitMapUpdate');
Route::post('hr/operation/area_map_update', 'Hr\Recruitment\CostMappingController@areaMapUpdate');


//Frequent Manual Attendance report
Route::get('hr/reports/manual_attendance', 'Hr\Reports\manualAttendanceReportController@manualAttendanceForm');
Route::get('hr/reports/manual_attendance_list', 'Hr\Reports\manualAttendanceReportController@manualAttendanceList');


	#---------- HR Logs----------------# 
Route::get('hr/logs/desg_update_log', 'Hr\Logs\LogController@designationLog');
Route::post('hr/logs/desg_update_log_data', 'Hr\Logs\LogController@designationLogData');