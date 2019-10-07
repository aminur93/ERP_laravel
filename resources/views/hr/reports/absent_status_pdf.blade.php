<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 
@if(!empty(request()->associate_id) && !empty(request()->absent_from) && !empty(request()->absent_to))
<div class="col-xs-12" id="PrintArea">
    <div id="html-2-pdfwrapper" class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
        <div class="page-header" style="text-align:left;border-bottom:2px double #666">
            <h2 style="margin:4px 10px">{{ !empty($report->unit)?$report->unit:null }}</h2>
            <h5 style="margin:4px 10px">From {{ !empty($report->from)?$report->from:null}} To {{ !empty($report->to)?$report->to:null }}</h5>
            <p style="margin:4px 5px; font-size: 10px;">As on {{ !empty($report->print_date)?$report->print_date:null}}</hp>
        </div>
        <table class="table" style="width:100%;border:1px solid #ccc;margin-bottom:0;font-size:14px;text-align:left"  cellpadding="5">
            <tr>
                <th style="width:40%">
                   <p style="margin:0;padding:4px 10px"><strong>ID </strong> # {{ !empty($report->associate_id)?$report->associate_id:null }}</p>
                   <p style="margin:0;padding:4px 10px"><strong>Name </strong>: {{ !empty($report->name)?$report->name:null }}</p>
                </th>
                <th>
                   <p style="margin:0;padding:4px 10px"><strong>Date of Join </strong>: {{ !empty($report->doj)?date("d-F-Y", strtotime($report->doj)):null }} </p> 
                   <p style="margin:0;padding:4px 10px"><strong>Designation </strong>: {{ !empty($report->designation)?$report->designation:null }} </p> 
                </th>
            </tr> 
        </table>

        <table class="table" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
        <thead>
            <tr>
                <th>Month</th>
                <th>Year</th>
                <th>Absent</th>
                <th>Leave</th>
                <th>Late</th>
            </tr> 
        </thead>
        <tbody>
            <?php
                if (!empty($report->month) && is_array($report->month) && sizeof($report->month)>0 ){
                    for($i=0;$i<sizeof($report->month);$i++)
                    {
                        echo "<tr><td>".$report->month[$i]."</td><td>".$report->year[$i]."</td><td>".$report->absent[$i]."</td><td>".$report->leave[$i]."</td><td>".$report->late[$i]."</td></tr>";
                    }
                }
            ?>

        <!-- ends of report -->
        </tbody>
        </table>
    </div>
</div>
@endif 