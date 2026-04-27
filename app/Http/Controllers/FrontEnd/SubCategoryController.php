<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\SubCategoryService;

class SubCategoryController extends Controller
{
    public function __construct(protected SubCategoryService $subCategoryService) {}

    public function index()
    {
        $subcategories = $this->subCategoryService->getActiveSubCategories();
        return view('subcategories', compact('subcategories'));
    }

    public function showProductsBySubcategory($id)
    {
        $data     = $this->subCategoryService->getProductsBySubCategory($id);
        $products = $data['products'];
        return view('products', compact('products'));
    }
}