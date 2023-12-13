<div class="row">
    <div class="mb-3 col-md-10">
        <label class="form-label" for="role_id">Role</label>
        <select id="role_id" name="role_id" class="default-select form-control wide">
            <option selected disabled>Choose...</option>
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
            <input name="tdate" class="datepicker-default form-control" id="datepicker" placeholder="Today's Date">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="name">Patient's First Name</label>
            <input type="text" id="name" name="fname" class="form-control" placeholder="First Name">
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Patient's Last Name</label>
            <input type="text" name="lname" class="form-control" placeholder="Last Name">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Date of Birth</label>
            <input type="text" nmae="dob" class="form-control" placeholder="Date of Birth">
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Mobile Number</label>
            <input type="text" name ="mobilenumber"class="form-control" placeholder="+947711223">
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">NIC</label>
            <input type="text" id="nic" name="nic" class="form-control" placeholder="NIC Number">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-10">
            <label class="form-label" for="email">Address Lane 1</label>
            <input type="text" id="address1" name="address1" class="form-control" placeholder="Address Lane 1">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="email">Address Lane 2</label>
            <input type="text" id="address2" name="address2" class="form-control" placeholder="Address Lane 2 (Optional)">
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="email">City</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="Town/City">
        </div>
    </div>
</div>
{{-- Doctor Information --}}
<div id="doctor-info" class="d-none">
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="name">Doctor's First Name</label>
            <input type="text" id="name" name="fname" class="form-control" placeholder="First Name">
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">Doctor's Last Name</label>
            <input type="text" name="lname" class="form-control" placeholder="Last Nmae">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label class="form-label" for="dob">Date of Birth</label>
            <input type="text" name="dob" class="form-control" placeholder="Date of Birth">
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="mobilenumber">Mobile Number</label>
            <input type="text" name ="mobilenumber"class="form-control" placeholder="+947711223">
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="name">NIC</label>
            <input type="text" id="nic" name="nic" class="form-control" placeholder="NIC Number">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-10">
            <label class="form-label" for="address">Address Lane 1</label>
            <input type="text" id="address1" name="address1" class="form-control" placeholder="Address Lane 1">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="address">Address Lane 2</label>
            <input type="text" id="address2" name="address1" class="form-control" placeholder="Address Lane 2 (Optional)">
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="city">City</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="Town/City">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-7">
            <label class="form-label" for="consultation_id">Consulation Name</label>
            <select id="consultation_id" name="consultation_id" class="default-select form-control wide">
                <option selected disabled>Choose...</option>
                @foreach($consultations as $consultation)
                    <option value="{{ $consultation->id }}">{{ $consultation->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-5">
            <label class="form-label">Speciality</label>
            <input type="text" id="spciality" name="city" class="form-control" placeholder="Speciality">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="slmcno">SLMC NO</label>
            <input type="text" id="slmcno" name="slmcno" class="form-control" placeholder="SLMC NO">
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="basehospital">Base Hospital</label>
            <input type="text" id="basehospital" name="basehospital" class="form-control" placeholder="Base Hospital">
        </div>
    </div>
</div>
{{-- User Login Credentials --}}
<div class="row">
    <div class="mb-3 col-md-10">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-10">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
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
        } else {
            $('#doctor-info').removeClass('d-none');
            $('#patient-info').addClass('d-none');
        }
    });
})
</script>
@endsection

