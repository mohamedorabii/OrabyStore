<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    public function index()
    {
      
            $brands = Brand::where('status', 1)->paginate(6);
            return view('brands', compact('brands'));
      
    }

    public function products($id)
    {
        $products = Product::where('status', 1)
            ->where('brand_id', $id)
            ->whereHas('brand', function ($query) {
                $query->where('status', 1);
            })
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->paginate(6);

        return view('products', compact('products'));
    }
}
