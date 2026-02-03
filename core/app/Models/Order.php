<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    // notifiable
    use Notifiable;
    protected $guarded = [];
    public function orderDetails()
    {
        return $this->hasMany(\App\Models\OrderDetail::class);
    }
    public function payment()
    {
        return $this->belongsTo(\App\Models\paypalpayment::class);
    }
    public function shippmentAdress()
    {
        return $this->belongsTo(\App\Models\Adress::class, 'shppment_adress_id');
    }

    // public function products()
    // {
    //     return $this->belongsToMany(\App\Models\Product::class, 'order_details')->withPivot('quantity');
    // }
}
