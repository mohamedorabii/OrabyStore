<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Services\BrandService;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService) {}

    public function index()
    {
        $brands = $this->brandService->getActiveBrands();
        return BrandResource::collection($brands);
    }

    public function products($id)
    {
        $products = $this->brandService->getProductsByBrand($id);
        return ProductResource::collection($products);
    }
}