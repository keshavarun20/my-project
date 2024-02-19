@extends('layouts.admin.master')
@section('title', 'HCC : User Create')
@section('header', 'Users')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.create') }}">Create Users</a></li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Create</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        @include('admin.user._form')
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
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
