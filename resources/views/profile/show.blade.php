@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s Profile</h1>
    <p>Email: {{ $user->email }}</p>
    <!-- Add more user information here as needed -->
    
    <a href="{{ route('profile.edit') }}">Edit Profile</a>
</div>
@endsection