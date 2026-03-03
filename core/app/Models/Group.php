<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'created_by_telegram_id',
    ];

    public function groupProducts()
    {
        return $this->hasMany(GroupProduct::class);
    }
    public function products()
    {
        return $this->hasMany(GroupProduct::class)->with('product', 'votes');
    }
}
