<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tourism_object_id',
        'submission_type',
        'payload',
        'status',
        'admin_feedback',
        'proof_document',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourismObject()
    {
        return $this->belongsTo(TourismObject::class);
    }
}
