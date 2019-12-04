<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogProductImage extends Model
{
    protected $fillable = [
        'dog_product_id',
        'src'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'dog_product_id'
    ];

    public function product()
    {
        return $this->belongsTo(DogProduct::class,'dog_product_id');
    }
}
