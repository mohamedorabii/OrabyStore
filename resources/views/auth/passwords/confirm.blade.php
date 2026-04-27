@extends('layouts.parent')

@section('title', 'Confirm Password - OrabyStore')

@section('content')


{{-- Confirm Password Section --}}
<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card">

                    <h3 class="text-center mb-2">Confirm Password</h3>
                    <p class="text-center mb-4">Please confirm your password before continuing.</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="main_btn">
                            Confirm Password
                        </button>

                    </form>

                    @if(Route::has('password.request'))
                    <p class="register-link">
                        <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                    </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@endsection