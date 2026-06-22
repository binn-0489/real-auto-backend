<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    //use HasFactory;

    protected $fillable = [
        'ad_id',
        'path',
        'is_main',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
