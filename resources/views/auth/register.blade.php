@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Human Resource </a>
                </li> 
                <li>
                    <a href="#"> User </a>
                </li>
                <li class="active"> Registration </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>User <small><i class="ace-icon fa fa-angle-double-right"></i> Registration </small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <!-- PAGE CONTENT BEGINS -->
                <div class="col-sm-12">
                <form class="form-horizontal" role="form" method="post" action="{{ route('register')  }}">
                {{ csrf_field() }} 

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="name" > Name </label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" placeholder="Name" class="col-xs-12 col-sm-5" data-validation="required length custom" value="{{ old('name') }}" data-validation-length="1-128" data-validation-regexp="^([a-z A-Z]+)$"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="associate_id"> Associate's ID </label>
                        <div class="col-sm-9"> 
                            {{ Form::select('associate_id', [], null, ['placeholder'=>'Select Associate\'s ID', 'id'=>'associate_id', 'class'=> 'associates no-select col-xs-10 col-sm-5', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Associate\'s ID field is required']) }}  
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="email" > Email </label>
                        <div class="col-sm-9">
                            <input type="text" id="email" name="email" placeholder="Email Address"  value="{{ old('email') }}" class="col-xs-12 col-sm-5" data-validation="required email"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="password" > Password </label>
                        <div class="col-sm-9">
                            <input type="password" id="password" name="password" placeholder="Password"  value="{{ old('password') }}" class="col-xs-12 col-sm-5" data-validation-length="min6" data-validation="required length"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="password_confirmation" >Confirm Password </label>
                        <div class="col-sm-9">
                            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" class="col-xs-12 col-sm-5" data-validation-length="min6" data-validation="required length"/>
                        </div>
                    </div> 

                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9"> 
                            <button class="btn btn-info" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i> Submit
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                            </button>
                        </div>
                    </div>

                    <!-- /.row --> 
                </form> 
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  
    $('select.associates').select2({
        placeholder: 'Select Associate\'s ID',
        ajax: {
            url: '{{ url("hr/associate-search") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { 
                    keyword: params.term
                }; 
            },
            processResults: function (data) { 
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.associate_name,
                            id: item.associate_id
                        }
                    }) 
                };
          },
          cache: true
        }
    }); 
});
</script>
@endsection