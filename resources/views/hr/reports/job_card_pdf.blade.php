<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
<div class="row"> 
    <div class="col-xs-12" id="PrintArea">
        <!-- PAGE CONTENT BEGINS -->
    <?php
    if (!empty(request()->associate)
    && !empty(request()->month)
    && !empty(request()->year)
    ) {

    $total_attend   = 0;
    $total_overtime = 0;
    $associate = request()->associate; 
    $month = date("m", strtotime(request()->month));
    $year  = request()->year;
    #------------------------------------------------------
    // ASSOCIATE INFORMATION
    $fetchUser = DB::table("hr_as_basic_info AS b")
        ->select(
          "b.associate_id AS associate",
          "b.as_name AS name",
          "b.as_doj AS doj",
          "u.hr_unit_id AS unit_id",
          "u.hr_unit_name AS unit",
          "s.hr_section_name AS section",
          "d.hr_designation_name AS designation"
        )
        ->leftJoin("hr_unit AS u", "u.hr_unit_id", "=", "b.as_unit_id")
        ->leftJoin("hr_section AS s", "s.hr_section_id", "=", "b.as_section_id")
        ->leftJoin("hr_designation AS d", "d.hr_designation_id", "=", "b.as_designation_id")
        ->where("b.associate_id", "=", $associate);

    if ($fetchUser->exists())
    {
        $info = $fetchUser->first();
    ?>

    <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
        <div class="page-header" style="border-bottom:2px double #666">
            <h2 style="margin:4px 10px">{{ $info->unit }}</h2>
            <h5 style="margin:4px 10px">For the month of {{ request()->month }} - {{ request()->year }}</h5>
        </div>
        <table class="table" style="width:100%;border:1px solid #ccc;margin-bottom:0;font-size:14px;text-align:left"  cellpadding="5">
            <tr>
                <th style="width:50%">
                   <p style="margin:0;padding:4px 10px"><strong>ID </strong> # {{ $info->associate }}</p>
                   <p style="margin:0;padding:4px 10px"><strong>Name </strong>: {{ $info->name }}</p>
                   <p style="margin:0;padding:4px 10px"><strong>DOJ </strong>: {{ date("d-m-Y", strtotime($info->doj)) }}</p> 
                </th>
                <th>
                   <p style="margin:0;padding:4px 10px"><strong>Section </strong>: {{ $info->section }} </p> 
                   <p style="margin:0;padding:4px 10px"><strong>Designation </strong>: {{ $info->designation }} </p> 
                </th>
            </tr> 
        </table>

        <table class="table" style="width:100%;border:1px solid #ccc;font-size:13px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Present Status</th>
                    <th>In Time</th>
                    <th>Out Time</th>
                    <th>OT Hour</th>
                </tr> 
            </thead>

        <?php
            $date= ($year."-".$month."-"."01");
            $startDay= date('Y-m-d', strtotime($date));
            $endDay= date('Y-m-t', strtotime($date));
            $toDay= date('Y-m-d');
            //If end date is after current date then end day will be today

            if($endDay>$toDay) $endDay= $toDay;
            $totalDays= (date('d', strtotime($endDay))-date('d', strtotime($startDay)));
            //total attends and total overtime 
            $total_ot_minutes=0;
            $total_attends= 0;
            for($i=0; $i<=$totalDays; $i++) {
                $data= Attendance2::track($info->associate, $startDay, $startDay);
                $total_ot_minutes+= $data->overtime_minutes;

                 ?>
                 <tbody> 
                <tr>
                  <td>{{ $startDay }}</td>
                  <td>
                    <?php 
                    if($data->holidays>=0){
                        if($data->holidays==1) {
                            echo "Weekend(General)";
                            $total_attends++;
                        }
                        else if($data->holidays==2){
                            echo "Weekend(OT)";
                            $total_attends++;
                        }
                        else if($data->holidays==0) echo "Weekend";
                    }
                    else{
                        if($data->attends){
                            echo "P";
                            $total_attends++;
                        }
                        else {
                            echo "A";
                        }
                    }
                    ?>  
                  </td>
                  <td>{{!empty($data->in_time)?$data->in_time:null}}</td>
                  <td>{{!empty($data->out_time)?$data->out_time:null}}</td>
                  <td>{{ $data->overtime_time }}</td>
                </tr> 
              </tbody>
                
              <?php
               $startDay= date("Y-m-d", strtotime("$startDay +1 day"));
            }
            // dd($total);
        ?>

        <tfoot style="border-top:2px double #999">
                <tr>
                    <th style="text-align:right">Attend</th>
                    <th>{{ $total_attends }}</th>
                    <th></th>
                    <th style="text-align:right">Total</th>
                    <th>{{ floor($total_ot_minutes/60) }}:{{ (($total_ot_minutes%60)>0)? ($total_ot_minutes%60):"00"}}</th>
                </tr>
        </tfoot>
        <?php 
        }

        }
        ?>
        </table>
        </div> 
    <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div> 