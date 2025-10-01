<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class Product extends Model
{
    use HasFactory;
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Membuat atribut 'image_url' yang menghasilkan URL lengkap ke gambar.
     * @return string
     */
    public function getImageUrlAttribute(): string // <-- 2. TAMBAHKAN METHOD INI
    {
        // Cek jika kolom image punya nilai & file-nya ada di storage
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            // Maka, generate URL lengkapnya
            return Storage::url($this->image);
        }
        
        // Jika tidak, kembalikan gambar placeholder
        return 'https://via.placeholder.com/400x300.png?text=No+Image';
    }
}