<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="{{ url('/dashboard') }}" class="navbar-brand">
						<small><img src="assets/images/avatars/mbm_logo.png" height="21px" style="padding: 0px;" class="msg-photo" alt="Logo" /> Dashboard</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav"> 
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
<!-- 								<li>
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