@extends('layouts.admin.master')
@section('title', 'Patients Profile')
@section('header', 'Patients')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
        <!-- Display success message if it exists -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>Success!</strong>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
            @endif
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Patients Lists</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('patient.profileinfo', $patient->id) }}">Patients Profile</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="profile card card-body px-3 pt-3 pb-0">
                        <div class="profile-head">
                            <div class="profile-info">
                                <div class="profile-photo">
                                    @if ($patient->user->getMedia('profile_picture')->count() > 0)
                                        <img src="{{ $patient->user->getFirstMediaUrl('profile_picture') }}"
                                            class="img-fluid rounded-circle" alt="">
                                    @else
                                        <img src="/images/default-profile-photo.jpg" class="img-fluid rounded-circle"
                                            alt="">
                                    @endif
                                </div>
                                <div class="profile-details">
                                    <div class="profile-name px-3 pt-2">
                                        <h4 class="text-primary mb-0">{{$patient->name}}</h4>
                                        <p>Name</p>
                                    </div>
                                    <div class="profile-email px-2 pt-2">
                                        <h4 class="text-muted mb-0">{{$patient->age}} Years Old</h4>
                                        <p>Age</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills mb-4 light">
                                <li class="nav-item col-xl-6">
                                    <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false">Past Visits</a>
                                </li>
                                <li class="nav-item col-xl-6">
                                    <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Future Visits</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="navpills-1" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach ($pastAppointments as $appointment)
                                                <p>{{ $appointment->date }} - {{ $appointment->doctor->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="navpills-2" class="tab-pane">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            @foreach ($futureAppointments as $appointment)
                                                <p>{{ $appointment->date }} - {{ $appointment->doctor->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title">Document</h5>
                            <a href="#" class="btn light btn-light" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal"><i class="fas fa-file-upload me-2"></i>Upload Document</a>
                        </div>
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item col-xl-6">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1">Recent Document</a>
                                </li>
                                <li class="nav-item col-xl-6">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1">All Document</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                    <div class="pt-4">
                                        <div class="basic-list-group">
                                            @foreach ($pdfFiles as $pdfFile)
                                                <div class="list-group">
                                                <a href="{{ $pdfFile->original_url }}" target="_blank" class="list-group-item list-group-item-action">{{ $pdfFile->name }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile1">
                                    <div class="pt-4">
                                        @foreach ($patient->media as $media)
                                         <div class="list-group">
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="list-group-item list-group-item-action">{{ $media->name }}</a><br>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('patient.uploadPdf', $patient->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Select Document</span>
                        <div class="form-file">
                            <input type="file" class="form-file-input form-control" id="pdf" name="pdf" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

