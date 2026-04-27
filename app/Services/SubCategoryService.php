<?php

namespace App\Services;

use App\Models\Subcategory;

class SubCategoryService
{
    public function getActiveSubCategories(int $perPage = 6)
    {
        return Subcategory::where('status', 1)->paginate($perPage);
    }

    public function getProductsBySubCategory(int $id, int $perPage = 6)
    {
        $subcategory = Subcategory::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        return [
            'products' => $subcategory->products()
                ->where('status', 1)
                ->paginate($perPage),
        ];
    }
}