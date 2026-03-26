@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-header">
    <h1>Create Account</h1>
    <p>Join us to book your amazing tours!</p>
</div>

<form method="POST" action="{{ route('register.post') }}">
    @csrf

    <div class="form-group">
        <label for="name" class="form-label">Full Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="john@example.com">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone" class="form-label">Phone Number</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" placeholder="0123456789">
        @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create a password">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group" style="margin-bottom: 2rem;">
        <label for="password-confirm" class="form-label">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
    </div>

    <button type="submit" class="btn">
        Create Account
    </button>
</form>

<div class="auth-links">
    Already have an account? <a href="{{ route('login') }}">Login here</a>
</div>
@endsection
