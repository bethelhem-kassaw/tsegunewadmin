<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellProvider extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function stakeholders()
    {
        return $this->hasMany(Stakeholder::class, 'company_id');
    }
}
