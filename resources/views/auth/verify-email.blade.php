@extends('layouts.parent')

@section('title', 'Verify Email')

@section('content')

<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card text-center">

                    <h3 class="mb-2">Verify Your Email</h3>
                    <p class="mb-4">
                        Please verify your email address to continue shopping.
                    </p>

                    @if (session('resent') || session('status') === 'verification-link-sent')
                        <div class="alert alert-success mb-4">
                            A fresh verification link has been sent to your email.
                        </div>
                    @endif

                    <p class="mb-4">
                        Before proceeding, please check your email for a verification link.
                    </p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="main_btn">
                            Resend Verification Email
                        </button>
                    </form>

                    <div class="divider">─── OR ───</div>

                    <a href="{{ route('home') }}" class="google-btn">
                        Back to Home
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection