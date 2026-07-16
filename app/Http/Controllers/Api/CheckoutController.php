<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(protected CheckoutService $checkoutService) {}

    public function summary()
    {
        $cartItems = $this->checkoutService->getActiveCartItems(Auth::id());

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty.'], 400);
        }

        $totals = $this->checkoutService->calculateTotals($cartItems);

        return response()->json([
            'items'    => $cartItems,
            'subtotal' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'total'    => $totals['total'],
        ]);
    }

    public function placeOrder(PlaceOrderRequest $request)
    {
        $user      = Auth::user();
        $cartItems = $this->checkoutService->getActiveCartItems($user->id);

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty.'], 400);
        }

        $totals = $this->checkoutService->calculateTotals($cartItems);
        $order  = $this->checkoutService->placeOrder($user, $request->validated(), $cartItems, $totals);

        return response()->json([
            'message'      => 'Order placed successfully.',
            'order_number' => $order->order_number,
            'total'        => $order->total_price,
        ], 201);
    }

    public function myOrders()
    {
        $orders = $this->checkoutService->getUserOrders(Auth::id());

        return response()->json([
            'orders' => OrderResource::collection($orders),
        ]);
    }

    public function orderDetails($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found.',
            ], 404);
        }

        return response()->json([
            'order' => new OrderResource($order),
        ]);
    }
}
