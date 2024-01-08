@extends('layouts.admin.master')
@section('title','User List')
@section('header','Users')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Details</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form>
                        <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->Role->name }}">
                                </div>
                        </div>
                        @if($user->role->name == 'Doctor')
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->first_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->last_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->dob }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">NIC</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->nic }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->mobile_number }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Address Lane 1</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->address_lane_1 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Adress Lane 2</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->Address_lane_2 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->city }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Consultation</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->consultation->name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Specialty</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->specialty }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">SLMC No</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->slmc_no }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Base Hospital</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->doctor->base_hospital }}">
                                </div>
                            </div>
                        @elseif($user->role->name == 'Patient')
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->first_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->last_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->dob }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">NIC</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->nic }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->mobile_number }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Address Lane 1</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->address_lane_1 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Adress Lane 2</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->address_lane_2 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->patient->city }}">
                                </div>
                            </div>
                            @else
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->first_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->last_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->dob }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">NIC</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->nic }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->mobile_number }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Address Lane 1</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->address_lane_1 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Adress Lane 2</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->address_lane_2 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->city }}">
                                </div>
                            </div>
                        @endif
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-9">
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection