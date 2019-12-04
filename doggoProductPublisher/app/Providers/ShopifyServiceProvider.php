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
        $baseUri = env('SHOPIFY_API_BASE_URI');
        $apiKey = env('SHOPIFY_API_KEY');
        $password = env('SHOPIFY_API_PASSWORD');
        $version = env('SHOPIFY_API_VERSION');

        $this->app->when('App\Utils\ShopifyApiHelper')
            ->needs('GuzzleHttp\Client')
            ->give(function() use ($baseUri, $apiKey, $password, $version) {
                return new Client([
                    'base_uri' => 'https://'.$apiKey.':'.$password.'@'.$baseUri.$version.'/',
                ]);
            });
    }
}
