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
                    <a href="#">Payroll</a>
                </li> 
                <li class="active">Loan Approval</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Payroll <small> <i class="ace-icon fa fa-angle-double-right"></i> Loan Approval</small></h1>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/ess/loan_status', 'class'=>'form-horizontal']) }}
                    
                        {{ Form::hidden('hr_la_id', $loan->hr_la_id) }}
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_as_id"> Associate's ID </label>
                            <div class="col-sm-9">
                                <input name="hr_la_as_id" type="text" id="hr_la_as_id" placeholder="Associate's Name" class="col-xs-12" value="{{ $loan->hr_la_as_id }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_name"> Associate's Name </label>
                            <div class="col-sm-9">
                                <input name="hr_la_name" type="text" id="hr_la_name" placeholder="Associate's Name" class="col-xs-12" value="{{ $loan->hr_la_name }}" data-validation="required length custom" data-validation-regexp="^([a-z A-Z]+)$"  data-validation-length="3-64" data-validation-error-msg="The Associate's Name has to be an alphabet value between 3-64 characters" readonly/>
                            </div>
                        </div> 


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_designation"> Designation </label>
                            <div class="col-sm-9">
                               <input type="text" name="hr_la_designation" id="hr_la_designation" placeholder="Designation" class="col-xs-12" value="{{ $loan->hr_la_designation }}" data-validation="custom length required" data-validation-regexp="^([a-zA-z ]+)$" data-validation-length="1-64" data-validation-error-msg="Designation required between 1-64 characters" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_date_of_join"> Date of Joining </label>
                            <div class="col-sm-9">
                                <input type="text" name="hr_la_date_of_join" id="hr_la_date_of_join" placeholder="Date of Joining" class="col-xs-12 datepicker" value="{{ $loan->hr_la_date_of_join }}" data-validation="required" data-validation-format="yyyy-mm-dd" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_type_of_loan"> Types of Loan </label>
                            <div class="col-sm-9">
                                <input name="hr_la_type_of_loan" type="text" id="hr_la_type_of_loan" class="col-xs-12" value="{{ $loan->hr_la_type_of_loan }}" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_applied_amount"> Applied Amount  </label>
                            <div class="col-sm-9">
                                <input name="hr_la_applied_amount" type="text" id="hr_la_applied_amount" placeholder="Applied Amount" class="col-xs-12" value="{{ $loan->hr_la_applied_amount }}" data-validation="number required length" data-validation-length="1-11" data-validation-error-msg="The Applied Amount has to be a numeric value between 1-11 numbers" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_approved_amount"> Approved Amount  </label>
                            <div class="col-sm-9">
                                <input name="hr_la_approved_amount" type="text" id="hr_la_approved_amount" placeholder="Approved Amount" class="col-xs-12" value="{{ $loan->hr_la_applied_amount }}" data-validation="number required length" data-validation-length="1-11" data-validation-error-msg="The Approved Amount has to be a numeric value between 1-11 numbers" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_no_of_installments_approved"> No. of Installments (for payment)  </label>
                            <div class="col-sm-9">
                                <input name="hr_la_no_of_installments_approved" type="text" id="hr_la_no_of_installments_approved" placeholder="No. of Installments (for payment)" class="col-xs-12" value="{{ $loan->hr_la_no_of_installments }}" data-validation="number required length" data-validation-length="1-11" data-validation-error-msg="The Amount Applied For has to be a numeric value between 1-11 numbers" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_purpose_of_loan"> Purpose of Loan </label>
                            <div class="col-sm-9">
                                <input name="hr_la_purpose_of_loan" type="text" id="hr_la_purpose_of_loan" class="col-xs-12" value="{{ $loan->hr_la_purpose_of_loan }}" readonly />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="    hr_la_supervisors_comment"> Comment </label>
                            <div class="col-sm-9">
                                <textarea name="hr_la_supervisors_comment" id=" hr_la_supervisors_comment" class="col-xs-12" placeholder="Write your comment here" data-validation="required length" data-validation-length="2-1024" data-validation-allowing=" -" data-validation-error-msg="The Note has to be an alphanumeric value between 2-1024 characters">{{ $loan->hr_la_supervisors_comment }}</textarea>
                            </div>
                        </div>   

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status"> Loan Status </label>
                            <div class="col-sm-9">
                                <input type="text" id="status" class="col-xs-12" value="{{ $loan->status }}" readonly />
                            </div>
                        </div>

 
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                @if($loan->hr_la_status == 0)
                                <button name="approve" class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Approve
                                </button>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <button name="reject" class="btn btn-danger" type="submit">
                                    <i class="ace-icon fa fa-ban bigger-110"></i> Reject 
                                </button>
                                @else
                                <a href="{{ url()->previous() }}" class="btn btn-success">
                                    <i class="ace-icon fa fa-arrow-left bigger-110"></i> Back 
                                </a>
                                @endif
                            </div>
                        </div>
 
                    {{ Form::close() }}

                    <!-- /.row --> 
                    <hr />

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->


                <div class="col-sm-6">
                    <table class="table table-borderd table-compact">
                        <thead>
                            <tr>
                                <th>Types of Loan</th>
                                <th>Amount</th>
                                <th>Due</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $data)
                            <tr>
                                <td>{{ $data->hr_la_type_of_loan }}</td>
                                <td>{{ $data->hr_la_approved_amount }}</td>
                                <td>0.00</td>
                                <td>{{ $data->hr_la_updated_at }}</td>
                                <td>{{ $data->hr_la_status }}</td>
                            </tr>
                        @endforeach 
                        </tbody> 
                    </table>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>


 
<script type="text/javascript">
$(document).ready(function()
{   
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
 



    // retrive all information 
    var name         = $("input[name=hr_la_name]");
    var designation  = $("input[name=hr_la_designation]");
    var date_of_join = $("input[name=hr_la_date_of_join]");
    $('body').on('change', '.associates', function(){
        $.ajax({
            url: '{{ url("hr/associate") }}',
            dataType: 'json',
            data: {associate_id: $(this).val()},
            success: function(data)
            {
                name.val(data.as_name);
                designation.val(data.hr_designation_name);
                date_of_join.val(data.as_doj);
            },
            error: function(xhr)
            {
                alert('failed...');
            }
        });
    });

});
</script>
@endsection