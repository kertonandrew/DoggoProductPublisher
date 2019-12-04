<?php

namespace App\Utils;

use GuzzleHttp\Client as Client;
use App\DogBreed;

class DogApiHelper
{
	protected $client;

	public function __construct(Client $client)
	{
        $this->client = $client;
	}

	public function listAll()
	{
		return $this->get('breeds/list/all');
	}

	public function listImagesByBreed($breed)
	{
		return $this->get('breed/'.$breed.'/images');
    }

    public function randonImageByBreed($breed, $count = "")
	{
		return $this->get('breed/'.$breed.'/images/random/'.$count);
    }

    public function listSubBreedsByBreed($breed)
	{
		return $this->get('breed/'.$breed.'/list');
    }

    public function listImagesBySubBreed($breed, $subBreed)
	{
		return $this->get('breed/'.$breed.'/'.$subBreed.'/images');
    }

    public function randonImageBySubBreed($breed, $subBreed, $count = "")
	{
		return $this->get('breed/'.$breed.'/'.$subBreed.'/images/random/'.$count);
    }

    // Gets all the breeds from the API returns a random selection as a collection of DogBreeds
    // Not sure if this should be in this class from a Laravel perspective
    public function extractAllAndStore($count = 5)
    {
        $dogList = $this->listAll();
        $doggoSelection = array_rand($dogList, $count);

        //Todo: valitate response

        $dogs = [];
        $breedName = 'hound';
        // foreach ($doggoSelection as $breedName) {
            $breedImage = $this->randonImageByBreed($breedName);
            $breedObj = DogBreed::create([
                'name' => $breedName,
                'imageUrl' => $breedImage
            ]);

            foreach ($dogList[$breedName] as $subBreedName) {
                $subBreedImage = $this->randonImageBySubBreed($breedName, $subBreedName);
                DogBreed::create([
                    'breedGroup_id' => $breedObj->id,
                    'name' => $subBreedName,
                    'imageUrl' => $subBreedImage
                ]);
            }
            $breedObj = DogBreed::find($breedObj->id);
            $dogs[] = $breedObj;
        // }

        return collect($dogs);
    }

	public function get($url)
	{
		try {
            $response = $this->client->request('GET', $url);
		} catch (\Exception $e) {
            dump($e);
            return [];
		}
		return $this->responseHandler($response->getBody()->getContents());
	}

	public function responseHandler($response)
	{
        $responseArray = json_decode($response, true);
		if ($responseArray["status"] == "success") {
			return $responseArray['message'];
        }
		return [];
	}
}
