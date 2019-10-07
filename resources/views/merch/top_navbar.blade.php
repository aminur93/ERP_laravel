<div id="navbar" class="navbar navbar-default          ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">

			<a href="{{ url('dashboard') }}" class="navbar-brand">
				<small><img src="{{ asset('assets/images/avatars/mbm_logo.png') }}" height="21px" style="padding: 0px;" class="msg-photo" alt="Alex's Avatar" /> Dashboard</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">

			<?php
				// show style costing approval notification
				// get notification for auth user
		    	$StylecostAppNotify = DB::table("mr_stl_costing_approval AS c")
		    		->select("c.mr_style_stl_id", "s.stl_no")
		    		->leftJoin("mr_style AS s", "s.stl_id", "=", "c.mr_style_stl_id")
		    		->where("c.status", "1")
		    		->where("c.submit_to", auth()->user()->associate_id)
		    		->get();

		    	//Order Cost Approval Notification
		    	$OrdercostAppNotify = DB::table("mr_order_costing_approval AS c")
		    		->select("c.mr_order_bom_n_costing_id", "odr.order_code")
		    		->leftJoin("mr_order_entry AS odr", "odr.order_id", "=", "c.mr_order_bom_n_costing_id")
		    		->where("c.status", "1")
		    		->where("c.submit_to", auth()->user()->associate_id)
		    		->get();

		    	//Reservation and Order Qunatity Notification
		    	//Show Notification for the reservations which have dateline two month later
					$supplierApprovalAppNotify = DB::table("mr_supplier_approval AS c")
									    		->select("c.sup_id", "s.sup_name")
									    		->leftJoin("mr_supplier AS s", "s.sup_id", "=", "c.sup_id")
									    		->where("c.status", "1")
									    		->where("c.submit_to", auth()->user()->associate_id)
									    		->get();

		    	$reservation_notifs= DB::table('mr_order_entry AS oe')
		    						->select([
		    							"oe.res_id",
		    							DB::raw("SUM(oe.order_qty) AS total_order"),
		    							'cr.res_quantity'
		    						])
		    						->groupBy('oe.res_id')
	    							->join('mr_capacity_reservation AS cr', 'cr.res_id', 'oe.res_id')
	    							->where('cr.res_month', '>=', date('m', strtotime("month")))
	    							->where('cr.res_month', '<=', date('m', strtotime("+2 month")))
	    							// ->where(function($query) use(total_order){
	    							// 	$query->where('cr.res_quantity' '>', 'total_order')
	    							// })
	    							//->where('ototal_order', '<', 10000)
	    							->whereIn('cr.hr_unit_id', auth()->user()->unit_permissions())
	    							->whereIn('cr.b_id', auth()->user()->buyer_permissions())

	    							->get();
	    				$res_notifs= 0;
		    	foreach ($reservation_notifs as &$nof) {
					    if($nof->total_order < $nof->res_quantity) {
					    	$res_notifs++;
					    }
					}

		    	$total_notif= $StylecostAppNotify->count()+ $OrdercostAppNotify->count()+$supplierApprovalAppNotify->count()+$res_notifs;

    		?>

    		<?php
    		/// TNA Notification

	    		date_default_timezone_set('Asia/Dhaka');
	            $now = date("d-m-Y");

	            $order_en=DB::table('mr_order_tna AS t')
		            ->select(
		                "t.id",
		                "t.lead_days",
		                "t.tolerance_days",
		                "t.mr_tna_template_id",
		                "e.order_delivery_date"
		             )
		            ->leftJoin('mr_order_entry AS e', 'e.order_id', '=', 't.order_id')

	            ->get();
	        // dd($order_en);
 			   $tnas_for_notif= array();
			   foreach ($order_en as $order) {

			             // SyS Gen. Date
                            $delv_date=$order->order_delivery_date;
                            $date=date_create($delv_date);
                            $GDD=date_format($date,"Y/m/d");

                            $lead_tole= $order->lead_days+$order->tolerance_days ;
                            $yy=date('Y-m-d', strtotime('-'.$lead_tole.' day', strtotime($GDD)));
                            $offset=0;

                            $library= DB::table('mr_order_tna_action AS ta')
                                         ->select([
                                                      'ta.*',
                                                      'ttl.id AS tl_id',
                                                      'ttl.tna_temp_logic',
                                                      'ttl.offset_day'

                                                  ])
                                        ->leftJoin('mr_order_tna AS ot', 'ot.id', '=', 'ta.mr_order_entry_order_id')
                                        ->leftJoin('mr_tna_template AS tm', 'tm.id', '=', 'ot.mr_tna_template_id')
                                        ->leftJoin('mr_tna_library AS tl', 'tl.id', '=', 'ta.mr_tna_library_id')
                                        ->leftJoin('mr_tna_template_to_library AS ttl', 'ttl.mr_tna_library_id', '=', 'tl.id')
                                        ->where('ta.mr_order_entry_order_id', $order->id)
                                        ->where('ttl.mr_tna_template_id', $order->mr_tna_template_id)
                                        ->get();


			            foreach($library AS $lib){

		                   // Offset day

                                  $libray2=DB::table('mr_tna_template_to_library AS l')
                                    ->select([
                                              'l.id',
                                              'l.offset_day'

                                          ])

                                  ->where('l.mr_tna_template_id', $order->mr_tna_template_id)
                                  ->where('l.id','>', $lib->tl_id)
                                  ->get();

                                  $offset2=$lib->offset_day;

                                   foreach($libray2 AS $lib2){
                                     $offset2+=$lib2->offset_day;
                                   }
                                ///

			                if(empty($lib->actual_date)){

	                                 if($lib->tna_temp_logic=="OK to Begin"){

	                                      $offset=$lib->offset_day;
	                                      $sg_date=date('d-m-Y', strtotime('-'.$offset2.' day', strtotime($yy)));

	                                      $start = new DateTime($now);
	                                      $end = new DateTime($sg_date);
	                                      $interval = $end->diff($start);

	                                      // %a will output the total number of days.
	                                       $notif=$interval->format('%a');
	                                         if($notif>=0 && $notif<=7) {
	                                            $tnas_for_notif[]= $order->id;
	                                          }

	                                  }
					                 if($lib->tna_temp_logic=="DCD or FOB"){

	                                    $offset=$lib->offset_day;
	                                      $sg_date=date('d-m-Y', strtotime('-'.$offset2.' day', strtotime($GDD)));


	                                      $start = new DateTime($now);
	                                      $end = new DateTime($sg_date);
	                                      $interval = $end->diff($start);

	                                      // %a will output the total number of days.
	                                       $notif=$interval->format('%a');
	                                         if($notif>=0 && $notif<=7) {
	                                            $tnas_for_notif[]= $order->id;
	                                          }

	                                  }
				               }

			            }

		       }

		        $tnas_for_notif_count= sizeof($tnas_for_notif);
		        $total_notif+= $tnas_for_notif_count;

    ?>

				<li class=" dropdown-modal">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-bell icon-animated-bell"></i>
						<span class="badge badge-important">{{ $total_notif}} </span>
					</a>

					<ul class="dropdown-menu-right dropdown-navbar navbar-light dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar navbar-pink">
								@if($StylecostAppNotify->count()>0)
									<li>
										<span>{{ $StylecostAppNotify->count() }} Styles costing need approval</span>
									</li>
								@endif
								@foreach($StylecostAppNotify AS $notify)
									<li>
										<a href='{{ url("merch/style_costing/$notify->mr_style_stl_id/edit") }}'>
											<div class="clearfix">
												<span class="pull-left">
													<i class="btn btn-xs no-hover btn-primary fa fa-dollar"></i>
													Style - {{ ucfirst($notify->stl_no) }}
												</span>
											</div>
										</a>
									</li>
								@endforeach
								@if($supplierApprovalAppNotify->count()>0)
									<li>
										<span>{{$supplierApprovalAppNotify->count() }} Supplier need approval</span>
									</li>
								@endif
								@foreach($supplierApprovalAppNotify AS $notify)
									<li>
										<a href='{{ url("merch/setup/supplier_edit/$notify->sup_id") }}'>
											<div class="clearfix">
												<span class="pull-left">
													<i class="btn btn-xs no-hover btn-primary fa fa-dollar"></i>
													Supplier - {{ ucfirst($notify->sup_name) }}
												</span>
											</div>
										</a>
									</li>
								@endforeach
								@if($OrdercostAppNotify->count()>0)
									<li>
										<span>{{ $OrdercostAppNotify->count() }} Orders Costing need approval</span>
									</li>
								@endif
								@foreach($OrdercostAppNotify AS $notify)
									<li>
										<a href='{{ url("merch/order_costing/$notify->mr_order_bom_n_costing_id/edit") }}'>
											<div class="clearfix">
												<span class="pull-left">
													<i class="btn btn-xs no-hover btn-primary fa fa-dollar"></i>
													Order - {{ ucfirst($notify->order_code) }}
												</span>
											</div>
										</a>
									</li>
								@endforeach
								@if($res_notifs>0)
									<li>
										<span>{{$res_notifs}} Reservations action required</span>
									</li>
								@endif
								@foreach($reservation_notifs AS $nof)
									@if($nof->total_order < $nof->res_quantity)
										<li>
											<a href='{{ url("merch/orders/order_entry/".$nof->res_id) }}'>
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-primary fa fa-dollar"></i>
														Reservation - {{ ucfirst($nof->res_id) }}
													</span>
												</div>
											</a>
										</li>
									@endif
								@endforeach



								<!--TNA Notification--->
								@if(count($tnas_for_notif)>0)
									@foreach($tnas_for_notif AS $nf)
										<li>
											<a href='{{ url("merch/time_action/tna_order_edit/".$nf) }}'>
												<div class="clearfix">
													<span class="pull-left">
													<!-- 	<i class="btn btn-xs no-hover btn-primary fa fa-dollar"></i> -->
													<i class="fa fa-bell"></i>
														TNA Notification Pending
													</span>
												</div>
											</a>
										</li>
									@endforeach
								@endif
								@if($total_notif==0)
									<li>No approval and TNA notification</li>
								@endif

							</ul>
						</li>
					</ul>
				</li>

				<li class="light-blue dropdown-modal">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<img class="nav-user-photo" src="{{ asset(!empty($user->as_pic)?$user->as_pic:'assets/images/avatars/profile-pic.jpg') }}" alt="Profile Photo" />
						<span class="user-info">
							<small>Welcome,</small>
							{{ Auth::user()->name }}
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<!-- <li>
							<a href="#">
								<i class="ace-icon fa fa-cog"></i>
								Settings
							</a>
						</li> -->

						<li>
							<a href="{{ url('hr/user/profile') }}">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>
