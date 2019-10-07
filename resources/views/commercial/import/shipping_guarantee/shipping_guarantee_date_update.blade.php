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
                <li class="active"> Shipping Guarantee Date Update </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Import <small><i class="ace-icon fa fa-angle-double-right"></i> Shipping Guarantee Date Update</small></h1>
            </div>
            <div class="panel panel-info">
              <div class="panel-heading page-headline-bar"><h5> Shipping Guarantee Date Update <a href="{{URL::to('comm/import/importdata/shipping-guarantee-date-update-list')}}" class="btn btn-info btn-sm">List of Shipping Guarantee Date Update</a></h5> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="entry_search_section">
                            <div class="form-horizontal">
                                <!-- 1st ROW -->
                                <div class="row">
                                    <!-- Display Erro/Success Message -->

                                    <input type="hidden" name="url" value="{{URL::to('/')}}">
                                    <div class="col-sm-12">
                                      @include('inc/message')
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="file_no" > File No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="cm_file_id" id="file_no" class="col-xs-12 form-control" onchange="fileId(this.value)">
                                                        <option value=""> - select - </option>
                                                        @foreach($fileList as $file)
                                                        <option value="{{$file->id}}">{{$file->file_no}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="lc_no" > L/C No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="lc_no" id="lc-no-data" class="col-xs-12 form-control" >
                                                        <option value=""> - select - </option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="Sg_no" > S.G No.<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="Sg_no" id="Sg-no-data" class="col-xs-12 form-control" >
                                                        <option value=""> - select - </option>
                                                        @foreach($sgNo as $sgNo)
                                                        <option value="{{$sgNo}}">{{$sgNo}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-sm-4 no-padding control-label " for="lc_no" > Mode<span style="color: white">&#42;</span> </label>
                                                <div class="col-sm-8">
                                                    <select name="Ship_mode" id="Ship_mode" class="col-xs-12 form-control" >
                                                        <option value=""> - select - </option>
                                                        <option value="Sea">Sea</option>
                                                        <option value="Air">Air</option>
                                                        <option value="Road">Road</option>
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

                                        <div class="col-sm-6">
                                            <div class="form-group pull-right">
                                                <button onclick="search()" type="submit" class="btn btn-success btn-sm">Search</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="shortingResult" ></div>
                </div>
            </div>
            <div class="entry_save_section" id="entry-save-section"></div>
        </div><!-- /.page-content -->
    </div>
</div>
@push('js')
    <script>
        var loaderPath = "{{asset('assets/images/loader-cycle.gif')}}";
        //
        function fileId(value){
            if(value == ''){
                value = 0;
            }
            $("#lc-no-data").load('{{ URL::to('comm/import/importdata/filewise-lcno')}}'+'/'+value);
            // $("#lc-no-data").load('{{ URL::to('comm/import/importdata/filewise-lcno')}}'+'/'+value);
           $("#supplierId").load('{{ URL::to('comm/import/importdata/filewise-supplier')}}'+'/'+value);
        }


        function search() {
            var url = $('input[name="url"]').val();
            var _token = $('input[name="_token"]').val();
            var cm_file_id = $('select[name="cm_file_id"]').val();
            var lc_no   = $('select[name="lc_no"]').val();
            var sg_no   = $('select[name="Sg_no"]').val();
            var pi_no   = $('select[name="Pi_no"]').val();
            var mode   = $('select[name="Ship_mode"]').val();
            var mr_supplier_sup_id   = $('select[name="mr_supplier_sup_id"]').val();
            var value = $('input[name="value"]').val();

            // $("#shortingResult").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');
            $("#entry-save-section").html('');
            setTimeout(() => {
                $.ajax({
                    url: url+'/comm/import/importdata/shipping-guarantee-date-update-search',
                    type: "GET",
                    data: {
                      _token : _token,
                      cm_file_id : cm_file_id,
                      lc_no : lc_no,
                      sg_no : sg_no,
                      pi_no : pi_no,
                      mode : mode,
                      mr_supplier_sup_id : mr_supplier_sup_id,
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

        function chooseFileData(cm_imp_data_entry_id,cm_btb_id,cm_imp_date_update_sea_port_id,cm_file_id) {
            var url = $('input[name="url"]').val();
            // $("#entry-save-section").html('<div class="loader-cycle"><img src="'+loaderPath+'" /></div>');
            $('html, body').animate({
                scrollTop: $("#entry-save-section").offset().top
            }, 2000);
            setTimeout(() => {
                $.ajax({
                    url: url+'/comm/import/importdata/shipping-guarantee-edit',
                    type: "GET",
                    data: {
                      cm_imp_data_entry_id : cm_imp_data_entry_id,
                      cm_btb_id : cm_btb_id,
                      cm_file_id : cm_file_id,
                      cm_imp_date_update_sea_port_id :cm_imp_date_update_sea_port_id
                    },
                    success: function(response){
                      if(response !== 'error'){
                        //console.log(response);
                        $("#entry-save-section").html(response);
                      }
                    },
                });
            }, 1000);

        }

    </script>
@endpush

@endsection
