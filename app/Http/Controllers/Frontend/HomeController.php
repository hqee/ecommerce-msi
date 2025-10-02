<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(8);
        $categories = Category::limit(5)->get(); // Ambil 5 kategori teratas

        return view('home', compact('products', 'categories')); // Kirimkan kategori juga
    }
}
