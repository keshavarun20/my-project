@extends('layouts.admin.master')
@section('title', 'Patinet Demographic Report')
@section('header', 'Patinet Demographic Report')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Patients Demographic Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <select name="year" class="btn btn-outline-info ml-2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        {{ request()->input('year') == $year ? 'selected' : '' }}>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="month" class="btn btn-outline-info ml-2">
                                @foreach ($months as $month)
                                    <option value="{{ date('m', strtotime($month)) }}"
                                        {{ request()->input('month') == date('m', strtotime($month)) ? 'selected' : '' }}>
                                        {{ date('F', strtotime($month)) }}</option>
                                @endforeach
                            </select>
                            <input class="btn btn-success" type="submit" name="action" value="Generate">
                            <input class="btn btn-primary" type="submit" name="action" value="Export">
                        </form>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Contact Info</th>
                                </tr>
                            </thead>
                            @if ($patients->isNotEmpty())
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $patient->id }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->age }}</td>
                                            <td>{{ $patient->gender }}</td>
                                            <td>{{ $patient->mobile_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <div class="alert alert-info mt-4">No patients found for the selected period.</div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
