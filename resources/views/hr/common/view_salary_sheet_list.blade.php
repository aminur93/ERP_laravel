<div class="panel panel-info">
    <div class="panel-heading">{{ $title }}</div>
    <div class="panel-body">
        
        <table class="table" style="width:100%;border-bottom:1px solid #ccc;margin-bottom:0;font-size:12px;color:lightseagreen;text-align:left" cellpadding="5">
            <tr>
                <td style="width:14%">
                    <p style="margin:0;padding:4px 0"><strong>তারিখঃ </strong>
                        {{ $pageHead['current_date'] }}
                    </p>
                    <p style="margin:0;padding:4px 0"><strong>&nbsp;সময়ঃ </strong>
                        {{ $pageHead['current_time'] }}
                    </p>
                </td>
                <td style="width:15%;font-size:10px">
                    @if($pageHead['pay_date'] != null)
                    <p style="margin:0;padding:4px 0"><strong>&nbsp;প্রদান তারিখঃ </strong>
                        {{ $pageHead['pay_date'] }} ইং 
                    </p>
                    @endif
                </td>
                <td>
                    <h3 style="margin:4px 10px;text-align:center;font-weight:600;font-size:18px;">
                        {{ $pageHead['unit_name'] }}
                    </h3>
                    <h5 style="margin:4px 10px;text-align:center;font-weight:600;font-size:14px;">বেতন/মজুরি এবং অতিরিক্ত সময়ের মজুরীঃ 
            <br/>
            তারিখঃ {{ $pageHead['for_date'] }}</h5>
                </td>
                <td style="width:22%">
                    @if($pageHead['floor_name'] != null)
                    <p style="margin:0;padding:4px 0;">
                        <strong>ফ্লোর নংঃ
                            {{ $pageHead['floor_name'] }}
                        </strong>
                    </p>
                    @endif
                </td>
                
            </tr>
        </table>
        
        <table class="table" style="width:100%;border:1px solid #ccc;font-size:9px;color:lightseagreen" cellpadding="2" cellspacing="0" border="1" align="center">
            <thead>
                <tr style="color:hotpink">
                    <th style="color:lightseagreen">ক্রমিক নং</th>
                    <th width="180">কর্মী/কর্মচারীদের নাম
                        <br/> ও যোগদানের তারিখ</th>
                    <th>আই ডি নং</th>
                    <th>মাসিক বেতন/মজুরি</th>
                    <th width="140">হাজিরা দিবস</th>
                    <th width="220">বেতন হইতে কর্তন </th>
                    <th width="250">মোট দেয় টাকার পরিমান</th>
                    <th>সর্বমোট টাকার পরিমান</th>
                    <th width="80">দস্তখত</th>
                </tr>
            </thead>
            <tbody>
                @if(count($getSalaryList) == 0)
                <tr>
                    <td colspan='9'> <b><h5 class="text-center"> No data found !</h5></b></td>  
                </tr>
                @endif
                @php $i = 0; @endphp
                @foreach($getSalaryList as $list)

                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        <p style="margin:0;padding:0;">{{ $list->employee_bengali['hr_bn_associate_name'] }}</p>
                        <p style="margin:0;padding:0;">{{ $list->employee['as_doj'] }}</p>
                        <p style="margin:0;padding:0;">{{ $list->employee->designation['hr_designation_name_bn'] }}</p>
                        <p style="margin:0;padding:0;color:hotpink">মূল+বাড়ি ভাড়া+চিকিৎসা+যাতায়াত+খাদ্য </p>
                        <p style="margin:0;padding:0;">
                            {{ $list['basic'].'+'.$list['house'].'+'.$list['medical'].'+'.$list['transport'].'+'.$list['food'] }}
                        </p>
                    </td>
                    <td>
                        <p style="font-size:14px;margin:0;padding:0;color:blueviolet">
                            {{ $list['as_id'] }}
                        </p>
                        <p style="margin:0;padding:0;color:hotpink">
                            বিলম্ব উপস্থিতিঃ {{ $list['late_count'] }}
                        </p>
                        <p style="margin:0;padding:0">গ্রেডঃ {{ $list->employee->designation['hr_designation_grade'] }}</p>
                    </td>
                    <td>
                        <p style="margin:0;padding:0">
                            {{ $list['gross'] }}
                        </p>
                    </td>
                    <td>
                        <p style="margin:0;padding:0">
                            উপস্থিত দিবস &nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['present'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            সরকারি ছুটি &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['holiday'] }}</font>
                        </p>
                        <p style="margin:0;padding:0k">
                            অনুপস্থিত দিবস &nbsp;<font style="color:hotpink">= {{ $list['absent'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            ছুটি মঞ্জুর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['leave'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            মোট দেয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ ($list['present'] + $list['holiday'] + $list['leave']) }}</font>
                        </p>
                    </td>
                    <td>
                        <p style="margin:0;padding:0">
                            অনুপস্থিতির জন্য &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['absent_deduct'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            অর্ধ দিবসের জন্য কর্তন &nbsp;&nbsp;<font style="color:hotpink">= {{ $list['half_day_deduct'] }}
                            </font>
                        </p>
                        <p style="margin:0;padding:0">
                            অগ্রিম গ্রহণ বাবদ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ ($list->add_deduct == null) ? '0.00' : $list->add_deduct['advp_deduct'] }} </font>
                        </p>
                        <p style="margin:0;padding:0">
                            স্ট্যাম্প বাবদ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= 10.00</font>
                        </p>
                        <p style="margin:0;padding:0">
                            ভোগ্যপণ্য ক্রয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ ($list->add_deduct == null) ? '0.00' : $list->add_deduct['cg_product'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            খাবার বাবদ কর্তন &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ ($list->add_deduct == null) ? '0.00' : $list->add_deduct['food_deduct'] }} </font>
                        </p>
                        <p style="margin:0;padding:0">
                            অন্যান্য &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ ($list->add_deduct == null) ? '0.00' : $list->add_deduct['others_deduct'] }} </font>
                        </p>
                    </td>
                    <td>
                        <p style="margin:0;padding:0">
                            বেতন/মঞ্জুরি &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['salary_payable'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            অতিরিক্ত সময়ের কাজের মঞ্জুরি <font style="color:hotpink">= {{ ($list['ot_rate'] * $list['ot_hour']) }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            অতিরিক্ত কাজের মঞ্জুরি হার &nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['ot_rate'] }} ({{ $list['ot_hour'] }} ঘন্টা)</font>
                        </p>
                        <p style="margin:0;padding:0">
                            উপস্থিত বোনাস &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ $list['attendance_bonus'] }}</font>
                        </p>
                        <p style="margin:0;padding:0">
                            বেতন/মঞ্জুরি অগ্রিম/সমন্বয় &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:hotpink">= {{ ($list->add_deduct == null) ? '0.00' : $list->add_deduct['salary_add'] }}</font>
                        </p>
                    </td>
                    <td>
                        @php
                        $ot = ($list['ot_rate'] * $list['ot_hour']);
                        $salaryAdd = ($list->add_deduct == null) ? '0.00' : $list->add_deduct['salary_add'];
                        $total = ($list['salary_payable'] + $ot + $list['attendance_bonus'] + $salaryAdd);
                        @endphp
                        {{ $total }}
                    </td>
                    <td></td>
                </tr>
              @endforeach
            </tbody>

        </table>
    </div>
</div>