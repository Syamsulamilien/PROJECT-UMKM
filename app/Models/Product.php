<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'category_id',
        'stock',
        'discount'
    ];

    protected $appends = ['final_price', 'original_price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount > 0) {
            return $this->price * (1 - $this->discount / 100);
        }
        return $this->price;
    }

    public function getOriginalPriceAttribute()
    {
        return $this->price;
    }
}