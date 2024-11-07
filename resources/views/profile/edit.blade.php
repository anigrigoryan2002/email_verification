@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Profile</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Profile Update Form -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Avatar') }}</strong></label>
            <div class="col-md-8 text-center">
                @if (!$user->avatar)
                <img src="{{ asset($user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle mb-2" style="max-width: 150px;">
                @else
                    <img src="{{ asset($user->gender === 'male' ? 'images/male-avatar.jpg' : 'images/female-avatar.jpg') }}" alt="Default Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                @endif
                <input type="file" name="avatar" accept="image/*" class="form-control">
            </div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Name') }}</strong></label>
            <div class="col-md-8">
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Email') }}</strong></label>
            <div class="col-md-8">
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Phone') }}</strong></label>
            <div class="col-md-8">
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Gender') }}</strong></label>
            <div class="col-md-8">
                <select name="gender" class="form-control">
                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </div>
    </form>

    <button id="editPasswordBtn" class="btn btn-primary mb-3">Edit Password</button>
    <form id="changePasswordForm" method="POST" action="{{ route('profile.updatePassword') }}" style="display: none;">
        @csrf
        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Old Password') }}</strong></label>
            <div class="col-md-8">
                <input type="password" name="old_password" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('New Password') }}</strong></label>
            <div class="col-md-8">
                <input type="password" name="new_password" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>{{ __('Repeat New Password') }}</strong></label>
            <div class="col-md-8">
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </div>
    </form>

</div>

@section('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection

@endsection

@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection