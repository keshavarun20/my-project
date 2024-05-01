@extends('layouts.admin.master')
@section('title', 'Patients Profile')
@section('header', 'Patients')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Patients Lists</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('patient.profile', $patient->id) }}">Patients Profile</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="profile card card-body px-3 pt-3 pb-0">
                        <div class="profile-head">
                            <div class="profile-info">
                                <div class="profile-photo">
                                     @if ($patient->user->getMedia('profile_picture')->count() > 0)
                                    <img src="{{ $user->getFirstMediaUrl('profile_picture') }}" class="img-fluid rounded-circle" alt="">
                                    @else
                                    <img src="/images/default-profile-photo.jpg" class="img-fluid rounded-circle" alt="">
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="nav nav-pills mb-4">
                                <a href="#v-pills-home" data-bs-toggle="pill" class="nav-link active show">Presenting Complaint</a>
                                <a href="#v-pills-profile" data-bs-toggle="pill" class="nav-link">History of Presenting Complaint</a>
                                <a href="#v-pills-messages" data-bs-toggle="pill" class="nav-link">Medical History</a>
                                <a href="#v-pills-settings" data-bs-toggle="pill" class="nav-link">Surgical History</a>
                                <a href="#v-pills-allergic" data-bs-toggle="pill" class="nav-link">Allergic History</a>
                                <a href="#v-pills-family" data-bs-toggle="pill" class="nav-link">Family History</a>
                                <a href="#v-pills-social" data-bs-toggle="pill" class="nav-link">Social History</a>
                                <a href="#v-pills-signs" data-bs-toggle="pill" class="nav-link">Signs</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="tab-content">
                                    <form method="POST" action="/submit">
                                        @csrf
                                        <div id="v-pills-home" class="tab-pane fade active show">
                                        <div class="d-none" id="home">
                                            <div class="row" id="row1" >
                                                <div class="mb-3 col-md-5 input-primary">
                                                    <label for="symptom1">Symptom</label>
                                                    <input type="text" name="symptoms[]" class="form-control symptom" id="symptom1" placeholder="Symptom">
                                                </div>
                                                <div class="mb-3 col-md-5 input-primary">
                                                    <label for="duration1">Duration</label>
                                                    <input type="text" name="durations[]" class="form-control duration" id="duration1" placeholder="Duration">
                                                </div>
                                                <div class="mb-3 col-md-2">
                                                    <label>&nbsp;</label>
                                                    <br>
                                                    <button type="button" class="btn btn-primary add-button">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div id="v-pills-profile" class="tab-pane fade">
                                            <div class="d-none" id="profile">
                                                <div class="row">
                                                    <div class="input-primary">
                                                        <label for="treatment">Treatment for this Disease</label>
                                                        <textarea name="treatment" class="form-control " id="treatment" placeholder="Treatment for this Disease"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-primary">
                                                        <label for="medication">Medication for this Disease</label>
                                                        <textarea name="medication" class="form-control" id="medication" placeholder="Medication for this Disease"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="v-pills-messages" class="tab-pane fade">
                                            <div class="d-none input-primary" id="messages">
                                                <label for="medical_history">Medical History</label>
                                                <textarea name="medical_history" class="form-control" id="medical_history" placeholder="Medical History"></textarea>
                                            </div>
                                        </div>
                                        <div id="v-pills-settings" class="tab-pane fade">
                                            <div class="d-none input-primary" id="settings">
                                                <label for="surgical_history">Surgical History</label>
                                                <textarea name="surgical_history" class="form-control" id="surgical_history" placeholder="Surgical History"></textarea>
                                            </div>
                                        </div>
                                        <div id="v-pills-allergic" class="tab-pane fade">
                                            <div class="d-none" id="allergic">
                                                <div class="input-primary">
                                                    <label for="food">Food</label>
                                                    <input type="text" name="food" class="form-control" id="food" placeholder="Food">
                                                </div>
                                                <div class="input-primary">
                                                    <label for="drugs">Drugs</label>
                                                    <input type="text" name="drugs" class="form-control" id="drugs" placeholder="Drugs">
                                                </div>
                                                <div class="input-primary">
                                                    <label for="plaster">Plaster</label>
                                                    <input type="text" name="plaster" class="form-control" id="plaster" placeholder="Plaster">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="v-pills-family" class="tab-pane fade">
                                        <div class="d-none" id="family">
                                            <div class="row">
                                                <div class="input-primary">
                                                    <label for="treatment">Family History of Chronic illnesses</label>
                                                    <textarea name="family_hostory" class="form-control " id="family_hostory" placeholder="Family History of Chronic illnesses"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <fieldset class="mb-3 col-md-6">
                                                        <label class="col-form-label">Consanguineous Marriage</label>
                                                        <div class="col-sm-9">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="consanguineous_marriage" value="Yes">
                                                                <label class="form-check-label">
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="consanguineous_marriage" value="No"
                                                                    data-bs-toggle="modal" data-bs-target="#modalGrid">
                                                                <label class="form-check-label">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="v-pills-social" class="tab-pane fade">
                                            <div class="d-none" id="social">
                                                <div class="input-primary">
                                                    <label for="occupation">Occupation</label>
                                                    <input type="text" name="occupation" class="form-control" id="occupation" placeholder="Occupation">
                                                </div>
                                                <div class="input-primary">
                                                    <label for="monthly_income">Monthly Income</label>
                                                    <input type="text" name="monthly_income" class="form-control" id="monthly_income" placeholder="Monthly Income">
                                                </div>
                                                <div class="input-primary">
                                                    <label for="nearest_hospital">Nearest Hospital</label>
                                                    <input type="text" name="nearest_hospital" class="form-control" id="nearest_hospital" placeholder="Nearest Hospital">
                                                </div>
                                                <div class="input-primary">
                                                    <label for="water_source">Water Source</label>
                                                    <input type="text" name="water_source" class="form-control" id="water_source" placeholder="Water Source">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="v-pills-signs" class="tab-pane fade">
                                        </div>
                                    </form>
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

