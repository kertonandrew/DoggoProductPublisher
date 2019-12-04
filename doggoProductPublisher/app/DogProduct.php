<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogProduct extends Model
{
    protected $fillable = [
        'title',
        'body_html',
        'vendor',
        'product_type',
    ];

    protected $with = [
        'variants',
        'images'
    ];

    public function variants()
    {
        return $this->hasMany(DogProductVariant::class, 'dog_product_id');
    }

    public function images()
    {
        return $this->hasMany(DogProductImage::class);
    }
}

