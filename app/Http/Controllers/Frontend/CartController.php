<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Method untuk menampilkan halaman keranjang
    public function index(Request $request)
    {
        // Ambil keranjang milik user yang sedang login, beserta item dan produknya
        $cart = $request->user()->cart()->with('items.product')->first();
        
        // Hitung subtotal
        $subtotal = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }

        return view('cart.index', compact('cart', 'subtotal'));
    }

    // Method untuk menambah produk ke keranjang
    public function add(Request $request, Product $product)
    {
        $cart = $request->user()->cart()->firstOrCreate();
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create(['product_id' => $product->id, 'quantity' => 1]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Method untuk meng-update jumlah produk
    public function update(Request $request, CartItem $cartItem)
    {
        // dd($request->all()); 
        
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    // Method untuk menghapus produk dari keranjang
    public function remove(Request $request, CartItem $cartItem)
    {
        $cartItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}