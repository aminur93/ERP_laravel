<style type="text/css">
body { font-family: 'bangla', sans-serif;}
</style>
<div class="col-xs-12" style="font-size: 12px;">
    <div class="tinyMceLetter">
        <?php
        date_default_timezone_set('Asia/Dhaka');
        $en = array('0','1','2','3','4','5','6','7','8','9');
        $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');
        $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
        ?>
        <h3 style="text-align:center"><b style="font-size: 24px;">{{ $info->hr_unit_name_bn }}</b></h3>
        <p style="text-align:center">{{ $info->hr_unit_address_bn }}</p>
        <h3 style="text-align:center"><u style="font-weight: bold;" >নিরাপত্তা বিষয়ক তথ্য যাচাই ফরম</u></h3>
        <h4 style="text-align:center"><u style="" >(Background Verification Form)</u></h4>
        <p style="font-size: 12px; font-weight: bold;">ক.  ব্যক্তিগত তথ্য (Personal Information):</p>
        <p> <font style="width:14%;display:inline-block">১. কর্মীর আই.ডি</font><font style="width:12%;border-bottom:1px dotted #999; display:inline-block">:&nbsp; {{ (!empty($info->associate_id)?$info->associate_id:null) }}
            </font>পদবীঃ<font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->hr_designation_name_bn)?$info->hr_designation_name_bn:null) }}
            </font>সেকশনঃ<font style="width:14%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->hr_section_name_bn)?$info->hr_section_name_bn:null) }}
            </font>যোগদানের তারিখঃ<font style="width:11%;border-bottom:1px dotted #999; display:inline-block">&nbsp;{{ (!empty($info->as_doj)?str_replace($en,$bn, date("d-m-Y", strtotime($info->as_doj))):null) }}
            </font>
        </p>
        <p> <font style="width:20%;display:inline-block">১. পূর্ণ নাম (বাংলায়)</font><font style="width:80%;border-bottom:1px dotted #999; display:inline-block">:&nbsp; {{ (!empty($info->hr_bn_associate_name)?$info->hr_bn_associate_name:null) }}
            </font>
        </p>
        <p> <font style="width:20%;display:inline-block">১. পূর্ণ নাম (ইংরেজীতে)</font><font style="width:80%;border-bottom:1px dotted #999; display:inline-block">:&nbsp;{{ (!empty($info->as_name)?$info->as_name:null) }}
            </font>
        </p>
        <p>
            <font style="width:14%;display:inline-block">১. স্বামী/পিতার নাম
            </font>
            <font style="width:36%;border-bottom:1px dotted #999; display:inline-block">:&nbsp;{{ (!empty($info->hr_bn_father_name)?$info->hr_bn_father_name:null) }}/{{ (!empty($info->hr_bn_spouse_name)?$info->hr_bn_spouse_name:null) }}
            </font>মাতার নাম
            <font style="width:36%;border-bottom:1px dotted #999; display:inline-block">:&nbsp; {{ (!empty($info->hr_bn_mother_name)?$info->hr_bn_mother_name:null) }}
            </font>
        </p>

        <p>
            <font style="width:14%;display:inline-block">৭ । স্থায়ী ঠিকানাঃ
            </font>বাড়ীর নামঃ 
            <font style="width:20%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>গ্রামঃ 
            <font style="width:20%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->emp_adv_info_per_vill)?$info->emp_adv_info_per_vill:null) }}
            </font>ডাকঘরঃ 
            <font style="width:20%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->emp_adv_info_per_po)?$info->emp_adv_info_per_po:null) }}
            </font>
        </p>
        <p> 
            <font style="width:14%;display:inline-block">&nbsp;</font>
            থানাঃ<font style="width:38%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->permanent_upazilla_bn)?$info->permanent_upazilla_bn:null) }}
            </font>
            জেলাঃ<font style="width:37%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->permanent_district_bn)?$info->permanent_district_bn:null) }}
            </font>
        </p> 

        <p>
            <font style="width:14%;display:inline-block">৭ । বর্ত্মান ঠিকানাঃ
            </font>জমিদারের নামঃ
            <font style="width:20%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>বাসা নং
            <font style="width:20%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->emp_adv_info_pres_house_no)?$info->emp_adv_info_pres_house_no:null) }}
            </font>রাস্তা নং
            <font style="width:20%;border-bottom:1px dotted #999; display:inline-block">&nbsp; 
            </font> 
        </p>
        <p> 
            <font style="width:14%;display:inline-block">&nbsp;</font>
            ওয়ার্ড<font style="width:15%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
            ডাকঘরঃ<font style="width:15%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->emp_adv_info_pres_po)?$info->emp_adv_info_pres_po:null) }}
            </font>
            থানাঃ<font style="width:15%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->present_upazilla_bn)?$info->present_upazilla_bn:null) }}
            </font>
            জেলাঃ<font style="width:15%;border-bottom:1px dotted #999; display:inline-block">&nbsp; {{ (!empty($info->present_district_bn)?$info->present_district_bn:null) }}
            </font>
        </p> 

        <p> <font style="width:50%;display:inline-block">জাতীয় পরিচিতি নাম্বার <font style="font-size: 8px;">(কোনো ঠিকানা পরিবর্তিত হলে কর্তৃপক্ষকে জানাতে হবে)</font></font><font style="width:50%;border-bottom:1px dotted #999; display:inline-block">:&nbsp; {{ (!empty($info->emp_adv_info_nid)?$info->emp_adv_info_nid:null) }}
            </font>
        </p>

        <p style="font-size: 12px; font-weight: bold">খ. দুজন পরিচিত ব্যক্তির তথ্য(Information of Two Referoes):</p> 
        <p>১. ব্যক্তির নামঃ<font style="width:80%;border-bottom:1px dotted #999; display:inline-block">:&nbsp;
            </font></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;ঠিকানাঃ<font style="width:80%;border-bottom:1px dotted #999; display:inline-block">:&nbsp;
            </font></p>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;ফোন নাম্বারঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>সম্পর্কঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>মন্তব্যঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
            <font style="width:65%;border-bottom:1px dotted #999; display:inline-block">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </font>স্বাক্ষরঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>
        <p>২. ব্যক্তির নামঃ<font style="width:80%;border-bottom:1px dotted #999; display:inline-block">:&nbsp;
            </font></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;ঠিকানাঃ<font style="width:80%;border-bottom:1px dotted #999; display:inline-block">:&nbsp;
            </font></p>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;ফোন নাম্বারঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>সম্পর্কঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>মন্তব্যঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
            <font style="width:65%;border-bottom:1px dotted #999; display:inline-block">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </font>স্বাক্ষরঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>

        <p> <font style="width:70%;display:inline-block; font-weight: bold;">গ. পূর্বের চাকূরী সম্পর্কীত তথ্য(যদি থাকে)<font style="font-size: 8px;">(Information of Previous Employement):</font></font>
        </p>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;প্রতিষ্ঠানের নামঃ
            <font style="width:80%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;ঠিকানাঃ
            <font style="width:80%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;পদবীঃ
            <font style="width:25%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>চাকুরীতে যোগদান এবং ছাড়ার তারিখ
            <font style="width:35%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;সংশ্লিষ্ট প্রতিষ্ঠানের একজন পরিচিত ব্যক্তির নামঃ
            <font style="width:60%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>
        <p style="font-size: 12px; font-weight: bold;">ঘ. তথ্য যাচাইকারী (Information Verifier):</p>
        <p>১. ব্যক্তির নামঃ
            <font style="width:38%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>স্বাক্ষরঃ
            <font style="width:40%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;পদবীঃ
            <font style="width:42%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>তারিখঃ
            <font style="width:40%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>
        <p>২. ব্যক্তির নামঃ
            <font style="width:38%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>স্বাক্ষরঃ
            <font style="width:40%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;পদবীঃ
            <font style="width:42%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>তারিখঃ
            <font style="width:40%;border-bottom:1px dotted #999; display:inline-block">&nbsp;
            </font>
        </p>
        <p><font style="font-weight: bold;">যাচাইকারী অফিসারের মন্তব্যঃ </font>উপরোক্ত কর্মীর আবেদন পত্রে প্রদত্ত তথ্য সমূহ, রেফারেন্স হিসাবে উল্লেখিত ব্যক্তিদ্বয়ের মাধ্যমে যথাযথ ভাবে যাচাই করিয়া তথ্যের সত্যতা পাওয়া গিয়েছে/ পাওয়া যায় নাই।</p>
    </div>
</div>

