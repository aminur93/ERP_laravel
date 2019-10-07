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
                    <a href="#">Report </a>
                </li>
                <li class="active"> Report View</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Report <small><i class="ace-icon fa fa-angle-double-right"></i> Report View</small></h1>
            </div>
             <br>
            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <h5 class="center" style="">Select Report Type</h5><br>
                <div class="col-sm-8 col-sm-offset-2" style="padding-top: 16px; border: 1px solid lightgray;">
                <div class="col-sm-8 col-sm-offset-4">
                  <!-- <label class="col-sm-4 control-label no-padding-right" for="unit">Report Type </label> -->
                  <table class="" style="width:100%;border:none; margin-bottom: 20px;" cellpadding="0" >
                      <tr style="border-bottom:none;">
                        <td>
                          <label> <input type="radio" name="report" id="style" class="ace"> <span class="lbl" style="font-size:12px;">  Style</span>
                          </label>
                        </td>
                        <td>
                          <label> <input type="radio" name="report" id="order" class="ace" value=""> <span class="lbl" style="font-size:12px;">  Order</span>
                        </label>
                        </td>

                         <td>
                          <label> <input type="radio" name="report" id="bp" class="ace" value=""> <span class="lbl" style="font-size:12px;">Booking & Placement</span>
                        </label>
                        </td>
                        <td></td>
                      </tr>
                </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-md-offset-2 wraper" >

              </div>

            </div>

            <div class="row">
              <div class="col-md-10 col-md-offset-2 order-wraper">

              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <?php if(!empty($style)) {?>
                <?php if(count($style) > 0) {?>
                  <h1 class="center">Style Report </h1>
                  <h6 class="center"><?= !empty($start)?'From '.$start:''?><?= !empty($end)?' To '.$end:''?></h6>
                <table id="bomItemTable" class="custom-font-table table table-bordered">
                <thead>
                <tr>
                <th>Style</th>
                <th>Buyer</th>
                <th>CM</th>
                <th>FOB</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($style as $stl) { ?>
                    <tr>
                    <td><a href="{{url('merch/style/style_profile',$stl->stl_id)}}" >{{ $stl->stl_no}}</a></td>
                    <th>{{ $stl->b_name}}</th>
                    <th>{{ $stl->cm}}</th>
                    <th>{{ $stl->agent_fob}}</th>
                  </tr>
                  <?php } ?>
                </tbody>
                </table>
              <?php } }?>
              </div>
            </div>

            <div class="row">

                <?php if(!empty($orders['data'])) {?>
                <?php if(count($orders['data']) > 0) {?>
                  <div class="col-md-12" style="padding-top: 16px; border: 1px solid lightgray;">
                  <h1 class="center">Order Report</h1>
                  <h6 class="center"><?= !empty($unit)?'Unit: '.$unitList[$unit].',':''?><?= !empty($buyer)?' Buyer: '.$buyerList[$buyer].',':''?><?= !empty($start)?' From '.$start:''?><?= !empty($end)?' To '.$end:''?></h6>

                <?php foreach ($orders['data'] as $unitName => $value) {?>

                       <h3><?= $unitName ?></h3>



                  <?php foreach ($value as $buyerName=>$v) {

                    ?>
                       <button class="btn btn-xs" type="button"><?= $buyerName ?></button>
                       <table id="temTable" class="custom-font-table table table-bordered">
                       <thead>
                       <tr>
                       <th>Order</th>
                       <th>Style</th>
                       <th>Description</th>
                       <th>Qty</th>
                       <th>Del Date</th>
                       <th>FOB</th>
                       <th>SMV</th>
                       <th>SAH</th>
                       <th>CM</th>
                       <th>CM ERN</th>
                       </tr>
                       </thead>
                       <tbody>

                    <?php
                      $tqty=$tsah=$tcern=0;

                    foreach ($v as $ordr) {
                       $tqty += $ordr->order_qty;
                       $tsah += ($ordr->res_sewing_smv*$ordr->order_qty)/60;
                       $tcern += $ordr->cm*$ordr->order_qty;
                    ?>
                    <tr>
                    <td><a href="{{url('merch/orders/order_profile_show',$ordr->order_id)}}" >{{ $ordr->order_code}}</a></td>
                    <th><a href="{{url('merch/style/style_profile',$ordr->stl_id)}}" >{{ $ordr->stl_no}}</a></th>
                    <th>{{ $ordr->stl_description}}</th>
                    <th>{{ $ordr->order_qty}}</th>
                    <th>{{ $ordr->order_delivery_date}}</th>
                    <th>{{ $ordr->agent_fob}}</th>
                    <th>{{ $ordr->res_sewing_smv}}</th>
                    <th>{{ ($ordr->res_sewing_smv*$ordr->order_qty)/60}}</th>
                    <th>{{ $ordr->cm}}</th>
                    <th>{{ $ordr->cm*$ordr->order_qty }}</th>
                  </tr>


              <?php } ?>
              <tr>
                <th colspan="3" class="text-right"> <strong>Total</strong></th>
                <th>{{ $tqty }}</th><th></th><th></th><th></th><th>{{ $tsah }}</th><th></th><th>{{ $tcern }}</th>
              </tr>
            </tbody>
            </table>
            <?php }?>
                  <?php } ?>
                  <div class="text-center">
                   {{ $orders->appends($_REQUEST)->render() }}
                  </div>
                  </div>
              <?php } }?>
            </div>

            <div class="row">
              @if(!empty($reservation))
                 @if(count($reservation)>0)
                   <div class="col-md-12">

                    <div class="card">
                      <div class="card-body">

                     <h1 class="center">Booking & Placement Report</h1><hr><br>
                     <h6 class="center"><?= !empty($unit)?'Unit: '.$unitList[$unit].',':''?><?= !empty($buyer)?' Buyer: '.$buyerList[$buyer].',':''?><?= !empty($start)?' From '.$start:''?><?= !empty($end)?' To '.$end:''?></h6>
                     <br><br>

                     <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>

                        <th>Buyer Name</th>
                        <th>Total Quantity</th>
                        <th>Grand Total Quantity</th>
                        <th>Total SAH</th>

                      </tr>
                    </thead>
                    <tbody>



                      <?php foreach($reservation as $k => $res) {
                          $res_qty[$k][] = array_column((array)$reservation[$k],'res_quantity');
                          $res_qty1 = array_sum($res_qty[$k][0]);
                          //dump($res_qty1);

                          $res_sa[$k][] = array_column((array)$reservation[$k],'res_sah');
                          $res_sa1 = array_sum($res_sa[$k][0]);
                          //dump($res_sa1);
                          ?>
                      <?php if(is_array($res) || is_object($res)) {
                        ?>
                      <?php foreach($res as $re){
                      $check_m_y = $re->res_month.'-'.$re->res_year;
                      ?>

                      <tr>
                          <?php
                              if(isset($data_store_unique[$k][$check_m_y])) {
                                $rowspan = 'rowspan="'.$data_store_unique[$k][$check_m_y].'"';
                                //unset($data_store_unique[$k][$check_m_y]);
                          ?>

                        <td style="vertical-align : middle;" <?php echo $rowspan; ?>
                        >{{ $re->res_month }}-{{ $re->res_year }}</td>
                        <td style="vertical-align : middle;" <?php echo $rowspan; ?>>{{ $re->b_name }}</td>

                        <?php } ?>

                        <td>
                          @if($re->prd_type_id == 6 || $re->prd_type_id == 7)
                          <span>Placed {{ $re->prd_type_name }} : {{ $re->res_quantity }}
                          </span><br>
                          @endif
                        </td>

                        <?php
                              if(isset($data_store_unique[$k][$check_m_y])) {
                                $rowspan = 'rowspan="'.$data_store_unique[$k][$check_m_y].'"';
                                unset($data_store_unique[$k][$check_m_y]);
                          ?>


                        <td style="vertical-align : middle;" <?php echo $rowspan; ?>>
                          <?php
                            echo $res_qty1;
                          ?>
                        </td>

                        <td style="vertical-align : middle;" <?php echo $rowspan; ?>>
                          <?php echo $res_sa1; ?>
                        </td>
                        <?php } ?>

                      </tr>

                      <?php } ?>
                      <?php } ?>
                      <?php } ?>

                    </tbody>
                  </table>
                      </div>
                    </div>


                   </div>
                 @endif
              @endif
            </div>

        </div><!-- /.page-content -->
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        //Total quantity can not be greater than Projected quantity
        $('#bomItemTable').DataTable();
        $('#itemTable').DataTable();

        var data ='<form role="form" method="get" action="" class="has-validation-callback">'+
        '<h5 class="center" style="padding-right: 172px;">Serach Style Report Within a Date Range</h5><br>'+
        '<input type="hidden" name="type" id="type" class="col-xs-12" value="style" data-validation="required" placeholder="Range From" />'+
           '<div class="col-sm-4">\n'+
            '<label class="col-sm-4 control-label no-padding-right" for="unit">From </label>'+
            '<input type="date" name="range_from" id="range_from" class="col-xs-12 " value="" data-validation="required" placeholder="Range From" />'+
        '</div>'+
        '<div class="col-sm-4">'+
            '<label class="col-sm-4 control-label no-padding-right" for="unit">To </label>'+
            '<input type="date" name="range_to" id="range_to" class="col-xs-12 " value="" data-validation="required" placeholder="Range to" />'+
        '</div>'+
        '<div class="col-sm-4">'+
        '<label class="col-sm-4 control-label no-padding-right" for="unit">  </label>'+
            '<br><button type="submit" class="btn btn-primary btn-sm">'+
                                     '<i class="fa fa-search"></i>'+
                                     'Search'+
                                 '</button>'+
        '</div>'+
        '</form>';
        $('.wraper').append(data);

        $('#style').on('click', function(){
          // $('#bomItemTable').Datatable();
          $('.wraper').empty();
          $('.order-wraper').empty();
           var data ='<form role="form" method="get" action="" class="has-validation-callback">'+
           '<h5 class="center" style="padding-right: 172px;">Serach Style Report Within a Date Range</h5><br>'+
           '<input type="hidden" name="type" id="type" class="col-xs-12 " value="style" data-validation="required" placeholder="Range From" />'+

              '<div class="col-sm-4">\n'+
               '<label class="col-sm-4 control-label no-padding-right" for="unit">From </label>'+
               '<input type="date" name="range_from" id="range_from" class="col-xs-12 " value="" data-validation="required" placeholder="Range From" />'+
           '</div>'+
           '<div class="col-sm-4">'+
               '<label class="col-sm-4 control-label no-padding-right" for="unit">To </label>'+
               '<input type="date" name="range_to" id="range_to" class="col-xs-12 " value="" data-validation="required" placeholder="Range to" />'+
           '</div>'+

           '<div class="col-sm-4">'+
           '<label class="col-sm-4 control-label no-padding-right" for="unit">  </label>'+
               '<br><button type="submit" class="btn btn-primary btn-sm">'+
                                        '<i class="fa fa-search"></i>'+
                                        'Search'+
                                    '</button>'+
           '</div>'+
           '</form>';
           $('.wraper').append(data);
        });

        $('#order').on('click', function(){
          $('.wraper').empty();
           var data ='<form role="form" method="get" action="" class="has-validation-callback">'+
           '<h5 class="center" style="padding-right: 189px;">Serach Order Report</h5><br>'+
           '<input type="hidden" name="type" id="type" class="col-xs-12 " value="order" data-validation="required" placeholder="Range From" />'+

           '<div class="col-sm-2">\n'+
            '<label class="col-sm-2 control-label no-padding-right" for="unit"> Unit </label>'+
            '{{ Form::select('unit_id', $unitList, Request::get('unit_id'), ['placeholder'=>'Select Unit', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} '+
           '</div>'+

           '<div class="col-sm-2">\n'+
            '<label class="col-sm-2 control-label no-padding-right" for="unit"> Buyer </label>'+
            '{{ Form::select('buyer_id', $buyerList, Request::get('unit_id'), ['placeholder'=>'Select Buyer', 'id'=>'unit_id', 'class'=> 'col-xs-12', 'data-validation'=>'required']) }} '+
            '</div>'+

              '<div class="col-sm-2">\n'+
               '<label class="col-sm-2 control-label no-padding-right" for="unit">From </label>'+
               '<input type="date" name="range_from" id="range_from" class="col-xs-12 " value="" data-validation="required" placeholder="Range From" />'+
           '</div>'+
           '<div class="col-sm-2">'+
               '<label class="col-sm-2 control-label no-padding-right" for="unit">To </label>'+
               '<input type="date" name="range_to" id="range_to" class="col-xs-12 " value="" data-validation="required" placeholder="Range to" />'+
           '</div>'+
           '<div class="col-sm-2">'+
           '<label class="col-sm-2 control-label no-padding-right" for="unit">  </label>'+
               '<br><button type="submit" class="btn btn-primary btn-sm">'+
                                        '<i class="fa fa-search"></i>'+
                                        'Search'+
                                    '</button>'+
           '</div>'+
           '</form>';
           $('.order-wraper').append(data);
        });

         $('#bp').on('click', function(){
          $('.wraper').empty();
           var data ='<form role="form" method="get" action="" class="has-validation-callback">'+
           '<h5 class="center" style="padding-right: 189px;">Serach Booking & Placement Report</h5><br>'+
           '<input type="hidden" name="type" id="type" class="col-xs-12 " value="bp" data-validation="required" placeholder="Range From" />'+



              '<div class="col-sm-4">\n'+
               '<label class="col-sm-4 control-label no-padding-right" for="unit">From </label>'+
               '<input type="date" name="range_from" id="range_from" class="col-xs-12 " value="" data-validation="required" placeholder="Range From" />'+
           '</div>'+
           '<div class="col-sm-4">'+
               '<label class="col-sm-4 control-label no-padding-right" for="unit">To </label>'+
               '<input type="date" name="range_to" id="range_to" class="col-xs-12 " value="" data-validation="required" placeholder="Range to" />'+
           '</div>'+

           '<div class="col-sm-2">'+
           '<label class="col-sm-2 control-label no-padding-right" for="unit">  </label>'+
               '<br><button type="submit" class="btn btn-primary btn-sm">'+
                                        '<i class="fa fa-search"></i>'+
                                        'Search'+
                                    '</button>'+
           '</div>'+
           '</form>';
           $('.order-wraper').append(data);
        });
    });
</script>
@endsection
