<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('home', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::where('status', 1)->findorfail($id);
        return view('home', compact('category'));
    }
    public function LatestProducts()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->latest()
            ->take(6)
            ->get();
        return view('home', compact('products', 'categories'));
    }
    public function showProductsByCategory($id = null)
    {
        $categories = Category::where('status', 1)->get();
        if ($id) {
            $products = Product::where('status', 1)
                ->where('category_id', $id)
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->latest()
                ->take(6)
                ->get();
            return view('home', compact('products', 'categories'));
        } else {
            $products = Product::where('status', 1)
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->latest()
                ->take(6)
                ->get();
            return view('home', compact('products', 'categories'));
        }
    }
}
