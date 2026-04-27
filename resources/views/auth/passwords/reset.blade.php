@extends('layouts.parent')

@section('title', 'Reset Password - OrabyStore')

@section('content')



{{-- Reset Password Section --}}
<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card">

                    <h3 class="text-center mb-2">Reset Your Password</h3>
                    <p class="text-center mb-4">Set a new password to secure your account.</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ $email ?? old('email') }}"
                                required autofocus>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>New Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control" required>
                        </div>

                        <button type="submit" class="main_btn">
                            Reset Password
                        </button>

                    </form>

                    <p class="register-link">
                        Remember your password?
                        <a href="{{ route('login') }}">Login</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection