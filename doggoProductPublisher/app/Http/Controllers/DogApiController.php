<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\DogBreedApi;
use App\Http\Resources\DogBreedResource;


class DogApiController extends Controller
{
    protected $dogBreedApi;

    public function __construct(DogBreedApi $dogBreedApi)
    {
    	$this->dogBreedApi = $dogBreedApi;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dogs = $this->dogBreedApi->listAll();

        //Todo: valitate response
        return ($dogs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($breed)
    {
        $dog = $this->dogBreedApi->listImagesByBreed($breed);

        //Todo: valitate response

        return $dog;
    }

}
