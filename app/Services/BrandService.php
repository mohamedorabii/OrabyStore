<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;

class BrandService
{
    public function getActiveBrands(int $perPage = 6)
    {
        return Brand::where('status', 1)->paginate($perPage);
    }

    public function getProductsByBrand(int $brandId, int $perPage = 6)
    {
        return Product::where('status', 1)
            ->where('brand_id', $brandId)
            ->whereHas('brand', fn($q) => $q->where('status', 1))
            ->whereHas('category', fn($q) => $q->where('status', 1))
            ->paginate($perPage);
    }
}