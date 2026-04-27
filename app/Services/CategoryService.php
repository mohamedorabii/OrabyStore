<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getActiveCategories(int $perPage = 6)
    {
        return Category::where('status', 1)->paginate($perPage);
    }
}