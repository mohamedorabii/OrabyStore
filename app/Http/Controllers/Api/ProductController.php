<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index($id = null)
    {
        $products = $this->productService->getActiveProducts($id);
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        try {
            $product          = $this->productService->getProductDetails($id);
            $related_products = $this->productService->getRelatedProducts($product->category_id, $id);

            return response()->json([
                'product'          => new ProductResource($product),
                'related_products' => ProductResource::collection($related_products),
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }
    }
}
