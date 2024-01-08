<div class="row">
    <div class="mb-3 col-md-10">
        <label class="form-label" for="role_id">Role</label>
        <select id="role_id" name="role_id" class="default-select form-control wide">
            <option value="">Choose...</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>
{{-- Patient Information --}}
<div id="patient-info" class="d-none" >
    <div class="row">
        <div class="mb-3 col-md-10">
            <label class="form-label" for="dob">Today's Date</label>
            <input  type="date" name="today_date" class=" form-control" placeholder="Today's Date" value="{{ (isset($user->patient)) ? $user->patient->today_date : ''}}">
            @error('today_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="name">First Name</label>
            <input type="text" id="name" name="first_name" class="form-control" placeholder="First Name" value="{{ (isset($user->receptionist)) ? $user->receptionist->first_name : ((isset($user->doctor)) ? $user->doctor->first_name : (isset($user->patient) ? $user->patient->first_name : '')) }}">
            @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ (isset($user->receptionist)) ? $user->receptionist->last_name : ((isset($user->doctor)) ? $user->doctor->last_name : (isset($user->patient) ? $user->patient->last_name : '')) }}">
            @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Date of Birth</label>
            <input type="date" name="dob" class="form-control" placeholder="Date of Birth" value="{{ (isset($user->receptionist)) ? $user->receptionist->dob : ((isset($user->doctor)) ? $user->doctor->dob : (isset($user->patient) ? $user->patient->dob : '')) }}">
            @error('dob')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Mobile Number</label>
            <input type="text" name ="mobile_number"class="form-control" placeholder="07711223" value="{{ (isset($user->receptionist)) ? $user->receptionist->mobile_number : ((isset($user->doctor)) ? $user->doctor->mobile_number : (isset($user->patient) ? $user->patient->mobile_number : '')) }}">
            @error('mobile_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">NIC</label>
            <input type="text" id="nic" name="nic" class="form-control" placeholder="NIC Number" value="{{ (isset($user->receptionist)) ? $user->receptionist->nic : ((isset($user->doctor)) ? $user->doctor->nic : (isset($user->patient) ? $user->patient->nic : '')) }}">
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
                        <input class="form-check-input" type="radio" name="gender" value="Male" {{ ((isset($user->receptionist) && $user->receptionist->gender == 'Male') or (isset($user->patient) && $user->patient->gender == 'Male') or (isset($user->doctor) && $user->doctor->gender == 'Male')) ? "checked" : ''}} >
                        <label class="form-check-label">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Female" {{ ((isset($user->receptionist) && $user->receptionist->gender == 'Female') or (isset($user->patient) && $user->patient->gender == 'Female') or (isset($user->doctor) && $user->doctor->gender == 'Female')) ? "checked" : ''}}>
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
            <input type="text" id="address1" name="address_lane_1" class="form-control" placeholder="Address Lane 1" value="{{ (isset($user->receptionist)) ? $user->receptionist->address_lane_1 : ((isset($user->doctor)) ? $user->doctor->address_lane_1 : (isset($user->patient) ? $user->patient->address_lane_1 : '')) }}">
            @error('address_lane_1')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label">Address Lane 2</label>
            <input type="text" id="address_lane_2" name="address_lane_2" class="form-control" placeholder="Address Lane 2 (Optional)" value="{{ (isset($user->receptionist)) ? $user->receptionist->address_lane_2 : ((isset($user->doctor)) ? $user->doctor->address_lane_2 : (isset($user->patient) ? $user->patient->address_lane_2 : '')) }}">
            @error('address_lane_2')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">City</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="Town/City" value="{{ (isset($user->receptionist)) ? $user->receptionist->city : ((isset($user->doctor)) ? $user->doctor->city : (isset($user->patient) ? $user->patient->city : '')) }}">
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
            <select id="consultation_id" name="consultation_id" class="default-select form-control wide">
                <option selected disabled>Choose...</option>
                @foreach($consultations as $consultation)
                    <option value="{{ $consultation->id }}" {{ ((isset($user->doctor)) && $consultation->id == $user->doctor->consultation_id)? "selected" : '' }}>{{ $consultation->name }}</option>
                @endforeach
            </select>
            @error('consultation_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-5">
            <label class="form-label">Specialty</label>
            <input type="text" id="spciality" name="specialty" class="form-control" placeholder="Specialty" value="{{ (isset($user->doctor)) ? $user->doctor->specialty : ''}}">
            @error('specialty')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="slmcno">SLMC NO</label>
            <input type="text" id="slmcno" name="slmc_no" class="form-control" placeholder="SLMC NO" value="{{ (isset($user->doctor)) ? $user->doctor->slmc_no : ''}}">
            @error('slmc_no')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="basehospital">Base Hospital</label>
            <input type="text" id="basehospital" name="base_hospital" class="form-control" placeholder="Base Hospital" value="{{ (isset($user->doctor)) ? $user->doctor->base_hospital : ''}}">
            @error('base_hospital')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

{{-- User Login Credentials --}}
<div class="mb-3">
    <label class="text-label form-label" for="validationCustomUsername">Username</label>
    <div class="input-group">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        <input type="text" class="form-control" id="validationCustomUsername" name='email' placeholder="Enter a username.." required=""  value="{{$user->email}}">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-3">
    <label class="text-label form-label" for="dlab-password">Password</label>
    <div class="input-group transparent-append">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        <input type="password" class="form-control" id="dlab-password" name='password' placeholder="Choose a safe one.." >
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

@section('js')
<script>

$(document).ready(function() {
    
    function roleChange(selectedRole) {
    
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
    }

    $('#role_id').change(function () {
        var val = this.value;
        roleChange(val);
    });

    @if(isset($user))
        var existingRoleId = "{{ $user->role_id }}";
        roleChange(existingRoleId);
    @endif

})
</script>
@endsection

