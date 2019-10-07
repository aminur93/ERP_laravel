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
                    <a href="#"> Export </a>
                </li>
                <li class="active">ELC File Close </li>
            </ul>
            <!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i>ELC File Close</small></h1>
            </div>
            <!---Form -->
            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div id="selectOne"></div> 
                <!-- PAGE CONTENT BEGINS -->
                <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/export/elcFileClose_save')}}">
                    {{ csrf_field() }}
                    <div class="col-sm-offset-2 col-sm-8">
                        <div class="row">
                            <br>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cm_file_id" > FIle No</label>
                                    <div class="col-sm-9">
                                    {{ Form::select('cm_file_id', $fileList, null, ['placeholder'=>'Please Select File No.','id'=>'cm_file_id','class'=> 'form-control col-xs-10 cm_file_id', 'data-validation' => 'required']) }}
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="fileno">Re Enter<span style="color: red">&#42;</span> </label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Enter" id="fileno" class="col-xs-12" data-validation="required" />
                                        <span id="alert"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="close_date">Close Date<span style="color: red">&#42;</span> </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="close_date" name="close_date" placeholder="Enter Code" class="col-xs-12 datepicker" data-validation="required" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="remarks">Remarks<span style="color: red">&#42;</span> </label>

                                    <div class="col-sm-9">
                                        <textarea name="remarks" id="remarks" class="form-control" rows="10" data-validation="required length" data-validation-length="0-145"> </textarea>
                                    </div>
                                </div>
                            </div>
                        
                
                            <div class="col-sm-12" id="buttonSection">
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Save
                                        </button>
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>                
                <!-- /.col -->
            </div>
        </div>
        <!-- /.page-content -->
    </div>
</div>
@push('js')
    <script type="text/javascript">
        $("#cm_file_id").on('change', function(e) {
            var fileID = $(this).val();
            $("#fileno").val('');
            $.ajax({
                url: '{{ url('commercial/export/elcFileClose_checkExist') }}',
                type: 'post',
                datatype: 'json',
                data: {'file_id': fileID},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    if(res.status) {
                        $('#buttonSection').hide();
                        var html = '<div class="alert alert-danger alert-dismissible" role="alert">';
                        html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        html += '<span aria-hidden="true">&times;</span></button>File already closed.';
                        html += '</div>';
                        $('#selectOne').html(html);
                    } else {
                        $('#buttonSection').show();
                        $('#selectOne').html('');
                    }
                }
            })
        });
        $("#fileno").on('change', function(e) {
            var fileno1 = $("#cm_file_id").find('option:selected').text();
            var fileno2 = $("#fileno").val();
            if (fileno1 != fileno2) {
                $('#buttonSection').hide();
                var html = '<div class="alert alert-danger alert-dismissible" role="alert">';
                html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                html += '<span aria-hidden="true">&times;</span></button>File number dose not match.';
                html += '</div>';
                $('#selectOne').html(html);
            } else {
                $('#buttonSection').show();
                $('#selectOne').html('');
            }
        });
    
    </script>
@endpush
@endsection