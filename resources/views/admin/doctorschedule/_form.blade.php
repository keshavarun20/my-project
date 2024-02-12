<div class="row">
    <fieldset class="mb-3 col-md-6">
        <label class="col-form-label col-sm-6 pt-0">Daily Available</label>
        <div class="col-sm-9">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="days" name="daily_available" value="Yes"
                    {{ isset($doctor) && $doctor->doctor_schedules->count() == 7 ? 'checked' : '' }} <label
                    class="form-check-label">
                Yes
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="days" name="daily_available" value="No"
                    {{ isset($doctor) && $doctor->doctor_schedules->count() != 7 ? 'checked' : '' }}>
                <label class="form-check-label">
                    No
                </label>
            </div>
        </div>
    </fieldset>
    <div id="timeFieldsContainer" class="mb-3 col-md-6 d-none">
        <label class="form-label">Time</label>
        <input type="time" name="time" class="form-control" placeholder="13:14"
            @foreach ($doctor->doctor_schedules as $doctor_schedule)
                value="{{ $doctor_schedule->time }}" @endforeach>
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
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-md-6">
                            <input class="form-check-input" type="checkbox" name="available_days[]" value="Tuesday">
                            <label class="form-check-label">Tuesday</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-md-6">
                            <input class="form-check-input" type="checkbox" name="available_days[]" value="Wednesday">
                            <label class="form-check-label">Wednesday</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-md-6">
                            <input class="form-check-input" type="checkbox" name="available_days[]" value="Thursday">
                            <label class="form-check-label">Thursday</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-md-6">
                            <input class="form-check-input" type="checkbox" name="available_days[]" value="Friday">
                            <label class="form-check-label">Friday</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-md-6">
                            <input class="form-check-input" type="checkbox" name="available_days[]"
                                value="Saturday">
                            <label class="form-check-label">Saturday</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-md-6">
                            <input class="form-check-input" type="checkbox" name="available_days[]" value="Sunday">
                            <label class="form-check-label">Sunday</label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="times[]" class="form-control" placeholder="13:14">
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

@section('js')
    <script>
        $(document).ready(function() {

            $('input[name="daily_available"]').change(function() {
                if ($(this).val() == 'Yes') {
                    $('#timeFieldsContainer').removeClass('d-none');
                    $('#modalGrid').modal('hide');
                } else {
                    $('#timeFieldsContainer').addClass('d-none');
                    $('#modalGrid').modal('show');
                }
            });
            $('input[name="daily_available"]:checked').trigger('change');

            var doctor = {!! json_encode($doctor) !!};

            var doctorSchedules = doctor.doctor_schedules;

            for (let i = 0; i < doctorSchedules.length; i++) {
                switch (doctorSchedules[i].available_days) {
                    case 'Monday':
                        $('input[name="available_days[]"][value="Monday"]').prop('checked', true);
                        $('[name="times[]"]').eq(0).val(doctorSchedules[i].time);
                        break;
                    case 'Tuesday':
                        $('input[name="available_days[]"][value="Tuesday"]').prop('checked', true);
                        $('[name="times[]"]').eq(1).val(doctorSchedules[i].time);
                        break;
                    case 'Wednesday':
                        $('input[name="available_days[]"][value="Wednesday"]').prop('checked', true);
                        $('[name="times[]"]').eq(2).val(doctorSchedules[i].time);
                        break;
                    case 'Thursday':
                        $('input[name="available_days[]"][value="Thursday"]').prop('checked', true);
                        $('[name="times[]"]').eq(3).val(doctorSchedules[i].time);
                        break;
                    case 'Friday':
                        $('input[name="available_days[]"][value="Friday"]').prop('checked', true);
                        $('[name="times[]"]').eq(4).val(doctorSchedules[i].time);
                        break;
                    case 'Saturday':
                        $('input[name="available_days[]"][value="Saturday"]').prop('checked', true);
                        $('[name="times[]"]').eq(5).val(doctorSchedules[i].time);
                        break;
                    case 'Sunday':
                        $('input[name="available_days[]"][value="Sunday"]').prop('checked', true);
                        $('[name="times[]"]').eq(6).val(doctorSchedules[i].time);
                }

            }
        });
    </script>
@endsection
