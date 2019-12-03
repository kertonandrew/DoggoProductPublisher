<?php

namespace App\Utils;

use GuzzleHttp\Client as ShopifyClient;

class ShopifyProductHelper
{
	protected $client;

	public function __construct(ShopifyClient $client)
	{
		$this->client = $client;
	}

	public function listAll()
	{
		return $this->endpointRequest('the/path');
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
			return $response;
		}
		return [];
	}
}
