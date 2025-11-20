<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}