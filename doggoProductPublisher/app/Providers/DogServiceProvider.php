<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as DogClient;

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

        $this->app->singleton('DogClient', function($api) use ($baseUrl) {
            return new DogClient([
                'base_uri' => $baseUrl,
            ]);
        });
    }
}
