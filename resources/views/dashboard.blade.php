@extends('layouts.admin.master')
@section('title', 'Hatton Consultation Centre')
@section('header', 'Dashboard')
@section('content')
    <div class="row page-title-header">
        <div class="col-12">
            <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-6">
                @if (session('success'))
                    <div class="alert alert-primary left-icon-big alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                    class="mdi mdi-btn-close"></i></span>
                        </button>
                        <div class="media">
                            <div class="alert-left-icon-big">
                                <span><i class="mdi mdi-email-alert"></i></span>
                            </div>
                            <div class="media-body">
                                <h6 class="mt-1 mb-2">
                                    {{ session('success') }}
                                    @if (Auth::user()->role->name == 'Doctor')
                                        {{ Auth::user()->doctor->name }}
                                    @elseif(Auth::user()->role->name == 'Patient')
                                        {{ Auth::user()->patient->name }}
                                    @else
                                        {{ Auth::user()->receptionist->name }}
                                    @endif
                                    !
                                </h6>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if (auth()->user()->role->name == 'Admin')
                <div class="row">
                    <div class="col-xl-4 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4>Recently Booked Appointments</h4> <a href="{{ route('appointment.create') }}"
                                    class="btn btn-primary btn-sm">Book Now</a>
                            </div>
                            <div class="card-body pb-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="data-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Doctor Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->name }}</td>
                                                    <td>{{ $appointment->date }}</td>
                                                    <td>{{ $appointment->doctor->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer pt-0 pb-0 text-center">
                                <div class="row">
                                    <div class="col-6 pt-3 pb-3 border-end">
                                        <h3 class="mb-1 text-primary">{{ $appointmentsToday }}</h3>
                                        <span>Appointments today</span>
                                    </div>
                                    <div class="col-6 pt-3 pb-3">
                                        <h3 class="mb-1 text-primary">{{ $upcomingAppointments }}</h3>
                                        <span>Upcoming appointments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-8 col-lg-12 col-sm-12">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-5 p-0">
                                        <div class="card-body">
                                            <h6 class="fw-normal text-uppercase">Monthly Income</h6>
                                        </div>
                                    </div>
                                    <div class="col-7 p-0">
                                        <div class="chart-wrapper">
                                            <canvas id="chart_widget_11"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-primary">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <i class="flaticon-381-user-7"></i>
                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Total Doctors</p>
                                        <h3 class="text-white">{{ $totalDoctors }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-info">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Total Patients</p>
                                        <h3 class="text-white">
                                            {{ $totalPatients }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (auth()->user()->role->name == 'Patient')
                <div class="row">
                    <div class="col-xl-4 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4>Upcoming Appointments</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="data-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Doctor Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patientAppointments as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->name }}</td>
                                                    <td>{{ $appointment->date }}</td>
                                                    <td>{{ $appointment->doctor->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-8 col-lg-12 col-sm-12">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-5 p-0">
                                        <div class="card-body">
                                            <h6 class="fw-normal text-uppercase">Monthly Medical Expenses</h6>
                                        </div>
                                    </div>
                                    <div class="col-7 p-0">
                                        <div class="chart-wrapper">
                                            <canvas id="chart_widget_11"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4>Recent Prescription</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table primary-table-bordered">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Drug Name</th>
                                            <th>Dose</th>
                                            <th>Route</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medicals->management_plan as $record)
                                            <tr class="table-primary">
                                                <td>{{ $record['drug_name'] }}</td>
                                                <td>{{ $record['dose'] }}</td>
                                                <td>{{ $record['route'] }}</td>
                                                <td>{{ $record['frequency'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Vital Signs Overview</h4>
                            </div>
                            <div class="card-body">
                                <div id="morris_donught" class="morris_chart_height"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (auth()->user()->role->name == 'Doctor')
                <div class="row">
                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-info">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Total Patients</p>
                                        <h3 class="text-white">
                                            {{ $totalPatient }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-primary">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <i class="flaticon-381-user-7"></i>
                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Upcoming Appointment</p>
                                        <h3 class="text-white">{{ $totalAppointment }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4>Upcoming Appointments</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="data-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($upcomingAppointments as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->name }}</td>
                                                    <td>{{ $appointment->date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4>Recent Appointments</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="data-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->name }}</td>
                                                    <td>{{ $appointment->date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer pt-0 pb-0 text-center">
                                <div class="row">
                                    <h3 class="mb-1 text-primary">{{ $appointmentsToday }}</h3>
                                    <span>Appointments today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
