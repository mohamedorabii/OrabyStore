@extends('layouts.parent')

@section('title', 'Products')

@section('content')





    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('product.details', $product->id) }}"><img
                                        src="{{ asset('storage/' . $product->image) }}"class="card-img-top"
                                        style="max-height:250px !important; min-height:250px !important;">
                                </a>
                                <h3>{{ $product->name_en }}</h3>
                                <p class="product-price"> {{ $product->price }}$ </p>
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                </form>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->


    </div>

@endsection
