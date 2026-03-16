<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::findorfail($id);
        return view('home', compact('category'));
    }
    public function LatestProducts()
    {
        $categories = Category::all();
        $products = Product::latest()->take(6)->get();
        return view('home', compact('products', 'categories'));
    }
    public function showProductsByCategory($id = null)
    {
        $categories = Category::all();
        if ($id) {
            $products = Product::where('category_id', $id)->latest()->take(6)->get();
            return view('home', compact('products', 'categories'));
        } else {
            $products = Product::latest()->take(6)->get();
            return view('home', compact('products', 'categories'));
        }
    }
}
