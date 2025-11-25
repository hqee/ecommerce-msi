<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar pesanan user
    public function index()
    {
        $orders = Order::where('user_id', auth()->id()) // Hanya ambil punya user yg login
            ->latest()
            ->paginate(5);

        return view('frontend.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan user
    public function show(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya sendiri (Keamanan)
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('items.product');
        return view('frontend.orders.show', compact('order'));
    }
}