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
                @if($type == 'seas')
                <li class="active"> Consignment on High Seas </li>
                @else
                <li class="active"> Consignment at Port </li>
                @endif
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Consignment @if($type == 'seas') on High Seas @else at Port @endif</small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5> Consignment @if($type == 'seas') on High Seas <a href="{{URL::to('comm/import/import-data-update/consignment/seas/list')}}" class="btn btn-info btn-xs"><i class="fa fa-list"></i> &nbsp; List of Consignment seas</a>@else at Port <a href="{{URL::to('comm/import/import-data-update/consignment/port/list')}}" class="btn btn-info btn-xs"><i class="fa fa-list"></i> &nbsp; List of Consignment port</a> @endif </h5> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="entry_search_section">
                            <div class="form-horizontal">
                                <!-- 1st ROW -->
                                <div class="row">
                                    <!-- Display Erro/Success Message -->
                                    @include('inc/message')
                                    <input type="hidden" name="url" value="{{URL::to('/')}}">
                                    <input type="hidden" name="page_type" value="{{$type}}">
                                    <div class="col-sm-12">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="file_no" > File No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="cm_file_id" id="file_no" class="col-xs-12 form-control" onchange="fileNo(this.value)">
                                                        <option value=""> - select - </option>
                                                        @foreach($getFiles as $getFile)
                                                        <option value="{{$getFile->file->id}}">{{$getFile->file->file_no}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="value" > Value.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="value" id="value-data" class="col-xs-12 form-control" onchange="valueData(this.value)">
                                                        <option value=""> - select - </option>
                                                        @foreach($getValuePackage as $getValue)
                                                        <option value="{{$getValue->value}}">{{$getValue->value}}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="package" > Package<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="package" id="package-data" class="col-xs-12 form-control">
                                                        <option value=""> - select - </option>
                                                        @foreach($getValuePackage as $getPackage)
                                                        <option value="{{$getPackage->package}}">{{$getPackage->package}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="doc_no" >Transport Doc No<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="transp_doc_no1" id="doc_no" class="col-xs-12 form-control">
                                                        <option value=""> - select - </option>
                                                        @foreach($getTransDocNo as $transDocNo)
                                                        <option value="{{$transDocNo->transp_doc_no1}}">{{$transDocNo->transp_doc_no1}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button onclick="search()" type="submit" class="btn btn-success btn-sm">Search</button>
                                            </div> 
                                        </div> 
                                       
                                    </div>
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                    <div id="shortingResult"></div>
                </div>
            </div>
            <div class="entry_save_section" id="entry-save-section"></div>
        </div><!-- /.page-content -->
    </div>
</div> 
@push('js')
    <script>
        var loaderPath = "{{asset('assets/xinnah/img/loader-cycle.gif')}}";
        var url = $('input[name="url"]').val();
        var page_type   = $('input[name="page_type"]').val();
        //
        function fileNo(value){
            if(value == ''){
                value = 0;
            }
            $("#value-data").load('{{ URL::to('comm/import/import-data-update/filewise-value')}}'+'/'+value);
        }
        function valueData(value){
            if(value == ''){
                value = 0;
            }
            $("#package-data").load('{{ URL::to('comm/import/import-data-update/valuewise-package')}}'+'/'+value);
            
        }

        function search() {
            var _token = $('input[name="_token"]').val();
            var cm_file_id = $('select[name="cm_file_id"]').val();
            var value   = $('select[name="value"]').val();
            var package   = $('select[name="package"]').val();
            var transp_doc_no1   = $('select[name="transp_doc_no1"]').val();

            $("#shortingResult").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');
            $("#entry-save-section").html('');
            setTimeout(() => {
                $.ajax({
                    url: url+'/comm/import/import-data-update/consignment-seas-port-search',
                    type: "GET",
                    data: { 
                      _token : _token,
                      cm_file_id : cm_file_id,
                      package : package,
                      transp_doc_no1 : transp_doc_no1,
                      value : value,
                    },
                    success: function(response){
                      if(response !== 'error'){
                        //console.log(response);
                        $("#shortingResult").html(response)
                      }
                    }
                });    
            }, 1000);
            
        }

        function chooseFileData(data_entry_id) {
            $("#entry-save-section").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');
            $('html, body').animate({
                scrollTop: $("#entry-save-section").offset().top
            }, 2000);
            setTimeout(() => {
                $.ajax({
                    url: url+'/comm/import/import-data-update/consignment-seas-port-check',
                    type: "GET",
                    data: { 
                      cm_imp_data_entry_id : data_entry_id,
                      page_type : page_type
                    },
                    success: function(response){
                      if(response !== 'error'){
                        //console.log(response);
                        $("#entry-save-section").html(response);
                      }
                    }
                });    
            }, 1000);
            
        }
        
    </script>
@endpush

@endsection