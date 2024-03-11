@extends('layouts.admin.master')
@section('title','Patients Lists')
@section('header','Patients')
@section('content')

<div class="content-body">
    <div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Patients Lists</a></li>
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
                    <h4 class="card-title">Patients Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Status</th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($patients as $patient )
                                <tr>
                                    <td>{{$patient->id}}</td>
                                    <td>{{$patient->name}}</td>
                                    <td>{{$patient->user->email}}</td>
                                    <td>{{$patient->mobile_number}}</td>
                                    <td>{{$patient->today_date}}</td>
                                    <td>
                                        @if($patient->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                    <div class="dropdown ms-auto">
											<a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
											<ul class="dropdown-menu dropdown-menu-end">
												<a href="{{ route('patient.profile', $patient->id)}}"><li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i>View profile</li></a>
											</ul>
										</div>
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