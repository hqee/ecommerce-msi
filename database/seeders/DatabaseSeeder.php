<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // <-- 1. JANGAN LUPA IMPORT SCHEMA

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 2. Matikan pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        User::truncate();
        // Anda juga bisa truncate tabel lain di sini jika perlu
        // \App\Models\Category::truncate();
        // \App\Models\Product::truncate();

        // 3. Nyalakan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();


        // 4. Lanjutkan proses seeding seperti biasa
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::factory(10)->create();
    }
}