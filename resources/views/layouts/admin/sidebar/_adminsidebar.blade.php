<div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a href="{{ route('dashboard')}}"aria-expanded="false">
							<i class="fas fa-home"></i>
							<span class="nav-text">Dashboard</span>
						</a>

                    </li>

					<li><a href="{{ route('appointment.index')}}" aria-expanded="false">
							<i class="fas fa-calendar-check"></i>
							<span class="nav-text">Appointments</span>
						</a>
					</li>

					<li><a href="{{ route('user.index')}}" aria-expanded="false">
							<i class="fas fa-user"></i>
							<span class="nav-text">Users</span>
						</a>
					</li>

					<li><a href="{{ route('dschedule.index')}}" aria-expanded="false">
							<i class="fas fa-user-md"></i>
							<span class="nav-text">Doctors</span>
						</a>
					</li>
					<li><a href="{{ route('patient.info')}}" aria-expanded="false">
							<i class="fas fa-hospital-user"></i>
							<span class="nav-text">Patients</span>
						</a>
					</li>
					<li><a href="javascript:void()" aria-expanded="false">
							<i class="fas fa-file-invoice-dollar"></i>
							<span class="nav-text">Billing and Invoice</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="{{ route('billing.index')}}">Billing</a></li>
							<li><a href="{{ route('billing.invoice')}}">Invoice</a></li>	
						</ul>

                    </li>
				</ul>
			</div>
        </div>