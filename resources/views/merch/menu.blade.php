<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>
	<div id="sidebar" class="sidebar responsive ace-save-state">
		<script type="text/javascript">
			try{ace.settings.loadState('sidebar')}catch(e){}
		</script>

		<!-- Left sidebar menu start-->
		<ul class="nav nav-list">

			<li class="{{ (request()->segment(2)=='dashboard'?'active':'') }}">
				<a href="{{ url('merch/dashboard') }}"><i class="menu-icon fa fa-home"></i>
					<span class="menu-text">Merchandising </span>
				</a>
				<b class="arrow"></b>
			</li>
			<!-- Style-->
			<li>
			<!-- Setup -->

			<li class="{{ (request()->segment(2)=='style'?'active':'') }}">
				<a href="#" class=""> <i class="menu-icon glyphicon glyphicon-scissors"></i>
					<span class="menu-text">Style</span>

				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li >
						<a href="{{ url('merch/style/style_new') }}"> <i class="menu-icon fa fa-steam-square"></i>
							<span class="menu-text">New Style</span>
						</a>
					</li>
					<!-- Report-->
					<li>
						<a href="{{ url('merch/style/style_list') }}" > <i class="menu-icon fa fa-steam-square"></i>
							<span class="menu-text">Style List</span>
						</a>
					</li>
					<li>
						<a href="{{ url('merch/style/create_bulk') }}" > <i class="menu-icon fa fa-steam-square"></i>
							<span class="menu-text">Create Bulk</span>
						</a>
					</li>
					<li>
						<a href="{{ url('merch/style/style_copy_search') }}" > <i class="menu-icon fa fa-steam-square"></i>
							<span class="menu-text">Style Copy</span>
						</a>
					</li>

				</ul>

			</li>
			</li>
			<!-- Style BOM -->
			<li class="{{ (request()->segment(2)=='style_bom'?'active':'') }}">
				<a href="{{ url('merch/style_bom') }}"> <i class="menu-icon fa fa-file-text"></i> <span class="menu-text">Style BOM</span>
				</a>
			</li>
			<!-- Style Costing -->
			<li class="{{ (request()->segment(2)=='style_costing'?'active':'') }}">
				<a href="{{ url('merch/style_costing') }}"> <i class="menu-icon fa fa-usd"></i>
					<span class="menu-text">Style Costing</span>
				</a>
			</li>

			<!-- Reservation-->
			<li class="{{ (request()->segment(2)=='reservation'?'active':'')}}">
				<a href="{{ url('merch/reservation/reservation_list') }}"> <i class="menu-icon fa fa-ticket"></i>
					<span class="menu-text">Reservation</span>
				</a>
			</li>

			<!-- Order-->
			<li class="{{ (request()->segment(2)=='orders'?'active':'') }}">
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-shopping-cart"></i>
					<span class="menu-text">Order</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<!-- order list -->
					<li>
						<a href="{{ url('merch/orders/order_list') }}">
							<i class="menu-icon fa fa-caret-right"></i>Order List
						</a>
					</li>
					<!-- order profile -->
					<li>
						<a href="{{ url('merch/order_profile') }}">
							<i class="menu-icon fa fa-caret-right"></i>Order Profile
						</a>
					</li>

				</ul>
			</li>

			<!-- Time and Action-->
			<li class="{{ (request()->segment(2)=='time_action'?'active':'') }}">
				<a href="{{ url('merch/time_action/tna_order_list') }}" ><i class="menu-icon fa fa-calendar"></i>
					<span class="menu-text">Time and Action</span>

				</a>
				<b class="arrow"></b>
				<ul class="submenu">

			        <li>
						<a href="{{ url('merch/time_action/library') }}">
							<i class="menu-icon fa fa-caret-right"></i> TNA Library
						</a>
					</li>
					<li>
						<a href="{{ url('merch/time_action/tna_template') }}">
							<i class="menu-icon fa fa-caret-right"></i> TNA Template
						</a>
					</li>

					<li>
						<a href="{{ url('merch/time_action/tna_order_list') }}">
							<i class="menu-icon fa fa-caret-right"></i> Order TNA List
						</a>
					</li>
					<li>
						<a href="{{ url('merch/time_action/tna_order') }}">
							<i class="menu-icon fa fa-caret-right"></i> Order TNA
						</a>
					</li>


				</ul>
			</li>
			<!-- Order BOM-->
			<li class="{{ (request()->segment(2)=='order_bom'?'active':'')}}">
				<a href="{{ url('merch/order_bom')}}"> <i class="menu-icon fa fa-steam-square"></i>
					<span class="menu-text">Order BOM</span>
				</a>
			</li>

			<!-- Order Costing-->
			<li class="{{ (request()->segment(2)=='order_costing'?'active':'')}}">
				<a href="{{ url('merch/order_costing')}}"> <i class="menu-icon fa fa-steam-square"></i>
					<span class="menu-text">Order Costing</span>
				</a>
			</li>

			<!-- Order Booking-->
			<li class="{{ (request()->segment(2)=='order_breakdown'?'active':'')}}">
				<a href="{{ url('merch/order_breakdown')}}"> <i class="menu-icon fa fa-steam-square"></i>
					<span class="menu-text">Order Breakdown</span>
				</a>
			</li>


			<!-- Order Booking-->
			<li class="{{ (request()->segment(2)=='order_booking'?'active':'')}}">
				<a href="{{ url('merch/order_booking')}}"> <i class="menu-icon fa fa-steam-square"></i>
					<span class="menu-text">Order Booking</span>
				</a>
			</li>
			<!-- Report-->

			<li class="{{ (request()->segment(3)=='report_view'?'active':'')}}">
				
				<a href="{{ url('merch/report/report_view')}}" > <i class="menu-icon fa fa-table"></i>

					<span class="menu-text">Report</span>
					{{-- <b class="arrow fa fa-angle-down"></b> --}}
				</a>
				<ul class="submenu">
					{{-- Abir's Addition Start --}}
							<li class="{{ (request()->segment(3)=='tna_due_report'?'active':'')}}">
								<a href="{{ url('merch/report/report_view/tna_due_report') }}">
									<i class="menu-icon fa fa-caret-right"></i>Time and Action Due Report
								</a>
							</li>
					{{-- Abir's Addition End --}}
					
				</ul>
			</li>
			<!-- Setup -->
			@can("mr_setup")
			<li class="{{ (request()->segment(2)=='setup'?'active':'') }}">
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-cogs"></i>
					<span class="menu-text">Setup</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<!-- Sample Type -->
					<li>
						<a href="{{ url('merch/setup/sampletype') }}">
							<i class="menu-icon fa fa-caret-right"></i>Sample Type
						</a>
					</li>
					<!-- Product Size -->
					<li>
						<a href="{{ url('merch/setup/productsize') }}">
							<i class="menu-icon fa fa-caret-right"></i> Size Group
						</a>
					</li>
					<!-- Buyer Info -->
					<li>
						<a href="{{ url('merch/setup/buyer_info') }}">
							<i class="menu-icon fa fa-caret-right"></i>Buyer Info
						</a>
					</li>
					<!-- Brand Info -->
					{{-- <li>
						<a href="{{ url('merch/setup/brand') }}">
							<i class="menu-icon fa fa-caret-right"></i> Brand
						</a>
					</li> --}}
					<!-- Product Type -->
					<li>
						<a href="{{ url('merch/setup/product_type') }}">
							<i class="menu-icon fa fa-caret-right"></i> Product Type
						</a>
					</li>
					<!-- Garments Type  -->
					<li>
						<a href="{{ url('merch/setup/garments_type') }}">
							<i class="menu-icon fa fa-caret-right"></i> Garments Type
						</a>
					</li>
					<!-- Season -->
					<li>
						<a href="{{ url('merch/setup/season') }}">
							<i class="menu-icon fa fa-caret-right"></i> Season
						</a>
					</li>
					<!-- Supplier Info -->
					<li>
						<a href="{{ url('merch/setup/supplier') }}">
							<i class="menu-icon fa fa-caret-right"></i>Supplier Info
						</a>
					</li>
					<!-- Materials -->
	                <li>
						<a href="{{ url('merch/setup/supplier') }}">
							<i class="menu-icon fa fa-caret-right"></i>Materials
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
                        <ul class="submenu">
                        	<li>
								<a href="{{ url('merch/setup/item') }}"><i class="menu-icon fa fa-caret-right"></i>Item</a>
							</li>
							s
							<li>
								<a href="{{ url('merch/setup/color') }}"><i class="menu-icon fa fa-caret-right"></i>Color </a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<!-- Article Construction & Composition -->
	                <li>
						<a href="{{ url('merch/setup/article') }}">
							<i class="menu-icon fa fa-caret-right"></i>Article Construction & Composition
						</a>
					</li>
					<!-- Operation -->
					<li>
						<a href="{{ url('merch/setup/operation') }}">
							<i class="menu-icon fa fa-caret-right"></i> Operation
						</a>
					</li>
					<!-- Special Machine -->
                    <li>
						<a href="{{ url('merch/setup/spmachine') }}">
							<i class="menu-icon fa fa-caret-right"></i> Special Machine
						</a>
					</li>

					<!-- Wash Category -->
                    <li>
						<a href="{{ url('merch/setup/wash_category') }}">
							<i class="menu-icon fa fa-caret-right"></i> Wash Catergory
						</a>
					</li>
					<!-- Wash Type -->
                    <li>
						<a href="{{ url('merch/setup/wash_type') }}">
							<i class="menu-icon fa fa-caret-right"></i> Wash Type
						</a>
					</li>
					<!-- TNA Setup -->
					<li>
						<a href="{{ url('merch/time_action/library') }}">
							<i class="menu-icon fa fa-caret-right"></i>TNA Library
						</a>
					</li>
					<li>
						<a href="{{ url('merch/time_action/tna_template') }}">
							<i class="menu-icon fa fa-caret-right"></i> TNA Template
						</a>
					</li>
					<!-- Approval Hirarchy -->
                    <li>
						<a href="{{ url('merch/setup/approval') }}">
							<i class="menu-icon fa fa-caret-right"></i>  Approval Hirarchy
						</a>
					</li>
					<!-- LOG File-->
                    <!-- <li>
                    	<a href="{{ asset('assets/log.txt') }}" target="_blink">Log File</a>

					</li> -->
				</ul>
			</li>
			@endcan

				

			

		</ul>
    <!-- Left sidebar menu end-->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
