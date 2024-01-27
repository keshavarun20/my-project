<div class="row">
    <div class="mb-3 col-md-10">
        <label class="form-label" for="role_id">Doctor Name</label>
        <select id="doctor_id" name="doctor_id" class="default-select form-control wide">
            <option value="">Choose...</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label" for="name">Specialist Doctor</label>
        <input type="text" id="specialist_doctor" name="specialist_doctor" class="form-control" placeholder="Specialist Doctor">
        @error('specialist_doctor')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label" for="name">Visit Date</label>
        <input type="text" id="available_days" name="available_days" class="form-control" placeholder="Specialist Doctor">
        @error('available_days')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label" for="name">Time</label>
        <input type="text" id="time" name="time" class="form-control" placeholder="Specialist Doctor">
        @error('available_days')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
