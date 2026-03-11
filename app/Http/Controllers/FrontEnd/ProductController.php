<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id = null)
    {
        //get all products from database and pass to view
        if ($id) {
            $products = Product::where('category_id', $id)->get();
              return view('products', compact('products'));
        } else {
            $products = Product::all();
              return view('products', compact('products'));
        }
        
    }
    public function productdetails($id)
    {
        $product = Product::findorfail($id);

        $related_products = Product::where('category_id',$product->category_id)->where('id','!=',$id)->take(3)->get(); 
        return view('product_details', compact('product','related_products'));
    }

    
}
