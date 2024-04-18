@extends('layouts.admin.master')
@section('title', 'Hatton Consultation Centre')
@section('header', 'Dashboard')
@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-6">
            <div class="alert alert-primary left-icon-big alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                </button>
               <div class="media">
                    <div class="alert-left-icon-big">
                        <span><i class="mdi mdi-email-alert"></i></span>
                    </div>
                    <div class="media-body">
                        @if(session('success'))
                            <h6 class="mt-1 mb-2">
                                {{ session('success') }}
                                @if (Auth::user()->role->name == 'Doctor')
                                    {{ Auth::user()->doctor->name }}
                                @elseif(Auth::user()->role->name == 'Patient')
                                    {{ Auth::user()->patient->name }}
                                @else
                                    {{ Auth::user()->receptionist->name }}
                                @endif
                                !
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-info">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="me-3">
                                <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                  <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            <div class="media-body text-white text-end">
                                <p class="mb-1">Total Patients</p>
                                <h3 class="text-white">
                                     {{$totalPatients}}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
