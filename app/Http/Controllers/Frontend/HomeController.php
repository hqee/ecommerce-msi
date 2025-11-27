<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request; // <-- 1. Jangan lupa import Request
use App\Models\Wishlist;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query
        $query = Product::with('category');

        if (auth()->check()) {
        // Menambahkan atribut 'is_favorited' (true/false) ke setiap produk
        $query->withExists(['wishlists as is_favorited' => function ($q) {
            $q->where('user_id', auth()->id());
        }]);
    }

        // 1. Filter Kategori (yang sudah ada)
        if ($request->has('category') && $request->category != null) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 2. Filter Pencarian (BARU)
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Eksekusi query
        $products = $query->latest()->paginate(12)->withQueryString();
        
        
        // Ambil kategori untuk dropdown (sebenarnya ini sudah di-handle ViewComposer, 
        // tapi jika Anda menghapusnya dari ViewComposer, biarkan di sini).
        // Jika pakai ViewComposer, baris di bawah bisa dihapus.
        $categories = Category::orderBy('name', 'ASC')->get(); 

        return view('home', compact('products', 'categories'));
    }
}