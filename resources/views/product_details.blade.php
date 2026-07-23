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
            <div class="row s_product_inner align-items-center">

                {{-- Product Image --}}
                <div class="col-lg-6">
                    <div class="s_product_img text-center">
                        <img class="img-fluid product-details-img" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name_en }}">
                    </div>
                </div>

                {{-- Product Info --}}
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">

                        <h3 class="mb-3">{{ $product->name_en }}</h3>

                        <h2 class="text-primary font-weight-bold mb-4">
                            ${{ number_format($product->price, 2) }}
                        </h2>

                        <ul class="list-unstyled mb-4">

                            <li class="d-flex justify-content-between align-items-center border-bottom py-3">
                                <strong>Category</strong>
                                <span>{{ $product->category->name_en }}</span>
                            </li>

                            <li class="d-flex justify-content-between align-items-center py-3">
                                <strong>Availability</strong>

                                @if ($product->quantity > 0)
                                    <span class="badge badge-success"
                                        style="font-size:15px;padding:7px 14px;border-radius:20px;font-weight:600;">
                                        In Stock ({{ $product->quantity }} left)
                                    </span>
                                @else
                                    <span class="badge badge-danger"
                                        style="font-size:15px;padding:7px 14px;border-radius:20px;font-weight:600;">
                                        Out of Stock
                                    </span>
                                @endif
                            </li>

                        </ul>

                        <p class="text-muted mb-4" style="line-height: 1.8;">
                            {{ $product->desc_en }}
                        </p>

                        @if ($product->quantity > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="row align-items-end">

                                    <div class="col-md-4">
                                        <label class="font-weight-bold mb-2">
                                            Quantity
                                        </label>

                                        <input type="number" name="quantity" min="1" max="{{ $product->quantity }}"
                                            value="1" class="form-control">
                                    </div>

                                    <div class="col-md-8 mt-3 mt-md-0">
                                        <button type="submit" class="main_btn w-100">
                                            <i class="ti-shopping-cart mr-2"></i>
                                            Add to Cart
                                        </button>
                                    </div>

                                </div>

                            </form>
                        @else
                            <button class="main_btn" disabled
                                style="background:#6c757d;border-color:#6c757d;cursor:not-allowed;">
                                Out of Stock
                            </button>
                        @endif

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

                            @if ($related->quantity > 0)
                                <span class="badge badge-success"
                                    style="position:absolute;top:10px;left:10px;font-size:13px;padding:6px 12px;border-radius:20px;z-index:10;">
                                    In Stock
                                </span>
                            @else
                                <span class="badge badge-danger"
                                    style="position:absolute;top:10px;left:10px;font-size:13px;padding:6px 12px;border-radius:20px;z-index:10;">
                                    Out of Stock
                                </span>
                            @endif

                            <img class="related-product-img"
                                src="{{ asset('storage/' . $related->image) }}"
                                alt="{{ $related->name_en }}">

                            <div class="p_icon">

                                <a href="{{ route('product.details', $related->id) }}" title="View">
                                    <i class="ti-eye"></i>
                                </a>

                                @if ($related->quantity > 0)
                                    <a href="#"
                                        class="cart-trigger"
                                        data-form="cart-form-{{ $related->id }}"
                                        title="Add to cart">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                @endif

                            </div>

                        </div>

                        <div class="product-btm">

                            <a href="{{ route('product.details', $related->id) }}" class="d-block">
                                <h4>{{ $related->name_en }}</h4>
                            </a>

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <span class="mr-4 font-weight-bold">
                                    ${{ number_format($related->price, 2) }}
                                </span>

                                @if ($related->quantity > 0)
                                    <small class="text-success">
                                        {{ $related->quantity }} left
                                    </small>
                                @else
                                    <small class="text-danger">
                                        Sold Out
                                    </small>
                                @endif

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
