@extends('merch.index')
@section('content')
<div class="main-content">
  @push('css')
    <style>
      fieldset.group  {
        margin: 0;
        padding: 0;
        margin-bottom: 1.25em;
        padding: .125em;
        border-bottom: 1px solid lightgray;
        border-right: 1px solid lightgray;
        border-top: 1px solid lightgray;
      }

      fieldset.group legend {
        margin: 0;
        padding: 0;
        font-weight: bold;
        margin-left: 20px;
        color: black;
        text-align: center;
        margin-bottom: 15px;
        padding-bottom: 8px;
      }


      ul.checkbox  {
        margin: 0;
        padding: 0;
        margin-left: 20px;
        list-style: none;
      }

      ul.checkbox li input {
        margin-right: .25em;
      }

      ul.checkbox li {
        border: 1px transparent solid;
      }

      ul.checkbox li:hover,
      ul.checkbox li.focus  {
        background-color: lightyellow;
        border: 1px gray solid;
      }
      .checkbox label, .radio label {
        padding-left: 0px;
        font-size: 10px;
    }


    </style>
  @endpush
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li>
                <li>
                    <a href="#"> Setup </a>
                </li>

                <li class="active">Product Size</li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content">
              <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Product Size</small></h1>
            </div>
          <!---Form  -->

          <!---Form 1---------------------- -->
            <!-- Display Erro/Success Message -->
            @include('inc/message')
            <div class="row">
                <div class="col-sm-6">
                    <!-- PAGE CONTENT BEGINS -->
                    <!-- <h1 align="center">Add New Employee</h1> -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/productsizestore')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="product_size_group" >Buyer<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                              <div class="form-group col-xs-12 col-sm-10" >
                                 {{ Form::select('buyer', $buyer, null, ['placeholder'=>'Select Buyer', 'id'=> 'buyer','class'=> 'col-xs-12','data-validation' => 'required']) }}
                               </div>
                          </div>
                    </div>

                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="product_size_group" >Brand<span style="color: red">&#42;</span> </label>

                          <div class="col-sm-9">
                              <div class="form-group col-xs-12 col-sm-10" >

                                 <select  name='brand' id='brand'class='col-xs-12'data-validation ='required'>
                                   <option value="">Select Buyer</option>
                                 </select>
                               </div>
                          </div>
                    </div>
<!--                <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="product_size_group" >Size Group<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                              <div class="form-group col-xs-10 col-sm-10" >
                                 {{ Form::select('product_size_group', $sizegroup, null, ['placeholder'=>'Select Size Group', 'id'=> 'sizegrouplist','class'=> 'col-xs-12','data-validation' => 'required']) }}
                              </div>
                              <div class="form-group col-xs-2 col-sm-2" align="right">
                                  <button type="button"id="AddBtn" class="btn btn-sm btn-success AddBtn">+</button>
                              </div>
                          </div>
                    </div> -->

                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="product_type" >Product Type <span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                              <div class="form-group col-xs-12 col-sm-10" >
                          		 {{ Form::select('product_type', $productType, null, ['placeholder'=>'Select Product Type','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                              </div>
                             
                          </div>
                    </div>

                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="gender" >Gender <span style="color: red">&#42;</span> </label>
                          <div class="col-sm-7">
                            <select name="gender" class="col-xs-12" data-validation = 'required'>
                              <option>Select</option>
                               <option value="Men's">Men's</option>
                               <option value="Ladies">Ladies</option>
                               <option value="Boys/Girls">Boys/Girls</option>
                               <option value="Girls">Girls</option>
                               <option value="Women's">Women's</option>
                               <option value="Men's & Ladies">Men's & Ladies</option>
                               <option value="Baby Boys/Girls">Baby Boys/Girls</option>
                              </select>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="sg_name" >Size Group Name <span style="color: red">&#42;</span> </label>
                          <div class="col-sm-7">
                              <input type="text" id="sg_name" name="sg_name" placeholder="Enter Size Group Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="sino" >Sizes<span style="color: red">&#42;</span></label>
                        <div class="col-sm-9">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sizeModal">Select Size</button>
                            <div class="col-xs-10" id="show_selected_sizes" style="padding-top: 10px; margin: 0px; padding-left: 0px; padding-right: 0px;">

                            </div>
                          </div>
                    </div>




                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> ADD
                                </button>
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Size Group</th>
                                <th>Product Type </th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($Prodsizegroup as $prod)
                             @can("mr_setup")
                             <tr>
                                <td>{{ $prod->size_grp_name }}</td>
                                <td>{{ $prod->size_grp_product_type }}</td>
                                <td>{{ $prod->size_grp_gender }}</td>

                                <td>
                                    <div class="btn-group">

                                        <a type="button" href="{{ url('merch/setup/productsizedit/'.$prod->id) }}"class='btn btn-xs btn-success'><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a href="{{ url('merch/setup/productsizedelete/'.$prod->id) }}" type="button" class='btn btn-xs btn-danger bigger-120' onclick="return confirm('Are you sure you want to delete this Buyer?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>
                          @endcan
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--- /. Row Form 1---->



        </div><!-- /.page-content -->
    </div>
</div>


<!-- Select Size Items  -->
<div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="sizeLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Size Group</h4>
      </div>
      <div class="modal-body" style=""><br>
        @foreach($sizeModalData AS $modalData)
        {!! $modalData !!}
        @endforeach
      </div>
      <div class="modal-footer" style="background-color:#fff;">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        <button type="button" id="sizeModalDone" class="btn btn-primary btn-sm">Done</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
///Data TAble Color
    $('#dataTables').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>tp",
    });

    //Show Selected sizes from modal
    var modal = $("#sizeModal");
    $("body").on("click", "#sizeModalDone", function(e) {

        var data="";
        //-------- modal actions ------------------
        modal.find('.modal-body input[type=checkbox]').each(function(i,v) {
            if ($(this).prop("checked") == true)
            {
            console.log($(this).next().text());
            data+= '<button type="button" class="btn btn-sm" style="margin:2px; padding:2px;">'+$(this).next().text()+'</button>';
            data+= '<input type="hidden" name="seleted_sizes[]" value="'+$(this).next().text()+'"></input>';

            }
        });
        modal.modal('hide');
        $("#show_selected_sizes").html(data);
    });



/// Generate TNA

     var basedon = $("#buyer");
     var action_place=$("#brand");
      basedon.on("change", function(){
        $.ajax({
            url : "{{ url('merch/setup/productsize_brand_generate') }}",
            type: 'get',
            data: {
              b_id: $(this).val(),

            },
            success: function(data)
            {
                action_place.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });

});
</script>

@endsection
