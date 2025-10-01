<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category; // <-- Import Category
use App\Models\Product;  // <-- Import Product
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        // Kosongkan semua tabel yang akan diisi
        User::truncate();
        Category::truncate();
        Product::truncate();

        // Nyalakan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        // Buat user admin dan user biasa
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'), // Sebaiknya ganti dengan password yang lebih aman
            'role' => 'admin',
        ]);
        User::factory(10)->create();

        // === PANGGIL SEEDER LAINNYA DI SINI ===
        $this->call([
            CategorySeeder::class, // Jalankan ini dulu untuk membuat kategori
            ProductSeeder::class,  // Baru jalankan ini untuk membuat produk
        ]);
    }
}