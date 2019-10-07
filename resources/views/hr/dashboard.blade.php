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

            <!-- <div class="row"> -->
                <!-- Display Erro/Success Message -->
                @include('inc/message')

                <!-- <div class="col-sm-12">  -->

                    <div class="row">
                        <div class="space-6"></div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="infobox-container">
                                <div class="infobox infobox-black">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/total-employee.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->total?$reportCount->employee->total:0) }}</span>
                                        <div class="infobox-content">Total Employee</div>
                                    </div>
                                </div>


                                <div class="infobox infobox-orange">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/today-join.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->todays_join?$reportCount->employee->todays_join:0) }}</span>
                                        <div class="infobox-content">Today's Joining</div>
                                    </div>
                                </div>
     

                                <div class="infobox infobox-blue">
                                    <div class="infobox-icon">
                                       <img src="{{ asset('assets/images/hr-dashboard-icons/male-employee.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->males?$reportCount->employee->males:0) }}</span>
                                        <div class="infobox-content">Male</div>
                                    </div>
                                </div>

                                <div class="infobox infobox-purple">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/female-employee.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->females?$reportCount->employee->females:0) }}</span>
                                        <div class="infobox-content">Female</div>
                                    </div>
                                </div>

                                <div class="infobox infobox-green">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/active-employee.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->active?$reportCount->employee->active:0) }}</span>
                                        <div class="infobox-content">Active</div>
                                    </div>
                                </div>

                                <div class="infobox infobox-red">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/inactive-employee.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->inactive?$reportCount->employee->inactive:0) }}</span>
                                        <div class="infobox-content">Inactive</div>
                                    </div>
                                </div>


                                <div class="infobox infobox-pink">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/over-time.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->ot?$reportCount->employee->ot:0) }}</span>
                                        <div class="infobox-content">OT</div>
                                    </div>
                                </div>


                                <div class="infobox infobox-grey">
                                    <div class="infobox-icon">
                                        <img src="{{ asset('assets/images/hr-dashboard-icons/no-over-time.png') }}" class="hr-dashboard-icon">
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number">{{ ($reportCount->employee->non_ot?$reportCount->employee->non_ot:0) }}</span>
                                        <div class="infobox-content">NON OT</div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    
                    
                    <!-- Yesterday OT Summary  -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title lighter">
                                            <i class="ace-icon fa fa-bar-chart"></i>
                                            Over-time Report
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <canvas id="lineChart"></canvas>
                                            <script >
                                                // Practice donought chart
                                                $(function(){
                                                    var ctxL = document.getElementById("lineChart").getContext('2d');

                                                    var myLineChart = new Chart(ctxL, {
                                                        type: 'line',
                                                        data: {
                           
                                                            labels: [ <?php echo $lineChartData->day_names; ?> ],
                                                            datasets: [ <?php echo $lineChartData->dataset_string; ?> 
                                                            ]
                                                        },
                                                        options: {
                                                            responsive: true
                                                        }
                                                    });
                                                });
                                            //end of donought chart practice
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- OverTime graph end -->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title lighter">
                                            <i class="ace-icon fa fa-list"></i>
                                            Unit wise Employee Summary
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <table class="table table-bordered table-striped">
                                                <thead class="thin-border-bottom">
                                                    <tr>
                                                        <th style="text-align: center;">Unit</th>
                                                        <th>Male</th>
                                                        <th>Female</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($unitWiseEmpSummary AS $emp)
                                                    <tr>
                                                        <td>{{ $emp->hr_unit_name }}</td>
                                                        <td>{{ $emp->male }} </td>
                                                        <td>{{ $emp->female }}</td>
                                                        <td>{{ $emp->total }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12" style="margin-top: 10px;">
                            <!-- this portion is for practice -->
                            <?php $n=1; ?>
                            @foreach($dounoughtChart->chart AS $dounought)
                            <div class="col-sm-6" style="margin-bottom: 10px;">
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title lighter" style="font-size: 14px;">
                                            <i class="ace-icon fa fa-bar-chart"></i>
                                            Today's Attendance of <font style="font-weight: bold; font-size: 14px;">{{ $dounought->unit }}</font>
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <canvas id='<?php echo "doughnutChart".$n ?>'></canvas>
                                            <script >
                                                // Practice donought chart
                                                $(function(){
                                                    var ctxP = document.getElementById('<?php echo "doughnutChart".$n++ ?>').getContext('2d');
                                                    ctxP.canvas.height= 160;
                                                    var myPieChart = new Chart(ctxP, {
                                                        type: 'doughnut',
                                                        data: {
                                                        labels: ["Present","Absent", "Casual Leave", "Earned Leave", "Sick Leave", "Maternity Leave"],
                                                        datasets: [{
                                                        data: [ {{ $dounought->present }}, {{ $dounought->absent }}, {{ $dounought->casual }}, {{ $dounought->sick }} , {{ $dounought->earned }}, {{ $dounought->maternity }}],
                                                        backgroundColor: ["#42b73e", "#f24646", "#4cf4f7", "#f6f94a", "#39393a", "#2091CF"],
                                                        hoverBackgroundColor: ["#42b73e", "#f24646", "#4cf4f7", "#f6f94a", "#39393a", "#2091CF"]
                                                        }]
                                                        },
                                                        options: {
                                                            responsive: true,
                                                            legend: {
                                                                  position: 'right',

                                                            },
                                                            maintainAspectRatio: false
                                                        }
                                                    });
                                                });
                                            //end of donought chart practice
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        
                    </div>
                    
                    <!-- </div> -->
                    <!-- /.row -->
                <!-- </div> -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- PAGE CONTENT ENDS -->
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<script src="{{ asset('assets/js/chartjs.min.js') }}"></script>

@endsection