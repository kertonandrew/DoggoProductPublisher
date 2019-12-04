<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class ShopifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $baseUrl = env('SHOPIFY_API_BASE_URL');
        $apiKey = env('SHOPIFY_API_KEY');
        $password = env('SHOPIFY_API_PASSWORD');
        $version = env('SHOPIFY_API_VERSION');

        $this->app->when('App\Utils\ShopifyProductHelper')
            ->needs('GuzzleHttp\Client')
            ->give(function() use ($baseUrl, $apiKey, $password, $version) {
                return new Client([
                    'base_url' => [$baseUrl.'/{version}/', ['version' => $version]],
                    'defaults' => [
                        'auth'    => [$apiKey, $password]
                    ]
                ]);
            });
    }
}
