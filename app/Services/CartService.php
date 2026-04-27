<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ShippingSetting;

class CartService
{
    // جيب الـ identifier (user أو session)
    public function getIdentifier($userId = null, $sessionId = null): array
    {
        return $userId
            ? ['user_id' => $userId]
            : ['session_id' => $sessionId];
    }

    // جيب عناصر الكارت
    public function getCartItems(array $identifier)
    {
        return Cart::where($identifier)
            ->whereHas('product', function ($query) {
                $query->where('status', 1)
                    ->whereHas('category', function ($q) {
                        $q->where('status', 1);
                    });
            })
            ->with('product')
            ->get();
    }

    // احسب الإجمالي
    public function calculateTotal($cartItems): array
    {
        $shipping = ShippingSetting::first()->price ?? 0;
        $total    = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return compact('total', 'shipping');
    }

    // ضيف منتج للكارت
    public function addToCart(array $identifier, int $productId, int $quantity = 1): bool
    {
        $product = Product::where('status', 1)
            ->whereHas('category', fn($q) => $q->where('status', 1))
            ->find($productId);

        if (!$product) return false;

        $cartItem = Cart::where($identifier)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => min($cartItem->quantity + $quantity, 20)
            ]);
        } else {
            Cart::create([
                ...$identifier,
                'product_id' => $productId,
                'quantity'   => min($quantity, 20),
            ]);
        }

        return true;
    }

    // عدّل الكمية
    public function updateCart(Cart $cart, int $quantity): void
    {
        $cart->update(['quantity' => $quantity]);
    }

    // شيل منتج
    public function removeFromCart(Cart $cart): void
    {
        $cart->delete();
    }

    // فضّي الكارت
    public function clearCart(array $identifier): void
    {
        Cart::where($identifier)->delete();
    }
}