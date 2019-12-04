<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogProductImage extends Model
{
    protected $fillable = [
        'dog_product_id',
        'src'
    ];

    public function product()
    {
        return $this->belongsTo(DogProduct::class,'dog_product_id');
    }
}
