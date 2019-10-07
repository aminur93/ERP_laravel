<style type="text/css">body { font-family: 'bangla', sans-serif;}</style> 

@if(!empty(Request::get('associate_id')) && !empty(Request::get('pdf')))
<div>
    <?php
    date_default_timezone_set('Asia/Dhaka');
    $en = array('0','1','2','3','4','5','6','7','8','9');
    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');
    $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
    ?>
    <p>
    <h2 style="text-align:center;">চাকুরীর আবেদনপত্র </h2>
    <h4 style="text-align:center;"><u>JOB APPLICATION </u> </h4></p>
    <p>বরাবর,</p>
    <p>ব্যবস্থাপনা পরিচালক</p>
    <p>{{ (!empty($info->hr_unit_name_bn )?$info->hr_unit_name_bn:null) }}</p>
    <p>{{ (!empty($info->hr_unit_address_bn)?$info->hr_unit_address_bn:null) }}</p>
    <p><u> <b>বিষয়ঃ {{ $info->hr_designation_name_bn }} পদে চাকুরীর জন্য আবেদন</b></u></p>
    <p><u> <b> Sub: Application for the post of {{ (!empty($info->hr_designation_name_bn )?$info->hr_designation_name_bn:null) }}</b></u></p>
    <table style="border: none;font-size:14px;margin-left:0" width="100%" cellpadding="3">
        <tr>
            <td width="290px" style="border: none;">নামঃ (Name)</td>
            <td style="border: none; border-bottom: 1px dotted">:{{ (!empty($info->hr_bn_associate_name )?$info->hr_bn_associate_name:null) }}</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">পিতা/মাতার নামঃ (Name of Father/Mother)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{ (!empty($info->hr_bn_father_name )?$info->hr_bn_father_name:null) }} / {{ (!empty($info->hr_bn_mother_name )?$info->hr_bn_mother_name:null) }}</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">স্বামী/স্ত্রীর নামঃ (Name of Husband/Wife)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{ (!empty($info->hr_bn_spouse_name )?$info->hr_bn_spouse_name:null) }}</td>
        </tr>
        <tr>
            <tr>
                <td width="290px" style="border: none;" rowspan="2">স্থায়ী ঠিকানাঃ (Permanent Address)</td>
                <td style="border: none;">গ্রাম(Village): {{ (!empty($info->emp_adv_info_per_vill )?$info->emp_adv_info_per_vill:null) }}
                </td>
                <td style="border: none;">পোস্ট(P.O): {{ (!empty($info->emp_adv_info_per_po )?$info->emp_adv_info_per_po:null) }}
                </td>
            </tr>
            <tr>
                <td style="border: none;">থানা(P.S): {{ (!empty($info->permanent_upazilla_bn )?$info->permanent_upazilla_bn:null) }}
                </td>
                <td style="border: none;">জেলা(Dist.): {{ (!empty($info->permanent_district_bn )?$info->permanent_district_bn:null) }}
                </td>
            </tr>
        </tr>
        <tr >
            <tr>
                <td width="290px" style="border: none;" rowspan="2">বর্তমান ঠিকানাঃ (Permanent Address)</td>
                <td style="border: none;">গ্রাম(Village): {{ (!empty($info->emp_adv_info_pres_house_no )?$info->emp_adv_info_pres_house_no:null) }} {{ (!empty($info->emp_adv_info_pres_road )?$info->emp_adv_info_pres_road:null) }}
                </td>
                <td style="border: none;">পোস্ট(P.O): {{ (!empty($info->emp_adv_info_pres_po )?$info->emp_adv_info_pres_po:null) }}
                </td>
            </tr>
            <tr>
                <td style="border: none;">থানা(P.S): {{ (!empty($info->present_upazilla_bn )?$info->present_upazilla_bn:null) }}
                </td>
                <td style="border: none;">জেলা(Dist.): {{ (!empty($info->present_district_bn )?$info->present_district_bn:null) }}
                </td>
            </tr>
        </tr>
        <tr>
            <td width="290px" style="border: none;">শিক্ষাগত যোগ্যতাঃ (Edu. Qualification)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{$info->education_degree_title}}</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">জন্ম তারিখ/বয়সঃ (Date of Birth/ Age)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{ (!empty($info->as_dob )?$info->as_dob:null) }}</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">ধর্মঃ (Religion)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{ (!empty($info->emp_adv_info_religion )?$info->emp_adv_info_religion:null) }}</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">জাতীয়তাঃ (Nationality)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{ (!empty($info->emp_adv_info_nationality )?$info->emp_adv_info_nationality:null) }}</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">অভিজ্ঞতাঃ (Experience)</td>
            <td style="border: none; border-bottom: 1px dotted">: {{ (!empty($info->emp_adv_info_work_exp )?$info->emp_adv_info_work_exp:"0") }} Year(s)</td>
        </tr>
        <tr>
            <td width="290px" style="border: none;">সুপারিশকারীর নাম ও পরিচিতি/ঠিকানাঃ (Name and Address of recommender)</td>
            <td style="border: none; border-bottom: 1px dotted">: </td>
        </tr>
        <tr>
            <td style="border: none;" colspan="2"><p>অতএব, অনুগ্রহ করে আমাকে উক্ত পদে নিয়োগ দান করিয়া বাধিত করিবেন।</p>
                <p>
                    May I, therefore pray and hope that you would be kind enough to appoint me for the above post.
                </p>
            </td>
        </tr>
        <tr>
            <td style="border: none;" width="290px">
                আপনার বিশ্বস্ত
            </td>
        </tr>
        <tr>
            <td style="border: none;" width="290px" >
                Your Faithfully,
            </td>
        </tr>
        <tr>
            <td style="border: none;" width="290px">
              তারিখ
            </td>
            <td style="border: none;">
                :
            </td>
        </tr>
    </table>
    <table style="border: 1px solid" width="100%" cellpadding="3" width="100%">
        <tr style="width: 100%">
            <td style="border: none; text-align: right;" colspan= "2">
                (অফিস কর্তৃক পূরণীয় For office use only)
            </td>
        </tr>
        <tr style="width: 100%">
            <td style="border: none;">
                ১ লাইন নং (Dept) :
            </td>
            <td style="border: none;">
                ৪. নিয়োগের তারিখ (Date of App) : {{$info->as_doj}}
            </td>
        </tr>
        <tr style="width: 100%">
            <td style="border: none;">
                ২. পুর্ণ নাম (Full Name) :
            </td>
            <td style="border: none;">
                ৫. নির্ধারিত বেতন (Negotiated Salary) :
            </td>
        </tr>
        <tr style="width: 100%">
            <td style="border: none;">
                ৩. কার্ড নং (Card Number) : {{$info->associate_id}}
            </td>
        </tr>
        <tr style="width: 100%">
            <td style="border: none;"><br></td>
            <td style="border: none;"><br></td>
        </tr>
        
    </table>
    <table style="border: 1px solid" width="100%" cellpadding="3" width="100%">
        
        <tr style="width: 100%">
            <td style="border: 1px solid; text-align: center;">
                উতপাদন ব্যবস্থাপক
                Production Manager 
            </td>
            <td style="border: 1px solid; text-align: center;">
                প্রশাসনিক কর্মকর্তা
                Manager HR/ Asst. Manager HR
            </td>
            <td style="border: 1px solid; text-align: center;">
                জি.এম/ম্যানেজার/এ.জি.এম
                G.M/Manager/A.G.M 
            </td>
        </tr>
    </table>
</div>
@endif 