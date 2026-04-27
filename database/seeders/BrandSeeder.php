<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name_en' => 'Apple',
                'name_ar' => 'ابل',
                'image'   => 'brands/apple.jpeg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Nike',
                'name_ar' => 'نايك',
                'image'   => 'brands/nike.jpeg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Samsung',
                'name_ar' => 'سامسونج',
                'image'   => 'brands/samsung.jpeg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Xiaomi',
                'name_ar' => 'شاومي',
                'image'   => 'brands/xiaomi.jpeg',
                'status'  => 1,
            ],
            [
                'name_en' => 'zara',
                'name_ar' => 'زارا',
                'image'   => 'brands/zara.jpeg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Hp',
                'name_ar' => 'اتش بي',
                'image'   => 'brands/hp.jpeg',
                'status'  => 1,
            ],
            [
                'name_en' => 'Lg',
                'name_ar' => 'ال جي',
                'image'   => 'brands/lg.jpeg',
                'status'  => 1,
            ],
        ];
        foreach ($brands as $brand) {
            Brand::firstOrCreate(
                ['name_en' => $brand['name_en']],
                $brand
            );
        }
    }
}
