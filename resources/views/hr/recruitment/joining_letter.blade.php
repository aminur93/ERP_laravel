@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Human Resource</a>
				</li>
				<li>
					<a href="#">Recruitment</a>
				</li>
				<li>
					<a href="#">Job Portal</a>
				</li>
				<li class="active"> Joining Letter</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Recruitment<small> <i class="ace-icon fa fa-angle-double-right"></i> Job Portal <i class="ace-icon fa fa-angle-double-right"></i> Joining Letter</small></h1>
            </div>

            <div class="row">
                 @include('inc/message')
                <div class="col-xs-12">
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/recruitment/job_portal/joining_letter') }}" enctype="multipart/form-data"> 

                         {{ csrf_field() }} 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_letter_as_id"> Associate's ID<span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_letter_as_id', [Request::get('associate_id') => Request::get('associate_id')], Request::get('associate_id'),['placeholder'=>'Select Associate\'s ID', 'data-validation'=> 'required', 'id'=>'hr_letter_as_id',  'class'=> 'associates no-select col-xs-10 col-sm-5']) }} 
                                 <a id="generate" class="btn btn-primary" href="{{ url('hr/recruitment/job_portal/joining_letter?associate_id=%ASSOCIATE_ID%') }}">Generate</a>
                            </div>
                        </div>

                        @if(!empty(Request::get('associate_id')))
                        <div class="form-group">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-8" id="printable">
                            <!-- <div class="text-center">
                                <i class="fa fa-spinner fa-pulse fa-5x"></i>
                            </div> -->
                                <textarea class="tinyMceLetter hide" name="letter" id="letter">
                                    <?php
                                    date_default_timezone_set('Asia/Dhaka');
                                    $en = array('0','1','2','3','4','5','6','7','8','9');
                                    $bn = array('০', '১', '২', '৩',  '৪', '৫', '৬', '৭', '৮', '৯');
                                    $date = str_replace($en, $bn, date('Y-m-d H:i:s'));
                                    ?>
                                    <p>
                                    <center><b>{{ (!empty($info->hr_unit_name_bn)?$info->hr_unit_name_bn:null) }} </b></center>
                                    <center><u> {{ (!empty($info->hr_unit_address_bn)?$info->hr_unit_address_bn:null) }} </u> </center>
                                    <p>তারিখঃ&nbsp; {{ $date }} ইং</p>
                                    <p>জনাব/জনাবাঃ   {{ (!empty($info->hr_bn_associate_name)?$info->hr_bn_associate_name:null) }}</p>
                                    <p>পিতা/স্বামীর নামঃ   {{ (!empty($info->hr_bn_father_name)?$info->hr_bn_father_name:null) }}/{{ (!empty($info->hr_bn_spouse_name)?$info->hr_bn_spouse_name:null) }}</p>
                                    <p>মাতার নামঃ {{ (!empty($info->hr_bn_mother_name)?$info->hr_bn_mother_name:null) }}</p>
                                    <p><b>ঠিকানাঃ স্থায়ী ঠিকানাঃ</b></p>
                                    <p>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;গ্রামঃ    {{ (!empty($info->hr_bn_permanent_village)?$info->hr_bn_permanent_village:null) }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; ডাকঘরঃ {{ (!empty($info->hr_bn_permanent_po)?$info->hr_bn_permanent_po:null) }}</p>
                                    <p>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;থানাঃ   {{ (!empty($info->permanent_upazilla_bn)?$info->permanent_upazilla_bn:null) }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  জেলাঃ {{ (!empty($info->permanent_district_bn)?$info->permanent_district_bn:null) }}</p>
                                    <p><b>অস্থায়ী/বর্তমান ঠিকানাঃ</b></p>
                                    <p>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;গ্রামঃ    {{ (!empty($info->hr_bn_present_road)?$info->hr_bn_present_road:null) }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; ডাকঘরঃ {{ (!empty($info->hr_bn_present_po)?$info->hr_bn_present_po:null) }}</p>
                                    <p>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;থানাঃ   {{ (!empty($info->present_upazilla_bn)?$info->present_upazilla_bn:null) }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  জেলাঃ {{ (!empty($info->present_district_bn)?$info->present_district_bn:null) }}</p>
                                    <p><span style="text-decoration: underline;"><strong>বিষয়ঃ- নিয়োগপত্র</strong></span></p>
                                    <p>কতৃপক্ষ অত্যন্ত আনন্দের সহিত জানাচ্ছে যে, আপনাকে নিম্নলিখিত শর্তসাপেক্ষে অত্র কারখানার <b>{{ (!empty($info->hr_designation_name_bn)?$info->hr_designation_name_bn:null) }}</b> পদে প্রতি মাসে সর্বসাকুল্যে মোট {{ (!empty($info->ben_joining_salary)?str_replace($en, $bn, $info->ben_joining_salary):null) }} টাকা বেতনে  গ্রেডঃ {{$info->hr_designation_grade?$info->hr_designation_grade:''}} নিয়োগ দেওয়ার সিদ্ধান্ত গ্রহণ করিয়াছেন, আপনার পরিচয় পত্র নং(আই.ডি. নং)-<b>{{$info->associate_id}}</b>  যাহা <b>{{ (!empty($info->as_doj)?str_replace($en, $bn, $info->as_doj):null) }}</b> তারিখ হইতে কার্যকরী।</p>
                                    <p>১। আপনি চাকুরীতে প্রথম ০৩ (তিন) মাস প্রবেশনারী অবস্থায় থাকিবেন এবং উক্ত সময়ের মধ্যে আপনার কর্মদক্ষতা সন্তোষজনক না হইলে আপনার প্রবেশনকাল আরও তিন মাস বর্ধিত করা যেতে পারে। প্রবেশনকাল অতিবাহিত হওয়ার পর আপনি সরাসরি স্থায়ী শ্রমিক হিসাবে গণ্য হবেন।</p><br>
                                    <p>২। <b> বেতনঃ</b></p>
                                    <p>ক) মূল বেতন( Monthly Basic Pay )&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;: টাকা {{ (!empty($info->ben_basic)?str_replace($en, $bn, $info->ben_basic):null) }}/= অতিরিক্ত কর্ম ঘন্টার হার: <?php $ot_pay= ($info->ben_basic/208)*2; $ot_pay = sprintf('%0.2f', $ot_pay);
                                    echo str_replace($en, $bn, $ot_pay); 
                                     ?> টাকা</p>
                                    <p>খ) বাড়ী ভাড়া(House Rent-40% of Basic Pay)&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: টাকা {{ (!empty($info->ben_house_rent)?str_replace($en, $bn, $info->ben_house_rent):null) }}/=</p>
                                    <p>গ) চিকিৎসা ভাতা(Medical Allowance)&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;: টাকা {{ (!empty($info->ben_medical)?str_replace($en, $bn, $info->ben_medical):null) }}/=</p>
                                    <p>ঘ) খাদ্য ভাতা(Food Allowance)&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: টাকা {{ (!empty($info->ben_transport)?str_replace($en, $bn, $info->ben_transport):null) }}/=</p>
                                    <p>ঙ) যাতায়াত ভাতা(Conveyance Allowance) &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: টাকা {{ (!empty($info->ben_food)?str_replace($en, $bn, $info->ben_food):null) }}/=</p>
                                    <p>সর্বমোট বেতন( Monthly Gross Salary ) &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: টাকা {{ (!empty($info->ben_current_salary)?str_replace($en, $bn, $info->ben_current_salary):null) }}/=</p>
                                    <p style="text-align: center"> বেতন প্রদানঃ প্রতি মাসের বেতন পরবর্তী মাসের সাত কর্ম দিবসের মধ্যে বেতন এবং ওভার টাইম এক সঙ্গে প্রদান করা হয়। </p><br>

                                    <p>৩। কর্ম ঘন্টাঃ ফ্যাক্টরি সকাল ৮.০০ থেকে শুরু এবং বিকাল ৫.০০ টায় সাধারণ কর্মদিবসের সমাপ্তি এবং মধ্যবর্তী সময়ে ০১(এক) ঘণ্টা বিরতি।</p>
                                    <p>৪। অতিরিক্ত কর্মঘন্টা (ওভার টাইম) ঃ  ইহা মূল বেতনের দ্বিগুন হারে প্রদেয়। ( মূল বেতন/২০৮x২xমোট অতিরিক্ত ঘন্টা)।</p><br>
                                    <p>৫।<b> ছুটিঃ</b></p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;১। শুক্রবার সাপ্তাহিক ছুটি।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;২। অন্যান্য ছুটি, (যাহা পূর্ণ বেতনে ভোগ করিতে পারিবেন।&nbsp;</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ক) নৈমিত্তিক ছুটিঃ বছরে ১০(দশ) দিন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;খ) অসুস্থতা জনিত ছুটিঃ বছরে ১৪(চৌদ্দ) দিন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;গ) উৎসব ছুটিঃ বছরে ১১(এগার) দিন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ঘ) অর্জিত ছুটিঃ- ০১(এক) বৎসর অতিবাহিত হওয়ার পর প্রতি ১৮ কর্মদিবসের জন্য একদিন করে বার্ষিক ছুটি ভোগ করিতে পারিবেন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ঙ) মাতৃকল্যাণ ছুটিঃ- কোন মহিলা শ্রমিক যদি অত্র প্রতিষ্ঠানে একাধিক্রমে ০৬(ছয়) মাস চাকুরী করেন তাহলে তিনি উক্ত ছুটি ভোগ করিতে পারিবেন। ২০০৬ সালের মাতৃকল্যাণ আইনের ধারা অনুযায়ী মোট ১৬ সপ্তাহ বা (৫৬+৫৬)=১১২ দিন মাতৃত্বকালীন ছুটি (আইনানুগ ও নগদে) ভোগ করিতে পারিবেন।</p><br>

                                    <p>৬। <b> সুবিধা</b></p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ক) মূল মজুরীর ৫% হারে বাৎসরিক ভিত্তিতে মজুরী বৃদ্ধি পাইবে।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;খ) যারা নিরবিচ্ছিন্নভাবে ১(এক) বৎসর চাকরি পূর্ণ করিয়াছেন তাহাদেরকে বৎসরে দুইটি উৎসব ভাতা প্রদান করা হইবে(প্রতিটি উৎসব ভাতা মূল বেতনের সমান।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;গ) মাসের প্রতিটি কর্মদিনের সঠিক সময়ে ফ্যাক্টরিতে উপস্থিত হলে প্রথম মাস ৪০০/= টাকা এবং একইভাবে পরবর্তী মাসে উপস্থিত থাকলে ৫০০/= হারে হাজিরা বোনাস প্রদান করা হয়। (ইহা আইনানুনাগ কোন পাওনা নয়। ইহা বেতনের বাহিরের একটি অংশ। )</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ঘ) বিনা খরচে ডাক্তার এবং নার্সের মাধ্যমে চিকিৎসা প্রদান করা হয়। </p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ঙ) শ্রমিক/কর্মচারীর জন্য গ্রুপ ইন্স্যুরেন্স এর ব্যবস্থা আছে। </p><br>
                                    <p>৭। <b> চাকুরি ছাড়ার নিয়মঃ</b></p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ক) চাকুরী ছাড়তে হলে বাংলাদেশ শ্রম আইন, ২০০৬ অনুসারে ২৭(১) ধারা মোতাবেক চাকুরী ছাড়ার ২ মাস(৬০ দিন) আগে কতৃপক্ষকে লিখিত নোটিশ প্রদান করতে হবে, অন্যথায় প্রদেয় নোটিশের পরিবর্তে নোটিশ মেয়াদের জন্য মজুরীর সমপরিমাণ অর্থ মালিককে প্রদান করিয়া ইহা করিতে পারিবেন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;খ) অসুস্থতার কারণে চাকুরী ছেড়ে দিতে হলে মেডিকেল সার্টিফিকেট দাখিল করতে হবে।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;গ) চাকুরী ছাড়ার পর কোম্পানীর প্রদত্ত মালামাল অর্থাৎ পরিচয় পত্র, লকারের চাবি, ড্রেস, কাটার, টেপ ইত্যাদি মানব সম্পদ বিভাগে জমা প্রদান করতে হবে।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ঘ) চাকুরী স্থায়ী হইবার পর কতৃপক্ষ আপনার চাকুরী অবসান করিতে চাহিলে ১২০(একশত বিশ) দিনের লিখিত নোটিশ অথবা ১২০(একশত বিশ) দিনের বেতন প্রদান করিবেন।</p>

                                    <br>
                                    <p>৮। প্রবেশনারী থাকাকালীন সময়ে কোম্পানী যে কোন সময় কোন প্রকার কারণ দর্শানো ব্যতিরেকে বিনা নোটিশে আপনার চাকুরী অবসান করিতে পারিবেন অথবা আপনিও চাকুরী থেকে স্বেচ্ছায় ইস্তফা দিতে পারিবেন।</p>
                                    <br>
                                    <p>৯। <b>  বাংলাদেশের শ্রম আইন, ২০০৬ অনুসারে ধারা ২৩(৪) মোতাবেক নিম্নলিখিত কাজসমূহ "অসদাচরণ"</b></p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(ক) উপরস্থের কোন আইন সংগত বা যুক্তি সংগত আদেশ মানার ক্ষেত্রে এককভাবে বা অন্যের সঙ্গে সংঘবদ্ধ হইয়া ইচ্ছাকৃত ভাবে অবাধ্যতা।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(খ) মালিকের ব্যবসা বা সম্পত্তি সম্পর্কে চুরি আত্মসাৎ, প্রতারণা বা অসাধুতা।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(গ) মালিকের অধীন তাহার বা অন্য কোন শ্রমিকের চাকুরী সংক্রান্ত ব্যাপারে ঘুষ গ্রহণ বা প্রদান।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(ঘ) বিনা ছুটিতে অভ্যাসগত অনুপস্থিতি অথবা ছুটি না নিয়া একসঙ্গে ১০ (দশ) দিনের অধিক সময় অনুপস্থিতি।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(ঙ) অভ্যাসগত বিলম্ব।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(চ) প্রতিষ্ঠানে প্রযোজ্য কোন আইন, বিধি বা প্রবিধানের অভ্যাসগত লঙ্ঘন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(ছ) প্রতিষ্ঠানে উচ্ছৃংখল বা দাংগা হাংগামা, অগ্নিসংযোগ বা ভাংচুর।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(জ) কাজে কর্মে অভ্যাসগত গাফিলতি।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(ঝ) প্রধান পরিদর্শক কর্তৃক অনুমোদিত চাকুরী সংক্রান্ত আত্নশৃংখল বা আচরণসহ, যে কোন বিধির অভ্যাসগত লংঘন।</p>
                                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(ঞ) মালিকের অফিসিয়াল রেকর্ডের রদবদল, জালকরণ, অন্যায় পরিবর্তন, উহার ক্ষতিকরন বা উহা হারাইয়া ফেলা।</p>

                                    <p>আপনি যদি কখনো কোনরুপ অসদাচরণের অপরাধে দোষী প্রমাণিত হন তবে কতৃপক্ষ আপনার বিরুদ্ধে আইনগত শাস্তিমূলক ব্যবস্থা গ্রহণ করিতে পারবে। </p> <br>
                                    <p>১০।  আপনার চাকুরী কোম্পানী কর্তৃক জারিকৃত বিধি ও বাংলাদেশের প্রচলিত শ্রম আইন দ্বারা পরিচালিত হইবে।</p>
                                    <p>১১।  কর্তৃপক্ষ আপনাকে প্রয়োজনবোধে এই প্রতিষ্ঠানের যে কোন বিভাগে অথবা বাংলাদেশে অবস্থিত যে কোন কারখানায়/অফিসে বদলি করিতে পারিবেন।</p>
                                    <p>১২।  কোম্পানীর যাবতীয় নিয়ম-কানুন পরিবর্তনযোগ্য ( যাহা দেশের প্রচলিত আইনের পরিপন্থি নহে) এবং আপনি পরিবর্তীত নিয়ম কানুন সর্বদা মানিয়া চলিতে বাধ্য থাকিবেন। </p><br>
                                    <p>ধন্যবাদান্তে</p>
                                    <p>&nbsp; &nbsp;সংশ্লিষ্ট ব্যবস্থাপক</p>
                                    <p style="text-align: right;">কারখানা কতৃপক্ষ&nbsp; &nbsp; &nbsp;&nbsp;</p>
                                    <p>&nbsp; &nbsp;অনুলিপিঃ</p>
                                    <p>&nbsp; &nbsp;১। হিসাব বিভাগ।</p>
                                    <p>&nbsp; &nbsp;২। ব্যক্তিগত নথি।</p>
                                    <p>আমি অত্র নিয়োগপত্র পাঠ করিয়া এবং ইহাতে বর্ণিত শর্তাদি সম্পূর্ণরুপে অবগত হইয়া এই নিয়োগপত্র গ্রহণ করিয়া স্বাক্ষর করিলাম।</p>
                                    <p>&nbsp;</p>
                                    <p style="text-align: right;">&nbsp;শ্রমিকের স্বক্ষর&nbsp; &nbsp; &nbsp; &nbsp;</p>
                                    </p>
                                </textarea>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-8 col-md-9">
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-info" type="submit" onclick="printMe()">
                                    <i class="ace-icon fa fa-print bigger-110"></i> Print
                                </button> 
                            </div>
                        </div>
                        @endif
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
function printMe()
  { 

    var myWindow=window.open('','','width=800,height=800');
    myWindow.document.write('<html><head></head><body style="font-size:9px;">');
    myWindow.document.write(document.getElementById('letter').value);
    myWindow.document.write('</body></html>');
    myWindow.focus();
    myWindow.print();
    myWindow.close();
  }

$(document).ready(function()
{   
    $('select.associates').select2({
        
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term
                }; 
            }, 
            processResults: function (data) { 
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.associate_name,
                            id: item.associate_id
                        }
                    }) 
                };
          },
          cache: true
        }
    });

    // retrive all information  
    $('body').on('change', '.associates', function(){
        var id = $(this).val();
        var str = $("#generate").attr("href");
        var x = str.replace("%ASSOCIATE_ID%", id);
        $("#generate").attr('href', x);
    });
});
</script>
@endsection