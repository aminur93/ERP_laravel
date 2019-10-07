<style type="text/css">body { font-family: 'bangla', sans-serif;}</style> 

<?php
    date_default_timezone_set('Asia/Dhaka');
    $en = array('0','1','2','3','4','5','6','7','8','9');
    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');
    $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
?> 

@if(!empty($info) && !empty($other_info->unit_name))

    <div id="html-2-pdfwrapper" class="col-xs-12">
        <div class="col-sm-10" style="margin:20px auto;border:1px solid #ccc">
            <div class="page-header" style="text-align:left;border-bottom:2px double #666">

                <h2 style="margin:4px 10px; font-weight: bold;  text-align: center; color: #FF00FF">{{ !empty($other_info->unit_name)?$other_info->unit_name:null}}</h2>
                <h3 style="margin:4px 10px; text-align: center; color: #FF00FF">উৎসব বোনাস প্রদানের শীট ({{ !empty($other_info->festive_name)?$other_info->festive_name:null }})</h3>
                <h4 style="margin:4px 10px; text-align: center; color: #FF00FF">যোগদানের সর্বশেষ তারিখঃ ({{ !empty($other_info->last_join_date)?str_replace($en,$bn,date('d-m-y', strtotime($other_info->last_join_date))):null }})</h4>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="60%">
                                <h5 style="margin:4px 5px; font-size: 12px; color: #FF00FF"><font style="font-weight: bold; font-size: 12px; ">ফ্লোরঃ </font>{{ !empty($other_info->floor_name)?$other_info->floor_name:null }}</h5>
                                <h5 style="margin:4px 5px; font-size: 12px; color: #FF00FF"><font style="font-weight: bold; font-size: 12px; ">তারিখঃ </font><?php echo str_replace($en, $bn, date('d-m-Y')) ?></h5>
                                <h5 style="margin:4px 5px; font-size: 12px; color: #FF00FF"><font style="font-weight: bold; font-size: 12px;">সময়ঃ </font><?php echo str_replace($en, $bn, date('H:i'))?></h5>
                            </td>
                            <td>
                                <h5 style="margin:4px 5px; font-size: 13px; text-align: right; color: #FF00FF"><font style="font-weight: bold;">{{ !empty($other_info->department_name)?$other_info->department_name:null }}</font></h5>
                                <h5 style="margin:4px 5px; font-size: 10px; text-align: right; color: #FF00FF"><font style="font-weight: bold;">পাতা নং #</font></h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
                <table class="table" style="width:100%;border:1px solid #ccc; font-size:12px; color: #2A86FF"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                    <thead>
                        <tr style="color: #2A86FF">
                            <th>ক্রমিক নং</th>
                            <th>কর্মী/কর্মচারীদের নাম যোগদানের তারিখ</th>
                            <th>আই.ডি নং</th>
                            <th>মাসিক বেতন/মজুরী</th>
                            <th>সর্বমোট দেয় টাকার পরিমাণ</th>
                            <th>দস্তখত</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach($info AS $emp)
                        <tr >
                            <td width="5%">
                                {{ !empty($emp->sl)?(str_replace($en, $bn, $emp->sl)):null }}
                            </td>
                            <td>
                                <p style="margin: 0px; padding: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font>{{ !empty($emp->hr_bn_associate_name)?$emp->hr_bn_associate_name:null }}</font></p>

                                <p style="margin: 0px; padding: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ !empty($emp->as_doj)?(str_replace($en, $bn, date('d-m-Y', strtotime($emp->as_doj)))):null }}
                                </p>

                                <p style="margin: 0px; padding: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp(<?php echo str_replace($en, $bn, floor($emp->jobDuration/12))  ?> বৎসর <?php echo str_replace($en, $bn, ($emp->jobDuration%12))  ?> মাস)</p>

                                <p style="margin: 0px; padding: 0px;">{{ !empty($emp->status)?$emp->status:null }}&nbsp;&nbsp;&nbsp;&nbsp;<font>{{ !empty($emp->hr_designation_name_bn)?$emp->hr_designation_name_bn:null }}</font></p>
                            </td>

                            <td>
                                <?php $temp_bn= str_replace($en, $bn, $emp->temp_id)  ?>
                                {!! !empty($emp->associate_id)?(substr_replace($emp->associate_id, "<big style='font-size:16px; font-weight:bold;'>$temp_bn</big>", 3, 6)):null !!}
                            </td>

                            <td>
                                <p style="margin: 0px; padding: 0px;">{{ !empty($emp->salary)?(str_replace($en,$bn,$emp->salary)):null }}</p>
                                <p style="margin: 0px; padding: 0px;">মূল বেতনঃ {{ !empty($emp->basic)?(str_replace($en, $bn, $emp->basic)):null }}</p>
                                <p style="margin: 0px; padding: 0px; font-size: 8px;">স্ট্যাম্পের টাকা কাটাঃ ১০</p>
                            </td>
                            <td>
                                <p style="margin: 0px; padding: 0px; font-size: 20px; font-weight: bold;">{{ !empty($emp->bonus)?(str_replace($en,$bn,($emp->bonus-10))):null }}</p>
                                <p style="margin: 0px; padding: 0px;">{{ !empty($emp->jobDurationRatio)?(str_replace($en,$bn,($emp->jobDurationRatio))):"-" }}</p>
                                <p style="margin: 0px; padding: 0px; font-size: 12px; font-weight: bold;">{{ !empty($emp->bonus)?(str_replace($en,$bn,($emp->bonus))):null }}</p>
                            </td>
                            <td width="10%"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endif 