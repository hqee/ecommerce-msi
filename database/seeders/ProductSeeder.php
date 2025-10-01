<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kategori 'Electronics' yang sudah dibuat oleh CategorySeeder
        $electronicsCategory = Category::where('slug', 'electronics')->first();

        Product::create([
            'category_id' => $electronicsCategory->id,
            'name' => 'Smartphone',
            'slug' => 'smartphone',
            'description' => 'Latest model smartphone with advanced features',
            'price' => 15000000,
            'stock' => 50,
            'image' => 'images/products/hp.png',
        ]);
    }
}