@extends('layouts.admin.master')
@section('title','HCC : Make Appointment')
@section('header','Appoinment')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
        @if($user->role->name == 'Admin')
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('appointment.index') }}">Appointments</a></li>
                <li class="breadcrumb-item"><a href="{{ route('appointment.create') }}">Make Appointmet</a></li>
            </ol>
        @else
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('appointment.create') }}">Make Appointments</a></li>
            </ol>
        @endif
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Make Appointment</h4>
                    <button type="button" class="btn tp-btn btn-success" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Click Here To View The Doctor Availability Schedule</button>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Doctor Availability Schedule</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>Specialist Doctor</th>
                                                    <th>Name Of the Doctor</th>
                                                    <th>Visit Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($doctors as $doctor)
                                                    <tr>
                                                        @if($doctor->specialty != null)
                                                        <td>{{ $doctor->consultation->name }} ( {{ $doctor->specialty }} )</td>
                                                        @else
                                                        <td>{{ $doctor->consultation->name }}</td>
                                                        @endif
                                                        <td>{{ $doctor->name }}</td>
                                                        <td>
                                                        @if ($doctor->doctor_schedules->count() !=7)
                                                        @foreach($doctor->doctor_schedules as $index => $doctor_schedule)
                                                            @if ($index>0)
                                                                <br>
                                                            @endif
                                                            {{ $doctor_schedule->available_days }}
                                                        @endforeach
                                                        @else
                                                        {{"Daily"}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if ($doctor->doctor_schedules->count() !=7)
                                                        @foreach($doctor->doctor_schedules as $index => $doctor_schedule)
                                                            @if ($index>0)
                                                                <br>
                                                            @endif
                                                            {{ $doctor_schedule->time }}
                                                        @endforeach
                                                        @else
                                                        {{ $doctor->doctor_schedules->first()->time }}
                                                        @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="post" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    @include('appointment._form')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Book Now</button>
                                    <a href="{{ route('appointment.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    @if($user->role->name == 'Patient')
                    <form action="{{ route('appointment.index') }}" method="post">
                        @csrf

                        <h3>Need Assistance?</h3>

                        <p>
                            If you are experiencing any difficulties or have questions while booking your appointment,
                            please don't hesitate to contact our support team for assistance.
                            <h6>Contact Us:</h6>
                            <ul>
                                <li>Email: support@hcc.com</li>
                                <li>Phone: 051-2223218 / 051-2052441</li>
                            </ul>
                        </p>
                        <div class="mb-3 col-md-6">
                            <label for="feedback">Feedback (optional):</label>
                            <textarea name="feedback" id="feedback"  rows="8" cols="80"></textarea>
                            <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection