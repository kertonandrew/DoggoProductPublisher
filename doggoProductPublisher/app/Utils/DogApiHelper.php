<?php

namespace App\Utils;

use GuzzleHttp\Client as Client;

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

	public function get($url)
	{
		try {
            $response = $this->client->request('GET', $url);
		} catch (\Exception $e) {

            // Todo: Log errors and notify?
            return [];
		}
		return $this->responseHandler($response->getBody()->getContents());
	}

	public function responseHandler($response)
	{
		if ($response) {
			return $response;
		}
		return [];
	}
}
