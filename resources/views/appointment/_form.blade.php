{{-- Paitent Information --}}
<div class="mb-3 col-md-6">NIC</label>
		<input type="text" id="nic" name="nic" class="form-control" placeholder="NIC">
		@error('nic')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
<div class="row">
	<div class="mb-3 col-md-6">
		<label class="form-label" for="name">First Name</label>
		<input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name">
		@error('first_name')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="mb-3 col-md-6">
		<label class="form-label">Last Name</label>
		<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
		@error('last_name')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
</div>
<div class="row">
	<div class="mb-3 col-md-6">
		<label class="form-label" for="age">Age</label>
		<input  type="number" name="age" id="age" class=" form-control" placeholder="Age" >
		@error('age')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="mb-3 col-md-6">
		<label class="form-label" for="mobilenumber">Mobile Number</label>
		<input  type="text" name="mobile_number" id="mobile_number" class=" form-control" placeholder="0761122761" >
		@error('mobile_number')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
</div>

<strong><h4>Appoinment Details</h4></strong>

<div class="mb-3 col-md-6">
	<label class="form-label" for="date">Pick Your Date</label>
	<input name="date" class="datepicker-default form-control" id="date" placeholder="Pick your Date">
	@error('date')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="d-none">
	<div class="row">
	<div class="mb-3 col-md-7">
		<label class="form-label" for="doctor_id">Doctor Name</label>
		<select id="doctor_id" name="doctor_id" class="default-select form-control wide">
			<option selected disabled>Choose...</option>
			@foreach($doctors as $doctor)
				<option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
			@endforeach
		</select>
		@error('doctor_id')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
	</div>
</div>

@section('js')
<script>
    $('#nic').change(function(){
		
        var nic = $(this).val();
        if(nic){
            $.ajax({
                type: "GET",
                url: "{{ route('get.user')}}?nic="+nic,
                success: function(res){
					console.log(res);
                    if(res){
                        $("#first_name").val(res['first_name']);
                        $("#last_name").val(res['last_name']);
                        $("#age").val(res['age']);
                        $("#mobile_number").val(res['mobile_number']);
                    } else {
                        $("#first_name").val('');
                        $("#last_name").val('');
                        $("#mobile_number").val('');
                        $("#age").val('');

                    }
                }
            });
        } else {
            $("#first_name").val('');
            $("#last_name").val('');
            $("#mobile_number").val('');
            $("#age").val('');
        }
    });
</script>
@endsection