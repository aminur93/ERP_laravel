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
                <li class="active"> Pass Book And Volume Number </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Pass Book And Volume Number Entry</small></h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading page-headline-bar"><h5> Pass Book And Volume Number <a href="{{URL::to('comm/import/pass-book-and-volume-number-list')}}" class="btn btn-info btn-xs"> <i class="fa fa-list"></i> &nbsp; List of passbook volume</a></h5> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="entry_search_section">
                            <div class="form-horizontal">
                                <!-- 1st ROW -->
                                <div class="row">
                                    <!-- Display Erro/Success Message -->
                                    @include('inc/message')
                                    <input type="hidden" name="url" value="{{URL::to('/')}}">
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
                                                <label class="col-sm-4 no-padding control-label " for="lc_no" > L/C No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="lc_no" id="lc-no-data" class="col-xs-12 form-control" onchange="LcNo(this.value)">
                                                        <option value=""> - select - </option>
                                                        @foreach($getLcNo as $lcno)
                                                        <option value="{{$lcno->lc_no}}">{{$lcno->lc_no}}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="supplierId" > Supplier<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="mr_supplier_sup_id" id="supplierId" class="col-xs-12 form-control">
                                                        <option value=""> - select - </option>
                                                        @foreach($getSuppliers as $getSupplier)
                                                        <option value="{{$getSupplier->supplier->sup_id}}">{{$getSupplier->supplier->sup_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="value" > Value<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="value" name="value" placeholder="Value" value="" class="form-control col-xs-12" />
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="doc_no" > Doc No<span style="color: white">&#42;</span> </label>
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
        
        //
        function fileNo(value){
            if(value == ''){
                value = 0;
            }
            $("#lc-no-data").load('{{ URL::to('comm/import/filewise-lcno')}}'+'/'+value);
        }
        function LcNo(value){
            if(value == ''){
                value = 0;
            }
            $("#supplierId").load('{{ URL::to('comm/import/lcnowise-supplier')}}'+'/'+value);
        }

        function search() {
            var _token = $('input[name="_token"]').val();
            var cm_file_id = $('select[name="cm_file_id"]').val();
            var lc_no   = $('select[name="lc_no"]').val();
            var mr_supplier_sup_id   = $('select[name="mr_supplier_sup_id"]').val();
            var transp_doc_no1   = $('select[name="transp_doc_no1"]').val();
            var value = $('input[name="value"]').val();

            $("#shortingResult").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');
            $("#entry-save-section").html('');
            setTimeout(() => {
                $.ajax({
                    url: url+'/comm/import/pass-book-and-volume-number-search',
                    type: "GET",
                    data: { 
                      _token : _token,
                      cm_file_id : cm_file_id,
                      lc_no : lc_no,
                      mr_supplier_sup_id : mr_supplier_sup_id,
                      transp_doc_no1 : transp_doc_no1,
                      value : value,
                    },
                    success: function(response){
                      if(response !== 'error'){
                        //console.log(response);
                        $("#shortingResult").html(response);
                      }
                    }
                });
            }, 1000);
        }

        function chooseFileData(cm_imp_data_entry_id, cm_btb_id) {
            $("#entry-save-section").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');
            $('html, body').animate({
                scrollTop: $("#entry-save-section").offset().top
            }, 2000);
            setTimeout(() => {
                $.ajax({
                    url: url+'/comm/import/passbook-and-volume-number-check',
                    type: "GET",
                    data: { 
                      cm_imp_data_entry_id : cm_imp_data_entry_id,
                      cm_btb_id : cm_btb_id
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