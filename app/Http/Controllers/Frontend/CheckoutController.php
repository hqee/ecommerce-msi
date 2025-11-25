<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
        {
            // 1. Validasi Input
            $request->validate([
                'delivery_method' => 'required|in:pickup,delivery',
                'payment_method' => 'required|in:cash,qris',
                'payment_proof' => 'required_if:payment_method,qris|image|max:2048', // Wajib jika QRIS
            ]);

            $user = $request->user();
            $cart = $user->cart()->with('items.product')->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index');
            }

            try {
                DB::beginTransaction();

                // Cek stok ... (kode sama seperti sebelumnya)
                foreach ($cart->items as $item) {
                    if ($item->product->stock < $item->quantity) {
                        throw new \Exception('Stok habis: ' . $item->product->name);
                    }
                }

                // 2. Hitung Biaya
                $subtotal = $cart->items->sum(fn($i) => $i->quantity * $i->product->price);
                $shippingCost = ($request->delivery_method === 'delivery') ? 5000 : 0;
                $totalAmount = $subtotal + $shippingCost;

                // 3. Handle Upload Bukti Bayar
                $proofPath = null;
                if ($request->hasFile('payment_proof')) {
                    $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
                }

                // 4. Buat Order dengan data lengkap
                $order = $user->orders()->create([
                    'total_amount'    => $totalAmount,
                    'status'          => 'pending',
                    'delivery_method' => $request->delivery_method,
                    'shipping_cost'   => $shippingCost,
                    'payment_method'  => $request->payment_method,
                    'payment_proof'   => $proofPath,
                ]);

                // Pindahkan item & kurangi stok ... (kode sama seperti sebelumnya)
                foreach ($cart->items as $item) {
                    $order->items()->create([
                        'product_id' => $item->product_id,
                        'quantity'   => $item->quantity,
                        'price'      => $item->product->price,
                        'subtotal'   => $item->quantity * $item->product->price,
                    ]);
                    $item->product->decrement('stock', $item->quantity);
                }

                $cart->items()->delete();
                DB::commit();

                return redirect()->route('home')->with('success', 'Pesanan berhasil! Mohon tunggu konfirmasi admin.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Gagal: ' . $e->getMessage());
            }
        }

        // Tambahkan method ini
    public function index(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung subtotal untuk dikirim ke view
        $subtotal = $cart->items->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        return view('frontend.checkout', compact('cart', 'subtotal'));
    }
}