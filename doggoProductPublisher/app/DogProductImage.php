<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogProductImage extends Model
{
    protected $fillable = [
        'src'
    ];

    public function product()
    {
        return $this->belongsTo(DogProduct::class);
    }
}
