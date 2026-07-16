<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService) {}

    private function identifier(): array
    {
        return $this->cartService->getIdentifier(auth()->id());
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems($this->identifier());
        $totals    = $this->cartService->calculateTotal($cartItems);

        return response()->json([
            'items'    => CartResource::collection($cartItems),
            'total'    => $totals['total'],
            'shipping' => $totals['shipping'],
        ]);
    }

    public function store(AddToCartRequest $request)
    {
        $added = $this->cartService->addToCart(
            $this->identifier(),
            $request->product_id,
            $request->quantity ?? 1
        );

        if (!$added) {
            return response()->json(['message' => 'Product not available.'], 422);
        }

        return response()->json(['message' => 'Product added to cart successfully.']);
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        if (!$this->cartService->updateCart($cart, $request->quantity, auth()->id())) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        return response()->json(['message' => 'Cart updated successfully.']);
    }

    public function destroy(Cart $cart)
    {
        if (!$this->cartService->removeFromCart($cart, auth()->id())) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        return response()->json(['message' => 'Product removed successfully.']);
    }

    public function clear()
    {
        $this->cartService->clearCart($this->identifier());
        return response()->json(['message' => 'Cart cleared successfully.']);
    }
}
