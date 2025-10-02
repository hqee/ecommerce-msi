<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total produk
        $totalProducts = Product::count();

        // 2. Hitung total order yang selesai (asumsi ada kolom 'status')
        $completedOrders = Order::where('status', 'completed')->count();

        // 3. Hitung total order yang dibatalkan
        $canceledOrders = Order::where('status', 'canceled')->count();

        // 4. Hitung total pengguna (user biasa)
        $totalUsers = User::where('role', 'user')->count();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalProducts',
            'completedOrders',
            'canceledOrders',
            'totalUsers'
        ));
    }
}