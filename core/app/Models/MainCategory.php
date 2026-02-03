<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MainCategory extends Model
{
    // use InteractsWithMedia;
    protected $guarded = [];
    protected $casts = [
        'photos' => 'array'
    ];
    public function subCategory()
    {
        return $this->hasMany(\App\Models\SubCategory::class);
    }
    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class,'products_category');
    }
}
