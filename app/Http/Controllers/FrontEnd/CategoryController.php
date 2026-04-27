<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($id = null)
    {
        $categories = Category::where('status', 1)->paginate(6);
        return view('categories', compact('categories'));
    }
}
