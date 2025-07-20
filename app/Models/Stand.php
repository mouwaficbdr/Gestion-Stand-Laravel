<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'position',
        'user_id',
        'views',
        'likes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementLikes()
    {
        $this->increment('likes');
    }
}