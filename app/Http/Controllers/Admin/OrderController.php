<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        // Ambil pesanan terbaru beserta data usernya
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail satu pesanan
    public function show(Order $order)
    {
        // Load detail item dan produknya
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    // Update status pesanan (misal: dari pending -> completed)
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}