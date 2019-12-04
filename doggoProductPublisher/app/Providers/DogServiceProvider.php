<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class DogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $baseUri = env('DOG_API_BASE_URI');

        $this->app->when('App\Utils\DogApiHelper')
            ->needs('GuzzleHttp\Client')
            ->give(function() use ($baseUri) {
                return new Client([
                    'base_uri' => $baseUri,
                ]);
            });
    }
}
