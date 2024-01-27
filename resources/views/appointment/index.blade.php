@extends('layouts.admin.master')
@section('title','HCC : Appointments')
@section('header','Appointments')
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
                    <a href="{{ route('appointment.create')}}" class="btn btn-rounded btn-success btn-lg">Book Now</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
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
            </div>
        </div>
    </div>
</div>

@endsection
