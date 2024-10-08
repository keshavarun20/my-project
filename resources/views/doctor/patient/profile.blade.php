@extends('layouts.admin.master')
@section('title', 'Patients Profile')
@section('header', 'Patients')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Patients Lists</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('patient.profile', $patient->id) }}">Patients Profile</a>
                    </li>
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
                                        <h4 class="text-primary mb-0">{{ $patient->name }}</h4>
                                        <p>Name</p>
                                    </div>
                                    <div class="profile-email px-2 pt-2">
                                        <h4 class="text-muted mb-0">{{ $patient->age }} Years Old</h4>
                                        <p>Age</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills mb-4 light">
                                <li class="nav-item col-xl-6">
                                    <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab"
                                        aria-expanded="false">Past Visits</a>
                                </li>
                                <li class="nav-item col-xl-6">
                                    <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Future
                                        Visits</a>
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
                            @if (Auth::user()->role->name == 'Doctor')
                                <a href="#" class="btn light btn-light" data-bs-toggle="modal"
                                    data-bs-target="#uploadDocumentModal"><i class="fas fa-file-upload me-2"></i>Upload
                                    Document</a>
                            @endif
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
                                                    <a href="{{ $pdfFile->original_url }}" target="_blank"
                                                        class="list-group-item list-group-item-action">{{ $pdfFile->name }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile1">
                                    <div class="pt-4">
                                        @foreach ($patient->media as $media)
                                            <div class="list-group">
                                                <a href="{{ $media->getUrl() }}" target="_blank"
                                                    class="list-group-item list-group-item-action">{{ $media->name }}</a><br>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Glucose Rate
                                                    <div class="bootstrap-popover d-inline-block"
                                                        style="position: relative;">
                                                        <i class="fas fa-info-circle fa-xs" style="cursor: pointer;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="Random Blood Sugar (RBS) is a measure of the blood glucose level taken at any random time, regardless of when the person last ate. It helps assess current blood sugar levels and is used to diagnose or monitor diabetes"
                                                            title="Glucose Rate"></i>
                                                    </div>
                                                </h3>
                                                @if ($rbs < 140)
                                                    <div class="text-success">Normal</div>
                                                @elseif($rbs >= 140 && $rbs <= 199)
                                                    <div class="text-info">Pre Diabetic Range</div>
                                                @elseif($rbs > 200 && $rbs <= 300)
                                                    <div class="text-warning">Diabetic Range</div>
                                                @elseif($rbs > 300)
                                                    <div class="text-danger">Immediate Attention Needed</div>
                                                @endif
                                            </div>
                                            <div class="clearfix text-center">
                                                @if ($rbs < 140)
                                                    <h3 class="text-success mb-0">{{ $rbs }}</h3>
                                                @elseif($rbs >= 140 && $rbs <= 199)
                                                    <h3 class="text-info mb-0">{{ $rbs }}</h3>
                                                @elseif($rbs >= 200 && $rbs <= 300)
                                                    <h3 class="text-warning mb-0">{{ $rbs }}</h3>
                                                @elseif($rbs > 300)
                                                    <h3 class="text-danger mb-0">{{ $rbs }}</h3>
                                                @endif
                                                <span>mg/dl</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="sparkline8"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Heart Rate
                                                    <div class="bootstrap-popover d-inline-block"
                                                        style="position: relative;">
                                                        <i class="fas fa-info-circle fa-xs" style="cursor: pointer;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="Heart rate (HR) is the number of times your heart beats per minute. It's a vital sign that can provide important information about your health and fitness level. A normal resting heart rate for adults is typically between 60 and 100 beats per minute. Regular monitoring of your heart rate can help you understand your cardiovascular health and fitness levels."
                                                            title="Heart Rate"></i>
                                                    </div>
                                                </h3>
                                                <span class="text-danger">
                                                    @if ($hr >= 60 && $hr < 100)
                                                        <div class="text-success">Normal</div>
                                                    @elseif ($hr < 60)
                                                        <div class="text-info">Bradycardia</div>
                                                    @elseif ($hr >= 100 && $hr <= 150)
                                                        <div class="text-warning">Tachycardia</div>
                                                    @elseif ($hr > 150)
                                                        <div class="text-danger">Immediate Attention Needed</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="clearfix text-center">
                                                @if ($hr >= 60 && $hr < 100)
                                                    <h3 class="text-success mb-0">{{ $hr }}</h3>
                                                @elseif($hr < 60)
                                                    <h3 class="text-info mb-0">{{ $hr }}</h3>
                                                @elseif($hr >= 100 && $hr <= 150)
                                                    <h3 class="text-warning mb-0">{{ $hr }}</h3>
                                                @elseif($hr > 150)
                                                    <h3 class="text-danger mb-0">{{ $hr }}</h3>
                                                @endif
                                                <span>Per Min</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="composite-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Blood Pressure Systolic <div
                                                        class="bootstrap-popover d-inline-block"
                                                        style="position: relative;">
                                                        <i class="fas fa-info-circle fa-xs" style="cursor: pointer;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="Systolic blood pressure is the top number in a blood pressure reading, and it measures the force of blood in your arteries when your heart beats. Blood pressure is measured with a cuff and gauge, and is recorded as two numbers, with systolic pressure being the first"
                                                            title="Blood Pressure Systolic"></i>
                                                    </div>
                                                </h3>
                                                <span>
                                                    @if ($bps < 90)
                                                        <div class="text-danger">Immediate Attention Needed</div>
                                                    @elseif ($bps >= 90 && $bps < 160)
                                                        <div class="text-success">Normal</div>
                                                    @elseif ($bps > 160)
                                                        <div class="text-danger">Immediate Attention Needed</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-info mb-0">
                                                    @if ($bps < 90)
                                                        <h3 class="text-danger mb-0">{{ $bps }}</h3>
                                                    @elseif ($bps >= 90 && $bps < 160)
                                                        <h3 class="text-success">{{ $bps }}</h3>
                                                    @elseif ($bps > 160)
                                                        <h3 class="text-danger mb-0">{{ $bps }}</h3>
                                                    @endif
                                                </h3>
                                                <span>mmHg</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="spark-bar-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Blood Pressure Diastolic <div
                                                        class="bootstrap-popover d-inline-block"
                                                        style="position: relative;">
                                                        <i class="fas fa-info-circle fa-xs" style="cursor: pointer;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="Diastolic blood pressure is the pressure in your arteries when your heart is resting between beats. It's the bottom number in a blood pressure reading"
                                                            title="Blood Pressure Diastolic"></i>
                                                    </div>
                                                </h3>
                                                <span>
                                                    @if ($bpd < 60)
                                                        <div class="text-danger">Immediate Attention Needed</div>
                                                    @elseif ($bpd >= 60 && $bpd < 110)
                                                        <div class="text-success">Normal</div>
                                                    @elseif ($bpd > 110)
                                                        <div class="text-danger">Immediate Attention Needed</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-primary mb-0">
                                                    @if ($bpd < 60)
                                                        <h3 class="text-danger mb-0">{{ $bpd }}</h3>
                                                    @elseif ($bpd >= 60 && $bpd < 110)
                                                        <h3 class="text-success">{{ $bpd }}</h3>
                                                    @elseif ($bpd > 110)
                                                        <h3 class="text-danger mb-0">{{ $bpd }}</h3>
                                                    @endif
                                                </h3>
                                                <span>mmHG</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="spark-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Respiratory Rate <div
                                                        class="bootstrap-popover d-inline-block"
                                                        style="position: relative;">
                                                        <i class="fas fa-info-circle fa-xs" style="cursor: pointer;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="Respiratory rate, also known as breathing rate, is the number of breaths a person takes per minute while resting. It's usually measured by counting how many times the chest or abdomen rises over the course of one minute. For an accurate measurement, you can try sitting down and relaxing in a chair or bed"
                                                            title="Respiratory Rate"></i>
                                                    </div>
                                                </h3>
                                                <span>
                                                    @if ($rr < 12)
                                                        <div class="text-warning">Below Normal</div>
                                                    @elseif ($rr >= 12 && $rr <= 20)
                                                        <div class="text-success">Normal</div>
                                                    @elseif ($rr > 20)
                                                        <div class="text-danger">Immediate Attention Needed</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-primary mb-0">
                                                    @if ($rr < 12)
                                                        <h3 class="text-warning mb-0">{{ $rr }}</h3>
                                                    @elseif ($rr >= 12 && $rr <= 20)
                                                        <h3 class="text-success mb-0">{{ $rr }}</h3>
                                                    @elseif ($rr > 20)
                                                        <h3 class="text-danger mb-0">{{ $rr }}</h3>
                                                    @endif
                                                </h3>
                                                <span>breaths/min</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="sparkline9"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Oxygen Saturation (SPO2) <div
                                                        class="bootstrap-popover d-inline-block"
                                                        style="position: relative;">
                                                        <i class="fas fa-info-circle fa-xs" style="cursor: pointer;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-content="Oxygen saturation (SpO2) is the percentage of oxygen in a person's blood, measured with a pulse oximeter. A pulse oximeter is a medical device that clips onto a finger or earlobe and uses light to measure oxygen levels"
                                                            title="Oxygen Saturation (SPO2)"></i>
                                                    </div>
                                                </h3>
                                                <span>
                                                    @if ($spo2 >= 95 && $spo2)
                                                        <div class="text-success">Normal</div>
                                                    @elseif ($spo2 >= 90 && $spo2 < 95)
                                                        <div class="text-warning">Mild Hypoxemia</div>
                                                    @elseif ($spo2 < 90)
                                                        <div class="text-danger">Hypoxemia</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="clearfix text-center">
                                                @if ($spo2 >= 95)
                                                    <h3 class="text-success mb-0">{{ $spo2 }}</h3>
                                                @elseif ($spo2 >= 90 && $spo2 < 95)
                                                    <h3 class="text-warning mb-0">{{ $spo2 }}</h3>
                                                @elseif ($spo2 < 90)
                                                    <h3 class="text-danger mb-0">{{ $spo2 }}</h3>
                                                @endif

                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="spark-bar-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($medicals as $medical)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#diagnosisModal{{ $medical->id }}">
                                    {{ $medical->diagnosis }}
                                </button>

                                <div class="modal fade" id="diagnosisModal{{ $medical->id }}" tabindex="-1"
                                    aria-labelledby="diagnosisModal{{ $medical->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="diagnosisModal{{ $medical->id }}Label">
                                                    {{ $medical->diagnosis }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-primary">
                                                            <tr>
                                                                <th>Symptoms</th>
                                                                <th>Durations</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($medical->presenting_complaint as $record)
                                                                <tr>
                                                                    <td>{{ $record['symptom'] }}</td>
                                                                    <td>{{ $record['duration'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <fieldset disabled="">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-5 ">
                                                            <label for="symptom">Treatment for this Disease :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->treatment }}">
                                                        </div>
                                                        <div class="mb-3 col-md-5 ">
                                                            <label for="duration">Medication for this Disease :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->medication }}">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset disabled="">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-5 ">
                                                            <label for="symptom">Medical History :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->medical_history }}">
                                                        </div>
                                                        <div class="mb-3 col-md-5 ">
                                                            <label for="duration">Surgical Histroy :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->surgical_history }}">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset disabled="">
                                                    <h5>Allergic History</h5>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4 ">
                                                            <label for="symptom">Food :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->food }}">
                                                        </div>
                                                        <div class="mb-3 col-md-4 ">
                                                            <label for="duration">Drugs :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->drugs }}">
                                                        </div>
                                                        <div class="mb-3 col-md-4 ">
                                                            <label for="duration">Plaster :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->plaster }}">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset disabled="">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-5 ">
                                                            <label for="symptom">Family History of Chronic illnesses
                                                                :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->family_history }}">
                                                        </div>
                                                        <div class="mb-3 col-md-5 ">
                                                            <fieldset class="mb-3 col-md-6">
                                                                <label class="col-form-label">Consanguineous
                                                                    Marriage</label>
                                                                <div class="col-sm-9">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="Yes"
                                                                            @if ($medical->consanguineous_marriage == 'Yes') checked @endif>
                                                                        <label class="form-check-label">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="No"
                                                                            @if ($medical->consanguineous_marriage == 'No') checked @endif>
                                                                        <label class="form-check-label">No</label>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset disabled="">
                                                    <h5>Social History</h5>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-3 ">
                                                            <label for="symptom">Occupation :</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->occupation }}">
                                                        </div>
                                                        <div class="mb-3 col-md-3 ">
                                                            <label for="monthly_income">Monthly Income</label>
                                                            <input type="number" class="form-control" readonly
                                                                value="{{ $medical->monthly_income }}">
                                                        </div>
                                                        <div class="mb-3 col-md-3 ">
                                                            <label for="duration">Nearest Hospital</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->nearest_hospital }}">
                                                        </div>
                                                        <div class="mb-3 col-md-3 ">
                                                            <label for="duration">Water Source</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{ $medical->water_source }}">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset disabled="">
                                                    <h5>Signs</h5>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Height</th>
                                                                    <th>Weight</th>
                                                                    <th>BMI</th>
                                                                    <th>Status</th>
                                                                    <th>Temperature</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <td>{{ $medical->height }}</td>
                                                                <td>{{ $medical->weight }}</td>
                                                                <td>{{ $medical->bmi }}</td>
                                                                <td>
                                                                    @if ($medical->bmi < 16)
                                                                        <span class="badge badge-danger">Severe
                                                                            Thinness</span>
                                                                    @elseif($medical->bmi >= 16 && $medical->bmi < 18)
                                                                        <span class="badge badge-info">Mild Thinness</span>
                                                                    @elseif($medical->bmi >= 18.5 && $medical->bmi < 25)
                                                                        <span class="badge badge-success">Normal</span>
                                                                    @elseif($medical->bmi >= 25 && $medical->bmi < 30)
                                                                        <span class="badge badge-warning">Overweight</span>
                                                                    @elseif($medical->bmi >= 30 && $medical->bmi < 35)
                                                                        <span class="badge badge-warning">Obese Class
                                                                            I</span>
                                                                    @elseif($medical->bmi >= 35 && $medical->bmi < 340)
                                                                        <span class="badge badge-info">Obese Class
                                                                            II</span>
                                                                    @elseif($medical->bmi >= 35 && $medical->bmi < 40)
                                                                        <span class="badge badge-warning">Obese Class
                                                                            III</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $medical->temperature }}</td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="general_sign">General Sign:</label>
                                                            <textarea class="form-control" id="general_sign" readonly rows="5">{{ $medical->general_sign }}</textarea>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="abdominal">Abdominal:</label>
                                                            <textarea class="form-control" readonly rows="5">{{ $medical->abdominal }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="cardiovascular_system">Cardiovascular
                                                                System:</label>
                                                            <textarea class="form-control" id="cardiovascular_system" readonly rows="5">{{ $medical->cardiovascular_system }}</textarea>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="respiratory_system">Respiratory System:</label>
                                                            <textarea class="form-control" id="respiratory_system" readonly rows="5">{{ $medical->respiratory_system }}</textarea>
                                                        </div>
                                                    </div>
                                                </fieldset>
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
                                                            @foreach ($medical->management_plan as $record)
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role->name == 'Doctor')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="nav nav-pills mb-4">
                                    <a href="#v-pills-home" data-bs-toggle="pill" class="nav-link active show">Presenting
                                        Complaint</a>
                                    <a href="#v-pills-profile" data-bs-toggle="pill" class="nav-link">History of
                                        Presenting
                                        Complaint</a>
                                    <a href="#v-pills-messages" data-bs-toggle="pill" class="nav-link">Medical
                                        History</a>
                                    <a href="#v-pills-settings" data-bs-toggle="pill" class="nav-link">Surgical
                                        History</a>
                                    <a href="#v-pills-allergic" data-bs-toggle="pill" class="nav-link">Allergic
                                        History</a>
                                    <a href="#v-pills-family" data-bs-toggle="pill" class="nav-link">Family History</a>
                                    <a href="#v-pills-social" data-bs-toggle="pill" class="nav-link">Social History</a>
                                    <a href="#v-pills-signs" data-bs-toggle="pill" class="nav-link">Signs</a>
                                    <a href="#v-pills-plan" data-bs-toggle="pill" class="nav-link">Management Plan</a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="tab-content">
                                        <form method="POST" action="{{ route('medical.store', $patient->id) }}">
                                            @csrf
                                            <div id="v-pills-home" class="tab-pane fade active show">
                                                <div class="d-none" id="home">
                                                    <div class="row" id="row1">
                                                        <div class="mb-3 col-md-5 input-primary">
                                                            <label for="symptom1">Symptom</label>
                                                            <input type="text" name="symptoms[]"
                                                                class="form-control symptom" id="symptom1"
                                                                placeholder="Symptom" required>
                                                        </div>
                                                        <div class="mb-3 col-md-5 input-primary">
                                                            <label for="duration1">Duration</label>
                                                            <input type="text" name="durations[]"
                                                                class="form-control duration" id="duration1"
                                                                placeholder="Duration" required>
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <label>&nbsp;</label>
                                                            <br>
                                                            <button type="button"
                                                                class="btn btn-primary add-button">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="v-pills-profile" class="tab-pane fade">
                                                <div class="d-none" id="profile">
                                                    <div class="row">
                                                        <div class="input-primary">
                                                            <label for="treatment">Treatment for this Disease</label>
                                                            <textarea name="treatment" class="form-control " id="treatment" placeholder="Treatment for this Disease" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-primary">
                                                            <label for="medication">Medication for this Disease</label>
                                                            <textarea name="medication" class="form-control" id="medication" placeholder="Medication for this Disease" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="v-pills-messages" class="tab-pane fade">
                                                <div class="d-none input-primary" id="messages">
                                                    <label for="medical_history">Medical History</label>
                                                    <textarea name="medical_history" class="form-control" id="medical_history" placeholder="Medical History" required></textarea>
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
                                                        <input type="text" name="food" class="form-control"
                                                            id="food" placeholder="Food">
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="drugs">Drugs</label>
                                                        <input type="text" name="drugs" class="form-control"
                                                            id="drugs" placeholder="Drugs">
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="plaster">Plaster</label>
                                                        <input type="text" name="plaster" class="form-control"
                                                            id="plaster" placeholder="Plaster">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="v-pills-family" class="tab-pane fade">
                                                <div class="d-none" id="family">
                                                    <div class="row">
                                                        <div class="input-primary">
                                                            <label for="treatment">Family History of Chronic
                                                                illnesses</label>
                                                            <textarea name="family_history" class="form-control " id="family_history"
                                                                placeholder="Family History of Chronic illnesses" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <fieldset class="mb-3 col-md-6">
                                                            <label class="col-form-label">Consanguineous Marriage</label>
                                                            <div class="col-sm-9">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="consanguineous_marriage" value="Yes">
                                                                    <label class="form-check-label">
                                                                        Yes
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="consanguineous_marriage" value="No"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalGrid">
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
                                                        <input type="text" name="occupation" class="form-control"
                                                            id="occupation" placeholder="Occupation">
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="monthly_income">Monthly Income</label>
                                                        <input type="number" name="monthly_income" class="form-control"
                                                            id="monthly_income" placeholder="Monthly Income">
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="nearest_hospital">Nearest Hospital</label>
                                                        <input type="text" name="nearest_hospital"
                                                            class="form-control" id="nearest_hospital"
                                                            placeholder="Nearest Hospital">
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="water_source">Water Source</label>
                                                        <input type="text" name="water_source" class="form-control"
                                                            id="water_source" placeholder="Water Source">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="v-pills-signs" class="tab-pane fade">
                                                <div class="d-none" id="signs">
                                                    <div class="input-primary">
                                                        <label for="general_sign">General Sign</label>
                                                        <input type="text" name="general_sign" class="form-control"
                                                            id="general_sign" placeholder="General Sign" required>
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="abdominal">Abdominal</label>
                                                        <input type="text" name="abdominal" class="form-control"
                                                            id="abdominal" placeholder="Abdominal" required>
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="cardiovascular_system">Cardiovascular System</label>
                                                        <input type="text" name="cardiovascular_system"
                                                            class="form-control" id="cardiovascular_system"
                                                            placeholder="Cardiovascular System" required>
                                                    </div>
                                                    <div class="input-primary">
                                                        <label for="respiratory_system">Respiratory System</label>
                                                        <input type="text" name="respiratory_system"
                                                            class="form-control" id="respiratory_system"
                                                            placeholder="Respiratory System" required>
                                                    </div>
                                                    <div class="row input-primary">
                                                        <div class="mb-3 col-md-3">
                                                            <label for="height">Height (meters):</label>
                                                            <input type="number" class="form-control" id="height"
                                                                name="height" step="0.01" placeholder="Height"
                                                                required>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="weight">Weight (kg):</label>
                                                            <input type="number" id="weight" class="form-control"
                                                                name="weight" step="0.01" placeholder="Weight'"
                                                                required>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="bmi">BMI:</label>
                                                            <input type="number" class="form-control" id="bmi"
                                                                name="bmi" readonly placeholder="BMI" required>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="temperature">Temperature (°C):</label>
                                                            <input type="number" class="form-control" id="temperature"
                                                                name="temperature" step="0.01"
                                                                placeholder="Temperature" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="v-pills-plan" class="tab-pane fade">
                                                <div class="d-none" id="plan">
                                                    <div class="input-primary">
                                                        <label for="diagnosis">Diagnosis</label>
                                                        <input type="text" name="diagnosis" class="form-control"
                                                            id="diagnosis" placeholder="Diagnosis" required>
                                                    </div>
                                                    <div class="row input-primary" id="ro1">
                                                        <div class="mb-3 col-md-3">
                                                            <label for="drug_name">Drug Name:</label>
                                                            <input type="text" name="drug_name[]" id="drug_name"
                                                                class="form-control" placeholder="Drug Name">
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <label for="dose">Dose:</label>
                                                            <input type="text" name="dose[]" id="dose"
                                                                class="form-control" placeholder="Dose">
                                                        </div>

                                                        <div class="mb-3 col-md-2">
                                                            <label for="route">Route:</label>
                                                            <input type="text" name="route[]" id="route"
                                                                class="form-control" placeholder="Route">
                                                        </div>

                                                        <div class="mb-3 col-md-3">
                                                            <label for="frequency">Frequency:</label>
                                                            <input type="text" name="frequency[]" id="frequency"
                                                                class="form-control" placeholder="Frequency">
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <label>&nbsp;</label>
                                                            <br>
                                                            <button type="button"
                                                                class="btn btn-primary add">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('patient.uploadPdf', $patient->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Select Document</span>
                            <div class="form-file">
                                <input type="file" class="form-file-input form-control" id="pdf" name="pdf"
                                    required>
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
                if (targetId == '#v-pills-home') {
                    $('#home').removeClass('d-none');
                    $('#profile').addClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#allergic').addClass('d-none');
                    $('#family').addClass('d-none');
                    $('#social').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                }

                if (targetId == '#v-pills-profile') {
                    $('#profile').removeClass('d-none');
                    $('#home').addClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#family').addClass('d-none');
                    $('#social').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#allergic').addClass('d-none');
                }

                if (targetId == '#v-pills-messages') {
                    $('#messages').removeClass('d-none');
                    $('#home').addClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#profile').addClass('d-none');
                    $('#family').addClass('d-none');
                    $('#social').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#allergic').addClass('d-none');
                }
                if (targetId == '#v-pills-settings') {
                    $('#settings').removeClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#home').addClass('d-none');
                    $('#profile').addClass('d-none');
                    $('#family').addClass('d-none');
                    $('#social').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#allergic').addClass('d-none');
                }
                if (targetId == '#v-pills-allergic') {
                    $('#allergic').removeClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#home').addClass('d-none');
                    $('#family').addClass('d-none');
                    $('#social').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#profile').addClass('d-none');
                }
                if (targetId == '#v-pills-family') {
                    $('#family').removeClass('d-none');
                    $('#allergic').addClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#home').addClass('d-none');
                    $('#social').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#profile').addClass('d-none');
                }
                if (targetId == '#v-pills-social') {
                    $('#social').removeClass('d-none');
                    $('#family').addClass('d-none');
                    $('#allergic').addClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#home').addClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#profile').addClass('d-none');
                }
                if (targetId == '#v-pills-signs') {
                    $('#signs').removeClass('d-none');
                    $('#social').addClass('d-none');
                    $('#family').addClass('d-none');
                    $('#allergic').addClass('d-none');
                    $('#settings').addClass('d-none');
                    $('#messages').addClass('d-none');
                    $('#home').addClass('d-none');
                    $('#plan').addClass('d-none');
                    $('#profile').addClass('d-none');
                }
                if (targetId == '#v-pills-plan') {
                    $('#plan').removeClass('d-none');
                    $('#signs').addClass('d-none');
                    $('#social').addClass('d-none');
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
                newRow.find('.add-button').text('Remove').removeClass('btn-primary add-button').addClass(
                    'btn-danger remove-button');
                $('#row1').parent().append(newRow);
            });

            $(document).on('click', '.remove-button', function() {
                $(this).closest('.row').remove();
            });

            $('#height, #weight').on('input', function() {
                var height = parseFloat($('#height').val());
                var weight = parseFloat($('#weight').val());
                var bmi = weight / (height * height);
                $('#bmi').val(bmi.toFixed(2));
            });

            let rowNo = 1;

            $(document).on('click', '.add', function() {
                rowNo++;
                let newRow = $('#ro1').clone();
                newRow.attr('id', 'ro' + rowNo);
                newRow.find('#drug_name,#dose,#route,#frequency').val('');
                newRow.find('.add').text('Remove').removeClass('btn-primary add').addClass(
                    'btn-danger remove');
                $('#ro1').parent().append(newRow);
            });
            $(document).on('click', '.remove', function() {
                $(this).closest('.row').remove();
            });
        });
    </script>
@endsection
