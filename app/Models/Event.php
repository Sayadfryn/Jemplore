<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'tourism_object_id', 
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'start_time',
        'location_name',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function tourismObject()
    {
        return $this->belongsTo(TourismObject::class);
    }
}