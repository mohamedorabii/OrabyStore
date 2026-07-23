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
['subcategory' => 'Phones', 'brand' => 'Apple',   'name_en' => 'iPhone 15 Pro',         'name_ar' => 'ايفون 15 برو',           'image' => 'products/iphone-15-pro.jpg',         'price' => 999.00, 'quantity' => 50, 'status' => 1],
['subcategory' => 'Phones', 'brand' => 'Apple',   'name_en' => 'iPhone 15 Pro Max',     'name_ar' => 'ايفون 15 برو ماكس',      'image' => 'products/iphone-15-pro-max.jpg',     'price' => 1199.00, 'quantity' => 40, 'status' => 1],
['subcategory' => 'Phones', 'brand' => 'Samsung', 'name_en' => 'Galaxy S24 Ultra',      'name_ar' => 'جالاكسي S24 ألترا',       'image' => 'products/galaxy-s24-ultra.jpg',      'price' => 1099.00, 'quantity' => 60, 'status' => 1],
['subcategory' => 'Phones', 'brand' => 'Samsung', 'name_en' => 'Galaxy A55',            'name_ar' => 'جالاكسي A55',             'image' => 'products/galaxy-a55.jpg',            'price' => 399.00, 'quantity' => 120, 'status' => 1],
['subcategory' => 'Phones', 'brand' => 'Xiaomi',  'name_en' => 'Redmi Note 13 Pro',     'name_ar' => 'ريدمي نوت 13 برو',        'image' => 'products/redmi-note-13-pro.jpg',     'price' => 349.00, 'quantity' => 100, 'status' => 1],
['subcategory' => 'Phones', 'brand' => 'Xiaomi',  'name_en' => 'Xiaomi 14',             'name_ar' => 'شاومي 14',                'image' => 'products/xiaomi-14.jpg',             'price' => 799.00, 'quantity' => 70, 'status' => 1],

// ─── Electronics > Laptops ────────────────────────────────────
['subcategory' => 'Laptops', 'brand' => 'Apple',  'name_en' => 'MacBook Air M3',        'name_ar' => 'ماك بوك إير M3',          'image' => 'products/macbook-air-m3.jpg',        'price' => 1299.00, 'quantity' => 40, 'status' => 1],
['subcategory' => 'Laptops', 'brand' => 'Dell',   'name_en' => 'Dell XPS 13',           'name_ar' => 'ديل XPS 13',              'image' => 'products/dell-xps-13.jpg',           'price' => 1499.00, 'quantity' => 35, 'status' => 1],
['subcategory' => 'Laptops', 'brand' => 'HP',     'name_en' => 'HP Spectre x360',       'name_ar' => 'إتش بي سبيكتر x360',      'image' => 'products/hp-spectre-x360.jpg',       'price' => 1599.00, 'quantity' => 25, 'status' => 1],
['subcategory' => 'Laptops', 'brand' => 'Lenovo', 'name_en' => 'Lenovo Legion 5',       'name_ar' => 'لينوفو ليجن 5',           'image' => 'products/lenovo-legion-5.jpg',       'price' => 1399.00, 'quantity' => 30, 'status' => 1],
['subcategory' => 'Laptops', 'brand' => 'Asus',   'name_en' => 'ASUS ROG Zephyrus G14', 'name_ar' => 'أسوس ROG زيفيروس G14',    'image' => 'products/asus-rog-zephyrus-g14.jpg', 'price' => 1799.00, 'quantity' => 20, 'status' => 1],

// ─── Computer Accessories > Mice ──────────────────────────────
['subcategory' => 'Mice', 'brand' => 'Logitech',  'name_en' => 'Logitech MX Master 3S', 'name_ar' => 'لوجيتك MX Master 3S',     'image' => 'products/logitech-mx-master-3s.jpg', 'price' => 99.00, 'quantity' => 90, 'status' => 1],
['subcategory' => 'Mice', 'brand' => 'Logitech',  'name_en' => 'Logitech G Pro X Superlight', 'name_ar' => 'لوجيتك G Pro X سوبر لايت', 'image' => 'products/logitech-g-pro-x-superlight.jpg', 'price' => 149.00, 'quantity' => 50, 'status' => 1],
['subcategory' => 'Mice', 'brand' => 'Razer',     'name_en' => 'Razer DeathAdder V3',   'name_ar' => 'ريزر ديث أدر V3',         'image' => 'products/razer-deathadder-v3.jpg',   'price' => 79.00, 'quantity' => 75, 'status' => 1],

// ─── Clothes > T-Shirts ───────────────────────────────────────
['subcategory' => 'T-Shirts', 'brand' => 'Nike',  'name_en' => 'Nike Sportswear Club Tee', 'name_ar' => 'تيشيرت نايك سبورتسوير', 'image' => 'products/nike-sportswear-club-tee.jpg', 'price' => 30.00, 'quantity' => 200, 'status' => 1],
['subcategory' => 'T-Shirts', 'brand' => 'Adidas','name_en' => 'Adidas Essentials Tee', 'name_ar' => 'تيشيرت أديداس إسينشالز', 'image' => 'products/adidas-essentials-tee.jpg', 'price' => 28.00, 'quantity' => 180, 'status' => 1],
['subcategory' => 'T-Shirts', 'brand' => 'Puma',  'name_en' => 'Puma Logo Tee',          'name_ar' => 'تيشيرت بوما لوجو',        'image' => 'products/puma-logo-tee.jpg',         'price' => 25.00, 'quantity' => 150, 'status' => 1],

// ─── Books > Programming ──────────────────────────────────────
['subcategory' => 'Programming-books', 'name_en' => 'Laravel Up & Running',      'name_ar' => 'لارافيل أب آند رانينج',     'image' => 'products/laravel-up-and-running.jpg', 'price' => 45.00, 'quantity' => 50, 'status' => 1],
['subcategory' => 'Programming-books', 'name_en' => 'PHP Objects, Patterns, and Practice', 'name_ar' => 'PHP Objects, Patterns, and Practice', 'image' => 'products/php-objects-patterns-practice.jpg', 'price' => 42.00, 'quantity' => 40, 'status' => 1],
['subcategory' => 'Programming-books', 'name_en' => 'The Pragmatic Programmer',  'name_ar' => 'المبرمج العملي',             'image' => 'products/the-pragmatic-programmer.jpg', 'price' => 38.00, 'quantity' => 60, 'status' => 1],

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