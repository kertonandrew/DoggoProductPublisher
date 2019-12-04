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

            $breedObj = new DogBreed();
            $breedObj->fill([
                'name' => $breedName,
                'imageUrl' => $this->dogApiHelper->randonImageByBreed($breedName)
            ]);

            $subBreeds = [];
            foreach ($subBreedNames as $subBreedName) {

                $subBreedObj = new DogBreed();
                $subBreedObj->fill([
                    'breedGroup_id' => $breedObj->id,
                    'name' => $breedName,
                    'imageUrl' => $this->dogApiHelper->randonImageByBreed($subBreedName)
                ]);

                $subBreeds[] = $subBreedObj;
            }

            // To handle "Array to string conversion" issue - not sure what's happening here.
            // Mostly likely something that would be handled by propper validation.
            try{
                $breedObj->subBreeds()->saveMany($subBreeds);
            } catch(\Exception $e){
                dump($e);
            }

            $dogs[] = $breedObj;
        }

        //Todo: create dog breed model

        return $dogs;
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
