@extends('merch.index')
@section('content')
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="ace-icon fa fa-home home-icon"></i>Marchendising</a>
        </li>
        <li>
          <a href="#">Buyer Info</a>
        </li>
        <li>
          <a href="#">Buyer</a>
        </li>
        <li class="active">Buyer Profile</li>
      </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
      <div class="page-header row">
        <h1 class="col-sm-6">Marchendising<small> <i class="ace-icon fa fa-angle-double-right"></i> Buyer Profile</small></h1>
        <div class="text-right">
          <!-- <div class="btn-group">
          <a href='{{ url("hr/ess/leave_application") }}' class="btn btn-sm btn-success" title="Leave Application"><i class="fa fa-file-text"></i></a>
          <a href='{{ url("hr/ess/loan_application") }}' class="btn btn-sm btn-primary" title="Loan Application"><i class="fa fa-money"></i></a>
        </div> -->
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div id="user-profile-1" class="user-profile row">
          <div class="col-sm-3 center">
            <div>
              <span class="profile-picture">
                <img id="avatar" style="width: 180px; height: 200px;" class="img-responsive" alt="profile picture" src="{{ asset(!empty($style->stl_img_link)?$style->stl_img_link:'assets/images/avatars/profile-pic.jpg') }}"/>
              </span>
              <div class="space-4"></div>
              <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                <div class="inline position-relative">
                  <a href="#" class="user-title-label">
                    <span class="white">{{ $buyerInfo->b_name}}</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="space-6"></div>
            <!-- <div class="profile-contact-info">
              <div class="profile-contact-links align-left">
                <p style="text-align: center;"><strong>Buyer Short Name:</strong> {{ $buyerInfo->b_shortname }}</p>
                <p style="text-align: center;"><strong>Buyer Country:</strong> {{ $buyerInfo->b_country }}</p>
              </div>
            </div> -->
          </div>
          <div class="col-sm-9">
            <div id="accordion" class="accordion-style1 panel-group accordion-style2">
              <!-- Basic Information -->
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#basicInfo" aria-expanded="true">
                      <i class="bigger-110 ace-icon glyphicon glyphicon-minus-sign" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Basic Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse in" id="basicInfo" aria-expanded="true" style="">
                  <div class="panel-body">
                    <div class="profile-user-info">
                      <div class="profile-info-row">
                        <div class="profile-info-name"> Buyer Name </div>
                        <div class="profile-info-value">
                          <span>{{ $buyerInfo->b_name}} </span>
                        </div>
                      </div>
                      <div class="profile-info-row">
                        <div class="profile-info-name"> Buyer Short Name </div>
                        <div class="profile-info-value">
                          <span> {{ $buyerInfo->b_shortname }} </span>
                        </div>
                      </div>
                      <div class="profile-info-row">
                        <div class="profile-info-name"> Buyer Country </div>
                        <div class="profile-info-value">
                          <span> {{ $buyerInfo->b_country }} </span>
                        </div>
                      </div>
                      <div class="profile-info-row">
                        <div class="profile-info-name"> Buyer Contact Person </div>
                        <div class="profile-info-value">
                          <span> {{ $buyerInfo->bcontact_person }} </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Advance Information -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#advanceInfo">
                      <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Sample Type Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="advanceInfo">
                  <div class="panel-body">
                    <div class="profile-user-info">
                      <div class="profile-info-row">
                        <div class="profile-info-name"> Sample Name </div>
                        <div class="profile-info-value">
                          <span>
                            <?php foreach ($sampleType as $sample) {?>
                              <strong>
                                {{ $sample->sample_name }}
                              </strong>
                            <?php  } ?>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Product Size Group Info  -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#productSizeInfo">
                      <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Product Size Group Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="productSizeInfo">
                  <div class="panel-body">
                    <div class="profile-user-info">
                      <div class="widget-body">
                        <table id="dataTables" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Size Group</th>
                              <th>Product Type </th>
                              <th>Gender</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($prodsizegroup as $prod)
                            <tr>
                              <td>{{ $prod->size_grp_name }}</td>
                              <td>{{ $prod->size_grp_product_type }}</td>
                              <td>{{ $prod->size_grp_gender }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Brand Info  -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#brandInfo">
                      <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Brand Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="brandInfo">
                  <div class="panel-body">
                    <div class="profile-user-info">
                      <div class="widget-body">
                        <table id="dataTables_brand" class="table table-striped table-bordered responsive">
                          <thead>
                            <tr>
                              <th>Brand Name</th>
                              <th>Brand Short Name</th>
                              <th>Country</th>
                              <th>Contact Person</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($brands as $brand)
                            <tr>
                              <td>{{ $brand->br_name }}</td>
                              <td>{{ $brand->br_shortname }}</td>
                              <td>{{ $brand->br_country}}</td>
                              <td>{!! $brand->brcontact_person !!}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Season Info -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#seasonInfo">
                      <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Season Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="seasonInfo">
                  <div class="panel-body">
                    <div class="profile-user-info">
                      <div class="widget-body">
                        <table id="dataTables" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Season Name</th>
                              <th>Start Month-Year</th>
                              <th>End Month-Year</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($seasons as $season)
                            <tr>
                              <td>{{ $season->se_name }}</td>
                              <td>{{ $season->se_start }}</td>
                              <td>{{ $season->se_end}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#styleInfo">
                      <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Style Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="styleInfo">
                  <div class="panel-body">
                    <div class="widget-body">
                      <table id="bomItemTable" class="custom-font-table table table-bordered">
                        <thead>
                          <tr>
                            <th>Style Name</th>
                            <th>Production Type</th>
                            <th>Product Name</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(count($styles)==0){ ?>
                            <tr >
                              <td  colspan="4" ><h4 class="text-center">No style found for this Buyer</h4></td>
                            </tr>
                          <?php }else{ ?>
                            <?php foreach ($styles as $style) {

                              ?>
                              <tr>
                                <td><a href="{{url('merch/style/style_profile',$style->stl_id)}}" >{{ $style->stl_no}}</a></td>
                                <th>{{ $style->stl_type}}</th>
                                <th>{{ $style->stl_product_name}}</th>
                                <th>{{ $style->stl_description}}</th>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div><!-- /.col -->
                  </div>
                </div>
              </div>
              <!-- Order Information  -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#EducationHistory">
                      <i class="ace-icon glyphicon glyphicon-plus-sign bigger-110" data-icon-hide="ace-icon glyphicon glyphicon-minus-sign" data-icon-show="ace-icon glyphicon glyphicon-plus-sign"></i>
                      Order Info
                    </a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="EducationHistory">
                  <div class="panel-body">
                    <div class="widget-body">
                      <table id="bomItemTable" class="custom-font-table table table-bordered">
                        <thead>
                          <tr>
                            <th>Order Code</th>
                            <th>Order Referance No</th>
                            <th>Order Quantity</th>
                            <th>Order Delivery Date</th>
                            <th width="80">Order Status</th>
                            <th width="80">Brand Name</th>
                            <th width="80">Season Name</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(count($orders)==0){ ?>
                            <tr >
                              <td  colspan="8" ><h4 class="text-center">No Order found for this Buyer</h4></td>
                            </tr>
                          <?php }else{ ?>
                            <?php foreach ($orders as $order) {

                              ?>
                              <tr>
                                <td><a href="{{url('merch/orders/order_profile_show',$order->order_id)}}" >{{ $order->order_code}}</a></td>
                                <th>{{ $order->order_ref_no}}</th>
                                <th>{{ $order->order_qty}}</th>
                                <th>{{ $order->order_delivery_date}}</th>
                                <th width="80">{{ $order->order_status}}</th>
                                <th width="80">{{ $order->br_name}}</th>
                                <th width="80">{{ $order->se_name}}</th>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div><!-- /.col -->
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
<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->



@endsection
