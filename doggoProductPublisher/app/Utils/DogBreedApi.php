<?php

namespace App\Utils;

use GuzzleHttp\Client;

class DogBreedApi
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}


	public function listAll()
	{
		return $this->endpointRequest('breeds/list/all');
	}

	public function listImagesByBreed($breed)
	{
		return $this->endpointRequest('breed/'.$breed.'/images');
    }

    public function randonImageByBreed($breed, $count = "")
	{
		return $this->endpointRequest('breed/'.$breed.'/images/random/'.$count);
    }

    public function listSubBreedsByBreed($breed)
	{
		return $this->endpointRequest('breed/'.$breed.'/list');
    }

    public function listImagesBySubBreed($breed, $subBreed)
	{
		return $this->endpointRequest('breed/'.$breed.'/'.$subBreed.'/images');
    }

    public function randonImageBySubBreed($breed, $subBreed, $count = "")
	{
		return $this->endpointRequest('breed/'.$breed.'/'.$subBreed.'/images/random/'.$count);
    }

	public function endpointRequest($url)
	{
		try {
            $response = $this->client->request('GET', $url);
		} catch (\Exception $e) {
            // Todo: Log errors and notify?
            return [];
		}

		return $this->response_handler($response->getBody()->getContents());
	}

	public function response_handler($response)
	{
		if ($response) {
			return json_decode($response);
		}

		return [];
	}
}
