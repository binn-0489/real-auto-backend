<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ad extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'user_id',
        'brand_id',
        'model',
        'generation',
        'price',
        'mileage',
        'year',
        'transmission',
        'drive',
        'engine_type',
        'engine_volume',
        'engine_power',
        'wheel',
        'condition',
        'body_type',
        'description',
        'location',
        'vin',
        'number',
        //'photo',
    ];

    //protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id', 'id');
    }

}
