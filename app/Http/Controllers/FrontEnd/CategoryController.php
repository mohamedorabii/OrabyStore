<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id = null)
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }
}
