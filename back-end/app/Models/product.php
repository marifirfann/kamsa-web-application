<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'product_image',
    ];

    // Mutator untuk menyimpan gambar produk
    public function setProductImageAttribute($value)
    {
        if (is_object($value) && method_exists($value, 'store')) {
            // Menyimpan gambar ke disk public dan direktori products
            $this->attributes['product_image'] = $value->store('products', 'public');
        }
    }

    // Menampilkan URL gambar produk
    public function getProductImageUrlAttribute()
    {
        return $this->product_image ? Storage::url($this->product_image) : null;
    }
}
