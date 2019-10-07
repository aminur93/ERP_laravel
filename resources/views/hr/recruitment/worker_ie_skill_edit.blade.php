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
                <li class="active"> IE Skill Test</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Recruitment <small> <i class="ace-icon fa fa-angle-double-right"></i> Worker <i class="ace-icon fa fa-angle-double-right"></i> IE Skill Test</small></h1>
            </div>

            <div class="row">

                <!-- Display Erro/Success Message -->
                @include('inc/message')


                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    </br>
                    {{ Form::open(['url'=>'hr/recruitment/worker/ie_skill_test', 'class'=>'form-horizontal']) }}

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
 
                    <legend style="text-indent: 100px;"><b>Training Center</b></legend>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_pigboard_test"> Pgboard Test<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_pigboard_test" name="worker_pigboard_test" type="radio" class="ace" value="1" data-validation="required"   {{ (($employee->worker_pigboard_test==1)?'checked':null) }} />
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_pigboard_test" type="radio" class="ace"  value="0" {{ (($employee->worker_pigboard_test==0)?'checked':null) }} />
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_finger_test"> Finger Test<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_finger_test" name="worker_finger_test" type="radio" class="ace" value="1" data-validation="required" {{ (($employee->worker_finger_test==1)?'checked':null) }} />
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_finger_test" type="radio" class="ace"  value="0" {{ (($employee->worker_finger_test==0)?'checked':null) }} />
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <legend style="text-indent: 100px;"><b>IE (Industrial Engineering)</b></legend>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_color_join"> Color Join <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_color_join" name="worker_color_join" type="radio" class="ace" value="1" data-validation="required" {{ (($employee->worker_color_join==1)?'checked':null) }} />
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_color_join" type="radio" class="ace"  value="0"  {{ (($employee->worker_color_join==0)?'checked':null) }} />
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_color_band_join"> Color Band Join <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_color_band_join" name="worker_color_band_join" type="radio" class="ace" value="1" data-validation="required" {{ (($employee->worker_color_band_join==1)?'checked':null) }}/>
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_color_band_join" type="radio" class="ace"  value="0" {{ (($employee->worker_color_band_join==0)?'checked':null) }}/>
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_box_pleat_join"> Box Pleat Join <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_box_pleat_join" name="worker_box_pleat_join" type="radio" class="ace" value="1" data-validation="required" {{ (($employee->worker_box_pleat_join==1)?'checked':null) }}/>
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_box_pleat_join" type="radio" class="ace" value="0" {{ (($employee->worker_box_pleat_join==0)?'checked':null) }}/>
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_color_top_stice"> Color Top Stice <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_color_top_stice" name="worker_color_top_stice" type="radio" class="ace" value="1" data-validation="required"  {{ (($employee->worker_color_top_stice==1)?'checked':null) }}/>
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_color_top_stice" type="radio" class="ace"  value="0"  {{ (($employee->worker_color_top_stice==0)?'checked':null) }}/>
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_urmol_join"> Urmol Join <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_urmol_join" name="worker_urmol_join" type="radio" class="ace" value="1" data-validation="required"  {{ (($employee->worker_urmol_join==1)?'checked':null) }}/>
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_urmol_join" type="radio" class="ace"  value="0"  {{ (($employee->worker_urmol_join==0)?'checked':null) }}/>
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_clip_join"> Clip Join <span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input id="worker_clip_join" name="worker_clip_join" type="radio" class="ace" value="1" data-validation="required"  {{ (($employee->worker_clip_join==1)?'checked':null) }}/>
                                    <span class="lbl"> Yes</span>
                                </label>
                                <label>
                                    <input name="worker_clip_join" type="radio" class="ace"  value="0"  {{ (($employee->worker_clip_join==0)?'checked':null) }}/>
                                    <span class="lbl"> No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="worker_salary">Recommended Salary<span style="color: red">&#42;</span> </label>
                        <div class="col-sm-9">
                            <input type="text" id="worker_salary" name="worker_salary" data-validation=" required" placeholder="Salary" class="col-xs-10" value="{{ (!empty($employee->worker_salary)?$employee->worker_salary:0) }}" />
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
                            @foreach($ieList as $ie)
                            <tr>
                                <td>{{ $ie->sl }}</td>
                                <td>{{ $ie->worker_name }}</td>
                                <td>{{ $ie->worker_doj }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('hr/recruitment/worker/ie_skill_edit/'.$ie->worker_id) }}" class='btn btn-xs btn-info' data-toggle="tooltip" title="Edit Information"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
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