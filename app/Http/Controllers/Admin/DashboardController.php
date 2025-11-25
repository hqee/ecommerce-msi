<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        // --- DATA KARTU STATISTIK ---
        $totalProducts = Product::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $canceledOrders = Order::where('status', 'canceled')->count();
        $totalUsers = User::where('role', 'user')->count();

        // --- DATA GRAFIK PENJUALAN BULANAN ---
        // Mengambil total penjualan per bulan untuk tahun ini
        $salesDataRaw = Order::select(
            DB::raw('MONTH(created_at) as month'), 
            DB::raw('SUM(total_amount) as total') // Pastikan 'total_amount' sesuai kolom DB Anda
        )
        ->where('status', 'completed') // Hanya pesanan selesai
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Format data untuk Chart.js (isi 0 jika bulan tidak ada penjualan)
        $salesLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $salesData = array_fill(0, 12, 0); // Array default [0, 0, ..., 0]

        foreach ($salesDataRaw as $data) {
            // month di DB mulai dari 1, array mulai dari 0. Jadi kurangi 1.
            $salesData[$data->month - 1] = $data->total;
        }

        // --- DATA TRANSAKSI TERAKHIR ---
        $latestOrders = Order::with('user') // Eager load user
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'completedOrders',
            'canceledOrders',
            'totalUsers',
            'salesLabels',
            'salesData',
            'latestOrders'
        ));
    }
}