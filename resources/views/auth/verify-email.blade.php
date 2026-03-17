@extends('layouts.parent')

@section('title', 'Verify Email')

@section('content')
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Secure Account Access</p>
                    <h1>Verify Email</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">One Last</span> Step</h3>
                    <p>{{ __('Please verify your email address to continue shopping and complete checkout.') }}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="single-product-item p-4">
                    @if (session('resent') || session('status') === 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p class="mb-4">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="boxed-btn w-100 text-center border-0">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="{{ route('home') }}">{{ __('Back to Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
