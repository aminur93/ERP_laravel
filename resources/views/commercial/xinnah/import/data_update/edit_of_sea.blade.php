@extends('commercial.index')
@push('css')
    <style>
        
    </style>
@endpush
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
                <li class="#"> Import Data Update </li>
                <li class="active"> Edit Consignment on High Seas </li>
                
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Consignment on High Seas</small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5>Edit Consignment on High Seas <a href="{{URL::to('comm/import/import-data-update/consignment/seas/list')}}" class="btn btn-info btn-sm">List of Consignment seas</a> </h5> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="entry_search_section">
                            <div class="form-horizontal">
                                <!-- 1st ROW -->
                                <div class="row">
                                    <!-- Display Erro/Success Message -->
                                    @include('inc/message')
                                    
                                    <div class="col-sm-12">
                                        
                                        @include('commercial.xinnah.import.data_update.consignment_sea_entry') 
                                       
                                    </div>
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div> 


@endsection