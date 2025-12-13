<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'description',
        'address',
        'thumbnail',
        'latitude',
        'longitude',
        'opening_hours',
        'closing_hours',
        'ticket_price',
        'contact_number',
        'is_active',
        'rating',
        'total_reviews',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function culinaries()
    {
        return $this->hasMany(Culinary::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(TourismObjectImage::class)->orderBy('sort_order');
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }
}