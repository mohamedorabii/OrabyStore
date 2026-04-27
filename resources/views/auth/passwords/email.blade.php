@extends('layouts.parent')

@section('title', 'Forgot Password - OrabyStore')

@section('content')



{{-- Forgot Password Section --}}
<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card">

                    <h3 class="text-center mb-2">Forgot Password?</h3>
                    <p class="text-center mb-4">Enter your email and we will send you a reset link.</p>

                    @if(session('status'))
                    <div class="alert alert-success mb-4">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required autofocus>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="main_btn">
                            Send Password Reset Link
                        </button>

                    </form>

                    <p class="register-link">
                        Remember your password?
                        <a href="{{ route('login') }}">Back to Login</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection