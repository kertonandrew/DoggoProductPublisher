<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogProductVariant extends Model
{
    protected $fillable = [
        'dog_product_id',
        'option1', //name
        'price',
        'sku'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'dog_product_id'
    ];

    public function product()
    {
        return $this->belongsTo(DogProduct::class, 'dog_product_id');
    }
}
