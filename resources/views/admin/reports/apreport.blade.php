@extends('layouts.admin.master')
@section('title', 'Appointment Report')
@section('header', 'Appointment Report')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Appointment Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <div class="row">
                                <label for="start_date">Start Date:</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ $startDate->format('Y-m-d') }}">
                                <label for="end_date">End Date:</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ $endDate->format('Y-m-d') }}">
                            </div>
                            <input class="btn btn-success" type="submit" name="action" value="Generate">
                            <input class="btn btn-primary" type="submit" name="action" value="Export">
                        </form>
                        <h5 class="mt-4">Daily Appointments</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Date</th>
                                    <th>Total Appointments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailySummary as $date => $doctors)
                                    @foreach ($doctors as $doctor => $count)
                                        <tr>
                                            <td>{{ $doctor }}</td>
                                            <td>{{ $date }}</td>
                                            <td>{{ $count }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <h5 class="mt-4">Weekly Appointments</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Week</th>
                                    <th>Total Appointments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weeklySummary as $week => $doctors)
                                    @foreach ($doctors as $doctor => $count)
                                        <tr>
                                            <td>{{ $doctor }}</td>
                                            <td>{{ $week }}</td>
                                            <td>{{ $count }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <h5 class="mt-4">Monthly Appointments</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Month</th>
                                    <th>Total Appointments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlySummary as $month => $doctors)
                                    @foreach ($doctors as $doctor => $count)
                                        <tr>
                                            <td>{{ $doctor }}</td>
                                            <td>{{ $month }}</td>
                                            <td>{{ $count }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
