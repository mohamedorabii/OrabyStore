@extends('layouts.parent')

@section('title', 'Products - OrabyStore')

@section('content')

    {{-- Banner --}}
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Our Products</h2>
                        <p>Browse all our products</p>
                    </div>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('products') }}">Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Products Section --}}
    <section class="cat_product_area section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Our</span> Products</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name_en }}" />
                                <div class="p_icon">
                                    <a href="{{ route('product.details', $product->id) }}" title="View">
                                        <i class="ti-eye"></i>
                                    </a>

                                    <<a href="#" class="cart-trigger" data-form="cart-form-{{ $product->id }}"
                                        title="Add to cart">
                                        <i class="ti-shopping-cart"></i>
                                        </a>

                                        <form id="cart-form-{{ $product->id }}" action="{{ route('cart.add') }}"
                                            method="POST" style="display:none;">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                        </form>
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
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <ul style="display:flex; gap:10px; justify-content:center; list-style:none; padding:0;">
                            @if ($products->onFirstPage())
                                <li><span class="main_btn" style="opacity:0.5; cursor:not-allowed;">← Prev</span></li>
                            @else
                                <li><a href="{{ $products->previousPageUrl() }}" class="main_btn">← Prev</a></li>
                            @endif

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li><span class="main_btn">{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}" class="main_btn"
                                            style="background:#fff; color:#333; border:1px solid #ddd;">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}" class="main_btn">Next →</a></li>
                            @else
                                <li><span class="main_btn" style="opacity:0.5; cursor:not-allowed;">Next →</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection
