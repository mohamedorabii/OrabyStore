@extends('layouts.parent')

@section('title', 'Register - OrabyStore')

@section('content')



{{-- Register Section --}}
<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card">

                    <h3 class="text-center mb-2">Create Account</h3>
                    <p class="text-center mb-4">Register now to start shopping and save your orders.</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
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

                        <div class="form-group mb-4">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control" required>
                        </div>

                        <button type="submit" class="main_btn">REGISTER</button>

                    </form>

                    <div class="divider">─── OR ───</div>

                    <a href="{{ url('/auth/google/redirect') }}" class="google-btn">
                        <i class="fa fa-google"></i> Register with Google
                    </a>

                    @if(Route::has('login'))
                    <p class="register-link">
                        Already have an account?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@endsection