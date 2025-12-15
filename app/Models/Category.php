<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;
    protected $fillable = ['name', 'slug', 'color'];

    public function tourismObjects() {
        return $this->hasMany(TourismObject::class);
    }
}