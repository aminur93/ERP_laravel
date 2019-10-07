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
                    <a href="#">Ess</a>
                </li>
                <li class="active">Loan Application</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Ess<small> <i class="ace-icon fa fa-angle-double-right"></i> Loan Application</small></h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- Display Erro/Success Message -->
                    @include('inc/message')

                    {{ Form::open(['url'=>'hr/ess/loan_application', 'class'=>'form-horizontal']) }}

                        <input type="hidden" name="hr_la_name"/>
                        <input type="hidden" name="hr_la_designation"/>
                        <input type="hidden" name="hr_la_date_of_join"/> 
 
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_type_of_loan">Type of Loan<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select name="hr_la_type_of_loan" id="hr_la_type_of_loan" class="col-xs-10 col-sm-5"  data-validation="required" data-validation-error-msg="The Type of Loan Request field is required"  >
                                    <option value="">Select Type of Loan</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->hr_loan_type_name }}">{{ $type->hr_loan_type_name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_applied_amount"> Applied Amount<span style="color: red">&#42;</span>  </label>
                            <div class="col-sm-9">
                                <input name="hr_la_applied_amount" type="text" id="hr_la_applied_amount" placeholder="Applied Amount" class="col-xs-10 col-sm-5" data-validation="number required length" data-validation-length="1-11" data-validation-error-msg="The Applied Amount has to be a numeric value between 1-11 numbers" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_no_of_installments"> No. of Installments (for payment)<span style="color: red">&#42;</span>  </label>
                            <div class="col-sm-9">
                                <input name="hr_la_no_of_installments" type="text" id="hr_la_no_of_installments" placeholder="No. of Installments (for payment)" class="col-xs-10 col-sm-5" data-validation="number required length" data-validation-length="1-11" data-validation-error-msg="The Amount Applied For has to be a numeric value between 1-11 numbers" />
                            </div>
                        </div>

                        <input type="hidden" name="hr_la_applied_date" id="hr_la_applied_date" value="<?php echo date('Y-m-d'); ?>" class="col-xs-10 col-sm-5 " data-validation="required"/>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="gender"> Purpose of Loan<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                <div class="control-group"> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Education" class="ace" data-validation="checkbox_group" data-validation-qty="min1">
                                            <span class="lbl"> Education</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Children's education" class="ace">
                                            <span class="lbl"> Children's education</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Holidays/Travel" class="ace">
                                            <span class="lbl"> Holidays/Travel</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Medical expenses" class="ace">
                                            <span class="lbl"> Medical expenses</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Investments" class="ace">
                                            <span class="lbl"> Investments</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Consumer durable purchase" class="ace">
                                            <span class="lbl"> Consumer durable purchase</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Marriage in family" class="ace">
                                            <span class="lbl"> Marriage in family</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Home improvement/Renovation of home or office" class="ace">
                                            <span class="lbl"> Home improvement/Renovation of home or office</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Loan transfer" class="ace">
                                            <span class="lbl"> Loan transfer</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" type="checkbox" value="Purchase of equipment" class="ace">
                                            <span class="lbl"> Purchase of equipment</span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="hr_la_purpose_of_loan[]" id="otherBox" type="checkbox" value="Other" class="ace">
                                            <span class="lbl"> Others.....</span>
                                        </label>
                                    </div> 
                                </div> 
                            </div>
                        </div>


                        <div class="form-group" style="display:none;" id="hiddenNote">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_la_note"></label>
                            <div class="col-sm-9">
                                <textarea name="hr_la_note" id="hr_la_note" class="col-xs-10 col-sm-5" placeholder="Other details"  data-validation="required length" data-validation-length="2-1024" data-validation-allowing=" -" data-validation-error-msg="The Note has to be an alphanumeric value between 2-1024 characters"></textarea>
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


                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <table class="table table-info">
                                    <thead>
                                        <tr>
                                            <th>Types of Loan</th>
                                            <th>Amount</th>
                                            <th>Due</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loanHistory"> 
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    {{ Form::close() }}

                    <!-- /.row --> 
                    <hr />

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>


 
<script type="text/javascript">
$(document).ready(function()
{ 
$('#otherBox').removeAttr('checked');
    $('#otherBox').on('click', function(){
        if(this.checked){
            $('#hiddenNote').toggle();
        }
        else{
            $('#hiddenNote').toggle();
        }
    });

 
    // retrive all information 
    var associate_id = '{{ auth()->user()->associate_id }}';
    var name         = $("input[name=hr_la_name]");
    var designation  = $("input[name=hr_la_designation]");
    var date_of_join = $("input[name=hr_la_date_of_join]");
    $(window).load( function(){
        $.ajax({
            url: '{{ url("hr/ess/loan_history") }}',
            dataType: 'json',
            data: {associate_id: associate_id},
            success: function(data)
            {
                name.val(data.associate.as_name);
                designation.val(data.associate.hr_designation_name);
                date_of_join.val(data.associate.as_doj);

                var html = "";
                $.each(data.loan, function(i, v)
                {
                    html += "<tr>"+
                        "<td>"+v.hr_la_type_of_loan+"</td>"+
                        "<td>"+(v.hr_la_applied_amount).toFixed(2)+"</td>"+
                        "<td>0.00</td>"+
                        "<td>"+v.hr_la_updated_at+"</td>"+
                        "<td>"+v.hr_la_status+"</td>"+
                    "</tr>";
                });
                $("#loanHistory").html(html);

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