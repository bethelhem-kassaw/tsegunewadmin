<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'group_product_id',
        'voted_by_telegram_id',
    ];

    public function groupProduct()
    {
        return $this->belongsTo(GroupProduct::class);
    }
}
