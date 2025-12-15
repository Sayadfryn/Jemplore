<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    use HasFactory;

    protected $fillable = [
        'tourism_object_id', 
        'name',
        'image',
        'primary_tag',
        'secondary_tags',
        'price_type',       
        'price',
        'min_price',
        'max_price',
        'description',
        'best_at',
        'rating',
        'total_reviews'
    ];

    protected $casts = [
        'secondary_tags' => 'array', 
        'price' => 'decimal:2',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    public function tourismObject()
    {
        return $this->belongsTo(TourismObject::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}