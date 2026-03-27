<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $subcategories = [
            // Electronics
            ['category' => 'Electronics', 'name_en' => 'Phones',    'name_ar' => 'موبايلات',       'image' => 'subcategories/phones.jpg',    'status' => 1],
            ['category' => 'Electronics', 'name_en' => 'Laptops',   'name_ar' => 'لابتوبات',       'image' => 'subcategories/laptops.jpg',   'status' => 1],

            // Clothes
            ['category' => 'Clothes', 'name_en' => 'T-Shirts', 'name_ar' => 'تيشيرتات', 'image' => 'subcategories/tshirts.jpg', 'status' => 1],

            // Computer Accessories
            ['category' => 'Computer Accessories', 'name_en' => 'Mice',      'name_ar' => 'ماوسات',    'image' => 'subcategories/mice.jpg',      'status' => 1],

            // Bicycles
            ['category' => 'Bicycles', 'name_en' => 'Road Bikes',     'name_ar' => 'دراجات طريق',    'image' => 'subcategories/road-bikes.jpg',     'status' => 1],

            // Books
            ['category' => 'Books', 'name_en' => 'Programming_books', 'name_ar' => 'كتب برمجة',      'image' => 'subcategories/programming-books.jpg', 'status' => 1],
           
            // Home 
            ['category' => 'Home & Kitchen', 'name_en' => 'Furniture', 'name_ar' => 'أثاث', 'image' => 'subcategories/furniture.jpg', 'status' => 1],
        ];
        foreach ($subcategories as $item) {
            $category = Category::where('name_en', $item['category'])->first();

            if ($category) {
                Subcategory::firstOrCreate(
                    [
                        'name_en'     => $item['name_en'],
                        'category_id' => $category->id,
                    ],
                    [
                        'name_ar'     => $item['name_ar'],
                        'image'       => $item['image'],
                        'status'      => $item['status'],
                        'category_id' => $category->id,
                    ]
                );
            }
        }

    }
}
   