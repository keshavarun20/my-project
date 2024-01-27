<div class="row">
    <div class="mb-3 col-md-10">
        <label class="form-label" for="role_id">Role</label>
        <select id="role_id" name="role_id" class="default-select form-control wide">
            <option value="">Choose...</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>
{{-- Patient Information --}}
<div id="patient-info" class="d-none" >
    <div class="row">
        <div class="mb-3 col-md-10">
            <label class="form-label" for="dob">Today's Date</label>
            <input  type="date" name="today_date" class=" form-control" placeholder="Today's Date" >
            @error('today_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="name">First Name</label>
            <input type="text" id="name" name="first_name" class="form-control" placeholder="First Name">
            @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Date of Birth</label>
            <input type="date" name="dob" class="form-control" placeholder="Date of Birth">
            @error('dob')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Mobile Number</label>
            <input type="text" name ="mobile_number"class="form-control" placeholder="07711223">
            @error('mobile_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">NIC</label>
            <input type="text" id="nic" name="nic" class="form-control" placeholder="NIC Number">
            @error('nic')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <fieldset class="mb-3">
        <div class="row">
            <label class="col-form-label col-sm-3 pt-0">Gender</label>
                <div class="col-sm-9">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Male" checked="">
                        <label class="form-check-label">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Female">
                        <label class="form-check-label">
                            Female
                        </label>
                    </div>
                </div>
            </label>
        </div>
    </fieldset>
    <div class="row">
        <div class="mb-3 col-md-10">
            <label class="form-label">Address Lane 1</label>
            <input type="text" id="address1" name="address_lane_1" class="form-control" placeholder="Address Lane 1">
            @error('address_lane_1')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">Address Lane 2</label>
            <input type="text" id="address_lane_2" name="address_lane_2" class="form-control" placeholder="Address Lane 2 (Optional)">
            @error('address_lane_2')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">City</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="Town/City">
            @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
{{-- Doctor Information --}}
<div id="doctor-info" class="d-none" >
    <div class="row">
        <div class="mb-3 col-md-7">
            <label class="form-label" for="consultation_id">Consulation Name</label>
            <select id="consultation_id" name="consultation_id" class="form-control wide">
                <option selected disabled>Choose...</option>
                @foreach($consultations as $consultation)
                    <option value="{{ $consultation->id }}">{{ $consultation->name }}</option>
                @endforeach
            </select>
            @error('consultation_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-5">
            <label class="form-label">Specialty</label>
            <input type="text" id="spciality" name="specialty" class="form-control" placeholder="Specialty">
            @error('specialty')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="slmcno">SLMC NO</label>
            <input type="text" id="slmcno" name="slmc_no" class="form-control" placeholder="SLMC NO">
            @error('slmc_no')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="basehospital">Base Hospital</label>
            <input type="text" id="basehospital" name="base_hospital" class="form-control" placeholder="Base Hospital">
            @error('base_hospital')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <fieldset class="mb-3 col-md-6">
            <label class="col-form-label col-sm-6 pt-0">Daily Available</label>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="daily_available" value="Yes">
                    <label class="form-check-label">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="daily_available" value="No" data-bs-toggle="modal" data-bs-target="#modalGrid">
                    <label class="form-check-label">
                        No
                    </label>
                </div>
            </div>
        </fieldset>
        <div id="timeFieldsContainer" class="mb-3 col-md-6 d-none">
            <label class="form-label">Time</label>
            <input type="time" name="time"  class="form-control" placeholder="13:14"> 
        </div>
    </div>
    <div class="modal fade" id="modalGrid">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Available Days</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Monday">
                                <label class="form-check-label">Monday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Tuesday">
                                <label class="form-check-label">Tuesday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Wednesday">
                                <label class="form-check-label">Wednesday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Thursday">
                                <label class="form-check-label">Thursday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Friday">
                                <label class="form-check-label">Friday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Saturday">
                                <label class="form-check-label">Saturday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check mb-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="Sunday">
                                <label class="form-check-label">Sunday</label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time"  name="times[]" class="form-control" placeholder="13:14"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="text-label form-label" for="validationCustomUsername">Username</label>
    <div class="input-group">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        <input type="text" class="form-control" id="validationCustomUsername" name='email' placeholder="Enter a username.." required="">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-3">
    <label class="text-label form-label" for="dlab-password">Password</label>
    <div class="input-group transparent-append">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        <input type="password" class="form-control" id="dlab-password" name='password' placeholder="Choose a safe one.." required="">
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

@section('js')
<script>

$(document).ready(function() {
    
    $('#role_id').change(function() {
        var selectedRole = $(this).val();
        if (selectedRole == 3) { 
            $('#patient-info').removeClass('d-none');
            $('#doctor-info').addClass('d-none');
        } else if(selectedRole== 2) {
            $('#doctor-info').removeClass('d-none');
            $('#patient-info').addClass('d-none');
        } else{
            $('#doctor-info').addClass('d-none');
            $('#patient-info').addClass('d-none');
        }
    });

   $('input[name="daily_available"]').change(function() {
            var isDailyAvailable = $(this).val();
            if (isDailyAvailable == 'Yes') {
                $('#availabilityDays').addClass('d-none');
                $('#timeFieldsContainer').removeClass('d-none');
            } else {
                $('#availabilityDays').removeClass('d-none');
                $('#timeFieldsContainer').addClass('d-none');
            }
        });
})
</script>
@endsection

