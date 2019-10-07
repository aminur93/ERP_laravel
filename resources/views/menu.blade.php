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
			<a href="/">
				<i class="menu-icon fa fa-home"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="">
			<a href="{{ url('merch/dashboard') }}">
            
				<i class="menu-icon fa fa-industry"></i>
				<span class="menu-text"> Merchandising </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="">
			<a href="{{ url('commercial/dashboard') }}">
				<i class="menu-icon fa fa-money"></i>
				<span class="menu-text"> Commercial </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('hr') }}">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Human Resource </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('planning') }}">
				<i class="menu-icon fa fa-line-chart"></i>
				<span class="menu-text"> Planning </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('manufacturing') }}">
				<i class="menu-icon fa fa-truck"></i>
				<span class="menu-text"> Manufacturing </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('wash') }}">
				<i class="menu-icon fa fa-shopping-cart"></i>
				<span class="menu-text"> Wash </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('store') }}">
				<i class="menu-icon fa fa-institution"></i>
				<span class="menu-text"> Store </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('csr') }}">
				<i class="menu-icon fa fa-shopping-basket"></i>
				<span class="menu-text"> CSR </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a href="{{ url('compliance') }}">
				<i class="menu-icon fa fa-recycle"></i>
				<span class="menu-text"> Compliance </span>
			</a>

			<b class="arrow"></b>
		</li>
        
        <li class="">
			<a id="bootbox-confirm" href="{{ url('account_finance') }}">
				<i class="menu-icon fa fa-suitcase"></i>
				<span class="menu-text"> Account Finance </span>
			</a>

			<b class="arrow"></b>
		</li> 

		<!-- Starts of Setup -->
		<li>
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cogs"></i>
				<span class="menu-text"> Setup </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>
			<ul class="submenu">
				<li>
					<a href="{{ url('global/setup/user/registration') }}"><i class="menu-icon fa fa-caret-right"></i>Add User</a>
					<b class="arrow"></b>
				</li>
				<li>
					<a href="{{ url('global/setup/user/list') }}"><i class="menu-icon fa fa-caret-right"></i>User List</a>
					<b class="arrow"></b>
				</li> 
			</ul>
		</li>
		<!-- Ends of Setup -->		 
	</ul>
    
    <!-- Left sidebar menu end-->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
