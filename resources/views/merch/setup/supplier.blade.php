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
                    <div class="col-sm-12">
                        <a href="{{ url('/merch/setup/article/') }}" class="btn btn-primary btn-xs">
                            Article Construction & Composition
                        </a>
                    </div>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6">
                    <h5 class="page-header">Add Supplier</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('merch/setup/supplier') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        @foreach($unit_id as $ui)
                        <input type="hidden" name="unit_id" value="{{ $ui->as_unit_id }}">
                        @endforeach

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="sup_name" > Supplier Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="sup_name" id="sup_name" placeholder="Supplier Name"  class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="cnt_id" >Country<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('cnt_id', $countryList, null, ['placeholder'=>'Select Country', 'class'=> 'col-xs-12 filter', 'data-validation' => 'required','id'=>'country_id']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="sup_address"> Address <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <textarea name="sup_address" id="sup_address" class="col-xs-12" placeholder="Address"  data-validation="required length" data-validation-length="0-128"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="sup_type"> Supplier Type <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" id="sup_type" name="sup_type"  class="local" value="Local"  data-validation="required"/>
                                        <span class="lbl"> Local</span>
                                    </label>
                                    <label>
                                        <input type="radio" id="sup_type" name="sup_type" class="foreign" value="Foreign"/>
                                        <span class="lbl">Foreign</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="addRemove">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="scp_details"> Contact Person <span style="color: red">&#42;</span> (<span style="font-size: 9px">Name, Cell No, Email</span>) </label>

                                <div class="col-sm-9">
                                    <textarea name="scp_details[]" id="scp_details" class="col-xs-9" placeholder="Contact Person"  data-validation="required length" data-validation-length="0-128"></textarea>

                                    <div class="form-group col-xs-3">
                                        <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
                                    </div>
                                </div>
                            </div>
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
                    <h5 class="page-header">Supplier List</h5>
                    <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Supplier Name</th>
                                    <th>Spplier Type</th>
                                    <th>Address</th>
                                    <th>Contact Persons</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplierList AS $suppliers)
                                    <tr>
                                        <td>{{ $suppliers->sup_name }}</td>
                                        <td>{{ $suppliers->sup_type }}</td>
                                        <td>{{ $suppliers->sup_address }}, {{ $suppliers->cnt_name }}</td>
                                        <td>{!! $suppliers->contact_person !!}</td>
                                        <td>{{ $suppliers->status == 2 ? 'Approved' : "Pending" }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a type="button" href="{{ url('merch/setup/supplier_edit/'.$suppliers->sup_id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                                <a href="{{ url('merch/setup/supplier_delete/'.$suppliers->sup_id) }}" type="button" class='btn btn-xs btn-danger' title="Delete" onClick="return window.confirm('Are you sure?')"><i class="ace-icon fa fa-trash bigger-120"></i></a>
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
