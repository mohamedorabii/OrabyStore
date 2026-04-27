<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Product::factory(20)->create();
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
         $this->call(SubcategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
       
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
