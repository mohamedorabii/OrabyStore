<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index($id = null)
    {
        $products = $this->productService->getActiveProducts($id);
        return view('products', compact('products'));
    }

    public function productdetails($id)
    {
        $product          = $this->productService->getProductDetails($id);
        $related_products = $this->productService->getRelatedProducts($product->category_id, $id);
        return view('product_details', compact('product', 'related_products'));
    }
}