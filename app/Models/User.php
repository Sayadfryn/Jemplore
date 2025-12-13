<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'google_id', 
        'role',      
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tourismObject()
    {
        return $this->hasOne(TourismObject::class);
    }

    public function registrationSubmission()
    {
        return $this->hasOne(Submission::class)
            ->where('submission_type', 'create_new_tourism')
            ->latest();
    }
}