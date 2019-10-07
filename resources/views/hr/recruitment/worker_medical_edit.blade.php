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
                    <a href="#">Recruitment </a>
                </li>
                <li>
                    <a href="#">Worker </a>
                </li>
                <li class="active"> Medical Information</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment <small> <i class="ace-icon fa fa-angle-double-right"></i> Worker <i class="ace-icon fa fa-angle-double-right"></i> Medical Information</small></h1>
            </div>

            <div class="row">

                <!-- Display Erro/Success Message -->
                @include('inc/message')


                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    </br>

                    {{ Form::open(['url'=>'hr/recruitment/worker/medical', 'class'=>'form-horizontal', 'files'=>'true']) }}


                    <input type="hidden" name="worker_id" value="{{ (!empty($employee->worker_id)?$employee->worker_id:null) }}">

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_name"> Associate's Name </label>
                        <div class="col-sm-9"> 
                            <input type="text" name="worker_name" id="worker_name" class="col-xs-10" value="{{ (!empty($employee->worker_name)?$employee->worker_name:null) }}" readonly /> 
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_doj"> Date of Joining </label>
                        <div class="col-sm-9">
                            <input type="date" name="worker_doj" id="worker_doj" placeholder="Date of Joining" class="col-xs-10" value="{{ (!empty($employee->worker_doj)?$employee->worker_doj:null) }}" readonly/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_height"> Height<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <input type="text" id="worker_height" name="worker_height" data-validation="required length" data-validation-length="1-50" data-validation-regexp="^([$/.,-;:'& a-zA-Z0-9]+)$" placeholder="Height in Inch" class="col-xs-10" value="{{ (!empty($employee->worker_height)?$employee->worker_height:null) }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_weight"> Weight<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <input type="text" id="worker_weight" name="worker_weight" placeholder="Weight in Kg" class="col-xs-10" data-validation="required length" data-validation-length="1-50" data-validation-regexp="^([$/.,-;:'& a-zA-Z0-9]+)$" value="{{ (!empty($employee->worker_weight)?$employee->worker_weight:null) }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_tooth_structure"> Tooth Structure </label>
                        <div class="col-sm-9">
                            <input type="text" id="worker_tooth_structure" name="worker_tooth_structure" placeholder="Tooth Structure" class="col-xs-10" data-validation="length" data-validation-length="0-124" value="{{ (!empty($employee->worker_tooth_structure)?$employee->worker_tooth_structure:'N/A') }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_blood_group"> Blood Group<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            {{ Form::select(
                                "worker_blood_group", 
                                [
                                    "A+"=>"A+",
                                    "A-"=>"A-",
                                    "B+"=>"B+",
                                    "B-"=>"B-",
                                    "O+"=>"O+",
                                    "O-"=>"O-",
                                    "AB+"=>"AB+",
                                    "AB-"=>"AB-"
                                ], 
                                (!empty($employee->worker_blood_group)?$employee->worker_blood_group:null),
                                [
                                    'id'=>'worker_blood_group',
                                    'class'=>'col-xs-10',
                                    'data-validation'=>'required',
                                    'placeholder'=>'Select Blood Group'
                                ]) 
                            }} 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_identification_mark"> Identification Mark </label>
                        <div class="col-sm-9">
                            <textarea id="worker_identification_mark" name="worker_identification_mark" class="col-xs-10" placeholder="Identification Mark" data-validation="length" data-validation-length="0-256">{{ (!empty($employee->worker_identification_mark)?$employee->worker_identification_mark:null) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_doctor_age_confirm"> Doctor's Age Confirmation<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            {{ Form::select(
                                "worker_doctor_age_confirm", 
                                [
                                    "18-20"=>"18-20", 
                                    "21-25"=>"21-25", 
                                    "26-30"=>"26-30", 
                                    "31-35"=>"31-35", 
                                    "36-40"=>"36-40", 
                                    "41-45"=>"41-45", 
                                    "46-50"=>"46-50", 
                                    "51-55"=>"51-55", 
                                    "56-60"=>"56-60", 
                                    "61-65"=>"61-65", 
                                    "66-70"=>"66-70" 
                                ], 
                                (!empty($employee->worker_doctor_age_confirm)?$employee->worker_doctor_age_confirm:null),
                                [
                                    'id'=>'worker_doctor_age_confirm',
                                    'class'=>'col-xs-10',
                                    'data-validation'=>'required',
                                    'placeholder'=>'Doctor\'s Age Confirmation'
                                ]) 
                            }}  
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_doctor_comments"> Doctor's Comments<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <textarea id="worker_doctor_comments" name="worker_doctor_comments" class="col-xs-10" placeholder="Doctor's Comments" data-validation="required length" data-validation-length="1-256">{{ (!empty($employee->worker_doctor_comments)?$employee->worker_doctor_comments:null) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="med_acceptance"> Acceptance<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_doctor_acceptance" name="worker_doctor_acceptance" type="radio" class="ace" value="1" data-validation="required" {{ (($employee->worker_doctor_acceptance==1)?'checked':null) }}/>
                                    <span class="lbl"> Yes</span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="worker_doctor_acceptance" id="worker_doctor_acceptance" type="radio" class="ace" value="2" {{ (($employee->worker_doctor_acceptance==2)?'checked':null) }}/>
                                    <span class="lbl">No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_doctor_signature">Doctor's Signature <font style="font-size: 8px;">(jpg|jpeg|png)</font></label>
                        <div class="col-sm-9">
                            @if(!empty($employee->worker_doctor_signature))
                                <strong class="text-success">Signature Available</strong>
                            @else
                                <strong class="text-danger">No file found!</strong>
                            @endif

                            <input type="hidden" name="old_signature" value="{{ (!empty($employee->worker_doctor_signature)?$employee->worker_doctor_signature:null) }}">

                            <input type="file" id="worker_doctor_signature" name="worker_doctor_signature" value="{{ $employee->worker_doctor_signature }}" data-validation="mime size" data-validation-allowing="jpeg,png,jpg" data-validation-max-size="512kb" data-validation-error-msg-size="You can not upload images larger than 512kb" data-validation-error-msg-mime="You can only upload jpeg, jpg or png images">
                        </div>
                    </div>

                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="space-4"></div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" >
                                <i class="ace-icon fa fa-check bigger-110"></i> Submit
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                            </button>
                        </div>
                    </div>

                    <!-- /.row -->
                    <hr />
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Join Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalList as $medical)
                            <tr>
                                <td>{{ $medical->sl }}</td>
                                <td>{{ $medical->worker_name }}</td>
                                <td>{{ $medical->worker_doj }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/recruitment/worker/medical_edit/'.$medical->worker_id) }}" class='btn btn-xs btn-info' data-toggle="tooltip" title="Edit Information"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                    </div>
                                </td>
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
    $('#dataTables').DataTable({
        pagingType: "full_numbers" ,
    }); 

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

});
</script>
@endsection