<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil ID Kategori
        $catKebersihan = Category::where('slug', 'perlengkapan-kebersihan')->first()->id ?? 1;
        $catAlat = Category::where('slug', 'alat-kebersihan')->first()->id ?? 1;
        $catElektronik = Category::where('slug', 'elektronik-listrik')->first()->id ?? 1;
        $catPlastik = Category::where('slug', 'plastik-kemasan')->first()->id ?? 1;

        // 2. Daftar Produk (Data dari Anda)
        $products = [
            // --- Perlengkapan Kebersihan ---
            [
                'category_id' => $catKebersihan,
                'name' => 'Vixal 470 ml',
                'stock' => 25,
                'price' => 18000,
                'image' => 'storage/image/products/vixal.jpg' // Botol pembersih
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Stella Gantung All in one 42 gr',
                'stock' => 25,
                'price' => 14000,
                'image' => 'storage/image/products/stella all var.jpg' // Pengharum
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Sunlight Lime 650 ml',
                'stock' => 15,
                'price' => 16000,
                'image' => 'storage/image/products/sunligt.jpg' // Sabun cuci
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Handsoap Refill 375 ml',
                'stock' => 25,
                'price' => 23000,
                'image' => 'storage/image/products/handsoap all var.png' // Sabun tangan
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Tissue 2 ply x 200 sheets Besar',
                'stock' => 50,
                'price' => 10000,
                'image' => 'storage/image/products/tisu ebsar.png' // Tisu
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Tissue 2 ply x 200 sheets Kecil',
                'stock' => 50,
                'price' => 5000,
                'image' => 'storage/image/products/tisu kecil.png' // Tisu
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Superpell 770 ml',
                'stock' => 25,
                'price' => 18000,
                'image' => 'storage/image/products/super pell.jpg' // Lantai
            ],
            [
                'category_id' => $catKebersihan,
                'name' => 'Bayclin 1000 ml',
                'stock' => 10,
                'price' => 24000,
                'image' => 'storage/image/products/Untitled-byclin.png' // Pemutih
            ],

            // --- Alat Kebersihan ---
            [
                'category_id' => $catAlat,
                'name' => 'Sapu Lidi',
                'stock' => 3,
                'price' => 17000,
                'image' => 'storage/image/products/sapu lidi.png' // Sapu
            ],
            [
                'category_id' => $catAlat,
                'name' => 'Sapu Ijuk',
                'stock' => 8,
                'price' => 20000,
                'image' => 'storage/image/products/sapu ijuk.png' // Sapu Ijuk
            ],
            [
                'category_id' => $catAlat,
                'name' => 'Serok Sampah',
                'stock' => 3,
                'price' => 18000,
                'image' => 'storage/image/products/serok sampah.png' // Serok (ilustrasi)
            ],

            // --- Elektronik & Listrik ---
            [
                'category_id' => $catElektronik,
                'name' => 'Baterai AA (Pack)',
                'stock' => 20,
                'price' => 32000,
                'image' => 'storage/image/products/BATRE AA.png' // Baterai
            ],
            [
                'category_id' => $catElektronik,
                'name' => 'Baterai AAA (Pack)',
                'stock' => 10,
                'price' => 30000,
                'image' => 'storage/image/products/BATRE AAA.png' // Baterai kecil
            ],
            [
                'category_id' => $catElektronik,
                'name' => 'Lampu 15 Watt',
                'stock' => 20,
                'price' => 26000,
                'image' => 'storage/image/products/15 watt.png' // Lampu
            ],
            [
                'category_id' => $catElektronik,
                'name' => 'Lampu 20 Watt',
                'stock' => 30,
                'price' => 31000,
                'image' => 'storage/image/products/LAMPU20WTT.png'
            ],
            [
                'category_id' => $catElektronik,
                'name' => 'Lampu 30 Watt',
                'stock' => 30,
                'price' => 39000,
                'image' => 'storage/image/products/30 watt.png'
            ],
            [
                'category_id' => $catElektronik,
                'name' => 'Lampu 40 Watt',
                'stock' => 10,
                'price' => 49000,
                'image' => 'storage/image/products/40 watt.png'
            ],

            // --- Plastik ---
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik Hitam 100 x 60',
                'stock' => 10,
                'price' => 14000,
                'image' => 'storage/image/products/Plastik Hitam uk 100 x 60.png' // Plastik
            ],
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik Kuning 100 x 60',
                'stock' => 10,
                'price' => 18000,
                'image' => 'storage/image/products/Plastik Kuning uk 100 x 60.png'
            ],
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik Hitam 60 x 40',
                'stock' => 10,
                'price' => 14000,
                'image' => 'storage/image/products/Plastik Hitam uk 40 x 60.png'
            ],
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik Kuning 60 x 40',
                'stock' => 10,
                'price' => 15000,
                'image' => 'storage/image/products/Plastik Kuning uk 60 x 40.png'
            ],
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik Bawang (Pack)',
                'stock' => 30,
                'price' => 48000,
                'image' => 'storage/image/products/plastik bawang.png'
            ],
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik 1/2 kg (Pack)',
                'stock' => 10,
                'price' => 48000,
                'image' => 'storage/image/products/plastik 2.png'
            ],
            [
                'category_id' => $catPlastik,
                'name' => 'Plastik 1/4 kg (Pack)',
                'stock' => 10,
                'price' => 40000,
                'image' => 'storage/image/products/plastik 4.png'
            ],
        ];

        // 3. Loop untuk Insert Data (Menggunakan Create)
        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'name'        => $product['name'],
                'slug'        => Str::slug($product['name']), // Generate Slug Otomatis
                'price'       => $product['price'],
                'stock'       => $product['stock'],
                'image'       => $product['image'],
                'description' => 'Produk berkualitas ' . $product['name'] . ' tersedia dengan harga terjangkau.',
            ]);
        }
    }
}