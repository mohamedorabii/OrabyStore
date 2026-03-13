@extends('layouts.parent')

@section('title', 'My Orders')

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

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Order</span> Tracking</h3>
                        <p>Check your latest order status and item details.</p>
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

            @if ($orders->isEmpty())
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="single-product-item p-5">
                            <h4 class="mb-3">No orders yet</h4>
                            <p class="mb-4">Once you place an order, its status will appear here.</p>
                            <a href="{{ route('products') }}" class="boxed-btn">
                                <i class="fas fa-shopping-bag"></i> Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match ($order->status) {
                                                        'pending' => 'warning',
                                                        'shipped' => 'info',
                                                        'delivered' => 'success',
                                                        'cancelled' => 'danger',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge badge-{{ $statusClass }} text-uppercase">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td>${{ number_format($order->total_price, 2) }}</td>
                                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                @foreach ($order->items as $item)
                                                    <div>
                                                        {{ $item->product->name_en ?? 'Product removed' }} x {{ $item->quantity }}
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
