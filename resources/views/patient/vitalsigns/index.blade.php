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
                                                <h3 class="card-title">Glucose Rate</h3>
                                                <span>In the normal</span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-success mb-0">97</h3>
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
                                                <h3 class="card-title">Heart Rate</h3>
                                                <span class="text-danger">Above the normal</span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-danger mb-0">107</h3>
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
                                                <h3 class="card-title">Clolesterol</h3>
                                                <span>In the normal</span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-info mb-0">124</h3>
                                                <span>mg/dl</span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="ico-sparkline">
                                                <div id="sparkline9" class="height80;"></div>
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
                                                <h3 class="card-title">Blood pressure</h3>
                                                <span>In the normal</span>
                                            </div>
                                            <div class="clearfix text-center">
                                                <h3 class="text-primary mb-0">120/89</h3>
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
                    <div class="form-group">
                        <label for="respiratory_rate">Respiratory Rate (breaths/min):</label>
                        <input type="number" name="respiratory_rate" id="respiratory_rate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="spo2">Oxygen Saturation (%):</label>
                        <input type="number" name="spo2" id="spo2" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
