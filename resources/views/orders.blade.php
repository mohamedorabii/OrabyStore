@extends('layouts.parent')

@section('title', 'My Orders')

@section('content')

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Track your purchases</p>
                    <h1>My Orders</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-section mt-100 mb-150">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Order</span> Tracking</h3>
                    <p>Check your latest order status and item details.</p>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        {{-- No Orders --}}
        @if ($orders->isEmpty())
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="login-card">
                        <h4 class="mb-3">No orders yet</h4>
                        <p class="mb-4">Once you place an order, it will appear here.</p>
                        <a href="{{ route('products') }}" class="main_btn">
                            <i class="fas fa-shopping-bag"></i> Shop Now
                        </a>
                    </div>
                </div>
            </div>
        @else

            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-lg-6 mb-4">
                        <div class="login-card h-100">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Order #{{ $order->order_number }}</h5>

                                @php
                                    $statusClass = match ($order->status) {
                                        'pending' => 'warning',
                                        'shipped' => 'info',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp

                                <span class="badge badge-{{ $statusClass }}">
                                    {{ $order->status }}
                                </span>
                            </div>

                            <p class="mb-2">
                                <strong>Total:</strong>
                                ${{ number_format($order->total_price, 2) }}
                            </p>

                            <p class="mb-3">
                                <strong>Date:</strong>
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </p>

                            <hr>

                            <h6 class="mb-2">Items:</h6>

                            <ul class="list-unstyled mb-0">
                                @foreach ($order->items as $item)
                                    <li class="mb-1">
                                        {{ $item->product->name_en ?? 'Product removed' }}
                                        × {{ $item->quantity }}
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </div>
</div>

@endsection