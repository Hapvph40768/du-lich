@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-header">
    <h1>Welcome Back!</h1>
    <p>Sign in to your account to continue</p>
</div>

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" style="font-size: 0.875rem; color: var(--text-muted);">Remember Me</label>
        </div>
        <a href="#" style="font-size: 0.875rem; color: var(--primary-color); text-decoration: none;">Forgot Password?</a>
    </div>

    <button type="submit" class="btn">
        Login
    </button>
</form>

<div class="auth-links">
    Don't have an account? <a href="{{ route('register') }}">Register here</a>
</div>
@endsection
