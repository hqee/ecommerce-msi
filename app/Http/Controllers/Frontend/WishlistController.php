<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // TAMBAHKAN METHOD INI
    public function index()
    {
        // Ambil data wishlist milik user yang login, beserta data produknya
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->with('product.category') // Eager load agar ringan
            ->latest()
            ->paginate(12);

        return view('frontend.wishlist.index', compact('wishlists'));
    }
    
    public function toggle($productId)
    {
        $user = Auth::user();

        // Cek apakah sudah ada di wishlist
        $wishlist = Wishlist::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($wishlist) {
            // Jika ada, hapus (Unlove)
            $wishlist->delete();
            $message = 'Produk dihapus dari favorit.';
        } else {
            // Jika belum, tambahkan (Love)
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);
            $message = 'Produk ditambahkan ke favorit!';
        }

        return back()->with('success', $message);
    }
}