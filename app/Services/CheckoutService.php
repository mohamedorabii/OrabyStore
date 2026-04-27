<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    // جيب كارت اليوزر مع الفلترة
    public function getActiveCartItems($userId)
    {
        return Cart::where('user_id', $userId)
            ->whereHas('product', function ($query) {
                $query->where('status', 1)
                    ->whereHas('category', function ($q) {
                        $q->where('status', 1);
                    });
            })
            ->with('product')
            ->get();
    }

    // احسب الأسعار
    public function calculateTotals($cartItems)
    {
        $shipping = ShippingSetting::first()->price ?? 0;
        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $total    = $subtotal + $shipping;

        return compact('subtotal', 'shipping', 'total');
    }

    // عمل الأوردر
    public function placeOrder($user, $data, $cartItems, $totals)
    {
        $order = null;

        DB::transaction(function () use ($user, $data, $cartItems, $totals, &$order) {
            $order = Order::create([
                'user_id'        => $user->id,
                'order_number'   => 'ORD-' . strtoupper(uniqid()),
                'status'         => 'pending',
                'shipping_price' => $totals['shipping'],
                'name'           => $data['name'],
                'phone'          => $data['phone'],
                'address'        => $data['address'],
                'city'           => $data['city'],
                'governorate'    => $data['governorate'],
                'total_price'    => $totals['total'],
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $item->product_id,
                    'quantity'    => $item->quantity,
                    'price'       => $item->product->price,
                    'total_price' => $item->quantity * $item->product->price,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
        });

        return $order;
    }

    // اوردرات اليوزر
    public function getUserOrders($userId)
    {
        return Order::where('user_id', $userId)
            ->with(['items.product'])
            ->latest()
            ->get();
    }
}