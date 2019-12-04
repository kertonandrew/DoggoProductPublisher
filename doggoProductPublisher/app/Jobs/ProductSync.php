<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Utils\DogApiHelper;
use App\Utils\ShopifyApiHelper;

class ProductSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dogApiHelper;
    protected $shopifyApiHelper;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ShopifyApiHelper $shopifyApiHelper, DogApiHelper $dogApiHelper)
    {
        $this->shopifyApiHelper = $shopifyApiHelper;
        $this->dogApiHelper = $dogApiHelper;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dogs = $this->dogApiHelper->extractAllAndStore();



    }
}
