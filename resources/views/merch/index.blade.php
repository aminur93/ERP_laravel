<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>MERCHANDISING-MBM</title>
		<link rel="icon" href="{{ asset('assets/images/logo/mbm.png') }}" type="image/png" sizes="32x32"/> 

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}">

		
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
		
		{{-- Label text align left --}}
		<style type="text/css">
   				.form-horizontal .control-label {text-align: left; margin-bottom: 0; padding-top: 7px;}
		</style>

		<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
		<!-- Datepicker Css -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
		<!-- Select2 Css -->
		<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

		<!-- Datatable Css -->
		<link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}" />
		

		<!-- Theme Css -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
 		@stack('css')
 		<!-- xinnah Common Css --> 
		<link rel="stylesheet" href="{{ asset('assets/xinnah/css/style.css') }}" />
		<!-- Common Css --> 
		<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
 
		<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>
    
		<script>
    		function ajaxLoad(filename, content) {
		        content = typeof content !== 'undefined' ? content : 'content';
		        $('.loading').show();
		        $.ajax({
		            type: "GET",
		            url: filename,
		            contentType: false,
		            success: function (data) {
		                $("#" + content).html(data);
		                $('.loading').hide();
		            },
		            error: function (xhr, status, error) {
		                alert(xhr.responseText);
		            }
		        });
		    }
		</script>
		
	</head>

	<body class="skin-1">
		
		@include('merch.top_navbar')
		@include('merch.menu')
		@yield('content')
		@include('../footer')

		
		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<!-- Jquery Ui Js-->
		<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
		{{-- bootstrap js --}}
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- Select2 Js -->
		<script src="{{ asset('assets/js/select2.min.js') }}"></script>

		<!-- Datatables Js -->
		<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>

		<!-- Form Validation -->
		<script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script> 

		<!-- Pie Chart -->
	    <script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>
	    <script src="{{ asset('assets/js/jquery.sparkline.index.min.js') }}"></script>
	    <script src="{{ asset('assets/js/jquery.flot.min.js') }}"></script>
	    <script src="{{ asset('assets/js/jquery.flot.pie.min.js') }}"></script>
	    <script src="{{ asset('assets/js/jquery.flot.resize.min.js') }}"></script>

		<!-- Typeahead Js -->
		<script src="{{ asset('assets/js/bootstrap3-typeahead.min.js') }}"></script> 

		<!-- Tag Input -->
		<script src="{{ asset('assets/js/bootstrap-tag.min.js') }}"></script> 
		
		<!-- Tinymce Js by khirat -->
		<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script> 

		<!-- Date Time Picker Js-->
		<script src="{{ asset('assets/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

		<!-- Ace Default -->
		<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace.min.js') }}"></script>
		
		@stack('js')
		<script>
			$(function () {
		    $("[rel='tooltip']").tooltip();
		    $('[data-toggle="popover"]').popover();
		  });
		</script>
		<!-- Custom Js -->
		<script src="{{ asset('assets/js/custom.js') }}"></script> 
	</body>
</html>
