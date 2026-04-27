<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index($id = null)
    {
        $categories = $this->categoryService->getActiveCategories();
        return view('categories', compact('categories'));
    }
}