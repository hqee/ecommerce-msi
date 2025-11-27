<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KARTU STATISTIK
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count(); // <-- Ini yang tadi hilang
        $canceledOrders = Order::where('status', 'canceled')->count();   // <-- Ini juga
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();

        // 2. GRAFIK PENJUALAN BULANAN
        // Definisikan Label Bulan Manual
        $salesLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']; // <-- INI YANG MENYEBABKAN ERROR

        $salesDataRaw = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
        ->where('status', 'completed')
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $salesData = array_fill(0, 12, 0);
        foreach ($salesDataRaw as $data) {
            $salesData[$data->month - 1] = $data->total;
        }

        // 3. PRODUK TERLARIS
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select('products.name', 'products.image', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // 4. STOK MENIPIS
        $lowStockProducts = Product::where('stock', '<', 5)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        // 5. TRANSAKSI TERAKHIR
        $latestOrders = Order::with('user')->latest()->take(5)->get();

        // Kirim SEMUA data ke View
        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'completedOrders',
            'canceledOrders',
            'totalUsers',
            'totalProducts',
            'salesLabels', // <-- Pastikan ini terkirim
            'salesData',
            'topProducts',
            'lowStockProducts',
            'latestOrders'
        ));
    }
}