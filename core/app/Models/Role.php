<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['id','name', 'description', 'slug'];
    public function stakeholders()
    {
        return $this->belongsToMany(\App\Models\Manager::class, 'stakeholder_role');
    }
}
