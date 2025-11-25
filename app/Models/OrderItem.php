<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    public $timestamps = false; // <--- WAJIB ADA jika tabel tidak punya created_at/updated_at

    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price', 
        'subtotal' // <--- WAJIB ADA
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi: Satu item pesanan milik satu order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}