<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
         
         $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
      
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $shipping = ShippingSetting::first()->price ?? 0;
    $subtotal = $cartItems->sum(function($item){
        return $item->quantity * $item->product->price;
    });
    $total = $subtotal + $shipping;

        return view('checkout', compact('cartItems', 'shipping', 'subtotal', 'total'));
    }
  public function placeOrder(PlaceOrderRequest $request)
   {
    $user = Auth::user();
    $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $shipping = ShippingSetting::first()->price ?? 0;
    $subtotal = $cartItems->sum(function($item){
        return $item->quantity * $item->product->price;
    });
    $total = $subtotal + $shipping;

    DB::transaction(function () use($cartItems, $user, $request, $subtotal, $shipping, $total) {
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'shipping_price' => $shipping,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'governorate' => $request->governorate,
            'total_price' => $total
        ]);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'total_price' => $item->quantity * $item->product->price
            ]);
        }
        Cart::where('user_id', $user->id)->delete();
    });

    return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
   }

}
        
