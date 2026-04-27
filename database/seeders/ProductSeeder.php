<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // ─── Electronics > Phones ─────────────────────────────────────
            ['subcategory' => 'Phones', 'brand' => 'Apple',   'name_en' => 'iPhone 15',       'name_ar' => 'ايفون 15',    'image' => 'products/iphone-15.jpg',   'price' => 799.00,  'quantity' => 80,  'status' => 1],

            // ─── Electronics > Laptops ────────────────────────────────────
            ['subcategory' => 'Laptops', 'brand' => 'Apple',  'name_en' => 'MacBook Pro 14 M3',       'name_ar' => 'ماك بوك برو 14 M3',      'image' => 'products/macbook-pro-14-m3.jpg',       'price' => 1999.00, 'quantity' => 30,  'status' => 1],

            // ─── Clothes > T-Shirts ───────────────────────────────────────
            ['subcategory' => 'T-Shirts', 'brand' => 'Nike', 'name_en' => 'Nike Dri-FIT Training Tee',  'name_ar' => 'تيشرت نايك دراي فيت',   'image' => 'products/nike-dri-fit-training-tee.jpg',   'price' => 35.00,  'quantity' => 200, 'status' => 1],

            // ─── Computer Accessories > Mice ──────────────────────────────
            ['subcategory' => 'Mice', 'brand' => 'Apple',   'name_en' => 'Apple Magic Mouse 3',         'name_ar' => 'ماوس ابل ماجيك 3',       'image' => 'products/apple-magic-mouse-3.jpg',       'price' => 79.00,  'quantity' => 85,  'status' => 1],


            // ─── Bicycles > Road Bikes ────────────────────────────────────
            ['subcategory' => 'Road Bikes', 'brand' => 'Xiaomi', 'name_en' => 'Xiaomi HIMO R16 Road Bike', 'name_ar' => 'دراجة شاومي هيمو R16 طريق', 'image' => 'products/xiaomi-himo-r16-road-bike.jpg',        'price' => 499.00, 'quantity' => 20, 'status' => 1],

            // ─── Books > Programming ──────────────────────────────────────
            ['subcategory' => 'Programming-books', 'name_en' => 'Clean Code by Robert Martin',     'name_ar' => 'كلين كود',                'image' => 'products/clean-code.jpg',    'price' => 35.00,  'quantity' => 80,  'status' => 1],

            // ─── Home & Kitchen > Furniture ───────────────────────────────
            ['subcategory' => 'Furniture', 'brand' => 'zara',   'name_en' => 'Zara Home Linen Sofa 3-Seater',  'name_ar' => 'كنبة زارا هوم كتان 3 مقاعد', 'image' => 'products/zara-home-linen-sofa-3-seater.jpg',        'price' => 899.00, 'quantity' => 15,  'status' => 1],

        ];

        foreach ($products as $item) {
            $subcategory = !empty($item['subcategory'])
                ? Subcategory::where('name_en', $item['subcategory'])->first()
                : null;
            $brand       = !empty($item['brand'])
                ? Brand::where('name_en', $item['brand'])->first()
                : null;

            $category = !empty($item['category'])
                ? Category::where('name_en', $item['category'])->first()
                : ($subcategory ? Category::find($subcategory->category_id) : null);

            if (! $category) {
                continue;
            }

            $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $item['name_en']), 0, 3));
            $code   = $prefix . '-' . strtoupper(Str::random(4));

            Product::firstOrCreate(
                [
                    'name_en'        => $item['name_en'],
                    'subcategory_id' => $subcategory?->id,
                    'category_id'    => $category->id,
                ],
                [
                    'name_ar'        => $item['name_ar'],
                    'desc_en'        => $item['name_en'],
                    'desc_ar'        => $item['name_ar'],
                    'price'          => $item['price'],
                    'quantity'       => $item['quantity'],
                    'status'         => $item['status'],
                    'code'           => $code,
                    'brand_id'       => $brand?->id,
                    'category_id'    => $category->id,
                    'subcategory_id' => $subcategory?->id,
                    'image'          => $item['image'],
                ]
            );
        }
    }
}