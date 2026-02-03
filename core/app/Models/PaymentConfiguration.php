<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentConfiguration extends Model
{
    use HasFactory;
    protected $casts = ['field_values' => 'array'];
    protected $guarded = [];
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    
}
