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
                    <a href="#">Payroll</a>
                </li>
                <li class="active">Benefit Info</li>
            </ul><!-- /.breadcrumb -->
 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Payroll <small> <i class="ace-icon fa fa-angle-double-right"></i>Benefit Info</small></h1>
            </div>

            <div class="row">
                 <!-- Display Erro/Success Message -->
                    @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
						<div class="col-sm-6 center">
							<div>
								<div class="width-100 label label-info label-xlg ">
									<div class="inline position-relative">
										<a href="#" class="user-title-label">
											<span class="white">{{ !empty($info->as_name)?$info->as_name:null }}</span>
										</a>
									</div>
								</div>
							</div>
							<div class="space-6"></div>
							<div class="profile-contact-info">
								<div class="profile-contact-links align-left"> 
									<p style="text-align: center;">Associate ID: {{ !empty($info->associate_id)?$info->associate_id:null }}</p>
									<p style="text-align: center;">Designation: {{ !empty($info->hr_designation_name)?$info->hr_designation_name:null }}</p>
									<p style="text-align: center;">Department: {{ !empty($info->hr_department_name)?$info->hr_department_name:null }}</p>
									<p style="text-align: center;">Unit: {{ !empty($info->hr_unit_name)?$info->hr_unit_name:null }}</p>
								</div>
							</div>
						</div>

	                    <div class="col-sm-6">
							<div class="widget-box widget-color-blue">
		                        <div class="widget-header widget-header-flat">
		                            <h4 class="widget-title lighter">
		                                <i class="ace-icon fa fa-list"></i>
		                                Benefit History
		                            </h4>
		                        </div>

		                        <div class="widget-body">
		                            <div class="widget-main no-padding">
		                                <table class="table table-borderd" style="border:1px solid #6EAED1">
		                                    <thead>
		                                    <tr>
		                                        <th style="padding:4px">Type</th>
		                                        <th style="padding:4px">Amount</th>
		                                    </tr>   
		                                    </thead>
		                                    <tbody>
		                                    <tr>
		                                        <th style="padding:4px">Gross Salary</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_joining_salary)?$benefit->ben_joining_salary:0) }}</td>
		                                    </tr>
		                                    <tr>
		                                        <th style="padding:4px">Current Salary</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_current_salary)?$benefit->ben_current_salary:0) }}</td>
		                                    </tr>
		                                    <tr>
		                                        <th style="padding:4px">Basic Salary</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_basic)?$benefit->ben_basic:0) }}</td>
		                                    </tr>
		                                    <tr>
		                                        <th style="padding:4px">House Rent</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_house_rent)?$benefit->ben_house_rent:0) }}</td>
		                                    </tr>
		                                    <tr>
		                                        <th style="padding:4px">Medical</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_medical)?$benefit->ben_medical:0) }}</td>
		                                    </tr>
		                                    <tr>
		                                        <th style="padding:4px">Transportation</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_transport)?$benefit->ben_transport:0) }}</td>
		                                    </tr>
		                                    <tr>
		                                        <th style="padding:4px">Food</th>
		                                        <td style="padding:4px">{{ (!empty($benefit->ben_food)?$benefit->ben_food:0) }}</td>
		                                    </tr>
		                                    </tbody> 
		                                </table>
		                            </div>
		                        </div>
		                    </div> 
	                    </div>
                    </div>


                    <div class="row"> 
	                    <div class="col-sm-6">
							<div class="widget-box widget-color-blue">
		                        <div class="widget-header widget-header-flat">
		                            <h4 class="widget-title lighter">
		                                <i class="ace-icon fa fa-list"></i>
		                                Promotion History
		                            </h4>
		                        </div>

		                        <div class="widget-body">
		                            <div class="widget-main no-padding">
		                                <table class="table table-borderd" style="border:1px solid #6EAED1">
		                                    <thead>
			                                    <tr>
			                                        <th style="padding:4px">Current Designation</th>
			                                        <th style="padding:4px">Previous Designation</th>
			                                        <th style="padding:4px">Eligible Date</th>
			                                        <th style="padding:4px">Effective Date</th>
			                                    </tr>   
		                                    </thead>	 
		                                    <tbody> 
		                                    	@foreach($promotions as $promotion)
			                                    <tr>
			                                        <td style="padding:4px">{{ $promotion->current_designation }}</td>
			                                        <td style="padding:4px">{{ $promotion->previous_designation }}</td>
			                                        <td style="padding:4px">{{ $promotion->eligible_date }}</td>
			                                        <td style="padding:4px">{{ $promotion->effective_date }}</td>
			                                    </tr> 
			                                    @endforeach
		                                    </tbody> 
		                                </table>
		                            </div>
		                        </div>
		                    </div> 
	                    </div>
	                     
	                    <div class="col-sm-6">
							<div class="widget-box widget-color-blue">
		                        <div class="widget-header widget-header-flat">
		                            <h4 class="widget-title lighter">
		                                <i class="ace-icon fa fa-list"></i>
		                                Increment History
		                            </h4>
		                        </div>

		                        <div class="widget-body">
		                            <div class="widget-main no-padding">
		                                <table class="table table-borderd" style="border:1px solid #6EAED1">
		                                    <thead>
			                                    <tr>
			                                        <th style="padding:4px">Current Salary</th>
			                                        <th style="padding:4px">Previous Salary</th>
			                                        <th style="padding:4px">Increment Amount</th>
			                                        <th style="padding:4px">Eligible Date</th>
			                                        <th style="padding:4px">Effective Date</th>
			                                    </tr>   
		                                    </thead>	 
		                                    <tbody> 
		                                    	@foreach($increments as $increment)
			                                    <tr>
			                                        <td style="padding:4px">
			                                        <?php
														$amount = $increment->current_salary;
			                                         	if ($increment->amount_type==2)
			                                         	{
			                                         		$incrementAmount = ($increment->current_salary/100)*$increment->increment_amount;
			                                         	} 
			                                         	else
			                                         	{
			                                         		$incrementAmount = $increment->increment_amount;
			                                         	}
			                                         	echo $amount+$incrementAmount;
		                                         	?>
			                                         </td>
			                                        <td style="padding:4px">
		                                        	{{ $increment->current_salary }}
			                                        </td>
			                                        <td style="padding:4px">
			                                        <?php 
			                                        if($increment->amount_type==1)    
			                                        	 echo $increment->increment_amount;
			                                        else {
			                                        	if(!empty($benefit->ben_basic)){
			                                        	echo ($benefit->ben_basic/100)*$increment->increment_amount;}
			                                        	echo " (".$increment->increment_amount. "%)";} ?>
			                                        </td>
			                                        <td style="padding:4px">{{ $increment->eligible_date }}</td>
			                                        <td style="padding:4px">{{ $increment->effective_date }}</td>
			                                    </tr> 
			                                    @endforeach
		                                    </tbody> 
		                                </table>
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
@endsection




