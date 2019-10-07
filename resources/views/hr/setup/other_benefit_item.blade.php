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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Other Benefit Item </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Other Benefit Item </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-7">
                    <!-- PAGE CONTENT BEGINS --> 
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/setup/other_benefit_item')  }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div id="addRemove">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="benefit_name" > Benefit Item Name<span style="color: red">&#42;</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" name="benefit_name[]" id="benefit_name" placeholder="Benefit Item Name" class="col-xs-10" value="{{old('benefit_name')}}" data-validation="required length" data-validation-length="1-128"/>
                                    <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                    <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button> 
                                </div>
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
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
                <div class="col-sm-5">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Other Benefit Item Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $i=1; ?>
                            @foreach($benefit_list AS $benef)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $benef->benefit_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a type="button" href="{{ url('hr/setup/other_benefit_delete/'.$benef->id) }}" class='btn btn-xs btn-danger' title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

    $('#dataTables').DataTable({
        pagingType: "full_numbers" ,
        // searching: false,
        // "lengthChange": false,
        // 'sDom': 't' 
        "sDom": '<"F"tp>'

    }); 

    var data= '<div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="benefit_name" > Benefit Item Name<span style="color: red">&#42;</span> </label> <div class="col-sm-9"><input type="text" name="benefit_name[]" id="benefit_name" placeholder="Benefit Item Name" class="col-xs-10" value="{{old("benefit_name")}}" data-validation="required length" data-validation-length="1-128"/><button type="button" class="btn btn-sm btn-success AddBtn">+</button><button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button></div></div>';

    $('body').on('click', '.AddBtn', function(){
        $("#addRemove").append(data);
    });

    $('body').on('click', '.RemoveBtn', function(){
        $(this).parent().parent().remove();

    });
});
</script>
@endsection