@inject('request', 'Illuminate\Http\Request')
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
                <li class="active">Roles </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>User Management<small> <i class="ace-icon fa fa-angle-double-right"></i> Roles  </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                        <div class="well col-sm-12">
                        <h3  class="col-sm-12">{{ $title }}</h3>
                        <div class="col-sm-6"> 
                            {!! Form::open(['url'=>'users_management/roles/store']) !!} 
                            {{ Form::hidden('id', (!empty($roles->id)?$roles->id:old('id'))) }}

                            <div class="form-group">
                                <label for="name">Role </label>
                                <input type="text" id="name" name="name" placeholder="Role Name" class="form-control" data-validation="required length custom" value="{{ (!empty($role->name)?$role->name:old('name'))}}" data-validation-length="1-128" data-validation-regexp="^([a-zA-Z0-9_]+)$" /> 
                            </div>   
 
                            <div class="form-group">
                                <label for="permission">Permissions</label>
                                {!! Form::select('permission[]', $permissions, ((count((array)$role)>0)? $role->permissions()->pluck('name','name'):old('permission')), ['class' => 'form-control select2', 'multiple' => 'multiple', 'style'=>'height:22px', 'data-validation'=>'required']) !!} 
                            </div> 
                            <div class="form-group">
                                <button class="btn btn-info btn-sm" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> {{ $button }}
                                </button>
                            </div> 
                            {!! Form::close() !!}
                        </div>
                        <div class="col-sm-12">
                            <p class="help-block text-success">
                                Only letters (a-z), digits (0-9) and underscores (_) are allowed
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <table class="datatable table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Role</th> 
                                <th>Permissions</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                    <tr data-entry-id="{{ $role->id }}">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions()->pluck('name') as $permission)
                                                <span class="label label-info label-many" style="margin:1px 0">{{ $permission }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url('users_management/roles?id='.$role->id) }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url('users_management/roles/delete',[$role->id]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a> 
                                        </td>
                                    </tr>
                                @endforeach 
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>  
@endsection
