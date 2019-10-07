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
                <li class="active"> Order Entry View</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Capacity & Placement <small><i class="ace-icon fa fa-angle-double-right"></i> Order Entry View</small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <form class="form-horizontal" role="form" method="post" action="{{ url('merch/capacity/order_entry') }}">
                {{ csrf_field() }} 

                <div class="col-sm-4">
                    <h5 class="page-header">Order Entry</h5>

                    <!-- PAGE CONTENT BEGINS --> 
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"><b>Order No</b>
                                </label>
                            </div>
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->order_code }} </label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Unit</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->hr_unit_name }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Buyer Name</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->b_name }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Brand</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->br_name }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Month, Year</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->month_year }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Season</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->se_name }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Style</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->stl_code }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Quantity</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->order_qty }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Delivery Date</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                <label class="col-xs-12">{{ $order->order_delivery_date }}</label>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label class="col-xs-12 no-padding-right"> <b>Status</b> </label>
                            </div>
                            
                            <div class="col-xs-8">
                                @if($order->order_status == "On GOing")
                                <label class="col-xs-6 btn btn-xs btn-primary">{{ $order->order_status }}</label>
                                @else
                                <label class="col-xs-6 btn btn-xs btn-success">{{ $order->order_status }}</label>
                                @endif
                            </div>
                        </div>
                        <!-- /.row --> 
                     
                    <!-- PAGE CONTENT ENDS -->
                </div>
                <div class="col-sm-8">
                    <h5 class="page-header">Purchase Orders</h5>
                    <div>
                    <table class="table table-bordered">
                            <thead style="background-color: #2C6AA0">
                                <th>PO</th>
                                <th>Country</th>
                                <th>Qty</th>
                                <th>PCD</th>
                                <th>FOB</th>
                            </thead>

                            <tbody id="addRemove">
                                @foreach($purchase_order_list AS $po)
                                <tr>
                                    <td style="width: 18%">
                                        {{ $po->po_no }}
                                    </td>
                                    <td style="width: 21%">
                                      {{ $po->cnt_name }}
                                    </td >
                                    <td style="width: 15%">
                                       {{ $po->po_qty }}
                                    </td>
                                    <td style="width: 18%">
                                        {{ $po->po_pcd }}
                                    </td>
                                    <td style="width: 18%">
                                        {{ $po->po_fob_date }}
                                    </td>
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
        //Po details by po number
        $("body").on('change', '.po_id', function(){
            var po_id = $(this).val();
            var that = $(this);
            var t_qty= parseInt($('#order_qty').val());
            var po_t_qty=0;

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
                        if(t_qty<po_t_qty+data.po.po_qty){
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
 
    });
</script>
@endsection