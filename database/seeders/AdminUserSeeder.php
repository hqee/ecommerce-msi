<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. User Admin Uji Coba
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'), // Password: password
            'role' => 'admin', // Role diset sebagai 'admin'
        ]);

        // 2. User Biasa Uji Coba
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'), // Password: user123
            'role' => 'user', // Role diset sebagai 'user'
        ]);
        
        // Opsional: Buat 10 user dummy menggunakan Factory bawaan Laravel
        // \App\Models\User::factory(10)->create(); 
    }
}