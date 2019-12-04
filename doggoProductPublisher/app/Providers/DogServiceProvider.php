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
        $baseUrl = env('DOG_API_BASE_URL');

        $this->app->when('App\Utils\DogApiHelper')
            ->needs('GuzzleHttp\Client')
            ->give(function() use ($baseUrl) {
                return new Client([
                    'base_uri' => $baseUrl,
                ]);
            });
    }
}
