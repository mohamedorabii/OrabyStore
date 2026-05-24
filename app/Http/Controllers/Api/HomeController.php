<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\HomeService;
use App\Http\Resources\CategoryResource;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService) {}

 public function index()
{
    $categories = $this->homeService->getActiveCategories();
    $products   = $this->homeService->getLatestProducts();

    return response()->json([
        'categories' => CategoryResource::collection($categories),
        'products'   => ProductResource::collection($products),
    ]);
}

public function productsByCategory($id = null)
{
    $categories = $this->homeService->getActiveCategories();
    $products   = $this->homeService->getProductsByCategory($id);

    return response()->json([
        'categories' => CategoryResource::collection($categories),
        'products'   => ProductResource::collection($products),
    ]);
}
}