@section('js')
<script>
    $(document).ready(function() {
        $('#home').removeClass('d-none');

        $('.nav-link').on('click', function() {
            let targetId = $(this).attr('href')
            if(targetId == '#v-pills-home'){
                $('#home').removeClass('d-none');
                $('#profile').addClass('d-none');
                $('#messages').addClass('d-none');
                $('#settings').addClass('d-none');
                $('#allergic').addClass('d-none');
                $('#family').addClass('d-none');
                $('#social').addClass('d-none');
            }

            if(targetId == '#v-pills-profile'){
                $('#profile').removeClass('d-none');
                $('#home').addClass('d-none');
                $('#settings').addClass('d-none');
                $('#messages').addClass('d-none');
                $('#family').addClass('d-none');
                $('#social').addClass('d-none');
                $('#allergic').addClass('d-none');
            }

            if(targetId == '#v-pills-messages'){
                $('#messages').removeClass('d-none');
                $('#home').addClass('d-none');
                $('#settings').addClass('d-none');
                $('#profile').addClass('d-none');
                $('#family').addClass('d-none');
                $('#social').addClass('d-none');
                $('#allergic').addClass('d-none');
            }
            if(targetId == '#v-pills-settings'){
                $('#settings').removeClass('d-none');
                $('#messages').addClass('d-none');
                $('#home').addClass('d-none');
                $('#profile').addClass('d-none');
                $('#family').addClass('d-none');
                $('#social').addClass('d-none');
                $('#allergic').addClass('d-none');
            }
            if(targetId == '#v-pills-allergic'){
                $('#allergic').removeClass('d-none');
                $('#settings').addClass('d-none');
                $('#messages').addClass('d-none');
                $('#home').addClass('d-none');
                $('#family').addClass('d-none');
                $('#social').addClass('d-none');
                $('#profile').addClass('d-none');
            }
            if(targetId == '#v-pills-family'){
                $('#family').removeClass('d-none');
                $('#allergic').addClass('d-none');
                $('#settings').addClass('d-none');
                $('#messages').addClass('d-none');
                $('#home').addClass('d-none');
                $('#social').addClass('d-none');
                $('#profile').addClass('d-none');
            }
            if(targetId == '#v-pills-social'){
                $('#social').removeClass('d-none');
                $('#family').addClass('d-none');
                $('#allergic').addClass('d-none');
                $('#settings').addClass('d-none');
                $('#messages').addClass('d-none');
                $('#home').addClass('d-none');
                $('#profile').addClass('d-none');
            }
        
        });

        let rowCount = 1;

        $(document).on('click', '.add-button', function() {
            rowCount++;
            let newRow = $('#row1').clone();
            newRow.attr('id', 'row' + rowCount);
            newRow.find('.symptom, .duration').val('');
            newRow.find('.add-button').text('Remove').removeClass('btn-primary add-button').addClass('btn-danger remove-button');
            $('#row1').parent().append(newRow);
        });

       $(document).on('click', '.remove-button', function() {
            $(this).closest('.row').remove();
        });
    });
</script>
@endsection

