@extends('layouts.parent')

@section('title', 'Checkout')
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fast and Secure</p>
						<h1>Checkout</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
@section('content')


	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Complete</span> Your Order</h3>
						<p>Review your details and confirm your purchase.</p>
					</div>
				</div>
			</div>

			@if (session('error'))
				<div class="row mb-4">
					<div class="col-12">
						<div class="alert alert-danger mb-0" role="alert">
							{{ session('error') }}
						</div>
					</div>
				</div>
			@endif

			@if (session('success'))
				<div class="row mb-4">
					<div class="col-12">
						<div class="alert alert-success mb-0" role="alert">
							{{ session('success') }}
						</div>
					</div>
				</div>
			@endif

			@if ($errors->any())
				<div class="row mb-4">
					<div class="col-12">
						<div class="alert alert-danger mb-0" role="alert">
							<ul class="mb-0 pl-3">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			@endif

			<form action="{{ route('checkout.placeOrder') }}" method="POST">
				@csrf

			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="billingAccordion">
							<div class="card single-accordion">
								<div class="card-header" id="billingHeading">
									<h5 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#billingCollapse" aria-expanded="true" aria-controls="billingCollapse">
											Billing Details
										</button>
									</h5>
								</div>

								<div id="billingCollapse" class="collapse show" aria-labelledby="billingHeading" data-parent="#billingAccordion">
									<div class="card-body">
										<div class="billing-address-form">
											<p><input type="text" name="name" placeholder="Full Name" value="{{ old('name', auth()->user()->name ?? '') }}"></p>
											<p><input type="text" name="phone" placeholder="Phone" min="11" max="11" value="{{ old('phone') }}"></p>
											<p><input type="text" name="address" placeholder="Address" value="{{ old('address') }}"></p>
											<p><input type="text" name="city" placeholder="City" value="{{ old('city') }}"></p>
											<p><input type="text" name="governorate" placeholder="Governorate" value="{{ old('governorate') }}"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Your order Details</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
								<tr>
									<td>Product</td>
									<td>Total</td>
								</tr>
								@foreach ($cartItems as $item)
									@if ($item->product)
										<tr>
											<td>{{ $item->product->name_en }} x {{ $item->quantity }}</td>
											<td>${{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}</td>
										</tr>
									@endif
								@endforeach
							</tbody>
							<tbody class="checkout-details">
								<tr>
									<td>Subtotal</td>
									<td>${{ number_format($subtotal, 2) }}</td>
								</tr>
								<tr>
									<td>Shipping</td>
									<td>${{ number_format($shipping, 2) }}</td>
								</tr>
								<tr>
									<td>Total</td>
									<td>${{ number_format($total, 2) }}</td>
								</tr>
							</tbody>
						</table>

						<button type="submit" class="boxed-btn black mt-3 w-100 text-center border-0">
							Place Order
						</button>
						<a href="{{ route('cart.index') }}" class="boxed-btn black mt-3 w-100 text-center">Back to Cart</a>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
@endsection
