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
					<li><a href="{{ route('patient.profile', Auth::user()->patient->id)}}" aria-expanded="false">
							<i class="fas fa-id-card-alt"></i>
							<span class="nav-text">Medical Profile</span>
						</a>
					</li>
				</ul>
			</div>
        </div>