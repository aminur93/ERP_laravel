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
                <li class="active"> Supplier Info </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Supplier Info </small></h1>
            </div>
            <div class="widget-header text-right">
                    <!-- <div class="col-sm-12">
                        <a href="{{ url('/merch/setup/article/'.$supplier->sup_id) }}" class="btn btn-primary btn-xs">
                            Article Construction & Composition
                        </a>
                    </div> -->
            </div>
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('merch/setup/supplier_update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     <br>
                    <input type="hidden" name="sup_id" value="{{$supplier->sup_id}}">

                        @foreach($unit_id as $ui)
                            <input type="hidden" name="unit_id" value="{{ $ui->as_unit_id }}">
                        @endforeach

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="sup_name" > Supplier Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="sup_name" id="sup_name" placeholder="Supplier Name"  class="col-xs-12" value="{{$supplier->sup_name}}" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="cnt_id" >Country<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('cnt_id', $countryList, $supplier->cnt_id, ['placeholder'=>'Select Country', 'class'=> 'col-xs-12 filter', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="sup_address"> Address <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <textarea name="sup_address" id="sup_address" class="col-xs-12" placeholder="Address"  data-validation="required length" data-validation-length="0-128">{{ $supplier->sup_address}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="sup_type"> Supplier Type <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" id="sup_type" name="sup_type"  class="ace" value="Local"  data-validation="required" {{ ($supplier->sup_type=="Local")?"checked":null }}/>
                                        <span class="lbl"> Local</span>
                                    </label>
                                    <label>
                                        <input type="radio" id="sup_type" name="sup_type" class="ace" value="Foreign" {{ ($supplier->sup_type=="Foreign")?"checked":null }}/>
                                        <span class="lbl">Foreign</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="addRemove">
                            @foreach($sup_contact AS $contact)
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="scp_details"> Contact Person <span style="color: red">&#42;</span> (<span style="font-size: 9px">Name, Cell No, Email</span>)</label>

                                <div class="col-sm-9">
                                    <textarea name="scp_details[]" id="scp_details" class="col-xs-9" placeholder="Contact Person"  data-validation="required length" data-validation-length="0-128">{{ $contact->scp_details }}</textarea>

                                    <div class="form-group col-xs-3">
                                        <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label no-padding-right" for="scp_details"> Item</label>
                            <div class="col-sm-9">
                                <div class="form-group col-xs-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#select_item">Select  Item</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="Item_description" class="form-group col-xs-12 pull-right">
                                @foreach($sup_category as $sc)
                                    <button class="btn btn-sm btn-success">{{ $sc->mcat_name }}</button>
                                    @endforeach
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


                        <div class="widget-footer text-right">
                            {!! (!empty($buttons)?$buttons:null) !!}
                        </div>
                        <br>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                              <?php if(empty($buttons)){ ?>
                                <button class="btn btn-info btn-sm" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                              <?php } ?>
                            </div>
                        </div>
                        <!-- /.row -->
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="select_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">Close</button> -->
                <h2 class="modal-title text-center" id="myModalLabel"> Items</h2>
            </div>
            <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body"  style="padding:0 15px">


                    {!! (!empty($itemList)?$itemList:null) !!}


                </div>
                <div class="modal-footer">
                    <div class="col-md-8" style="padding-top: 20px;">
                        <button type="button btn-sm" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-info btn-sm" type="button" id="modal_data" data-dismiss="modal">
                            <i class="ace-icon fa fa-check bigger-110" ></i> Done
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->


<script type="text/javascript">

    $(document).ready(function(){
        // var data = $('.AddBtn').parent().parent().parent().parent().html();
        var data= '<div class="form-group">\
                    <label class="col-sm-3 control-label no-padding-right" for="scp_details"> Contact Person <span style="color: red">&#42;</span> </label>\
                    <div class="col-sm-9">\
                        <textarea name="scp_details[]" id="scp_details" class="col-xs-9" placeholder="Contact Person"  data-validation="required length" data-validation-length="0-128"></textarea>\
                        <div class="form-group col-xs-3">\
                            <button type="button" class="btn btn-sm btn-success AddBtn">+</button>\
                            <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>\
                        </div>\
                    </div>\
                </div>';
        $('body').on('click', '.AddBtn', function(){
            $('.addRemove').append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });


        // Modal Check Box
                $('#select_item').on('hidden.bs.modal', function (e) {
            var data= "";
            $('.checkbox-input').each(function(i, v){
                if ($(this).is(":checked"))
                {
                    var id= $(this).val();
                    console.log(id);
                    var item_name= $(this).next().text();
                    //var item_code= $(this).parent().next().text();
                    data+='<div class="col-sm-7"><label class="col-sm-5 control-label no-padding-right" for="items">Item Name<span style="color: red">&#42;</span>  </label> <div class="col-sm-7"> <input type="text" name="items[]" id="items[]" placeholder="Food" value="'+item_name+'" class="col-xs-12" readonly/> </div></div> <div class="form-group"> <input type="hidden" name="item_id[]" value="'+id+'"> </div>';
                }
            });
            // console.log(data);
            $("#Item_description").html(data);
        });


    });
</script>

<script type="text/javascript">

    $(document).ready(function(){

        $('#dataTables').DataTable();
        var data = $('.AddBtn').parent().parent().parent().parent().html();
        $('body').on('click', '.AddBtn', function(){
            $('.addRemove').append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });


        // Modal Check Box
        $('#select_item').on('hidden.bs.modal', function (e) {
            var data= "";
            $('.checkbox-input').each(function(i, v){
                if ($(this).is(":checked"))
                {
                    var id= $(this).val();
                    console.log(id);
                    var item_name= $(this).next().text();
                    //var item_code= $(this).parent().next().text();
                    data+='<div class="col-sm-7"><label class="col-sm-5 control-label no-padding-right" for="items">Item Name<span style="color: red">&#42;</span>  </label> <div class="col-sm-7"> <input type="text" name="items[]" id="items[]" placeholder="Food" value="'+item_name+'" class="col-xs-12" readonly/> </div></div> <div class="form-group"> <input type="hidden" name="item_id[]" value="'+id+'"> </div>';
                }
            });
            // console.log(data);
            $("#Item_description").html(data);
        });

    });
</script>

<script type="text/javascript">

    $(document).ready(function() {


        $('#country_id').on("change",function() {

            var country_id = $(this).val();
            console.log(country_id);
            if (country_id==18){

                $('.local').prop('checked',true);

            }

            else if(country_id==""){

                $('.local').prop('checked',false);
                $('.foreign').prop('checked',false);

            }
            else{

                $('.foreign').prop('checked',true);

            }

        });
    });



</script>
@endsection
