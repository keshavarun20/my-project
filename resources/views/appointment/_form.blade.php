{{-- Paitent Information --}}
<div class="mb-3 col-md-6">
    <label class="form-label" for="nic">NIC</label>
    <input type="text" id="nic" name="nic" class="form-control" placeholder="NIC"
        @if (Auth::check() && Auth::user()->role->name == 'Patient') value="{{ Auth::user()->patient->nic }}" readonly @endif>
    @error('nic')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div id="userNotFound" class="alert alert-danger d-none">User not found</div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label" for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"  @if (Auth::check() && Auth::user()->role->name == 'Patient') value="{{ Auth::user()->patient->first_name }}" readonly @endif>
        @error('first_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name"  @if (Auth::check() && Auth::user()->role->name == 'Patient') value="{{ Auth::user()->patient->last_name }}" readonly @endif>
        @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label" for="age">Age</label>
        <input type="number" name="age" id="age" class=" form-control" placeholder="Age"  @if (Auth::check() && Auth::user()->role->name == 'Patient') value="{{ Auth::user()->patient->age }}" readonly @endif>
        @error('age')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label" for="mobilenumber">Mobile Number</label>
        <input type="text" name="mobile_number" id="mobile_number" class=" form-control" placeholder="0761122761"  @if (Auth::check() && Auth::user()->role->name == 'Patient') value="{{ Auth::user()->patient->mobile_number }}" readonly @endif>
        @error('mobile_number')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<strong>
    <h4>Appoinment Details</h4>
</strong>

<div class="mb-3 col-md-6">
    <label class="form-label" for="date">Pick Your Date</label>
    <input name="date" type="date" class="form-control" id="date" placeholder="Pick your Date">
    @error('date')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="mb-3 col-md-7">
        <label for="doctor_id">Doctor Name</label>
        <select name="doctor_id" id="doctor_id" class="form-control"></select>
    </div>
    @error('doctor_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

@section('js')
    <script>
        $('#nic').change(function() {

            var nic = $(this).val();
            if (nic) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get.user') }}?nic=" + nic,
                    success: function(res) {
                        console.log(res);
                        if (res) {
                            $("#first_name").val(res['first_name']);
                            $("#last_name").val(res['last_name']);
                            $("#age").val(res['age']);
                            $("#mobile_number").val(res['mobile_number']);
                            $("#patient_id").val(res['id']);
                            $("#userNotFound").addClass('d-none');
                        } else {
                            $("#first_name").val('');
                            $("#last_name").val('');
                            $("#mobile_number").val('');
                            $("#age").val('');
                            $("#patient_id").val();
                            $("#userNotFound").removeClass('d-none');

                        }
                    }
                });
            } else {
                $("#first_name").val('');
                $("#last_name").val('');
                $("#mobile_number").val('');
                $("#age").val('');
                $("#userNotFound").addClass('d-none');
            }
        });


        $(document).ready(function() {
            $('#date').change(function() {
                var selectedDate = $(this).val();
                if (selectedDate) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get.available.doctors') }}?selectedDate=" + selectedDate,
                        data: {
                            date: selectedDate
                        },
                        success: function(res) {
                            if (res) {
                                $("#doctor_id").empty();
                                $("#doctor_id").append(
                                    '<option value="">Select Your Consultant</option>');
                                $.each(res, function(key, value) {
                                    $("#doctor_id").append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });

                            } else {
                                $("#doctor_id").empty();
                            }
                        }
                    });
                } else {
                    $("#doctor_id").empty();
                }
            });
        });
    </script>
@endsection
