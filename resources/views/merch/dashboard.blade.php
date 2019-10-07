@extends('merch.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <!-- breadcrumbs -->
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="/">Merchandising</a>
                </li>
                <li class="active"> Dashboard  </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <!-- /. breadcrumbs -->
        <!-- page-content -->
        <div class="page-content">
            <!-- /.page-header -->

            <div class="row">
                <!-- Display Erro/Success Message -->

                @include('inc/message')

                    <div class="col-sm-12">
                    </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- PAGE CONTENT ENDS -->
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->
@endsection