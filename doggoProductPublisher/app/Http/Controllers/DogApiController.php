<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\DogApiHelper;

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
    public function index(Request $request)
    {
        $dogs = $this->dogApiHelper->listAll();

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
        $dog = $this->dogApiHelper->listImagesByBreed($breed);

        //Todo: valitate response

        return $dog;
    }

}
