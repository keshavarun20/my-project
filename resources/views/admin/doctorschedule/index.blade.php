@extends('layouts.admin.master')
@section('title','Doctor List')
@section('header','Doctors')
@section('content')

<div class="content-body">
    <div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('dschedule.index') }}">Home</a></li>
        </ol>
    </div>
        <div class="col-lg-12">
            <div class="card">
                    @if(session('updated'))
                    <div class="alert alert-secondary alert-dismissible fade show">
                        <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                        <strong>Done!</strong> {{ session('updated') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                    @endif
                <div class="card-header">
                    <h4 class="card-title">Doctor Schedule</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Specialist Doctors</th>
                                    <th scope="col">Doctor Name</th>
                                    <th scope="col">Visit Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Action</th>
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
                                        <td>
                                            <a href="{{ route('dschedule.edit',$doctor->id) }}" class="btn btn-primary">Edit</a>
                                    </td>
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
