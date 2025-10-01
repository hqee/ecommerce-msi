<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
            $Category1 = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Gadgets and devices',
        ]);

        $Category2 = Category::create([
            'name' => 'Ladies Wears',
            'slug' => 'ladies-wears',
            'description' => 'All kinds of ladies wears',
        ]);

        $Category3 = Category::create([
            'name' => 'Mens Wears',
            'slug' => 'mens-wears',
            'description' => 'All kinds of mens wears',
        ]);

        $Category4 = Category::create([
            'name' => 'Kids Wears',
            'slug' => 'kids-wears',
            'description' => 'All kinds of kids wears',
        ]);

        $Category5 = Category::create([
            'name' => 'Home Appliances',
            'slug' => 'home-appliances',
            'description' => 'Appliances for home use',
        ]);
    }
}
