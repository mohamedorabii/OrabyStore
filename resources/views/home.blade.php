@extends('layouts.parent')

@section('title', 'Home - OrabyStore')

@section('content')

{{-- Banner --}}
<section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content row">
                <div class="col-lg-12">
                    <p class="sub text-uppercase">New Collection</p>
                    <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
                    <a class="main_btn mt-40" href="{{ route('products') }}">View Collection</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="feature-area section_gap_bottom_custom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-money"></i>
                        <h3>Money back guarantee</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-truck"></i>
                        <h3>Free Delivery</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-support"></i>
                        <h3>Always support</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-blockchain"></i>
                        <h3>Secure payment</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Products Section --}}
<section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Latest Products</span></h2>
                </div>
            </div>
        </div>

        {{-- Category Filter --}}
        <div class="row mb-4">
            <div class="col-12 text-center">
                <a href="{{ route('home') }}">
                    <button class="main_btn {{ !request()->route('id') ? '' : 'btn-outline' }}">All</button>
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('home.category', $category->id) }}">
                        <button class="main_btn {{ request()->route('id') == $category->id ? '' : 'btn-outline' }}">
                            {{ $category->name_en }}
                        </button>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="single-product">
                    <div class="product-img">
                       <img class="img-fluid w-100"
    src="{{ asset('storage/' . $product->image) }}"
    alt="{{ $product->name_en }}" />
                        <div class="p_icon">
                            <a href="{{ route('product.details', $product->id) }}" title="View">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="#" class="cart-trigger"
                               data-form="cart-form-{{ $product->id }}"
                               title="Add to cart">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="{{ route('product.details', $product->id) }}" class="d-block">
                            <h4>{{ $product->name_en }}</h4>
                        </a>
                        <div class="mt-3">
                            <span class="mr-4">${{ $product->price }}</span>
                        </div>
                    </div>
                </div>

                <form id="cart-form-{{ $product->id }}"
                      action="{{ route('cart.add') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                </form>

            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection