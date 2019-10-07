@php
	$pageHead = $pageHead;
@endphp
@if(count($group1) > 0)
	@php 
		$group1Flug = 0;
		$title = 'Unit : '.$group1[0]->employee->unit['hr_unit_name_bn'].' - Location : '.$group1[0]->employee->location['hr_unit_name_bn'];
		$getSalaryList = $group1; 
	@endphp
	@include('hr.common.view_salary_sheet_list')
@else
	@php 
		$group1Flug = 1; 
	@endphp
@endif
@if(count($group2) > 0)
	
	@php 
		$group2Flug = 0;
		$title = 'Unit : '.$group2[0]->employee->unit['hr_unit_name_bn'].' - Location : '.$group2[0]->employee->location['hr_unit_name_bn'];
		$getSalaryList = $group2; 
	@endphp
	@include('hr.common.view_salary_sheet_list')
@else
	@php $group2Flug = 1; @endphp
@endif

@if(count($group3) > 0)
	
	@php 
		$group3Flug = 0;
		$title = 'Unit : '.$group3[0]->employee->unit['hr_unit_name_bn'].' - Location : '.$group3[0]->employee->location['hr_unit_name_bn'];
		$getSalaryList = $group3; 
	@endphp
	@include('hr.common.view_salary_sheet_list')
@else
	@php $group3Flug = 1; @endphp
@endif

@if($group1Flug == 1 && $group2Flug == 1 && $group3Flug == 1)
	@php
		$title = '';
		$getSalaryList = [];
	@endphp
	@include('hr.common.view_salary_sheet_list')
@endif