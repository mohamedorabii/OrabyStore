@extends('layouts.parent')

@section('title', 'Categories')
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fast and Secure</p>
						<h1>Categories</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Categories</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ route('products', $category->id) }}" class="category-card-link">
                            <div class="category-card">
                                <img src="{{ asset('storage/' . $category->image) }}"
                                     alt="{{ $category->name_en }}"
                                     class="category-img">
                                <div class="category-card-body">
                                    <h3>{{ $category->name_en }}</h3>
                                    <span>Browse Products &rarr;</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->


@endsection
