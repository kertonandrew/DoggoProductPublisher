<?php

namespace App\Utils;

use GuzzleHttp\Client as Client;

class ShopifyApiHelper
{
	protected $client;

	public function __construct(Client $client)
	{
        $this->client = $client;
    }

    public function index()
	{
		return $this->get('products.json');
    }

	public function create($data)
	{
		return $this->post('products.json', $data);
    }

	public function post($url, $json)
	{
		try {
            $response = $this->client->request('POST', $url, ['json' => $json]);
		} catch (\Exception $e) {
            dump($e);
            return [];
		}
		return $this->responseHandler($response->getBody()->getContents());
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
		if ($response) {
			return $response;
		}
		return [];
	}
}
