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

			<li class="active">
				<a href="{{ url('merch') }}"><i class="menu-icon fa fa-home"></i>
					<span class="menu-text"> Dashboard </span>
				</a>
				<b class="arrow"></b>
			</li>
			 <!-- Capacity & Placement -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-balance-scale"></i>
					<span class="menu-text">Capacity & Placement</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch/capacity/placement') }}">
							<i class="menu-icon fa fa-caret-right"></i>Placement
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}">
							<i class="menu-icon fa fa-caret-right"></i>Reservation
						</a>
					</li>
				</ul>
			</li>
			<!-- Style & Library -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-steam-square"></i>
					<span class="menu-text">Style & Library</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch/styleLibrary/newStyle') }}">
							<i class="menu-icon fa fa-caret-right"></i>New Style
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Sample Library
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Failed History
						</a>
					</li>
				</ul>
			</li>
			<!-- Orders & PO -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-cart-plus"></i>
					<span class="menu-text">Orders & PO</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Order Confirmation
						</a>
					</li>
					<li>
						<a href="{{ url('merch/orders/productInfo') }}">
							<i class="menu-icon fa fa-caret-right"></i>Product Information
						</a>
					</li>
					<li>
						<a href="{{ url('merch/orders/poInput') }}">
							<i class="menu-icon fa fa-caret-right"></i>PO Processing
						</a>
					</li>
				</ul>
			</li>
			<!-- Costing -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-money"></i>
					<span class="menu-text">Costing</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Fabric
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Trims
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Wash
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>CM
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>SMV
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Consumption
						</a>
					</li>
				</ul>
			</li>

			<!-- Order BOM & Booking -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-hourglass"></i>
					<span class="menu-text">Order BOM & Booking</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch/bom/bom') }}">
							<i class="menu-icon fa fa-caret-right"></i>BOM Analysis
						</a>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Booking
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
                        <ul class="submenu">
                        	<li>
								<a href="#"><i class="menu-icon fa fa-caret-right"></i>Fabric</a>
								<b class="arrow"></b>
							</li>
                        	<li>
								<a href="#"><i class="menu-icon fa fa-caret-right"></i>Trims</a>
								<b class="arrow"></b>
							</li>
                            <li>
								<a href="#"><i class="menu-icon fa fa-caret-right"></i>Others</a>
								<b class="arrow"></b>
							</li>
                        </ul>
                    </li>
				</ul>
			</li>
			<!-- Samples -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-camera"></i>
					<span class="menu-text">Samples</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Sample Library
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Sample Cost
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Sample Inspection
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Sample Requisition Chart
						</a>
					</li>
				</ul>
			</li>
			<!-- Tracking -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-motorcycle"></i>
					<span class="menu-text">Tracking</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Pre-Production Activities
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>WIP
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Inventory Final Inspection Reports
						</a>
					</li>
					<li>
						<a href="{{ url('merch/tracking/tna') }}">
							<i class="menu-icon fa fa-caret-right"></i>T & A
						</a>
					</li>
					<li>
						<a href="{{ url('merch') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-caret-right"></i>Mapping
						</a>
					</li>
				</ul>
			</li>
			<!-- Setup -->
			<li>
				<a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-cogs"></i>
					<span class="menu-text">Setup</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b> 
				<ul class="submenu">
					<li>
						<a href="{{ url('merch/setup/buyer') }}">
							<i class="menu-icon fa fa-caret-right"></i>Buyer
						</a>
					</li>
					<li>
						<a href="{{ url('merch/setup/season') }}">
							<i class="menu-icon fa fa-caret-right"></i>Season
						</a>
					</li>
					<li>
						<a href="{{ url('merch/setup/brand') }}">
							<i class="menu-icon fa fa-caret-right"></i>Brand
						</a>
					</li>
					<li>
						<a href="{{ url('merch/setup/supplier') }}">
							<i class="menu-icon fa fa-caret-right"></i>Supplier
						</a>
					</li>
				</ul>
			</li>

		</ul>
    <!-- Left sidebar menu end-->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
