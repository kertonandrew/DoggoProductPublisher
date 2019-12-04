<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\DogApiHelper;
use App\DogBreed;
use App\Http\Resources\DogBreedResource;
use Illuminate\Support\Collection;

class DogApiController extends Controller
{
    protected $dogApiHelper;

    public function __construct(DogApiHelper $dogApiHelper)
    {
    	$this->dogApiHelper = $dogApiHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function extractAllAndStore($count = 5)
    {

        $dogList = $this->dogApiHelper->listAll();
        $doggoSelection = array_rand($dogList, $count);

        //Todo: valitate response

        $dogs = [];
        foreach ($doggoSelection as $breedName) {
            $breedImage = $this->dogApiHelper->randonImageByBreed($breedName);
            $breedObj = DogBreed::create([
                'name' => $breedName,
                'imageUrl' => $breedImage
            ]);

            $subBreeds = [];
            foreach ($dogList[$breedName] as $subBreedName) {
                $subBreedImage = $this->dogApiHelper->randonImageBySubBreed($breedName, $subBreedName);
                $subBreedObj = DogBreed::create([
                    'breedGroup_id' => $breedObj->id,
                    'name' => $breedName,
                    'imageUrl' => $subBreedImage
                ]);
                $subBreeds[] = $subBreedObj;
            }

            $breedObj->subBreeds()->saveMany($subBreeds);

            $dogs[] = $breedObj;
        }

        return collect($dogs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function extractBreedAndStore($breed)
    {
        $dog = $this->dogApiHelper->listImagesByBreed($breed);

        //Todo: valitate response

        return $dog;
    }

}
