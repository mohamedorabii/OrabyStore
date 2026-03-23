@extends('layouts.parent')

@section('title', 'Login')

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('Welcome') }}</span> {{ __('Back') }}</h3>
                        <p>{{ __('Login to continue shopping and manage your account.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="single-product-item p-4">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3 text-left">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3 text-left">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check mb-4 text-left">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <button type="submit" class="boxed-btn w-100 text-center border-0">
                                {{ __('Login') }}
                            </button>

                            <div class="mt-4 d-flex justify-content-between flex-wrap text-left">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                @endif

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">{{ __('Create new account') }}</a>
                                @endif
                            </div>
                            <div class="social-login-buttons">

                            </div>
                        </form>
                        <!-- Google Button -->
                        <a href="{{ url('/auth/google/redirect') }}" class="btn btn-danger w-100 mb-2">
                            <i class="fab fa-google me-2"></i> Login with Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
