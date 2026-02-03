<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'specifications' => 'array',
        'path' => 'array' // Casts JSON to array
    ];
    // protected function specifications(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_encode($value),
    //     );
    // }
    // You can add a method to decode the attributes if needed
    public function getSpecificationsAttribute($value)
    {
        return json_decode($value, true);  // Decode JSON to an array
    }

    // Mutator: Encode specifications array to JSON before saving it to the database
    public function setSpecificationsAttribute($value)
    {
        $this->attributes['specifications'] = json_encode($value);  // Encode array to JSON
    }
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }


}
