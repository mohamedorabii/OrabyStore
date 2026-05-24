<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubCategoryResource;
use App\Services\SubCategoryService;

class SubCategoryController extends Controller
{
    public function __construct(protected SubCategoryService $subCategoryService) {}

    public function index()
    {
        $subcategories = $this->subCategoryService->getActiveSubCategories();
        return SubCategoryResource::collection($subcategories);
    }

    public function products($id)
    {
        $data     = $this->subCategoryService->getProductsBySubCategory($id);
        return ProductResource::collection($data['products']);
    }
}