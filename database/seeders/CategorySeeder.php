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
        $categories = [
            ['name' => 'Perlengkapan Kebersihan', 'slug' => 'perlengkapan-kebersihan'],
            ['name' => 'Alat Kebersihan', 'slug' => 'alat-kebersihan'],
            ['name' => 'Elektronik & Listrik', 'slug' => 'elektronik-listrik'],
            ['name' => 'Plastik & Kemasan', 'slug' => 'plastik-kemasan'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name']]
            );
        }
    }
}
