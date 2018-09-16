<!-- WRAPPER -->
<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#">
                <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Klorofil Logo" class="img-responsive logo">
                </a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						
                    @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
									<li>
										<a href="{{ route('my-profile') }}"><i class="lnr lnr-user"></i>
                                            Profile</a>
									</li>
									<li>
										<a href="{{ route('my-approvals') }}"><i class="lnr lnr-user"></i>
                                            My Approvals</a>
									</li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="lnr lnr-exit"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest


						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li> -->
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li>
							<a href="{{route('home')}}" 
							class=" @if($route = Route::current()->getName() == 'home') <?php echo "active" ?> @endif"
							><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
						</li>
						<li>
							<a href="{{route('staffs')}}" 
							class=" @if($route = Route::current()->getName() == 'staffs') <?php echo "active" ?> @endif"
							><i class="lnr lnr-user"></i> <span>Staffs</span></a>
						</li>
						<li>
							<a href="{{route('students')}}" 
							class=" @if($route = Route::current()->getName() == 'students') <?php echo "active" ?> @endif"
							><i class="lnr lnr-users"></i> <span>Students</span></a>
						</li>
						<!-- {{-- <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
						<li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
						<li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li> --}} -->
						<li>
								<a href="#subStaffAt" data-toggle="collapse" 
								class="collapsed @if($route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'student-attendance') <?php echo "active" ?> @endif"
								><i class="lnr lnr-calendar-full"></i> <span>Staff Attendance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subStaffAt" class="collapse ">
									<ul class="nav">
										<li><a href="{{route('staff-attendance')}}" class="">Make Attendance</a></li>
										<li><a href="{{route('staff-attendance-edit')}}" class="">Edit Attendance</a></li>
										<li >
											<a href="#subStaffview" data-toggle="collapse" 
											class="collapsed @if($route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'staff-attendance' || $route = Route::current()->getName() == 'staff-attendance') <?php echo "active" ?> @endif"
											><span>View Attendance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
											<div id="subStaffview" class="collapse">
												<ul class="nav">
													<li><a href="{{route('staff-attendance-view-day')}}" class="">Day</a></li>
													<li><a href="{{route('staff-attendance-view-month')}}" class="">Month</a></li>
													<li><a href="{{route('staff-attendance-view-overall')}}" class="">Overall</a></li>
												</ul>
											</div>
										</li>
									</ul>
						</li>
						<li>
							<a href="{{route('staff-approvals')}}" 
							class=" @if($route = Route::current()->getName() == 'staff-approvals') <?php echo "active" ?> @endif"
							><i class="lnr lnr-user"></i> <span>Staff Approvals</span></a>
						</li>
						<li>
								<a href="#subStudAt" data-toggle="collapse" 
								class="collapsed @if($route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'student-attendance') <?php echo "active" ?> @endif"
								><i class="lnr lnr-chart-bars"></i> <span>Student Attendance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subStudAt" class="collapse ">
									<ul class="nav">
										<li><a href="{{route('student-attendance')}}" class="">Make Attendance</a></li>
										<li><a href="{{route('student-attendance-edit')}}" class="">Edit Attendance</a></li>
										<li >
											<a href="#subStudAtView" data-toggle="collapse" 
											class="collapsed @if($route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'student-attendance' || $route = Route::current()->getName() == 'student-attendance') <?php echo "active" ?> @endif"
											><span>View Attendance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
											<div id="subStudAtView" class="collapse">
												<ul class="nav">
													<li><a href="{{route('student-attendance-view-day')}}" class="">Day</a></li>
													<li><a href="{{route('student-attendance-view-month')}}" class="">Month</a></li>
													<li><a href="{{route('student-attendance-view-overall')}}" class="">Overall</a></li>
													<li><a href="{{route('student-attendance-view-subject')}}" class="">Subject</a></li>
												</ul>
											</div>
										</li>
									<li >
									</ul>
								</div>
							</li>
						<li>
							<a href="#subSchedule" data-toggle="collapse" 
							class="collapsed @if($route = Route::current()->getName() == 'subject-home' || $route = Route::current()->getName() == 'schedule-assign' || $route = Route::current()->getName() == 'schedule-view') <?php echo "active" ?> @endif"
							><i class="lnr lnr-pie-chart"></i> <span>Student Schedule</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subSchedule" class="collapse ">
								<ul class="nav">
									<li><a href="{{route('subject-home')}}" class="">Add Subject</a></li>
									<li><a href="{{route('schedule-assign')}}" class="">Assign Schedule</a></li>
									<li><a href="{{route('schedule-view')}}" class="">View Schedule</a></li>
								</ul>
							</div>
						</li>

						
						{{-- <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
						<li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
						<li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li> --}}
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					

