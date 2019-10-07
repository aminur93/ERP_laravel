@extends('merch.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li> 
                <li>
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Brand </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
       
            
          <!---Form 2---------------------->
            <div class="row">

                <div class="page-header"> 
                    
                     <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Brand</small></h1>
                </div>
                  <!-- Display Error/Success Message -->
                @include('inc/message')
                <div class="col-sm-5">
                    <h5 class="page-header">Add Brand</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action=" {{ url('merch/setup/brandstore') }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_buyer_name2" > Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                             
                              
                                   {{ Form::select('march_buyer_name2', $buyers, null, ['placeholder'=>'Select Buyer', 'id'=> 'march_buyer_name2','class'=> 'col-xs-12','data-validation' => 'required']) }}

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_brand_name2" > Brand Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="march_brand_name2" name="march_brand_name2" placeholder="Brand Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_buyer_short_name2" > Brand Short Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="march_brand_short_name2" name="march_brand_short_name2" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>                 
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="action_type" > Country<span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               {{ Form::select('country', $country, null, ['placeholder'=>'Select Country','class'=> 'col-xs-12', 'data-validation' => 'required']) }} 
                            </div>
                        </div>
                    <div id="contactPersonData2"> 
                      <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_brand_contact" > Contact Person <span style="color: red">&#42;</span>(<span style="font-size: 9px">Name, Cell No, Email</span>)</label>
                            <div class="col-sm-9">
                                
                              <textarea name="march_brand_contact[]" class="col-sm-9" data-validation="required length" data-validation-length="0-128"></textarea>
                            <!--  <a href=""><h5>+ Add More</h5></a>-->
                               <div class="form-group col-xs-3 col-sm-3">
                                    <button type="button" class="btn btn-xs btn-success AddBtn2">+</button>
                                    <button type="button" class="btn btn-xs btn-danger RemoveBtn2">-</button>
                                </div>        
                            </div>
                 
                        </div>   
                    </div>    
                 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> ADD
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>                   
                    </form> 
                </div>     
                <!-- /.col -->
                <div class="col-sm-7">
                    <h5 class="page-header">Brand List</h5>
                    <table id="dataTables_brand" class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th>Buyer Name</th>
                                <th>Brand Name</th>
                                <th>Brand Short Name</th>
                                <th>Country</th>                      
                                <th>Contact Person</th>             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                    <td>{{ $brand->b_name }}</td>
                                    <td>{{ $brand->br_name }}</td>
                                    <td>{{ $brand->br_shortname }}</td>
                                    <td>{{ $brand->br_country}}</td>
                                    <td>{!! $brand->contact_person !!}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/brandupdate/'.$brand->br_id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/brand_delete/'.$brand->br_id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Brand?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                    </div>
                                   </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--- /. Row ---->
            
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 


//Add More2     
        var data2 = $("#contactPersonData2").html();
        $('body').on('click', '.AddBtn2', function(){
            $("#contactPersonData2").append(data2);
        });

        $('body').on('click', '.RemoveBtn2', function(){
            $(this).parent().parent().parent().remove();
        });


///Data TAble Brand///
     $('#dataTables_brand').DataTable();
});
</script>
@endsection