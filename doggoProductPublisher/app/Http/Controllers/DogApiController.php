<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\DogBreedApiHelper;
use App\Http\Resources\DogBreedResource;


class DogApiController extends Controller
{
    protected $dogBreedApiHelper;

    public function __construct(DogBreedApiHelper $dogBreedApiHelper)
    {
    	$this->dogBreedApiHelper = $dogBreedApiHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dogs = $this->dogBreedApiHelper->listAll();

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
        $dog = $this->dogBreedApiHelper->listImagesByBreed($breed);

        //Todo: valitate response

        return $dog;
    }

}
