<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogProductVariant extends Model
{
    protected $fillable = [
        'dogProduct_id',
        'option1', //name
        'price',
        'sku'
    ];

    public function product()
    {
        return $this->belongsTo(DogProduct::class);
    }
}
