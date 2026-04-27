<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::where('status',1)->paginate(6);
        return view('subcategories', compact('subcategories'));
    }
    public function showProductsBySubcategory($id){
        $subcategory = Subcategory::where('id', $id)->where('status', 1)->firstOrFail();
        $products = $subcategory->products()->where('status', 1)->paginate(6);
        return view('products', compact('products'));
    }
}
