<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        try {
            DB::beginTransaction();

            // 1. Cek Stok Dulu
            foreach ($cart->items as $item) {
                // Pastikan ambil stok terbaru dari DB, bukan dari cache relasi
                $freshProduct = $item->product->fresh(); 
                if ($freshProduct->stock < $item->quantity) {
                    throw new \Exception('Stok untuk produk "' . $freshProduct->name . '" tidak mencukupi. Sisa stok: ' . $freshProduct->stock);
                }
            }
            
            // 2. Buat Order Utama
            $order = $user->orders()->create([
                'total_amount' => $cart->items->sum(function($item) {
                    return $item->quantity * $item->product->price;
                }),
                'status' => 'pending',
            ]);

            // 3. Pindahkan Item & Kurangi Stok
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                    'subtotal'   => $item->quantity * $item->product->price,
                ]);

                // Kurangi stok
                $item->product->decrement('stock', $item->quantity);
            }

            // 4. Hapus Keranjang
            $cart->items()->delete();
            
            // 5. Simpan Permanen
            DB::commit();

            return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Ini akan mengirim pesan error ke View yang baru kita update
            return back()->with('error', 'Gagal Checkout: ' . $e->getMessage());
        }
    }
}