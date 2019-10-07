<style type="text/css">body { font-family: 'bangla', sans-serif;}</style> 
 
@if(!empty(Request::get('associate'))) 
<div style="font-size:13px">
    <?php
    date_default_timezone_set('Asia/Dhaka');
    $en = array('0','1','2','3','4','5','6','7','8','9', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
    $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
    ?>
    <h1 style="text-align:center;margin:0 0 0 0">নমিনী মনোনয়ন</h1>
    <h2 style="text-align:center;margin:0 0 10px 0">ফরম-৪১</h2>
    <p style="text-align:center;margin:0 0 0 0">[ধারা ১৯, ১৩১(১)(ক), ১৫৫(২), ২৩৪, ২৪৬, ২৬৫ ও ২৭৩ এবং বিধি ১১৮(১), ১৩৬, ২৩২(২), ২৬২(১), ২৮৯(১) ও ৩২১(১) দ্রষ্টব্য] <br/>জমা ও বিভিন্নখাতে প্রাপ্য অর্থ পরিশোধের ঘোষণা ও মনোনয়ন ফরম </p>
    <p>১ । কারখানা/প্রতিষ্ঠানের নামঃ&nbsp;{{ (!empty($info->hr_unit_name_bn)?$info->hr_unit_name_bn:null) }}</p>
    <p>২ । কারখানা/প্রতিষ্ঠানের ঠিকানাঃ&nbsp;{{ (!empty($info->hr_unit_address_bn)?$info->hr_unit_address_bn:null) }}</p>
    <p>
        <font style="width:250px">৩ । শ্রমিকের নাম ও ঠিকানাঃ</font>&nbsp;
        <font style="width:80%;border-bottom:1px dotted #999; display:inline-block">
            {{ (!empty($info->hr_bn_associate_name)?$info->hr_bn_associate_name:null) }} 
            ({{ (!empty($info->hr_bn_present_road)?"রোড নং-".$info->hr_bn_present_road:null) }},
            {{ (!empty($info->hr_bn_present_house)?"বাড়ি নং-".$info->hr_bn_present_house:null) }},
            {{ (!empty($info->hr_bn_present_po)?"ডাকঘর-".$info->hr_bn_present_po:null) }},
            {{ (!empty($info->present_upazilla_bn)?"উপজেলা-".$info->present_upazilla_bn:null) }},
            {{ (!empty($info->present_district_bn)?"জেলা-".$info->present_district_bn:null) }} )
        </font>
    </p>
    <p>
        <font style="width:60%;border-bottom:1px dotted #999; display:inline-block">&nbsp;</font>লিঙ্গঃ<font style="width:34%;border-bottom:1px dotted #999; display:inline-block">&nbsp;{{ ((!empty($info->as_gender) && $info->as_gender=="Male")?"পুরুষ":"মহিলা") }}
        </font>
    </p>
    <p>
        <font style="width:250px">
        ৪ । পিতা/মাতা/{{ ((!empty($info->as_gender) && $info->as_gender=="Male")?"স্ত্রী":"স্বামী") }}  নামঃ 
        </font>
        &nbsp;
        <font style="width:81%;border-bottom:1px dotted #999; display:inline-block">{{ (!empty($info->hr_bn_father_name)?$info->hr_bn_father_name:null) }}/{{ (!empty($info->hr_bn_mother_name)?$info->hr_bn_mother_name:null) }}/{{ (!empty($info->hr_bn_spouse_name)?$info->hr_bn_spouse_name:null) }}
        </font>
    </p>
    <p>
        <font style="width:250px">
        ৫ । জন্ম তারিখঃ</font>&nbsp;
        তারিখঃ&nbsp;
        <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">
            {{ (!empty($info->as_dob)?str_replace($en,$bn, date("d", strtotime($info->as_dob))):null) }}&nbsp;
        </font>
        মাসঃ&nbsp;
        <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">
            {{ (!empty($info->as_dob)?str_replace($en,$bn, date("F", strtotime($info->as_dob))):null) }}&nbsp;
        </font>
        বছরঃ&nbsp;
        <font style="width:23%;border-bottom:1px dotted #999; display:inline-block">
            {{ (!empty($info->as_dob)?str_replace($en,$bn, date("Y", strtotime($info->as_dob))):null) }}&nbsp;
        </font>
    </p>
    <p>
        <font style="width:19%;display:inline-block">৬ । সনাক্তকরণ চিন্হ (যদি থাকে)</font>
        <font style="width:76%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
        </font>
    </p>
    <p> 
        <font style="width:14%;display:inline-block">৭ । স্থায়ী ঠিকানাঃ</font>
        গ্রামঃ<font style="width:38%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            {{ (!empty($info->hr_bn_permanent_village)?$info->hr_bn_permanent_village:null) }}
        </font>
        ডাকঘরঃ<font style="width:36%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            {{ (!empty($info->hr_bn_permanent_po)?$info->hr_bn_permanent_po:null) }}
        </font>
    </p>
    <p> 
        <font style="width:14%;display:inline-block">&nbsp;</font>
        থানাঃ<font style="width:38%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            {{ (!empty($info->permanent_upazilla_bn)?$info->permanent_upazilla_bn:null) }}
        </font>
        জেলাঃ<font style="width:37%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            {{ (!empty($info->permanent_district_bn)?$info->permanent_district_bn:null) }}
        </font>
    </p> 
    <p>
        <font style="width:18%;display:inline-block">৮ । চাকরিতে নিযুক্তির তারিখঃ</font>
        <font style="width:77%;border-bottom:1px dotted #999; display:inline-block">
            {{ (!empty($info->as_doj)?str_replace($en,$bn, date("d-F-Y", strtotime($info->as_doj))):null) }}&nbsp;
        </font>
    </p>
    <p>
        <font style="width:10%;display:inline-block">৯ । পদের নামঃ</font>
        <font style="width:87%;border-bottom:1px dotted #999; display:inline-block">
            {{ (!empty($info->hr_designation_name_bn)?$info->hr_designation_name_bn:null) }}
        </font>
    </p> 

    <p style="margin:20px auto;text-align:justify;">আমি এতদ্বারা ঘোষণা করিতেছি যে, আমার মৃত্যু হইলে বা আমার অবর্তমানে, আমার অনুকূলে জমা ও বিভিন্নখাতে প্রাপ্য টাকা গ্রহণের জন্য আমি নিন্মবর্ণিত ব্যক্তিকে/ব্যক্তিগণকে মনোনয়ন দান করিতেছি এবং নির্দেশ দিচ্ছি যে, উক্ত টাকা নিম্নবর্ণিত পদ্ধতিতে মনোনীত ব্যাক্তিদের মধ্যে বন্টন করিতে হইবেঃ</p>

    <table style="font-size:9px" align="center" width="100%" border="1" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <td width="45%" align="center">
                    মনোনীত ব্যক্তি বা ব্যক্তিদের নাম, ঠিকানা ও ছবি <br/>
                    (নমিনীর ছবি ও স্বাক্ষর শ্রমিক কর্তৃক সত্যায়িত) <br/>
                    এন আই ডি নং  
                </td>
                <td width="15%" align="center">সদস্যদের সহিত মনোনীত ব্যক্তিদের সম্পর্ক</td>
                <td width="10%" align="center">বয়স</td>
                <td width="30%" align="center" colspan="2">প্রত্যেক মনোনীত ব্যক্তিকে দেয় অংশ</td>
            </tr>
            <tr>
                <td align="center">(১)</td>
                <td align="center">(২)</td>
                <td align="center">(৩)</td>
                <td align="center" colspan="2">(৪)</td>
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center" width="15%">জমাখাত</td>
                <td align="center" width="15%">অংশ</td> 
            </tr> 
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center">বকেয়া মজুরি </td>
                <td align="center"></td> 
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center">প্রভিডেন্ট ফান্ড </td>
                <td align="center"></td> 
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center">বীমা</td>
                <td align="center"></td> 
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center">দুর্ঘটনার ক্ষতিপূরণ</td>
                <td align="center"></td> 
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center">লভ্যাংশ</td>
                <td align="center"></td> 
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center">অন্যান্য</td>
                <td align="center"></td> 
            </tr> 
        </thead>
        <tbody>
            <tr></tr>
        </tbody>
    </table>

    <p style="margin:10px auto;text-align:justify;">প্রত্যয়ন করিতেছি যে, আমার উপস্থিতিতে জনাব/জনাবা <font style="width:160px;border-bottom:1px dotted #999; display:inline-block">{{ (!empty($info->hr_bn_associate_name)?$info->hr_bn_associate_name:null) }}&nbsp;</font> লিপিবদ্ধ বিবরণসমূহ পাঠ করিবার পর উক্ত ঘোষণা সাক্ষর করিয়াছেন। </p> 
    <p style="text-align:right;">
        <font style="width:30%;border-bottom:1px dotted #999; display:inline-block">&nbsp;</font><br/>
        <font style="width:30%;display:inline-block;text-align:left">মনোনয়ন প্রদানকারী শ্রমিকের স্বাক্ষর, টিপসই ও তারিখ</font><br/>
        <font style="width:30%;border-bottom:1px dotted #999; display:inline-block">&nbsp;</font>
    </p>

    <p style="text-align:left;">
        <font style="width:30%;border-top:1px dotted #999; display:inline-block;padding-top:10px">তারিখ সহ মনোনীত ব্যক্তিগণের স্বাক্ষর অথবা টিপসই <br/>
        (শ্রমিক কর্তৃক সত্যায়িত ছবি)</font> 
    </p> 

    <p style="text-align:right;">
        <font style="width:30%;border-bottom:1px dotted #999; display:inline-block">&nbsp;</font><br/>
        <font style="width:30%;display:inline-block;text-align:left">মালিকের বা প্রধিকারপ্রাপ্ত কর্মকর্তার স্বাক্ষর ও তারিখ</font><br/>
        <font style="width:30%;border-bottom:1px dotted #999; display:inline-block">&nbsp;</font>
    </p>
</div> 
@endif
 