<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'tourism_object_id', 
        'culinary_id',
        'rating', 
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourismObject()
    {
        return $this->belongsTo(TourismObject::class);
    }
    
    public function culinary()
    {
        return $this->belongsTo(Culinary::class);
    }
}