<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Clothes',
                'name_ar' => 'ملابس',
                'image'   => 'categories/clothes.jpg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Computer Accessories',
                'name_ar' => 'ملحقات الكمبيوتر',
                'image'   => 'categories/computer-accessories.jpg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Bicycles',
                'name_ar' => 'دراجات هوائية',
                'image'   => 'categories/bicycles.jpg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Books',
                'name_ar' => 'كتب',
                'image'   => 'categories/books.jpg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Electronics',
                'name_ar' => 'إلكترونيات',
                'image'   => 'categories/electronics.jpg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Home & Kitchen',
                'name_ar' => 'منزل ومطبخ',
                'image'   => 'categories/home-kitchen.jpg',
                'status'  => 1,
            ],
        ];
        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name_en' => $category['name_en']],
                $category
            );
        }
    }
}
