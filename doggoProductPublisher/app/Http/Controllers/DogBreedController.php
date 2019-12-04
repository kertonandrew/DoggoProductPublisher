<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DogBreed;
use App\Http\Resources\DogBreedResource;

class DogBreedController extends Controller
{
    const ITEM_PER_PAGE = 20;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $DogBreedQuery = DogBreed::query();
        $limit = Arr::get($params, 'limit', static::ITEM_PER_PAGE);

        return DogBreedResource::collection($DogBreedQuery->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Todo: add validation rules

        $dogBreed = DogBreed::create([
            'breedGroup_id' => $request->breedGroup_id,
            'name' => $request->name,
            'imageUrl' => $request->imageUrl,
        ]);

        // Could set this up to loop through child breeds but our data is only 1
        // layer deep so this is fine.
        $subBreeds = [];
        foreach ($request->subBreeds as $subBreed) {
            $subBreeds[] = DogBreed::create([
                'breedGroup_id' => $dogBreed->id,
                'name' => $subBreed['name'],
                'imageUrl' => $subBreed['imageUrl'],
            ]);
        }

        $dogBreed->subBreeds()->saveMany($subBreeds);

        return new DogBreedResource($dogBreed);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DogBreed $dogBreed)
    {
        try {
            $dogBreed->delete();
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
