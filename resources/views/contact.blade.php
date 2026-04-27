@extends('layouts.parent')

@section('title', 'Contact Us - OrabyStore')

@section('content')

    {{-- Banner --}}
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Contact Us</h2>
                        <p>We are always happy to hear from you</p>
                    </div>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('contact') }}">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="section_gap">
        <div class="container">

            {{-- Info Cards --}}
            <div class="row justify-content-center mb-40">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Get</span> In Touch</h2>
                        <p>We are always happy to hear from you. Reach out through any of the channels below.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-feature text-center">
                        <a href="#" class="title">
                            <i class="ti-home"></i>
                            <h3>Address</h3>
                        </a>
                        <p>Beni Suef, Egypt</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-feature text-center">
                        <a href="mailto:mosasameh123@gmail.com" class="title">
                            <i class="ti-email"></i>
                            <h3>Email</h3>
                        </a>
                        <p><a href="mailto:mosasameh123@gmail.com">mosasameh123@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-feature text-center">
                        <a href="tel:+201281856592" class="title">
                            <i class="ti-mobile"></i>
                            <h3>Phone</h3>
                        </a>
                        <p><a href="tel:+201281856592">+20 128 185 6592</a></p>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="row mt-4">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="contact-title mb-4">Send us a Message</h2>
                    @if (session('success'))
                        <div class="alert alert-success mb-3">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="form-contact" action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" cols="30" rows="9" placeholder="Enter Message">{{ old('message') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" type="text" placeholder="Enter your name"
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" type="email"
                                        placeholder="Enter email address" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" type="text" placeholder="Enter Subject"
                                        value="{{ old('subject') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="main_btn">Send Message</button>
                        </div>
                    </form>
                </div>

                {{-- Social --}}
                <div class="col-lg-4">
                    <h2 class="contact-title mb-4">Follow Us</h2>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-facebook"></i></span>
                        <div class="media-body">
                            <a href="https://www.facebook.com/share/1CfcigUQ94/" target="_blank">Facebook</a>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-linkedin"></i></span>
                        <div class="media-body">
                            <a href="https://www.linkedin.com/in/mohamedalaaorabii" target="_blank">LinkedIn</a>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-github"></i></span>
                        <div class="media-body">
                            <a href="https://github.com/mohamedorabiii" target="_blank">GitHub</a>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-mobile"></i></span>
                        <div class="media-body">
                            <a href="https://wa.me/201281856592" target="_blank">WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
