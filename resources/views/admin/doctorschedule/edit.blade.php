@extends('layouts.admin.master')
@section('title','Edit User')
@section('header','Users')
@section('content')

<div class="content-body">
    <div class="container-fluid">
    <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dschedule.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dschedule.edit', [$doctor->id]) }}">Edit</a></li>
            </ol>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Schedule</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="post" action="{{ route('dschedule.update', [$doctor->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH') 
                            <div class="row">
                                <div class="col-md-8">
                                    @include('admin.doctorschedule._form')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('dschedule.index')}}" class="btn btn-secondary">Cancel</a>
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
