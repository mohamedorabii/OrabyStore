<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ShippingSetting;

class CartService
{

    public function getIdentifier($userId = null, $sessionId = null): array
    {
        return $userId
            ? ['user_id' => $userId]
            : ['session_id' => $sessionId];
    }


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


   public function calculateTotal($cartItems): array
{
    $shipping = ShippingSetting::first()->price ?? 0;

    $total = $cartItems->sum(function ($item) {
        if (!$item->product) {
            return 0;
        }

        return $item->product->price * $item->quantity;
    });

    return compact('total', 'shipping');
}

   public function addToCart(array $identifier, int $productId, int $quantity = 1): bool
{
    $product = Product::where('status', 1)
        ->whereHas('category', fn($q) => $q->where('status', 1))
        ->find($productId);

    if (!$product) {
        return false;
    }

    $cartItem = Cart::where($identifier)
        ->where('product_id', $productId)
        ->first();

    $newQuantity = ($cartItem?->quantity ?? 0) + $quantity;

    // لا تسمح بإضافة كمية أكبر من المخزون
    if ($newQuantity > $product->quantity) {
        return false;
    }

    if ($cartItem) {
        $cartItem->update([
            'quantity' => $newQuantity,
        ]);
    } else {
        Cart::create([
            ...$identifier,
            'product_id' => $productId,
            'quantity'   => $quantity,
        ]);
    }

    return true;
}

    public function updateCart(Cart $cart, int $quantity, int $userId): bool
{
    if ($cart->user_id !== $userId) {
        return false;
    }

    $product = $cart->product;

    if (!$product) {
        return false;
    }

    if ($quantity > $product->quantity) {
        return false;
    }

    $cart->update([
        'quantity' => $quantity,
    ]);

    return true;
}

    public function removeFromCart(Cart $cart, int $userId): bool
    {
        if ($cart->user_id !== $userId) {
            return false;
        }

        $cart->delete();
        return true;
    }

    public function clearCart(array $identifier): void
    {
        Cart::where($identifier)->delete();
    }
}
