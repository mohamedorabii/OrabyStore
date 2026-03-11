@extends('layouts.parent')


@section('title', 'Shopping Cart')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Your Shopping Cart</p>
                    <h1>Your Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Your</span> Cart</h3>
                        <p>Review your selected products, update quantities, and continue to checkout.</p>
                    </div>
                </div>
            </div>

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

            @if ($cartItems->isEmpty())
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="single-product-item p-5">
                            <h4 class="mb-3">Your cart is empty</h4>
                            <p class="mb-4">Looks like you haven’t added products yet.</p>
                            <a href="{{ route('products') }}" class="boxed-btn">
                                <i class="fas fa-shopping-bag"></i> Start Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="cart-table-wrap">
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove"></th>
                                        <th class="product-image">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        @if ($item->product)
                                            <tr class="table-body-row">
                                                <td class="product-remove">
                                                    <form action="{{ route('cart.remove', $item) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="remove-btn" title="Remove item">
                                                            <i class="far fa-window-close"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="product-image">
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        alt="{{ $item->product->name_en }}">
                                                </td>
                                                <td class="product-name">{{ $item->product->name_en }}</td>
                                                <td class="product-price">${{ number_format($item->product->price, 2) }}
                                                </td>
                                                <td class="product-quantity">
                                                    <form action="{{ route('cart.update', $item) }}" method="POST"
                                                        class="d-flex align-items-center justify-content-center">
                                                        @csrf
                                                        <input type="number" name="quantity" min="1" max="20"
                                                            value="{{ $item->quantity }}" class="mr-2"
                                                            style="max-width: 80px;">
                                                        <button type="submit" class="boxed-btn"
                                                            style="padding: 8px 14px; line-height: 1;">
                                                            Update
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="product-total">
                                                    ${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="total-section">
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Summary</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>Subtotal:</strong></td>
                                        <td>${{ number_format($total, 2) }}</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Shipping:</strong></td>
                                        <td>${{ number_format($shipping, 2) }}</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Total:</strong></td>
                                        <td>${{ number_format($total + $shipping, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="cart-buttons mt-4">
                                <a href="{{ route('products') }}" class="boxed-btn black">Continue Shopping</a>


                                <a href="{{ route('checkout.index') }}" class="boxed-btn black mt-2 w-100 text-center">
                                    Checkout
                                </a>


                                <form action="{{ route('cart.clear') }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="boxed-btn w-100" style="border: none;">
                                        Clear Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
