<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogBreed extends Model
{

    protected $fillable = [
        'breedGroup_id'.
        'name',
        'imageUrl'
    ];

    public function breedGroup()
    {
        return $this->belongsTo(DogBreed::class,'breedGroup_id')->where('breedGroup_id',0)->with('breedGroup');
    }

    public function subBreeds()
    {
        return $this->hasMany(DogBreed::class,'breedGroup_id')->with('subBreeds');
    }
}
