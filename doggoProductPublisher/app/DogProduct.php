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
        'images'
    ];

    public function variants()
    {
        return $this->hasMany(DogProductVariant::class);
    }
}

