<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style> 

@if(!empty(Request::get('associate_id')) || !empty(Request::get('unit_id')))
<div id="html-2-pdfwrapper" class="row">
    <div class="col-sm-10" id="PrintArea" style="float: left;">
        <table border="1" cellpadding="4" cellspacing="0" width="100%" style="margin-bottom: 10px;">
            <tr>
                <th style="font-size: 18px; text-align: center;">Salary/Wages Increment Status</th>
            </tr>
        </table>

       <table border="1" cellpadding="4" cellspacing="0" width="100%" style="margin-bottom: 10px; float: left;">
            <tr>
                <td>
                    <div class="col-xs-12">
                    <label class="col-sm-4 control-label no-padding-right">ID No:</label>
                    <span class="col-sm-8">{{ $info->associate_id}}</span>
                </div>
                <div class="col-xs-12">
                    <label class="col-sm-4 control-label no-padding-right">Name:</label>
                    <span class="col-sm-8">{{ $info->as_name}}</span>
                </div>
                <div class="col-xs-12">
                    <label class="col-sm-4 control-label no-padding-right">Joining Designation:</label>
                    <span class="col-sm-8">{{ $info->hr_designation_name}}</span>
                </div>
                </td>
                <td>
                    <div class="col-xs-12">
                    <label class="col-sm-4 control-label no-padding-right">Date of Join:</label>
                    <span class="col-sm-8">{{$info->as_doj}}</span>
                </div>

                <div class="col-xs-12">
                    <label class="col-sm-4 control-label no-padding-right">Section:</label>
                    <span class="col-sm-8">{{$info->hr_section_name}}</span>
                </div>

                <div class="col-xs-12">
                    <label class="col-sm-4 control-label no-padding-right">Present Designation:</label>
                    <span class="col-sm-8">{{$info->hr_designation_name}}</span>
                </div>
                </td>
            </tr>
        </table>
        <table border="1" cellpadding="4" cellspacing="0" width="100%" style="margin-bottom: 30px;">
            <thead>
                <tr>
                    <th colspan="10" style="text-align: center; font-size: 12px;">Salary/wages increment</th>
                    <th colspan="2" style="text-align: center; font-size: 12px;">Designation Changed</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Sl</th>
                    <th>Inc. Amout</th>
                    <th>Reason</th>
                    <th>Eff. Date</th>
                    <th>Gross</th>
                    <th>Basic</th>
                    <th>H.Rent</th>
                    <th>Medical</th>
                    <th>Conv.</th>
                    <th>Food</th>
                    
                    <th>Eff. Date</th>
                    <th>Designation</th>
                </tr>
                
                <?php 
                    for($i=0; $i<$ret; $i++){
                        echo "<tr>
                            <td>".$oVal->sl[$i]."</td>
                            <td>".$oVal->increment_amount[$i]."</td>
                            <td>".$oVal->reason[$i]."</td>
                            <td>".$oVal->incEfDate[$i]."</td>
                            <td>".$oVal->gross[$i]."</td>
                            <td>".$oVal->basic[$i]."</td>
                            <td>".$oVal->house[$i]."</td>
                            <td>".$oVal->medical[$i]."</td>
                            <td>".$oVal->conv[$i]."</td>
                            <td>".$oVal->food[$i]."</td>
                            <td>".$oVal->pomEfDate[$i]."</td>
                            <td>".$oVal->designation[$i]."</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table> 
    </div>
</div>
@endif 