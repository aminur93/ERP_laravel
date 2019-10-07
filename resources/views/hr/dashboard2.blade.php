@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="/">HR</a>
                </li>
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 

            <div class="page-header">
                <h1>
                    Dashboard
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Human Resource Management
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row"> 
                <div class="col-sm-6">
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                                <i class="ace-icon fa fa-list"></i>
                                Current Year Leave History
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
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
                    </div>

                    <br/>
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                                <i class="ace-icon fa fa-list"></i>
                                Loan History
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <table class="table table-borderd table-compact">
                                    <thead>
                                        <tr>
                                            <th>Types of Loan</th>
                                            <th>Applied Amount</th>
                                            <th>Approved Amount</th>
                                            <th>Due</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <body>
                                    @foreach($loans as $loan)
                                        <tr>
                                            <td>{{ $loan->hr_la_type_of_loan }}</td>
                                            <td>{{ $loan->hr_la_applied_amount }}</td>
                                            <td>{{ $loan->hr_la_approved_amount }}</td>
                                            <td>0.00</td>
                                            <td>
                                                @if($loan->hr_la_updated_at !=null)     {{ date("d-M-Y",strtotime($loan->hr_la_updated_at)) }}
                                                @endif
                                            </td>
                                            <td>{{ $loan->hr_la_status }}</td>
                                        </tr>
                                    @endforeach 
                                    </body>
                                </table> 
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                                <i class="ace-icon fa fa-list"></i>
                                Disciplinary Records
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
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
                                <tbody>
                                @foreach($records as $record)
                                    <tr> 
                                        <td>{{ $record->dis_re_griever_id }}</td>
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
                                Current Month Attendance
                            </h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <table id="dataTables" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Date</th>
                                            <th>Floor</th>
                                            <th>Shift</th>
                                            <th>In Time</th>
                                            <th>Out Time</th>
                                            <th>Over Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendances as $att)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $att->date }}</td>
                                            <td>{{ $att->hr_floor_name }}</td>
                                            <td>{{ $att->hr_shift_code }}</td>
                                            <td>{{ $att->start }}</td>
                                            <td>{{ $att->end }}</td>
                                            <td>
                                            <?php
                                                $out = date('H:i:s', strtotime($att->out_time));
                                                $shift_out = DB::table('hr_shift')
                                                    ->select('hr_shift_id','hr_shift_end_time')
                                                    ->where('hr_shift_code', "=", $att->hr_shift_code)
                                                    ->first();
                                                if($shift_out == null)
                                                {
                                                    $shift_out_time=0;
                                                } 
                                                else
                                                {
                                                    $shift_out_time=$shift_out->hr_shift_end_time;
                                                }

                                                if(($att->as_emp_type_id == 3) &&  ($out > $shift_out_time) && $shift_out_time !=0){
                                                    
                                                    $hour = date('h', strtotime($out) - strtotime($shift_out_time));
                                                    if(date('h',strtotime($out)) == date('h',strtotime($shift_out_time)))
                                                        $hour=0;
                                                    $minute= date('i', strtotime($out) - strtotime($shift_out_time));

                                                    if($hour == 0 && $minute== 0)
                                                        $ot="";
                                                    else
                                                    $ot= $hour." h ". $minute. " m";
                                                }
                                                else {
                                                    $ot="0" ;
                                                } 
                                                echo $ot;
                                            ?>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>          
@endsection