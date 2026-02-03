<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $casts = [
        'expire_at' => 'datetime',
    ];
    protected $guarded = [];
}
