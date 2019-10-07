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
                <li class="active"> Brand Info Edit </li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Brand Info Edit </small></h1>
            </div>
          <!---Form 1---------------------->
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-md-offset-2">
                    <h5 class="page-header">Brand Info Edit</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action=" {{ url('merch/setup/brandUpdateAction') }}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_buyer_name2" > Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                             
                                {{ Form::select('march_buyer_name2', $buyer_name, $brand->b_id, ['placeholder'=>'Select Buyer', 'class'=> 'col-xs-12 filter', 'data-validation' => 'required']) }} 
                            </div>
                        </div>

                           <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_brand_name2" > Brand Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="march_brand_name2" name="march_brand_name2" value="{{ $brand->br_name}}" placeholder="Brand Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_buyer_short_name2" > Brand Short Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="march_brand_short_name2" name="march_brand_short_name2" value="{{ $brand->br_shortname}}"  placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>                   

                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="action_type" > Country<span style="color: red">&#42;</span> </label>

                            <div class="col-sm-9">
                               {{ Form::select('country', $country, $brand->br_country, ['placeholder'=>'Select Country','class'=> 'col-xs-12', 'data-validation' => 'required']) }} 
                            </div>
                        </div>
                    <div class="contactPersonData2">
                     @foreach($brand_contact as $contact) 
                      <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="march_brand_contact" > Contact Person <span style="color: red">&#42;</span>(<span style="font-size: 9px">Name, Cell No, Email</span>)</label>
                            <div class="col-sm-9">
                                
                              <textarea name="march_brand_contact[]" class="col-sm-9" data-validation="required length" data-validation-length="0-128"> {{ $contact->brcontact_person }}</textarea>
                           
                             <div class="form-group col-xs-3 col-sm-3">
                                   <button type="button" class="btn btn-sm btn-success AddBtn2">+</button>
                                <button type="button" class="btn btn-sm btn-danger RemoveBtn2">-</button>
                                </div>        
                            </div>
                 
                        </div>   
                    @endforeach
                    </div>    
                   
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>

                                {{Form::hidden('brand_id', $value=$brand->br_id)}}
                            </div>
                        </div>

                   
                    </form> 
                   
                </div>     
               
            </div><!--- /. Row ---->            
         
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
       var data= '<div class="form-group">\
                    <label class="col-sm-3 control-label no-padding-right" for="scp_details"> Contact Person <span style="color: red">&#42;</span> </label>\
                    <div class="col-sm-9">\
                        <textarea name="march_brand_contact[]" id="march_brand_contact" class="col-xs-9" placeholder="Contact Person"  data-validation="required length" data-validation-length="0-128"></textarea>\
                        <div class="form-group col-xs-3">\
                            <button type="button" class="btn btn-sm btn-success AddBtn2">+</button>\
                            <button type="button" class="btn btn-sm btn-danger RemoveBtn2">-</button>\
                        </div>\
                    </div>\
                </div>';
        $('body').on('click', '.AddBtn2', function(){
            $('.contactPersonData2').append(data);
        });

        $('body').on('click', '.RemoveBtn2', function(){
            $(this).parent().parent().parent().remove();
        });
 


});
</script>
@endsection