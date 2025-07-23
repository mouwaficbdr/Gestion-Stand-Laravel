<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'nom', 'email', 'telephone', 'stand_id', 'total', 'honeypot',
    ];

    public static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = strtoupper('CMD-' . Str::random(8));
            }
        });
    }

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
} 