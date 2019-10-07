<?php 
  $Job_report_link   = url('hr/reports/job_application'); 
  $file_tag_link     = url('hr/reports/file_tag'); 
  $job_card_link     = url('hr/reports/job_card'); 
  $em_report_link    = url('hr/reports/employee_report'); 
  $nominee_link      = url('hr/reports/nominee'); 
  $bg_verify_link    = url('hr/reports/back_verf'); 

  $at_report_link    = url('hr/reports/attendance_report');
  $at_report_2_link  = url('hr/reports/attendance_report_2');
  $unit_report_link  = url('hr/reports/unitattendance');
  $line_report_link  = url('hr/reports/line_wise_att');
  $absent_report_link= url('hr/reports/absent_status');
  $ot_report_link    = url('hr/reports/daily_ot_report');
  $leave_report_link = url('hr/reports/leave_log');
  $worker_report_link= url('hr/reports/worker_register');
  $fixed_salary_link= url('hr/reports/fixedsalarysheet');

  $increment_link           = url('hr/reports/increment_report'); 
  $m_increment_link         = url('hr/reports/monthy_increment'); 
  $bonus_slip_link          = url('hr/reports/bonus_slip'); 
  $salary_sheet_link        = url('hr/reports/salary_sheet'); 
  $pay_slip_link            = url('hr/reports/payslip'); 
  $earn_leave_link          = url('hr/reports/earnleavepayment');
  $extra_ot_link            = url('hr/reports/extraotsheet');
  $manual_attendance_link   = url('hr/reports/manual_attendance');  


?>
<div class="col-sm-12">

  <table class="" style="width:100%;border:none; margin-bottom: 20px;" cellpadding="0" >
      <tr style="border-bottom:none;">
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$Job_report_link}}" <?php if ($type == 'job_application') echo 'checked="checked"'; ?>"  onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Job Application</span>
          </label>
        </td>
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$file_tag_link}}" <?php if ($type == 'file_tag') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  File Tag</span>
        </label> 
        </td>
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$job_card_link}}" <?php if ($type == 'job_card') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Job Card</span>
          </label>
        </td> 
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$em_report_link}}" <?php if ($type == 'employee_report') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">   Employee Report</span>
          </label>
        </td>
        <td>
         <label> <input type="radio" name="attendance" class="ace" value="{{$nominee_link}}" <?php if ($type == 'nominee') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">   Nominee</span>
        </label>
        </td>
        <td colspan="2">
          <label> <input type="radio" name="attendance" class="ace" value="{{$bg_verify_link}}" <?php if ($type == 'bg_verification') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Background Verification</span>
            </label>
        </td>
        <td></td>
      </tr> 
      <tr>
        <td colspan="6"><hr></td>
      </tr>

      <tr>
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$increment_link}}" <?php if ($type == 'increment') echo 'checked="checked"'; ?>"  onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Increment Report</span>
          </label>
        </td>
        <td>
         <label> <input type="radio" name="attendance" class="ace" value="{{$m_increment_link}}" <?php if ($type == 'm_increment') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Monthly Increment</span>
         </label>

        </td>
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$bonus_slip_link}}" <?php if ($type == 'bonus_slip') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Bonus Sheet</span>
         </label>
        </td>
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$salary_sheet_link}}" <?php if ($type == 'salary_sheet') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">   Salary Sheet</span>
          </label>
        </td> 
        <td>
           <label> <input type="radio" name="attendance" class="ace" value="{{$pay_slip_link}}" <?php if ($type == 'pay_slip') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">   Pay Slip</span>
           </label>
        </td>
        <td>
          <label> <input type="radio" name="attendance" class="ace" value="{{$earn_leave_link}}" <?php if ($type == 'earn_leave') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Earned Leave Payment Sheet</span>
            </label>
        </td>

      </tr>
      <tr>
        <td>
          <label> <input type="radio" name="extra_ot" class="ace" value="{{$extra_ot_link}}" <?php if ($type == 'extra_ot') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Extra OT Sheet</span>
            </label>
        </td>
        <td>
          <label> <input type="radio" name="extra_ot" class="ace" value="{{$fixed_salary_link}}" <?php if ($type == 'fixed_salary') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Fixed Salary Sheet</span>
            </label>
        </td>        
      </tr>
      <tr>
        <td colspan="6"><hr></td>
      </tr>
      <tr>
       
        <td style="padding-bottom: 5px;">
         <label> <input type="radio" name="attendance_2" class="ace" value="{{$at_report_2_link}}" <?php if ($type == 'attendance_2') echo 'checked="checked"'; ?>"  onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Attendance Report</span>
       </label>
        </td>
        <td style="padding-bottom: 5px;">
          <label> <input type="radio" name="attendance" class="ace" value="{{$unit_report_link}}" <?php if ($type == 'unit') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Unit Attendance</span>
          </label>
        </td>
        <td style="padding-bottom: 5px;"><label> <input type="radio" name="attendance" class="ace" value="{{$line_report_link}}" <?php if ($type == 'line') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Line Wise Attendance</span>
            </label>
        </td>
        <td style="padding-bottom: 5px;">
          <label> <input type="radio" name="attendance" class="ace" value="{{$absent_report_link}}" <?php if ($type == 'absent') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Absent Status</span>
          </label>
        </td> 
        <td style="padding-bottom: 5px;">
          <label> <input type="radio" name="attendance" class="ace" value="{{$ot_report_link}}" <?php if ($type == 'ot_status') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">   Daily OT Report</span>
          </label>
        </td>
        <td>
        <label> <input type="radio" name="attendance" class="ace" value="{{$leave_report_link}}" <?php if ($type == 'leave_log') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Leave Log</span>
        </label>
        </td>
        </tr>
        <tr>
        <td>
         <label> <input type="radio" name="attendance" class="ace" value="{{$worker_report_link}}" <?php if ($type == 'worker_register') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Worker Register</span>
        </label>
        </td>
        <td colspan="4">
         <label> <input type="radio" name="attendance" class="ace" value="{{$manual_attendance_link}}" <?php if ($type == 'manual_attendance') echo 'checked="checked"'; ?>" onclick="attLocation(this.value)"> <span class="lbl" style="font-size:12px;">  Manual Attendance</span>
        </label>
        </td>

        </tr>

     
</table>


</div>
