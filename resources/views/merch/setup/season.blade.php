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
                    <a href="#">Setup</a>
                </li>
                <li class="active"> Season </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Season </small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Add New Season</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    {{ Form::open(["url"=>"merch/setup/season_store", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="b_id"> Buyer<span style="color: red">&#42;</span>  </label>
                            <div class="col-sm-9">
                                {{ Form::select('b_id', $buyerList, null, ['placeholder'=>'Select Buyer', 'id'=>'b_id', 'class'=> 'col-xs-12', 'data-validation'=>'required', 'data-validation-error-msg' => 'The Buyer field is required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_name" > Season Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                <input type="text" name="se_name" id="se_name" placeholder="Season Name" data-type="season" class="col-xs-10 col-sm-12 autocomplete_pla" data-validation="required length custom" data-validation-length="1-128"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" autocomplete="off"/>
                                <div id="suggesstion-box"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_mm_start" > Start Month-Year<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">

                                <input type="text" name="se_mm_start" id="se_mm_start" placeholder="Month-y" class="form-control monthYearpicker" data-validation="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_mm_end" > End Month-Year<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                              <input type="text" name="se_mm_end" id="se_mm_end" placeholder="Month-y" class="form-control monthYearpicker" data-validation="required"/>
                            </div>

                        </div>


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

                <div class="col-sm-6">
                    <h5 class="page-header">Season List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                                <th>SL. NO.</th>
                                <th>Buyer Name</th>
                                <th>Season Name</th>
                                <th>Start Month-Year</th>
                                <th>End Month-Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seasons as $season)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $season->b_name }}</td>
                                <td>{{ $season->se_name }}</td>
                                <td>{{ $season->se_start }}</td>
                                <td>{{ $season->se_end}}</td>
                                <td>{{ ($season->season_status ==1)? "Active":"Inactive" }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('merch/setup/season_edit/'.$season->se_id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                        <a href="{{ url('merch/setup/season_delete/'.$season->se_id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
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
//autocomplete placement script
$(document).on('focus','.autocomplete_pla',function(){
    var type = $(this).data('type');
    if(type == 'season')autoTypeNo=0;

    $(this).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url : "{{ url('merch/setup/season_input') }}",
                method: 'GET',
                data: {
                  name_startsWith: request.term,
                  type: type,
                  b_id: $("#b_id").val()
                },
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        var code = item.split("|");
                        return {
                            label: code[autoTypeNo],
                            value: code[autoTypeNo],
                            data : item
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0,
        select: function( event, ui ) {
            var names = ui.item.data.split("|");
            $(this).val(names[0]);
        }
    });

});



$(document).ready(function(){
   $('#dataTables').DataTable();
});


function selectCountry(val) {
$("#se_name").val(val);
$("#suggesstion-box").hide();
}






</script>
@endsection
