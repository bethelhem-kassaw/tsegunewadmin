<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $fillable = [
        'group_id',
        'product_id',
        'added_by_telegram_id'
    ];

    protected $with = ['product']; // AUTO load product details

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
