<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubCategoryResource;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(protected SearchService $searchService) {}

   public function index(Request $request)
{
    $request->validate([
        'q' => 'required|string|min:2|max:100',
    ]);

    $query   = $request->input('q');
    $results = $this->searchService->search($query);

    return response()->json([
        'products'      => ProductResource::collection($results['products']),
        'categories'    => CategoryResource::collection($results['categories']),
        'brands'        => BrandResource::collection($results['brands']),
        'subcategories' => SubCategoryResource::collection($results['subcategories']),
    ]);
}
}