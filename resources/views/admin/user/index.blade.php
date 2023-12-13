@extends('layouts.admin.master')
@section('title','User List')
@section('content')


<div class="content-body">
<div class="container-fluid">
<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User List</h4>
                                <a href="{{ route('user.create')}}" class="btn btn-success">Create</i></a>
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
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td>
                                                        <a href="{{ route('user.show',$user->id) }}" class="btn btn-info">View</i></a>
														<a href="#" class="btn btn-primary">Edit</i></a>
														<a href="#" class="btn btn-danger">Delete</i></a>
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