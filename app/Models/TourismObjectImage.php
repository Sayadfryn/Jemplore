<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismObjectImage extends Model
{
    use HasFactory;
    protected $fillable = ['tourism_object_id', 'image_path', 'sort_order'];
}