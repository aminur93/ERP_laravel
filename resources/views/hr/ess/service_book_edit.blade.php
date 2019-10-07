@extends('hr.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Human Resource</a>
				</li>
				<li>
					<a href="#">Operation</a>
				</li>
				<li class="active"> Service Book Update</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content"> 
            <div class="page-header">
				<h1>Operation<small><i class="ace-icon fa fa-angle-double-right"></i> Service Book Update</small></h1>
            </div>

            <div class="row">
                 @include('inc/message')
                <div class="col-xs-12">
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/operation/servicebookupdate') }}" enctype="multipart/form-data"> 

                         {{ csrf_field() }} 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="job_app_id"> Associate's ID :<span style="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                                {{ Form::select('associate_id', [Request::get('associate_id') => Request::get('associate_id')], Request::get('associate_id'),['placeholder'=>'Select Associate\'s ID', 'data-validation'=> 'required', 'id'=>'job_app_id',  'class'=> 'associates no-select col-xs-10 col-sm-5']) }} 
                                
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page1">Page 1 :<span style="color: red">&#42;</span><br/> (pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page1" data-validation="mime size required" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;" > 
                          </div><br/>
                           <img class="preview" src="{{ url($sbook->page1_url) }}" alt="Color image" style="margin-right: 10px" width="80" />
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page2">Page 2 : <br/>(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page2" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;"> 
                          </div>
                          <br/>
                         
                          @if ($sbook->page2_url)
                            <img class="preview" src="{{ url($sbook->page2_url)}}" alt="Color image" style="margin-right: 10px" width="80" />
                         @endif
                         
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page3">Page 3 : <br/>(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page3" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;"> 
                          </div>
                          <br/>
                         
                          @if ($sbook->page3_url)
                            <img class="preview" src="{{ url($sbook->page3_url)}}" alt="Color image" style="margin-right: 10px" width="80" />
                         @endif
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page4">Page 4 :<br/> (pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page4" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;"> 
                          </div>
                          <br/>
                         
                          @if ($sbook->page4_url)
                            <img class="preview" src="{{ url($sbook->page4_url)}}" alt="Color image" style="margin-right: 10px" width="80" />
                         @endif
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page5">Page 5 :<br/> (pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page5" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;"> 
                          </div>
                          <br/>
                         
                          @if ($sbook->page5_url)
                            <img class="preview" src="{{ url($sbook->page5_url)}}" alt="Color image" style="margin-right: 10px" width="80" />
                         @endif
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page6">Page 6 :<br/> (pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page6" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;"> 
                          </div>
                          <br/>
                         
                          @if ($sbook->page6_url)
                            <img class="preview" src="{{ url($sbook->page6_url)}}" alt="Color image" style="margin-right: 10px" width="80" />
                            <a href="{{ url($sbook->page6_url) }}" class="btn btn-xs btn-primary" target="_blank" title="View"><i class="fa fa-eye"></i> </a>
                            <a href="{{ url($sbook->page6_url) }}" class="btn btn-xs btn-success" target="_blank" download title="Download"><i class="fa fa-download"></i> </a>

                         @endif
                        </div>
 
                       <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="page7">Page 7 :<br/> (pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </label>
                          <div class="col-sm-3"><br/>
                                <input type="file" class="form-control" name="page7" data-validation="mime size" data-validation-allowing="docx,doc,pdf,jpeg,png,jpg" data-validation-max-size="512kb"
                                data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload docx, doc, pdf, jpeg, jpg or png type file" style="border: 0px;"> 
                          </div><br/>
                         
                          @if ($sbook->page7_url)
                            <img class="preview" src="{{ url($sbook->page7_url)}}" alt="Color image" style="margin-right: 10px" width="80" />
                         @endif
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                              <input type="text" name="serviceid" value="{{ $sbook->hr_s_book_id}}">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Add
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
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
        // retrive all information  
        

        $('select.associates').select2({
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