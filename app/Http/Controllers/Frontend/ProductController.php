<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product; // Jangan lupa import model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman detail untuk satu produk.
     */
    public function show(Product $product)
    {
        // Kirim data produk ke view
        return view('products.show', compact('product'));
    }
}