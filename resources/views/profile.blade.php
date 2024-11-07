@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">User Profile</h2>

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4 text-center">
                    @if ($user->avatar)
                        <img src="{{ asset($user->avatar) }}" alt="User Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                    @else
                        <img src="{{ asset($user->gender === 'male' ? 'images/male-avatar.jpg' : 'images/female-avatar.jpg') }}" alt="{{ ucfirst($user->gender) }} Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                    @endif
                </div>
                <div class="col-md-8">
                    <h4 class="mb-0">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <label class="col-md-4 col-form-label"><strong>Phone</strong></label>
                <div class="col-md-8">
                    <p class="form-control-plaintext">{{ $user->phone ?? 'Not provided' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-4 col-form-label"><strong>Gender</strong></label>
                <div class="col-md-8">
                    <p class="form-control-plaintext">{{ ucfirst($user->gender ?? 'Not specified') }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-4 col-form-label"><strong>Joined on</strong></label>
                <div class="col-md-8">
                    <p class="form-control-plaintext">{{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-8 offset-md-4">
                    <div class="btn-group">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
