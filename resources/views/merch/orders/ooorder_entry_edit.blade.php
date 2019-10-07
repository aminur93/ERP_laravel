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
                    <a href="#">Capacity & Placement</a>
                </li> 
                <li class="active"> Order Entry Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Capacity & Placement <small><i class="ace-icon fa fa-angle-double-right"></i> Order Entry Edit</small></h1>
            </div>

            <div class="row">
                @include('inc/message')
                
                  <!-- Display Erro/Success Message -->
                
                <form class="form-horizontal" role="form" method="post" action="{{ url('merch/capacity/order_entry_update') }}">
                {{ csrf_field() }} 
                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                <input type="hidden" name="res_id" value="{{ $order->res_id }}">
                <div class="col-sm-4">
                    <h5 class="page-header">Order Entry Edit</h5>
                    <!-- PAGE CONTENT BEGINS -->  
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_code"> Order No<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_code" name="order_code" class="col-xs-12" value="{{ $order->order_code }}" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="hr_unit_id">Unit<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('hr_unit_id', $unitList, $order->hr_unit_id, ['id' => 'hr_unit_id', 'placeholder' => 'Select Unit', 'class' => 'col-xs-12 filter', 'data-validation' => 'required', 'disabled']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="b_id" >Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                {{ Form::select('b_id', $buyerList, $order->b_id, ['id'=> 'b_id', 'placeholder' => 'Select Buyer', 'class' => 'col-xs-12 filter', 'data-validation'=> 'required', 'disabled']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="br_id" >Brand</label>
                            <div class="col-sm-9">
                                {{ Form::select('br_id', $brandList, $order->br_id, [ 'id'=> 'br_id', 'placeholder' => 'Select Brand', 'class'=> 'col-xs-12', 'data-validation' => 'required', 'data-validation-optional' => 'true']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_month"> Month<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_month" name="order_month" data-validation=" required length number" value="{{ $order->order_month }}" data-validation-length="1-11" placeholder="Month" class="col-xs-4" data-validation-allowing="range[1;12]"/>
                                <label class="col-xs-3">Year<span style="color: red">&#42;</span></label>
                                <input type="text" id="order_year" name="order_year" value="{{ $order->order_year }}" data-validation=" required length number" data-validation-length="1-11" placeholder="Year" class="col-xs-4" data-validation-allowing="range[2018;2068]"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="se_id"> Season <span style="color: red">&#42;</span></label>
                            <div class="col-sm-9">
                                {{ Form::select('se_id', $seasonList, $order->se_id, [ 'id'=> 'se_id', 'placeholder' => 'Select Season', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="stl_id"> Style <span style="color: red">&#42;</span></label>
                                <div class="col-sm-9">
                                    {{ Form::select('stl_id', $styleList, $order->stl_id, [ 'id'=> 'stl_id', 'placeholder' => 'Select Style', 'class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                                </div>
                            </div>
                            <input type="hidden" class="qty_check" name="qty_check" id="qty_check" value="{{ $order->res_quantity }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_qty"> Quantity<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="text" id="order_qty" name="order_qty" value="{{ $order->order_qty }}" data-validation=" required length number" data-validation-length="1-11" placeholder="Quantity" class="col-xs-12"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_delivery_date"> Delivery Date <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <input type="date" id="order_delivery_date" name="order_delivery_date" value="{{ $order->order_delivery_date }}" class="col-xs-12" data-validation=" required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="order_status"> Status <span style="color: red">&#42;</span> </label>
                            <div class="col-sm-9">
                                <select class="col-xs-12" name="order_status" data-validation="required">
                                    <option value="">Select order status</option>
                                    <option value="Ongoing" <?php if($order->order_status == "Ongoing") echo "selected"; ?> >Ongoing</option>
                                    <option value="Completed" <?php if($order->order_status == "Completed") echo "selected"; ?> >Completed</option>
                                    
                                </select>
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
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                        <!-- /.row --> 
                     
                    <!-- PAGE CONTENT ENDS -->
                </div>
                 <div class="col-sm-8">
                    <h5 class="page-header">Select Purchase Order</h5>
                    <div>
                        <table class="table table-bordered">
                            <thead style="background-color: #2C6AA0">
                                <th>PO</th>
                                <th>Country</th>
                                <th>Qty</th>
                                <th>PCD</th>
                                <th>FOB</th>
                                <th>Add/Remove</th>
                            </thead>
                            <tbody id="addRemove">
                                @if($purchase_order_list->isEmpty())
                                    <tr>
                                    <td style="width: 18%">
                                        {{Form::select('po_id[]', $po_list, null, ['id' => 'po_id[]', 'placeholder' => 'Select PO', 'style'=> 'width:100%', 'class'=>'po_id no-select'])}}
                                    </td>
                                    <td style="width: 21%">
                                       <input type="text" name="po_contry[]" class="col-xs-12" readonly>
                                    </td style="width: 15%">
                                    <td>
                                        <input type="text" name="po_qty[]" id="po_qty[]" class="col-xs-12" readonly>
                                    </td>
                                    <td style="width: 18%">
                                        <input type="text" name="po_pcd[]" class="col-xs-12" readonly>
                                    </td>
                                    <td style="width: 18%">
                                        <input type="text" name="po_fob_date[]" class="col-xs-12" readonly>
                                    </td>
                                    <td style="width: 10%">
                                        <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
                                    </td>
                                    <input type="hidden" id="iterator" value="1">
                                </tr> 
                                @endif
                                @foreach($purchase_order_list AS $poList)
                                <tr id="{{ $poList->po_id }}">
                                    <td style="width: 18%">
                                        {{Form::select('po_id[]', $po_list, $poList->po_id, ['id' => 'po_id[]', 'placeholder' => 'Select PO', 'style'=> 'width:100%', 'class'=>'po_id no-select',  'data-validation' => 'required'])}}
                                    </td>
                                    <td style="width: 21%">
                                       <input type="text" name="po_contry[]" value="{{ $poList->cnt_name }}" class="col-xs-12" readonly>
                                    </td style="width: 15%">
                                    <td>
                                        <input type="text" name="po_qty[]" id="po_qty[]" value="{{ $poList->po_qty }}" class="col-xs-12" readonly>
                                    </td>
                                    <td style="width: 18%">
                                        <input type="text" name="po_pcd[]" value="{{ $poList->po_pcd }}" class="col-xs-12" readonly>
                                    </td>
                                    <td style="width: 18%">
                                        <input type="text" name="po_fob_date[]" value="{{ $poList->po_fob_date }}" class="col-xs-12" readonly>
                                    </td>
                                    <td style="width: 10%">
                                        <button type="button" class="btn btn-sm btn-success AddBtn">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button>
                                    </td>
                                    <input type="hidden" id="iterator" value="1">
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                    <div id="addSubStyle">
                        <h5 class="page-header">PO Sub-Styles</h5>
                        {!! $subs !!}
                    </div>
                </div>
               
                </form>


            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //Total quantity can not be greater than Projected quantity
        $('#order_qty').on('keyup', function(){
            var sum = 0;
            var total_qty= parseInt($(this).val());
            var projected_qty= parseInt($("#qty_check").val());
            if(total_qty> projected_qty){
                alert('Total quantity can not greater than Projected quantity');
                $(this).val(projected_qty);
            }
        });
        
        //Po details by po number
        $("body").on('change', '.po_id', function(){
            var po_id = $(this).val();
            var that = $(this);
            var t_qty= parseInt($('#order_qty').val());
            var po_t_qty=0;
            // var duplicateChecker= $("#po_contry")
            // alert(that.prop('selectedIndex'));

            // reset values of selected option
            that.parent().next().children().val("");
            that.parent().next().next().children().val("");
            that.parent().next().next().next().children().val("");
            that.parent().next().next().next().next().children().val("");
            // reset end

            //checking quantity with total quantity
            $('input[name^="po_qty"]').each(function() {
                var val= parseInt($(this).val());
                if(isNaN(val))
                po_t_qty = po_t_qty+ 0;
                else
                    po_t_qty = po_t_qty+ val;
            });


            //checking existing PO selected
            var chk= true;

            if(po_id != ""){
                $.ajax({
                    url: '{{ url("merch/capacity/po_by_po_id") }}',
                    type: 'json',
                    method: 'get',
                    data: { po_id: $(this).val()},
                    beforeSend: function()
                    {
                        $("table#table_po_id_"+that.parent().parent().attr("id")).remove();
                        
                        var count= 0;
                        $('.po_id').each(function(i, v) { 
                            if(parseInt($(v).val()) == po_id) count++;
                        });
                        if(count>1){
                            chk=false;
                        }
                    },
                    success: function (data) 
                    { 
                        // if total quatity is less than total sub quantity then do not select
                        var total_po= parseInt( parseInt(po_t_qty) + parseInt(data.po.po_qty) );
                        if(t_qty<total_po){
                            alert("Total quantity is less than sub-quantity");
                            that.closest('select').prop('selectedIndex', 0);
                        }
                        else if(chk == false){
                            alert("PO already exists!!");
                        that.closest('select').prop('selectedIndex', 0);
                        }
                        else
                        {
                            that.parent().parent().attr("id", data.po.po_id);
                            that.parent().next().children().val(data.po.cnt_name);
                            that.parent().next().next().children().val(data.po.po_qty);
                            that.parent().next().next().next().children().val(data.po.po_pcd);
                            that.parent().next().next().next().next().children().val(data.po.po_fob_date);
                            $("#addSubStyle").append(data.posub);
                        }
                    },
                    error: function()
                    {
                        alert("failed!!");
                    }
                });
            }
            else
            {
                $("table#table_po_id_"+that.parent().parent().attr("id")).remove();

                that.parent().next().children().val("");
                that.parent().next().next().children().val("");
                that.parent().next().next().next().children().val("");
                that.parent().next().next().next().next().children().val(""); 
            }
        });



        var data= '<tr><td style="width: 18%">{{Form::select("po_id[]", $po_list, null, ["id" => "po_id[]", "placeholder" => "Select PO", "style"=> "width:100%", "class"=>"po_id",  "data-validation" => "required"])}}</td><td style="width: 21%"><input type="text" name="po_contry[]" class="col-xs-12" readonly></td style="width: 15%"><td><input type="text" name="po_qty[]" id="po_qty[]" class="col-xs-12" readonly></td><td style="width: 18%"><input type="text" name="po_pcd[]" class="col-xs-12" readonly></td><td style="width: 18%"><input type="text" name="po_fob_date[]" class="col-xs-12" readonly></td><td style="width: 10%"><button type="button" class="btn btn-sm btn-success AddBtn">+</button><button type="button" class="btn btn-sm btn-danger RemoveBtn">-</button></td></tr> '; 

        $('body').on('click', '.AddBtn', function(){
            $('#addRemove').append(data);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().remove();
            $("table#table_po_id_"+ $(this).parent().parent().attr("id")).remove();
        });
 
    });
</script>
@endsection