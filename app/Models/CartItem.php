<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Sebaiknya tambahkan ini
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory; // Sebaiknya tambahkan ini

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    /**
     * Menandakan bahwa model ini tidak menggunakan timestamps (created_at & updated_at).
     *
     * @var bool
     */
    public $timestamps = false; // <-- TAMBAHKAN BARIS INI

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}