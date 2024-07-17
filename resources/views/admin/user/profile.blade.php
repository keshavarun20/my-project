@extends('layouts.admin.master')
@section('title', 'HCC : Users')
@section('header', 'Users')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('user.profile', Auth::user()->id) }}">Profile</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo" data-bs-toggle="modal" data-bs-target="#changeProfilePictureModal">
                                @if ($user->getMedia('profile_picture')->count() > 0)
                                    <img src="{{ $user->getFirstMediaUrl('profile_picture') }}" class="img-fluid rounded-circle" alt="">
                                @else
                                    <img src="/images/default-profile-photo.jpg" class="img-fluid rounded-circle" alt="">
                                @endif
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    @if ($user->role->name == 'Doctor')
                                        <h4 class="text-primary mb-0">{{ $user->doctor->name }}</h4>
                                    @elseif($user->role->name == 'Patient')
                                        <h4 class="text-primary mb-0">{{ $user->patient->name }}</h4>
                                    @else
                                        <h4 class="text-primary mb-0">{{ $user->receptionist->name }}</h4>
                                    @endif
                                    <p>{{ $user->role->name }}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ $user->email }}</h4>
                                    <p>Email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
		<div class="col-xl-6">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="profile-statistics">
								<div class="text-center">
									<div class="row overflow-auto" style="max-height: 200px;">
										@foreach($logs as $log)
											<p>{{ $log->description }} - {{ $log->created_at }}</p>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

    </div>
</div>

<div class="modal fade" id="changeProfilePictureModal" tabindex="-1" aria-labelledby="changeProfilePictureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeProfilePictureModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.profile_picture', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Choose Profile Picture</span>
                            <div class="form-file">
                                <input type="file" class="form-file-input form-control" id="profile_picture" name="profile_picture" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
