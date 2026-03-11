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
        return view('home',compact('categories'));
    }
    public function show($id)
    {
        $category = Category::findorfail($id);
        return view('home',compact('category'));
    }
}


