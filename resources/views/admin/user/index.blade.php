@extends('layouts.admin.master')
@section('title', 'HCC : Users')
@section('header', 'Users')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Home</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
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
                    @if (session('deleted'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            <strong>Success!</strong>{{ session('deleted') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="btn-close"></button>
                        </div>
                    @endif
                    @if (session('updated'))
                        <div class="alert alert-secondary alert-dismissible fade show">
                            <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <path
                                    d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                                </path>
                            </svg>
                            <strong>Done!</strong> {{ session('updated') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            </button>
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">User List</h4>
                        <div>
                            <form method="get" action="{{ route('search') }}">
                                <div class="d-flex align-items-center">
                                    <div class="input-group search-area">
                                        <input type="text" name="search" class="form-control" placeholder="Search here..."
                                            value="{{ isset($q) ? $q : '' }}">
                                        <span class="input-group-text">
                                            <button type="submit" style="border: none; background-color: transparent;"><i
                                                    class="flaticon-381-search-2"></i></button>
                                        </span>
                                    </div>
                                    <a href="{{ route('user.create') }}" class="btn btn-success ms-2">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            @if ($user->role->name == 'Doctor')
                                                <td>{{ $user->doctor->first_name }}</td>
                                            @elseif($user->role->name == 'Patient')
                                                <td>{{ $user->patient->first_name }}</td>
                                            @else
                                                <td>{{ $user->receptionist->first_name }}</td>
                                            @endif
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->name }}</td>
                                            <td>
                                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info">View</a>
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $user->id }}">Delete</button>
                                                <!-- Delete User Modal -->
                                                <div class="modal fade" id="deleteModal-{{ $user->id }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this user?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <!-- Form for deletion -->
                                                                <form action="{{ route('user.destroy', [$user->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
