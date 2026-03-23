<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id = null)
    {
        //get all products from database and pass to view
        if ($id) {
            $products = Product::where('status', 1)
                ->where('category_id', $id)
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->get();
            return view('products', compact('products'));
        } else {
            $products = Product::where('status', 1)
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->get();
            return view('products', compact('products'));
        }
        
    }
    public function productdetails($id)
    {
        $product = Product::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->findorfail($id);

        $related_products = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->take(3)
            ->get();
        return view('product_details', compact('product','related_products'));
    }

    
}
