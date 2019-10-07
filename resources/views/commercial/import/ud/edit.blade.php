@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li>
                <li>
                    <a href="#"> Import </a>
                </li>
                <li>
                    <a href="#"> UD System </a>
                </li>
                <li class="active"> Edit </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Edit UD System </small></h1>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <ul class="nav nav-tabs">
                      <li role="presentation" class="{{ !request()->get('tab')?'active':null }}"><a href="{{ url()->current() }}">Master Information</a></li>
                      <!-- <li role="presentation" class="{{ request()->get('tab')=='2'?'active':null }}"><a href="{{ url()->current().'?tab=2' }}">UD Quantity</a></li>
                      <li role="presentation" class="{{ request()->get('tab')=='3'?'active':null }}"><a href="{{ url()->current().'?tab=3' }}">Transaction</a></li>
                      <li role="presentation" class="{{ request()->get('tab')=='4'?'active':null }}"><a href="{{ url()->current().'?tab=4' }}">Library</a></li> -->
                      <li role="presentation" class="{{ request()->get('tab')=='5'?'active':null }}"><a href="{{ url()->current().'?tab=5' }}">UD Amount</a></li>
                    </ul>
                    <div class="tabbable">
                        <div class="tab-content">
                            <!-- Display Erro/Success Message -->
                            @include('inc/message')
                            @switch(request()->get('tab'))
                                @case(2)
                                    @include('commercial/import/ud/ud_quantity')
                                    @break
                                @case(3)
                                    @include('commercial/import/ud/transaction')
                                    @break
                                @case(4)
                                    @include('commercial/import/ud/library')
                                    @break
                                @case(5)
                                    @include('commercial/import/ud/ud_amount')
                                    @break
                                @default
                                    @include('commercial/import/ud/master_information_edit')
                            @endswitch

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
@endsection
