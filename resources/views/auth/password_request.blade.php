<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" /> 
        <title>MBM ERP - LOGIN</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" /> 

        <!-- Theme Css -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
 
    </head>

    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">

                                <h3>
                                    <!-- <i class="ace-icon fa fa-desktop green"></i> -->
                                    <img src="{{ asset('assets/images/logo/mbm.png') }}" height="40px" width="140px" style="padding: 0px; margin-bottom: 10px;" class="msg-photo" alt="MBM logo "/>
                                    <br>
                                    <strong style="color: #FBAF42">MBM</strong>
                                    <strong style="color: #FBAF42" id="id-text2">Group</strong>
                                </h3>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative"> 
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-sign-in "></i>
                                                Please Enter Your Associate ID
                                            </h4>

                                            <div class="space-6"></div>
                                            @include('inc/message')

                                            <form method="POST" action="{{ url('password_request/send') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input name="associate_id" type="associate_id" class="form-control " placeholder="Associate ID"/>
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span> 
                                                    </label>
 

                                                    <div class="space"></div>

                                                    <div class="clearfix">

                                                        <button type="submit" class="width-42 pull-right btn btn-sm btn-primary">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Send Request </span>
                                                        </button>
                                                    </div>
                                                    <div class="space-4"></div> 
                                            </form> 
                                        </div><!-- /.widget-main -->

                                        <div class="toolbar clearfix">
                                            <div>
                                                <a href="{{ route('login') }}" data-target="#forgot-box" class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left" style="margin-right: 3px;"></i>Back to login
                                                </a>
                                            </div> 
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->
                            </div><!-- /.position-relative --> 
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->
        <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
             
    </body>
</html>
 