@extends('layouts.admin.master')
@section('title','Edit User')
@section('header','Users')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="post" action="{{ route('user.update', [$user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH') 
                            <div class="row">
                                <div class="col-md-8">
                                    @include('admin.user._eform')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('user.index')}}" class="btn btn-secondary">Cancel</a>
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
