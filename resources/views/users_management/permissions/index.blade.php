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
                <li class="active">Permissions </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>User Management<small> <i class="ace-icon fa fa-angle-double-right"></i> Permissions  </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-12">
                        <div class="well col-sm-12">
                        <h3  class="col-sm-12">{{ $title }}</h3>
                        <div class="col-sm-6"> 
                            {!! Form::open(['url'=>'users_management/permissions/store']) !!} 
                            {{ Form::hidden('id', (!empty($permission->id)?$permission->id:old('id'))) }}

                            <div class="input-group">
                                <input type="text" id="name" name="name" placeholder="Permission Name" class="form-control" data-validation="required length custom" value="{{ (!empty($permission->name)?$permission->name:old('name')) }}" data-validation-length="1-128" data-validation-regexp="^([a-zA-Z0-9_]+)$" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-sm" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i> {{ $button }}
                                    </button>
                                </span>
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
                                <th>Permission Name</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($permissions) > 0)
                                @foreach ($permissions as $permission)
                                    <tr data-entry-id="{{ $permission->id }}">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ url('users_management/permissions?id='. $permission->id) }}" class="btn btn-xs btn-info">Edit</a>
                                            <a href="{{ url('users_management/permissions/delete/'. $permission->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger">Delete</a> 
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
