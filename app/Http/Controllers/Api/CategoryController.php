<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Services\CategoryService;
use App\Services\ProductService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService
    ) {}

    public function index()
    {
        $categories = $this->categoryService->getActiveCategories();
        return CategoryResource::collection($categories);
    }

    public function products($id)
    {
        $products = $this->productService->getActiveProducts($id);
        return ProductResource::collection($products);
    }
}