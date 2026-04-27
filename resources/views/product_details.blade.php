@extends('layouts.parent')

@section('title', 'Product Details - OrabyStore')

@section('content')

{{-- Banner --}}
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Product Details</h2>
                    <p>{{ $product->name_en }}</p>
                </div>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('products') }}">Products</a>
                    <a href="#">{{ $product->name_en }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Product Details --}}
<div class="product_image_area section_gap">
    <div class="container">
        <div class="row s_product_inner">

            {{-- Product Image --}}
            <div class="col-lg-6">
                <div class="s_product_img">
                    <img class="img-fluid w-100"
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name_en }}" />
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product->name_en }}</h3>
                    <h2>${{ $product->price }}</h2>
                    <ul class="list">
                        <li>
                            <a href="#">
                                <span>Category</span> : {{ $product->category->name_en }}
                            </a>
                        </li>
                        <li>
                            <a>
                                <span>Availability</span> : In Stock
                            </a>
                        </li>
                    </ul>
                    <p>{{ $product->desc_en }}</p>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="product_count">
                            <label>Quantity:</label>
                            <input type="number" name="quantity" min="1" max="20"
                                value="1" class="input-text qty">
                        </div>
                        <div class="card_area mt-3">
                            <button type="submit" class="main_btn">
                                <i class="ti-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Related Products --}}
<section class="cat_product_area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Related</span> Products</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($related_products as $related)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100"
                            src="{{ asset('storage/' . $related->image) }}"
                            alt="{{ $related->name_en }}" />
                        <div class="p_icon">
                            <a href="{{ route('product.details', $related->id) }}" title="View">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="#" class="cart-trigger"
                               data-form="cart-form-{{ $related->id }}"
                               title="Add to cart">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="{{ route('product.details', $related->id) }}" class="d-block">
                            <h4>{{ $related->name_en }}</h4>
                        </a>
                        <div class="mt-3">
                            <span class="mr-4">${{ $related->price }}</span>
                        </div>
                    </div>
                </div>

                <form id="cart-form-{{ $related->id }}"
                      action="{{ route('cart.add') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $related->id }}">
                    <input type="hidden" name="quantity" value="1">
                </form>

            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection