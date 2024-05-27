@extends('layouts.admin.master')
@section('title', 'Vital Signs')
@section('header', 'Vital Signs ')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Vital Signs</a></li>
                </ol>
            </div>
            <form action="{{ route('vital.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-6 col-lg-6 col-xxl-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Glucose Rate <div
                                                        class="bootstrap-popover d-inline-block"
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
                                <div class="input-group mb-3 input-primary">
                                    <span class="input-group-text">Random Blood Sugar (mg/dL):</span>
                                    <input type="number" name="rbs" id="rbs" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-6 col-lg-6 col-xxl-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <div class="clearfix">
                                                <h3 class="card-title">Heart Rate <div
                                                        class="bootstrap-popover d-inline-block"
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
                                <div class="input-group mb-3 input-primary">
                                    <span class="input-group-text">Pulse Rate (bpm):</span>
                                    <input type="number" name="heart_rate" id="heart_rate" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-6 col-lg-6 col-xxl-6 col-md-6">
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
                                <div class="input-group mb-3 input-primary">
                                    <span class="input-group-text">Blood Pressure Systolic (mmHg):</span>
                                    <input type="number" name="blood_pressure_systolic" id="blood_pressure_systolic"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-6 col-lg-6 col-xxl-6 col-md-6">
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
                                <div class="input-group mb-3 input-primary">
                                    <span class="input-group-text">Blood Pressure Diastolic (mmHg):</span>
                                    <input type="number" name="blood_pressure_diastolic" id="blood_pressure_diastolic"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-6 col-lg-6 col-xxl-6 col-md-6">
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
                                <div class="input-group mb-3 input-primary">
                                    <span class="input-group-text">Respiratory Rate (breaths/min):</span>
                                    <input type="number" name="respiratory_rate" id="respiratory_rate"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-6 col-lg-6 col-xxl-6 col-md-6">
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
                                                    </div></h3>
                                                <span>
                                                    @if ($spo2 >= 95)
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
                                <div class="input-group mb-3 input-primary">
                                    <span class="input-group-text">Oxygen Saturation (SPO2) (%):</span>
                                    <input type="number" name="spo2" id="spo2" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Save</button>
                                </div>
                                <div class="col-xl-6 col-lg-6 mb-3">
                                    <a href="{{ route('vital.index') }}" class="btn btn-secondary w-100">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
