@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">User Management</a>
                </li>  
                <li class="active">Edit User</li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>User Management<small> <i class="ace-icon fa fa-angle-double-right"></i> Edit User </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12"> 
                    {!! Form::open(['url'=>['users_management/user/edit', $user->id], 'class'=>'form-horizontal']) !!}

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="associate_id"> Associate's ID </label>
                        <div class="col-sm-9"> 
                            <input type="text" id="associate_id" name="associate_id" placeholder="Name" class="associates col-xs-12 col-sm-5" data-validation="required" value="{{ $user->associate_id }}" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="name" > Name </label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" placeholder="Name" class="col-xs-12 col-sm-5" data-validation="required length custom" value="{{ old('name')?old('name'):$user->name }}" data-validation-length="1-128" data-validation-regexp="^([a-z A-Z]+)$"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="email" > Email </label>
                        <div class="col-sm-9">
                            <input type="text" id="email" name="email" placeholder="Email Address"  value="{{ old('email')?old('email'):$user->email }}" class="col-xs-12 col-sm-5" data-validation="required email"/>
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

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="roles" >Unit Permission </label>
                        <div class="col-sm-9"> 
                            <?php
                            $userUnitArray = explode(",", $user->unit_permissions);
                            foreach($units as $unit)
                            {
                                $checked = (in_array($unit->hr_unit_id, $userUnitArray)?"checked":"");
                               
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input name="unit_permissions[]" class="ace ace-checkbox-2" type="checkbox" value="{{ $unit->hr_unit_id }}" data-validation="checkbox_group" data-validation-qty="min1" {{$checked}}>
                                    <span class="lbl"> {{ $unit->hr_unit_name }}</span>
                                </label>
                            </div> 
                            <?php
                            }
                            ?>
                        </div>
                    </div> 
               
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="roles" >Buyer Permission </label>
                        <div class="col-sm-9"> 
                                 <?php
                            $userbuyerArray = explode(",", $user->buyer_permissions);
                            foreach($buyerList as $buyer)
                            {
                                $checked_b = (in_array($buyer->b_id, $userbuyerArray)?"checked":"");
                               
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input name="buyer_permissions[]" class="ace" type="checkbox" value="{{ $buyer->b_id }}" {{$checked_b}}>
                                    <span class="lbl">{{ $buyer->b_name }}</span>
                                </label>
                            </div> 
                             <?php
                            }
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="roles" >Roles </label>
                        <div class="col-sm-9">
                             {!! Form::select('roles[]', $roles, old('roles') ? old('roles') : $user->roles()->pluck('name', 'name'), ['class' => 'select2 col-xs-12 col-sm-5', 'multiple' => 'multiple', 'data-validation' => 'required']) !!}
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

                    {!! Form::close() !!}
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>  
<script type="text/javascript">
$(document).ready(function(){  
    // retrive all information 
    $(window).on('load', function(){
        loadUnits($('.associates').val());
    });
 
    function loadUnits(associate_id)
    { 
        $.ajax({
            url: '{{ url("hr/associate") }}',
            dataType: 'json',
            data: {associate_id},
            success: function(data)
            {
                $("input[type=checkbox]").each(function(i, v){
                    if (data.hr_unit_id == $(this).val())
                    {  
                        $(this).parent().find(".lbl").html(" "+data.hr_unit_name+" (own)");
                    }
                }); 
            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
    }

});
</script>
@endsection