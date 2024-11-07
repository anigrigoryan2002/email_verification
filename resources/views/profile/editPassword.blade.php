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

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>Old Password</strong></label>
            <div class="col-md-8">
                <input type="password" name="old_password" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>New Password</strong></label>
            <div class="col-md-8">
                <input type="password" name="new_password" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label"><strong>Repeat New Password</strong></label>
            <div class="col-md-8">
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-update">Update Profile</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection
