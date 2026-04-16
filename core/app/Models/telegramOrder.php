<?php

// app/Models/telegramOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class telegramOrder extends Model
{
    protected $table = 'tg_orders';

    protected $fillable = [
        'telegram_id',
        'telegram_username',
        'full_name',       // Added
        'phone_number',    // Added
        'product_id',
        'clothing_category',
        'measurements',
        'total_price',
        'status'
    ];

    protected $casts = [
        'measurements' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
