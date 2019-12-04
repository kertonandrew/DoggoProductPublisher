<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\DogApiHelper;
use App\DogBreed;
use App\Http\Resources\DogBreedResource;

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
    public function extractAllAndStore(Request $request)
    {
        $dogsArray = $this->dogApiHelper->listAll();

        //Todo: valitate response

        $dogs = [];
        foreach ($dogsArray as $breedName => $subBreedNames) {

            $breedImage = $this->dogApiHelper->randonImageByBreed($breedName);

            $breedObj = DogBreed::create([
                'name' => $breedName,
                'imageUrl' => $breedImage
            ]);

            $subBreeds = [];
            foreach ($subBreedNames as $subBreedName) {
                $subBreedImage = $this->dogApiHelper->randonImageByBreed($subBreedName);

                $subBreeds[] = DogBreed::create([
                    'breedGroup_id' => $breedObj->id,
                    'name' => $breedName,
                    'imageUrl' => $subBreedImage
                ]);
            }

            $breedObj->subBreeds()->saveMany($subBreeds);

            $dogs[] = $breedObj;
        }

        dd($dogs);

        //Todo: create dog breed model

        return DogBreedResource::collection($dogs);
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
