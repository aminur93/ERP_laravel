<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" /> 
        <title>Dashboard - MBM</title>
        <link rel="icon" href="{{ asset('assets/images/logo/mbm.png') }}" type="image/png" sizes="32x32"/>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

        <!-- Select 2  -->
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>


        <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
        
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

        <!-- Common JS -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>
    
       
    </head>
    
   
<body class="skin-1">
    @include('top_navbar')
    @include('menu')


    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="dashboard">Dashboard</a>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12 menubox-container"  id="para">
                                    <a href="{{ url('hr') }}">
                                    <div class="menubox menubox-hr">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/HR.png') }}" class="icon-img">
                                        </div>
                                        <p>Human Resource</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('merch/dashboard') }}">
                                    <div class="menubox menubox-merch">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Merchandising.png') }}" class="icon-img">
                                        </div>
                                        <p>Merchandising</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('commercial/dashboard') }}">
                                    <div class="menubox menubox-comm">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Commercial.png') }}" class="icon-img">
                                        </div>
                                        <p>Commercial</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('planning') }}">
                                    <div class="menubox menubox-plan">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Planning.png') }}" class="icon-img">
                                        </div>
                                        <p>Planning</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('manufacturing') }}">
                                    <div class="menubox menubox-mfg">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Manufacture.png') }}" class="icon-img">
                                        </div>
                                        <p>Manufacturing</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('wash') }}">
                                    <div class="menubox menubox-wash">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Wash.png') }}" class="icon-img">
                                        </div>
                                        <p>Wash</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('store') }}">
                                    <div class="menubox menubox-store">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Store.png') }}" class="icon-img">
                                        </div>
                                        <p>Store</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('csr') }}">
                                    <div class="menubox menubox-csr">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/CSR.png') }}" class="icon-img">
                                        </div>
                                        <p>CSR</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('compliance') }}">
                                    <div class="menubox menubox-comp">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/Compliance.png') }}" class="icon-img">
                                        </div>
                                        <p>Compliance</p>
                                    </div>
                                    </a>

                                    <a href="{{ url('account_finance') }}">
                                    <div class="menubox menubox-acc" style="min-width: 200px;">
                                        <div class="menubox-img">
                                            <img src="{{ asset('assets/images/menu-icons/AccountsFinance.png') }}" class="icon-img">
                                        </div>
                                        <p>Accounts & Finance</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.page-content -->
        </div>
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>

    @include('footer')
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Select 2 Js -->
    <script src="assets/js/select2.min.js"></script>


    <script src="assets/js/jquery-ui.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/bootbox.js"></script>
    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

    <!-- Custom Js -->
    {{-- <script src="assets/js/custom.js"></script> --}}
    </body>
</html>
