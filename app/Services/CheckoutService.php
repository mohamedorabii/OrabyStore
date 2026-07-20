<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
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

    public function calculateTotals($cartItems)
    {
        $shipping = ShippingSetting::first()->price ?? 0;
        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $total    = $subtotal + $shipping;

        return compact('subtotal', 'shipping', 'total');
    }

   public function placeOrder($user, $data, $cartItems, $totals)
{
    $order = null;

    DB::transaction(function () use ($user, $data, $cartItems, $totals, &$order) {
        
        // تحقق من الكميات مع Lock
        foreach ($cartItems as $item) {
            $product = Product::lockForUpdate()->find($item->product_id);
            
            if (!$product || $product->quantity < $item->quantity) {
                throw new \Exception(
                    "Sorry, only {$product->quantity} units available for {$product->name_en}."
                );
            }
        }

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
            $product = Product::lockForUpdate()->find($item->product_id);

            OrderItem::create([
                'order_id'    => $order->id,
                'product_id'  => $item->product_id,
                'quantity'    => $item->quantity,
                'price'       => $product->price,
                'total_price' => $item->quantity * $product->price,
            ]);

            $product->decrement('quantity', $item->quantity);
        }

        Cart::where('user_id', $user->id)->delete();
    });

    return $order;
}

    public function getUserOrders($userId)
    {
        return Order::where('user_id', $userId)
            ->with(['items.product'])
            ->latest()
            ->get();
    }

    public function cancelOrder(Order $order, int $userId): bool
    {
        if ($order->user_id !== $userId) {
            return false;
        }

        if ($order->status !== 'pending') {
            return false;
        }

        DB::transaction(function () use ($order) {
            $order->loadMissing('items.product');

            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('quantity', $item->quantity);
                }
            }

            $order->update(['status' => 'cancelled']);
        });

        return true;
    }
}