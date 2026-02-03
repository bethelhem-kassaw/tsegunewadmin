<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryCity extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function subcityies() {
        return $this->hasMany(SubCity::class, 'city_id');
    }

    public function shipmentRate()
    {
        return $this->hasOne(ShippmentRate::class,'city_id');
    }
}
