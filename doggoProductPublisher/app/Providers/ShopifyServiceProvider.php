<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as ShopifyClient;

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

        $this->app->singleton('ShopifyClient', function($api) use ($baseUrl, $apiKey, $password, $version) {
            return new ShopifyClient([
                'base_url' => [$baseUrl.'/{version}/', ['version' => $version]],
                'defaults' => [
                    'auth'    => [$apiKey, $password]
                ]
            ]);
        });
    }
}
