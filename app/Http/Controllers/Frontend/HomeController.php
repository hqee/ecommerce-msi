<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request; // <-- 1. Jangan lupa import Request

class HomeController extends Controller
{
    public function index(Request $request) // <-- 2. Tambahkan Request $request
    {
        // Mulai query produk dengan relasi kategori
        $query = Product::with('category');

        // 3. Cek apakah ada parameter 'category' di URL
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        // Ambil hasil query yang sudah difilter (jika ada)
        // withQueryString() penting agar paginasi tetap membawa filter
        $products = $query->latest()->paginate(8)->withQueryString();

        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }
}