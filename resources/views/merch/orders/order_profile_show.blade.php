@extends('merch.index')
@section('content')
<div class="main-content">
       <div class="main-content-inner">
           <div class="breadcrumbs ace-save-state" id="breadcrumbs">
               <ul class="breadcrumb">
                   <li>
                       <a href="/"><i class="ace-icon fa fa-home home-icon"></i>Human Resource</a>
                   </li>
                   <li>
                       <a href="#">Merchandising</a>
                   </li>
                   <li>
                       <a href="#">Order</a>
                   </li>
                   <li class="active">Order Profile Information</li>
               </ul><!-- /.breadcrumb -->
           </div>
 
           <div class="page-content">
               <div class="page-header">
                   <h1 style="float:left;">Merchandising<small> <i class="ace-icon fa fa-angle-double-right"></i> Order Profile Information</small></h1>
                   <button class="btn btn-xs btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
               </div>
 
               <div class="row">
                   <div class="col-xs-12">
                       <div id="user-profile-1" class="user-profile row">
                           <div class="col-sm-3 center">
                               <div>
                                <span class="profile-picture">
                                    <img id="avatar" style="width: 180px; height: 200px;" class="img-responsive" alt="profile picture" src="{{ $order->stl_img_link }}" />
                                </span>
                                   <div class="space-4"></div>
                                   <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
 
                                       <div class="inline position-relative">
                                           <a href="#" class="user-title-label">
                                               <span class="white">{{ $order->stl_product_name }}</span>
                                           </a>
                                       </div>
                                   </div>
                               </div>
 
                               <div class="space-6"></div>
                               <div class="profile-contact-info">
                                   <div class="profile-contact-links align-left">
                                       <p style="text-align: center;"><strong>Order Code : </strong> {{ $order->order_code }}</p>
                                       <p style="text-align: center;"><strong>Order Status : </strong> {{ $order->order_status }}</p>
                                       <p style="text-align: center;"><strong>Order Quantity : </strong> {{ $order->order_qty }}</p>
                                       <p style="text-align: center;"><strong>Order Delivery Date : </strong> {{ $order->order_delivery_date }}</p>
                                   </div>
                               </div>
 
                           </div>
 
                           <div class="col-sm-9">
                               <div id="accordion" class="accordion-style1 panel-group accordion-style2">
                                   <!-- Reservation Information -->
                                   <div class="panel panel-info">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#basicInfo" aria-expanded="true">
                                                   <i class="bigger-110 ace-icon glyphicon glyphicon-minus-sign" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Reservation Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse in" id="basicInfo" aria-expanded="true" style="">
                                           @if(!empty($order))
                                           <div class="panel-body">
                                               <div class="profile-user-info">
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation Id </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->res_id }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Unit </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->hr_unit_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Buyer Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->b_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation Month </div>
                                                       <div class="profile-info-value">
                                                           <span>
                                                               <?php
                                                                 $monthNum = $order->res_month;
                                                                 $monthName = date('F',mktime(0,0,0, $monthNum, 19));
 
                                                                 echo $monthName;
                                                               ?>
                                                           </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation Year </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->res_year }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Product Type </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->prd_type_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation Quantity </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->res_quantity }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation sah </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->res_sah }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation Sweing Smv </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->res_sewing_smv }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Reservation Created </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->res_created_on }} </span>
                                                       </div>
                                                   </div>
 
 
                                               </div>
                                           </div>
                                           @else
                                           <div class="panel-body">
                                               <h3>No data found</h3>
                                           </div>
                                           @endif
                                       </div>
                                   </div>
 
                                   <!-- Order Reconciliation -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#orderReInfo">
                                                   <i class="bigger-110 ace-icon glyphicon glyphicon-minus-sign" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Order Reconciliation
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="orderReInfo">
                                           @if(!empty($order))
                                               <div class="panel-body">
                                                   <div class="profile-user-info">
 
                                                       <div class="widget-body">
                                                           <div class="row">
                                                               <div class="col-sm-12">
                                                                   <table class="table table-bordered">
                                                                       <tbody>
 
                                                                       <tr>
                                                                           <th>Name</th>
                                                                           <td>Cost/Unit</td>
                                                                           <td>Total Value</td>
                                                                       </tr>
 
                                                                       @foreach($boms as $bom)
                                                                           @if($bom->mr_material_category_mcat_id == 1 || $bom->mr_material_category_mcat_id == 4)
                                                                       <tr>
                                                                           <th>Febric Price</th>
                                                                           <td>
                                                                               <?php
                                                                               $total_price =   $bom->precost_unit_price;
 
                                                                               echo $total_price;
                                                                               ?>
                                                                           </td>
                                                                           <td><?= $total_price; ?></td>
                                                                       </tr>
                                                                       @endif
                                                                       @endforeach
 
                                                                       @foreach($boms as $bom)
                                                                           @if($bom->mr_material_category_mcat_id == 1 || $bom->mr_material_category_mcat_id == 4)
                                                                       <tr>
                                                                           <th>Fabric YY</th>
                                                                           <td>
                                                                               <?php
                                                                                   $p = ($bom->extra_percent / 100);
 
                                                                               $febric_yy = ($bom->consumption + $p);
 
                                                                               echo $febric_yy;
                                                                               ?>
                                                                           </td>
                                                                           <td>
                                                                               <?php
                                                                               $p = ($bom->extra_percent / 100);
 
                                                                               $febric_yy = ($bom->consumption + $p);
 
                                                                               $t_yy = $febric_yy * $order->order_qty;
 
                                                                               echo $t_yy;
                                                                               ?>
                                                                           </td>
                                                                       </tr>
                                                                       @endif
                                                                       @endforeach
 
                                                                       @foreach($boms as $bom)
                                                                           @if($bom->mr_material_category_mcat_id == 1 || $bom->mr_material_category_mcat_id == 4)
                                                                       <tr>
                                                                           <th>Fabric Cost</th>
                                                                           <td>
                                                                               <?php
                                                                               $total_price =   $bom->precost_unit_price;
 
                                                                               $p = ($bom->extra_percent / 100);
 
                                                                               $febric_yy = ($bom->consumption + $p);
 
                                                                               $cost = $total_price * $febric_yy;
 
                                                                               echo $cost;
                                                                                   ?>
                                                                           </td>
                                                                           <td>
                                                                               <?php
                                                                               $total_price =   $bom->precost_unit_price;
 
                                                                               $p = ($bom->extra_percent / 100);
 
                                                                               $febric_yy = ($bom->consumption + $p);
 
                                                                               $cost = $total_price * $febric_yy;
 
                                                                               $febric_cost = $cost * $order->order_qty;
 
                                                                               echo $febric_cost;
 
                                                                                   ?>
                                                                           </td>
                                                                       </tr>
                                                                           @endif
                                                                       @endforeach
 
                                                                       @foreach($boms as $bom)
                                                                           @if($bom->mr_material_category_mcat_id == 2 || $bom->mr_material_category_mcat_id == 5)
 
                                                                       <tr>
                                                                           <th>Trims</th>
                                                                           <td>
                                                                               <?php
                                                                                   $sum = 0;
                                                                                 $sum += $bom->precost_unit_price;
                                                                                 echo $sum;
                                                                               ?>
                                                                           </td>
                                                                           <td>
                                                                               <?php
                                                                               $sum = 0;
                                                                               $sum += $bom->precost_unit_price;
 
                                                                               $trim = $sum * $order->order_qty;
 
                                                                               echo $trim;
                                                                               ?>
                                                                           </td>
                                                                       </tr>
                                                                           @endif
                                                                       @endforeach
 
                                                                       <tr>
                                                                           <th>Wash</th>
                                                                           <td></td>
                                                                           <td></td>
                                                                       </tr>
 
                                                                       @foreach($other_cost as $oc)
                                                                       <tr>
                                                                           <th>CM</th>
                                                                           <td>{{ $oc->cm }}</td>
                                                                           <td>
                                                                               <?php
                                                                                  $total_cm = $oc->cm * $order->order_qty;
 
                                                                                  echo $total_cm;
                                                                               ?>
                                                                           </td>
                                                                       </tr>
                                                                       @endforeach
 
                                                                       @foreach($other_cost as $oc)
                                                                           <tr>
                                                                           <th>Fob</th>
                                                                           <td>{{ $oc->final_fob }}</td>
                                                                           <td>
                                                                               <?php
                                                                                 $total_fob = $oc->final_fob * $order->order_qty;
 
                                                                                 echo $total_fob;
                                                                               ?>
                                                                           </td>
                                                                       </tr>
                                                                           @endforeach
 
                                                                       </tbody>
                                                                   </table>
                                                               </div>
                                                           </div>
                                                       </div>
 
                                                   </div>
                                               </div>
                                           @else
                                               <div class="panel-body">
                                                   <h3>No data found</h3>
                                               </div>
                                           @endif
                                       </div>
                                   </div>
 
                                   <!-- Style Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#styleInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Style Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="styleInfo">
                                           @if(!empty($order))
                                           <div class="panel-body">
                                               <div class="profile-user-info">
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Type </div>
                                                       <div class="profile-info-value">
                                                        <span>{{ $order->stl_type }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Buyer Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->b_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style no </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->stl_no }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Product Type No </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->prd_type_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Garments Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->gmt_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Product Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->stl_product_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Description </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->stl_description }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Session Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->se_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Smv </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->stl_smv }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Added By </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->stl_addedby }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Added On </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->stl_added_on }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Style Satus </div>
                                                       <div class="profile-info-value">
                                                           <span>
                                                               @if($order->stl_status == 0)
                                                                   Created
                                                                   @elseif($order->stl_status == 1)
                                                               Submitted
                                                                   @elseif($order->stl_status == 2)
                                                               Approved
                                                                   @else
                                                               Nothing Found
                                                                   @endif
                                                           </span>
                                                       </div>
                                                   </div>
 
                                               </div>
                                           </div>
                                               @else
                                           <div class="panel-body">
                                               <h3>No Data Found</h3>
                                           </div>
                                               @endif
                                       </div>
                                   </div>
 
                                   <!-- Purchase Order Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#poInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Purchase Order Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="poInfo">
                                           @if(!empty($order))
                                           <div class="panel-body">
                                               <div class="profile-user-info">
                                                   @foreach($order_purchase as $op)
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Purchase Order Code </div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $op->order_code }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Purchase Order No </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $op->po_no }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Purchase Order Quantity </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $op->po_qty }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Purchase Order Ex Fty </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $op->po_ex_fty }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Purchase Order Delivery Country Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $op->cnt_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Country Fob </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $op->country_fob }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Remarks </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $op->remarks }} </span>
                                                       </div>
                                                   </div>
                                                       <hr>
                                                       @endforeach
 
                                               </div>
                                           </div>
                                               @else
                                           <div class="panel-body">
                                               <h3>No Data Found</h3>
                                           </div>
                                               @endif
                                       </div>
                                   </div>
 
                                   <!-- BOM Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#bomInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Bom Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="bomInfo">
                                           <div class="panel-body table-responsive">
                                               <div class="profile-user-info">
 
                                                   <div class="widget-body">
                                                       <div class="row">
                                                           <div class="col-sm-12">
                                                               <table class="table" width="50%" cellpadding="0" cellspacing="0" border="0">
                                                                   <tbody>
                                                                   @if(!empty($order))
                                                                   <tr>
                                                                       <th>Order No</th>
                                                                       <td>{{ $order->order_code }}</td>
                                                                       <th>Unit</th>
                                                                       <td>{{ $order->hr_unit_name }}</td>
                                                                       <th>Buyer</th>
                                                                       <td>{{ $order->b_name }}</td>
                                                                   </tr>
                                                                   <tr>
                                                                       <th>Brand</th>
                                                                       <td>{{ $order->br_name }}</td>
                                                                       <th>Season</th>
                                                                       <td>{{ $order->se_name }}</td>
                                                                       <th>Style No</th>
                                                                       <td>{{ $order->stl_no }}</td>
                                                                   </tr>
                                                                   <tr>
                                                                       <th>Order Quantity</th>
                                                                       <td>{{ $order->order_qty }}</td>
                                                                       <th>Delivery Date</th>
                                                                       <td>{{ $order->order_delivery_date }}</td>
                                                                       <th>Reference No</th>
                                                                       <td>{{ $order->order_ref_no }}</td>
                                                                   </tr>
                                                                       @else
                                                                       <h3>No Data Found</h3>
                                                                       @endif
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   </div>
 
                                                   <div class="widget-body">
                                                       <table id="bomItemTable" class="table table-striped table-bordered">
                                                           <thead>
                                                           <tr>
                                                               <th>Main Category</th>
                                                               <th>Item</th>
                                                               <th>Item Code</th>
                                                               <th>Description</th>
                                                               <th>Color</th>
                                                               <th>Size / Width</th>
                                                               <th>Article</th>
                                                               <th>Composition</th>
                                                               <th>Construction</th>
                                                               <th>Supplier</th>
                                                               <th>Consumption</th>
                                                               <th>Extra (%)</th>
                                                               <th>Unit</th>
                                                               <th>Terms</th>
                                                               <th>FOB</th>
                                                               <th>L/C</th>
                                                               <th>Freight</th>
                                                               <th>Unit Price</th>
                                                               <th>Total Price</th>
                                                               <th>Req. Qty</th>
                                                               <th>Total Value</th>
                                                           </tr>
                                                           </thead>
                                                           <tbody id="order-bom">
                                                           @if(count($boms)>0)
                                                           @foreach($boms as $bom)
                                                               <tr>
                                                                   <td>{{ $bom->mcat_name }}</td>
                                                                   <td>{{ $bom->item_name }}</td>
                                                                   <td>{{ $bom->item_code }}</td>
                                                                   <td>{{$bom->item_description}}</td>
                                                                   <td>{{ $bom->clr_code }}</td>
                                                                   <td>{{ $bom->size }}</td>
                                                                   <td>{{ $bom->art_name }}</td>
                                                                   <td>{{ $bom->comp_name }}</td>
                                                                   <td>{{ $bom->construction_name }}</td>
                                                                   <td>{{ $bom->sup_name }}</td>
                                                                   <td class="consumption">{{ $bom->consumption }}</td>
                                                                   <td class="extra">{{ $bom->extra_percent }}</td>
                                                                   <td>{{ $bom->uom }}</td>
                                                                   <td> {{ $bom->bom_term }}</td>
                                                                   <td> {{ $bom->precost_fob }}</td>
                                                                   <td> {{ $bom->precost_lc }}</td>
                                                                   <td> {{ $bom->precost_freight }}</td>
                                                                   <td> {{ $bom->precost_unit_price }}</td>
                                                                   <td>
                                                                       <?php
                                                                       $total_price = number_format(($bom->consumption*$bom->precost_unit_price), 2);
 
                                                                       echo $total_price;
                                                                       ?>
                                                                   </td>
                                                                   <td> {{ $bom->consumption* $bom->order_qty }} </td>
                                                                   <td> {{ $bom->precost_value }}</td>
                                                               </tr>
 
                                                           @endforeach
                                                               @else
                                                               <h3>No Data Found</h3>
                                                               @endif
                                                           </tbody>
                                                       </table>
                                                   </div>
 
                                               </div>
                                           </div>
                                       </div>
                                   </div>
 
                                   <!-- Costing Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#costingInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Costing Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="costingInfo">
                                           <div class="panel-body table-responsive">
                                               <div class="profile-user-info">
                                                   <div class="widget-body">
                                                       <table id="bomCostingTable" class="table table-bordered table-condensed">
                                                           <thead>
                                                           <tr>
                                                               <th>Main Category</th>
                                                               <th>Item</th>
                                                               <th>Item Code</th>
                                                               <th>Description</th>
                                                               <th>Color</th>
                                                               <th>Size / Width</th>
                                                               <th>Article</th>
                                                               <th>Composition</th>
                                                               <th>Construction</th>
                                                               <th>Supplier</th>
                                                               <th>Consumption</th>
                                                               <th>Extra (%)</th>
                                                               <th>Unit</th>
                                                               <th>Terms</th>
                                                               <th>FOB</th>
                                                               <th>L/C</th>
                                                               <th>Freight</th>
                                                               <th>Unit Price</th>
                                                               <th>Total Price</th>
                                                               <th>Req. Qty</th>
                                                               <th>Total Value</th>
                                                           </tr>
                                                           </thead>
                                                           <tbody>
                                                           @if(count($boms)>0)
                                                           @foreach($boms as $bom)
                                                           <tr>
                                                               <td>{{ $bom->mcat_name }}</td>
                                                               <td>{{ $bom->item_name }}</td>
                                                               <td>{{ $bom->item_code }}</td>
                                                               <td>{{$bom->item_description}}</td>
                                                               <td>{{ $bom->clr_code }}</td>
                                                               <td>{{ $bom->size }}</td>
                                                               <td>{{ $bom->art_name }}</td>
                                                               <td>{{ $bom->comp_name }}</td>
                                                               <td>{{ $bom->construction_name }}</td>
                                                               <td>{{ $bom->sup_name }}</td>
                                                               <td class="consumption">{{ $bom->consumption }}</td>
                                                               <td class="extra">{{ $bom->extra_percent }}</td>
                                                               <td>{{ $bom->uom }}</td>
                                                               <td> {{ $bom->bom_term }}</td>
                                                               <td> {{ $bom->precost_fob }}</td>
                                                               <td> {{ $bom->precost_lc }}</td>
                                                               <td> {{ $bom->precost_freight }}</td>
                                                               <td> {{ $bom->precost_unit_price }}</td>
                                                               <td>
                                                                  <?php
                                                                   $total_price = number_format(($bom->consumption*$bom->precost_unit_price), 2);
 
                                                                   echo $total_price;
                                                                   ?>
                                                               </td>
                                                               <td> {{ $bom->consumption* $bom->order_qty }} </td>
                                                               <td> {{ $bom->precost_value }}</td>
                                                           </tr>
 
                                                           <tr>
                                                               <th colspan="18" class="text-center"> Total {{ $bom->mcat_name }} Price</th>
                                                               <th>
                                                                   <?php
                                                                   $total_price = number_format(($bom->consumption*$bom->precost_unit_price), 2);
 
                                                                   echo $total_price;
                                                                   ?>
                                                               </th>
                                                               <th></th>
                                                               <th></th>
                                                           </tr>
                                                           @endforeach
                                                           @endif
                                                           @if(!empty($other_cost1))
 
 
 
                                                           <tr>
                                                               <td colspan="10" class="text-center">Testing Cost</td>
                                                               <td class="consumption">1</td>
                                                               <td>0</td>
                                                               <td>Piece</td>
                                                               <td colspan="4"></td>
                                                               <td>{{ $other_cost1->testing_cost }}</td>
                                                               <td>{{ $other_cost1->testing_cost }}</td>
                                                               <td></td>
                                                               <td></td>
                                                           </tr>
 
                                                           <tr>
                                                               <td colspan="10" class="text-center">CM</td>
                                                               <td class="consumption">1</td>
                                                               <td>0</td>
                                                               <td>Piece</td>
                                                               <td colspan="4"></td>
                                                               <td>
                                                                   {{ $other_cost1->cm }}
                                                               </td>
                                                               <td>{{ $other_cost1->cm }}</td>
                                                               <td></td>
                                                               <td></td>
                                                           </tr>
 
                                                           <tr>
                                                               <td colspan="10" class="text-right">Comercial Cost</td>
                                                               <td></td>
                                                               <td colspan="6" class="text-left"></td>
                                                               <td>{{ $other_cost1->commercial_commision }}</td>
                                                               <td>{{ $other_cost1->commercial_commision }}</td>
                                                               <td></td>
                                                               <td></td>
                                                           </tr>
 
 
                                                           <tr>
                                                               <th colspan="18" class="text-center">Net FOB </th>
                                                               <th>
                                                                  {{ $other_cost1->net_fob }}
                                                               </th>
                                                               <th></th>
                                                               <th></th>
                                                           </tr>
 
                                                           <tr>
                                                               <td colspan="10" class="text-right">Buyer Commision</td>
                                                               <td>{{ $other_cost1->buyer_comission_percent }}</td>
                                                               <td colspan="6" class="text-left">%</td>
                                                               <td>{{ $other_cost1->buyer_fob-$other_cost1->net_fob }}</td>
                                                               <td>{{ $other_cost1->buyer_fob-$other_cost1->net_fob }}</td>
                                                               <td></td>
                                                               <td></td>
                                                           </tr>
 
                                                           <tr>
                                                               <th colspan="18" class="text-center">Buyer FOB </th>
                                                               <th>
                                                                {{ $other_cost1->buyer_fob }}
                                                               </th>
                                                               <th></th>
                                                               <th></th>
                                                           </tr>
                                                           <tr>
                                                               <td colspan="10" class="text-right">Agent Commision</td>
                                                               <td>{{ $other_cost1->agent_comission_percent }}</td>
                                                               <td colspan="6" class="text-left">%</td>
 
                                                               <td>{{ $other_cost1->agent_fob-$other_cost1->buyer_fob }}</td>
                                                               <td>{{ $other_cost1->agent_fob-$other_cost1->buyer_fob }}</td>
                                                               <td></td>
                                                               <td></td>
                                                           </tr>
 
                                                           <tr>
                                                               <th colspan="18" class="text-center">Agent FOB </th>
                                                               <th>
                                                                   {{ $other_cost1->agent_fob }}
                                                               </th>
                                                               <th></th>
                                                               <th></th>
                                                           </tr>
                                                           <tr>
                                                               <th colspan="18" class="text-center">Total FOB </th>
                                                               <th>
                                                                   {{ $other_cost1->agent_fob }}
                                                               </th>
                                                               <th></th>
                                                               <th></th>
                                                           </tr>
                                                               @endif
                                                           </tbody>
                                                       </table>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
 
                                   <!-- Approval Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#approvalInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Approval Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="approvalInfo">
                                           @if(count($order_approve)>0)
                                           <div class="panel-body">
                                               <div class="profile-user-info">
                                                    @foreach($order_approve as $op)
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Order Code</div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $op->order_code }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Title</div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $op->title }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Submit By </div>
                                                       <div class="profile-info-value">
                                                           <span>
                                                               @if($op->submit_by == 1)
                                                                   Approved
                                                                   @elseif($op->submit_by == 2)
                                                               Declined
                                                                   @else
                                                               Nothing Found
                                                                   @endif
                                                           </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Submit To</div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $op->submit_to }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Comments </div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $op->comments }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Status </div>
                                                       <div class="profile-info-value">
                                                           <span>
                                                               @if($op->status == 0)
                                                                   Created
                                                               @elseif($op->status == 1)
                                                                   Submitted
                                                               @elseif($op->status == 2)
                                                                   Approved
                                                               @else
                                                                   Nothing Found
                                                               @endif
                                                           </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Created At </div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $op->created_at }}</span>
                                                       </div>
                                                   </div>
 
                                                       <hr>
 
                                                   @endforeach
 
                                               </div>
                                           </div>
                                               @else
                                           <div class="panel-body">
                                               <h3>No Data Found</h3>
                                           </div>
                                               @endif
                                       </div>
                                   </div>
 
                                   <!-- TNA Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#tnaInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   TNA Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="tnaInfo">
                                           <div class="panel-body">
                                               <div class="profile-user-info">
                                                   @if(!empty($order))
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Order Code</div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $order->order_code }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Confirm Date </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->confirm_date }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Lead Days </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->lead_days }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Tolerance Days </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->tolerance_days }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Tna Template </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->tna_temp_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Tna Template Buyer Name</div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->b_name }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Begin Date </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->begin_date }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Revise Begin Date </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->revise_begin_date }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Created AT </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->created_at }} </span>
                                                       </div>
                                                   </div>
                                                   @else
                                                       <h3>No Data Found</h3>
                                                   @endif
 
                                                   <h5 style="font-size: 13px;">Time and Action Templete</h5>
                                                   <hr>
 
                                                   <div class="col-xs-10" style="width: 300%;margin-left: -12px;">
                                                       <table class="table table-bordered" style="border:1px solid #6EAED1">
                                                           <thead>
                                                           <tr>
                                                               <th>SL</th>
                                                               <th>Activity</th>
                                                               <th>Actual Date</th>
                                                               <th>Remark</th>
                                                           </tr>
                                                           </thead>
                                                           <tbody>
                                                           @if(count($order_tna)>0)
                                                           @foreach($order_tna as $ot)
                                                           <tr>
                                                               <td>{{ $ot->id }}</td>
                                                               <td>{{ $ot->tna_lib_action }}</td>
                                                               <td>{{ $ot->actual_date }}</td>
                                                               <td></td>
                                                           </tr>
                                                               @endforeach
                                                               @else
                                                           <h3>No Data Found</h3>
                                                               @endif
                                                           </tbody>
                                                       </table>
                                                   </div>
 
                                               </div>
                                           </div>
                                       </div>
                                   </div>
 
                                   <!-- Buyer Information -->
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                               <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#buyerInfo">
                                                   <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                                                   Buyer Information
                                               </a>
                                           </h4>
                                       </div>
 
                                       <div class="panel-collapse collapse" id="buyerInfo">
                                           @if(!empty($order))
                                           <div class="panel-body">
                                               <div class="profile-user-info">
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Buyer Name</div>
                                                       <div class="profile-info-value">
                                                           <span>{{ $order->b_name }}</span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Buyer Short Name </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->b_shortname }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Buyer Address  </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->b_address }} </span>
                                                       </div>
                                                   </div>
 
                                                   <div class="profile-info-row">
                                                       <div class="profile-info-name"> Buyer Country </div>
                                                       <div class="profile-info-value">
                                                           <span> {{ $order->b_country }} </span>
                                                       </div>
                                                   </div>
 
                                               </div>
                                           </div>
                                               @else
                                           <div class="panel-body">
                                               <h3>No Data Found</h3>
                                           </div>
                                               @endif
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
 
   <script type="text/javascript">
       function myFunction() {
         $('#accordion .collapse').addClass("in");
           window.print();
           location.reload();
       }
   </script>
    @endsection