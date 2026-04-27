<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\HomeService;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService) {}

    public function index()
    {
        $categories = $this->homeService->getActiveCategories();
        return view('home', compact('categories'));
    }

    public function show($id)
    {
        $category = $this->homeService->getCategory($id);
        return view('home', compact('category'));
    }

    public function LatestProducts()
    {
        $categories = $this->homeService->getActiveCategories();
        $products   = $this->homeService->getLatestProducts();
        return view('home', compact('products', 'categories'));
    }

    public function showProductsByCategory($id = null)
    {
        $categories = $this->homeService->getActiveCategories();
        $products   = $this->homeService->getProductsByCategory($id);
        return view('home', compact('products', 'categories'));
    }
}