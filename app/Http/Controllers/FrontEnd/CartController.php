<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\ShippingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getIdentifier()
    {
        return Auth::check() ? ['user_id' => Auth::id()] : ['session_id' => session()->getId()];
    }
    public function index()
    {
            $shipping = ShippingSetting::first()->price ?? 0;
        $identifier = $this->getIdentifier();
        $cartItems = Cart::where($identifier)->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('cart', compact('cartItems', 'total', 'shipping'));
    }
    public function addToCart(AddToCartRequest $request)
    {
        $identifier = $this->getIdentifier();
        $cartItem = Cart::where($identifier)->where('product_id', $request->product_id)->first();
        if ($cartItem) {
            $newQuantity = min($cartItem->quantity + ($request->quantity ?? 1), 20);
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                ...$identifier,
                'product_id' => $request->product_id,
                'quantity' => min($request->quantity ?? 1, 20),
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully✅.');
    }
    public function updateCart(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);
        $cart->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully✅.');
    }
    public function removeFromCart(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully✅.');
    }
    public function clearCart()
    {
        $identifier = $this->getIdentifier();
        Cart::where($identifier)->delete();
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully✅.');
    }
}
