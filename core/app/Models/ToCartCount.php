<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stevebauman\Location\Facades\Location;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ToCartCount extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected function ipAdress(): Attribute
    {
        return Attribute::make(
            get: function(string $ip){
                $userData = Location::get($ip);
                return env('APP_ENV') == 'production'?$userData->countryName. '/'. $userData->cityName:$ip;
            },
        );
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
