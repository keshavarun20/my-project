@extends('layouts.admin.master')
@section('title', 'HCC : Appointments')
@section('header', 'Appointments')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('appointment.index') }}">Appointments</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Appointments</h4>
                        <div class="btn-group">
                            <select class=" form-control custom-select" id="filterSelect">
                                <option value="">Filter</option>
                                <option value="name">Filter by Name</option>
                                <option value="date">Filter by Date</option>
                            </select>
                        <div id="filterByName" class="dropdown-item-filter d-none">
                            <input id="filterValueName" type="text" class="form-control filter-input" placeholder="Enter name">
                        </div>

                        <div id="filterByDate" class="dropdown-item-filter d-none">
                            <input id="filterValueDate" type="date" class="form-control filter-input">
                        </div>
                        </div>
                        <a href="{{ route('appointment.create') }}" class="btn btn-rounded btn-success btn-lg">Book Now</a>   
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Appointment Date</th>
                                        <th scope="col">Doctor Name</th>
                                        <th scope="col">Token Number</th>
                                        <th scope="col">Referance Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->doctor->name }}</td>
                                            <td>{{ $appointment->token_number }}</td>
                                            <td>{{ $appointment->reference_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="appointmentConfirmationModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment Booking Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your doctor appointment is successfully booked.</p>
                    <p>Please be advised to arrive at least 10 minutes before the scheduled time.</p>

                    @if(isset($appointmentBooked))
                    <div class="appointment-details">
                        <p><strong>Name:</strong> {{ $appointmentBooked->name }}</p>
                        <p><strong>Appointment Date:</strong> {{ $appointmentBooked->date }}</p>
                        <p><strong>Doctor Name:</strong> {{ $appointmentBooked->doctor->name }}</p>

                        @if (auth()->user()->role->name == 'Admin')
                        <p><strong>Your token number :</strong> {{ $appointmentBooked->token_number }}</p>
                        <p><strong>Your reference number for payment:</strong> {{ $appointmentBooked->reference_number }}</p>
                        @endif
                    </div>
                    @endif

                    <p>For further details, please contact us:</p>
                    <ul class="contact-details">
                        <li>Email: support@hcc.com</li>
                        <li>Phone: 051-2223218 / 051-2052441</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
@if (session('appointmentBooked'))
    <script>
        $(document).ready(function() {
            $('#appointmentConfirmationModal').modal('show');
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        var originalData = {!! json_encode($appointments) !!};

        $('#filterSelect').change(function() {
            var filterType = $(this).val();
            if (filterType === 'name') {
                $('#filterByName').removeClass('d-none');
                $('#filterByDate').addClass('d-none');
            } else if (filterType === 'date') {
                $('#filterByDate').removeClass('d-none');
                $('#filterByName').addClass('d-none');
            } else {
                $('#filterByName').addClass('d-none');
                $('#filterByDate').addClass('d-none');
            }
        });

        $('.filter-input').on('input', function() {
            var filterType = $('#filterSelect').val();
            var filterValue = $(this).val();
            if (filterType && filterValue) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('appointment.filter') }}?filterType=" + filterType + "&filterValue=" + filterValue,
                    success: function(res) {
                        console.log(res);
                        $('#data-table tbody').empty();
                        if (res.length > 0) {
                            $.each(res, function(index, data) {
                                $('#data-table tbody').append('<tr>' +
                                    '<td>' + data.name + '</td>' +
                                    '<td>' + data.date + '</td>' +
                                    '<td>' + data.doctorName + '</td>' +
                                    '<td>' + data.token_number + '</td>' +
                                    '<td>' + data.reference_number + '</td>' +
                                    '</tr>');
                            });
                        } else {
                            $('#data-table tbody').append('<tr><td colspan="5">No result</td></tr>');
                        }
                    }
                });
            } else {
                $('#data-table tbody').empty();
                $.each(originalData, function(index, data) {
                    $('#data-table tbody').append('<tr>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' + data.date + '</td>' +
                        '<td>' + data.doctorName + '</td>' +
                        '<td>' + data.token_number + '</td>' +
                        '<td>' + data.reference_number + '</td>' +
                        '</tr>');
                });
            }
        });
    });
</script>
@endsection

