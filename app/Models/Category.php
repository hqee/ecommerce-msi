<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import ini

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Relasi: Satu Kategori memiliki BANYAK Produk
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}