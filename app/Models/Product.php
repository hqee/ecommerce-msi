<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TAMBAHKAN PROPERTI INI
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }
        
        return 'https://via.placeholder.com/400x300.png?text=No+Image';
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}