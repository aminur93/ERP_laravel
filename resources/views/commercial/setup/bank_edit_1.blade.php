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
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Bank  </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Bank Update</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Update Bank</h5>
                    <!-- PAGE CONTENT BEGINS --> 
                    {{ Form::open(["url"=>"commercial/setup/bank_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_name" >Bank Name<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="bank_name" id="bank_name" value="{{ $bank->bank_name}}"placeholder="Enter Bank Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-43"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_short_code" >Short Code<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="bank_short_code" value="{{ $bank->short_code}}" id="bank_short_code" placeholder="Enter Bank Short Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-59"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>  

                        <div class="form-group">

                                  <label class="col-sm-3 control-label no-padding-right align-left" for="bank_swift_code">Bank Swift Code<span style="color: red">&#42;</span></label>

                                  <div class="col-sm-9">
                                    <input type="text" name="bank_swift_code" id="bank_swift_code" value="{{$bank->swift_code}}" placeholder="Enter Swift Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-59" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                        </div>
                    
                      <div id="accno">
                        @if(!empty($bankacc2)) 
                         @foreach($bankacc as $bnac) 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="acc_no" >Account No<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="acc_no[]" value="{{$bnac->account_no}}" id="acc_no" placeholder="Enter Account Number" class="col-xs-9" data-validation="required length custom" data-validation-length="1-59"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                            <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_bnk">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_bnk">-</button> 
                              </div>   
                          </div>
                        </div>
                        @endforeach

                        @else 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="acc_no" >Account No<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                            <input type="text" name="acc_no[]"
                             id="acc_no" placeholder="Enter Account Number" class="col-xs-9" data-validation="required length custom" data-validation-length="1-59"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                            <div class="form-group col-xs-3 col-sm-3">
                                     <button type="button" class="btn btn-sm btn-success AddBtn_bnk">+</button>
                                     <button type="button" class="btn btn-sm btn-danger RemoveBtn_bnk">-</button> 
                              </div>   
                          </div>
                        </div>
                       @endif 


                     </div> 
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_address1" >Address 1<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                              <textarea name="bank_address1" class="form-control" id="bank_address1" data-validation="required length" data-validation-length="0-255">{{ $bank->address_1 }} 
                              </textarea>
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_address2" >Address 2<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                              <textarea name="bank_address2" class="form-control" id="bank_address2" data-validation="required length" data-validation-length="0-255">{{ $bank->address_2 }}
                               </textarea>
                          </div>
                        </div> 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                               <input type="hidden" name="bnk_id" value="{{ $bank->id }}">  
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
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
        
          
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){  
  
//Add More1
 
        var data= '<div class="form-group">\
                    <label class="col-sm-3 control-label no-padding-right align-left" for="march_buyer_contact">Account No<span style="color: red">&#42;</span> </label>\
                    <div class="col-sm-9">\
                      <input type="text" name="acc_no[]"\
                             id="acc_no" placeholder="Enter Account Number" class="col-xs-9" data-validation="required length custom" data-validation-length="1-43"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>\
                        <div class="form-group col-xs-3">\
                            <button type="button" class="btn btn-sm btn-success AddBtn_bnk">+</button>\
                            <button type="button" class="btn btn-sm btn-danger RemoveBtn_bnk">-</button>\
                        </div>\
                    </div>\
                </div>';
        $('body').on('click', '.AddBtn_bnk', function(){
            $("#accno").append(data);
        });

        $('body').on('click', '.RemoveBtn_bnk', function(){
            $(this).parent().parent().parent().remove();
        });
        
});
</script>
@endsection