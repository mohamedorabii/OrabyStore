@extends('layouts.parent')

@section('title', 'Contact Us')

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Contact Us</p>
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content')
	<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Get</span> In Touch</h3>
						<p>
							We are always happy to hear from you. Reach out through any of the channels below
							and we will get back to you as soon as possible.
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="single-product-item text-center p-4 h-100">
						<h3><i class="fas fa-map-marker-alt orange-text mr-2"></i> Address</h3>
						<p class="mb-0">Beni Suef, Egypt</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 mb-4">
					<div class="single-product-item text-center p-4 h-100">
						<h3><i class="fas fa-envelope orange-text mr-2"></i> Email</h3>
						<p class="mb-0">
							<a href="mailto:mosasameh123@gmail.com">mosasameh123@gmail.com</a>
						</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-12 mb-4">
					<div class="single-product-item text-center p-4 h-100">
						<h3><i class="fas fa-phone orange-text mr-2"></i> Phone</h3>
						<p class="mb-0">
							<a href="tel:+201281856592">+20 128 185 6592</a>
						</p>
					</div>
				</div>
			</div>

			<div class="row mt-4 contact-social">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h4 class="mb-4">Follow Us</h4>
					<div class="social-icons">
						<ul class="d-inline-flex align-items-center justify-content-center">
							<li>
								<a href="https://www.facebook.com/share/1CfcigUQ94/" target="_blank">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<li>
								<a href="https://www.linkedin.com/in/mohamedalaaorabii" target="_blank">
									<i class="fab fa-linkedin"></i>
								</a>
							</li>
							<li>
								<a href="https://github.com/mohamedorabiii" target="_blank">
									<i class="fab fa-github"></i>
								</a>
							</li>
							<li>
								<a href="https://wa.me/201281856592" target="_blank">
									<i class="fab fa-whatsapp"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
