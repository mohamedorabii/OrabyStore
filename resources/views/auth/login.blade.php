@extends('layouts.parent')

@section('title', 'Login - OrabyStore')

@section('content')



{{-- Login Section --}}
<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card">

                    <h3 class="text-center mb-2">Welcome Back</h3>
                    <p class="text-center mb-4">Login to continue shopping</p>

                    @if(session('error'))
                    <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div>

                        <button type="submit" class="main_btn">LOGIN</button>

                    </form>

                    <div class="divider">─── OR ───</div>

                    <a href="{{ url('/auth/google/redirect') }}" class="google-btn">
                        <i class="fa fa-google"></i> Login with Google
                    </a>

                    @if(Route::has('register'))
                    <p class="register-link">
                        Don't have an account?
                        <a href="{{ route('register') }}">Create one</a>
                    </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@endsection