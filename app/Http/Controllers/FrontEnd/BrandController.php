<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\BrandService;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService) {}

    public function index()
    {
        $brands = $this->brandService->getActiveBrands();
        return view('brands', compact('brands'));
    }

    public function products($id)
    {
        $products = $this->brandService->getProductsByBrand($id);
        return view('products', compact('products'));
    }
}