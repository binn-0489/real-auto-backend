<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    public function ads()
    {
        return $this->hasMany(Ad::class, 'brand_id', 'id');
    }
}
