<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class telegramOrder extends Model
{
    protected $table = 'tg_orders';
    protected $fillable = [
        'telegram_id',
        'telegram_username',
        'product_id',
        'clothing_category',
        'measurements',
        'total_price',
        'status'
    ];

    protected $casts = [
        'measurements' => 'array', // Crucial for Filament to read JSON
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
