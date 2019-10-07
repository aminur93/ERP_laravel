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
				<li class="active"> Service Book</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">  
            <div class="page-header row">
                <h1 class="col-sm-6">Operation<small><i class="ace-icon fa fa-angle-double-right"></i> Service Book</small></h1>
                <div class="text-right" id="newBtn"> 
                </div>
            </div>

            <div class="row">
                 @include('inc/message')
                <div class="col-xs-7">
                  <h5 class="page-header">Service Book Entry</h5>
                    <form class="form-horizontal" role="form" method="post" action="{{ url('hr/operation/servicebookstore') }}" enctype="multipart/form-data"> 

                         {{ csrf_field() }} 
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="job_app_id"> Associate's ID :<span style="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                                 {{ Form::select('associate_id', [Request::get('associate_id') => Request::get('associate_id')], Request::get('associate_id'),['placeholder'=>'Select Associate\'s ID', 'data-validation'=> 'required', 'id'=>'associate_id',  'class'=> 'associates no-select col-xs-10 col-sm-10']) }} 
                                
                            </div>
                        </div>
                      
                       <div id="form-element"> <!---Image Fields --></div>
                       
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-6"> 
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
function drawNewBtn(associate_id)
{
    var url = "{{ url("") }}";
    var newUrl = "<div class=\"btn-group\">"+ 
        "<a href='"+url+'/hr/recruitment/employee/edit/'+associate_id+"'  class=\"btn btn-sm btn-success\" title=\"Basic Info\"><i class=\"glyphicon glyphicon-bold\"></i></a>"+
        "<a href='"+url+'/hr/recruitment/operation/advance_info_edit/'+associate_id+"'  class=\"btn btn-sm btn-info\" title=\"Advance Info\"><i class=\"glyphicon  glyphicon-font\"></i></a>"+
        "<a href='"+url+'/hr/recruitment/operation/benefits?associate_id='+associate_id+"' class=\"btn btn-sm btn-primary\" title=\"Benefits\"><i class=\"fa fa-usd\"></i></a>"+
        "<a href='"+url+'/hr/ess/medical_incident?associate_id='+associate_id+"'  class=\"btn btn-sm btn-warning\" title=\"Medical Incident\"><i class=\"fa fa-stethoscope\"></i></a>"+
        "<a href='"+url+'/hr/operation/servicebook?associate_id='+associate_id+"' class=\"btn btn-sm btn-danger\" title=\"Service Book\"><i class=\"fa fa-book\"></i></a>"+
    "</div>"; 
    $("#newBtn").html(newUrl);
}
 

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

    // Form Based on Emloyee Id
    var action_element = $("#form-element");
    var associate_id = '{{ request()->get("associate_id") }}';

    $(window).on("load", function(){
        if (associate_id) 
        {
            ajaxLoad(associate_id);
            drawNewBtn(associate_id);
        }
    });
    
    $("#associate_id").on("change", function(){ 
        ajaxLoad($(this).val());
        drawNewBtn($(this).val());
    });

    function ajaxLoad(associate_id){
        // Action Element list
        $.ajax({
            url : "{{ url('hr/operation/servicebookpage') }}",
            type: 'get',
            data: {associate_id},
            success: function(data)
            {
                action_element.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });
    }


     $('#dataTables').DataTable(); 
});
 

     
</script>
@endsection