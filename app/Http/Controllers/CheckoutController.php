<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Services\CheckoutService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(protected CheckoutService $checkoutService) {}

    public function index()
    {
        $cartItems = $this->checkoutService->getActiveCartItems(Auth::id());

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totals = $this->checkoutService->calculateTotals($cartItems);

        return view('checkout', array_merge(compact('cartItems'), $totals));
    }

    public function placeOrder(PlaceOrderRequest $request)
    {
        $user      = Auth::user();
        $cartItems = $this->checkoutService->getActiveCartItems($user->id);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totals = $this->checkoutService->calculateTotals($cartItems);
        $order  = $this->checkoutService->placeOrder($user, $request->validated(), $cartItems, $totals);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order placed successfully. Tracking number: ' . $order->order_number);
    }

    public function myOrders()
    {
        $orders = $this->checkoutService->getUserOrders(Auth::id());
        return view('orders', compact('orders'));
    }
}